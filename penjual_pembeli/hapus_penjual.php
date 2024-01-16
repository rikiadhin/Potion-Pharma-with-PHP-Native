<?php

require 'functions_penjual_pembeli.php';
$idpenjual = $_GET["nomortelepon"];

if(hapusPenjual($idpenjual) > 0 ){
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
