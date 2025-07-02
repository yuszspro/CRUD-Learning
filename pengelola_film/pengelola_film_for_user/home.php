<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>
    <h1>Selamat Datang di Home, <?php echo $_SESSION['username']; ?>!</h1>
    <a href="logout.php">Logout</a>
</body>
</html>
