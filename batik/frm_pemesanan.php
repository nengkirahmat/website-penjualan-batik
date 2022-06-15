<?php
if (isset($_POST['simpan_pemesanan'])){
	$nama=$_POST['nama'];
	$alamat=$_POST['alamat'];
	$pos=$_POST['pos'];
	$telp=$_POST['telp'];
	$email=$_POST['email'];
	$jasa=$_POST['jasa'];
	$pembayaran=$_POST['pembayaran'];
	$pesanan=$_POST['pesanan'];
	$catatan=$_POST['catatan'];

	$query="insert into tbl_pembeli values ('','$nama','$alamat','$pos','$telp','$email')";
	if ($res=$con->query($query)){
		$query="select id_pembeli from tbl_pembeli where nama_lengkap='$nama' and telp='$telp' order by id_pembeli desc";
						$res=$con->query($query);
						if ($data=$res->fetch_array(MYSQLI_BOTH)){
							$id_pembeli=$data['id_pembeli'];
						}
		$query="select id_trans from tbl_trans order by id_trans desc";
						$res=$con->query($query);
						if ($data=$res->fetch_array(MYSQLI_BOTH)){
							$id_trans=$data['id_trans']+1;
						}else{
							$id_trans=1;
						}
		$jenis_trans="Order Banyak";
		$query="insert into tbl_trans values ('$id_trans','$id_pembeli','','','$jasa','0','$pembayaran','$pesanan','$catatan','$jenis_trans','Belum Bayar',Now())";
						$con->query($query);
		header('location:index.php?aksi=page&page=response&id_trans='.$id_trans);
	}
}
?>
<h3>Order Banyak</h3>
<form action="#" method="POST">
Nama Lengkap<br>
<input name="nama" type="text" size="50" required=""><br><br>
Alamat Pengiriman<br>
<textarea name="alamat" cols="50" required=""></textarea><br><br>
Kode Pos<br>
<input name="pos" type="text" required=""><br><br>
Telepon<br>
<input name="telp" type="text" size="30" required=""><br><br>
Email (Optional)<br>
<input name="email" type="text" size="50"><br><br>
Jasa Pengiriman<br>
			<select name="jasa" required="">
				<option value="">--Jasa Pengiriman--</option>
				<option value="JNE">JNE</option>
				<option value="TIKI">TIKI</option>
				<option value="J&T">J&T</option>
				<option value="POS Indonesia">Pos Indonesia</option>
				<option value="Lainnya">Lainnya</option>
			</select><br><br>
Jenis Pembayaran<br>
<select name="pembayaran" required="">
	<option value="">--Jenis Pembayaran--</option>
	<option value="Bayar Langsung">Bayar Langsung</option>
	<option value="Transfer">Transfer</option>
</select><br><br>
Kode Batik, Warna, Ukuran dan Jumlah<br>
<textarea cols="50" rows="5" name="pesanan" required=""></textarea><br><br>
Catatan Lebih Rinci<br>
<textarea cols="50" rows="5" name="catatan" required=""></textarea><br><br>
<input value="Kirim" name="simpan_pemesanan" class="btn-red" type="submit">
</form>
<br><br>