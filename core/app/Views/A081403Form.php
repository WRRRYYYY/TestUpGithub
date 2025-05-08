<?= $this->extend('layout/bsa_main') ?>
<?= $this->section('main') ?>
<?php if (!$SessionEmpty) {
  $KodeLama = "";
  $Kode = "";
  $Periode = $periode;

  $RegNo = "-auto-";
  $RegTanggal = "";
  $NomorSurat = "";
  $TanggalSurat = "";
  $Kepada = "";
  $Perihal = "";
  $Jenis = "";

  $Agenda = "0";
  $AgendaTempat = "";
  $AgendaTanggal = "";
  $AgendaDeskripsi = "";

  $Arsip = "0";
  $ArsipTanggal = "";
  $ArsipLokasi = "";

  $VerifOleh = "";
  $VerifCatatan = "";


  $EditDisabled = "0";

  $FirstRec = "0";
  $LastRec = "0";
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
        $Kepada = $oRS->Kepada;
        $Perihal = $oRS->Perihal;
        $Jenis = $oRS->Jenis;

        $VerifOleh = $oRS->VerifOleh;
        $VerifCatatan = $oRS->VerifCatatan;

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
              <input type="hidden" name="Periode" class="form-control" value="<?php echo $Periode ?>" />
              <div class="card-body">
                <div class="alert alert-info alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-info"></i> Catatan!</h5>
                  Form ini digunakan untuk mengajukan konsep surat kepada atasan untuk diperiksa dan diverifikasi. 
                  Selanjutnya akan diajukan kembali ke atasan untuk ditandatangani.
                  
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label for="Nama" class="col-sm-2 control-label label-data">Kepada</label>
                      <div class="col-sm-10">
                        <span class="control-label label-data"><?php echo $Kepada ?></span>
                      </div>
                    </div>
                  </div>
                  <!-- <div class="col-md-6">
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
                        <span class="control-label label-data"><?php echo $TanggalSurat ?></span>
                      </div>
                    </div>
                  </div> -->

                  <div class="col-md-12">
                    <div class="form-group row">
                      <label for="Perihal" class="col-sm-2 control-label label-data">Perihal</label>
                      <div class="col-sm-10">
                        <span class="control-label label-data"><?php echo $Perihal ?></span>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="VerifOleh" class="col-sm-2 control-label">Diajukan Kepada</label>
                      <div class="col-sm-10">
                        <select class="form-control select2 editable-combo" name="VerifOleh" id="VerifOleh" data-placeholder="Pilih Pejabat" required="required" data-validate="1" style="width: 100%;">
                          <option value=""></option>
                          <?php
                          if (isset($oQueryVerifOleh)) {
                            if (count($oQueryVerifOleh) > 0) {
                              foreach ($oQueryVerifOleh as $oRS) {
                                if($oRS->Kode."," != $KodePosisiUser.",") {
                                  $sSelected = "";
                                  if (".".$VerifOleh."," == ".".$oRS->Kode.",") $sSelected = " selected=\"selected\""; ?>
                                <option value="<?php echo $oRS->Kode ?>" <?php echo $sSelected ?>><?php echo $oRS->AliasStruktur . " (" . $oRS->NamaPegawai . ")" ?></option>
                          <?php }
                              }
                            }
                          } ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row mb-2">
                      <label for="VerifCatatan" class="col-sm-2 control-label">Catatan</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="VerifCatatan" id="VerifCatatan" placeholder="Catatan Pengajuan Verifikasi" style="height: 150px;"><?php echo $VerifCatatan ?></textarea>
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