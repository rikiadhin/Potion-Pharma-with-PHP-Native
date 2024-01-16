<?php

// if(!isset($_SESSION["login"])){
//      header("Location: ../dashboard.php");
//      exit;
// }

require 'functions_user.php';

$id =  $_GET["id"];
$rowsuser = queryUser("SELECT * FROM tb_user WHERE id=$id");

if (isset($_POST["submit"])) {
     if (ubahUser($_POST) > 0) {
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
     <title>Ubah Data User</title>
</head>

<body>
     <h1>Form Ubah Data User</h1>
     <br>
     <form action="" method="post">
          <?php foreach ($rowsuser as $rowuser) : ?>
               <table>
                    <tr>
                         <td>Nama Lengkap</td>
                         <td><input type="text" name="fullname" id="fullname" value="<?php echo $rowuser['fullname'] ?>"></td>
                    </tr>
                    <tr>
                         <td>Username</td>
                         <td><input type="text" name="username" id="username" value="<?php echo $rowuser['username'] ?>"></td>
                    </tr>
                    <tr>
                         <td>Nomor Telepon</td>
                         <td><input type="text" name="nomortelepon" id="nomortelepon" value="<?php echo $rowuser['nomortelepon'] ?>"></td>
                    </tr>
                    <tr>
                         <td>Role</td>
                         <td><input type="text" name="role" id="role" value="<?php echo $rowuser['role'] ?>"></td>
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