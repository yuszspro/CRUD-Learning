<?php
session_start();
include 'db.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Menangani pengiriman komentar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_SESSION['username']; // Ambil username dari sesi
    $comment = $_POST['comment'];

    $sql = "INSERT INTO comments (username, comment) VALUES ('$username', '$comment')";
    if ($conn->query($sql) === TRUE) {
        $success = "Komentar berhasil dikirim!";
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Komentar</title>
    <link rel="icon" href="cineyusz.jpg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php include 'navbar.php' ?>
    <div class="form-container">
        <h2>Tambah Komentar</h2>

        <!-- Menampilkan pesan sukses/gagal -->
        <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

        <!-- Form Tambah Komentar -->
        <form method="POST">
            <textarea name="comment" placeholder="Tulis komentar Anda di sini..." required></textarea><br>
            <button type="submit">Kirim Komentar</button>
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
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    color: #ddd;
}

</style>