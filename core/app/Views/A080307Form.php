<?= $this->extend('layout/bsa_main') ?>
<?= $this->section('main') ?>
<?php if (!$SessionEmpty) {
  $KodeLama = "";
  $Kode = "";
  $Periode = date("Y");

  $RegNo = "-auto-";
  $RegTanggal = "";
  $NomorSurat = "";
  $TanggalSurat = "";
  $Pengirim = "";
  $Perihal = "";
  $Jenis = "";

  $Agenda = "0";
  $AgendaTempat = "";
  $AgendaTanggal = "";
  $AgendaDeskripsi = "";

  $Arsip = "0";
  $ArsipTanggal = "";
  $ArsipLokasi = "";

  $AjukanKe = "";
  $AjukanCC = "";
  $AjukanTanggal = "";
  $AjukanCaption = "";
  $AjukanCatatan = "";

    $Kategori = "";

  $TanggalSurat = "";
  $Kode = "";
  $TanggalPermohonan = "";
  $NomorUrut = "-auto-";
  $NomorSurat = "";
  
  $TanggalTerima = "";
  
  $NomorSurat = "";
  $Perihal = "";
  $PengajuanDari = "";
  $KategoriPemohon = "";
  $Wilayah = "";
  $WilayahSeries = "";
  $Nama = "";
  $NIK = "";
  $NomorKK = "";
  $Alamat = "";
  $RTRW = "";
  $Desa = "";
  $Kecamatan = "";
  $Handphone = "";
  
  $JenisBantuan = "";
  $JumlahPengusulan = "0";
  
  $Catatan = "";
  $Isi = "";

  $StatusDraft = "0";
  
  $EditDisabled = "0";




  $EditDisabled = "0";
  $TotalRow = 0;
  $FirstRec = "0";
  $LastRec = "0";
  $TotalDtl = 0;
  $FileName = array("");
  $FileNameOri = array("");
  $DokumenPath = array("");
  $DokumenIdx = array(0);
  $iCnt = 0;
  if (isset($oQuery)) {
    if (count($oQuery) > 0) {
      foreach ($oQuery as $oRS) {

        $KodeLama = $oRS->idx;
        $Kode = $oRS->idx;
        $Periode = $oRS->Periode;

        $RegNo = $oRS->RegNo;
        $RegTanggal = $oRS->RegTanggal;
        $NomorSurat = $oRS->NomorSurat;
        $TanggalSurat = $oRS->TanggalSurat;
        $Pengirim = $oRS->Pengirim;
        $Perihal = $oRS->Perihal;
        $Jenis = $oRS->Jenis;

        $Agenda = $oRS->Agenda;
        $AgendaTempat = $oRS->AgendaTempat;
        $AgendaTanggal = $oRS->AgendaTanggal;
        $AgendaDeskripsi = $oRS->AgendaDeskripsi;

        $Arsip = $oRS->Arsip;
        $ArsipTanggal = $oRS->ArsipTanggal;
        $ArsipLokasi = $oRS->ArsipLokasi;

        //$EditDisabled = $oRS->Ajukan;

        $FirstRec = $oRS->FirstRec;
        $LastRec = $oRS->LastRec;

        if ($iCnt < 1) { //if($iCnt<$oRS->DtlSeq) {
          while ($iCnt < 1) {   //while($iCnt<$oRS->DtlSeq) {
            $FileName[$iCnt] = "";
            $DokumenPath[$iCnt] = "";
            $DokumenIdx[$iCnt] = $iCnt;
            $iCnt++;
          }
        }
        $iCnt = 0;
        $FileName[$iCnt] = "";
        $FileNameOri[$iCnt] = "";
        $DokumenPath[$iCnt] = "";
        $DokumenIdx[$iCnt] = 0;
        if (!is_null($oRS->DokumenPath)) $DokumenPath[$iCnt] = $oRS->DokumenPath;
        if ($DokumenPath[$iCnt] != "") {
          $FileName[$iCnt] = substr($DokumenPath[$iCnt], strrpos($DokumenPath[$iCnt], "/", -1) - strlen($DokumenPath[$iCnt]) + 1);
          $FileNameOri[$iCnt] = $oRS->FileNameOri;
        }
        $iCnt++;
      }
    }
  }
  if (isset($oQueryList)) {
    $TotalDtl = count($oQueryList);
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
            <ol class="breadcrumb float-sm-right">
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
            <div class="card card-olives card-outline card-tabs">
              <div class="card-header p-0 pt-1 border-bottom-0 d-none">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link<?php if(!isset($param01)) {  ?> active<?php } ?>" id="tab-1-tab" data-toggle="pill" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">Proposal</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link<?php if($KodeLama=="") {  ?> disabled<?php } elseif(isset($param01)) {  ?> active<?php } ?>" id="tab-2-tab" data-toggle="pill" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false">Data Mustahiq</a>
                  </li>
                  <!-- <li class="nav-item">
                    <a class="nav-link" id="tab-3-tab" data-toggle="pill" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false">Foto & Dokumen</a>
                  </li> -->
                </ul>
              </div>
              <form id="page_form" role="form" class="form-horizontal">
                <input type="hidden" name="KodeLama" class="form-control" value="<?php echo $KodeLama ?>" />
                <input type="hidden" name="Periode" class="form-control" value="<?php echo $Periode ?>" /> 
                <input type="hidden" name="EditDisabled" class="form-control" value="<?php echo $EditDisabled ?>" />
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade d-none" id="tab-1" role="tabpanel" aria-labelledby="tab-1-tab">
                        <div class="alert alert-info alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <h5><i class="icon fas fa-quote-right"></i> Keterangan</h5>
                          Berikut data surat permohonan yang telah tersimpan. Untuk detail data mustahiq ada pada tab <strong>Data Mustahiq</strong>.
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group row">
                                <label for="Nama" class="col-sm-2 control-label label-data">Pengirim</label>
                                <div class="col-sm-10">
                                    <span class="control-label label-data"><?php echo $Pengirim ?></span>
                                </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                                <label for="NomorSurat" class="col-sm-4 control-label label-data">No. Surat</label>
                                <div class="col-sm-8">
                                    <span class="control-label label-data"><?php echo $NomorSurat ?></span>
                                </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                                <label for="TanggalPermohonan" class="col-sm-4 control-label label-data">Tanggal Surat</label>
                                <div class="col-sm-8">
                                    <span class="control-label label-data"><?php echo $TanggalSurat ?></span>
                                </div>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group row">
                                <label for="Perihal" class="col-sm-2 control-label label-data">Perihal</label>
                                <div class="col-sm-10">
                                    <span class="control-label label-data"><?php echo $Perihal ?></span>
                                </div>
                            </div>
                            <div class="form-group row d-none">
                                <label for="optKategori_0" class="col-sm-2 col-form-label">Kategori</label>
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
                            </div>

                            <div class="form-group row d-none">
                                <label for="KategoriPemohon" class="col-sm-2 control-label">Kategori Pemohon</label>
                                <div class="col-sm-4">
                                    <select class="form-control select2 editable-combo" name="KategoriPemohon" id="KategoriPemohon" style="width: 100%;" required="required" data-validate="1" data-placeholder="Pilih Kategori">
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
                            <div class="form-group row d-none">
                                  <label for="Nama" class="col-sm-2 control-label">Nama Pemohon</label>
                                  <div class="col-sm-9">
                                    <input name="Nama" type="text" required="required" data-validate="1" class="form-control" id="Nama" value="<?php echo $Nama ?>" maxlength="100" placeholder="Isikan Nama Pemohon" title="Nama Pemohon" />
                                  </div>
                            </div>
                            <div class="form-group row d-none">
                                  <label for="Handphone" class="col-sm-2 control-label">No. HP</label>
                                  <div class="col-sm-9">
                                    <input name="Handphone" type="text" required="required" data-validate="1" class="form-control" style="max-width:200px" id="Handphone" value="<?php echo $Handphone ?>" maxlength="20" placeholder="Isikan Nomor HP" title="Nomor HP" />
                                  </div>
                            </div>
                               <div class="form-group row d-none">
                                  <label for="JumlahPengusulan" class="col-sm-2 control-label">Jumlah Pengusulan</label>
                                  <div class="col-sm-9">
                                    <input name="JumlahPengusulan" type="text" required="required" data-validate="1" class="form-control text-right" style="max-width:200px" id="JumlahPengusulan" value="<?php echo $JumlahPengusulan ?>" readonly="readonly" placeholder="Isikan Jumlah Pengusulan" />
                                  </div>
                              </div>
                              

                                <div class="row d-none">
                                  <label for="JumlahPengusulan" class="col-sm-3 control-label">Status Proposal</label>
                                  <div class="col-9">
                                    <div class="mt-2">
                                        <div class="icheck-danger d-inline">
                                            <input type="checkbox" id="StatusDraft" name="StatusDraft" class="form-control"<?php if($EditDisabled=="1") {  ?> disabled="disabled"<?php } ?> value="1" title="Draf" <?php if($StatusDraft=="1") { echo " checked=\"checked\""; } ?>>
                                            <?php if($EditDisabled=="1") {  ?>
                                            <label for="StatusDraft"> Draf <small class="text-danger">(sudah terdisposisi)</small></label>
                                            <?php } else {  ?>
                                            <label for="StatusDraft"> Draf <small class="text-danger">(dicek/centang jika tidak ingin langsung didisposisi)</small></label>
                                            <?php }  ?>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-10 pt-5">
                               <div class="row">
                                  <div class="col-9">
					                <input type="hidden" name="TotalDtl" class="form-control" value="<?php echo $TotalDtl ?>" />
                                    <button type="button" class="btn control-close btn-warning">Close</button>
                                  </div>
                                  <div class="col-3" style="text-align:right">
									<?php if($KodeLama!="" && $TotalDtl>0) {  ?>
                                    <button type="button" class="btn btn-primary control-new">New</button>
                                    <?php } ?>
                                  </div>
                              </div>
                          </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show active" id="tab-2" role="tabpanel" aria-labelledby="tab-3-tab">
                    	<div class="row d-none" style="margin-bottom:30px">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                            	<div class="input-images"></div>
                            </div>
                      	</div>
                        <div class="form-group row">
                            <div class="col-12">
                            	<table id="datatable" class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th style="text-align:center">Aksi</th>
                                      <th>Nama</th>
                                      <th>NIK</th>
                                      <!--<th class="d-none">No. KK</th>-->
                                      <th>Alamat</th>
                                      <th>Kabupaten</th>
                                      <!--<th>No. HP</th>-->
                                      <th style="text-align:right">Nominal Usulan</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                    <?php 
                      if(isset($oQueryList)) { 
//						$TotalDtl = count($oQueryList);
                        if(count($oQueryList) > 0) { 
                          foreach($oQueryList as $oRS) {
                            $hash = hash('sha512',rand());
                            $pos = substr(rand(),0,1); 
                            $mnu = $pos . substr($hash,0,128-intval($pos)) . $AppClass->KodeMenu . substr($hash,-1*intval($pos));
                            $url_add = "/frm/cod".$oRS->idx."/";
                             ?>
									<tr>
                                      <td style="width:40px; text-align:center">
                                        <div class="btn-group" role="group" aria-label="Action Button">
                                            <a href="<?php echo  base_url() . "/" . strtolower($controller_name)."/mnu/" . substr(md5(rand()),4,7) . "/salt/" . $mnu . $url_add ?>" data-idx="<?php echo $oRS->idx."-".$oRS->DtlSeq; ?>" data-wil="<?php echo $oRS->Wilayah; ?>" class="btn btn-xs btn-info control-view" title="Lihat Data"><i class="fas fa-pen smallzz"></i></a>
                                            <a href="<?php echo $oRS->idx; ?>" data-idx="<?php echo $oRS->idx."-".$oRS->DtlSeq; ?>" class="btn btn-xs btn-danger control-del" title="Hapus Data"><i class="fas fa-trash-alt"></i></a>
                                        </div>
                                      </td>
									  <td><?php echo $oRS->Nama ?></td>
									  <td><?php if(!is_null($oRS->NIK)) { echo $oRS->NIK; } else { echo "-"; } ?></td>
									  <td><?php echo $oRS->Alamat; ?></td>
									  <td><?php echo $oRS->NamaKabupaten; ?></td>
									  <!--<td><?php if(!is_null($oRS->Handphone)) echo $oRS->Handphone;
									  else echo "-"; ?></td>-->
									  <td class="text-right"><?php echo number_format(intval($oRS->Nominal),0,",",".") ?></td>
									</tr><?php 
                          }
                    
                        }
                      } ?>
                                  </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-10 text-center"><br />
                            <button type="button" class="btn control-close btn-warning">Close</button>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
    
                <!--<div class="card-footer">
                <?php if($KodeLama=="" || $TotalDtl==0) {  ?>
                    <button type="button" class="btn control-save btn-success"<?php if(isset($param01)) {  ?> disabled<?php } ?>>Next</button>
                    <button type="button" class="btn control-close btn-warning">Cancel</button>
                <?php } else {  ?>
                    <button type="button" class="btn control-save btn-success">Save</button>
                    <button type="button" class="btn control-delete btn-danger">Delete</button>
                    <button type="button" class="btn control-close btn-warning">Close</button>
                <?php } ?>
                </div>-->
              </form>
              <!-- /.card -->
            </div>
          </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div id="modalForm" class="modal fade modalForm" role="dialog" aria-labelledby="theModalForm" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
  <!--<div class="modal fade" id="modalForm">
    <div class="modal-dialog">-->
      <div class="modal-content">
        <!--<div class="overlay d-flex justify-content-center align-items-center">
            <i class="fas fa-2x fa-sync fa-spin"></i>
        </div>-->
        <div class="modal-header bg-light">
            <h4 class="modal-title" id="theModalForm">Form Title</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
        </div>
        <div class="modal-footer bg-light">
            <div class="w-100">
        	<?php if($EditDisabled=="1") {  ?>
            	<div class="float-left"><div class="text-danger">Ket: Data tidak bisa diubah, karena proposal sudah diproses</div></div>
                <div class="float-right">
                    <button type="button" disabled="disabled" class="btn btn-success waves-effect text-left control-save-modal">Save</button>
                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                </div>
        	<?php } else {  ?>
                    <button type="button" class="btn btn-success waves-effect text-left control-save-modal">Save</button>
                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
        	<?php }  ?>
			</div>            
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<?php } else { echo $html_SessionEmpty; } ?>
<?= $this->endSection() ?>