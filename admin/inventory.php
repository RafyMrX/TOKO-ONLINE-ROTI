<?php 
include 'header.php';

if(isset($_GET['cek'])){
	$cek = $_GET['cek'];
	mysqli_query($conn, "UPDATE produksi SET cek = '$cek'");
}

if(isset($_GET['page'])){
	$kode = $_GET['kode'];
	$result = mysqli_query($conn, "DELETE FROM inventory WHERE kode_bk = '$kode'");

	if($result){
		echo "
		<script>
		alert('DATA BERHASIL DIHAPUS');
		window.location = 'inventory.php';
		</script>
		";
	}
}

?>


<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid gray"><b>Inventory Material</b></h2>
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">No</th>
				<th scope="col">Kode Matrial</th>
				<th scope="col">Nama</th>
				<th scope="col">Stok</th>
				<th scope="col">Satuan</th>
				<th scope="col">Harga</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$result = mysqli_query($conn, "SELECT * FROM inventory order by kode_bk asc");
			$no =1;
			while ($row = mysqli_fetch_assoc($result)) {
				?>
				<tr>

					<th scope="row"><?php echo $no; ?></th>
					<td><?= $row['kode_bk'];  ?></td>
					<td><?= $row['nama'];  ?></td>
					<td><?= $row['qty'];  ?></td>
					<td><?= $row['satuan'];  ?></td>
					<td><?php  echo "".number_format($row['harga'])."/".$row['satuan'];  ?></td>
					<td><a href="edit_inventory.php?kode=<?php echo $row['kode_bk']; ?>" class="btn btn-warning"><i class="glyphicon glyphicon-edit"></i> </a> <a href="inventory.php?kode=<?php echo $row['kode_bk'];?>&page=del" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i class="glyphicon glyphicon-trash"></i> </a></td>
				</tr>
				<?php 
				$no++;
			}
			?>
		</tbody>
	</table>
	<a href="tm_inventory.php" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Material</a>
</div>
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Modal title</h4>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<?php 
include 'footer.php';
?>