<?php

require 'functions_user.php';

$iduser = $_GET["id"];
$queryuser = mysqli_query($conn, "DELETE FROM tb_user WHERE id = '$iduser' ");
// var_dump($queryuser);
// die;
if($queryuser == 1 ){
     echo 
          "<script>
          alert('Selamat. Data BERHASIL dihapus');
          document.location.href = '../index.php';
          </script> 
          ";
}else{
     echo 
          "<script>
          alert('Maaf. Data GAGAL dihapus');
          document.location.href = '../index.php';
          </script> 
          ";
}
