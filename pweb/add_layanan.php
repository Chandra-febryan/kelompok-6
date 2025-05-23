<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}
include_once("config/koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode = $_POST['kode_bus'];
    $rute = $_POST['rute'];
    $start_time = $_POST['bus_start'];
    $end_time = $_POST['bus_end'];

    $sql = "INSERT INTO tb_armada (kode_bus, rute) VALUES ('$kode', '$rute')";
    if ($conn->query($sql) === TRUE) {
        $bus_id = $conn->insert_id;
        $sql2 = "INSERT INTO tb_jadwal (bus_id, bus_start, bus_end) VALUES ('$bus_id', '$start_time', '$end_time')";
        $conn->query($sql2);
        header("Location: admin_dashboard.php");
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<nav class="bg-green-700 p-4">
        <ul class="flex justify-between text-white">
        <body class="bg-gray-100">
    <?php include_once("includes/navbar.php"); ?>
        </ul>
    </nav>
    <div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
        <h2 class="text-xl font-bold mb-4">Tambah Jadwal Operasional</h2>
        <form action="" method="POST">
            <input type="text" name="kode_bus" placeholder="Kode Bus" class="w-full p-2 border rounded mb-3" required>
            <input type="text" name="rute" placeholder="Nama Rute" class="w-full p-2 border rounded mb-3" required>
            <input type="time" name="bus_start" class="w-full p-2 border rounded mb-3" required>
            <input type="time" name="bus_end" class="w-full p-2 border rounded mb-3" required>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>
</body>
<?php include_once('includes/footer.html');?>
</html>
