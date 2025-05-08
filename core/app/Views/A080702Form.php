<?= $this->extend('layout/bsa_main') ?>
<?= $this->section('main') ?>
<?php if (!$SessionEmpty) {
  $KodeLama = "";
  $Kode = "";
  $Seq = "";
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

  $Arsip = "0";
  $ArsipTanggal = "";
  $ArsipLokasi = "";

  
  $AjukanOleh = "";
  $AjukanOlehPosisi = "Admin";
  $AjukanKe = "";
  $AjukanCC = "";
  $AjukanTanggal = "";
  $AjukanCaption = "";
  $AjukanCatatan = "";

  $KodePosisiUser = "";
  $DispoKe = "";
  $DispoTanggal = date("Y-m-d");
  $DispoCaption = "";
  $DispoCatatan = "";

  $Laksana = "";
  $LaksanaUraian = "";

  $FileName = array("");
  $FileNameOri = array("");
  $DokumenPath = array("");
  $DokumenIdx = array(0);
  $iCnt = 0;

  $EditDisabled = "0";

  $FirstRec = "0";
  $LastRec = "0";
  if (isset($oQuery)) {
    if (count($oQuery) > 0) {
      foreach ($oQuery as $oRS) {

        $KodeLama = $oRS->idx;
        $Kode = $oRS->idx;
        $Seq = $oRS->Seq;
        $Periode = $oRS->Periode;

        $RegNo = $oRS->RegNo;
        $RegTanggal = $oRS->RegTanggal;
        $NomorSurat = $oRS->NomorSurat;
        $TanggalSurat = $oRS->TanggalSurat;
        $Pengirim = $oRS->Pengirim;
        $Perihal = $oRS->Perihal;
        $Jenis = $oRS->Jenis;
        // $EditDisabled = $oRS->EditDisabled;

        $KodePosisiUser = $oRS->KodePosisiUser;

        $DispoOleh = $oRS->DispoOleh;
        if(!is_null($oRS->DispoOleh))
          $DispoOlehPosisi = $oRS->DispoOlehPosisi . " (".  $oRS->DispoOlehPerson . ")";
        $DispoKe = $oRS->DispoKe;
        if(!is_null($oRS->DispoTanggal))
          $DispoTanggal = $oRS->DispoTanggal;
        $DispoCaption = $oRS->DispoCaption;
        $DispoCatatan = $oRS->DispoCatatan;

        $Laksana = $oRS->Laksana;
        $LaksanaUraian = $oRS->LaksanaUraian;
              

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
        if (!is_null($oRS->LaksanaDokumenPath)) $DokumenPath[$iCnt] = $oRS->LaksanaDokumenPath;
        if ($DokumenPath[$iCnt] != "") {
          $FileName[$iCnt] = substr($DokumenPath[$iCnt], strrpos($DokumenPath[$iCnt], "/", -1) - strlen($DokumenPath[$iCnt]) + 1);
          $FileNameOri[$iCnt] = $oRS->LaksanaFileNameOri;
        }
        $iCnt++;

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
              <input type="hidden" name="KodeLama" class="form-control" value="<?php echo $KodeLama ?>" />
              <input type="hidden" name="Seq" class="form-control" value="<?php echo $Seq ?>" />
              <input type="hidden" name="Periode" class="form-control" value="<?php echo $Periode ?>" />
              <?php
              $i = 0;
              if (isset($oQueryDtlListGb)) {
                if (count($oQueryDtlListGb) > 0) {
                  foreach ($oQueryDtlListGb as $oRS) {
              ?>
                    <input type="hidden" name="img_path" id="<?php echo $oRS->Seq ?>" class="preloaded" value="<?php echo base_url() . $oRS->GambarPath . "?" . rand() ?>" />
              <?php
                  }
                }
              } ?>
              <div class="card-body">
                <div class="alert alert-info alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-info"></i> Catatan!</h5>
                  Berikut adalah informasi disposisi. <br>
                  Untuk Proses Pelaksaan, isikan Uraian Pelaksanaan dan Statusnya.
                </div>
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                      <label for="Nama" class="col-sm-2 control-label label-data">Pengirim</label>
                      <div class="col-sm-10">
                        <span class="control-label label-data"><?php echo $Pengirim ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group row">
                      <label for="NomorSurat" class="col-sm-3 control-label label-data">No. Surat</label>
                      <div class="col-sm-8">
                        <span class="control-label label-data"><?php echo $NomorSurat ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label for="TanggalPermohonan" class="col-sm-4 control-label label-data">Tanggal Surat</label>
                      <div class="col-sm-8">
                        <span class="control-label label-data"><?php echo $AppClass->date_format_ina($TanggalSurat) ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label for="Perihal" class="col-sm-2 control-label label-data">Perihal</label>
                      <div class="col-sm-10">
                        <span class="control-label label-data"><?php echo $Perihal ?></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="AjukanCaption" class="col-sm-12 p-2 text-center  font-weight-bold control-label">
                      <div class="line-with-text">DISPOSISI</div>
                      </label>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group row">
                      <label for="DispoOleh" class="col-sm-3 control-label label-data">Dari</label>
                      <div class="col-sm-8">
                        <span class="control-label label-data"><?php echo $DispoOlehPosisi ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label for="DispoTanggal" class="col-sm-4 control-label label-data">Tanggal</label>
                      <div class="col-sm-8">
                        <span class="control-label label-data"><?php echo $AppClass->date_format_ina($DispoTanggal) ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label for="DispoKe" class="col-sm-2 control-label">Kepada</label>
                      <div class="col-sm-10">
                      <select class="form-control select2 editable-combo" name="DispoKe" id="DispoKe" class="select2 form-control" multiple="multiple" data-placeholder="Pilih Tujuan Disposisi " style="width: 100%;" disabled="disabled">
                          <option value=""></option>
                          <?php
                          if (isset($oQueryDispoKe)) {
                            if (count($oQueryDispoKe) > 0) {
                              foreach ($oQueryDispoKe as $oRS) {
                                //if($oRS->Kode."," != $KodePosisiUser.",") {
                                  $sSelected = "";
                                  if(strpos($DispoKe.",",$oRS->Kode.",",0)!==false) $sSelected = " selected=\"selected\""; ?>
                                <option value="<?php echo $oRS->Kode ?>" <?php echo $sSelected ?>><?php echo $oRS->AliasStruktur . " (" . $oRS->NamaPegawai . ")" ?></option>
                          <?php //}
                              }
                            }
                          } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="DispoCaption" class="col-sm-2 control-label">Instruksi</label>
                      <div class="col-sm-10">
                        <select class="form-control select2 editable-combo" name="DispoCaption" id="DispoCaption" class="select2 form-control" multiple="multiple" data-placeholder="Permohonan Arahan" style="width: 100%;" disabled="disabled">
                          <option value=""></option>
                          <?php
                          if (isset($oQueryDispoCaption)) {
                            if (count($oQueryDispoCaption) > 0) {
                              foreach ($oQueryDispoCaption as $oRS) {
                                $sSelected = "";
                                if(strpos($DispoCaption.",",$oRS->Kode.",",0)!==false) $sSelected = " selected=\"selected\""; ?>
                                <option value="<?php echo $oRS->Kode ?>" <?php echo $sSelected ?>><?php echo $oRS->Nama ?></option>
                          <?php
                              }
                            }
                          } ?>
                        </select>
                      </div>
                    </div>                    
                    <?php if ($DispoCatatan!="") { ?>
                    <div class="form-group row">
                      <label for="DispoCatatan" class="col-sm-2 control-label label-data">Catatan</label>
                      <div class="col-sm-8">
                        <span class="control-label label-data"><?php echo $DispoCatatan ?></span>
                      </div>
                    </div>
                    <?php } ?>
                    <div class="form-group row">
                      <label for="AjukanCaption" class="col-sm-12 p-2 text-center  font-weight-bold control-label">
                      <div class="line-with-text">PELAKSANA</div>
                      </label>
                    </div>
                    <div class="form-group row mb-2">
                      <label for="LaksanaUraian" class="col-sm-2 control-label">Uraian Laporan</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="LaksanaUraian" id="LaksanaUraian" placeholder="Uraian Pelaksanaan" style="height: 150px;"><?php echo $LaksanaUraian ?></textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="optStatus_1" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10" style="padding-top:8px">
                            <div class="icheck-primary d-inline">
                            <input type="radio" id="optStatus_1" name="Laksana" class="form-option" value="1" required="required" title="Status Pelaksanaan"<?php if($Laksana=="1") { echo " checked=\"checked\""; } ?>>
                            <label for="optStatus_1"> Dilaksanakan</label>
                            </div>&nbsp;&nbsp;&nbsp;
                            <div class="icheck-danger d-inline">
                            <input type="radio" id="optStatus_0" name="Laksana" class="form-option" value="0" required="required" title="Status Pelaksanaan"<?php if($Laksana=="0") { echo " checked=\"checked\""; } ?>>
                            <label for="optStatus_0"> Tidak Dilaksanakan</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="Dokumen" class="col-sm-2 control-label">Lampiran (Max 5 MB) <a href="#" class="input-group-addon btn btn-sm btn-success control-add d-none" style="margin-left:1px;">+ Add</a></label>
                        <div class="col-sm-10 doc-pad">
                            <div class="fileinputt<?php if ($FileName[0] == "") {
                                    echo " fileinput-new";
                                    } else {
                                    echo " fileinput-exists";
                                    } ?> input-group" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput">
                                <i class="fa fa-file fileinput-exists"></i>
                                <span class="fileinput-filename"><?php if ($FileNameOri[0] == "") {
                                    echo "";
                                    } else {
                                    echo $FileNameOri[0];
                                    } ?></span>
                                </div>
                                <span class="input-group-addon btn btn-primary btn-file">
                                <span class="fileinput-new">Select file</span>
                                <span class="fileinput-exists">Change</span>
                                <input type="file" name="DokumenPath" class="file-input">
                                </span>
                                <a href="#" class="input-group-addon btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                <!--<a href="#" class="input-group-addon btn btn-success control-add" style="margin-left:1px;">+</a>-->
                                <input type="hidden" name="FileOri" class="form-control" value="<?php echo $FileName[0] ?>">
                            </div>
                        </div>
                    </div>                    
                  </div>
                </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" class="btn control-save btn-success">Submit</button>
                <!-- <button type="button" class="btn control-delete btn-danger">Delete</button> -->
                <button type="button" class="btn control-close btn-warning">Cancel</button>
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