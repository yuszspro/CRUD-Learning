<?php
include 'db.php';

$id = $_GET['id'];
$sql = "DELETE FROM films WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Film berhasil dihapus!";
} else {
    echo "Error: " . $conn->error;
}
?>

<head>
    <link rel="stylesheet" type="text/css" href="style.css"> 
    <title>Hapus</title>
</head>
<body>
<?php include 'navbar.php' ?>
</body>