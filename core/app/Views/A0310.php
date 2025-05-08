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
            <div class="card-title"> <!--Data Role-->
            <button name="reload" class="btn btn-sm btn-success control-reload" type="button"><i class="fa fa-sync-alt"></i></button>
            <button name="new" class="btn btn-sm btn-primary control-new" type="button"><i class="fa fa-plus"></i><span class="hidden-xs-down">&nbsp;&nbsp;New</span></button>
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
                  <th>Nama </th>
                  <th>Alias</th>
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
        $url_add = "/frm/cod".$oRS->Kode."/";
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
                        <a class="dropdown-item control-delete btn-sm" href="<?php echo $oRS->Kode; ?>" title="Hapus Data">
                          <i class="fas fa-trash-alt mx-2"></i>Hapus Data
                        </a>
                      </div>
                    </div>
                  </td>                  
                  <td><?php echo $oRS->Nama; ?></td>
                  <td><?php echo $oRS->Alias; ?></td>
                  <td align="center"><?php 
                    if($oRS->Aktif=="1") echo "<span class=\"badge badge-success\">Aktif</span>"; //"&#10004;";
                    else echo "<span class=\"badge badge-danger\">Non Aktif</span>"; //"-"; ?></td>
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
