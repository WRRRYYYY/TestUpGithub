<?= $this->extend('layout/bsa_main') ?>
<?= $this->section('main') ?>
<?php if (!$SessionEmpty) {
  $KodeLama = "";
  $Kode = "";
  $Tahun = date("Y");

  $RegNo = "-auto-";
  $RegTanggal = date("Y-m-d");
  $NomorSurat = "";
  $TanggalSurat = "";
  $Lampiran = "";



  $Kepada = "";
  $AlamatKepada = "";
  $Perihal = "";
  $Jenis = "";
  $Isi = "";
  $Tembusan = "";
  $KodeHeader = "";

  $NamaTTD = "";
  $JabatanTTD = "";



  $EditDisabled = "0";

  $FirstRec = "0";
  $LastRec = "0";
  $FileName = array("");
  $FileNameOri = array("");
  $DokumenPath = array("");
  $DokumenIdx = array(0);
  $iCnt = 0;
  if (isset($oQuery)) {
    if (count($oQuery) > 0) {
      foreach ($oQuery as $oRS) {

        $KodeLama = $oRS->idx;
        $Kode = $oRS->idx;
        $Tahun = $oRS->Periode;

        $RegNo = $oRS->RegNo;
        $RegTanggal = $oRS->RegTanggal;


        $NomorSurat = $oRS->NomorSurat;
        $TanggalSurat = $oRS->TanggalSurat;
        $Lampiran = $oRS->Lampiran;


        $Kepada = $oRS->Kepada;
        $AlamatKepada = $oRS->AlamatKepada;
        $Perihal = $oRS->Perihal;
        $Jenis = $oRS->Jenis;
        $Isi = $oRS->Isi;
        $Tembusan = $oRS->Tembusan;
        $KodeHeader = $oRS->KodeHeader;

        $NamaTTD = $oRS->NamaTTD;
        $JabatanTTD = $oRS->JabatanTTD;


        $FirstRec = $oRS->FirstRec;
        $LastRec = $oRS->LastRec;

        if ($iCnt < 1) { //if($iCnt<$oRS->DtlSeq) {
          while ($iCnt < 1) {   //while($iCnt<$oRS->DtlSeq) {
            $FileName[$iCnt] = "";
            $DokumenPath[$iCnt] = "";
            $DokumenIdx[$iCnt] = $iCnt;
            $iCnt++;
          }
        }
        $iCnt = 0;
        $FileName[$iCnt] = "";
        $FileNameOri[$iCnt] = "";
        $DokumenPath[$iCnt] = "";
        $DokumenIdx[$iCnt] = 0;
        if (!is_null($oRS->DokumenPath)) $DokumenPath[$iCnt] = $oRS->DokumenPath;
        if ($DokumenPath[$iCnt] != "") {
          $FileName[$iCnt] = substr($DokumenPath[$iCnt], strrpos($DokumenPath[$iCnt], "/", -1) - strlen($DokumenPath[$iCnt]) + 1);
          $FileNameOri[$iCnt] = $oRS->FileNameOri;
        }
        $iCnt++;
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
            <h1 class="m-0 text-dark">Detail Preview Surat Keluar</h1>
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
            <form id="page_form" role="form" class="form-horizontal" style="font-family: 'Times New Roman'; font-size:10pt;">
              <div style="position:relative; height:4cm; width:16.7cm; text-align:center; margin:auto; padding-top:1cm; border-bottom:3px double #666 !important;">
                <div style="width:2.7cm; float:left; text-align:right"><img src="<?php echo base_url() ?>/assets/img/logo_jateng.png" style="width:2.8cm; margin-top:-0.5cm;" /></div>
                <div style="width:14cm; float:right; text-align:center;">
                  <?php
                  if (!empty($KodeHeader) && isset($oQueryKop)) {
                    foreach ($oQueryKop as $oRS) {
                      if ($KodeHeader == $oRS->Kode) {
                        echo '<div class="kop-surat-html">';
                        echo htmlspecialchars_decode($oRS->Isi); // atau echo $oRS->Isi;

                        echo '</div>';
                        break;
                      }
                    }
                  }
                  ?>

                </div>
                <br style="line-height:1em; clear:both" />

              </div>
              <br style="line-height:0.2cm;" />
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
                    <div style="font-size:10pt;">Semarang, <?php
                                                            if (!empty($TanggalSurat) && $TanggalSurat != "") {
                                                              echo $AppClass->date_format_ina($TanggalSurat);
                                                            } else {
                                                              echo "";
                                                            }
                                                            ?>
                    </div>
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
                    <div style="font-size:10pt;">Semarang, <?php
                                                            if (!empty($TanggalSurat) && $TanggalSurat != "") {
                                                              echo $AppClass->date_format_ina($TanggalSurat);
                                                            } else {
                                                              echo "";
                                                            }
                                                            ?></div>
                  </div>
                </div>

              <?php endif; ?>

              <div style="font-size:10pt; width:16.7cm; padding-top:8pt; margin:auto;">
                <?php echo $Isi ?>
              </div>
              <div style="width:16.7cm; padding-top:12pt; margin-left:35%">
                <div style="width:8cm; float:right; text-align:left; padding-top:1cm;">
                  <div style="font-size:10pt;"><?php echo $JabatanTTD ?>.</div><br /><br /><br /><br /><br />
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


              <div class="card-footer">
                <button type="button" class="btn control-close btn-warning">Close</button>
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

<?php
} else {
  echo $html_SessionEmpty;
} ?>
<?= $this->endSection() ?>