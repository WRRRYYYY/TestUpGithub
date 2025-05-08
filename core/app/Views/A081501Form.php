<?= $this->extend('layout/bsa_main') ?>
<?= $this->section('main') ?>
<?php if (!$SessionEmpty) {
  $KodeLama = "";
  $Kode = "";
  $Tahun = date("Y");

  $RegNo = "-auto-";
  $RegTanggal = date("Y-m-d");



  $Kepada = "";
  $AlamatKepada = "";
  $Perihal = "";
  $Jenis = "";
  $Isi = "";
  $Tembusan = "";
  $KodeHeader = "";

  $Asman = "0";


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


        $Kepada = $oRS->Kepada;
        $AlamatKepada = $oRS->AlamatKepada;
        $Perihal = $oRS->Perihal;
        $Jenis = $oRS->Jenis;
        $Isi = $oRS->Isi;
        $Tembusan = $oRS->Tembusan;
        $KodeHeader = $oRS->KodeHeader;

        $Asman = $oRS->Asman;

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
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">Form Penandatanganan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 d-none">
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
              <input type="hidden" name="Tahun" class="form-control" value="<?php echo $Tahun ?>" />
              <input type="hidden" name="RegNo" class="form-control" value="<?php echo $RegNo ?>" />
              <input type="hidden" name="RegTanggal" class="form-control" value="<?php echo $RegTanggal ?>" />
              <div class="card-body">
                <div class="alert alert-info alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-info"></i> Keterangan</h5>
                  Berikut adalah data surat yang perlu Anda tandatangani. Silahkan diperiksa dan diubah jika ada yang perlu untuk disesuaikan.<br>
                  Terakhir, silahkan dibubuhkan tanda tangan.
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label for="Kepada" class="col-sm-2 control-label">Kepada</label>
                      <div class="col-sm-10">
                        <input name="Kepada" type="text" class="form-control" id="Kepada" value="<?php echo $Kepada ?>" required="required" placeholder="Kepada" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="AlamatKepada" class="col-sm-2 control-label">Kepada Alamat</label>
                      <div class="col-sm-10">
                        <input name="AlamatKepada" type="text" class="form-control" id="AlamatKepada" value="<?php echo $AlamatKepada ?>" required="required" placeholder="Alamat Kepada" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Perihal" class="col-sm-2 control-label">Perihal</label>
                      <div class="col-sm-10">
                        <input name="Perihal" type="text" class="form-control" id="Perihal" value="<?php echo $Perihal ?>" required="required" placeholder="Perihal" />
                      </div>
                    </div>

                    
                    <div class="form-group row">
                      <label for="KodeHeader" class="col-sm-2 control-label">Kop Surat</label>
                      <div class="col-sm-10">
                        <select class="form-control select2 editable-combo" name="KodeHeader" id="KodeHeader" required="required" data-validate="1" >
                          <option value="">Pilih Kop Surat</option>
                          <?php
                          if (isset($oQueryKop)) {
                            if (count($oQueryKop) > 0) {
                              foreach ($oQueryKop as $oRS) {
                                $sSelected = "";
                                if ($KodeHeader == $oRS->Kode) $sSelected = " selected=\"selected\""; ?>
                                <option value="<?php echo $oRS->Kode ?>" data-isi="<?php echo htmlspecialchars($oRS->Isi) ?>" <?php echo $sSelected ?>>
                                  <?php echo $oRS->Nama ?>
                                </option>

                          <?php
                              }
                            }
                          } ?>
                        </select>
                        <div id="isiKopContainer" class="mt-2 mb-2 d-none">
                          <div id="isiKopContent" class="border pt-3"></div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Jenis" class="col-sm-2 control-label">Jenis Surat</label>
                      <div class="col-sm-2">
                        <select class="form-control select2 editable-combo" name="Jenis" id="Jenis" required="required" data-validate="1">
                          <option value="">Pilih Jenis Surat</option>
                          <?php
                          if (isset($oQueryJenis)) {
                            if (count($oQueryJenis) > 0) {
                              foreach ($oQueryJenis as $oRS) {
                                $sSelected = "";
                                if ($Jenis == $oRS->Kode) $sSelected = " selected=\"selected\""; ?>
                                <option value="<?php echo $oRS->Kode ?>" <?php echo $sSelected ?>><?php echo $oRS->Nama ?></option>
                          <?php
                              }
                            }
                          } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Isi" class="col-sm-2 control-label">Isi Surat</label>
                      <div class="col-sm-10">
                        <div data-name="Isi" class="form-control inline-editor"><?php echo $Isi ?></div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Tembusan" class="col-sm-2 control-label">Tembusan</sup></label>
                      <div class="col-sm-10 mb-2">
                      <input type="text" name="Tembusan" id="Tembusan" class="form-control2" placeholder="Ketik/Isikan Tembusan lalu enter" required  value="<?php echo $Tembusan ?>" />
                      </div>
                    </div>
                    <?php if($FileNameOri[0]!="") { ?>
                      <div class="form-group row">
                      <label for="Lokasi" class="col-sm-2 control-label">Lampiran</label>
                      <div class="col-sm-10">
                        <div class="accordion" id="timelineAccordion">
                          <div class="card">
                            <a href="#" data-toggle="collapse" data-target="#collapseTimeline" aria-expanded="true" aria-controls="collapseTimeline">
                              <div class="card-header bg-primary" id="headingOne" style="height: 50px;">
                                <i class="fas fa-file-pdf"></i><span class="ml-2">Lihat Lampiran Surat</span>
                              </div>
                            </a>
                            <div id="collapseTimeline" class="collapse" aria-labelledby="headingOne" data-parent="#timelineAccordion">
                              <div class="card-body">
                                <?php if (!empty($DokumenPath[0])) : ?>
                                  <iframe src="<?php echo $DokumenPath[0] ?>" title="Preview" style="width:100%; height:1000px;"></iframe>
                                <?php else : ?>
                                  <div class="alert alert-warning alert-dismissible">
                                    <P class="p-0"><i class="icon fas fa-exclamation-triangle"></i> Dokumen Lampiran Kosong, Tidak ada dokumen lampiran untuk ditampilkan.!</P>
                                  </div>
                                <?php endif; ?>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>               
                    <?php } ?>                    
                    <div class="row bg-olive">
                      <label for="Asman" class="col-sm-2 control-label">Status </label>
                      <div class="col-10">
                        <div class="mt-2">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="Asman" name="Asman" class="form-control"<?php if($EditDisabled=="1") {  ?> disabled="disabled"<?php } ?> value="1" title="Draf" <?php if($Asman=="1") { echo " checked=\"checked\""; } ?>>
                                <?php if($EditDisabled=="1") {  ?>
                                <label for="Asman" class="text-danger"> Sudah ditandatangani</label>
                                <?php } else {  ?>
                                <label for="Asman"> Bubuhkan tanda tangan <small class="text-danger">(dicek/centang jika ingin langsung ditandatangani)</small></label>
                                <?php }  ?>
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
                <!-- <button type="button" class="btn control-delete btn-danger">Delete</button> -->
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