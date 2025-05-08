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
    <!--jodit-->
    <script src="https://cdn.jsdelivr.net/npm/jodit@3.24.2/build/jodit.min.js"></script>


    <!-- Script jQuery dan Tagify -->
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify@4.6.0/dist/tagify.min.js"></script>

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
			$mnu1 = $pos . substr($hash, 0, 128 - intval($pos)) . "080401" . substr($hash, -1 * intval($pos));
			$mnu2 = $pos . substr($hash, 0, 128 - intval($pos)) . "080302" . substr($hash, -1 * intval($pos));
			$mnu3 = $pos . substr($hash, 0, 128 - intval($pos)) . "080601" . substr($hash, -1 * intval($pos));
			?>
			var page_list = '<?php echo  base_url() . "/" . strtolower($controller_name) . "/mnu/" . substr(md5(rand()), 4, 7) . "/salt/" . $mnu ?>';
    		var url_inbox = '<?php echo  base_url() . "/" . strtolower($controller_name) . "/mnu/" . substr(md5(rand()), 4, 7) . "/salt/" . $mnu1; ?>';
    		var url_arsip = '<?php echo  base_url() . "/" . strtolower($controller_name) . "/mnu/" . substr(md5(rand()), 4, 7) . "/salt/" . $mnu2 . "/frm/"; ?>';
    		var url_ajukan = '<?php echo  base_url() . "/" . strtolower($controller_name) . "/mnu/" . substr(md5(rand()), 4, 7) . "/salt/" . $mnu3 . "/frm/"; ?>';


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

    		$("#Agenda").change(function() {
    			if ($(this).prop("checked")) {
    				$("#agendaGroup").slideDown();
    			} else {
    				$("#agendaGroup").slideUp();
    			}
    		});

    		// Pastikan status awal sesuai dengan nilai yang sudah ada
    		if ($("#Agenda").prop("checked")) {
    			$("#agendaGroup").show();
    		}

    		$("#page_form .control-get-number").off().on("click", function() {
				if($("#page_form .form-control[name='TanggalSurat']").val()=="") {
					mySwal("Validation", 'Isikan/Pilih Tanggal Surat terlebih dahulu', "warning");
				} else {
					pleaseWait('Please wait while opening form');
					var param = '0='+escape(page_list);
					param += "&<?= csrf_token() ?>=<?= csrf_hash() ?>";
					param += '&id='+escape($("#page_form .form-control[name='KodeLama']").val());
					// param += '&per='+escape($("#page_form .form-control[name='Periode']").val());
					param += '&tgl='+escape($("#page_form .form-control[name='TanggalSurat']").val());
					var i = 0;
					var url = page_list+"/frx/GetNumber";
					$.ajax({
						url: url, 
						type:'POST',
						data:param,
						success:function(response){ 
							Swal.close();
							$("#theModalForm").html("List Nomor Surat"); 
							$(".modalForm .modal-body").html(response); 
							$(".modalForm").modal("show"); 

							datatable1 = $("#datatable1").DataTable({
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

							$(document).on("shown.bs.modal", function(e) {
								$($.fn.dataTable.tables(true)).DataTable()
									.columns.adjust();
							});
							if($(".modalForm .form-control[name='BisaAutoNumber']").val()=="0") {
								$(".modalForm .control-auto").prop("disabled",true)
									.attr("title","Sudah ada surat bernomor setelah tanggal "+$(".modalForm .form-control[name='TanggalSuratDipilih']").val());
							} else {
								$(".modalForm .control-auto").prop("disabled",false);
							}
							if($(".modalForm .form-control[name='BisaSisip']").val()=="0") {
								$(".modalForm .control-sisip").prop("disabled",true);
							} else {
								$(".modalForm .control-sisip").prop("disabled",false);
							}
							$(".modalForm .control-auto").off().on('click', function() {
								setAutoNumber($("#page_form .form-control[name='Periode']").val(),$("#page_form .form-control[name='TanggalSurat']").val());
							});
							$(".modalForm .control-sisip").off().on('click', function() {
								if($(".modalForm .form-option[name='optNomor']:checked").get().length==0) {
									mySwal("Validation", 'Pilih Nomor Surat yang akan disisipi', "warning");
								} else {
									setSisipNumber($(".modalForm .form-option[name='optNomor']:checked").val());
								}
							});
							
				
						}, error: function(jqXHR, textStatus, errorThrown) {  
							Swal.close();
							// Swal.fire({ title: jqXHR.status+" Error", text: "Internal Error in Opening Form.", icon: "error" });
							Swal.fire({ title: jqXHR.status+" Error", text: jqXHR.responseText, icon: "error" });
						}
					});
				}
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
    			initComplete: function() {
    				$.fn.dataTable.tables({
    					visible: true,
    					api: true
    				}).columns.adjust();
    			}
    		});

    		//Date range picker
    		$('#paramdate').datetimepicker({
    			maxDate: "now",
    			format: 'YYYY-MM-DD'
    		});
			
			$('#paramdate').on('change.datetimepicker', function (e) {
					setPreviewParam();
					$("#page_form .form-control[name='NomorSurat']").val('').attr("readonly","readonly");
			});

    		$('#paramdate2').datetimepicker({
    			maxDate: "now",
    			format: 'YYYY-MM-DD'
    		});

    		$('#paramdate3').datetimepicker({

    			format: 'YYYY-MM-DD'
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
    			window.location = url_inbox;
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
    				window.location = url_inbox;
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
			$("#timelineAccordion").on("click",function() {
				setPreviewParam();
			});

			$("#page_form .form-control[name='Lampiran']").on("change",function() {
				if($(this).val()!="")
					$("#lampiran_pad").html($(this).val());
			});

			$("#page_form .form-control[name='NomorSurat']").on("change",function() {
				if($(this).val()!="")
					$("#nomor_pad").html($(this).val());
			});

			// $("#page_form .form-control[name='TanggalSurat']").on("change",function() { 
			// 	$("#tanggal_pad").html(formatTanggalIna($(this).val()));
			// });

			function setPreviewParam() {
				if($("#page_form .form-control[name='NomorSurat']").val()!="")
					$("#nomor_pad").html($("#page_form .form-control[name='NomorSurat']").val());
				if($("#page_form .form-control[name='TanggalSurat']").val()!="")
					$("#tanggal_pad").html(formatTanggalIna($("#page_form .form-control[name='TanggalSurat']").val()));
				if($("#page_form .form-control[name='Lampiran']").val()!="")
					$("#lampiran_pad").html($("#page_form .form-control[name='Lampiran']").val());

			}
			
    		function setAutoNumber(periode,tanggal) {
				var param = '0='+escape(page_href);
				param += '&1=AutoNumber';
				param += "&periode="+escape(periode);
				param += "&id="+escape(tanggal);
				param += "&<?= csrf_token() ?>=<?= csrf_hash() ?>";
				$.ajax({
					url: base_url_class+"get_data_detail_ext", 
					type:'POST',
					data:param,
					success:function(response){  //alert(response)
						$("#page_form .form-control[name='NomorSurat']").val(response)
						//  .removeAttr('readonly').attr('readonly','readonly');
							.removeAttr('readonly');
						$(".modalForm").modal("hide");
						$(".sisip-pad").removeClass("d-none").addClass("d-none");
						$("#page_form .form-control[name='Sisip']").val('0');
						setPreviewParam();
					} 
				});
			}
    		function setSisipNumber(idx) { //alert(idx)
				var param = '0='+escape(page_href);
				param += '&1=Sisip';
				param += "&id="+escape(idx);
				param += "&<?= csrf_token() ?>=<?= csrf_hash() ?>";
				$.ajax({
					url: base_url_class+"get_data_detail_ext", 
					type:'POST',
					data:param,
					success:function(response){  //alert(response)
						$("#page_form .form-control[name='NomorSurat']").val(response)
							.removeAttr('readonly');
						$(".modalForm").modal("hide");
						$(".sisip-pad").removeClass("d-none");
						$("#page_form .form-control[name='Sisip']").val('1');
						setPreviewParam();
					} 
				});
			}
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
    								//									window.location = url_inbox;
    								Swal.fire({
    										title: "Success",
    										text: "Data berhasil dihapus",
    										icon: "success",
    									})
    									.then((result) => {
    										if (result.isConfirmed) {
    											pleaseWait();
    											window.location = url_inbox;
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
    											window.location = url_inbox;
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
    				$("#page_form input.form-control2").each(function() {
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
    					//							param += $(this).attr("name")+"="+escape($(this).val())+"&";
    					if ($.trim($(this).val()) == '' && $(this).attr("required") == "required") {
    						mySwal("Validation", 'Pilih ' + $(this).attr("data-placeholder"), "warning");
    						$(this).focus();
    						param = '';
    						return false;
    					} else
    						param += $(this).attr("name") + "=" + escape($(this).val()) + "&";
    				});
    			}
    			if (param != '') {
    				$("#page_form input.form-control[type='radio']").each(function() {
    					if ($("#page_form .form-control[name='" + $(this).attr("name") + "']:checked").get().length == 0 && $(this).attr("required") == "required") {
    						mySwal("Validation", 'Pilih ' + $(this).attr("title"), "warning");
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
    						param += $(this).attr("name") + "=0&";
    					}
    				});
    			}
    			if (param != '') {
    				$("#page_form .inline-editor").each(function() {
    					const editor = $(this).data("joditInstance");
    					if (editor) {
    						param += $(this).attr("data-name") + "=" + escape($.trim(editor.value)) + "&";
    					}
    				});
    			}
				// if (param != '') {
				// 	$("#page_form .inline-editor").each(function() {
				// 		param += $(this).attr("data-name") + "=" + escape($.trim($(this).summernote("code"))) + "&";
				// 	});
				// }

    			//				if(param!='') {
    			//					$("#page_form .inline-editor").each(function() {
    			//						param += $(this).attr("data-name")+"="+escape($.trim($(this).summernote("code")))+"&";
    			//					});
    			//				}
    			//				        alert(param); 
    			//				param='';
    			if (param != '') {
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
    									url: base_url_class + "save_data",
    									data: param,
    									success: function(response) { //alert(response);
    										if (response.toLowerCase().indexOf("session habis") >= 0) {
    											Swal.close();
    											Swal.fire({
    													title: "Session Error",
    													html: response,
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
														Swal.close();
														Swal.fire({
																title: "Success",
																html: arResp[1],
																icon: "success",
															})
															.then((result) => {
																if (result.isConfirmed) {
																	pleaseWait();
																// 	if ($("#page_form .form-control[name='KodeLama']").val() == "")
																// 		window.location = page_list;
																// 	else
																		window.location = page_list;
																}
															});
    												} else {
    													Swal.close();
    													Swal.fire({
    														title: "Session Error",
    														html: response,
    														icon: "error",
    													});
    												}
    											} else {
    												Swal.close();
    												Swal.fire({
    													title: "Error",
    													html: arResp[1],
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

    		function removeFile() {
    			var RemoveStatus = "0";
    			var i = 0;
    			$("#page_form .fileinputt").each(function() {
    				if ($(this).find(".form-control[name^='FileOri']").val() != "" &&
    					$(this).find('.fileinput-filename').html() == "") {

    					var param = 'href=' + escape(page_href) + "&",
    						paramdtls = '';
    					param += "&Kode=" + escape($("#page_form .form-control[name='KodeLama']").val());
    					param += "&Folder=" + FolderDoc;
    					param += "&FileOri=" + escape($(this).find(".form-control[name^='FileOri']").val());
    					//						param += "&DocIdx="+escape(substrRight("00"+i, 2));
    					param += "&DocIdx=" + escape($(this).find(".form-control[name^='DocIdx']").val());
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
    					Swal.close();
    					Swal.fire({
    							title: "Success",
    							text: "Data tersimpan",
    							icon: "success",
    						})
    						.then((result) => {
    							// if (result.isConfirmed) { reloadPage(); } 
    							if (result.isConfirmed) {
    								pleaseWait();
    								if (NewDataMode)
    									window.location = url_inbox;
    								else
    									window.location.reload();
    							}
    						});
    				}, 100);
    			}
    		}

    		function doRemoveFile($fileOri, DocIdx) {
    			var param = 'href=' + escape(page_href) + "&",
    				paramdtls = '';
    			param += "&Kode=" + escape($("#page_form .form-control[name='KodeLama']").val());
    			param += "&Folder=" + FolderDoc;
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
    					//formData.append('DocIdx', substrRight("00"+i, 2)); 
    					//diganti ini
    					if ($(".form-control[name^='DocIdx']").get().length > 0)
    						formData.append('DocIdx', $(this).find(".form-control[name^='DocIdx']").val());
    					else
    						formData.append('DocIdx', "");
    					formData.append('Folder', FolderDoc);
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
			function formatTanggalIna(tanggal) {
				const bulanIndo = [
				'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
				'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
				];

				// Pecah tanggal: yyyy-mm-dd
				const parts = tanggal.split('-');
				const tahun = parts[0];
				const bulan = parseInt(parts[1], 10) - 1; // Index bulan dimulai dari 0
				const hari = parts[2];

				return `${parseInt(hari)} ${bulanIndo[bulan]} ${tahun}`;
			}
    	});
    </script>