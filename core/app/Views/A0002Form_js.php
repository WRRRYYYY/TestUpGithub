    <script src="<?php echo base_url(); ?>/plugins/jasny/jasny-bootstrap.js"></script>

    
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

			$("#page_form .btn-save").off().on("click",function() { saveData() });
			$("#page_form .btn-close").off().on("click",function() { reloadPage() });

			$(".editable-check[name='chkMenu']").on("click",function() { isCheckAll('Menu'); });
			$("#chkMenuAll").on("click",function() { 
				var node = $('#datatable').DataTable().rows().nodes().to$();
				node.find(".editable-check[name='chkMenu']").prop("checked",$(this).prop("checked"));
			});

			$(".editable-check[name='chkSektor']").on("click",function() { isCheckAll('Sektor'); });
			$("#chkSektorAll").on("click",function() { 
//				$(".editable-check[name='chkSektor']").prop("checked",$(this).prop("checked"));
				var node = $('#datatable2').DataTable().rows().nodes().to$();
				node.find(".editable-check[name='chkSektor']").prop("checked",$(this).prop("checked"));
			});


			datatable = $("#datatable").DataTable({
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
			datatable2 = $("#datatable2").DataTable({
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
			$("#tab-2-tab").on("shown.bs.tab",function(e) { 
			   $($.fn.dataTable.tables(true)).DataTable()
				  .columns.adjust();
			});
			$("#tab-3-tab").on("shown.bs.tab",function(e) { 
			   $($.fn.dataTable.tables(true)).DataTable()
				  .columns.adjust();
			});

			$("#page_form input.form-option[type='radio'][name='HakAksesTambahan']").off().on("click", function() {
				if($(this).val()=="1") {
					$("#tab-3-tab").attr("class","nav-link");
					//genDetailList("Client",$("#page_form .form-control[name='KodeLama']").val());
				} else {
					$("#tab-3-tab").attr("class","nav-link disabled");
					//$("#tab-3 .box-body").html("");
				}
			});
			function isCheckAll(list) {
				var node;
				if(list=="Menu")
					node = $('#datatable').DataTable().rows().nodes().to$();
				else if(list=="Sektor")
					node = $('#datatable2').DataTable().rows().nodes().to$();
				if(node.find(".editable-check[name='chk"+list+"']").get().length==node.find(".editable-check[name='chk"+list+"']:checked").get().length) 
					$(".editable-check[name='chk"+list+"All']").prop("checked",true);
				else
					$(".editable-check[name='chk"+list+"All']").prop("checked",false);
			}

			function toggleEdit() { 
				if(EditMode) { 
					$(".btn-edit-mode").prop('disabled', false).removeClass("disabled");
					$(".btn-view-mode").prop('disabled', true).addClass("disabled");
					 
					$(".form-input").prop('disabled', false);
					$(".editable-check").prop('disabled', false);
					if($("#image:visible").get().length>0) { 
						setTimeout(init_cropper,100);
					}

				} else {
					$(".btn-view-mode").prop('disabled', false).removeClass("disabled");
					$(".btn-edit-mode").prop('disabled', true).addClass("disabled");

					$(".form-input").prop('disabled', true);
					$(".editable-check").prop('disabled', true);
					
					$("#image").cropper("destroy");
					
				}
			}
			
			
			$(".control-back").on("click",function(e) { 
				e.preventDefault();
				pleaseWait();
				window.location = page_list;
			})
			$(".control-edit").on("click",function(e) { 
				e.preventDefault();
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
/*				
				var btn = $(this);
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
							saveData();
//							timerInterval = setInterval(() => {
//							  const content = Swal.getHtmlContainer()
//							  if (content) {
//								const b = content.querySelector('b')
//								if (b) {
//								  b.textContent = Swal.getTimerLeft()
//								}
//							  }
//							}, 100)
//						  },
//						  willClose: () => {
//							clearInterval(timerInterval)
						  }
						});				

					} 
				});
*/
				saveData();

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
							mySwal("Validation",'Pilih '+$(this).attr("placeholder"),"warning");
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
				if(param!='') {
					parammenus += '&menus=';
					$('#datatable').DataTable().rows().nodes().to$().each(function () {
						var node = $(this); 
						//node.context is element of tr generated by jQuery DataTables.
						if(node.find(".editable-check[name='chkMenu']:checked").get().length>0) {
							var thisVal = node.find(".editable-check[name='chkMenu']:checked").val();
//							if($(this).prop("checked")) {
								if(node.find(".form-control[name^='Indeks']").val()=='') { 
									mySwal("Validation","Isikan Indeks Menu "+thisVal+"!","warning");
									node.find(".form-control[name^='Indeks']").focus();
									parammenus = '';
									return false;
								} else { 
									parammenus += escape(thisVal)+"@@@"+
										escape(node.find(".form-control[name^='Indeks']").val());
									if(node.find(".editable-check[name^='chkAdaSubMenu']").prop("checked")) {
										parammenus += "@@@1";
									} else {
										parammenus += "@@@0";
									}
									if(node.find(".editable-check[name^='chkPreSeparator']").prop("checked")) {
										parammenus += "@@@1"+"@@@";
									} else {
										parammenus += "@@@0"+"@@@";
									}
									parammenus += node.find(".form-control[name^='hdnChangeMenu']").val()+"###";
								}
//							}
						}
					});

					if(parammenus=='&menus=') {
						mySwal("Validation","Pilih Menu!","warning");
						param = '';	
					} else if (parammenus=='') {
						param = '';
					} else {
						param+=parammenus;
					}
				}


// 				if(param!='' && $("#page_form input.form-option[type='radio'][name='HakAksesTambahan'][value='1']").prop("checked")) {
// 					var paramsektor = '&sektor=', paramkampus = '&kampus=';
// 					$('#datatable2').DataTable().rows().nodes().to$().each(function () {
// 						var node = $(this); 
// 						//node.context is element of tr generated by jQuery DataTables.
// 						if(node.find(".editable-check[name='chkSektor']:checked").get().length>0) {
// 							var thisVal = node.find(".editable-check[name='chkSektor']:checked").val();
// //							if($(this).prop("checked")) {
// 							paramsektor += escape(thisVal)+"@@@";
// 							paramsektor += node.find(".form-control[name^='hdnChangeSektor']").val()+"###";
// 						}
// 					});
// 					if(paramsektor=='&sektor=') {
// 						window.alert('Pilih Sektor');
// 						param = '';	
// 					} else if (paramsektor=='') {
// 						param = '';
// 					} else {
// 						param+=paramsektor;
// 					}
// 				}

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
									success: function(response){ //alert(response);
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
																	if($("#page_form .form-control[name='KodeLama']").val()=="") 
																		window.location = page_list;
																	else
																		window.location.reload(); 
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
