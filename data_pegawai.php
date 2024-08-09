<?php include "header.php"; ?>
<div class="container">

<?php
$view = isset($_GET['view']) ? $_GET['view'] : null;

switch($view){
	default:
	?>
		<!--menampilkan pesan -->
		<?php
		if(isset($_GET['e']) && $_GET['e'] =='sukses'){
		?>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Selamat!</strong> Proses Berhasil...!
				</div>
			</div>
		</div>
		<?php
		}elseif(isset($_GET['e']) && $_GET['e'] =='gagal'){
		?>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Error!</strong> Proses gagal dilakukan..!
				</div>
			</div>
		</div>
		<?php
		}
		?>

		<div class="row">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title" >
						Data Pegawai
					</h3>
				</div>
				<div class="panel-body">
					<a href="data_pegawai.php?view=tambah" style="margin-bottom: 10px" class="btn btn-primary">Tambah Data</a>
					<table class="table table-bordered table-striped">						
						<tr>
							<th>No</th>
							<th>NIP</th>
							<th>Nama Pegawai</th>
							<th>Jabatan</th>
							<th>Golongan</th>
							<th>Gapok</th>
							<th>Tunj.Jabatan</th>
							<th>TMK</th>
							<th>TPK</th>
							<th>Premi Hadir</th>
							<th>Tunj.Lain</th>
							<th>Bpjs Kerja</th>
							<th>Bpjs Kesehatan</th>
							<th>Aksi</th>
						</tr>					
						<?php
						$sql = mysqli_query($konek, "SELECT pegawai.*, jabatan.namajabatan, golongan.nama_golongan 
											FROM pegawai 
											INNER JOIN jabatan ON pegawai.kodejabatan=jabatan.kodejabatan 
											INNER JOIN golongan ON pegawai.Kode_Golongan=golongan.kode_golongan 
											ORDER BY pegawai.nama_pegawai ASC");
						$no=1;

						while($d=mysqli_fetch_array($sql)){
							echo "<tr>
								<td width='10px' align=center'>$no</td>
								<td>$d[nip]</td>
								<td>$d[nama_pegawai]</td>
								<td>$d[namajabatan]</td>
								<td>$d[nama_golongan]</td>
								<td>$d[gapok]</td>
								<td>$d[tunj_jabatan]</td>
								<td>$d[TMK]</td>
								<td>$d[TPK]</td>
								<td>$d[premi_hadir]</td>
								<td>$d[tunj_lain_lain]</td>
								<td>$d[bpjs_kerja]</td>
								<td>$d[bpjs_kesehatan]</td>
								<td width='160px' align='center'>
									<a class='btn btn-warning btn-sm' href='data_pegawai.php?view=edit&id=$d[nip]'>Edit</a>
									<a class='btn btn-danger btn-sm' href='aksi_pegawai.php?act=del&id=$d[nip]'>Hapus</a>
								</td>
							</tr>";
							$no++;
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
		<?php
		if(isset($_GET['row']) && $_GET['e'] =='bl'){
		?>
			<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="alert alert-warning alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Peringatan!</strong> Form anda belum lengkap,silahkan dilengkapi...!
				</div>
			</div>
		</div>
		<?php
		}
		?>
		
		<div class="row">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Tambah Data Pegawai</h3>
				</div>

				<div class="panel-body">

					<form method="post" action="aksi_pegawai.php?act=insert">
						<table class="table">
							<tr>
								<td width="160px">NIP</td>
								<td>
									<input class="form-control" type="text" name="nip" required>					
								</td>
							</tr>
							<tr>
								<td>Nama Pegawai</td>
								<td>
									<input class="form-control" type="text" name="nama_pegawai" required>
								</td>
							</tr>
							<tr>
								<td>Jabatan</td>
								<td>
									<select name="kodejabatan" class="form-control">
										<option>- Pilih -</option>
										<?php
										$sqlJabatan=mysqli_query($konek, "SELECT * FROM jabatan ORDER BY kodejabatan ASC");
										while($J=mysqli_fetch_array($sqlJabatan)){
											echo "<option value='$J[kodejabatan]'>$J[kodejabatan]-$J[namajabatan]</option>";
										}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Golongan</td>
								<td>
									<select name="Kode_Golongan" class="form-control">
										<option>- Pilih -</option>
										<?php
										$sqlGolongan=mysqli_query($konek, "SELECT * FROM golongan ORDER BY kode_golongan ASC");
										while($G=mysqli_fetch_array($sqlGolongan)){
											echo "<option value='$G[kode_golongan]'>$G[kode_golongan]-$G[nama_golongan]</option>";
										}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Gapok</td>
								<td>
									<input class="form-control" type="text" name="gapok" required>
								</td>
							</tr>
							<tr>
								<td>Tunj.Jabatan</td>
								<td>
									<input class="form-control" type="text" name="tunj_jabatan" required>
								</td>
							</tr>
							<tr>
								<td>TMK</td>
								<td>
									<input class="form-control" type="text" name="TMK" required>
								</td>
							</tr>
							<tr>
								<td>TPK</td>
								<td>
									<input class="form-control" type="text" name="TPK" required>
								</td>
							</tr>
							<tr>
								<td>Premi Hadir</td>
								<td>
									<input class="form-control" type="text" name="premi_hadir" required>
								</td>
							</tr>
							<tr>
								<td>Tunj.Lain</td>
								<td>
									<input class="form-control" type="text" name="tunj_lain_lain" required>
								</td>
							</tr>
							<tr>
								<td>Bpjs Kerja</td>
								<td>
									<input class="form-control" type="text" name="bpjs_kerja" required>
								</td>
							</tr>
							<tr>
								<td>Bpjs Kesehatan</td>
								<td>
									<input class="form-control" type="text" name="bpjs_kesehatan" required>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input type="submit" class="btn btn-primary" value="Simpan">
									<a class="btn btn-danger" href="data_pegawai.php">Kembali</a>
								</td>
							</tr>

						</table>
					</form>
		
				</div>
			</div>
		</div>

	<?php
	break;
	case "edit";
		//kode
		$sqlEdit= mysqli_query($konek, "SELECT * FROM pegawai WHERE nip='$_GET[id]'");
		$e = mysqli_fetch_array($sqlEdit);
	?>

	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"> Edit Data Pegawai </h3>					
				</div>
				<div class="panel-body">
					<form method="post" action="aksi_pegawai.php?act=update">
					<table class="table">
						<tr>
							<td width="160px">NIP</td>
							<td>
								<input type="text" name="nip" class="form-control" value="<?php echo $e['nip']; ?>" readonly />
							</td>
						</tr>
						<tr>
							<td>Nama Pegawai</td>
							<td>
								<input type="text" name="nama_pegawai" class="form-control" value="<?php echo $e['nama_pegawai']; ?>" readonly />
							</td>
						</tr>
						<tr>
							<td>Jabatan</td>
							<td>
								<select name="kodejabatan" class="form-control">
									<option>- Pilih -</option>
									<?php
									$sqlJabatan=mysqli_query($konek, "SELECT * FROM jabatan ORDER BY kodejabatan ASC");
									while($J=mysqli_fetch_array($sqlJabatan)){

										$selected = ($J['kodejabatan'] == $e['kodejabatan']) ? 'selected="selected"' : "";

										echo "<option value='$J[kodejabatan]' $selected>$J[kodejabatan]-$J[namajabatan]</option>";
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Golongan</td>
							<td>
								<select name="Kode_Golongan" class="form-control">
									<option>- Pilih -</option>
									<?php
									$sqlGolongan=mysqli_query($konek, "SELECT * FROM golongan ORDER BY kode_golongan ASC");
									while($G=mysqli_fetch_array($sqlGolongan)){

										$selected = ($G['kode_golongan'] == $e['Kode_Golongan']) ? 'selected="selected"' : "";

										echo "<option value='$G[kode_golongan]' $selected>$G[kode_golongan]-$G[nama_golongan]</option>";
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Gapok</td>
							<td>
								<input type="text" name="gapok" class="form-control" value="<?php echo $e['gapok']; ?>" required/>
							</td>
						</tr>
						<tr>
							<td>Tunj.Jabatan</td>
							<td>
								<input type="text" name="tunj_jabatan" class="form-control" value="<?php echo $e['tunj_jabatan']; ?>" required/>
							</td>
						</tr>
						<tr>
							<td>TMK</td>
							<td>
								<input type="text" name="TMK" class="form-control" value="<?php echo $e['TMK']; ?>" required/>
							</td>
						</tr>
						<tr>
							<td>TPK</td>
							<td>
								<input type="text" name="TPK" class="form-control" value="<?php echo $e['TPK']; ?>" required/>
							</td>
						</tr>
						<tr>
							<td>Premi Hadir</td>
							<td>
								<input type="text" name="premi_hadir" class="form-control" value="<?php echo $e['premi_hadir']; ?>" required/>
							</td>
						</tr>
						<tr>
							<td>Tunj.Lain</td>
							<td>
								<input type="text" name="tunj_lain_lain" class="form-control" value="<?php echo $e['tunj_lain_lain']; ?>" required/>
							</td>
						</tr>
						<tr>
							<td>Bpjs Kerja</td>
							<td>
								<input type="text" name="bpjs_kerja" class="form-control" value="<?php echo $e['bpjs_kerja']; ?>" required/>
							</td>
						</tr>
						<tr>
							<td>Bpjs Kesehatan</td>
							<td>
								<input type="text" name="bpjs_kesehatan" class="form-control" value="<?php echo $e['bpjs_kesehatan']; ?>" required/>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="submit" value="Update Data" class="btn btn-primary" />
								<a href="data_pegawai.php" class="btn btn-danger">Kembali</a>
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





