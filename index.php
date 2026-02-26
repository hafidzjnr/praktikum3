<?php
require 'connection.php'; 
$stmt = $pdo->query("SELECT * FROM barang ORDER BY id DESC"); 
$barang = $stmt->fetchAll(PDO::FETCH_ASSOC); 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Inventaris Gudang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow border-0 rounded-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="text-primary fw-bold mb-0"><i class="bi bi-box-seam me-2"></i>Daftar Barang Gudang</h2>
                </div>
                <a href="tambah.php" class="btn btn-primary px-4 shadow-sm"><i class="bi bi-plus-lg me-1"></i> Tambah Barang</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%" class="text-center py-3">No</th>
                            <th width="20%" class="py-3">Kode Barang</th>
                            <th width="40%" class="py-3">Nama Barang</th>
                            <th width="15%" class="text-center py-3">Stok</th>
                            <th width="20%" class="text-center py-3">Aksi</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($barang) > 0): ?>
                            <?php $no = 1; foreach($barang as $row): ?> 
                            <tr>
                                <td class="text-center text-muted"><?= $no++; ?></td> 
                                <td><span class="badge bg-secondary px-2 py-1"><?= htmlspecialchars($row['kode_barang']); ?></span></td>
                                <td class="fw-semibold text-dark"><?= htmlspecialchars($row['nama_barang']); ?></td>
                                <td class="text-center">
                                    <span class="badge <?= $row['stok'] < 10 ? 'bg-danger' : 'bg-success'; ?> px-3 py-2 fs-6">
                                        <?= htmlspecialchars($row['stok']); ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-warning fw-bold"><i class="bi bi-pencil-square"></i> Edit</a> 
                                    <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-danger fw-bold" onclick="return confirm('Yakin hapus <?= htmlspecialchars($row['nama_barang']); ?>?')"><i class="bi bi-trash"></i> Hapus</a> 
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="5" class="text-center py-5 text-muted"><h5>Gudang masih kosong</h5></td></tr>
                        <?php endif; ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>