<?php
// Sertakan file koneksi database
require_once 'db.php';

// Ambil data film berdasarkan status
$sql_sudah = "SELECT * FROM film WHERE status = 'Sudah Ditonton'";
$sql_belum = "SELECT * FROM film WHERE status = 'Belum Ditonton'";

$result_sudah = $koneksi->query($sql_sudah);
$result_belum = $koneksi->query($sql_belum);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Film</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">
    <h2>Status Film</h2>

    <!-- Daftar Film Sudah Ditonton -->
    <h3>Sudah Ditonton</h3>
    <?php if ($result_sudah->num_rows > 0): ?>
        <ul>
            <?php while ($row = $result_sudah->fetch_assoc()): ?>
                <li><?php echo htmlspecialchars($row['judul']); ?> (<?php echo htmlspecialchars($row['tahun_rilis']); ?>)</li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>Tidak ada film yang sudah ditonton.</p>
    <?php endif; ?>

    <!-- Daftar Film Belum Ditonton -->
    <h3>Belum Ditonton</h3>
    <?php if ($result_belum->num_rows > 0): ?>
        <ul>
            <?php while ($row = $result_belum->fetch_assoc()): ?>
                <li><?php echo htmlspecialchars($row['judul']); ?> (<?php echo htmlspecialchars($row['tahun_rilis']); ?>)</li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>Tidak ada film yang belum ditonton.</p>
    <?php endif; ?>
</div>

</body>
</html>
