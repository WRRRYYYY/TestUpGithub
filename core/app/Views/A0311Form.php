<?= $this->extend('layout/bsa_main') ?>
<?= $this->section('main') ?>    
    <?php if(!$SessionEmpty) {  
			$KodeLama = "";
			$Kode = "";
			$KodeAlias = "";
			$KodeSeri = "-auto-";
			$ReadonlyAttr = "";
			$Nama = "";
			$TanggalLahir = date("Y\-m\-d");
			$Alamat = "";
			$Desa = "";
			$NIK = "";
			$Handphone = "-";	
			$Email = "";	
			//$KodePosisi = "";
			//$NamaPosisi = "";
			//$KodeRole = "";
			//$NamaRole = "";
			
			$GambarPath = "";
			
			$Aktif = "";
      		$chkAktif_1 = " checked=\"checked\"";
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
						$KodeLama = $oRS->Kode;
					  	$Kode = $oRS->Kode;
            			$KodeAlias = substr($oRS->Kode,0,2);    
            			$KodeSeri = substr($oRS->Kode,-3);    
            			$ReadonlyAttr = " readonly=\"readonly\"";
						$Nama = $oRS->Nama;		
					
						$Handphone = $oRS->Handphone;	
						// if(!is_null($oRS->Email))
            $Email = $oRS->Email;	
            $NIK = $oRS->NIK;
            $TanggalLahir = date("Y\-m\-d",strtotime($oRS->TanggalLahir));
            $TanggalLahir = $oRS->TanggalLahir;   
            $Alamat = $oRS->Alamat; 
            $Desa = $oRS->Desa;
						
						// $GambarPath = $oRS->GambarPath;	
						$Keterangan = $oRS->Keterangan;	
			
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
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">Form <?php echo $NamaMenu ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6 d-none">
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
            <div class="card card-primaryxxx card-outline card-tabs">
              <div class="card-header p-0 pt-1 border-bottom-0 d-none">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="tab-1-tab" data-toggle="pill" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">Data Utama</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tab-3-tab" data-toggle="pill" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false">Foto</a>
                  </li>
                </ul>
              </div>
              <form id="page_form" role="form" class="form-horizontal">
                <input type="hidden" name="KodeLama" class="form-control" value="<?php echo $KodeLama ?>" />
                <!-- <input type="hidden" name="GambarPathOri" class="form-control" value="<?php echo $GambarPath ?>" />
                <input type="hidden" name="GambarChange" class="form-control" value="0" /> -->
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab-1-tab">

                    <div class="row">
                      <div class="col-md-8">
                          <div class="form-group row">
                            <label for="Kode" class="col-sm-3 control-label">Kode</label>
                            <div class="col-sm-3">
                                <div class="input-group" style="max-width:200px">
                                    <!-- <input type="text" class="form-control text-center" style="max-width:80px" name="KodeAlias" id="KodeAlias" value="<?php echo $KodeAlias ?>" maxlength="2" placeholder="Inisial" title="Kode Inisial 2 digit" required="required"<?php echo $ReadonlyAttr ?>> -->
                                    <input type="text" class="form-control readonly-text text-center" name="KodeSeri" id="KodeSeri" value="<?php echo $KodeSeri ?>" maxlength="3" placeholder="Kode Seri" required="required" readonly="readonly">
                                </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="Nama" class="col-sm-3 col-form-label">Nama Lengkap<sup style="color:red">*</sup></label>
                            <div class="col-sm-9">
                                <input type="text" id="Nama" name="Nama" class="form-control" value="<?php echo $Nama ?>" required="required" placeholder="Enter Nama" title="Nama Lengkap">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="NIK" class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-3">
                                <input type="text" id="NIK" name="NIK" class="form-control editable-text"  value="<?php echo $NIK ?>" required="required" placeholder="NIK" title="NIK">
                            </div>
                          </div>
                          <div class="form-group row">
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
                          <label for="TanggalLahir" class="col-sm-3 control-label">Tanggal Lahir</label>
                          <div class="col-sm-3">
                              <div class="input-group input-group-date date" style="float:left !important; margin-left:2px;" id="paramdate" data-target-input="nearest">
                                <input id="TanggalLahir" name="TanggalLahir" type="text" class="form-control form-control float-left text-center datetimepicker-input" data-target="#paramdate"  data-toggle="datetimepicker" value="<?php echo $TanggalLahir ?>" />
                                <div class="input-group-append" data-target="#paramdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                </div>
                              </div>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="Alamat" class="col-sm-3 control-label">Alamat</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" name="Alamat" id="Alamat" placeholder="Alamat" requiredzzz="required" style="resize:none"><?php echo $Alamat ?></textarea>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="Desa" class="col-sm-3 control-label">Desa/Kelurahan</label>
                          <div class="col-sm-9">
                          <select id="Desa" name="Desa" class="form-control select2 float-left" requiredzzz="required" placeholder="Pilih Desa/Kel">
                        <option value="" <?php if ($Desa == "") {
                                            echo 'selected="selected"';
                                          } ?>>Pilih Desa/Kelurahan</option>
                        <?php
                        $Kecamatan = "";
                        if (isset($oQueryDesa) && count($oQueryDesa) > 0) {
                          foreach ($oQueryDesa as $oRS) {
                            if ($Kecamatan != $oRS->Kecamatan) {
                              if ($Kecamatan != "") {
                                echo '</optgroup>';
                              }
                              $Kecamatan = $oRS->Kecamatan;
                              echo '<optgroup label="KEC ' . $oRS->NamaKecamatan . ' ' . $oRS->NamaKabupaten . '">';
                            }
                            echo '<option value="' . $oRS->Kode . '" ' . ($Desa == $oRS->Kode ? 'selected="selected"' : '') . '>';
                            echo ($oRS->Kecamatan == "33.24.15" ? "KEL " : "DESA ") . $oRS->Nama . '</option>';
                          }
                          if ($Kecamatan != "") {
                            echo '</optgroup>';
                          }
                        }
                        ?>
                      </select>
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="Handphone" class="col-sm-3 col-form-label">Nomor HP</label>
                        <div class="col-sm-3">
                            <input type="text" id="Handphone" name="Handphone" class="form-control editable-text"  value="<?php echo $Handphone ?>" placeholder="Handphone" title="Handphone">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="Email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-6">
                            <input type="text" id="Email" name="Email" class="form-control editable-text"  value="<?php echo $Email ?>" placeholder="Email" title="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                          <label for="Keterangan" class="col-sm-3 control-label">Keterangan</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" rows="1" name="Keterangan" id="Keterangan" placeholder="Keterangan" style="resize:none"><?php echo $Keterangan ?></textarea>
                          </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="optAktif_1" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9" style="padding-top:8px">
                          <div class="icheck-primary d-inline">
                            <input type="radio" id="optAktif_1" name="Aktif" class="form-option" title="Status Data" value="1" required="required"<?php if($Aktif=="1") { echo " checked=\"checked\""; } ?>>
                            <label for="optAktif_1"> Aktif</label>
                          </div>&nbsp;&nbsp;&nbsp;
                          <div class="icheck-primary d-inline">
                            <input type="radio" id="optAktif_0" name="Aktif" class="form-option" title="Status Data" value="0" required="required"<?php if($Aktif=="0") { echo " checked=\"checked\""; } ?>>
                            <label for="optAktif_0"> Non Aktif</label>
                          </div>
                        </div>
                      </div>
                        </div>
                      </div>
                    </div>
				<?php 
                if($GambarPath=="") $SrcPath = "/assets/img/user-no-pic.png";
                else $SrcPath=$GambarPath;
                ?>
                  <div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="tab-3-tab">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <div id="img-container" class="img-container" style="text-align:center">
                            <img id="image" src="<?php echo base_url() .'/'. $SrcPath ?>?<?php echo rand() ?>" alt="Pilih Gambar">
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
                  <!-- <div class="tab-pane fade" id="tab-4" role="tabpanel" aria-labelledby="tab-4-tab">
                    <div class="box-body table-responsive no-padding">
                        <div style="color:#F00; text-align:center; margin-top:40px;">Pilih dahulu Role User</div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="tab-5" role="tabpanel" aria-labelledby="tab-5-tab">
                    <div class="box-body table-responsive no-padding">
                        <div style="color:#F00; text-align:center; margin-top:40px;">Pilih dahulu Role User</div>
                    </div>
                  </div> -->
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
