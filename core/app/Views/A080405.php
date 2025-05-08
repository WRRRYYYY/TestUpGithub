<?= $this->extend('layout/bsa_main') ?>
<?= $this->section('main') ?>
<?php if (!$SessionEmpty) {  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1><?php echo $NamaMenu ?></h1>
          </div>
          <div class="col-sm-6 d-none">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Administrasi</li>
              <li class="breadcrumb-item active"><?php echo $NamaMenu ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div id="card-header" class="card-header">
          <div class="card-title" style="white-space:nowrap">
            <form id="page_form" class="form-inline">
              <select id="Periode" name="Periode" class="form-control form-control-sm select2 float-left" style="width:120px;" required="required" placeholder="Pilih Tahun">
                <?php
                if (isset($oQueryPeriode)) {
                  if (count($oQueryPeriode) > 0) {
                    foreach ($oQueryPeriode as $oRS) { ?>
                      <option value="<?php echo $oRS->Kode ?>" <?php if ($periode == $oRS->Kode) { ?> selected="selected" <?php } ?>><?php echo $oRS->Nama ?></option>
                <?php
                    }
                  }
                } ?>
              </select>
              <button name="reload" class="btn btn-sm btn-success control-reload float-left" style="margin-left:2px" type="button"><i class="fa fa-sync-alt"></i></button>
              <!--<strong><?php echo $Today ?></strong>-->
              <button name="new" class="btn btn-sm btn-primary control-new float-left d-none" style="margin-left:2px" type="button"><!--<i class="fa fa-plus"></i><span class="hidden-xs-down">&nbsp;&nbsp;New</span>-->Contoh Form</button>
            </form>
          </div>

          <div class="card-tools">
            <div class="action-pad box-tools" style="display:none">
              <div class="float-right">
                <a type="button" class="btn btn-sm control-edit" href="#edit"><i class="fas fa-edit"></i></a>
                <button type="button" class="btn btn-sm control-edit font-18" disabled="disabled" style="display:none"><i class="fas fa-edit"></i></button>
                <a type="button" class="btn btn-sm control-del" href="#hapus"><i class="fas fa-trash"></i></a>
              </div>
            </div>
          </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
          <table id="datatable" class="table table-striped">
            <thead>
              <tr>
                
       
                <th>Nomor Surat</th>
                <th>Tanggal Surat</th>
                <th>Kepada</th>
                <th>Perihal</th>
                <th>Jenis Surat</th>
                <th>Ditandatangani Oleh</th>
                <th style="text-align:center">Aksi</th>

              </tr>
            </thead>
            <tbody>
              <?php
              if (isset($oQueryList)) {
                if (count($oQueryList) > 0) {
                  foreach ($oQueryList as $oRS) {
                    $hash = hash('sha512', rand());
                    $pos = substr(rand(), 0, 1);
                    $mnu = $pos . substr($hash, 0, 128 - intval($pos)) . $AppClass->KodeMenu . substr($hash, -1 * intval($pos));
                    $url_add = "/frm/cod" . $oRS->idx . "/";
              ?>
                    <tr>
                      <td><?php echo $oRS->NomorSurat?></td>
                      <td><?php echo $oRS->TanggalSurat ?></td>
                      <td><?php echo $oRS->Kepada ?></td>
                      <td><?php echo $oRS->Perihal ?></td>
                      <td><span class="badge badge-warning" ><?php echo $oRS->NamaJenis ?></span></td>
                      <td><?php echo $oRS->NamaTTD ?></td>
                      <td style="width:40px; text-align:center">
                        <div class="btn-group" role="group" aria-label="Action Button">
                          <!--<a href="<?php echo  base_url() . "/" . strtolower($controller_name) . "/mnu/" . substr(md5(rand()), 4, 7) . "/salt/" . $mnu . $url_add ?>" class="btn btn-xs btn-success control-view" title="Edit Data"><i class="fas fa-eye smallzz"></i></a>-->
                          <a href="<?php echo $oRS->idx; ?>" data-kode="<?php echo $oRS->idx; ?>" class="btn btn-xs btn-primary control-print" title="Cetak Data"><i class="fas fa-print"></i></a>
                        </div>
                      </td>
                      
                    </tr><?php
                        }
                      }
                    } ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <form id="GenForm" method="post" style="display:none"><input type="hidden" name="Doc" value="Print" /><input type="hidden" name="HRef" /><input type="hidden" name="Periode" /><input type="hidden" name="Filter" /><input type="hidden" name="Key" /><input type="hidden" name="Kode" /></form>

<?php } else {
  echo $html_SessionEmpty;
} ?>
<?= $this->endSection() ?>