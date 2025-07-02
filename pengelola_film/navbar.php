<?php
// Memastikan sesi hanya dimulai sekali
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CINE YUSZ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      body {
        padding-top: 100px; /* Sesuaikan dengan tinggi navbar */
      }
    </style>
  </head>
  <body>
  <body class="pt-5">
  <nav class="navbar bg-dark border-bottom border-body fixed-top" data-bs-theme="dark">
    <a class="navbar-brand" href="index.php">
      <!-- <img src=".jpg" alt="Logo" width="50" height="20" class="d-inline-block align-text-top"> --></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="list.php">Daftar Film</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="daftar_komentar.php">Daftar Komentar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="add_comment.php">Tambahkan Komentar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
        
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
        <!-- Dropdown CRUD hanya untuk Admin -->
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            CRUD
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="tambah.php">Tambahkan Film</a></li>
            <li><a class="dropdown-item" href="perbarui.php">Edit Film</a></li>
            <li><a class="dropdown-item" href="delete.php">Hapus Film</a></li>
            <li><a class="dropdown-item" href="crud_komentar.php">Edit dan Hapus Komentar</a></li>
            <li><a class="dropdown-item" href="admin_komentar.php">Balas Komentar</a></li>
            <li><a class="dropdown-item" href="comment.php">Komentar Masuk(ADMIN)</a></li>
          </ul>
        </li>
        <?php else: ?>
        <!-- Jika bukan admin, tampilkan pesan larangan -->
          <span class="nav-link text-danger">Akses Terlarang! Hanya Admin yang dapat mengakses menu (CRUD).</span>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
  </nav>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
<style>
  .dropdown-toggle {
    color: #ddd;
  }
</style>
