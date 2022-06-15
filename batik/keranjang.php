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
							* Belum Termasuk Ongkos Kirim<br><br>
							<a class="btn-blue" href="index.php?aksi=page&amp;page=proses">Order Sekarang</a> <a class="btn-red" href="index.php?aksi=batal">Batalkan Semua</a>
							<br>
						<?php } ?>