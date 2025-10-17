<?php
class Pemilik {
    private $db;

    public function __construct($db) {
        $this->db = $db->getConnection();
    }

    // Ambil semua data pemilik
    public function getAll() {
        $sql = "SELECT idpemilik, nama, no_wa, alamat 
                FROM pemilik
                ORDER BY idpemilik ASC";
        $result = $this->db->query($sql);
        $data = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) $data[] = $row;
        }
        return ['data' => $data];
    }

    // Ambil satu pemilik
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM pemilik WHERE idpemilik=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // 🩷 Tambah data pemilik (pakai nama, no_wa, alamat)
    public function create($nama, $no_wa, $alamat) {
        $stmt = $this->db->prepare("INSERT INTO pemilik (nama, no_wa, alamat) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $no_wa, $alamat);
        return $stmt->execute();
    }

    // Update data pemilik
    public function update($id, $nama, $no_wa, $alamat) {
        $stmt = $this->db->prepare("UPDATE pemilik SET nama=?, no_wa=?, alamat=? WHERE idpemilik=?");
        $stmt->bind_param("sssi", $nama, $no_wa, $alamat, $id);
        return $stmt->execute();
    }

    // Hapus data pemilik
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM pemilik WHERE idpemilik=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
