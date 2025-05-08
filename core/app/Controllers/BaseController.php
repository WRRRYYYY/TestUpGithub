<?php
namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;
use CodeIgniter\Files\File;	
//use CodeIgniter\HTTP\RequestInterface;
//use CodeIgniter\HTTP\ResponseInterface;
//use CodeIgniter\Services;
//use Psr\Log\LoggerInterface;
use ReflectionClass;

use Google_Client;	// 01. tambahkan ini

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
// =============================
use App\Libraries\Recaptcha;
// =============================

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/* berli MY_Controller ================================ */
//	protected $_ci;
	protected $_is_valid;
	protected $_exp_date;
	protected $_valid_ip;
	protected $_valid_server;

	/* berli Bsa_Controller ============================== */
	public $conn_id;
	
	public $bsa_model;
	
	public $uri;

	public $controller_name;
	
	public $PageTitle;
	public $base_url_index_page;
	public $base_url_frontend;
	public $base_path_frontend;
	public $base_url_path;
	public $core_folder_path;
//	public $public_folder;
//	public $writable_folder;
	
	public $default_main_content_type;

	public $AppCode;
	public $AppModule;
	public $AppName;
	public $KodeInstitusi;
	public $NamaInstitusi;
	public $BrandInstitusi;
	public $NamaAplikasi;
	public $BrandAplikasi;
	public $PageTitlePrefix;

	public $BaseMenu;
	public $KodeInduk;
	public $KodeMenu;
	public $NamaMenu;
	public $JudulMenu;
	public $KeteranganMenu;
	// New Public Var
	public $KodeController;
	public $KodeView;

	public $KurikulumAktif;
	public $PeriodeAktif;
	public $NamaPeriodeAktif;
	public $TahunAktif;
	public $ThnPengisianAnggaran;
	public $RenstraAktif;
	public $MenuNoLogin;
	
	public $SelisihHari;
	
	public $arModule;
	public $arBulan;
	public $arBulanShort;
	public $arBulanRomawi;
	public $arHari;


	public $awsURL;
	public $awsAccessKey;
	public $awsSecretKey;
	public $awsBucketName;
	public $awsFolderParent;

	// tambahan 2024-11-28
	const sign_up_url = 'https://www.google.com/recaptcha/admin';
	const site_verify_url = 'https://www.google.com/recaptcha/api/siteverify';
	const api_url = 'https://www.google.com/recaptcha/api.js';
	
	/* end of Public Vars ================================ */
	protected $GoogleClient;	// 02. tambahkan ini

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
//		$this->session = \Config\Services::session();
		$this->session = session();
//		$request = \Config\Services::request();
		$uri = current_url(true); //service('uri');
		
//		echo "test"; die();
		$arControllerName = explode('\\',service('router')->controllerName());
		$this->controller_name = end($arControllerName);

		/* BERLI's MY_Controller init checking formerly */
		$this->_exp_date = "";
//		$this->_valid_ip = "103.144.170.57";
		$this->_valid_ip = "*";
		$this->_valid_server = "*"; //'eoffice.web.id";

		$this->if_valid();

		if(!$this->_is_valid) {
			//echo view("sori");	
//			if(file_exists(FCPATH.$this->core_folder_path."app/Views/bsa_zpg.php")) {
//				echo echo view('bsa_zpg', '', TRUE);
//			}
			echo "sorri";
			die();	
		}
		// Bsa_Controller construct
		$db = db_connect('default');
