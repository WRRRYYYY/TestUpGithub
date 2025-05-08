<?= $this->extend('layout/bsa_main') ?>
<?= $this->section('main') ?>
    <?php if(!$SessionEmpty) {  
			$KodeLama = "";
			$Kode = "";
			$ReadonlyAttr = "";
			$Nama = "";
			$Alias = "";
			$Induk = "";
			$NamaInduk = "";
			$Indeks = "";
			$Keterangan = "";
			$KodeModul = "";
			$chkKodeModul = "";
			$sClassDisabled = "";

			$HakAksesKhusus = "";	
			
			$HakAksesTambahan = "";
			$chkHakAksesTambahan = " disabled=\"disabled\"";
			$HakAksesTambahan = "";
			$chkHakAksesTambahan = " disabled=\"disabled\"";
			$chkHakAksesInstansi_All = " disabled=\"disabled\"";
			$HakAksesInstansi_All = "0";
			$chkHakAksesSeksi_All = "";
			$HakAksesSeksi_All = "0";
			
			
			$KodeController = "";
			$KodeView = "";
			
			$Aktif = "";
			$chkAktif_1 = " disabled=\"disabled\"";
			$chkAktif_0 = " disabled=\"disabled\"";
			$chkTampil_0 = " disabled=\"disabled\"";
			$chkTampil_1 = " disabled=\"disabled\"";
			$FirstRec = "1";
			$LastRec= "0";
			
			if(isset($oQuery)) {
				if(count($oQuery) > 0) {
					foreach($oQuery as $oRS) {
						$KodeLama = $oRS->Kode;		
						$Kode = $oRS->Kode;		
						$ReadonlyAttr = " readonly=\"readonly\"";
						$Nama = $oRS->Nama;		
						if(!is_null($oRS->KodeModul)) $KodeModul = $oRS->KodeModul;
						$HakAksesTambahan = $oRS->HakAksesTambahan;	
//						if($oRS->HakAksesTambahan=="1")	
//							$chkHakAksesTambahan = " checked=\"checked\" disabled=\"disabled\"";
			
						$HakAksesKhusus = $oRS->HakAksesKhusus;	
			//			if($oRS->HakAksesKhusus=="1")	
			//				$chkHakAksesKhusus = " checked=\"checked\" disabled=\"disabled\"";
			
			//			if($oRS->TotalInstansiChecked>=$oRS->TotalInstansi)	{
			//				$chkHakAksesInstansi_All = " checked=\"checked\" disabled=\"disabled\"";
			//				$HakAksesInstansi_All = "1";
			//			}
			//
			//			if($oRS->TotalSeksiChecked>=$oRS->TotalSeksi)	{
			//				$chkHakAksesSeksi_All = " checked=\"checked\"";
			//				$HakAksesSeksi_All = "1";
			//			}
						$KodeController = $oRS->KodeController;	
						$KodeView = $oRS->KodeView;	
						
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
            <div class="card card-primary card-outline card-tabs">
              <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="tab-1-tab" data-toggle="pill" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">Data Utama</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tab-2-tab" data-toggle="pill" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false">Hak Akses Menu</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link<?php if($HakAksesTambahan=="0") { echo " disabled"; } ?>" id="tab-3-tab" data-toggle="pill" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false">Hak Akses Instansi</a>
                  </li>
                  <!--<li class="nav-item">
                    <a class="nav-link<?php if($HakAksesTambahan=="0") { echo " disabled"; } ?>" id="tab-3-tab" data-toggle="pill" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false">Hak Akses Instansi</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link<?php if($HakAksesTambahan=="0") { echo " disabled"; } ?>" id="tab-4-tab" data-toggle="pill" href="#tab-4" role="tab" aria-controls="tab-4" aria-selected="false">Hak Akses Prodi</a>
                  </li>-->
                </ul>
              </div>
              <form id="page_form" role="form" class="form-horizontal">
                <input type="hidden" name="KodeLama" class="form-control" value="<?php echo $KodeLama ?>" />
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab-1-tab">

                    <div class="row">
                      <div class="col-md-8">
                          <div class="form-group row">
                            <label for="Kode" class="col-sm-3 col-form-label">Kode<sup style="color:red">*</sup></label>
                            <div class="col-sm-9">
                            	<input type="text" id="Kode" name="Kode" class="form-control" value="<?php echo $Kode ?>" required="required" placeholder="Enter Kode">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="Nama" class="col-sm-3 col-form-label">Nama<sup style="color:red">*</sup></label>
                            <div class="col-sm-9">
                                <input type="text" id="Nama" name="Nama" class="form-control" value="<?php echo $Nama ?>" required="required" placeholder="Enter Nama">
                            </div>
                          </div>
                          <div class="form-group row">
                          	<label for="optKodeModul_0" class="col-sm-3 col-form-label">Kode Modul</label>
                            <div class="col-sm-9" style="padding-top:8px">
							<?php for($i=0; $i<count($arModule); $i++) {
                                    $sSelected = "";
                                    if($KodeModul==$arModule[$i]["value"]) $sSelected = " checked=\"checked\""; ?>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="optKodeModul_<?php echo $i ?>" name="KodeModul" class="form-option" value="<?php echo $arModule[$i]["value"] ?>"<?php echo $sSelected ?>>
                                <label for="optKodeModul_<?php echo $i ?>"> <?php echo $arModule[$i]["label"] ?>
                                </label>
                              </div>&nbsp;&nbsp;&nbsp;
                            <?php } ?>
                            </div>
                          </div>
                          <div class="form-group row">
                          	<label for="optAktif_1" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9" style="padding-top:8px">
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="optAktif_1" name="Aktif" class="form-option" value="1"<?php if($Aktif=="1") { echo " checked=\"checked\""; } ?>>
                                <label for="optAktif_1"> Aktif</label>
                              </div>&nbsp;&nbsp;&nbsp;
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="optAktif_0" name="Aktif" class="form-option" value="0"<?php if($Aktif=="0") { echo " checked=\"checked\""; } ?>>
                                <label for="optAktif_0"> Non Aktif</label>
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                          	<label for="optHakAksesKhusus_1" class="col-sm-3 col-form-label">Hak Akses Khusus</label>
                            <div class="col-sm-9" style="padding-top:8px">
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="optHakAksesKhusus_1" name="HakAksesKhusus" class="form-option" value="1"<?php if($HakAksesKhusus=="1") { echo " checked=\"checked\""; } ?>>
                                <label for="optHakAksesKhusus_1"> Ya
                                </label>
                              </div>&nbsp;&nbsp;&nbsp;
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="optHakAksesKhusus_0" name="HakAksesKhusus" class="form-option" value="0"<?php if($HakAksesKhusus=="0") { echo " checked=\"checked\""; } ?>>
                                <label for="optHakAksesKhusus_0"> Tidak
                                </label>
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                          	<label for="optHakAksesTambahan_1" class="col-sm-3 col-form-label">Hak Akses Tambahan</label>
                            <div class="col-sm-9" style="padding-top:8px">
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="optHakAksesTambahan_1" name="HakAksesTambahan" class="form-option" value="1"<?php if($HakAksesTambahan=="1") { echo " checked=\"checked\""; } ?>>
                                <label for="optHakAksesTambahan_1"> Ya
                                </label>
                              </div>&nbsp;&nbsp;&nbsp;
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="optHakAksesTambahan_0" name="HakAksesTambahan" class="form-option" value="0"<?php if($HakAksesTambahan=="0") { echo " checked=\"checked\""; } ?>>
                                <label for="optHakAksesTambahan_0"> Tidak
                                </label>
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="KodeController" class="col-sm-3 col-form-label">Kode Controller<sup style="color:red">*</sup></label>
                            <div class="col-sm-9">
                            	<input type="text" id="KodeController" name="KodeController" class="form-control" value="<?php echo $KodeController ?>" maxlength="3" required="required" placeholder="Enter Kode Controller">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="KodeView" class="col-sm-3 col-form-label">Kode View<sup style="color:red">*</sup></label>
                            <div class="col-sm-9">
                            	<input type="text" id="KodeView" name="KodeView" class="form-control" value="<?php echo $KodeView ?>" maxlength="1" required="required" placeholder="Enter Kode View">
                            </div>
                          </div>
                      </div>
                      
                    </div>

                  </div>
                  <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab-2-tab">
                    <div class="box-body table-responsive no-padding">
                      <table id="datatable" class="table table-striped">
                        <thead>
                            <tr>
                              <th style="text-align:center">
                                <div class="icheck-primary d-inline">
                                    <input id="chkMenuAll" name="chkMenuAll" class="editable-check" type="checkbox" value="1">
                                    <label for="chkMenuAll">
                                    </label>
                                </div>
                              </th>
                              <th>Kode Menu</th>
                              <th>Nama Menu</th>
                              <!--<th>Keterangan</th>-->
                              <th style="text-align:center">Indeks</th>
                              <th style="text-align:center">Parent</th>
                              <th style="text-align:center">Upper-lined</th>
                            </tr>
                        </thead>
                        <tbody>
<?php 	
	$i = 0;
	if(isset($oQueryDtlList)) {
		if(count($oQueryDtlList) > 0) {
			foreach($oQueryDtlList as $oRS) {
				$i++;
				$sChecked = ""; //" disabled=\"disabled\"";
				if($oRS->Checked=="1") $sChecked .= " checked=\"checked\"";
				$sChecked_2 = ""; //" disabled=\"disabled\"";
				if($oRS->AdaSubMenu=="1") $sChecked_2 .= " checked=\"checked\"";
				$sChecked_3 = ""; //" disabled=\"disabled\"";
				if($oRS->PreSeparator=="1") $sChecked_3 .= " checked=\"checked\"";
				$sClass = "odd";
				if($i%2==0) $sClass = "even";
		?>
                            <tr>
                              <td align="center">
                                <div class="icheck-primary d-inline">
                                    <input id="chkMenu<?php echo $oRS->KodeMenu; ?>_1" name="chkMenu" class="editable-check" type="checkbox" value="<?php echo $oRS->KodeMenu ?>" <?php echo $sChecked ?>>
                                    <label for="chkMenu<?php echo $oRS->KodeMenu; ?>_1">
                                    </label>
                                </div>
                              </td>
                              <td><?php echo $oRS->KodeMenu ?></td>
                              <td><?php 
                                echo $oRS->NamaMenu;
                                if(!is_null($oRS->Keterangan) && $oRS->Keterangan!="-") { 
                                    echo "<br />(".$oRS->Keterangan.")";
                                } ?></td>
                              <td align="center"><input type="text" class="form-control form-control-sm editable-text" style="width:100%; max-width:60px; text-align:center" name="Indeks<?php echo $oRS->KodeMenu; ?>" value="<?php echo $oRS->Indeks; ?>"></td>
                              <td align="center">
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" name="chkAdaSubMenu<?php echo $oRS->KodeMenu; ?>" id="chkAdaSubMenu<?php echo $oRS->KodeMenu; ?>" class="editable-check" <?php echo $sChecked_2 ?> /><label for="chkAdaSubMenu<?php echo $oRS->KodeMenu; ?>"></label>
                                </div></td>
                              <td align="center">
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" name="chkPreSeparator<?php echo $oRS->KodeMenu; ?>" id="chkPreSeparator<?php echo $oRS->KodeMenu; ?>" class="editable-check" <?php echo $sChecked_3 ?> /><label for="chkPreSeparator<?php echo $oRS->KodeMenu; ?>"></label>
                                </div>
                              <input name="hdnChangeMenu<?php echo $oRS->KodeMenu; ?>" type="hidden" class="form-control" value="0" /></td>
                            </tr>
<?php 
			}
		}
	} ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="tab-3-tab">
                    <div class="box-body table-responsive no-padding">
                      <table id="datatable2" class="table table-striped">
                        <thead>
                            <tr>
                              <th style="text-align:center">
                                <div class="icheck-primary d-inline">
                                    <input id="chkInstansiAll" name="chkInstansiAll" class="editable-check" type="checkbox" value="1">
                                    <label for="chkInstansiAll">
                                    </label>
                                </div>
                              </th>
                              <th>Kode Instansi</th>
                              <th>Nama Instansi</th>
                              <th>Kecamatan</th>
                            </tr>
                        </thead>
                        <tbody>
<?php 	
	$i = 0;
	if(isset($oQueryDtlList02)) {
		if(count($oQueryDtlList02) > 0) {
			foreach($oQueryDtlList02 as $oRS) {
				$i++;
				$sChecked = ""; //" disabled=\"disabled\"";
				if($oRS->Checked=="1") $sChecked .= " checked=\"checked\"";
				$sClass = "odd";
				if($i%2==0) $sClass = "even";
		?>
                            <tr>
                              <td align="center">
                                <div class="icheck-primary d-inline">
                                    <input id="chkInstansi<?php echo $oRS->KodeInstansi; ?>_1" name="chkInstansi" class="editable-check" type="checkbox" value="<?php echo $oRS->KodeInstansi ?>" <?php echo $sChecked ?>>
                                    <label for="chkInstansi<?php echo $oRS->KodeInstansi; ?>_1">
                                    </label>
                                </div>
                                <input name="hdnChangeInstansi<?php echo $oRS->KodeInstansi; ?>" type="hidden" class="form-control" value="0" /></td>
                              <td><?php echo $oRS->KodeInstansi ?></td>
                              <td><?php echo $oRS->NamaInstansi; ?></td>
                              <td><?php echo $oRS->NamaKecamatan ?></td>
                            </tr>
<?php 
			}
		}
	} ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="tab-4" role="tabpanel" aria-labelledby="tab-4-tab">
                    <div class="box-body table-responsive no-padding"></div>
                  </div>
                </div>
              </div>
              <div class="card-footer" align="center">
                <button type="button" class="btn control-save btn-success">Save</button>
                <button type="button" class="btn control-del btn-danger">Delete</button>
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
<?php } else { echo $html_SessionEmpty; } ?>
<?= $this->endSection() ?>
