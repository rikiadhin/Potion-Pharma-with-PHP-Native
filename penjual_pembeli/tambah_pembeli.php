<?php

require 'functions_penjual_pembeli.php';

if (isset($_POST["submit"])) {
     if (tambahPembeli($_POST) > 0) {
          echo "
          <script>
          alert('Selamat. Data BERHASIL ditambahkan');
          document.location.href = '../index.php';
          </script> 
          ";
     } else {
          echo
          "<script>
          alert('Maaf. Data GAGAL ditambahkan');
          document.location.href = '../index.php';
          </script> 
          ";
     }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Tambah Data Pembeli</title>
</head>

<body>
     <h1>Form Tambah Data Pembeli</h1>
     <br>
     <form action="" method="post">
          <table>
               <tr>
                    <td>Nama Lengkap</td>
                    <td><input type="text" name="fullname" id="fullname"></td>
               </tr>
               <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" id="username"></td>
               </tr>
               <tr>
                    <td>Nomor Telepon</td>
                    <td><input type="text" name="nomortelepon" id="nomortelepon"></td>
               </tr>
               <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" id="password"></td>
               </tr>
               <tr>
                    <td></td>
                    <td><button type="submit" name="submit">Simpan</button></td>
               </tr>
          </table>
     </form>
</body>

</html>