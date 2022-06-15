<?php 
include "koneksi.php"; 
if (isset($_GET['aksi']) and $_GET['aksi']=="add"){
	if (isset($_GET['id_batik'])){
		$id_batik=$_GET['id_batik'];
		if (!isset($_SESSION['items'][$id_batik])){
			$_SESSION['items'][$id_batik]=1;
			header('location:index.php?aksi=page&page=keranjang');
		}else{
			$_SESSION['items'][$id_batik]+=1;
			header('location:index.php?aksi=page&page=keranjang');
		}
	}
}

if (isset($_GET['aksi']) and $_GET['aksi']=="min"){
	if (isset($_GET['id_batik'])){
		$id_batik=$_GET['id_batik'];
		if ($_SESSION['items'][$id_batik]<=1){
			unset($_SESSION['items'][$id_batik]);
			header('location:index.php?aksi=page&page=keranjang');
		}else{
			$_SESSION['items'][$id_batik]-=1;
			header('location:index.php?aksi=page&page=keranjang');
		}
	}
}

if (isset($_GET['aksi']) and $_GET['aksi']=="hapus"){
		if (isset($_GET['id_batik'])){
		$id_batik=$_GET['id_batik'];
		unset($_SESSION['items'][$id_batik]);
		header('location:index.php?aksi=page&page=keranjang');
		}

	}

if (isset($_GET['aksi']) and $_GET['aksi']=="batal"){
		unset($_SESSION['items']);
		header('location:index.php?aksi=page&page=keranjang');
	}

if (isset($_POST['cari'])){
	$id_trans=$_POST['id_trans'];
	header('location:index.php?aksi=page&page=keranjang_saya&id_trans='.$id_trans);
}

