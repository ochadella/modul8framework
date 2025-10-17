<?php
class KategoriKlinis {
    private $conn;
    private $table = "kategori_klinis";

    public $id_kategori_klinis;
    public $nama_kategori_klinis;
    public $deskripsi;

    public function __construct($db = null) {
        if ($db === null) {
            require_once(__DIR__ . '/../config/koneksiDB.php');
            // Ambil koneksi dari class DBConnection kamu tanpa ubah apapun
            $dbInstance = new DBConnection();
            $this->conn = $dbInstance->getConnection();
        } else {
            $this->conn = $db;
        }
    }

    // CREATE
    public function create() {
        if (!$this->conn) die("Koneksi database tidak tersedia (CREATE).");

        $query = "INSERT INTO {$this->table} (nama_kategori_klinis, deskripsi) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $this->nama_kategori_klinis, $this->deskripsi);
        return $stmt->execute();
    }

    // READ ALL
    public function readAll() {
        if (!$this->conn) die("Koneksi database tidak tersedia (READ ALL).");

        $query = "SELECT * FROM {$this->table} ORDER BY idkategori_klinis DESC";
        $result = $this->conn->query($query);

        if (!$result) die("Query gagal: " . $this->conn->error);
        return $result;
    }

    // READ BY ID
    public function readById($id) {
        if (!$this->conn) die("Koneksi database tidak tersedia (READ BY ID).");
        $query = "SELECT * FROM {$this->table} WHERE idkategori_klinis = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // UPDATE
    public function update() {
        if (!$this->conn) die("Koneksi database tidak tersedia (UPDATE).");
        $query = "UPDATE {$this->table} 
                  SET nama_kategori_klinis = ?, deskripsi = ? 
                  WHERE idkategori_klinis = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $this->nama_kategori_klinis, $this->deskripsi, $this->id_kategori_klinis);
        return $stmt->execute();
    }

    // DELETE
    public function delete() {
        if (!$this->conn) die("Koneksi database tidak tersedia (DELETE).");
        $query = "DELETE FROM {$this->table} WHERE idkategori_klinis = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id_kategori_klinis);
        return $stmt->execute();
    }
}
?>
