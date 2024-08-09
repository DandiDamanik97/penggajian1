<?php include "header.php"; ?>
<div class="container">

<?php
$view = isset($_GET['view']) ? $_GET['view'] : null;

switch($view){
	default;
	?>

	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"> Data Kehadiran Pegawai</h3>			
			</div>
			<div class="panel-body">
				<form class="form-inline" method="get" action="">
					<div class="form-group">
						<label>Bulan</label>
						<select name="bulan" class="form-control">
							<option value="">- Pilih -</option>
							<option value="01">Januari</option>
							<option value="02">Februari</option>
							<option value="03">Maret</option>
							<option value="04">April</option>
							<option value="05">Mei</option>
							<option value="06">Juni</option>
							<option value="07">Juli</option>
							<option value="08">Agustus</option>
							<option value="09">September</option>
							<option value="10">Oktober</option>
							<option value="11">Nopember</option>
							<option value="12">Desember</option>
						</select>
					</div>
					<div class="form-group">
						<label>Tahun</label>
						<select name="tahun" class="form-control">
							<option value="">- Pilih -</option>
							<?php

							$y = date('Y');
							for($i=2021;$i<=$y+10;$i++){
								echo "<option value='$i'>$i</option>";
							}
							?>
						</select>
					</div>
					<button type ="submit" class="btn btn-primary"> Tampilkan Data</button>
					<a href ="data_kehadiran.php?view=tambah" class="btn btn-primary">Input Kehadiran Pegawai</a>
				</form>
				<br>
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
				?>
				<div class="alert alert-info">
					<strong>Bulan : <?php echo $bulan; ?>, Tahun: <?php echo $tahun; ?> </strong>
				</div>

				<table class="table table-bordered table-striped">
					<tr>
						<th>No</th>
						<th>NIP</th>
						<th>Nama Pegawai</th>
						<th>Jabatan</th>
						<th>Masuk</th>
						<th>S1</th>
						<th>S2</th>
						<th>P3</th>
						<th>P4</th>					
						<th>C</th>
						<th>M</th>
						<th>Potongan</th>
					</tr>
					<?php
					$sql = mysqli_query($konek, "SELECT master_gaji.*, pegawai.nama_pegawai, pegawai.kodejabatan, jabatan.namajabatan FROM master_gaji
						INNER JOIN pegawai ON master_gaji.nip=pegawai.nip
						INNER JOIN jabatan ON pegawai.kodejabatan=jabatan.kodejabatan
						WHERE master_gaji.bulan=$bulantahun
						ORDER BY pegawai.nip ASC");

					$no=1;
					while($d=mysqli_fetch_array($sql)){
						echo "<tr>
							<td>$no</td>
							<td>$d[NIP]</td>
							<td>$d[nama_pegawai]</td>
							<td>$d[namajabatan]</td>
							<td>$d[masuk]</td>
							<td>$d[S1]</td>
							<td>$d[S2]</td>
							<td>$d[P3]</td>
							<td>$d[P4]</td>
							<td>$d[C]</td>
							<td>$d[M]</td>
							<td>$d[potongan]</td>
						</tr>";
						$no++;

					}

					if(mysqli_num_rows($sql) > 0){
						echo "<tr>
							<td colspan='10' text-align='center'> 
								<a class='btn btn-warning' href='data_kehadiran.php?view=edit&bulan=$bulan&tahun=$tahun'>Edit Data Kehadiran </a>
							</td>
						</tr>";
					}else{

						echo "<tr>
							<td colspan='9' text-align='center'> 
								Belum ada data pada bulan dan tahun yang anda pilih!!!
							</td>
						</tr>";
					}
					?>
				</table>

			</div>
			
		</div>
		
	</div>

	<?php

	break;
	case "tambah";
	?>

	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Tambah Data Kehadiran Pegawai</h3>
			</div>
			<div class="panel-body">
				<form class="form-inline" method="get" action="">
					<input type="hidden" name="view" value="tambah">
					<div class="form-group">
						<label>Bulan</label>
						<select name="bulan" class="form-control">
							<option value="">- Pilih -</option>
							<option value="01">Januari</option>
							<option value="02">Februari</option>
							<option value="03">Maret</option>
							<option value="04">April</option>
							<option value="05">Mei</option>
							<option value="06">Juni</option>
							<option value="07">Juli</option>
							<option value="08">Agustus</option>
							<option value="09">September</option>
							<option value="10">Oktober</option>
							<option value="11">Nopember</option>
							<option value="12">Desember</option>
						</select>
					</div>
					<div class="form-group">
						<label>Tahun</label>
						<select name="tahun" class="form-control">
							<option value="">- Pilih -</option>
							<?php

							$y = date('Y');
							for($i=2021;$i<=$y+10;$i++){
								echo "<option value='$i'>$i</option>";
							}
							?>
						</select>
					</div>
					<button type ="submit" class="btn btn-primary"> Generate Form </button>
				</form>
				<br>
				
				<?php
				if((isset($_GET['tahun']) && $_GET['tahun']!='') && (isset($_GET['bulan']) && $_GET['bulan']!='')){
					$bulan = $_GET['bulan'];
					$tahun = $_GET['tahun'];
					$bulantahun = $bulan.$tahun;
				}else{
					$bulan = date('m');
					$tahun = date('Y');
					$bulantahun = $bulan.$tahun;
				}
				?>

				<div class="alert alert-info">
					<strong>Bulan : <?php echo $bulan; ?>, Tahun: <?php echo $tahun; ?> </strong>
				</div>

				<form method="post" action="aksi_kehadiran.php?act=insert">
					<table class="table">
						<tr>
							<th>NO</th>
							<th>NIP</th>
							<th>Nama Pegawai</th>
							<th>Jabatan</th>
							<th>Masuk</th>
							<th>S1</th>
							<th>S2</th>
							<th>P3</th>
							<th>P4</th>					
							<th>C</th>
							<th>M</th>
							<th>Potongan</th>
						</tr>

						<?php
						$no=1;
						$query=mysqli_query($konek, "SELECT pegawai.*, jabatan.namajabatan 
														FROM pegawai INNER JOIN jabatan ON pegawai.kodejabatan=jabatan.kodejabatan 
														WHERE NOT EXISTS (SELECT * FROM master_gaji WHERE bulan='$bulantahun' 
														AND pegawai.nip=master_gaji.nip) 
														ORDER BY pegawai.nip ASC");
						$jmlpegawai=mysqli_num_rows($query);
						while($d=mysqli_fetch_array($query)){
							?>
							<input type="hidden" name="bulan[]" value="<?php echo $bulantahun; ?>" />
							<input type="hidden" name="nip[]" value="<?php echo $d['nip']; ?>" />
							<tr>
								<td><?php echo $no; ?></td>
								<td><?php echo $d['nip']; ?></td>
								<td><?php echo $d['nama_pegawai']; ?></td>
								<td><?php echo $d['namajabatan']; ?></td>
								<td>
									<input type="number" name="masuk[]" class="form-control" value="0" required />
								</td>
								<td>
									<input type="number" name="S1[]" class="form-control" value="0" required />
								</td>
								<td>
									<input type="number" name="S2[]" class="form-control" value="0" required />
								</td>
								<td>
									<input type="number" name="P3[]" class="form-control" value="0" required />
								</td>
								<td>
									<input type="number" name="P4[]" class="form-control" value="0" required />
								</td>
								<td>
									<input type="number" name="C[]" class="form-control" value="0" required />
								</td>
								<td>
									<input type="number" name="M[]" class="form-control" value="0" required />
								</td>
								<td>
									<input type="number" name="potongan[]" class="form-control" value="0" required />
								</td>
							</tr>
						<?php 
							$no++;
						}

						if($jmlpegawai > 0){
						?>
							<tr>
								<td colspan="4"></td>
								<td colspan="6">
									<input class="btn btn-primary" type="submit" value="Simpan">
									<a href="data_kehadiran.php" class="btn btn-danger">Kembali</a>
								</td>
							</tr>
						<?php
						}else{
							?>
							<tr>
								<td colspan="10">
									<label class="label label-warning">Maaf,....Bulan dan tahun yang dipilih sudah diproses,Silahkan lakukan edit data....</label>
								</td>
							</tr>
						<?php
						}
						?>
					</table>
					
				</form>

			</div>
		</div> 
	</div>


	<?php

	break;
	case "edit";
		
	$bulan = $_GET['bulan'];
	$tahun = $_GET['tahun'];
	$bulantahun = $bulan.$tahun;
	?>

	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"> Edit Data Kehadiran Pegawai</h3>
			</div>
			<div class="panel-body">
				<div class="alert alert-info">
					<strong>Bulan : <?php echo $bulan; ?>, Tahun : <?php echo $tahun; ?> </strong>
				</div>

				<form method="post" action="aksi_kehadiran.php?act=update">
					<table class="table">
						<tr>
							<th>NO</th>
							<th>NIP</th>
							<th>Nama Pegawai</th>
							<th>Jabatan</th>
							<th>Masuk</th>
							<th>S1</th>
							<th>S2</th>
							<th>P3</th>
							<th>P4</th>					
							<th>C</th>
							<th>M</th>
							<th>Potongan</th>
						</tr>

						<?php
						$no=1;
						$query=mysqli_query($konek, "SELECT master_gaji.*,pegawai.nama_pegawai, jabatan.namajabatan
													FROM master_gaji
													INNER JOIN pegawai ON master_gaji.nip=pegawai.nip
													INNER JOIN jabatan ON pegawai.kodejabatan=jabatan.kodejabatan
													WHERE master_gaji.bulan='$bulantahun'
													ORDER BY master_gaji.nip ASC");
						$jmlpegawai=mysqli_num_rows($query);
						while($d=mysqli_fetch_array($query)){
						?>
							<input type="hidden" name="bulan[]" value="<?php echo $bulantahun; ?>" />
							<input type="hidden" name="nip[]" value="<?php echo $d['NIP']; ?>" />
							<tr>
								<td><?php echo $no; ?></td>
								<td><?php echo $d['NIP']; ?></td>
								<td><?php echo $d['nama_pegawai']; ?></td>
								<td><?php echo $d['namajabatan']; ?></td>
								<td>
									<input type="number" name="masuk[]" class="form-control" value="<?php echo $d['masuk']; ?>" required />
								</td>
								<td>
									<input type="number" name="S1[]" class="form-control" value="<?php echo $d['S1']; ?>" required />
								</td>
								<td>
									<input type="number" name="S2[]" class="form-control" value="<?php echo $d['S2']; ?>" required />
								</td>
								<td>
									<input type="number" name="P3[]" class="form-control" value="<?php echo $d['P3']; ?>" required />
								</td>
								<td>
									<input type="number" name="P4[]" class="form-control" value="<?php echo $d['P4']; ?>" required />
								</td>
								<td>
									<input type="number" name="C[]" class="form-control" value="<?php echo $d['C']; ?>" required />
								</td>
								<td>
									<input type="number" name="M[]" class="form-control" value="<?php echo $d['M']; ?>" required />
								</td>
								<td>
									<input type="number" name="potongan[]" class="form-control" value="<?php echo $d['potongan']; ?>" required />
								</td>
							</tr>
						<?php 
							$no++;
						}
						?>
						<tr>
							<td colspan="4"></td>
							<td colspan="6">
							<input class="btn btn-primary" type="submit" value="Update">
							<a href="data_kehadiran.php" class="btn btn-danger">Kembali</a>
							</td>
						</tr>
				
					</table>
				</form>

			</div>
		</div>
	</div>

	<?php
	break;
}
?>

</div>
<?php include "footer.php"; ?>