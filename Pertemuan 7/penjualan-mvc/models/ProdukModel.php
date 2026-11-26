<?php

class ProdukModel
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    public function getAllProduk()
    {
        return mysqli_query($this->koneksi, "SELECT * FROM produk ORDER BY id ASC");
    }

    public function getProdukById($id)
    {
        $stmt = mysqli_prepare($this->koneksi, "SELECT * FROM produk WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $data;
    }

    public function createProduk($nama_produk, $harga, $stok)
    {
        $stmt = mysqli_prepare($this->koneksi, "INSERT INTO produk (nama_produk, harga, stok) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sii", $nama_produk, $harga, $stok);
        $success = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $success;
    }

    public function updateProduk($id, $nama_produk, $harga, $stok)
    {
        $stmt = mysqli_prepare($this->koneksi, "UPDATE produk SET nama_produk = ?, harga = ?, stok = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "siii", $nama_produk, $harga, $stok, $id);
        $success = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $success;
    }

    public function deleteProduk($id)
    {
        $stmt = mysqli_prepare($this->koneksi, "DELETE FROM produk WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        $success = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $success;
    }
}
