<?php
$host = "localhost";// Alamat database
$user = "root"; // dengan username database 
$password = ""; //  password database
$dbname = "film_db"; // nama database 

$conn = new mysqli($host, $user, $password, $dbname);// membuat koneksi ke database

if ($conn->connect_error) {
    die("koneksi gagal: " . $conn->connect_error);
}
?>
