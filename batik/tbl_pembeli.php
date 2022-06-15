<h3>Data Pembeli</h3>
<table border="1" cellspacing="0" cellpadding="5" width="98%">
	<thead>
		<tr>
			<th>No</th>
			<th>ID</th>
			<th>Nama Pembeli</th>
			<th>Alamat</th>
			<th>Kode Pos</th>
			<th>Telpon</th>
			<th>Email</th>
		</tr>
	</thead>
	<tbody>
			<?php
			$n=1;
			$query="select * from tbl_pembeli order by id_pembeli desc";
			$res=$con->query($query);
			while ($data=$res->fetch_array(MYSQLI_BOTH)){
				?>
			<tr>	
				<td align="center"><?php echo $n; ?></td>
				<td align="center"><?php echo $data['id_pembeli']; ?></td>
				<td><?php echo $data['nama_lengkap']; ?></td>
				<td><?php echo $data['alamat']; ?></td>
				<td align="center"><?php echo $data['pos']; ?></td>
				<td align="center"><?php echo $data['telp']; ?></td>
				<td><?php echo $data['email']; ?></td>
			</tr>	
				<?php
				$n++;
			}
			?>
	</tbody>
</table>
<br>