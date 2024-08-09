<?php
session_start();
if(isset($_SESSION['login'])){
	include "koneksi.php";
	include "fungsi.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Laporan Data Golongan</title>
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
<p>LAPORAN DATA GOLONGAN</p>
<table border="1" cellpadding="5" cellspacing="0" width="1000px">
	<tr>
		<th>NO.</th>
		<th>Kode</th>
		<th>Nama Golongan</th>
	</tr>

	<?php
	$sql=mysqli_query($konek, "SELECT * FROM golongan ORDER BY kode_golongan ASC");
	$no =1;
	while ($d=mysqli_fetch_array($sql)) {
		echo "<tr>
			<td align='center' width='40px'>$no</td>
			<td align='center'>$d[kode_golongan]</td>
			<td>$d[nama_golongan]</td>
			 </tr>";
			 $no++;
	}

	if(mysqli_num_rows($sql) < 1){
		echo "<tr><td colspan='9'> Belum ada data </td></tr>";
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