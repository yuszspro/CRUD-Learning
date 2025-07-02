<?php
// Include file koneksi database
include 'db.php';

// Periksa apakah ada query pencarian yang dikirim
if (isset($_GET['query'])) {
    $searchQuery = $_GET['query'];

    // Siapkan dan jalankan query pencarian menggunakan prepared statements
    $stmt = $conn->prepare("SELECT * FROM films WHERE judul LIKE ? OR genre LIKE ?");
    $likeQuery = "%" . $searchQuery . "%";
    $stmt->bind_param("ss", $likeQuery, $likeQuery);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Jika tidak ada query pencarian, tampilkan pesan kosong
    $searchQuery = "";
    $result = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian</title>
    <link rel="stylesheet" href="search.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'navbar.php' ?> 

    <!-- Section Hasil Pencarian -->
    <section class="search-results">
        <h1>Hasil Pencarian</h1>
        <p>Mencari: <strong><?php echo htmlspecialchars($searchQuery); ?></strong></p>

        <?php if ($result && $result->num_rows > 0): ?>
            <div class="movies-grid">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="movie-card">
                        <h3><?php echo htmlspecialchars($row['judul']); ?></h3>
                        <p>Genre: <?php echo htmlspecialchars($row['genre']); ?></p>
                        <p>Tahun: <?php echo htmlspecialchars($row['tahun_rilis']); ?></p>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>Tidak ada hasil yang ditemukan untuk "<strong><?php echo htmlspecialchars($searchQuery); ?></strong>".</p>
        <?php endif; ?>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 Film Manager by Fairuz. All rights reserved.</p>
    </footer>
</body>
</html>
