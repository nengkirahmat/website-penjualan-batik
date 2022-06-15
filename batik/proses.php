<?php
if (isset($_POST['simpan_transaksi'])){
	$nama=$_POST['nama'];
	$alamat=$_POST['alamat'];
	$pos=$_POST['pos'];
	$telp=$_POST['telp'];
	$email=$_POST['email'];
	$jasa=$_POST['jasa'];
	$pembayaran=$_POST['pembayaran'];
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

		$total=0;
		$total_berat=0;
		foreach ($_SESSION['items'] as $key => $value) {
						$query="select * from tbl_batik where id_batik='$key'";
						$res=$con->query($query);
						$data=$res->fetch_array(MYSQLI_BOTH);

						$id_batik=$data['id_batik'];
						if ($data['min_grosir']>0 and $value>=$data['min_grosir']){
							$harga=$data['harga_grosir'];
							$sub_total=$harga*$value;
							$total+=$sub_total;
							$jenis_beli="grosir";
						}else{
							$harga=$data['harga_eceran'];
							$sub_total=$harga*$value;
							$total+=$sub_total;
							$jenis_beli="eceran";
						}
						$berat=$data['berat']*$value;
						$total_berat+=$berat;
						

						$query="insert into tbl_cart values ('','$id_pembeli','$id_trans','$id_batik','$harga','$value','$berat','$jenis_beli')";
						$con->query($query);
	}
	$jenis_trans="Keranjang";
	$query="insert into tbl_trans values ('$id_trans','$id_pembeli','$total','$total_berat','$jasa','0','$pembayaran','','$catatan','$jenis_trans','Belum Bayar',Now())";
						$con->query($query);
	unset($_SESSION['items']);
	header('location:index.php?aksi=page&page=response&id_trans='.$id_trans);
	}else{
		echo "Gagal Disimpan";
	}
}
?>
<div style="margin-top: 10px; margin-left: 2%; width: 96%; margin-bottom: 10px;">
<h3>Formulir Order Batik</h3>
	<div id="different_address">
		
		<form action="#" method="POST">
			Nama Lengkap<br>
			<input name="nama" type="text" size="50" required=""><br><br>
			Alamat Pengiriman<br>
			<textarea name="alamat" cols="50" required=""></textarea><br><br>
			Kode Pos<br>
			<input name="pos" size="30" type="text" required=""><br><br>
			Telpon<br>
			<input name="telp" size="30" type="text" required=""><br><br>
			Email<br>
			<input name="email" size="50" type="text"><br><br>
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
				<option value="">--Pembayaran--</option>
				<option value="Bayar Langsung">Bayar Langsung</option>
				<option value="Transfer">Transfer</option>
			</select><br><br>
			Catatan<br>
			<textarea name="catatan" cols="50" rows="5"></textarea><br><br>
			<input value="Proses" name="simpan_transaksi" class="btn-red" type="submit">
		</form>
	</div>


	<h3 style="margin-left: 10px;">Keranjang Belanja</h3>
			<table border="1" width="96%" cellpadding="2" cellspacing="0" style="margin-left: 2%; margin-bottom: 10px;">
				<tr>
					<th>Kode</th>
					<th>Model Batik</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th>Sub Total</th>
					<th>Jenis Beli</th>
					<th>Berat (gr)</th>
					<th>Aksi</th>
				</tr>
				<?php
				if (!empty($_SESSION['items'])){
					$total=0;
					$berat=0;
					foreach ($_SESSION['items'] as $key => $value) {
						$query="select * from tbl_batik where id_batik='$key'";
						$res=$con->query($query);
						$data=$res->fetch_array(MYSQLI_BOTH);
						?>
						<tr>
							<td align="center"><?php echo $key; ?></td>
							<td><?php echo $data['model_batik']; ?></td>
							<?php if ($data['min_grosir']>0 and $value>=$data['min_grosir']){
								?>
								<td align="Right"><?php echo $data['harga_grosir']; ?></td>
								<td align="center"><?php echo $value; ?></td>
								<td align="Right"><?php $sub_total=$data['harga_grosir']*$value; echo $sub_total; $total+=$sub_total; ?>
									
								</td>
								<td align="center"><?php echo "Grosir"; ?></td>
								<?php
								}else{
									?>
									<td align="Right"><?php echo $data['harga_eceran']; ?></td>
									<td align="center"><?php echo $value; ?></td>
									<td align="Right"><?php $sub_total=$data['harga_eceran']*$value; echo $sub_total; $total+=$sub_total;?></td>
									<td align="center"><?php echo "Eceran"; ?></td>
									<?php
									} ?>
							<td align="center"><?php $total_berat=$data['berat']*$value; echo $total_berat; $berat+=$total_berat; ?></td>
							<td>
								<a class="btn-blue" href="index.php?aksi=add&amp;id_batik=<?php echo $key; ?>">+</a>
								<a class="btn-green" href="index.php?aksi=min&amp;id_batik=<?php echo $key; ?>">-</a>
								<a class="btn-red" href="index.php?aksi=hapus&amp;id_batik=<?php echo $key; ?>">Hapus</a>
							</td>
						</tr>
						<?php
					}
				}
				?>
			</table>
						<?php if (!empty($_SESSION['items'])){ ?>
			<br>
							Total Berat : <h4 style="margin: 0;"><?php echo $berat; ?> Gram </h4>
							<br>
							Total Belanja : <h2 style="margin: 0;">Rp.<?php echo number_format($total,0,".","."); ?></h2>
							<br>
							* Belum Termasuk Ongkos Kirim<br>
							* Lakukan Konfirmasi Orderan untuk mengetahui jumlah yang harus ditransfer
							<br>
						<?php } ?>
</div>
			