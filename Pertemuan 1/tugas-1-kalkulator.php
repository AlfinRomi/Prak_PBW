<?php

$hasil = null;
$pesan = '';
$daftarOperator = ['+', '-', '*', '/', '%', '^'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = (float) ($_POST['a'] ?? 0);
    $b = (float) ($_POST['b'] ?? 0);
    $operator = $_POST['operator'] ?? '+';

    switch ($operator) {
        case '+':
            $hasil = $a + $b;
            break;
        case '-':
            $hasil = $a - $b;
            break;
        case '*':
            $hasil = $a * $b;
            break;
        case '/':
            if ($b == 0) {
                $pesan = 'Pembagian dengan nol tidak diperbolehkan.';
            } else {
                $hasil = $a / $b;
            }
            break;
        case '%':
            if ($b == 0) {
                $pesan = 'Modulo dengan nol tidak diperbolehkan.';
            } else {
                $hasil = fmod($a, $b);
            }
            break;
        case '^':
            $hasil = $a ** $b;
            break;
        default:
            $pesan = 'Operator tidak valid.';
    }
}
?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Kalkulator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 520px;
            margin: 40px auto;
            padding: 0 16px;
        }

        input,
        select,
        button {
            padding: 8px;
            font-size: 16px;
        }

        input[type=number] {
            width: 110px;
        }

        button {
            background: #2563eb;
            color: #fff;
            border: 0;
            border-radius: 4px;
            cursor: pointer;
        }

        .hasil {
            margin-top: 16px;
            padding: 10px 14px;
            background: #e8f5e9;
            border-left: 4px solid #2e7d32;
        }

        .error {
            margin-top: 16px;
            padding: 10px 14px;
            background: #fdecea;
            border-left: 4px solid #c62828;
        }
    </style>
</head>

<body>
    <h1>Kalkulator Sederhana</h1>
    <form method="post">
        <input type="number" step="any" name="a" required
            value="<?= htmlspecialchars((string) ($_POST['a'] ?? '')) ?>">

        <select name="operator">
            <?php foreach ($daftarOperator as $op): ?>
                <option value="<?= htmlspecialchars($op) ?>"
                    <?= (($_POST['operator'] ?? '+') === $op) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($op) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="number" step="any" name="b" required
            value="<?= htmlspecialchars((string) ($_POST['b'] ?? '')) ?>">

        <button type="submit">Hitung</button>
    </form>

    <?php if ($pesan): ?>
        <p class="error"><?= htmlspecialchars($pesan) ?></p>
    <?php elseif ($hasil !== null): ?>
        <p class="hasil">Hasil: <?= htmlspecialchars((string) $hasil) ?></p>
    <?php endif; ?>
</body>

</html>