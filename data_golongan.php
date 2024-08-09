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
						Data Golongan
					</h3>
				</div>

				<div class="panel-body">
					<a href="data_golongan.php?view=tambah" style="margin-bottom: 10px" class="btn btn-primary">Tambah Data</a>
					<table class="table table-bordered table-striped">						
						<tr>
							<th>No</th>
							<th>Kode</th>
							<th>Nama Golongan</th>
						</tr>								
						<?php
						$sql = mysqli_query($konek, "SELECT * FROM golongan ORDER BY kode_golongan ASC");
						$no=1;

						while($d=mysqli_fetch_array($sql)){
							echo "<tr>
								<td width='40px' align=center'>$no</td>
								<td>$d[kode_golongan]</td>
								<td>$d[nama_golongan]</td>
								<td width='160px' align='center'>
									<a class='btn btn-warning btn-sm' href='data_golongan.php?view=edit&id=$d[kode_golongan]'>Edit</a>
									<a class='btn btn-danger btn-sm' href='aksi_golongan.php?act=del&id=$d[kode_golongan]'>Hapus</a>
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
		//membuat kode golongan otomatis
		$simbol= "G";
		$query = mysqli_query($konek, "SELECT max(kode_golongan) AS last FROM golongan WHERE kode_golongan LIKE '$simbol%'");
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
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;
					</span></button>
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
					<h3 class="panel-title">Tambah Data Golongan</h3>
				</div>

				<div class="panel-body">

					<form method="post" action="aksi_golongan.php?act=insert">
						<table class="table">
							<tr>
								<td width="160px">Kode Golongan</td>
								<td>
									<input class="form-control" type="text" name="kode_golongan" value="<?php
									echo $nextkode; ?>" readonly>					
								</td>
							</tr>
							<tr>
								<td>Nama Golongan</td>
								<td>
									<input class="form-control" type="text" name="nama_golongan" required>
								</td>
							<tr>
								<td></td>
								<td>
									<input type="submit" class="btn btn-primary" value="Simpan">
									<a class="btn btn-danger" href="data_golongan.php">Kembali</a>
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
		$sqlEdit= mysqli_query($konek, "SELECT * FROM golongan WHERE kode_golongan='$_GET[id]'");
		$e = mysqli_fetch_array($sqlEdit);
	?>

	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"> Edit Data Golongan </h3>					
				</div>
				<div class="panel-body">
					<form method="post" action="aksi_golongan.php?act=update">
					<table class="table">
						<tr>
							<td width="160px">Kode Golongan</td>
							<td>
								<input type="text" name="kode_golongan" class="form-control" value="<?php echo $e['kode_golongan']; ?>" readonly />
							</td>
						</tr>
						<tr>
							<td>Nama Golongan</td>
							<td>
								<input class="form-control" type="text" name="nama_golongan" value="<?php echo $e['nama_golongan']; ?>" required>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="submit" value="Update Data" class="btn btn-primary" />
								<a href="data_golongan.php" class="btn btn-danger">Kembali</a>
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





