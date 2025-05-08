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
            <div class="card bg-olive">
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
                  <h3>Selamat Datang di Dashboard Utama Aplikasi Sistem Informasi Baznas Jawa Tengah!</h3>
                  <p> Aplikasi Sistem Informasi Baznas Jawa Tengah adalah sebuah platform digital yang dirancang untuk mendukung pengelolaan zakat, infak, dan sedekah (ZIS).
                  </p>
                </div>
                <div class="ml-auto d-none d-sm-block">
                  <img src="<?php echo base_url() ?>/assets/img/logo-putih.png" alt="Ilustrasi Surat" width="200">
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <a>
              <div class="card bg-danger" >
                <div class="card-body d-flex align-items-center" style="padding:20px !important;">
                  <div style="padding-right:10px !important;">
                    <h4>Dashboard Administrasi Surat</h4>
                    <p>Dashboard ini berisi informasi mengenai surat masuk, surat keluar, dan disposisi surat.</p>
                    <a class="text-white" href="#">Selengkapnya <i class="fas fa-arrow-circle-right" ></i></a>
                  </div>
                  <div class="ml-auto">
                    <img src="<?php echo base_url() ?>/assets/img/flaticon/letter.png?<?php echo rand() ?>" alt="Ilustrasi Dashboard" width="150">
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4">
            <a>
              <div class="card bg-warning" >
                <div class="card-body d-flex align-items-center" style="padding:20px !important;">
                  <div class="padding-right-10" style="padding-right:10px !important;">
                    <h4>Dashboard Pengelolaan ZIS</h4>
                    <p>Menampilkan data dan statistik pengelolaan Zakat, Infaq, Dan Shodaqoh secara real-time.</p>
                    <a class="text-dark" href="#">Selengkapnya <i class="fas fa-arrow-circle-right" ></i></a>
                  </div>
                  <div class="ml-auto">
                    <img src="https://berliansolusi.com/griyadonasi.org/public/flaticon/infaq.png" alt="Ilustrasi Dashboard" width="150">
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4">
            <a>
              <div class="card bg-info" >
                <div class="card-body d-flex align-items-center" style="padding:20px !important;">
                  <div style="padding-right:10px !important;">
                    <h4>Dashboard Administrasi Keuangan</h4>
                    <p>Menampilkan informasi keuangan secara real-time dan pengelolaan lebih efektif.</p>
                    <a class="text-white" href="#">Selengkapnya <i class="fas fa-arrow-circle-right" ></i></a>
                  </div>
                  <div class="ml-auto">
                    <img src="<?php echo base_url() ?>/assets/img/flaticon/debit-card.png?<?php echo rand() ?>" alt="Ilustrasi Dashboard" width="150">
                  </div>
                </div>
              </div>
            </a>
          </div>

        </div>
        <!-- Small boxes (Stat box) -->
        <div class="row d-none">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo number_format($Tot01, 0, ",", ".") ?></h3>

                <p>Surat Masuk</p>
              </div>
              <div class="icon">
                <i class="fas fa-envelope"></i>
              </div>
              <a href="<?php echo  base_url() . "/" . strtolower($controller_name) . "/mnu/" . substr(md5(rand()), 4, 7) . "/salt/" . $mnu01 ?>" class="small-box-footer bg-warning">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo number_format($Tot02, 0, ",", ".") ?></h3>

                <p>Surat Keluar</p>
              </div>
              <div class="icon">
                <i class="fas fa-paper-plane"></i>
              </div>
              <a href="<?php echo  base_url() . "/" . strtolower($controller_name) . "/mnu/" . substr(md5(rand()), 4, 7) . "/salt/" . $mnu02 ?>" class="small-box-footer bg-warning">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
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
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo number_format($Tot04, 0, ",", ".") ?></h3>

                <p>Pengguna</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="<?php echo  base_url() . "/" . strtolower($controller_name) . "/mnu/" . substr(md5(rand()), 4, 7) . "/salt/" . $mnu04 ?>" class="small-box-footer bg-warning">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row d-none">
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
                  <table id="surat-data" style="display:none">
                    <tr>
                      <td>Januari</td>
                      <td>10</td>
                      <td>5</td>
                    </tr>
                    <tr>
                      <td>Februari</td>
                      <td>15</td>
                      <td>8</td>
                    </tr>
                    <tr>
                      <td>Maret</td>
                      <td>12</td>
                      <td>6</td>
                    </tr>
                    <tr>
                      <td>April</td>
                      <td>20</td>
                      <td>10</td>
                    </tr>
                    <tr>
                      <td>Mei</td>
                      <td>18</td>
                      <td>9</td>
                    </tr>
                    <tr>
                      <td>Juni</td>
                      <td>25</td>
                      <td>12</td>
                    </tr>
                    <tr>
                      <td>Juli</td>
                      <td>30</td>
                      <td>15</td>
                    </tr>
                    <tr>
                      <td>Agustus</td>
                      <td>22</td>
                      <td>11</td>
                    </tr>
                    <tr>
                      <td>September</td>
                      <td>17</td>
                      <td>7</td>
                    </tr>
                    <tr>
                      <td>Oktober</td>
                      <td>19</td>
                      <td>10</td>
                    </tr>
                    <tr>
                      <td>November</td>
                      <td>23</td>
                      <td>13</td>
                    </tr>
                    <tr>
                      <td>Desember</td>
                      <td>27</td>
                      <td>14</td>
                    </tr>

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
                <h3 class="card-title">Disposisi Surat Terbaru <span class="badge badge-warning">15</span></h3>
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
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Pengirim</th>
                      <th>Tanggal</th>
                      <th>Status</th>
                      <th>Catatan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>201</td>
                      <td>Ketua Baznas</td>
                      <td><span class="badge badge-secondary">2 menit yang lalu</span></td>
                      <td><span class="badge badge-success">Disetujui</span></td>
                      <td>Segera ditindaklanjuti.</td>
                    </tr>
                    <tr>
                      <td>202</td>
                      <td>Sekretariat</td>
                      <td><span class="badge badge-secondary">5 menit yang lalu</span></td>
                      <td><span class="badge badge-warning">Menunggu</span></td>
                      <td>Menunggu persetujuan pimpinan.</td>
                    </tr>
                    <tr>
                      <td>203</td>
                      <td>Bidang Pendistribusian</td>
                      <td><span class="badge badge-secondary">10 menit yang lalu</span></td>
                      <td><span class="badge badge-danger">Ditolak</span></td>
                      <td>Dokumen kurang lengkap.</td>
                    </tr>
                    <tr>
                      <td>204</td>
                      <td>Bidang Pengumpulan</td>
                      <td><span class="badge badge-secondary">30 menit yang lalu</span></td>
                      <td><span class="badge badge-primary">Diproses</span></td>
                      <td>Dalam proses verifikasi data.</td>
                    </tr>
                    <tr>
                      <td>205</td>
                      <td>Bidang Keuangan</td>
                      <td><span class="badge badge-secondary">1 jam yang lalu</span></td>
                      <td><span class="badge badge-success">Disetujui</span></td>
                      <td>Dana siap disalurkan.</td>
                    </tr>
                    <tr>
                      <td>206</td>
                      <td>Bidang SDM</td>
                      <td><span class="badge badge-secondary">2 jam yang lalu</span></td>
                      <td><span class="badge badge-warning">Menunggu</span></td>
                      <td>Menunggu kelengkapan berkas.</td>
                    </tr>
                    <tr>
                      <td>207</td>
                      <td>Bidang Kesejahteraan</td>
                      <td><span class="badge badge-secondary">3 jam yang lalu</span></td>
                      <td><span class="badge badge-primary">Diproses</span></td>
                      <td>Dalam tahap validasi penerima.</td>
                    </tr>
                    <tr>
                      <td>208</td>
                      <td>Bidang Audit</td>
                      <td><span class="badge badge-secondary">5 jam yang lalu</span></td>
                      <td><span class="badge badge-danger">Ditolak</span></td>
                      <td>Laporan keuangan tidak valid.</td>
                    </tr>
                    <tr>
                      <td>209</td>
                      <td>Bidang Sosialisasi</td>
                      <td><span class="badge badge-secondary">8 jam yang lalu</span></td>
                      <td><span class="badge badge-success">Disetujui</span></td>
                      <td>Kegiatan sosialisasi sudah disetujui.</td>
                    </tr>
                    <tr>
                      <td>210</td>
                      <td>Bidang Teknologi Informasi</td>
                      <td><span class="badge badge-secondary">10 jam yang lalu</span></td>
                      <td><span class="badge badge-primary">Diproses</span></td>
                      <td>Pengembangan sistem dalam tahap analisis.</td>
                    </tr>
                    <tr>
                      <td>211</td>
                      <td>Bidang Humas</td>
                      <td><span class="badge badge-secondary">12 jam yang lalu</span></td>
                      <td><span class="badge badge-success">Disetujui</span></td>
                      <td>Persetujuan publikasi telah diberikan.</td>
                    </tr>
                    <tr>
                      <td>212</td>
                      <td>Bidang Kesehatan</td>
                      <td><span class="badge badge-secondary">14 jam yang lalu</span></td>
                      <td><span class="badge badge-warning">Menunggu</span></td>
                      <td>Menunggu konfirmasi dari dinas terkait.</td>
                    </tr>
                    <tr>
                      <td>213</td>
                      <td>Bidang Pendidikan</td>
                      <td><span class="badge badge-secondary">16 jam yang lalu</span></td>
                      <td><span class="badge badge-primary">Diproses</span></td>
                      <td>Verifikasi bantuan pendidikan sedang berlangsung.</td>
                    </tr>
                    <tr>
                      <td>214</td>
                      <td>Bidang Logistik</td>
                      <td><span class="badge badge-secondary">18 jam yang lalu</span></td>
                      <td><span class="badge badge-danger">Ditolak</span></td>
                      <td>Distribusi logistik belum memenuhi syarat.</td>
                    </tr>
                    <tr>
                      <td>215</td>
                      <td>Bidang Zakat</td>
                      <td><span class="badge badge-secondary">20 jam yang lalu</span></td>
                      <td><span class="badge badge-success">Disetujui</span></td>
                      <td>Pendistribusian zakat telah disetujui.</td>
                    </tr>
                  </tbody>
                </table>

              </div>
              <!-- /.card-body -->
            </div>

          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row (main row) -->
        <div class="row d-none">
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
                    <tr>
                      <td>1</td>
                      <td>Rapat Evaluasi</td>
                      <td>2025-03-05</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Seminar IT</td>
                      <td>2025-03-10</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Diskusi Proyek</td>
                      <td>2025-03-15</td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Pelatihan Kepemimpinan</td>
                      <td>2025-03-20</td>
                    </tr>
                    <tr>
                      <td>5</td>
                      <td>Meeting Internal</td>
                      <td>2025-03-25</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0 bg-success">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Agenda Surat Minggu Ini <span class="badge badge-warning">20</span></h3>
                </div>
              </div>
              <div class="card-body">
                <table id="datatable" class="table table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th>Nama Kegiatan</th>
                      <th>Tanggal</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-center">1.</td>
                      <td>Rapat Koordinasi BAZNAS dalam Pengelolaan Zakat dan Infak</td>
                      <td>2025-02-26</td>
                      <td><span class="badge badge-warning">Terjadwal</span></td>
                    </tr>
                    <tr>
                      <td class="text-center">2.</td>
                      <td>Evaluasi Kinerja BAZNAS dan Peningkatan Transparansi Dana Zakat</td>
                      <td>2025-02-25</td>
                      <td><span class="badge badge-success">Selesai</span></td>
                    </tr>
                    <tr>
                      <td class="text-center">3.</td>
                      <td>Pelatihan SDM BAZNAS dalam Pendistribusian Zakat</td>
                      <td>2025-02-24</td>
                      <td><span class="badge badge-danger">Dibatalkan</span></td>
                    </tr>
                    <tr>
                      <td class="text-center">4.</td>
                      <td>Workshop Digitalisasi Sistem BAZNAS</td>
                      <td>2025-02-23</td>
                      <td><span class="badge badge-warning">Terjadwal</span></td>
                    </tr>
                    <tr>
                      <td class="text-center">5.</td>
                      <td>Monitoring Penyaluran Dana Zakat</td>
                      <td>2025-02-22</td>
                      <td><span class="badge badge-success">Selesai</span></td>
                    </tr>
                    <tr>
                      <td class="text-center">6.</td>
                      <td>Diskusi Anggaran BAZNAS Tahun 2025</td>
                      <td>2025-02-21</td>
                      <td><span class="badge badge-warning">Terjadwal</span></td>
                    </tr>
                    <tr>
                      <td class="text-center">7.</td>
                      <td>Seminar Inovasi Program BAZNAS</td>
                      <td>2025-02-20</td>
                      <td><span class="badge badge-success">Selesai</span></td>
                    </tr>
                    <tr>
                      <td class="text-center">8.</td>
                      <td>Rapat Evaluasi Program BAZNAS Semester 1</td>
                      <td>2025-02-19</td>
                      <td><span class="badge badge-danger">Dibatalkan</span></td>
                    </tr>
                    <tr>
                      <td class="text-center">9.</td>
                      <td>Kunjungan Kerja BAZNAS ke Pesantren</td>
                      <td>2025-02-18</td>
                      <td><span class="badge badge-warning">Terjadwal</span></td>
                    </tr>
                    <tr>
                      <td class="text-center">10.</td>
                      <td>Presentasi Proyek Digitalisasi Zakat</td>
                      <td>2025-02-17</td>
                      <td><span class="badge badge-success">Selesai</span></td>
                    </tr>
                  </tbody>



                </table>
              </div>

              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php } else {
  echo $html_SessionEmpty;
} ?>
<?= $this->endSection() ?>