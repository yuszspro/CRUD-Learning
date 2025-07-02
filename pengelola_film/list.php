<?php
include 'db.php';

$sql = "SELECT * FROM films";// Query untuk mengambil semua data dari tabel films
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="cineyusz.jpg" type="image/x-icon">
    <title>Daftar Film</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<h2>Daftar List Film </h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Judul</th>
        <th>Genre</th>
        <th>Tahun Rilis</th>
        <th>Status ditonton</th>
        <th>Gambar</th>
        <th>Rating</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
        <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['judul']; ?></td>
            <td><?php echo $row['genre']; ?></td>
            <td><?php echo $row['tahun_rilis']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td><img src="uploads/<?php echo $row['image']; ?>" alt="Gambar Film" width="100"></td>
            <td><?php echo $row['rating']; ?></td>
        </tr>
    <?php endwhile; ?>    
</table>

</body>
</html>
    <style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    table, th, td {
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        border: 1px solid black;
    }
    
    th, td {
        padding: 10px;
        text-align: left;
    }
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