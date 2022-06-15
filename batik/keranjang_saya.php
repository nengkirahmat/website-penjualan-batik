<?php if (empty($_GET['page'])){ ?>
<center>
<h1>Toko Batik Prima Sari</h1>
<h2>Faktur Transaksi Pembelian Batik</h2>
</center>
<?php }else{ ?>
<h3 style="margin-left: 10px;">Data Keranjang Belanja</h3>
<?php } ?>
<?php
if (empty($_GET['page'])){
include "koneksi.php";
?>
<script>window.print();</script>
<?php
}
$id_trans=$_GET['id_trans'];
$query="select * from tbl_trans where id_trans='$id_trans'";
$cari=$con->query($query);
$cari=$cari->num_rows;
if ($cari<1){ echo "<h2>Opss..!!!</h2>Transaksi Tidak Ditemukan...!!!"; }else{
			if (isset($_GET['id_trans'])){ echo "<h2 style='margin-left:30px;'>Id Transaksi : ".$_GET['id_trans']."</h2>"; } 
				include "koneksi.php";
					$total=0;
					$berat=0;
					$nama="";
					$alamat="";
					$telp="";
					$ongkir=0;
					$jasa="";
					$n=1;
					$cek="";
					$status_bayar="";
						if (isset($_GET['id_trans'])){
							$id_trans=$_GET['id_trans'];
							$query="select * from tbl_trans where id_trans='$id_trans'";
							$cek=$con->query($query);
							$cek=$cek->fetch_array();
							if ($cek['jenis_trans']=="Order Banyak"){
								$cek=$cek['jenis_trans'];
								$query="select * from tbl_pembeli,tbl_trans where tbl_pembeli.id_pembeli=tbl_trans.id_pembeli and tbl_trans.id_trans='$id_trans'";	
							}else{
							$query="select * from tbl_cart,tbl_batik,tbl_pembeli,tbl_trans where tbl_cart.id_batik=tbl_batik.id_batik and tbl_cart.id_trans='$id_trans' and tbl_pembeli.id_pembeli=tbl_cart.id_pembeli and tbl_trans.id_trans=tbl_cart.id_trans order by tbl_cart.id_cart asc";
							}
						}else{
						$query="select * from tbl_cart,tbl_batik where tbl_cart.id_batik=tbl_batik.id_batik order by tbl_cart.id_trans desc";
						}
			if ($cek=="Order Banyak"){
				$res=$con->query($query);
				$data=$res->fetch_array(MYSQLI_BOTH);
				if (isset($_GET['id_trans'])){
						$nama=$data['nama_lengkap'];
						$alamat=$data['alamat'];
						$telp=$data['telp'];
						$ongkir=$data['ongkir'];
						$jasa=$data['jasa'];
						$total=$data['total_belanja'];
						$berat=$data['total_berat'];
						$status_bayar=$data['status_bayar'];
						echo "<h4 style='margin:0;'>Pesanan Anda</h4><p>".$data['pesanan']."</p>";
						} 
				}else{
			?>
			<table border="1" width="98%" cellpadding="2" cellspacing="0" style="margin-left: 1%; margin-bottom: 10px;">
				<tr>
					<th>No</th>
					<th>Kode</th>
					<th>Model Batik</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th>Sub Total</th>
					<th>Jenis Beli</th>
					<th>Berat (gr)</th>
				</tr>
				<?php
						$res=$con->query($query);
						while ($data=$res->fetch_array(MYSQLI_BOTH)){
						?>
						<tr>
							<td align="center"><?php echo $n; ?></td>
							<td align="center"><?php echo $data['id_batik']; ?></td>
							<td><?php if (!empty($_GET['page'])){ ?><a href="index.php?aksi=page&page=detail&detail=<?php echo $data['id_batik']; ?>"><?php echo $data['model_batik']; ?></a><?php }else{ echo $data['model_batik']; } ?></td>
							<?php if ($data['min_grosir']>0 and $data['jumlah']>=$data['min_grosir']){
								?>
								<td align="Right">Rp.<?php echo number_format($data['harga_grosir'],0,".","."); ?></td>
								<td align="center"><?php echo $data['jumlah']; ?></td>
								<td align="Right">Rp.<?php $sub_total=$data['harga_grosir']*$data['jumlah']; echo number_format($sub_total,0,".","."); $total+=$sub_total; ?>
									
								</td>
								<td align="center"><?php echo "Grosir"; ?></td>
								<?php
								}else{
									?>
									<td align="Right"><?php echo $data['harga_eceran']; ?></td>
									<td align="center"><?php echo $data['jumlah']; ?></td>
									<td align="Right"><?php $sub_total=$data['harga_eceran']*$data['jumlah']; echo $sub_total; $total+=$sub_total;?></td>
									<td align="center"><?php echo "Eceran"; ?></td>
									<?php
									} ?>
							<td align="center"><?php $total_berat=$data['berat']*$data['jumlah']; echo $total_berat; $berat+=$total_berat; ?></td>
							
						</tr>
						<?php
						$n++;
						if (isset($_GET['id_trans'])){
						$nama=$data['nama_lengkap'];
						$alamat=$data['alamat'];
						$telp=$data['telp'];
						$ongkir=$data['ongkir'];
						$jasa=$data['jasa'];
						$status_bayar=$data['status_bayar'];
						}
					}
					?>	

			</table>
			<?php } ?>

<?php if (isset($_GET['id_trans'])){
$id_trans=$_GET['id_trans'];
$query="select * from tbl_trans,tbl_bayar where tbl_trans.id_trans='$id_trans' and tbl_trans.id_trans=tbl_bayar.id_trans";
$cb=$con->query($query);
$rc=$cb->num_rows;
$db=$cb->fetch_array();
if ($rc>0 and $db['status_bayar']<>"Dibayar"){ echo "<h3>Pembayaran Masih Dalam Pengecekan</h3>"; }else{
?>
			<br>
				<div style="width: 50%; float: left;">
							Nama Pembeli : <h3 style="margin: 0;"><?php echo $nama; ?> </h3><br>
							Telp / HP : <h3 style="margin: 0;"><?php echo $telp; ?> </h3><br>
							Alamat Pembeli : <p style="margin: 0;"><?php echo $alamat; ?> </p><br>
							</div>
				<div style="width: 50%; clear: none; float: left;">
							Total Berat : <h4 style="margin: 0;"><?php echo $berat; ?> Gram </h4><br>
							<?php if ($ongkir=="0" and $ongkir<>"Gratis"){ echo "<h2>Transaksi anda masih dalam proses Pengecekan.</h2><p>Silahkan hubungi kami untuk mempercepat proses transaksi anda, jika proses Pengecekan telah selesai anda dapat melihat Jumlah Biaya yang harus anda bayar/transfer di bagian ini</p>"; }else{ ?>
							Biaya Kirim : <h4 style="margin: 0;"><?php if ($ongkir=="Gratis" or $ongkir=="0"){ echo $ongkir; }else{ echo "Rp.".number_format($ongkir,0,".","."); } ?> <small>via</small> <?php echo $jasa; ?> </h4><br>
							Sub Total : <h4 style="margin: 0;">Rp.<?php echo number_format($total,0,".","."); ?></h4><br>
							Total Pembayaran : <h2 style="margin: 0;">Rp.<?php if ($ongkir=="Gratis"){ $tbayar=$total; }else{ $tbayar=$total+$ongkir; } echo number_format($tbayar,0,".","."); ?> <small>(<?php if ($status_bayar<>"Dibayar"){ echo "Belum Bayar"; }else{ echo "Sudah Dibayar"; } ?>)</small></h2>

							<?php if ($status_bayar<>"Dibayar"){ ?>
							<p>Silahkan bayar sesuai Total Pembayaran diatas.</p>
							<a class="btn-blue" href="index.php?aksi=page&amp;page=pembayaran&amp;id_trans=<?php echo $_GET['id_trans']; ?>">Pembayaran</a>
							<?php } } ?>
							<br>
				</div>
				<?php if (!empty($_GET['page'])){ ?>
				<div style="width: 100%; clear: both; float: none;"><a class="btn-green" href="keranjang_saya.php?id_trans=<?php echo $_GET['id_trans']; ?>">Cetak Transaksi</a></div>
				<?php } ?>
<?php } } } ?>