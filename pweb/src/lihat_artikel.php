<?php
session_start();
$conn = new mysqli("localhost", "root", "", "db_pweb");
if ($conn->connect_error) {
    die("Koneksi database gagal.");
}
mysqli_set_charset($conn, "utf8mb4");

define('UPLOAD_URL_ARTIKEL', 'uploads/artikel/');

$artikel = null;
$error_message = '';
$artikel_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($artikel_id > 0) {
    $sql = "SELECT judul, konten, tgl_buat, foto FROM tb_artikel WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $artikel_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $artikel = $result->fetch_assoc();
        } else {
            $error_message = "Artikel tidak ditemukan.";
        }
        $stmt->close();
    } else {
        $error_message = "Gagal menyiapkan query."; // Pesan untuk developer
    }
} else {
    $error_message = "ID Artikel tidak valid.";
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
    <title><?php echo $artikel ? htmlspecialchars($artikel['judul']) : 'Artikel Tidak Ditemukan'; ?> - JatimGO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tambahkan CSS lain jika perlu -->
    <style>
        .content-body p { margin-bottom: 1em; } /* Jarak antar paragraf */
        .content-body img { max-width: 100%; height: auto; margin-top: 1em; margin-bottom: 1em; }
    </style>
</head>
<body class="bg-gray-100">
    <?php include_once("includes/navbar.php"); ?>

    <div class="container mx-auto px-4 py-8 max-w-4xl">

        <div class="mb-4">
            <a href="artikel.php" class="text-secondary hover:underline">« Kembali ke Daftar Artikel</a>
        </div>

        <?php if ($artikel): ?>
            <div class="bg-white rounded-lg shadow p-6 md:p-8">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">
                    <?php echo htmlspecialchars($artikel['judul']); ?>
                </h1>
                <p class="text-gray-500 text-sm mb-5">
                    Dipublikasikan pada: <?php echo date('d F Y, H:i', strtotime($artikel['tgl_buat'])); ?>
                    <?php if ($role === 'admin'): ?>
                        | <a href="edit_artikel.php?id=<?php echo $artikel_id; ?>" class="text-red-600 hover:underline font-medium">Edit Artikel Ini</a>
                    <?php endif; ?>
                </p>

                <?php if (!empty($artikel['foto'])): ?>
                    <img src="<?php echo UPLOAD_URL_ARTIKEL . htmlspecialchars($artikel['foto']); ?>"
                         alt="<?php echo htmlspecialchars($artikel['judul']); ?>"
                         class="w-full h-auto max-h-96 object-cover rounded-md mb-6 shadow">
                <?php endif; ?>

                <div class="prose max-w-none content-body text-gray-700 leading-relaxed">
                    <?php
                        // Menggunakan nl2br untuk menghormati baris baru dari textarea biasa.
                        // Jika Anda menggunakan editor WYSIWYG yang menghasilkan HTML, HAPUS htmlspecialchars dan nl2br,
                        // TAPI PASTIKAN Anda membersihkan input HTML di simpan_artikel.php menggunakan library seperti HTMLPurifier.
                        echo nl2br(htmlspecialchars($artikel['konten']));
                    ?>
                </div>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <h2 class="text-2xl font-semibold text-red-600 mb-4">Artikel Tidak Ditemukan</h2>
                <p class="text-gray-600"><?php echo $error_message; ?></p>
            </div>
        <?php endif; ?>

    </div>

    <?php include_once("includes/footer.html"); ?>
</body>
</html>
<?php $conn->close(); ?>