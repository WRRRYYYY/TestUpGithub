    <!--<link rel="stylesheet" href="<?php echo base_url() ?>/plugins/select2/css/select2.min.css" type="text/css" />-->
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  	<link rel="stylesheet" href="<?php echo base_url() ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  	<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.8/css/fixedHeader.dataTables.min.css">
    <!-- Cropper CSS -->
    <link href="<?php echo base_url() ?>/plugins/cropper/cropper.min.css" rel="stylesheet">
    <style>
	#datatable { min-width:100%; }
	.customtab { font-size:14px; }
	.customtab .nav-item a.nav-link { padding-left:10px; padding-right:10px; }
	
	#page-form label {
	  color:#666; 
	}
	#table-hak-akses, #table-hak-akses-desa { width:100%; min-width:100%; max-width:100%; /*font-size:13px;*/  }

	.dataTables_wrapper .dataTables_info { float:left; }
	.dataTables_wrapper .dataTables_length {
	  padding-top: 0.85em;
	}
	.dataTables_wrapper .dataTables_paginate { float:right; padding-top: 0.85em; }
	.dataTables_wrapper .dataTables_paginate .paginate_button {
		font-size:8.8pt;	
	}

	.form-control, .select2 { color:#666; }
	.form-control-sm { height: 31px !important; font-size:13px !important; }
	.control-label { line-height:31px !important; }

	

	.disabled {
	  cursor: not-allowed;
	  pointer-events: all !important;
	}

		.img-container {
		  /* Never limit the container height here */
		  max-width: 100%;
		}
		
		.img-container img {
		  /* This is important */
		  width: 100%;
		}
		
		.cropper .img-container,
		.cropper .img-preview {
			background-color: #f7f7f7;
			width: 100%;
			text-align: center
		}
		.cropper .img-container {
			min-height: 200px;
			/*max-height: 516px;*/
			max-height: 420px;
			margin-bottom: 20px
		}
		@media (min-width: 768px) {
			.cropper .img-container {
				/*min-height: 516px;*/
				min-height: 420px;
			}
		}
		.cropper .img-container>img {
			max-width: 100%;
		}
		.cropper .docs-preview {
			margin-right: -15px
		}
		.cropper .img-preview {
			float: left;
			margin-right: 10px;
			margin-bottom: 10px;
			overflow: hidden
		}
		.cropper .img-preview>img {
			max-width: 100%;
		}
		.cropper .preview-lg {
			width: 263px;
			height: 148px;
			width: 183px;
			height:244px;
			background-color:#f7f7f7;
		}
		.cropper .preview-md {
			width: 139px;
			height: 78px
		}
		.cropper .preview-sm {
			width: 69px;
			height: 39px
		}
		.cropper .preview-xs {
			width: 35px;
			height: 20px;
			margin-right: 0
		}
		.cropper .docs-data>.input-group {
			margin-bottom: 10px
		}
		.cropper .docs-data>.input-group>label {
			min-width: 80px
		}
		.cropper .docs-data>.input-group>span {
			min-width: 50px
		}
		.cropper .docs-buttons>.btn,
		.cropper .docs-buttons>.btn-group,
		.cropper .docs-buttons>.form-control {
			margin-right: 5px;
			margin-bottom: 10px
		}
		.cropper .docs-toggles>.btn,
		.cropper .docs-toggles>.btn-group,
		.cropper .docs-toggles>.dropdown {
			margin-bottom: 10px
		}
		.cropper .docs-tooltip {
			display: block;
			margin: -6px -12px;
			padding: 6px 12px
		}
		.cropper .docs-tooltip>.icon {
			margin: 0 -3px;
			vertical-align: top
		}
		.cropper .tooltip-inner {
			white-space: normal
		}
		.cropper .btn-upload .tooltip-inner,
		.cropper .btn-toggle .tooltip-inner {
			white-space: nowrap
		}
		.cropper .btn-toggle {
			padding: 6px
		}
		.cropper .btn-toggle>.docs-tooltip {
			margin: -6px;
			padding: 6px
		}
		@media (max-width: 400px) {
			.cropper .btn-group-crop {
				margin-right: -15px !important
			}
			.cropper .btn-group-crop>.btn {
				padding-left: 5px;
				padding-right: 5px
			}
			.cropper .btn-group-crop .docs-tooltip {
				margin-left: -5px;
				margin-right: -5px;
				padding-left: 5px;
				padding-right: 5px
			}
		}
		.cropper .docs-options .dropdown-menu {
			width: 100%
		}
		.cropper .docs-options .dropdown-menu>li {
			padding: 3px 20px
		}
		.cropper .docs-options .dropdown-menu>li:hover {
			background-color: #f7f7f7
		}
		.cropper .docs-options .dropdown-menu>li>label {
			display: block
		}
		.cropper .docs-cropped .modal-body {
			text-align: center
		}
		.cropper .docs-cropped .modal-body>img,
		.cropper .docs-cropped .modal-body>canvas {
			max-width: 100%
		}
		.cropper .docs-diagram .modal-dialog {
			max-width: 352px
		}
		.cropper .docs-cropped canvas {
			max-width: 100%
		}
	</style>