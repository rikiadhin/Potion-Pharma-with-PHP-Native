<?php

session_start();
if (!isset($_SESSION["login"])) {
     header("Location: login.php");
     exit;
}

require 'obat/functions_obat.php';
require 'pesanan/functions_pesanan.php';
$nama = $_SESSION["username"];
// $rowsobat = queryObat("SELECT * FROM tb_obat");
// $rows = queryPesanan("SELECT * FROM tb_pesanan");


$datatoko = mysqli_query($conn, "SELECT * FROM tb_toko INNER JOIN tb_user ON tb_toko.usernameUser = '$nama'");
$datapesanan = mysqli_query($conn, "SELECT * FROM tb_obat 
INNER JOIN tb_pesanan ON tb_obat.id_obat = tb_pesanan.id_obat
INNER JOIN tb_toko ON tb_obat.id_toko = tb_toko.id_toko WHERE tb_toko.usernameUser = '$nama'");

$dataobat = mysqli_query($conn, "SELECT * FROM tb_obat 
    INNER JOIN tb_toko ON tb_obat.id_toko = tb_toko.id_toko 
    INNER JOIN tb_kemasan ON tb_obat.id_kemasan = tb_kemasan.id_kemasan 
    INNER JOIN tb_dosis ON tb_obat.id_dosis = tb_dosis.id_dosis 
    INNER JOIN tb_penyajian ON tb_obat.id_penyajian = tb_penyajian.id_penyajian 
    INNER JOIN tb_golongan ON tb_obat.id_golongan = tb_golongan.id_golongan 
    INNER JOIN tb_bentukobat ON tb_obat.id_bentuk = tb_bentukobat.id_bentuk WHERE tb_toko.usernameUser = '$nama'");

$penjual = mysqli_fetch_assoc($datatoko);

?>

<!DOCTYPE html>
<html lang="en">

<head>
     <title>Pharma </title>
     <meta charset="utf-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
     <link href="https://fonts.googleapis.com/css?family=Rubik:400,700|Crimson+Text:400,400i" rel="stylesheet" />
     <link rel="stylesheet" href="fonts/icomoon/style.css" />
     <link rel="stylesheet" href="css/bootstrap.min.css" />
     <link rel="stylesheet" href="css/magnific-popup.css" />
     <link rel="stylesheet" href="css/jquery-ui.css" />
     <link rel="stylesheet" href="css/owl.carousel.min.css" />
     <link rel="stylesheet" href="css/owl.theme.default.min.css" />
     <link rel="stylesheet" href="css/aos.css" />
     <link rel="stylesheet" href="css/style.css" />
</head>

<body>
     <div class="site-wrap">
          <div class="site-navbar py-2">
               <div class="search-wrap">
                    <div class="container">
                         <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
                         <form action="#" method="post">
                              <input type="text" class="form-control" placeholder="Search keyword and hit enter..." />
                         </form>
                    </div>
               </div>
               <div class="container">
                    <div class="d-flex align-items-center justify-content-between">
                         <div class="logo">
                              <div class="site-logo">
                                   <a href="dashboard_penjual.php" class="js-logo-clone">Pharma</a>
                              </div>
                         </div>
                         <div class="main-nav d-none d-lg-block">
                              <nav class="site-navigation text-right text-md-center" role="navigation">
                                   <ul class="site-menu js-clone-nav d-none d-lg-block">
                                        <li class="active"><a href="dashboard_penjual.php">Home</a></li>
                                        <li><a href="shop.php">Store</a></li>
                                        <li class="has-children">
                                             <a href="#">Kategori</a>
                                             <ul class="dropdown">
                                                  <li><a href="#">Supplements</a></li>
                                                  <li class="has-children">
                                                       <a href="#">Vitamins</a>
                                                       <ul class="dropdown">
                                                            <li><a href="#">Supplements</a></li>
                                                            <li><a href="#">Vitamins</a></li>
                                                            <li><a href="#">Diet &amp; Nutrition</a></li>
                                                            <li><a href="#">Tea &amp; Coffee</a></li>
                                                       </ul>
                                                  </li>
                                                  <li><a href="#">Diet &amp; Nutrition</a></li>
                                                  <li><a href="#">Tea &amp; Coffee</a></li>
                                             </ul>
                                        </li>
                                        <li><a href="about.php">About</a></li>
                                        <li><a href="contact.php">Contact</a></li>
                                        <li>
                                             <div class="icons">
                                                  <a href="#" class="icons-btn d-inline-block js-search-open"><span class="icon-search"></span></a>
                                                  <a href="cart.php" class="icons-btn d-inline-block bag">
                                                       <span class="icon-shopping-bag"></span>
                                                       <!-- <span class="number">2</span> -->
                                                  </a>
                                                  <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span class="icon-menu"></span></a>
                                             </div>
                                        </li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li class="has-children">
                                             <a><?php echo $_SESSION["username"] ?></a>
                                             <ul class="dropdown">
                                                  <li><a href="profile/profile_penjual.php">Profile</a></li>
                                                  <li><a href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar ?')">Log
                                                            out</a></li>
                                             </ul>
                                        </li>
                                   </ul>
                              </nav>
                         </div>
                    </div>
                    <br>
                    <div class="row">
                         <div class="col-lg-12 col-md-12">
                              <button type="button" class="btn btn-secondary btn-md dropdown-toggle px-4" id="dropdownMenuReference" data-toggle="dropdown">Reference</button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                   <a class="dropdown-item" href="dashboard-penjual/data_pesanan.php">Data Pesanan</a>
                                   <a class="dropdown-item" href="dashboard-penjual/data_obat.php">Data Obat</a>
                              </div>
                         </div>
                    </div>
                    <br>
                    <div class="row">
                         <div class="col-lg-12 col-md-12 text-center">
                              <button type="button" class="btn btn-primary btn-md px-4" id="dropdownMenuReference">
                                   <?php echo 'TOKO ', $penjual["namatoko"]; ?>
                                   <br>
                                   <?php echo $penjual["alamat"]; ?>
                              </button>
                         </div>
                    </div>
                    <br>
                    <h5> <?php  ?></h5>
                    <div class="col-12">
                         <div class="card table-card review-card">
                              <div class="card-header borderless">
                                   <h3>Data Pesanan</h3>
                              </div>
                              <div class="card-body pb-0">
                                   <div class="review-block">
                                        <div class="row">
                                             <div class="col">
                                                  <form action="" method="post">
                                                       <input type="text" name="keywordpenjual" id="keywordpenjual" autofocus placeholder="Masukkan kata kunci...">
                                                       <button type="submit" name="cari">Cari</button>
                                                  </form>
                                                  <br>
                                                  <div class="card-body table-border-style">
                                                       <div class="table-responsive">
                                                            <table border="1" cellpadding=10 cellspacing=0>
                                                                 <thead class="table-dark" color>
                                                                      <th>No</th>
                                                                      <th>Username</th>
                                                                      <th>Kode Obat</th>
                                                                      <th>Jumlah</th>
                                                                      <th>Harga</th>
                                                                      <th>Tanggal</th>
                                                                      <th>Status</th>
                                                                      <th>Tindakan</th>
                                                                 </thead>
                                                                 <tbody>
                                                                      <?php foreach ($datapesanan as $row) : ?>
                                                                           <tr>
                                                                                <td class="table-info">
                                                                                     <?php echo $row["id_pesanan"] ?>
                                                                                </td>
                                                                                <td class="table-success">
                                                                                     <?php echo $row["username"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php echo $row["id_obat"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php echo $row["jumlah"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php echo $row["harga"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php echo $row["waktu"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php echo $row["status"] ?>
                                                                                </td>
                                                                                <td class="table-primary">
                                                                                     <a href="pesanan/hapus_pesanan.php?id= <?php echo $row["id_pesanan"] ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ?')"><button class="btn btn-danger">Hapus
                                                                                               Data</button></a>
                                                                                </td>
                                                                           </tr>
                                                                      <?php endforeach; ?>
                                                                 </tbody>
                                                            </table>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>

                                   </div>
                              </div>
                         </div>
                    </div>
                    <br>
                    <br>
                    <div class="col-lg-12 col-md-12">
                         <div class="card table-card review-card">
                              <div class="card-header ">
                                   <h3>Data Obat</h3>
                              </div>
                              <div class="card-body pb-0">
                                   <div class="review-block">
                                        <div class="row">
                                             <div class="col">
                                                  <!-- tempat tabel -->
                                                  <a href="obat/tambah_obat.php"><button class="btn btn-success">Tambah
                                                            Data</button></a>
                                                  <br>
                                                  <br>
                                                  <form action="" method="post">
                                                       <input type="text" name="keywordobat" id="keywordobat" autofocus placeholder="Masukkan kata kunci...">
                                                       <button type="submit" name="cari">Cari</button>
                                                  </form>
                                                  <br>
                                                  <div class="card-body table-border-style">
                                                       <div class="table-responsive">
                                                            <table border="1" cellpadding=10 cellspacing=0>
                                                                 <thead class="table-dark">
                                                                      <th>Kode Obat</th>
                                                                      <th>Nama Obat</th>
                                                                      <th>Nama Standar MIMS</th>
                                                                      <th>Deskripsi</th>
                                                                      <th>Manfaat</th>
                                                                      <th>Jumlah Kemasan</th>
                                                                      <th>Kemasan</th>
                                                                      <th>Dosis</th>
                                                                      <th>Penyajian</th>
                                                                      <th>Golongan</th>
                                                                      <th>Bentuk</th>
                                                                      <th>Nomor Izin Edar</th>
                                                                      <th>Komposisi</th>
                                                                      <th>Jumlah Stok</th>
                                                                      <th>Expired</th>
                                                                      <th>Harga</th>
                                                                      <th>Referensi</th>
                                                                      <th>Tindakan</th>
                                                                 </thead>
                                                                 <tbody>
                                                                      <?php foreach ($dataobat as $obat) : ?>
                                                                           <tr>
                                                                                <td class="table-info">
                                                                                     <?php echo $obat["id_obat"] ?>
                                                                                </td>
                                                                                <td class="table-success">
                                                                                     <?php echo $obat["nama_obat"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php echo $obat["nama_standar_MIMS"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php echo $obat["deskripsi"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php echo $obat["manfaat"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php echo $obat["jumlah_kemasan"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php echo $obat["kemasan"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php echo $obat["dosis"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php echo $obat["penyajian"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php echo $obat["golongan"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php echo $obat["bentuk"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php echo $obat["nomor_izin_edar"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php echo $obat["komposisi"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php echo $obat["jumlah_stok"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php echo $obat["expired"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php echo $obat["harga"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php echo $obat["referensi"] ?>
                                                                                </td>
                                                                                <td class="table-primary">
                                                                                     <a href="obat/ubah_obat.php?id=<?php echo $obat["id_obat"] ?>"><button class="btn btn-success">Ubah
                                                                                               Data</button></a>
                                                                                     <a href="obat/hapus_obat.php?id= <?php echo $obat["id_obat"] ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ?')"><button class="btn btn-danger">Hapus
                                                                                               Data</button></a>
                                                                                </td>
                                                                           </tr>
                                                                      <?php endforeach; ?>
                                                                 </tbody>
                                                            </table>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>

                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <script src="js/jquery-3.3.1.min.js"></script>
     <script src="js/jquery-ui.js"></script>
     <script src="js/popper.min.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/jquery.magnific-popup.min.js"></script>
     <script src="js/aos.js"></script>
</body>

</html>