<?php
class RasHewan {
    private $db;

    public function __construct($db) {
        $this->db = $db->getConnection();
    }

    // Ambil semua ras + join jenis hewan
    public function getAll() {
        $sql = "SELECT r.idras_hewan, r.nama_ras, j.nama_jenis_hewan
                FROM ras_hewan r
                JOIN jenis_hewan j ON r.idjenis_hewan = j.idjenis_hewan
                ORDER BY r.idras_hewan ASC";
        $result = $this->db->query($sql);
        $data = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return ['data' => $data];
    }

    // Ambil data berdasarkan id
    public function getById($id) {
        $sql = "SELECT * FROM ras_hewan WHERE idras_hewan = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Tambah ras baru
    public function create($nama_ras, $idjenis_hewan) {
        $sql = "INSERT INTO ras_hewan (nama_ras, idjenis_hewan) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("si", $nama_ras, $idjenis_hewan);
        return $stmt->execute();
    }

    // Update ras
    public function update($id, $nama_ras, $idjenis_hewan) {
        $sql = "UPDATE ras_hewan SET nama_ras = ?, idjenis_hewan = ? WHERE idras_hewan = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sii", $nama_ras, $idjenis_hewan, $id);
        return $stmt->execute();
    }

    // Hapus ras
    public function delete($id) {
        $sql = "DELETE FROM ras_hewan WHERE idras_hewan = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>