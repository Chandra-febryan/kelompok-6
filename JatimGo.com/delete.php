<?php
include_once("koneksi.php");
$id = $_GET['id'];

if (isset($_POST['confirm'])) {
    $conn->query("DELETE FROM tb_jadwal WHERE bus_id=$id");
    $conn->query("DELETE FROM tb_armada WHERE id=$id");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function confirmDelete() {
            document.getElementById("popup").classList.remove("hidden");
        }

        function closePopup() {
            document.getElementById("popup").classList.add("hidden");
        }
    </script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Konfirmasi Hapus</h2>
        <p>Apakah Anda yakin ingin menghapus rute ini?</p>
        <div class="mt-4">
            <button onclick="confirmDelete()" class="bg-red-500 text-white px-4 py-2 rounded">Hapus</button>
            <a href="index.php" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Batal</a>
        </div>
    </div>

    <!-- Pop-up Konfirmasi -->
    <div id="popup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-lg font-bold mb-2">Konfirmasi Penghapusan</h2>
            <p>Data yang dihapus tidak dapat dikembalikan.</p>
            <form action="" method="POST" class="mt-4">
                <button type="submit" name="confirm" class="bg-red-500 text-white px-4 py-2 rounded">Hapus</button>
                <button type="button" onclick="closePopup()" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Batal</button>
            </form>
        </div>
    </div>
</body>
</html>