<?php namespace App\Controllers;

class Bsa extends BaseController {
	public $kode;
	public $page;
	public $tahun;
	public $tanggal;
	public $kategori;
	public $subkategori;
	public $tanggal_1;
	public $tanggal_2;

//	function index() {
//				return redirect()->to(base_url() , 'refresh');
//	}
	function index()
	{
//			$this->session->sess_destroy();
		if(!$this->request->isAJAX()) {
			$this->init_app();
//			$this->session = \Config\Services::session();
			$this->session = session();
			if($this->session->get($this->AppModule . "UserID"))  { 
//				echo $this->session->get($this->AppModule . "UserID"); die();
//				echo strtolower($this->session->get($this->AppModule . "KodeController")); die();
				if($this->session->get($this->AppModule . "KodeController")!="Bsa")
					return redirect()->to(base_url()."/".strtolower($this->session->get($this->AppModule . "KodeController")));
//					echo base_url()."/".strtolower($this->session->get($this->AppModule . "KodeController"));
				else
					$this->mnu();
			} else {
				$this->gen_login_form();	
			}
		}
	}
	function chgpwdfrm() {
		$this->init_app();
		$this->init();
		$data["baseURL"] = base_url()."app/";
		$data["base_url_class"] = $this->base_url_index_page.strtolower(service('router')->controllerName())."/";
		$data["base_url_index_page"] = $this->base_url_index_page;
		$data["AppModule"] = $this->AppModule;
		$data['AppClass'] = $this;
		//$data["public_folder"] = $this->public_folder; // new pub var
		echo view("bsa_chg_pwd",$data);	
	}
	function login_process() {
		if(!$this->request->isAJAX()) {
			//$this->main();
			return redirect()->to(base_url());
//			return redirect()->to($this->base_url_index_page.strtolower(service('router')->controllerName())."/" , 'refresh');
		} else {
			$this->init_app();
			$this->do_login();
		}
    }

	function logout() {
		$this->init_app();
		$oQuery = $this->bsa_model->ins_log_record($this->AppModule,$this->session->get($this->AppModule . "UserID"));	
		$this->session->unset_userdata($this->AppModule."UserID");
		$this->session->unset_userdata($this->AppModule."UserName");

		$this->session->unset_userdata($this->AppModule."Role");
		$this->session->unset_userdata($this->AppModule."RoleName");

		$this->session->unset_userdata($this->AppModule."KodeController");
		$this->session->unset_userdata($this->AppModule."KodeView");
		$this->session->unset_userdata($this->AppModule."KodeInstansi");
		$this->session->sess_destroy();

		return redirect()->to(base_url(), 'refresh');
//		return redirect()->to($this->base_url_index_page.strtolower(service('router')->controllerName())."/" , 'refresh');
    }

	function refresh_period()
	{
		if(!$this->request->isAJAX()) {
			$this->init_app();
			$this->main();
		} else {
			$this->init();
		}
	}
	function get_data_list_cnt() {
		if(!$this->request->isAJAX()) {
			//$this->main();
//			return redirect()->to(base_url(), 'refresh');
			return redirect()->to($this->base_url_index_page.strtolower(service('router')->controllerName())."/" , 'refresh');
		} else {
			$this->init_app();
			$this->gen_data_list_cnt();
		}
    }
	function get_data_list() {
		if(!$this->request->isAJAX()) {
			//$this->main();
//			return redirect()->to(base_url(), 'refresh');
			return redirect()->to($this->base_url_index_page.strtolower(service('router')->controllerName())."/" , 'refresh');
		} else {
			$this->init_app();
			$this->gen_data_list();
		}
    }


