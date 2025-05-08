<?= $this->extend('layout/bsa_main') ?>
<?= $this->section('main') ?>
<?php if (!$SessionEmpty) {
  $KodeLama = "";
  $Kode = "";
  $Periode = date("Y");

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

  $AsmanOlehPosisi = "";
  $AsmanOlehNama = "";

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
        $Periode = $oRS->Periode;

        $RegNo = $oRS->RegNo;
        $RegTanggal = $oRS->RegTanggal;


        $Kepada = $oRS->Kepada;
        $AlamatKepada = $oRS->AlamatKepada;
        $Perihal = $oRS->Perihal;
        $Jenis = $oRS->Jenis;
        $Isi = $oRS->Isi;
        $Tembusan = $oRS->Tembusan;
        $KodeHeader = $oRS->KodeHeader;

        $AsmanOlehPosisi = $oRS->AsmanOlehPosisi;
        $AsmanOlehNama = $oRS->AsmanOlehNama;
      

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
            <h1 class="m-0 text-dark">Form <?= $NamaMenu ?></h1>
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
              <input type="hidden" name="KodeLama" class="form-control" value="<?php echo $KodeLama ?>" />
              <input type="hidden" name="Periode" class="form-control" value="<?php echo $Periode ?>" />
              <input type="hidden" name="Sisip" class="form-control" value="0" />
              <div class="card-body">
                <div class="alert alert-info alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-info"></i> Keterangan</h5>
                  Pilih terlebih dahulu Tanggal Surat. Selanjutnya untuk mengisikan Nomor Surat klik tombol Get.<br>
                  Untuk Nomor Sisip, silahkan edit Nomor Surat yang akan disisipi, yang diperoleh dari tombol Get.
                </div>
                <div class="row">
                  <div class="col-md-12">

                    <div class="form-group row">
                        <label for="TanggalSurat" class="col-sm-2 control-label">Tanggal Surat</label>
                        <div class="col-sm-3">
                        <div class="input-group date" id="paramdate" data-target-input="nearest">
                            <input id="TanggalSurat" name="TanggalSurat" type="text" class="form-control datetimepicker-input text-center" data-target="#paramdate" value="<?php echo $TanggalSurat ?>" required="required" placeholder="Isikan/Pilih Tanggal" />
                            <div class="input-group-append" data-target="#paramdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="NomorSurat" class="col-sm-2 control-label">Nomor Surat</label>
                        <div class="col-sm-3">
                            <input name="NomorSurat" type="text" class="form-control" id="NomorSurat" value="<?php echo $NomorSurat ?>" readonly="readonly" required="required" placeholder="Klik tombol Get..." />
                        </div>
                        <div class="col-sm-1">
                            <button type="button" class="btn control-get-number btn-primary">Get</button>
                        </div>
                        <label class="col-sm-5 sisip-pad d-none control-label text-red">silahkan sesuaikan untuk nomor sisip</label>
                    </div>
                    <div class="form-group row">
                        <label for="Lampiran" class="col-sm-2 control-label">Lampiran</label>
                        <div class="col-sm-2">
                            <input name="Lampiran" type="text" class="form-control" id="Lampiran" value="<?php echo $Lampiran ?>" placeholder="Isikan lampiran" />
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                      <label for="Preview" class="col-sm-2 control-label d-none">Preview</label>
                      <div class="col-sm-12">
                        <div class="accordion" id="timelineAccordion">
                          <div class="card">
                            <a href="#" data-toggle="collapse" data-target="#collapseTimeline" aria-expanded="true" aria-controls="collapseTimeline">
                              <div class="card-header bg-primary" id="headingOne" style="height: 50px;">
                                <i class="fas fa-file-pdf"></i><span class="ml-2">Preview Surat</span>
                              </div>
                            </a>
                            <div id="collapseTimeline" class="collapse" aria-labelledby="headingOne" data-parent="#timelineAccordion">
                              <div class="card-body">
                                <div class="surat-preview px-3 py-4 border rounded">
                                  <!-- KOP SURAT -->
                                  <div class="kop-surat mb-4" style="font-family: Times New Roman, Times, serif;">
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
                                  <!-- Jika jenis surat SELAIN 05 -->
                                  <?php if ($Jenis != '05') : ?>
                                    <table style="margin-top: 1rem; line-height: 1; width: 100%;">
                                      <tr>
                                        <td style="padding: 4px 0; white-space: nowrap;"><strong>Nomor</strong></td>
                                        <td style="padding: 4px 0;">: <span id="nomor_pad">[Nomor Surat]</span></td>
                                        <td style="text-align: right; padding: 4px 0;" colspan="2"><strong>Semarang,</strong> <span id="tanggal_pad">[Tanggal Surat]</span></td>
                                      </tr>
                                      <tr>
                                        <td style="padding: 4px 0;"><strong>Lampiran</strong></td>
                                        <td style="padding: 4px 0;">: <span id="lampiran_pad">[Lampiran]</span></td>
                                      </tr>
                                      <tr>
                                        <td style="padding: 4px 0;"><strong>Perihal</strong></td>
                                        <td style="padding: 4px 0;">: <?php echo $Perihal; ?></td>
                                      </tr>
                                    </table>

                                    <p class="mt-5">
                                      Kepada Yth.<br>
                                      <strong><?php echo $Kepada; ?></strong><br>
                                      di-
                                      <strong><?php echo $AlamatKepada; ?></strong>
                                    </p>

                                    <!-- Jika jenis surat 05 -->
                                  <?php else : ?>
                                    <div class="text-center mt-4">
                                      <span style="font-weight:bold; text-decoration:underline;">S U R A T &nbsp;T U G A S</span><br>
                                      <span>Nomor : <span id="nomor_pad">[Nomor Surat]</span></span><br>

                                    </div>
                                    <div class="text-right">
                                      <span><strong>Semarang,</strong> <span id="tanggal_pad">[Tanggal Surat]</span></span>
                                    </div>
                                  <?php endif; ?>


                                  <!-- ISI SURAT -->
                                  <div class="isi-surat mt-4">
                                    <?php echo $Isi; ?>
                                  </div>
                                  <!-- TANDA TANGAN -->
                                  <div class="ttd mt-5" style="margin-left:60%">
                                    <p>Hormat kami,</p>
                                    <br><br><br> <!-- Jarak untuk tanda tangan -->
                                    <p><strong><?= $AsmanOlehNama ?></strong><br>
                                      <?= $AsmanOlehPosisi ?></p>
                                  </div>



                                  <!-- TEMBUSAN -->
                                  <?php if (!empty($Tembusan)) {
                                    // Pecah berdasarkan koma, lalu hapus spasi berlebih
                                    $listTembusan = array_map('trim', explode(',', $Tembusan));
                                    if (count($listTembusan) > 0) {
                                  ?>
                                      <div class="tembusan mt-4">
                                        <strong>Tembusan:</strong>
                                        <ol>
                                          <?php foreach ($listTembusan as $item) {
                                            if (!empty($item)) {
                                              echo "<li>" . htmlspecialchars($item) . "</li>";
                                            }
                                          } ?>
                                        </ol>
                                      </div>
                                  <?php
                                    }
                                  } ?>

                                </div>
                              </div>

                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" class="btn control-save btn-success">Save</button>
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
  <div id="modalForm" class="modal fade modalForm" role="dialog" aria-labelledby="theModalForm" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- <div class="overlay d-flex justify-content-center align-items-center">
          <i class="fas fa-2x fa-sync fa-spin"></i>
        </div> -->
        <div class="modal-header">
          <h4 class="modal-title">Data Surat Bernomor</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
        </div>
        <div class="modal-footer bg-light">
            <div class="w-100 text-center">
                <button type="button" class="btn btn-primary waves-effect text-left control-auto">Auto</button>
                <button type="button" class="btn btn-warning waves-effect text-left control-sisip" disabled="true">Sisip</button>
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
            </div>
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