<?php
session_start();

$conn = new mysqli("localhost", "root", "", "db_pweb");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); 
}


$role = null; 
if (isset($_SESSION['username'])) {
    $role = $_SESSION['role'];  
}

$chart_labels = [];
$chart_data = [];

if (isset($_SESSION['username'])) {
    $sql = "SELECT minggu, bulan, user_aktif FROM tb_chart ORDER BY FIELD(bulan, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), minggu ASC"; // Order chronologically
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            
            $chart_labels[] = "Minggu " . htmlspecialchars($row['minggu']) . " - " . htmlspecialchars($row['bulan']);
            $chart_data[] = (int)$row['user_aktif']; 
        }
    } elseif ($result === false) {
        error_log("Database query error: " . $conn->error);
        
    }
    
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
  <!-- Font Awesome for icons (if needed for service cards) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- jsPDF (if needed elsewhere) -->
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
    <style>
        /* Optional: Add some basic styling for the chart container */
        .chart-container {
            position: relative;
            /* height: 40vh; */ /* Adjust height as needed */
            /* width: 80vw;  */ /* Adjust width as needed */
            max-width: 800px; /* Max width */
            margin: auto; /* Center */
        }
        /* Styling for service cards */
        .service-card i {
            transition: transform 0.3s ease;
        }
        .service-card:hover i {
            transform: scale(1.2);
        }
    </style>
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
    <section class="bg-cover bg-center h-64" style="background-image: url('src/123.jpg');">
        <div class="bg-black bg-opacity-40 h-full flex items-center justify-center">
            <div class="text-center text-white px-4">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">JatimGO - Transportasi Umum Jawa Timur</h1>
                <p class="text-lg md:text-xl mb-8">Layanan transportasi umum terintegrasi yang memudahkan perjalanan Anda di seluruh Jawa Timur</p>
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
                        <h3 class="text-xl font-bold mb-2 text-gray-800">Rute Lengkap</h3>
                        <p class="text-gray-600">Temukan rute perjalanan bus Trans Jatim di seluruh Jawa Timur</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-md service-card">
                        <div class="text-primary text-4xl mb-4">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-800">Jadwal Tepat</h3>
                        <p class="text-gray-600">Informasi jadwal keberangkatan dan kedatangan yang akurat</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-md service-card">
                        <div class="text-primary text-4xl mb-4">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-800">Pembelian Tiket</h3>
                        <p class="text-gray-600">Beli tiket secara online untuk kenyamanan perjalanan Anda</p>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <!-- Tampilan jika SUDAH login -->
            <section class="flex flex-col gap-8">

                <!-- Welcome Message & Role Specific Content -->
                <div class="bg-white p-6 rounded-xl shadow-md mb-8">
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        <!-- Tampilan untuk Admin -->
                        <h2 class="text-2xl font-bold text-red-600 mb-4">
                            Selamat datang Admin, <?= htmlspecialchars($_SESSION['username']); ?>!
                        </h2>
                        <?php include_once("includes/admin.php"); ?>
                    <?php else: ?>
                        <!-- Tampilan untuk User -->
                        <h2 class="text-2xl font-bold text-primary mb-4">
                            Selamat datang, <?= htmlspecialchars($_SESSION['username']); ?>!
                        </h2>
                        <?php include_once("includes/user.php"); ?>
                    <?php endif; ?>
                </div>

                <!-- User Statistics Chart Section -->
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Statistik Pengguna Aktif Mingguan</h3>
                    <?php if (!empty($chart_labels) && !empty($chart_data)): ?>
                        <div class="chart-container">
                            <canvas id="userStatsChart"></canvas>
                        </div>
                    <?php else: ?>
                        <p class="text-center text-gray-500">Data statistik belum tersedia.</p>
                    <?php endif; ?>
                </div>

            </section>
        <?php endif; ?>
    </div> <!-- Close container -->

    <?php include_once("includes/footer.html") ?>

    <!-- Chart.js Initialization Script (Place after the canvas element) -->
    <?php if (isset($_SESSION['username']) && !empty($chart_labels) && !empty($chart_data)): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('userStatsChart').getContext('2d');

            // Retrieve data passed from PHP
            const labels = <?php echo json_encode($chart_labels); ?>;
            const data = <?php echo json_encode($chart_data); ?>;

            const userStatsChart = new Chart(ctx, {
                type: 'line', // Type of chart: line, bar, pie, etc.
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah User Aktif', // Legend label
                        data: data,
                        borderColor: 'rgb(26, 86, 50)', // Primary color line
                        backgroundColor: 'rgba(46, 125, 50, 0.2)', // Secondary color area fill (optional)
                        tension: 0.1, // Makes the line slightly curved
                        fill: true // Fill area under the line
                    }]
                },
                options: {
                    responsive: true, // Make chart responsive
                    maintainAspectRatio: true, // Maintain aspect ratio
                    scales: {
                        y: {
                            beginAtZero: true, // Start Y-axis at 0
                            title: {
                                display: true,
                                text: 'Jumlah Pengguna'
                            }
                        },
                        x: {
                             title: {
                                display: true,
                                text: 'Periode Waktu (Minggu - Bulan)'
                             }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top', // Position of the legend
                        },
                        title: {
                            display: true,
                            text: 'Grafik Pertumbuhan Pengguna Aktif' // Chart title
                        },
                        tooltip: {
                             callbacks: {
                                 label: function(context) {
                                     let label = context.dataset.label || '';
                                     if (label) {
                                         label += ': ';
                                     }
                                     if (context.parsed.y !== null) {
                                         label += context.parsed.y + ' pengguna';
                                     }
                                     return label;
                                 }
                             }
                        }
                    }
                }
            });
        });
    </script>
    <?php endif; ?>

</body>
</html>
<?php
$conn->close(); // Close the database connection at the end
?>