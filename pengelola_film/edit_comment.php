<?php
session_start();
include 'db.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

// Proses pengeditan komentar
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment_id'])) {
    $comment_id = $_POST['comment_id'];
    $new_comment = $_POST['comment'];

    $sql = "UPDATE comments SET comment = '$new_comment' WHERE id = $comment_id";
    if ($conn->query($sql) === TRUE) {
        echo "Komentar berhasil diupdate!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Ambil data komentar untuk di-edit
if (isset($_GET['id'])) {
    $comment_id = $_GET['id'];
    $sql = "SELECT * FROM comments WHERE id = $comment_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $comment = $result->fetch_assoc();
    } else {
        header("Location: comment.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Komentar</title>
    <link rel="icon" href="cineyusz.jpg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php include 'navbar.php' ?>
    <div class="form-container">
        <h2>Edit Komentar</h2>
        <form method="POST">
            <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
            <textarea name="comment" required><?php echo htmlspecialchars($comment['comment']); ?></textarea><br>
            <button type="submit">Update Komentar</button>
        </form>
    </div>
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
h2 {
    color: #ddd;
}
</style>