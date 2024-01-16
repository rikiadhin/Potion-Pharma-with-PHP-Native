<?php

require 'functions_penjual_pembeli.php';

$nomortelepon =  $_GET["nomortelepon"];
$rowspenjual = queryPenjual("SELECT * FROM tb_penjual WHERE nomortelepon = $nomortelepon");

if (isset($_POST["submit"])) {
     if (ubahPenjual($_POST) > 0) {
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
     <title>Ubah Data Penjual</title>
</head>

<body>
     <h1>Form Ubah Data Penjual</h1>
     <br>
     <form action="" method="post">
          <?php foreach ($rowspenjual as $rowpenjual) : ?>
               <table>
                    <tr>
                         <td>Nama Lengkap</td>
                         <td><input type="text" name="fullname" id="fullname" value="<?php echo $rowpenjual['fullname'] ?>"></td>
                    </tr>
                    <tr>
                         <td>Username</td>
                         <td><input type="text" name="username" id="username" value="<?php echo $rowpenjual['username'] ?>"></td>
                    </tr>
                    <tr>
                         <td>Nomor Telepon</td>
                         <td><input type="text" name="nomortelepon" id="nomortelepon" value="<?php echo $rowpenjual['nomortelepon'] ?>"></td>
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