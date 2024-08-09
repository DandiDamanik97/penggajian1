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
		$kode = $_POST['kodejabatan'];
		$nama = $_POST['namajabatan'];

		if($kode =='' || $nama ==''){
			header('location:data_jabatan.php?view=tambah&e=bl');

		}else{
			//proses query simpan data
			$simpan = mysqli_query($konek, "INSERT INTO jabatan (kodejabatan,namajabatan) VALUES ('$kode','$nama')");

		if($simpan){
			header('location:data_jabatan.php?e=sukses');
		}else{
			header('location:data_jabatan.php?e=gagal');
		}
	}
}

	//jika act update
	elseif ($_GET['act']=='update'){
	//menyimpan kiriman form ke variabel
		$kode = $_POST['kodejabatan'];
		$nama = $_POST['namajabatan'];

		if($kode =='' || $nama ==''){
			header('location:data_jabatan.php?view=tambah&e=bl');
		}else{
			//proses query update data
			$update = mysqli_query($konek, " UPDATE jabatan SET namajabatan='$nama' WHERE kodejabatan='$kode'");
			if($update){
			header('location:data_jabatan.php?e=sukses');
		}else{
			header('location:data_jabatan.php?e=gagal');
		}
		}
}
//jika act del
elseif($_GET['act']=='del'){
	$hapus=mysqli_query($konek, "DELETE FROM jabatan WHERE kodejabatan='$_GET[id]'");

	if($hapus){
			header('location:data_jabatan.php?e=sukses');
		}else{
			header('location:data_jabatan.php?e=gagal');
		}
	}
}

?>