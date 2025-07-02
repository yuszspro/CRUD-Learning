<?php
session_start();
include 'db.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

// Hapus komentar berdasarkan ID
if (isset($_GET['id'])) {
    $comment_id = $_GET['id'];

    $sql = "DELETE FROM comments WHERE id = $comment_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: crud_komentar.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
