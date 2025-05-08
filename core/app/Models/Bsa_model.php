<?php

namespace App\Models;
use CodeIgniter\Model;

class Bsa_model extends Model
{
    // ...
	/**
     * Called during initialization. Appends
     * our custom field to the module's model.
     */
//    protected function initialize()
//    {
//        $this->allowedFields[] = 'middlename';
//    }

	protected $DBGroup = 'default';
	
	public function tes($Kode){
		$query=$this->db->query("CALL spDesaList('".$Kode."');");
		$result = $query->getResult();
        return $result;
	}
	public function init_app(){
		$query=$this->db->query("CALL spABSInit();");
		$result = $query->getResult();
        return $result;
	}
	public function init_app_module(){
		$query=$this->db->query("CALL spABSListModule();");
		$result = $query->getResult();
        return $result;
	}
	public function get_app_data($AppModule,$KodeUser,$ObjName){
		$query=$this->db->query("CALL spABSData".$ObjName."('" . $AppModule . "','".$KodeUser."');");
		$result = $query->getResult();
        return $result;
//		return "CALL spABSData".$ObjName."('" . $AppModule . "','".$KodeUser."');";
	}
	public function get_menu_list($AppModule,$KodeUser,$KodeInduk){
		$query=$this->db->query("CALL spABSUserMenu('" . $AppModule . "','".$KodeUser."','".$KodeInduk."');");
		$result = $query->getResult();
        return $result;
	}
	public function get_menu_list_all($AppModule,$KodeUser){
		$query=$this->db->query("CALL spABSUserMenuAll('" . $AppModule . "','".$KodeUser."');");
		$result = $query->getResult();
        return $result;
//		return "CALL spUserMenuAll('" . $AppModule . "','".$KodeUser."');";
	}
	public function get_menu_detail($AppModule,$KodeUser,$KodeMenu){
		$query=$this->db->query("CALL spABSUserMenuDetail('" . $AppModule . "','".$KodeUser."','".$KodeMenu."');");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		echo "CALL spABSUserMenuDetail('" . $AppModule . "','".$KodeUser."','".$KodeMenu."');";
	}
	// New designed for HELPDESK
	public function get_submenu_default($AppModule,$KodeUser,$KodeInduk){
		$query=$this->db->query("CALL spUserMenuSubMenuDefault('" . $AppModule . "','".$KodeUser."','".$KodeInduk."');");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
	}

	public function do_login($AppModule,$KodeUser,$IPAddress,$UserAgent){
		$query=$this->db->query("call spABSUserLogin('" . $AppModule . "','" . $KodeUser . "','" . $IPAddress . "','" . $UserAgent . "');");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "call spABSUserLogin('" . $AppModule . "','" . $KodeUser . "','" . $IPAddress . "','" . $UserAgent . "');";
	}

	public function do_loginsso($AppModule,$Email,$IPAddress,$UserAgent){
		$query=$this->db->query("call spABSUserLoginSSO('" . $AppModule . "','" . $Email . "','" . $IPAddress . "','" . $UserAgent . "');");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
		// return "call spABSUserLoginSSO('" . $AppModule . "','" . $Email . "','" . $IPAddress . "','" . $UserAgent . "');";
	}

