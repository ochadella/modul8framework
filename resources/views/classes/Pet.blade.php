<?php
class Pet {
    private $db;

    public function __construct($db) {
        $this->db = $db->getConnection();
    }

    // 🔹 Ambil semua data pet dengan join tabel pemilik, ras, dan jenis
    public function getAll() {
        $sql = "SELECT 
                    p.idpet, 
                    p.nama, 
                    p.tanggal_lahir,
                    p.warna_bulu,
                    p.jenis_kelamin,
                    pm.idpemilik, 
                    pm.nama AS nama_pemilik, 
                    r.idras_hewan, 
                    r.nama_ras, 
                    j.nama_jenis_hewan
                FROM pet p
                JOIN pemilik pm ON p.idpemilik = pm.idpemilik
                JOIN ras_hewan r ON p.idras_hewan = r.idras_hewan
                JOIN jenis_hewan j ON r.idjenis_hewan = j.idjenis_hewan
                ORDER BY p.idpet ASC";
        $result = $this->db->query($sql);
        $data = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) $data[] = $row;
        }
        return ['data' => $data];
    }

    // 🔹 Ambil data pet berdasarkan ID
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM pet WHERE idpet=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // 🔹 Tambah data pet (sinkron dengan Datapet.php)
    public function create($nama, $tanggal_lahir, $warna_bulu, $jenis_kelamin, $idpemilik, $idras) {
        $stmt = $this->db->prepare("
            INSERT INTO pet (nama, tanggal_lahir, warna_bulu, jenis_kelamin, idpemilik, idras_hewan) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param("ssssii", $nama, $tanggal_lahir, $warna_bulu, $jenis_kelamin, $idpemilik, $idras);
        return $stmt->execute();
    }

    // 🔹 Update data pet
    public function update($id, $nama, $tanggal_lahir, $warna_bulu, $jenis_kelamin, $idpemilik, $idras) {
        $stmt = $this->db->prepare("
            UPDATE pet 
            SET nama=?, tanggal_lahir=?, warna_bulu=?, jenis_kelamin=?, idpemilik=?, idras_hewan=? 
            WHERE idpet=?
        ");
        $stmt->bind_param("ssssiii", $nama, $tanggal_lahir, $warna_bulu, $jenis_kelamin, $idpemilik, $idras, $id);
        return $stmt->execute();
    }

    // 🔹 Hapus data pet
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM pet WHERE idpet=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
