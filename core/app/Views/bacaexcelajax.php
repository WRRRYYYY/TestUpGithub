<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Import Excel Codeigniter</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
	<div class="container mt-3">
		<form method="post" id="formExcel" enctype="multipart/form-data">
			<div class="form-group">
				<label>File Excel</label>
				<input type="file" name="fileexcel" class="form-control" id="file" required accept=".xls, .xlsx" /></p>
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Open via AJAX</button>
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
			</tbody>
		</table>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
	<script type="text/javascript">
		//upload data
		$("#formExcel").on('submit',function(e){
			e.preventDefault();
			$.ajax({
		      url:"<?php echo base_url() ?>/adm/bacaExcelAjax",
		      method:"POST",
		      data:new FormData(this),
		      processData:false,
		      contentType:false,
		      cache:false,
		      success:function(val){ //alert(val)
//		      	console.log(data);
//		        loadData();
					val = JSON.parse(val);
					var i = 0;
					$.each(val,function(idx,data){
//						row = data.split(" ");
						if(i>0) {
							$("#contactTable").append('<tr><td>'+data[0]+'</td><td>'+data[1]+'</td><td>'+data[2]+'</td></tr>');
						}
						i++;
					});
		      }
		    })
		})
	</script>
</body>
</html>