	public function ins_log_record($AppModule,$KodeUser,$IPAddress,$UserAgent){
	    $this->db->query("call spABSUserLogRecord('" . $AppModule . "','" . $KodeUser . "','signed out','" . $IPAddress . "','" . $UserAgent . "');");
//		return "call spABSUserLogRecord('" . $AppModule . "','" . $KodeUser . "','signed out','" . $IPAddress . "','" . $UserAgent . "');";
	}
	public function chg_pwd($AppModule,$KodeUser,$PasswordLama,$PasswordBaru,$IPAddress,$UserAgent){
		$query=$this->db->query("CALL spABSUserGantiPwd('" . $AppModule . "','" . $KodeUser . "','" . $PasswordLama ."','" . $PasswordBaru ."','" . $IPAddress . "','" . $UserAgent . "');");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "CALL spABSUserGantiPwd('" . $AppModule . "','" . $KodeUser . "','" . $PasswordLama ."','" . $PasswordBaru ."','" . $IPAddress . "','" . $UserAgent . "');";
	}
	public function get_user_detail($AppModule,$KodeUser){
		$query=$this->db->query("CALL spABSUserDetail('" . $AppModule . "','".$KodeUser."');");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
	}
	public function get_user_log_list($AppModule,$KodeUser){
		$query=$this->db->query("CALL spABSUserLogList('" . $AppModule . "','".$KodeUser."');");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
	}
	public function get_image($AppModule,$KodeImage){
		$query=$this->db->query("CALL spABSImageGet('".$AppModule."','".$KodeImage."');");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "CALL spImageGet('".$AppModule."','".$KodeImage."');";
	}
	public function get_image_ext($AppModule,$Extended,$KodeImage){
		$query=$this->db->query("CALL sp".$Extended."GetImage('".$AppModule."','".$KodeImage."');");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
	}
	public function get_image_thumb($AppModule,$Extended,$KodeImage){
		$query=$this->db->query("CALL sp".$Extended."GetImageThumb('".$AppModule."','".$KodeImage."');");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
	}
	public function get_image_user($AppModule,$KodeUser){
		$query=$this->db->query("CALL spABSUserGetImage('".$AppModule."','".$KodeUser."');");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "CALL spUserGetImage('".$AppModule."','".$KodeUser."');";
	}
	public function get_data_system_info_list($AppModule,$Params){
		$query=$this->db->query("CALL spABSSystemInfoList('" . $AppModule . "',".$Params.");");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
	}
	public function get_data_list_cnt($AppModule,$KodeMenu,$Params){
		$query=$this->db->query("CALL sp".$KodeMenu."ListCount('" . $AppModule . "',".$Params.");");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "CALL sp".$KodeMenu."ListCount('" . $AppModule . "',".$Params.");";
	}

	public function get_data_list($AppModule,$KodeMenu,$Params){
		if($Params=='')
			$query=$this->db->query("CALL sp".$KodeMenu."List('" . $AppModule . "');");
		else
			$query=$this->db->query("CALL sp".$KodeMenu."List('" . $AppModule . "',".$Params.");");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "CALL sp".$KodeMenu."List('" . $AppModule . "',".$Params.");";
	}
	public function get_data_list_ext($AppModule,$KodeMenu,$Ext,$Params){
		if($Params=='')
			$query=$this->db->query("CALL sp".$KodeMenu."List".$Ext."('" . $AppModule . "');");
		else
			$query=$this->db->query("CALL sp".$KodeMenu."List".$Ext."('" . $AppModule . "',".$Params.");");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "CALL sp".$KodeMenu."List".$Ext."('" . $AppModule . "',".$Params.");";
	}
	public function get_data_detail($AppModule,$KodeMenu,$Params){
		if($Params=='')
			$query=$this->db->query("CALL sp".$KodeMenu."Detail('" . $AppModule . "');");
		else
			$query=$this->db->query("CALL sp".$KodeMenu."Detail('" . $AppModule . "',".$Params.");");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "CALL sp".$KodeMenu."Detail('" . $AppModule . "',".$Params.");";
	}
	public function get_data_detail_ext($AppModule,$KodeMenu,$Extended,$Params){
		$query=$this->db->query("CALL sp".$KodeMenu."Detail".$Extended."('" . $AppModule . "',".$Params.");");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
		//return "CALL sp".$KodeMenu."Detail".$Extended."('" . $AppModule . "',".$Params.");";
	}
	public function get_detail_list($AppModule,$KodeMenu,$ListName,$Params){
		$query=$this->db->query("CALL sp".$KodeMenu."DetailList".$ListName."('" . $AppModule . "',".$Params.");");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "CALL sp".$KodeMenu."DetailList".$ListName."('" . $AppModule . "',".$Params.");";
	}
	public function get_pop_list($AppModule,$KodeMenu,$PopUpElement){
		$query=$this->db->query("CALL sp".$KodeMenu."List".$PopUpElement."('" . $AppModule . "');");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "CALL sp".$KodeMenu."List".$PopUpElement."('" . $AppModule . "');";
	}
	public function get_pop_list_ext($AppModule,$KodeMenu,$PopUpElement,$Params){
		$query=$this->db->query("CALL sp".$KodeMenu."List".$PopUpElement."('" . $AppModule . "',".$Params.");");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "CALL sp".$KodeMenu."List".$PopUpElement."('" . $AppModule . "',".$Params.");";
	}
	public function get_combo_list_($AppModule,$ComboElement){
		$query=$this->db->query("CALL sp".$ComboElement."List('" . $AppModule . "');");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "CALL sp".$ComboElement."List('" . $AppModule . "');";
	}
	public function get_combo_list($AppModule,$ComboElement,$Params){
		$query=$this->db->query("CALL sp".$ComboElement."List('" . $AppModule . "',".$Params.");");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "CALL sp".$ComboElement."List('" . $AppModule . "',".$Params.");";
	}



