<?php
include 'db.php';

// Proses pengiriman komentar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $komentar = $_POST['komentar'];

    // Simpan ke database
    $sql = "INSERT INTO komentar (nama, komentar) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nama, $komentar);

    if ($stmt->execute()) {
        $pesan = "Komentar berhasil dikirim!";
    } else {
        $pesan = "Terjadi kesalahan: " . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komentar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'navbar.php' ?>
    <?php if (isset($pesan)) { echo "<p class='alert'>$pesan</p>"; } ?>

    <h2>Masukan Komentar</h2>
    <form action="comment.php" method="post" class="form">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required placeholder="Masukkan nama Anda">
        
        <label for="komentar">Komentar:</label>
        <textarea id="komentar" name="komentar" required placeholder="Tulis komentar Anda"></textarea>

        <button type="submit">Kirim Komentar</button>
    </form>
</body>
</html>
