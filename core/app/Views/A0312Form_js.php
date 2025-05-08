	<script src="<?php echo base_url(); ?>/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/js/jasny-bootstrap.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			var	base_url_class = "<?php echo $base_url_class  ?>", 
				base_url = "<?php echo base_url()  ?>", 
				default_main_segmen = "<?php echo $default_main_content_type  ?>", 
				page_href = window.location.pathname;
			var EditMode = false;
			<?php 
				$hash = hash('sha512',rand());
				$pos = substr(rand(),0,1); 
				$mnu = $pos . substr($hash,0,128-intval($pos)) . $AppClass->KodeMenu . substr($hash,-1*intval($pos));
			?>
			var page_list = '<?php echo  base_url() . "/" . strtolower($controller_name)."/mnu/" . substr(md5(rand()),4,7) . "/salt/" . $mnu ?>';

			function toggleEdit() { 
				if(EditMode) { 
					$(".control-edit").prop('disabled', true).addClass("disabled");
					$(".control-back").prop('disabled', true).addClass("disabled");
					$(".control-save").prop('disabled', false).removeClass("disabled");
					$(".control-delete").prop('disabled', false).removeClass("disabled");
					$(".control-cancel").prop('disabled', false).removeClass("disabled");
					$(".form-input").prop('disabled', false);
					$(".select2").select2({
		//				placeholder: this.attr("title")	
					});

				} else {
					$(".control-back").prop('disabled', false).removeClass("disabled");
					$(".control-edit").prop('disabled', false).removeClass("disabled");
					$(".control-save").prop('disabled', true).addClass("disabled");
					$(".control-delete").prop('disabled', true).addClass("disabled");
					$(".control-cancel").prop('disabled', true).addClass("disabled");
					$(".display-text").show();
					$(".form-input").prop('disabled', true);
					$(".select2").select2('destroy');
				}
			}

