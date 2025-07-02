<?php
session_start();
include 'db.php';
// Mendapatkan semua komentar dari tabel
$sql = "SELECT * FROM comments ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Komentar</title>
    <link rel="icon" href="cineyusz.jpg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php include 'navbar.php' ?>
    <div class="container">
        <h2>Daftar Komentar dan Balasan</h2>
        <table>
            <thead>
                <tr>
                    <th>no</th>
                    <th>Username</th>
                    <th>Komentar</th>
                    <th>Balasan Admin</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['comment']); ?></td>
                            <td><?php echo $row['reply'] ? htmlspecialchars($row['reply']) : '<i>Belum dibalas</i>'; ?></td>

                            <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Belum ada komentar.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
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