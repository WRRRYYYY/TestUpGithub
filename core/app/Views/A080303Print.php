<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!--<title>Lembar Bukti Penerimaan Surat</title>-->
</head>

<body class="page">
	<?php
	$RowWidth = 18;
	$Column = 1;

	?>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
	<style type="text/css">
		* {
			/* font-family: 'Times New Roman', Times, serif; */
			/* font-size: 10pt; */
		}

		body {
			margin: 0;
		}

		.page {
			/*     -webkit-transform: rotate(-90deg); 
     -moz-transform:rotate(-90deg);
     filter:progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
	 height:138mm; width:170mm; 
*/
		}

		.check_box {
			float: left;
			margin-left: 0.2cm;
			width: 0.8cm;
			height: 0.4cm;
			border: 1px solid #000;
			text-align: center;
		}
	</style>
	<?php
	$Periode = $_POST["Periode"];
	$NamaInstitusi = "BADAN AMIL ZAKAT NASIONAL";
	$AlamatPhoneFax = "Jl. Taman Makam Pahlawan Kusumajati Kendal Bugangin Kodepos 51315";
	$Website = "";
	$Email = "";
	//$PrintTime = date("Y\-m\-d H:i:s");
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
	$Tahun = date("Y");

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
	if (isset($oQueryList)) {
		if (count($oQueryList) > 0) {
			foreach ($oQueryList as $oRS) {

				$KodeLama = $oRS->idx;
				$Kode = $oRS->idx;
				$Tahun = $oRS->Periode;

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

	// $AppClass->load->library('ciqrcode'); //pemanggilan library QR CODE

	// $config['cacheable']    = true; //boolean, the default is true
	// $config['cachedir']     = './qrTmp/'; //string, the default is application/cache/
	// $config['errorlog']     = './qrTmp/'; //string, the default is application/logs/
	// $config['imagedir']     = './qrTmp/images/'; //direktori penyimpanan qr code
	// $config['quality']      = true; //boolean, the default is true
	// $config['size']         = '1024'; //interger, the default is 1024
	// $config['black']        = array(224,255,255); // array, default is array(255,255,255)
	// $config['white']        = array(70,130,180); // array, default is array(0,0,0)
	// $AppClass->ciqrcode->initialize($config);

	// $image_name=$KodeTracking.'.png'; //buat name dari qr code sesuai dengan nim

	// $params['data'] = base_url()."tracking/search/".$KodeTracking; //data yang akan di jadikan QR CODE
	// $params['level'] = 'H'; //H=High
	// $params['size'] = 10;
	// $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
	// $AppClass->ciqrcode->generate($params); // fungsi untuk generate QR CODE

	?>
	<div style="position:relative; height:2.5cm; width:20cm; text-align:center; margin:auto; padding-top:1cm; border-bottom:3px double #666 !important; margin-top:-0.6cm;"">
		<div style="width:4cm; float:left; text-align:right"><img src="<?php echo base_url() ?>/assets/img/logo_jateng.png" style="width:2.8cm; margin-top:-0.5cm;" /></div>
		<div style="width:16cm; float:right; text-align:center; margin-top:-0.5cm;">
			<?php echo $Isi ?>

		</div>
		<br style="line-height:1em; clear:both" />
		
	</div>
	<br style="line-height:0.2cm;" />
	<!-- <div style="height:0.5cm; width:20cm; text-align:center; margin:auto; border:1px solid #000 !important;"><span style="font-size:12pt; line-height:0.5cm; font-family:'Times New Roman', Times, serif; font-weight:bold;">BUKTI PENERIMAAN SURAT</span>
</div> -->

	<div style="height:auto; width:18.2cm; text-align:center; padding-top:0; padding-bottom:12pt; margin:auto;">
		<span style="font-size:12pt; font-weight:bold; text-decoration:underline">BUKTI PENERIMAAN SURAT</span><br style="line-height:1em" />
	</div>

	<div style="width:16.7cm; padding-top:12pt; margin:auto;">
		<div style="font-size:10pt; float:left; width:3.5cm;">No. Arsip</div>
		<div style="font-size:10pt; float:left; width:1cm; text-align:center;">:</div>
		<div style="font-size:10pt; float:left; width:11.5cm;"><?php echo $RegNo ?>&nbsp;</div>
		<div style="font-size:10pt; float:left; width:3.5cm;">Kepada</div>
		<div style="font-size:10pt; float:left; width:1cm; text-align:center;">:</div>
		<div style="font-size:10pt; float:left; width:11.5cm;"><?php echo $Kepada ?>&nbsp;</div>
		<div style="font-size:10pt; float:left; width:3.5cm;">Pengirim</div>
		<div style="font-size:10pt; float:left; width:1cm; text-align:center;">:</div>
		<div style="font-size:10pt; float:left; width:11.5cm;"><?php echo $Pengirim ?>&nbsp;</div>
		<div style="font-size:10pt; float:left; width:3.5cm;">Tanggal</div>
		<div style="font-size:10pt; float:left; width:1cm; text-align:center;">:</div>
		<div style="font-size:10pt; float:left; width:11.5cm;"><?php echo $TanggalSurat ?>&nbsp;</div>
		<div style="font-size:10pt; float:left; width:3.5cm;">No. Surat</div>
		<div style="font-size:10pt; float:left; width:1cm; text-align:center;">:</div>
		<div style="font-size:10pt; float:left; width:11.5cm;"><?php echo $NomorSurat ?>&nbsp;</div>
		<div style="font-size:10pt; float:left; width:3.5cm;">Perihal</div>
		<div style="font-size:10pt; float:left; width:1cm; text-align:center;">:</div>
		<div style="font-size:10pt; float:left; width:11.5cm;"><?php echo $Perihal ?>&nbsp;</div>
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
			<div style="font-size:10pt; margin-left:1cm">Semarang, <?php echo $RegTanggal ?>&nbsp;</div><br />
			<div style="font-size:10pt; width:8cm; text-align:center; font-weight:bold">
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
		<div style="color:#ccc; font-size:smaller; font-family:'Courier New', Courier, monospace; text-align:center">&#8249;dicetak dari Aplikasi Sistem Informasi Baznas Jateng (ASIAB) pada <?php echo $CrtTime ?>
			&#8250;</div><br style="clear:both" />
	</div>


	<script type="text/javascript">
		self.print();
		setTimeout(function() {
			self.close();
		}, 1000);
	</script>
</body>

</html>