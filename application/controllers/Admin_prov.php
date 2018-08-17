<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_prov extends CI_Controller {
private $user_id = "";
	function __construct(){
		parent::__construct();
		$this->load->model('admin_prov_model', 'admin_model');
		$this->load->model('stories_model');
		$this->load->model('dashboard_model');
		$this->load->model('customer_model','customers');
		$this->load->model('user_model');
		
		// $this->admin_model->check_admin();
			// print_r($this->db->last_query());
			// if (!$this->admin_model->check_admin()) echo "!";
			// die();

		$this->user_id = $this->session->userdata('userid');
		if (!$this->admin_model->check_admin()) redirect('/', 'location'); //die("admin only");
        
	}
    
	/* dashboard */
	public function index() {
	//	redirect('/admin/dashboard', 'location');
		redirect('/admin_prov/daftar_sungai', 'location');

	}
	
	public function dashboard()
    {
		$sel['sel'] = "dashboard";
		//$p = $this->input->post('p');
		
		$data['sungai'] = $this->admin_model->get_ika();		
		
		//print_r($data);
  		$this->load->view('layout/header');
        $this->load->view('layout/navigation_prov', $sel);
        $this->load->view('admin_prov/dashboard_ika', $data);
		
        $this->load->view('layout/footer');
	}

	public function users()
	{
		$sel['sel'] = "users";
		$data['petugas'] = $this->admin_model->get_daftar_users();

		$this->load->view('layout/header');
        $this->load->view('layout/navigation_prov', $sel);
        $this->load->view('admin_prov/users', $data);
        $this->load->view('layout/footer');
	}


	public function register()
	{
		$data['provinsi']    = $this->admin_model->data_provinsi();
		
		$sel['sel'] = "users";
	
        $this->load->helper('captcha');
        $random_number = substr(number_format(time() * rand(),0,'',''),0,6);
          $vals = array(
                 'word' => $random_number,
                 'img_path' => './captcha/',
                 'img_url' => base_url().'captcha/',
                 'img_width' => 140,
                 'img_height' => 32,
                 'expiration' => 7200
                );
        $data['captcha'] = create_captcha($vals);
        $this->session->set_userdata('captchaWord',$data['captcha']['word']);

        $this->load->view('layout/header');
		$this->load->view('layout/navigation_prov', $sel);
		$this->load->view('admin_prov/register', $data);
		$this->load->view('layout/footer');
	}

	function registerdata()
    {             


            $name = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('name', TRUE));
            $lastname = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('lastname', TRUE));

             $provinsi = preg_replace('/[^0-9\-]/', '', $this->input->post('provinsi', TRUE));


          
            $slug = url_title($this->input->post('slug'),'dash',TRUE);
            $password = $this->input->post('password');
            $password2 = $this->input->post('password2');
			$newsletter = $this->input->post('newsletter');
			$provinsi = $this->input->post('provinsi');
			$level = $this->input->post('level');		
            $terms = $this->input->post('terms');

            $this->load->helper('captcha');
            $userCaptcha = $this->input->post('userCaptcha');

            $arr['result'] = 'confirm';
            $arr['message'] = '<ul>';

            $datains = array();
            $newsins = array();

            $arr['result'] = 'confirm';
            $arr['message'] = '<ul>';

          
            if (strlen($name) == 0) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('fillname').'</li>';
            }

            if (strlen($lastname) == 0) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('lastname').'</li>';
            }

            if (strlen($slug) == 0) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('slug').'</li>';
            }

        

            if (strlen($password) == 0) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('fillpassword').'</li>';
            }

            if (strlen($password2) == 0) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('fillcpassword').'</li>';
            }

            if (($password) != ($password2)) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('passwordequal').'</li>';
            }

            if ($this->user_model->slug_exists($slug)) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('slugexists').'</li>';
            }
			/*
            if ($this->user_model->email_exists($email)) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('emailexists').'</li>';
            }
            */

            if ($arr['result'] != 'error') 
            {

				$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
				$passwordins = hash('sha256', $password . $salt); 
				for($round = 0; $round < 65536; $round++){ $passwordins = hash('sha256', $passwordins . $salt); }
		
                $datains['user_name'] = $name;
                $datains['user_slug'] = $slug;
                $datains['user_lastname'] = $lastname;
                //$datains['user_email'] = $email;
                $datains['user_pass'] = $passwordins;
                 $datains['user_level'] = $level;
				$datains['user_salt'] = $salt;
                $datains['provinsi'] = $provinsi;
                $datains['user_date'] = date('Y-m-d G:i:s');
                $result = $this->user_model->insert_user($datains);

                redirect("/admin_prov/users");
                

            

            } else {

            echo json_encode($arr);   
            }

	}

	function edit_user($id){
		$sel['sel'] = "users";
		$data['provinsi'] = $this->admin_model->data_provinsi();
		$petugas = $this->admin_model->data_petugas($id);
		
 		$data['petugas'] = $petugas[0];
		$this->load->helper('url');
		$this->load->view('layout/header');
        $this->load->view('layout/navigation_prov', $sel);
	    $this->load->view('admin_prov/edit_user', $data);
	    $this->load->view('layout/footer');	
	}


    function edit_userdata()
    {             
            $name = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('name', TRUE));
            $lastname = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('lastname', TRUE));

             $provinsi = preg_replace('/[^0-9\-]/', '', $this->input->post('provinsi', TRUE));

 			$id_user = $this->input->post('id_user');
          
            $slug = url_title($this->input->post('slug'),'dash',TRUE);
            $password = $this->input->post('password');
            $password2 = $this->input->post('password2');
			$newsletter = $this->input->post('newsletter');
			$provinsi = $this->input->post('provinsi');
			$level = $this->input->post('level');
			


            $datains = array();
            $newsins = array();
            $perbarui_sandi = false;
            $arr['result']  = 'confirm';
            $arr['message'] = '<ul>';

          
            if (strlen($name) == 0) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('fillname').'</li>';
            }

            if (strlen($lastname) == 0) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('lastname').'</li>';
            }

            if (strlen($slug) == 0) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('slug').'</li>';
            }




        if(strlen($password)==0){
            $perbarui_sandi = true;
             if (($password) != ($password2)) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('passwordequal').'</li>';
            }
        }

           

         

            if ($arr['result'] != 'error') 
            {


                if($perbarui_sandi){
                    $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
                    $passwordins = hash('sha256', $password . $salt); 
                    for($round = 0; $round < 65536; $round++){ $passwordins = hash('sha256', $passwordins . $salt); }
                         $datains['user_pass'] = $passwordins;
                      $datains['user_salt'] = $salt;
                }
               
                $datains['user_name'] = $name;
                $datains['user_slug'] = $slug;
				$datains['user_lastname'] = $lastname;
				$datains['provinsi'] = $provinsi;
				$datains['user_level'] = $level;
                $this->db->where('user_id', $id_user);
                 $this->db->update('users', $datains);
              
                redirect("/admin_prov/users");
                

            

            } else {

            echo json_encode($arr);   
            }

    }
	
	public function daftar_sungai(){
		$sel['sel'] = "daftar_sungai";
		$data['data_ika'] = $this->admin_model->get_ika();
	
		$this->load->view('layout/header');
        $this->load->view('layout/navigation_prov', $sel);
        $this->load->view('admin_prov/daftar_sungai', $data);
        $this->load->view('layout/footer');
	}

	public function load_sungai(){
		$p = $this->input->post('p');
		
		$data['sungai'] = $this->admin_model->get_lokasi_sungai('', $p, '', 'all');		
		
		// $this->load->view('admin/ajaxcontent/loadSungai', $data);
		$this->load->view('admin_prov/load_Sungai', $data);
	}

	function add_sungai() {
		$sel['sel'] = "sungai";
		$data['provinsi'] 		= $this->admin_model->data_provinsi();
		$data['sel_provinsi'] 		= $this->session->userdata("provinsi");
		$data['kabupaten'] 			= $this->admin_model->data_kabupaten();
		$this->load->library('googlemaps');

		$config['center'] = '	-6.2069063, 106.797554';
		$config['zoom'] = '12';
		$this->googlemaps->initialize($config);

		$marker = array();
		$marker['position'] = '	-6.2069063, 106.797554';
		$marker['draggable'] = true;
		$marker['ondragend'] = '$("#latitude").val(event.latLng.lat());$("#longitude").val(event.latLng.lng());';
		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();
		
		
		$this->load->view('layout/header');
        $this->load->view('layout/navigation_prov', $sel);
        $this->load->view('admin_prov/add_sungai',$data);
        $this->load->view('layout/footer');
	}
	
	public function add_sungai_data() {
			$nama 		=  	$_POST['nama'];   //kode_sungai
			$titik 		=  	$_POST['titik'];  //lokasi pengamatan
			$kategori   =  	$_POST['kategori'];
			$tanggal	=  	$_POST['tanggal'];
			
			$level 		=  	3;
			
			$provinsi 	= 	$userdata['provinsi'];
			$kabupaten 	= 	$_POST['kabupaten'];
			$lintang 	=	$_POST['lintang'];
			$bujur 		=	$_POST['bujur'];
			
			$latitude 	= 	$_POST['lat'];
			$longitude 	= 	$_POST['long'];
			
			$deskripsi 	=  	$_POST['deskripsi'];

			if(empty($latitude)){
				$latitude = '-7.546839';
			}
			if(empty($longitude)) {
				$longitude ='112.226479';
			}

			$datains2['sungai'] = $nama;
            $datains2['lokasi'] = $titik;
            $datains2['kategori'] = $kategori;
            $datains2['id_prov'] = $this->session->userdata("provinsi");
            $datains2['id_kab'] = $kabupaten;
         	$datains2['lintang'] = $lintang;
            $datains2['bujur'] = $bujur;
			$datains2['usr_lv'] = $level;
			$datains2['tanggal'] = $tanggal;

			$datains2['ket'] = $deskripsi;
		
			// print_r($datains2);die();		
			
			$this->db->insert('st_air', $datains2); 
			// echo $this->db->last_query();
			// print_r($datains2);
			
			echo "add";	
			
			// echo "tetteasssss";	 
	}

	public function removesungai(){		
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;		
		$i = $this->input->post('i');
		$this->db->where(array("id"=>$i));
		$this->db->delete("st_air");
	}

	function editsungai($i) {
		$sel['sel'] = "sungai";
		$data['provinsi'] 		= $this->admin_model->data_provinsi();
		$data['kabupaten'] 			= $this->admin_model->data_kabupaten();
		$data['stories'] = $this->admin_model->get_specific_sungai($i);

		$this->load->view('layout/header');
        $this->load->view('layout/navigation_prov', $sel);
        $this->load->view('admin_prov/sungaiedit', $data);
        $this->load->view('layout/footer');
	}

	public function sungaieditdata() {
		
			if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;	
			$id =  $_POST['id'];
			$lokasi = $_POST['lokasi'];
			$sungai = $_POST['sungai'];
			$kategori = $_POST['kategori'];
			// $id_prov = $_POST['id_prov'];
			$id_prov = substr($_POST['kabupaten'],0,2);
			$id_kab = $_POST['kabupaten'];
			$lintang = $_POST['lintang'];
			$bujur = $_POST['bujur'];
		
			$data = array(
				'id' => $id,
				'lokasi' => $lokasi,
				'sungai' => $sungai,
				'kategori' => $kategori,
				'id_prov'  => $id_prov,
				'id_kab' => $id_kab,
				'lintang'  => $lintang,
				'bujur' => $bujur,
				
			);

			$this->db->where('id', $id);
			$this->db->update('st_air', $data); 
			
			echo "edit";	 
	}

	public function data_sungai(){
		$sel['sel'] = "data_sungai";
		$data['data_ika'] = $this->admin_model->get_ika();
	
		$this->load->view('layout/header');
        $this->load->view('layout/navigation_prov', $sel);
        $this->load->view('admin_prov/data_sungai',$data);
        $this->load->view('layout/footer');
	}

	public function load_data_sungai(){
		$p = $this->input->post('p');
		
		$data['sungai'] = $this->admin_model->get_data_sungai('', $p, '', 'all');		
		
		// $this->load->view('admin/ajaxcontent/loadDataSungai', $data);
		$this->load->view('admin_prov/load_DataSungai', $data);
	}

	public function parameter_sungai(){
		$sel['sel'] = "parameter_sungai";
	
		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/daftar_par_sungai');
        $this->load->view('layout/footer');
	}

	public function load_par_sungai(){
		$p = $this->input->post('p');
		
		$data['sungai'] = $this->admin_model->get_parameter_sungai('', $p, '', 'all');		
		
		$this->load->view('admin/ajaxcontent/loadParSungai', $data);
	}

	function add_par_sungai() {
		$sel['sel'] = "sungai";
		$data['provinsi'] 		= $this->admin_model->data_provinsi();
		$data['kabupaten'] 			= $this->admin_model->data_kabupaten();
		/* $this->load->library('googlemaps');

		$config['center'] = '	-7.546839, 112.226479';
		$config['zoom'] = '12';
		$this->googlemaps->initialize($config);

		$marker = array();
		$marker['position'] = '	-7.546839,  112.226479';
		$marker['draggable'] = true;
		$marker['ondragend'] = '$("#latitude").val(event.latLng.lat());$("#longitude").val(event.latLng.lng());';
		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();
		*/
		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/add_par_sungai',$data);
        $this->load->view('layout/footer');
	}

	public function add_par_sungai_data() {
		
			
			$tss 	=	$_POST['tss'];
			$do 	=	$_POST['do'];
			$bod 	=	$_POST['bod'];
			$cod 	=	$_POST['cod'];
			$tf 	=	$_POST['tp'];
			$fcoli 	=	$_POST['fcoli'];
			$tcoli 	=	$_POST['tcoli'];
			
			
			$deskripsi 	=  $_POST['deskripsi'];

			$datains2['tss'] = $tss;
            $datains2['do'] = $do;
            $datains2['bod'] = $bod;
           	$datains2['cod'] = $cod;
           	$datains2['tf'] = $tf;
           	$datains2['fcoli'] = $fcoli;
			$datains2['tcoli'] = $tcoli;
			$datains2['ket'] = $deskripsi;
			
			$this->db->insert('par_ika', $datains2); 
			print_r($datains2);
			
			echo "add";	 
	}

	function add_data_sungai() {
		$sel['sel'] = "sungai";
		$data['provinsi'] 		= $this->admin_model->data_provinsi();
		$data['kabupaten'] 			= $this->admin_model->data_kabupaten();
		$data['lokasi'] 			= $this->admin_model->data_lokasi();

		/* $this->load->library('googlemaps');

		$config['center'] = '	-7.546839, 112.226479';
		$config['zoom'] = '12';
		$this->googlemaps->initialize($config);

		$marker = array();
		$marker['position'] = '	-7.546839,  112.226479';
		$marker['draggable'] = true;
		$marker['ondragend'] = '$("#latitude").val(event.latLng.lat());$("#longitude").val(event.latLng.lng());';
		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();
		*/
		$this->load->view('layout/header');
        $this->load->view('layout/navigation_prov', $sel);
        $this->load->view('admin_prov/add_data_sungai',$data);
        $this->load->view('layout/footer');
	}

	function add_data_sungaidata() {
			$kategori   =  $_POST['kategori'];
			$tanggal =  $_POST['tanggal'];
			
			$level 		=  3;
			
			// $provinsi 	= $_POST['provinsi'];
			$provinsi 	= $this->session->userdata("provinsi");
			$id_sungai 	= $_POST['lokasi'];

			$info_sungai = $this->admin_model->get_specific_sungai($id_sungai);
			
			$kabupaten = $info_sungai[0]['id_kab'];
			$lokasi = $info_sungai[0]['lokasi'];
			$sungai = $info_sungai[0]['sungai'];
			$bujur = $info_sungai[0]['bujur'];
			$lintang = $info_sungai[0]['lintang'];

			$tss 	=	$_POST['tss'];
			$do 	=	$_POST['do'];
			$bod 	=	$_POST['bod'];
			$cod 	=	$_POST['cod'];
			$tf 	=	$_POST['tp'];
			$fcoli 	=	$_POST['fcoli'];
			$tcoli 	=	$_POST['tcoli'];
			
			
			$deskripsi 	=  $_POST['deskripsi'];


			$datains2['lokasi'] = $lokasi;
			$datains2['kode_sungai'] = $sungai;
			$datains2['id_prov'] = $provinsi;
			$datains2['id_kab'] = $kabupaten;
			$datains2['kategori'] = $kategori;
			$datains2['usr_lv'] = $level;
			$datains2['lat'] = $bujur;
			$datains2['lon'] = $lintang;
			$datains2['tss'] = $tss;
            $datains2['do'] = $do;
            $datains2['bod'] = $bod;
           	$datains2['cod'] = $cod;
           	$datains2['tf'] = $tf;
           	$datains2['fcoli'] = $fcoli;
			$datains2['tcoli'] = $tcoli;
			$datains2['ket'] = $deskripsi;
			$datains2['validated'] = 1;
			$datains2['date_input'] = date("Y-m-d H:i:s");
			
			// print_r($datains2);die();
			
			$this->db->insert('tbl_sungai', $datains2); 

			// print_r($datains2);
			
			echo "add";	 
	}

	function removedatasungai(){		
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;		
		$i = $this->input->post('i');
		$this->db->where(array("id_sungai"=>$i));
		$this->db->delete("tbl_sungai");
	}
	
	function validatedatasungai(){		
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;		
		$i = $this->input->post('i');
		$this->db->where(array("id_sungai"=>$i));
		$this->db->update("tbl_sungai", array('validated' => 1));
	}

	
}
