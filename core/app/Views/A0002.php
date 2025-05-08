<?= $this->extend('layout/bsa_main') ?>
<?= $this->section('main') ?>
    <?php if(!$SessionEmpty) {  ?>

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
            <button name="reload" class="btn btn-sm btn-warning control-reload" type="button"><i class="fa fa-sync-alt"></i></button>
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
                  <th>Kode</th>
                  <th>Nama Role</th>
                  <th class="text-center">Akses Khusus</th>
                  <th class="text-center">Akses Tambahan</th>
                  <th class="text-center">Status</th>
                  <th>Keterangan</th>
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
                  <td style="width:40px; text-align:center">
                    <div class="btn-group" role="group" aria-label="Action Button">
                                                            <a href="<?php echo  base_url() . "/" . strtolower($controller_name)."/mnu/" . substr(md5(rand()),4,7) . "/salt/" . $mnu . $url_add ?>" class="btn btn-xs btn-info control-view" title="Lihat Data"><i class="fas fa-eye small"></i></a>
                                                            <a href="<?php echo $oRS->Kode; ?>" class="btn btn-xs btn-danger control-delete" title="Hapus Data"><i class="fas fa-trash-alt"></i></a>
</div>
                  </td>
                  <td><a href="<?php echo  base_url() . "/" . strtolower($controller_name)."/mnu/" . substr(md5(rand()),4,7) . "/salt/" . $mnu . $url_add ?>" class="nav-edit"><?php echo $oRS->Kode ?></a></td>
                  <td><a href="<?php echo  base_url() . "/" . strtolower($controller_name)."/mnu/" . substr(md5(rand()),4,7) . "/salt/" . $mnu . $url_add ?>" class="nav-edit"><?php echo $oRS->Nama ?></a></td>
                  <td class="text-center"><?php 
                    if($oRS->HakAksesKhusus=="1") echo "<span class=\"badge badge-success\">Ya</span>"; 
                    else echo "<span class=\"badge badge-danger\">Tidak</span>";
                  ?></td>
                  <td class="text-center"><?php 
                    if($oRS->HakAksesTambahan=="1") echo "<span class=\"badge badge-success\">Ya</span>"; 
                    else echo "<span class=\"badge badge-danger\">Tidak</span>";
                  ?></td>
                  <td class="text-center"><?php 
                    if($oRS->Aktif=="1") echo "<span class=\"badge badge-success\">Aktif</span>"; 
                    else echo "<span class=\"badge badge-danger\">Non Aktif</span>";
                  ?></td>
                  <td><?php echo $oRS->Kode ?></td>
                </tr><?php 
			}
		}
	} ?>
              </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix" style="display:none">
          <div class="input-group input-group-sm" style="width: 150px; float:left;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
            </div>
          </div>
          <ul class="pagination pagination-sm m-0 float-right">
              <li class="page-item<?php if($page==1) { ?> disabled<?php } ?>"><a class="page-link" href="#<?php echo $page-1 ?>">&laquo;</a></li>
		<?php	for($i=1;$i<=$pages;$i++) { ?>
              <li class="page-item<?php if($i==$page) { ?> active<?php } ?>"><a class="page-link" href="#<?php echo $i ?>"><?php echo $i ?></a></li>
		<?php	} ?>
              <li class="page-item<?php if($page==$pages) { ?> disabled<?php } ?>"><a class="page-link" href="#<?php echo $page+1 ?>">&raquo;</a></li>
          </ul>
        </div>
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<?php } else { echo $html_SessionEmpty; } ?>
<?= $this->endSection() ?>
