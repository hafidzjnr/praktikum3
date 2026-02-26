<?php 
require 'connection.php'; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pdo->prepare("INSERT INTO barang (kode_barang, nama_barang, stok) VALUES (?, ?, ?)")
        ->execute([$_POST['kode'], $_POST['nama'], $_POST['stok']]);
    header("Location: index.php");
    exit;
} 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <title>Tambah Barang | Hafidz</title>
</head>
<body>
<div id="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header"><h5><i class="bi bi-cpu-fill me-2"></i>GUDANG IT</h5></div>
        <ul>
            <li><a href="index.php"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
            <li><a href="analytics.php"><i class="bi bi-graph-up me-2"></i> Analytics</a></li>
            <li class="active"><a href="tambah.php"><i class="bi bi-plus-circle me-2"></i> Tambah Barang</a></li>
        </ul>
    </nav>

    <div id="content">
        <h2 class="mb-4"><i class="bi bi-plus-circle-dotted me-2"></i>Input Barang Baru</h2>
        <div class="card p-4 shadow-sm col-md-8">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-key me-1"></i> Kode Barang</label>
                    <input type="text" name="kode" class="form-control" placeholder="Contoh: BRG-001" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-info-square me-1"></i> Nama Barang</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama perangkat" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-123 me-1"></i> Stok Awal</label>
                    <input type="number" name="stok" class="form-control" placeholder="0" required>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <a href="index.php" class="btn btn-light"><i class="bi bi-arrow-left"></i> Batal</a>
                    <button type="submit" class="btn btn-primary px-4"><i class="bi bi-cloud-arrow-up me-2"></i>Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>