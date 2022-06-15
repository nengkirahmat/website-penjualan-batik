<?php
if (isset($_POST['simpan'])){
	$id_trans=$_POST['id_trans'];
	$nama_rek=$_POST['nama_rek'];
	$no_rek=$_POST['no_rek'];
	$bank=$_POST['bank'];
	$jumlah=$_POST['jumlah'];
	$query="insert into tbl_bayar values ('','$id_trans','$nama_rek','$no_rek','$bank','$jumlah',Now())";
	$res=$con->query($query);
	if ($res){
		header('location:index.php?aksi=page&page=keranjang_saya&id_trans='.$id_trans);
	}
}
?>
<h3>Pembayaran Transaksi</h3>
<form action="#" method="POST">
	ID Transaksi<br>
	<input type="text" name="id_trans" <?php if (!empty($_GET['id_trans'])){ ?> value="<?php echo $_GET['id_trans']; ?>" <?php } ?> required="" maxlength="10" size="5"><br><br>
	Nama Rekening<br>
	<input type="text" name="nama_rek" required="" maxlength="50" size="50"><br><br>
	Nomor Rekening<br>
	<input type="text" name="no_rek" required="" maxlength="50" size="50"><br><br>
	Bank Transfer<br>
	<input type="text" name="bank" required="" maxlength="50" size="20"><br><br>
	Jumlah Transfer<br>
	<input type="text" name="jumlah" required="" maxlength="10" size="30"><br><br>
	<input type="submit" class="btn-blue" name="simpan" value="Kirim">
</form>