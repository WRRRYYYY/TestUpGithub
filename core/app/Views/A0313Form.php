<?= $this->extend('layout/bsa_main') ?>
<?= $this->section('main') ?>
    <?php if(!$SessionEmpty) {  
			$KodeLama = "";
			$Kode = "";
			$ReadonlyAttr = "";
			$Nama = "";
			$KodeInstansi = "";
			$NamaInstansi = "";
			$Handphone = "";	
			$Email = "";	
			$KodePosisi = "";
			$NamaPosisi = "";
			$KodeRole = "";
			$NamaRole = "";
			
			$GambarPath = "";
			$HakAksesKhusus = "";
			$HakAksesTambahan = "";
			$chkHakAksesInstansi_All = "";
			$HakAksesInstansi_All = "0";
			$chkHakAksesSeksi_All = "";
			$HakAksesSeksi_All = "0";
			
			$chkHakAksesInstansi_All = "";
			$HakAksesInstansi_All = "0";
			
			$chkHakAksesMenu_All = "";
			$HakAksesMenu_All = "0";
			
			$Aktif = "";
			$chkAktif_1 = "";
			$chkAktif_0 = "";
			$JenisKelamin = "";
			$chkJenisKelamin_L = "";
			$chkJenisKelamin_P = "";
			$FirstRec = "0";		
			$LastRec = "0";	

			$Keterangan = "-";
			$GambarPath = "";
			
			if(isset($oQuery)) {
				if(count($oQuery) > 0) {
					foreach($oQuery as $oRS) {
						$KodePerson = $oRS->KodePerson;	
						$KodeLama = $oRS->Kode;
						$Kode = $oRS->Kode;
            if(!is_null($oRS->Kode))
						  $ReadonlyAttr = " readonly=\"readonly\"";
						$Nama = $oRS->Nama;		

						$KodeInstansi = $oRS->KodeInstansi;	
//						$NamaInstansi = $oRS->NamaInstansi;	
						if(!is_null($oRS->Handphone))
							$Handphone = $oRS->Handphone;	
						if(!is_null($oRS->Email))
							$Email = $oRS->Email;	
						$KodePosisi = $oRS->KodePosisi;	
						$NamaPosisi = $oRS->NamaPosisi;	
			//			if(is_null($oRS->JabatanPosisi) && !is_null($oRS->NamaPegawai)) 
			//				$NamaPosisi .= " (" . $oRS->NamaPegawai . ")";
						$KodeRole = $oRS->KodeRole;	
						$NamaRole = $oRS->NamaRole;	
						
						$GambarPath = $oRS->GambarPath;	
						if(!is_null($oRS->Keterangan))
							$Keterangan = $oRS->Keterangan;	
			
						$HakAksesKhusus = $oRS->HakAksesKhusus;	
						$HakAksesTambahan = $oRS->HakAksesTambahan;	
						if($oRS->TotalMenuChecked>=$oRS->TotalMenu)	{
							$chkHakAksesMenu_All = " checked=\"checked\"";
							$HakAksesMenu_All = "1";
						}
			
			//			if($oRS->TotalInstansiChecked>=$oRS->TotalInstansi)	{
			//				$chkHakAksesInstansi_All = " checked=\"checked\"";
			//				$HakAksesInstansi_All = "1";
			//			}
			//
			//			if($oRS->TotalSeksiChecked>=$oRS->TotalSeksi)	{
			//				$chkHakAksesSeksi_All = " checked=\"checked\"";
			//				$HakAksesSeksi_All = "1";
			//			}
				
			
			//			if($oRS->TotalInstansiChecked>=$oRS->TotalInstansi)	{
			//				$chkHakAksesInstansi_All = " checked=\"checked\"";
			//				$HakAksesInstansi_All = "1";
			//			}
			
						$Aktif = $oRS->Aktif;	
						if($oRS->Aktif=="1")	
							$chkAktif_1 = " checked=\"checked\"";
						elseif($oRS->Aktif=="0")	
							$chkAktif_0 = " checked=\"checked\"";
			
						$JenisKelamin = $oRS->JenisKelamin;	
						if($oRS->JenisKelamin=="L")	
							$chkJenisKelamin_L = " checked=\"checked\"";
						elseif($oRS->JenisKelamin=="P")	
							$chkJenisKelamin_P = " checked=\"checked\"";
							
							
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
                  <li class="nav-item d-none">
                    <a class="nav-link<?php if($HakAksesTambahan!="1") { ?> disabled<?php } ?>" id="tab-4-tab" data-toggle="pill" href="#tab-4" role="tab" aria-controls="tab-4" aria-selected="false">Hak Akses Instansi</a>
                  </li>
                  <!--<li class="nav-item">
                    <a class="nav-link disabled" id="tab-5-tab" data-toggle="pill" href="#tab-5" role="tab" aria-controls="tab-5" aria-selected="false">Hak Akses Desa</a>
                  </li>-->
                  <li class="nav-item">
                    <a class="nav-link" id="tab-3-tab" data-toggle="pill" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false">Foto</a>
                  </li>
                </ul>
              </div>
              <form id="page_form" role="form" class="form-horizontal">
                <input type="hidden" name="KodeLama" class="form-control" value="<?php echo $KodeLama ?>" />
                <input type="hidden" name="KodePerson" class="form-control" value="<?php echo $KodePerson ?>" />
                <input type="hidden" name="KodePosisi" class="form-control" value="<?php echo $KodePosisi ?>" />
                <input type="hidden" name="GambarPathOri" class="form-control" value="<?php echo $GambarPath ?>" />
                <input type="hidden" name="GambarChange" class="form-control" value="0" />
                <input name="HakAksesKhusus" type="hidden" class="form-control" value="<?php echo $HakAksesKhusus ?>" />
                <input name="HakAksesTambahan" type="hidden" class="form-control" value="<?php echo $HakAksesTambahan ?>" />
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab-1-tab">

                    <div class="row">
                      <div class="col-md-8">
                          <div class="form-group row">
                            <label for="Nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input type="text" id="Nama" name="Nama" class="form-control" value="<?php echo $Nama ?>" placeholder="Enter Nama" title="Nama Lengkap" readonly="readonly">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="NamaPosisi" class="col-sm-3 col-form-label">Posisi Saat ini</label>
                            <div class="col-sm-9">
                                <input type="text" id="NamaPosisi" name="NamaPosisi" class="form-control" value="<?php echo $NamaPosisi ?>" placeholder="Posisi" title="Posisi" readonly="readonly">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="Kode" class="col-sm-3 col-form-label">User ID<sup style="color:red">*</sup></label>
                            <div class="col-sm-9">
                            	<input type="text" id="Kode" name="Kode" class="form-control" value="<?php echo $Kode ?>" required="required" placeholder="Enter User ID" title="User ID"<?php echo $ReadonlyAttr ?>>
                            </div>
                          </div>
                          <div class="form-group row d-none">
                          	<label for="optJenisKelamin_L" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9" style="padding-top:8px">
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="optJenisKelamin_L" name="JenisKelamin" class="form-option" value="L"<?php echo $chkJenisKelamin_L; ?>>
                                <label for="optJenisKelamin_L"> Laki-laki</label>
                              </div>&nbsp;&nbsp;&nbsp;
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="optJenisKelamin_P" name="JenisKelamin" class="form-option" value="P"<?php echo $chkJenisKelamin_P;  ?>>
                                <label for="optJenisKelamin_P"> Perempuan</label>
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                              <label for="KodeRole" class="col-sm-3 control-label">Role<sup style="color:red">*</sup></label>
                              <div class="col-sm-9">
                                <select class="form-control select2 editable-combo" name="KodeRole" id="KodeRole" style="width: 100%;" required="required" title="Role User">
                                    <option value="">Pilih Role</option><?php 	
        if(isset($oQueryRole)) {
            if(count($oQueryRole) > 0) {
                foreach($oQueryRole as $oRS) {
                    $sSelected = "";
                    if($KodeRole==$oRS->Kode) $sSelected = " selected=\"selected\""; ?>
                                    <option value="<?php echo $oRS->Kode ?>"<?php echo $sSelected ?>><?php echo $oRS->Nama ?></option>
    <?php 	
                }
            }
        } ?>
    
                                </select>
                              </div>
                          </div>
                          <div class="form-group row">
                            <label for="Password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" id="Password" name="Password" class="form-control editable-text" placeholder="Password">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="Password2" class="col-sm-3 col-form-label">Konfirm Password</label>
                            <div class="col-sm-9">
                                <input type="password" id="Password2" name="Password2" class="form-control editable-text" placeholder="Konfirmasi Password">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="Email" class="col-sm-3 col-form-label">Email<sup style="color:red">*</sup></label>
                            <div class="col-sm-9">
                                <input type="text" id="Email" name="Email" class="form-control editable-text"  value="<?php echo $Email ?>" placeholder="Email" title="Email">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="NomorHP" class="col-sm-3 col-form-label">Nomor HP</label>
                            <div class="col-sm-9">
                                <input type="text" id="NomorHP" name="NomorHP" class="form-control editable-text"  value="<?php echo $Handphone ?>" placeholder="Nomor HP" title="Nomor HP">
                            </div>
                          </div>
                          <div class="form-group row">
                          	<label for="optAktif_1" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9" style="padding-top:8px">
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="optAktif_1" name="Aktif" class="form-option" value="1" required="required" title="Status User"<?php if($Aktif=="1") { echo " checked=\"checked\""; } ?>>
                                <label for="optAktif_1"> Aktif</label>
                              </div>&nbsp;&nbsp;&nbsp;
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="optAktif_0" name="Aktif" class="form-option" value="0" required="required" title="Status User"<?php if($Aktif=="0") { echo " checked=\"checked\""; } ?>>
                                <label for="optAktif_0"> Non Aktif</label>
                              </div>
                            </div>
                          </div>
                      </div>
                      
                    </div>

                  </div>
                  <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab-2-tab">
                    <div id="list_mnu" class="box-body table-responsive no-padding">
<?php  		if(isset($oQueryDtlList)) {
      	      if(count($oQueryDtlList) > 0) { ?>
                                            <table id="table-hak-akses" class="table table-hover" border="0">
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
                                                </tr>
                                                </thead>
                                                <tbody><?php 	
				$i = 0;
                foreach($oQueryDtlList as $oRS) {
                    $i++;
                    $sChecked = ""; //" disabled=\"disabled\"";
                    $lblChecked = "-";
                    if($oRS->Checked=="1") {
                        $sChecked .= " checked=\"checked\"";
                        $lblChecked = "<i class=\"mdi mdi-check\"></i>";
                    }
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
//                                                    if(!is_null($oRS->Keterangan) && $oRS->Keterangan!="-") { 
//                                                        echo "<br />(".$oRS->Keterangan.")";
//                                                    } ?></td>
                                                </tr><?php 
				} ?>
                                                </tbody>
                                              </table><?php 
			} else { ?>
                        <div style="color:#F00; text-align:center; margin-top:40px;">Pilih dahulu Role User</div><?php 
			}
		} else {?>
                        <div style="color:#F00; text-align:center; margin-top:40px;">Pilih dahulu Role User</div>
<?php 	} ?>
                    </div>
                  </div>
				<?php 
                if($GambarPath=="") $SrcPath = "assets/img/user-no-pic.png";
                else $SrcPath=$GambarPath;
                ?>
                  <div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="tab-3-tab">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <div id="img-container" class="img-container" style="text-align:center">
                            <img id="image" src="<?php echo base_url() . "/" . $SrcPath ?>?<?php echo rand() ?>" alt="Pilih Gambar">
                          </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="row">
                            <div class="col-md-12 col-sm-6 col-xs-6" style="display:none">
                            
                              <div class="docs-preview clearfix">
                                <div class="img-preview preview-lg"></div>
                              </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="toolbar" style="text-align:center; margin-top:20px">
                                  <div class="btn-group" style="text-align:center; margin:auto">
                                    <label class="btn btn-success btn-upload editable-button" for="inputImage" title="Upload image file">
                                      <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
                                      <span class="docs-tooltip" data-toggle="tooltip" title="Import image with Blob URLs">
                                        <span class="fa fa-upload"></span>&nbsp;&nbsp;Pilih Gambar
                                      </span>
                                    </label>
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="tab-pane fade" id="tab-4" role="tabpanel" aria-labelledby="tab-4-tab">
                    <div id="list_desa" class="box-body table-responsive no-padding">
<?php  		if(isset($oQueryDtlList)) {
      	      if(count($oQueryDtlList) > 0) { ?>
                        <table id="table-hak-akses-desa" class="table table-striped">
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
	if(isset($oQueryDtlListInstansi)) {
		if(count($oQueryDtlListInstansi) > 0) {
			foreach($oQueryDtlListInstansi as $oRS) {
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
                      </table><?php 
			} else { ?>
                        <div style="color:#F00; text-align:center; margin-top:40px;">Pilih dahulu Role User</div><?php 
			}
		} else {?>
                        <div style="color:#F00; text-align:center; margin-top:40px;">Pilih dahulu Role User</div>
<?php 	} ?>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="tab-5" role="tabpanel" aria-labelledby="tab-5-tab">
                    <div class="box-body table-responsive no-padding">
                        <div style="color:#F00; text-align:center; margin-top:40px;">Pilih dahulu Role User</div>
                    </div>
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
