<?php

require 'functions_obat.php';
session_start();

if (!isset($_SESSION["login"])) {
     header("Location: ../login.php");
     exit;
}

$nama = $_SESSION["username"];
$datatoko = mysqli_query($conn, "SELECT * FROM tb_toko INNER JOIN tb_user ON tb_toko.usernameUser = '$nama'");
$penjual = mysqli_fetch_assoc($datatoko);

$dataobat = mysqli_query($conn, "SELECT * FROM tb_obat 
    INNER JOIN tb_toko ON tb_obat.id_toko = tb_toko.id_toko 
    INNER JOIN tb_kemasan ON tb_obat.id_kemasan = tb_kemasan.id_kemasan 
    INNER JOIN tb_dosis ON tb_obat.id_dosis = tb_dosis.id_dosis 
    INNER JOIN tb_penyajian ON tb_obat.id_penyajian = tb_penyajian.id_penyajian 
    INNER JOIN tb_golongan ON tb_obat.id_golongan = tb_golongan.id_golongan 
    INNER JOIN tb_bentukobat ON tb_obat.id_bentuk = tb_bentukobat.id_bentuk WHERE tb_toko.usernameUser = '$nama'");

$datakemasan = mysqli_query($conn, "SELECT * FROM tb_kemasan");
$datadosis = mysqli_query($conn, "SELECT * FROM tb_dosis");
$datapenyajian = mysqli_query($conn, "SELECT * FROM tb_penyajian");
$datagolongan = mysqli_query($conn, "SELECT * FROM tb_golongan");
$databentuk = mysqli_query($conn, "SELECT * FROM tb_bentukobat");


if (isset($_POST["submit"])) {
     if (tambahObat($_POST) > 0) {
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
     <title>Tambah Data Obat</title>
</head>

<body>
     <h1>Form Tambah Data Obat</h1>
     <h5><?php echo 'TOKO : ', $penjual["namatoko"]; ?></h5> 
     <form action="" method="post">
          <table>
               <?php foreach ($databentuk as $obat) : ?>
                    <tr>
                         <td><input type="text" name="id_toko" value="<?php echo $penjual["id_toko"]; ?>"></td>
                    </tr>
                    <tr>
                         <td>File Gambar</td>
                         <td><input type="file" name="gambar" id="gambar"></td>
                    </tr> 
                    <tr>
                         <td>Kode Obat</td>
                         <td><input type="text" name="id_obat" id="id_obat"></td>
                    </tr>
                    <tr>
                         <td>Nama Obat</td>
                         <td><input type="text" name="nama_obat" id="nama_obat"></td>
                    </tr>
                    <tr>
                         <td>Nama Standar MIMS</td>
                         <td><input type="text" name="nama_standar_MIMS" id="nama_standar_MIMS"></td>
                    </tr>
                    <tr>
                         <td>Deskripsi</td>
                         <td><input type="text" name="deskripsi" id="deskripsi"></td>
                    </tr>
                    <tr>
                         <td>Manfaat</td>
                         <td><input type="text" name="manfaat" id="manfaat"></td>
                    </tr>
                    <tr>
                         <td>Jumlah Kemasan</td>
                         <td><input type="text" name="jumlah_kemasan" id="jumlah_kemasan"></td>
                    </tr>
                    <tr>
                         <td>Kemasan</td>
                         <!-- <td><input type="text" name="kemasan" id="kemasan"></td> -->
                         <td><select name="kemasan">
                                   <?php foreach ($datakemasan as $obat) : ?>
                                        <option value='<?php echo $obat["id_kemasan"]; ?>'><?php echo $obat["id_kemasan"]; ?></option>
                                   <?php endforeach; ?>
                              </select></td>
                    </tr>
                    <tr>
                         <td>Dosis</td>
                         <!-- <td><input type="text" name="dosis" id="dosis"></td> -->
                         <td><select name="dosis">
                                   <?php foreach ($datadosis as $obat) : ?>
                                        <option value='<?php echo $obat["id_dosis"]; ?>'><?php echo $obat["id_dosis"]; ?></option>
                                   <?php endforeach; ?>
                              </select></td>
                    </tr>
                    <tr>
                         <td>Penyajian</td>
                         <!-- <td><input type="text" name="penyajian" id="penyajian"></td> -->
                         <td><select name="penyajian">
                                   <?php foreach ($datapenyajian as $obat) : ?>
                                        <option value='<?php echo $obat["id_penyajian"]; ?>'><?php echo $obat["id_penyajian"]; ?></option>
                                   <?php endforeach; ?>
                              </select></td>
                    </tr>
                    <tr>
                         <td>Golongan</td>
                         <!-- <td><input type="text" name="golongan" id="golongan"></td> -->
                         <td><select name="golongan">
                                   <?php foreach ($datagolongan as $obat) : ?>
                                        <option value='<?php echo $obat["id_golongan"]; ?>'><?php echo $obat["id_golongan"]; ?></option>
                                   <?php endforeach; ?>
                              </select></td>
                    </tr>
                    <tr>
                         <td>Bentuk</td>
                         <!-- <td><input type="text" name="bentuk" id="bentuk"></td> -->
                         <td><select name="bentuk">
                                   <?php foreach ($databentuk as $obat) : ?>
                                        <option value='<?php echo $obat["id_bentuk"]; ?>'><?php echo $obat["id_bentuk"]; ?></option>
                                   <?php endforeach; ?>
                              </select></td>
                    </tr>
                    <tr>
                         <td>Nomor Izin Edar</td>
                         <td><input type="text" name="nomor_izin_edar" id="nomor_izin_edar"></td>
                    </tr>
                    <tr>
                         <td>Komposisi</td>
                         <td><input type="text" name="komposisi" id="komposisi"></td>
                    </tr>
                    <tr>
                         <td>Jumlah Stok</td>
                         <td><input type="text" name="jumlah_stok" id="jumlah_stok"></td>
                    </tr>
                    <tr>
                         <td>Expired</td>
                         <td><input type="text" name="expired" id="expired"></td>
                    </tr>
                    <tr>
                         <td>Harga</td>
                         <td><input type="text" name="harga" id="harga"></td>
                    </tr>
                    <tr>
                         <td>Referensi</td>
                         <td><input type="text" name="referensi" id="referensi"></td>
                    </tr>
                    <tr>
                         <td></td>
                         <td><button type="submit" name="submit">Simpan</button></td>
                    </tr>
               <?php endforeach; ?>
          </table>
     </form>
</body>

</html>