	public function get_xls_list($AppModule,$KodeMenu,$Doc,$Params){
		if($Params=='')
			$query=$this->db->query("CALL sp".$KodeMenu."XLS".$Doc."List('" . $AppModule . "');");
		else
			$query=$this->db->query("CALL sp".$KodeMenu."XLS".$Doc."List('" . $AppModule . "',".$Params.");");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
        
        //return "CALL sp".$KodeMenu."XLS".$Doc."List('" . $AppModule . "',".$Params.");";
	}
	public function get_xls_hdr($AppModule,$KodeMenu,$Doc,$Params){
		if($Params=='')
			$query=$this->db->query("CALL sp".$KodeMenu."XLS".$Doc."Hdr('" . $AppModule . "');");
		else
			$query=$this->db->query("CALL sp".$KodeMenu."XLS".$Doc."Hdr('" . $AppModule . "',".$Params.");");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
	}

	public function get_print_list($AppModule,$KodeMenu,$Doc,$Params){
		if($Params=='')
			$query=$this->db->query("CALL sp".$KodeMenu."Print".$Doc."List('" . $AppModule . "');");
		else
			$query=$this->db->query("CALL sp".$KodeMenu."Print".$Doc."List('" . $AppModule . "',".$Params.");");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
	}
	public function get_print_hdr($AppModule,$KodeMenu,$Doc,$Params){
		if($Params=='')
			$query=$this->db->query("CALL sp".$KodeMenu."Print".$Doc."Hdr('" . $AppModule . "');");
		else
			$query=$this->db->query("CALL sp".$KodeMenu."Print".$Doc."Hdr('" . $AppModule . "',".$Params.");");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
	}

	public function get_pdf_list($AppModule,$KodeMenu,$Doc,$Params){
		if($Params=='')
			$query=$this->db->query("CALL sp".$KodeMenu."PDF".$Doc."List('" . $AppModule . "');");
		else
			$query=$this->db->query("CALL sp".$KodeMenu."PDF".$Doc."List('" . $AppModule . "',".$Params.");");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
	}
	public function get_pdf_hdr($AppModule,$KodeMenu,$Doc,$Params){
		if($Params=='')
			$query=$this->db->query("CALL sp".$KodeMenu."PDF".$Doc."Hdr('" . $AppModule . "');");
		else
			$query=$this->db->query("CALL sp".$KodeMenu."PDF".$Doc."Hdr('" . $AppModule . "',".$Params.");");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
	}


