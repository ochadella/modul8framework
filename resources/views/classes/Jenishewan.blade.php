<?php
class JenisHewan {
    private $db;

    public function __construct($db) {
        $this->db = $db->getConnection();
    }

    // Ambil semua data jenis hewan
    public function getAll() {
        $sql = "SELECT idjenis_hewan, nama_jenis_hewan FROM jenis_hewan ORDER BY idjenis_hewan ASC";
        $result = $this->db->query($sql);
        $data = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return ['data' => $data];
    }

    // Ambil satu jenis hewan by id
    public function getById($id) {
        $sql = "SELECT * FROM jenis_hewan WHERE idjenis_hewan = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Tambah jenis hewan
    public function create($nama) {
        $sql = "INSERT INTO jenis_hewan (nama_jenis_hewan) VALUES (?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $nama);
        return $stmt->execute();
    }

    // Update jenis hewan
    public function update($id, $nama) {
        $sql = "UPDATE jenis_hewan SET nama_jenis_hewan = ? WHERE idjenis_hewan = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("si", $nama, $id);
        return $stmt->execute();
    }

    // Hapus jenis hewan
    public function delete($id) {
        $sql = "DELETE FROM jenis_hewan WHERE idjenis_hewan = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>