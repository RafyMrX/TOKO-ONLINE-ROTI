<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table>
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
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Laporan Omset.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		$conn = mysqli_connect("localhost", "root", "", "dbpw192_18410100054");
		$date1 = $_POST['date1'];
		$date2 = $_POST['date2'];
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

</body>
</html>