<?php
require 'connection.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Memastikan request yang masuk adalah POST (bukan dari URL langsung)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if ($id) {
        $stmt = $pdo->prepare("DELETE FROM barang WHERE id = ?");
        $stmt->execute([$id]);
    }
}

header("Location: index.php");
exit;
?>