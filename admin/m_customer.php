<?php 
include 'header.php';

if(isset($_GET['page'])){
	$kode = $_GET['kode'];
	$result = mysqli_query($conn, "DELETE FROM customer WHERE kode_customer = '$kode'");

	if($result){
		echo "
		<script>
		alert('DATA BERHASIL DIHAPUS');
		window.location = 'm_customer.php';
		</script>
		";
	}
}

?>


<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid gray"><b>Data Customer</b></h2>
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">No</th>
				<th scope="col">Kode Customer</th>
				<th scope="col">Nama</th>
				<th scope="col">Email</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$result = mysqli_query($conn, "SELECT * FROM customer order by kode_customer asc");
			$no =1;
			while ($row = mysqli_fetch_assoc($result)) {
				?>
				<tr>

					<th scope="row"><?php echo $no; ?></th>
					<td><?= $row['kode_customer'];  ?></td>
					<td><?= $row['nama'];  ?></td>
					<td><?= $row['email'];  ?></td>
					<td><a href="m_customer.php?kode=<?php echo $row['kode_customer'];?>&page=del" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i class="glyphicon glyphicon-trash"></i> </a></td>
				</tr>
				<?php 
				$no++;
			}
			?>
		</tbody>
	</table>

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
