<?php
class Kategori {
    private $db;

    public function __construct($db) {
        $this->db = $db->getConnection();
    }

    // Ambil semua data kategori
    public function getAll() {
        $sql = "SELECT * FROM kategori ORDER BY idkategori ASC";
        $result = $this->db->query($sql);
        $data = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) $data[] = $row;
        }
        return ['data' => $data];
    }

    // Ambil kategori berdasarkan ID
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM kategori WHERE idkategori=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Tambah kategori baru (versi manual id, tanpa auto_increment)
    public function create($nama) {
        // Ambil id terakhir
        $result = $this->db->query("SELECT MAX(idkategori) AS max_id FROM kategori");
        $row = $result->fetch_assoc();
        $next_id = isset($row['max_id']) ? $row['max_id'] + 1 : 1;

        // Insert data baru
        $stmt = $this->db->prepare("INSERT INTO kategori (idkategori, nama_kategori) VALUES (?, ?)");
        $stmt->bind_param("is", $next_id, $nama);
        return $stmt->execute();
    }

    // Update kategori
    public function update($id, $nama) {
        $stmt = $this->db->prepare("UPDATE kategori SET nama_kategori=? WHERE idkategori=?");
        $stmt->bind_param("si", $nama, $id);
        return $stmt->execute();
    }

    // Hapus kategori
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM kategori WHERE idkategori=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
