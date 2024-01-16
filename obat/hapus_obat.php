<?php
require 'functions_obat.php';
$idobat = $_GET["id"];
$queryobat = mysqli_query($conn, "DELETE FROM tb_obat WHERE id = '$idobat' ");
// var_dump($queryobat);
// die;
if($queryobat == 1 ){
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
