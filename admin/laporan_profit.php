<?php 
include 'header.php';
$date = date('yy-m-d');
if(isset($_POST['submit'])){
	$date1 = $_POST['date1'];
	$date2 = $_POST['date2'];
}
?>
<style type="text/css">
	@media print{
		.print{
			display: none;
		}
	}
</style>
<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid gray; padding-bottom: 5px;"><b>Laporan profit</b></h2>
	<div class="row print">
		<div class="col-md-9">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<table>
					<tr>
						<td><input type="date" name="date1" class="form-control" value="<?= $date; ?>"></td>
						<td>&nbsp; - &nbsp;</td>
						<td><input type="date" name="date2" class="form-control" value="<?= $date; ?>"></td>
						<td> &nbsp;</td>
						<td><input type="submit" name="submit" class="btn btn-primary" value="Tampilkan"></td>
					</tr>
				</table>
			</form>
			
		</div>
		<div class="col-md-3">
			<form action="exp_profit.php" method="POST">
				<table>
					<tr>
						<td><input type="hidden" name="date1" class="form-control" value="<?= $date1; ?>"></td>
						<td><input type="hidden" name="date2" class="form-control" value="<?= $date2; ?>"></td>
						<td><button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-save-file"></i> Export to Excel</button></td>
						<td> &nbsp;</td>
						<td><a href="" onclick="window.print()" class="btn btn-default"><i class="glyphicon glyphicon-print"></i> Cetak</a></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	<br>
	<br>

	<table class="table table-striped">
		<tr>
			<th>No</th>
			<th>Invoice</th>
			<th>Nama Produk</th>
			<th>Harga</th>
			<th>qty</th>
			<th>Subtotal</th>
			<th>tanggal</th>
		</tr>
		<?php 
		if(isset($_POST['submit'])){
			$result = mysqli_query($conn, "SELECT * FROM produksi WHERE terima = 1 and tanggal between '$date1' and '$date2'");
			$no=1;
			$total = 0;
			while ($row = mysqli_fetch_assoc($result)) {
				?>
				<tr>
					<td><?= $no; ?></td>
					<td><?= $row['invoice']; ?></td>
					<td><?= $row['nama_produk']; ?></td>
					<td><?=  number_format($row['harga']); ?></td>
					<td><?= $row['qty']; ?></td>
					<td><?= number_format($row['harga']*$row['qty']); ?></td>
					<td><?= $row['tanggal']; ?></td>
				</tr>
				<?php 
				$total += $row['harga']*$row['qty'];
				$no++;
			}

			?>
			<tr>
				<td colspan="7" class="text-right"><b>Total Pendapatan Kotor = <?= number_format($total); ?></b></td>
			</tr>
		</table>
		<hr>
		<h4><b>Pemotongan dengan Biaya Bahan Baku</b></h4>
		<table class="table table-striped">
			<tr>
				<th>No</th>
				<th>Nama Bahan Baku</th>
				<th>Harga</th>
				<th>Kebutuhan</th>
				<th>Subtotal</th>
			</tr>
			<?php 
			$result = mysqli_query($conn, "SELECT * FROM produksi WHERE terima = 1 and tanggal between '$date1' and '$date2'");
			$no1=1;
			$totalb = 0;
			while ($row = mysqli_fetch_assoc($result)) {
				$kd = $row['kode_produk'];
				$bahan = mysqli_query($conn, "SELECT b.kebutuhan as kebutuhan, i.nama as nama, i.harga as harga from bom_produk b join inventory i on b.kode_bk=i.kode_bk WHERE b.kode_produk = '$kd'");
				while ($row1 = mysqli_fetch_assoc($bahan)) {
					?>
					<tr>
						<td><?= $no1; ?></td>
						<td><?= $row1['nama']; ?></td>
						<td><?= $row1['harga']; ?></td>
						<td><?= $row1['kebutuhan']; ?></td>
						<td><?= number_format($row1['harga']*$row1['kebutuhan']); ?></td>
					</tr>
					<?php 
					$totalb += $row1['harga']*$row1['kebutuhan'];
					$no1++;
				}
			}
		?>
		<tr>
			<td colspan="7" class="text-right"><b>Total Biaya Bahan Baku = <?= number_format($totalb); ?></b></td>
		</tr>
		<tr>
			<td colspan="7" class="text-right bg-success" style="color: green;"><b>TOTAL PENDAPATAN BERSIH = <?= number_format($total-$totalb); ?></b></td>
		</tr>
		<?php 
			}
		 ?>
	</table>
</div>

<br>
<br>
<br>
<br>
<br>


<?php 
include 'footer.php';
?>