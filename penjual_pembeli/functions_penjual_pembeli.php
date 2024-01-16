<?php

$conn = mysqli_connect('localhost', 'root', '', 'database_penjualanobat');

function queryPembeli($querypembeli){

     global $conn;
     $resultpembeli = mysqli_query($conn, $querypembeli);
     $rowpembeli = [];
     while ($rowpembeli = mysqli_fetch_assoc($resultpembeli)){
          $rowspembeli [] = $rowpembeli; 
     }
     return $rowspembeli;
}

function queryPenjual($querypenjual){

     global $conn;
     $resultpenjual = mysqli_query($conn, $querypenjual);
     $rowpenjual = [];
     while ($rowpenjual = mysqli_fetch_assoc($resultpenjual)){
          $rowspenjual [] = $rowpenjual; 
     }
     return $rowspenjual;
}

function tambahPembeli($data){

     global $conn;
     $nomortelepon = $data["nomortelepon"];
     $fullname = $data["fullname"];
     $username = $data["username"];
     $password = $data["password"];

     $querypembeli = "INSERT INTO tb_pembeli VALUES('$nomortelepon', '$fullname', '$username', '$password')";
     
     mysqli_query($conn, $querypembeli);
     return mysqli_affected_rows($conn);
}
function tambahPenjual($data){

     global $conn;
     $nomortelepon = $data["nomortelepon"];
     $fullname = $data["fullname"];
     $username = $data["username"];
     $password = $data["password"];

     $querypenjual = "INSERT INTO tb_penjual VALUES('$nomortelepon', '$fullname', '$username', '$password')";
     
     mysqli_query($conn, $querypenjual);
     return mysqli_affected_rows($conn);
}

function hapusPembeli($nomortelepon){
     global $conn;
     $querypembeli = "DELETE FROM tb_pembeli WHERE nomortelepon = $nomortelepon";
     mysqli_query($conn, $querypembeli);

     return mysqli_affected_rows($conn);
}
function hapusPenjual($nomortelepon){
     global $conn;
     $querypenjual = "DELETE FROM tb_penjual WHERE nomortelepon = $nomortelepon";
     mysqli_query($conn, $querypenjual);

     return mysqli_affected_rows($conn);
}

function ubahPembeli($data){

     global $conn;
     $nomortelepon = $data["nomortelepon"];
     $fullname = $_POST["fullname"];
     $username = $_POST["username"];

     $querypembeli = "UPDATE tb_pembeli SET
               fullname = '$fullname',
               username = '$username'
               WHERE nomortelepon ='$nomortelepon'
     ";

     mysqli_query($conn, $querypembeli);
     return mysqli_affected_rows($conn);
}
function ubahPenjual($data){

     global $conn;
     $nomortelepon = $data["nomortelepon"];
     $fullname = $_POST["fullname"];
     $username = $_POST["username"];

     $querypenjual = "UPDATE tb_penjual SET
               fullname = '$fullname',
               username = '$username'
               WHERE nomortelepon = '$nomortelepon'
     ";

     mysqli_query($conn, $querypenjual);
     return mysqli_affected_rows($conn);
}

function registrasiPenjual($data){

     global $conn;
     $nomortelepon = $data["nomortelepon"];
     $fullname = $data["fullname"];
     $username = strtolower($data["username"]);
     $password = mysqli_escape_string($conn, $data["password"]);
     $password2= mysqli_escape_string($conn, $data["password2"]);
     
     $result = mysqli_query($conn, "SELECT username FROM tb_penjual WHERE username = '$username'");

     if(mysqli_fetch_assoc($result)){
          echo "
          <script>
               alert('username sudah terdaftar');
          </script>
          ";

          return false;
     }

     if($password != $password2){
          echo "
          <script>
               alert('Koonfirmasi password tidak sama');
          </script>
          ";
          
          return false;
     }else{
          $password = password_hash($password, PASSWORD_DEFAULT);
          $result = mysqli_query($conn, "INSERT INTO tb_penjual VALUES ('$nomortelepon', '$fullname', '$username', '$password')");
          return mysqli_affected_rows($conn);
     }
}

function registrasiPembeli($data){

     global $conn;
     $nomortelepon = $data["nomortelepon"];
     $fullname = $data["fullname"];
     $username = strtolower($data["username"]);
     $password = mysqli_escape_string($conn, $data["password"]);
     $password2= mysqli_escape_string($conn, $data["password2"]);
     
     $result = mysqli_query($conn, "SELECT username FROM tb_pembeli WHERE username = '$username'");

     if(mysqli_fetch_assoc($result)){
          echo "
          <script>
               alert('username sudah terdaftar');
          </script>
          ";

          return false;
     }

     if($password != $password2){
          echo "
          <script>
               alert('Koonfirmasi password tidak sama');
          </script>
          ";
          
          return false;
     }else{
          $password = password_hash($password, PASSWORD_DEFAULT);
          $result = mysqli_query($conn, "INSERT INTO tb_pembeli VALUES ('$nomortelepon', '$fullname', '$username', '$password')");
          return mysqli_affected_rows($conn);
     }
}

function cariPenjual($keywordpenjual){
     $querypenjual = "SELECT * FROM tb_penjual WHERE nomortelepon LIKE '%$keywordpenjual%'";
     
     return queryPenjual($querypenjual);
}
function cariPembeli($keywordpembeli){
     $querypembeli = "SELECT * FROM tb_pembeli WHERE nomortelepon LIKE '%$keywordpembeli%'";
     
     return queryPembeli($querypembeli);
}