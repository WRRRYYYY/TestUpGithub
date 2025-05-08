<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\Tmp_model;

class Ket extends BaseController
{
	public $kode;
	public $page;
	public $tahun;
	public $tanggal;
	public $kategori;
	public $subkategori;
	public $tanggal_1;
	public $tanggal_2;

	//	function index() {
	//				return redirect()->to(base_url() );
	//	}
	function index()
	{
		if (!$this->request->isAJAX()) {
			$this->init_app();
			if ($this->session->get($this->AppModule . "UserID")) {
				if ($this->session->get($this->AppModule . "KodeController") != "Ket")
					return redirect()->to(base_url() . "/" . strtolower($this->session->get($this->AppModule . "KodeController")));
				else
					$this->mnu();
			} else {
				$this->gen_login_form();
			}
		}
	}

	function refresh_period()
	{
		if (!$this->request->isAJAX()) {
			$this->init_app();
			$this->main();
		} else {
			$this->init();
		}
	}
	function get_data_list_cnt()
	{
		if (!$this->request->isAJAX()) {
			//$this->main();
			//			return redirect()->to(base_url());
			return redirect()->to($this->base_url_index_page . strtolower($this->router->fetch_class()) . "/");
		} else {
			$this->init_app();
			$this->gen_data_list_cnt();
		}
	}
	function get_data_list()
	{
		if (!$this->request->isAJAX()) {
			//$this->main();
			//			return redirect()->to(base_url());
			return redirect()->to($this->base_url_index_page . strtolower($this->router->fetch_class()) . "/");
		} else {
			$this->init_app();
			$this->gen_data_list();
		}
	}


	function get_data_detail()
	{
		if (!$this->request->isAJAX()) {
			//$this->main();
			//			return redirect()->to(base_url());
			return redirect()->to($this->base_url_index_page . strtolower($this->router->fetch_class()) . "/");
		} else {
			$this->init_app();
			$this->gen_data_detail();
		}
	}
	function get_detail_list()
	{
		if (!$this->request->isAJAX()) {
			//$this->main();
			//			return redirect()->to(base_url());
			return redirect()->to($this->base_url_index_page . strtolower($this->router->fetch_class()) . "/");
		} else {
			$this->init_app();
			$this->gen_detail_list();
		}
	}
	function get_data_detail_spec()
	{
		if (!$this->request->isAJAX()) {
			//$this->main();
			//			return redirect()->to(base_url());
			return redirect()->to($this->base_url_index_page . strtolower($this->router->fetch_class()) . "/");
		} else {
			$this->init_app();
			$this->gen_data_detail_spec();
		}
	}
	function get_data_detail_ext()
	{
		if (!$this->request->isAJAX()) {
			//$this->main();
			//			return redirect()->to(base_url());
			return redirect()->to($this->base_url_index_page . strtolower($this->router->fetch_class()) . "/");
		} else {
			$this->init_app();
			$this->gen_data_detail_ext();
		}
	}
	function show_form()
	{
		if (!$this->request->isAJAX()) {
			//$this->main();
			//			return redirect()->to(base_url());
			return redirect()->to($this->base_url_index_page . strtolower($this->router->fetch_class()) . "/");
		} else {
			$this->init_app();
			$this->gen_form();
		}
	}
	function show_form_spec()
	{
		if (!$this->request->isAJAX()) {
			//$this->main();
			//			return redirect()->to(base_url());
			return redirect()->to($this->base_url_index_page . strtolower($this->router->fetch_class()) . "/");
		} else {
			$this->init_app();
			$this->gen_form_spec();
		}
	}
	function show_form_ext()
	{
		if (!$this->request->isAJAX()) {
			//$this->main();
			//			return redirect()->to(base_url());
			return redirect()->to($this->base_url_index_page . strtolower($this->router->fetch_class()) . "/");
		} else {
			$this->init_app();
			$this->gen_form_ext();
		}
	}
	function show_combo()
	{
		if (!$this->request->isAJAX()) {
			//$this->main();
			//			return redirect()->to(base_url());
			return redirect()->to($this->base_url_index_page . strtolower($this->router->fetch_class()) . "/");
		} else {
			$this->init_app();
			$this->gen_combo();
		}
	}
	function show_combo_list()
	{
		if (!$this->request->isAJAX()) {
			//$this->main();
			//			return redirect()->to(base_url());
			return redirect()->to($this->base_url_index_page . strtolower($this->router->fetch_class()) . "/");
		} else {
			$this->init_app();
			$this->gen_combo_list();
		}
	}
	function show_combo_list_ext()
	{
		if (!$this->request->isAJAX()) {
			//$this->main();
			//			return redirect()->to(base_url());
			return redirect()->to($this->base_url_index_page . strtolower($this->router->fetch_class()) . "/");
		} else {
			$this->init_app();
			$this->gen_combo_list_ext();
		}
	}
	function show_popup_win()
	{
		if (!$this->request->isAJAX()) {
			//$this->main();
			//			return redirect()->to(base_url());
			return redirect()->to($this->base_url_index_page . strtolower($this->router->fetch_class()) . "/");
		} else {
			$this->init_app();
			$this->gen_popup_win();
		}
	}
	function show_popup_win_ext()
	{
		if (!$this->request->isAJAX()) {
			//$this->main();
			//			return redirect()->to(base_url());
			return redirect()->to($this->base_url_index_page . strtolower($this->router->fetch_class()) . "/");
		} else {
			$this->init_app();
			$this->gen_popup_win_ext();
		}
	}
	function process_data()
	{
		if (!$this->request->isAJAX()) {
			//$this->main();
			//			return redirect()->to(base_url());
			return redirect()->to($this->base_url_index_page . strtolower($this->router->fetch_class()) . "/");
		} else {
			$this->init_app();
			$this->do_process_data();
		}
	}
	function save_data()
	{
		if (!$this->request->isAJAX()) {
			//$this->main();
			//			return redirect()->to(base_url());
			return redirect()->to($this->base_url_index_page . strtolower($this->router->fetch_class()) . "/");
		} else {
			$this->init_app();
			$this->do_save_data();
		}
	}
	function save_data_ext()
	{
		if (!$this->request->isAJAX()) {
			//$this->main();
			//			return redirect()->to(base_url());
			return redirect()->to($this->base_url_index_page . strtolower($this->router->fetch_class()) . "/");
		} else {
			$this->init_app();
			$this->do_save_data_ext();
		}
	}
	function remove_doc()
	{
		$this->init_app();
		$this->do_remove_doc();
	}
	function remove_docv2()
	{
		$this->init_app();
		$this->do_remove_docv2();
	}
	function remove_docv2s3()
	{
		$this->init_app();
		$this->do_remove_docv2s3();
	}
	function upload_doc()
	{
		$this->init_app();
		$this->do_upload_doc();
	}
	function upload_docv2()
	{
		$this->init_app();
		$this->do_upload_docv2();
	}
	function upload_docv2s3()
	{
		$this->init_app();
		$this->do_upload_docv2s3();
	}
	function upload_img()
	{
		$this->init_app();
		$this->do_upload_img();
	}
	function upload_img_crop()
	{
		$this->init_app();
		$this->do_upload_img_crop();
	}
	function upload_img_crop_png()
	{
		$this->init_app();
		$this->do_upload_img_crop_png();
	}
	function upload_mainslide()
	{
		$this->init_app();
		$this->do_upload_mainslide();
	}
	function upload_img_db()
	{
		$this->init_app();
		$this->do_upload_img_db();
	}
	function del_data()
	{
		if (!$this->request->isAJAX()) {
			//$this->main();
			//			return redirect()->to(base_url());
			return redirect()->to($this->base_url_index_page . strtolower($this->router->fetch_class()) . "/");
		} else {
			$this->init_app();
			$this->do_del_data();
		}
	}
	function del_data_single()
	{
		if (!$this->request->isAJAX()) {
			//$this->main();
			//			return redirect()->to(base_url());
			return redirect()->to($this->base_url_index_page . strtolower($this->router->fetch_class()) . "/");
		} else {
			$this->init_app();
			$this->do_del_data_single();
		}
	}
	function del_data_dtl()
	{
		if (!$this->request->isAJAX()) {
			//$this->main();
			//			return redirect()->to(base_url());
			return redirect()->to($this->base_url_index_page . strtolower($this->router->fetch_class()) . "/");
		} else {
			$this->init_app();
			$this->do_del_data_dtl();
		}
	}
	function del_dataimg()
	{
		if (!$this->request->isAJAX()) {
			//$this->main();
			//			return redirect()->to(base_url());
			return redirect()->to($this->base_url_index_page . strtolower($this->router->fetch_class()) . "/");
		} else {
			$this->init_app();
			$this->do_del_dataimg();
		}
	}
	function del_data_dtl_img()
	{
		if (!$this->request->isAJAX()) {
			//$this->main();
			//			return redirect()->to(base_url());
			return redirect()->to($this->base_url_index_page . strtolower($this->router->fetch_class()) . "/");
		} else {
			$this->init_app();
			$this->do_del_data_dtl_img();
		}
	}
	function get_pdf()
	{
		$this->init_app();
		$this->gen_pdf();
	}
	function get_xls()
	{
		$this->init_app();
		if (!isset($_POST["Doc"])) {
			echo "<script language=\"javascript\">window.alert('Technical Error. Call the Vendor.'); window.close()</script>";
		} else {
			$this->init();

			$Doc = trim($_POST["Doc"]);
			$FileName = $_POST["FileName"];
			$arHREF = explode("/", $_POST["HRef"]);
			$KodeMenuRaw = $arHREF[count($arHREF) - 1];
			if (strlen($KodeMenuRaw) > 100) {
				$mnupos = substr($KodeMenuRaw, 0, 1);
				$KodeMenu = substr_replace($KodeMenuRaw, '', 0, 129 - intval($mnupos));
				$KodeMenu = substr_replace($KodeMenu, '', -1 * intval($mnupos), intval($mnupos));
			} else {
				$KodeMenu = $this->BaseMenu;
			}
			if (file_exists(FCPATH . "application/views/" . $KodeMenu . "XLS" . $Doc . ".php")) {

				$ParamsHdr = $this->get_param_xls_hdr($KodeMenu, $Doc);
				$oQueryHdr = $this->bsa_model->get_xls_hdr($this->AppModule, $KodeMenu, $Doc, $ParamsHdr);
				$data["oQueryHdr"] = $oQueryHdr;

				$ParamsList = $this->get_param_xls_list($KodeMenu, $Doc);
				$oQueryList = $this->bsa_model->get_xls_list($this->AppModule, $KodeMenu, $Doc, $ParamsList);
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
				$this->load->view($KodeMenu . "XLS" . $Doc, $data);
			} else {
				echo "<html><script language=\"javascript\">window.alert('underconstruction'); window.close()</script></html>";
			}
		}
	}
	function get_xlsx()
	{
		$this->init_app();
		if (!isset($_POST["Doc"])) {
			echo "<script language=\"javascript\">window.alert('Technical Error. Call the Vendor.'); window.close()</script>";
		} else {
			$this->init();

			$Doc = trim($_POST["Doc"]);
			$FileName = $_POST["FileName"];
			$arHREF = explode("/", $_POST["HRef"]);
			//			$KodeMenuRaw = $arHREF[count($arHREF)-1];
			// diganti ini ================================
			for ($i = count($arHREF) - 1; $i > 0; $i--) {
				if (strlen($arHREF[$i]) > 120) {
					$KodeMenuRaw = $arHREF[$i];
					break;
				}
			}
			// ============================================
			$mnupos = substr($KodeMenuRaw, 0, 1);
			$KodeMenu = substr_replace($KodeMenuRaw, '', 0, 129 - intval($mnupos));
			$KodeMenu = substr_replace($KodeMenu, '', -1 * intval($mnupos), intval($mnupos));

			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$KodeView = $this->session->get($this->AppModule . "KodeView");
			$KodeController = $this->session->get($this->AppModule . "KodeController");

			// 	echo FCPATH . $this->core_folder_path . "app/Views/" . $KodeView . $KodeMenu . "XLS" . $Doc . ".php"; die();
			if (file_exists(realpath(FCPATH . $this->core_folder_path . "app/Views/" . $KodeView . $KodeMenu . "XLS" . $Doc . ".php"))) {
				$data['AppClass'] = $this;

				$ParamsHdr = $this->get_param_xls_hdr($KodeController . $KodeMenu, $Doc);
				$oQueryHdr = $this->bsa_model->get_xls_hdr($this->AppModule, $KodeView . $KodeMenu, $Doc, $ParamsHdr);
				$data["oQueryHdr"] = $oQueryHdr;

				$ParamsList = $this->get_param_xls_list($KodeController . $KodeMenu, $Doc);
				$oQueryList = $this->bsa_model->get_xls_list($this->AppModule, $KodeView . $KodeMenu, $Doc, $ParamsList);
				$data["oQueryList"] = $oQueryList;
				//				echo $oQueryList; die();
				$data['_POST'] = $_POST;

				$data['FileName'] = $FileName;

				// PHPSpreadsheet
				$objPHPSpreadsheet = new Spreadsheet();
				$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
				$richText = new \PhpOffice\PhpSpreadsheet\RichText\RichText();

				$writer = new Xlsx($objPHPSpreadsheet);

				$data['objPHPSpreadsheet'] = $objPHPSpreadsheet;
				$data['drawing'] = $drawing;
				$data['writer'] = $writer;
				// proses lempar ke view
				//   echo file_exists(realpath(FCPATH . $this->core_folder_path . "app/Views/" . $KodeView . $KodeMenu . "XLS" . $Doc . ".php")); die();
				// $this->load->view($KodeView . $KodeMenu . "XLS" . $Doc, $data);
				echo view($KodeView . $KodeMenu . "XLS" . $Doc, $data);
			} else {
				echo "<html><script language=\"javascript\">window.alert('underconstruction'); window.close()</script></html>";
			}
		}
	}
	function print_doc()
	{
		$this->init_app();
		if (!isset($_POST["Doc"])) {
			echo "<script language=\"javascript\">window.alert('Technical Error. Call the Vendor.'); window.close()</script>";
		} else {
			$this->init();


			$Doc = trim($_POST["Doc"]);
			$arHREF = explode("/", $_POST["HRef"]);
			//			$KodeMenuRaw = $arHREF[count($arHREF)-1];
			// diganti ini ================================
			for ($i = count($arHREF) - 1; $i > 0; $i--) {
				if (strlen($arHREF[$i]) > 120) {
					$KodeMenuRaw = $arHREF[$i];
					break;
				}
			}
			// ============================================
			$mnupos = substr($KodeMenuRaw, 0, 1);
			$KodeMenu = substr_replace($KodeMenuRaw, '', 0, 129 - intval($mnupos));
			$KodeMenu = substr_replace($KodeMenu, '', -1 * intval($mnupos), intval($mnupos));

			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$KodeView = $this->session->get($this->AppModule . "KodeView");
			$KodeController = $this->session->get($this->AppModule . "KodeController");

			$ParamsHdr = $this->get_param_print_hdr($KodeController . $KodeMenu, $Doc);
			$oQueryHdr = $this->bsa_model->get_print_hdr($this->AppModule, $KodeView . $KodeMenu, $Doc, $ParamsHdr);
			$data["oQueryHdr"] = $oQueryHdr;
			//echo $oQueryHdr; die();

			$ParamsList = $this->get_param_print_list($KodeController . $KodeMenu, $Doc);
			$oQueryList = $this->bsa_model->get_print_list($this->AppModule, $KodeView . $KodeMenu, $Doc, $ParamsList);
			$data["oQueryList"] = $oQueryList;

			//echo $oQueryList; die();

			$data['AppClass'] = $this;
			if (file_exists(FCPATH . $this->core_folder_path . "app/Views/" . $KodeView . $KodeMenu . "Print" . $Doc . ".php")) {
				echo view($KodeView . $KodeMenu . "Print" . $Doc, $data);
			} else {
				echo "<html><script language=\"javascript\">window.alert('underconstruction'); window.close()</script></html>";
			}
		}
	}
// 	function get_param_print_hdr($KodeMenu, $Doc)
// 	{
// 		$data['_POST'] = $_POST;
// 		$data['AppClass'] = $this;
// 		$KodeUser = $this->session->get($this->AppModule . "UserID");
// 		$data['KodeUser'] = $KodeUser;
// 		return $this->load->view($KodeMenu . "Print" . $Doc . "ParamHdr", $data, TRUE);
// 	}
// 	function get_param_print_list($KodeMenu, $Doc)
// 	{
// 		$data['_POST'] = $_POST;
// 		$data['AppClass'] = $this;
// 		$KodeUser = $this->session->get($this->AppModule . "UserID");
// 		$data['KodeUser'] = $KodeUser;
// 		return $this->load->view($KodeMenu . "Print" . $Doc . "ParamList", $data, TRUE);
// 	}
	public function get_image_user()
	{
		$this->init_app();
		$KodeUser = $this->uri->segment(3);
		$oQuery = $this->bsa_model->get_image_user($this->AppModule, $KodeUser);
		if (count($oQuery) > 0) {
			foreach ($oQuery as $oRS) {
				$data["ext"] = $oRS->Ext;
				$data["image_time"] = $oRS->CrtDate;
				$data["image_data"] = $oRS->Gambar;
			}
			return $this->load->view("image", $data, TRUE);
		} else {
			return "";
		}
	}







