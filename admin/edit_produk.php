<?php 
include 'header.php';
// generate kode material
$kode_produk = $_GET['kode'];
$kode = mysqli_query($conn, "SELECT * from produk where kode_produk = '$kode_produk'");
$data = mysqli_fetch_assoc($kode);

?>


<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid gray"><b>Edit Produk</b></h2>

	<form action="proses/edit_produk.php" method="POST" enctype="multipart/form-data">

		<div class="form-group">
			<label for="exampleInputFile"><img src="../image/produk/<?= $data['image']; ?>" width="100"></label>
			<input type="file" id="exampleInputFile" name="files">
			<p class="help-block">Pilih Gambar untuk Produk</p>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputEmail1">Kode Produk</label>
					<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama Produk" disabled value="<?= $data['kode_produk']; ?>">
					<input type="hidden" name="kode" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama Produk"  value="<?= $data['kode_produk']; ?>">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputEmail1">Nama Produk</label>
					<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama Produk" name="nama" value="<?= $data['nama']; ?>">
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputEmail1">Harga</label>
					<input type="number" class="form-control" id="exampleInputEmail1" placeholder="masukkan Harga" name="harga" value="<?= $data['harga']; ?>">
				</div>
			</div>
		</div>

		<div class="form-group">
			<label for="exampleInputPassword1">Deskripsi</label>
			<textarea name="desk" class="form-control">
				<?= $data['deskripsi']; ?>
			</textarea>
		</div>
		<hr>
		<h3 style=" width: 100%; border-bottom: 4px solid gray">BOM Produk</h3>

		<div class="row">
			<div class="col-md-6">
				<h4>Daftar Material</h4>
				<table class="table table-striped ">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Kode Material</th>
							<th scope="col">Nama Material</th>
						</tr>
					</thead>
					<?php 
					$result2 = mysqli_query($conn, "SELECT * FROM inventory order by kode_bk asc");
					$no2 =1;
					while ($row2 = mysqli_fetch_assoc($result2)) {
						?>
						<tbody>
							<tr>
								<th scope="row"><?= $no2;  ?></th>
								<td><?= $row2['kode_bk']; ?></td>
								<td><?= $row2['nama']; ?></td>

							</tr>
						</tbody>
						<?php 
						$no2++;
					}
					?>
				</table>
			</div>


			<div class="col-md-6">
				<h4>Pilih material yang hanya dibutuhkan untuk produk</h4>
				<div class="bg-danger" style="padding: 5px;">
				<p style="color: red; font-weight: bold;">NB. Form dibawah tidak harus diisi semua</p>
				<p style="color: red; font-weight: bold;">Kode Material tidak boleh sama</p>
				</div>
				<br>
				<?php 
				$result3 = mysqli_query($conn, "SELECT * FROM bom_produk where kode_produk = '$kode_produk'");
				$jml = mysqli_num_rows($result3);
				$no3 = 1;
				while ($no3 <= $jml) {
				$row3 = mysqli_fetch_assoc($result3);
					?>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputPassword1">Kode Material</label>
								<input type="text" name="material[]" class="form-control" placeholder="Masukkan Kode Material" value="<?= $row3['kode_bk']; ?>" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label >Kebutuhan Material</label>
								<input type="text" class="form-control"placeholder="Contoh : 250 atau 0.2" name="keb[]" value="<?= $row3['kebutuhan']; ?>" required>
								
							</div>
						</div>
					</div>
					<?php 
					$no3++;
				}	
				?>

			</div>

		</div>
		<div class="row">
			
			<div class="col-md-6">
				<button type="submit"  class="btn btn-warning btn-block" ><i class="glyphicon glyphicon-edit"></i> Edit</button>
			</div>	
			<div class="col-md-6">
				<a href="m_produk.php" class="btn btn-danger btn-block">Cancel</a>
			</div>
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