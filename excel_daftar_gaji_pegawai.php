<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=daftar_gaji_pegawai.xls");
include "koneksi.php";
include "fungsi.php";
$bulantahun=$_GET['bulan'].$_GET['tahun'];
?>

<h3>PT.INDOWIRA PUTRA PAINT<br>DAFTAR GAI PEGAWAI</h3>
<p>Bulan : <?php echo $_GET['bulan']." Tahun: ".$_GET['tahun']; ?></p>
<table border="1" cellpadding="4" cellspacing="0" width="100px">
	<thead>
		<tr>
			<th>No</th>
			<th>NIP</th>
			<th>Nama Pegawai</th>
			<th>Jabatan</th>
			<th>Gol</th>
			<th>Gapok</th>
			<th>Tj.Jabatan</th>
			<th>TMK</th>
			<th>TPK</th>
			<th>Premi Hadir</th>
			<th>Tunj.Lain-lain</th>
			<th>Bpjs Kerja</th>
			<th>Bpjs Kesehatan</th>
			<th>Pendapatan</th>
			<th>Potongan</th>
			<th>Total Gaji</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql =mysqli_query($konek, "SELECT pegawai.*,jabatan.namajabatan,golongan.nama_golongan,
				pegawai.TMK AS tmk,pegawai.premi_hadir AS premi,
				pegawai.tunj_lain_lain AS tunjlain,tpk,uang_makan,bpjs_kerja,bpjs_kesehatan,
				(gapok+tunj_jabatan+(SELECT tmk)+tpk+(SELECT premi)+(SELECT tunjlain)-bpjs_kerja-bpjs_kesehatan) AS pendapatan,
				potongan,
				(SELECT pendapatan) - potongan AS totalgaji
				FROM pegawai
				INNER JOIN master_gaji ON master_gaji.nip=pegawai.nip
				INNER JOIN golongan ON golongan.kode_golongan=pegawai.kode_golongan
				INNER JOIN jabatan ON jabatan.kodejabatan=pegawai.kodejabatan
				WHERE master_gaji.bulan='$bulantahun'
				ORDER BY pegawai.nip ASC");

		$no=1;

		while($d=mysqli_fetch_array($sql)){
			echo "<tr>
				<td width='40px' align='center'>$no</td>
				<td>$d[nip]</td>
				<td>$d[nama_pegawai]</td>
				<td>$d[namajabatan]</td>
				<td>$d[nama_golongan]</td>
				<td>".buatRp($d['gapok'])."</td>
				<td>".buatRp($d['tunj_jabatan'])."</td>
				<td>".buatRp($d['tmk'])."</td>
				<td>".buatRp($d['tpk'])."</td>
				<td>".buatRp($d['premi'])."</td>
				<td>".buatRp($d['tunjlain'])."</td>
				<td>".buatRp($d['bpjs_kerja'])."</td>
				<td>".buatRp($d['bpjs_kesehatan'])."</td>
				<td>".buatRp($d['pendapatan'])."</td>
				<td>".buatRp($d['potongan'])."</td>
				<td>".buatRp($d['totalgaji'])."</td>
			</tr>";
			$no++;
		}
		?>
	</tbody>
</table>

<table width="100%">
	<tr>
		<td></td>
		<td width="200px">
			<p>Cimahi, <?php echo date("d/m/Y"); ?> <br>
			Bendahara</p>
			<br>
			<br>
			<br>
			<p>_______________________</p>
		</td>
	</tr>	

</table>

