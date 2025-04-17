<?php
session_start();
include_once("config/koneksi.php");
if (isset($_SESSION['username'])) {
    $role = $_SESSION['role'];  // Ambil role dari session

    // Jika user adalah admin, tampilkan tampilan admin
    if ($role == 'admin') {
        // Ambil semua jadwal dan armada
        $query = "SELECT tb_armada.kode_bus, tb_armada.rute, tb_jadwal.bus_start, tb_jadwal.bus_end, tb_armada.id AS bus_id 
                  FROM tb_armada
                  JOIN tb_jadwal ON tb_armada.id = tb_jadwal.bus_id";
        $result = $conn->query($query);
    } else {
        // Jika user adalah user biasa, tampilkan hanya jadwal bus
        $query = "SELECT tb_armada.kode_bus, tb_armada.rute, tb_jadwal.bus_start, tb_jadwal.bus_end 
                  FROM tb_armada
                  JOIN tb_jadwal ON tb_armada.id = tb_jadwal.bus_id";
        $result = $conn->query($query);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Jadwal operasional</title>
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
        <h1 class="text-2xl font-bold mb-4">Jadwal Operasional</h1>
        <table class="w-full border bg-white shadow rounded">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="p-2">Kode Bus</th>
                    <th class="p-2">Rute</th>
                    <th class="p-2">Berangkat</th>
                    <th class="p-2">Tiba</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr class="text-center border-t">
                    <td class="p-2"><?= $row['kode_bus']; ?></td>
                    <td class="p-2"><?= $row['rute']; ?></td>
                    <td class="p-2"><?= $row['bus_start']; ?></td>
                    <td class="p-2"><?= $row['bus_end']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
<?php include_once("includes/footer.html")?>

</html>