<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Manager - Beranda</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'navbar.php' ?> 
<link rel="stylesheet" href="index.css">

    <!-- Header -->
    <header class="header">
        <h1>Selamat Datang di Film Manager by Fairuz</h1>
        <p>Kelola dan temukan film favorit dengan mudah!</p>
    </header>

    <!-- Pencarian -->
    <section class="search-section">
        <h2>Cari Film</h2>
        <form action="search.php" method="GET">
            <input type="text" name="query" placeholder="Masukkan judul atau genre..." class="search-input">
            <button type="submit" class="search-button">Cari</button>
        </form>
    </section>

    <!-- Daftar Film Terbaru -->
    <section class="latest-movies">
        <h2>Film Terbaru</h2>
        <div class="movies-grid">
            <?php
            // Ambil 4 film terbaru dari database
            $result = $conn->query("SELECT * FROM films ORDER BY id DESC LIMIT 4");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="movie-card">';
                    echo '<h3>' . $row['judul'] . '</h3>';
                    echo '<p>Genre: ' . $row['genre'] . '</p>';
                    echo '<p>Tahun: ' . $row['tahun_rilis'] . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<p>Tidak ada film yang tersedia.</p>';
            }
            ?>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 Film Manager by Fairuz. All rights reserved.</p>
    </footer>
</body>
</html>
