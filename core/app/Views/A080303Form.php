<?= $this->extend('layout/bsa_main') ?>
<?= $this->section('main') ?>
<?php if (!$SessionEmpty) {
	$NamaInstitusi = "BADAN AMIL ZAKAT NASIONAL";
	$AlamatPhoneFax = "Jl. Taman Makam Pahlawan Kusumajati Kendal Bugangin Kodepos 51315";
	$Website = "";
	$Email = "";
	//$PrintTime = date("Y\-m\-d H:i:s");
	// if (isset($oQuery)) {
	// 	if (count($oQuery) > 0) {
	// 		foreach ($oQuery as $oRS) {
	// 			$PrintTime = $oRS->PrintTime;
	// 			//				$NamaInstitusi = $oRS->NamaInstitusi;
	// 			//				$Bulan = $oRS->Bulan;
	// 		}
	// 	}
	// }

  $Isi = "";
	if (isset($oQueryHdr)) {
		if (count($oQueryHdr) > 0) {
			foreach ($oQueryHdr as $oRS) {
				$Isi = $oRS->Isi;
				//				$NamaInstitusi = $oRS->NamaInstitusi;
				//				$Bulan = $oRS->Bulan;
			}
		}
	}

	$KodeLama = "";
	$Kode = "";
	$Periode = date("Y");

	$RegNo = "-auto-";
	$RegTanggal = "";
	$NomorSurat = "";
	$TanggalSurat = "";
	$Pengirim = "";
	$Perihal = "";
	$Jenis = "";

	$Agenda = "0";
	$AgendaTempat = "";
	$AgendaTanggal = "";
	$AgendaDeskripsi = "";
	$CrtTime = "";
	
	$Kepada = "";

	$EditDisabled = "0";

	$TotalRow = 0;
	$FirstRec = "1";
	$LastRec = "0";
	$prefixKota = array("Provinsi Administrasi", "Provinsi", "Kota Administrasi", "Kota");
	if (isset($oQuery)) {
		if (count($oQuery) > 0) {
			foreach ($oQuery as $oRS) {

				$KodeLama = $oRS->idx;
				$Kode = $oRS->idx;
				$Periode = $oRS->Periode;

				$RegNo = $oRS->RegNo;
				$RegTanggal = $oRS->RegTanggal;
				$NomorSurat = $oRS->NomorSurat;
				$TanggalSurat = $oRS->TanggalSurat;
				$Pengirim = $oRS->Pengirim;
				$Perihal = $oRS->Perihal;
				$Jenis = $oRS->Jenis;

				$Agenda = $oRS->Agenda;
				$AgendaTempat = $oRS->AgendaTempat;
				$AgendaTanggal = $oRS->AgendaTanggal;
				$AgendaDeskripsi = $oRS->AgendaDeskripsi;
				$CrtTime = $oRS->CrtTime;
				
				$Kepada = $oRS->Kepada;

				$FirstRec = $oRS->FirstRec;
				$LastRec = $oRS->LastRec;
			}
		}
	}

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Form <?php echo $NamaMenu ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right" style="display:none">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $NamaMenu ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <!-- ./row -->
      <div class="row">
        <div class="col-12 col-sm-12">
          <div class="card ">
            <div class="card-header p-0 pt-1 border-bottom-0">

            </div>
            <form id="page_form" role="form" class="form-horizontal">

            <div style="position:relative; height:4cm; width:20cm; text-align:center; margin:auto; padding-top:1cm; border-bottom:3px double #666 !important;">
                <div style="width:4cm; float:left; text-align:right"><img src="<?php echo base_url() ?>/assets/img/logo_jateng.png" style="width:2.8cm; margin-top:-0.5cm;" /></div>
                <div style="width:16cm; float:right; text-align:center;">
                <?php echo $Isi ?>
                    
                </div>
                <br style="line-height:1em; clear:both" />
                
            </div>
            <br style="line-height:0.2cm;" />
            <!-- <div style="height:0.5cm; width:20cm; text-align:center; margin:auto; border:1px solid #000 !important;"><span style="font-size:12pt; line-height:0.5cm; font-family:'Times New Roman', Times, serif; font-weight:bold;">BUKTI PENERIMAAN SURAT</span>
        </div> -->

            <div style="height:auto; width:18.2cm; text-align:center; padding-top:0; padding-bottom:12pt; margin:auto;">
                <span style="font-size:12pt; font-family:'Times New Roman', Times, serif; font-weight:bold; text-decoration:underline">BUKTI PENERIMAAN SURAT</span><br style="line-height:1em" />
            </div>

            <div style="width:16.7cm; padding-top:12pt; margin:auto;">
                <div style="font-size:10pt; float:left;font-family:'Times New Roman', Times, serif; width:3.5cm;">No. Arsip</div>
                <div style="font-size:10pt; float:left;font-family:'Times New Roman', Times, serif; width:1cm; text-align:center;">:</div>
                <div style="font-size:10pt; float:left;font-family:'Times New Roman', Times, serif; width:11.5cm;"><?php echo $RegNo ?>&nbsp;</div>
                <div style="font-size:10pt; float:left;font-family:'Times New Roman', Times, serif; width:3.5cm;">Kepada</div>
                <div style="font-size:10pt; float:left;font-family:'Times New Roman', Times, serif; width:1cm; text-align:center;">:</div>
                <div style="font-size:10pt; float:left;font-family:'Times New Roman', Times, serif; width:11.5cm;"><?php echo $Kepada ?>&nbsp;</div>
                <div style="font-size:10pt; float:left;font-family:'Times New Roman', Times, serif; width:3.5cm;">Pengirim</div>
                <div style="font-size:10pt; float:left;font-family:'Times New Roman', Times, serif; width:1cm; text-align:center;">:</div>
                <div style="font-size:10pt; float:left;font-family:'Times New Roman', Times, serif; width:11.5cm;"><?php echo $Pengirim ?>&nbsp;</div>

                <div style="font-size:10pt; float:left;font-family:'Times New Roman', Times, serif; width:3.5cm;">Tanggal</div>
                <div style="font-size:10pt; float:left;font-family:'Times New Roman', Times, serif; width:1cm; text-align:center;">:</div>
                <div style="font-size:10pt; float:left;font-family:'Times New Roman', Times, serif; width:11.5cm;"><?php echo $TanggalSurat ?>&nbsp;</div>
                <div style="font-size:10pt; float:left;font-family:'Times New Roman', Times, serif; width:3.5cm;">No. Surat</div>
                <div style="font-size:10pt; float:left;font-family:'Times New Roman', Times, serif; width:1cm; text-align:center;">:</div>
                <div style="font-size:10pt; float:left;font-family:'Times New Roman', Times, serif; width:11.5cm;"><?php echo $NomorSurat ?>&nbsp;</div>
                <div style="font-size:10pt; float:left;font-family:'Times New Roman', Times, serif; width:3.5cm;">Perihal</div>
                <div style="font-size:10pt; float:left;font-family:'Times New Roman', Times, serif; width:1cm; text-align:center;">:</div>
                <div style="font-size:10pt; float:left;font-family:'Times New Roman', Times, serif; width:11.5cm;"><?php echo $Perihal ?>&nbsp;</div>
                <!--<span style="clear:both;"></span>-->
            </div>

            <div style="width:18.2cm; padding-top:12pt; margin:auto;">
                <!-- <div style="width:8cm; float:left; margin-left:1cm; padding-top:1cm">
                <img src="<?php //echo base_url() 
                            ?>qrTmp/images/<?php //echo $image_name; 
                                                                    ?>?<?php //echo rand() 
                                                                                                ?>" style="width:3cm" /><br />
            </div> -->
            
                <div style="width:8cm; float:right; margin-right:1cm; padding-top:1cm">
                    <div style="font-size:10pt;font-family:'Times New Roman', Times, serif; margin-left:1cm">Semarang, <?php echo $RegTanggal ?>&nbsp;</div><br />
                    <div style="font-size:10pt;font-family:'Times New Roman', Times, serif; width:8cm; text-align:center; font-weight:bold">
                        Penerima<br /><br /><br /><br />
                        <?php echo $AppClass->session->get($AppClass->AppModule . "UserName") ?>
                    </div>
                </div><br style="clear:both" />
            </div>
            <div style="width:18.2cm; padding-top:20pt; margin:auto;">
                <!-- untuk tracking surat, silahkan discan atau<br />
                kunjungi https://asiab.baznaskendal.or.id/tracking<br />
                isikan kode surat: <?php //echo $KodeTracking 
                                    ?><br /><br /> -->
                <div style="color:#ccc; font-size:smaller; font-family:'Courier New', Courier, monospace; text-align:center">&#8249;dicetak dari Aplikasi Sistem Informasi Baznas Jateng (ASIAB) pada  <?php echo $CrtTime ?>&#8250;</div><br style="clear:both" />
            </div>            
               <!-- /.card-body -->

              <div class="card-footer text-center">
                <button type="button" class="btn control-print btn-primary">Print</button>
              </div>
            </form>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="modal fade" id="modal-overlay">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="overlay d-flex justify-content-center align-items-center">
          <i class="fas fa-2x fa-sync fa-spin"></i>
        </div>
        <div class="modal-header">
          <h4 class="modal-title">Please wait</h4>
          <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>-->
        </div>
        <div class="modal-body">
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <form id="GenForm" method="post" style="display:none"><input type="hidden" name="Doc" value="Print" /><input type="hidden" name="HRef" /><input type="hidden" name="Periode" value="<?= $Periode ?> /><input type="hidden" name="Filter" /><input type="hidden" name="Key" /><input type="hidden" name="Kode" value="<?= $KodeLama ?>" /></form>

<?php
} else {
  echo $html_SessionEmpty;
} ?>
<?= $this->endSection() ?>