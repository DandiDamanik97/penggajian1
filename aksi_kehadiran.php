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
		//menyimpan kiriman form ke variabel
		$bulan 		=$_POST['bulan'];
		$nip		=$_POST['nip'];
		$masuk		=$_POST['masuk'];
		$S1			=$_POST['S1'];
		$S2			=$_POST['S2'];
		$P3			=$_POST['P3'];
		$P4			=$_POST['P4'];
		$C			=$_POST['C'];
		$M			=$_POST['M'];
		$potongan	=$_POST['potongan'];

		$count = count($nip);

		$sql ="INSERT INTO master_gaji(bulan,nip,masuk,S1,S2,P3,P4,C,M,potongan) VALUES";

		for ($i=0; $i < $count; $i++){
			$sql .="('{$bulan[$i]}','{$nip[$i]}','{$masuk[$i]}','{$S1[$i]}','{$S2[$i]}','{$P3[$i]}','{$P4[$i]}','{$C[$i]}','{$M[$i]}','{$potongan[$i]}')";
		$sql .= " , ";
	}

	$sql = rtrim($sql," , ");

	$simpan = mysqli_query($konek, $sql);


	if($simpan){
		header('location:data_kehadiran.php?e=sukses');
	}else{
		header('location:data_kehadiran.php?e=gagal');
		}
	}


	//jika act update
	elseif ($_GET['act']=='update'){
		//menyimpan kiriman form ke variabel
		$bulan 		=$_POST['bulan'];
		$nip		=$_POST['nip'];
		$masuk		=$_POST['masuk'];
		$S1			=$_POST['S1'];
		$S2			=$_POST['S2'];
		$P3			=$_POST['P3'];
		$P4			=$_POST['P4'];
		$C			=$_POST['C'];
		$M			=$_POST['M'];
		$potongan	=$_POST['potongan'];

		$count = count($nip);

		for ($i=0; $i < $count; $i++){
			$update=mysqli_query($konek,"UPDATE master_gaji SET masuk='$masuk[$i]', S1='$S1[$i]', S2='$S2[$i]', P3='$P3[$i]', P4='$P4[$i]',C='$C[$i]', M='$M[$i]', potongan='$potongan[$i]' WHERE bulan='$bulan[$i]' AND nip='$nip[$i]'");
	}

			if($update){
			header('location:data_kehadiran.php?e=sukses');
		}else{
			header('location:data_kehadiran.php?e=gagal');
		}
		}

//jika act del
elseif($_GET['act']=='del'){
	$hapus=mysqli_query($konek, "DELETE FROM pegawai WHERE nip='$_GET[id]'");

	if($hapus){
			header('location:data_kehadiran.php?e=sukses');
		}else{
			header('location:data_kehadiran.php?e=gagal');
		}
	}
}
?>