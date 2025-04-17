<?php
session_start();
include_once("config/koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE username='$username'");
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $user['role'];
        header("Location: index.php");
    } else {
        $error = "Login gagal. Cek kembali username atau password.";
    }
}
?>

<!-- HTML login -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<nav class="bg-green-700 p-4">
        <ul class="flex justify-between text-white">
        <body class="bg-gray-100">
    <?php include_once("includes/navbar.php"); ?>
        </ul>
    </nav>
    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Login</h2>
        <?php if (!empty($error)) echo "<p class='text-red-500'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required class="w-full p-2 border rounded mb-3">
            <input type="password" name="password" placeholder="Password" required class="w-full p-2 border rounded mb-3">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Login</button>
        </form>
    </div>
</body>
</html>
