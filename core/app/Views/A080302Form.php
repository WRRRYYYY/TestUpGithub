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

        $Agenda = $oRS->Agenda;
        $AgendaTempat = $oRS->AgendaTempat;
        $AgendaTanggal = $oRS->AgendaTanggal;
        $AgendaDeskripsi = $oRS->AgendaDeskripsi;

        $Arsip = $oRS->Arsip; 
        $ArsipTanggal = $oRS->ArsipTanggal;
        $ArsipLokasi = $oRS->ArsipLokasi;

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
              <div class="card-body">
                <div class="alert alert-info alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-info"></i> Catatan!</h5>
                  Berikut adalah informasi dari surat yang masuk. <br>
                  Untuk Proses Arsip Surat, Jika surat sudah di arsipkan maka surat tidak dapat <b>Diajukan</b> maupun <b>Disposisi.</b>
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
                    <div class="form-group row">
                      <label for="TanggalPermohonan" class="col-sm-4 control-label label-data">Tanggal Surat</label>
                      <div class="col-sm-8">
                        <span class="control-label label-data"><?php echo $TanggalSurat ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label for="TanggalPermohonan" class="col-sm-4 control-label label-data">Tanggal Agenda</label>
                      <div class="col-sm-8">
                        <span class="control-label label-data"><?php echo $AgendaTanggal ?></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="TanggalTerima" class="col-sm-4 control-label label-data">Diterima</label>
                      <div class="col-sm-8">
                        <span class="control-label label-data"><?php echo $RegTanggal ?></span>
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
                          <label for="ArsipTanggal" class="col-sm-2 control-label">Tanggal Arsip</label>
                          <div class="col-sm-2">
                            <div class="input-group date" id="paramdate" data-target-input="nearest">
                              <input id="ArsipTanggal" name="ArsipTanggal" type="text" class="form-control datetimepicker-input" data-target="#paramdate" value="<?php echo $ArsipTanggal ?>" />
                              <div class="input-group-append" data-target="#paramdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="ArsipLokasi" class="col-sm-2 control-label">Arsip Lokasi Surat</label>
                          <div class="col-sm-2">
                            <select class="form-control select2 editable-combo" name="ArsipLokasi" id="ArsipLokasi" data-validate="1" style="width: 100%;">
                              <option value="">Pilih ArsipLokasi Surat</option>
                              <?php
                              if (isset($oQueryArsipLokasi)) {
                                if (count($oQueryArsipLokasi) > 0) {
                                  foreach ($oQueryArsipLokasi as $oRS) {
                                    $sSelected = "";
                                    if ($ArsipLokasi == $oRS->Kode) $sSelected = " selected=\"selected\""; ?>
                                    <option value="<?php echo $oRS->Kode ?>" <?php echo $sSelected ?>><?php echo $oRS->Nama ?></option>
                              <?php
                                  }
                                }
                              } ?>
                            </select>
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