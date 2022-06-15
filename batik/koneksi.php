<?php
if (!isset($_SESSION)){
	session_start();
}
$con=new mysqli("localhost","root","","db_batik");
if ($con){

}else{
	echo "Koneksi Gagal";
}
?>