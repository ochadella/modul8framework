<?php
require_once __DIR__ . '/../../../config/koneksiDB.php';
require_once __DIR__ . '/../../../classes/RekamMedis.php';

$db = new DBConnection();
$conn = $db->getConnection();
$rekam = new RekamMedis($conn);

$rekam->idreservasi_dokter = $_POST['idreservasi_dokter'];
$rekam->keluhan = $_POST['anamnesa'];
$rekam->diagnosa = $_POST['diagnosa'];
$rekam->tindakan = $_POST['temuan_klinis'];
$rekam->catatan = $_POST['dokter_pemeriksa'];

if ($rekam->create()) {
    header("Location: DataRekamMedis.php?success=1");
    exit;
} else {
    echo "Gagal menyimpan data rekam medis.";
}
?>
