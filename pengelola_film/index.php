<?php include 'db.php'; ?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CINEYUSZ</title>
    <link rel="icon" href="cineyusz.jpg" type="image/x-icon">

</head>
</head>
<body>
<?php include 'navbar.php' ?> 


    <!-- Header -->
    <header class="header">
    <img src="yusz.jpg" alt="Logo" width="500" height="300" >
    </header>

    <!-- Pencarian -->
    <section class="search-section">
    <h2>Cari Film</h2>
        <form action="search.php" method="GET">
            <input type="text" name="query" placeholder="Masukkan judul atau genre..." class="search-input" required>
            <button type="submit" class="search-button">Cari</button>
        </form>
    </section>

    <!-- Daftar Film Terbaru -->
    <section class="latest-movies">
    <h2>Film Terbaru yang di Tambahkan</h2>
    <div class="movies-grid">
        <?php
        // Ambil 4 film terbaru dari database
        $result = $conn->query("SELECT * FROM films ORDER BY id DESC LIMIT 4");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="movie-card">';
                // Tampilkan gambar jika tersedia, gunakan gambar default jika tidak ada
                if (!empty($row['image'])) {
                    echo '<img src="uploads/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['judul']) . '" class="movie-image">';
                } else {
                    echo '<img src="uploads/default.jpg" alt="Default Image" class="movie-image">';
                }
                echo '<h3>' . htmlspecialchars($row['judul']) . '</h3>';
                echo '<p>Genre: ' . htmlspecialchars($row['genre']) . '</p>';
                echo '<p>Tahun: ' . htmlspecialchars($row['tahun_rilis']) . '</p>';
                echo '<p>Rating: ' . htmlspecialchars($row['rating']) . '</p>';
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
        <p>&copy; CineYusz. All rights reserved.</p>
    </footer>
</body>
</html>
<style>
    header {
    text-align: center;
    color: #ddd;
    padding: 50px 20px;
    padding: 0;
    margin: 0;
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
/* Search Section */
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

.movie-image {
    width: 100%; /* Mengisi lebar kartu */
    height: 150px; /* Tinggi tetap untuk gambar */
    object-fit: cover; /* Memastikan gambar proporsional */
    border-bottom: 1px solid #ddd; /* Garis pemisah */
    border-radius: 5px 5px 0 0; /* Sudut atas melengkung */
}

/* Movies Grid */
.latest-movies {
    padding: 20px;
    text-align: center;
}

.latest-movies h2 {
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    color: #ddd;
    font-size: 24px;
    margin-bottom: 20px;
}

.movies-grid {
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
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

.movie-card h3 {
    font-size: 20px;
    margin: 10px 0;
}

.movie-card p {
    font-size: 14px;
    color: #555;
}

/* Footer */
.footer {
    position: relative;/* Tetap pada posisi tertentu di viewport */
    bottom: 0; /* Melekat ke bawah */
    left: 0; /* Melekat ke kiri */
    right: 0; /* Melekat ke kanan */
    text-align: center;
    padding: 10px;
    background-color: #333;
    color: #fff;
    margin-top: 20px;
}

</style>