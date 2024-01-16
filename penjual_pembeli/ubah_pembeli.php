<?php

require 'functions_penjual_pembeli.php';

$nomortelepon =  $_GET["nomortelepon"];
$rowspembeli = queryPembeli("SELECT * FROM tb_pembeli WHERE nomortelepon=$nomortelepon");

if (isset($_POST["submit"])) {
     if (ubahPembeli($_POST) > 0) {
          echo "
          <script>
          alert('Selamat. Data BERHASIL diubah');
          document.location.href = '../index.php';
          </script> 
          ";
     } else {
          echo
          "<script>
          alert('Maaf. Data GAGAL diubah');
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
     <title>Ubah Data Pembeli</title>
</head>

<body>
     <h1>Form Ubah Data Pembeli</h1>
     <br>
     <form action="" method="post">
          <?php foreach ($rowspembeli as $rowpembeli) : ?>
               <table>
                    <tr>
                         <td>Nama Lengkap</td>
                         <td><input type="text" name="fullname" id="fullname" value="<?php echo $rowpembeli['fullname'] ?>"></td>
                    </tr>
                    <tr>
                         <td>Username</td>
                         <td><input type="text" name="username" id="username" value="<?php echo $rowpembeli['username'] ?>"></td>
                    </tr>
                    <tr>
                         <td>Nomor Telepon</td>
                         <td><input type="text" name="nomortelepon" id="nomortelepon" value="<?php echo $rowpembeli['nomortelepon'] ?>"></td>
                    </tr>
                    <tr>
                         <td></td>
                         <td><button type="submit" name="submit">Simpan</button></td>
                    </tr>
               </table>
          <?php endforeach; ?>
     </form>
</body>

</html>