$(function()	{
  <?php if(!$AppClass->session->get($AppClass->AppModule . "UserID"))  {  ?>
    // ###################################################################################
    var token = '<?php echo $AppClass->security->get_csrf_token_name(); ?>',
    	hash = '<?php echo $AppClass->security->get_csrf_hash(); ?>';
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
			$('.form-control').on('keypress', function(e) {
				if(e.which==13)  {
					e.preventDefault();
					doLogin(e); 
				}
			});
			$('.submit').on('click', function(e) {
				e.preventDefault();
				doLogin(e);
			});
			function doLogin(e) { 
				if($.trim($(".form-control[name='UserID']").val())=="") {
					window.alert("Isikan User ID Anda!");
					$(".form-control[name='UserID']").focus();
				} else {
					var param = $('#loginform').serialize(), form = $('#loginform');
					$.ajax({ 
						type: "POST", 
						url: "<?php echo base_url()."bsa/login_process" ?>", 
						data: param, 
	//					beforeSend: function(){ showModal(true) },
						/*complete: function(){ showModal(false) },*/
						success: function(response){ 
							if(response.indexOf("<!--###-->")>0) {
								arRsp = $.trim(response).split("<!--###-->");
								if(arRsp[0]=='0') {
									/* $("#loginfrm").hide(); */
									/*window.location.reload();*/
									var href = $(location).attr('href');
									window.location.replace(href); 
								} else {
									window.alert(arRsp[1]);	
									$(form.find(".form-control:eq("+arRsp[2]+")")).select();
	//								showModal(false);
								}
							} else { window.alert(response);/* showModal(false)*/ }
						}, error: function(xhr,sta,err) { window.alert('eror'); window.alert(xhr.responseText); /*showModal(false);*/ }
					});
				}
			}
    // ###################################################################################
  <?php } else {  ?>
  	const Konfirm = Swal.mixin({
      buttons: [
        'No, cancel it!',
        'Yes, I am sure!'
      ],
      dangerMode: true,
    });
	$(".nav-chgpwd").on('click', function(e) {
        e.preventDefault();
        window.location.replace("<?php echo base_url() ?>/bsa/chgpwdfrm"); 
    });
	$(".nav-logout").on('click', function(e) { 
        e.preventDefault();
        Swal.fire({
              title: "Anda yakin?",
              text: "Anda akan keluar dari aplikasi ini",
              icon: "question",
              confirmButtonText: "Ya",
              cancelButtonText: "Tidak",
              showCancelButton: true,
        }).then((result) => { 
        	if (result.isConfirmed) {
                window.location.replace("<?php echo base_url() ?>/bsa/do_logout"); 
            } 
        })
    });
  <?php }  ?>
	
});