	public function process_data($AppModule,$KodeMenu,$Params,$IPAddress,$UserAgent){
		$query=$this->db->query("CALL sp".$KodeMenu."Process('" . $AppModule . "',".$Params.",'" . $IPAddress . "','" . $UserAgent . "');");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "CALL sp".$KodeMenu."Process('" . $AppModule . "',".$Params.",'" . $IPAddress . "','" . $UserAgent . "');";
	}
	public function save_data($AppModule,$KodeMenu,$Params,$IPAddress,$UserAgent,$Extended=""){
		$query=$this->db->query("CALL sp".$KodeMenu."Save".$Extended."('" . $AppModule . "',".$Params.",'" . $IPAddress . "','" . $UserAgent . "');");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "CALL sp".$KodeMenu."Save".$Extended."('" . $AppModule . "',".$Params.",'" . $IPAddress . "','" . $UserAgent . "');";
	}
	public function save_data_ext_notusedanymore($AppModule,$KodeMenu,$Extended,$Params,$IPAddress,$UserAgent){
		$query=$this->db->query("CALL sp".$KodeMenu."Save".$Extended."('" . $AppModule . "',".$Params.",'" . $IPAddress . "','" . $UserAgent . "');");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "CALL sp".$KodeMenu."Save".$Extended."('" . $AppModule . "',".$Params.",'" . $IPAddress . "','" . $UserAgent . "');";
	}
	public function del_data_ori($AppModule,$KodeMenu,$Params){
		$query=$this->db->query("CALL sp".$KodeMenu."Del('" . $AppModule . "',".$Params.");");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "CALL sp".$KodeMenu."Del('" . $AppModule . "',".$Params.");";
	}
	public function del_data($AppModule,$KodeMenu,$Params,$IPAddress,$UserAgent){
		$query=$this->db->query("CALL sp".$KodeMenu."Del('" . $AppModule . "',".$Params.",'" . $IPAddress . "','" . $UserAgent . "');");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "CALL sp".$KodeMenu."Del('" . $AppModule . "',".$Params.",'" . $IPAddress . "','" . $UserAgent . "');";
	}
	public function del_data_dtl_ori($AppModule,$KodeMenu,$Params){
		$query=$this->db->query("CALL sp".$KodeMenu."DelDtl('" . $AppModule . "',".$Params.");");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "CALL sp".$KodeMenu."DelDtl('" . $AppModule . "',".$Params.");";
	}
	public function del_data_dtl($AppModule,$KodeMenu,$Params,$IPAddress,$UserAgent){
		$query=$this->db->query("CALL sp".$KodeMenu."DelDtl('" . $AppModule . "',".$Params.",'" . $IPAddress . "','" . $UserAgent . "');");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "CALL sp".$KodeMenu."DelDtl('" . $AppModule . "',".$Params.",'" . $IPAddress . "','" . $UserAgent . "');";
	}
	public function del_data_dtl_img($AppModule,$KodeMenu,$Params,$IPAddress,$UserAgent){
		$query=$this->db->query("CALL sp".$KodeMenu."DelDtlImg('" . $AppModule . "',".$Params.",'" . $IPAddress . "','" . $UserAgent . "');");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "CALL sp".$KodeMenu."DelDtl('" . $AppModule . "',".$Params.",'" . $IPAddress . "','" . $UserAgent . "');";
	}
	public function del_dataimg_ori($AppModule,$KodeMenu,$Params){
		$query=$this->db->query("CALL sp".$KodeMenu."DelImg('" . $AppModule . "',".$Params.");");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "CALL sp".$KodeMenu."DelImg('" . $AppModule . "',".$Params.");";
	}
	public function del_dataimg($AppModule,$KodeMenu,$Params,$IPAddress,$UserAgent){
		$query=$this->db->query("CALL sp".$KodeMenu."DelImg('" . $AppModule . "',".$Params.",'" . $IPAddress . "','" . $UserAgent . "');");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "CALL sp".$KodeMenu."DelImg('" . $AppModule . "',".$Params.",'" . $IPAddress . "','" . $UserAgent . "');";
	}
	public function upload_img($AppModule,$KodeMenu,$KodeImg,$ImgData,$Ext,$KodeUser){
		$this->db->query("CALL sp".$KodeMenu."SetImage('" . $AppModule . "','" . $KodeImg . "','" . $ImgData . "','" . $Ext . "','" . $KodeUser ."');");
//		$query=$this->db->query("CALL sp".$KodeMenu."SetImage('" . $AppModule . "','" . $KodeImg . "','" . $ImgData . "','" . $Ext . "','" . $KodeUser ."');");
//		//return $query->result();
//		$result = $query->result();
//        $query->next_result();
//        $query->free_result();
//        //return $query->result();
//        return $result;
	}
	
