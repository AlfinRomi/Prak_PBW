<?php
require_once 'koneksi.php';

$sqlCreateDB = "CREATE DATABASE IF NOT EXISTS akademik2";

if (mysqli_query($koneksi, $sqlCreateDB)) {
    echo "Database berhasil dibuat atau sudah ada";
} else {
    echo "ERROR membuat database: " . mysqli_error($koneksi) ;
}

mysqli_set_charset($koneksi,"utf8mb4");

mysqli_select_db($koneksi, 'akademik');

$sqlCreateTable = [
"CREATE TABLE IF NOT EXISTS mahasiswa (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(15) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    prodi VARCHAR(80)NOT NULL,
    angkatan YEAR NOT NULL,
    ipk DECIMAL (3,2) DEFAULT0.00
) ENGINE=InnoDB",

"CREATE TABLE IF NOT EXISTS dosen (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nidn VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
) ENGINE=InnoDB",

"CREATE TABLE IF NOT EXISTS mata_kuliah (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    kode_mk VARCHAR(12) NOT NULL UNIQUE,
    nama_mk VARCHAR(100) NOT NULL,
    sks TINYINT UNSIGNED NOT NULL,
    dosen_id BIGINT UNSIGNED,
    CONSTRAINT fk_mk_dosen
    FOREIGN KEY (dosen_id) REFERENCES dosen(id) ON UPDATE CASCADE ON DELETE
) ENGINE=InnoDB"
];

foreach ($sqlCreateTable as $namaTabel => $query) {
    if (mysqli_query($koneksi, $query)) {
        echo "Tabel berhasil dibuat atau sudah ada";
    } else {
        echo "Gagal membuat tabel: " . mysqli_error($koneksi);
    }
}

mysqli_close($koneksi);
?>