//		$this->load->library('bsa_template');	
//		$this->load->library('session');	// dah dipindah ke atas
//		$this->load->model('bsa_model','',TRUE);	
		$this->bsa_model = model('Bsa_model', true, $db);
		$this->base_url_index_page = base_url().index_page();
		if(substr($this->base_url_index_page,-1)!="/") $this->base_url_index_page .= "/";

		$oQuery = $this->bsa_model->init_app_module();	
		if(count($oQuery) > 0) {
			$i = 0;
			foreach($oQuery as $oRS) {
				$this->arModule[$i] = array("value"=>$oRS->Kode, "label"=>$oRS->Nama);
				$i++;
			}
		}
		$this->arBulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$this->arBulanShort = array("", "Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des");
		$this->arBulanRomawi = array("", "I","II","III","IV","V","VI","VII","VIII","IX","X","XI","XII");
		$this->arHari = array("","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");
		$this->base_url_frontend = base_url(); 
		// $this->base_url_frontend = str_replace("/backend","",base_url()); 
		$this->base_url_path = str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
		$this->base_path_frontend = FCPATH; 
		// $this->base_path_frontend = str_replace("\backend","",FCPATH);  
		$this->core_folder_path = "../core/";
		
		// $this->init(); // execute in each Application

		$this->AppCode = "ASIAB"; 
		// PASTIKAN 2 variable ini sama dgn yg diset di table abs_param
		$this->KodeInstitusi = "BAZJT";
		$this->NamaInstitusi = "Baznas Provinsi Jawa Tengah";

		$this->BaseMenu = '01';	// dashboard
		
		$this->default_main_content_type = "def";

		$this->SMS_username = 'irmaone'; // username 
		$this->SMS_password = '123456789';     // password 
		$this->SMS_apikey   = '2a31bbde524b5c4aec16901d77e15a36';     // key 

		$this->SMS_modem = '2005';     // modem


		$this->awsURL = "s3-id-jkt-1.kilatstorage.id/"; //$s3_config['s3_url'];

		$this->awsAccessKey = "19bdaae4a01e4e55e3fe"; //$s3_config['access_key'];
		$this->awsSecretKey = "/k2cmwT13kS0IBau8NHax+tNIUushTdFrErrLNsy"; //$s3_config['secret_key'];
		$this->awsBucketName = "s3.berliansolusi.co.id"; //$s3_config['bucket_name'];
		$this->awsFolderParent = "baznasjateng/"; //$s3_config['folder_parent'];

	}

	function if_valid() {
//		return (date("Y\-m\-d H:i:s")<date("Y\-m\-d H:i:s",strtotime($this->_expdate))); 
		$this->_is_valid = ($this->_exp_date == "" || date("Y\-m\-d H:i:s")<date("Y\-m\-d H:i:s",strtotime($this->_exp_date)));
//		$this->_is_valid = $this->_is_valid && ($this->_valid_ip == "*" || $this->_valid_ip == $_SERVER['SERVER_ADDR']);
		$this->_is_valid = $this->_is_valid && ($this->_valid_server == "*" || $this->_valid_server == $_SERVER['SERVER_NAME']);
	}

	public function init_app() {
		$this->AppModule = md5($this->AppCode.' '.$this->KodeInstitusi.' '.$this->NamaInstitusi);
		$this->AppName = 'Aplikasi Sistem Informasi Baznas';
		// coba dideklarasikan di sini
		$uri = service('uri');
	}

	public function init() {
		$oQuery = $this->bsa_model->init_app($this->AppModule);	
		// utk default agar by pass sementara ====
		$this->SelisihHari = 100;
		// =======================================
		if(count($oQuery) > 0) {
			foreach($oQuery as $oRS) {
				$this->AppName = $oRS->NamaAplikasi;
				$this->NamaAplikasi = $oRS->NamaAplikasi;
				$this->BrandAplikasi = $oRS->BrandAplikasi;
				$this->KodeInstitusi = $oRS->KodeInstitusi;
				$this->NamaInstitusi = $oRS->NamaInstitusi;
				$this->BrandInstitusi = $oRS->BrandInstitusi;
				$this->PageTitlePrefix = $oRS->BrandInstitusi . " :: " . $this->AppName;
				$this->PeriodeAktif = $oRS->PeriodeAktif; // date("Y");	// sementara
//				$this->NamaPeriodeAktif = $oRS->NamaPeriodeAktif; 
				//$this->TahunAktif = $oRS->TahunAktif; // date("Y");	// sementara
				$this->RenstraAktif = $oRS->RenstraAktif; // date("Y");	// Tahun Renstra
				
				$this->AppModule = md5($this->AppCode.' '.$this->KodeInstitusi.' '.$this->NamaInstitusi);
//				$this->SelisihHari = $oRS->SelisihHari; 
			}
		}
		$uri = service('uri');
		$KodeMenuRaw = "";
		if($uri->getTotalSegments()>4)
			$KodeMenuRaw = $uri->getSegment(5);
		if($KodeMenuRaw!="") {
			$mnupos = substr($KodeMenuRaw,0,1);
			$KodeMenu = substr_replace($KodeMenuRaw, '', 0, 129-intval($mnupos)); 
			$KodeMenu = substr_replace($KodeMenu, '', -1*intval($mnupos), intval($mnupos)); 
		} else {
			$KodeMenu = $this->BaseMenu;	// dashboard special
		}
		$this->KodeMenu=$KodeMenu;
		
		if($this->session->get($this->AppModule . "UserID"))  { 
			$this->KodeController = $this->session->get($this->AppModule . "KodeController");
			$this->KodeView = $this->session->get($this->AppModule . "KodeView");
		} 
	}
	
	public function get_home_nologin() {
		$data["AppClass"] = $this; 
		$data["AppModule"] = $this->AppModule;
//		$oQuery = $this->bsa_model->get_data_list($this->AppModule,"Berita","'',5,0");	
//		$data["oQuery"] = $oQuery;
		return view("A01",$data,TRUE);	
	}

	function gen_login_form() {
		$this->init_app();
//		$this->main();
//		moved here
		// initiate global data variable
		$this->init(); 

		
		
		$data["base_url_class"] = $this->base_url_index_page.strtolower($this->controller_name)."/";
		$data["base_url_index_page"] = $this->base_url_index_page;
		$data["AppName"] = $this->AppName;
		$data["AppClass"] = $this;
		$data["NamaInstitusi"] = $this->NamaInstitusi;
		$data["BrandInstitusi"] = $this->BrandInstitusi;
		$data["NamaAplikasi"] = $this->NamaAplikasi;
		$data["BrandAplikasi"] = $this->BrandAplikasi;
		$data["PageTitlePrefix"] = $this->PageTitlePrefix;
		
		$Year = date("Y");		// YYYY
		$Month = date("n");		// 1 - 12;
		$Day = date("d");		// 01 - 31;
		$WeekDay = date("N");	// 1(Monday) - 7(Sunday);
		$DateCode = date("y").date("m").date("d"); // YYMMDD
		$data["Today"] = $this->arHari[$WeekDay] . ", " . $Day . " " . $this->arBulan[$Month] . " " . $Year;
		$data["BulanTahun"] = $this->arBulan[$Month] . " " . $Year;
		$data["Tahun"] = $Year;


		$data["captcha"] = config('Recaptcha_cfg')->recaptcha_site_key; //$this->recaptcha->getWidget();

		// 03. tambahkan ini =================================================
		$this->GoogleClient = new Google_Client();
		$this->GoogleClient->setClientId('745223472959-qeneanpsg25j2efgrotvf3meko3ocnno.apps.googleusercontent.com');
		$this->GoogleClient->setClientSecret('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');
		// $this->GoogleClient->setRedirectUri('https://satpolkar.kendalkab.go.id/siecantikpol/login/proses');
		$this->GoogleClient->setRedirectUri('http://localhost/bazjateng/public/login/proses');
		$this->GoogleClient->addScope('email');
		$this->GoogleClient->addScope('profile');

		$data['linksso'] = $this->GoogleClient->createAuthUrl();

		// ===================================================================
		echo view("bsalogin",$data);
	}
	// main menu
	function mnu() { 
		$this->init_app();


		/* perubahan non-session =============================================================================
		if(!$this->session->get($this->AppModule . "UserID"))  
//			return redirect()->to(base_url());
			return redirect()->to($this->base_url_index_page.strtolower($this->controller_name)."/");
		==================================================================================================== */
//		$this->main();
//		moved here
		// initiate global data variable
		$this->init(); 

//		$data["public_folder"] = $this->public_folder; // new pub var
//		$data["writable_folder"] = $this->writable_folder; // new pub var

		$data["controller_name"] = $this->controller_name;
		$data["base_url_class"] = $this->base_url_index_page.strtolower($this->controller_name)."/";
		$data["base_url_index_page"] = $this->base_url_index_page;
		$data["default_main_content_type"] = $this->default_main_content_type;
		$data["AppModule"] = $this->AppModule;
		$data["AppName"] = $this->AppName;
		$data["AppClass"] = $this;
		$data["NamaInstitusi"] = $this->NamaInstitusi;
		$data["BrandInstitusi"] = $this->BrandInstitusi;
		$data["NamaAplikasi"] = $this->NamaAplikasi;
		$data["BrandAplikasi"] = $this->BrandAplikasi;
		$data["PageTitlePrefix"] = $this->PageTitlePrefix;
		$Year = date("Y");		// YYYY
		$Month = date("n");		// 1 - 12;
		$Day = date("d");		// 01 - 31;
		$WeekDay = date("N");	// 1(Monday) - 7(Sunday);
		$DateCode = date("y").date("m").date("d"); // YYMMDD
		$data["Today"] = $this->arHari[$WeekDay] . ", " . $Day . " " . $this->arBulan[$Month] . " " . $Year;
		$data["BulanTahun"] = $this->arBulan[$Month] . " " . $Year;
		$data["Tahun"] = $Year;


		$data["arModule"] = $this->arModule;

		// init Account
		$AccountPart = "";
		if($this->session->get($this->AppModule . "UserID"))  { 
			$this->KodeController = $this->session->get($this->AppModule . "KodeController");
			$this->KodeView = $this->session->get($this->AppModule . "KodeView");
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$SessionEmpty = false;
		} else {
			$this->KodeController = "Bsa";
			$this->KodeView = "";
			$KodeUser = "nologin";
			$SessionEmpty = true;
			// untuk kali ini kita redir ke base url aja ya, biar dibawa ke form login
			return redirect()->to(base_url()."/".$this->KodeController);
		}

		$oQuery = $this->bsa_model->get_menu_detail($this->AppModule,$KodeUser,$this->KodeMenu);
		// echo $oQuery; die();
		
		if(count($oQuery) > 0) {
			$oResult = $oQuery;
			$this->KodeInduk = "";
			$KodeRoleUser = "";
			$NamaRoleUser = "";
			// since CI-3 need this ======
			$KodeMenuCek = "";
			// ===========================
			foreach($oResult as $oRS) {
				if(!is_null($oRS->KodeInduk)) $this->KodeInduk = $oRS->KodeInduk;
				$this->NamaMenu = $oRS->Nama;
				$this->KeteranganMenu = $oRS->Keterangan;
				$KodeRoleUser = $oRS->KodeRole;
				$NamaRoleUser = $oRS->NamaRole;
				
				$KodeMenuCek = $oRS->KodeMenuCek;
			}
			// added on Mar 18, 2013
			$data["KodeRoleUser"] = $KodeRoleUser;
			$data["NamaRoleUser"] = $NamaRoleUser;
			// no privillege will be redirected (since CI-3) ==================
			if($this->KodeMenu!=$KodeMenuCek)
				return redirect()->to(base_url());
			// ================================================================
		} else {
			// no privillege will be redirected
//			if($this->KodeMenu!="00" && !$SessionEmpty)
			if($this->KodeMenu!=$this->BaseMenu && !$SessionEmpty)
				return redirect()->to(base_url());
		}
		// added on Dec 15, 2012
		if($this->KodeInduk=="") $this->KodeInduk = $this->KodeMenu;


		$data["JudulMenu"] = $this->NamaMenu;
		$data["NamaMenu"] = $this->NamaMenu;
		$data["KeteranganMenu"] = $this->KeteranganMenu;
		$data["html_AccountPart"] = $AccountPart;
		$data["SessionEmpty"] = $SessionEmpty;
		$data["AppModule"] = $this->AppModule; 
//		$data["html_SessionEmpty"] = $this->get_home_nologin();

// ###########################################################################################################################	
		// $uri_strings = explode("/",uri_string());
		// sedikit modifikasi utk mengatasi misteri uri_string() yg ketambahan / didepannya
		if(substr(uri_string(),0,1)=="/")
			$uri_strings = explode("/",substr(uri_string(),1));
		else
			$uri_strings = explode("/",uri_string());
			
//		$data["JScript"] = $this->base_url_index_page.strtolower($this->controller_name)."/jscript"; 
//		for($i=2;$i<count($uri_strings);$i++)
//			$data["JScript"] .= "/".$uri_strings[$i];

		$MainContentType = $this->default_main_content_type;
		if(count($uri_strings)>5) {
			$MainContentType = $uri_strings[5];	// pag, frm, dtl
		}
		$data["MainContentType"] = $MainContentType;

		$data["MainContent"] = $this->BaseMenu.".php";
//		$data["BottomScript"] = $this->BaseMenu."BottomScript.php";

		$ExtName = "";	// default
//		echo FCPATH.$this->core_folder_path."app/Views/".$this->KodeView.$this->KodeMenu.".php"; die();
		if(file_exists(FCPATH.$this->core_folder_path."app/Views/".$this->KodeView.$this->KodeMenu.".php")) {
			if($MainContentType==$this->default_main_content_type)
				$data["MainContent"] = $this->KodeView.$this->KodeMenu.".php";
			elseif($MainContentType=="frm")
				$data["MainContent"] = $this->KodeView.$this->KodeMenu."Form.php";
			elseif($MainContentType=="dtl")
				$data["MainContent"] = $this->KodeView.$this->KodeMenu."Detail.php";
			elseif($MainContentType=="frx") {
				$ExtName = $uri_strings[6];	// pag, frm, dtl
				$data["MainContent"] = $this->KodeView.$this->KodeMenu."Form".$ExtName.".php";
//				echo $data["MainContent"]; die();
//				$data["ExtName"] = $ExtName;	// pindah ke bawah
			}
			
			$data["BottomScript"] = $this->KodeView.$this->KodeMenu."Script.php";
//		} elseif(!$SessionEmpty) {
		} else {
			$data["MainContent"] = "underconstruction.php";
			$data["BottomScript"] = "underconstructionScript.php";
		}
//		echo FCPATH."application/views/".$this->KodeView.$this->KodeMenu.".php"; die();
		// pindah ke sini
		$data["ExtName"] = $ExtName;

		$data["AppJS"] = $this->base_url_index_page.strtolower($this->controller_name)."/pagescript"; 
		for($i=2;$i<count($uri_strings);$i++)
			$data["AppJS"] .= "/".$uri_strings[$i];

		$data["PageJS"] = $this->load_script($data,"js");
		$data["PageCSS"] = $this->load_script($data,"css");

// ##############################################################################################################################
			
		$hash = hash('sha512',rand());
		$pos = substr(rand(),0,1); 
		$mnu = $pos . substr($hash,0,128-intval($pos)) . $this->KodeMenu . substr($hash,-1*intval($pos));

		$URLMenu = base_url() . strtolower($this->controller_name)."/mnu/" . substr(md5(rand()),4,7) . "/salt/" . $mnu;
		// tambah ini
		$URLMenu .= "/".$MainContentType;

				
		$data["URLMenu"] = $URLMenu;
		$data["KodeMenu"] = $this->KodeMenu;
		// TOP MENU QUERY
		$oQueryMnuTop = $this->bsa_model->get_menu_list_all($this->AppModule,$KodeUser);	
//		echo $oQueryMnuTop; die();
		$data["oQueryMnuTop"] = $oQueryMnuTop;
		
		
		// GET ADDITIONAL VARIABLES FROM URI !!!! ################################################################
		// additional var start from 6th segment... ini yg lama
		// additional var start from 7th segment...
		$uri = service('uri');
		$uri_last = $uri->getTotalSegments();
		for ($i_uri = 7; $i_uri <= $uri_last; $i_uri++) {
			$this->get_additional_data($uri->getSegment($i_uri));	
		}
		if(isset($this->kode))
			$data["kode"] = $this->kode;	
		if(isset($this->periode))
			$data["periode"] = $this->periode;	
		if(isset($this->tahun))
			$data["tahun"] = $this->tahun;	
		if(isset($this->bulan))
			$data["bulan"] = $this->bulan;	
		if(isset($this->tanggal))
			$data["tanggal"] = $this->tanggal;	
		if(isset($this->tanggal_1))
			$data["tanggal_1"] = $this->tanggal_1;	
		if(isset($this->tanggal_2))
			$data["tanggal_2"] = $this->tanggal_2;	
		if(isset($this->extended))
			$data["extended"] = $this->extended;	
		if(isset($this->kategori))
			$data["kategori"] = $this->kategori;	
		if(isset($this->subkategori))
			$data["subkategori"] = $this->subkategori;	
		if(isset($this->param01))
			$data["param01"] = $this->param01;
		if(isset($this->param02))
			$data["param02"] = $this->param02;
		if(isset($this->param03))
			$data["param03"] = $this->param03;
		if(isset($this->param04))
			$data["param04"] = $this->param04;
		if(isset($this->param05))
			$data["param05"] = $this->param05;

			
		if(isset($this->page))
			$data["page"] = $this->page;	
		else
			$data["page"] = 1;	

		// #######################################################################################################

/*

		// spesial fitur Aplikasi Keuangan ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		$Label0413 = 0;
		$Params = "'',0";
		$Params = "'" . $this->PeriodeAktif . "',".$Params;
		$Params = "'" . $KodeUser . "',".$Params ;
//		$oQueryLabel0413 = $this->bsa_model->get_data_detail($this->AppModule,"FiturLabel0413",$Params);	
//		if(count($oQueryLabel0413) > 0) {
//			foreach($oQueryLabel0413 as $oRS) {
//				$Label0413 = $oRS->Total;
//			}
//		}
		$data["Label0413"] = $Label0413;
		
		// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~		
*/

		$data["KodeMenu"] = $this->KodeMenu;


		// call queries involved dynamically
		if($this->isFunctionExists($this->KodeMenu) && 
			file_exists(FCPATH.$this->core_folder_path."app/Views/".$this->KodeView.$this->KodeMenu.".php")) {
				// echo strtolower($this->KodeController).$this->KodeMenu; die();
			$this->{strtolower($this->KodeController).$this->KodeMenu}($data);
		} else {
			echo view("bsa404",$data);
		}


	}

	function jsn() {
		$this->init_app();
		// initiate global data variable
		$this->init(); 
		$data["KodeMenu"] = $this->KodeMenu;
		$KodeMenu = $this->KodeController.$this->KodeMenu;
		// echo strtolower($KodeMenu); die();

		$uri = service('uri');
		$uri_last = $uri->getTotalSegments();
		for ($i_uri = 7; $i_uri <= $uri_last; $i_uri++) {
			$this->get_additional_data($uri->getSegment($i_uri));	
		}
		if(isset($this->kode))
			$data["kode"] = $this->kode;	
		if(isset($this->periode))
			$data["periode"] = $this->periode;	
		if(isset($this->tahun))
			$data["tahun"] = $this->tahun;	
		if(isset($this->bulan))
			$data["bulan"] = $this->bulan;	
		if(isset($this->tanggal))
			$data["tanggal"] = $this->tanggal;	
		if(isset($this->tanggal_1))
			$data["tanggal_1"] = $this->tanggal_1;	
		if(isset($this->tanggal_2))
			$data["tanggal_2"] = $this->tanggal_2;	
		if(isset($this->extended))
			$data["extended"] = $this->extended;	
		if(isset($this->kategori))
			$data["kategori"] = $this->kategori;	
		if(isset($this->subkategori))
			$data["subkategori"] = $this->subkategori;	
		if(isset($this->keyword))
			$data["keyword"] = $this->keyword;	
		if(isset($this->param01))
			$data["param01"] = $this->param01;
		if(isset($this->param02))
			$data["param02"] = $this->param02;
		if(isset($this->param03))
			$data["param03"] = $this->param03;
		if(isset($this->param04))
			$data["param04"] = $this->param04;
		if(isset($this->param05))
			$data["param05"] = $this->param05;

			
		if(isset($this->page))
			$data["page"] = $this->page;	
		else
			$data["page"] = 1;			

		return $this->{strtolower($KodeMenu)}($data,"listdata");
		
	}


	function isFunctionExists($KodeMenu) {
		$controllerClass = "App\\Controllers\\$this->KodeController";

		if (class_exists($controllerClass)) {
			// Membuat objek refleksi untuk kelas controller
			$reflection = new ReflectionClass($controllerClass);

			// Memeriksa apakah metode ada dalam controller
			if ($reflection->hasMethod(strtolower($this->KodeController).$this->KodeMenu)) {
				return true; // Metode ditemukan
			} else {
				return false; // Metode tidak ditemukan
			}
		} else {
			// throw new \Exception("Controller $controller tidak ditemukan.");
			return false; // Metode tidak ditemukan
		}

	}
	function load_view($data,$view) { 
		if($view=="app") {
			if($data["MainContentType"]==$this->default_main_content_type)
				echo view($this->KodeView.$this->KodeMenu,$data);
			elseif($data["MainContentType"]=="frm")
				echo view($this->KodeView.$this->KodeMenu."Form",$data);
			elseif($data["MainContentType"]=="frx") 
				echo view($this->KodeView.$this->KodeMenu."Form".$data["ExtName"],$data);
			elseif($data["MainContentType"]=="dtl")
				echo view($this->KodeView.$this->KodeMenu."Detail",$data);
		} elseif($view=="js")
			echo view($this->KodeView.$this->KodeMenu."_js",$data);	
	}
	function load_script($data,$view) {
		if($data["MainContentType"]==$this->default_main_content_type)
			$PageName = $this->KodeView.$this->KodeMenu;
		elseif($data["MainContentType"]=="frm")
			$PageName = $this->KodeView.$this->KodeMenu."Form";
		elseif($data["MainContentType"]=="frx") 
			$PageName = $this->KodeView.$this->KodeMenu."Form";
		elseif($data["MainContentType"]=="dtl")
			$PageName = $this->KodeView.$this->KodeMenu."Detail";

		if($view=="js") {
			if(file_exists(FCPATH.$this->core_folder_path."app/Views/".$PageName."_js.php")) {
				return view($PageName."_js",$data);	
			} else { 
				return "";
			}
		} elseif($view=="css") {
			if(file_exists(FCPATH.$this->core_folder_path."app/Views/".$PageName."_css.php")) {
				return view($PageName."_css",$data);	
			} else { 
				return "";
			}
		}
	}
	function get_additional_data($uri) {
		if($uri) {
			if(substr($uri,0,3)=="per")
				$this->periode = urldecode(substr($uri,3));	
			elseif(substr($uri,0,3)=="thn")
				$this->tahun = urldecode(substr($uri,3));	
			elseif(substr($uri,0,3)=="bln")
				$this->bulan = urldecode(substr($uri,3));	
			elseif(substr($uri,0,3)=="tgl")
				$this->tanggal = urldecode(substr($uri,3));	
			elseif(substr($uri,0,3)=="tg1")
				$this->tanggal_1 = urldecode(substr($uri,3));	
			elseif(substr($uri,0,3)=="tg2")
				$this->tanggal_2 = urldecode(substr($uri,3));	
			elseif(substr($uri,0,3)=="pag")
				$this->page = urldecode(substr($uri,3));	
			elseif(substr($uri,0,3)=="ext")
				$this->extended = urldecode(substr($uri,3));	
			elseif(substr($uri,0,3)=="kat")
				$this->kategori = urldecode(substr($uri,3));	
			elseif(substr($uri,0,3)=="sub")
				$this->subkategori = urldecode(substr($uri,3));	
			elseif(substr($uri,0,3)=="cod")
				$this->kode = urldecode(substr($uri,3));	
			elseif(substr($uri,0,3)=="p01")
				$this->param01 = urldecode(substr($uri,3));	
			elseif(substr($uri,0,3)=="p02")
				$this->param02 = urldecode(substr($uri,3));	
			elseif(substr($uri,0,3)=="p03")
				$this->param03 = urldecode(substr($uri,3));	
			elseif(substr($uri,0,3)=="p04")
				$this->param04 = urldecode(substr($uri,3));	
			elseif(substr($uri,0,3)=="p05")
				$this->param05 = urldecode(substr($uri,3));	
			else
				$this->page = $uri;	
		}
	}

	function jplugins() {
		$this->init_app();
		$this->init();
		$data["baseURL"] = base_url()."aps/";
		$data["base_url_class"] = $this->base_url_index_page.strtolower($this->controller_name)."/";
		$data["default_main_content_type"] = $this->default_main_content_type;
		$data["base_url_index_page"] = $this->base_url_index_page;
		$data["base_url_frontend"] = $this->base_url_frontend;
		$data["base_url_path"] = $this->base_url_path;
		$data["tinymce_convert_urls"] = "true";
		$data['AppClass'] = $this;
		//echo view($this->KodeMenu."_js",$data);	
		$this->{strtolower($this->KodeController).$this->KodeMenu}($data,"jplug");
	}
	function jscript() {
		$this->init_app();
		$this->init();
		$data["baseURL"] = base_url()."aps/";
		$data["base_url_class"] = $this->base_url_index_page.strtolower($this->controller_name)."/";
		$data["default_main_content_type"] = $this->default_main_content_type;
		$data["base_url_index_page"] = $this->base_url_index_page;
		$data["base_url_frontend"] = $this->base_url_frontend;
		$data["base_url_path"] = $this->base_url_path;
		$data["tinymce_convert_urls"] = "true";
		$data['AppClass'] = $this;
		//echo view($this->KodeMenu."_js",$data);	
		$this->{strtolower($this->KodeController).$this->KodeMenu}($data,"js");
	}
	function pagescript() {
		$this->init_app();
		$data["baseURL"] = base_url()."aps/";
		$data["base_url_class"] = $this->base_url_index_page.strtolower($this->controller_name)."/";
		$data["base_url_index_page"] = $this->base_url_index_page;
		$data["AppModule"] = $this->AppModule;
		$data['AppClass'] = $this;
		echo view("bsa_js",$data);	
	}

	function login_process() {
		if(!$this->request->isAJAX()) {
			//$this->main();
//			return redirect()->to(base_url());
			return redirect()->to(base_url()."/".strtolower($this->controller_name)."/");
		} else {
			$this->init_app();
			$this->do_login();
		}
    }
	function logout_process() {
		if(!$this->request->isAJAX()) {
			//$this->main();
			// diganti di bawah ini ========================================================================
			$this->init_app();
			//$oQuery = 
			$this->bsa_model->ins_log_record($this->AppModule,$this->session->get($this->AppModule . "UserID"),$this->sql_safe(\Config\Services::request()->getIPAddress()),$this->sql_safe(\Config\Services::request()->getUserAgent()->getAgentString()));	
			// kill session
			$this->session->sess_destroy();
	
			//unset session
//			$this->session->unset_userdata($this->AppModule."UserID");
//			$this->session->unset_userdata($this->AppModule."UserName");
//	
//			$this->session->unset_userdata($this->AppModule."Role");

			return redirect()->to($this->base_url_index_page.strtolower($this->controller_name)."/");
			// ====================================================================================================================
		} else {
			$this->init_app();
			$this->do_logout(); 
			return redirect()->to($this->base_url_index_page.strtolower($this->controller_name)."/");
		}
    }



	public function chg_pwd_form() {
		echo view("chg_pwd_form");
	}
	public function chg_pwd() { 
		if(!$this->request->isAJAX()) {
			//$this->main);
			return redirect()->to(base_url());
		} else {
			// need this ================
			$this->init_app();
			// ==========================
			$PasswordLama = $_POST["PasswordLama"];
			$PasswordBaru = $_POST["PasswordBaru"];
			$ErrNbr = "9";
			$ErrMsg = "Database Error. Call the vendor!";
			if($this->session->get($this->AppModule . "UserID"))  {
				$KodeUser = $this->session->get($this->AppModule . "UserID");
				$oQuery = $this->bsa_model->chg_pwd($this->AppModule,$this->sql_safe($KodeUser),$this->sql_safe($PasswordLama),$this->sql_safe($PasswordBaru),$this->sql_safe(\Config\Services::request()->getIPAddress()),$this->sql_safe(\Config\Services::request()->getUserAgent()->getAgentString()));	
//				echo $oQuery; die();
				if(count($oQuery) > 0) {
					foreach($oQuery as $oRS) {
						$ErrNbr = $oRS->ErrNbr;
						$ErrMsg = $oRS->ErrMsg;
					}
				}
				echo $ErrNbr . "<!--###-->" . $ErrMsg;
//				echo $oQuery;
			} else {
				echo "Session habis. Harap login kembali.";
			}
		}
	}
	public function do_logout() {
		$this->init_app();	// iki penting kanggo resolve AppModule
		// record log
		//$this->load->model('bsa_model','',TRUE);	
//		$oQuery = $this->bsa_model->ins_log_record_ori($this->AppModule,$this->session->get($this->AppModule . "UserID"));	
//		$this->load->library('user_agent');
		//$oQuery = 
		$this->bsa_model->ins_log_record($this->AppModule,$this->session->get($this->AppModule . "UserID"),$this->sql_safe(\Config\Services::request()->getIPAddress()),$this->sql_safe(\Config\Services::request()->getUserAgent()->getAgentString()));	
		// kill session
		//$this->session->sess_destroy();

		//unset session
//		$this->session->unset_userdata($this->AppModule."UserID");
//		$this->session->unset_userdata($this->AppModule."UserName");
//
//		$this->session->unset_userdata($this->AppModule."Role");
		$this->session->destroy();
		return redirect()->to(base_url()."/bsa/");
	}
	public function do_login() {
		$strLoginErrNo = "1";
		$strLoginMessage = "Unknown error...";
		$strInputIdx = "0";
//		$this->init_app();
		$this->init();

//		echo $this->AppModule; die();
		if($this->SelisihHari>0) {
			if(isset($_POST["UserPassword"])) {

				$recaptcha = $this->request->getPost('g-recaptcha-response');
				if($recaptcha=="") {
					$strLoginErrNo = "8";
					$strLoginMessage = "Mohon diklik CAPTCHA";
					$strInputIdx = "0";
				} else {
					$this->recaptcha = new Recaptcha();
					$response = $this->recaptcha->verifyResponse($recaptcha);
					if (isset($response['success']) and $response['success'] === true) {				

						$strKodeUser = $_POST["UserID"];
						$strUserPwd = $_POST["UserPassword"];
		//				$this->load->library('user_agent');
			//			$oQuery = $this->bsa_model->do_login_ori($this->AppModule,$this->sql_safe($strKodeUser));	
						$oQuery = $this->bsa_model->do_login($this->AppModule,$this->sql_safe($strKodeUser),$this->sql_safe(\Config\Services::request()->getIPAddress()),$this->sql_safe(\Config\Services::request()->getUserAgent()->getAgentString()));	
		//				echo $oQuery; die();
						if(count($oQuery) > 0) {
							foreach($oQuery as $oRS) {
								$oRS_Password = $oRS->Password;
								$oRS_Aktif = $oRS->Aktif;
								$oRS_TotalMenu = $oRS->TotalMenu;
								$oRS_KodeUser = $oRS->KodeUser;
								$oRS_NamaUser = $oRS->NamaUser;
								$oRS_KodeRole = $oRS->KodeRole;
								$oRS_NamaRole = $oRS->NamaRole;
								
								$oRS_KodeInstansi = $oRS->KodeInstansi;
								
								$oRS_KodeController = $oRS->KodeController;
								$oRS_KodeView = $oRS->KodeView;
								$oRS_GambarPath = ""; //$oRS->GambarPath;
								
        						$oRS_Email = $oRS->Email;	// untuk cek user via email
								
			
			//					$oRS_HakAksesKhusus = $oRS->HakAksesKhusus;
								// tambahan untuk SIPAS
			//					$oRS_KodePosisi = $oRS->KodePosisi;
			//					$oRS_NamaInstansi = $oRS->NamaInstansi;
			//					$oRS_AliasInstansi = $oRS->AliasInstansi;
							}
				// 			if($oRS_KodeUser==$oRS_Email) {		// cek if user special SSO
							if($oRS_KodeUser==$oRS_Email) {		// cek if user special SSO
								$strLoginErrNo = "1";
								$strLoginMessage = "Harap login melalui Google...";
								$strInputIdx = "0";
							} else {
		
								if($oRS_Password==md5($strUserPwd) && $oRS_Aktif=="1")	{
									if($oRS_TotalMenu>0)	{
										$data_session=array(
											$this->AppModule . "UserID"=>$oRS_KodeUser, 
											$this->AppModule . "UserName"=>$oRS_NamaUser,
											$this->AppModule . "Role"=>$oRS_KodeRole,
											$this->AppModule . "RoleName"=>$oRS_NamaRole,
											$this->AppModule . "KodeController"=>$oRS_KodeController,
											$this->AppModule . "KodeView"=>$oRS_KodeView,
											$this->AppModule . "KodeInstansi"=>$oRS_KodeInstansi/*,
											$this->AppModule . "HakAksesKhusus"=>$oRS_HakAksesKhusus,
											
											$this->AppModule . "Posisi"=>$oRS_KodePosisi ,
											$this->AppModule . "NamaInstansi"=>$oRS_NamaInstansi,
											$this->AppModule . "AliasInstansi"=>$oRS_AliasInstansi */
										);
										$this->session->set($data_session);
										// set Kode Controller and View
			//							$this->KodeController = $oRS_KodeController;
			//							$this->KodeView = $oRS_KodeView;
										
										$strLoginErrNo = "0";
										$strLoginMessage = "Login valid".$this->session->get($this->AppModule . "KodeController");
										$strInputIdx = "0";
									} else {
										$strLoginErrNo = "1";
										$strLoginMessage = "Akun Anda tidak memiliki hak akses menu sama sekali.\nSilahkan kontak administrator.";
										$strInputIdx = "0";
									}
								}
								elseif($oRS->Aktif=="0")	{
									$strLoginErrNo = "1";
									$strLoginMessage = "Akun Anda tidak aktif. Silahkan kontak administrator.";
									$strInputIdx = "0";
								}
								else {
									$strLoginErrNo = "1";
									$strLoginMessage = "Password Anda salah, silahkan diulang";
									$strInputIdx = "1";
								}
							}

						}
						else	{
							$strLoginErrNo = "1";
							$strLoginMessage = "Anda tidak terdaftar sebagai User...";
							$strInputIdx = "0";
						}

					} else {
						$strLoginErrNo = "8";
						$strLoginMessage = "Mohon diklik CAPTCHA";
						$strInputIdx = "0";
					}
				}

			}
		} else {
			$strLoginErrNo = "1";
			$strLoginMessage = "Aplikasi \"suspended\".\nSilahkan kontak Vendor.";
			$strInputIdx = "0";
		}
		echo $strLoginErrNo . "<!--###-->" . $strLoginMessage . "<!--###-->" . $strInputIdx;
	}
	
	public function get_image() 
	{
		$KodeImage = $uri->getSegment(3);
		$oQuery = $this->bsa_model->get_image($this->AppModule,$KodeImage);	
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
	public function get_image_ext() 
	{
		$Extended = $uri->getSegment(3);
		$KodeImage = $uri->getSegment(4);
		$oQuery = $this->bsa_model->get_image_ext($this->AppModule,$Extended,$KodeImage);	
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
	public function get_image_thumb() 
	{
		$Extended = $uri->getSegment(3);
		$KodeImage = $uri->getSegment(4);
		$oQuery = $this->bsa_model->get_image_thumb($this->AppModule,$Extended,$KodeImage);	
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

	public function get_data_detail_spec() {
		if($this->session->get($this->AppModule . "UserID"))  {
			$arHREF = explode("/",$_POST["0"]);
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
			$data["KodeMenu"] = $KodeMenu;
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$Params = $this->get_param_detail_spec($KodeMenu);
			
			// uniformity purpose
			if($Params!="")  // KodeUser placed first after KodeApp
				$Params = "'" . $KodeUser . "',".$Params ;
			else
				$Params = "'" . $KodeUser . "'";
			
			$oQuery = $this->bsa_model->get_data_detail($this->AppModule,$KodeMenu,$Params);	
			$data["oQuery"] = $oQuery;
			echo view($KodeMenu."Detail",$data);	
		} else {
			echo "Session habis. Harap login kembali.";
		}
	}

	public function gen_data_detail_ext() {
		if($this->session->get($this->AppModule . "UserID"))  {
			$arHREF = explode("/",$_POST["0"]);
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
			$Extended = $_POST["1"];
			$data["KodeMenu"] = $KodeMenu;
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$KodeView = $this->session->get($this->AppModule . "KodeView");
			if(isset($_POST["id"])) { 
				$id = $_POST["id"];
				$Params = "'" . $id . "'";
				if(isset($_POST["go"]))
					$Params .= "," . $_POST["go"];
				if(isset($_POST["instansi"]))
					$Params = "'" . $_POST["instansi"] . "',".$Params;
				if(isset($_POST["periode"]))
					$Params = "'" . $_POST["periode"] . "',".$Params;
				if(isset($_POST["thn"]))
					$Params = "'" . $_POST["thn"] . "',".$Params;

				if(isset($_POST["go"])) {	// sementara
					// uniformity purpose
					if($Params!="")  // KodeUser placed first after KodeApp
						$Params = "'" . $KodeUser . "',".$Params ;
					else
						$Params = "'" . $KodeUser . "'";
				}
				$oQuery = $this->bsa_model->get_data_detail_ext($this->AppModule,$KodeView.$KodeMenu,$Extended,$Params);	
//					echo $oQuery; die(); // for debugging only
				$data["oQuery"] = $oQuery;
			}
//			echo $KodeView.$KodeMenu."Detail".$Extended; die();
			echo view($KodeView.$KodeMenu."Detail".$Extended,$data);	
		} else {
			echo "Session habis. Harap login kembali.";
		}
	}
	public function gen_detail_list() { 
		if($this->session->get($this->AppModule . "UserID"))  {
			$this->KodeView = $this->session->get($this->AppModule . "KodeView");
			$this->KodeController = $this->session->get($this->AppModule . "KodeController");
//			echo "test app"; die();
		
			$arHREF = explode("/",$_POST["0"]);
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
			$ListName = $_POST["1"];

//			$Params = $this->get_param_detail_list($KodeMenu,$ListName);
//			$oQuery = $this->bsa_model->get_detail_list($this->AppModule,$KodeMenu,$ListName,$Params);
//			$Params = $this->get_param_detail_list($this->KodeView.$KodeMenu,$ListName);
			$Params = $this->get_param_detail_list($this->KodeController.$KodeMenu,$ListName);
//			echo $Params; die();
			$oQuery = $this->bsa_model->get_detail_list($this->AppModule,$this->KodeView.$KodeMenu,$ListName,$Params);
			$data["oQuery"] = $oQuery;
//			echo  $oQuery; die();
			// added since 2020-12-13
			if(isset($_POST["id"]))
				$data["id"] = $_POST["id"];
			if(isset($_POST["periode"]))
				$data["periode"] = $_POST["periode"];

			echo view($this->KodeView.$KodeMenu."DetailList".$ListName,$data);	
		} else {
			echo "Session habis. Harap login kembali.";
		}
	}
	public function gen_form_spec() {
		if($this->session->get($this->AppModule . "UserID"))  {
			// initiate global data variable
			$this->init(); 
			
			$arHREF = explode("/",$_POST["0"]);
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
			$data["KodeMenu"] = $KodeMenu;
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$FormName = "Form";
			if(isset($_POST["1"])) 
				$FormName = $_POST["1"];
			$Params = $this->get_param_detail_spec($KodeMenu);
			
			// uniformity purpose
			if($Params!="")  // KodeUser placed first after KodeApp
				$Params = "'" . $KodeUser . "',".$Params ;
			else
				$Params = "'" . $KodeUser . "'";
			
			$oQuery = $this->bsa_model->get_data_detail($this->AppModule,$KodeMenu,$Params);	
			$data["oQuery"] = $oQuery;
			$data['AppClass'] = $this;
			$data['AppModule'] = $this->AppModule;
			$data['arModule'] = $this->arModule;
			$data["baseURL"] = base_url()."aps/";
			$data["base_url_class"] = $this->base_url_index_page.strtolower($this->controller_name)."/";
			$data["base_url_index_page"] = $this->base_url_index_page;
			$data["base_url_frontend"] = $this->base_url_frontend;
//			$data["TahunAktif"] = $this->TahunAktif; 
//			$data["ThnPengisianAnggaran"] = $this->ThnPengisianAnggaran; 
			echo view($KodeMenu.$FormName,$data);	
		} else {
			echo "Session habis. Harap login kembali.";
		}
	}

	public function gen_form_ext() {
		if($this->session->get($this->AppModule . "UserID"))  {
			// initiate global data variable
			$this->init(); 
			
			$arHREF = explode("/",$_POST["0"]);
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
			$data["KodeMenu"] = $KodeMenu;
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$FormName = "";
			if(isset($_POST["1"])) 
				$FormName .= $_POST["1"];
			$Params = $this->get_param_detail_ext($KodeMenu);
//			echo $Params;
			// uniformity purpose
			if($Params!="")  // KodeUser placed first after KodeApp
				$Params = "'" . $KodeUser . "',".$Params ;
			else
				$Params = "'" . $KodeUser . "'";
			
			$oQuery = $this->bsa_model->get_data_detail_ext($this->AppModule,$KodeMenu,$FormName,$Params);	
			$data["oQuery"] = $oQuery;
			$data['AppClass'] = $this;
			$data['AppModule'] = $this->AppModule;
			$data['arModule'] = $this->arModule;
			$data["baseURL"] = base_url()."aps/";
			$data["base_url_class"] = $this->base_url_index_page.strtolower($this->controller_name)."/";
			$data["base_url_index_page"] = $this->base_url_index_page;
			$data["base_url_frontend"] = $this->base_url_frontend;
			$data["PeriodeAktif"] = $this->PeriodeAktif;
//			$data["NamaPeriodeAktif"] = $this->NamaPeriodeAktif;
//			echo $oQuery;
			echo view($KodeMenu."Form".$FormName,$data);	
		} else {
			echo "Session habis. Harap login kembali.";
		}
	}


	public function gen_form() {
//		if($this->session->get($this->AppModule . "UserID"))  { // disabled since 2014-02-08 in SIPPD Project
			// initiate global data variable
			$this->init(); 
			// added since 2014-02-08 in SIPPD Project
			$arMenuNoLogin = explode(',',$this->MenuNoLogin);
			
			
			$arHREF = explode("/",$_POST["0"]);
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
			$data["KodeMenu"] = $KodeMenu;
		// if clause moved here
		if($this->session->get($this->AppModule . "UserID")
			|| in_array($KodeMenu,$arMenuNoLogin))  {
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$FormName = "";
			if(isset($_POST["1"])) 
				$FormName = $_POST["1"];
			if(isset($_POST["id"])) { 
				$id = $_POST["id"];
				$move = "0"; //$_POST["go"];
				
				$Params = "'" . $id . "'," . $move;
				// tambahan pada simpok
				if(isset($_POST["subkategori"]))
					$Params = "'" . $_POST["subkategori"] . "',".$Params;
				if(isset($_POST["kategori"]))
					$Params = "'" . $_POST["kategori"] . "',".$Params;
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

				// uniformity purpose
				if($Params!="")  // KodeUser placed first after KodeApp
					$Params = "'" . $KodeUser . "',".$Params ;
				else
					$Params = "'" . $KodeUser . "'";
				
				if($FormName!="")
					$oQuery = $this->bsa_model->get_data_detail_ext($this->AppModule,$KodeMenu,$FormName,$Params);	
				else
					$oQuery = $this->bsa_model->get_data_detail($this->AppModule,$KodeMenu,$Params);	
				$data["oQuery"] = $oQuery;
//				echo $oQuery;
			}
			if(isset($_POST["2"])) { 
				$RefName = $_POST["2"];
				$Params = "'" . $_POST["idref"] . "',0";
				$oQueryRef = $this->bsa_model->get_data_detail_ext($this->AppModule,$KodeMenu,$RefName,$Params);	
				$data["oQueryRef"] = $oQueryRef;
			}
			$data['AppClass'] = $this;
			$data['AppModule'] = $this->AppModule;
			$data['arModule'] = $this->arModule;
			$data["baseURL"] = base_url().strtolower($this->controller_name)."/";
			$data["base_url_class"] = $this->base_url_index_page.strtolower($this->controller_name)."/";
			$data["base_url_index_page"] = $this->base_url_index_page;
			$data["base_url_frontend"] = $this->base_url_frontend;
			$data["PeriodeAktif"] = $this->PeriodeAktif;
			$data["NamaPeriodeAktif"] = $this->NamaPeriodeAktif;
			$data["_POST"] = $_POST;
			echo view($KodeMenu."Form".$FormName,$data);	
		} else {
			echo "Session habis. Harap login kembali.";
		}
	}
	public function gen_modal_form() {
//		if($this->session->get($this->AppModule . "UserID"))  { // disabled since 2014-02-08 in SIPPD Project
			// initiate global data variable
			$this->init(); 
			// added since 2014-02-08 in SIPPD Project
			$arMenuNoLogin = explode(',',$this->MenuNoLogin);
			
			
			$arHREF = explode("/",$_POST["0"]);
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
			$data["KodeMenu"] = $KodeMenu;
		// if clause moved here
		if($this->session->get($this->AppModule . "UserID")
			|| in_array($KodeMenu,$arMenuNoLogin))  {
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$this->KodeView = $this->session->get($this->AppModule . "KodeView");
			$FormName = "";
			if(isset($_POST["1"])) 
				$FormName = $_POST["1"];
			if(isset($_POST["id"])) { 
				$id = $_POST["id"];
				$move = "0"; //$_POST["go"];
				
				$Params = "'" . $id . "'," . $move;

				if(isset($_POST["subkategori"]))
					$Params = "'" . $_POST["subkategori"] . "',".$Params;
				if(isset($_POST["kategori"]))
					$Params = "'" . $_POST["kategori"] . "',".$Params;
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


				if(isset($_POST["param05"]))
					$Params = "'" . $_POST["param05"] . "',".$Params;
				if(isset($_POST["param04"]))
					$Params = "'" . $_POST["param04"] . "',".$Params;
				if(isset($_POST["param03"]))
					$Params = "'" . $_POST["param03"] . "',".$Params;
				if(isset($_POST["param02"]))
					$Params = "'" . $_POST["param02"] . "',".$Params;
				if(isset($_POST["param01"]))
					$Params = "'" . $_POST["param01"] . "',".$Params;

				// uniformity purpose
				if($Params!="")  // KodeUser placed first after KodeApp
					$Params = "'" . $KodeUser . "',".$Params ;
				else
					$Params = "'" . $KodeUser . "'";

				if($FormName!="")
					$oQuery = $this->bsa_model->get_data_detail_ext($this->AppModule,$this->KodeView.$KodeMenu,$FormName,$Params);	
				else
					$oQuery = $this->bsa_model->get_data_detail($this->AppModule,$this->KodeView.$KodeMenu,$Params);	
				$data["oQuery"] = $oQuery;
//				echo $oQuery; die();
			}
			if(isset($_POST["2"])) { 
				$RefName = $_POST["2"];
				$Params = "'" . $_POST["idref"] . "',0";
				$oQueryRef = $this->bsa_model->get_data_detail_ext($this->AppModule,$KodeMenu,$RefName,$Params);	
				$data["oQueryRef"] = $oQueryRef;
			}
			$data['AppClass'] = $this;
			$data['AppModule'] = $this->AppModule;
			$data['arModule'] = $this->arModule;
			$data["baseURL"] = base_url().strtolower($this->controller_name)."/";
			$data["base_url_class"] = $this->base_url_index_page.strtolower($this->controller_name)."/";
			$data["base_url_index_page"] = $this->base_url_index_page;
			$data["base_url_frontend"] = $this->base_url_frontend;
			$data["PeriodeAktif"] = $this->PeriodeAktif;
			$data["NamaPeriodeAktif"] = $this->NamaPeriodeAktif;
			$data["_POST"] = $_POST;
				echo $this->KodeView.$KodeMenu."MdFrm".$FormName; die();
			echo view($this->KodeView.$KodeMenu."MdFrm".$FormName,$data);	
		} else {
			echo "Session habis. Harap login kembali.";
		}
	}
	public function gen_combo() {
		if(!$this->request->isAJAX()) {
			//$this->main();
			return redirect()->to(base_url());
		} else {
			if($this->session->get($this->AppModule . "UserID"))  {
				$arHREF = explode("/",$_POST["0"]);
//				$KodeMenuRaw = $arHREF[count($arHREF)-1];
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
				$data["KodeMenu"] = $KodeMenu;
				$KodeUser = $this->session->get($this->AppModule . "UserID");
				$ComboElement = $_POST["1"];
				$data["ComboElement"] = $ComboElement;
				$Params = "'".$KodeUser."'";
				$oQuery = $this->bsa_model->get_combo_list($this->AppModule,$ComboElement,$Params);	
				$data["oQuery"] = $oQuery;
				//echo $oQuery;
				echo view($KodeMenu."Combo".$ComboElement,$data);	
			} else {
				echo "Session habis. Harap login kembali.";
			}
		}
	}
	public function gen_combo_list() {
		if(!$this->request->isAJAX()) {
			//$this->main();
			return redirect()->to(base_url());
		} else {
			if($this->session->get($this->AppModule . "UserID"))  {
				$this->KodeView = $this->session->get($this->AppModule . "KodeView");
				$arHREF = explode("/",$_POST["0"]);
//				$KodeMenuRaw = $arHREF[count($arHREF)-1];
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
				$data["KodeMenu"] = $KodeMenu;
				$PopUpElement = $_POST["1"];
				$data["PopUpElement"] = $PopUpElement;
				$data['AppClass'] = $this;
				$oQuery = $this->bsa_model->get_pop_list($this->AppModule,$this->KodeView.$KodeMenu,$PopUpElement);	
				$data["oQuery"] = $oQuery;
				echo view($this->KodeView.$KodeMenu."List".$PopUpElement,$data);	
//				echo $oQuery;	// debugging
			} else {
				echo "Session habis. Harap login kembali.";
			}
		}
	}

	public function gen_combo_list_ext() {
		if(!$this->request->isAJAX()) {
			//$this->main();
			return redirect()->to(base_url());
		} else {
			if($this->session->get($this->AppModule . "UserID"))  {
				$this->KodeView = $this->session->get($this->AppModule . "KodeView");
			
				$arHREF = explode("/",$_POST["0"]);
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
				$data["KodeMenu"] = $KodeMenu;
				$PopUpElement = $_POST["1"];
				$data["PopUpElement"] = $PopUpElement;
				$Params = "'".$_POST["2"]."'";
				$data['AppClass'] = $this;
//				echo $Params; die();
				$oQuery = $this->bsa_model->get_pop_list_ext($this->AppModule,$this->KodeView.$KodeMenu,$PopUpElement,$Params);	
				$data["oQuery"] = $oQuery;
//				echo $oQuery; die();
//				echo $this->KodeView.$KodeMenu."List".$PopUpElement; die();	// debugging
				echo view($this->KodeView.$KodeMenu."List".$PopUpElement,$data);	
			} else {
				echo "Session habis. Harap login kembali.";
			}
		}
	}
	public function gen_popup_win() {
		if(!$this->request->isAJAX()) {
			//$this->main();
			return redirect()->to(base_url());
		} else {
			if($this->session->get($this->AppModule . "UserID"))  {
				$arHREF = explode("/",$_POST["0"]);
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
				$data["KodeMenu"] = $KodeMenu;
				$PopUpElement = $_POST["1"];
				$data["PopUpElement"] = $PopUpElement;
				$data['AppClass'] = $this;
				$oQuery = $this->bsa_model->get_pop_list($this->AppModule,$KodeMenu,$PopUpElement);	
				$data["oQuery"] = $oQuery;
				echo view($KodeMenu."Pop".$PopUpElement,$data);	
//				echo $oQuery;	// debugging
			} else {
				echo "Session habis. Harap login kembali.";
			}
		}
	}
	public function gen_popup_win_ext() {
		if($this->session->get($this->AppModule . "UserID"))  {
			$arHREF = explode("/",$_POST["0"]);
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
			$data["KodeMenu"] = $KodeMenu;
			$PopUpElement = $_POST["1"];
			$data["PopUpElement"] = $PopUpElement;
			$data['AppClass'] = $this;
			if(isset($_POST["id"])) {
				$KodeExt = $_POST["id"];
				$Params = "'" . $KodeExt . "'";
				$data["Kode"] = $KodeExt;
			} else {
				$Params = $this->get_param_popup_win_ext($KodeMenu,$PopUpElement);
			}
			$oQuery = $this->bsa_model->get_pop_list_ext($this->AppModule,$KodeMenu,$PopUpElement,$Params);	
//			echo $oQuery; // debuging purpose
			$data["oQuery"] = $oQuery;
			echo view($KodeMenu."Pop".$PopUpElement,$data);	
		} else {
			echo "Session habis. Harap login kembali.";
		}
	}
	public function do_process_data() {
		if($this->session->get($this->AppModule . "UserID"))  {
			$arHREF = explode("/",$_POST["0"]);
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
			//$data["KodeMenu"] = $KodeMenu;
			$KodeView = $this->session->get($this->AppModule . "KodeView");
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$Params = $this->get_param_process($KodeView.$KodeMenu,$KodeUser);
//			$this->load->library('user_agent');
			$oQuery = $this->bsa_model->process_data($this->AppModule,$KodeView.$KodeMenu,$Params,$this->sql_safe(\Config\Services::request()->getIPAddress()),$this->sql_safe(\Config\Services::request()->getUserAgent()->getAgentString()));	
			//$data["oQuery"] = $oQuery;
//			echo $oQuery; die();
			if(count($oQuery) > 0) {
				foreach($oQuery as $oRS) {			
					echo $oRS->ErrNo . "###";
					echo $oRS->ErrDesc;
				}
			}
		} else {
			echo "Session habis. Harap login kembali.";
		}
	}
	public function do_save_data() {
		if($this->session->get($this->AppModule . "UserID"))  {
			$Post_0 = $_POST["0"];
			$pos = strpos($Post_0, "param");
			if($pos>0) {	
				$Post_0 = substr($Post_0,0,$pos-1);	// min 1 to remove /
			}
			$arHREF = explode("/",$Post_0);
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
//			//$data["KodeMenu"] = $KodeMenu;
			$KodeView = $this->session->get($this->AppModule . "KodeView");
			$KodeController = $this->session->get($this->AppModule . "KodeController");
			$KodeUser = $this->session->get($this->AppModule . "UserID");
//			echo $KodeController.$KodeMenu; die();
			$Params = $this->get_param_save($KodeController.$KodeMenu,$KodeUser);
//			echo $Params; die();
			$oQuery = $this->bsa_model->save_data($this->AppModule,$KodeView.$KodeMenu,$Params,$this->sql_safe(\Config\Services::request()->getIPAddress()),$this->sql_safe(\Config\Services::request()->getUserAgent()->getAgentString()));	
			//$data["oQuery"] = $oQuery;
//			echo $oQuery; die(); // for debugging
			if(count($oQuery) > 0) {
				foreach($oQuery as $oRS) {			
					echo $oRS->ErrNo . "###";
					echo $oRS->ErrDesc . "###";
					echo "KodeLama@@@" . $oRS->Kode . "<!--##-->";
					echo "FirstRec@@@" . $oRS->FirstRec . "<!--##-->";
					echo "LastRec@@@" . $oRS->LastRec;
				}
			}
		} else {
			echo "Session habis. Harap login kembali.";
		}
	}
	public function do_save_data_ext() {
		if($this->session->get($this->AppModule . "UserID"))  {
			$Post_0 = $_POST["0"];
			$pos = strpos($Post_0, "param");
			if($pos>0) {	
				$Post_0 = substr($Post_0,0,$pos-1);	// min 1 to remove /
			}
			$arHREF = explode("/",$Post_0);
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
//			//$data["KodeMenu"] = $KodeMenu;
			$Extended = "";
			if(isset($_POST["ext"]))
				$Extended = $_POST["ext"];
			$KodeView = $this->session->get($this->AppModule . "KodeView");
			$KodeController = $this->session->get($this->AppModule . "KodeController");
			$KodeUser = $this->session->get($this->AppModule . "UserID");

			$Params = $this->get_param_save($KodeController.$KodeMenu,$KodeUser,$Extended);
//			echo $KodeView.$KodeMenu.$Params; die();
			$oQuery = $this->bsa_model->save_data($this->AppModule,$KodeView.$KodeMenu,$Params,$this->sql_safe(\Config\Services::request()->getIPAddress()),$this->sql_safe(\Config\Services::request()->getUserAgent()->getAgentString()),$Extended);	
			$data["oQuery"] = $oQuery;
//			echo $oQuery; die(); // for debugging
			if(count($oQuery) > 0) {
				foreach($oQuery as $oRS) {			
					echo $oRS->ErrNo . "###";
					echo $oRS->ErrDesc . "###";
					echo "KodeLama@@@" . $oRS->Kode . "<!--##-->";
					echo "FirstRec@@@" . $oRS->FirstRec . "<!--##-->";
					echo "LastRec@@@" . $oRS->LastRec;
				}
			}

		} else {
			echo "Session habis. Harap login kembali.";
		}
	}
	public function do_remove_doc() {
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
		$KodeUser = $this->session->get($this->AppModule . "UserID");
		$KodeView = $this->session->get($this->AppModule . "KodeView");
		
		$Kode = $_POST["Kode"];
		$Folder = $_POST["Folder"];
		$DocIdx = "";
		if(isset($_POST["DocIdx"])) {
			$DocIdx = $_POST["DocIdx"];
		}
		//$src_path = "uploads/docs/".$Folder."/";
		// utk JDIH
		$src_path = "../docs/".$Folder."/";
//		$upload_path = $this->base_path_frontend.$src_path; 
////		@unlink($upload_path.$_POST["FileOri"]);
//		@unlink("/".$upload_path.$_POST["FileOri"]);
//		$upload_path = $this->base_path_frontend."/".$src_path; 
		$upload_path = $this->base_path_frontend.$src_path; 

		@unlink($upload_path.$_POST["FileOri"]);
		
		if($DocIdx!="")
			$oQuery = $this->bsa_model->remove_doc_db_path_ext($this->AppModule,$KodeView.$KodeMenu,$Kode,$DocIdx,$KodeUser);	
		else
			$oQuery = $this->bsa_model->remove_doc_db_path($this->AppModule,$KodeView.$KodeMenu,$Kode,$KodeUser);	
//		echo $oQuery; die();
		echo $upload_path.$_POST["FileOri"];
	}

	public function do_remove_docv2() {
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
		$KodeUser = $this->session->get($this->AppModule . "UserID");
		$KodeView = $this->session->get($this->AppModule . "KodeView");
		
		$Kode = $_POST["Kode"];
		$Folder = $_POST["Folder"];
		$DocIdx = "";
		if(isset($_POST["DocIdx"])) {
			$DocIdx = $_POST["DocIdx"];
		}
//		$src_path = "uploads/docs/".$Folder."/";
		$src_path = "docs/".$Folder."/";
//		$upload_path = $this->base_path_frontend.$src_path; 
////		@unlink($upload_path.$_POST["FileOri"]);
//		@unlink($this->writable_folder.$upload_path.$_POST["FileOri"]);
		$upload_path = $this->base_path_frontend.$src_path; 

		@unlink($upload_path.$_POST["FileOri"]);
		
		if($DocIdx!="")
			$oQuery = $this->bsa_model->remove_docv2_db_path_ext($this->AppModule,$KodeView.$KodeMenu,$Kode,$DocIdx,$KodeUser);	
		else
			$oQuery = $this->bsa_model->remove_docv2_db_path($this->AppModule,$KodeView.$KodeMenu,$Kode,$KodeUser);	
//		echo $oQuery; die();
		echo $upload_path.$_POST["FileOri"];
	}

	public function do_upload_doc() {
		if(isset($_POST["href"])) {
			$fileElementName = 'fileToUpload';
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
			$src_path = "uploads/docs/";
			// utk SIAP PAKDE
			//$src_path = "../docs/";
			if(isset($_POST["Folder"])) {
				$Folder = $_POST["Folder"];
				$src_path .= $Folder."/";
			}
//			$upload_path = $this->base_path_frontend."/".$src_path; 
			$upload_path = $this->base_path_frontend.$src_path; 
		
			// get filename
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$KodeView = $this->session->get($this->AppModule . "KodeView");

			$FileName = str_replace(".","_",$Kode);
			$FileName = str_replace("#","_",$FileName);

			if($DocIdx!="" && intval($DocIdx)>0) {
				$FileName = $FileName."_".$DocIdx;
			} 

//			echo $upload_path; die();
			$validationRule = [
				'fileToUpload' => [
					'label' => 'Doc File',
					'rules' => [
						'uploaded[fileToUpload]',
						'mime_in[fileToUpload,application/pdf,application/vnd.ms-excel,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation]',
						'max_size[fileToUpload,10000]',
					],
				],
			];
			if (!$this->validate($validationRule)) {
				echo "Tipe file yang diijinkan adalah pdf, doc, docx, xls, xlsx, ppt dan pptx, dengan ukuran maksimal 10 MB.";
			} else {

		        $file  = $this->request->getFile('fileToUpload');

//				$FileName = $file->getRandomName();

				if (!$file->hasMoved()) {
					$file->move($upload_path,$FileName.".".$file->getClientExtension(),true);
	
//					return view('upload_success', $data);
//					echo $upload_path.$FileName;

					$ext = $file->getClientExtension();
					//$ext = $upload_data['image_type'];
					$filename = $FileName.".".$file->getClientExtension();
					$size = $file->getSizeByUnit('kb');
					$is_image = "0";
					if($DocIdx!="")
						$oQuery = $this->bsa_model->upload_doc_db_path_ext($this->AppModule,$KodeView.$KodeMenu,$Kode,$DocIdx,$src_path.$filename,$ext,$size,$is_image,$KodeUser);	
					else
						$oQuery = $this->bsa_model->upload_doc_db_path($this->AppModule,$KodeView.$KodeMenu,$Kode,$src_path.$filename,$ext,$size,$is_image,$KodeUser);	
//					echo $oQuery; die();
					if(isset($_POST["FileOri"])) {
						// hapus yg lama
//						echo $upload_path.$_POST["FileOri"];
						if($filename!=$_POST["FileOri"]) @unlink($upload_path.$_POST["FileOri"]);
					}
					echo $src_path.$filename;



				} else {
					echo "gagal";	
				}
//				echo $newName;
			}
		}
	}
	public function do_upload_docv2() {
		if(isset($_POST["href"])) {
			$fileElementName = 'fileToUpload';
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
			$src_path = "uploads/docs/";
//			$src_path = "docs/";
			if(isset($_POST["Folder"])) {
				$Folder = $_POST["Folder"];
				$src_path .= $Folder."/";
			}
			$upload_path = $this->base_path_frontend.$src_path; 

			// get filename
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$KodeView = $this->session->get($this->AppModule . "KodeView");

			$FileName = str_replace(".","_",$Kode);
			$FileName = str_replace("#","_",$FileName);

			if($DocIdx!="" && intval($DocIdx)>0) {
				$FileName = $FileName."_".$DocIdx;
			} 

//			echo $upload_path; die();
			$validationRule = [
				'fileToUpload' => [
					'label' => 'Doc File',
					'rules' => [
						'uploaded[fileToUpload]',
						'mime_in[fileToUpload,application/pdf,application/vnd.ms-excel,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation]',
						'max_size[fileToUpload,10000]',
					],
				],
			];
			if (!$this->validate($validationRule)) {
				echo "Tipe file yang diijinkan adalah pdf, doc, docx, xls, xlsx, ppt dan pptx, dengan ukuran maksimal 10 MB.";
			} else {

		        $file  = $this->request->getFile('fileToUpload');

//				$FileName = $file->getRandomName();

				if (!$file->hasMoved()) {
					$file->move($upload_path,$FileName.".".$file->getClientExtension(),true);
	
//					return view('upload_success', $data);
//					echo $upload_path.$FileName;

					$ext = $file->getClientExtension();
					//$ext = $upload_data['image_type'];
					$filenameori = $file->getClientName();
					$filename = $FileName.".".$file->getClientExtension();

					$size = $file->getSizeByUnit('kb');
					$is_image = "0";
					if($DocIdx!="")
						$oQuery = $this->bsa_model->upload_docv2_db_path_ext($this->AppModule,$KodeView.$KodeMenu,$Kode,$DocIdx,$src_path.$filename,$filenameori,$ext,$size,$is_image,$KodeUser);	
					else
						$oQuery = $this->bsa_model->upload_docv2_db_path($this->AppModule,$KodeView.$KodeMenu,$Kode,$src_path.$filename,$filenameori,$ext,$size,$is_image,$KodeUser);	
//					echo $oQuery; die();
					if(isset($_POST["FileOri"])) {
						// hapus yg lama
//						echo $upload_path.$_POST["FileOri"];
						if($filename!=$_POST["FileOri"]) @unlink($upload_path.$_POST["FileOri"]);
					}
					echo $src_path.$filename;



				} else {
					echo "gagal";	
				}
//				echo $newName;
			}
		}
	}

	public function do_upload_docv2s3() {
		if(isset($_POST["href"])) {
			$fileElementName = 'fileToUpload';
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
			$src_path = "uploads/docs/";
//			$src_path = "docs/";
			if(isset($_POST["Folder"])) {
				$Folder = $_POST["Folder"];
				$src_path .= $Folder."/";
			}
			$upload_path = $this->base_path_frontend.$src_path; 

			// get filename
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$KodeView = $this->session->get($this->AppModule . "KodeView");

			$FileName = str_replace(".","_",$Kode);
			$FileName = str_replace("#","_",$FileName);

			if($DocIdx!="" && intval($DocIdx)>0) {
				$FileName = $FileName."_".$DocIdx;
			} 

//			echo $upload_path; die();
			$validationRule = [
				'fileToUpload' => [
					'label' => 'Doc File',
					'rules' => [
						'uploaded[fileToUpload]',
						'mime_in[fileToUpload,application/pdf,application/vnd.ms-excel,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation]',
						'max_size[fileToUpload,5000]',
					],
				],
			];
			if (!$this->validate($validationRule)) {
				echo "Tipe file yang diijinkan adalah pdf, doc, docx, xls, xlsx, ppt dan pptx, dengan ukuran maksimal 5 MB.";
			} else {

		        $file  = $this->request->getFile('fileToUpload');

//				$FileName = $file->getRandomName();

				if (!$file->hasMoved()) {
					$file->move($upload_path,$FileName.".".$file->getClientExtension(),true);
	
//					return view('upload_success', $data);
//					echo $upload_path.$FileName;

					$ext = $file->getClientExtension();
					//$ext = $upload_data['image_type'];
					$filenameori = $file->getClientName();
					$filename = $FileName.".".$file->getClientExtension();

					$size = $file->getSizeByUnit('kb');
					$is_image = "0";


					// mulai dari sini 
//					$this->config->load('s3', TRUE);				
//					$s3_config = $this->config->item('s3');
//			
					$awsURL = $this->awsURL;

					$awsAccessKey = $this->awsAccessKey;
					$awsSecretKey = $this->awsSecretKey;
					$awsBucketName = $this->awsBucketName;
					$awsFolderParent = $this->awsFolderParent;
					$awsFolder = $awsFolderParent."docs/".$Folder;

					// Instantiate an Amazon S3 client.
					$s3 = new S3Client([
						'version' => 'latest',
						'region'  => 'id-jkt-1',
						'credentials' => [
							'key'    => $awsAccessKey,
							'secret' => $awsSecretKey,
						],
						'endpoint' => "http://".$awsURL
					]);
					
					$filePath = $upload_path.$filename;
					
					if (file_exists($filePath)) { 
						 try {
							$S3Return = $s3->putObject([
								'Bucket' => $awsBucketName,
								'Key'    => $awsFolder.'/'.$filename,
								'SourceFile'   => $filePath,
								'ACL'    => 'public-read'
							]);
			
						 } catch (Exception $e) {
							$S3Return = $e->getMessage(); //false;
						 }
						 if($S3Return) {
//							$AWSFilePathDB = "http://".$awsBucketName.'/'.$awsFolder.'/'.$filename;
							$AWSFilePathDB = "https://".$awsURL.$awsBucketName.'/'.$awsFolder.'/'.$filename;

							if($DocIdx!="")

								$oQuery = $this->bsa_model->upload_docv2_db_path_ext($this->AppModule,$KodeView.$KodeMenu,$Kode,$DocIdx,$AWSFilePathDB,$filenameori,$ext,$size,$is_image,$KodeUser);	
							else
								$oQuery = $this->bsa_model->upload_docv2_db_path($this->AppModule,$KodeView.$KodeMenu,$Kode,$AWSFilePathDB,$filenameori,$ext,$size,$is_image,$KodeUser);	
//							echo $oQuery; die();
							// hapus yg di localhost
							@unlink($filePath);
							echo $AWSFilePathDB;
						 }

					} else echo "error S3 uploading";
					@unlink($fileTempName);
				} else {
					echo "gagal";	
				}
			}
		}
	}

	public function do_upload_img() {
		$fileElementName = 'FileGambar';
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
		$src_path = "uploads/imgs/".$Folder."/";
		$upload_path = $this->base_path_frontend.$src_path; 
		$ImgOri = "";
		if(isset($_POST["ImgOri"])) {
			$ImgOri = $_POST["ImgOri"];
		}
		$ThumbOri = "";
		if(isset($_POST["ThumbOri"])) {
			$ThumbOri = $_POST["ThumbOri"];
		}

		$height = 600;
		$width = 800;
		$no_thumb = false;
		if(isset($_POST["height"]))
			$height = $_POST["height"];
		if(isset($_POST["width"]))
			$width = $_POST["width"];
		if(isset($_POST["no_thumb"])) {
			$no_thumb = filter_var($_POST["no_thumb"], FILTER_VALIDATE_BOOLEAN);

		}
//		$config['upload_path'] = $upload_path; 
//		$config['upload_path'] = "/".$upload_path; 
		$config['upload_path'] = $upload_path; 
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 0;
		$config['max_width'] = 0;
		$config['max_height'] = 0;
		$config['overwrite'] = TRUE;
		// special addition to prevent bugs in CI - Upload
		if (strpos($Kode, '.') === TRUE) {
			$config['file_name'] = $Kode;
		} else {
			$config['file_name'] = str_replace(".","_",$Kode);
		}
		
		$this->load->library('upload', $config);		
//		echo $fileElementName; die();
		if ($this->upload->do_upload($fileElementName)) {
			$upload_data = $this->upload->data();
			$this->upload_finishing($KodeMenu,$Kode,$upload_data,$upload_path,$src_path,$width,$height,$no_thumb,$ImgOri,$ThumbOri);
		} else { echo "errornya;".$this->upload->display_errors(); }
	}
	public function upload_finishing($KodeMenu,$Kode,$upload,$upload_path,$src_path,$width,$height,$no_thumb,$ImgOri,$ThumbOri) {    
		$this->load->library('image_lib');
		$filename = $upload['file_name'];
		$thumbfilename = $upload['file_name'];
		$filesize = $upload['file_size'];
		if(!$no_thumb) {
			$thumbfilename = $upload['raw_name'].'_thumb'.$upload['file_ext']; 
			//[ THUMB IMAGE ]
			$img_config_0['image_library'] = 'gd2';
//			$img_config_0['source_image'] = $upload_path.$filename;
//			$img_config_0['source_image'] = "/".$upload_path.$filename;
			$img_config_0['source_image'] = $upload_path.$filename;
			$img_config_0['maintain_ratio'] = TRUE;
			$img_config_0['width'] = 240;
			$img_config_0['height'] = 180;    
			$img_config_0['create_thumb'] = TRUE;
			
			$this->image_lib->initialize($img_config_0); // load 2nd config  
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			}
		}
		//[ MAIN IMAGE ]
		$img_config_1['image_library'] = 'gd2';
//		$img_config_1['source_image'] = $upload_path.$filename;
//		$img_config_1['source_image'] = "/".$upload_path.$filename;
		$img_config_1['source_image'] = $upload_path.$filename;
		$img_config_1['maintain_ratio'] = TRUE;
		$img_config_1['width'] = $width;
		$img_config_1['height'] = $height;
		$img_config_1['create_thumb'] = FALSE;	
		
		$this->image_lib->initialize($img_config_1); // load 2nd config  
        if (!$this->image_lib->resize()) {
            echo $this->image_lib->display_errors();
        } else {
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$oQuery = $this->bsa_model->upload_img_db_path($this->AppModule,$KodeMenu,$Kode,$src_path.$filename,$src_path.$thumbfilename,$KodeUser);	
			// hapus yg lama
			if($ImgOri!="" && $src_path.$filename!=$ImgOri) {
				@unlink($ImgOri);
			}
			if($ThumbOri!="" &&  $src_path.$thumbfilename!=$ThumbOri) {
				@unlink($ThumbOri);
			}
			echo $src_path.$thumbfilename;	
		}
	}
	function do_upload_img_crop() { 
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


		$img = $_POST['fileimg'];
//		$src_path = "uploads/imgs/".$_POST['folder']."/";	// rsud pake ini
//		$src_path = "uploads/".$_POST['folder']."/";	// jdih pake ini
		$src_path = "uploads/imgs/".$_POST['folder']."/";	// dprd pake ini karena di folder atasnya
		$Folder = $_POST['folder'];

//		$src_path = "images/".$Folder."/";
//		$upload_path = $this->base_path_frontend.$src_path; 
		$upload_path = $this->base_path_frontend.$src_path; 
//echo $upload_path; die();
		$img = str_replace('data:image/jpeg;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
//		file_put_contents($src_path.$filename.".jpg", $data);	
// 		ganti ini
//echo $src_path.$filename.".jpg"; //die();
//		file_put_contents($src_path.$filename.".jpg", $data);	
		file_put_contents($this->base_path_frontend.$src_path.$filename.".jpg", $data);	
		
		
		$filePath = $upload_path.$filename.".jpg";

		if (file_exists($filePath)) { //echo $filePath; die();
			$oQuery = $this->bsa_model->upload_img_db_path($this->AppModule,$KodeView.$KodeMenu,$Kode,$src_path.$filename.".jpg","",$KodeUser);
//			echo $oQuery; die();
			echo $src_path.$filename.".jpg";
		} else echo "error local uploading";

		
	}
	function do_upload_img_crop_png() {
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


		$img = $_POST['fileimg'];
//		$src_path = "uploads/imgs/".$_POST['folder']."/";
		$src_path = "uploads/".$_POST['folder']."/";
		$Folder = $_POST['folder'];
//echo $src_path; die();
// //		$src_path = "images/".$Folder."/";
// 		$upload_path = $this->base_path_frontend."/".$src_path; 
		$upload_path = $this->base_path_frontend.$src_path; 

		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
// //		file_put_contents($src_path.$filename.".png", $data);	
// 		file_put_contents("/".$src_path.$filename.".png", $data);	
//		file_put_contents($src_path.$filename.".png", $data);	
		file_put_contents($this->base_path_frontend.$src_path.$filename.".png", $data);	
		
		$filePath = $upload_path.$filename.".png";
//echo $src_path.$filename.".png"; die();
		if (file_exists($filePath)) { 
			$oQuery = $this->bsa_model->upload_img_db_path($this->AppModule,$KodeView.$KodeMenu,$Kode,$src_path.$filename.".png","",$KodeUser);
//			echo $oQuery; die();
			echo $src_path.$filename.".png";
		} else echo "error local uploading";

		
	}
	function do_upload_img_crops3() {
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


		$img = $_POST['fileimg'];
//		$src_path = "upload/imgs/".$_POST['folder']."/";
		$src_path = "uploads/".$_POST['folder']."/";
		$Folder = $_POST['folder'];

//		$src_path = "images/".$Folder."/";
		$upload_path = $this->base_path_frontend.$src_path; 

		$img = str_replace('data:image/jpeg;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
//		file_put_contents($src_path.$filename.".jpg", $data);	
//		file_put_contents("/".$src_path.$filename.".jpg", $data);	
		file_put_contents($src_path.$filename.".jpg", $data);	
		
//		$filePath = $upload_path.$filename.".jpg";
//		$filePath = "/".$upload_path.$filename.".jpg";
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

				$oQuery = $this->m_app_model->upload_img_db_path($this->AppCode,$KodeMenu,$Kode,$AWSFilePathDB,"",$KodeUser);
//				echo $oQuery; die();
				echo $AWSFilePathDB;
				

//						echo $filename;
			} else echo "error S3 uploading";
			@unlink($filePath);
		} else echo "error local uploading";

		
	}
	public function do_upload_img_db() {
		$fileElementName = 'fileToUpload';
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

		$config['upload_path'] = "./uploadtmp/";
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 0;
		$config['max_width'] = 0;
		$config['max_height'] = 0;
		$config['overwrite'] = TRUE;
		$config['file_name'] = $Kode;
		
		$this->load->library('upload', $config);		
		if ($this->upload->do_upload($fileElementName)) {
			$upload_data = $this->upload->data();
			//$ext = $upload_data['file_ext'];
			$ext = $upload_data['image_type'];
			$filename = $upload_data['file_name'];
			$config2['image_library'] = 'gd2';
			$config2['source_image'] = "./uploadtmp/".$filename;
			$config2['create_thumb'] = FALSE;
			$config2['maintain_ratio'] = TRUE;
			$config2['width'] = 480;
			$config2['height'] = 360;
			
			$this->load->library('image_lib', $config2);
			
//			$this->image_lib->resize();
			if (!$this->image_lib->resize())
			{
				echo $this->image_lib->display_errors();
			} else {
				$TmpFilePath = "./uploadtmp/".$filename;
				$imgData = addslashes(file_get_contents($TmpFilePath));
				// hapus temp file
				@unlink($TmpFilePath);
				
				$KodeUser = $this->session->get($this->AppModule . "UserID");
				$oQuery = $this->bsa_model->upload_img_db($this->AppModule,$KodeMenu,$Extended,$Kode,$imgData,$ext,$KodeUser);	
				if(count($oQuery) > 0) {
					foreach($oQuery as $oRS) {			
						$KodeGambar = $oRS->KodeGambar;
					}
					echo $KodeGambar;
				}
			}
		}
	}

	public function get_param_process($KodeMenu,$KodeUser) {
		$data['_POST'] = $_POST;
		$data['AppClass'] = $this;
		$data['Session_UserID'] = $KodeUser;
		return view($this->KodeView.$KodeMenu."ProcessParam",$data,TRUE);	
	}
	public function get_param_save($KodeMenu,$KodeUser,$Extended="") {
		$data['_POST'] = $_POST;
		$data['AppClass'] = $this;
		$data['KodeMenu'] = str_replace($this->session->get($this->AppModule . "KodeController"),"",$KodeMenu);
		$data['Session_UserID'] = $KodeUser;
		$data['Extended'] = $Extended;
		//echo strtolower($KodeMenu)."=as"; die();
		return $this->{strtolower($KodeMenu)}($data,"prmsave");
	}
	public function get_param_save_ext($KodeMenu,$Extended,$KodeUser) {
		$data['_POST'] = $_POST;
		$data['AppClass'] = $this;
		$data['KodeMenu'] = str_replace($this->session->get($this->AppModule . "KodeController"),"",$KodeMenu);
		
		$data['Session_UserID'] = $KodeUser;
//		return view($this->KodeView.$KodeMenu."Save".$Extended."Param",$data,TRUE);	
		return $this->{strtolower($KodeMenu)}($data,"prmsavext");
	}	
	public function get_param_detail_list($KodeMenu,$ListName) {
		$data['_POST'] = $_POST;
		$data['AppClass'] = $this;
//		return view($this->KodeView.$KodeMenu."DetailList".$ListName."Param",$data,TRUE);	
		$data['ListName'] = $ListName;
		return $this->{strtolower($KodeMenu)}($data,"prmdtlst");
	}
	public function get_param_detail_spec($KodeMenu) {
		$data['_POST'] = $_POST;
		$data['AppClass'] = $this;
//		return view($this->KodeView.$KodeMenu."DetailParam",$data,TRUE);	
		return $this->{strtolower($KodeMenu)}($data,"prmdtlsp");
	}
	public function get_param_detail_ext($KodeMenu) {
		$data['_POST'] = $_POST;
		$data['AppClass'] = $this;
		$Extended = $_POST["1"];
//		return view($this->KodeView.$KodeMenu."Detail".$Extended."Param",$data,TRUE);	
		return $this->{strtolower($KodeMenu)}($data,"prmdtlxt");
	}
// 	public function get_param_print_hdr($KodeMenu,$Doc) {
// 		$data['_POST'] = $_POST;
// 		$data['AppClass'] = $this;
// //		$KodeUser = $this->session->get($this->AppModule . "UserID");
// //		$data['KodeUser'] = $KodeUser;
// //		return view($this->KodeView.$KodeMenu."XLS".$Doc."ParamHdr",$data,TRUE);	
// 		return $this->{strtolower($KodeMenu)}($data,"prmprnhdr");
// 	}
// 	public function get_param_print_list($KodeMenu,$Doc) {
// 		$data['_POST'] = $_POST;
// 		$data['AppClass'] = $this;
// //		$KodeUser = $this->session->get($this->AppModule . "UserID");
// //		$data['KodeUser'] = $KodeUser;
// 		return $this->{strtolower($KodeMenu)}($data,"prmprnlst");
// 	}

	public function get_param_xls_hdr($KodeMenu,$Doc) {
		$data['_POST'] = $_POST;
		$data['AppClass'] = $this;
		return $this->{strtolower($KodeMenu)}($data,"prmxlsh");
	}
	public function get_param_xls_list($KodeMenu,$Doc) {
		$data['_POST'] = $_POST;
		$data['AppClass'] = $this;
		return $this->{strtolower($KodeMenu)}($data,"prmxlst");
	}
	public function get_param_pdf_hdr($KodeMenu,$Doc) {
		$data['_POST'] = $_POST;
		$data['AppClass'] = $this;
		$KodeUser = $this->session->get($this->AppModule . "UserID");
		$data['KodeUser'] = $KodeUser;
		return view($this->KodeView.$KodeMenu."PDF".$Doc."ParamHdr",$data,TRUE);	
	}
	public function get_param_pdf_list($KodeMenu,$Doc) {
		$data['_POST'] = $_POST;
		$data['AppClass'] = $this;
		$KodeUser = $this->session->get($this->AppModule . "UserID");
		$data['KodeUser'] = $KodeUser;
		return view($this->KodeView.$KodeMenu."PDF".$Doc."ParamList",$data,TRUE);	
	}
	public function get_param_print_hdr($KodeMenu,$Doc) {
		$data['_POST'] = $_POST;
		$data['AppClass'] = $this;
//		$KodeUser = $this->session->get($this->AppModule . "UserID");
//		$data['KodeUser'] = $KodeUser;
//		return�view($this->KodeView.$KodeMenu."XLS".$Doc."ParamHdr",$data,TRUE);	
		return $this->{strtolower($KodeMenu)}($data,"prmprnhdr");
	}
	public function get_param_print_list($KodeMenu,$Doc) {
		$data['_POST'] = $_POST;
		$data['AppClass'] = $this;
//		$KodeUser = $this->session->get($this->AppModule . "UserID");
//		$data['KodeUser'] = $KodeUser;
		return $this->{strtolower($KodeMenu)}($data,"prmprnlst");
	}
	public function do_del_data() {
		if($this->session->get($this->AppModule . "UserID"))  {

			$Post_0 = $_POST["0"];
			$pos = strpos($Post_0, "param");
			if($pos>0) {	
				$Post_0 = substr($Post_0,0,$pos-1);	// min 1 to remove /
			}
			$arHREF = explode("/",$Post_0);
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
			//$data["KodeMenu"] = $KodeMenu;
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$KodeView = $this->session->get($this->AppModule . "KodeView");

			$strIDSeries = $_POST["1"];
			$Params = "'" . $strIDSeries . "','" . $KodeUser ."'";

			$oQuery = $this->bsa_model->del_data($this->AppModule,$KodeView.$KodeMenu,$Params,$this->sql_safe(\Config\Services::request()->getIPAddress()),$this->sql_safe(\Config\Services::request()->getUserAgent()->getAgentString()));	
//			echo $oQuery; die();
			$Response = "";
			if(count($oQuery) > 0) {
				$errDesc = "";
				foreach($oQuery as $oRS) {			
					if($oRS->ErrNo!=0) $errDesc = "Data: " . $oRS->ErrDesc . "; ";
				}
				$Response = ($errDesc!="")  ?  "9@@@" : "0@@@";
				$Response = ($errDesc!="")  ?  $Response . $errDesc . "\ndisarankan untuk tidak dihapus, demi stabilitas sistem." : $Response . "0";
			}
			echo $Response;
		} else {
			echo "Session habis. Harap login kembali.";
		}
	}
	public function do_del_data_single() {
		if($this->session->get($this->AppModule . "UserID"))  {

			$Post_0 = $_POST["0"];
			$pos = strpos($Post_0, "param");
			if($pos>0) {	
				$Post_0 = substr($Post_0,0,$pos-1);	// min 1 to remove /
			}
			$arHREF = explode("/",$Post_0);
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
			//$data["KodeMenu"] = $KodeMenu;
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$KodeView = $this->session->get($this->AppModule . "KodeView");

			$strIDSeries = $_POST["1"];
			$Params = "'" . $strIDSeries . "','" . $KodeUser ."'";

			$oQuery = $this->bsa_model->del_data($this->AppModule,$KodeView.$KodeMenu,$Params,$this->sql_safe(\Config\Services::request()->getIPAddress()),$this->sql_safe(\Config\Services::request()->getUserAgent()->getAgentString()));	
//			echo $oQuery;
			$Response = "";
			if(count($oQuery) > 0) {
				$errDesc = "";
				foreach($oQuery as $oRS) {			
					if($oRS->ErrNo!=0) $errDesc = $oRS->ErrDesc;
				}
				$Response = ($errDesc!="")  ?  "9@@@" : "0@@@";
				$Response = ($errDesc!="")  ?  $Response . $errDesc . "\nDisarankan untuk tidak dihapus, demi stabilitas sistem." : $Response . "0";
			}
			echo $Response;
		} else {
			echo "Session habis. Harap login kembali.";
		}
	}
	public function do_del_dataimg() {
		if($this->session->get($this->AppModule . "UserID"))  {
			$arHREF = explode("/",$_POST["0"]);
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
			//$data["KodeMenu"] = $KodeMenu;
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$KodeView = $this->session->get($this->AppModule . "KodeView");
			$strIDSeries = $_POST["1"];
			$Params = "'" . $strIDSeries . "','" . $KodeUser ."'";

			$oQuery = $this->bsa_model->del_dataimg($this->AppModule,$KodeView.$KodeMenu,$Params,$this->sql_safe(\Config\Services::request()->getIPAddress()),$this->sql_safe(\Config\Services::request()->getUserAgent()->getAgentString()));	
//			echo $oQuery; die();
			$Response = "";
			if(count($oQuery) > 0) {
				$errDesc = "";
				foreach($oQuery as $oRS) {			
					if($oRS->ErrNo!=0) $errDesc = "Data: " . $oRS->ErrDesc . ", ";
					if(!is_null($oRS->Kode)) {
						if(!is_null($oRS->GambarPath)) @unlink($this->base_path_frontend.$oRS->GambarPath);
						if(!is_null($oRS->ThumbnailPath)) @unlink($this->base_path_frontend.$oRS->ThumbnailPath);
					}
				}
				$Response = ($errDesc!="")  ?  "9@@@" : "0@@@";
				$Response = ($errDesc!="")  ?  $Response . $errDesc . "\ndisarankan untuk tidak dihapus, demi stabilitas sistem." : $Response . "0";
			}
			echo $Response;
		} else {
			echo "Session habis. Harap login kembali.";
		}
	}
	public function do_del_data_dtl() {
		if($this->session->get($this->AppModule . "UserID"))  {
			$arHREF = explode("/",$_POST["0"]);
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
			//$data["KodeMenu"] = $KodeMenu;
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$KodeView = $this->session->get($this->AppModule . "KodeView");
			$strIDSeries = $_POST["1"];
			$Params = "'" . $strIDSeries . "','" . $KodeUser ."'";

			$oQuery = $this->bsa_model->del_data_dtl($this->AppModule,$KodeView.$KodeMenu,$Params,$this->sql_safe(\Config\Services::request()->getIPAddress()),$this->sql_safe(\Config\Services::request()->getUserAgent()->getAgentString()));	
//			echo $oQuery; die();
			$Response = "";
			if(count($oQuery) > 0) {
				$errDesc = "";
				foreach($oQuery as $oRS) {			
					if($oRS->ErrNo!=0) $errDesc = "Data: " . $oRS->ErrDesc . ", ";
					if(!is_null($oRS->Kode)) {
						if(!is_null($oRS->DokumenPath)) @unlink($this->base_path_frontend.$oRS->DokumenPath);
					}
				}
				$Response = ($errDesc!="")  ?  "9@@@" : "0@@@";
				$Response = ($errDesc!="")  ?  $Response . $errDesc . "\ndisarankan untuk tidak dihapus, demi stabilitas sistem." : $Response . "0";
			}
			echo $Response;
		} else {
			echo "Session habis. Harap login kembali.";
		}
	}
	public function do_del_data_dtl_img() {
		if($this->session->get($this->AppModule . "UserID"))  {
			$arHREF = explode("/",$_POST["0"]);
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
			//$data["KodeMenu"] = $KodeMenu;
			$KodeUser = $this->session->get($this->AppModule . "UserID");
			$KodeView = $this->session->get($this->AppModule . "KodeView");
			$strIDSeries = $_POST["1"];
			$Params = "'" . $strIDSeries . "','" . $KodeUser ."'";
			$oQuery = $this->bsa_model->del_data_dtl_img($this->AppModule,$KodeView.$KodeMenu,$Params,$this->sql_safe(\Config\Services::request()->getIPAddress()),$this->sql_safe(\Config\Services::request()->getUserAgent()->getAgentString()));	
//			echo $oQuery; die();
			$Response = "";
			if(count($oQuery) > 0) {
				$errDesc = "";
				foreach($oQuery as $oRS) {			
					if($oRS->ErrNo!=0) $errDesc = "Data: " . $oRS->ErrDesc . ", ";
					if(!is_null($oRS->Kode)) {
						if(!is_null($oRS->DokumenPath)) @unlink($this->base_path_frontend.$oRS->DokumenPath);
						if(!is_null($oRS->GambarPath)) @unlink($this->base_path_frontend.$oRS->GambarPath);
						if(!is_null($oRS->ThumbnailPath)) @unlink($this->base_path_frontend.$oRS->ThumbnailPath);
					}
				}
				$Response = ($errDesc!="")  ?  "9@@@" : "0@@@";
				$Response = ($errDesc!="")  ?  $Response . $errDesc . "\ndisarankan untuk tidak dihapus, demi stabilitas sistem." : $Response . "0";
			}
			echo $Response;
		} else {
			echo "Session habis. Harap login kembali.";
		}
	}
	public function gen_pdf() {
		if(!isset($_POST["Doc"])) {
			// header("location: /".$AppRoot); 	
			echo "<script language=\"javascript\">window.alert('Internal Error... Call the Vendor...'); window.close()</script>";
		} else {
			$Doc = $_POST["Doc"];
			$arHREF = explode("/",$_POST["HRef"]);
//			$KodeMenuRaw = $arHREF[count($arHREF)-1];
			// diganti ini ================================
			for($i = count($arHREF)-1; $i>0; $i--) {
				if(strlen($arHREF[$i])>120)	{
					$KodeMenuRaw = $arHREF[$i];
					break;
				}
			}
			// ============================================
			if(strlen($KodeMenuRaw)>100) {
				$mnupos = substr($KodeMenuRaw,0,1);
				$KodeMenu = substr_replace($KodeMenuRaw, '', 0, 129-intval($mnupos)); 
				$KodeMenu = substr_replace($KodeMenu, '', -1*intval($mnupos), intval($mnupos)); 
			} else {
				$KodeMenu=$this->BaseMenu;	
			}
			$ParamsHdr = $this->get_param_pdf_hdr($KodeMenu,$Doc);
			$oQueryHdr = $this->bsa_model->get_pdf_hdr($this->AppModule,$KodeMenu,$Doc,$ParamsHdr);
			$data["oQueryHdr"] = $oQueryHdr;

			$ParamsList = $this->get_param_pdf_list($KodeMenu,$Doc);
			$oQueryList = $this->bsa_model->get_pdf_list($this->AppModule,$KodeMenu,$Doc,$ParamsList);
			$data["oQueryList"] = $oQueryList;
			$data['_POST'] = $_POST;
			if(file_exists(FCPATH.$this->core_folder_path."app/Views/".$KodeMenu."PDF".$Doc.".php")) {
				echo view($KodeMenu."PDF".$Doc,$data);
			} else { 
				echo "<script language=\"javascript\">window.alert('underconstruction'); window.close()</script>";
			}
		}
	}

	public function is_ajax() {
		return (
			$this->_ci->input->server('HTTP_X_REQUESTED_WITH')&&
			($this->_ci->input->server('HTTP_X_REQUESTED_WITH')==
			'XMLHttpRequest')
		);
				
	}

	public function sql_safe($str, $like = FALSE)    {
		$str = addslashes($str);
        if ($like === TRUE)
        {
            $str = str_replace(array('%', '_'), array('\\%', '\\_'), $str);
        }
        
        return $str;
	}
	public function get_body_string($string) {
		$output="";
		$pos = strpos($string, "<body>");
		if($pos>0) {	
			$string = substr($string,$pos+6-strlen($string));
			$pos = strpos($string, "</body>");
			if($pos>0) {	
				$string = substr($string,0,$pos);
			}
		}
		return $string;
	}
	public function date_format_ymd_slashed($date)
	{
		global $arBulan, $arHari;
		$Year = date("Y",strtotime($date));		// YYYY
		$Month = date("n",strtotime($date));		// 1 - 12;
		$Day = date("d",strtotime($date));		// 01 - 31;
		$WeekDay = date("N",strtotime($date));	// 1(Monday) - 7(Sunday);
		return $Year . "/" . $Month . "/" . $Day;
	}
	public function date_format_ina($date)
	{
		global $arBulan, $arHari;
		$Year = date("Y",strtotime($date));		// YYYY
		$Month = date("n",strtotime($date));		// 1 - 12;
		$Day = date("d",strtotime($date));		// 01 - 31;
		$WeekDay = date("N",strtotime($date));	// 1(Monday) - 7(Sunday);
		return $Day . " " . $this->arBulan[$Month] . " " . $Year;
	}
	public function datetime_format_ina($date)
	{
		global $arBulan, $arHari;
		$Year = date("Y",strtotime($date));		// YYYY
		$Month = date("n",strtotime($date));		// 1 - 12;
		$Day = date("d",strtotime($date));		// 01 - 31;
		$WeekDay = date("N",strtotime($date));	// 1(Monday) - 7(Sunday);
		$Time = date("H:i",strtotime($date));		// 01 - 31;
		return $Day . " " . $this->arBulan[$Month] . " " . $Year . " "  . " " . date('H:i:s',strtotime($date));
	}
	public function date_format_ina_full($date)
	{
		global $arBulan, $arHari;
		$Year = date("Y",strtotime($date));		// YYYY
		$Month = date("n",strtotime($date));		// 1 - 12;
		$Day = date("d",strtotime($date));		// 01 - 31;
		$WeekDay = date("N",strtotime($date));	// 1(Monday) - 7(Sunday);
		$Time = date("H:i",strtotime($date));		// 01 - 31;
		return $this->arHari[$WeekDay] . ", " . $Day . " " . $this->arBulan[$Month] . " " . $Year;
	}
	public function date_format_ina_fullshort($date)
	{
		global $arBulan, $arHari;
		$Year = date("Y",strtotime($date));		// YYYY
		$Month = date("n",strtotime($date));		// 1 - 12;
		$Day = date("d",strtotime($date));		// 01 - 31;
		$WeekDay = date("N",strtotime($date));	// 1(Monday) - 7(Sunday);
		$Time = date("H:i",strtotime($date));		// 01 - 31;
		return $this->arHari[$WeekDay] . ", " . $Day . " " . $this->arBulanShort[$Month] . " " . $Year;
	}
	public function datetime_format_ina_full($date)
	{
		global $arBulan, $arHari;
		$Year = date("Y",strtotime($date));		// YYYY
		$Month = date("n",strtotime($date));		// 1 - 12;
		$Day = date("d",strtotime($date));		// 01 - 31;
		$WeekDay = date("N",strtotime($date));	// 1(Monday) - 7(Sunday);
		$Time = date("H:i",strtotime($date));		// 01 - 31;
		return $this->arHari[$WeekDay] . ", " . $Day . " " . $this->arBulan[$Month] . " " . $Year . " "  . " " . date('H:i:s',strtotime($date));
	}
	public function datetime_format_ina_fullshort($date)
	{
		global $arBulan, $arHari;
		$Year = date("Y",strtotime($date));		// YYYY
		$Month = date("n",strtotime($date));		// 1 - 12;
		$Day = date("d",strtotime($date));		// 01 - 31;
		$WeekDay = date("N",strtotime($date));	// 1(Monday) - 7(Sunday);
		$Time = date("H:i",strtotime($date));		// 01 - 31;
		return $this->arHari[$WeekDay] . ", " . $Day . " " . $this->arBulanShort[$Month] . " " . $Year . " "  . " " . date('H:i:s',strtotime($date));
	}
	public function romawi($num) 
	{
		$n = intval($num);
		$res = '';
	 
		/*** roman_numerals array  ***/
		$roman_numerals = array(
					'M'  => 1000,
					'CM' => 900,
					'D'  => 500,
					'CD' => 400,
					'C'  => 100,
					'XC' => 90,
					'L'  => 50,
					'XL' => 40,
					'X'  => 10,
					'IX' => 9,
					'V'  => 5,
					'IV' => 4,
					'I'  => 1);
	 
		foreach ($roman_numerals as $roman => $number) 
		{
			/*** divide to get  matches ***/
			$matches = intval($n / $number);
	 
			/*** assign the roman char * $matches ***/
			$res .= str_repeat($roman, $matches);
	 
			/*** substract from the number ***/
			$n = $n % $number;
		}
	 
		/*** return the res ***/
		return $res;
    }	

	public function str_ellipsis($string, $length, $stopanywhere=false) {
		//truncates a string to a certain char length, stopping on a word if not specified otherwise.
		if (strlen($string) > $length) {
			//limit hit!
			$string = substr($string,0,($length -3));
			if ($stopanywhere) {
				//stop anywhere
				$string .= '...';
			} else{
				//stop on a word.
				$string = substr($string,0,strrpos($string,' ')).'...';
			}
		}
		return $string;
	}
	
	function send_mail($mailto,$mailfrom,$subject,$message)
	{
		$this->load->library('email');
		$config['protocol']    = 'smtp';
		$config['smtp_host']    = 'ssl://smtp.mail.yahoo.com';
		$config['smtp_port']    = 465;
		$config['smtp_timeout'] = 7;
		$config['smtp_user']    = 'notifikasiaplikasi@yahoo.com';
		$config['smtp_pass']    = 'notifikasi1234';
		$config['charset']    = 'utf-8';
		$config['newline']    = "\r\n";
		$config['mailtype'] = 'text'; // or html
		$config['validation'] = TRUE; // bool whether to validate email or not      
		$this->email->initialize($config);

		$this->email->from('notifikasiaplikasi@yahoo.com', $mailfrom);
		$this->email->reply_to('noreply@yahoo.com'); 
		$this->email->to($mailto); 
		$this->email->subject($subject);
		$this->email->message($message);
		if($this->email->send()) {
			echo 'Email sent.';
		}
		else {
            echo $this->email->print_debugger();
		}
	}


	function summernote_saveimg() {	
		if($this->request->isAJAX()) {
    		if ($_FILES['file']['name']) {
    		  if (!$_FILES['file']['error']) {
    			$name = date("Ymd").md5(rand(100, 200));
    			$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    			$filename = $name.
    			'.'.$ext;
    //			$destination = $this->writable_folder.'/uploads/imgs/rte/'.$filename; //change this directory
    			$destination = 'uploads/imgs/rte/'.$filename; //change this directory
    			$location = $_FILES["file"]["tmp_name"];
    			move_uploaded_file($location, $destination);
    //			echo base_url()."/".$this->writable_folder.'/uploads/imgs/rte/'.$filename; //change this URL
    			echo base_url().'/uploads/imgs/rte/'.$filename; //change this URL
    		  } else {
    			echo $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
    		  }
    		}
		}
		    
	}

}
