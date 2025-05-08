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
    		var FolderDoc = "suratmasuk";
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

			$('#AjukanCC').select2({
    			placeholder: "Mengetahui"
    		}).on('change', function() {}).trigger('change');
			$('#AjukanCaption').select2({
    			placeholder: "Permohonan Arahan"
    		}).on('change', function() {}).trigger('change');

			$('#DispoKe').select2({
    			placeholder: "Pilih Dispo Ke"
    		}).on('change', function() {}).trigger('change');

			$('#DispoCaption').select2({
    			placeholder: "Pilih Dispo Caption"
    		}).on('change', function() {}).trigger('change');


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

    		$(".control-save").off().on("click", function(e) {
    			e.preventDefault();
    			saveData();
    		});



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


    			if (param != '') {
    				Swal.fire({
    					title: "Anda yakin?",
    					html: "Surat akan didisposisi ke bawahan untuk ditindaklanjuti. Pastikan isinya sudah sesuai.<br>Lanjutkan?",
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
    											text: "Internal Error in Processing Data.",
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
    	$('#DispoKe').on('change', function () {
    var isValid = false;

    $('#DispoKe option:selected').each(function () {
      var noPegawai = $(this).data('nopegawai');
      // Cek jika tidak kosong dan bukan "-"
      if (noPegawai && noPegawai !== '-') {
        isValid = true;
      }
    });

    if (isValid) {
      $('#kirimNotif').prop('disabled', false);
    } else {
      $('#kirimNotif').prop('checked', false).prop('disabled', true);
    }
  });

  // Jalankan saat halaman pertama kali dimuat
  $('#DispoKe').trigger('change');
    	document.getElementById("btnSubmit").addEventListener("click", async function () {
    const selectDispoKe = document.getElementById("DispoKe");
    const selectDispoCaption = document.getElementById("DispoCaption");
    const textareaCatatan = document.getElementById("DispoCatatan");
    const checkboxNotif = document.getElementById("kirimNotif");

    // Ambil semua opsi yang dipilih (tujuan disposisi)
    const selectedOptions = Array.from(selectDispoKe.selectedOptions);
    const noPegawaiList = selectedOptions.map(option => option.getAttribute("data-nopegawai"));

    // Jika tidak ada penerima yang dipilih, beri peringatan
    if (noPegawaiList.length === 0) {
        alert("Silakan pilih tujuan disposisi terlebih dahulu.");
        return;
    }

    // Ambil caption dan catatan
    const captions = Array.from(selectDispoCaption.selectedOptions).map(opt => opt.text).join(", ");
    const catatan = textareaCatatan.value.trim();

    // Ambil tanggal surat dan perihal dari elemen lainnya
    let tanggalSurat = "-";
    let perihal = "-";
    const labelElements = document.querySelectorAll(".form-group.row");
    labelElements.forEach(group => {
        const label = group.querySelector("label");
        if (label) {
            const text = label.textContent.trim();
            if (text === "Tanggal Surat") {
                const span = group.querySelector("span.label-data");
                if (span) tanggalSurat = span.textContent.trim();
            }
            if (text === "Perihal") {
                const span = group.querySelector("span.label-data");
                if (span) perihal = span.textContent.trim();
            }
        }
    });

    const linkSurat = "https://baznasjateng.eoffice.web.id"; // Ganti dengan link surat yang relevan

    // Membuat pesan yang akan dikirim
    const pesan = `📩 *Notifikasi Surat Masuk [Uji Coba Notifikasi]*\n
Ada pesan masuk:

🗂️ *Perihal:* ${perihal}
📅 *Tanggal:* ${tanggalSurat}
📌 *Arahan:* ${captions || '-'}
📝 *Catatan:* ${catatan || '-'}

Mohon segera dicek dan berikan tanggapan.
👉 Klik di sini untuk membuka surat: ${linkSurat}`;

    let successMessages = [];
    let errorMessages = [];

    // Cek apakah checkbox notifikasi dicentang
    if (checkboxNotif && checkboxNotif.checked) {
        // Kirim notifikasi untuk setiap NoPegawai yang dipilih
        for (const noPegawai of noPegawaiList) {
            const data = new FormData();
            data.append("target", noPegawai);
            data.append("message", pesan);
            data.append("schedule", "0");
            data.append("delay", "2");
            data.append("countryCode", "62");

            try {
                const response = await fetch("https://api.fonnte.com/send", {
                    method: "POST",
                    mode: "cors",
                    headers: new Headers({
                        Authorization: "!uDX9u#aTN7tV#@W8FLL", // Token Fonnte Anda
                    }),
                    body: data,
                });

                const res = await response.json();
                console.log(res);
                successMessages.push(`Notifikasi berhasil dikirim ke ${noPegawai}`);
            } catch (error) {
                console.error("Gagal mengirim notifikasi:", error);
                errorMessages.push(`Gagal mengirim notifikasi ke ${noPegawai}`);
            }
        }
    } else {
        console.log("Notifikasi tidak dikirim (checkbox tidak dicentang).");
    }

    // Tampilkan alert setelah pengiriman selesai
    if (successMessages.length > 0) {
        alert(successMessages.join("\n"));
    }
    if (errorMessages.length > 0) {
        alert(errorMessages.join("\n"));
    }

    // Jika ingin submit form setelah mengirim notifikasi (aktifkan jika perlu)
    // document.getElementById("myForm").submit();
});
    </script>