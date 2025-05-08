	<script src="<?php echo base_url(); ?>/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <!-- Image cropper JavaScript -->
    <script src="<?php echo base_url(); ?>/plugins/cropper/cropper.min.js"></script>
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
			var page_list = '<?php echo  base_url() . "/" . strtolower($controller_name)."/mnu/" . substr(md5(rand()),4,7) . "/salt/" . $mnu; ?>';
//			var page_form = '<?php echo  base_url() . "/" . strtolower($controller_name)."/mnu/" . substr(md5(rand()),4,7) . "/salt/" . $mnu . "/frm/"; ?>';

			// ##################################################################

//			$(".customtab .nav-link:eq(2)").on("click",function() { 
			$("#tab-3-tab").on("shown.bs.tab",function(e) {
//				if(EditMode) setTimeout(init_cropper,100);
				setTimeout(init_cropper,100);
			}).on("hidden.bs.tab",function(e) {
				$("#image").cropper("destroy");
			});

			$("#tab-2-tab").on("shown.bs.tab",function(e) { 
			   $($.fn.dataTable.tables(true)).DataTable()
				  .columns.adjust();
			});

			$("#tab-4-tab").on("shown.bs.tab",function(e) { 
			   $($.fn.dataTable.tables(true)).DataTable()
				  .columns.adjust();
			});


			$(".control-close").on("click",function() {
				pleaseWait();
				window.location = page_list;
			})

			$(".control-back").on("click",function(e) { 
				e.preventDefault();
				pleaseWait();
				window.location = page_list;
			})
			
			// $(".control-save").on("click",function(e) { 
			// 	e.preventDefault();
			// 	var btn = $(this);
			// 	Swal.fire({
			// 		  title: "Anda yakin?",
			// 		  text: "Anda akan menyimpan perubahan data	ini",
			// 		  icon: "question",
			// 		  confirmButtonText: "Ya",
			// 		  cancelButtonText: "Tidak",
			// 		  showCancelButton: true,
			// 	}).then((result) => { 
			// 		if (result.isConfirmed) {
			// 			Swal.close();
			// 			Swal.fire({
			// 			  title: 'Saving Process',
			// 			  html: 'Please wait while data is being processed',
			// 			  didOpen: () => {
			// 				Swal.showLoading();
			// 				saveData();
			// 			  }
			// 			});				

			// 		} 
			// 	});
			// });
			$(".control-save").on("click",function(e) { 
				e.preventDefault();
                saveData();
			});

			
			$(".editable-check[name='chkMenu']").on("click",function() { isCheckAll(); });
			$("#chkMenu_All").on("click",function() { 
				$(".editable-check[name='chkMenu']").prop("checked",$(this).prop("checked"));
			});
			
			if($("#table-hak-akses").get().length>0) {
				datatable = $("#table-hak-akses").DataTable({
					destroy: true, //elakkan dari error initialise
	//				orderCellsTop: true,
	//		        fixedHeader: true,
					"ordering": false,
					"scrollX": true,
					"language": {
					"paginate": {
					  "previous": "<",
					  "next": ">"
					  }
					},
					initComplete: function () {
						$.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
					}
				});
				
				Swal.close();
				$(".editable-check[name='chkMenu']").on("click",function() { 
					// isCheckAll(); 
					if($(".editable-check[name='chkMenu']").get().length==$(".editable-check[name='chkMenu'][checked]").get().length) {
						$("#chkMenuAll").prop("checked",true);
					} else {
						$("#chkMenuAll").prop("checked",false);
					}
				});
				$("#chkMenuAll").on("click",function() { 
					$(".editable-check[name='chkMenu']").prop("checked",$(this).prop("checked"));
				});
			}
//alert($("#table-hak-akses-desa").get().length)
			if($("#table-hak-akses-desa").get().length>0) { 
				datatable2 = $("#table-hak-akses-desa").DataTable({
					destroy: true, //elakkan dari error initialise
	//				orderCellsTop: true,
	//		        fixedHeader: true,
					"ordering": false,
					"scrollX": true,
					"language": {
					"paginate": {
					  "previous": "<",
					  "next": ">"
					  }
					},
					initComplete: function () {
						$.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
					}
				});
				

				$(".editable-check[name='chkDesa']").on("click",function() { 
					var checked = ($(".editable-check[name='chkDesa']:checked").get().length==$(".editable-check[name='chkDesa']").get().length) ? true : false;
					$("#chkDesaAll").prop("checked",checked);
				});
				$("#chkDesaAll").on("click",function() {
					$(".editable-check[name='chkDesa']").prop("checked",$(this).prop("checked"));
				});
			}
			
