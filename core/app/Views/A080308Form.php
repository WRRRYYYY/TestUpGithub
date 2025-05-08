<?= $this->extend('layout/bsa_main') ?>
<?= $this->section('main') ?>
<?php if (!$SessionEmpty) {
  $KodeLama = "";
  $Kode = "";
  $Tahun = date("Y");

  $KodePosisiUser = "";

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

  $Dispo = "";
  $DispoOlehNama = "";
  $DispoKe = "";
  $DispoOleh = "";
  $DispoCaption = "";
  $DispoCaptionNama = "";
  $DispoTanggal = "";
  $DispoCatatan = "";
  $AjukanCC = "";

  $MsgDeskripsi = "";

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

        $KodePosisiUser = $oRS->KodePosisiUser;
        $KodePosisiUserChat = $oRS->KodePosisiUser;

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

        $Dispo = $oRS->Dispo;
        $DispoKe = $oRS->DispoKe;
        $DispoOlehNama = $oRS->DispoOlehNama;
        $DispoCaptionNama = $oRS->DispoCaptionNama;
        $DispoTanggal = $oRS->DispoTanggal;
        $DispoCatatan = $oRS->DispoCatatan;

        $AjukanCC = $oRS->AjukanCC;

        // $MsgDeskripsi = $oRS->MsgDeskripsi;
        // $isRight = !empty($oRS->MsgOleh);
        // $chatClass = $isRight ? 'right' : '';
        // $MsgOleh = $oRS->MsgOleh;
        // $MsgOlehNama = $oRS->MsgOlehNama;
        // $MsgTanggal = $oRS->MsgTanggal;
        // $MsgDeskripsi = $oRS->MsgDeskripsi;
        // $MsgOleh = $oRS->MsgOleh;


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
            <h1 class="m-0 text-dark">Pembahasan Surat Masuk<?php //echo $NamaMenu 
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
                <div class="alert alert-info alert-dismissible d-none">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-info"></i> Keterangan</h5>
                  Berikut data yang telah diisikan dan telah tersimpan. <strong>Perhatian!</strong> Data yang telah tersimpan tidak dapat diubah.
                </div>
                <div class="row">

                  <div class="col-md-12">
                    <div class="form-group row">
                      <label for="RegTanggal" class="col-sm-2 control-label label-data">Tanggal Terima</label>
                      <div class="col-sm-2">
                        <div class="input-group date" id="paramdate" data-target-input="nearest">
                          <span class="control-label label-data"><?php echo $AppClass->date_format_ina($RegTanggal) ?></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Pengirim" class="col-sm-2 control-label label-data">Pengirim</label>
                      <div class="col-sm-10">
                        <span class="control-label label-data"><?php echo $Pengirim ?></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="TanggalSurat" class="col-sm-2 control-label label-data">Tanggal Surat</label>
                      <div class="col-sm-2">
                        <span class="control-label label-data"><?php echo $AppClass->date_format_ina($TanggalSurat) ?></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="NomorSurat" class="col-sm-2 control-label label-data">Nomor Surat</label>
                      <div class="col-sm-10">
                        <span class="control-label label-data"><?php echo $NomorSurat ?></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Kepada" class="col-sm-2 control-label label-data">Kepada</label>
                      <div class="col-sm-10">
                        <span class="control-label label-data"><?php echo $Kepada ?></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Perihal" class="col-sm-2 control-label label-data">Perihal</label>
                      <div class="col-sm-10">
                        <span class="control-label label-data"><?php echo $Perihal ?></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Jenis" class="col-sm-2 control-label label-data">Jenis Surat</label>
                      <div class="col-sm-2"><?php
                                            $NamaJenis = "";
                                            if (isset($oQueryJenis)) {
                                              if (count($oQueryJenis) > 0) {
                                                foreach ($oQueryJenis as $oRS) {
                                                  if ($Jenis == $oRS->Kode) $NamaJenis = $oRS->Nama;
                                                  // break;
                                                }
                                              }
                                            } ?><span class="control-label label-data"><?php echo $NamaJenis ?></span>
                      </div>
                    </div>

                    <?php if ($FileNameOri[0] != "") { ?>
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



                    <?php if ($Agenda == "1") { ?>
                      <div id="agendaGroup">
                        <div class="form-group row">
                          <label class="col-sm-12 p-2 text-center font-weight-bold control-label">
                            <div class="line-with-text">AGENDA PIMPINAN</div>
                          </label>
                        </div>
                        <div class="form-group row">
                          <label for="AgendaTempat" class="col-sm-2 control-label label-data">Tempat</label>
                          <div class="col-sm-10">
                            <span class="control-label label-data"><?php echo $AgendaTempat ?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="AgendaTanggal" class="col-sm-2 control-label label-data">Tanggal</label>
                          <div class="col-sm-2">
                            <span class="control-label label-data"><?php echo $AppClass->date_format_ina($AgendaTanggal) ?></span>
                          </div>
                        </div>
                        <div class="form-group row mb-2">
                          <label for="AgendaDeskripsi" class="col-sm-2 control-label label-data">Agenda</label>
                          <div class="col-sm-10">
                            <span class="control-label label-data"><?php echo $AgendaDeskripsi ?></span>
                          </div>
                        </div>
                      </div>
                    <?php } ?>

                    <?php if ($Dispo == "1" && strpos("," . $DispoKe . ",", "," . $KodePosisiUser . ",", 0) !== false) { ?>
                      <div id="agendaGroup">
                        <div class="form-group row">
                          <label class="col-sm-12 p-2 text-center font-weight-bold control-label">
                            <div class="line-with-text">DETAIL DISPOSISI</div>
                          </label>
                        </div>
                        <div class="form-group row">
                          <label for="AgendaTempat" class="col-sm-2 control-label label-data">Dispo Dari</label>
                          <div class="col-sm-10">
                            <span class="control-label label-data"><?php echo $DispoOlehNama ?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="AgendaTanggal" class="col-sm-2 control-label label-data">Tanggal</label>
                          <div class="col-sm-2">
                            <span class="control-label label-data"><?php echo $AppClass->date_format_ina($DispoTanggal) ?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="AgendaTempat" class="col-sm-2 control-label label-data">Dispo Caption</label>
                          <div class="col-sm-10">
                            <span class="control-label label-data"><?php echo $DispoCaptionNama ?></span>
                          </div>
                        </div>

                        <div class="form-group row mb-2">
                          <label for="AgendaDeskripsi" class="col-sm-2 control-label label-data">Pesan Dispo</label>
                          <div class="col-sm-10">
                            <span class="control-label label-data"><?php echo $DispoCatatan ?></span>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-12 p-2 text-center font-weight-bold control-label">
                    <div class="line-with-text">PEMBAHASAN SURAT</div>
                  </label>
                </div>
                <div class="card direct-chat direct-chat-primary">
                  <div class="card-header ui-sortable-handle" style="cursor: move;">
                    <h3 class="card-title d-none">Ruang Chat : <?php echo $AjukanCC ?> (<?php echo $KodePosisiUser ?>)</h3>
                    <div class="card-tools">
                      <span title="<?php echo count($oQueryList); ?> New Messages" class="badge badge-primary">
                        <?php echo count($oQueryList); ?>
                      </span>
                      <button type="button" class="btn btn-tool" title="Refresh" onclick="location.reload();">
                        <i class="fas fa-sync-alt"></i>
                      </button>
                      <span title="3 New Messages" class="badge badge-primary  d-none">3</span>
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool d-none" title="Contacts" data-widget="chat-pane-toggle">
                        <i class="fas fa-comments"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->

                  <div class="card-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages">
                      <?php
                      if (isset($oQueryList) && count($oQueryList) > 0) {
                        foreach ($oQueryList as $oRS) {
                          $MsgDeskripsi = $oRS->MsgDeskripsi;
                          $MsgOleh = $oRS->MsgOleh;
                          $MsgOlehNama = $oRS->MsgOlehNama;
                          $MsgTanggal = $oRS->CrtTime;
                          $CrtUser = $oRS->CrtUser;

                          $isRight = ($MsgOleh === $KodePosisiUserChat);
                          $chatClass = $isRight ? 'right' : '';
                      ?>
                          <!-- Message -->
                          <div class="direct-chat-msg <?= $chatClass ?>">
                            <div class="direct-chat-infos clearfix">
                              <?php if ($isRight): ?>
                                <span class="direct-chat-name float-right"><?= htmlspecialchars($MsgOlehNama) ?></span>
                                <span class="direct-chat-timestamp float-left"><?= htmlspecialchars($MsgTanggal) ?></span>
                              <?php else: ?>
                                <span class="direct-chat-name float-left"><?= htmlspecialchars($MsgOlehNama) ?></span>
                                <span class="direct-chat-timestamp float-right"><?= htmlspecialchars($MsgTanggal) ?></span>
                              <?php endif; ?>
                            </div>
                            <?php
                            // Buat inisial dari MsgOlehNama
                            $parts = preg_split('/[\s\.]+/', trim($CrtUser)); // pisah berdasarkan spasi atau titik
                            $first = isset($parts[0]) ? strtoupper(substr($parts[0], 0, 1)) : '';
                            $second = isset($parts[1]) ? strtoupper(substr($parts[1], 0, 1)) : (
                              isset($parts[0]) && strlen($parts[0]) > 1 ? strtoupper(substr($parts[0], 1, 1)) : ''
                            );
                            $initial = $first . $second;
                            
                            // Tentukan warna bubble (biru kanan, abu kiri)
                            $bgColor = $isRight ? 'bg-primary' : 'bg-secondary';
                            ?>
                            <div class="direct-chat-img text-white <?= $bgColor ?> rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:40px; height:40px; font-weight:bold; font-size:14px;">
                              <?= $initial ?>
                            </div>


                            <div class="direct-chat-text">
                              <?= nl2br(htmlspecialchars($MsgDeskripsi)) ?>
                            </div>
                          </div>
                      <?php
                        }
                      } else {
                        echo '<div class="text-center text-muted">Belum ada percakapan.</div>';
                      }
                      ?>
                    </div>



                    <!--/.direct-chat-messages-->

                    <!-- Contacts are loaded here -->
                    

                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">

                    <div class="input-group">

                      <input name="MsgDeskripsi" type="text" class="form-control" id="MsgDeskripsi" value="" placeholder="Masukkan Pesan..." />
                      <span class="input-group-append">
                        <button type="button" class="btn control-save btn-primary">Send</button>
                      </span>
                    </div>

                  </div>
                  <!-- /.card-footer-->
                </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer text-center">
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