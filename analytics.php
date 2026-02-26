<?php 
require 'connection.php'; 
$data = $pdo->query("SELECT nama_barang, stok FROM barang")->fetchAll(PDO::FETCH_ASSOC);
$lbl = array_column($data, 'nama_barang');
$stk = array_column($data, 'stok'); 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Analytics | Hafidz</title>
</head>
<body>
<div id="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header"><h5><i class="bi bi-cpu-fill me-2"></i>GUDANG IT</h5></div>
        <ul>
            <li><a href="index.php"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
            <li class="active"><a href="analytics.php"><i class="bi bi-graph-up me-2"></i> Analytics</a></li>
            <li><a href="tambah.php"><i class="bi bi-plus-circle me-2"></i> Tambah Barang</a></li>
        </ul>
    </nav>

    <div id="content">
        <h2 class="mb-4"><i class="bi bi-pie-chart-fill me-2"></i>Visual Analytics</h2>
        <div class="card p-4 shadow-sm">
            <h6 class="text-secondary fw-bold mb-4"><i class="bi bi-bar-chart-line me-2"></i>Grafik Stok Barang Terkini</h6>
            <div class="chart-container">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
</div>
<script>
new Chart(document.getElementById('myChart'), {
    type: 'bar',
    data: { 
        labels: <?= json_encode($lbl) ?>, 
        datasets: [{ 
            label: 'Level Stok', 
            data: <?= json_encode($stk) ?>, 
            backgroundColor: 'rgba(78, 115, 223, 0.8)',
            borderColor: '#4e73df',
            borderWidth: 1,
            borderRadius: 4
        }] 
    },
    options: { maintainAspectRatio: false }
});
</script>
</body>
</html>