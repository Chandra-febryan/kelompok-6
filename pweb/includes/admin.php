<p class="text-gray-700 mb-4">
                    Ini adalah dashboard <strong>Admin</strong>. Kamu bisa mengelola data pengguna, jadwal, dan sistem.
                </p>
                <!-- Bisa tambahkan tombol manajemen atau panel admin di sini -->
                <div class="grid md:grid-cols-4 gap-8 mb-12">
                    <div class="bg-green-50 p-4 rounded-lg stat-card">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="text-gray-500 text-sm">Total Pengguna</div>
                                <div class="text-primary font-bold text-2xl">1,248</div>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="fas fa-users text-accent"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg stat-card">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="text-gray-500 text-sm">Bus Aktif</div>
                                <div class="text-primary font-bold text-2xl">120</div>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="fas fa-bus text-accent"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg stat-card">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="text-gray-500 text-sm">Tiket Terjual</div>
                                <div class="text-primary font-bold text-2xl">3,542</div>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="fas fa-ticket-alt text-accent"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg stat-card">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="text-gray-500 text-sm">Pendapatan</div>
                                <div class="text-primary font-bold text-2xl">Rp 89.5jt</div>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="fas fa-money-bill-wave text-accent"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div class="bg-white p-4 rounded-lg border border-gray-200">
                        <h3 class="font-bold text-lg mb-4 text-primary">Statistik Pengguna</h3>
                        <canvas id="adminUserChart" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>
