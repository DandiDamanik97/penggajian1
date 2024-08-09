<?php
session_start();
if(isset($_SESSION['login'])){
	include "koneksi.php";
	include "fungsi.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Laporan Data Pegawai</title>
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
<p>LAPORAN DATA PEGAWAI</p>
<table border="1" cellpadding="5" cellspacing="0" width="1000px">
	<tr>
		<th>NO.</th>
		<th>NIP</th>
		<th>Nama Pegawai</th>
		<th>Jabatan</th>
		<th>Golongan</th>
	</tr>

	<?php
	$sql=mysqli_query($konek, "SELECT pegawai.*,golongan.nama_golongan,jabatan.namajabatan
								FROM pegawai
								INNER JOIN jabatan ON pegawai.kodejabatan=jabatan.kodejabatan
								INNER JOIN golongan ON pegawai.kode_golongan=golongan.kode_golongan
								ORDER BY golongan.nama_golongan DESC");
	$no =1;
	while ($d=mysqli_fetch_array($sql)) {
		echo "<tr>
			<td align='center' width='40px'>$no</td>
			<td align='center'>$d[nip]</td>
			<td>$d[nama_pegawai]</td>
			<td>$d[namajabatan]</td>
			<td>$d[nama_golongan]</td>
			 </tr>";
			 $no++;
	}

	if(mysqli_num_rows($sql) < 1){
		echo "<tr><td colspan='7'> Belum ada data </td></tr>";
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
			<p>______________________________</p>
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