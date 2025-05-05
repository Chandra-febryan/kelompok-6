<?php
// --- (Letakkan Blok Periksa Admin & Koneksi DB dari atas di sini) ---
session_start();

// ---- AWAL BLOK PERIKSA ADMIN ----
if (!isset($_SESSION['username']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // Jika bukan admin, redirect ke halaman login atau halaman utama
    header('Location: index.php'); // Ganti ke halaman login jika ada
    exit;
}
// ---- AKHIR BLOK PERIKSA ADMIN ----

// Koneksi DB (setelah cek admin)
$conn = new mysqli("localhost", "root", "", "db_pweb");
if ($conn->connect_error) { die("Koneksi gagal: " . $conn->connect_error); }

$sql = "SELECT id, judul, tgl_buat, foto FROM tb_artikel ORDER BY tgl_buat DESC";
$result = $conn->query($sql);
$artikel_list = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $artikel_list[] = $row;
    }
}

// Pesan status dari GET request (setelah simpan/hapus)
$message = '';
$message_type = ''; // 'success' atau 'error'
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'saved') {
        $message = 'Artikel berhasil disimpan.';
        $message_type = 'success';
    } elseif ($_GET['status'] == 'deleted') {
        $message = 'Artikel berhasil dihapus.';
        $message_type = 'success';
    } elseif ($_GET['status'] == 'error') {
        $error_msg = isset($_GET['msg']) ? htmlspecialchars($_GET['msg']) : 'Terjadi kesalahan.';
        $message = 'Gagal: ' . $error_msg;
        $message_type = 'error';
    }
     elseif ($_GET['status'] == 'notfound') {
        $message = 'Artikel tidak ditemukan.';
        $message_type = 'error';
    }
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Kelola Artikel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .thumb-admin { width: 80px; height: 50px; object-fit: cover; }
        .thumb-no-img { width: 80px; height: 50px; background-color: #e5e7eb; display: flex; justify-content: center; align-items: center; font-size: 0.7rem; color: #6b7280; }
    </style>
</head>
<body class="bg-gray-100">
<nav class="bg-green-700 p-4">
        <ul class="flex justify-between text-white">
        <body class="bg-gray-100">
    <?php include_once("includes/navbar.php"); ?>
        </ul>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Kelola Artikel</h1>
            <a href="edit_artikel.php" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                <i class="fas fa-plus mr-2"></i> Tambah Artikel Baru
            </a>
        </div>

        <!-- Tampilkan Pesan Status -->
        <?php if ($message): ?>
            <div class="mb-4 p-4 rounded <?php echo ($message_type === 'success') ? 'bg-green-100 border border-green-400 text-green-700' : 'bg-red-100 border border-red-400 text-red-700'; ?>" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-4 text-left">Foto</th>
                        <th class="py-3 px-4 text-left">Judul</th>
                        <th class="py-3 px-4 text-left">Tanggal Buat</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    <?php if (!empty($artikel_list)): ?>
                        <?php foreach ($artikel_list as $artikel): ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-4">
                                    <?php if (!empty($artikel['foto'])): ?>
                                        <img src="<?php echo UPLOAD_URL_ARTIKEL . htmlspecialchars($artikel['foto']); ?>" alt="Thumb" class="thumb-admin rounded">
                                    <?php else: ?>
                                        <div class="thumb-no-img rounded"><span>No Img</span></div>
                                    <?php endif; ?>
                                </td>
                                <td class="py-3 px-4">
                                    <?php echo htmlspecialchars($artikel['judul']); ?>
                                </td>
                                <td class="py-3 px-4">
                                    <?php echo date('d M Y', strtotime($artikel['tgl_buat'])); ?>
                                </td>
                                <td class="py-3 px-4 text-center whitespace-nowrap">
                                    <a href="#?id=<?php echo $artikel['id']; ?>" target="_blank" title="Lihat Artikel" class="text-blue-600 hover:text-blue-800 mr-3">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="edit_artikel.php?id=<?php echo $artikel['id']; ?>" title="Edit Artikel" class="text-yellow-600 hover:text-yellow-800 mr-3">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="hapus_artikel.php?id=<?php echo $artikel['id']; ?>" title="Hapus Artikel" class="text-red-600 hover:text-red-800" onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini? Ini tidak dapat dibatalkan.');">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">Belum ada artikel.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include_once("includes/footer.html"); ?>
</body>
</html>
<?php $conn->close(); ?>