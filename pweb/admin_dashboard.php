<?php
session_start();
include_once("config/koneksi.php");

// Cek apakah admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$result = $conn->query("SELECT * FROM tb_armada JOIN tb_jadwal ON tb_armada.id = tb_jadwal.bus_id");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
</head>
<body class="bg-gray-100">
<nav class="bg-green-700 p-4">
        <ul class="flex justify-between text-white">
        <body class="bg-gray-100">
    <?php include_once("includes/navbar.php"); ?>
        </ul>
    </nav>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Dashboard Admin</h1>
        <table class="w-full border bg-white shadow rounded">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="p-2">Kode Bus</th>
                    <th class="p-2">Rute</th>
                    <th class="p-2">Berangkat</th>
                    <th class="p-2">Tiba</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr class="text-center border-t">
                    <td class="p-2"><?= $row['kode_bus']; ?></td>
                    <td class="p-2"><?= $row['rute']; ?></td>
                    <td class="p-2"><?= $row['bus_start']; ?></td>
                    <td class="p-2"><?= $row['bus_end']; ?></td>
                    <td class="p-2">
                        <a href="edit_layanan.php?id=<?= $row['id']; ?>" class="text-blue-600 hover:underline">Edit</a> |
                        <a href="delete_layanan.php?id=<?= $row['id']; ?>" class="text-red-600 hover:underline">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
<?php include_once("includes/footer.html")?>
</html>