<?php
$host = '127.0.0.1';
$user = 'root';
$password = '';
$port = 3306;

$koneksi = mysqli_connect($host, $user, $password, '', $port);

if(!$koneksi) {
    die("koneksi gagal: ".mysqli_connect_error());
}
echo "koneksi ke server MYSQL berhasil!";
?>