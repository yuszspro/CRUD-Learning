<?php
session_start();
include 'db.php'; // Koneksi ke database


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa username
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Simpan informasi ke sesi
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Arahkan sesuai peran
            if ($user['role'] == 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: user_dashboard.php");
            }
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>


<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">

   <head>
      <meta charset="utf-8">
      <title>Login</title>
      <link rel="icon" href="cineyusz.jpg" type="image/x-icon">
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <div class="login-form">
      <img src="yusz.jpg" alt="Logo" width="320" height="200" >
         <div class="text">
<!-- LOGIN -->
         </div>
         <form method="POST">
            <div class="field">
               <div class="fas fa-envelope"></div>
               <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="field">
               <div class="fas fa-lock"></div>
               <input type="password" name="password" placeholder="Password" required>
            </div>
            <button>LOGIN</button>
            <?php if (isset($error)) echo "<p class='error'>$error</p>";?>

            <div class="link">
               Belum punya akun?
               <a href="register_user.php">Daftar disini</a>
               <div class="link">
              Mau Langsung Masuk?
               <a href="index.php">Masuk Sebagai Tamu</a>
            </div>
            </div>
         </form>
      </div>
   </body>
</html>


<style>

*{
  margin: 0;
  padding: 0;
  font-family: 'Poppins',sans-serif;
}
body{
  display: flex;
  height: 100vh;
  text-align: center;
  align-items: center;
  justify-content: center;
  background-image: url('sasuke.jpg'); /* URL gambar latar */
  background-size: cover; /* Membuat gambar menyesuaikan ukuran layar */
  background-position: center; /* Pusatkan gambar latar */
  background-repeat: no-repeat; /* Menghindari pengulangan gambar */
  background-attachment: fixed; /* Gambar tetap saat di-scroll */
  margin: 0;
  padding: 20px;
}

.login-form{
  position: relative;
  width: 400px;
  height: auto;
  background: #1b1b1b;
  padding: 10px 20px 30px;
  border: 1px solid black;
  border-radius: 15px;
  box-shadow: inset 0 0 1px #272727;
}
.text{
  font-size: 30px;
  color: #c7c7c7;
  font-weight: 600;
  letter-spacing: 2px;
}

form .field{
  margin-top: 20px;
  display: flex;
}
.field .fas{
  height: 50px;
  width: 60px;
  color: #868686;
  font-size: 20px;
  line-height: 50px;
  border: 1px solid #444;
  border-right: none;
  border-radius: 5px 0 0 5px;
  background: linear-gradient(#333,#222);
}
.field input,form button{
  height: 50px;
  width: 100%;
  outline: none;
  font-size: 19px;
  color: #868686;
  padding: 0 15px;
  border-radius: 0 5px 5px 0;
  border: 1px solid #444;
  caret-color: #339933;
  background: linear-gradient(#333,#222);
}
input:focus{
  color: #339933;
  box-shadow: 0 0 5px rgba(0,255,0,.2),
              inset 0 0 5px rgba(0,255,0,.1);
  background: linear-gradient(#333933,#222922);
  animation: glow .8s ease-out infinite alternate;
}
@keyframes glow {
   0%{
    border-color: #339933;
    box-shadow: 0 0 5px rgba(0,255,0,.2),
                inset 0 0 5px rgba(0,0,0,.1);
  }
   100%{
    border-color: #6f6;
    box-shadow: 0 0 20px rgba(0,255,0,.6),
                inset 0 0 10px rgba(0,255,0,.4);
  }
}
button{
  margin-top: 30px;
  border-radius: 5px!important;
  font-weight: 600;
  letter-spacing: 1px;
  cursor: pointer;
}
button:hover{
  color: #339933;
  border: 1px solid #339933;
  box-shadow: 0 0 5px rgba(0,255,0,.3),
              0 0 10px rgba(0,255,0,.2),
              0 0 15px rgba(0,255,0,.1),
              0 2px 0 black;
}
.link{
  margin-top: 25px;
  color: #868686;
}
.link a{
  color: #339933;
  text-decoration: none;
}
.link a:hover{
  text-decoration: underline;
}
</style>