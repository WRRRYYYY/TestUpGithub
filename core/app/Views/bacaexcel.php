<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Import Excel Codeigniter</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
	<div class="container mt-3">
		<?php
		if(session()->getFlashdata('message')){
		?>
			<div class="alert alert-info">
				<?= session()->getFlashdata('message') ?>
			</div>
		<?php
		}
		?>
		<form method="post" action="<?php echo base_url() ?>/adm/bacaExcel" enctype="multipart/form-data">
			<div class="form-group">
				<label>File Excel</label>
				<input type="file" name="fileexcel" class="form-control" id="file" required accept=".xls, .xlsx" /></p>
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Upload</button>
			</div>
		</form>
        
        
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Kode</th>
					<th>Nama</th>
					<th>Nomor Urut</th>
				</tr>
			</thead>
			<tbody id="contactTable">
			<?php
if(isset($oQuery)) {			
			foreach($oQuery as $x => $row) {
				if ($x == 0) {
					continue;
				}
				
				$Nis = $row[0];
				$NamaSiswa = $row[1];
				$Alamat = $row[2];

				?>
					<tr>
						<td><?= $row[0] ?></td>
						<td><?= $row[1] ?></td>
						<td><?= $row[2] ?></td>
					</tr>
				<?php
			}

} else {
			?>
				<tr>
					<td colspan="3">Tidak ada data</td>		
				</tr>
			<?php
}
			
			?>
			</tbody>
		</table>
	</div>
</body>
</html>