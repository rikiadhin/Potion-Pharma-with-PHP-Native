<?php

session_start();
$nama =  $_SESSION["username"];
require '../tabel_user/functions_user.php';
require '../tabel_penjual/function_penjual.php';

$result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$nama'");
$rows = mysqli_fetch_assoc($result);
$id = $rows["id"];

$result1 = mysqli_query($conn, "SELECT * FROM tb_pembeli WHERE username = '$nama'");
$rows1 = mysqli_fetch_assoc($result1);

$result2 = mysqli_query($conn, "SELECT * FROM tb_toko WHERE usernameUser = '$nama'");
$rows2 = mysqli_fetch_assoc($result2);

if (isset($_POST["save"])) {
     if (ubahDataPembeli($_POST) > 0) {
          $username = $_POST['username'];
          $_SESSION["username"] = $username;
          echo "
               <script>
               alert('Data profil berhasil di update'); 
               </script>
          ";
     } else {
          echo mysqli_error($conn);
     }
}

?>

<head>
     <link rel="stylesheet" href="style_penjual.css" />
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" />

</head>

<body style="background-color: orange;">
     <div class="container rounded bg-white mt-5 mb-5">

          <form action="" method="post">
               <div class="container-fluid">
                    <div class="row">
                         <div class="col-md-3 border-right">
                              <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold"><?php echo $nama; ?></span>
                                   <span class="text-black-50"><?php echo $rows1['email']; ?></span><span> </span>
                              </div>
                         </div>

                         <div class="col-md-5 border-right">
                              <div class="p-3 py-5">
                                   <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 class="text-right">Profile Settings</h4>
                                        <h5><?php   ?></h5>
                                   </div>
                                   <div class="row mt-2">
                                        <div class="col-md-6"><label class="labels">Nama Lengkap</label>
                                             <input name="fullname" type="text" class="form-control" placeholder="first name" value="<?php echo $rows['fullname']; ?>">
                                             <input name="id" type="hidden" class="form-control" placeholder="first name" value="<?php echo $rows['id']; ?>">
                                        </div>
                                        <div class="col-md-6"><label class="labels">Username</label>
                                             <input name="username" type="text" class="form-control" value="<?php echo $rows['username']; ?>" placeholder="surname">
                                        </div>
                                   </div>
                                   <div class="row mt-3">
                                        <div class="col-md-12 pb-3"><label class="labels">Mobile Number</label>
                                             <input type="text" class="form-control" placeholder="enter phone number" name="nomortelepon" value="<?php echo $rows['nomortelepon']; ?>">
                                        </div>

                                        <div class="col-md-12"><label class="labels">Email ID</label><input name="email" type="text" class="form-control" placeholder="enter email id" value="<?php echo $rows1['email']; ?>"></div>
                                   </div>
                                   <div class="row mt-3">
                                        <div class="col-md-6"><label class="labels">Country</label><input name="kota" type="text" class="form-control" placeholder="country" value="<?php echo $rows1['kota']; ?>"></div>

                                        <div class="col-md-6"><label class="labels">State/Region</label><input name="provinsi" type="text" class="form-control" placeholder="state" value="<?php echo $rows1['provinsi']; ?>"></div>
                                   </div>
                              </div>
                         </div>

                         <div class="col-md-4">
                              <div class="p-3 py-5">
                                   <div class="d-flex justify-content-between align-items-center experience"><span> </span><span class="btn btn-secondary"> &nbsp;<a style="text-decoration:none; color:white" href="../dashboard_pembeli.php">Kembali</a></span></div>

                                   <div class=" d-flex justify-content-between align-items-center experience"><span><b>Change Password</b></span><span class=" "> </span></div>

                                   <div class="col-md-12"><label class="labels"></label><input name="id" type="hidden" class="form-control" placeholder="Nama Toko" value="<?php echo $rows['id']; ?>"></div> <br>

                                   <div class="col-md-12"><label class="labels">Password Lama</label><input name="password" type="text" class="form-control" placeholder="Password Lama"></div> <br>

                                   <div class="col-md-12"><label class="labels">Password Baru</label><input name="password" type="text" class="form-control" placeholder="Password Baru"></div> <br>

                                   <div class="col-md-12"><label class="labels">Password Baru</label><input name="password" type="text" class="form-control" placeholder="Password Baru"></div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="mt-4 pb-4 text-center">
                    <button class="btn btn-primary profile-button" type="submit" name="save">Save Profile</button>
               </div>
          </form>
          <!-- <form action="" method="post"> -->


          <!-- </form> -->
     </div>
</body>