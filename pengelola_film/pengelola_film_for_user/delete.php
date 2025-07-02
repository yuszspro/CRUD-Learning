<?php
include 'db.php';

$sql = "SELECT * FROM films";// Query untuk mengambil semua data dari tabel films
$result = $conn->query($sql);
?>

<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta charset="UTF-8">
  <title>Hapus Film</title>
</head>
<?php include 'navbar.php' ?>
    <h2>DAFTAR FILM</h2>
    <table border='1'>
    <style>  
    table {
        border-collapse: collapse;
        width: 100%;
    }
    table, th, td {
        border: 1px solid black;
    }
    
    th, td {
        padding: 10px;
        text-align: left;
    }

</style>
      <tr>
      <th>ID</th>
      <th>Judul</th>
      <th>Genre</th>
      <th>Tahun Rilis</th>
      <th>Status Ditonton</th>
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
        <td>
            <a href='hapus.php?id=".$row["id"]."'>Delete</a>
        </td>
        </tr>";
    }
    echo "</table>";
} 
?>