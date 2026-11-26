<?php
$host = '127.0.0.1';
$user = 'root';
$password = '';
$dbname = 'akademik';
$port = 3306;

$koneksi = mysqli_connect($host, $user, $password, $dbname, $port);

if(!$koneksi) {
    die("koneksi gagal:".mysqli_connect_error());
}
?>