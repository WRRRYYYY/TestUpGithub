<?= $this->extend('layout/bsa_main') ?>
<?= $this->section('main') ?>
<?php if (!$SessionEmpty) {
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

  $Arsip = "0";
  $ArsipTanggal = "";
  $ArsipLokasi = "";

  
  $AjukanOleh = "";
  $AjukanOlehPosisi = "Admin";
  $AjukanKe = "";
  $AjukanCC = "";
  $AjukanTanggal = "";
  $AjukanKembaliTanggal = date("Y-m-d");
  $AjukanCaption = "";
  $AjukanCatatan = "";

  $KodePosisiUser = "";


  $EditDisabled = "0";

  $FirstRec = "0";
  $LastRec = "0";
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
        $Pengirim = $oRS->Pengirim;
        $Perihal = $oRS->Perihal;
        $Jenis = $oRS->Jenis;
        // $EditDisabled = $oRS->EditDisabled;

        $AjukanOleh = $oRS->AjukanOleh;
        if(!is_null($oRS->AjukanOleh))
          $AjukanOlehPosisi = $oRS->AjukanOlehPosisi . " (".  $oRS->AjukanOlehPerson . ")";
        $AjukanKe = $oRS->AjukanKe;
        $AjukanCC = $oRS->AjukanCC;
        if(!is_null($oRS->AjukanTanggal))
          $AjukanTanggal = $oRS->AjukanTanggal;
        $AjukanCaption = $oRS->AjukanCaption;
        $AjukanCatatan = $oRS->AjukanCatatan;

        $KodePosisiUser = $oRS->KodePosisiUser;

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
              <input type="hidden" name="Tahun" class="form-control" value="<?php echo $Tahun ?>" />
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
                  Berikut adalah informasi dari surat yang masuk. <br>
                  Untuk Proses Pengajuan Kembali, pilih pejabat yang seharusnya pada isian Diteruskan Kepada.
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
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label for="NomorSurat" class="col-sm-4 control-label label-data">No. Surat</label>
                      <div class="col-sm-8">
                        <span class="control-label label-data"><?php echo $NomorSurat ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
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
                      <label for="AjukanTanggal" class="col-sm-2 control-label label-data">Tanggal Pengajuan</label>
                      <div class="col-sm-8">
                        <span class="control-label label-data"><?php echo $AppClass->date_format_ina($AjukanTanggal) ?></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="AjukanOleh" class="col-sm-2 control-label label-data">Diajukan oleh</label>
                      <div class="col-sm-8">
                        <span class="control-label label-data"><?php echo $AjukanOlehPosisi ?></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="AjukanCCOri" class="col-sm-2 control-label">Mengetahui</label>
                      <div class="col-sm-10">
                        <select class="form-control select2 editable-combo" name="AjukanCCOri" id="AjukanCCOri" class="select2 form-control" multiple="multiple" data-placeholder="Pejabat yang mengetahui" style="width: 100%;" disabled="disabled">
                          <option value=""></option>
                          <?php
                          if (isset($oQueryPejabat)) {
                            if (count($oQueryPejabat) > 0) {
                              foreach ($oQueryPejabat as $oRS) {
                                $sSelected = "";
                                if(strpos($AjukanCC.",",$oRS->Kode.",",0)!==false) $sSelected = " selected=\"selected\""; ?>
                                <option value="<?php echo $oRS->Kode ?>" <?php echo $sSelected ?>><?php echo $oRS->AliasStruktur . " (" . $oRS->NamaPegawai . ")" ?></option>
                          <?php 
                              }
                            }
                          } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="AjukanCaptionOri" class="col-sm-2 control-label">Permohonan Arahan</label>
                      <div class="col-sm-10">
                        <select class="form-control select2 editable-combo" name="AjukanCaptionOri" id="AjukanCaptionOri" class="select2 form-control" multiple="multiple" data-placeholder="Permohonan Arahan" style="width: 100%;" disabled="disabled">
                          <option value=""></option>
                          <?php
                          if (isset($oQueryAjukanCaption)) {
                            if (count($oQueryAjukanCaption) > 0) {
                              foreach ($oQueryAjukanCaption as $oRS) {
                                $sSelected = "";
                                if(strpos($AjukanCaption.",",$oRS->Kode.",",0)!==false) $sSelected = " selected=\"selected\""; ?>
                                <option value="<?php echo $oRS->Kode ?>" <?php echo $sSelected ?>><?php echo $oRS->Nama ?></option>
                          <?php
                              }
                            }
                          } ?>
                        </select>
                      </div>
                    </div>                    
                    <?php if ($AjukanCatatan!="") { ?>
                    <div class="form-group row">
                      <label for="AjukanCatatanOri" class="col-sm-2 control-label label-data">Catatan</label>
                      <div class="col-sm-8">
                        <span class="control-label label-data"><?php echo $AjukanCatatan ?></span>
                      </div>
                    </div>
                    <?php } ?>
                    <div class="form-group row">
                      <label for="AjukanCaption" class="col-sm-12 p-2 text-center  font-weight-bold control-label">
                        <div class="line-with-text">AJUKAN KEMBALI</div>
                      </label>
                    </div>

                    <div class="form-group row">
                      <label for="AjukanKe" class="col-sm-2 control-label">Diajukan Kepada</label>
                      <div class="col-sm-10">
                        <select class="form-control select2 editable-combo" name="AjukanKe" id="AjukanKe" data-placeholder="Pilih Pejabat" required="required" data-validate="1" style="width: 100%;">
                          <option value=""></option>
                          <?php
                          if (isset($oQueryAjukanKe)) {
                            if (count($oQueryAjukanKe) > 0) {
                              foreach ($oQueryAjukanKe as $oRS) {
                                if($oRS->Kode."," != $KodePosisiUser.",") {
                                  $sSelected = "";
                                  if (".".$AjukanKe."," == ".".$oRS->Kode.",") $sSelected = " selected=\"selected\""; ?>
                                <option value="<?php echo $oRS->Kode ?>" <?php echo $sSelected ?>><?php echo $oRS->AliasStruktur . " (" . $oRS->NamaPegawai . ")" ?></option>
                          <?php }
                              }
                            }
                          } ?>
                        </select>
                      </div>
                    </div>


                    <div class="form-group row">
                      <label for="AjukanCC" class="col-sm-2 control-label">Mengetahui</label>
                      <div class="col-sm-10">
                      <select class="form-control select2 editable-combo" name="AjukanCC" id="AjukanCC" class="select2 form-control" multiple="multiple" data-placeholder="Pilih Pejabat yang mengetahui" style="width: 100%;">
                          <option value=""></option>
                          <?php
                          if (isset($oQueryPejabat)) {
                            if (count($oQueryPejabat) > 0) {
                              foreach ($oQueryPejabat as $oRS) {
                                // if($oRS->Kode."," != $KodePosisiUser.",") {
                                  $sSelected = "";
                                  // if(strpos(".".$AjukanCC.",",".".$oRS->Kode.",",0)!==false) $sSelected = " selected=\"selected\""; ?>
                                <option value="<?php echo $oRS->Kode ?>" <?php echo $sSelected ?>><?php echo $oRS->AliasStruktur . " (" . $oRS->NamaPegawai . ")" ?></option>
                          <?php // }
                              }
                            }
                          } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="AjukanTanggal" class="col-sm-2 control-label">Tanggal Pengajuan</label>
                      <div class="col-sm-2">
                        <div class="input-group date" id="paramdate2" data-target-input="nearest">
                          <input id="AjukanTanggal" name="AjukanTanggal" type="text" class="form-control datetimepicker-input text-center" data-target="#paramdate2" value="<?php echo $AjukanKembaliTanggal ?>" />
                          <div class="input-group-append" data-target="#paramdate2" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="AjukanCaption" class="col-sm-2 control-label">Arahan Disposisi</label>
                      <div class="col-sm-10">
                        <select class="form-control select2 editable-combo" name="AjukanCaption" id="AjukanCaption" class="select2 form-control" multiple="multiple" data-placeholder="Pilih Arahan Disposisi" style="width: 100%;">
                          <option value=""></option>
                          <?php
                          if (isset($oQueryAjukanCaption)) {
                            if (count($oQueryAjukanCaption) > 0) {
                              foreach ($oQueryAjukanCaption as $oRS) {
                                $sSelected = "";
                                // if ($AjukanCaption == $oRS->Kode) $sSelected = " selected=\"selected\""; ?>
                                <option value="<?php echo $oRS->Kode ?>" <?php echo $sSelected ?>><?php echo $oRS->Nama ?></option>
                          <?php
                              }
                            }
                          } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row mb-2">
                      <label for="AjukanCatatan" class="col-sm-2 control-label">Catatan</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="AjukanCatatan" id="AjukanCatatan" placeholder="Catatan Pengajuan" style="height: 150px;"><?php echo $AjukanCatatan ?></textarea>
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