if (!empty($_GET['action']) and $_GET['action']=="logout"){
	session_destroy();
	header('location:index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Toko Batik Prima Sari</title>
<link rel="stylesheet" type="text/css" href="css.css">
</head>
<body style="margin-top: 0;color: #666; background-image:url('body.jpg'); background-position: center; background-size: 100%;">
<div class="container">
	<div class="header" id="grad-yellow">
		<h1>Toko Batik Prima Sari</h1>
		<h2>Menjual Bermacam Jenis dan Model Batik Seluruh Nusantara</h2>
	</div>
	<div class="nav">
		<ul>
			<li><a href="index.php">Beranda</a></li>
			<li><a href="index.php?aksi=page&amp;page=contact">Hubungi</a></li>
			<li><a href="index.php?aksi=page&amp;page=tentang">Tentang</a></li>
			<?php if (!empty($_SESSION['id_admin'])){ ?>
			<li style="float: right;"><a href="index.php?action=logout">Logout</a></li>
			<?php }else{ ?><li style="float: right;"><a href="index.php?aksi=page&amp;page=login">Login</a></li><?php } ?>
			<li style="float: right;"><a href="index.php?aksi=page&amp;page=keranjang">Keranjang <strong></strong></a></li>
			<li style="float: right;"><a href="index.php?aksi=page&amp;page=pemesanan">Order Banyak</a></li>
			
		</ul>
	</div>
	<div class="section">
		<div class="content" id="grad-silver">
			<div class="artikel">

			<?php
			if (empty($_GET['page'])){
			$query="select * from tbl_batik order by id_batik desc";
			$query=$con->query($query);
			while ($res=$query->fetch_array(MYSQLI_BOTH)){
			?>
				<div class="body-artikel">
					<div class="img-artikel"><a href="index.php?aksi=page&page=detail&detail=<?php echo $res['id_batik']; ?>"><img style="max-height: 200px;" src="gambar/<?php echo $res['gambar']; ?>"/></a></div>
					<div class="caption-artikel">
						<h3><a href="index.php?aksi=page&page=detail&detail=<?php echo $res['id_batik']; ?>"><?php echo $res['model_batik']; ?></a></h3>
						<small>Grosir</small> <br><strong>Rp.<?php echo number_format($res['harga_grosir'],0,".","."); ?> </strong> <small>(Min. <?php echo $res['min_grosir']; ?> Pcs)</small><br>
						<small>Eceran</small> <strong>Rp.<?php echo number_format($res['harga_eceran'],0,".","."); ?> </strong><br>
						<small>Size</small> <strong><?php echo $res['ukuran']; ?></strong><br>
						<small>Kode</small> <strong><?php echo $res['id_batik']; ?></strong><br>
						<a class="btn-red" href="index.php?aksi=add&amp;id_batik=<?php echo $res['id_batik']; ?>">Beli</a>
					</div>
				</div>
			<?php } } ?>

			
			
			<?php 
			if (isset($_GET['aksi']) and $_GET['aksi']=="page" and !empty($_GET['page']) and $_GET['page']=="data_batik"){ 
				include "frm_batik.php";
			 }
			 if (isset($_GET['aksi']) and $_GET['aksi']=="page" and !empty($_GET['page']) and $_GET['page']=="pembayaran"){ 
				include "frm_pembayaran.php";
			 }

			 if (isset($_GET['aksi']) and $_GET['aksi']=="page" and !empty($_GET['page']) and $_GET['page']=="login"){ 
				include "login.php";
			 }

			 if (isset($_GET['aksi']) and $_GET['aksi']=="page" and !empty($_GET['page']) and $_GET['page']=="data_pembayaran"){ 
				include "tbl_pembayaran.php";
			 }
			 if (isset($_GET['aksi']) and $_GET['aksi']=="page" and !empty($_GET['page']) and $_GET['page']=="kategori" and !empty($_GET['kategori'])){ 
				include "kategori.php";
			 }
			 if (isset($_GET['aksi']) and $_GET['aksi']=="page" and !empty($_GET['page']) and $_GET['page']=="input_batik"){ include "frm_batik.php";
			 }

			 if (isset($_GET['aksi']) and $_GET['aksi']=="page" and !empty($_GET['page']) and $_GET['page']=="data_kategori"){ 
				include "frm_kategori.php";
			 }
			 if (isset($_GET['aksi']) and $_GET['aksi']=="page" and !empty($_GET['page']) and $_GET['page']=="data_order"){ 
				include "tbl_order.php";
			 }
			 if (isset($_GET['aksi']) and $_GET['aksi']=="page" and !empty($_GET['page']) and $_GET['page']=="data_order_banyak"){ 
				include "tbl_order_banyak.php";
			 }
			 if (isset($_GET['aksi']) and $_GET['aksi']=="page" and !empty($_GET['page']) and $_GET['page']=="input_kategori"){ include "frm_kategori.php";
			 }

			 if (isset($_GET['aksi']) and $_GET['aksi']=="page" and !empty($_GET['page']) and $_GET['page']=="tabel_pembeli"){ include "tbl_pembeli.php";
			 }

			 if (isset($_GET['aksi']) and $_GET['aksi']=="page" and !empty($_GET['page']) and $_GET['page']=="ongkir"){ include "ongkir.php";
			 }

			if (isset($_GET['aksi']) and $_GET['aksi']=="page" and !empty($_GET['page']) and $_GET['page']=="contact"){ 
				include "contact.php";
			 }

			if (isset($_GET['aksi']) and $_GET['aksi']=="page" and !empty($_GET['page']) and $_GET['page']=="detail" and !empty($_GET['detail'])){ 
				include "detail.php";
			 }
 
			if (isset($_GET['aksi']) and $_GET['aksi']=="page" and !empty($_GET['page']) and $_GET['page']=="tentang"){ 
				include "tentang.php";
			 } 

			if (isset($_GET['aksi']) and $_GET['aksi']=="page" and !empty($_GET['page']) and $_GET['page']=="keranjang"){ 
				include "keranjang.php";
			 }

			if (isset($_GET['aksi']) and $_GET['aksi']=="page" and !empty($_GET['page']) and $_GET['page']=="proses"){ 
				include "proses.php";

			 }

			 if (isset($_GET['aksi']) and $_GET['aksi']=="page" and !empty($_GET['page']) and $_GET['page']=="pemesanan"){ 
				include "frm_pemesanan.php";
			 }

			if (isset($_GET['aksi']) and $_GET['aksi']=="page" and !empty($_GET['page']) and $_GET['page']=="keranjang_saya" and empty($_GET['id_trans'])){ 
				include "keranjang_saya.php";
			 }

			if (isset($_GET['aksi']) and $_GET['aksi']=="page" and !empty($_GET['page']) and $_GET['page']=="keranjang_saya" and !empty($_GET['id_trans'])){
			 	$id_trans=$_GET['id_trans']; 
				include "keranjang_saya.php";
			 }

			 if (isset($_GET['aksi']) and $_GET['aksi']=="page" and !empty($_GET['page']) and $_GET['page']=="response" and !empty($_GET['id_trans'])){ 
				?>
				<div style="margin-top: 10px; margin-left: 2%; width: 96%; margin-bottom: 10px;">
				<center>
				Id Transaksi Anda Adalah<br>
				<a href="index.php?aksi=page&amp;page=keranjang_saya&amp;id_trans=<?php echo $_GET['id_trans']; ?>"><h1><?php echo $_GET['id_trans']; ?></h1></a>
				Kami akan segera memberitahukan total biaya yang harus anda Transfer<br>Hati-hati terhadap segala bentuk penipuan, jangan melakukan transfer selain ke nomor rekening kami
				</center>
				</div>
				<?php
			 } ?>
			</div>
		</div>
		<div class="sidebar">
		<?php if (!empty($_SESSION['id_admin'])){ ?>
		<div class="sub-menu">
			<h3>Menu Admin</h3>
			<hr>
			<ul>
				<li><h4 style="margin: 0;">Master</h4></li>
				<li><a href="index.php?aksi=page&amp;page=data_batik">Data Batik</a></li>
				<li><a href="index.php?aksi=page&amp;page=data_kategori">Data Kategori</a></li>
			</ul>
			<ul>
				<li><h4 style="margin: 0;">Transaksi</h4></li>
				<li><a href="index.php?aksi=page&amp;page=tabel_pembeli">Data Pembeli</a></li>
				<li><a href="index.php?aksi=page&amp;page=data_order">Data Order</a></li>
				<li><a href="index.php?aksi=page&amp;page=data_order_banyak">Data Order Banyak</a></li>
				<li><a href="index.php?aksi=page&amp;page=data_pembayaran">Data Pembayaran</a></li>
			</ul>
			<ul>
				<li><h4 style="margin: 0;">Laporan</h4></li>
				<li><a target="_blank" href="lap_batik.php">Laporan Batik</a></li>
				<li><a target="_blank" href="lap_pembeli.php">Laporan Pembeli</a></li>
				<li><a target="_blank" href="lap_transaksi.php">Laporan Transaksi</a></li>
				<li><a target="_blank" href="lap_pembayaran.php">Laporan Pembayaran</a></li>
			</ul>
		</div>
		<?php } ?>

			<div class="sub-menu">
				<form action="#" method="POST">
					<input type="text" name="id_trans" required="" placeholder="Masukkan ID Transaksi">
					<button class="btn-red" style="border: 0; margin: 5px 5px 5px 0;" name="cari">Cari</button>
				</form>
			</div>
			<div class="sub-menu">
				<h3>Kategori Batik</h3>
				<ul>
					<?php
					$query="select * from tbl_kategori order by kategori asc";
					$kategori=$con->query($query);
					while ($dk=$kategori->fetch_array(MYSQLI_BOTH)){
						?>
						<li><a href="index.php?aksi=page&amp;page=kategori&amp;kategori=<?php echo $dk['kategori']; ?>"><?php echo $dk['kategori']; ?></a></li>
						<?php
					}
					?>
				</ul>
			</div>

			<div class="sub-menu">
				
			</div>
		</div>
	</div>
	<div class="footer"><p>&copy; Copyright <?php echo date('Y'); ?> - Prima Sari All Right Reserved</p></div>
</div>
</body>
</html>