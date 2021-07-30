<?php 
include '../../koneksi/koneksi.php';
$kode = $_POST['kd_material'];
$nama = $_POST['nama'];
$stok = $_POST['stok'];
$satuan = $_POST['satuan'];
$harga = $_POST['harga'];
$tanggal = date("y-m-d");

$result = mysqli_query($conn, "UPDATE inventory SET kode_bk = '$kode', nama='$nama', qty = '$stok', satuan='$satuan', harga='$harga',tanggal='$tanggal' where kode_bk = '$kode'");

if($result){
	echo "
	<script>
	alert('DATA BERHASIL DIUPDATE');
	window.location = '../inventory.php';
	</script>
	";
}

?>