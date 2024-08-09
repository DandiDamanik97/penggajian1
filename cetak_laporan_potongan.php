<?php
session_start();
if(isset($_SESSION['login'])){
	include "koneksi.php";
	include "fungsi.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Laporan Data Potongan Gaji Pegawai</title>
	<style type="text/css">
		body{
			font-family: Arial;
		}
		table{
			border-collapse: collapse;
		}

		@media print{
			.no-print{
				display: none;
			}
		}
	</style>
	<link href='assets/img/login.jpg' rel='shortcut icon' />
	
</head>
<body>
<h3>PT.INDOWIRA PUTRA PAINT</h3>
<hr>
<p>LAPORAN DATA POTONGAN GAJI PEGAWAI</p>
<table>
	<tr>
		<td width="100px">Bulan</td>
		<td width="4px">:</td>
		<td><?php echo bulanIndonesia($_GET['bulan']); ?></td>
	</tr>
	<tr>
		<td width="100px">Tahun</td>
		<td width="4px">:</td>
		<td><?php echo $_GET['tahun']; ?></td>
	</tr> 
	
</table>
<br>
<table border="1" cellpadding="5" cellspacing="0" width="1000px">
	<tr>
		<th>NO.</th>
		<th>NIP</th>
		<th>Nama Pegawai</th>
		<th>Jabatan</th>
		<th>Golongan</th>
		<th>Potongan</th>
	</tr>

	<?php
	if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
		$bulan = $_GET['bulan'];
		$tahun = $_GET['tahun'];
		$bulantahun = $bulan.$tahun;
	}else{
		$bulan = date('m');
		$tahun = date('Y');
		$bulantahun = $bulan.$tahun;
	}

	$sql=mysqli_query($konek, "SELECT pegawai.nip,pegawai.nama_pegawai,jabatan.namajabatan,
						golongan.nama_golongan,master_gaji.potongan
						FROM pegawai
						INNER JOIN jabatan ON jabatan.kodejabatan=pegawai.kodejabatan
						INNER JOIN golongan ON golongan.kode_golongan=pegawai.kode_golongan
						INNER JOIN master_gaji ON master_gaji.nip=pegawai.nip
						WHERE master_gaji.bulan='$bulantahun'
						ORDER BY pegawai.nip ASC");
	$no =1;
	while ($d=mysqli_fetch_array($sql)) {
		echo "<tr>
			<td align='center' width='40px'>$no</td>
			<td align='center'>$d[nip]</td>
			<td>$d[nama_pegawai]</td>
			<td>$d[namajabatan]</td>
			<td>$d[nama_golongan]</td>
			<td>".buatRp($d['potongan'])."</td>
			 </tr>";
			 $no++;
	}

	if(mysqli_num_rows($sql) < 1){
		echo "<tr><td colspan='6'> Belum ada data </td></tr>";
	}
	?>

</table>

<table width="100%">
	<tr>
		<td></td>
		<td width="200px">
			<p>
				Cimahi, <?php echo tglIndonesia(date('Y-m-d')); ?>
				<br>
				Administrator,		
			</p>
			<br>
			<br>
			<br>
			<p>___________________________</p>
		</td>
	</tr>
	
</table>

<a href="#" class="no-print" onclick="window.print();">Cetak Print</a>
</body>
</html>
<?php
}else{
	header('location:login.php');
}

?>