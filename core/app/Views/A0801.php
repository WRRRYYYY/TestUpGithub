<?= $this->extend('layout/bsa_main') ?>
<?= $this->section('main') ?>
<style type="text/css">
  .bg-success {
    background-color: #005331 !important;
    color: #fff;
  }

  .text-success {
    color: #005331 !important;

  }

  .fc .fc-button-primary {
    color: #fff;
    color: var(--fc-button-text-color, #fff);
    background-color: #005331 !important;
    background-color: var(--fc-button-bg-color, #005331) !important;
    border-color: #005331 !important;
    border-color: var(--fc-button-border-color, #005331) !important;
  }

  .fc .fc-button-primary:hover {
    background-color: #004026 !important;
    border-color: #00331d !important;
  }

  #calendar {
    max-height: 471px;
    overflow-y: auto;
  }

  .fc-daygrid-day {
    border: 2px solid #ddd !important;
  }
</style>
<?php if (!$SessionEmpty) { ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col-sm-6">
            <h1><?php echo $NamaMenu ?></h1>
          </div>
          <div class="col-sm-6">
            <h5 class="float-sm-right mt-2">Periode <?php echo $PeriodeAktif ?></h5>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php
    $Tot01 = 0;
    $Tot02 = 0;
    $Tot03 = 0;
    $Tot04 = 0;
    $mnu01 = "";
    $mnu02 = "";
    $mnu03 = "";
    $mnu04 = "";
    $TotGraph01 = 0;
    $TotGraph02 = 0;
    if (isset($oQueryList01)) {
      if (count($oQueryList01) > 0) {
        foreach ($oQueryList01 as $oRS) {
          $Tot01 = $oRS->Tot01;
          $Tot02 = $oRS->Tot02;
          $Tot03 = $oRS->Tot03;
          $Tot04 = $oRS->Tot04;

          $hash = hash('sha512', rand());
          $pos = substr(rand(), 0, 1);
          $mnu01 = $pos . substr($hash, 0, 128 - intval($pos)) . $oRS->KodeMenu01 . substr($hash, -1 * intval($pos)) . "/";

          $hash = hash('sha512', rand());
          $pos = substr(rand(), 0, 1);
          $mnu02 = $pos . substr($hash, 0, 128 - intval($pos)) . $oRS->KodeMenu02 . substr($hash, -1 * intval($pos));

          $hash = hash('sha512', rand());
          $pos = substr(rand(), 0, 1);
          $mnu03 = $pos . substr($hash, 0, 128 - intval($pos)) . $oRS->KodeMenu03 . substr($hash, -1 * intval($pos));

          $hash = hash('sha512', rand());
          $pos = substr(rand(), 0, 1);
          $mnu04 = $pos . substr($hash, 0, 128 - intval($pos)) . $oRS->KodeMenu04 . substr($hash, -1 * intval($pos));
        }
      }
    }
    $TotGraph01 = $Tot03; //$Tot01+$Tot02;
    $TotGraph02 = $Tot04; //$Tot03+$Tot04;
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card bg-success">
              <div class="card-body d-flex align-items-center">
                <div>
                  <p>Hi <?php echo $AppClass->session->get($AppClass->AppModule . "UserName") ?>, Selamat
                    <?php
                    date_default_timezone_set('Asia/Jakarta');

                    $jam = date('H');
                    if ($jam >= 5 && $jam < 11) {
                      $waktu = "Pagi";
                    } elseif ($jam >= 11 && $jam < 15) {
                      $waktu = "Siang";
                    } elseif ($jam >= 15 && $jam < 18) {
                      $waktu = "Sore";
                    } else {
                      $waktu = "Malam";
                    }

                    echo $waktu;
                    ?>!
                  </p>
                  <h3>Selamat Datang di Aplikasi Sistem Informasi Baznas Jawa Tengah!</h3>
                  <p>Kelola surat masuk dan keluar dengan lebih mudah dan efisien. <a href="#">
                      <bagde class="badge badge-warning">Panduan Penggunaan <i class="fas fa-arrow-circle-right"></i></bagde>
                  </p></a>
                </div>
                <div class="ml-auto d-none d-sm-block">
                  <img src="<?php echo base_url() ?>/assets/img/mail2.png?<?php echo rand() ?>" alt="Ilustrasi Surat" width="200">
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo number_format($Tot01, 0, ",", ".") ?></h3>

                <p>Surat Masuk</p>
              </div>
              <div class="icon">
                <i class="fas fa-envelope"></i>
              </div>
              <a href="<?php echo  base_url() . "/" . strtolower($controller_name) . "/mnu/" . substr(md5(rand()), 4, 7) . "/salt/" . $mnu01 ?>" class="small-box-footer bg-danger">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-olive">
              <div class="inner">
                <h3><?php echo number_format($Tot02, 0, ",", ".") ?></h3>

                <p>Surat Keluar</p>
              </div>
              <div class="icon">
                <i class="fas fa-paper-plane"></i>
              </div>
              <a href="<?php echo  base_url() . "/" . strtolower($controller_name) . "/mnu/" . substr(md5(rand()), 4, 7) . "/salt/" . $mnu02 ?>" class="small-box-footer bg-olive">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo number_format($Tot03, 0, ",", ".") ?></h3>
                <p>Disposisi Surat</p>
              </div>
              <div class="icon">
                <i class="fas fa-mail-bulk"></i>
              </div>
              <a href="<?php echo  base_url() . "/" . strtolower($controller_name) . "/mnu/" . substr(md5(rand()), 4, 7) . "/salt/" . $mnu03 ?>" class="small-box-footer bg-warning">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo number_format($Tot04, 0, ",", ".") ?></h3>

                <p>Pengguna</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="<?php echo  base_url() . "/" . strtolower($controller_name) . "/mnu/" . substr(md5(rand()), 4, 7) . "/salt/" . $mnu04 ?>" class="small-box-footer bg-info">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0 bg-success">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Grafik Surat Masuk Dan Keluar</h3>
                  <a href="javascript:void(0);" style="display:none">Laporan Detail</a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column text-center w-100">
                    <span class="text-bold text-lg d-none"><?php echo $TotGraph02 ?></span>
                    <span>Perbandingan Surat Masuk vs Surat Keluar</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right" style="display:none !important">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 33.1%
                    </span>
                    <span class="text-muted">Since last month</span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="surat-chart" height="300"></canvas>
                  <table id="surat-data" style="display:none !important">
                    <thead>
                      <tr>
                        <th>Bulan</th>
                        <th>Jumlah Masuk</th>
                        <th>Jumlah Keluar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if (isset($oQueryGrafik) && count($oQueryGrafik) > 0) {
                        foreach ($oQueryGrafik as $oRS) {
                      ?>
                          <tr>
                            <td><?php echo $oRS->nama_bulan; ?></td>
                            <td><?php echo $oRS->jumlah_masuk; ?></td>
                            <td><?php echo $oRS->jumlah_keluar; ?></td>
                          </tr>
                      <?php
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-success"></i> Surat Masuk
                  </span>

                  <span class="mr-2">
                    <i class="fas fa-square text-warning"></i> Surat Keluar
                  </span>
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0 bg-success">
                <h3 class="card-title">Posisi Surat Terbaru</h3>
                <div class="card-tools d-none">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 427px;">
                  <div class="scroll-container">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Pengirim</th>
                      <th>Tanggal Registrasi</th>
                      <th>Posisi Terakhir</th>
                      <th>Perihal</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    if (isset($oQueryPosisi)) {
                      if (count($oQueryPosisi) > 0) {
                        $iNo = 0;
                        foreach ($oQueryPosisi as $oRS) {
                          $iNo++;
                    ?>
                          <tr>
                            <td style="width:40px;" class="text-center"><?php echo $iNo; ?>.</td>
                            <td><?php echo $oRS->Pengirim; ?></td>
                            <td><?php echo $oRS->RegTanggal; ?></td>
                            <td><span class="badge badge-warning" ><?php echo $oRS->PosisiTerakhir; ?></span></td>
                            <td><?php echo $oRS->Perihal; ?></td>

                          </tr>
                    <?php
                        }
                      }
                    } ?>
                  </tbody>
                </table>
                </div>

              </div>
              <!-- /.card-body -->
            </div>

          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row (main row) -->
        <div class="row ">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0 bg-success">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Agenda Surat Minggu Ini <span class="badge badge-warning"> <?php echo isset($oQueryAgenda) ? count($oQueryAgenda) : 0; ?></span></h3>
                </div>
              </div>
              <div class="card-body">
                <table id="datatable" class="table table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">No.</th>
                      <th>Status</th>
                      <th>Tanggal</th>
                      <th>Nama Kegiatan</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if (isset($oQueryAgenda)) {
                      if (count($oQueryAgenda) > 0) {
                        $iNo = 0;
                        foreach ($oQueryAgenda as $oRS) {
                          $iNo++;
                          // Tentukan kelas badge berdasarkan status
                          $status = $oRS->StatusAgenda;
                          $badgeClass = 'badge-secondary';
                          if ($status == 'Hari ini') $badgeClass = 'badge-danger';
                          else if ($status == 'Besok') $badgeClass = 'badge-warning';
                          else if (strpos($status, 'hari lagi') !== false) $badgeClass = 'badge-info';
                          else if ($status == 'Pekan Depan') $badgeClass = 'badge-primary';
                          else if ($status == '2 Pekan Lagi') $badgeClass = 'badge-primary';
                          else if (strpos($status, 'yang lalu') !== false) $badgeClass = 'badge-dark';
                          else if ($status == 'Lebih dari 1 minggu yang lalu') $badgeClass = 'badge-dark';
                    ?>
                          <tr>
                            <td><?php echo $iNo; ?>.</td>
                            <td><span class="badge <?php echo $badgeClass; ?>"><?php echo $status; ?></span></td>
                            <td><?php echo $oRS->AgendaTanggal; ?></td>
                            <td><?php echo $oRS->AgendaDeskripsi; ?></td>
                          </tr>
                    <?php
                        }
                      }
                    } ?>
                  </tbody>
                </table>
              </div>

              <!-- /.card-body -->
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0 bg-success">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title text-white">Agenda Surat</h3>
                </div>
              </div>
              <div class="card-body">
                <div id="calendar"></div>
                <table class="table" style="display:none">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Judul</th>
                      <th>Tanggal</th>
                    </tr>
                  </thead>
                  <tbody id="agendaData">
                    <?php
                    if (isset($oQueryAgenda)) {
                      if (count($oQueryAgenda) > 0) {
                        $iNo = 0;
                        foreach ($oQueryAgenda as $oRS) {
                          $iNo++;
                    ?>
                          <tr>
                            <td><?php echo $iNo; ?>.</td>
                            <td><?php echo $oRS->AgendaDeskripsi; ?></td>
                            <td><?php echo $oRS->AgendaTanggal; ?></td>
                            

                          </tr>
                    <?php
                        }
                      }
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Modal untuk detail agenda -->
<div class="modal fade" id="agendaModal" tabindex="-1" aria-labelledby="agendaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content rounded-3">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="agendaModalLabel">Detail Agenda</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <p id="agendaDescription"></p>
        <p><strong>Tanggal:</strong> <span id="agendaDate"></span></p>
      </div>
    </div>
  </div>
</div>

<?php } else {
  echo $html_SessionEmpty;
} ?>
<?= $this->endSection() ?>