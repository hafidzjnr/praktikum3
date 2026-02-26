<?php
require 'connection.php'; 
$id = $_GET['id']; 
$stmt = $pdo->prepare("SELECT * FROM barang WHERE id = ?"); 
$stmt->execute([$id]); 
$data = $stmt->fetch(PDO::FETCH_ASSOC); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $stok = $_POST['stok'];

    $sql = "UPDATE barang SET kode_barang = ?, nama_barang = ?, stok = ? WHERE id = ?"; 
    $stmt = $pdo->prepare($sql); 
    if ($stmt->execute([$kode, $nama, $stok, $id])) { 
        header("Location: index.php"); 
        exit; 
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0 rounded-4">
                <div class="card-header bg-warning text-dark p-4 text-center rounded-top-4">
                    <h4 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i>Edit Data Barang</h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Kode Barang</label>
                            <input type="text" name="kode" class="form-control form-control-lg bg-light" value="<?= htmlspecialchars($data['kode_barang']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Nama Barang</label>
                            <input type="text" name="nama" class="form-control form-control-lg bg-light" value="<?= htmlspecialchars($data['nama_barang']); ?>" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-secondary">Stok</label>
                            <input type="number" name="stok" class="form-control form-control-lg bg-light" value="<?= htmlspecialchars($data['stok']); ?>" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning fw-bold btn-lg"><i class="bi bi-check2-circle me-2"></i>Update Data</button> 
                            <a href="index.php" class="btn btn-light text-secondary fw-semibold">Batal & Kembali</a> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>