<?php if(!$SessionEmpty) {  
//	$KodeLama = "";
//	$Kode = "";

//	$Tahun = date("Y");
	$DtlSeq = "-auto-";
  $TanggalSurat = "";
  $BisaAutoNumber = "0";
  $BisaSisip = "0";

  $Realisasi = "";
  $RealTanggal = "";

  $TotalRow = 0;
  $FirstRec = "1";
  $LastRec= "0";
  $prefixKota = array("Provinsi Administrasi", "Provinsi", "Kota Administrasi", "Kota");

	if(isset($oQuery)) { 
		if(count($oQuery) > 0) {
			foreach($oQuery as $oRS) {
                $TanggalSurat = $oRS->TanggalSurat;
                $BisaAutoNumber = $oRS->BisaAutoNumber;
                $BisaSisip = $oRS->BisaSisip;
            }

		}
	}
	
	?>
                    <!-- <div class="modal-body"> -->
                        <div class="alert alert-info alert-dismissiblezz">
                            <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
                            <!-- <h5><i class="icon fas fa-info"></i> Tanggal Surat <?= $AppClass->date_format_ina($TanggalSurat) ?></h5> -->
                            <ul style="margin-left:-25px">
                                <li>Tombol <strong>Auto</strong> untuk penomoran otomatis. Syaratnya tidak ada Nomor Surat lain setelah tanggal terpilih.</li>
                                <li>Tombol <strong>Sisip</strong> untuk penomoran sisip. Caranya, pilih  Nomor Surat pada tanggal terpilih yang akan disisipi.</li>
                                <li>Anda memilih Tanggal Surat <strong><?= $AppClass->date_format_ina($TanggalSurat) ?></strong>.
                                <br>Berikut ini adalah data Nomor Surat sampai dengan tanggal tersebut.
                                <?php if($BisaAutoNumber=="0") { ?>
                                    <br><span class="text-danger">Akan tetapi Anda <strong class="blink">tidak bisa</strong> memilih fitur <strong class="blink">Auto</strong>, 
                                    karena ada nomor surat untuk tanggal setelahnya!!!</span> 
                                <?php } ?></li>
                            </ul>
                        </div>

                       <input type="hidden" name="BisaAutoNumber" class="form-control" value="<?php echo $BisaAutoNumber ?>" /> 
                       <input type="hidden" name="BisaSisip" class="form-control" value="<?php echo $BisaSisip ?>" /> 
                       <input type="hidden" name="TanggalSuratDipilih" class="form-control" value="<?= $AppClass->date_format_ina($TanggalSurat) ?>" /> 
                       <input type="hidden" name="ForceSave" class="form-control" value="0" /> 
                        <div class="row">
                          <div class="col-md-12">
                            <table id="datatable1" class="table table-striped w-100">
                                <thead>
                                <tr>
                                    
                                    <th class="text-center">Pilih</th>
                                    <th>Nomor Surat</th>
                                    <th>Tanggal Surat</th>
                                    <th>Kepada</th>
                                    <!-- <th>Perihal</th> -->

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
                                            $sDisabled = "";
                                            if($oRS->Sisip=="1") $sDisabled = " disabled=\"disabled\"";
                                ?>
                                    <tr>
                                        <td class="text-center">
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="optNomor_<?= $oRS->RegNo ?>" name="optNomor" class="form-option" value="<?= $oRS->idx ?>"<?= $sDisabled ?>>
                                                <label for="optNomor_<?= $oRS->RegNo ?>"></label>
                                            </div>
                                        </td>
                                        <td><?php echo $oRS->NomorSurat ?></td>
                                        <td><?php echo $oRS->TanggalSurat ?></td>
                                        <td><?php echo $oRS->Kepada ?></td>
                                    </tr><?php
                                        }
                                    }
                                } ?>
                                </tbody>
                            </table>
                          </div>
                        </div>
                    <!-- </div> -->
<?php } else { echo $html_SessionEmpty; } ?>
