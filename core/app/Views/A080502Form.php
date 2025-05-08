<?= $this->extend('layout/bsa_main') ?>
<?= $this->section('main') ?>
<?php if (!$SessionEmpty) {
  $KodeLama = "";
  $Kode = "";

  $Tahun = date("Y");
  $Klasifikasi = "";
  $NamaKlasifikasi = "";
  $TglSurat = "";
  $Kode = "";
  $TglTerima = "";
  $NomorArsip = "-auto-";
  $NomorSurat = "";
  $Pengirim = "";
  $KetPengirim = "";
  $Tempat = "";
  $JenisSurat = "";
  $SifatSurat = "";
  $Pengolah = "";
  $Perihal = "";
  $TanggalAgenda = "";
  $Agenda = "";
  $Lampiran = "";
  $Satuan = "";
  $chkSatuan_1 = ""; //  disabled=\"disabled\"";
  $chkSatuan_2 = ""; //  disabled=\"disabled\"";
  $TanggalDisposisi = "";
  $Intruksi = "";

  $Isi = "";
  $TglAgenda = "";
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

        $NomorSurat = $oRS->NomorSurat;
        $NomorArsip = $oRS->NomorArsip;
        $TglTerima = $oRS->TglTerima;
        $Klasifikasi = $oRS->Klasifikasi;
        $TglSurat = $oRS->TglSurat;
        $Pengirim = $oRS->Pengirim;
        $KetPengirim = $oRS->KetPengirim;
        $Tempat = $oRS->Tempat;
        $Perihal = $oRS->Perihal;
        $Lampiran = $oRS->Lampiran;
        $Satuan = $oRS->Satuan;
        if ($oRS->Satuan == "1")
          $chkSatuan_1 = " checked=\"checked\"";
        else
          $chkSatuan_2 = " checked=\"checked\"";

        $JenisSurat = $oRS->Jenis;
        $SifatSurat = $oRS->Sifat;
        $Pengolah = $oRS->Pengolah;
        $Isi = $oRS->Isi;
        $TglAgenda = $oRS->TglAgenda;
        $Status = $oRS->Status;
        $Catatan = $oRS->Catatan;
        $Agenda = $oRS->Agenda;
        // $EditDisabled = $oRS->EditDisabled;

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
        $DokumenIdx[$iCnt] = $oRS->DocIdx;
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
                   Disposisi telah dibatalkan. Jika diperlukan, silakan periksa kembali informasi surat ini dan tentukan ulang Bagian/Bidang yang akan dituju.
                  <br>Pastikan instruksi disposisi sesuai sebelum mengirim ulang untuk menghindari kesalahan dalam proses tindak lanjut.
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label for="Nama" class="col-sm-2 control-label label-data">Pengirim</label>
                      <div class="col-sm-10">
                        <span class="control-label label-data">Dinas Sosial Kota Semarang</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label for="NomorSurat" class="col-sm-4 control-label label-data">No. Surat</label>
                      <div class="col-sm-8">
                        <span class="control-label label-data">140/312/XII/2024</span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="TanggalPermohonan" class="col-sm-4 control-label label-data">Tanggal Surat</label>
                      <div class="col-sm-8">
                        <span class="control-label label-data">2025-01-24</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label for="TanggalPermohonan" class="col-sm-4 control-label label-data">Tanggal Agenda</label>
                      <div class="col-sm-8">
                        <span class="control-label label-data">2025-01-24</span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="TanggalTerima" class="col-sm-4 control-label label-data">Diterima</label>
                      <div class="col-sm-8">
                        <span class="control-label label-data">2025-03-03</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label for="Perihal" class="col-sm-2 control-label label-data">Perihal</label>
                      <div class="col-sm-10">
                        <span class="control-label label-data">Undangan bantuan sosial korban banjir Semarang</span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="optAktif_1" class="col-sm-2 col-form-label">Sifat</label>
                      <div class="col-sm-10" style="padding-top:8px">
                        <div class="icheck-primary d-inline">
                          <input type="radio" id="optSifat_1" name="Sifat" class="form-control" value="1" title="Sifat" required="required">
                          <label for="optSifat_1" style="font-weight:normal; font-size:15px;"> Sangat Segera</label>
                        </div>&nbsp;&nbsp;&nbsp;
                        <div class="icheck-primary d-inline">
                          <input type="radio" id="optSifat_2" name="Sifat" class="form-control" value="2" title="Sifat" required="required">
                          <label for="optSifat_2" style="font-weight:normal; font-size:15px;"> Segera</label>
                        </div>&nbsp;&nbsp;&nbsp;
                        <div class="icheck-primary d-inline">
                          <input type="radio" id="optSifat_3" name="Sifat" class="form-control" value="3" title="Sifat" required="required">
                          <label for="optSifat_3" style="font-weight:normal; font-size:15px;"> Rahasia</label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Disposisi" class="col-sm-2 control-label">Disposisi Ke</label>
                      <div class="col-sm-10">
                        <select name="Disposisi" id="Disposisi" class="select2 form-control" multiple="multiple" data-placeholder="Bagian/Bidang" style="width: 100%;">
                          <option value="0">Ketua</option>
                          <option value="1">Wakil Ketua 1,2,3,4</option>
                          <option value="2">Sekretaris</option>
                          <option value="3">Kasubag</option>
                          <option value="4">Staff</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="TanggalDisposisi" class="col-sm-2 control-label">Tanggal Disposisi</label>
                      <div class="col-sm-2">
                        <div class="input-group date" id="paramdate2" data-target-input="nearest">
                          <input id="TanggalDisposisi" name="TanggalDisposisi" type="text" class="form-control datetimepicker-input" data-target="#paramdate2" value="<?php echo $TanggalDisposisi ?>" />
                          <div class="input-group-append" data-target="#paramdate2" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="CatatanDisposisi" class="col-sm-2 control-label">Intruksi Disposisi</label>
                      <div class="col-sm-10">
                        <select name="CatatanDisposisi" id="CatatanDisposisi" class="select2 form-control" multiple="multiple" data-placeholder="Intruksi Disposisi" style="width: 100%;">
                          <option value="1">Laksanakan</option>
                          <option value="2">Koordinasikan</option>
                          <option value="3">Bahan Rapat</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Catatan" class="col-sm-2 control-label">Catatan Disposisi</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="Catatan" id="Catatan" placeholder="Catatan" style="height: 100px;"></textarea>

                      </div>
                    </div>
                    <div class="form-group row d-none">
                      <label for="Catatan" class="col-sm-2 control-label">Catatan Disposisi</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="Catatan" id="Catatan" placeholder="Catatan" style="height: 100px;"></textarea>
                        <!-- Tombol Quick Select -->
                        <button type="button" class="btn btn-sm btn-primary mt-2 quick-select" data-value="Laksanakan">Laksanakan</button>
                        <button type="button" class="btn btn-sm btn-primary mt-2 quick-select" data-value="Koordinasikan">Koordinasikan</button>
                        <button type="button" class="btn btn-sm btn-primary mt-2 quick-select" data-value="Bahan">Bahan Rapat</button>
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