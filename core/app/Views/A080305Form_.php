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
            <h1 class="m-0 text-dark">Histori Surat Masuk<?php //echo $NamaMenu 
                                                          ?></h1>
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
                  Halaman ini menampilkan histori surat masuk yang telah diterima dan diproses oleh TU. <br>Histori surat masuk ini mencakup proses dari penerimaan surat, disposisi, hingga pengarsipan surat.
                </div>
                <!-- Timelime example  -->
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
                  </div>



                  
                  <div class="form-group row">
                      <div class="col-12">
                        <table id="datatable" class="table table-striped">
                          <thead>
                            <tr>
                              
                              <th>Step</th>
                              <th>Nama Step</th>
                              <th>Aksi Step</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            if (isset($oQueryList)) {
                              //						$TotalDtl = count($oQueryList);
                              if (count($oQueryList) > 0) {
                                foreach ($oQueryList as $oRS) {
                                  $hash = hash('sha512', rand());
                                  $pos = substr(rand(), 0, 1);
                                  $mnu = $pos . substr($hash, 0, 128 - intval($pos)) . $AppClass->KodeMenu . substr($hash, -1 * intval($pos));
                                  $url_add = "/frm/cod" . $oRS->idx . "/";
                            ?>
                                  <tr>

                                    <td><?php echo $oRS->Step ?></td>
                                    <td><?php echo $oRS->NamaStep ?></td>
                                    <td><?php echo $oRS->AksiStep ?></td>
                                   
                                  </tr><?php
                                      }
                                    }
                                  } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>



                  <!-- dari atas ke bawah -->
                  <div class="col-md-12 mt-4 d-none">
                    <div class="timeline">
                      <!-- Timeline label: Surat Masuk -->
                      <div class="time-label">
                        <span class="bg-blue">10 Maret 2025</span>
                      </div>
                      <div>
                        <i class="fas fa-envelope bg-blue"></i>
                        <div class="timeline-item">
                          <span class="time"><i class="fas fa-clock"></i> 08:30</span>
                          <h3 class="timeline-header"><a href="#">Surat Masuk</a></h3>
                          <div class="timeline-body">
                            <span><strong>Diterima Oleh : </strong> Admin TU</span>
                          </div>
                        </div>
                      </div>

                      <!-- Timeline label: Pengajuan -->
                      <div class="time-label">
                        <span class="bg-yellow">11 Maret 2025</span>
                      </div>
                      <div>
                        <i class="fas fa-paper-plane bg-yellow"></i>
                        <div class="timeline-item">
                          <span class="time"><i class="fas fa-clock"></i> 10:00</span>
                          <h3 class="timeline-header"><a href="#">Ajukan Disposisi</a></h3>
                          <div class="timeline-body">
                            <span><strong>Diajukan Ke :</strong> Ketua</span><br>
                            <span><strong>Catatan :</strong> Surat diajukan untuk disposisi ke Kepala Bagian Umum.</span>
                          </div>
                        </div>
                      </div>

                      <!-- Timeline label: Disposisi -->
                      <div class="time-label">
                        <span class="bg-green">12 Maret 2025</span>
                      </div>
                      <div>
                        <i class="fas fa-share bg-green"></i>
                        <div class="timeline-item">
                          <span class="time"><i class="fas fa-clock"></i> 13:45</span>
                          <h3 class="timeline-header"><a href="#">Disposisi</a></h3>
                          <div class="timeline-body">
                            <span><strong>Disposisi Ke :</strong> Sekretaris</span><br>
                            <span><strong>Catatan :</strong> Surat telah didisposisikan ke bidang terkait untuk ditindaklanjuti.</span>
                          </div>
                        </div>
                      </div>

                      <!-- Timeline label: Arsip -->
                      <div class="time-label">
                        <span class="bg-gray">15 Maret 2025</span>
                      </div>
                      <div>
                        <i class="fas fa-archive bg-gray"></i>
                        <div class="timeline-item">
                          <span class="time"><i class="fas fa-clock"></i> 16:20</span>
                          <h3 class="timeline-header"><a href="#">Arsip</a></h3>
                          <div class="timeline-body">
                            <span><strong>Diarsipkan Oleh : </strong> Admin TU</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 mt-4">
                    <div class="accordion" id="timelineAccordion">
                      <div class="card">
                        <div class="card-header" id="headingOne">
                          <h2 class="mb-0">
                            <button class="btn btn-link text-dark font-weight-bold d-flex align-items-center" type="button" data-toggle="collapse" data-target="#collapseTimeline" aria-expanded="true" aria-controls="collapseTimeline">
                              <i class="fas fa-stream"></i> <span class="ml-2">Timeline Surat</span>

                            </button>
                          </h2>
                        </div>
                        <div id="collapseTimeline" class="collapse" aria-labelledby="headingOne" data-parent="#timelineAccordion">
                          <div class="card-body">
                            <div class="timeline">
                              <!-- Timeline label: Arsip -->
                              <div class="time-label">
                                <span class="bg-gray">15 Maret 2025</span>
                              </div>
                              <div>
                                <i class="fas fa-archive bg-gray"></i>
                                <div class="timeline-item">
                                  <span class="time"><i class="fas fa-clock"></i> 16:20</span>
                                  <h3 class="timeline-header"><a href="#">Arsip</a></h3>
                                  <div class="timeline-body">
                                    <span><strong>Diarsipkan Oleh : </strong> Admin TU</span>
                                  </div>
                                </div>
                              </div>

                              <!-- Timeline label: Disposisi -->
                              <div class="time-label">
                                <span class="bg-green">12 Maret 2025</span>
                              </div>
                              <div>
                                <i class="fas fa-share bg-green"></i>
                                <div class="timeline-item">
                                  <span class="time"><i class="fas fa-clock"></i> 13:45</span>
                                  <h3 class="timeline-header"><a href="#">Disposisi</a></h3>
                                  <div class="timeline-body">
                                    <span><strong>Disposisi Ke :</strong> Sekretaris</span><br>
                                    <span><strong>Catatan :</strong> Surat telah didisposisikan ke bidang terkait untuk ditindaklanjuti.</span>
                                  </div>
                                </div>
                              </div>

                              <!-- Timeline label: Pengajuan -->
                              <div class="time-label">
                                <span class="bg-yellow">11 Maret 2025</span>
                              </div>
                              <div>
                                <i class="fas fa-paper-plane bg-yellow"></i>
                                <div class="timeline-item">
                                  <span class="time"><i class="fas fa-clock"></i> 10:00</span>
                                  <h3 class="timeline-header"><a href="#">Ajukan Disposisi</a></h3>
                                  <div class="timeline-body">
                                    <span><strong>Diajukan Ke :</strong> Ketua</span><br>
                                    <span><strong>Catatan :</strong> Surat diajukan untuk disposisi ke Kepala Bagian Umum.</span>
                                  </div>
                                </div>
                              </div>

                              <!-- Timeline label: Surat Masuk -->
                              <div class="time-label">
                                <span class="bg-blue">10 Maret 2025</span>
                              </div>
                              <div>
                                <i class="fas fa-envelope bg-blue"></i>
                                <div class="timeline-item">
                                  <span class="time"><i class="fas fa-clock"></i> 08:30</span>
                                  <h3 class="timeline-header"><a href="#">Surat Masuk</a></h3>
                                  <div class="timeline-body">
                                    <span><strong>Diterima Oleh : </strong> Admin TU</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- dari bawah ke atas -->
                  <div class="col-md-12 mt-4 d-none">
                    <div class="accordion" id="timelineAccordion">
                      <div class="card">
                        <div class="card-header bg-green" id="headingOne">
                          <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTimeline" aria-expanded="true" aria-controls="collapseTimeline">
                              <span class="timeline-header">Histori Surat Masuk</span>
                            </button>
                          </h2>
                        </div>
                        <div id="collapseTimeline" class="collapse " aria-labelledby="headingOne" data-parent="#timelineAccordion">
                          <div class="card-body">
                            <div class="timeline">
                              <div class="time-label">
                                <span class="bg-gray">15 Maret 2025</span>
                              </div>
                              <div>
                                <i class="fas fa-archive bg-gray"></i>
                                <div class="timeline-item">
                                  <span class="time"><i class="fas fa-clock"></i> 16:20</span>
                                  <h3 class="timeline-header"><a href="#">Arsip</a></h3>
                                  <div class="timeline-body">
                                    <span><strong>Diarsipkan Oleh : </strong> Admin TU</span>
                                  </div>
                                </div>
                              </div>
                              <div class="time-label">
                                <span class="bg-green">12 Maret 2025</span>
                              </div>
                              <div>
                                <i class="fas fa-share bg-green"></i>
                                <div class="timeline-item">
                                  <span class="time"><i class="fas fa-clock"></i> 13:45</span>
                                  <h3 class="timeline-header"><a href="#">Disposisi</a></h3>
                                  <div class="timeline-body">
                                    <span><strong>Disposisi Ke :</strong> Sekretaris</span><br>
                                    <span><strong>Catatan :</strong> Surat telah didisposisikan ke bidang terkait untuk ditindaklanjuti.</span>
                                  </div>
                                </div>
                              </div>
                              <div class="time-label">
                                <span class="bg-yellow">11 Maret 2025</span>
                              </div>
                              <div>
                                <i class="fas fa-paper-plane bg-yellow"></i>
                                <div class="timeline-item">
                                  <span class="time"><i class="fas fa-clock"></i> 10:00</span>
                                  <h3 class="timeline-header"><a href="#">Ajukan Disposisi</a></h3>
                                  <div class="timeline-body">
                                    <span><strong>Diajukan Ke :</strong> Ketua</span><br>
                                    <span><strong>Catatan :</strong> Surat diajukan untuk disposisi ke Kepala Bagian Umum.</span>
                                  </div>
                                </div>
                              </div>
                              <div class="time-label">
                                <span class="bg-blue">10 Maret 2025</span>
                              </div>
                              <div>
                                <i class="fas fa-envelope bg-blue"></i>
                                <div class="timeline-item">
                                  <span class="time"><i class="fas fa-clock"></i> 08:30</span>
                                  <h3 class="timeline-header"><a href="#">Surat Masuk</a></h3>
                                  <div class="timeline-body">
                                    <span><strong>Diterima Oleh : </strong> Admin TU</span>
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


              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <!-- <button type="button" class="btn control-save btn-success">Save</button>
                <button type="button" class="btn control-delete btn-danger">Delete</button> -->
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