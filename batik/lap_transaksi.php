<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Laporan Transaksi Penjualan Batik</title>
</head>
<body>
<?php if (empty($_GET['page'])){ ?>
<div style="width: 30%; float: left; margin-left: 2%;">
<h3>Laporan Pertanggal</h3>
<form action="lap_transaksi.php?page=pertanggal" method="POST">
<h4>Tanggal Awal</h4>
	<select name="tgl" required="">
		<option value="">Tgl</option>
		<?php $tgl=1; while ($tgl<=31) {
			?>
			<option value="<?php echo $tgl; ?>"><?php echo $tgl; ?></option>
			<?php
		$tgl++; } ?>
	</select> 
	<select name="bln" required="">
		<option value="">Bulan</option>
		<option value="01">Januari</option>
		<option value="02">Februari</option>
		<option value="03">Maret</option>
		<option value="04">April</option>
		<option value="05">Mei</option>
		<option value="06">Juni</option>
		<option value="07">Juli</option>
		<option value="08">Agustus</option>
		<option value="09">September</option>
		<option value="10">Oktober</option>
		<option value="11">November</option>
		<option value="12">Desember</option>
	</select> 
	<select name="thn" required="">
		<option value="">Tahun</option>
		<?php
		$thn=2017;
		while ($thn<=date('Y')) {
			?>
			<option value="<?php echo $thn; ?>"><?php echo $thn; ?></option>
			<?php
		$thn++; }
		?>
	</select> 
	<h4>Tanggal Akhir</h4>
	<select name="tgl1" required="">
		<option value="">Tgl</option>
		<?php $tgl1=1; while ($tgl1<=31) {
			?>
			<option value="<?php echo $tgl1; ?>"><?php echo $tgl1; ?></option>
			<?php
		$tgl1++; } ?>
	</select> 
	<select name="bln1" required="">
		<option value="">Bulan</option>
		<option value="01">Januari</option>
		<option value="02">Februari</option>
		<option value="03">Maret</option>
		<option value="04">April</option>
		<option value="05">Mei</option>
		<option value="06">Juni</option>
		<option value="07">Juli</option>
		<option value="08">Agustus</option>
		<option value="09">September</option>
		<option value="10">Oktober</option>
		<option value="11">November</option>
		<option value="12">Desember</option>
	</select> 
	<select name="thn1" required="">
		<option value="">Tahun</option>
		<?php
		$thn1=2017;
		while ($thn1<=date('Y')) {
			?>
			<option value="<?php echo $thn1; ?>"><?php echo $thn1; ?></option>
			<?php
		$thn1++; }
		?>
	</select> <br><br>
	<input type="submit" name="harian" value="Tampilkan">
</form>
</div>
<div style="width: 30%; float: left; margin-left: 2%;">
<h3>Laporan Berdasar Status Bayar</h3>
<form action="lap_transaksi.php?page=status_bayar" method="POST">
	Status Bayar<br>
	<select name="status_bayar" required="">
		<option value="">Status Bayar</option>
		<option value="Belum Bayar">Belum Bayar</option>
		<option value="Dibayar">Dibayar</option>
	</select><br><br>
	<input type="submit" name="tampilkan" value="Tampilkan">
</form>
</div>
<?php }else{ ?>
<center>
<h1>Toko Batik Prima Sari</h1>
<h3>Laporan Transaksi Penjualan Batik</h3>
</center>
<?php
//$query="select * from tbl_trans,tbl_pembeli where tbl_pembeli.id_pembeli=tbl_trans.id_pembeli order by id_trans desc";
//$res=$con->query($query);
?>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
	<tr>
		<th>No</th>
		<th>Id Trans</th>
		<th>Nama Pembeli</th>
		<th>Total Berat</th>
		<th>Ongkos Kirim</th>
		<th>Total Harga</th>
		<th>Total Belanja</th>
		<th>Metode Bayar</th>
		<th>Status Bayar</th>
		<th>Waktu</th>
	</tr>
	<?php
	if (!empty($_GET['page']) and $_GET['page']=="pertanggal"){
		$tgl=$_POST['thn']."-".$_POST['bln']."-".$thn=$_POST['tgl'];
		$tgl1=$_POST['thn1']."-".$_POST['bln1']."-".$thn=$_POST['tgl1'];
		$query="select * from tbl_trans,tbl_pembeli where tbl_pembeli.id_pembeli=tbl_trans.id_pembeli and (waktu_trans between '$tgl' and '$tgl1') order by id_trans desc";
		$res=$con->query($query);
	}

	if (!empty($_GET['page']) and $_GET['page']=="status_bayar"){
		$status_bayar=$_POST['status_bayar'];
		$query="select * from tbl_trans,tbl_pembeli where tbl_pembeli.id_pembeli=tbl_trans.id_pembeli and status_bayar='$status_bayar' order by id_trans desc";
		$res=$con->query($query);
	}

	$n=1;
	while ($data=$res->fetch_array(MYSQLI_BOTH)) {
		?>
		<tr>
			<td align="center"><?php echo $n; ?></td>
			<td align="center"><?php echo $data['id_trans']; ?></td>
			<td><?php echo $data['nama_lengkap']; ?></td>
			<td align="center"><?php echo $data['total_berat']; ?> Gram</td>
			<td align="right"><?php echo $data['ongkir']; ?></td>
			<td align="right"><?php echo "Rp.".number_format($data['total_belanja'],0,".","."); ?></td>
			<td align="right"><?php echo "Rp.".number_format($data['total_belanja']+$data['ongkir'],0,".","."); ?></td>
			<td align="center"><?php echo $data['pembayaran']; ?></td>
			<td align="center"><?php echo $data['status_bayar']; ?></td>
			<td align="center"><?php echo $data['waktu_trans']; ?></td>
		</tr>
		<?php
	$n++; }
	?>
</table>
<?php } ?>
</body>
</html>