	public function upload_img_db($AppModule,$KodeMenu,$Extended,$KodeImg,$ImgData,$Ext,$KodeUser){
//		$this->db->query("CALL sp".$KodeMenu."SetImage".$Extended."('" . $AppModule . "','" . $KodeImg . "','" . $ImgData . "','" . $Ext . "','" . $KodeUser ."');");
		$query=$this->db->query("CALL sp".$KodeMenu."SetImage".$Extended."('" . $AppModule . "','" . $KodeImg . "','" . $ImgData . "','" . $Ext . "','" . $KodeUser ."');");
//		//return $query->result();
//		$result = $query->result();
//        $query->next_result();
//        $query->free_result();
//        //return $query->result();
//        return $result;
//		return "CALL sp".$KodeMenu."SetImage".$Extended."('" . $AppModule . "','" . $KodeImg . "','" . $ImgData . "','" . $Ext . "','" . $KodeUser ."');";
	}
	public function upload_img_db_path($AppModule,$KodeMenu,$KodeImg,$ImagePath,$ThumbnailPath,$KodeUser){
		$this->db->query("CALL sp".$KodeMenu."SetImagePath('" . $AppModule . "','" . $KodeImg . "','" . $ImagePath . "','" . $ThumbnailPath . "','" . $KodeUser ."');");
//		return "CALL sp".$KodeMenu."SetImagePath('" . $AppModule . "','" . $KodeImg . "','" . $ImagePath . "','" . $ThumbnailPath . "','" . $KodeUser ."');";
	}

	public function upload_img_db_path_ext($AppModule,$KodeMenu,$Kode,$Seq,$ImagePath,$ThumbnailPath,$KodeUser){
		$this->db->query("CALL sp".$KodeMenu."SetImagePath('" . $AppModule . "','" . $Kode . "','" . $Seq . "','" . $ImagePath . "','" . $ThumbnailPath . "','" . $KodeUser ."');");
//		return "CALL sp".$KodeMenu."SetImagePath('" . $AppModule . "','" . $Kode . "','" . $Seq . "','" . $ImagePath . "','" . $ThumbnailPath . "','" . $KodeUser ."');";
	}

	public function upload_doc_db_path($AppModule,$KodeMenu,$Kode,$DocumentPath,$Ext,$Size,$Image,$KodeUser){
		$this->db->query("CALL sp".$KodeMenu."SetDocumentPath('" . $AppModule . "','" . $Kode . "','" . $DocumentPath . "','" . $Ext . "','" . $Size . "','" . $Image . "','" . $KodeUser ."');");
////        return "CALL sp".$KodeMenu."SetDocumentPath('" . $AppModule . "','" . $Kode . "','" . $DocumentPath . "','" . $Ext . "','" . $Size . "','" . $Image . "','" . $KodeUser ."');";
	}
	public function upload_docv2_db_path($AppModule,$KodeMenu,$Kode,$DocumentPath,$FileNameOri,$Ext,$Size,$Image,$KodeUser){
		$this->db->query("CALL sp".$KodeMenu."SetDocumentPath('" . $AppModule . "','" . $Kode . "','" . $DocumentPath . "','" . $FileNameOri . "','" . $Ext . "','" . $Size . "','" . $Image . "','" . $KodeUser ."');");
//		return "CALL sp".$KodeMenu."SetDocumentPath('" . $AppModule . "','" . $Kode . "','" . $DocumentPath . "','" . $FileNameOri . "','" . $Ext . "','" . $Size . "','" . $Image . "','" . $KodeUser ."');";
	}
	public function upload_doc_db_path_ext($AppModule,$KodeMenu,$Kode,$DocIdx,$DocumentPath,$Ext,$Size,$Image,$KodeUser){
		$this->db->query("CALL sp".$KodeMenu."SetDocumentPath('" . $AppModule . "','" . $Kode . "','" . $DocIdx . "','" . $DocumentPath . "','" . $Ext . "','" . $Size . "','" . $Image . "','" . $KodeUser ."');");
//		return "CALL sp".$KodeMenu."SetDocumentPath('" . $AppModule . "','" . $Kode . "','" . $DocIdx . "','" . $DocumentPath . "','" . $Ext . "','" . $Size . "','" . $Image . "','" . $KodeUser ."');";
	}
	public function upload_docv2_db_path_ext($AppModule,$KodeMenu,$Kode,$DocIdx,$DocumentPath,$FileNameOri,$Ext,$Size,$Image,$KodeUser){
		$this->db->query("CALL sp".$KodeMenu."SetDocumentPath('" . $AppModule . "','" . $Kode . "','" . $DocIdx . "','" . $DocumentPath . "','" . $FileNameOri . "','" . $Ext . "','" . $Size . "','" . $Image . "','" . $KodeUser ."');");
//		return "CALL sp".$KodeMenu."SetDocumentPath('" . $AppModule . "','" . $Kode . "','" . $DocIdx . "','" . $DocumentPath . "','" . $FileNameOri . "','" . $Ext . "','" . $Size . "','" . $Image . "','" . $KodeUser ."');";
	}

