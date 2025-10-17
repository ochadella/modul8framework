<?php
session_start();
Require_once __DIR__ "/../../config/KoneksiDB.php";
require_once __DIR__ "/../../classes/User.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userObj = new User();
$currentUser = $userObj->getById($_SESSION['user_id']);
?>
<nav style="background:#0f172a; padding:10px; display:flex; justify-content:space-between; align-items:center;">
    <div>
        <a href="datamaster.php" style="color:#3b82f6; font-weight:600; margin-right:15px; text-decoration:none;">📊 Data Master</a>
        <a href="role.php" style="color:#3b82f6; font-weight:600; margin-right:15px; text-decoration:none;">⚙️ Role</a>
    </div>
    <div style="color:#e2e8f0;">
        👋 Halo, <b><?= htmlspecialchars($currentUser['nama']) ?></b> |
        <a href="logout.php" style="color:#ec4899; font-weight:600; text-decoration:none;">Logout</a>
    </div>
</nav>
