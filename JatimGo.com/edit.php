<?php
include_once("koneksi.php");
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM tb_armada JOIN tb_jadwal ON tb_armada.id = tb_jadwal.bus_id WHERE tb_armada.id=$id");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode = $_POST['kode_bus'];
    $rute = $_POST['rute'];
    $start_time = $_POST['bus_start'];
    $end_time = $_POST['bus_end'];

    $conn->query("UPDATE tb_armada SET kode_bus='$kode', rute='$rute' WHERE id=$id");
    $conn->query("UPDATE tb_jadwal SET bus_start='$start_time', bus_end='$end_time' WHERE bus_id=$id");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function confirmEdit(event) {
            event.preventDefault();
            if (confirm("Apakah Anda yakin ingin menyimpan perubahan?")) {
                document.getElementById("editForm").submit();
            }
        }
    </script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Edit Rute dan Jadwal Bus</h2>
        <form id="editForm" action="" method="POST">
            <input type="text" name="kode_bus" value="<?= $row['kode_bus']; ?>" class="w-full p-2 border rounded mb-3"  readonly>
            <input type="text" name="rute" value="<?= $row['rute']; ?>" class="w-full p-2 border rounded mb-3" required>
            <input type="time" name="bus_start" value="<?= $row['bus_start']; ?>" class="w-full p-2 border rounded mb-3" required>
            <input type="time" name="bus_end" value="<?= $row['bus_end']; ?>" class="w-full p-2 border rounded mb-3" required>
            <button type="submit" onclick="confirmEdit(event)" class="bg-blue-500 text-white px-4 py-2 rounded">Perbarui</button>
            <a href="index.php" class="bg-blue-500 text-white px-4 py-2 rounded">Kembali</a>
        </form>
    </div>
</body>
</html>