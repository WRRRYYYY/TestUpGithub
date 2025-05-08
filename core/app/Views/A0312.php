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
              <li class="breadcrumb-item active">Konfigurasi</li>
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
              <select id="Periode" name="Periode" class="form-control form-control-sm select2 float-left" style="width:160px;" required="required" placeholder="Pilih Tahun">
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
              <!-- <button name="new" class="btn btn-sm btn-primary control-new float-left" style="margin-left:2px" type="button"><i class="fa fa-plus"></i><span class="hidden-xs-down">&nbsp;&nbsp;New</span></button> -->
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
                  <th style="text-align:center">Aksi</th>
                  <th>Posisi</th>
                  <th>Pegawai</th>
                  <th style="text-align:center">Keterangan</th>
                </tr>
              </thead>
              <tbody>
<?php 
  if(isset($oQueryList)) { 
    if(count($oQueryList) > 0) { 
      foreach($oQueryList as $oRS) {
        $hash = hash('sha512',rand());
        $pos = substr(rand(),0,1); 
        $mnu = $pos . substr($hash,0,128-intval($pos)) . $AppClass->KodeMenu . substr($hash,-1*intval($pos));
        $url_add = "/frm/per".$oRS->KodePeriode."/cod".$oRS->KodeStruktur."/";
         ?>
                <tr>
                  <td class="text-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item control-view btn-sm" href="<?php echo  base_url() . "/" . strtolower($controller_name) . "/mnu/" . substr(md5(rand()), 4, 7) . "/salt/" . $mnu . $url_add ?>">
                          <i class="fas fa-eye small mx-2"></i>Lihat Data
                        </a>
                        <a class="dropdown-item control-delete btn-sm" href="<?php echo $oRS->KodeStruktur; ?>" title="Hapus Data">
                          <i class="fas fa-trash-alt mx-2"></i>Hapus Data
                        </a>
                      </div>
                    </div>
                  </td>                  
                  <td><?php echo $oRS->NamaStruktur; ?></td>
                  <td><?php echo $oRS->NamaPegawai; ?></td>
                  <td><?php echo $oRS->Keterangan; ?></td>
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
  
  <?php } else {
  echo $html_SessionEmpty;
} ?>
<?= $this->endSection() ?>
