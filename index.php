<?php 
require 'connection.php'; 
$barang = $pdo->query("SELECT * FROM barang ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC); 
$total = count($barang);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Dashboard | Hafidz</title>
</head>
<body>
<div id="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header"><h5><i class="bi bi-cpu-fill me-2"></i>GUDANG IT</h5></div>
        <ul>
            <li class="active"><a href="index.php"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
            <li><a href="analytics.php"><i class="bi bi-graph-up me-2"></i> Analytics</a></li>
            <li><a href="tambah.php"><i class="bi bi-plus-circle me-2"></i> Tambah Barang</a></li>
        </ul>
    </nav>

    <div id="content">
        <h2 class="mb-4"><i class="bi bi-house-door me-2"></i>Inventory Dashboard</h2>
        
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card p-3 border-start border-primary border-4 shadow-sm">
                    <div class="text-muted small fw-bold">TOTAL JENIS BARANG</div>
                    <h3 class="mb-0 text-primary"><?= $total ?> Item <i class="bi bi-box-seam float-end opacity-50"></i></h3>
                </div>
            </div>
        </div>

        <div class="card p-4 shadow-sm">
            <h5 class="mb-3 text-secondary fw-bold"><i class="bi bi-table me-2"></i>Daftar Inventaris Terkini</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th><i class="bi bi-hash"></i> Kode</th>
                            <th><i class="bi bi-tag"></i> Nama Barang</th>
                            <th><i class="bi bi-stack"></i> Stok</th>
                            <th class="text-center"><i class="bi bi-gear"></i> Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($barang as $b): ?>
                        <tr>
                            <td><span class="badge bg-secondary"><?= htmlspecialchars($b['kode_barang']) ?></span></td>
                            <td class="fw-bold"><?= htmlspecialchars($b['nama_barang']) ?></td>
                            <td><span class="badge <?= $b['stok'] < 10 ? 'bg-danger':'bg-success' ?> rounded-pill px-3"><?= $b['stok'] ?></span></td>
                            <td class="text-center">
                                <a href="edit.php?id=<?= $b['id'] ?>" class="btn btn-sm btn-outline-primary border-0"><i class="bi bi-pencil-square"></i></a>
                                <button onclick="del(<?= $b['id'] ?>)" class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function del(id) {
    Swal.fire({ 
        title: 'Hapus Barang?', 
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning', 
        showCancelButton: true, 
        confirmButtonColor: '#4e73df',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
    }).then(r => {
        if(r.isConfirmed) window.location.href = 'delete.php?id='+id;
    });
}
</script>
</body>
</html>