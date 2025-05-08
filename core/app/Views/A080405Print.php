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
	$Lampiran = "";

	$RegNo = "-auto-";
	$RegTanggal = "";
	$NomorSurat = "";
	$TanggalSurat = "";
	$Kepada = "";
	$AlamatKepada = "";
	$Perihal = "";
	$Jenis = "";

	$HeaderSurat = "";
	$KodeHeader = "";
	$Isi = "";
	$Tembusan = "";
	$NamaTTD = "";
	$JabatanTTD = "";


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
				$Lampiran = $oRS->Lampiran;

				$RegNo = $oRS->RegNo;
				$RegTanggal = $oRS->RegTanggal;
				$NomorSurat = $oRS->NomorSurat;
				$TanggalSurat = $oRS->TanggalSurat;
				$Kepada = $oRS->Kepada;
				$AlamatKepada = $oRS->AlamatKepada;
				$Perihal = $oRS->Perihal;
				$Jenis = $oRS->Jenis;
				$HeaderSurat = $oRS->HeaderSurat;
				$KodeHeader = $oRS->KodeHeader;
				$Isi = $oRS->Isi;
				$Tembusan = $oRS->Tembusan;

				$Kepada = $oRS->Kepada;
				$NamaTTD = $oRS->NamaTTD;
				$JabatanTTD = $oRS->JabatanTTD;

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
	<div style="position:relative; height:2.5cm; width:16.7cm; text-align:center; margin:auto; padding-top:1cm; border-bottom:3px double #666 !important; margin-top:-0.6cm;"">
		<div style=" width:2.7cm; float:left; text-align:right"><img src="<?php echo base_url() ?>/assets/img/logo_jateng.png" style="width:2.8cm; margin-top:-0.5cm;" /></div>
	<div style="width:14cm; float:right; text-align:center; margin-top:-0.5cm;">
		<?php echo $HeaderSurat ?>

	</div>
	<br style="line-height:1em; clear:both" />

	</div>
	<br style="line-height:0.2cm;" />
	<!-- <div style="height:0.5cm; width:20cm; text-align:center; margin:auto; border:1px solid #000 !important;"><span style="font-size:12pt; line-height:0.5cm; font-family:'Times New Roman', Times, serif; font-weight:bold;">BUKTI PENERIMAAN SURAT</span>
</div> -->


	<?php if ($Jenis != '05'): ?>
		<!-- jika jenis surat selain 05 -->
		<div style="width:16.7cm; padding-top:12pt; margin:auto; display: flex; justify-content: space-between;">
			<!-- Kiri -->
			<div style="width:12.5cm;">
				<div style="font-size:10pt; float:left; width:1.5cm;">Nomor</div>
				<div style="font-size:10pt; float:left; width:0.5cm; text-align:center;">:</div>
				<div style="font-size:10pt; float:left; width:7.5cm;"><?php echo $NomorSurat ?>&nbsp;</div>

				<div style="clear:both"></div>

				<div style="font-size:10pt; float:left; width:1.5cm;">Lampiran</div>
				<div style="font-size:10pt; float:left; width:0.5cm; text-align:center;">:</div>
				<div style="font-size:10pt; float:left; width:7.5cm;"><?php echo $Lampiran ?>&nbsp;</div>

				<div style="clear:both"></div>

				<div style="font-size:10pt; float:left; width:1.5cm;">Perihal</div>
				<div style="font-size:10pt; float:left; width:0.5cm; text-align:center;">:</div>
				<div style="font-size:10pt; float:left; width:7.5cm;"><?php echo $Perihal ?>&nbsp;</div>
			</div>
			<!-- Kanan (Kota) -->
			<div style="width:4.2cm; text-align:left;">
				<div style="font-size:10pt;">Semarang, <?php echo $AppClass->date_format_ina($TanggalSurat) ?></div>
			</div>
		</div>
		<div style="width:16.7cm; padding-top:12pt; margin:auto; display: flex; justify-content: space-between;">
			<!-- Kiri -->
			<div style="width:12.5cm;">
				<div style="font-size:10pt; float:left; width:2.5cm;">Kepada Yth.</div><br>
				<div style="font-size:10pt; float:left; width:7.5cm;"><?php echo $Kepada ?>&nbsp;</div>
				<div style="clear:both"></div>
				<div style="font-size:10pt; float:left; width:0.5cm;">Di-</div>
				<div style="font-size:10pt; float:left; width:10cm;"><?php echo $AlamatKepada ?>&nbsp;</div>
			</div>
		</div>
	<?php else: ?>
		<!-- jika jenis surat 05 tampil ini -->
		<div style="height:auto; width:16.7cm; text-align:center; padding-top:0; padding-top:0.5cm; margin:auto;">
			<span style="font-size:12pt; font-weight:bold; text-decoration:underline; ">S U R A T &nbsp;T U G A S</span><br style="line-height:1em" />
			<span style="font-size:10pt;">Nomor : <?php echo $NomorSurat ?></span><br>
			<!-- Kota dan Tanggal - Kanan -->
			<div style="text-align:right; padding-top:0.5cm;">
				<div style="font-size:10pt;">Semarang, <?php echo $AppClass->date_format_ina($TanggalSurat) ?></div>
			</div>
		</div>

	<?php endif; ?>

	<div style="font-size:10pt; width:16.7cm; padding-top:8pt; margin:auto;">
		<?php echo $Isi ?>
	</div>
	<div style="width:16.7cm; padding-top:12pt; margin:auto;">
		<div style="width:8cm; float:right; text-align:left; padding-top:1cm;">
			<div style="font-size:10pt;"><?php echo $JabatanTTD ?></div><br /><br /><br /><br /><br />
			<div style="font-size:10pt; font-weight:bold;">
			<?php echo $NamaTTD ?>
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>
	<?php
$TembusanList = array_filter(array_map('trim', explode(',', $Tembusan)));
?>

<?php if (!empty($TembusanList)) : ?>
<div style="width:16.7cm; padding-top:12pt; margin:auto;">
    <div style="font-size:10pt; font-weight:bold; margin-bottom:4pt;">Tembusan Yth.:</div>
    <ol style="font-size:10pt; padding-left:20px; margin:0;">
        <?php foreach ($TembusanList as $item): ?>
            <li><?= $item ?></li>
        <?php endforeach; ?>
    </ol>
</div>
<?php endif; ?>

	<div style="width:18.2cm; padding-top:20pt; margin:auto;">
		<div style="color:#ccc; font-size:smaller; font-family:'Courier New', Courier, monospace; text-align:center">&#8249;dicetak dari Aplikasi Sistem Informasi Baznas Jateng (ASIAB) pada <?php echo date("Y-m-d H:i:s"); ?>
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