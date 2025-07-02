<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $genre = implode(", ", $_POST['genre']);
    $tahun_rilis = $_POST['tahun_rilis'];
    $status = $_POST['status'];
    $rating = $_POST['rating'];

    $sql = "UPDATE films SET judul='$judul', genre='$genre', tahun_rilis='$tahun_rilis', status='$status', rating='$rating' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Film berhasil diupdate!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$id = $_GET['id'];
$sql = "SELECT * FROM films WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Edit Film</title>
    <link rel="icon" href="cineyusz.jpg" type="image/x-icon">
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="form-container">
    <h2>Edit Film</h2>
    <style>
</style>
    <form method="POST" onsubmit="return validateGenre()">
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <label for="judul">Judul Film:</label>
        <input type="text" id="judul" name="judul" value="<?php echo $row['judul']; ?>" required>

        <label>Genre:</label>
        <div class="checkbox-group">
            <label><input type="checkbox" name="genre[]" value="Action" <?php if (in_array('Action', explode(", ", $row['genre']))) echo 'checked'; ?>>Action</label>
            <label><input type="checkbox" name="genre[]" value="Drama" <?php if (in_array('Drama', explode(", ", $row['genre']))) echo 'checked'; ?>>Drama</label>
            <label><input type="checkbox" name="genre[]" value="Comedy" <?php if (in_array('Comedy', explode(", ", $row['genre']))) echo 'checked'; ?>>Comedy</label>
            <label><input type="checkbox" name="genre[]" value="Adventure" <?php if (in_array('Adventure', explode(", ", $row['genre']))) echo 'checked'; ?>>Adventure</label>
            <label><input type="checkbox" name="genre[]" value="Romance" <?php if (in_array('Romance', explode(", ", $row['genre']))) echo 'checked'; ?>>Romance</label>
            <label><input type="checkbox" name="genre[]" value="Horror" <?php if (in_array('Horror', explode(", ", $row['genre']))) echo 'checked'; ?>>Horror</label>
        </div>

        <label for="tahun_rilis">Tahun Rilis:</label>
        <input type="number" id="tahun_rilis" name="tahun_rilis" value="<?php echo $row['tahun_rilis']; ?>" required>

        <label>Status:</label>
        <div class="radio-group">
            <label><input type="radio" name="status" value="Sudah" <?php if ($row['status'] == 'Sudah') echo 'checked'; ?>>Sudah Ditonton</label>
            <label><input type="radio" name="status" value="Belum" <?php if ($row['status'] == 'Belum') echo 'checked'; ?>>Belum Ditonton</label>
        </div>

        <label for="tahun_rilis">Rating:</label>
        <input type="number" id="rating" name="rating" value="<?php echo $row['rating']; ?>" required>

        <input type="submit" value="Update Film">
    </form>
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
</div>
</body>
</html>
<style>
        body {
    background-image: url('sasuke.jpg'); /* URL gambar latar */
    background-size: cover; /* Membuat gambar menyesuaikan ukuran layar */
    background-position: center; /* Pusatkan gambar latar */
    background-repeat: no-repeat; /* Menghindari pengulangan gambar */
    background-attachment: fixed; /* Gambar tetap saat di-scroll */

}
h2{
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    color: #ddd;
}
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
}

input[type="submit"]:hover {
    background-color: #45a049;
}

</style>