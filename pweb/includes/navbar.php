<nav> <!-- Warna sedikit lebih gelap, tambah shadow -->
    <div class="container mx-auto px-6 py-3 flex justify-between items-center"> <!-- Container, padding & alignment -->
        <div class="flex items-center space-x-6"> <!-- Tingkatkan spasi antar item -->
        <span class="text-xl font-bold">JatimGO</span>
            <a href="index.php" class="hover:text-green-200 transition duration-150 ease-in-out font-medium">Beranda</a>
                    <a href="jadwal.php" class="hover:text-green-200 transition duration-150 ease-in-out font-medium">Jadwal</a>
                    <a href="tiket.php" class="hover:text-green-200 transition duration-150 ease-in-out font-medium">Tiket</a>
                    <a href="artikel.php" class="hover:text-green-200 transition duration-150 ease-in-out font-medium">Artikel</a>
                    <a href="kontak.php" class="hover:text-green-200 transition duration-150 ease-in-out font-medium">Kontak</a>

            <?php if (isset($_SESSION['role'])): ?>
                <?php if ($_SESSION['role'] == 'admin'): ?>
                    <!-- Dropdown Admin -->
<div class="relative group pb-2">

    <button class="hover:text-green-200 transition duration-150 ease-in-out flex items-center focus:outline-none">
        <span class="hover:text-green-200 transition duration-150 ease-in-out font-medium">Admin Menu</span>
        <svg class="ml-1 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
    </button>

    <!-- Konten Dropdown: (mt-2 dipertahankan untuk visual spacing) -->
    <!-- Class group-hover:block tetap sama -->
    <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-xl z-20 hidden group-hover:block">
        <!-- Item Dropdown: Padding sudah cukup baik (px-4 py-2) -->
        <a href="admin_dashboard.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100 hover:text-green-700 transition duration-150 ease-in-out">Ubah Penjadwalan</a>
        <a href="add_layanan.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100 hover:text-green-700 transition duration-150 ease-in-out">Tambah Jadwal</a>
    </div>

</div> 
                <?php endif; ?>
                <a href="logout.php" class="bg-red-500 hover:bg-red-300 px-3 py-1 rounded text-white transition duration-150 ease-in-out font-medium">Logout</a>
            <?php else: ?>
                <div class="relative group pb-2">

    <button class="hover:text-green-200 transition duration-150 ease-in-out flex items-center focus:outline-none">
        <span class="hover:text-green-200 transition duration-150 ease-in-out font-medium">Masuk</span>
        <svg class="ml-1 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
    </button>

    <!-- Konten Dropdown: (mt-2 dipertahankan untuk visual spacing) -->
    <!-- Class group-hover:block tetap sama -->
    <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-xl z-20 hidden group-hover:block">
        <!-- Item Dropdown: Padding sudah cukup baik (px-4 py-2) -->
        <a href="login.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100 hover:text-green-700 transition duration-150 ease-in-out font-medium">Login</a>
                <a href="register.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100 hover:text-green-700 transition duration-150 ease-in-out font-medium">Register</a>
             </div>
<?php endif; ?>
        </div>

    </div>
</nav>