//			$(".control-delete").on("click", function(e) {
			$(".select2").select2({
//				placeholder: this.attr("title")	
			});

			$("#KodeRole").on("change",function(e) { 
				e.preventDefault(); 
				var code = $(this).val(); 
				pleaseWait();
				genDetailListMenu(code,$("#page_form .form-control[name='KodeLama']").val());
	        	checkHakAksesKhusus("Role",$(this).val());
//				openForm(code);
			});
			
			function checkHakAksesKhusus(fldname,roleid) { 
				var param = '0='+escape(page_href);
				param += '&1='+fldname;
				param += "&id="+escape(roleid);
				$.ajax({
					url: base_url_class+"get_data_detail_ext", 
					type:'POST',
					data:param,
					success:function(response){ 
						if(response.indexOf("<!--##-->")>0) {
							arResp = $.trim(response).split("<!--##-->");
							if(fldname=="Role") {
								$("#page_form .form-control[name='KodeRole']").select2().trigger('change.select2');;
		
								$("#page_form .form-control[name='HakAksesKhusus']").val(arResp[2]);
								$("#page_form .form-control[name='HakAksesTambahan']").val(arResp[3]);
								
								genDetailListMenu(arResp[0],$("#page_form .form-control[name='KodeLama']").val());
		//                        genDetailList("Client",$("#page_form .form-control[name='KodeLama']").val());
		                        if(arResp[2]=="1") {	// Hak Akses Khusus
		                            $("#page_form .form-control[name='Instansi']").prop("disabled",false);
		                        } else {
		                            $("#page_form .form-control[name='Instansi']").prop("disabled",true);
		                        }
		
								if(arResp[3]=="1") {	// Hak Akses Tambahan
									$("#tab-4-tab").attr("class","nav-link");
									genDetailList("Desa",$("#page_form .form-control[name='KodeLama']").val());
									// tambahan mengenablekan combo Instansi
									
								} else {
									$("#tab-4-tab").attr("class","nav-link disabled");
									$("#tab-4 .box-body").html("");
								}
								
							}
						}       
					} 
				});
			}

			function genDetailListMenu(roleid,userid) { 
				var param = '0='+escape(page_href), list_name="Menu";
				param += '&1='+list_name;
				param += "&id="+escape(roleid)+"###"+escape(userid);
				$.ajax({
					url: base_url_class+"get_detail_list", 
					type:'POST',
					data:param,
					success:function(response){ 
						$("#list_mnu").html(response);

						datatable = $("#table-hak-akses").DataTable({
							destroy: true, //elakkan dari error initialise
			//				orderCellsTop: true,
			//		        fixedHeader: true,
							"ordering": false,
							"scrollX": true,
							"language": {
							"paginate": {
							  "previous": "<",
							  "next": ">"
							  }
							},
							initComplete: function () {
								$.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
							}
						});
						
						Swal.close();
						$(".editable-check[name='chkMenu']").on("click",function() { 
							// isCheckAll(); 
							if($(".editable-check[name='chkMenu']").get().length==$(".editable-check[name='chkMenu'][checked]").get().length) {
								$("#chkMenuAll").prop("checked",true);
							} else {
								$("#chkMenuAll").prop("checked",false);
							}
//							alert($(".editable-check[name='chkMenu']").get().length);
//							alert($(".editable-check[name='chkMenu'][checked]").get().length);
						});
						$("#chkMenuAll").on("click",function() { 
							$(".editable-check[name='chkMenu']").prop("checked",$(this).prop("checked"));
						});
					}, 
					error:function(jqXHR, textStatus, errorThrown) { 
						mySwal(jqXHR.status+" Error",jqXHR.responseText+"Generate "+list_name+" List error. Try again.","error"); 
					}
				});
			}
			function genDetailList(list_name,code) { 
				var param = '0='+escape($(location).attr('href'));
				param += '&1='+list_name;
				if(list_name=="Desa" || list_name=="Kampus") {
					param += "&id="+escape( $("#page_form .form-control[name='KodeRole']").val())+"###"+escape(code);
				} 
				else if(code) param += "&id="+escape(code);
				$.ajax({
					url: base_url_class+"get_detail_list", 
					type:'POST',
					data:param,
					success:function(response){ 
						if(list_name=="Desa") { 
							$("#tab-4").html(response);
							datatable2 = $("#table-hak-akses-desa").DataTable({
								destroy: true, //elakkan dari error initialise
				//				orderCellsTop: true,
				//		        fixedHeader: true,
								"ordering": false,
								"scrollX": true,
								"language": {
								"paginate": {
								  "previous": "<",
								  "next": ">"
								  }
								},
								initComplete: function () {
									$.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
								}
							});
							

							$(".editable-check[name='chkDesa']").on("click",function() { 
								var checked = ($(".editable-check[name='chkDesa']:checked").get().length==$(".editable-check[name='chkDesa']").get().length) ? true : false;
								$("#chkDesaAll").prop("checked",checked);
							});
							$("#chkDesaAll").on("click",function() {
								$(".editable-check[name='chkDesa']").prop("checked",$(this).prop("checked"));
							});

						}
					},
					error:function(jqXHR, textStatus, errorThrown) { 
						mySwal(jqXHR.status+" Error","Generate "+list_name+" List error. Try again.","error"); 
					}
				});
			}

			function delData(kode)	{ 
				var param = '0='+escape(page_href)+"&1=";
				if(kode) {
					param += escape(kode)+'@@@';
				} else {
					$("#datatable .cb-data:checked").each(function() {
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
												window.location.reload();
											} 
										});
								}
								else {
									Swal.fire({ title: "Attention", text: arMsg[1],icon: "warning",})
// since delete is one by one it's no need
//										.then((result) => {
//											if (result.isConfirmed) { 
//												pleaseWait();
//												window.location.reload();
//											} 
//										});
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
				var param = '0='+escape(page_href)+"&", parammenus = '', paramdesas = '';
				if(param!='') {
					$("#page_form input.form-control[type='hidden']").each(function() {
							param += $(this).attr("name")+"="+escape($(this).val())+"&";
					});
				}
				if(param!='') {
					$("#page_form select.form-control").each(function() { 
                        // param += $(this).attr("name")+"="+escape($(this).val())+"&";
						if($.trim($(this).val())=='' && $(this).attr("required")=="required") {
							mySwal("Validation",'Pilih '+$(this).attr("title"),"warning");
							$(this).focus();
							param='';
							return false;
						} else
                        param += $(this).attr("name")+"="+escape($(this).val())+"&";
					});
				}
				if(param!='') {
					$("#page_form input.form-control[type!='radio'][type!='checkbox']").each(function() { // text, date
						if($.trim($(this).val())=='' && $(this).attr("required")=="required") {
							mySwal("Validation",'Isikan '+$(this).attr("title"),"warning");
							$(this).focus();
							param='';
							return false;
						} else {
                            if($(this).attr("id")=="Password") {
								if($(this).val()!="") {
									// var pwdPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
									var pwdPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*?])[A-Za-z\d!@#$%^&*?]{8,}$/;
									if(!pwdPattern.test($(this).val())) {
										mySwal("Validation","Password harus minimal 8 karakter, mengandung huruf besar, huruf kecil, angka, dan karakter khusus.","warning");
										param='';
										return false;
									} else if($(this).val()!=$("#page_form input.form-control[name='Password2']").val()) {
										mySwal("Validation",'Password harap dikonfirmasi dengan benar',"warning");
										param='';
										return false;
									} else {
								        param += $(this).attr("name")+"="+escape($(this).val())+"&";
									}
								}

							} else if($(this).attr("id")=="Email") {
                                var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                                if(!emailPattern.test($(this).val())) {
                                    mySwal("Validation","Periksa lagi format email yang dimasukkan","warning");
                                    $(this).focus();
                                    param='';
                                    return false;
                                } else {
							        param += $(this).attr("name")+"="+escape($(this).val())+"&";
                                }
                            } else {
							    param += $(this).attr("name")+"="+escape($(this).val())+"&";
                            }
                        }
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
				// if(param!='') {
				// 	if($("#page_form input.form-control[name='Password']").val()!="") {
				// 		var pwdPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
				// 		var pwd = $("#page_form input.form-control[name='Password']").val();
				// 		if(!pwdPattern.test(pwd)) {
				// 			mySwal("Validation","Password harus minimal 8 karakter, mengandung huruf besar, huruf kecil, angka, dan karakter khusus.","warning");
				// 			param='';
				// 			return false;
				// 		} else if($("#page_form input.form-control[name='Password']").val()!=$("#page_form input.form-control[name='Password2']").val()) {
				// 			mySwal("Validation",'Periksa lagi Password yang diisikan',"warning");
				// 			param='';
				// 			return false;
				// 		}
				// 	}
				// }
				if(param!='') {
					parammenus += '&menus=';
					$("#table-hak-akses").DataTable().rows().nodes().to$().each(function () {
						var node = $(this); 
						if(node.find(".editable-check[name='chkMenu']:checked").get().length>0) {
							var thisVal = node.find(".editable-check[name='chkMenu']:checked").val();
							parammenus += escape(thisVal)+"###";
						}
					});

					if(parammenus=='&menus=') {
						Swal.fire({ title: "Validation", text: "Pilih Menu!",icon: "warning",})
							.then((result) => {
								if (result.isConfirmed) { $("#tab-2-tab").trigger('click'); } 
							});
						param = '';	
					} else if (parammenus=='') {
						param = '';
					} else {
						param+=parammenus;
					}
				}
				// if(param!='') {
				// 	paramdesas = '&desas=';
				// 	$("#table-hak-akses-desa").DataTable().rows().nodes().to$().each(function () {
				// 		var node = $(this); 
				// 		if(node.find(".editable-check[name='chkDesa']:checked").get().length>0) {
				// 			var thisVal = node.find(".editable-check[name='chkDesa']:checked").val();
				// 			paramdesas += escape(thisVal)+"###";
				// 		}
				// 	});
                //     param+=paramdesas;

				// }
                // alert(param); 
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
                                                        arResponse = arResp[2].split("<!--##-->");
                                                        for(var i=0;i<arResponse.length;i++) {
                                                            arVal = arResponse[i].split("@@@");
                                                            $("#page_form .form-control[name='"+arVal[0]+"']").val(arVal[1]);	
                                                        }
                                                        setTimeout(function() {
                                                            if($('#image').cropper('getData').height>0) {
                                                                saveDataFoto(arResp[1]);
                                                            } else {
                                                                Swal.close(); 
                                                                Swal.fire({ title: "Success", html: arResp[1],icon: "success",})
                                                                    .then((result) => {
                                                                        // if (result.isConfirmed) { reloadPage(); } 
                                                                        if (result.isConfirmed) { 
                                                                            pleaseWait(); 
                                                                                window.location = page_list;
                                                                        } 
                                                                    });
                                                            } 
                                                        },100);
                                                    }
                                                } else {
                                                    Swal.close(); 
                                                    Swal.fire({ title: "Error", html: arResp[1], icon: "error" });
                                                }
                                            }
                                        }, error: function(jqXHR, textStatus, errorThrown) {  
                                            Swal.close();
                                            Swal.fire({ title: jqXHR.status+" Error", html: "Internal Error in Saving Data.", icon: "error" });
                                        }
                                    });
                                }
							});				
	
						} 
					});

				}
			}			

			function saveData2() { 
				var param = '0='+escape(page_href)+"&", parammenus = '';
				if(param!='') {
					$("#page_form input.form-control[type='hidden']").each(function() {
							param += $(this).attr("name")+"="+escape($(this).val())+"&";
					});
				}
				if(param!='') {
					$("#page_form select.form-control").each(function() {
							param += $(this).attr("name")+"="+escape($(this).val())+"&";
					});
				}
				if(param!='') {
					parammenus += '&menus=';
					$("#page_form .editable-check[name='chkMenu']:checked").each(function() {
						if($(this).prop("checked")) {
							if($("#page_form .form-control[name='Indeks"+$(this).val()+"']").val()=='') {
								Swal.fire({ title: "Validation", text: "Isikan Indeks Menu "+$(this).val()+"!",icon: "warning",})
									.then((result) => {
										if (result.isConfirmed) { $("#page_form .form-control[name='Indeks"+$(this).val()+"']").focus(); } 
									});
								parammenus = '';
								return false;
							} else {
		//						parammenus += escape($(this).val())+"@@@"+
		//							escape($("#page_form .form-control[name='Indeks"+$(this).val()+"']").val());
		//						if($("#page_form .editable-check[name='chkAdaSubMenu"+$(this).val()+"']").prop("checked")) {
		//							parammenus += "@@@1";
		//						} else {
		//							parammenus += "@@@0";
		//						}
		//						if($("#page_form .editable-check[name='chkPreSeparator"+$(this).val()+"']").prop("checked")) {
		//							parammenus += "@@@1"+"@@@";
		//						} else {
		//							parammenus += "@@@0"+"@@@";
		//						}
		//						parammenus += $("#page_form .form-control[name='hdnChangeMenu"+$(this).val()+"']").val()+"###";
								parammenus += escape($(this).val())+"###";
							}
						}
					});
					if(parammenus=='&menus=') {
						Swal.fire({ title: "Validation", text: "Pilih Menu!",icon: "warning",})
							.then((result) => {
								if (result.isConfirmed) { $("#tab-2-tab").trigger('click'); } 
							});
						param = '';	
					} else if (parammenus=='') {
						param = '';
					} else {
						param+=parammenus;
					}
				}

//				        alert(param); 
//				param='';
				if(param!='') { 
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
										arResponse = arResp[2].split("<!--##-->");
										for(var i=0;i<arResponse.length;i++) {
											arVal = arResponse[i].split("@@@");
											$("#page_form .form-control[name='"+arVal[0]+"']").val(arVal[1]);	
										}
										setTimeout(function() {
											Swal.close(); 
											Swal.fire({ title: "Success", text: arResp[1],icon: "success",})
												.then((result) => {
													// if (result.isConfirmed) { reloadPage(); } 
													if (result.isConfirmed) { 
														pleaseWait(); 
														if($("#page_form .form-control[name='KodeLama']").val()=="") 
															window.location = page_list;
														else
//															window.location.reload(); 
															window.location = page_list+"/frm/cod"+$("#page_form .form-control[name='KodeLama']").val();
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
			}
			
			function saveDataFoto(Msg) {
				var cropcanvas = $('#image').cropper('getCroppedCanvas');
				var croppng = cropcanvas.toDataURL("image/jpeg");
				//alert(base_url_class+"upload_img_crop");
				$.ajax({
					type: 'POST',
//					url: base_url_class+"upload_img_crops3", 
					url: base_url_class+"upload_img_crop", 
					data: {
						href: $(location).attr('href'),
						fileimg: croppng,
						kode: $("#page_form .form-control[name='KodeLama']").val(),
						folder: "users"
					},
					success: function(output) { // alert(output)
						if(output.indexOf("users")>0) {
							setTimeout(function() {

								Swal.close(); 
								Swal.fire({ title: "Success", text: Msg,icon: "success",})
									.then((result) => {
										// if (result.isConfirmed) { reloadPage(); } 
										if (result.isConfirmed) { 
											pleaseWait(); 
											if($("#page_form .form-control[name='KodeLama']").val()=="") 
												window.location = page_list;
											else
//															window.location.reload(); 
												window.location = page_list+"/frm/cod"+$("#page_form .form-control[name='KodeLama']").val();
										} 
									});
							},1000);
						} else {
							mySwal("Error","Upload Foto gagal. Silahkan coba lagi.","error");
//							autoDelete($("#page_form .form-control[name='KodeLama']").val());
						}
					},
					error:function(jqXHR, textStatus, errorThrown) { 
						mySwal(jqXHR.status+" Error",textStatus+" "+jqXHR.responseText,"error"); 
//						autoDelete($("#page_form .form-control[name='KodeLama']").val());
					}
				});
			}

			function isCheckAll() {
				var checked = ($(".editable-check[name='chkMenu']:checked").get().length==$(".editable-check[name='chkMenu']").get().length) ? true : false;
				$("#chkMenu_All").prop("checked",checked);
			}
			
			function pleaseWait() {
				Swal.close();
				Swal.fire({
				  title: 'Please wait',
				  html: 'Please wait while reload the page',
				  didOpen: () => {
					Swal.showLoading()
				  },
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





			function init_cropper() {
		//        var colWidth = 
				if( typeof ($.fn.cropper) === 'undefined'){ return; }
				console.log('init_cropper');
				
				var $image = $('#image');
				var $download = $('#download');
				var $dataX = $('#dataX');
				var $dataY = $('#dataY');
				var $dataHeight = $('#dataHeight');
				var $dataWidth = $('#dataWidth');
				var $dataRotate = $('#dataRotate');
				var $dataScaleX = $('#dataScaleX');
				var $dataScaleY = $('#dataScaleY');
		//        var options = {
				options = {
					  aspectRatio: 1 / 1,
		//              preview: '.img-preview',
		//			  minContainerWidth:colWidth,	// tambahan
					  crop: function (e) {
						$dataX.val(Math.round(e.x));
						$dataY.val(Math.round(e.y));
						$dataHeight.val(Math.round(e.height));
						$dataWidth.val(Math.round(e.width));
						$dataRotate.val(e.rotate);
						$dataScaleX.val(e.scaleX);
						$dataScaleY.val(e.scaleY);
					  },
					  checkCrossOrigin: false
					};
		
		
				// Tooltip
				$('[data-toggle="tooltip"]').tooltip();
		
		
				// Cropper
				$image.on({
				  'build.cropper': function (e) {
					console.log(e.type);
				  },
				  'built.cropper': function (e) {
					console.log(e.type);
				  },
				  'cropstart.cropper': function (e) {
					console.log(e.type, e.action);
				  },
				  'cropmove.cropper': function (e) {
					console.log(e.type, e.action);
				  },
				  'cropend.cropper': function (e) {
					console.log(e.type, e.action);
				  },
				  'crop.cropper': function (e) {
					console.log(e.type, e.x, e.y, e.width, e.height, e.rotate, e.scaleX, e.scaleY);
				  },
				  'zoom.cropper': function (e) {
					console.log(e.type, e.ratio);
				  }
				}).cropper(options);
		
				// Methods
				$('.toolbar').on('click', '[data-method]', function () {
				  var $this = $(this);
				  var data = $this.data();
				  var $target;
				  var result;
		
				  if ($this.prop('disabled') || $this.hasClass('disabled')) {
					return;
				  }
		
				  if ($image.data('cropper') && data.method) {
					data = $.extend({}, data); // Clone a new one
		
					if (typeof data.target !== 'undefined') {
					  $target = $(data.target);
		
					  if (typeof data.option === 'undefined') {
						try {
						  data.option = JSON.parse($target.val());
						} catch (e) {
						  console.log(e.message);
						}
					  }
					}
		
					result = $image.cropper(data.method, data.option, data.secondOption);
		
					switch (data.method) {
					  case 'scaleX':
					  case 'scaleY':
						$(this).data('option', -data.option);
						break;
		
					}
		
					if ($.isPlainObject(result) && $target) {
					  try {
						$target.val(JSON.stringify(result));
					  } catch (e) {
						console.log(e.message);
					  }
					}
		
				  }
				});
		
				// Keyboard
				$(document.body).on('keydown', function (e) {
				  if (!$image.data('cropper') || this.scrollTop > 300) {
					return;
				  }
		
				  switch (e.which) {
					case 37:
					  e.preventDefault();
					  $image.cropper('move', -1, 0);
					  break;
		
					case 38:
					  e.preventDefault();
					  $image.cropper('move', 0, -1);
					  break;
		
					case 39:
					  e.preventDefault();
					  $image.cropper('move', 1, 0);
					  break;
		
					case 40:
					  e.preventDefault();
					  $image.cropper('move', 0, 1);
					  break;
				  }
				});
		
				// Import image
				var $inputImage = $('#inputImage');
				var URL = window.URL || window.webkitURL;
				var blobURL;
		
				if (URL) {
				  $inputImage.change(function () {
					var files = this.files;
					var file;
		
					if (!$image.data('cropper')) {
					  return;
					}
		
					if (files && files.length) {
					  file = files[0];
		
					  if (/^image\/\w+$/.test(file.type)) {
						blobURL = URL.createObjectURL(file);
						$image.one('built.cropper', function () {
		
						  // Revoke when load complete
						  URL.revokeObjectURL(blobURL);
						}).cropper('reset').cropper('replace', blobURL);
						$inputImage.val('');
					  } else {
						window.alert('Please choose an image file.');
					  }
					}
				  });
				} else {
				  $inputImage.prop('disabled', true).parent().addClass('disabled');
				}
		//        alert('test')
			};

			
			isCheckAll();
		});
    
    </script>
