<?php

session_start();
include "koneksi.php";

if(!isset($_SESSION['login'])){
	header('location:login.php');
}

// jika ada get act
if(isset($_GET['act'])){

	//act insert
	if($_GET['act']=='insert'){
		//proses menyimpan data
		//menyimpan kiriman form ke variabel
		$kode 			= $_POST['kode_golongan'];
		$nama 			= $_POST['nama_golongan'];

		if($kode =='' || $nama ==''){
			header('location:data_golongan.php?view=tambah&e=bl');
		}else{
			//proses query simpan data
			$simpan = mysqli_query($konek, "INSERT INTO golongan (kode_golongan,nama_golongan) VALUES ('$kode','$nama')");

		if($simpan){
			header('location:data_golongan.php?e=sukses');
		}else{
			header('location:data_golongan.php?e=gagal');
		}
	}
}

	//jika act update
	elseif ($_GET['act']=='update'){
	//menyimpan kiriman form ke variabel
		$kode 			= $_POST['kode_golongan'];
		$nama 			= $_POST['nama_golongan'];

		if($kode =='' || $nama ==''){
			header('location:data_golongan.php?view=edit&e=bl');
		}else{
			//proses query update data
			$update = mysqli_query($konek, " UPDATE golongan SET nama_golongan='$nama'
								WHERE kode_golongan='$kode'");
			if($update){
			header('location:data_golongan.php?e=sukses');
		}else{
			header('location:data_golongan.php?e=gagal');
		}
		}
}
//jika act del
elseif($_GET['act']=='del'){
	$hapus=mysqli_query($konek, "DELETE FROM golongan WHERE kode_golongan='$_GET[id]'");

	if($hapus){
			header('location:data_golongan.php?e=sukses');
		}else{
			header('location:data_golongan.php?e=gagal');
		}
	}
}

?>