	function get_data_detail() {
		if(!$this->request->isAJAX()) {
			//$this->main();
//			return redirect()->to(base_url(), 'refresh');
			return redirect()->to($this->base_url_index_page.strtolower(service('router')->controllerName())."/" , 'refresh');
		} else {
			$this->init_app();
			$this->gen_data_detail();
		}
    }
	function get_detail_list() {
		if(!$this->request->isAJAX()) {
			//$this->main();
//			return redirect()->to(base_url(), 'refresh');
			return redirect()->to($this->base_url_index_page.strtolower(service('router')->controllerName())."/" , 'refresh');
		} else {
			$this->init_app();
			$this->gen_detail_list();
		}
    }
	function get_data_detail_spec() {
		if(!$this->request->isAJAX()) {
			//$this->main();
//			return redirect()->to(base_url(), 'refresh');
			return redirect()->to($this->base_url_index_page.strtolower(service('router')->controllerName())."/" , 'refresh');
		} else {
			$this->init_app();
			$this->gen_data_detail_spec();
		}
    }
	function get_data_detail_ext() {
		if(!$this->request->isAJAX()) {
			//$this->main();
//			return redirect()->to(base_url(), 'refresh');
			return redirect()->to($this->base_url_index_page.strtolower(service('router')->controllerName())."/" , 'refresh');
		} else {
			$this->init_app();
			$this->gen_data_detail_ext();
		}
    }
	function show_form() {
		if(!$this->request->isAJAX()) {
			//$this->main();
//			return redirect()->to(base_url(), 'refresh');
			return redirect()->to($this->base_url_index_page.strtolower(service('router')->controllerName())."/" , 'refresh');
		} else {
			$this->init_app();
			$this->gen_form();
		}
	}
	function show_form_spec() {
		if(!$this->request->isAJAX()) {
			//$this->main();
//			return redirect()->to(base_url(), 'refresh');
			return redirect()->to($this->base_url_index_page.strtolower(service('router')->controllerName())."/" , 'refresh');
		} else {
			$this->init_app();
			$this->gen_form_spec();
		}
	}
	function show_form_ext() {
		if(!$this->request->isAJAX()) {
			//$this->main();
//			return redirect()->to(base_url(), 'refresh');
			return redirect()->to($this->base_url_index_page.strtolower(service('router')->controllerName())."/" , 'refresh');
		} else {
			$this->init_app();
			$this->gen_form_ext();
		}
	}
	function show_combo() {
		if(!$this->request->isAJAX()) {
			//$this->main();
//			return redirect()->to(base_url(), 'refresh');
			return redirect()->to($this->base_url_index_page.strtolower(service('router')->controllerName())."/" , 'refresh');
		} else {
			$this->init_app();
			$this->gen_combo();
		}
	}
	function show_combo_list() {
		if(!$this->request->isAJAX()) {
			//$this->main();
//			return redirect()->to(base_url(), 'refresh');
			return redirect()->to($this->base_url_index_page.strtolower(service('router')->controllerName())."/" , 'refresh');
		} else {
			$this->init_app();
			$this->gen_combo_list();
		}
	}
	function show_combo_list_ext() {
		if(!$this->request->isAJAX()) {
			//$this->main();
//			return redirect()->to(base_url(), 'refresh');
			return redirect()->to($this->base_url_index_page.strtolower(service('router')->controllerName())."/" , 'refresh');
		} else {
			$this->init_app();
			$this->gen_combo_list_ext();
		}
	}
	function show_popup_win() {
		if(!$this->request->isAJAX()) {
			//$this->main();
//			return redirect()->to(base_url(), 'refresh');
			return redirect()->to($this->base_url_index_page.strtolower(service('router')->controllerName())."/" , 'refresh');
		} else {
			$this->init_app();
			$this->gen_popup_win();
		}
	}
	function show_popup_win_ext() {
		if(!$this->request->isAJAX()) {
			//$this->main();
//			return redirect()->to(base_url(), 'refresh');
			return redirect()->to($this->base_url_index_page.strtolower(service('router')->controllerName())."/" , 'refresh');
		} else {
			$this->init_app();
			$this->gen_popup_win_ext();
		}
	}
	function process_data() {
		if(!$this->request->isAJAX()) {
			//$this->main();
//			return redirect()->to(base_url(), 'refresh');
			return redirect()->to($this->base_url_index_page.strtolower(service('router')->controllerName())."/" , 'refresh');
		} else {
			$this->init_app();
			$this->do_process_data();
		}

	}
	function save_data() {
		if(!$this->request->isAJAX()) {
			//$this->main();
//			return redirect()->to(base_url(), 'refresh');
			return redirect()->to($this->base_url_index_page.strtolower(service('router')->controllerName())."/" , 'refresh');
		} else {
			$this->init_app();
			$this->do_save_data();
		}
	}
	function save_data_ext() {
		if(!$this->request->isAJAX()) {
			//$this->main();
//			return redirect()->to(base_url(), 'refresh');
			return redirect()->to($this->base_url_index_page.strtolower(service('router')->controllerName())."/" , 'refresh');
		} else {
			$this->init_app();
			$this->do_save_data_ext();
		}
	}
	function remove_doc() {
		$this->init_app();
		$this->do_remove_doc();
	}
	function upload_doc() {
		$this->init_app();
		$this->do_upload_doc();
	}
	function upload_img() {
		$this->init_app();
		$this->do_upload_img();
	}
	function upload_mainslide() {
		$this->init_app();
		$this->do_upload_mainslide();
	}
	function upload_img_db() {
		$this->init_app();
		$this->do_upload_img_db();
	}
	function del_data() {
		if(!$this->request->isAJAX()) {
			//$this->main();
//			return redirect()->to(base_url(), 'refresh');
			return redirect()->to($this->base_url_index_page.strtolower(service('router')->controllerName())."/" , 'refresh');
		} else {
			$this->init_app();
			$this->do_del_data();
		}
	}
	function del_data_single() {
		if(!$this->request->isAJAX()) {
			//$this->main();
//			return redirect()->to(base_url(), 'refresh');
			return redirect()->to($this->base_url_index_page.strtolower(service('router')->controllerName())."/" , 'refresh');
		} else {
			$this->init_app();
			$this->do_del_data_single();
		}
	}
	function del_data_dtl() {
		if(!$this->request->isAJAX()) {
			//$this->main();
//			return redirect()->to(base_url(), 'refresh');
			return redirect()->to($this->base_url_index_page.strtolower(service('router')->controllerName())."/" , 'refresh');
		} else {
			$this->init_app();
			$this->do_del_data_dtl();
		}
	}
	function del_dataimg() {
		if(!$this->request->isAJAX()) {
			//$this->main();
//			return redirect()->to(base_url(), 'refresh');
			return redirect()->to($this->base_url_index_page.strtolower(service('router')->controllerName())."/" , 'refresh');
		} else {
			$this->init_app();
			$this->do_del_dataimg();
		}
	}
	function get_pdf() {
		$this->init_app();
		$this->gen_pdf();
	}
	function get_xls_() {
		$this->init_app();
		$this->gen_xls();
	}
	function get_xls()	{
		$this->init_app();
		if(!isset($_POST["Doc"])) {
			echo "<script language=\"javascript\">window.alert('Technical Error. Call the Vendor.'); window.close()</script>";
		} else {
			$this->init();

			$Doc = trim($_POST["Doc"]);
			$FileName = $_POST["FileName"];
			$arHREF = explode("/",$_POST["HRef"]);
			$KodeMenuRaw = $arHREF[count($arHREF)-1];
			if(strlen($KodeMenuRaw)>100) {
				$mnupos = substr($KodeMenuRaw,0,1);
				$KodeMenu = substr_replace($KodeMenuRaw, '', 0, 129-intval($mnupos)); 
				$KodeMenu = substr_replace($KodeMenu, '', -1*intval($mnupos), intval($mnupos)); 
			} else {
				$KodeMenu=$this->BaseMenu;	
			}
			if(file_exists(FCPATH."app/Views/".$KodeMenu."XLS".$Doc.".php")) {

				$ParamsHdr = $this->get_param_xls_hdr($KodeMenu,$Doc);
				$oQueryHdr = $this->m_adm_model->get_xls_hdr($this->AppModule,$KodeMenu,$Doc,$ParamsHdr);
				$data["oQueryHdr"] = $oQueryHdr;
	
				$ParamsList = $this->get_param_xls_list($KodeMenu,$Doc);
				$oQueryList = $this->m_adm_model->get_xls_list($this->AppModule,$KodeMenu,$Doc,$ParamsList);
				$data["oQueryList"] = $oQueryList;
				$data['_POST'] = $_POST;
				
				$data['FileName'] = $FileName;
				
				//load librarynya terlebih dahulu
				//jika digunakan terus menerus lebih baik load ini ditaruh di auto load
				$this->load->library("Excel/PHPExcel");
		
				//membuat objek PHPExcel
				$objPHPExcel = new PHPExcel();
		
				$data['objPHPExcel'] = $objPHPExcel;
				// proses lempar ke view
				echo view($KodeMenu."XLS".$Doc,$data);
			} else { 
				echo "<html><script language=\"javascript\">window.alert('underconstruction'); window.close()</script></html>";
			}
		}
	}
	function print_doc() {
		$this->init_app();
		if(!isset($_POST["Doc"])) {
			echo "<script language=\"javascript\">window.alert('Technical Error. Call the Vendor.'); window.close()</script>";
		} else {
			$this->init();
			
			$Doc = $_POST["Doc"];
			$arHREF = explode("/",$_POST["HRef"]);
			$KodeMenuRaw = $arHREF[count($arHREF)-1];
			if(strlen($KodeMenuRaw)>100) {
				$mnupos = substr($KodeMenuRaw,0,1);
				$KodeMenu = substr_replace($KodeMenuRaw, '', 0, 129-intval($mnupos)); 
				$KodeMenu = substr_replace($KodeMenu, '', -1*intval($mnupos), intval($mnupos)); 
			} else {
				$KodeMenu=$this->BaseMenu;	
			}
			$ParamsHdr = $this->get_param_print_hdr($KodeMenu,$Doc);
			$oQueryHdr = $this->m_adm_model->get_print_hdr($this->AppModule,$KodeMenu,$Doc,$ParamsHdr);
			$data["oQueryHdr"] = $oQueryHdr;

			$ParamsList = $this->get_param_print_list($KodeMenu,$Doc);
			$oQueryList = $this->m_adm_model->get_print_list($this->AppModule,$KodeMenu,$Doc,$ParamsList);
			$data["oQueryList"] = $oQueryList;

			$data['AppClass'] = $this;
			$data["ThnAnggaranAktif"] = $this->ThnAnggaranAktif; 
			$data["ThnPengisianAnggaran"] = $this->ThnPengisianAnggaran; 
			if(file_exists(FCPATH."app/Views/".$KodeMenu."Print".$Doc.".php")) {
				echo view($KodeMenu."Print".$Doc,$data);
			} else { 
				echo "<html><script language=\"javascript\">window.alert('underconstruction'); window.close()</script></html>";
			}
		}
	}
	function get_param_print_hdr($KodeMenu,$Doc) {
		$data['_POST'] = $_POST;
		$data['AppClass'] = $this;
		$KodeUser = $this->session->get($this->AppModule . "UserID");
		$data['KodeUser'] = $KodeUser;
		return view($KodeMenu."Print".$Doc."ParamHdr",$data,TRUE);	
	}
	function get_param_print_list($KodeMenu,$Doc) {
		$data['_POST'] = $_POST;
		$data['AppClass'] = $this;
		$KodeUser = $this->session->get($this->AppModule . "UserID");
		$data['KodeUser'] = $KodeUser;
		return view($KodeMenu."Print".$Doc."ParamList",$data,TRUE);	
	}
	public function get_image_user() 
	{
		$this->init_app();
		$KodeUser = $uri->getSegment(3);
		$oQuery = $this->m_adm_model->get_image_user($this->AppModule,$KodeUser);	
		if(count($oQuery) > 0) {
			foreach($oQuery as $oRS) {
                $data["ext"] = $oRS->Ext;
				$data["image_time"] = $oRS->CrtDate;
				$data["image_data"] = $oRS->Gambar;
            }
			return view("image",$data,TRUE);	
		} else {
			return "";	
		}
	}







// APP MENU FUNCTIONS #############################################################################################################
	
