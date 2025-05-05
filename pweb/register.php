<?php
session_start();
$conn = new mysqli("localhost", "root", "", "db_pweb");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];  // Menyimpan role (admin atau user)

    // Cek apakah username sudah terdaftar
    $result = $conn->query("SELECT * FROM users WHERE username = '$username'");
    if ($result->num_rows > 0) {
        echo "Username sudah digunakan!";
    } else {
        // Jika belum ada, insert data baru
        $conn->query("INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')");
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;  // Menyimpan role dalam session
        header("Location: index.php");
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-green-700 p-4">
        <ul class="flex justify-between text-white">
        <body class="bg-gray-100">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center"> <!-- Container, padding & alignment -->
        <div class="flex items-center space-x-6"> <!-- Tingkatkan spasi antar item -->
        <span class="text-xl font-bold">JatimGO</span>
            <a href="index.php" class="hover:text-green-200 transition duration-150 ease-in-out font-medium">Beranda</a>
                    <a href="jadwal.php" class="hover:text-green-200 transition duration-150 ease-in-out font-medium">Jadwal</a>
                    <a href="tiket.php" class="hover:text-green-200 transition duration-150 ease-in-out font-medium">Tiket</a>
                    <a href="artikel.php" class="hover:text-green-200 transition duration-150 ease-in-out font-medium">Artikel</a>
                    <a href="kontak.php" class="hover:text-green-200 transition duration-150 ease-in-out font-medium">Kontak</a>
            <?php if (!isset($_SESSION['username'])): ?>
                <li><a href="login.php" class="hover:underline">Login</a></li>
                <li><a href="register.php" class="hover:underline">Register</a></li>
            <?php else: ?>
                <li><a href="logout.php" class="hover:underline">Logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div class="max-w-lg mx-auto p-6 bg-white shadow-md rounded-lg mt-20">
        <h2 class="text-2xl font-semibold mb-4">Daftar Akun Baru</h2>
        <form action="" method="POST">
            <input type="text" name="username" placeholder="Username" class="w-full p-2 border rounded mb-3" required>
            <input type="password" name="password" placeholder="Password" class="w-full p-2 border rounded mb-3" required>
            <select name="role" class="w-full p-2 border rounded mb-3">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Daftar</button>
        </form>
    </div>
</body>
</html>



