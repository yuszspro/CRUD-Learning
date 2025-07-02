<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $tahun_rilis = $_POST['tahun_rilis'];
    $status = $_POST['status'];
    $image = $_FILES['image'];
    $rating = $_POST['rating'];

    // Validasi genre di sisi server
    if (!isset($_POST['genre']) || count($_POST['genre']) == 0) {
        die("Harap pilih minimal satu genre!");
    }

    $genre = implode(", ", $_POST['genre']); // Menyimpan genre yang dipilih sebagai string

    // Validasi upload gambar
    if ($image['error'] !== UPLOAD_ERR_OK) {
        die("Terjadi kesalahan saat mengupload file. Kode error: " . $image['error']);
    }

    // Tentukan nama file gambar dan folder tujuan
    $image_name = time() . '_' . basename($image['name']);
    $target_dir = "uploads/"; // Folder untuk menyimpan gambar
    $target_file = $target_dir . $image_name;

    // Validasi tipe file
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array($image_file_type, $allowed_types)) {
        die("Hanya file gambar yang diperbolehkan (jpg, jpeg, png, gif).");
    }

    // Buat folder jika belum ada
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Pindahkan file ke folder tujuan
    if (move_uploaded_file($image['tmp_name'], $target_file)) {
        // Simpan data ke database
        $sql = "INSERT INTO films (judul, genre, tahun_rilis, status, image, rating) 
                VALUES ('$judul', '$genre', '$tahun_rilis', '$status', '$image_name', '$rating')";

        if ($conn->query($sql) === TRUE) {
            echo "Film berhasil ditambahkan!";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        die("Gagal memindahkan file ke folder tujuan. Periksa izin folder atau path tujuan.");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <title>Tambahkan Film</title>
    <link rel="icon" href="cineyusz.jpg" type="image/x-icon">
</head>
<body>
<div class="form-container">
<?php include 'navbar.php'; ?> 
<h2>Tambahkan Film</h2>

<form method="POST" enctype="multipart/form-data">
<label for="judul">Judul Film:</label>
    <input type="text" id="judul" name="judul" required>

    <label>Genre:</label>
    <div class="checkbox-group">
        <label><input type="checkbox" name="genre[]" value="Action">Action</label>
        <label><input type="checkbox" name="genre[]" value="Drama">Drama</label>
        <label><input type="checkbox" name="genre[]" value="Comedy">Comedy</label>
        <label><input type="checkbox" name="genre[]" value="Adventure">Adventure</label>
        <label><input type="checkbox" name="genre[]" value="Romance">Romance</label>
        <label><input type="checkbox" name="genre[]" value="Horror">Horror</label>
    </div>

    <label for="tahun">Tahun Rilis:</label>
    <input type="number" id="tahun" name="tahun_rilis" min="1000" max="9999" required>

    <label>Status:</label>
    <div class="radio-group">
        <label><input type="radio" name="status" value="Sudah" required>Sudah Ditonton</label>
        <label><input type="radio" name="status" value="Belum" required>Belum Ditonton</label>
    </div>

    <label for="tahun">Rating:</label>
    <input type="number" id="rating" name="rating" min="1" max="10" required>

    <label>Gambar:</label>
    <input type="file" name="image" accept="image/*" required><br>

    <input type="submit" value="Tambah Film">
</form>
</div>
</body>
</html>

<style>

form label {
    margin-bottom: 5px;
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
form input[type="text"],
form input[type="number"],
form input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-sizing: border-box;
}

.checkbox-group,
.radio-group {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 15px;
}

.checkbox-group label,
.radio-group label {
    display: flex;
    align-items: center;
    gap: 5px;
}

input[type="checkbox"],
input[type="radio"] {
    margin-right: 5px;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    text-transform: uppercase;
    font-weight: bold;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

</style>