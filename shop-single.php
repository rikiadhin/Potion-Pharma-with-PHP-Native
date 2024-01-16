<?php

session_start();
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

date_default_timezone_set('Asia/Jakarta');
require 'obat/functions_obat.php';

$username =   $_SESSION["username"];
$rowspesan = queryObat("SELECT * FROM tb_keranjang WHERE username = '$username'");

$selected_obat_id = $_SESSION["id_obat"];
$selected_obat_query = mysqli_query($conn, "SELECT * FROM tb_obat 
    INNER JOIN tb_toko ON tb_obat.id_toko = tb_toko.id_toko 
    INNER JOIN tb_kemasan ON tb_obat.id_kemasan = tb_kemasan.id_kemasan 
    INNER JOIN tb_dosis ON tb_obat.id_dosis = tb_dosis.id_dosis 
    INNER JOIN tb_penyajian ON tb_obat.id_penyajian = tb_penyajian.id_penyajian 
    INNER JOIN tb_golongan ON tb_obat.id_golongan = tb_golongan.id_golongan 
    INNER JOIN tb_bentukobat ON tb_obat.id_bentuk = tb_bentukobat.id_bentuk WHERE tb_obat.id_obat = '$selected_obat_id'");
$selected_obat = mysqli_fetch_assoc($selected_obat_query);

if (isset($_POST["addtocart"])) {

  $username =   $_SESSION["username"];
  $id_obat =   $selected_obat["id_obat"];
  $gambar =   $selected_obat["gambar"];
  $nama_obat =   $selected_obat["nama_obat"];
  $jumlah =   $_POST["jumlah"];
  $harga =   $selected_obat["harga"];
  $timestamp = time();
  $timestampFormatted = date('Y-m-d H:i:s', $timestamp);

  mysqli_query($conn, "INSERT INTO tb_keranjang VALUES('', '$username', '$id_obat', '$gambar', '$nama_obat', '$jumlah', '$harga')");
  mysqli_query($conn, "INSERT INTO tb_pesanan VALUES('', '$username', '$id_obat', '$jumlah', '$harga', '$timestampFormatted', 'Add to keranjang')");
  $rowsAffected = mysqli_affected_rows($conn);

  if ($rowsAffected > 0) {
    echo "
          <script>
          alert('Selamat. Data BERHASIL ditambahkan ke keranjang');
          document.location.href = 'cart.php';
          </script> 
          ";
  } else {
    echo
    "<script>
          alert('Maaf. Data GAGAL ditambahkan ke keranjang');
          document.location.href = 'cart.php';
          </script> 
          ";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Pharma &mdash; Colorlib Template</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Rubik:400,700|Crimson+Text:400,400i" rel="stylesheet">
  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">


  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/style.css">

</head>

<body>

  <div class="site-wrap">


    <div class="site-navbar py-2">

      <div class="search-wrap">
        <div class="container">
          <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
          <form action="#" method="post">
            <input type="text" class="form-control" placeholder="Search keyword and hit enter...">
          </form>
        </div>
      </div>

      <div class="container">
        <div class="d-flex align-items-center justify-content-between">
          <div class="logo">
            <div class="site-logo">
              <a href="dashboard.php" class="js-logo-clone">Pharma</a>
            </div>
          </div>
          <div class="main-nav d-none d-lg-block">
            <nav class="site-navigation text-right text-md-center" role="navigation">
              <ul class="site-menu js-clone-nav d-none d-lg-block">
                <li class="active"><a href="dashboard.php">Home</a></li>
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
              </ul>
            </nav>
          </div>
          <div class="icons">
            <a href="#" class="icons-btn d-inline-block js-search-open"><span class="icon-search"></span></a>
            <a href="cart.php" class="icons-btn d-inline-block bag">
              <span class="icon-shopping-bag"></span>
              <?php foreach ($rowspesan as $rowobat) : ?>
                <?php $jumlahdatakeranjang = count($rowobat); ?>
              <?php endforeach; ?>
              <span class="number"><?php echo $jumlahdatakeranjang; ?></span>
            </a>
            <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span class="icon-menu"></span></a>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="dashboard.php">Home</a> <span class="mx-2 mb-0">/</span> <a href="shop.php">Store</a> <span class="mx-2 mb-0">/</span> <strong class="text-black"><?php echo $selected_obat["nama_obat"] ?></strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <form action="" method="post">
          <div class="row">
            <div class="col-md-5">
              <div class="border text-center">
                <img name="gambar" src="images/<?php echo $selected_obat["gambar"] ?>" alt="Image" class="img-fluid p-5" width="1000" style="background-color: grey ; ">
              </div>
            </div>
            <div class="col-md-6">
              <h2 name="nama_obat" class="text-black"><?php echo $selected_obat["nama_obat"] ?></h2>
              <h5> <?php   ?></h5>
              <p><?php echo $selected_obat["deskripsi"] ?></p>


              <p name="harga"><del>$95.00</del> <strong class="text-primary h4"><?php echo $selected_obat["harga"] ?></strong></p>
              <div class="mb-3 mr-3">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                  </div>
                  <input type="text" name="jumlah" class="form-control text-center" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">

                  <div class="input-group-append">
                    <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                  </div>
                  <a href="cart.php"><button class="btn btn-primary height-auto ml-4 mr-5" name="addtocart" type="submit">Add To Cart</button></a>
                </div>
              </div>

              <div class="mt-1">
                <ul class="nav nav-pills mb-3 custom-pill" id="pills-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Ordering Information</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Specifications</a>
                  </li>

                </ul>
                <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <table class="table custom-table">
                      <thead>
                        <th style="font-weight: bold;">Material</th>
                        <th style="font-weight: bold;">Description</th>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">Jumlah Stok</th>
                          <td><?php echo $selected_obat["jumlah_stok"] ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Expired</th>
                          <td><?php echo $selected_obat["expired"] ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Dosis</th>
                          <td><?php echo $selected_obat["dosis"] ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Nomor Izin Edar</th>
                          <td><?php echo $selected_obat["nomor_izin_edar"] ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Komposisi</th>
                          <td><?php echo $selected_obat["komposisi"] ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <table class="table custom-table">
                      <tbody>
                        <tr>
                          <th scope="row">Golongan</th>
                          <td class="bg-light"><?php echo $selected_obat["golongan"] ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Bentuk</th>
                          <td class="bg-light"><?php echo $selected_obat["bentuk"] ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Kemasan</th>
                          <td class="bg-light"><?php echo $selected_obat["kemasan"] ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Penyajian</th>
                          <td class="bg-light"><?php echo $selected_obat["penyajian"] ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Manfaat</th>
                          <td class="bg-light"><?php echo $selected_obat["manfaat"] ?></td>
                        </tr>
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>


            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="site-section bg-secondary bg-image" style="background-image: url('images/bg_2.jpg');">
      <div class="container">
        <div class="row align-items-stretch">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_1.jpg');">
              <div class="banner-1-inner align-self-center">
                <h2>Pharma Products</h2>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad minus rem odio voluptatem.
                </p>
              </div>
            </a>
          </div>
          <div class="col-lg-6 mb-5 mb-lg-0">
            <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_2.jpg');">
              <div class="banner-1-inner ml-auto  align-self-center">
                <h2>Rated by Experts</h2>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad minus rem odio voluptatem.
                </p>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>


    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">

            <div class="block-7">
              <h3 class="footer-heading mb-4">About Us</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius quae reiciendis distinctio voluptates
                sed dolorum excepturi iure eaque, aut unde.</p>
            </div>

          </div>
          <div class="col-lg-3 mx-auto mb-5 mb-lg-0">
            <h3 class="footer-heading mb-4">Quick Links</h3>
            <ul class="list-unstyled">
              <li><a href="#">Supplements</a></li>
              <li><a href="#">Vitamins</a></li>
              <li><a href="#">Diet &amp; Nutrition</a></li>
              <li><a href="#">Tea &amp; Coffee</a></li>
            </ul>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="block-5 mb-5">
              <h3 class="footer-heading mb-4">Contact Info</h3>
              <ul class="list-unstyled">
                <li class="address">203 Fake St. Mountain View, San Francisco, California, USA</li>
                <li class="phone"><a href="tel://23923929210">+2 392 3929 210</a></li>
                <li class="email">emailaddress@domain.com</li>
              </ul>
            </div>


          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <p>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              Copyright &copy;
              <script>
                document.write(new Date().getFullYear());
              </script> All rights reserved | This template is made
              with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" class="text-primary">Colorlib</a>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
          </div>

        </div>
      </div>
    </footer>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>

</body>

</html>