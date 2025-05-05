<?php
session_start();
// Sesuaikan path jika koneksi ada di file terpisah
$conn = new mysqli("localhost", "root", "", "db_pweb");
if ($conn->connect_error) {
    // Sebaiknya log error, jangan tampilkan detail ke user
    die("Koneksi database gagal. Silakan coba lagi nanti.");
}
mysqli_set_charset($conn, "utf8mb4"); // Set charset

define('UPLOAD_URL_ARTIKEL', 'uploads/artikel/'); // URL path ke gambar

$sql = "SELECT id, judul, LEFT(konten, 150) AS ringkasan, tgl_buat, foto
        FROM tb_artikel
        ORDER BY tgl_buat DESC";
$result = $conn->query($sql);
$artikel_list = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $artikel_list[] = $row;
    }
}

$role = null; 
if (isset($_SESSION['username'])) {
    $role = $_SESSION['role'];  
}


?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Artikel - JatimGO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tambahkan CSS lain jika perlu -->
    <style>
        .artikel-item { border-bottom: 1px solid #e2e8f0; }
        .artikel-thumb { width: 150px; height: 100px; object-fit: cover; }
        .artikel-no-thumb { width: 150px; height: 100px; background-color: #f1f5f9; display: flex; align-items: center; justify-content: center; color: #94a3b8; }
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
        <h1 class="text-3xl font-bold text-primary mb-6">Artikel Terbaru</h1>

        <?php if (!empty($artikel_list)): ?>
            <div class="space-y-6">
                <?php foreach ($artikel_list as $artikel): ?>
                    <div class="artikel-item bg-white rounded-lg shadow p-4 flex gap-4">
                        <div class="flex-shrink-0">
                            <?php if (!empty($artikel['foto'])): ?>
                                <img src="<?php echo UPLOAD_URL_ARTIKEL . htmlspecialchars($artikel['foto']); ?>"
                                     alt="<?php echo htmlspecialchars($artikel['judul']); ?>" class="artikel-thumb rounded">
                            <?php else: ?>
                                <div class="artikel-no-thumb rounded"><span>No Image</span></div>
                            <?php endif; ?>
                        </div>
                        <div class="flex-grow">
                            <h2 class="text-xl font-semibold text-gray-800 mb-1 hover:text-secondary">
                                <a href="lihat_artikel.php?id=<?php echo $artikel['id']; ?>">
                                    <?php echo htmlspecialchars($artikel['judul']); ?>
                                </a>
                            </h2>
                            <p class="text-gray-600 text-sm mb-2">
                                <?php echo date('d M Y, H:i', strtotime($artikel['tgl_buat'])); // Sesuaikan format jika perlu ?>
                            </p>
                            <p class="text-gray-700 mb-3">
                                <?php echo htmlspecialchars($artikel['ringkasan']); ?>...
                            </p>
                            <a href="#?id=<?php echo $artikel['id']; ?>" class="text-secondary hover:underline font-medium">
                                Baca Selengkapnya »
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center text-gray-500">Belum ada artikel yang dipublikasikan.</p>
        <?php endif; ?>

        <?php if ($role === 'admin'): ?>
            <div class="mt-8 text-center">
                <a href="artikel_admin.php" class="bg-blue-500 hover:bg-blue-200 text-white font-bold py-2 px-4 rounded">
                    Kelola Artikel (Admin)
                </a>
            </div>
        <?php endif; ?>

    </div>

    <?php include_once("includes/footer.html"); ?>
</body>
</html>
<?php $conn->close(); ?>