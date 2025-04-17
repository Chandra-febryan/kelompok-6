<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "db_jatimgo";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT tb_armada.id, tb_armada.kode_bus, tb_armada.rute, tb_jadwal.bus_start, tb_jadwal.bus_end
        FROM tb_armada 
        JOIN tb_jadwal ON tb_armada.id = tb_jadwal.bus_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>layanan Operasional</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Daftar Rute dan Jadwal Bus</h2>

        <a href="addlayanan.php" class="mb-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Tambah Rute</a>

        <div class="space-y-4">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="p-4 border rounded-lg flex justify-between items-center">
                    <div>
                        <span class="font-bold text-lg"><?= $row['kode_bus']; ?></span>
                        <p class="text-gray-600"><?= $row['rute']; ?></p>
                        <p class="text-sm text-green-600">Waktu Operasional: <?= $row['bus_start']; ?> - <?= $row['bus_end']; ?></p>
                    </div>
                    <div>
                        <a href="edit.php?id=<?= $row['id']; ?>" class=" inline-block bg-green-400 text-white px-4 py-1 mr-2 rounded">Ubah</a>
                        <a href="delete.php?id=<?= $row['id']; ?>" class=" inline-block bg-red-500 text-white px-4 py-1 rounded" >Hapus</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</body>
</html>

>