<?php
include 'db.php'; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi input
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $error = "Semua field wajib diisi!";
    } elseif ($password !== $confirm_password) {
        $error = "Password dan konfirmasi password tidak cocok!";
    } else {
        // Cek apakah username sudah ada
        $sql_check = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql_check);

        if ($result->num_rows > 0) {
            $error = "Username telah dipakai!";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Simpan data user ke database
            $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed_password', 'user')";
            if ($conn->query($sql) === TRUE) {
                echo "Registrasi berhasil! Silakan login.";
            } else {
                $error = "Error: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi User</title>
    <link rel="icon" href="cineyusz.jpg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="form-container">
    <h2>Registrasi User</h2>
    <form method="POST">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>

    <label for="confirm_password">Konfirmasi Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" required><br>

    <button type="submit">Daftar</button>
    <button type="button" onclick="location.href='login.php'">Kembali ke Halaman Login</button>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
</form>

</div>
</body>
</html>
<style>
 body {
    font-family: Arial, sans-serif;
    background-image: url('sasuke.jpg'); /* URL gambar latar */
    background-size: cover; /* Membuat gambar menyesuaikan ukuran layar */
    background-position: center; /* Pusatkan gambar latar */
    background-repeat: no-repeat; /* Menghindari pengulangan gambar */
    background-attachment: fixed; /* Gambar tetap saat di-scroll */
    margin: 0;
    padding: 20px;
}

h2{
    color: #ddd;
}
</style>