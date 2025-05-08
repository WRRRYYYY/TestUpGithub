	<script src="<?php echo base_url(); ?>plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.8/js/dataTables.fixedHeader.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			var	base_url_class = "<?php echo $base_url_class  ?>", 
				base_url = "<?php echo base_url()  ?>", 
				default_main_segmen = "<?php echo $default_main_content_type  ?>", 
				page_href = window.location.pathname;

			<?php 
				$hash = hash('sha512',rand());
				$pos = substr(rand(),0,1); 
				$mnu = $pos . substr($hash,0,128-intval($pos)) . $AppClass->KodeMenu . substr($hash,-1*intval($pos));
			?>
			var page_form = '<?php echo  base_url() . "/" . strtolower($controller_name)."/mnu/" . substr(md5(rand()),4,7) . "/salt/" . $mnu . "/frm/"; ?>';

			// ##################################################################
			var buttonCommon = {
				exportOptions: {
					format: {
						body: function ( data, row, column, node ) {
							// Strip $ from salary column to make it numeric
							return column < 3 ?	// kolom pertama
								"\0" + data.replace( /(<([^>]+)>)/ig, '') :
								data.replace( /[.,]/g, '' );
						}
					}
				}
			};
			// ##################################################################
			
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
				"pageLength": 10
			});

//			$(".control-view").on("click",function(e) { 
//				e.preventDefault();
//				var code = $(this).attr("href");
//				openForm(code);
//			});

			$("#card-header .control-new").on("click",function(e) {
				window.location = page_form;
			});

			$("#card-header .control-reload").on("click",function(e) {
				window.location.reload();
			});
//			$(".control-delete").on("click", function(e) {
			$("#datatable").on("click","a.control-delete", function(e) { 
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
						delData(btn.attr("href")); 
					} 
				});

			});

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

		});
    
    </script>
