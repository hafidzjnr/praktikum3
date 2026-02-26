<?php
require 'connection.php'; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $stok = $_POST['stok'];

    $sql = "INSERT INTO barang (kode_barang, nama_barang, stok) VALUES (?, ?, ?)"; 
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$kode, $nama, $stok])) { 
        header("Location: index.php");
        exit; 
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0 rounded-4">
                <div class="card-header bg-primary text-white p-4 text-center rounded-top-4">
                    <h4 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Tambah Barang Baru</h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action=""> 
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Kode Barang</label>
                            <input type="text" name="kode" class="form-control form-control-lg bg-light" placeholder="Contoh: BRG-001" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Nama Barang</label>
                            <input type="text" name="nama" class="form-control form-control-lg bg-light" placeholder="Masukkan nama barang..." required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-secondary">Stok Awal</label>
                            <input type="number" name="stok" class="form-control form-control-lg bg-light" placeholder="0" min="0" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-save me-2"></i>Simpan Data</button> 
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