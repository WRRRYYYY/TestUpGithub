<?= $this->extend('layout/bsa_main') ?>
<?= $this->section('main') ?>
    <?php if(!$SessionEmpty) {  
			$KodeLama = "";
			$Kode = "";
			$ReadonlyAttr = "";
			$Nama = "";
			$Alias = "";
			$Induk = "";
			$KodeInduk = "";
			$NamaInduk = "";
			$Indeks = "";
			$Indeks = "";
			$Keterangan = "";
			$sClassDisabled = "";
			$Aktif = "";
			$chkAktif_1 = " disabled=\"disabled\"";
			$chkAktif_0 = " disabled=\"disabled\"";
			$FirstRec = "1";
			$LastRec= "0";
			if(isset($oQuery)) {
				if(count($oQuery) > 0) {
					foreach($oQuery as $oRS) {
				
						$KodeLama = $oRS->Kode;		
						$Kode = $oRS->Kode;		
						$ReadonlyAttr = " readonly=\"readonly\"";
						$Nama = $oRS->Nama;		
						$Alias = $oRS->Alias;	
						$KodeInduk = $oRS->KodeInduk;	
						$Indeks = $oRS->Indeks;	
						$Keterangan = $oRS->Keterangan;	
			
						$Aktif = $oRS->Aktif;	
						if($oRS->Aktif=="1")	
							$chkAktif_1 = " checked=\"checked\"";
						else
							$chkAktif_0 = " checked=\"checked\"";
				
						$FirstRec = $oRS->FirstRec;		
						$LastRec = $oRS->LastRec;	
					}
				}
			}
	
	?>
<style>
	.page-wrapper, .page-titles { background-color:#FFF; }
	.form-group.row { margin-bottom:5px; }
	.control-label { line-height:38px; font-weight:bold; }
</style>

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
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header" style="display:none">
            <h3 class="card-title">Struktur Form</h3>

            <!--<div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>-->
          </div>
          <!-- /.card-header -->
          <form id="page_form" role="form" class="form-horizontal">
            <input type="hidden" name="KodeLama" class="form-control" value="<?php echo $KodeLama ?>" />
            <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                      <div class="form-group row">
                          <label for="Kode" class="col-sm-3 control-label">Kode</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control readonly-text" name="Kode" id="Kode" value="<?php echo $Kode ?>" placeholder="Kode Struktur" required="required"<?php echo $ReadonlyAttr ?>>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="Nama" class="col-sm-3 control-label">Nama</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="Nama" id="Nama" value="<?php echo $Nama ?>"  placeholder="Nama Struktur" required="required">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="Alias" class="col-sm-3 control-label">Alias</label>
                          <div class="col-sm-4">
                            <input type="text" class="form-control" name="Alias" id="Alias" value="<?php echo $Alias ?>"  placeholder="Alias Struktur" required="required">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="Induk" class="col-sm-3 control-label">Struktur Induk</label>
                          <div class="col-sm-9">
                            <select class="form-control select2 editable-combo" name="Induk" id="Induk" style="width: 100%;">
                                <option value="">Pilih Struktur Induk</option><?php 	
    if(isset($oQueryInduk)) {
        if(count($oQueryInduk) > 0) {
            foreach($oQueryInduk as $oRS) {
                $sSelected = "";
                if("k".$KodeInduk=="k".$oRS->Kode) $sSelected = " selected=\"selected\""; ?>
                                <option value="<?php echo $oRS->Kode ?>"<?php echo $sSelected ?>><?php echo $oRS->Kode . " - " . $oRS->Nama ?></option>
<?php 	
            }
        }
    } ?>

                            </select>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="Indeks" class="col-sm-3 control-label">Indeks</label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control text-center" name="Indeks" id="Indeks" value="<?php echo $Indeks ?>" placeholder="Indeks">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="Keterangan" class="col-sm-3 control-label">Keterangan</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="Keterangan" id="Keterangan" value="<?php echo $Keterangan ?>" placeholder="Keterangan">
                            <!--<textarea class="form-control" rows="1" name="Keterangan" id="Keterangan" placeholder="Keterangan"></textarea>-->
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="optAktif_1" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9" style="padding-top:8px">
                          <div class="icheck-primary d-inline">
                            <input type="radio" id="optAktif_1" name="Aktif" class="form-option" value="1" title="Status" required="required"<?php if($Aktif=="1") { echo " checked=\"checked\""; } ?>>
                            <label for="optAktif_1"> Aktif</label>
                          </div>&nbsp;&nbsp;&nbsp;
                          <div class="icheck-primary d-inline">
                            <input type="radio" id="optAktif_0" name="Aktif" class="form-option" value="0" title="Status" required="required"<?php if($Aktif=="0") { echo " checked=\"checked\""; } ?>>
                            <label for="optAktif_0"> Non Aktif</label>
                          </div>
                        </div>
                      </div>
                      
                  </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" class="btn control-save btn-success">Save</button>
                <button type="button" class="btn control-del btn-danger">Delete</button>
                <button type="button" class="btn control-close btn-warning">Close</button>
            </div>
          </form>
        </div>
        <!-- /.card -->
      </div>
    </section><br />
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
  <?php } else { echo $html_SessionEmpty; } ?>
  <?= $this->endSection() ?>