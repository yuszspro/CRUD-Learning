<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - Dashboard</title>
    <link rel="icon" href="cineyusz.jpg" type="image/x-icon">
    <header class="header">
    <img src="yusz.jpg" alt="Logo" width="500" height="300" >
</head>
<body>
    <div class="container">
        <h1>Selamat Datang bro!</h1>
        <p class="welcome-message">Halo, <?php echo $_SESSION['username']; ?>! Terima kasih telah login.
        jelajahi untuk melihat list film Fairuz.</p>
        <a href="index.php">Beranda</a>
    </div>
</body>
</html>

<style>
    /* Umum */
    body{
  display: flex;
  height: 100vh;
  text-align: center;
  align-items: center;
  justify-content: center;
  background-image: url('sasuke.jpg'); /* URL gambar latar */
  background-size: cover; /* Membuat gambar menyesuaikan ukuran layar */
  background-position: center; /* Pusatkan gambar latar */
  background-repeat: no-repeat; /* Menghindari pengulangan gambar */
  background-attachment: fixed; /* Gambar tetap saat di-scroll */
  margin: 0;
  padding: 20px;
}

/* Kontainer Utama */
.container {
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    background-color: #ffffff;
    width: 100%;
    max-width: 600px;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
}

/* Header */
h1 {
    color: #4CAF50;
    font-size: 24px;
    margin-bottom: 20px;
}

/* Link beranda*/
a {
    display: inline-block;
    margin-top: 20px;
    text-decoration: none;
    font-size: 16px;
    color: white;
    background-color: #4CAF50;
    padding: 10px 20px;
    border-radius: 5px;
    transition: all 0.3s ease-in-out;
}

a:hover {
    background-color: #007bf0;
}

/* Pesan Selamat Datang */
.welcome-message {
    font-size: 18px;
    color: #666666;
    margin-bottom: 20px;
}

</style>