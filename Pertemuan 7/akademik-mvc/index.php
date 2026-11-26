<?php
include "koneksi.php";
include "controllers/MahasiswaController.php";

$controller = new MahasiswaController($koneksi);
$controller->index();
?>