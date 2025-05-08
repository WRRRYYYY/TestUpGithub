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
  $Kepada = "";
  $Perihal = "";
  $Jenis = "";

  $Agenda = "0";
  $AgendaTempat = "";
  $AgendaTanggal = "";
  $AgendaDeskripsi = "";

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
        $Pengirim = $oRS->Pengirim;
        $Kepada = $oRS->Kepada; 
        $Perihal = $oRS->Perihal;
        $Jenis = $oRS->Jenis;

        $Agenda = $oRS->Agenda;
        $AgendaTempat = $oRS->AgendaTempat;
        $AgendaTanggal = $oRS->AgendaTanggal;
        $AgendaDeskripsi = $oRS->AgendaDeskripsi;

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
            <h1 class="m-0 text-dark">Form Registrasi Surat Masuk<?php //echo $NamaMenu ?></h1>
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
              <input type="hidden" name="RegNo" class="form-control" value="<?php echo $RegNo ?>" />
              <div class="card-body">
              <div class="alert alert-info alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-info"></i> Keterangan</h5>
                  Berikut data yang telah diisikan dan telah tersimpan. <strong>Perhatian!</strong> Data yang telah tersimpan tidak dapat diubah.
                </div>
                <div class="row">
                  
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label for="RegTanggal" class="col-sm-2 control-label">Tanggal Terima</label>
                      <div class="col-sm-2">
                        <div class="input-group date" id="paramdate" data-target-input="nearest">
                          <input id="RegTanggal" name="RegTanggal" type="text" class="form-control datetimepicker-input" data-target="#paramdate" value="<?php echo $RegTanggal ?>" required="required" />
                          <div class="input-group-append" data-target="#paramdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Pengirim" class="col-sm-2 control-label">Pengirim</label>
                      <div class="col-sm-10">
                        <input name="Pengirim" type="text" class="form-control" id="Pengirim" value="<?php echo $Pengirim ?>" required="required" placeholder="Pengirim" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="TanggalSurat" class="col-sm-2 control-label">Tanggal Surat</label>
                      <div class="col-sm-2">
                        <div class="input-group date" id="paramdate2" data-target-input="nearest">
                          <input id="TanggalSurat" name="TanggalSurat" type="text" class="form-control datetimepicker-input" data-target="#paramdate2" value="<?php echo $TanggalSurat ?>" required="required" />
                          <div class="input-group-append" data-target="#paramdate2" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="NomorSurat" class="col-sm-2 control-label">Nomor Surat</label>
                      <div class="col-sm-10">
                        <input name="NomorSurat" type="text" class="form-control" id="NomorSurat" value="<?php echo $NomorSurat ?>" required="required" placeholder="Nomor Surat" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Kepada" class="col-sm-2 control-label">Kepada</label>
                      <div class="col-sm-10">
                        <input name="Kepada" type="text" class="form-control" id="Kepada" value="<?php echo $Kepada ?>" required="required" placeholder="Kepada" />
                      </div>
                    </div>
                    <div class="form-group row mb-2">
                      <label for="Perihal" class="col-sm-2 control-label">Perihal</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="Perihal" id="Perihal" placeholder="Perihal" style="height: 150px;" required="required"><?php echo $Perihal ?></textarea>
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
                        <?php for ($i = 1; $i < $iCnt; $i++) { ?>
                          <div class="fileinputt<?php if ($FileName[$i] == "") {
                                                  echo " fileinput-new";
                                                } else {
                                                  echo " fileinput-exists";
                                                } ?> input-group" style="margin:15px 0 10px" data-provides="fileinput">
                            <div class="form-control" data-trigger="fileinput">
                              <i class="fa fa-file fileinput-exists"></i>
                              <span class="fileinput-filename"><?php if ($FileNameOri[$i] == "") {
                                                                  echo "";
                                                                } else {
                                                                  echo $FileNameOri[$i];
                                                                } ?></span>
                            </div>
                            <span class="input-group-addon btn btn-primary btn-file">
                              <span class="fileinput-new">Select file</span>
                              <span class="fileinput-exists">Change</span>
                              <input type="file" id="DokumentPath_<?php echo $i ?>" name="DokumenPath" class="file-input">
                            </span>
                            <a href="#" class="input-group-addon btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                            <!--<a href="#" class="input-group-addon btn btn-danger control-remove" style="margin-left:1px;">-</a>-->
                            <input type="hidden" name="FileOri" class="form-control" value="<?php echo $FileName[$i] ?>">
                          </div>

                        <?php } ?>
                        <div class="mt-2 mb-2">
                          <div class="icheck-primary d-inline">
                            <input type="checkbox" id="Agenda" name="Agenda" class="form-control" <?php if ($EditDisabled == "1") {  ?> disabled="disabled" <?php } ?> value="1" title="Draf" <?php if ($Agenda == "1") {
                                                                                                                                                                                                echo " checked=\"checked\"";
                                                                                                                                                                                              } ?>>
                            <label for="Agenda"> Agenda Pimpinan </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div id="agendaGroup" style="display: none;">
                      <div class="form-group row">
                        <label for="AgendaTempat" class="col-sm-2 control-label">Agenda Tempat</label>
                        <div class="col-sm-10">
                          <input name="AgendaTempat" type="text" class="form-control" id="AgendaTempat" value="<?php echo $AgendaTempat ?>" placeholder="Agenda Tempat" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="AgendaTanggal" class="col-sm-2 control-label">Tanggal Agenda</label>
                        <div class="col-sm-2">
                          <div class="input-group date" id="paramdate3" data-target-input="nearest">
                            <input id="AgendaTanggal" name="AgendaTanggal" type="text" class="form-control datetimepicker-input" data-target="#paramdate3" value="<?php echo $AgendaTanggal ?>" />
                            <div class="input-group-append" data-target="#paramdate3" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row mb-2">
                        <label for="AgendaDeskripsi" class="col-sm-2 control-label">Agenda</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" name="AgendaDeskripsi" id="AgendaDeskripsi" placeholder="Agenda Deskripsi" style="height: 150px;"><?php echo $AgendaDeskripsi ?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                 <button type="button" class="btn control-save btn-success">Save</button> 
                <button type="button" class="btn control-delete btn-danger">Delete</button>
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