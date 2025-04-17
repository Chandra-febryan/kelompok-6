
<p class="text-gray-700 mb-4">
                    JatimGO merupakan aplikasi yang berisi informasi tentang operasional transportasi bus TransJatim.
                    Aplikasi ini diciptakan dalam mendukung SDGs no 11 tentang sustainable cities, dengan fokus utama 
                    kami pada transportasi berkelanjutan.
                </p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                            <div class="bg-green-50 p-4 rounded-lg stat-card">
                                <div class="text-primary font-bold text-xl">15</div>
                                <div class="text-sm text-gray-600">Rute Aktif</div>
                            </div>
                            <div class="bg-green-50 p-4 rounded-lg stat-card">
                                <div class="text-primary font-bold text-xl">120</div>
                                <div class="text-sm text-gray-600">Bus Beroperasi</div>
                            </div>
                            <div class="bg-green-50 p-4 rounded-lg stat-card">
                                <div class="text-primary font-bold text-xl">85%</div>
                                <div class="text-sm text-gray-600">Ketepatan Waktu</div>
                            </div>
                            <div class="bg-green-50 p-4 rounded-lg stat-card">
                                <div class="text-primary font-bold text-xl">4.8</div>
                                <div class="text-sm text-gray-600">Rating Pengguna</div>
                            </div>
                        </div>
             <!-- Services Section -->
             <div class="bg-white p-6 rounded-xl shadow-md">
                        <h2 class="text-2xl font-bold text-primary mb-6">Layanan Terintegrasi</h2>
                        
                        <div class="grid md:grid-cols-3 gap-6">
                            <div class="border border-gray-200 rounded-lg p-5 hover:border-accent transition service-card">
                                <div class="flex items-start mb-3">
                                    <div class="bg-green-100 p-3 rounded-full mr-4">
                                        <i class="fas fa-route text-accent text-xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-lg mb-1">Info Rute</h3>
                                        <p class="text-gray-600 mb-3">Informasi lengkap mengenai rute perjalanan Trans Jatim di seluruh Jawa Timur</p>
                                        <a href="rute.php" class="text-accent font-medium flex items-center">
                                            Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="border border-gray-200 rounded-lg p-5 hover:border-accent transition service-card">
                                <div class="flex items-start mb-3">
                                    <div class="bg-green-100 p-3 rounded-full mr-4">
                                        <i class="fas fa-ticket-alt text-accent text-xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-lg mb-1">Info Tiket</h3>
                                        <p class="text-gray-600 mb-3">Informasi lengkap mengenai tiket Trans Jatim termasuk harga dan promo</p>
                                        <a href="tiket.php" class="text-accent font-medium flex items-center">
                                            Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="border border-gray-200 rounded-lg p-5 hover:border-accent transition service-card">
                                <div class="flex items-start mb-3">
                                    <div class="bg-green-100 p-3 rounded-full mr-4">
                                        <i class="fas fa-bus text-accent text-xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-lg mb-1">Jadwal Bus</h3>
                                        <p class="text-gray-600 mb-3">Jadwal lengkap keberangkatan dan kedatangan bus Trans Jatim</p>
                                        <a href="jadwal.php" class="text-accent font-medium flex items-center">
                                            Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                      <!-- Statistics Chart -->
                      <div class="bg-white p-6 rounded-xl shadow-md mb-6">
                        <h3 class="font-bold text-lg mb-4 text-primary">Statistik Penggunaan</h3>
                        <canvas id="userStatsChart" height="200"></canvas>
                        <canvas id="userStatsChart" width="600" height="400"></canvas>
    <br>
    <button onclick="downloadChartAsPDF()">Download PDF</button>

    <script>
        const ctx = document.getElementById('userStatsChart').getContext('2d');
        const userStatsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode($minggu); ?>,
                datasets: [{
                    label: 'Pengguna Aktif',
                    data: <?= json_encode($user_aktif); ?>,
                    backgroundColor: 'rgba(34, 197, 94, 0.2)',
                    borderColor: 'rgba(34, 197, 94, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            color: '#111',
                            font: {
                                weight: 'bold'
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        async function downloadChartAsPDF() {
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF();
            const canvas = document.getElementById('userStatsChart');
            const imageData = canvas.toDataURL('image/png');

            pdf.setFontSize(16);
            pdf.text("Statistik Penggunaan JatimGO", 10, 10);
            pdf.addImage(imageData, 'PNG', 10, 20, 180, 100);
            pdf.save('statistik_jatimgo.pdf');
        }
    </script>
                    </div>
                     <!-- Articles Section -->
        <section class="mb-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-primary">Artikel & Berita Terkini</h2>
                <a href="#" class="text-accent font-medium hover:underline">Lihat Semua</a>
            </div>
            
            <div class="swiper articleSwiper rounded-xl overflow-hidden shadow-lg">
                <div class="swiper-wrapper">
                    <!-- Slide 1 -->
                    <div class="swiper-slide relative">
                        <img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                             alt="Artikel 1" class="w-full h-64 md:h-80 object-cover">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                            <span class="bg-accent text-white text-xs px-2 py-1 rounded mb-2 inline-block">Berita</span>
                            <h3 class="text-white text-xl font-bold mb-2">
                                Gratis Tarif Selama 7 Hari, Pemprov Jatim Resmikan Transjatim Koridor V
                            </h3>
                            <p class="text-gray-200 text-sm mb-3">Rute Terminal Purabaya – Terminal Bangkalan mulai beroperasi</p>
                            <div class="flex items-center text-gray-300 text-sm">
                                <i class="far fa-calendar-alt mr-2"></i> 15 Juni 2023
                            </div>
                        </div>
                    </div>
                    
                    <!-- Slide 2 -->
                    <div class="swiper-slide relative">
                        <img src="https://images.unsplash.com/photo-1508514177221-188e1e464088?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                             alt="Artikel 2" class="w-full h-64 md:h-80 object-cover">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                            <span class="bg-blue-500 text-white text-xs px-2 py-1 rounded mb-2 inline-block">Pengumuman</span>
                            <h3 class="text-white text-xl font-bold mb-2">
                                Transjatim Tambah Rute Baru untuk Meningkatkan Pelayanan
                            </h3>
                            <p class="text-gray-200 text-sm mb-3">Rute baru Surabaya - Tuban mulai beroperasi bulan depan</p>
                            <div class="flex items-center text-gray-300 text-sm">
                                <i class="far fa-calendar-alt mr-2"></i> 5 Juni 2023
                            </div>
                        </div>
                    </div>
                    
                    <!-- Slide 3 -->
                    <div class="swiper-slide relative">
                        <img src="https://images.unsplash.com/photo-1557223562-6c77ef16210f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                             alt="Artikel 3" class="w-full h-64 md:h-80 object-cover">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                            <span class="bg-purple-500 text-white text-xs px-2 py-1 rounded mb-2 inline-block">Promo</span>
                            <h3 class="text-white text-xl font-bold mb-2">
                                Promo Tiket Akhir Pekan Diskon 20% untuk Pelajar
                            </h3>
                            <p class="text-gray-200 text-sm mb-3">Gunakan kode promo PELAJAR20 saat pembelian tiket</p>
                            <div class="flex items-center text-gray-300 text-sm">
                                <i class="far fa-calendar-alt mr-2"></i> 1 Juni 2023
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="swiper-pagination !bottom-2"></div>
                <div class="swiper-button-next text-white"></div>
                <div class="swiper-button-prev text-white"></div>
            </div>
        </section>
 <!-- SDGs Section -->
 <section class="bg-green-50 rounded-xl p-8 mb-12">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-6 md:mb-0 md:pr-8">
                    <img src="src/ods11.png" alt="SDG 11" class="w-full max-w-xs mx-auto">
                </div>
                <div class="md:w-1/2">
                    <h2 class="text-2xl font-bold text-primary mb-4">Mendukung Tujuan Pembangunan Berkelanjutan (SDGs)</h2>
                    <p class="text-gray-700 mb-4">
                        JatimGO berkomitmen untuk mendukung Sustainable Development Goals (SDGs) nomor 11: 
                        Kota dan Permukiman yang Berkelanjutan. Fokus kami pada transportasi umum yang 
                        terjangkau, aman, dan ramah lingkungan berkontribusi pada pencapaian tujuan ini.
                    </p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white p-3 rounded-lg shadow-sm">
                            <div class="flex items-center">
                                <div class="bg-green-100 p-2 rounded-full mr-3">
                                    <i class="fas fa-leaf text-accent"></i>
                                </div>
                                <span class="font-medium">Emisi Karbon Rendah</span>
                            </div>
                        </div>
                        <div class="bg-white p-3 rounded-lg shadow-sm">
                            <div class="flex items-center">
                                <div class="bg-green-100 p-2 rounded-full mr-3">
                                    <i class="fas fa-users text-accent"></i>
                                </div>
                                <span class="font-medium">Akses untuk Semua</span>
                            </div>
                        </div>
                        <div class="bg-white p-3 rounded-lg shadow-sm">
                            <div class="flex items-center">
                                <div class="bg-green-100 p-2 rounded-full mr-3">
                                    <i class="fas fa-shield-alt text-accent"></i>
                                </div>
                                <span class="font-medium">Keamanan Penumpang</span>
                            </div>
                        </div>
                        <div class="bg-white p-3 rounded-lg shadow-sm">
                            <div class="flex items-center">
                                <div class="bg-green-100 p-2 rounded-full mr-3">
                                    <i class="fas fa-city text-accent"></i>
                                </div>
                                <span class="font-medium">Perkotaan Berkelanjutan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>            