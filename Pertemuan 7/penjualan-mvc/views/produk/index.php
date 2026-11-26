<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk - Penjualan MVC</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 32px;
            color: #1f2937;
        }
        .container {
            max-width: 820px;
            margin: 0 auto;
            background: #ffffff;
            padding: 24px 28px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        h2 {
            margin: 0;
            font-size: 22px;
        }
        .btn {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #2563eb;
            color: #ffffff;
        }
        .btn-warning {
            background-color: #f59e0b;
            color: #ffffff;
            padding: 5px 10px;
            font-size: 13px;
        }
        .btn-danger {
            background-color: #dc2626;
            color: #ffffff;
            padding: 5px 10px;
            font-size: 13px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #d1d5db;
            padding: 10px 12px;
            text-align: left;
        }
        th {
            background-color: #f3f4f6;
        }
        .text-center {
            text-align: center;
        }
        .empty {
            text-align: center;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Daftar Produk Penjualan</h2>
            <a href="index.php?action=create" class="btn btn-primary">+ Tambah Produk</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($produk && mysqli_num_rows($produk) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($produk)): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']); ?></td>
                            <td><?= htmlspecialchars($row['nama_produk']); ?></td>
                            <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                            <td><?= htmlspecialchars($row['stok']); ?></td>
                            <td class="text-center">
                                <a href="index.php?action=edit&id=<?= urlencode($row['id']); ?>" class="btn btn-warning">Edit</a>
                                <a href="index.php?action=delete&id=<?= urlencode($row['id']); ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="empty">Belum ada data produk.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