	public function upload_doc_db_path_extplus($AppModule,$KodeMenu,$Kode,$DocIdx,$Attrib,$DocumentPath,$Ext,$Size,$Image,$KodeUser){
		$this->db->query("CALL sp".$KodeMenu."SetDocumentPath('" . $AppModule . "','" . $Kode . "','" . $DocIdx . "','" . $Attrib . "','" . $DocumentPath . "','" . $Ext . "','" . $Size . "','" . $Image . "','" . $KodeUser ."');");
//		return "CALL sp".$KodeMenu."SetDocumentPath('" . $AppModule . "','" . $Kode . "','" . $DocIdx . "','" . $DocumentPath . "','" . $Ext . "','" . $Size . "','" . $Image . "','" . $KodeUser ."');";
	}

	public function upload_img_dbplus($AppModule,$KodeMenu,$Extended,$KodeImg,$ImgData,$ImgDataThumb,$Ext,$KodeUser){
		$query=$this->db->query("CALL sp".$KodeMenu."SetImagePlus".$Extended."('" . $AppModule . "','" . $KodeImg . "','" . $ImgData . "','" . $ImgDataThumb . "','" . $Ext . "','" . $KodeUser ."');");
		$result = $query->getResult();
        //return $query->result();
        return $result;
	}

	public function remove_doc_db_path($AppModule,$KodeMenu,$Kode,$KodeUser){
		$this->db->query("CALL sp".$KodeMenu."SetDocumentPath('" . $AppModule . "','" . $Kode . "','','',0,'','" . $KodeUser ."');");
//		$query=$this->db->query("CALL sp".$KodeMenu."SetDocumentPath('" . $AppModule . "','" . $Kode . "','','','','','" . $KodeUser ."');");
//		//return $query->result();
//		$result = $query->result();
//        $query->next_result();
//        $query->free_result();
//        //return $query->result();
//        return $result;
//		return "CALL sp".$KodeMenu."SetDocumentPath('" . $AppModule . "','" . $Kode . "','','','','','" . $KodeUser ."');";
	}
	public function remove_docv2_db_path($AppModule,$KodeMenu,$Kode,$KodeUser){
		$this->db->query("CALL sp".$KodeMenu."SetDocumentPath('" . $AppModule . "','" . $Kode . "','','','',0,'','" . $KodeUser ."');");
	}
	public function remove_doc_db_path_ext($AppModule,$KodeMenu,$Kode,$DocIdx,$KodeUser){
		$this->db->query("CALL sp".$KodeMenu."SetDocumentPath('" . $AppModule . "','" . $Kode . "','" . $DocIdx . "','','',0,'','" . $KodeUser ."');");
//		$query=$this->db->query("CALL sp".$KodeMenu."SetDocumentPath('" . $AppModule . "','" . $Kode . "','" . $DocIdx . "','','','','','" . $KodeUser ."');");
//		//return $query->result();
//		$result = $query->result();
//        $query->next_result();
//        $query->free_result();
//        //return $query->result();
//        return $result;
//		return "CALL sp".$KodeMenu."SetDocumentPath('" . $AppModule . "','" . $Kode . "','" . $DocIdx . "','','',0,'','" . $KodeUser ."');";
	}
	public function remove_docv2_db_path_ext($AppModule,$KodeMenu,$Kode,$DocIdx,$KodeUser){
		$this->db->query("CALL sp".$KodeMenu."SetDocumentPath('" . $AppModule . "','" . $Kode . "','" . $DocIdx . "','','','',0,'','" . $KodeUser ."');");
	}



