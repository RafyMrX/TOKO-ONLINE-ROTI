<?php 
include '../../koneksi/koneksi.php';

$kode = $_GET['kode'];
$produk = mysqli_query($conn, "SELECT * FROM produk where kode_produk ='$kode'");
$row = mysqli_fetch_assoc($produk);
unlink("../../image/produk/".$row['image']);
mysqli_query($conn, "DELETE FROM bom_produk where kode_produk = '$kode'");
$del = mysqli_query($conn, "DELETE FROM produk WHERE kode_produk = '$kode'");

if($del){
	echo "
	<script>
	alert('DATA BERHASIL DIHAPUS');
	window.location = '../m_produk.php';
	</script>
	";
}

?>