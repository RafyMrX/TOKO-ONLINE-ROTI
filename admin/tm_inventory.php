<?php 
include 'header.php';

// generate kode material
	$kode = mysqli_query($conn, "SELECT kode_bk from inventory order by kode_bk desc");
	$data = mysqli_fetch_assoc($kode);
	$num = substr($data['kode_bk'], 1, 4);
	$add = (int) $num + 1;
	if(strlen($add) == 1){
		$format = "M000".$add;
	}else if(strlen($add) == 2){
		$format = "M00".$add;
	}
	else if(strlen($add) == 3){
		$format = "M0".$add;
	}else{
		$format = "M".$add;
	}

?>


<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid gray"><b>Tambah Material</b></h2>

	<form action="proses/tambah_inv.php" method="POST">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputEmail1">Kode Material</label>
					<input type="text" class="form-control" id="exampleInputEmail1" disabled value="<?php echo $format; ?>">

					<input type="hidden" class="form-control" id="exampleInputEmail1"  name="kd_material" value="<?php echo $format; ?>">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputEmail1">Nama Material</label>
					<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Material" name="nama">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputEmail1">Stok</label>
					<input type="number" class="form-control" id="exampleInputEmail1"  name="stok" placeholder="contoh 2 atau 0.4" min="1">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputEmail1">Satuan</label>
					<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Contoh : Kg atau gram" name="satuan">
						<p class="help-block">Hanya Masukkan Satuan saja : Kg atau gram</p>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputEmail1">Harga</label>
					<input type="number" class="form-control" id="exampleInputEmail1"  name="harga" placeholder="Contoh : 1000" min="1">
					<p class="help-block">Harga termasuk harga per kg atau per 	gram</p>
				</div>
			</div>
		</div>
		<button type="submit"  class="btn btn-success" ><i class="glyphicon glyphicon-plus-sign"></i> Tambah</button>
		<a href="inventory.php" class="btn btn-danger">Cancel</a>
	</form>
</div>

<br>

</div>
</form>

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