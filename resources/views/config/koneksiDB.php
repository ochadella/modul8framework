<?php
class DBConnection {
    private string $servername = "127.0.0.1";      // atau "localhost"
    private string $username   = "root";           // user MySQL kamu
    private string $password   = "Konikulaposero25"; // password MySQL kamu
    private string $dbname     = "kuliah_wf_2025"; // nama database
    private mysqli $dbconn;

    public function __construct() {
        $this->init_connect();
    }

    private function init_connect(): void {
        $this->dbconn = new mysqli(
            $this->servername,
            $this->username,
            $this->password,
            $this->dbname
        );

        if ($this->dbconn->connect_error) {
            die("Koneksi gagal: " . $this->dbconn->connect_error);
        }

        // Tambahan kecil: set charset UTF-8 biar aman untuk teks
        $this->dbconn->set_charset("utf8mb4");
    }

    // ✅ tetap bisa pakai send_query() seperti biasa
    public function send_query(string $query): array {
        $result = $this->dbconn->query($query);

        if ($this->dbconn->error) {
            return [
                "status"  => "error",
                "message" => $this->dbconn->error,
                "data"    => []
            ];
        } elseif ($result === true) {
            return [
                "status"  => "success",
                "message" => "Query berhasil dijalankan",
                "data"    => []
            ];
        } else {
            return [
                "status"  => "success",
                "message" => "Query berhasil dijalankan",
                "data"    => $result->fetch_all(MYSQLI_ASSOC)
            ];
        }
    }

    // ✅ ini penting buat file lain biar gampang akses koneksi mentahnya
    public function getConnection(): mysqli {
        return $this->dbconn;
    }

    public function close_connection(): void {
        if ($this->dbconn) {
            $this->dbconn->close();
        }
    }
}
?>
