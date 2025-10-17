<?php
session_start();
require_once __DIR__ . "/koneksiDB.php"; 
require_once __DIR__ . "/role.php";      

$db = new DBConnection();
$role = new Role($db);

$id = $_GET['id'] ?? null;
if ($id) {
    $role->delete($id);
}

header("Location: manajemenrole.php");
exit;