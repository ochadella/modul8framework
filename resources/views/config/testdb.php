<?php
require_once 'koneksiDB.php'; // koneksi ke DB

try {
    // Cek koneksi dengan query sederhana
    $stmt = $pdo->query("SELECT NOW() AS waktu");
    $row = $stmt->fetch();

    echo "<h2>Koneksi Database Berhasil ✅</h2>";
    echo "Waktu server DB saat ini: " . $row['waktu'];
} catch (PDOException $e) {
    echo "<h2>Koneksi Database Gagal ❌</h2>";
    echo "Error: " . $e->getMessage();
}