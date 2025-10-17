<?php
class Tindakan {
    private $conn;
    private $table = "tindakan_terapi";

    public $id_tindakan;
    public $id_rekam;
    public $nama_tindakan;
    public $biaya;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO $this->table (id_rekam, nama_tindakan, biaya) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isd", $this->id_rekam, $this->nama_tindakan, $this->biaya);
        return $stmt->execute();
    }

    public function readByRekam($id_rekam) {
        $query = "SELECT * FROM $this->table WHERE id_rekam = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id_rekam);
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>