	function appunderconstruction($data,$view="app") {
		$this->load_view($data,$view);	
	}
	function appprofil($data,$view="app") {
		$this->load_view($data,$view);	
	}

	function upload_img_crop() {
		$arHREF = explode("/",$_POST["href"]);
//		$KodeMenuRaw = $arHREF[count($arHREF)-1];
		// diganti ini ================================
		for($i = count($arHREF)-1; $i>0; $i--) {
			if(strlen($arHREF[$i])>120)	{
				$KodeMenuRaw = $arHREF[$i];
				break;
			}
		}
		// ============================================
		$mnupos = substr($KodeMenuRaw,0,1);
		$KodeMenu = substr_replace($KodeMenuRaw, '', 0, 129-intval($mnupos)); 
		$KodeMenu = substr_replace($KodeMenu, '', -1*intval($mnupos), intval($mnupos)); 
		
		$KodeUser = $this->session->get($this->AppModule . "UserID");
		$Kode = $_POST["kode"];
//		$filename = $Kode; //$_POST['filename'];
		// special addition to prevent bugs in CI - Upload
		if (strpos($Kode, '.') === TRUE) {
			$filename = $Kode;
		} else {
			$filename = str_replace(".","_",$Kode);
		}
		$img = $_POST['fileToUpload'];
		$src_path = "uploads/".$_POST['folder']."/";

//		$src_path = "images/".$Folder."/";
		$upload_path = $this->base_path_frontend.$src_path; 

		$img = str_replace('data:image/jpeg;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		file_put_contents($src_path.$filename.".jpg", $data);	
//		$this->upload_finishing($KodeMenu,$Kode,$upload_data,$upload_path,$src_path,$width,$height,$no_thumb,$ImgOri,$ThumbOri);

		$oQuery = $this->adm_model->upload_img_db_path($this->AppModule,$KodeMenu,$Kode,$src_path.$filename.".jpg","",$KodeUser);
//		$this->session->get($this->AppModule . "GambarPath") = $src_path.$filename.".jpg";
		$this->session->set_userdata($this->AppModule . "GambarPath",$src_path.$filename.".jpg");
		

//		echo $oQuery;
		// hapus yg lama
//		if($ImgOri!="" && $src_path.$filename!=$ImgOri) {
//			@unlink($ImgOri);
//		}
//		if($ThumbOri!="" &&  $src_path.$thumbfilename!=$ThumbOri) {
//			@unlink($ThumbOri);
//		}
		echo $src_path.$filename.".jpg";	
		
	}

	function upload_berkas(){

			$arHREF = explode("/",$_POST["href"]);
//			$KodeMenuRaw = $arHREF[count($arHREF)-1];
			// diganti ini ================================
			for($i = count($arHREF)-1; $i>0; $i--) {
				if(strlen($arHREF[$i])>120)	{
					$KodeMenuRaw = $arHREF[$i];
					break;
				}
			}
			// ============================================
			$mnupos = substr($KodeMenuRaw,0,1);
			$KodeMenu = substr_replace($KodeMenuRaw, '', 0, 129-intval($mnupos)); 
			$KodeMenu = substr_replace($KodeMenu, '', -1*intval($mnupos), intval($mnupos)); 
			$Extended = "";
			if(isset($_POST["ext"]))
				$Extended = $_POST["ext"];
			
			$Kode = $_POST["Kode"];
			$Folder = $_POST["Folder"];
			$DocIdx = "";
			if(isset($_POST["DocIdx"])) {
				$DocIdx = $_POST["DocIdx"];
			}
			$src_path = "docs/";
			if(isset($_POST["Folder"])) {
				$Folder = $_POST["Folder"];
				$src_path .= $Folder."/";
			}
			$upload_path = $this->base_path_frontend.$src_path; 
			// hapus dulu
			if(isset($_POST["FileOri"])) {
				@unlink($upload_path.$_POST["FileOri"]);
			}
		
			// get filename
			$KodeUser = $this->session->get($this->AppModule . "UserID");

//			$oQuery = $this->adm_model->get_data_detail($this->AppModule,$KodeMenu,"'".$KodeUser."','".$Kode."',0");

			$Params = "'".$KodeUser."','".$Kode."'";

			if(isset($_POST["bln"]))
				$Params = "'" . $_POST["bln"] . "',".$Params;

			if(isset($_POST["instansi"]))
				$Params = "'" . $_POST["instansi"] . "',".$Params;
			if(isset($_POST["periode"]))
				$Params = "'" . $_POST["periode"] . "',".$Params;
			if(isset($_POST["thn"]))
				$Params = "'" . $_POST["thn"] . "',".$Params;
			if(isset($_POST["tgl"]))
				$Params = "'" . $_POST["tgl"] . "',".$Params;
			
			

			$oQuery = $this->adm_model->get_data_detail($this->AppModule,$KodeMenu,$Params.",0");	
			$FileName = ""; // default name set to ""
			if(count($oQuery) > 0) {
				foreach($oQuery as $oRS) {
					$FileName = $oRS->url_alias;
					if(strrpos($FileName,"/",-1)>0) 
						$FileName = substr($FileName,strrpos($FileName,"/",-1)-strlen($FileName)+1);
				}
			}
			$config['upload_path'] = $upload_path; 
			$config['allowed_types'] = 'gif|jpg|png|pdf|docx|doc|xls|xlsx|ppt|pptx|pps|ppsx|zip';
			$config['max_size'] = 0;
	//		$config['max_width'] = 0;
	//		$config['max_height'] = 0;
			$config['overwrite'] = TRUE;

			if($DocIdx!="" && intval($DocIdx)>0) {
				$config['file_name'] = $FileName."_".$DocIdx;
			} else
				$config['file_name'] = $FileName;

//
//        $config['upload_path'] = $this->base_path_frontend.'docs/suratmasuk/'; //path folder
//        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf|docx'; //type yang dapat diakses bisa anda sesuaikan
//        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
 
		$this->load->library('upload', $config);		

//        $this->upload->initialize($config);
        if(!empty($_FILES['fileToUpload']['name']))
        {
            if ($this->upload->do_upload('fileToUpload'))
                {
//                    $gbr = $this->upload->data();
//                    $gambar=$gbr['file_name']; //Mengambil file name dari gambar yang diupload
//                    $judul=strip_tags($this->input->post('judul'));
//                    $this->m_upload->simpan_upload($judul,$gambar);
                    echo "Upload Berhasil";
                }else{
                    echo "Gambar Gagal Upload. Gambar harus bertipe gif|jpg|png|jpeg|bmp";
                }
                      
            }else{
                echo "Gagal, gambar belum di pilih";
        }
                 
    }

	function upload_img_crops3() {
		$this->init_app();
		
		$arHREF = explode("/",$_POST["href"]);
//		$KodeMenuRaw = $arHREF[count($arHREF)-1];
		foreach($arHREF as $href) {
			if(strlen($href)>100) $KodeMenuRaw = $href;	
		}
			
//			echo $KodeMenuRaw; die();
		$mnupos = substr($KodeMenuRaw,0,1);
		$KodeMenu = substr_replace($KodeMenuRaw, '', 0, 129-intval($mnupos)); 
		$KodeMenu = substr_replace($KodeMenu, '', -1*intval($mnupos), intval($mnupos)); 
		$KodeUser = $this->session->get($this->AppModule . "UserID");
		$KodeView = $this->session->get($this->AppModule . "KodeView");
		$Kode = $_POST["kode"];
//		$filename = $Kode; //$_POST['filename'];
		// special addition to prevent bugs in CI - Upload
		if (strpos($Kode, '.') === TRUE) {
			$filename = $Kode;
		} else {
			$filename = str_replace(".","_",$Kode);
		}

		if (strpos($Kode, '#') === TRUE) {
			$filename = $Kode;
		} else {
			$filename = str_replace("#","_",$Kode);
		}


		$img = $_POST['fileToUpload'];
		$src_path = "uploads/".$_POST['folder']."/";
		$Folder = $_POST['folder'];

//		$src_path = "images/".$Folder."/";
		$upload_path = $this->base_path_frontend.$src_path; 

		$img = str_replace('data:image/jpeg;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		file_put_contents($src_path.$filename.".jpg", $data);	
		
		$filePath = $upload_path.$filename.".jpg";

// mulai dari sini 
		$this->config->load('s3', TRUE);				

		$s3_config = $this->config->item('s3');

		$awsURL = $s3_config['s3_url'];
		$awsAccessKey = $s3_config['access_key'];
		$awsSecretKey = $s3_config['secret_key'];
		$awsBucketName = $s3_config['bucket_name'];
		$awsFolderParent = $s3_config['folder_parent'];
		$awsFolder = $awsFolderParent."imgs/".$Folder;

//				echo $awsFolder."-".$awsSecretKey; die();
//				$this->load->library('S3');
// ==================================================================================================
		$this->load->library('S3',array($awsAccessKey, $awsSecretKey)); //load S3 library
//				$s3 = new S3($awsAccessKey, $awsSecretKey);
		$s3 = new S3($awsAccessKey, $awsSecretKey, false);
// ==================================================================================================				


		if (file_exists($filePath)) { //echo $filePath; die();
			 try {
				 $S3Return = $s3->putObjectFile($filePath, $awsBucketName, $awsFolder.'/'.$filename.".jpg",S3::ACL_PUBLIC_READ);

			 } catch (Exception $e) {
				$S3Return = false;
			 }
//			 echo $S3Return; die();
			 if($S3Return) {
				$AWSFilePathDB = "http://".$awsBucketName.'/'.$awsFolder.'/'.$filename.".jpg";
//echo $AWSFilePathDB; die();
//				$KodeUser = $this->session->get($this->AppModule . "UserID");

//				echo $this->AppCode . ",".$KodeMenu.",".$Kode.",".$AWSFilePathDB.",".$KodeUser; die();

				$oQuery = $this->adm_model->upload_img_db_path($this->AppModule,$KodeView.$KodeMenu,$Kode,$AWSFilePathDB,"",$KodeUser);
//				echo $oQuery; die();
		//		$this->session->get($this->AppModule . "GambarPath") = $src_path.$filename.".jpg";
//				$this->session->set_userdata($this->AppCode . "GambarPath",$AWSFilePathDB);
				
		
		//		echo $src_path.$filename.".jpg";	

				echo $AWSFilePathDB;
				

//						echo $filename;
			} else echo "error S3 uploading";
			@unlink($filePath);
		} else echo "error local uploading";

		
	}
	
}

/* End of file app.php */
/* Location: ./application/controllers/app.php */