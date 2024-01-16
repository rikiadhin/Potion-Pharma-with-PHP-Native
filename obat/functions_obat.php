<?php

$conn = mysqli_connect('localhost', 'root', '', 'potionpharma_web');

function queryObat($queryobat)
{

     global $conn;
     $resultobat = mysqli_query($conn, $queryobat);
     $rowobat = [];
     while ($rowobat = mysqli_fetch_assoc($resultobat)) {
          $rowsobat[] = $rowobat;
     }
     return $rowsobat;
}

function tambahObat($data)
{
     global $conn;
     $idtoko = $data["id_toko"];
     $gambar = $data["gambar"];
     $obat = $data["id_obat"]; 
     $namaobat = $data["nama_obat"];
     $namastandarmims = $data["nama_standar_MIMS"];
     $deskripsi = $data["deskripsi"];
     $manfaat = $data["manfaat"];
     $jumlahkemasan = $data["jumlah_kemasan"];
     $kemasan = $data["kemasan"];
     $dosis = $data["dosis"];
     $penyajian = $data["penyajian"];
     $golongan = $data["golongan"];
     $bentuk = $data["bentuk"];
     $nomorizinedar = $data["nomor_izin_edar"];
     $komposisi = $data["komposisi"];
     $jumlahstok = $data["jumlah_stok"];
     $expired = $data["expired"];
     $harga = $data["harga"];
     $referensi = $data["referensi"]; 

     $queryobat = "INSERT INTO tb_obat VALUES('', '$gambar', '$idtoko', '$obat', '$namaobat', '$namastandarmims', '$deskripsi', '$manfaat','$jumlahkemasan','$kemasan','$dosis','$penyajian','$golongan','$bentuk','$nomorizinedar','$komposisi','$jumlahstok','$expired','$harga','$referensi' )";

     mysqli_query($conn, $queryobat);
     return mysqli_affected_rows($conn);
}

// // function hapusObat($idobat){
// //      global $conn;
// //      $queryobat = "DELETE FROM tb_obat WHERE idobat = '$idobat' ";


// //      mysqli_query($conn, $queryobat);
// //      return mysqli_affected_rows($conn);
// // }

function ubahObat($data)
{

     global $conn;
     $nomor = $data["nomor"];
     $gambar = $data["gambar"];
     $idtoko = $data["id_toko"];
     $obat = $data["id_obat"];
     $namaobat = $data["nama_obat"];
     $namastandarmims = $data["nama_standar_MIMS"];
     $deskripsi = $data["deskripsi"];
     $manfaat = $data["manfaat"];
     $jumlahkemasan = $data["jumlah_kemasan"];
     $kemasan = $data["kemasan"];
     $dosis = $data["dosis"];
     $penyajian = $data["penyajian"];
     $golongan = $data["golongan"];
     $bentuk = $data["bentuk"];
     $nomorizinedar = $data["nomor_izin_edar"];
     $komposisi = $data["komposisi"];
     $jumlahstok = $data["jumlah_stok"];
     $expired = $data["expired"];
     $harga = $data["harga"];
     $referensi = $data["referensi"]; 

     $queryobat = "UPDATE tb_obat SET 
               nomor = '$nomor',
               gambar = '$gambar',
               id_toko = '$idtoko',
               nama_obat = '$namaobat',
               nama_standar_MIMS = '$namastandarmims',
               deskripsi = '$deskripsi',
               manfaat = '$manfaat',
               jumlah_kemasan = '$jumlahkemasan',
               id_kemasan = '$kemasan',
               id_dosis = '$dosis',
               id_penyajian = '$penyajian',
               id_golongan = '$golongan',
               id_bentuk = '$bentuk',
               nomor_izin_edar = '$nomorizinedar',
               komposisi = '$komposisi',
               jumlah_stok = '$jumlahstok',
               expired = '$expired',
               harga = '$harga',
               referensi = '$referensi'  
               WHERE id_obat = $obat
     ";

     mysqli_query($conn, $queryobat);
     return mysqli_affected_rows($conn);
}

// function cariObat($keywordobat)
// {
//      $queryobat = "SELECT * FROM tb_obat WHERE idobat LIKE '%$keywordobat%'";

//      return queryObat($queryobat);
// }
