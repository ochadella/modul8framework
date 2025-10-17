<?php
class TemuDokter {
    private $conn;

    public function __construct($db) {
        $this->conn = $db->getConnection();
    }

    // 🔹 Tambah data baru (reservasi)
    public function create($no_urut, $status, $idpet, $idrole_user) {
        $sql = "INSERT INTO temu_dokter (no_urut, status, idpet, idrole_user) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isii", $no_urut, $status, $idpet, $idrole_user);
        return $stmt->execute();
    }

    // 🔹 Ambil semua data temu dokter (sinkron nama hewan, pemilik, dokter)
    public function getAll() {
        $sql = "
            SELECT 
                td.idreservasi_dokter,
                td.no_urut,
                td.waktu_daftar,
                td.status,
                p.idpet,
                p.nama AS nama_pet,
                pm.nama AS nama_pemilik,
                u.nama AS nama_dokter,
                ru.idrole_user
            FROM temu_dokter td
            JOIN pet p ON td.idpet = p.idpet
            JOIN pemilik pm ON p.idpemilik = pm.idpemilik
            JOIN role_user ru ON td.idrole_user = ru.idrole_user
            JOIN user u ON ru.iduser = u.iduser
            ORDER BY td.waktu_daftar DESC
        ";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // 🔹 Ambil 1 data by ID
    public function getById($id) {
        $sql = "SELECT * FROM temu_dokter WHERE idreservasi_dokter = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // 🔹 Update data
    public function update($id, $no_urut, $status, $idpet, $idrole_user) {
        $sql = "UPDATE temu_dokter 
                SET no_urut = ?, status = ?, idpet = ?, idrole_user = ?
                WHERE idreservasi_dokter = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isiii", $no_urut, $status, $idpet, $idrole_user, $id);
        return $stmt->execute();
    }

    // 🔹 Hapus data
    public function delete($id) {
        $sql = "DELETE FROM temu_dokter WHERE idreservasi_dokter = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
