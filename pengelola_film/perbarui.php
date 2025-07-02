<?php
include 'db.php';


$sql = "SELECT * FROM films";// Query untuk mengambil semua data dari tabel films
$result = $conn->query($sql);
?>

<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta charset="UTF-8">
  <title>Edit Film</title>
  <link rel="icon" href="cineyusz.jpg" type="image/x-icon">
</head>
<?php include 'navbar.php' ?>
    <h2>DAFTAR FILM</h2>
    <table border='1'>
      <tr>
      <th>ID</th>
      <th>Judul</th>
      <th>Genre</th>
      <th>Tahun Rilis</th>
      <th>Status Ditonton</th>
      <th>Rating</th>
      <th>Aksi</th>
      </tr>
<?php if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>" . $row["id"]. "</td>
        <td>" . $row["judul"]. "</td>
        <td>" . $row["genre"]. "</td>
        <td>" . $row["tahun_rilis"]. "</td>
        <td>" . $row["status"]. "</td>
        <td>" . $row["rating"]. "</td>
        <td>
            <a href='edit.php?id=".$row["id"]."'>Edit</a>
        </td>
        </tr>";
    }
    echo "</table>";
} 
?>
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