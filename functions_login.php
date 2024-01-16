<?php
function login($data)
{
    global $conn;
    $nomortelepon = $_POST['nomortelepon'];
    $password = $_POST['password'];

    // Koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "potionpharma_web");
    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    // Query untuk mencari username
    $result = mysqli_query($conn, "SELECT * FROM tb_pembeli WHERE nomortelepon = '$nomortelepon'");
	$result1 = mysqli_query($conn, "SELECT * FROM tb_penjual WHERE nomortelepon = '$nomortelepon'");
	$result2 = mysqli_query($conn, "SELECT * FROM tb_admin WHERE nomortelepon = '$nomortelepon'");
    if (!$result){
          die("Error: " . mysqli_error($conn));
    }else if(!$result1){
          die("Error: " . mysqli_error($conn));
     }else if(!$result2){
          die("Error: " . mysqli_error($conn));
     }

    // Cek username
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Cek password
        if (password_verify($password, $row["password"])) {
            // Redirect ke halaman register.php jika login berhasil
            header("Location: dashboard_pembeli.html");
            
        } else {
            echo "Password salah!";
        }
    } else if(mysqli_num_rows($result1)){
          $row = mysqli_fetch_assoc($result1);

        // Cek password
        if (password_verify($password, $row["password"])) {
            // Redirect ke halaman register.php jika login berhasil
            header("Location: dashboard_penjual.php");
            
        } else {
            echo "Password salah!";
     }
     } else if(mysqli_num_rows($result2)){
          $row = mysqli_fetch_assoc($result2);

        // Cek password
        if (password_verify($password, $row["password"])) {
            // Redirect ke halaman register.php jika login berhasil
            header("Location: index.php");
            
        } else {
            echo "Password salah!";
        }
     } else {
        echo "Username tidak ditemukan!";
    }
    // Tutup koneksi database
    mysqli_close($conn);
}
?>