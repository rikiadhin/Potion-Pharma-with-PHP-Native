<?php

session_start();
if(!isset($_SESSION["login"])){
	header("Location: login.php");
	exit;
}

require '../pesanan/functions_pesanan.php';

$rows = queryPesanan("SELECT * FROM tb_pemesanan");
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <title>Pharma </title>
     <meta charset="utf-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
     <link href="../https://fonts.googleapis.com/css?family=Rubik:400,700|Crimson+Text:400,400i" rel="stylesheet" />
     <link rel="stylesheet" href="../fonts/icomoon/style.css" />
     <link rel="stylesheet" href="../css/bootstrap.min.css" />
     <link rel="stylesheet" href="../css/magnific-popup.css" />
     <link rel="stylesheet" href="../css/jquery-ui.css" />
     <link rel="stylesheet" href="../css/owl.carousel.min.css" />
     <link rel="stylesheet" href="../css/owl.theme.default.min.css" />
     <link rel="stylesheet" href="../css/aos.css" />
     <link rel="stylesheet" href="../css/style.css" />
</head>

<body>
     <div class="site-wrap">
          <div class="site-navbar py-2">
               <div class="search-wrap">
                    <div class="container">
                         <a href="../#" class="search-close js-search-close"><span class="icon-close2"></span></a>
                         <form action="#" method="post">
                              <input type="text" class="form-control" placeholder="Search keyword and hit enter..." />
                         </form>
                    </div>
               </div>
               <div class="container">
                    <div class="d-flex align-items-center justify-content-between">
                         <div class="logo">
                              <div class="site-logo">
                                   <a href="../dashboard_penjual.php" class="js-logo-clone">Pharma</a>
                              </div>
                         </div>
                         <div class="main-nav d-none d-lg-block">
                              <nav class="site-navigation text-right text-md-center" role="navigation">
                                   <ul class="site-menu js-clone-nav d-none d-lg-block">
                                        <li class="active"><a href="../dashboard_penjual.php">Home</a></li>
                                        <li><a href="../shop.html">Store</a></li>
                                        <li class="has-children">
                                             <a href="../#">Dropdown</a>
                                             <ul class="dropdown">
                                                  <li><a href="../#">Supplements</a></li>
                                                  <li class="has-children">
                                                       <a href="../#">Vitamins</a>
                                                       <ul class="dropdown">
                                                            <li><a href="../#">Supplements</a></li>
                                                            <li><a href="../#">Vitamins</a></li>
                                                            <li><a href="../#">Diet &amp; Nutrition</a></li>
                                                            <li><a href="../#">Tea &amp; Coffee</a></li>
                                                       </ul>
                                                  </li>
                                                  <li><a href="../#">Diet &amp; Nutrition</a></li>
                                                  <li><a href="../#">Tea &amp; Coffee</a></li>
                                             </ul>
                                        </li>
                                        <li><a href="../about.html">About</a></li>
                                        <li><a href="../contact.html">Contact</a></li>
                                        <li>
                                             <div class="icons">
                                                  <a href="../#" class="icons-btn d-inline-block js-search-open"><span
                                                            class="icon-search"></span></a>
                                                  <a href="../cart.html" class="icons-btn d-inline-block bag">
                                                       <span class="icon-shopping-bag"></span>
                                                       <!-- <span class="number">2</span> -->
                                                  </a>
                                                  <a href="../#"
                                                       class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span
                                                            class="icon-menu"></span></a>
                                             </div>
                                        </li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li class="has-children">
                                             <a><?php echo $_SESSION["username"]?></a>
                                             <ul class="dropdown">
                                                  <li><a href="../logout.php"
                                                            onclick="return confirm('Apakah anda yakin ingin keluar ?')">Log
                                                            out</a></li>
                                             </ul>
                                        </li>
                                   </ul>
                              </nav>
                         </div>
                    </div>
                    <br>
                    <div class="row">
                         <div class="col-lg-6">
                              <button type="button" class="btn btn-secondary btn-md dropdown-toggle px-4"
                              id="dropdownMenuReference" data-toggle="dropdown">Reference</button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                   <a class="dropdown-item" href="data_pesanan.php">Data Pesanan</a>
                                   <a class="dropdown-item" href="data_obat.php">Data Obat</a>
                              </div>
                         </div>
                    </div>
                    <br>
                    <div class="col-lg-12 col-md-12">
                         <div class="card table-card review-card">
                              <div class="card-header borderless">
                                   <h3>Data Pesanan</h3>
                              </div>
                              <div class="card-body pb-0">
                                   <div class="review-block">
                                        <div class="row">
                                             <div class="col">
                                                  <form action="" method="post">
                                                       <input type="text" name="keywordpenjual" id="keywordpenjual"
                                                            autofocus placeholder="Masukkan kata kunci...">
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
                                                                      <th>Tanggal</th>
                                                                      <th>Tindakan</th>
                                                                 </thead>
                                                                 <tbody>
                                                                      <?php foreach ($rows as $row) : ?>
                                                                      <tr>
                                                                           <td class="table-info">
                                                                                <?php echo $row["id_jual"] ?>
                                                                           </td>
                                                                           <td class="table-success">
                                                                                <?php echo $row["username"] ?>
                                                                           </td>
                                                                           <td class="table-warning">
                                                                                <?php echo $row["idobat"] ?>
                                                                           </td>
                                                                           <td class="table-warning">
                                                                                <?php echo $row["tanggal"] ?>
                                                                           </td>
                                                                           <td class="table-primary">
                                                                                <a href="../pesanan/hapus_pesanan.php?id= <?php echo $row["id_jual"] ?>"
                                                                                     onclick="return confirm('Apakah anda yakin akan menghapus data ?')"><button
                                                                                          class="btn btn-danger">Hapus
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

     <script src="../js/jquery-3.3.1.min.js"></script>
     <script src="../js/jquery-ui.js"></script>
     <script src="../js/popper.min.js"></script>
     <script src="../js/bootstrap.min.js"></script>
     <script src="../js/owl.carousel.min.js"></script>
     <script src="../js/jquery.magnific-popup.min.js"></script>
     <script src="../js/aos.js"></script>
</body>

</html>