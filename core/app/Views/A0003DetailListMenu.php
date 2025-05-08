<?php 	
 		if(isset($oQuery)) {
            if(count($oQuery) > 0) { ?>
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
			} else { ?><ol class="breadcrumb bc-colored m-b-30 bg-danger">
                                    <li class="breadcrumb-item text-white">Pilih dahulu Role</li>
                                </ol><?php 
			}
		} ?>