	// APP MENU FUNCTIONS #############################################################################################################

	function appunderconstruction($data, $view = "app")
	{
		$this->load_view($data, $view);
	}
	function appprofil($data, $view = "app")
	{
		$this->load_view($data, $view);
	}
	function ket01($data, $view = "app")
	{
		if ($view == "app") {
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$Params = "'" . $KodeUser . "',";
			$Params .= "'1',''";
			$KodeMenu1 = '110301';
			$KodeMenu2 = '130301';
			$KodeMenu3 = '150302';
			$KodeMenu4 = '150302';

			if (!isset($data["periode"]))
				$data["periode"] = $this->PeriodeAktif; //date("Y");
			$Params .= "'" . $data["periode"] . "',";

			$Pages = 0;
			$data["pages"] = $Pages;
			if (isset($data["page"]))
				$Params .= "," . $data["page"];
			else
				$Params .= ",1";
			// $oQueryList01 = $this->bsa_model->get_data_list_ext($this->AppModule, $this->KodeView . $this->KodeMenu, "01", "'" . $this->PeriodeAktif . "'");
			// $data["oQueryList01"] = $oQueryList01;

			$data["PeriodeAktif"] = $this->PeriodeAktif;
			$data["TahunAktif"] = $this->TahunAktif;

			//			}

		}
		$this->load_view($data, $view);
	}	
	// Modul Administrasi Surat Start
	function ket0801($data, $view = "app")
	{
		if ($view == "app") {
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$Params = "'" . $KodeUser . "',";
			$Params .= "'1',''";
			

			if (!isset($data["periode"]))
				$data["periode"] = $this->PeriodeAktif; //date("Y");
			$Params .= "'" . $data["periode"] . "',";

			$Pages = 0;
			$data["pages"] = $Pages;
			if (isset($data["page"]))
				$Params .= "," . $data["page"];
			else
				$Params .= ",1";
			$oQueryList01 = $this->bsa_model->get_data_list_ext($this->AppModule, $this->KodeView . $this->KodeMenu, "01", "'" . $this->PeriodeAktif . "'");
			$data["oQueryList01"] = $oQueryList01;
			$oQueryAgenda = $this->bsa_model->get_data_list($this->AppModule, "DashboardAgenda", "'" . $this->PeriodeAktif . "'");
			//echo $oQueryAgenda; die();
			$data["oQueryAgenda"] = $oQueryAgenda;
			$oQueryPosisi = $this->bsa_model->get_data_list($this->AppModule, "DashboardPosisi", "'" . $this->PeriodeAktif . "'");
			//echo $oQueryAgenda; die();
			$data["oQueryPosisi"] = $oQueryPosisi;
			$oQueryGrafik = $this->bsa_model->get_data_list($this->AppModule, "DashboardGrafik", "'" . $this->PeriodeAktif . "'");
			//echo $oQueryAgenda; die();
			$data["oQueryGrafik"] = $oQueryGrafik;

			$data["PeriodeAktif"] = $this->PeriodeAktif;
			$data["TahunAktif"] = $this->TahunAktif;

			//			}

		}
		$this->load_view($data, $view);
	}
	