	public function get_notification_list($AppModule,$KodeMenu,$Params){
		$query=$this->db->query("CALL sp".$KodeMenu."ProcessListNotification('" . $AppModule . "',".$Params.");");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "CALL sp".$KodeMenu."Process('" . $AppModule . "',".$Params.");";
	}
	public function set_notification($AppModule,$KodeMenu,$Params){
		$query=$this->db->query("CALL sp".$KodeMenu."SetNotification('" . $AppModule . "',".$Params.");");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "CALL sp".$KodeMenu."Process('" . $AppModule . "',".$Params.");";
	}


	public function auto_login($AppModule,$Kode){
		$query=$this->db->query("call spAutoLogin('" . $AppModule . "','" . $Kode . "');");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "call spUserLogin('" . $AppModule . "','" . $KodeUser . "');";
	}




/*




	public function get_siak_list_top5(){
		$query=$this->db->query("call spBeritaList(5)");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
	}
	public function get_siak_list(){
		$query=$this->db->query("call spBeritaList(0)");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
	}
	public function get_siak_detail($idx){
		$query=$this->db->query("call spBeritaDetail('".$idx."')");
		$result = $query->getResult();
        //return $query->result();
        return $result;
	}
	public function mst_siak_detail($idx,$move){
		$query=$this->db->query("call spMstBeritaDetail('".$idx."',".$move.")");
		$result = $query->getResult();
        //return $query->result();
        return $result;
	}
	public function mst_siak_del($Kodes){

		$query=$this->db->query("call spMstBeritaDel('" . $Kodes . "','admin')");
		$result = $query->getResult();
        //return $query->result();
        return $result;
		//return "call spMstBeritaDel('" . $Kodes . "','admin')";
	}
	public function mst_siak_save($KodeLama,$Kode,$Judul,$Ringkasan,$Isi,$Sumber,$Aktif){

		$query=$this->db->query("call spMstBeritaSave('" . $KodeLama . "','" . $Kode . "','" . $Judul ."','" . $Ringkasan ."','" . $Isi ."','" . $Sumber ."','" . $Aktif ."','admin')");
		$result = $query->getResult();
        //return $query->result();
        return $result;

		//	return "call spMstBeritaSave('" . $KodeLama . "','" . $Kode . "','" . $Judul ."','" . $Ringkasan ."','" . $Isi ."','" . $Sumber ."','" . $Aktif ."','admin')";
	}
	public function mst_siak_setimg($Kode,$Ext){

		$query=$this->db->query("call spMstBeritaSetImage('" . $Kode . "','" . $Ext . "','admin')");
		$result = $query->getResult();
        //return $query->result();
        return $result;
	}
*/	

	public function bni_payment($AppModule,$Params,$IPAddress,$UserAgent){
		$query=$this->db->query("CALL spBNIPaymentSave('" . $AppModule . "',".$Params.",'" . $IPAddress . "','" . $UserAgent . "');");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "CALL spBNIPaymentSave('" . $AppModule . "',".$Params.",'" . $IPAddress . "','" . $UserAgent . "');";
	}

	public function siak_data_detail($NamaProc,$Params){
		if($Params=='')
			$query=$this->db->query("CALL spSIAK".$NamaProc."Detail();");
		else
			$query=$this->db->query("CALL spSIAK".$NamaProc."Detail(".$Params.");");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "CALL sp".$KodeMenu."Detail('" . $AppModule . "',".$Params.");";
	}

	public function siak_data_list($KodeMenu,$Params){
		if($Params=='')
			$query=$this->db->query("CALL spSIAK".$KodeMenu."List();");
		else
			$query=$this->db->query("CALL spSIAK".$KodeMenu."List(".$Params.");");
		//return $query->result();
		$result = $query->getResult();
        //return $query->result();
        return $result;
//		return "CALL spSIAK".$KodeMenu."List(".$Params.");";
	}

}