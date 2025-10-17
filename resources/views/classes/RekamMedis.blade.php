<?php
class RekamMedis {
    private $conn;
    private $table = "rekam_medis";

    public $idrekam_medis;
    public $idreservasi_dokter;
    public $anamnesa;
    public $diagnosa;
    public $temuan_klinis;
    public $dokter_pemeriksa;

    public function __construct($db) {
        $this->conn = $db;
    }

    // 🩺 Tambah Data Rekam Medis
    public function create() {
        // 🔍 Cek dulu apakah idreservasi_dokter sudah ada di tabel temu_dokter
        $cekQuery = "SELECT idreservasi_dokter FROM temu_dokter WHERE idreservasi_dokter = ?";
        $cekStmt = $this->conn->prepare($cekQuery);
        $cekStmt->bind_param("i", $this->idreservasi_dokter);
        $cekStmt->execute();
        $result = $cekStmt->get_result();

        // ⚙️ Kalau belum ada, insert otomatis ke temu_dokter
        if ($result->num_rows == 0) {
            $insertTemu = "INSERT INTO temu_dokter (no_urut, status, idpet, idrole_user) VALUES (1, 'A', 1, ?)";
            $insertStmt = $this->conn->prepare($insertTemu);
            $insertStmt->bind_param("i", $this->dokter_pemeriksa);
            $insertStmt->execute();
        }

        // 🩺 Setelah itu baru insert ke rekam_medis
        $query = "INSERT INTO $this->table (idreservasi_dokter, anamnesa, diagnosa, temuan_klinis, dokter_pemeriksa)
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("issss", 
            $this->idreservasi_dokter, 
            $this->anamnesa, 
            $this->diagnosa, 
            $this->temuan_klinis, 
            $this->dokter_pemeriksa
        );

        // ✅ Jika insert ke rekam_medis berhasil
        if ($stmt->execute()) {
            // Ambil ID rekam medis terakhir yang baru ditambah
            $last_id = $this->conn->insert_id;

            // 🔁 Tambahkan otomatis ke tabel detail_rekam_medis
            $insertDetail = "INSERT INTO detail_rekam_medis (idrekam_medis, idkode_tindakan_terapi, detail)
                             VALUES (?, ?, ?)";
            $detailStmt = $this->conn->prepare($insertDetail);

            // misal default tindakan 101 (atau bisa disesuaikan)
            $defaultKode = 101;
            $defaultDetail = 'Belum ada tindakan lanjutan';

            $detailStmt->bind_param("iis", $last_id, $defaultKode, $defaultDetail);
            $detailStmt->execute();

            return true;
        }

        return false;
    }

    // 📋 Tampilkan Semua Data Rekam Medis
    public function readAll() {
        $query = "SELECT * FROM $this->table ORDER BY idrekam_medis DESC";
        return $this->conn->query($query);
    }

    // 🔍 Ambil 1 Data Rekam Medis Berdasarkan ID
    public function readById($id) {
        $query = "SELECT * FROM $this->table WHERE idrekam_medis = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        // kalau ada datanya, ambil 1 baris
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null; // biar gak error pas detail.php ngecek
        }
    }

    // ✏️ Update Rekam Medis
    public function update() {
        $query = "UPDATE $this->table 
                  SET anamnesa=?, diagnosa=?, temuan_klinis=?, dokter_pemeriksa=? 
                  WHERE idrekam_medis=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssi", 
            $this->anamnesa, 
            $this->diagnosa, 
            $this->temuan_klinis, 
            $this->dokter_pemeriksa, 
            $this->idrekam_medis
        );
        return $stmt->execute();
    }

    // 🗑️ Hapus Data Rekam Medis
    public function delete($id) {
        $query = "DELETE FROM $this->table WHERE idrekam_medis=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
