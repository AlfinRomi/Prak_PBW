<?php

interface Identitas
{
    public function ringkasan(): string;
}

class Mahasiswa implements Identitas
{
    private string $nim;
    private string $nama;
    protected float $ipk;

    public function __construct(string $nim, string $nama, float $ipk)
    {
        if (!ctype_digit($nim) || strlen($nim) !== 7) {
            throw new InvalidArgumentException('NIM harus 7 digit angka.');
        }
        $this->nim = $nim;
        $this->nama = $nama;
        $this->setIpk($ipk);
    }

    public function setIpk(float $ipk): void
    {
        if ($ipk < 0 || $ipk > 4) {
            throw new InvalidArgumentException('IPK harus 0 sampai 4.');
        }
        $this->ipk = $ipk;
    }

    public function getIpk(): float
    {
        return $this->ipk;
    }

    public function getPredikat(): string
    {
        return match (true) {
            $this->ipk >= 3.75 => 'Cum Laude',
            $this->ipk >= 3.00 => 'Memuaskan',
            default            => 'Perlu Peningkatan',
        };
    }

    public function ringkasan(): string
    {
        return $this->nim . ' - ' . $this->nama
            . ' - IPK: ' . number_format($this->ipk, 2)
            . ' (' . $this->getPredikat() . ')';
    }
}

// Data valid
try {
    $mhs = new Mahasiswa('2026001', 'Andi Pratama', 3.75);
    echo $mhs->ringkasan() . "<br>\n";
} catch (InvalidArgumentException $e) {
    echo 'Error: ' . $e->getMessage() . "<br>\n";
}

// IPK tidak valid -> exception ditangkap
try {
    $salah = new Mahasiswa('2026002', 'Budi', 4.5);
    echo $salah->ringkasan() . "<br>\n";
} catch (InvalidArgumentException $e) {
    echo 'Error: ' . $e->getMessage() . "<br>\n";
}

// NIM tidak valid -> exception ditangkap
try {
    $salah2 = new Mahasiswa('ABC', 'Citra', 3.20);
    echo $salah2->ringkasan() . "<br>\n";
} catch (InvalidArgumentException $e) {
    echo 'Error: ' . $e->getMessage() . "<br>\n";
}