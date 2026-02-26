<?php 
require 'connection.php'; 
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
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
            <i class="bi bi-house-door me-2"></i>Inventory Dashboard
        </h2>
            
    <div class="d-flex align-items-center bg-white px-4 py-2 rounded-pill shadow-sm border">                <span class="text-secondary fw-bold me-3">
            Halo, <?= htmlspecialchars($_SESSION['username']) ?>!   
        </span>
            <i class="bi bi-person-circle text-primary fs-3"></i>
    </div>
</div>
        
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
        if(r.isConfirmed) {
            // Membuat form POST virtual untuk menghapus secara aman (terhindar dari CSRF URL link)
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = 'delete.php';
            
            let inputId = document.createElement('input');
            inputId.type = 'hidden';
            inputId.name = 'id';
            inputId.value = id;
            
            form.appendChild(inputId);
            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>
</body>
</html>