<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $tahun_rilis = $_POST['tahun_rilis'];
    $status = $_POST['status'];

    // Validasi genre di sisi server
    if (!isset($_POST['genre']) || count($_POST['genre']) == 0) {
        echo "Harap pilih minimal satu genre!";
        exit; // Hentikan eksekusi jika tidak ada genre yang dipilih
    }

    $genre = implode(", ", $_POST['genre']); // Menyimpan genre yang dipilih sebagai string

    $sql = "INSERT INTO films (judul, genre, tahun_rilis, status) 
            VALUES ('$judul', '$genre', '$tahun_rilis', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "Film berhasil ditambahkan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <title>Tambahkan Film</title>
</head>
<body>
<div class="form-container">
<?php include 'navbar.php' ?> 
<h2>Tambahkan Film</h2>

<form method="POST" onsubmit="return validateGenre()">
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

    <input type="submit" value="Tambah Film">
</form>



<script>
    function validateGenre() {
        const checkboxes = document.querySelectorAll('input[name="genre[]"]');
        let isChecked = false;

        for (const checkbox of checkboxes) {
            if (checkbox.checked) {
                isChecked = true;
                break;
            }
        }

        if (!isChecked) {
            alert("Harap pilih minimal satu genre!");
            return false;
        }
        return true;
    }
</script>
</body>
</html>
<style>

form label {
    margin-bottom: 5px;
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