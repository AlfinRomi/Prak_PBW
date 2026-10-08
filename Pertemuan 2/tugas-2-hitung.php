<?php

interface BisaDihitung
{
    public function hargaAkhir(): float;
}

class Produk implements BisaDihitung
{
    public function __construct(
        protected string $nama,
        protected float $harga
    ) {}

    public function hargaAkhir(): float
    {
        return $this->harga;
    }

    public function getNama(): string
    {
        return $this->nama;
    }
}

class ProdukDiskon extends Produk
{
    public function __construct(string $nama, float $harga, private float $diskon)
    {
        if ($diskon < 0 || $diskon > 100) {
            throw new InvalidArgumentException('Diskon harus 0 sampai 100.');
        }
        parent::__construct($nama, $harga);
    }

    public function hargaAkhir(): float
    {
        return $this->harga * (1 - $this->diskon / 100);
    }
}

function totalBayar(BisaDihitung $produk, int $qty, float $ppn = 11): float
{
    if ($qty < 1) {
        throw new InvalidArgumentException('Jumlah beli minimal 1.');
    }
    return $produk->hargaAkhir() * $qty * (1 + $ppn / 100);
}

// Daftar belanja: [produk, jumlah]
$daftar = [
    [new Produk('Keyboard', 250000), 2],
    [new ProdukDiskon('Mouse', 150000, 10), 3],
];

echo "<h3>Daftar Belanja (sudah termasuk PPN 11%)</h3>";
foreach ($daftar as [$produk, $qty]) {
    echo $produk->getNama() . ' x' . $qty
        . ' = Rp ' . number_format(totalBayar($produk, $qty), 0, ',', '.')
        . "<br>\n";
}

// Contoh validasi: diskon tidak valid -> exception ditangkap
try {
    $salah = new ProdukDiskon('Headset', 300000, 150);
} catch (InvalidArgumentException $e) {
    echo "<br>Error: " . $e->getMessage() . "<br>\n";
}