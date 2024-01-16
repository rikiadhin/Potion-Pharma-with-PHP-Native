<?php

require 'functions_pesanan.php';

if (isset($_POST["submit"])) {
     if (tambahPesanan($_POST) > 0) {
          echo "
          <script>
          alert('Selamat. Data BERHASIL ditambahkan');
          document.location.href = '../dashboard_penjual.php';
          </script> 
          ";
     } else {
          echo
          "<script>
          alert('Maaf. Data GAGAL ditambahkan');
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
     <title>Tambah Data Pesanan</title>
</head>

<body>
     <h1>Form Tambah Data Pesanan</h1>
     <br>
     <form action="" method="post">
          <table>
               <tr>
                    <td>Nomor Telepon Pembeli</td>
                    <td><input type="text" name="notep_pembeli" id="notep_pembeli"></td>
               </tr>
               <tr>
                    <td>Kode Obat</td>
                    <td><input type="text" name="idobat" id="idobat"></td>
               </tr>
               <tr>
                    <td>Tanggal Memesan</td>
                    <td><input type="date" name="tanggal" id="tanggal"></td>
               </tr>
               <tr>
                    <td></td>
                    <td><button type="submit" name="submit">Simpan</button></td>
               </tr>
          </table>
     </form>
</body>

</html>