//			$("#page_form .btn-save").on("click",function() { saveData() });
			$("#page_form .btn-close").on("click",function() { reloadPage() });
			
			$(".control-back").on("click",function() { 
				pleaseWait();
				window.location = page_list;
			})
			$(".control-edit").on("click",function() { 
				EditMode = true;
				toggleEdit();
			})
			$(".control-close").on("click",function() {
				if($("#page_form .form-control[name='KodeLama']").val()!=""
					&& EditMode) { 
					EditMode = false;
					toggleEdit();
				} else {
					pleaseWait();
					page_list += "/def/per"+$(".form-control[name='KodePeriode']").val();
					window.location = page_list;
				}
			})

			$(".control-delete").on("click", function(e) {
				e.preventDefault();
				var btn = $(this);
				Swal.fire({
					  title: "<span style='color:#dc3545'>Anda yakin?</span>",
					  text: "Anda akan menghapus data ini",
					  icon: "question",
					  confirmButtonText: "Ya",
					  confirmButtonColor: "#dc3545",
					  cancelButtonText: "Tidak",
					  showCancelButton: true,
				}).then((result) => { 
					if (result.isConfirmed) {
						Swal.showLoading();
						delData($("#page_form .form-control[name='KodeLama']").val()); 
					} 
				});

			});
			$(".control-save").on("click", function(e) {
				e.preventDefault();
				var btn = $(this);
				saveData();
			});


			$(".select2").select2({
                allowClear: true    
//				placeholder: this.attr("title")	
			});
			

			function delData(kode)	{ 
				var param = '0='+escape(page_href)+"&1=";
				if(kode) {
					param += escape(kode)+'@@@';
				} else {
					$("#table-data .cb-data:checked").each(function() {
						param += escape($(this).val())+'@@@';
					});
				}
				if(param!='') { 
					$.ajax({ 
						type: "POST", 
						url: base_url_class+"del_data", 
						data: param, 
						success: function(msg){ 
							if(msg.toLowerCase().indexOf("session habis")>=0) {
								Swal.fire({ title: "Session Error", text: msg,icon: "error",})
									.then((result) => {
										if (result.isConfirmed) { window.location.reload(); } 
									});
							} else if(msg.indexOf('@@@')>0) {
								arMsg = msg.split('@@@');
								if(parseInt(arMsg[0])==0)	{
//									reloadPage();
//									pleaseWait();
//									window.location = page_list;
									Swal.fire({ title: "Success", text: "Data berhasil dihapus",icon: "success",})
										.then((result) => {
											if (result.isConfirmed) { 
												pleaseWait();
												window.location = page_list;
											} 
										});
								}
								else {
									Swal.fire({ title: "Attention", text: arMsg[1],icon: "warning",})
										.then((result) => {
											if (result.isConfirmed) { 
												pleaseWait();
												window.location = page_list;
											} 
										});
								}
							} else {
								mySwal("Error",msg+".\nMohon coba lagi...","error");
							}
						}, error: function() { 
							mySwal("Attention","Demi stabilitas data, saat ini tidak diperkenankan untuk penghapusan data lewat aplikasi.\nSilahkan hubungi web administrator.","warning");
						} 
					});
				}
			}
			
			function saveData() { 
				var param = '0='+escape(page_href)+"&", parammenus = '';
				if(param!='') {
					$("#page_form input.form-control[type='hidden']").each(function() {
							param += $(this).attr("name")+"="+escape($(this).val())+"&";
					});
				}
				if(param!='') {
					$("#page_form input.form-control[type!='radio'][type!='checkbox']").each(function() { // text, date
						if($.trim($(this).val())=='' && $(this).attr("required")=="required") {
							mySwal("Validation",'Isikan '+$(this).attr("placeholder"),"warning");
							$(this).focus();
							param='';
							return false;
						} else
							param += $(this).attr("name")+"="+escape($(this).val())+"&";
					});
				}
				if(param!='') {
					$("#page_form textarea.form-control").each(function() { 
						if($.trim($(this).val())=='' && $(this).attr("required")=="required") {
							mySwal("Validation",'Isikan '+$(this).attr("placeholder"),"warning");
							$(this).focus();
							param='';
							return false;
						} else
							param += $(this).attr("name")+"="+escape($(this).val())+"&";
					});
				}
				if(param!='') {
					$("#page_form select.form-control").each(function() {
							param += $(this).attr("name")+"="+escape($(this).val())+"&";
					});
				}
				if(param!='') {
					$("#page_form input.form-option[type='radio']").each(function() {
						if($("#page_form .form-option[name='"+$(this).attr("name")+"']:checked").get().length==0 && $(this).attr("required")=="required") {
							mySwal("Validation",'Pilih '+$(this).attr("title"),"warning");
							param='';
							return false;
						} else
							param += $(this).attr("name")+"="+escape($("#page_form .form-option[name='"+$(this).attr("name")+"']:checked").val())+"&";
					});
				}
				if(param!='') {
					$("#page_form input.form-control[type='checkbox']").each(function() {
						if($(this).prop("checked")) {
							param += $(this).attr("name")+"=1&";
						} else {
							param += $(this).attr("name")+"=0&";
						}
					});
				}
//				        alert(param); 
//				param='';
				if(param!='') { 
					Swal.fire({
						  title: "Anda yakin?",
						  text: "Anda akan menyimpan perubahan data ini",
						  icon: "question",
						  confirmButtonText: "Ya",
						  cancelButtonText: "Tidak",
						  showCancelButton: true,
					}).then((result) => { 
						if (result.isConfirmed) {
							Swal.close();
							Swal.fire({
							  title: 'Saving Process',
							  html: 'Please wait while data is being processed',
	//						  timer: 2000,
	//						  timerProgressBar: true,
							  didOpen: () => {
								Swal.showLoading();
								$.ajax({ 
									type: "POST", 
									url: base_url_class+"save_data", 
									data: param, 
									success: function(response){ //alert(response)
										if(response.toLowerCase().indexOf("session habis")>=0) {
											Swal.close(); 
											Swal.fire({ title: "Session Error", text: response,icon: "error",})
												.then((result) => {
													if (result.isConfirmed) { window.location.reload(); } 
												});
										} else { 
											arResp = response.split("###");
											if(arResp[0]=="0") { 
												if(arResp[2].indexOf("<!--##-->")>0) {
			//										arResponse = arResp[2].split("<!--##-->");
			//										for(var i=0;i<arResponse.length;i++) {
			//											arVal = arResponse[i].split("@@@");
			//											$("#page_form .form-control[name='"+arVal[0]+"']").val(arVal[1]);	
			//										}
													setTimeout(function() {
														Swal.close(); 
														Swal.fire({ title: "Success", text: arResp[1],icon: "success",})
															.then((result) => {
																// if (result.isConfirmed) { reloadPage(); } 
																if (result.isConfirmed) { 
																	pleaseWait(); 
																	// if($("#page_form .form-control[name='KodeLama']").val()=="") 
                                                                    page_list += "/def/per"+$(".form-control[name='KodePeriode']").val();
                                                                    window.location = page_list;
																	// else
																	// 	window.location.reload(); 
																} 
															});
													},1000);
												}
											} else {
												Swal.close(); 
												Swal.fire({ title: "Error", text: arResp[1], icon: "error" });
			//									.then((result) => {
			//										if (result.isConfirmed) {
			//											$('#modal-overlay').modal('hide');
			//										} 
			//									});
											}
										}
									}, error: function(jqXHR, textStatus, errorThrown) {  
										Swal.close();
										Swal.fire({ title: jqXHR.status+" Error", text: "Internal Error in Saving Data.", icon: "error" });
			//							.then((result) => {
			//								if (result.isConfirmed) {
			//									$('#modal-overlay').modal('hide');
			//								} 
			//							});
									}
								});
							  }
							});				
	
						} 
					});
				}
			}
			
			function pleaseWait() {
				Swal.close();
				Swal.fire({
				  title: 'Please wait',
				  html: 'Please wait while reload the page',
//				  timer: 2000,
//				  timerProgressBar: true,
				  didOpen: () => {
					Swal.showLoading()
//					timerInterval = setInterval(() => {
//					  const content = Swal.getHtmlContainer()
//					  if (content) {
//						const b = content.querySelector('b')
//						if (b) {
//						  b.textContent = Swal.getTimerLeft()
//						}
//					  }
//					}, 100)
				  },
//				  willClose: () => {
//					clearInterval(timerInterval)
//				  }
//				}).then((result) => {
//				  /* Read more about handling dismissals below */
//				  if (result.dismiss === Swal.DismissReason.timer) {
//					console.log('I was closed by the timer')
//				  }
				})				

			}

			function mySwal(title,text,icon) {
				Swal.close();
				Swal.fire({
				  title: title,
				  text: text,
				  icon: icon
				});
			}
			function substrLeft(str,n){
				if(n <= 0)
					return "";
				else if(n > String(str).length)
					return str;
				else
					return String(str).substring(0,n);
			}
			function substrRight(str, n){
				if (n <= 0)
				   return "";
				else if (n > String(str).length)
				   return str;
				else {
				   var iLen = String(str).length;
				   return String(str).substring(iLen, iLen - n);
				}
			}
			function clearChar(str,chr) {
				while(str.indexOf(chr)>=0)
					str = str.replace(chr,"");
				return str;	
			}
			// Input New Mode
			if($("#page_form .form-control[name='KodeLama']").val()=="") { 
				EditMode = true;
				toggleEdit();
			}
			
		});
    
    </script>
