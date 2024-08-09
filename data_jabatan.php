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
					<h3 class="panel-title">
						Data Jabatan
					</h3>
				</div>

				<div class="panel-body">
					<a href="data_jabatan.php?view=tambah" style="margin-bottom: 10px" class="btn btn-primary">Tambah Data</a>
					<table class="table table-bordered table-striped">
						
						<tr>
							<th>NO</th>
							<th>Kode Jabatan</th>
							<th>Nama Jabatan</th>
							<th>Aksi</th>
						</tr>
						
						
						<?php
						$sql = mysqli_query($konek, "SELECT * FROM jabatan ORDER BY kodejabatan ASC");
						$no=1;

						while($d=mysqli_fetch_array($sql)){
							echo "<tr>
								<td width='40px' align=center'>$no</td>
								<td>$d[kodejabatan]</td>
								<td>$d[namajabatan]</td>
								<td width='160px' align='center'>
									<a class='btn btn-warning btn-sm' href='data_jabatan.php?view=edit&id=$d[kodejabatan]'>Edit</a>
									<a class='btn btn-danger btn-sm' href='aksi_jabatan.php?act=del&id=$d[kodejabatan]'>Hapus</a>
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
		//membuat kode jabatan otomatis
		$simbol= "J";
		$query = mysqli_query($konek, "SELECT max(kodejabatan) AS last FROM jabatan WHERE kodejabatan LIKE '$simbol%'");
		$data = mysqli_fetch_array($query);

		$kodeterakhir = $data['last'];
		$nomorterakhir = substr($kodeterakhir, 1, 2);
		$nextnomor = $nomorterakhir+ 1;
		$nextkode = $simbol.sprintf('%02s',$nextnomor);

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
					<h3 class="panel-title">Tambah Data Jabatan</h3>
				</div>

				<div class="panel-body">

					<form method="post" action="aksi_jabatan.php?act=insert">
						<table class="table">
							<tr>
								<td width="160px">Kode Jabatan</td>
								<td>
									<input class="form-control" type="text" name="kodejabatan" value="<?php
									echo $nextkode; ?>" readonly>					
								</td>
							</tr>
							<tr>
								<td>Nama Jabatan</td>
								<td>
									<input class="form-control" type="text" name="namajabatan" required>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input type="submit" class="btn btn-primary" value="Simpan">
									<a class="btn btn-danger" href="data_jabatan.php">Kembali</a>
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
		$sqlEdit= mysqli_query($konek, "SELECT * FROM jabatan WHERE kodejabatan='$_GET[id]'");
		$e = mysqli_fetch_array($sqlEdit);
	?>

	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"> Edit Data Jabatan </h3>					
				</div>
				<div class="panel-body">
					<form method="post" action="aksi_jabatan.php?act=update">
					<table class="table">
						<tr>
							<td width="160px">Kode Jabatan</td>
							<td>
								<input type="text" name="kodejabatan" class="form-control" value="<?php echo $e['kodejabatan'] ?>" readonly>
							</td>
						</tr>
						<tr>
							<td>Nama Jabatan</td>
							<td>
								<input type="text" name="namajabatan" class="form-control" value="<?php echo $e['namajabatan'] ?>" required>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="submit" value="Update Data" class="btn btn-primary" />
								<a href="data_jabatan.php" class="btn btn-danger">Kembali</a>
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





