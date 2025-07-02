<?php
include 'db.php';

$sql = "SELECT * FROM komentar";// Query untuk mengambil semua data dari tabel films
$result = $conn->query($sql);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Komentar</title>
</head>
<body>
<?php include 'navbar.php' ?>
<link rel="stylesheet" type="text/css" href="style.css">
<h3>Komentar Terkirim:</h3>
</body>
</html>
<table class="comments-table">
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
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Komentar</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $result = $conn->query("SELECT * FROM komentar ORDER BY id DESC");
        $no = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
            echo "<td>" . htmlspecialchars($row['komentar']) . "</td>";
            echo "<td>" . htmlspecialchars($row['tanggal']) . "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
