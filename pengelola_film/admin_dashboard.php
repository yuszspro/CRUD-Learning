<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <link rel="icon" href="cineyusz.jpg" type="image/x-icon">
    <header class="header">
    <img src="yusz.jpg" alt="Logo" width="500" height="300" >
</head>
<div class="dashboard-container">
    <h1>Selamat Datang, Admin!</h1>
    <p>Gunakan dashboard ini untuk mengelola list filmnya FAIRUZ</p>
    <a href="index.php">Beranda</a>
</div>
</body>
</html>
 <style>
    /* Gaya untuk body */
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
/* Container utama */
.dashboard-container {
    background-color: #ffffff;
    padding: 20px 30px;
    border-radius: 10px;
    width: 600px;
    text-align: center;
}

/* Header */
.dashboard-container h1 {
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    margin-bottom: 20px;
    color: #4CAF50;
    font-size: 24px;
    font-weight: bold;
}
.dashboard-container p {
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
}
/* Tombol beranda */
.dashboard-container a {
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    display: inline-block;
    text-decoration: none;
    background-color: #4CAF50;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 14px;
    margin-top: 20px;
    transition: background-color 0.3s ease;
}

.dashboard-container a:hover {
    background-color: #007bf0;
}

/* Informasi tambahan */
.dashboard-container p {
    font-size: 16px;
    color: #555;
    margin-bottom: 20px;
}

/* Efek hover untuk header */
.dashboard-container h1:hover {
    color: #0056b3;
    transition: color 0.3s ease;
}

 </style>