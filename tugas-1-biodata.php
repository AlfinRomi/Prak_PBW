<?php

function statusKelulusan(float $ipk): string
{
    if ($ipk >= 3.75) return 'Cum Laude';
    if ($ipk >= 3.50) return 'Sangat Memuaskan';
    if ($ipk >= 3.00) return 'Memuaskan';
    return 'Perlu Peningkatan';
}

$mahasiswa = [
    'nim'      => '2026001',
    'nama'     => 'Andi Pratama',
    'prodi'    => 'Teknik Informatika',
    'semester' => 1,
    'ipk'      => 3.72,
    'email'    => 'andi.pratama@kampus.ac.id',
];
?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Biodata</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 520px;
            margin: 40px auto;
            padding: 0 16px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        td {
            border: 1px solid #999;
            padding: 8px 12px;
        }

        td:first-child {
            background: #eef2ff;
            font-weight: bold;
            width: 35%;
        }

        .predikat {
            margin-top: 16px;
            padding: 10px 14px;
            background: #fff8e1;
            border-left: 4px solid #f9a825;
        }
    </style>
</head>

<body>
    <h1>Biodata Mahasiswa</h1>
    <table>
        <?php foreach ($mahasiswa as $kunci => $nilai): ?>
            <tr>
                <td><?= ucfirst($kunci) ?></td>
                <td><?= htmlspecialchars((string) $nilai) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p class="predikat">Predikat: <strong><?= statusKelulusan($mahasiswa['ipk']) ?></strong></p>
</body>

</html>