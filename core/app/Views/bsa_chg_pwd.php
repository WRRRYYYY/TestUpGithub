<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $AppClass->NamaAplikasi ?> | Ganti Password</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">  
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url() ?>"><?php echo $AppClass->NamaAplikasi ?></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <h3 class="login-box-msg">Ganti Password</h3>

      <form class="form-horizontal form-material" id="loginform" action="<?php echo base_url() ?>/bsa" method="post">
        <div class="input-group mb-3">
          <input name="PasswordLama" type="password" class="form-control" placeholder="Password Lama" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="PasswordBaru" type="password" class="form-control" placeholder="Password Baru" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="PasswordBaru2" type="password" class="form-control" placeholder="Konfirmasi Password Baru" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <button type="submit" class="btn btn-primary btn-block submit">Change password</button>
          </div>
          <div class="col-6">
            <a href="<?php echo base_url() ?>/bsa" class="btn btn-secondary btn-block">Cancel</a>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url() ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?php echo base_url() ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>/dist/js/adminlte.min.js"></script>

    <script language="javascript">
		$(document).ready(function() {
    // ###################################################################################
    var token = '<?php //echo $AppClass->security->get_csrf_token_name(); ?>',
    	hash = '<?php //echo $AppClass->security->get_csrf_hash(); ?>';
    $.ajaxPrefilter(function(options, originalOptions, jqXHR){
        if (options.type.toLowerCase() === "post") {
            // initialize `data` to empty string if it does not exist
            options.data = options.data || "";
    
            // add leading ampersand if `data` is non-empty
            options.data += options.data?"&":"";
    
            // add _token entry
            options.data += token + "=" + hash;
        }
    });		
    // ###################################################################################
			function strip_html_tags(str)
			{
			   if ((str===null) || (str===''))
				   return false;
			  else
			   str = str.toString();
			  return str.replace(/<[^>]*>/g, '');
			}

			$('.form-control').on('keypress', function(e) {
				if(e.which==13)  {
					e.preventDefault();
					changePwd(e); 
				}
			});
			$('.submit').on('click', function(e) { 
				e.preventDefault();
				changePwd(e);
			});
			function changePwd(e) { //alert(e)
				var param = '';
				$(".form-control").each(function() { 
					if($.trim($(this).val())=='') { 
//						if(e) { window.alert('Isikan '+$(this).attr("title")+' Anda'); }
//						$(this).focus();  
//						param = ''; return false; 
						if(e) { 
							Swal.fire({ title: "Validasi", text: 'Isikan '+$(this).attr("placeholder")+' Anda', icon: "warning" })
							.then((result) => {
								if (result.isConfirmed) {
									$(this).focus();  
								} 
							});
						}
						param=''; return false; 
					} else {
						param+= $(this).attr("name")+'='+escape($(this).val())+'&';	
					}
				});
				if(param!='' 
					&& $(".form-control[name='PasswordBaru']").val()!=$(".form-control[name='PasswordBaru2']").val()) {
						Swal.fire({ title: "Validasi", text: "Cek lagi Password Baru Anda", icon: "warning" })
						.then((result) => {
							if (result.isConfirmed) {
								$(".form-control[name='PasswordBaru2']").select();
							} 
						});
						param='';	
				}


				if(param!='') { 

					$.ajax({ 
						type: "POST", 
						url: "<?php echo base_url()."/bsa/chg_pwd" ?>", 
						data: param, 
						success: function(response){
							if(response.indexOf("<!--###-->")>0) {
								arRsp = $.trim(response).split("<!--###-->");
								if(arRsp[0]=='0') {
									Swal.fire({ title: "Berhasil", text: arRsp[1], icon: "success" })
									.then((result) => {
										if (result.isConfirmed) {
//											window.location.reload();
											window.location.replace("<?php echo base_url() ?>"); 
										} 
									});
//									var href = $(location).attr('href');
//									window.location.replace(href); 
								} else {
									Swal.fire({ title: "Gagal", text: arRsp[1], icon: "error" })
									.then((result) => {
										if (result.isConfirmed) {
											$(".form-control[name='PasswordLama']").select();
										} 
									});
								}
							} else if(response.toLowerCase().indexOf("session habis")>=0) {
								Swal.fire({title:"Session Error",text: response, icon: "error" })
								.then((result) => {
									if (result.isConfirmed) {
										window.location.reload();
									} 
								});
							} else { 
								Swal.fire({text: response, icon: "error" });
							}
						}, error: function(xhr,sta,err) { 
							var ErrMsg = strip_html_tags(xhr.responseText);
							if(ErrMsg=="") ErrMsg = err;
							Swal.fire({title: "Error "+xhr.status, text: ErrMsg, icon: "error" });
						}
					});
				}
			}

		});	
	</script>

</body>
</html>
