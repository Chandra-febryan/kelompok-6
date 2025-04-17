<?php
session_start();
$conn = new mysqli("localhost", "root", "", "db_pweb");

if (isset($_SESSION['username'])) {
    $role = $_SESSION['role'];  // Ambil role dari session   

}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>JatimGO</title>
    <script src="https://cdn.tailwindcss.com"></script>
     <!-- Swiper CSS -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
  />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1a5632',
                        secondary: '#2e7d32',
                        accent: '#4caf50',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 ">

    <!-- Navbar -->
    <nav class="bg-green-700 p-4">
        <ul class="flex justify-between text-white">
        <body class="bg-gray-100">
    <?php include_once("includes/navbar.php"); ?>
        </ul>
    </nav>
      <!--Hero section-->
    <section class="bg-cover  bg-center h-64" style="background-image: url('src/123.jpg');">
        <div class="bg-black bg-opacity-40 h-full flex items-center justify-center">
            <div class="text-center text-white">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">JatimGO - Transportasi Umum Jawa Timur</h1>
                <p class="text-xl mb-8">Layanan transportasi umum terintegrasi yang memudahkan perjalanan Anda di seluruh Jawa Timur</p>
</div>
</div>
    </section>

    <div class="container mx-auto p-6">
        <?php if (!isset($_SESSION['username'])): ?>
            <!-- Halaman Selamat Datang jika belum login -->
            <div class="container mx-auto px-4 py-12 text-center">
            <h2 class="text-3xl font-bold text-primary mb-6">Selamat Datang di JatimGO!</h2>
            <p class="text-lg text-gray-700 mb-8 max-w-3xl mx-auto">
                Dapatkan semua informasi mengenai Trans Jatim yang memudahkan perjalanan Anda. 
                Silakan login atau registrasi untuk mengakses jadwal bus dan layanan lengkap kami.
            </p>
            <div class="grid md:grid-cols-3 gap-8 mb-12">
                <div class="bg-white p-6 rounded-xl shadow-md service-card">
                    <div class="text-primary text-4xl mb-4">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Rute Lengkap</h3>
                    <p class="text-gray-600">Temukan rute perjalanan bus Trans Jatim di seluruh Jawa Timur</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-md service-card">
                    <div class="text-primary text-4xl mb-4">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Jadwal Tepat</h3>
                    <p class="text-gray-600">Informasi jadwal keberangkatan dan kedatangan yang akurat</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-md service-card">
                    <div class="text-primary text-4xl mb-4">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Pembelian Tiket</h3>
                    <p class="text-gray-600">Beli tiket secara online untuk kenyamanan perjalanan Anda</p>
                </div>
            </div>
            
            </div>
            
        <?php else: ?>
<section class="flex flex-col md:flex-row gap-8">
  <div>
        <div class="bg-white p-6 rounded-xl shadow-md mb-8">
            <?php if ($_SESSION['role'] === 'admin'): ?>
               <!-- Tampilan untuk Admin -->
 <h2 class="text-2xl font-bold text-red-600 mb-4">
                    Selamat datang Admin, <?= htmlspecialchars($_SESSION['username']); ?>!
                </h2>
               <?php include_once("includes/admin.php");?>
            <?php else: ?>
                <!-- Tampilan untuk User -->
                <h2 class="text-2xl font-bold text-primary mb-4">
                    Selamat datang, <?= htmlspecialchars($_SESSION['username']); ?>!
                </h2>
              <?php include_once("includes/user.php");?>          
            <?php endif; ?>
        </div>
            </div>
            </section>
        <?php endif; ?>
            </div>

    
  </div>

  
</body>
<?php include_once("includes/footer.html")?>
</html>
