<?php

session_start();
if (!isset($_SESSION["login"])) {
     header("Location: login.php");
     exit;
}
require 'obat/functions_obat.php';
require 'pesanan/functions_pesanan.php';

$username =   $_SESSION["username"];
$rowsobat = queryObat("SELECT * FROM tb_keranjang WHERE username = '$username'");

if (isset($_POST["pesan"])) {
     $id_obat =   $_POST["id_obat"];
     $jumlah =   $_POST["jumlah"] + $rowobat["jumlah"];
     $dipesan = "Di Pesan";
     $username =   $_SESSION["username"];
     mysqli_query($conn, "UPDATE tb_pesanan SET jumlah='$jumlah', status='$dipesan' WHERE id_obat='$id_obat' AND username='$username'");
     $pesanobat =  mysqli_affected_rows($conn);
     if ($pesanobat > 0) {
          echo "
          <script>
          alert('Selamat. Pesanan BERHASIL dibuat');
          document.location.href = 'cart.php';
          </script> 
          ";
     } else {
          echo
          "<script>
          alert('Maaf. Pesanan GAGAL dibuat');
          document.location.href = 'cart.php';
          </script> 
          ";
     }
}

if (isset($_POST["hapus"])) {

     $id_obat =   $_POST["id_obat"];
     $username =   $_SESSION["username"];
     mysqli_query($conn, "DELETE FROM tb_keranjang WHERE id_obat='$id_obat' AND username='$username'");
     mysqli_query($conn, "DELETE FROM tb_pesanan WHERE id_obat='$id_obat' AND username='$username'");
     $pesanobat =  mysqli_affected_rows($conn);

     if ($pesanobat > 0) {
          echo "
          <script>
          alert('Selamat. Pesanan BERHASIL dibatalkan');
          document.location.href = 'cart.php';
          </script> 
          ";
     } else {
          echo
          "<script>
          alert('Maaf. Pesanan GAGAL dibatalkan');
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
                                   <a href="dashboard_pembeli.php" class="js-logo-clone">Pharma</a>
                              </div>
                         </div>
                         <div class="main-nav d-none d-lg-block">
                              <nav class="site-navigation text-right text-md-center" role="navigation">
                                   <ul class="site-menu js-clone-nav d-none d-lg-block">
                                        <li><a href="dashboard_pembeli.php">Home</a></li>
                                        <li class="active"><a href="shop.php">Store</a></li>
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
                                   <?php foreach ($rowsobat as $rowobat) : ?>
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
                         <div class="col-md-12 mb-0">
                              <a href="dashboard_pembeli.php">Home</a> <span class="mx-2 mb-0">/</span>
                              <strong class="text-black">Cart</strong>
                         </div>
                    </div>
               </div>
          </div>
          <!-- <div class="site-section">
               <div class="container">
                    <div class="row mb-5">
                         <div class="site-blocks-table">
                              <table class="table table-bordered">
                                   <thead>
                                        <tr>
                                             <th class="product-thumbnail">Image</th>
                                             <th class="product-name">Product</th>
                                             <th class="product-price">Price</th>
                                             <th class="product-quantity">Quantity</th>
                                             <th class="product-remove">Action</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php foreach ($rowsobat as $rowobat) : ?>
                                             <form  action="" method="post">
                                                  <tr>
                                                       <input type="hidden" name="id_obat" value="<?php echo $rowobat["id_obat"] ?>">

                                                       <input type="hidden" name="tanggal" value="date">

                                                       <td class="product-thumbnail">
                                                            <?php echo "<img src='images/$rowobat[gambar]' width='250' height='270' />"; ?>
                                                       </td>
                                                       <td class="product-name">
                                                            <h2 class="h5 text-black"><?php echo $rowobat["nama_obat"] ?></h2>
                                                       </td>
                                                       <td><?php echo $rowobat["harga"] ?></td>
                                                       <td>
                                                            <div class="input-group mb-3" style="max-width: 120px;">
                                                                 <div class="input-group-prepend">
                                                                      <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                                                                 </div>
                                                                 <input name="jumlah" type="text" class="form-control text-center" value="<?php echo $rowobat["jumlah"] ?>" placeholder="<?php echo $rowobat["jumlah"] ?>" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                                                 <div class="input-group-append">
                                                                      <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                                                                 </div>
                                                            </div>
                                                       </td>
                                                       <td>
                                                            <button class="btn btn-primary height-auto btn-sm" type="submit" name="pesan">Pesan</button>
                                                            <button class="btn btn-danger height-auto btn-sm" type="submit" name="hapus">Hapus</button>
                                                       </td>
                                                  </tr>
                                             </form>
                                             <?php endforeach; ?>
                                        </tbody>
                                   </table>
                              </div>
                    </div>

                    <div class="row">
                         <div class="col-md-6">
                              <div class="row mb-5">
                                   <div class="col-md-6 mb-3 mb-md-0">
                                        <button class="btn btn-primary btn-md btn-block">Update Cart</button>
                                   </div>
                                   <div class="col-md-6">
                                        <button class="btn btn-outline-primary btn-md btn-block">Continue
                                             Shopping</button>
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="col-md-12">
                                        <label class="text-black h4" for="coupon">Coupon</label>
                                        <p>Enter your coupon code if you have one.</p>
                                   </div>
                                   <div class="col-md-8 mb-3 mb-md-0">
                                        <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                                   </div>
                                   <div class="col-md-4">
                                        <button class="btn btn-primary btn-md px-4">Apply Coupon</button>
                                   </div>
                              </div>
                         </div>
                         <div class="col-md-6 pl-5">
                              <div class="row justify-content-end">
                                   <div class="col-md-7">
                                        <div class="row">
                                             <div class="col-md-12 text-right border-bottom mb-5">
                                                  <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                             </div>
                                        </div>
                                        <div class="row mb-3">
                                             <div class="col-md-6">
                                                  <span class="text-black">Subtotal</span>
                                             </div>
                                             <div class="col-md-6 text-right">
                                                  <strong class="text-black">$230.00</strong>
                                             </div>
                                        </div>
                                        <div class="row mb-5">
                                             <div class="col-md-6">
                                                  <span class="text-black">Total</span>
                                             </div>
                                             <div class="col-md-6 text-right">
                                                  <strong class="text-black">$230.00</strong>
                                             </div>
                                        </div>

                                        <div class="row">
                                             <div class="col-md-12">
                                                  <button class="btn btn-primary btn-lg btn-block" onclick="window.location='checkout.html'">Proceed To
                                                       Checkout</button>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div> -->
          <div class="site-section">
               <div class="container">
                    <div class="row mb-5">
                         <div class="col-md-12">
                              <div class="site-blocks-table">
                                   <table class="table table-bordered">
                                        <thead>
                                             <tr>
                                                  <th class="product-thumbnail">Image</th>
                                                  <th class="product-name">Product</th>
                                                  <th class="product-price">Price</th>
                                                  <th class="product-quantity">Quantity</th>
                                                  <th class="product-remove">Action</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             <?php foreach ($rowsobat as $rowobat) : ?>
                                                  <form action="" method="post">
                                                       <tr>
                                                            <input type="hidden" name="id_obat" value="<?php echo $rowobat["id_obat"] ?>">
                                                            <input type="hidden" name="tanggal" value="date">

                                                            <td class="product-thumbnail">
                                                                 <?php echo "<img src='images/$rowobat[gambar]' width='250' height='270' />"; ?>
                                                            </td>
                                                            <td class="product-name">
                                                                 <h2 class="h5 text-black"><?php echo $rowobat["nama_obat"] ?></h2>
                                                            </td>
                                                            <td><?php echo $rowobat["harga"] ?></td>
                                                            <td>
                                                                 <div class="input-group mb-3" style="max-width: 120px;">
                                                                      <div class="input-group-prepend">
                                                                           <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                                                                      </div>
                                                                      <input name="jumlah" type="text" class="form-control text-center" value="<?php echo $rowobat["jumlah"] ?>" placeholder="<?php echo $rowobat["jumlah"] ?>" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                                                      <div class="input-group-append">
                                                                           <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                                                                      </div>
                                                                 </div>
                                                            </td>
                                                            <td>
                                                                 <button class="btn btn-primary height-auto btn-sm" type="submit" name="pesan">Pesan</button>
                                                                 <button class="btn btn-danger height-auto btn-sm" type="submit" name="hapus">Hapus</button>
                                                            </td>
                                                       </tr>
                                                  </form>
                                             <?php endforeach; ?>
                                        </tbody>
                                   </table>
                              </div>
                         </div>
                    </div>

                    <div class="row">
                         <div class="col-md-6 mb-3 mb-md-0">
                              <button class="btn btn-primary btn-md btn-block">Update Cart</button>
                         </div>
                         <div class="col-md-6">
                              <button class="btn btn-outline-primary btn-md btn-block">Continue Shopping</button>
                         </div>
                    </div>

                    <div class="row mt-3">
                         <div class="col-md-12">
                              <label class="text-black h4" for="coupon">Coupon</label>
                              <p>Enter your coupon code if you have one.</p>
                         </div>
                         <div class="col-md-8 mb-3 mb-md-0">
                              <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                         </div>
                         <div class="col-md-4">
                              <button class="btn btn-primary btn-md px-4">Apply Coupon</button>
                         </div>
                    </div>
               </div>
          </div>

          <div class="site-section bg-secondary bg-image" style="background-image: url('images/bg_2.jpg');">
               <div class="container">
                    <div class="row align-items-stretch">
                         <div class="col-lg-6 mb-5 mb-lg-0">
                              <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_1.jpg');">
                                   <div class="banner-1-inner align-self-center">
                                        <h2>Pharma Products</h2>
                                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad
                                             minus rem odio voluptatem.
                                        </p>
                                   </div>
                              </a>
                         </div>
                         <div class="col-lg-6 mb-5 mb-lg-0">
                              <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_2.jpg');">
                                   <div class="banner-1-inner ml-auto  align-self-center">
                                        <h2>Rated by Experts</h2>
                                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad
                                             minus rem odio voluptatem.
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
                                   <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius quae reiciendis
                                        distinctio voluptates
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
                                        <li class="address">203 Fake St. Mountain View, San Francisco, California, USA
                                        </li>
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