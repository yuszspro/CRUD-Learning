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
    <title>Pencarian</title>
    <link rel="icon" href="cineyusz.jpg" type="image/x-icon">
</head>
<body>
<?php include 'navbar.php'; ?> 
<section class="search-section">
    <h2>Cari Film</h2>
        <form action="search.php" method="GET">
            <input type="text" name="query" placeholder="Masukkan judul atau genre..." class="search-input" required>
            <button type="submit" class="search-button">Cari</button>
        </form>
    </section>

<!-- Section Hasil Pencarian -->
<section class="search-results">
    <h1>Hasil Pencarian</h1>
    <p>Mencari: <strong><?php echo htmlspecialchars($searchQuery); ?></strong></p>

    <?php if ($result && $result->num_rows > 0): ?>
        <div class="movies-grid">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="movie-card">
                    <!-- Tampilkan gambar jika ada -->
                    <?php if (!empty($row['image'])): ?>
                        <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="Gambar <?php echo htmlspecialchars($row['judul']); ?>" class="movie-image">
                    <?php else: ?>
                        <img src="default-image.jpg" alt="Gambar tidak tersedia" class="movie-image">
                    <?php endif; ?>

                    <h3><?php echo htmlspecialchars($row['judul']); ?></h3>
                    <p>Genre: <?php echo htmlspecialchars($row['genre']); ?></p>
                    <p>Tahun: <?php echo htmlspecialchars($row['tahun_rilis']); ?></p>
                    <p>Rating: <?php echo htmlspecialchars($row['rating']); ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>Tidak ada hasil yang ditemukan untuk "<strong><?php echo htmlspecialchars($searchQuery); ?></strong>".</p>
    <?php endif; ?>
</section>

<!-- Footer -->
<footer class="footer">
    <p>&copy; CineYusz. All rights reserved.</p>
</footer>
</body>
</html>

<style>

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
.search-section {
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    text-align: center;
    padding: 20px;
    margin: 20px auto;
}

.search-section h2 {
    color: #ddd;
    font-size: 24px;
    margin-bottom: 15px;
}

.search-input {
    width: 60%;
    padding: 10px;
    font-size: 16px;
    margin-right: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.search-button {
    padding: 10px 20px;
    font-size: 16px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.search-button:hover {
    background-color: #45a049;
}

.search-results {
    color: #fff;
    padding: 20px;
    text-align: center;
}

.search-results h1 {
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    color: #ddd;
    font-size: 28px;
    margin-bottom: 15px;
}

.search-results p {
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    color: #fff;
    font-size: 16px;
    margin-bottom: 20px;
}

.movies-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    padding: 20px;
}

.movie-card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    overflow: hidden;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.movie-card img {
    width: 100%;
    height: auto;
}

.movie-card h3 {
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    color: #000000;
    font-size: 20px;
    margin: 10px 0;
}

.movie-card p {
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    font-size: 14px;
    color: #000000;
}
/* Footer */
.footer {
    position: fixed; /* Tetap pada posisi tertentu di viewport */
    bottom: 0; /* Melekat ke bawah */
    left: 0; /* Melekat ke kiri */
    right: 0; /* Melekat ke kanan */
    text-align: center;
    padding: 10px;
    background-color: #333;
    color: #fff;
    margin-top: 20px;
    z-index: 1000; /* Pastikan footer berada di atas elemen lain jika ada */
}

</style>