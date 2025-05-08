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

        $Pengirim = $oRS->Pengirim;
        $Kepada = $oRS->Kepada;
        $AlamatKepada = $oRS->AlamatKepada;
        $Perihal = $oRS->Perihal;
        $Jenis = $oRS->Jenis;
        $Isi = $oRS->Isi;
        $Tembusan = $oRS->Tembusan;
        $KodeHeader = $oRS->KodeHeader;


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
              <input type="hidden" name="RegNo" class="form-control" value="<?php echo $RegNo ?>" />
              <input type="hidden" name="RegTanggal" class="form-control" value="<?php echo $RegTanggal ?>" />
              <input type="hidden"  name="RoleAlert" class="form-control" value="<?php echo $AppClass->session->get($AppClass->AppModule . "Role") ?>" />
              
              <div class="card-body">
                <div class="alert alert-info alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-info"></i> Keterangan</h5>
                  Isikan data berikut terlebih dahulu, dan Klik <strong>Save </strong>untuk menyimpan.<br>Kemudian jika mengajukan surat pilih button <strong>Ajukan</strong>. Harap diisikan data dengan informasi yang selengkap-lengkapnya.
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