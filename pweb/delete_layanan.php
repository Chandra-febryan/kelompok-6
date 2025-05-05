<?php
session_start();
include_once("config/koneksi.php");

// Periksa apakah sudah login sebagai admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");  // Redirect jika bukan admin
    exit();
}

$id = $_GET['id'];  // Ambil id bus yang akan dihapus

if (isset($_POST['confirm'])) {
    // Proses penghapusan data
    $deleteJadwal = $conn->query("DELETE FROM tb_jadwal WHERE bus_id = $id");
    $deleteArmada = $conn->query("DELETE FROM tb_armada WHERE id = $id");

    if ($deleteJadwal && $deleteArmada) {
        // Redirect ke halaman admin_dashboard jika berhasil
        header("Location: admin_dashboard.php");
        exit();
    } else {
        // Jika gagal, tampilkan error
        echo "<p>Gagal menghapus data. Coba lagi!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hapus Layanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <!-- Navbar -->
    <nav class="bg-green-700 p-4 rounded-md">
        <ul class="flex justify-between text-white">
        <?php include_once('includes/navbar.php');?>
            <?php if (!isset($_SESSION['username'])): ?>
                
            <?php endif; ?>
        </ul>
    </nav>

    <div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Konfirmasi Hapus</h2>
        <p>Apakah Anda yakin ingin menghapus rute ini?</p>

        <!-- Form konfirmasi hapus -->
        <form action="" method="POST">
            <button type="submit" name="confirm" class="bg-red-500 text-white px-4 py-2 rounded">Hapus</button>
            <a href="admin_dashboard.php" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Batal</a>
        </form>
    </div>
</body>
</html>

