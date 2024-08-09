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
		$nip 				= $_POST['nip'];
		$nama_pegawai		= $_POST['nama_pegawai'];
		$kodejabatan		= $_POST['kodejabatan'];
		$Kode_Golongan 		= $_POST['Kode_Golongan'];
		$gapok 				= $_POST['gapok'];
		$tunj_jabatan		= $_POST['tunj_jabatan'];
		$TMK 				= $_POST['TMK'];
		$TPK 				= $_POST['TPK'];
		$premi_hadir		= $_POST['premi_hadir'];
		$tunj_lain_lain		= $_POST['tunj_lain_lain'];
		$bpjs_kerja			= $_POST['bpjs_kerja'];
		$bpjs_kesehatan		= $_POST['bpjs_kesehatan'];
		

		if($nip =='' || $nama_pegawai =='' || $kodejabatan =='' || $Kode_Golongan =='' || $gapok =='' || $tunj_jabatan =='' || $TMK ==''|| $TPK =='' || $premi_hadir ==''|| $tunj_lain_lain =='' || $bpjs_kerja ==''|| $bpjs_kesehatan ==''){
			header('location:data_pegawai.php?view=tambah&e=bl');

		}else{
			//proses query simpan data
			$simpan = mysqli_query($konek, "INSERT INTO pegawai (nip,nama_pegawai,kodejabatan,Kode_Golongan,gapok,tunj_jabatan,TMK,TPK,premi_hadir,tunj_lain_lain,bpjs_kerja,bpjs_kesehatan) 
				VALUES ('$nip','$nama_pegawai','$kodejabatan','$Kode_Golongan','$gapok','$tunj_jabatan','$TMK','$TPK','$premi_hadir','$tunj_lain_lain','$bpjs_kerja','$bpjs_kesehatan')");

		if($simpan){
			header('location:data_pegawai.php?e=sukses');
		}else{
			header('location:data_pegawai.php?e=gagal');
		}
	}
}

	//jika act update
	elseif ($_GET['act']=='update'){
	//menyimpan kiriman form ke variabel
		$nip 				= $_POST['nip'];
		$nama_pegawai 		= $_POST['nama_pegawai'];
		$kodejabatan		= $_POST['kodejabatan'];
		$Kode_Golongan 		= $_POST['Kode_Golongan'];
		$gapok 				= $_POST['gapok'];
		$tunj_jabatan		= $_POST['tunj_jabatan'];
		$TMK 				= $_POST['TMK'];
		$TPK 				= $_POST['TPK'];
		$premi_hadir		= $_POST['premi_hadir'];
		$tunj_lain_lain		= $_POST['tunj_lain_lain'];
		$bpjs_kerja			= $_POST['bpjs_kerja'];
		$bpjs_kesehatan		= $_POST['bpjs_kesehatan'];

		if($nip =='' || $nama_pegawai =='' || $kodejabatan =='' || $Kode_Golongan ==''|| $gapok =='' || $tunj_jabatan =='' || $TMK ==''|| $TPK =='' || $premi_hadir ==''|| $tunj_lain_lain =='' || $bpjs_kerja ==''|| $bpjs_kesehatan ==''){
			header('location:data_pegawai.php?view=edit&e=bl');
		}else{
			//proses query update data
			$update = mysqli_query($konek, " UPDATE pegawai SET nama_pegawai='$nama_pegawai',
									kodejabatan='$kodejabatan',
									Kode_Golongan='$Kode_Golongan',
									gapok='$gapok',
									tunj_jabatan='$tunj_jabatan',
									TMK='$TMK',
									TPK='$TPK',
									premi_hadir='$premi_hadir',
									tunj_lain_lain='$tunj_lain_lain',
									bpjs_kerja='$bpjs_kerja',
									bpjs_kesehatan='$bpjs_kesehatan'
								WHERE nip='$nip'");
			if($update){
			header('location:data_pegawai.php?e=sukses');
		}else{
			header('location:data_pegawai.php?e=gagal');
		}
		}
}
//jika act del
elseif($_GET['act']=='del'){
	$hapus=mysqli_query($konek, "DELETE FROM pegawai WHERE nip='$_GET[id]'");

	if($hapus){
			header('location:data_pegawai.php?e=sukses');
		}else{
			header('location:data_pegawai.php?e=gagal');
		}
	}
}

?>