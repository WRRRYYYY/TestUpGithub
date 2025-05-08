<?php 	
 		if(isset($oQuery)) {
            if(count($oQuery) > 0) { ?>
                                            <table id="table-hak-akses-desa" class="table table-hover" border="0" style="min-width:100%;">
                                                <thead>
                                                <tr>
                                                  <th style="text-align:center">
                                                    <div class="icheck-primary d-inline">
                                                        <input id="chkDesaAll" name="chkDesaAll" class="editable-check" type="checkbox" value="1">
                                                        <label for="chkDesaAll">
                                                        </label>
                                                    </div>
                                                  </th>
                                                  <th>Kode Desa</th>
                                                  <th>Nama Desa</th>
                                                  <th>Kecamatan</th>
                                                </tr>
                                                </thead>
                                                <tbody><?php 	
				$i = 0;
                foreach($oQuery as $oRS) {
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
                                                        <input id="chkDesa<?php echo $oRS->KodeDesa; ?>_1" name="chkDesa" class="editable-check" type="checkbox" value="<?php echo $oRS->KodeDesa ?>" <?php echo $sChecked ?>>
                                                        <label for="chkDesa<?php echo $oRS->KodeDesa; ?>_1">
                                                        </label>
                                                    </div>
                                                  </td>
                                                  <td><?php echo $oRS->KodeDesa ?></td>
                                                  <td><?php echo $oRS->NamaDesa; ?></td>
                                                  <td><?php echo $oRS->NamaKecamatan; ?></td>
                                                </tr><?php 
				} ?>
                                                </tbody>
                                              </table><?php 
			} else { ?><ol class="breadcrumb bc-colored m-b-30 bg-danger">
                                    <li class="breadcrumb-item text-white">Pilih dahulu Role</li>
                                </ol><?php 
			}
		} ?>