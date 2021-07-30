<?php 
	session_start();
	unset($_SESSION['user']);
	unset($_SESSION['kd_cs']);
	header('location:../user_login.php');
 ?>