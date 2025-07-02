<?php
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: comment.php");
    exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM komentar WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$pesan = ""; // Variabel untuk pesan notifikasi

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $komentar = $_POST['komentar'];

    $sql = "UPDATE komentar SET nama = ?, komentar = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nama, $komentar, $id);

    if ($stmt->execute()) {
        $pesan = "Komentar berhasil diupdate!"; // Notifikasi
        $row['nama'] = ""; // Kosongkan formulir
        $row['komentar'] = ""; // Kosongkan formulir
    } else {
        $pesan = "Terjadi kesalahan: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Komentar</title>
    <link rel="icon" href="cineyusz.jpg" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<?php if (!empty($pesan)) { echo "<p class='alert'>$pesan</p>"; } ?>

<h2>Edit Komentar</h2>
<form action="" method="post" class="form">
    <label for="nama">Nama:</label>
    <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($row['nama']); ?>" required>
    
    <label for="komentar">Komentar:</label>
    <textarea id="komentar" name="komentar" required><?php echo htmlspecialchars($row['komentar']); ?></textarea>

    <button type="submit" name="edit_comment">Update Komentar</button>
</form>
</body>
</html>
