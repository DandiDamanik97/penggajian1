<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['login'])){
	header('Location:login.php');

}

//jika ada get act
if(isset($_GET['act'])){


	//jika act = insert
	if($_GET['act'] == 'insert'){
		//simpan sinputan form ke variabel
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$namalengkap = $_POST['namalengkap'];

		//apabila form belum lengkap
		if($username=='' || $_POST['password']=='' ||$username==''){
			//header('Location:data_admin.php?view=tambah');
			echo"form anda belum lengkap....";
		}else{
			//proses simpan data
			$simpan = mysqli_query($konek, "INSERT INTO admin(username,password,namalengkap)VALUES('$username','$password','$namalengkap')");

			if($simpan){
				header('location:data_admin.php?e=sukses');
			}else{
				header('location:data_admin.php?e=gagal');

			}
		}
	}elseif ($_GET['act']=='update') {//jika act=update
		$idadmin = $_POST['idadmin'];
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$namalengkap = $_POST['namalengkap'];

		//apabila form belum lengkap
		if($username=='' || $namalengkap==''){
			//header('Location:data_admin.php?view=tambah&e=b1');
			echo "form anda belum lengkap....";
		}else{

			if($_POST['password']==''){
				$update= mysqli_query($konek, "UPDATE admin SET username='$username',
																namalengkap='$namalengkap'
															WHERE idadmin='$idadmin'");
			}else{
				$update= mysqli_query($konek, "UPDATE admin SET username='$username',
																password='$password',
																namalengkap='$namalengkap'
															WHERE idadmin='$idadmin'");

			}
			if($update){
				header('location:data_admin.php?e=sukses');
			}else{
				header('location:data_admin.php?e=gagal');

			}
		}
	}elseif($_GET['act']=='del') { // jika act = delete
		$hapus = mysqli_query($konek, "DELETE FROM admin WHERE idadmin='$_GET[id]' AND idadmin!='13'");

		if($hapus){
			header('location:data_admin.php?e=sukses');
		}else{
			header('location:data_admin.php?e=gagal');
		}
	} else { //jika act bukan insert,update atau delete
		header('location:data_admin.php');
	}

	}else{ // jika tidak ada get act
	header('location:data_admin.php');

}
?>