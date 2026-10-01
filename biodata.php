<?php
//biodata.php
function statuskelulusan(float $ipk): string
{
    if ($ipk >=3.50) return 'Sangat Memuaskan';
    if ($ipk >=3.00) return 'Memuaskan';
    return 'perlu peningkatan';
}

$mahasiswa = [
    'nim' => '2026001', 
    'nama' => 'Andio Pratama',
    'prodi' => 'Teknik Informatika',
    'semester' => 1,
    'ipk' => 3.720
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Biodata</title>
</head>
<body>
    <h1>Biodata Mahasiswa</h1>
    <ul>
        <?php foreach ($mahasiswa as $kunci => $nilai): ?>
        <li><?= ucfirst($kunci) ?>: <?= htmlspecialchars((string)$nilai) ?>
        </li>
        <?php endforeach; ?>
    </ul>
    <p>Predikat: <?= statuskelulusan($mahasiswa['ipk']) ?></p>
</body>
</html>