<?php

session_start();
if (!isset($_SESSION["login"])) {
     header("Location: login.php");
     exit;
}
require 'obat/functions_obat.php';
require 'tabel_user/functions_user.php';

$rowsobat = queryObat("SELECT * FROM tb_obat");
$rowsuser = queryUser("SELECT * FROM tb_user");

if (isset($POST["cari"])) {
     $keywordpenjual = $_POST["keywordpenjual"];
     $rowspenjual = ($keywordpenjual);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <title>Dashboard Admin</title>
     <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
     <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
     <!--[if lt IE 11]>
    	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
     <!-- Meta -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <meta name="description" content="" />
     <meta name="keywords" content="">
     <meta name="author" content="Phoenixcoded" />
     <!-- Favicon icon -->
     <link rel="icon" href="dist/assets/images/favicon.ico" type="image/x-icon">

     <!-- vendor css -->
     <link rel="stylesheet" href="dist/assets/css/style.css">

</head>

<body class="">
     <!-- [ Pre-loader ] start -->
     <div class="loader-bg">
          <div class="loader-track">
               <div class="loader-fill"></div>
          </div>
     </div>
     <!-- [ Pre-loader ] End -->
     <!-- [ navigation menu ] start -->
     <nav class="pcoded-navbar  ">
          <div class="navbar-wrapper  ">
               <div class="navbar-content scroll-div ">

                    <div class="">
                         <div class="main-menu-header">
                              <img class="img-radius" src="dist/assets/images/user/avatar-2.jpg" alt="User-Profile-Image">
                              <div class="user-details">
                                   <span><?php echo $_SESSION["username"] ?></span>
                                   <div id="more-details">Admin<i class="fa fa-chevron-down m-l-5"></i></div>
                              </div>
                         </div>
                         <div class="collapse" id="nav-user-link">
                              <ul class="list-unstyled">
                                   <li class="list-group-item"><a href=""><i class="feather icon-user m-r-5"></i>View Profile</a></li>
                                   <li class="list-group-item"><a href="#!"><i class="feather icon-settings m-r-5"></i>Settings</a></li>
                                   <li class="list-group-item"><a href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar ?')"><i class="feather icon-log-out m-r-5"></i>Logout</a></li>
                              </ul>
                         </div>
                    </div>

                    <ul class="nav pcoded-inner-navbar ">
                         <li class="nav-item pcoded-menu-caption">
                              <label>Navigation</label>
                         </li>
                         <li class="nav-item">
                              <a href="index.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                         </li>
                         <li class="nav-item">
                              <a href="dashboard-admin/data_user.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Data User</span></a>
                         </li>
                         <li class="nav-item">
                              <a href="dashboard-admin/data_toko.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Data Toko</span></a>
                         </li>
                         <li class="nav-item">
                              <a href="dashboard-admin/data_obat.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Data Obat</span></a>
                         </li>
                         <li class="nav-item">
                              <a href="dashboard-admin/data_propembeli.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Data Profil Pembeli</span></a>
                         </li>
                         <li class="nav-item">
                              <a href="dashboard-admin/data_propenjual.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Data Profil Penjual</span></a>
                         </li>

               </div>
          </div>
     </nav>
     <!-- [ navigation menu ] end -->
     <!-- [ Header ] start -->
     <header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">


          <div class="m-header">
               <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
               <a href="#!" class="b-brand">
                    <!-- ========   change your logo hear   ============ -->
                    <img src="dist/assets/images/logo.png" alt="" class="logo">
                    <img src="dist/assets/images/logo-icon.png" alt="" class="logo-thumb">
               </a>
               <a href="#!" class="mob-toggler">
                    <i class="feather icon-more-vertical"></i>
               </a>
          </div>
          <div class="collapse navbar-collapse">
               <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                         <a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
                         <div class="search-bar">
                              <input type="text" class="form-control border-0 shadow-none" placeholder="Search hear">
                              <button type="button" class="close" aria-label="Close">
                                   <span aria-hidden="true">&times;</span>
                              </button>
                         </div>
                    </li>

               </ul>
               <ul class="navbar-nav ml-auto">
                    <li>
                         <div class="dropdown">
                              <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                                   <i class="icon feather icon-bell"></i>
                                   <span class="badge badge-pill badge-danger">1</span>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right notification">
                                   <div class="noti-head">
                                        <h6 class="d-inline-block m-b-0">Notifications</h6>
                                        <div class="float-right">
                                             <a href="#!" class="m-r-10">mark as read</a>
                                             <a href="#!">clear all</a>
                                        </div>
                                   </div>
                                   <ul class="noti-body">
                                        <li class="n-title">
                                             <p class="m-b-0">NEW</p>
                                        </li>
                                        <li class="notification">
                                             <div class="media">
                                                  <img class="img-radius" src="dist/assets/images/user/avatar-1.jpg" alt="Generic placeholder image">
                                                  <div class="media-body">
                                                       <p><strong><?php $_SESSION["username"] ?></strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>5
                                                                 min</span></p>
                                                       <p>New ticket Added</p>
                                                  </div>
                                             </div>
                                        </li>
                                        <li class="n-title">
                                             <p class="m-b-0">EARLIER</p>
                                        </li>
                                        <li class="notification">
                                             <div class="media">
                                                  <img class="img-radius" src="dist/assets/images/user/avatar-2.jpg" alt="Generic placeholder image">
                                                  <div class="media-body">
                                                       <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>10
                                                                 min</span></p>
                                                       <p>Prchace New Theme and make payment</p>
                                                  </div>
                                             </div>
                                        </li>
                                        <li class="notification">
                                             <div class="media">
                                                  <img class="img-radius" src="dist/assets/images/user/avatar-1.jpg" alt="Generic placeholder image">
                                                  <div class="media-body">
                                                       <p><strong>Sara Soudein</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>12
                                                                 min</span></p>
                                                       <p>currently login</p>
                                                  </div>
                                             </div>
                                        </li>
                                        <li class="notification">
                                             <div class="media">
                                                  <img class="img-radius" src="dist/assets/images/user/avatar-2.jpg" alt="Generic placeholder image">
                                                  <div class="media-body">
                                                       <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30
                                                                 min</span></p>
                                                       <p>Prchace New Theme and make payment</p>
                                                  </div>
                                             </div>
                                        </li>
                                   </ul>
                                   <div class="noti-footer">
                                        <a href="#!">show all</a>
                                   </div>
                              </div>
                         </div>
                    </li>
                    <li>
                         <div class="dropdown drp-user">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                   <i class="feather icon-user"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right profile-notification">
                                   <div class="pro-head">
                                        <img src="dist/assets/images/user/avatar-2.jpg" class="img-radius" alt="User-Profile-Image">
                                        <span><?php echo $_SESSION["username"] ?></span>
                                        <a href="logout.php" class="dud-logout" title="Logout" onclick="return confirm('Apakah anda yakin ingin keluar ?')">
                                             <i class="feather icon-log-out"></i>
                                        </a>
                                   </div>
                                   <ul class="pro-body">
                                        <li><a href="" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
                                        <li><a href="" class="dropdown-item"><i class="feather icon-mail"></i> My Messages</a></li>
                                        <li><a href="" class="dropdown-item"><i class="feather icon-lock"></i> Lock Screen</a></li>
                                   </ul>
                              </div>
                         </div>
                    </li>
               </ul>
          </div>


     </header>
     <!-- [ Header ] end -->



     <!-- [ Main Content ] start -->
     <div class="pcoded-main-container">
          <div class="pcoded-content">
               <!-- [ breadcrumb ] start -->
               <div class="page-header">
                    <div class="page-block">
                         <div class="row align-items-center">
                              <div class="col-md-12">
                                   <div class="page-header-title">
                                        <h5 class="m-b-10">Dashboard Analytics</h5>
                                   </div>
                                   <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                                        <li class="breadcrumb-item"><a href="#!">Dashboard Analytics</a></li>
                                   </ul>
                              </div>
                         </div>
                    </div>
               </div>
               <!-- [ breadcrumb ] end -->
               <!-- [ Main Content ] start -->
               <div class="row">
                    <!-- jangan dihapus Latest Customers start -->
                    <div class="col-lg-12 col-md-12">
                         <div class="card table-card review-card">
                              <div class="card-header borderless ">

                                   <h3>Data User</h3>
                                   <div class="card-header-right">
                                        <div class="btn-group card-option">
                                             <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <i class="feather icon-more-horizontal"></i>
                                             </button>
                                             <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                                  <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i>
                                                                 maximize</span><span style="display:none"><i class="feather icon-minimize"></i>
                                                                 Restore</span></a></li>
                                                  <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i>
                                                                 collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a>
                                                  </li>
                                                  <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                                  <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                                             </ul>
                                        </div>
                                   </div>
                              </div>
                              <div class="card-body pb-0">
                                   <div class="review-block">
                                        <div class="row">
                                             <div class="col">
                                                  <!-- tempat tabel -->
                                                  <a href="tabel_user/tambah_user.php"><button class="btn btn-success">Tambah Data</button></a>
                                                  <br>
                                                  <br>
                                                  <form action="" method="post">
                                                       <input type="text" name="keyworduser" id="keyworduser" autofocus placeholder="Masukkan kata kunci...">
                                                       <button type="submit" name="cari">Cari</button>
                                                  </form>
                                                  <br>
                                                  <div class="card-body table-border-style">
                                                       <div class="table-responsive">
                                                            <table border="1" cellpadding=10 cellspacing=0>
                                                                 <thead class="table-dark">
                                                                      <th>No</th>
                                                                      <th>Nama Lengkap</th>
                                                                      <th>Email</th>
                                                                      <th>Nomor Telepon</th>
                                                                      <th>Role</th>
                                                                      <th>Tindakan</th>
                                                                 </thead>
                                                                 <tbody>
                                                                      <?php foreach ($rowsuser as $rowuser) : ?>
                                                                           <tr>
                                                                                <td class="table-info">
                                                                                     <?php echo $rowuser["id"] ?>
                                                                                </td>
                                                                                <td class="table-success">
                                                                                     <?php echo $rowuser["fullname"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php echo $rowuser["username"] ?>
                                                                                </td>
                                                                                <td class="table-info">
                                                                                     <?php echo $rowuser["nomortelepon"] ?>
                                                                                </td>
                                                                                <td class="table-secondary">
                                                                                     <?php echo $rowuser["role"] ?>
                                                                                </td>
                                                                                <td class="table-primary">
                                                                                     <a href="tabel_user/ubah_user.php?id= <?php echo $rowuser["id"] ?>"><button class="btn btn-success">Ubah
                                                                                               Data</button></a>
                                                                                     <a href="tabel_user/hapus_user.php?id= <?php echo $rowuser["id"] ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ? ')"><button class="btn btn-danger">Hapus
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
                                                                      <th>No</th>
                                                                      <th>Kode Obat</th>
                                                                      <th>Nama Obat</th>
                                                                      <th>Nama Standar MIMS</th>
                                                                      <th>Deskripsi</th>
                                                                      <th>Manfaat</th>
                                                                      <th>Jumlah Kemasan</th>
                                                                      <th>Dosis</th>
                                                                      <th>Penyajian</th>
                                                                      <th>Golongan</th>
                                                                      <th>Bentuk</th>
                                                                      <th>Nomor Izin Edar</th>
                                                                      <th>Komposisi</th>
                                                                      <th>Jumlah Stok</th>
                                                                      <th>Expired</th>
                                                                      <th>Harga Obat</th>
                                                                      <th>Referensi</th>
                                                                      <th>Tindakan</th>
                                                                 </thead>
                                                                 <tbody>
                                                                      <?php foreach ($rowsobat as $rowobat) : ?>
                                                                           <tr>
                                                                                <td width=" 20px" class="table-info">
                                                                                     <?php echo $rowobat["nomor"] ?>
                                                                                </td>
                                                                                <td class="table-success">
                                                                                     <?php echo $rowobat["id_obat"] ?>
                                                                                </td>
                                                                                <td class="table-secondary">
                                                                                     <?php echo $rowobat["nama_obat"] ?>
                                                                                </td>
                                                                                <td class="table-primary">
                                                                                     <?php echo $rowobat["nama_standar_MIMS"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php
                                                                                     if (str_word_count($rowobat["deskripsi"]) > 60) {
                                                                                          echo substr($rowobat["deskripsi"], 0, 50) . "...";
                                                                                     } else {
                                                                                          echo $rowobat["deskripsi"];
                                                                                     }
                                                                                     ?>
                                                                                </td>
                                                                                <td class="table-info">
                                                                                     <?php echo $rowobat["manfaat"] ?>
                                                                                </td>
                                                                                <td class="table-success">
                                                                                     <?php echo $rowobat["jumlah_kemasan"] ?>
                                                                                </td>
                                                                                <td class="table-secondary">
                                                                                     <?php echo $rowobat["id_dosis"] ?>
                                                                                </td>
                                                                                <td class="table-primary">
                                                                                     <?php echo $rowobat["id_penyajian"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php echo $rowobat["id_golongan"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php echo $rowobat["id_bentuk"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php echo $rowobat["nomor_izin_edar"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php
                                                                                     if (strlen($rowobat["komposisi"]) > 30) {
                                                                                          echo substr($rowobat["komposisi"], 0, 20) . "...";
                                                                                     } else {
                                                                                          echo $rowobat["komposisi"];
                                                                                     }
                                                                                     ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php echo $rowobat["jumlah_stok"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php echo $rowobat["expired"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php echo $rowobat["harga"] ?>
                                                                                </td>
                                                                                <td class="table-warning">
                                                                                     <?php
                                                                                     if (strlen($rowobat["referensi"]) > 20) {
                                                                                          echo substr($rowobat["referensi"], 0, 15) . "...";
                                                                                     } else {
                                                                                          echo $rowobat["referensi"];
                                                                                     }
                                                                                     ?>
                                                                                </td>
                                                                                <td class="table-primary">
                                                                                     <a href="obat/ubah_obat.php?id= <?php echo $rowobat["id_obat"] ?>"><button class="btn btn-success">Ubah
                                                                                               Data</button></a>
                                                                                     <a href="obat/hapus_obat.php?id= <?php echo $rowobat["id_obat"] ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ?')"><button class="btn btn-danger">Hapus
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

                    <!-- Latest Customers end -->
               </div>
               <!-- [ Main Content ] end -->
          </div>
     </div>


     <!-- Required Js -->
     <script src="dist/assets/js/vendor-all.min.js"></script>
     <script src="dist/assets/js/plugins/bootstrap.min.js"></script>
     <script src="dist/assets/js/pcoded.min.js"></script>

     <!-- Apex Chart -->
     <script src="dist/assets/js/plugins/apexcharts.min.js"></script>


     <!-- custom-chart js -->
     <script src="dist/assets/js/pages/dashboard-main.js"></script>
</body>

</html>