<?php
class JadwalJaga {
    private $conn;
    private $table = "jadwal_jaga";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Ambil jadwal berdasarkan id_perawat
    public function getByPerawat($id_perawat) {
        $query = "SELECT * FROM {$this->table} WHERE id_perawat = :id_perawat ORDER BY tanggal ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_perawat", $id_perawat);
        $stmt->execute();
        return $stmt;
    }

    // Tambah jadwal baru
    public function create($data) {
        $query = "INSERT INTO {$this->table} (id_perawat, tanggal, shift, keterangan)
                  VALUES (:id_perawat, :tanggal, :shift, :keterangan)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    // Hapus jadwal (opsional)
    public function delete($id_jadwal) {
        $query = "DELETE FROM {$this->table} WHERE id_jadwal = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id_jadwal);
        return $stmt->execute();
    }
}
?>
