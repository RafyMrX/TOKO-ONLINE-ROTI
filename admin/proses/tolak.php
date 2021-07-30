<?php 
include '../../koneksi/koneksi.php';
$inv = $_GET['inv'];
$tolak = mysqli_query($conn, "UPDATE produksi set tolak = '1', terima='2' WHERE invoice = '$inv'");

if($tolak){
	echo "
	<script>
	alert('PESANAN DITOLAK');
	window.location = '../produksi.php';
	</script>
	";
}

?>