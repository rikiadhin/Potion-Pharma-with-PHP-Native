<?php

require 'functions_pesanan.php';

$id_jual = $_GET["id"];
$query = mysqli_query($conn, "DELETE FROM tb_pemesanan WHERE id_jual = '$id_jual' ");

if($query == 1 ){
     echo 
          "<script>
          alert('Selamat. Data BERHASIL dihapus');
          document.location.href = '../dashboard_penjual.php';
          </script> 
          ";
}else{
     echo 
          "<script>
          alert('Maaf. Data GAGAL dihapus');
          document.location.href = '../dashboard_penjual.php';
          </script> 
          ";
}
