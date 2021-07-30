<?php 
session_start();
include '../koneksi/koneksi.php';

$username = $_POST['username'];
$password = $_POST['pass'];

$cek = mysqli_query($conn, "SELECT * FROM customer where username = '$username'");
$jml = mysqli_num_rows($cek);
$row = mysqli_fetch_assoc($cek);

if($jml ==1){
	if(password_verify($password, $row['password'])){
		$_SESSION['user'] = $row['nama'];
		$_SESSION['kd_cs'] = $row['kode_customer'];
		header('location:../index.php');
	}else{
		echo "
		<script>
		alert('USERNAME/PASSWORD SALAH');
		window.location = '../user_login.php';
		</script>
		";
		die;
	}
}else{
	echo "
	<script>
	alert('USERNAME/PASSWORD SALAH');
	window.location = '../user_login.php';
	</script>
	";
	die;
}

?>
