<?php 
require 'connection.php'; 
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM barang WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pdo->prepare("UPDATE barang SET kode_barang=?, nama_barang=?, stok=? WHERE id=?")
        ->execute([$_POST['kode'], $_POST['nama'], $_POST['stok'], $id]);
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
    <title>Edit Barang | Hafidz</title>
</head>
<body>
<div id="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header"><h5><i class="bi bi-cpu-fill me-2"></i>GUDANG IT</h5></div>
        <ul>
            <li><a href="index.php"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
            <li><a href="analytics.php"><i class="bi bi-graph-up me-2"></i> Analytics</a></li>
            <li><a href="tambah.php"><i class="bi bi-plus-circle me-2"></i> Tambah Barang</a></li>
        </ul>
    </nav>

    <div id="content">
        <h2 class="mb-4"><i class="bi bi-pencil-square me-2"></i>Edit Data Barang</h2>
        <div class="card p-4 shadow-sm col-md-8">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-key me-1"></i> Kode Barang</label>
                    <input type="text" name="kode" class="form-control" value="<?= htmlspecialchars($data['kode_barang']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-info-square me-1"></i> Nama Barang</label>
                    <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama_barang']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-123 me-1"></i> Stok</label>
                    <input type="number" name="stok" class="form-control" value="<?= htmlspecialchars($data['stok']) ?>" required>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <a href="index.php" class="btn btn-light"><i class="bi bi-arrow-left"></i> Batal</a>
                    <button type="submit" class="btn btn-success px-4 text-white"><i class="bi bi-check-circle me-2"></i>Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>