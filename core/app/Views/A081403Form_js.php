    <!-- DataTables -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

    <script src="<?php echo base_url() ?>/plugins/jasny/jasny-bootstrap.js"></script>
    <!-- bootstrap time picker -->
    <script src="<?php echo base_url() ?>/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- wysuhtml5 Plugin JavaScript -->
    <script src="<?php echo base_url() ?>/plugins/summernote/dist/summernote-bs4.min.js"></script>
    <!-- image-uploader -->
    <script src="<?php echo base_url() ?>/plugins/image-uploader/image-uploader.min.js"></script>
    <script src="<?php echo base_url() ?>/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/plugins/jasny/jasny-bootstrap.js"></script>

    <script type="text/javascript">
    	$(document).ready(function() {
    		var base_url_class = "<?php echo $base_url_class  ?>",
    			base_url = "<?php echo base_url()  ?>",
    			default_main_segmen = "<?php echo $default_main_content_type  ?>",
    			page_href = window.location.pathname;
    		var EditMode = false;
    		var NewDataMode = false;
    		var UploadNeeded = false,
    			RemoveNeeded = false;
    		var RemoveStatus;
    		var jsonPreloaded = [];
    		var FolderDoc = "suratkeluar";
    		<?php
			$hash = hash('sha512', rand());
			$pos = substr(rand(), 0, 1);
			$mnu = $pos . substr($hash, 0, 128 - intval($pos)) . $AppClass->KodeMenu . substr($hash, -1 * intval($pos));
			?>
    		var page_list = '<?php echo  base_url() . "/" . strtolower($controller_name) . "/mnu/" . substr(md5(rand()), 4, 7) . "/salt/" . $mnu ?>';

    		$(".quick-select").on("click", function() {
    			var nilai = $(this).data("value"); // Ambil teks dari tombol
    			$("#Catatan").val(nilai); // Masukkan teks ke textarea
    		});

    		$("#page_form .btn-save").off().on("click", function() {
    			saveData()
    		});
    		$("#page_form .btn-close").off().on("click", function() {
    			reloadPage()
    		});

    		// $(".editable-check[name='chkSatuan_1']").on("click",function() { isCheckAll(); });
    		// $("#chkSatuan_2_All").on("click",function() { 
    		// 	$(".editable-check[name='chkSatuan_1']").prop("checked",$(this).prop("checked"));
    		// });

			$('#VerifOleh').select2({
    			placeholder: "Pilih Verif Oleh"
    		}).on('change', function() {}).trigger('change');


    		// $('#Pengirim').select2({
    		// 	placeholder: "Pilih Instansi/OPD Internal", allowClear: true
    		// }).on('change', function() {
    		// }).trigger('change'); 

    		if ($("#page_form .timepicker").get().length > 0) {
    			//Date picker
    			$('#page_form .timepicker').timepicker({
    				showInputs: false,
    				timeFormat: 'HH:mm:ss',
    				showMeridian: false
    			})
    		}

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
    			initComplete: function() {
    				$.fn.dataTable.tables({
    					visible: true,
    					api: true
    				}).columns.adjust();
    			}
    		});
    		$("#tab-2-tab").on("shown.bs.tab", function(e) {
    			$($.fn.dataTable.tables(true)).DataTable()
    				.columns.adjust();
    		});

    		//Date range picker
    		$('#paramdate').datetimepicker({
    			maxDate: "now",
    			format: 'YYYY-MM-DD'
    		});

    		$('#paramdate2').datetimepicker({
    			maxDate: "now",
    			format: 'YYYY-MM-DD'
    		});

    		$('#paramdate3').datetimepicker({

    			format: 'YYYY-MM-DD'
    		});


    		$('.inline-editor').summernote({
    			//				dialogsInBody: true,
    			height: 150,
    			placeholder: "Isikan Isi/Ringkasan",
    			toolbar: [
    				// [groupName, [list of button]]
    				['style', ['bold', 'italic', 'underline', 'clear']],
    				['font', ['strikethrough', 'superscript', 'subscript']],
    				['fontsize', ['fontsize']],
    				['color', ['color']],
    				['para', ['ul', 'ol', 'paragraph']],
    				['height', ['height']]
    			]
    		});

    		$(".control-add").on("click", function(e) {
    			e.preventDefault();
    			var sHTML = '<div class="fileinputt fileinput-new input-group" style="margin:15px 0 10px" data-provides="fileinput">';
    			sHTML += '                <div class="form-control" data-trigger="fileinput">';
    			sHTML += '          <i class="fa fa-file fileinput-exists"></i>';
    			sHTML += '          <span class="fileinput-filename"></span>';
    			sHTML += '      </div>';
    			sHTML += '      <span class="input-group-addon btn btn-primary btn-file"> ';
    			sHTML += '          <span class="fileinput-new">Select file</span>';
    			sHTML += '      <span class="fileinput-exists">Change</span>';
    			sHTML += '      <input type="file" name="DokumenPath" class="file-input">';
    			sHTML += '      </span>';
    			sHTML += '      <a href="#" class="input-group-addon btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a> ';
    			//                sHTML += '      <a href="#" class="input-group-addon btn btn-danger control-remove" style="margin-left:1px;">-</a>';
    			sHTML += '      <input type="hidden" name="FileOri" class="form-control" value="">';
    			sHTML += '      </div>';
    			$(".doc-pad").append(sHTML);
    			$(".doc-pad .control-remove").off().on("click", function(e) {
    				e.preventDefault();
    				$(this).closest(".fileinputt").remove();
    			});
    		});
    		$(".doc-pad .control-remove").on("click", function(e) {
    			e.preventDefault();
    			$(this).closest(".fileinputt").remove();
    		});

    		if ($("input[class='preloaded']").get().length > 0) {
    			jsonPreloaded = [];
    			$("input[class='preloaded']").each(function() {

    				var id = $(this).attr("id");
    				var src = $(this).val();

    				item = {}
    				item["id"] = id;
    				item["src"] = src;

    				jsonPreloaded.push(item);
    			});
    		}

    		$('.input-images').imageUploader({
    			preloaded: jsonPreloaded,
    			imagesInputName: 'photos',
    			preloadedInputName: 'old'
    		});

    		$(".control-back").on("click", function(e) {
    			e.preventDefault();
    			pleaseWait();
    			window.location = page_list;
    		})
    		$(".control-edit").on("click", function(e) {
    			e.preventDefault();
    			EditMode = true;
    			toggleEdit();
    		})
    		$(".control-close").on("click", function() {
    			if ($("#page_form .form-control[name='KodeLama']").val() != "" &&
    				EditMode) {
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
    		$(".control-save").off().on("click", function(e) {
    			e.preventDefault();
    			saveData();
    		});


    		function delData(kode) {
    			var param = '0=' + escape(page_href) + "&1=";
    			if (kode) {
    				param += escape(kode) + '@@@';
    			} else {
    				$("#table-data .cb-data:checked").each(function() {
    					param += escape($(this).val()) + '@@@';
    				});
    			}
    			if (param != '') {
    				$.ajax({
    					type: "POST",
    					url: base_url_class + "del_data",
    					data: param,
    					success: function(msg) {
    						if (msg.toLowerCase().indexOf("session habis") >= 0) {
    							Swal.fire({
    									title: "Session Error",
    									text: msg,
    									icon: "error",
    								})
    								.then((result) => {
    									if (result.isConfirmed) {
    										window.location.reload();
    									}
    								});
    						} else if (msg.indexOf('@@@') > 0) {
    							arMsg = msg.split('@@@');
    							if (parseInt(arMsg[0]) == 0) {
    								//									reloadPage();
    								//									pleaseWait();
    								//									window.location = page_list;
    								Swal.fire({
    										title: "Success",
    										text: "Data berhasil dihapus",
    										icon: "success",
    									})
    									.then((result) => {
    										if (result.isConfirmed) {
    											pleaseWait();
    											window.location = page_list;
    										}
    									});
    							} else {
    								Swal.fire({
    										title: "Attention",
    										text: arMsg[1],
    										icon: "warning",
    									})
    									.then((result) => {
    										if (result.isConfirmed) {
    											pleaseWait();
    											window.location = page_list;
    										}
    									});
    							}
    						} else {
    							mySwal("Error", msg + ".\nMohon coba lagi...", "error");
    						}
    					},
    					error: function() {
    						mySwal("Attention", "Demi stabilitas data, saat ini tidak diperkenankan untuk penghapusan data lewat aplikasi.\nSilahkan hubungi web administrator.", "warning");
    					}
    				});
    			}
    		}

    		function saveData() {
    			var param = '0=' + escape(page_href) + "&",
    				parammenus = '';
    			NewDataMode = ($("#page_form .form-control[name='KodeLama']").val() == "") ? true : false;
    			if (param != '') {
    				$("#page_form input.form-control[type='hidden']").each(function() {
    					param += $(this).attr("name") + "=" + escape($(this).val()) + "&";
    				});
    			}
    			if (param != '') {
    				$("#page_form input.form-control[type!='radio'][type!='checkbox']").each(function() { // text, date
    					if ($.trim($(this).val()) == '' && $(this).attr("required") == "required") {
    						mySwal("Validation", 'Isikan ' + $(this).attr("placeholder"), "warning");
    						$(this).focus();
    						param = '';
    						return false;
    					} else
    						param += $(this).attr("name") + "=" + escape($(this).val()) + "&";
    				});
    			}
    			if (param != '') {
    				$("#page_form textarea.form-control").each(function() {
    					if ($.trim($(this).val()) == '' && $(this).attr("required") == "required") {
    						mySwal("Validation", 'Isikan ' + $(this).attr("placeholder"), "warning");
    						$(this).focus();
    						param = '';
    						return false;
    					} else
    						param += $(this).attr("name") + "=" + escape($(this).val()) + "&";
    				});
    			}
    			if (param != '') {
    				$("#page_form select.form-control").each(function() {
    					param += $(this).attr("name") + "=" + escape($(this).val()) + "&";
    				});
    			}
    			if (param != '') {
    				$("#page_form input.form-control[type='radio']").each(function() {
    					if ($("#page_form .form-control[name='" + $(this).attr("name") + "']:checked").get().length == 0 && $(this).attr("required") == "required") {
    						mySwal("Validation", 'Pilih ' + $(this).attr("placeholder"), "warning");
    						param = '';
    						return false;
    					} else
    						param += $(this).attr("name") + "=" + escape($("#page_form .form-control[name='" + $(this).attr("name") + "']:checked").val()) + "&";
    				});
    			}
    			if (param != '') {
    				$("#page_form input.form-control[type='checkbox']").each(function() {
    					if ($(this).prop("checked")) {
    						param += $(this).attr("name") + "=1&";
    					} else {
    						param += $(this).attr("name") + "=2&";
    					}
    				});
    			}
    			if (param != '') {
    				$("#page_form .inline-editor").each(function() {
    					param += $(this).attr("data-name") + "=" + escape($.trim($(this).summernote("code"))) + "&";
    				});
    			}

    			// 				if(param!='') {
    			// 					parampersonels += '&personels=';
    			// //					$("#page_form .editable-check[name='chkPersonel']:checked").each(function() {
    			// //					$('#datatable').DataTable().rows().iterator('row', function(context, index){
    			// 					$('#datatable').DataTable().rows().nodes().to$().each(function () {
    			// 						var node = $(this); 
    			// 						//node.context is element of tr generated by jQuery DataTables.
    			// 						if(node.find(".editable-check[name='chkPersonel']:checked").get().length>0) {
    			// 							var thisVal = node.find(".editable-check[name='chkPersonel']:checked").val();
    			// //							if($(this).prop("checked")) {
    			// 								parampersonels += escape(thisVal);
    			// 								if(node.find(".editable-check[name^='optKomandan']").prop("checked")) {
    			// 									parampersonels += "@@@1";
    			// 								} else {
    			// 									parampersonels += "@@@0";
    			// 								}
    			// 								parampersonels += "###";
    			// //							}
    			// 						}
    			// 					});

    			// 					if(parampersonels=='&personels=') {
    			// 						mySwal("Validation","Pilih Personel!","warning");
    			// 						param = '';	
    			// 					} else if (parampersonels=='') {
    			// 						param = '';
    			// 					} else {
    			// 						param+=parampersonels;
    			// 					}
    			// 				}

    			//				        alert(param); 
    			//				param='';
    			if (param != '') {
    				Swal.fire({
    					title: "Anda yakin?",
    					html: "Surat akan diajukan ke atasan untuk diverifikasi.<br>Lanjutkan?",
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
    									url: base_url_class + "save_data",
    									data: param,
    									success: function(response) { //alert(response);
    										if (response.toLowerCase().indexOf("session habis") >= 0) {
    											Swal.close();
    											Swal.fire({
    													title: "Session Error",
    													text: response,
    													icon: "error",
    												})
    												.then((result) => {
    													if (result.isConfirmed) {
    														window.location.reload();
    													}
    												});
    										} else {
    											arResp = response.split("###");
    											if (arResp[0] == "0") {
    												if (arResp[2].indexOf("<!--##-->") > 0) {
    													arResponse = arResp[2].split("<!--##-->");
    													for (var i = 0; i < arResponse.length; i++) {
    														arVal = arResponse[i].split("@@@");
    														$("#page_form .form-control[name='" + arVal[0] + "']").val(arVal[1]);
    													}
    													setTimeout(function() {

    														$("#page_form .fileinputt").each(function() {
    															if ($(this).find(".file-input")[0].files.length !== 0) {
    																UploadNeeded = true;
    																//return false;
    															}
    															if ($(this).find(".form-control[name^='FileOri']").val() != "" &&
    																$(this).find('.fileinput-filename').html() == "") {
    																RemoveNeeded = true;
    																//return false;
    															}
    														});
    														if (UploadNeeded) {
    															uploadFile();
    														} else if (RemoveNeeded) {
    															removeFile();
    															//} else {


    															// Get the input file
    															// $inputImages = $("#page_form").find('input[name^="images"]');
    															// if (!$inputImages.length) {
    															// 	$inputImages = $("#page_form").find('input[name^="photos"]')
    															// }
    															// $inputPreloaded = $("#page_form").find('input[name^="old"]');

    															// $("input[class='preloaded']").each(function() {
    															// 	var src = $(this).val(),
    															// 		id = $(this).attr("id"),
    															// 		isExists = false;
    															// 	$("#page_form").find('input[name^="old"]').each(function() {
    															// 		if ($(this).parent().find("img").attr("src") == src) {
    															// 			isExists = true;
    															// 			return false;
    															// 		}
    															// 	});
    															// 	if (!isExists) delDataFoto(id, src);
    															// });
    															// var $startJ = -1;
    															// $("#page_form").find('input[name^="old"]').each(function() {
    															// 	$startJ = Math.max($(this).val(), $startJ);
    															// });
    															// $startJ++;
    															// if ($('.input-images').find("input").prop('files').length > 0) {
    															// 	for (var j = 0; j < $('.input-images').find("input").prop('files').length; j++) {
    															// 		if ((j + 1) < $('.input-images').find("input").prop('files').length)
    															// 			saveDataFoto("", $('.input-images').find("input").get(0).files[j], j + $startJ);
    															// 		else
    															// 			saveDataFoto(arResp[1], $('.input-images').find("input").get(0).files[j], j + $startJ);
    															// 	};

    														} else {
    															Swal.close();
    															Swal.fire({
    																	title: "Success",
    																	text: arResp[1],
    																	icon: "success",
    																})
    																.then((result) => {
    																	if (result.isConfirmed) {
    																		pleaseWait();
    																		if ($("#page_form .form-control[name='KodeLama']").val() == "")
    																			window.location = page_list;
    																		else
    																			window.location = page_list;
    																	}
    																});
    														}



    														//}
    													}, 100);
    												}
    											} else {
    												Swal.close();
    												Swal.fire({
    													title: "Error",
    													text: arResp[1],
    													icon: "error"
    												});
    											}
    										}
    									},
    									error: function(jqXHR, textStatus, errorThrown) {
    										Swal.close();
    										Swal.fire({
    											title: jqXHR.status + " Error",
    											text: "Internal Error in Saving Data.",
    											icon: "error"
    										});
    									}
    								});
    							}
    						});
    					}
    				});
    			}
    		}

    		function delDataFoto(id, src) {
    			var param = 'href=' + escape(page_href) + "&",
    				paramdtls = '';
    			if (src.indexOf("?") > 0) {
    				src = substrLeft(src, src.indexOf("?"));
    			}
    			param += "&Folder=suratmasuk";
    			param += "&kode=" + escape($("#page_form .form-control[name='KodeLama']").val());
    			param += "&id=" + escape(id);
    			param += "&src=" + escape(src);
    			$.ajax({
    				url: base_url_class + "del_gbr",
    				type: 'POST',
    				data: param,
    				success: function(msg) {}
    			});
    		}

    		function saveDataFoto(Msg, theFiles, Seq) {
    			var formData = new FormData();
    			formData.append('href', $(location).attr('href'));
    			formData.append('kode', escape($("#page_form .form-control[name='KodeLama']").val()));
    			formData.append('file', theFiles);
    			formData.append('seq', Seq);
    			formData.append('folder', "suratmasuk");
    			$.ajax({
    				url: '<?php echo base_url() ?>adm/upload_gbr',
    				type: "post",
    				data: formData,
    				processData: false,
    				contentType: false,
    				cache: false,
    				async: false,
    				success: function(data) {
    					if (Msg != "") {
    						Swal.close();
    						Swal.fire({
    								title: "Success",
    								text: Msg,
    								icon: "success",
    							})
    							.then((result) => {
    								if (result.isConfirmed) {
    									pleaseWait();
    									window.location = page_list; // lgsg close form
    								}
    							});
    					}
    				}
    			});
    		}

    		function removeFile() {
    			var RemoveStatus = "0";
    			var i = 0;
    			$("#page_form .fileinputt").each(function() {
    				if ($(this).find(".form-control[name^='FileOri']").val() != "" &&
    					$(this).find('.fileinput-filename').html() == "") {

    					var param = 'href=' + escape(page_href) + "&",
    						paramdtls = '';
    					param += "&Kode=" + escape($("#page_form .form-control[name='KodeLama']").val());
    					param += "&Folder=suratmasuk";
    					param += "&FileOri=" + escape($(this).find(".form-control[name^='FileOri']").val());
    					param += "&DocIdx=" + escape(substrRight("00" + i, 2));
    					$.ajax({
    						url: base_url_class + "remove_doc",
    						type: 'POST',
    						data: param,
    						success: function(msg) {
    							RemoveStatus = "0";
    						},
    						error: function(jqXHR, textStatus, errorThrown) {
    							Swal.close();
    							Swal.fire({
    									title: jqXHR.status + " Error",
    									text: "Error in removing file, please try again.",
    									icon: "error"
    								})
    								.then((result) => {
    									if (result.isConfirmed) {
    										pleaseWait();
    										window.location.reload();
    									}
    								});
    							return false;
    						}
    					});
    				}
    				i++;
    			});
    			if (RemoveStatus == "0") {
    				setTimeout(function() {

    					// Get the input file
    					$inputImages = $("#page_form").find('input[name^="images"]');
    					if (!$inputImages.length) {
    						$inputImages = $("#page_form").find('input[name^="photos"]')
    					}
    					$inputPreloaded = $("#page_form").find('input[name^="old"]');

    					$("input[class='preloaded']").each(function() {
    						var src = $(this).val(),
    							id = $(this).attr("id"),
    							isExists = false;
    						$("#page_form").find('input[name^="old"]').each(function() {
    							if ($(this).parent().find("img").attr("src") == src) {
    								isExists = true;
    								return false;
    							}
    						});
    						if (!isExists) delDataFoto(id, src);
    					});
    					var $startJ = -1;
    					$("#page_form").find('input[name^="old"]').each(function() {
    						$startJ = Math.max($(this).val(), $startJ);
    					});
    					$startJ++;
    					if ($('.input-images').find("input").prop('files').length > 0) {
    						for (var j = 0; j < $('.input-images').find("input").prop('files').length; j++) {
    							if ((j + 1) < $('.input-images').find("input").prop('files').length)
    								saveDataFoto("", $('.input-images').find("input").get(0).files[j], j + $startJ);
    							else
    								saveDataFoto(arResp[1], $('.input-images').find("input").get(0).files[j], j + $startJ);
    						};

    					} else {
    						Swal.close();
    						Swal.fire({
    								title: "Success",
    								text: arResp[1],
    								icon: "success",
    							})
    							.then((result) => {
    								if (result.isConfirmed) {
    									pleaseWait();
    									if ($("#page_form .form-control[name='KodeLama']").val() == "")
    										window.location = page_list;
    									else
    										window.location = page_list;
    								}
    							});
    					}

    					//						Swal.close(); 
    					//						Swal.fire({ title: "Success", text: "Data tersimpan",icon: "success",})
    					//							.then((result) => {
    					//								// if (result.isConfirmed) { reloadPage(); } 
    					//								if (result.isConfirmed) { 
    					//									pleaseWait(); 
    					//									if(NewDataMode) 
    					//										window.location = page_list;
    					//									else
    					//										window.location.reload(); 
    					//								} 
    					//							});
    				}, 100);
    			}
    		}

    		function doRemoveFile($fileOri, DocIdx) {
    			var param = 'href=' + escape(page_href) + "&",
    				paramdtls = '';
    			param += "&Kode=" + escape($("#page_form .form-control[name='KodeLama']").val());
    			param += "&Folder=suratmasuk";
    			param += "&FileOri=" + escape($fileOri.val());
    			param += "&DocIdx=" + escape(DocIdx);
    			$.ajax({
    				url: base_url_class + "remove_doc",
    				type: 'POST',
    				data: param,
    				success: function(msg) {
    					return "0";
    				},
    				error: function(jqXHR, textStatus, errorThrown) {
    					return jqXHR.status;
    				}
    			});
    		}

    		function uploadFile() {
    			var UploadStatus = "0";
    			var i = 0;
    			$("#page_form .fileinputt").each(function() {
    				if ($(this).find(".file-input")[0].files.length !== 0) {
    					//						doUploadFile($(this).find(".file-input"),$(this).find(".form-control[name^='FileOri']"),i);
    					// Upload Process
    					var form = document.getElementById('page_form');
    					var formData = new FormData(form);
    					//				formData.append('section', 'general');
    					//				formData.append('action', 'previewImg');
    					//				// Attach file\
    					formData.append('href', page_href);
    					formData.append('Kode', $("#page_form .form-control[name='KodeLama']").val());
    					//				formData.append('fileToUpload', $('input[type=file]')[0].files[0]); 
    					formData.append('fileToUpload', $(this).find(".file-input")[0].files[0]);
    					formData.append('DocIdx', substrRight("00" + i, 2));
    					formData.append('Folder', "suratmasuk");
    					//				formData.append('FileOri', $("#page_form .form-control[name='FileOri']").val()); 
    					formData.append('FileOri', $(this).find(".form-control[name^='FileOri']").val());
    					$.ajax({
    						type: 'POST',
    						url: base_url_class + "upload_docv2s3",
    						data: formData,
    						contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
    						processData: false, // NEEDED, DON'T OMIT THIS
    						success: function(msg) { //alert(msg);
    							UploadStatus = "0";
    						},
    						error: function(jqXHR, textStatus, errorThrown) {
    							UploadStatus = jqXHR.status;
    							Swal.close();
    							Swal.fire({
    									title: jqXHR.status + " Error",
    									text: "Error in uploading file, please try again.",
    									icon: "error"
    								})
    								.then((result) => {
    									if (result.isConfirmed) {
    										pleaseWait();
    										window.location.reload();
    									}
    								});
    							return false;
    						}
    					});
    				}
    				i++;
    			});
    			if (UploadStatus == "0") {
    				if (RemoveNeeded) removeFile();
    				else {
    					setTimeout(function() {
    						Swal.close();
    						Swal.fire({
    								title: "Success",
    								text: "Data berikut file tersimpan",
    								icon: "success",
    							})
    							.then((result) => {
    								// if (result.isConfirmed) { reloadPage(); } 
    								if (result.isConfirmed) {
    									pleaseWait();

    									if (NewDataMode)
    										window.location = page_list;
    									else
    										window.location.reload();
    								}
    							});
    					}, 100);
    				}
    			}
    		}

    		function doUploadFile($fileInput, $fileOri, DocIdx) {
    			var form = document.getElementById('page_form');
    			var formData = new FormData(form);
    			//				formData.append('section', 'general');
    			//				formData.append('action', 'previewImg');
    			//				// Attach file\
    			formData.append('href', page_href);
    			formData.append('Kode', $("#page_form .form-control[name='KodeLama']").val());
    			//				formData.append('fileToUpload', $('input[type=file]')[0].files[0]); 
    			formData.append('fileToUpload', $fileInput[0].files[0]);
    			formData.append('DocIdx', DocIdx);
    			formData.append('Folder', FolderDoc);
    			//				formData.append('FileOri', $("#page_form .form-control[name='FileOri']").val()); 
    			formData.append('FileOri', $fileOri.val());
    			$.ajax({
    				type: 'POST',
    				url: base_url_class + "upload_docv2s3",
    				data: formData,
    				contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
    				processData: false, // NEEDED, DON'T OMIT THIS
    				success: function(msg) { //alert(msg);
    					UploadStatus = "0";
    				},
    				error: function(jqXHR, textStatus, errorThrown) {
    					UploadStatus = jqXHR.status;
    				}
    			});
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

    		function mySwal(title, text, icon) {
    			Swal.close();
    			Swal.fire({
    				title: title,
    				text: text,
    				icon: icon
    			});
    		}

    		function substrLeft(str, n) {
    			if (n <= 0)
    				return "";
    			else if (n > String(str).length)
    				return str;
    			else
    				return String(str).substring(0, n);
    		}

    		function substrRight(str, n) {
    			if (n <= 0)
    				return "";
    			else if (n > String(str).length)
    				return str;
    			else {
    				var iLen = String(str).length;
    				return String(str).substring(iLen, iLen - n);
    			}
    		}

    		function printData(kode) {
    			$("#GenForm input[name='HRef']").val(escape($(location).attr('href')));
    			$("#GenForm input[name='Doc']").val("");
    			$("#GenForm input[name='Periode']").val($("#Periode").val());
    			$("#GenForm input[name='Kode']").val(kode);
    			$("#GenForm input[name='Key']").val($("#Opsi").val());
    			$("#GenForm").attr("target", "_blank")
    				.attr("action", base_url_class + "print_doc")
    				.submit();
    		}


    		function clearChar(str, chr) {
    			while (str.indexOf(chr) >= 0)
    				str = str.replace(chr, "");
    			return str;
    		}
    		//			// Input New Mode
    		//			if($("#page_form .form-control[name='KodeLama']").val()=="") { 
    		//				EditMode = true;
    		//				toggleEdit();
    		//			}

    	});
    </script>