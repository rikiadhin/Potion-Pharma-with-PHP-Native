<?php

require 'functions_pesanan.php';

$id_jual =  $_GET["id"];
$rows = queryPesanan("SELECT * FROM tb_obat WHERE idobat = $id_jual ");

if (isset($_POST["submit"])) {
     if (buatPesanan($_POST) > 0) {
          echo "
          <script>
          alert('Selamat. Data BERHASIL diubah');
          document.location.href = '../dashboard_penjual.php';
          </script> 
          ";
     } else {
          echo
          "<script>
          alert('Maaf. Data GAGAL diubah');
          document.location.href = '../dashboard_penjual.php';
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
     <title>Ubah Data Pesanan</title>
</head>

<body>
     <h1>Form Ubah Data Pesanan</h1>
     <br>
     <form action="" method="post">
          <?php foreach ($rows as $row) : ?>
               <input type="hidden" name="id_jual" value="<?= $row['id_jual']?>">
               <table>
                    <tr>
                         <td>Nomor Telepon Pembeli</td>
                         <td><input type="text" name="notep_pembeli" id="notep_pembeli" value="<?php echo $row['notep_pembeli'] ?>"></td>
                    </tr>
                    <tr>
                         <td>Kode Obat</td>
                         <td><input type="text" name="idobat" id="idobat" value="<?php echo $row['idobat'] ?>"></td>
                    </tr>
                    <tr>
                         <td>Tanggal</td>
                         <td><input type="date" name="tanggal" id="tanggal" value="<?php echo $row['tanggal'] ?>"></td>
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