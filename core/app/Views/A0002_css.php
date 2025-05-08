    <link rel="stylesheet" href="<?php echo base_url() ?>/plugins/select2/css/select2.min.css" type="text/css" />
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  	<link rel="stylesheet" href="<?php echo base_url() ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  	<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.8/css/fixedHeader.dataTables.min.css">
  <style>
	#datatable { min-width:100%; }
  	/*#datatable th { background-color:#228dff; color:#FFF; }	*/
	#datatable td, th { 
	  white-space:nowrap; 
	  padding-top: calc(0.25rem + 1px);
	  padding-bottom: calc(0.25rem + 1px);
	  font-size: 1em;
	  line-height: 1.25;
	}
	tfoot tr th { 
	  padding-top: calc(0.25rem + 1px) !important;
	  padding-bottom: calc(0.25rem + 1px) !important;
	}

	.dataTables_wrapper .dataTables_info { float:left; }
	.dataTables_wrapper .dataTables_length {
	  padding-top: 0.85em;
	}
	.dataTables_wrapper .dataTables_paginate { float:right; padding-top: 0.85em; }
	.dataTables_wrapper .dataTables_paginate .paginate_button {
		font-size:8.8pt;	
	}
	
	button.control-edit, button.control-edit:hover { color:#aaaaaa; }
	a.control-edit { color:#007bff; }
	a.control-edit:hover { color:#00f; }
	a.control-del { color:#dc3545; }
	a.control-del:hover { color:#f00; }
  </style>

