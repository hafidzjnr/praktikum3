<?php 
require 'connection.php'; 
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM barang WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

// Mencegah error jika ID dimasukkan sembarangan di URL
if (!$data) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validasi di sisi server (PHP)
    if (!empty($_POST['kode']) && !empty($_POST['nama']) && isset($_POST['stok'])) {
        $pdo->prepare("UPDATE barang SET kode_barang=?, nama_barang=?, stok=? WHERE id=?")
            ->execute([$_POST['kode'], $_POST['nama'], $_POST['stok'], $id]);
        header("Location: index.php");
        exit;
    }
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
<nav id="sidebar" class="d-flex flex-column">
        <div class="sidebar-header"><h5><i class="bi bi-cpu-fill me-2"></i>GUDANG KU</h5></div>
        
        <ul class="mb-auto">
            <li class="active"><a href="index.php"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
            <li><a href="analytics.php"><i class="bi bi-graph-up me-2"></i> Analytics</a></li>
            <li><a href="tambah.php"><i class="bi bi-plus-circle me-2"></i> Tambah Barang</a></li>
        </ul>

        <ul class="mt-auto mb-4 px-3">
            <li>
                <a href="logout.php" class="d-flex align-items-center justify-content-center rounded bg-white bg-opacity-10 text-white text-decoration-none shadow-sm border border-white border-opacity-25" style="padding: 0.75rem 1rem; transition: 0.3s;" onmouseover="this.style.backgroundColor='rgba(255,255,255,0.2)'" onmouseout="this.style.backgroundColor='rgba(255,255,255,0.1)'">
                    <i class="bi bi-box-arrow-left me-2 fs-5"></i> <span class="fw-bold tracking-wide">Logout</span>
                </a>
            </li>
        </ul>
    </nav>

    <div id="content">
        <div class="d-flex justify-content-between align-items-center w-100 mb-4 pb-3 border-bottom">
            <h2 class="mb-0 text-dark fw-bold">
                <i class="bi bi-pencil-square me-2"></i>Edit Data Barang
            </h2>
            <div class="d-flex align-items-center bg-white px-4 py-2 rounded-pill shadow-sm border">
                <span class="text-secondary fw-bold me-3">
                    Halo, <?= htmlspecialchars($_SESSION['username']) ?>!
                </span>
                <i class="bi bi-person-circle text-primary fs-3"></i>
            </div>
        </div>
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