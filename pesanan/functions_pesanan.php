<?php

$conn = mysqli_connect('localhost', 'root', '', 'potionpharma_web');

function queryPesanan($query){

     global $conn;
     $result = mysqli_query($conn, $query);
     $row = [];
     while ($row = mysqli_fetch_assoc($result)){
          $rows [] = $row; 
     }
     return $rows;
}

function buatPesanan($data){

     global $conn;
     $idobat = $data["idobat"];
     $tanggal = $data["tanggal"];

     $query = "INSERT INTO tb_pesanan VALUES('', '', '$idobat', '$tanggal')";
     
     mysqli_query($conn, $query);
     return mysqli_affected_rows($conn);
}

function tambahPesanan($data){

     global $conn;
     $idobat = $_POST["idobat"];

     $query = "INSERT INTO tb_pesanan VALUES('id', 'username', '$idobat', 'tanggal')";
     
     mysqli_query($conn, $query);
     return mysqli_affected_rows($conn);
}

function hapusPesanan($id_jual){
     global $conn;
     $query = "DELETE FROM tb_pesanan WHERE id_jual = '$id_jual' ";

     mysqli_query($conn, $query);
     return mysqli_affected_rows($conn);
}

function ubahPesanan($data){

     global $conn;
     $id_jual = $data["id_jual"];
     $notep_pembeli = $_POST["notep_pembeli"];
     $idobat = $_POST["idobat"];
     $tanggal = $_POST["tanggal"];

     $queryobat = "UPDATE tb_pesanan SET
               notep_pembeli = '$notep_pembeli',
               idobat = '$idobat',
               tanggal = '$tanggal'
               WHERE id_jual = '$id_jual'
     ";

     mysqli_query($conn, $queryobat);
     return mysqli_affected_rows($conn);
}

function cariPesanan($keyword){
     $query = "SELECT * FROM tb_pesanan WHERE idobat LIKE '%$keyword%'";
     
     return queryPesanan($query);
}