	function ket080201($data, $view = "app")
	{
		if ($view == "app") {
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$Params = "'" . $KodeUser . "',";
			//			if(isset($data["kode"])) {
			if ($data["MainContentType"] == "frm") {
				if (isset($data["kode"])) {
					$Params .= "'" . $data["kode"] . "',0";
					//					$oQuery = $this->bsa_model->get_data_detail($this->AppModule,$this->KodeMenu,$Params);
					$oQuery = $this->bsa_model->get_data_detail($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
					$data["oQuery"] = $oQuery;
				}
			} else {
				$Params .= "'1',''";

				$Pages = 0;
				$data["pages"] = $Pages;
				if (isset($data["page"]))
					$Params .= "," . $data["page"];
				else
					$Params .= ",1";
				//				$oQueryList = $this->bsa_model->get_data_list($this->AppModule,$this->KodeMenu,$Params);
				$oQueryList = $this->bsa_model->get_data_list($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
				$data["oQueryList"] = $oQueryList;
				//				echo $oQueryList;
			}


			$this->load_view($data, $view);
		} elseif ($view == "prmsave") {
			$KodeLama = $_POST["KodeLama"];
			$Kode = $_POST["Kode"];
			$Nama = $_POST["Nama"];
			$Keterangan = $_POST["Keterangan"];
			$Aktif = $_POST["Aktif"];
			$Params = "'" . $this->sql_safe($KodeLama) . "','" . $this->sql_safe($Kode) . "',";
			$Params .= "'" . $this->sql_safe($Nama) . "','" . $this->sql_safe($Keterangan) . "',";
			$Params .= "'" . $this->sql_safe($Aktif) . "',";
			$Params .= "'" . $this->sql_safe($this->session->get($this->AppModule . "UserID")) . "'";
			return $Params;
		}
	}
	
	function ket080202($data, $view = "app")
	{
		if ($view == "app") {
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$Params = "'" . $KodeUser . "',";
			//			if(isset($data["kode"])) {
			if ($data["MainContentType"] == "frm") {
				if (isset($data["kode"])) {
					$Params .= "'" . $data["kode"] . "',0";
					//					$oQuery = $this->bsa_model->get_data_detail($this->AppModule,$this->KodeMenu,$Params);
					$oQuery = $this->bsa_model->get_data_detail($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
					$data["oQuery"] = $oQuery;
				}
			} else {
				$Params .= "'1',''";

				$Pages = 0;
				$data["pages"] = $Pages;
				if (isset($data["page"]))
					$Params .= "," . $data["page"];
				else
					$Params .= ",1";
				//				$oQueryList = $this->bsa_model->get_data_list($this->AppModule,$this->KodeMenu,$Params);
				$oQueryList = $this->bsa_model->get_data_list($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
				$data["oQueryList"] = $oQueryList;
				//				echo $oQueryList;
			}


			$this->load_view($data, $view);
		} elseif ($view == "prmsave") {
			$KodeLama = $_POST["KodeLama"];
			$Kode = $_POST["Kode"];
			$Nama = $_POST["Nama"];
			$Keterangan = $_POST["Keterangan"];
			$Aktif = $_POST["Aktif"];
			$Params = "'" . $this->sql_safe($KodeLama) . "','" . $this->sql_safe($Kode) . "',";
			$Params .= "'" . $this->sql_safe($Nama) . "','" . $this->sql_safe($Keterangan) . "',";
			$Params .= "'" . $this->sql_safe($Aktif) . "',";
			$Params .= "'" . $this->sql_safe($this->session->get($this->AppModule . "UserID")) . "'";
			return $Params;
		}
	}


	function ket080203($data, $view = "app")
	{
		if ($view == "app") {
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$Params = "'" . $KodeUser . "',";
			//			if(isset($data["kode"])) {
			if ($data["MainContentType"] == "frm") {
				if (isset($data["kode"])) {
					$Params .= "'" . $data["kode"] . "',0";
					//					$oQuery = $this->bsa_model->get_data_detail($this->AppModule,$this->KodeMenu,$Params);
					$oQuery = $this->bsa_model->get_data_detail($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
					$data["oQuery"] = $oQuery;
				}
			} else {
				$Params .= "'1',''";

				$Pages = 0;
				$data["pages"] = $Pages;
				if (isset($data["page"]))
					$Params .= "," . $data["page"];
				else
					$Params .= ",1";
				//				$oQueryList = $this->bsa_model->get_data_list($this->AppModule,$this->KodeMenu,$Params);
				$oQueryList = $this->bsa_model->get_data_list($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
				$data["oQueryList"] = $oQueryList;
				//				echo $oQueryList;
			}


			$this->load_view($data, $view);
		} elseif ($view == "prmsave") {
			$KodeLama = $_POST["KodeLama"];
			$Kode = $_POST["Kode"];
			$Nama = $_POST["Nama"];
			$Keterangan = $_POST["Keterangan"];
			$Aktif = $_POST["Aktif"];
			$Params = "'" . $this->sql_safe($KodeLama) . "','" . $this->sql_safe($Kode) . "',";
			$Params .= "'" . $this->sql_safe($Nama) . "','" . $this->sql_safe($Keterangan) . "',";
			$Params .= "'" . $this->sql_safe($Aktif) . "',";
			$Params .= "'" . $this->sql_safe($this->session->get($this->AppModule . "UserID")) . "'";
			return $Params;
		}
	}

	function ket080204($data, $view = "app")
	{
		if ($view == "app") {
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$Params = "'" . $KodeUser . "',";
			//			if(isset($data["kode"])) {
			if ($data["MainContentType"] == "frm") {
				if (isset($data["kode"])) {
					$Params .= "'" . $data["kode"] . "',0";
					//					$oQuery = $this->bsa_model->get_data_detail($this->AppModule,$this->KodeMenu,$Params);
					$oQuery = $this->bsa_model->get_data_detail($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
					$data["oQuery"] = $oQuery;
				}
			} else {
				$Params .= "'1',''";

				$Pages = 0;
				$data["pages"] = $Pages;
				if (isset($data["page"]))
					$Params .= "," . $data["page"];
				else
					$Params .= ",1";
				//				$oQueryList = $this->bsa_model->get_data_list($this->AppModule,$this->KodeMenu,$Params);
				$oQueryList = $this->bsa_model->get_data_list($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
				$data["oQueryList"] = $oQueryList;
				//				echo $oQueryList;
			}


			$this->load_view($data, $view);
		} elseif ($view == "prmsave") {
			$KodeLama = $_POST["KodeLama"];
			$Kode = $_POST["Kode"];
			$Nama = $_POST["Nama"];
			$Keterangan = $_POST["Keterangan"];
			$Aktif = $_POST["Aktif"];
			$Params = "'" . $this->sql_safe($KodeLama) . "','" . $this->sql_safe($Kode) . "',";
			$Params .= "'" . $this->sql_safe($Nama) . "','" . $this->sql_safe($Keterangan) . "',";
			$Params .= "'" . $this->sql_safe($Aktif) . "',";
			$Params .= "'" . $this->sql_safe($this->session->get($this->AppModule . "UserID")) . "'";
			return $Params;
		}
	}

	function ket080205($data, $view = "app")
	{
		if ($view == "app") {
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$Params = "'" . $KodeUser . "',";
			//			if(isset($data["kode"])) {
			if ($data["MainContentType"] == "frm") {
				if (isset($data["kode"])) {
					$Params .= "'" . $data["kode"] . "',0";
					//					$oQuery = $this->bsa_model->get_data_detail($this->AppModule,$this->KodeMenu,$Params);
					$oQuery = $this->bsa_model->get_data_detail($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
					$data["oQuery"] = $oQuery;
				}
			} else {
				$Params .= "'1',''";

				$Pages = 0;
				$data["pages"] = $Pages;
				if (isset($data["page"]))
					$Params .= "," . $data["page"];
				else
					$Params .= ",1";
				//				$oQueryList = $this->bsa_model->get_data_list($this->AppModule,$this->KodeMenu,$Params);
				$oQueryList = $this->bsa_model->get_data_list($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
				$data["oQueryList"] = $oQueryList;
				//				echo $oQueryList;
			}


			$this->load_view($data, $view);
		} elseif ($view == "prmsave") {
			$KodeLama = $_POST["KodeLama"];
			$Kode = $_POST["Kode"];
			$Nama = $_POST["Nama"];
			$Keterangan = $_POST["Keterangan"];
			$Aktif = $_POST["Aktif"];
			$Params = "'" . $this->sql_safe($KodeLama) . "','" . $this->sql_safe($Kode) . "',";
			$Params .= "'" . $this->sql_safe($Nama) . "','" . $this->sql_safe($Keterangan) . "',";
			$Params .= "'" . $this->sql_safe($Aktif) . "',";
			$Params .= "'" . $this->sql_safe($this->session->get($this->AppModule . "UserID")) . "'";
			return $Params;
		}
	}

	function ket080206($data, $view = "app")
	{
		if ($view == "app") {
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$Params = "'" . $KodeUser . "',";
			//			if(isset($data["kode"])) {
			if ($data["MainContentType"] == "frm") {
				if (isset($data["kode"])) {
					$Params .= "'" . $data["kode"] . "',0";
					//					$oQuery = $this->bsa_model->get_data_detail($this->AppModule,$this->KodeMenu,$Params);
					$oQuery = $this->bsa_model->get_data_detail($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
					$data["oQuery"] = $oQuery;
				}
			} else {
				$Params .= "'1',''";

				$Pages = 0;
				$data["pages"] = $Pages;
				if (isset($data["page"]))
					$Params .= "," . $data["page"];
				else
					$Params .= ",1";
				//				$oQueryList = $this->bsa_model->get_data_list($this->AppModule,$this->KodeMenu,$Params);
				$oQueryList = $this->bsa_model->get_data_list($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
				$data["oQueryList"] = $oQueryList;
				//				echo $oQueryList;
			}


			$this->load_view($data, $view);
		} elseif ($view == "prmsave") {
			$KodeLama = $_POST["KodeLama"];
			$Kode = $_POST["Kode"];
			$Nama = $_POST["Nama"];
			$Keterangan = $_POST["Keterangan"];
			$Aktif = $_POST["Aktif"];
			$Params = "'" . $this->sql_safe($KodeLama) . "','" . $this->sql_safe($Kode) . "',";
			$Params .= "'" . $this->sql_safe($Nama) . "','" . $this->sql_safe($Keterangan) . "',";
			$Params .= "'" . $this->sql_safe($Aktif) . "',";
			$Params .= "'" . $this->sql_safe($this->session->get($this->AppModule . "UserID")) . "'";
			return $Params;
		}
	}
	
	function ket080207($data, $view = "app")
	{
		if ($view == "app") {
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$Params = "'" . $KodeUser . "',";
			//			if(isset($data["kode"])) {
			if ($data["MainContentType"] == "frm") {
				if (isset($data["kode"])) {
					$Params .= "'" . $data["kode"] . "',0";
					//					$oQuery = $this->bsa_model->get_data_detail($this->AppModule,$this->KodeMenu,$Params);
					$oQuery = $this->bsa_model->get_data_detail($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
					$data["oQuery"] = $oQuery;
				}
			} else {
				$Params .= "'1',''";

				$Pages = 0;
				$data["pages"] = $Pages;
				if (isset($data["page"]))
					$Params .= "," . $data["page"];
				else
					$Params .= ",1";
				//				$oQueryList = $this->bsa_model->get_data_list($this->AppModule,$this->KodeMenu,$Params);
				$oQueryList = $this->bsa_model->get_data_list($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
				$data["oQueryList"] = $oQueryList;
				//				echo $oQueryList;
			}


			$this->load_view($data, $view);
		} elseif ($view == "prmsave") {
			$KodeLama = $_POST["KodeLama"];
			$Kode = $_POST["Kode"];
			$Nama = $_POST["Nama"];
			$Keterangan = $_POST["Keterangan"];
			$Aktif = $_POST["Aktif"];
			$Params = "'" . $this->sql_safe($KodeLama) . "','" . $this->sql_safe($Kode) . "',";
			$Params .= "'" . $this->sql_safe($Nama) . "','" . $this->sql_safe($Keterangan) . "',";
			$Params .= "'" . $this->sql_safe($Aktif) . "',";
			$Params .= "'" . $this->sql_safe($this->session->get($this->AppModule . "UserID")) . "'";
			return $Params;
		}
	}
	
	function ket080301($data, $view = "app")
	{
		if ($view == "app") {
			$KodeUser = $this->session->get($this->AppModule . "UserID"); 
			$Params = "'" . $KodeUser . "',";
			if (!isset($data["periode"]))
				$data["periode"] = $this->PeriodeAktif; //date("Y");
			$Params .= "'" . $data["periode"] . "',";  //echo $data["MainContentType"]; die();
			if ($data["MainContentType"] == "frm") {
				if (isset($data["kode"])) {
					$Params .= "'" . $data["kode"] . "',0";
					$oQuery = $this->bsa_model->get_data_detail($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
					$data["oQuery"] = $oQuery;
					//echo $oQuery; die();
				}
				
				//echo $oQueryJenis; die();
			} else { //echo "masuk"; die();
				if (isset($data["keyword"]))
					$Params .= "'1','" . $data["keyword"] . "'";
				else {
					$Params .= "'1',''";
					$data["keyword"] = "";
				}
				$Params .= ",1";
				$oQueryList = $this->bsa_model->get_data_list($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
				$data["oQueryList"] = $oQueryList;
				$oQueryJenis = $this->bsa_model->get_combo_list($this->AppModule, "ComboJenisSurat", "'" . $KodeUser . "'");
				$data["oQueryJenis"] = $oQueryJenis;
				//echo $oQueryList; die();
			}
			$oQueryPeriode = $this->bsa_model->get_combo_list($this->AppModule, "ComboPeriode", "'" . $KodeUser . "'");
			$data["oQueryPeriode"] = $oQueryPeriode;
		} elseif ($view == "prmsave") {
			$KodeLama = $_POST["KodeLama"];
			$Tahun = $_POST["Tahun"];

			$RegNo = $_POST["RegNo"];
			$RegTanggal = $_POST["RegTanggal"];
			$NomorSurat = $_POST["NomorSurat"];
			$TanggalSurat = $_POST["TanggalSurat"];
			$Pengirim = $_POST["Pengirim"];
			$Kepada = $_POST["Kepada"];
			$Perihal = $_POST["Perihal"];
			$Jenis = $_POST["Jenis"];

			$Agenda = $_POST["Agenda"];
			$AgendaTempat =	$_POST["AgendaTempat"];
			$AgendaTanggal = $_POST["AgendaTanggal"];
			$AgendaDeskripsi = $_POST["AgendaDeskripsi"];


			$Params = "'" . $this->sql_safe($KodeLama) . "','" . $this->sql_safe($Tahun) . "',";
			$Params .= "'" . $this->sql_safe($RegNo) . "','" . $this->sql_safe($RegTanggal) . "',";
			$Params .= "'" . $this->sql_safe($NomorSurat) . "','" . $this->sql_safe($TanggalSurat) . "',";
			$Params .= "'" . $this->sql_safe($Pengirim) . "','" . $this->sql_safe($Kepada) . "','" . $this->sql_safe($Perihal) . "',";
			$Params .= "'" . $this->sql_safe($Jenis) . "','" . $this->sql_safe($Agenda) . "',";
			$Params .= "'" . $this->sql_safe($AgendaTempat) . "','" . $this->sql_safe($AgendaTanggal) . "',";
			$Params .= "'" . $this->sql_safe($AgendaDeskripsi) . "',";

			$Params .= "'" . $this->sql_safe($this->session->get($this->AppModule . "UserID")) . "'";
			return $Params;
		}
		$this->load_view($data, $view);
	}

	

	function ket080302($data, $view = "app")
	{
		if ($view == "app") {
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$Params = "'" . $KodeUser . "',";
			if (!isset($data["periode"]))
				$data["periode"] = $this->PeriodeAktif; //date("Y");
			$Params .= "'" . $data["periode"] . "',";
			$oQueryPeriode = $this->bsa_model->get_combo_list($this->AppModule, "ComboPeriode", "'" . $KodeUser . "'");
			$data["oQueryPeriode"] = $oQueryPeriode;
			if ($data["MainContentType"] == "frm") {
				if (isset($data["kode"])) {
					$Params .= "'" . $data["kode"] . "',0";
					$oQuery = $this->bsa_model->get_data_detail($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
					$data["oQuery"] = $oQuery;
					//echo $oQuery; die();
				}
				$oQueryArsipLokasi = $this->bsa_model->get_combo_list($this->AppModule, "ComboLokasiArsip", "'" . $KodeUser . "'");
				$data["oQueryArsipLokasi"] = $oQueryArsipLokasi;

				//echo $oQueryLokasi; die();
			} else {
				if (isset($data["keyword"]))
					$Params .= "'1','" . $data["keyword"] . "'";
				else {
					$Params .= "'1',''";
					$data["keyword"] = "";
				}
				$Params .= ",1";
				$oQueryList = $this->bsa_model->get_data_list($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
				$data["oQueryList"] = $oQueryList;
				//echo $oQueryList; die();
			}
		} elseif ($view == "prmsave") {
			$KodeLama = $_POST["KodeLama"];
			$Tahun = $_POST["Tahun"];

			$ArsipTanggal = $_POST["ArsipTanggal"]; 
			$ArsipLokasi = $_POST["ArsipLokasi"];	

			$Params = "'" . $this->sql_safe($KodeLama) . "','" . $this->sql_safe($Tahun) . "',";
			$Params .= "'" . $this->sql_safe($ArsipTanggal) . "','" . $this->sql_safe($ArsipLokasi) . "',";
			$Params .= "'" . $this->sql_safe($this->session->get($this->AppModule . "UserID")) . "'";
			return $Params;
		}
		$this->load_view($data, $view);
	}

	function ket080303($data, $view = "app")
	{
		if ($view == "app") {
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$Params = "'" . $KodeUser . "',";
			if (!isset($data["periode"]))
				$data["periode"] = $this->PeriodeAktif; //date("Y");
			$Params .= "'" . $data["periode"] . "',";
			$oQueryPeriode = $this->bsa_model->get_combo_list($this->AppModule, "ComboPeriode", "'" . $KodeUser . "'");
			$data["oQueryPeriode"] = $oQueryPeriode;
			if ($data["MainContentType"] == "frm") {
				if (isset($data["kode"])) {
					$Params .= "'" . $data["kode"] . "',0";
					$oQuery = $this->bsa_model->get_data_detail($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
					$data["oQuery"] = $oQuery;
					$oQueryHdr = $this->bsa_model->get_print_hdr($this->AppModule, $this->KodeView . $this->KodeMenu, $doc, $Params);
					$data["oQueryHdr"] = $oQueryHdr;
				}
			} else {
				$Params .= "'1',''";
				//$Params .= "'1','".$data["param01"]."'" ;

				$Pages = 0;
				$data["pages"] = $Pages;
				if (isset($data["page"]))
					$Params .= "," . $data["page"];
				else
					$Params .= ",1";
				$oQueryList = $this->bsa_model->get_data_list($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
				$data["oQueryList"] = $oQueryList;
			}
			$this->load_view($data, $view);
		} elseif ($view == "prmprnhdr") {
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$Periode = $_POST["Periode"];
			$Kode = $_POST["Kode"];
			$Params = "'" . $this->sql_safe($KodeUser) . "','" . $this->sql_safe($Periode) . "',";
			$Params .= "'" . $Kode . "',0";
			//			echo $Params; die();
			return $Params;
		} elseif ($view == "prmprnlst") {
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$Periode = $_POST["Periode"];
			$Kode = $_POST["Kode"];
			$Params = "'" . $this->sql_safe($KodeUser) . "','" . $this->sql_safe($Periode) . "',";
			$Params .= "'" . $Kode . "',0";
			//			echo $Params; die();
			return $Params;
		}
	}
    
    function ket080304($data, $view = "app")
	{
		if ($view == "app") {
			$KodeUser = $this->session->get($this->AppModule . "UserID"); 
			$Params = "'" . $KodeUser . "',";
			if (!isset($data["periode"]))
				$data["periode"] = $this->PeriodeAktif; //date("Y");
			$Params .= "'" . $data["periode"] . "',";  //echo $data["MainContentType"]; die();
			if ($data["MainContentType"] == "frm") {
				if (isset($data["kode"])) {
					$Params .= "'" . $data["kode"] . "',0";
					$oQuery = $this->bsa_model->get_data_detail($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
					$data["oQuery"] = $oQuery;
					//echo $oQuery; die();
					$oQueryJenis = $this->bsa_model->get_combo_list($this->AppModule, "ComboJenisSurat", "'" . $KodeUser . "'");
				    $data["oQueryJenis"] = $oQueryJenis;
				}
				
				//echo $oQueryJenis; die();
			} elseif ($data["MainContentType"] == "dtl") {
				// if (isset($data["kode"])) {
					$Params .= "'" . $data["kode"] . "',0";
					$oQuery = $this->bsa_model->get_data_detail($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
					$data["oQuery"] = $oQuery;
					//echo $oQuery; die();
					$oQueryJenis = $this->bsa_model->get_combo_list($this->AppModule, "ComboJenisSurat", "'" . $KodeUser . "'");
				    $data["oQueryJenis"] = $oQueryJenis;
				// }
				
				//echo $oQueryJenis; die();
			} else { //echo "masuk"; die();
				if (isset($data["keyword"]))
					$Params .= "'1','" . $data["keyword"] . "'";
				else {
					$Params .= "'1',''";
					$data["keyword"] = "";
				}
				$Params .= ",1";
				$oQueryList = $this->bsa_model->get_data_list($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
				$data["oQueryList"] = $oQueryList;
				$oQueryJenis = $this->bsa_model->get_combo_list($this->AppModule, "ComboJenisSurat", "'" . $KodeUser . "'");
				$data["oQueryJenis"] = $oQueryJenis;
				//echo $oQueryList; die();
			}
			$oQueryPeriode = $this->bsa_model->get_combo_list($this->AppModule, "ComboPeriode", "'" . $KodeUser . "'");
			$data["oQueryPeriode"] = $oQueryPeriode;
		} elseif ($view == "prmsave") {
			$KodeLama = $_POST["KodeLama"];
			$Tahun = $_POST["Tahun"];

			$RegNo = $_POST["RegNo"];
			$RegTanggal = $_POST["RegTanggal"];
			$NomorSurat = $_POST["NomorSurat"];
			$TanggalSurat = $_POST["TanggalSurat"];
			$Pengirim = $_POST["Pengirim"];
			$Kepada = $_POST["Kepada"];
			$Perihal = $_POST["Perihal"];
			$Jenis = $_POST["Jenis"];

			$Agenda = $_POST["Agenda"];
			$AgendaTempat =	$_POST["AgendaTempat"];
			$AgendaTanggal = $_POST["AgendaTanggal"];
			$AgendaDeskripsi = $_POST["AgendaDeskripsi"];


			$Params = "'" . $this->sql_safe($KodeLama) . "','" . $this->sql_safe($Tahun) . "',";
			$Params .= "'" . $this->sql_safe($RegNo) . "','" . $this->sql_safe($RegTanggal) . "',";
			$Params .= "'" . $this->sql_safe($NomorSurat) . "','" . $this->sql_safe($TanggalSurat) . "',";
			$Params .= "'" . $this->sql_safe($Pengirim) . "','" . $this->sql_safe($Kepada) . "','" . $this->sql_safe($Perihal) . "',";
			$Params .= "'" . $this->sql_safe($Jenis) . "','" . $this->sql_safe($Agenda) . "',";
			$Params .= "'" . $this->sql_safe($AgendaTempat) . "','" . $this->sql_safe($AgendaTanggal) . "',";
			$Params .= "'" . $this->sql_safe($AgendaDeskripsi) . "',";

			$Params .= "'" . $this->sql_safe($this->session->get($this->AppModule . "UserID")) . "'";
			return $Params;
		}
		$this->load_view($data, $view);
	}
	
	
	function ket080305($data, $view = "app")
	{
		if ($view == "app") {
			$KodeUser = $this->session->get($this->AppModule . "UserID"); 
			$Params = "'" . $KodeUser . "',";
			if (!isset($data["periode"]))
				$data["periode"] = $this->PeriodeAktif; //date("Y");
			$Params .= "'" . $data["periode"] . "',";  //echo $data["MainContentType"]; die();
			if ($data["MainContentType"] == "frm") {
				if (isset($data["kode"])) {
					$Params .= "'" . $data["kode"] . "',0";
					$oQuery = $this->bsa_model->get_data_detail($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
					$data["oQuery"] = $oQuery;
					$oQueryList = $this->bsa_model->get_detail_list($this->AppModule, $this->KodeView . $this->KodeMenu, "", "'" . $data["kode"] . "'");
					$data["oQueryList"] = $oQueryList;
					//echo $oQuery; die();
					$oQueryJenis = $this->bsa_model->get_combo_list($this->AppModule, "ComboJenisSurat", "'" . $KodeUser . "'");
				    $data["oQueryJenis"] = $oQueryJenis;
				}
				
				//echo $oQueryJenis; die();
			} else { //echo "masuk"; die();
				if (isset($data["keyword"]))
					$Params .= "'1','" . $data["keyword"] . "'";
				else {
					$Params .= "'1',''";
					$data["keyword"] = "";
				}
				$Params .= ",1";
				$oQueryList = $this->bsa_model->get_data_list($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
				$data["oQueryList"] = $oQueryList;
				$oQueryJenis = $this->bsa_model->get_combo_list($this->AppModule, "ComboJenisSurat", "'" . $KodeUser . "'");
				$data["oQueryJenis"] = $oQueryJenis;
				//echo $oQueryList; die();
			}
			$oQueryPeriode = $this->bsa_model->get_combo_list($this->AppModule, "ComboPeriode", "'" . $KodeUser . "'");
			$data["oQueryPeriode"] = $oQueryPeriode;
		} elseif ($view == "prmsave") {
			$KodeLama = $_POST["KodeLama"];
			$Tahun = $_POST["Tahun"];

			$RegNo = $_POST["RegNo"];
			$RegTanggal = $_POST["RegTanggal"];
			$NomorSurat = $_POST["NomorSurat"];
			$TanggalSurat = $_POST["TanggalSurat"];
			$Pengirim = $_POST["Pengirim"];
			$Kepada = $_POST["Kepada"];
			$Perihal = $_POST["Perihal"];
			$Jenis = $_POST["Jenis"];

			$Agenda = $_POST["Agenda"];
			$AgendaTempat =	$_POST["AgendaTempat"];
			$AgendaTanggal = $_POST["AgendaTanggal"];
			$AgendaDeskripsi = $_POST["AgendaDeskripsi"];


			$Params = "'" . $this->sql_safe($KodeLama) . "','" . $this->sql_safe($Tahun) . "',";
			$Params .= "'" . $this->sql_safe($RegNo) . "','" . $this->sql_safe($RegTanggal) . "',";
			$Params .= "'" . $this->sql_safe($NomorSurat) . "','" . $this->sql_safe($TanggalSurat) . "',";
			$Params .= "'" . $this->sql_safe($Pengirim) . "','" . $this->sql_safe($Kepada) . "','" . $this->sql_safe($Perihal) . "',";
			$Params .= "'" . $this->sql_safe($Jenis) . "','" . $this->sql_safe($Agenda) . "',";
			$Params .= "'" . $this->sql_safe($AgendaTempat) . "','" . $this->sql_safe($AgendaTanggal) . "',";
			$Params .= "'" . $this->sql_safe($AgendaDeskripsi) . "',";

			$Params .= "'" . $this->sql_safe($this->session->get($this->AppModule . "UserID")) . "'";
			return $Params;
		}
		$this->load_view($data, $view);
	}
	
	function ket080308($data, $view = "app")
	{
		if ($view == "app") {
			$KodeUser = $this->session->get($this->AppModule . "UserID"); 
			$Params = "'" . $KodeUser . "',";
			if (!isset($data["periode"]))
				$data["periode"] = $this->PeriodeAktif; //date("Y");
			$Params .= "'" . $data["periode"] . "',";  //echo $data["MainContentType"]; die();
			if ($data["MainContentType"] == "frm") {
				if (isset($data["kode"])) {
					$Params .= "'" . $data["kode"] . "',0";
					$oQuery = $this->bsa_model->get_data_detail($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
					$data["oQuery"] = $oQuery;
					$oQueryList = $this->bsa_model->get_detail_list($this->AppModule, $this->KodeView . $this->KodeMenu, "", "'" . $data["kode"] . "'");
					$data["oQueryList"] = $oQueryList;
					//echo $oQuery; die();
					$oQueryJenis = $this->bsa_model->get_combo_list($this->AppModule, "ComboJenisSurat", "'" . $KodeUser . "'");
				    $data["oQueryJenis"] = $oQueryJenis;
				}
				
				//echo $oQueryJenis; die();
			} elseif ($data["MainContentType"] == "dtl") {
				// if (isset($data["kode"])) {
					$Params .= "'" . $data["kode"] . "',0";
					$oQuery = $this->bsa_model->get_data_detail($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
					$data["oQuery"] = $oQuery;
					//echo $oQuery; die();
					$oQueryJenis = $this->bsa_model->get_combo_list($this->AppModule, "ComboJenisSurat", "'" . $KodeUser . "'");
				    $data["oQueryJenis"] = $oQueryJenis;
				// }
				
				//echo $oQueryJenis; die();
			} else { //echo "masuk"; die();
				if (isset($data["keyword"]))
					$Params .= "'1','" . $data["keyword"] . "'";
				else {
					$Params .= "'1',''";
					$data["keyword"] = "";
				}
				$Params .= ",1";
				$oQueryList = $this->bsa_model->get_data_list($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
				$data["oQueryList"] = $oQueryList;
				//echo $oQueryList; die();
				$oQueryJenis = $this->bsa_model->get_combo_list($this->AppModule, "ComboJenisSurat", "'" . $KodeUser . "'");
				$data["oQueryJenis"] = $oQueryJenis;
				//echo $oQueryList; die();
			}
			$oQueryPeriode = $this->bsa_model->get_combo_list($this->AppModule, "ComboPeriode", "'" . $KodeUser . "'");
			$data["oQueryPeriode"] = $oQueryPeriode;
		} elseif ($view == "prmsave") {
			$KodeLama = $_POST["KodeLama"];
			$Tahun = $_POST["Tahun"];
			$MsgDeskripsi = $_POST["MsgDeskripsi"];


			$Params = "'" . $this->sql_safe($KodeLama) . "','" . $this->sql_safe($Tahun) . "',";
			$Params .= "'" . $this->sql_safe($MsgDeskripsi) . "',";
			$Params .= "'" . $this->sql_safe($this->session->get($this->AppModule . "UserID")) . "'";
			return $Params;
		}
		$this->load_view($data, $view);
	}
	
    function ket080401($data, $view = "app")
	{
		if ($view == "app") {
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$Params = "'" . $KodeUser . "',";
			if (!isset($data["periode"]))
				$data["periode"] = $this->PeriodeAktif; //date("Y");
			$Params .= "'" . $data["periode"] . "',";  //echo $data["MainContentType"]; die();
			if ($data["MainContentType"] == "frm") {
				if (isset($data["kode"])) {
					$Params .= "'" . $data["kode"] . "',0";
					$oQuery = $this->bsa_model->get_data_detail($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
					$data["oQuery"] = $oQuery;
					//echo $oQuery; die();
					$oQueryJenis = $this->bsa_model->get_combo_list($this->AppModule, "ComboJenisSuratKeluar", "'" . $KodeUser . "'");
					$data["oQueryJenis"] = $oQueryJenis;
					//echo $oQueryJenis; die();
					$oQueryKop = $this->bsa_model->get_combo_list($this->AppModule, "ComboHeadersurat", "'" . $KodeUser . "'");
					$data["oQueryKop"] = $oQueryKop;
				}
			} elseif ($data["MainContentType"] == "dtl") {
				// if (isset($data["kode"])) {
				$Params .= "'" . $data["kode"] . "',0";
				$oQuery = $this->bsa_model->get_data_detail($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
				$data["oQuery"] = $oQuery;
				//echo $oQuery; die();
				$oQueryJenis = $this->bsa_model->get_combo_list($this->AppModule, "ComboJenisSurat", "'" . $KodeUser . "'");
				$data["oQueryJenis"] = $oQueryJenis;
				$oQueryKop = $this->bsa_model->get_combo_list($this->AppModule, "ComboHeadersurat", "'" . $KodeUser . "'");
					$data["oQueryKop"] = $oQueryKop;		

				//echo $oQueryJenis; die();
			} else { //echo "masuk"; die();
				if (isset($data["keyword"]))
					$Params .= "'1','" . $data["keyword"] . "'";
				else {
					$Params .= "'1',''";
					$data["keyword"] = "";
				}
				$Params .= ",1";
				$oQueryList = $this->bsa_model->get_data_list($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
				$data["oQueryList"] = $oQueryList;
			}
			$oQueryPeriode = $this->bsa_model->get_combo_list($this->AppModule, "ComboPeriode", "'" . $KodeUser . "'");
			$data["oQueryPeriode"] = $oQueryPeriode;
		} elseif ($view == "prmsave") {
			$KodeLama = $_POST["KodeLama"];
			$Tahun = $_POST["Tahun"];
			$RegNo = $_POST["RegNo"];
			$RegTanggal = $_POST["RegTanggal"]; //echo "tes"; die();


			$Kepada = $_POST["Kepada"];
			$AlamatKepada = $_POST["AlamatKepada"];
			$Perihal = $_POST["Perihal"];
			$Jenis = $_POST["Jenis"];
			$KodeHeader = $_POST["KodeHeader"];
			$Tembusan = $_POST["Tembusan"];
			$Isi = $this->get_body_string($_POST["Isi"]);


			$Params = "'" . $this->sql_safe($KodeLama) . "','" . $this->sql_safe($Tahun) . "',";
			$Params .= "'" . $this->sql_safe($RegNo) . "','" . $this->sql_safe($RegTanggal) . "',";
			$Params .= "'" . $this->sql_safe($Kepada) . "','" . $this->sql_safe($AlamatKepada) . "',";
			$Params .= "'" . $this->sql_safe($Perihal) . "','" . $this->sql_safe($Jenis) . "',";
			$Params .= "'" . $this->sql_safe($KodeHeader) . "','" . $this->sql_safe($Tembusan) . "',";
			$Params .= "'" . $this->sql_safe($Isi) . "',";
			$Params .= "'" . $this->sql_safe($this->session->get($this->AppModule . "UserID")) . "'";
			return $Params;
		}
		$this->load_view($data, $view);
	}
	function ket080404($data, $view = "app")
	{
		if ($view == "app") {
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$Params = "'" . $KodeUser . "',";
			if (!isset($data["periode"]))
				$data["periode"] = $this->PeriodeAktif; //date("Y");
			$Params .= "'" . $data["periode"] . "',";  //echo $data["MainContentType"]; die();
			if ($data["MainContentType"] == "frm") {
				if (isset($data["kode"])) {
					$Params .= "'" . $data["kode"] . "',0";
					$oQuery = $this->bsa_model->get_data_detail($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
					$data["oQuery"] = $oQuery;
					$oQueryList = $this->bsa_model->get_detail_list($this->AppModule, $this->KodeView . $this->KodeMenu, "", "'" . $data["kode"] . "'");
					$data["oQueryList"] = $oQueryList;
					//echo $oQueryList; die();
					$oQueryJenis = $this->bsa_model->get_combo_list($this->AppModule, "ComboJenisSurat", "'" . $KodeUser . "'");
					$data["oQueryJenis"] = $oQueryJenis;
				}

				//echo $oQueryJenis; die();
			} else { //echo "masuk"; die();
				if (isset($data["keyword"]))
					$Params .= "'1','" . $data["keyword"] . "'";
				else {
					$Params .= "'1',''";
					$data["keyword"] = "";
				}
				$Params .= ",1";
				$oQueryList = $this->bsa_model->get_data_list($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
				$data["oQueryList"] = $oQueryList;
				$oQueryJenis = $this->bsa_model->get_combo_list($this->AppModule, "ComboJenisSurat", "'" . $KodeUser . "'");
				$data["oQueryJenis"] = $oQueryJenis;
				//echo $oQueryList; die();
			}
			$oQueryPeriode = $this->bsa_model->get_combo_list($this->AppModule, "ComboPeriode", "'" . $KodeUser . "'");
			$data["oQueryPeriode"] = $oQueryPeriode;
		} elseif ($view == "prmsave") {
			$KodeLama = $_POST["KodeLama"];
			$Tahun = $_POST["Tahun"];

			$RegNo = $_POST["RegNo"];
			$RegTanggal = $_POST["RegTanggal"];
			$NomorSurat = $_POST["NomorSurat"];
			$TanggalSurat = $_POST["TanggalSurat"];
			$Pengirim = $_POST["Pengirim"];
			$Kepada = $_POST["Kepada"];
			$Perihal = $_POST["Perihal"];
			$Jenis = $_POST["Jenis"];

			$Agenda = $_POST["Agenda"];
			$AgendaTempat =	$_POST["AgendaTempat"];
			$AgendaTanggal = $_POST["AgendaTanggal"];
			$AgendaDeskripsi = $_POST["AgendaDeskripsi"];


			$Params = "'" . $this->sql_safe($KodeLama) . "','" . $this->sql_safe($Tahun) . "',";
			$Params .= "'" . $this->sql_safe($RegNo) . "','" . $this->sql_safe($RegTanggal) . "',";
			$Params .= "'" . $this->sql_safe($NomorSurat) . "','" . $this->sql_safe($TanggalSurat) . "',";
			$Params .= "'" . $this->sql_safe($Pengirim) . "','" . $this->sql_safe($Kepada) . "','" . $this->sql_safe($Perihal) . "',";
			$Params .= "'" . $this->sql_safe($Jenis) . "','" . $this->sql_safe($Agenda) . "',";
			$Params .= "'" . $this->sql_safe($AgendaTempat) . "','" . $this->sql_safe($AgendaTanggal) . "',";
			$Params .= "'" . $this->sql_safe($AgendaDeskripsi) . "',";

			$Params .= "'" . $this->sql_safe($this->session->get($this->AppModule . "UserID")) . "'";
			return $Params;
		}
		$this->load_view($data, $view);
	}
	
	function ket080501($data, $view = "app")
	{
		if ($view == "app") {
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$Params = "'" . $KodeUser . "',";
			if (!isset($data["periode"]))
				$data["periode"] = $this->PeriodeAktif; //date("Y");
			$Params .= "'" . $data["periode"] . "',";
			$oQueryPeriode = $this->bsa_model->get_combo_list($this->AppModule, "ComboPeriode", "'" . $KodeUser . "'");
			$data["oQueryPeriode"] = $oQueryPeriode;
			if ($data["MainContentType"] == "frm") {
				if (isset($data["kode"])) {
					$Params .= "'" . $data["kode"] . "',0";
					$oQuery = $this->bsa_model->get_data_detail($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
					$data["oQuery"] = $oQuery;
					// echo $oQuery; die();
				}
				$oQueryPejabat = $this->bsa_model->get_combo_list($this->AppModule, "ComboSOPeriodik", "'" . $KodeUser . "'");
				$data["oQueryPejabat"] = $oQueryPejabat;
				$oQueryDispoKe = $this->bsa_model->get_combo_list($this->AppModule, "ComboDispoSurat", "'" . $KodeUser . "'");
				$data["oQueryDispoKe"] = $oQueryDispoKe;
				$oQueryAjukanCaption = $this->bsa_model->get_combo_list($this->AppModule, "ComboIntruksiAjukan", "'" . $KodeUser . "'");
				$data["oQueryAjukanCaption"] = $oQueryAjukanCaption;
				$oQueryDispoCaption = $this->bsa_model->get_combo_list($this->AppModule, "ComboIntruksiDispo", "'" . $KodeUser . "'");
				$data["oQueryDispoCaption"] = $oQueryDispoCaption;

				//echo $oQueryLokasi; die();
			} else {
				if (isset($data["keyword"]))
					$Params .= "'1','" . $data["keyword"] . "'";
				else {
					$Params .= "'1',''";
					$data["keyword"] = "";
				}
				$Params .= ",1";
				$oQueryList = $this->bsa_model->get_data_list($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
				$data["oQueryList"] = $oQueryList;
				//echo $oQueryList; die();
			}
		} elseif ($view == "prmsave") {
			$KodeLama = $_POST["KodeLama"];
			$Tahun = $_POST["Tahun"];

			$DispoKe = $_POST["DispoKe"];
			$DispoTanggal = $_POST["DispoTanggal"];
			$DispoCaption = $_POST["DispoCaption"];
			$DispoCatatan = $_POST["DispoCatatan"];



			$Params = "'" . $this->sql_safe($KodeLama) . "','" . $this->sql_safe($Tahun) . "',";
			$Params .= "'" . $this->sql_safe($DispoKe) . "','" . $this->sql_safe($DispoTanggal) . "',";
			$Params .= "'" . $this->sql_safe($DispoCaption) . "','" . $this->sql_safe($DispoCatatan) . "',";
			$Params .= "'" . $this->sql_safe($this->session->get($this->AppModule . "UserID")) . "'";
			return $Params;
		}
		$this->load_view($data, $view);
	}	

	function ket080509($data, $view = "app")
	{
		if ($view == "app") {
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$Params = "'" . $KodeUser . "',";
			if (!isset($data["periode"]))
				$data["periode"] = $this->PeriodeAktif; //date("Y");
			$Params .= "'" . $data["periode"] . "',";
			$oQueryPeriode = $this->bsa_model->get_combo_list($this->AppModule, "ComboPeriode", "'" . $KodeUser . "'");
			$data["oQueryPeriode"] = $oQueryPeriode;
				
			if ($data["MainContentType"] == "frm") {
				if (isset($data["kode"])) {
					$Params .= "'" . $data["kode"] . "',0";
					//					$oQuery = $this->bsa_model->get_data_detail($this->AppModule,$this->KodeMenu,$Params);
					$oQuery = $this->bsa_model->get_data_detail($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
					$data["oQuery"] = $oQuery;
				}
			} else {
				$Params .= "'1',''";

				$Pages = 0;
				$data["pages"] = $Pages;
				if (isset($data["page"]))
					$Params .= "," . $data["page"];
				else
					$Params .= ",1";
				$oQueryList = $this->bsa_model->get_data_list($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
				$data["oQueryList"] = $oQueryList;
				// echo $oQueryList; die();
			}


			$this->load_view($data, $view);
		} 
	}    
    
    function ket080601($data, $view = "app")
	{
		if ($view == "app") {
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$Params = "'" . $KodeUser . "',";
			if (!isset($data["periode"]))
				$data["periode"] = $this->PeriodeAktif; //date("Y");
			$Params .= "'" . $data["periode"] . "',";
			$oQueryPeriode = $this->bsa_model->get_combo_list($this->AppModule, "ComboPeriode", "'" . $KodeUser . "'");
			$data["oQueryPeriode"] = $oQueryPeriode;
			if ($data["MainContentType"] == "frm") {
				if (isset($data["kode"])) {
					$Params .= "'" . $data["kode"] . "',0";
					$oQuery = $this->bsa_model->get_data_detail($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
					$data["oQuery"] = $oQuery;
					//echo $oQuery; die();
				}
				$oQueryAjukanKe = $this->bsa_model->get_combo_list($this->AppModule, "ComboAjukanSurat", "'" . $KodeUser . "'");
				$data["oQueryAjukanKe"] = $oQueryAjukanKe;
				$oQueryAjukanCaption = $this->bsa_model->get_combo_list($this->AppModule, "ComboIntruksiAjukan", "'" . $KodeUser . "'");
				$data["oQueryAjukanCaption"] = $oQueryAjukanCaption;

				//echo $oQueryLokasi; die();
			} else {
				if (isset($data["keyword"]))
					$Params .= "'1','" . $data["keyword"] . "'";
				else {
					$Params .= "'1',''";
					$data["keyword"] = "";
				}
				$Params .= ",1";
				$oQueryList = $this->bsa_model->get_data_list($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
				$data["oQueryList"] = $oQueryList;
				//echo $oQueryList; die();
			}
		} elseif ($view == "prmsave") {
			$KodeLama = $_POST["KodeLama"];
			$Tahun = $_POST["Tahun"];

			$AjukanKe = $_POST["AjukanKe"];
			$AjukanCC = $_POST["AjukanCC"];
			$AjukanTanggal = $_POST["AjukanTanggal"];
			$AjukanCaption = $_POST["AjukanCaption"];
			$AjukanCatatan = $_POST["AjukanCatatan"];



			$Params = "'" . $this->sql_safe($KodeLama) . "','" . $this->sql_safe($Tahun) . "',";
			$Params .= "'" . $this->sql_safe($AjukanKe) . "','" . $this->sql_safe($AjukanCC) . "',";
			$Params .= "'" . $this->sql_safe($AjukanTanggal) . "','" . $this->sql_safe($AjukanCaption) . "','" . $this->sql_safe($AjukanCatatan) . "',";
			$Params .= "'" . $this->sql_safe($this->session->get($this->AppModule . "UserID")) . "'";
			return $Params;
		}
		$this->load_view($data, $view);
	}

    function ket080602($data, $view = "app")
	{
		if ($view == "app") {
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$Params = "'" . $KodeUser . "',";
			if (!isset($data["periode"]))
				$data["periode"] = $this->PeriodeAktif; //date("Y");
			$Params .= "'" . $data["periode"] . "',";
			$oQueryPeriode = $this->bsa_model->get_combo_list($this->AppModule, "ComboPeriode", "'" . $KodeUser . "'");
			$data["oQueryPeriode"] = $oQueryPeriode;
			if ($data["MainContentType"] == "frm") {
				if (isset($data["kode"])) {
					$Params .= "'" . $data["kode"] . "',0";
					$oQuery = $this->bsa_model->get_data_detail($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
					$data["oQuery"] = $oQuery;
					//echo $oQuery; die();
				}
				$oQueryAjukanKe = $this->bsa_model->get_combo_list($this->AppModule, "ComboAjukanSurat", "'" . $KodeUser . "'");
				$data["oQueryAjukanKe"] = $oQueryAjukanKe;
				$oQueryAjukanCaption = $this->bsa_model->get_combo_list($this->AppModule, "ComboIntruksiAjukan", "'" . $KodeUser . "'");
				$data["oQueryAjukanCaption"] = $oQueryAjukanCaption;

				//echo $oQueryLokasi; die();
			} else {
				if (isset($data["keyword"]))
					$Params .= "'1','" . $data["keyword"] . "'";
				else {
					$Params .= "'1',''";
					$data["keyword"] = "";
				}
				$Params .= ",1";
				$oQueryList = $this->bsa_model->get_data_list($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
				$data["oQueryList"] = $oQueryList;
				//echo $oQueryList; die();
			}
		} elseif ($view == "prmsave") {
			$KodeLama = $_POST["KodeLama"];
			$Tahun = $_POST["Tahun"];

			$AjukanKe = $_POST["AjukanKe"];
			$AjukanCC = $_POST["AjukanCC"];
			$AjukanTanggal = $_POST["AjukanTanggal"];
			$AjukanCaption = $_POST["AjukanCaption"];
			$AjukanCatatan = $_POST["AjukanCatatan"];



			$Params = "'" . $this->sql_safe($KodeLama) . "','" . $this->sql_safe($Tahun) . "',";
			$Params .= "'" . $this->sql_safe($AjukanKe) . "','" . $this->sql_safe($AjukanCC) . "',";
			$Params .= "'" . $this->sql_safe($AjukanTanggal) . "','" . $this->sql_safe($AjukanCaption) . "','" . $this->sql_safe($AjukanCatatan) . "',";
			$Params .= "'" . $this->sql_safe($this->session->get($this->AppModule . "UserID")) . "'";
			return $Params;
		}
		$this->load_view($data, $view);
	}	
	
	function ket080609($data, $view = "app")
	{
		if ($view == "app") {
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$Params = "'" . $KodeUser . "',";
			if (!isset($data["periode"]))
				$data["periode"] = $this->PeriodeAktif; //date("Y");
			$Params .= "'" . $data["periode"] . "',";
			$oQueryPeriode = $this->bsa_model->get_combo_list($this->AppModule, "ComboPeriode", "'" . $KodeUser . "'");
			$data["oQueryPeriode"] = $oQueryPeriode;
				
			if ($data["MainContentType"] == "frm") {
				if (isset($data["kode"])) {
					$Params .= "'" . $data["kode"] . "',0";
					//					$oQuery = $this->bsa_model->get_data_detail($this->AppModule,$this->KodeMenu,$Params);
					$oQuery = $this->bsa_model->get_data_detail($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
					$data["oQuery"] = $oQuery;
				}
			} else {
				$Params .= "'1',''";

				$Pages = 0;
				$data["pages"] = $Pages;
				if (isset($data["page"]))
					$Params .= "," . $data["page"];
				else
					$Params .= ",1";
				$oQueryList = $this->bsa_model->get_data_list($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
				$data["oQueryList"] = $oQueryList;
				// echo $oQueryList;
			}


			$this->load_view($data, $view);
		} 
	}
    function ket080701($data, $view = "app")
	{
		if ($view == "app") {
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$Params = "'" . $KodeUser . "',";
			if (!isset($data["periode"]))
				$data["periode"] = $this->PeriodeAktif; //date("Y");
			$Params .= "'" . $data["periode"] . "',";
			$oQueryPeriode = $this->bsa_model->get_combo_list($this->AppModule, "ComboPeriode", "'" . $KodeUser . "'");
			$data["oQueryPeriode"] = $oQueryPeriode;
			// if ($data["MainContentType"] == "frm") {
			// 	if (isset($data["kode"])) {
			// 		$Params .= "'" . $data["kode"] . "',0";
			// 		$oQuery = $this->bsa_model->get_data_detail($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
			// 		$data["oQuery"] = $oQuery;
			// 		//echo $oQuery; die();
			// 	}
			// 	$oQueryDispoKe = $this->bsa_model->get_combo_list($this->AppModule, "ComboAjukanSurat", "'" . $KodeUser . "'");
			// 	$data["oQueryDispoKe"] = $oQueryDispoKe;
			// 	$oQueryDispoCaption = $this->bsa_model->get_combo_list($this->AppModule, "ComboIntruksiDispo", "'" . $KodeUser . "'");
			// 	$data["oQueryDispoCaption"] = $oQueryDispoCaption;

			// 	//echo $oQueryLokasi; die();
			// } else {
				if (isset($data["keyword"]))
					$Params .= "'1','" . $data["keyword"] . "'";
				else {
					$Params .= "'1',''";
					$data["keyword"] = "";
				}
				$Params .= ",1";
				$oQueryList = $this->bsa_model->get_data_list($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
				$data["oQueryList"] = $oQueryList;
				//echo $oQueryList; die();
			// }
			$this->load_view($data, $view);
		} elseif ($view == "prmsave") {
			$KodeLama = $_POST["KodeLama"];
			$Tahun = $_POST["Tahun"];

			$AjukanKe = $_POST["AjukanKe"];
			$AjukanCC = $_POST["AjukanCC"];
			$AjukanTanggal = $_POST["AjukanTanggal"];
			$AjukanCaption = $_POST["AjukanCaption"];
			$AjukanCatatan = $_POST["AjukanCatatan"];



			$Params = "'" . $this->sql_safe($KodeLama) . "','" . $this->sql_safe($Tahun) . "',";
			$Params .= "'" . $this->sql_safe($AjukanKe) . "','" . $this->sql_safe($AjukanCC) . "',";
			$Params .= "'" . $this->sql_safe($AjukanTanggal) . "','" . $this->sql_safe($AjukanCaption) . "','" . $this->sql_safe($AjukanCatatan) . "',";
			$Params .= "'" . $this->sql_safe($this->session->get($this->AppModule . "UserID")) . "'";
			return $Params;
		}
	}	

    function ket080702($data, $view = "app")
	{
		if ($view == "app") {
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$Params = "'" . $KodeUser . "',";
			if (!isset($data["periode"]))
				$data["periode"] = $this->PeriodeAktif; //date("Y");
			$Params .= "'" . $data["periode"] . "',";
			$oQueryPeriode = $this->bsa_model->get_combo_list($this->AppModule, "ComboPeriode", "'" . $KodeUser . "'");
			$data["oQueryPeriode"] = $oQueryPeriode;
			if ($data["MainContentType"] == "frm") { 
				if (isset($data["kode"])) {
					$Params .= "'" . $data["kode"] . "',0";
					$oQuery = $this->bsa_model->get_data_detail($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
					$data["oQuery"] = $oQuery;
					//echo $oQuery; die();
				}
				$oQueryDispoKe = $this->bsa_model->get_combo_list($this->AppModule, "ComboAjukanSurat", "'" . $KodeUser . "'");
				$data["oQueryDispoKe"] = $oQueryDispoKe;
				$oQueryDispoCaption = $this->bsa_model->get_combo_list($this->AppModule, "ComboIntruksiDispo", "'" . $KodeUser . "'");
				$data["oQueryDispoCaption"] = $oQueryDispoCaption;

				//echo $oQueryLokasi; die();
			} else {
				if (isset($data["keyword"]))
					$Params .= "'1','" . $data["keyword"] . "'";
				else {
					$Params .= "'1',''";
					$data["keyword"] = "";
				}
				$Params .= ",1";
				$oQueryList = $this->bsa_model->get_data_list($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
				$data["oQueryList"] = $oQueryList;
				//echo $oQueryList; die();
			}
			$this->load_view($data, $view);
		} elseif ($view == "prmsave") {
			$KodeLama = $_POST["KodeLama"];
			$Seq = $_POST["Seq"];
			$Periode = $_POST["Periode"];

			$Laksana = $_POST["Laksana"];
			$LaksanaUraian = $_POST["LaksanaUraian"];



			$Params = "'" . $this->sql_safe($KodeLama) . "','" . $this->sql_safe($Seq) . "',";
			$Params .= "'" . $this->sql_safe($Laksana) . "','" . $this->sql_safe($LaksanaUraian) . "',";
			// $Params .= "'" . $this->sql_safe($LaksanaUraian) . "',";
			$Params .= "'" . $this->sql_safe($this->session->get($this->AppModule . "UserID")) . "'";
			return $Params;
		}
	}	
	
	function ket081501($data, $view = "app")
	{
		if ($view == "app") {
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$Params = "'" . $KodeUser . "',";
			if (!isset($data["periode"]))
				$data["periode"] = $this->PeriodeAktif; //date("Y");
			$Params .= "'" . $data["periode"] . "',";  //echo $data["MainContentType"]; die();
			if ($data["MainContentType"] == "frm") {
				if (isset($data["kode"])) {
					$Params .= "'" . $data["kode"] . "',0";
					$oQuery = $this->bsa_model->get_data_detail($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
					$data["oQuery"] = $oQuery;
					//echo $oQuery; die();
					$oQueryJenis = $this->bsa_model->get_combo_list($this->AppModule, "ComboJenisSuratKeluar", "'" . $KodeUser . "'");
					$data["oQueryJenis"] = $oQueryJenis;
					//echo $oQueryJenis; die();
					$oQueryKop = $this->bsa_model->get_combo_list($this->AppModule, "ComboHeadersurat", "'" . $KodeUser . "'");
					$data["oQueryKop"] = $oQueryKop;
				}

				//echo $oQueryJenis; die();
			} else { //echo "masuk"; die();
				if (isset($data["keyword"]))
					$Params .= "'1','" . $data["keyword"] . "'";
				else {
					$Params .= "'1',''";
					$data["keyword"] = "";
				}
				$Params .= ",1";
				$oQueryList = $this->bsa_model->get_data_list($this->AppModule, $this->KodeView . $this->KodeMenu, $Params);
				$data["oQueryList"] = $oQueryList;
			}
			$oQueryPeriode = $this->bsa_model->get_combo_list($this->AppModule, "ComboPeriode", "'" . $KodeUser . "'");
			$data["oQueryPeriode"] = $oQueryPeriode;
		} elseif ($view == "prmsave") {
			$KodeLama = $_POST["KodeLama"];
			$Tahun = $_POST["Tahun"];
			$RegNo = $_POST["RegNo"];
			$RegTanggal = $_POST["RegTanggal"]; //echo "tes"; die();

			$Kepada = $_POST["Kepada"];
			$AlamatKepada = $_POST["AlamatKepada"];
			$Perihal = $_POST["Perihal"];
			$Jenis = $_POST["Jenis"];
			$KodeHeader = $_POST["KodeHeader"];
			$Tembusan = $_POST["Tembusan"];
			$Isi = $this->get_body_string($_POST["Isi"]);
			$Asman = $_POST["Asman"];


			$Params = "'" . $this->sql_safe($KodeLama) . "','" . $this->sql_safe($Tahun) . "',";
			$Params .= "'" . $this->sql_safe($RegNo) . "','" . $this->sql_safe($RegTanggal) . "',";
			$Params .= "'" . $this->sql_safe($Kepada) . "','" . $this->sql_safe($AlamatKepada) . "',";
			$Params .= "'" . $this->sql_safe($Perihal) . "','" . $this->sql_safe($Jenis) . "',";
			$Params .= "'" . $this->sql_safe($KodeHeader) . "','" . $this->sql_safe($Tembusan) . "',";
			$Params .= "'" . $this->sql_safe($Isi) . "',";
			$Params .= "'" . $this->sql_safe($Asman) . "',";
			$Params .= "'" . $this->sql_safe($this->session->get($this->AppModule . "UserID")) . "'";
			return $Params;
		}
		$this->load_view($data, $view);
	}		
	// Modul ketinistrasi Surat End




	function upload_img_crop_()
	{
		$arHREF = explode("/", $_POST["href"]);
		//		$KodeMenuRaw = $arHREF[count($arHREF)-1];
		// diganti ini ================================
		for ($i = count($arHREF) - 1; $i > 0; $i--) {
			if (strlen($arHREF[$i]) > 120) {
				$KodeMenuRaw = $arHREF[$i];
				break;
			}
		}
		// ============================================
		$mnupos = substr($KodeMenuRaw, 0, 1);
		$KodeMenu = substr_replace($KodeMenuRaw, '', 0, 129 - intval($mnupos));
		$KodeMenu = substr_replace($KodeMenu, '', -1 * intval($mnupos), intval($mnupos));

		$KodeUser = $this->session->get($this->AppModule . "UserID");
		$Kode = $_POST["kode"];
		//		$filename = $Kode; //$_POST['filename'];
		// special addition to prevent bugs in CI - Upload
		if (strpos($Kode, '.') === TRUE) {
			$filename = $Kode;
		} else {
			$filename = str_replace(".", "_", $Kode);
		}
		$img = $_POST['fileToUpload'];
		$src_path = "uploads/" . $_POST['folder'] . "/";

		//		$src_path = "images/".$Folder."/";
		$upload_path = $this->base_path_frontend . $src_path;

		$img = str_replace('data:image/jpeg;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		file_put_contents($src_path . $filename . ".jpg", $data);
		//		$this->upload_finishing($KodeMenu,$Kode,$upload_data,$upload_path,$src_path,$width,$height,$no_thumb,$ImgOri,$ThumbOri);

		$oQuery = $this->bsa_model->upload_img_db_path($this->AppModule, $KodeMenu, $Kode, $src_path . $filename . ".jpg", "", $KodeUser);
		//		$this->session->get($this->AppModule . "GambarPath") = $src_path.$filename.".jpg";
		$this->session->set_userdata($this->AppModule . "GambarPath", $src_path . $filename . ".jpg");


		//		echo $oQuery;
		// hapus yg lama
		//		if($ImgOri!="" && $src_path.$filename!=$ImgOri) {
		//			@unlink($ImgOri);
		//		}
		//		if($ThumbOri!="" &&  $src_path.$thumbfilename!=$ThumbOri) {
		//			@unlink($ThumbOri);
		//		}
		echo $src_path . $filename . ".jpg";
	}

	function upload_berkas()
	{

		$arHREF = explode("/", $_POST["href"]);
		//			$KodeMenuRaw = $arHREF[count($arHREF)-1];
		// diganti ini ================================
		for ($i = count($arHREF) - 1; $i > 0; $i--) {
			if (strlen($arHREF[$i]) > 120) {
				$KodeMenuRaw = $arHREF[$i];
				break;
			}
		}
		// ============================================
		$mnupos = substr($KodeMenuRaw, 0, 1);
		$KodeMenu = substr_replace($KodeMenuRaw, '', 0, 129 - intval($mnupos));
		$KodeMenu = substr_replace($KodeMenu, '', -1 * intval($mnupos), intval($mnupos));
		$Extended = "";
		if (isset($_POST["ext"]))
			$Extended = $_POST["ext"];

		$Kode = $_POST["Kode"];
		$Folder = $_POST["Folder"];
		$DocIdx = "";
		if (isset($_POST["DocIdx"])) {
			$DocIdx = $_POST["DocIdx"];
		}
		$src_path = "docs/";
		if (isset($_POST["Folder"])) {
			$Folder = $_POST["Folder"];
			$src_path .= $Folder . "/";
		}
		$upload_path = $this->base_path_frontend . $src_path;
		// hapus dulu
		if (isset($_POST["FileOri"])) {
			@unlink($upload_path . $_POST["FileOri"]);
		}

		// get filename
		$KodeUser = $this->session->get($this->AppModule . "UserID");

		//			$oQuery = $this->bsa_model->get_data_detail($this->AppModule,$KodeMenu,"'".$KodeUser."','".$Kode."',0");

		$Params = "'" . $KodeUser . "','" . $Kode . "'";

		if (isset($_POST["bln"]))
			$Params = "'" . $_POST["bln"] . "'," . $Params;

		if (isset($_POST["instansi"]))
			$Params = "'" . $_POST["instansi"] . "'," . $Params;
		if (isset($_POST["periode"]))
			$Params = "'" . $_POST["periode"] . "'," . $Params;
		if (isset($_POST["thn"]))
			$Params = "'" . $_POST["thn"] . "'," . $Params;
		if (isset($_POST["tgl"]))
			$Params = "'" . $_POST["tgl"] . "'," . $Params;



		$oQuery = $this->bsa_model->get_data_detail($this->AppModule, $KodeMenu, $Params . ",0");
		$FileName = ""; // default name set to ""
		if (count($oQuery) > 0) {
			foreach ($oQuery as $oRS) {
				$FileName = $oRS->url_alias;
				if (strrpos($FileName, "/", -1) > 0)
					$FileName = substr($FileName, strrpos($FileName, "/", -1) - strlen($FileName) + 1);
			}
		}
		$config['upload_path'] = $upload_path;
		$config['allowed_types'] = 'gif|jpg|png|pdf|docx|doc|xls|xlsx|ppt|pptx|pps|ppsx|zip';
		$config['max_size'] = 0;
		//		$config['max_width'] = 0;
		//		$config['max_height'] = 0;
		$config['overwrite'] = TRUE;

		if ($DocIdx != "" && intval($DocIdx) > 0) {
			$config['file_name'] = $FileName . "_" . $DocIdx;
		} else
			$config['file_name'] = $FileName;

		//
		//        $config['upload_path'] = $this->base_path_frontend.'docs/suratmasuk/'; //path folder
		//        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf|docx'; //type yang dapat diakses bisa anda sesuaikan
		//        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

		$this->load->library('upload', $config);

		//        $this->upload->initialize($config);
		if (!empty($_FILES['fileToUpload']['name'])) {
			if ($this->upload->do_upload('fileToUpload')) {
				//                    $gbr = $this->upload->data();
				//                    $gambar=$gbr['file_name']; //Mengambil file name dari gambar yang diupload
				//                    $judul=strip_tags($this->input->post('judul'));
				//                    $this->m_upload->simpan_upload($judul,$gambar);
				echo "Upload Berhasil";
			} else {
				echo "Gambar Gagal Upload. Gambar harus bertipe gif|jpg|png|jpeg|bmp";
			}
		} else {
			echo "Gagal, gambar belum di pilih";
		}
	}

	function upload_img_crops3()
	{
		$this->init_app();

		$arHREF = explode("/", $_POST["href"]);
		//		$KodeMenuRaw = $arHREF[count($arHREF)-1];
		foreach ($arHREF as $href) {
			if (strlen($href) > 100) $KodeMenuRaw = $href;
		}

		//			echo $KodeMenuRaw; die();
		$mnupos = substr($KodeMenuRaw, 0, 1);
		$KodeMenu = substr_replace($KodeMenuRaw, '', 0, 129 - intval($mnupos));
		$KodeMenu = substr_replace($KodeMenu, '', -1 * intval($mnupos), intval($mnupos));
		$KodeUser = $this->session->get($this->AppModule . "UserID");
		$KodeView = $this->session->get($this->AppModule . "KodeView");
		$Kode = $_POST["kode"];
		//		$filename = $Kode; //$_POST['filename'];
		// special addition to prevent bugs in CI - Upload
		if (strpos($Kode, '.') === TRUE) {
			$filename = $Kode;
		} else {
			$filename = str_replace(".", "_", $Kode);
		}

		if (strpos($Kode, '#') === TRUE) {
			$filename = $Kode;
		} else {
			$filename = str_replace("#", "_", $Kode);
		}


		$img = $_POST['fileToUpload'];
		$src_path = "uploads/" . $_POST['folder'] . "/";
		$Folder = $_POST['folder'];

		//		$src_path = "images/".$Folder."/";
		$upload_path = $this->base_path_frontend . $src_path;

		$img = str_replace('data:image/jpeg;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		file_put_contents($src_path . $filename . ".jpg", $data);

		$filePath = $upload_path . $filename . ".jpg";

		// mulai dari sini 
		$this->config->load('s3', TRUE);

		$s3_config = $this->config->item('s3');

		$awsURL = $s3_config['s3_url'];
		$awsAccessKey = $s3_config['access_key'];
		$awsSecretKey = $s3_config['secret_key'];
		$awsBucketName = $s3_config['bucket_name'];
		$awsFolderParent = $s3_config['folder_parent'];
		$awsFolder = $awsFolderParent . "imgs/" . $Folder;

		//				echo $awsFolder."-".$awsSecretKey; die();
		//				$this->load->library('S3');
		// ==================================================================================================
		$this->load->library('S3', array($awsAccessKey, $awsSecretKey)); //load S3 library
		//				$s3 = new S3($awsAccessKey, $awsSecretKey);
		$s3 = new S3($awsAccessKey, $awsSecretKey, false);
		// ==================================================================================================				


		if (file_exists($filePath)) { //echo $filePath; die();
			try {
				$S3Return = $s3->putObjectFile($filePath, $awsBucketName, $awsFolder . '/' . $filename . ".jpg", S3::ACL_PUBLIC_READ);
			} catch (Exception $e) {
				$S3Return = false;
			}
			//			 echo $S3Return; die();
			if ($S3Return) {
				$AWSFilePathDB = "http://" . $awsBucketName . '/' . $awsFolder . '/' . $filename . ".jpg";
				//echo $AWSFilePathDB; die();
				//				$KodeUser = $this->session->get($this->AppModule . "UserID");

				//				echo $this->AppCode . ",".$KodeMenu.",".$Kode.",".$AWSFilePathDB.",".$KodeUser; die();

				$oQuery = $this->bsa_model->upload_img_db_path($this->AppModule, $KodeView . $KodeMenu, $Kode, $AWSFilePathDB, "", $KodeUser);
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


	public function preview_xls()
	{
		$this->init_app();
		$status = false;
		$file = $this->request->getFile('DokumenPath');
		if ($file) {
			//$file_excel = $this->request->getFile('DokumenPath');
			$ext = $file->getClientExtension();
			if ($ext == 'xls') {
				$render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
			} else {
				$render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}

			$spreadsheet = $render->load($file);
			$Periode = $this->PeriodeAktif; //date("Y");
			if (isset($_POST["Periode"])) {
				$Periode = $_POST["Periode"];
			}

			$ProgramStudi = ""; //date("Y");
			if (isset($_POST["ProgramStudi"])) {
				$ProgramStudi = $_POST["ProgramStudi"];
			}

			$KodeMenu = $_POST["mnu"];
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$KodeView = $this->session->get($this->AppModule . "KodeView");
			$KodeController = $this->session->get($this->AppModule . "KodeController");


			$oQuery = $spreadsheet->getActiveSheet()->toArray();
			//looping untuk mengambil data
			$UniqueKey = rand() . $KodeUser;
			$worksheet = $spreadsheet->getActiveSheet();
			$i = 0;
			$lastColumn = $worksheet->getHighestColumn();
			$colName = array();
			foreach ($worksheet->getRowIterator() as $row) {
				$cellIterator = $row->getCellIterator();
				$i++;
				if ($i == 1) {	// get Column Name
					$c = 0;
					foreach ($cellIterator as $cell) {
						$c++;
						$colName[$c] = $cell->getValue();
					}
				} elseif ($i > 1 && $worksheet->getCell('A' . $i)->getValue() != "") {
					$c = 0;
					foreach ($cellIterator as $cell) {
						$c++;
						$cellVal = $cell->getValue(); // Not sure what column this is looping through
						if ($c == 1) {
							$idx = $UniqueKey . $cellVal;
							$simpandata['idx'] = $idx;
							$simpandata['UniqueKey'] = $UniqueKey;
						}
						//$cellName = $cell->getColumn(); // method will tell you the column
						if (strpos($colName[$c], "Tanggal") !== false) {
							$tanggal = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($cellVal);
							$simpandata[$colName[$c]] = date("Y-m-d", $tanggal);
						} else
							$simpandata[$colName[$c]] = $cellVal;
					}
					$db = \Config\Database::connect();

					$cekIdx = $db->table('tmp_' . $KodeMenu)->getWhere(['idx' => $idx])->getResult();
					if (count($cekIdx) == 0) {
						$db->table('tmp_' . $KodeMenu)->insert($simpandata);
					}
				}
			}
			$Params = "'" . $this->sql_safe($KodeUser) . "','" . $this->sql_safe($Periode) . "','" . $this->sql_safe($ProgramStudi) . "','" . $this->sql_safe($UniqueKey) . "'";
			//			echo $Params; die();
			$oQueryList = $this->bsa_model->get_data_list_ext($this->AppModule, $KodeView . $KodeMenu, "XLS", $Params);
			//				echo $oQueryList; die();
			echo json_encode($oQueryList);
		}
	}

	function upload_gbr()
	{ //echo "test"; die();

		$this->init_app();

		$arHREF = explode("/", $_POST["href"]);
		//		$KodeMenuRaw = $arHREF[count($arHREF)-1];
		foreach ($arHREF as $href) {
			if (strlen($href) > 100) $KodeMenuRaw = $href;
		}

		//	echo $KodeMenuRaw; die();
		// $mnupos = substr($KodeMenuRaw, 0, 1);
		// $KodeMenu = substr_replace($KodeMenuRaw, '', 0, 129 - intval($mnupos));
		// $KodeMenu = substr_replace($KodeMenu, '', -1 * intval($mnupos), intval($mnupos));
		// $KodeUser = $this->session->userdata($this->AppModule . "UserID");
		// $KodeView = $this->session->userdata($this->AppModule . "KodeView");
		// $Kode = $_POST["kode"];

		$mnupos = substr($KodeMenuRaw, 0, 1);
		$KodeMenu = substr_replace($KodeMenuRaw, '', 0, 129 - intval($mnupos));
		$KodeMenu = substr_replace($KodeMenu, '', -1 * intval($mnupos), intval($mnupos));
		$KodeUser = $this->session->get($this->AppModule . "UserID");
		$KodeView = $this->session->get($this->AppModule . "KodeView");
		$Kode = $_POST["kode"];

		//echo $Kode; die();

		//		$filename = $Kode; //$_POST['filename'];
		// special addition to prevent bugs in CI - Upload
		if (strpos($Kode, '.') === TRUE) {
			$filename = $Kode;
		} else {
			$filename = str_replace(".", "_", $Kode);
		}

		if (strpos($Kode, '#') === TRUE) {
			$filename = $Kode;
		} else {
			$filename = str_replace("#", "_", $Kode);
		}


		//echo $filename ; die();
		$Seq = "";
		if (isset($_POST["seq"]))
			$Seq =  $this->input->post('seq');
		$Folder =  $this->input->post('folder');
		$src_path = "uploads/imgs/" . $Folder . "/";
		$upload_path = $this->base_path_frontend . $src_path;

		$height = 600;
		$width = 800;
		$no_thumb = true;
		if (isset($_POST["height"]))
			$height = $_POST["height"];
		if (isset($_POST["width"]))
			$width = $_POST["width"];
		if (isset($_POST["no_thumb"])) {
			$no_thumb = filter_var($_POST["no_thumb"], FILTER_VALIDATE_BOOLEAN);
		}
		$config['upload_path'] = $upload_path;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 0;
		$config['max_width'] = 0;
		$config['max_height'] = 0;
		$config['overwrite'] = TRUE;
		if (strpos($Kode, '.') === TRUE) {
			$config['file_name'] = $Kode . "_" . $Seq;
		} else {
			$config['file_name'] = str_replace(".", "_", $Kode) . "_" . $Seq;
		}

		//        $config['encrypt_name'] = TRUE;
		//		$config['file_name'] = $this->input->post('judul');
		$uploadPath = base_url() . "/uploads/imgs/" . $Folder . "/";

		$this->load->library('upload', $config);
		if ($this->upload->do_upload("file")) {
			//            $data = array('upload_data' => $this->upload->data());
			// 
			////            $judul= $this->input->post('judul');
			//            $image= $data['upload_data']['file_name']; 

			$gbr = $this->upload->data();
			//Compress Image
			$config['image_library'] = 'gd2';
			$config['source_image'] = "./uploads/imgs/" . $Folder . "/" . $gbr['file_name'];
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['quality'] = '50%';
			$config['width'] = $width;
			$config['height'] = $height;
			$config['new_image'] = "./uploads/imgs/" . $Folder . "/" . $gbr['file_name'];
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();

			$image = $gbr['file_name'];

			$oQuery = $this->bsa_model->upload_img_db_path_ext($this->AppModule, $KodeView . $KodeMenu, $Kode, $Seq, $src_path . $image, "", $KodeUser);
			echo $oQuery;
			die();

			//            $result= $this->m_upload->simpan_upload($judul,$image);
			//            echo json_decode($result);
			echo $image;
		}
	}

	function del_gbr()
	{
		$this->init_app();

		$arHREF = explode("/", $_POST["href"]);
		//		$KodeMenuRaw = $arHREF[count($arHREF)-1];
		foreach ($arHREF as $href) {
			if (strlen($href) > 100) $KodeMenuRaw = $href;
		}

		//			echo $KodeMenuRaw; die();
		$mnupos = substr($KodeMenuRaw, 0, 1);
		$KodeMenu = substr_replace($KodeMenuRaw, '', 0, 129 - intval($mnupos));
		$KodeMenu = substr_replace($KodeMenu, '', -1 * intval($mnupos), intval($mnupos));
		$KodeUser = $this->session->userdata($this->AppModule . "UserID");
		$KodeView = $this->session->userdata($this->AppModule . "KodeView");
		$Kode = $_POST["kode"];
		if (isset($_POST["src"])) {
			$Seq = $_POST["id"];
			$src = $_POST["src"];
			@unlink($this->base_path_frontend . str_replace(base_url(), "", $src));
			$oQuery = $this->bsa_model->upload_img_db_path_ext($this->AppModule, $KodeView . $KodeMenu, $Kode, $Seq, "", "", $KodeUser);
		}
		echo "0";
	}
}

/* End of file app.php */
/* Location: ./application/controllers/app.php */