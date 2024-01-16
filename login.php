<?php

session_start();
require 'tabel_user/functions_user.php';

if (isset($_POST["login"])) {

	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");

	if (mysqli_num_rows($result) > 0) {
		$rows = mysqli_fetch_assoc($result);
		if (password_verify($password, $rows["password"])) {
			// Periksa role pengguna
			$role = $rows["role"];
			if ($role === 'admin') {
				// Redirect ke halaman admin jika login berhasil
				$_SESSION['username'] = $username;
				$_SESSION['login'] = true;
				header("Location: index.php");
			} else if ($role === 'penjual') {
				// Redirect ke halaman admin jika login berhasil
				$_SESSION['username'] = $username;
				$_SESSION['login'] = true;
				header("Location: dashboard_penjual.php");
			} else if ($role === 'pembeli') {
				// Redirect ke halaman admin jika login berhasil
				$_SESSION['username'] = $username;
				$_SESSION['login'] = true;
				header("Location: dashboard_pembeli.php");
			} else {
				echo "
					<script>
					alert('Maaf. Role tidak ditemukan');
					document.location.href = 'login.php';
					</script> 
					";
			}
			$salahrole = true;
		}
		$error = true;
	}
	$error = true;
}
?>
<!DOCTYPE html>
<!-- Website - www.codingnepalweb.com -->
<html lang="en" dir="ltr">

<head>
     <meta charset="utf-8" />
     <title>Login Form</title>
     <link rel="stylesheet" href="style-login.css" />
</head>

<body>
     <div class="center">
          <h1>Login User</h1>
          <form action="" method="post">
               <div class="txt_field">
                    <input type="text" name="username" id="username" required />
                    <span></span>
                    <label>Masukkan Username</label>
               </div>
               <div class="txt_field">
                    <input type="password" name="password" id="password" required />
                    <span></span>
                    <label>Masukkan Password</label>
               </div>
			<?php if(isset($error)):?>
				<p style="color:red; font-style:italic">Usename atau password salah</p>
			<?php endif;?>
			<br>
               <div class="pass">Forgot Password?</div>
               <button type="submit" name="login">Login</button>
               <div class="signup_link">Not a member? <a href="registrasi.php">Signup</a></div>
          </form>
     </div>
</body>

</html>