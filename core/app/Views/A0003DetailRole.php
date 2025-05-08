<?php  
if(isset($oQuery)) {
	if(count($oQuery) > 0) {
		foreach($oQuery as $oRS) {
			echo $oRS->Kode . "<!--##-->" . $oRS->Nama. "<!--##-->" . $oRS->HakAksesKhusus. "<!--##-->" . $oRS->HakAksesTambahan;
		}
	}
}
?>
