<?php
include "models/ProdukModel.php";

class ProdukController
{
    private $model;

    public function __construct($koneksi)
    {
        $this->model = new ProdukModel($koneksi);
    }

    public function index()
    {
        $produk = $this->model->getAllProduk();
        include "views/produk/index.php";
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->store();
            return;
        }
        include "views/produk/create.php";
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?action=create");
            exit;
        }

        $nama_produk = trim($_POST['nama_produk'] ?? '');
        $harga = (int) ($_POST['harga'] ?? 0);
        $stok = (int) ($_POST['stok'] ?? 0);

        if ($nama_produk === '' || $harga < 0 || $stok < 0) {
            $error = "Nama produk wajib diisi, serta harga dan stok tidak boleh negatif.";
            include "views/produk/create.php";
            return;
        }

        $this->model->createProduk($nama_produk, $harga, $stok);
        header("Location: index.php");
        exit;
    }

    public function edit()
    {
        $id = (int) ($_GET['id'] ?? $_POST['id'] ?? 0);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->update();
            return;
        }

        $produk = $this->model->getProdukById($id);
        if (!$produk) {
            header("Location: index.php");
            exit;
        }

        include "views/produk/edit.php";
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php");
            exit;
        }

        $id = (int) ($_POST['id'] ?? $_GET['id'] ?? 0);
        $nama_produk = trim($_POST['nama_produk'] ?? '');
        $harga = (int) ($_POST['harga'] ?? 0);
        $stok = (int) ($_POST['stok'] ?? 0);

        if ($id <= 0 || $nama_produk === '' || $harga < 0 || $stok < 0) {
            $error = "Data produk tidak valid.";
            $produk = [
                'id' => $id,
                'nama_produk' => $nama_produk,
                'harga' => $harga,
                'stok' => $stok
            ];
            include "views/produk/edit.php";
            return;
        }

        $this->model->updateProduk($id, $nama_produk, $harga, $stok);
        header("Location: index.php");
        exit;
    }

    public function delete()
    {
        $id = (int) ($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->model->deleteProduk($id);
        }
        header("Location: index.php");
        exit;
    }
}
