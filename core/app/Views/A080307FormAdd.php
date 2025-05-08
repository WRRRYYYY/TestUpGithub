<?php if(!$SessionEmpty) {  
//	$KodeLama = "";
//	$Kode = "";

//	$Tahun = date("Y");
	$DtlSeq = "-auto-";

  $Kategori = "";
  $Kabupaten = "";
  $KategoriPemohon = "";
  
	$NIK = "";
	$Nama = "";
	$NomorKK = "";
	$Alamat = "";
	$RTRW = "";
	$RT = "";
	$RW = "";
	$Desa = "";
	$Kecamatan = "";
	$Handphone = "";

	$GunaPengajuan = "";
	$NominalPengajuan = "0";
  $Rekomendasi = "";
  $EditDisabled = "0";

  $Keterangan = "";

  $TanggalProposal = "";

  $Realisasi = "";
  $RealTanggal = "";

  $TotalRow = 0;
  $FirstRec = "1";
  $LastRec= "0";
  $prefixKota = array("Provinsi Administrasi", "Provinsi", "Kota Administrasi", "Kota");

	if(isset($oQuery)) { 
		if(count($oQuery) > 0) {
			foreach($oQuery as $oRS) {
        if(!is_null($oRS->DtlSeq)) 
          $DtlSeq = $oRS->DtlSeq;
				$Kategori = $oRS->Kategori;
				$KategoriPemohon = $oRS->KategoriPemohon;
				$Kabupaten = $oRS->Kabupaten;

				$Nama = $oRS->Nama;
				$NIK = $oRS->NIK;
				$Alamat = $oRS->Alamat;
				// $RT = $oRS->RT;
				// $RW = $oRS->RW;
//				$RTRW = $oRS->RTRW;
				// $Desa = $oRS->Desa;
				// $Kecamatan = $oRS->Kecamatan;
				$Handphone = $oRS->Handphone;

				$GunaPengajuan = $oRS->GunaPengajuan;
				$NominalPengajuan = intval($oRS->Nominal);

        $Rekomendasi = $oRS->Rekomendasi;
				$Keterangan = $oRS->Keterangan;

        if(!is_null($oRS->DtlTanggal)) {
          $TanggalProposal = $oRS->DtlTanggal;
        } else {
          $TanggalProposal = $oRS->TanggalSurat;
        }

				$Realisasi = $oRS->Realisasi;
				$RealTanggal = $oRS->RealTanggal;
			}
		}
	}
	
	?>
                    <!-- <div class="modal-body"> -->
                       <input type="hidden" name="DtlSeq" class="form-control" value="<?php echo $DtlSeq ?>" /> 
                       <input type="hidden" name="ForceSave" class="form-control" value="0" /> 
                        <div class="row">
                          <div class="col-md-12">
                              <!-- <div class="form-group row">
                                <label for="optKategori_0" class="col-sm-3 col-form-label">Kategori</label>
                                <div class="col-sm-9" style="padding-top:8px">
                                  <div class="icheck-secondary d-inline">
                                    <input type="radio" id="optKategori_0" name="Kategori" class="form-option" value="0"<?php if($Kategori=="1") { echo " checked=\"checked\""; } ?>>
                                    <label for="optKategori_0"> Umum</label>
                                  </div>&nbsp;&nbsp;&nbsp;
                                  <div class="icheck-primary d-inline">
                                    <input type="radio" id="optKategori_1" name="Kategori" class="form-option" value="1"<?php if($Kategori=="0") { echo " checked=\"checked\""; } ?>>
                                    <label for="optKategori_1"> Khusus</label>
                                  </div>
                                </div>
                              </div> -->

                              <div class="form-group row">
                                  <label for="Kategori" class="col-sm-3 control-label">Kategori <sup class="text-danger">*</sup></label>
                                  <div class="col-sm-4">
                                    <select class="form-control select2 editable-combo" name="Kategori" id="Kategori" style="width: 100%;" required="required" data-placeholder="Pilih Kategori" title="Kategori">
                                        <option value=""></option>
                                        <option value="0"<?php if($Kategori=="0") { echo " selected=\"selected\""; } ?>>Umum</option>
                                        <option value="1"<?php if($Kategori=="1") { echo " selected=\"selected\""; } ?>>Khusus</option>
                                    </select>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="Kabupaten" class="col-sm-3 control-label">Kabupaten/Kota <sup class="text-danger">*</sup></label>
                                  <div class="col-sm-9">
                                    <select class="form-control select2 editable-combo" name="Kabupaten" id="Kabupaten" style="width: 100%;" required="required" data-placeholder="Pilih Kabupaten/Kota" title="Kabupaten/Kota">
                                        <option value=""></option><?php  
            if(isset($oQueryKabupaten)) {
                if(count($oQueryKabupaten) > 0) {
                    foreach($oQueryKabupaten as $oRS) {
                        $sSelected = "";
                        if($Kabupaten.","==$oRS->Kode.",") $sSelected = " selected=\"selected\""; ?>
                                        <option value="<?php echo $oRS->Kode ?>"<?php echo $sSelected ?>><?php echo $oRS->Nama ?></option>
        <?php   
                    }
                }
            } ?>
        
                                    </select>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="KategoriPemohon" class="col-sm-3 control-label">Kategori Pemohon <sup class="text-danger">*</sup></label>
                                  <div class="col-sm-4">
                                    <select class="form-control select2 editable-combo" name="KategoriPemohon" id="KategoriPemohon" style="width: 100%;" required="required" data-placeholder="Pilih Kategori" title="Kategori Pemohon">
                                        <option value=""></option><?php  
            if(isset($oQueryPemohon)) {
                if(count($oQueryPemohon) > 0) {
                    foreach($oQueryPemohon as $oRS) {
                        $sSelected = "";
                        if($KategoriPemohon.","==$oRS->Kode.",") $sSelected = " selected=\"selected\""; ?>
                                        <option value="<?php echo $oRS->Kode ?>"<?php echo $sSelected ?>><?php echo $oRS->Nama ?></option>
        <?php   
                    }
                }
            } ?>
        
                                    </select>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="Nama" class="col-sm-3 control-label">Nama Mustahiq <sup class="text-red">*</sup></label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control" name="Nama" id="Nama" value="<?php echo $Nama ?>" required="required"  maxlength="100" placeholder="Isikan Nama Mustahiq" title="Nama Mustahiq">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="NIK" class="col-sm-3 control-label">N.I.K</label>
                                  <div class="col-sm-4">
                                    <input type="text" class="form-control" name="NIK" id="NIK" value="<?php echo $NIK ?>" requiredzz="required" placeholder="Isikan NIK" title="Nomor Induk Kepegawaian (NIK)">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="GunaPengajuan" class="col-sm-3 control-label">Guna Pengajuan <sup class="text-red">*</sup></label>
                                  <div class="col-sm-9">
                                    <input name="GunaPengajuan" type="text" required="required" class="form-control" id="GunaPengajuan" value="<?php echo $GunaPengajuan ?>" maxlength="255" placeholder="Isikan Guna Pengajuan" title="Guna Pengajuan" />
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="Alamat" class="col-sm-3 control-label">Alamat <sup class="text-red">*</sup></label>
                                  <div class="col-sm-9">
                                    <input name="Alamat" type="text" required="required" class="form-control" id="Alamat" value="<?php echo $Alamat ?>" maxlength="255" placeholder="Isikan Alamat" title="Alamat" />
                                  </div>
                              </div>


                              <div class="form-group row">
                                  <label for="Handphone" class="col-sm-3 control-label">Nomor HP</label>
                                  <div class="col-sm-4">
                                    <input type="text" class="form-control" name="Handphone" id="Handphone" value="<?php echo $Handphone ?>" maxlength="20" placeholder="Isikan Nomor HP" title="Nomor HP">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="NominalPengajuan" class="col-sm-3 control-label">Nominal Pengajuan <sup class="text-red">*</sup></label>
                                  <div class="col-sm-4">
                                    <input name="NominalPengajuan" type="text" required="required" class="form-control text-right" id="NominalPengajuan" value="<?php echo $NominalPengajuan ?>" maxlength="20" placeholder="Isikan Nominal Pengajuan" title="Nominal Pengajuan" />
                                  </div>
                              </div>

                              <!-- <div class="form-group row">
                                  <label for="Rekomendasi" class="col-sm-3 control-label">Rekomendasi</label>
                                  <div class="col-sm-9">
                                    <input name="Rekomendasi" type="text" required="required" class="form-control" id="Rekomendasi" value="<?php echo $Rekomendasi ?>" maxlength="255" placeholder="Isikan Rekomendasi" title="Rekomendasi" />
                                  </div>
                              </div> -->
                              <div class="form-group row">
                                  <label for="Rekomendasi" class="col-sm-3 control-label">Rekomendasi <sup class="text-red">*</sup></label>
                                  <div class="col-sm-9">
                                    <select class="form-control select2 editable-combo" name="Rekomendasi" id="Rekomendasi" class="select2 form-control" multiple="multiple" required="required" data-placeholder="Pilih/Isikan Pemberi Rekomendasi" title="Pemberi Rekomendasi" style="width: 100%;">
                                        <?php  
            if(isset($oQueryStruktur)) {
                if(count($oQueryStruktur) > 0) {
                    foreach($oQueryStruktur as $oRS) {
                        $sSelected = "";
                        if(strpos(".".$Rekomendasi.",",".".$oRS->Kode.",",0)!==false) {
                          $sSelected = " selected=\"selected\"";
                          $Rekomendasi = str_replace($oRS->Kode.",","",$Rekomendasi.",");
                        } ?>
                                        <option value="<?php echo $oRS->Kode ?>"<?php echo $sSelected ?>><?php echo $oRS->Nama ?></option>
        <?php   
                    }
                    if($Rekomendasi!="") {
                      foreach(explode(",",$Rekomendasi) as $Rekom) {
                        if($Rekom!="") {
                      // $Rekomendasi = str_replace(",","",$Rekomendasi) ?>
                      <option value="<?php echo $Rekom ?>" selected="selected"><?php echo $Rekom ?></option>
                      <?php   
                        }
                      }
                    }
                }
            } ?>
        
                                    </select>
                                  </div>
                            </div>

                            <div class="form-group row">
                                <label for="Keterangan" class="col-sm-3 control-label">Keterangan</label>
                                <div class="col-sm-9">
                                  <input name="Keterangan" type="text" class="form-control" id="Keterangan" value="<?php echo $Keterangan ?>" maxlength="255" placeholder="Isikan Keterangan" title="Keterangan" />
                                </div>
                            </div>

                            <div class="form-group row">
                              <label for="TanggalProposal" class="col-sm-3 control-label">Tanggal Terima</label>
                              <div class="col-sm-4">
                                <div class="input-group date" id="paramdate5" data-target-input="nearest">
                                  <input id="TanggalProposal" name="TanggalProposal" type="text" class="form-control datetimepicker-input text-center" data-target="#paramdate5" value="<?php echo $TanggalProposal ?>" />
                                  <div class="input-group-append" data-target="#paramdate5" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="form-group row">
                                <label for="Realisasi" class="col-sm-3 control-label">Pentasharufan</label>
                                <div class="col-sm-4">
                                  <select class="form-control select2 editable-combo" name="Realisasi" id="Realisasi" style="width: 100%;" requiredzz="required" data-placeholder="Pilih Status Tasharuf" title="Status Tasharuf">
                                      <option value=""></option>
                                      <option value="0"<?php if($Realisasi=="0") { echo " selected=\"selected\""; } ?>>Belum</option>
                                      <option value="1"<?php if($Realisasi=="1") { echo " selected=\"selected\""; } ?>>Sudah</option>
                                  </select>
                                </div>
                            </div>

                            <div class="form-group row">
                              <label for="RealTanggal" class="col-sm-3 control-label">Tanggal Pentasharufan</label>
                              <div class="col-sm-4">
                                <div class="input-group date" id="paramdate6" data-target-input="nearest">
                                  <input id="RealTanggal" name="RealTanggal" type="text" class="form-control datetimepicker-input text-center" data-target="#paramdate6" value="<?php echo $RealTanggal ?>" />
                                  <div class="input-group-append" data-target="#paramdate6" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="form-group row mt-3">
                              <!-- <label class="col-sm-3 control-label"> </label> -->
                              <label class="col-sm-4 text-red"><sup>*</sup> Wajib diisi</label>
                            </div>
                          </div>
                        </div>
                    <!-- </div> -->
<?php } else { echo $html_SessionEmpty; } ?>
