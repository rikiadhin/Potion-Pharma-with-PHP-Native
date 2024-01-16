<?php

$conn = mysqli_connect('localhost', 'root', '', 'potionpharma_web');

function registrasiPenjual($data)
{

     global $conn;
     $fullname = $data["fullname"];
     $username = strtolower($data["username"]);
     $nomortelepon = $data["nomortelepon"];
     $password = mysqli_escape_string($conn, $data["password"]);
     $password2 = mysqli_escape_string($conn, $data["password2"]);

     $result = mysqli_query($conn, "SELECT username FROM tb_user WHERE username = '$username'");

     if (mysqli_fetch_assoc($result)) {
          echo " <script>
                    alert('Username sudah terdaftar');
               </script>  ";

          return false;
     }

     if ($password != $password2) {
          echo "
               <script>
                    alert('Konfirmasi password tidak sama');
               </script>
               ";

          return false;
     } else {
          $password = password_hash($password, PASSWORD_DEFAULT);
          $result = mysqli_query($conn, "INSERT INTO tb_user VALUES ('', '$fullname', '$username', '$nomortelepon', '$password', 'penjual')");
          $userID = mysqli_insert_id($conn);
          $result = mysqli_query($conn, "INSERT INTO tb_penjual VALUES ('$userID', '$username', '', '', '')");
          $result = mysqli_query($conn, "INSERT INTO tb_toko VALUES ('', '', '', '', '$username')");
          return mysqli_affected_rows($conn);
     }
}

function ubahDataPenjual($data)
{
     global $conn;
     $id_toko = $data["id_toko"];
     $id = $data["id"];
     $fullname = $data["fullname"];
     $username = $data["username"];
     $nomortelepon = $data["nomortelepon"];
     $email = $data["email"];
     $kota = $data["kota"];
     $provinsi = $data["provinsi"];
     $namatoko = $data["namatoko"];
     $pemilik = $data["pemilik"];
     $alamat = $data["alamat"];

     $result = mysqli_query($conn, "UPDATE tb_penjual SET email='$email', kota='$kota', provinsi='$provinsi' WHERE userid='$id'");

     $result = mysqli_query($conn, "UPDATE tb_user SET fullname='$fullname', username='$username', nomortelepon='$nomortelepon' WHERE id='$id'");

     $result = mysqli_query($conn, "UPDATE tb_toko SET namatoko='$namatoko', alamat='$alamat', pemilik='$pemilik' WHERE id_toko='$id_toko'");

     return mysqli_affected_rows($conn);
     // if (mysqli_affected_rows($conn)) {
     //      // Perbarui nilai sesi $_SESSION["username"]
     //      $_SESSION["username"] = $username;

     //      // Tampilkan pesan sukses
     //      echo "<script>alert('Data profil berhasil diupdate');</script>";
     // } else {
     //      // Tampilkan pesan error jika ada masalah
     //      echo mysqli_error($conn);
     // }

}
