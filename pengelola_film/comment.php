<?php
session_start();
include 'db.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

// Menangani pengiriman komentar oleh pengguna
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_comment'])) {
    $username = $_SESSION['username'];
    $comment = $_POST['comment'];

    $sql = "INSERT INTO comments (username, comment) VALUES ('$username', '$comment')";
    if ($conn->query($sql) === TRUE) {
        $success = "Komentar berhasil dikirim!";
    } else {
        $error = "Error: " . $conn->error;
    }
}

// Menangani balasan admin
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_reply'])) {
    $comment_id = $_POST['comment_id'];
    $reply = $_POST['reply'];

    $sql = "UPDATE comments SET reply='$reply' WHERE id=$comment_id";
    if ($conn->query($sql) === TRUE) {
        $success = "Balasan berhasil dikirim!";
    } else {
        $error = "Error: " . $conn->error;
    }
}

// Mendapatkan semua komentar
$sql = "SELECT * FROM comments ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Comment System</title>
    <link rel="icon" href="cineyusz.jpg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php include 'navbar.php' ?>
<div class="container">
    <h2>Komentar</h2>

    <!-- Form untuk pengguna mengirim komentar -->
    <?php if ($_SESSION['role'] != 'admin'): ?>
        <form method="POST">
            <textarea name="comment" placeholder="Tulis komentar Anda di sini..." required></textarea><br>
            <button type="submit" name="submit_comment">Kirim Komentar</button>
        </form>
    <?php endif; ?>

    <!-- Menampilkan pesan sukses/gagal -->
    <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

    <!-- Menampilkan daftar komentar -->
    <div class="comments">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="comment">
                <p><strong><?php echo $row['username']; ?></strong>: <?php echo $row['comment']; ?></p>
                <?php if ($row['reply']): ?>
                    <p class="reply"><strong>Balasan Admin:</strong> <?php echo $row['reply']; ?></p>
                <?php endif; ?>

                <!-- Form untuk admin membalas komentar -->
                <?php if ($_SESSION['role'] == 'admin' && !$row['reply']): ?>
                    <form method="POST" class="reply-form">
                        <input type="hidden" name="comment_id" value="<?php echo $row['id']; ?>">
                        <textarea name="reply" placeholder="Tulis balasan..." required></textarea>
                        <button type="submit" name="submit_reply">Balas</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>

<style>
    .container {
    margin: 20px auto;
    width: 90%;
    max-width: 800px;
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
}

h2 {
    margin-bottom: 20px;
    text-align: center;
}

textarea {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 5px;
}

button {
    padding: 10px 20px;
    border: none;
    background-color: #007BFF;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background-color: #0056b3;
}

.comments {
    margin-top: 20px;
}

.comment {
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    padding: 15px;
    border: 1px solid #ddd;
    margin-bottom: 10px;
    border-radius: 5px;
    background-color: #f9f9f9;
}

.reply {
    margin-top: 10px;
    color: #555;
    font-style: italic;
}

.reply-form {
    margin-top: 10px;
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
    color: #000000;
}
</style>