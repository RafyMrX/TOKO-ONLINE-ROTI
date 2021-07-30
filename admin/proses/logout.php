<?php 
session_start();
unset($_SESSION['admin']);

if(!isset($_SESSION['admin'])){
	header('location:../index.php');
}

?>