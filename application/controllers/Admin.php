<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
private $user_id = "";
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->model('stories_model');
		$this->load->model('dashboard_model');
		$this->load->model('customer_model','customers');
		$this->load->model('user_model');
		

		$this->user_id = $this->session->userdata('userid');
		if (!$this->admin_model->check_admin()) redirect('/', 'location'); //die("admin only");
        
	}
    /* dashboard */
	public function index() 
	{
		redirect('/admin/dashboard', 'location');
	//	redirect('/admin/daftar_sungai', 'location');

	}
	public function dashboard()
    {
		$sel['sel'] = "dashboard";
		//$p = $this->input->post('p');
		
		$data['sungai'] = $this->admin_model->get_ika();		
		
		//print_r($data);
  		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/dashboard_ika', $data);
		
        $this->load->view('layout/footer');
    }
	/* users menu */
	
	public function users()
	{
		$sel['sel'] = "users";
		$data['petugas'] = $this->admin_model->get_daftar_users();

		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/users', $data);
        $this->load->view('layout/footer');
	}

	public function loadusers()
	{
		$p = $this->input->post('p');
		
		$data['users'] = $this->admin_model->get_users('', $p, '', 'all');		
		
		$this->load->view('admin/ajaxcontent/loadUsers', $data);
	}
/*
	public function user_list_ajax()
    {
        $list = $this->customers->get_datatables();
        $data = array();
		$no = $_POST['start'];
		//print_r($data);
        foreach ($list as $customers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $customers->user_name;
            $row[] = $customers->user_lastname;
            $row[] = $customers->user_slug;
            $nama_kecamatan =  $this->admin_model->get_nama_wilayah($customers->provinsi);
            $row[] = $nama_kecamatan[0]['nama'];
          if($this->session->userdata('logged_in')) {
         	$row[] = "<a class='btn btn-biru' href='".base_url()."admin/edit_user/".$customers->user_id."'>Edit</a> ";

     	}
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->customers->count_all(),
                        "recordsFiltered" => $this->customers->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
	}
	
	function adduser() {
		$sel['sel'] = "users";

		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/useradd');
        $this->load->view('layout/footer');
	}
*/
	public function daftar_sungai()
	{
		$sel['sel'] = "daftar_sungai";
	
		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/daftar_sungai');
        $this->load->view('layout/footer');
	}

	

	public function load_sungai()
	{
		$p = $this->input->post('p');
		
		$data['sungai'] = $this->admin_model->get_lokasi_sungai('', $p, '', 'all');		
		
		// $this->load->view('admin/ajaxcontent/loadSungai', $data);
		$this->load->view('admin/load_Sungai', $data);
	}

	function add_sungai() {
		$sel['sel'] = "sungai";
		$data['provinsi'] 		= $this->admin_model->data_provinsi();
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
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/add_sungai',$data);
        $this->load->view('layout/footer');
	}

	public function removesungai()
	{		
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
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/sungaiedit', $data);
        $this->load->view('layout/footer');
	}

	public function sungaieditdata() {
		
			if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;	
			$id =  $_POST['id'];
			$lokasi = $_POST['lokasi'];
			$sungai = $_POST['sungai'];
			$kategori = $_POST['kategori'];
			$id_prov = $_POST['id_prov'];
			$id_kab = $_POST['id_kab'];
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

	public function data_sungai()
	{
		$sel['sel'] = "data_sungai";
	
		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/data_sungai');
        $this->load->view('layout/footer');
	}

	public function load_data_sungai()
	{
		$p = $this->input->post('p');
		
		$data['sungai'] = $this->admin_model->get_data_sungai('', $p, '', 'all');		
		
		// $this->load->view('admin/ajaxcontent/loadDataSungai', $data);
		$this->load->view('admin/load_DataSungai', $data);
	}

	public function parameter_sungai()
	{
		$sel['sel'] = "parameter_sungai";
	
		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/daftar_par_sungai');
        $this->load->view('layout/footer');
	}

	public function load_par_sungai()
	{
		$p = $this->input->post('p');
		
		$data['sungai'] = $this->admin_model->get_parameter_sungai('', $p, '', 'all');		
		
		// $this->load->view('admin/ajaxcontent/loadParSungai', $data);
		$this->load->view('admin/load_ParSungai', $data);
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

	public function add_par_sungai_data() 
	{
		
			
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
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/add_data_sungai',$data);
        $this->load->view('layout/footer');
	}

	function add_data_sungaidata() 
	{
			$kategori   =  $_POST['kategori'];
			$tanggal =  $_POST['tanggal'];
			
			$level 		=  3;
			
			$provinsi 	= $_POST['provinsi'];
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
			$datains2['tanggal'] = $tanggal;
			$datains2['date_input'] = date("Y-m-d H:i:s");
			
			$this->db->insert('tbl_sungai', $datains2); 

			print_r($datains2);
			
			echo "add";	 
	}
	
	function add_kelompok_tani() {
		$sel['sel'] = "users";
		$data['kecamatan'] 		= $this->dashboard_model->data_kecamatan();
		$data['desa'] 			= $this->dashboard_model->data_desa();
		$this->load->library('googlemaps');

		$config['center'] = '	-7.546839, 112.226479';
		$config['zoom'] = '12';
		$this->googlemaps->initialize($config);

		$marker = array();
		$marker['position'] = '	-7.546839,  112.226479';
		$marker['draggable'] = true;
		$marker['ondragend'] = '$("#latitude").val(event.latLng.lat());$("#longitude").val(event.latLng.lng());';
		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();
		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/add_kelompok_tani',$data);
        $this->load->view('layout/footer');
	}

	public function petugas(){
		$this->load->helper('url');
		$sel['sel'] = "users";
	
		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
	    $this->load->view('admin/users',$data);
	    $this->load->view('layout/footer');	
	}

	

	function edit_user($id){
		$sel['sel'] = "users";
		$data['provinsi'] = $this->admin_model->data_provinsi();
		$petugas = $this->admin_model->data_petugas($id);
		
 		$data['petugas'] = $petugas[0];
		$this->load->helper('url');
		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
	    $this->load->view('admin/edit_user', $data);
	    $this->load->view('layout/footer');	
	}

	public function user_list()
    {
        $list = $this->customers->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $customers->user_name;
            $row[] = $customers->user_lastname;
            $row[] = $customers->user_slug;
            $nama_kecamatan =  $this->dashboard_model->nama_kecamatan($customers->kecamatan);
        $row[] = $nama_kecamatan[0]['nama'];
          if($this->session->userdata('logged_in')) {
         	$row[] = "<a class='btn btn-biru' href='".base_url()."admin/edit_user/".$customers->user_id."'>Edit</a> ";

     	}
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->customers->count_all(),
                        "recordsFiltered" => $this->customers->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
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
		$this->load->view('layout/navigation', $sel);
		$this->load->view('admin/register', $data);
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

                redirect("/admin/users");
                

            

            } else {

            echo json_encode($arr);   
            }

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
              
                redirect("/admin/users");
                

            

            } else {

            echo json_encode($arr);   
            }

    }



    function updatedata()
    {
            if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;  
            if (!$this->session->userdata('logged_in') == TRUE)
			{
				redirect('stories');
			} 
            
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $password2 = $this->input->post('password2');
            $newsletter = $this->input->post('newsletter');
            $website = $this->input->post('website');
            $twitter = $this->input->post('twitter');
            $shortbio = $this->input->post('shortbio');
            $slug = url_title($this->input->post('slug'),'dash',TRUE);

            $name = $this->input->post('name', TRUE);
            $lastname = $this->input->post('lastname', TRUE);

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

            if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('fillemail').'</li>';
            }

            if ($this->user_model->slug_exists_update($slug, $email)) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('slugexists').'</li>';
            }
            
			if (strlen($password) > 0) {
				if (strlen($password2) == 0) {
					$arr['result'] = 'error';
					$arr['message'] .= '<li>'.$this->lang->line('fillpassword').'</li>';
				}
				if (($password) != ($password2)) {
					$arr['result'] = 'error';
					$arr['message'] .= '<li>'.$this->lang->line('passwordequal').'</li>';
				}
            }

            if ($this->user_model->changed_email($email)) 
			{
				if ($this->user_model->email_exists($email)) {
					$arr['result'] = 'error';
					$arr['message'] .= '<li>'.$this->lang->line('emailexists').'</li>';
				}
			}

            if ($arr['result'] != 'error') 
            {

                //edit avatar
                if (strlen($_FILES["file"]["name"]) > 1)                
                {
                    $validextensions = array("jpeg", "jpg", "png");
                    $temporary = explode(".", $_FILES["file"]["name"]);
                    $file_extension = end($temporary);

                    if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) && ($_FILES["file"]["size"] < 400000) && in_array($file_extension, $validextensions)) 
                    {
                        if ($_FILES["file"]["error"] > 0)
                        {
                            echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
                        } else {
                            if (file_exists("images/avatar/" . $_FILES["file"]["name"])) 
                            {
                                $arr['result'] = 'erro';
                                $arr['message'] .= '<li>Image already exist.</li>';
                            } else {
                                $sourcePath = $_FILES['file']['tmp_name'];
                                $nameFile   =   time() . "_" . $slug;
                                $targetPath = "images/avatar/".$nameFile;
                                move_uploaded_file($sourcePath,$targetPath);
                                $datains['user_avatar'] = $nameFile;
                                
                                //resize
                                $this->load->library('image_lib');
                                $config['image_library'] = 'gd2';
                                $config['source_image'] = $targetPath;
                                $config['create_thumb'] = FALSE;
                                $config['maintain_ratio'] = FALSE;
                                $config['width'] = 300;
                                $config['height'] = 300;

                                $this->image_lib->clear();
                                $this->image_lib->initialize($config);
                                $this->image_lib->resize();
                                
                            }
                        }
                    } else {
                        $arr['result'] = 'error';
                        $arr['message'] .= '<li>'.$this->lang->line('invalidextension').'</li>';
                    }       
                }



                if (strlen($password) > 0) {
					$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
					$passwordins = hash('sha256', $password . $salt); 
					for($round = 0; $round < 65536; $round++){ $passwordins = hash('sha256', $passwordins . $salt); }
					$datains['user_pass'] = $passwordins;
					$datains['user_salt'] = $salt;
				}
        
                $datains['user_name'] = $name;
                $datains['user_slug'] = $slug;
                $datains['user_lastname'] = $lastname;
                $datains['user_email'] = $email;
                $datains['user_website'] = $website;
                $datains['user_twitter'] = $twitter;
                $datains['user_gplus'] = $this->input->post('gplus');
                $datains['user_fb'] = $this->input->post('fb');
                $datains['user_instagram'] = $this->input->post('instagram');
                $datains['user_pinterest'] = $this->input->post('pinterest');
                $datains['shortbio'] = $shortbio;
                $datains['user_date'] = date('Y-m-d G:i:s');
                $result = $this->user_model->update_user($datains);

                $idlogin = $this->session->userdata('userid');
                //$this->session->sess_destroy();

                if (strlen($_FILES["file"]["name"]) > 1)  {                    
                } else {
                   $nameFile = $this->session->userdata('avatar');
                }

                $data = array(
                   'userid'  => $idlogin,
                   'nome'  => $name." ".$lastname,
                   'email'  => $email,
                   'avatar' => $nameFile,             
                   'logged_in'  => TRUE
                );
            
                $this->session->set_userdata($data);   
				
				
                if ($newsletter == "on")
                {
                    $newsins['firstname'] = $name;
                    $newsins['lastname'] = $lastname;
                    $newsins['email'] = $email;
					
					if ($this->user_model->subscriber_exist($email)) {
						$this->db->update('newsletter_subscribers', $newsins);
					} else {
						$this->db->insert('newsletter_subscribers', $newsins);
					}
                } else {
					$this->db->where('email', $email);
					$this->db->delete('newsletter_subscribers'); 
				}

                if ($result === TRUE) {

                    $arr['result'] = 'confirm';
                    $arr['message'] .= $this->lang->line('profilesuccess');

                } else {
                    
                    $arr['result'] = 'error';
                    $arr['message'] .= $this->lang->line('errortryagain');

                }

            }

            echo json_encode($arr);   
    }
    

	public function removeuser()
	{		
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;		
		$i = $this->input->post('i');
		$this->db->where(array("user_id"=>$i));
		$this->db->delete("users");
	}
	function edituser($i) {
		$sel['sel'] = "users";

		$data['stories'] = $this->admin_model->get_specific_user($i);

		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/useredit', $data);
        $this->load->view('layout/footer');
	}
	public function usereditdata() {
		
			if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;	
			
			$user_id =  $_POST['user_id'];			
			$user_name =  $_POST['user_name'];
			$user_lastname =  $_POST['user_lastname'];
			$user_email =  $_POST['user_email'];
			$level =  $_POST['level'];
            
			$data = array(
				'user_name' => $user_name,
				'user_lastname' => $user_lastname,
				'user_email' => $user_email,
				'user_level' => $level
			);

			$this->db->where('user_id', $user_id);
			$this->db->update('users', $data); 
			
			echo "edit";	 
	}

	public function add_sungai_data() 
	{
		
			$nama 	=  $_POST['nama'];   //kode_sungai
			$titik 	=  $_POST['titik'];  //lokasi pengamatan
			$kategori   =  $_POST['kategori'];
			$tanggal =  $_POST['tanggal'];
			
			$level 		=  3;
			
			$provinsi 	= $_POST['provinsi'];
			$kabupaten 		= $_POST['kabupaten'];
			$lintang 	=	$_POST['lintang'];
			$bujur 	=	$_POST['bujur'];
			
			$latitude 	= $_POST['lat'];
			$longitude 	= $_POST['long'];
			
			$deskripsi 	=  $_POST['deskripsi'];

			if(empty($latitude)){
				$latitude = '-7.546839';
			}
			if(empty($longitude)) {
				$longitude ='112.226479';
			}

			$datains2['sungai'] = $nama;
            $datains2['lokasi'] = $titik;
            $datains2['kategori'] = $kategori;
            $datains2['id_prov'] = $provinsi;
            $datains2['id_kab'] = $kabupaten;
         	$datains2['lintang'] = $lintang;
            $datains2['bujur'] = $bujur;
			$datains2['usr_lv'] = $level;
			$datains2['tanggal'] = $tanggal;

			$datains2['ket'] = $deskripsi;
			
			$this->db->insert('st_air', $datains2); 
			print_r($datains2);
			
			echo "add";	 
	}
	
	
	public function stories()
	{
		$sel['sel'] = "stories";		

		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/stories');
        $this->load->view('layout/footer');
	}

	public function desa()
	{
		$sel['sel'] = "stories";		

		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/desa');
        $this->load->view('layout/footer');
	}

	public function kecamatan()
	{
		$sel['sel'] = "stories";		

		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/kecamatan');
        $this->load->view('layout/footer');
	}

	function editstory($i) {
		$sel['sel'] = "stories";

		$data['stories'] = $this->admin_model->get_specific_story($i);
		$data['categories'] = $this->stories_model->get_categories();

		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/storyedit', $data);
        $this->load->view('layout/footer');
	}
	public function storyeditdata() {
		
			if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;	

			$id =  $_POST['post_id'];			
			$post_subject =  $_POST['post_subject'];
			$post_url =  $_POST['post_url'];
			$post_text =  $_POST['post_text'];
			$category =  $_POST['category'];

			//delete category assoc
			$this->db->where(array("post_id"=>$id));
			$this->db->delete("categories_posts");

			//insert category
			$data2 = array(
				'post_id' => $id,
				'id_category' => $category
			);
			$this->db->insert('categories_posts', $data2); 

            
			$data = array(
				'post_subject' => $post_subject,
				'post_url' => $post_url,
				'post_text' => $post_text
			);

			$this->db->where('post_id', $id);
			$this->db->update('posts', $data); 
			
			echo "edit";
	 
	 }

	  function poktan() {
		
		$data['stories'] = $this->admin_model->poktan();
		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
     
		$this->load->view('admin/poktan', $data);

        $this->load->view('layout/footer');
	 }

	 function gapoktan() {
		
		$data['stories'] = $this->admin_model->gapoktan();
		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
     
		$this->load->view('admin/gapoktan', $data);

        $this->load->view('layout/footer');
	 }


	public function loadstories()
	{
		$p = $this->input->post('p');
		
		$data['stories'] = $this->admin_model->pengumuman();
		$this->load->view('admin/ajaxcontent/loadStories', $data);
	}

	public function load_desa()
	{
		$p = $this->input->post('p');
		
		$data['stories'] = $this->admin_model->getdesa('', $p, '', 'all');

		$this->load->view('admin/ajaxcontent/load_desa', $data);
	}

	public function load_kecamatan()
	{
		$p = $this->input->post('p');
		
		$data['stories'] = $this->admin_model->getkecamatan('', $p, '', 'all');
		
		$this->load->view('admin/ajaxcontent/load_kecamatan', $data);
	}
	
	
	public function load_produk()
	{
		$p = $this->input->post('p');
		
		$data['stories'] = $this->admin_model->get_stories(null, "",  "Popular","", "","",8, "All",1);
		$this->load->view('admin/ajaxcontent/load_produk', $data);
	}
	public function removestory()
	{
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;
		$i = $this->input->post('i');

		$this->db->where('post_id', $i);        
        $query = $this->db->get_where('posts');

        if ($query->num_rows() > 0) {
        	$row = $query->row_array();
            $image = "images/".$row['post_image'];

            if (file_exists($image)) {
    			unlink($image);
    		}
        }


		$this->db->where(array("post_id"=>$i));
		$this->db->delete("posts");
		
		$this->db->where(array("post_id"=>$id));
		$this->db->delete("categories_posts");

		//remove comments
		$this->db->where(array("posts_id"=>$i));
		$this->db->delete("post_comments");

	}

	public function aprovstory()
	{
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;
		$i = $this->input->post('i');
		$v = $this->input->post('v');

		//if ($v == 1) { $ni = 0; } else { $ni = 1; }
		$dad = array("approved"=>$v);
		$this->db->where(array("post_id"=>$i));
		$this->db->update("posts", $dad);
		//echo $ni;
	}

	/* newsletter subscribers */
	public function subscribers()
	{
		$sel['sel'] = "newsletter";

		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/subscribers');
        $this->load->view('layout/footer');
	}
	public function loadsubscribers()
	{
		$p = $this->input->post('p');
		
		$data['categories'] = $this->admin_model->get_subscribers('', $p, '', 'all');
		$this->load->view('admin/ajaxcontent/loadSubscribers', $data);
	}

	/*categories menu*/
	public function tambah_pengumuman()
	{
		$sel['sel'] = "categories";

		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/categories');
        $this->load->view('layout/footer');
	}

	public function pengumuman_tambah() 
	{
		$judul = $this->input->post('judul');
		$url = str_replace(" ","-",strtolower($judul));
		$tanggal =  $this->input->post('tanggal');
		$pengumuman =  $this->input->post('pengumuman');
			if($_FILES["foto"]['name']!="" ) {
				$config['upload_path']          = './images/pengumuman/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 100000;
                $config['max_width']            = 31024;
                $config['max_height']           = 47680;
                $new_name = time()."_".$_FILES["foto"]['name'];
				$config['file_name'] = $new_name;
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('foto'))
                {
                        $error = array('error' => $this->upload->display_errors());

                } 
                  $datains['gambar'] = $new_name;
             }

            $datains['judul'] = $judul;
            $datains['url'] = $url;
             $datains['tanggal'] = $tanggal;
            $datains['pengumuman'] = $pengumuman;
            $datains['user_id'] = $this->user_id;

			$this->db->insert('pengumuman', $datains); 
			redirect('/admin/stories', 'location');
	}


	function tambah_kelompok_tani() {
		$sel['sel'] = "users";
		$sel['header'] = "Tambah Poktan";
		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/poktanadd');
        $this->load->view('layout/footer');
	}
    public function tambah_poktan() 
	{
			$ketua 	= $this->input->post('ketua');
			$bendahara 	= $this->input->post('bendahara');
			$sekertaris	= $this->input->post('sekertaris');
			$luas= $this->input->post('luas');
			$pola1 = $this->input->post('pola1');
			$pola2 = $this->input->post('pola2');
			$pola3 = $this->input->post('pola3');
			$config['upload_path']          = './images/poktan/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 10000;
                $config['max_width']            = 1024;
                $config['max_height']           = 47680;
                $new_name = time()."_".$_FILES["foto"]['name'];
				$config['file_name'] = $new_name;
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('foto'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->load->view('upload_form', $error);
                }

                $file = './images/poktan/'. $new_name ;
				$newfile = './images/avatar/'. $new_name ;
				if (!copy($file, $newfile)) {
				    echo "failed to copy $file...\n";
				}

              

  			$name 	= preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('nama', TRUE));
            $slug 	= strtolower($name);
            $password = "12345678";
            $newsletter = $this->input->post('newsletter');
            $terms 	= $this->input->post('terms');
            $this->load->helper('captcha');
            $userCaptcha = $this->input->post('userCaptcha');

        
				$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
				$passwordins = hash('sha256', $password . $salt); 
				for($round = 0; $round < 65536; $round++){ $passwordins = hash('sha256', $passwordins . $salt); }
		
                $datains['user_name'] = $name;
                $datains['user_slug'] = $slug;
                $datains['user_pass'] = $passwordins;
				$datains['user_salt'] = $salt;
                $datains['user_date'] =$this->input->post('tanggal');
              	$result = $this->user_model->insert_user($datains);
                $this->db->set(array('user_avatar'=>$new_name,'user_level'=>'0',"kecamatan"=> $this->session->userdata('kecamatan'),"desa"=> $this->session->userdata('desa'),'user_slug'=>$slug.".".$result));
				$this->db->where('user_id', $result);
				$this->db->update('users');
				$tanggal =  $this->input->post('tanggal');
				$tanggal2 =  explode('-', $tanggal);
				$tahun = $tanggal2[0];
				$kecamatan  = $this->session->userdata('kecamatan');
				$desa 		=  $this->session->userdata('desa');
				$gapoktan = $this->admin_model->gapoktan_id;
                $masukan =  array(
                	'id_user'=>	$result ,
                	'desa'=>$desa,
                	'kecamatan'=>$kecamatan,
                	'gapoktan'=>$gapoktan,
                	'url'=>$slug.".".$result,
                	'nama'=>$name,
                	'foto'=>$new_name,
                	'tahun_berdiri'=>$tahun,
                	'sekertaris'=>$sekertaris,
                	'ketua'=>$ketua,
                	'bendahara'=>$bendahara,
                	'pola1'=>$pola1,
                	'pola2'=>$pola2,
                	'pola3'=>$pola3,
                	'tanggal'=>$tanggal
                );

         
         
		$this->db->insert('kelompok_tani', $masukan); 
		$sel['header'] = "Penambahan Berhasil";
		$yeay = array('user_name' =>$slug.".".$result,'password'=>12345678,'nama'=>$name);
		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/tambah_berhasil',$yeay);
        $this->load->view('layout/footer');
	}


	function tambah_sungai() {
		$sel['sel'] = "users";
		$sel['header'] = "Tambah Poktan";
		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/add_kelompok_tani');
        $this->load->view('layout/footer');
	}

	/* public function tambah_sungai_proses() 
	{
			$ketua 	= $this->input->post('ketua');
			$bendahara 	= $this->input->post('bendahara');
			$sekertaris	= $this->input->post('sekertaris');
		
			$config['upload_path']          = './images/poktan/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 10000;
                $config['max_width']            = 1024;
                $config['max_height']           = 47680;
                $new_name = time()."_".$_FILES["foto"]['name'];
				$config['file_name'] = $new_name;
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('foto'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->load->view('upload_form', $error);
                }

                $file = './images/poktan/'. $new_name ;
				$newfile = './images/avatar/'. $new_name ;
				if (!copy($file, $newfile)) {
				    echo "failed to copy $file...\n";
				}

              

  			$name 	= preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('nama', TRUE));
            $slug 	= strtolower($name);
            $password = "12345678";
            $newsletter = $this->input->post('newsletter');
            $terms 	= $this->input->post('terms');
            $this->load->helper('captcha');
            $userCaptcha = $this->input->post('userCaptcha');

        
				$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
				$passwordins = hash('sha256', $password . $salt); 
				for($round = 0; $round < 65536; $round++){ $passwordins = hash('sha256', $passwordins . $salt); }
		
                $datains['user_name'] = $name;
                $datains['user_slug'] = $slug;
                $datains['user_pass'] = $passwordins;
				$datains['user_salt'] = $salt;
                $datains['user_date'] =$this->input->post('tanggal');
              	$result = $this->user_model->insert_user($datains);
                $this->db->set(array('user_avatar'=>$new_name,'user_level'=>'0',"kecamatan"=> $this->session->userdata('kecamatan'),"desa"=> $this->session->userdata('desa'),'user_slug'=>$slug.".".$result));
				$this->db->where('user_id', $result);
				$this->db->update('users');
				$tanggal =  $this->input->post('tanggal');
				$tanggal2 =  explode('-', $tanggal);
				$tahun = $tanggal2[0];
				$kecamatan  = $this->session->userdata('kecamatan');
				$desa 		=  $this->session->userdata('desa');
                $masukan =  array(
                	'id_user'=>	$result ,
                	'desa'=>$desa,
                	'kecamatan'=>$kecamatan,
                	'url'=>$slug.".".$result,
                	'nama'=>$name,
                	'foto'=>$new_name,
                	'tahun_berdiri'=>$tahun,
                	'sekertaris'=>$sekertaris,
                	'ketua'=>$ketua,
                	'bendahara'=>$bendahara,
                	'tanggal'=>$tanggal
                );

         
         
		$this->db->insert('gapoktan', $masukan); 
		$sel['header'] = "Penambahan Berhasil";
		$yeay = array('user_name' =>$slug.".".$result,'password'=>12345678,'nama'=>$name);
		$this->load->view('admin/header');
        $this->load->view('admin/navigation', $sel);
        $this->load->view('admin/tambah_berhasil',$yeay);
        $this->load->view('admin/footer');
	}
	*/

	function tambah_gapoktan() {
		$sel['sel'] = "users";
		$sel['header'] = "Tambah Poktan";
		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/gapoktanadd');
        $this->load->view('layout/footer');
	}

    public function tambah_gapoktan_proses() 
	{
			$ketua 	= $this->input->post('ketua');
			$bendahara 	= $this->input->post('bendahara');
			$sekertaris	= $this->input->post('sekertaris');
		
			$config['upload_path']          = './images/poktan/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 10000;
                $config['max_width']            = 1024;
                $config['max_height']           = 47680;
                $new_name = time()."_".$_FILES["foto"]['name'];
				$config['file_name'] = $new_name;
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('foto'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->load->view('upload_form', $error);
                }

                $file = './images/poktan/'. $new_name ;
				$newfile = './images/avatar/'. $new_name ;
				if (!copy($file, $newfile)) {
				    echo "failed to copy $file...\n";
				}

              

  			$name 	= preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('nama', TRUE));
            $slug 	= strtolower($name);
            $password = "12345678";
            $newsletter = $this->input->post('newsletter');
            $terms 	= $this->input->post('terms');
            $this->load->helper('captcha');
            $userCaptcha = $this->input->post('userCaptcha');

        
				$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
				$passwordins = hash('sha256', $password . $salt); 
				for($round = 0; $round < 65536; $round++){ $passwordins = hash('sha256', $passwordins . $salt); }
		
                $datains['user_name'] = $name;
                $datains['user_slug'] = $slug;
                $datains['user_pass'] = $passwordins;
				$datains['user_salt'] = $salt;
                $datains['user_date'] =$this->input->post('tanggal');
              	$result = $this->user_model->insert_user($datains);
                $this->db->set(array('user_avatar'=>$new_name,'user_level'=>'0',"kecamatan"=> $this->session->userdata('kecamatan'),"desa"=> $this->session->userdata('desa'),'user_slug'=>$slug.".".$result));
				$this->db->where('user_id', $result);
				$this->db->update('users');
				$tanggal =  $this->input->post('tanggal');
				$tanggal2 =  explode('-', $tanggal);
				$tahun = $tanggal2[0];
				$kecamatan  = $this->session->userdata('kecamatan');
				$desa 		=  $this->session->userdata('desa');
                $masukan =  array(
                	'id_user'=>	$result ,
                	'desa'=>$desa,
                	'kecamatan'=>$kecamatan,
                	'url'=>$slug.".".$result,
                	'nama'=>$name,
                	'foto'=>$new_name,
                	'tahun_berdiri'=>$tahun,
                	'sekertaris'=>$sekertaris,
                	'ketua'=>$ketua,
                	'bendahara'=>$bendahara,
                	'tanggal'=>$tanggal
                );

         
         
		$this->db->insert('gapoktan', $masukan); 
		$sel['header'] = "Penambahan Berhasil";
		$yeay = array('user_name' =>$slug.".".$result,'password'=>12345678,'nama'=>$name);
		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/tambah_berhasil',$yeay);
        $this->load->view('layout/footer');
	}





	public function loadcategories()
	{
		$p = $this->input->post('p');
		
	$data['categories'] =$this->stories_model->kategori("1");
		$this->load->view('admin/ajaxcontent/loadCategories', $data);
	}
	public function removecategory()
	{
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;
		$i = $this->input->post('i');
		$this->db->where(array("id_category"=>$i));
		$this->db->delete("categories");
	}


public function remove_pengumuman($id)
	{
		$this->db->where("id",$id);
	
		$this->db->delete("pengumuman");
	
	}
	


	function addcategory() {
		$sel['sel'] = "categories";

		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/categoriesadd');
        $this->load->view('layout/footer');
	}
	function addcategory_data() 
	{
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;

		$name=trim($this->input->post('name', TRUE));
		$category_description=trim($this->input->post('category_description', TRUE));
		$category_color=trim($this->input->post('category_color', TRUE));


		$datains = array();            

        $arr['result'] = 'confirm';
        $arr['message'] = '<ul>';

         
		if (strlen($name) == 0) {
            $arr['result'] = 'error';
            $arr['message'] .= '<li>Please fill the category name.</li>';
        }

        if ($this->admin_model->check_category($name)) {
        	$arr['result'] = 'error';
            $arr['message'] .= '<li>Please choose another category.</li>';
        }
	     
	    
	    if ($arr['result'] != 'error') 
        { 
	     	$datains['category_name'] = $name;
	     	$datains['category_description'] = $category_description;
	     	$datains['category_color'] = $category_color;

	     	$name = preg_replace('/[^A-Za-z0-9\-]/', '', $name);
	     	$datains['category_slug'] = url_title($name,'dash',TRUE);

			$result = $this->db->insert('categories', $datains);

            $arr['result'] = 'confirm';
        	$arr['message'] = 'Category Inserted.';
	    }

        echo json_encode($arr); 


	}
	function editcategory($i) {
		$sel['sel'] = "pages";

		$data['pages'] = $this->admin_model->get_specific_cat($i);

		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/categoriesedit', $data);
        $this->load->view('layout/footer');
	}
	function editcategory_data() 
	{
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;
		$category_name=trim($this->input->post('category_name', TRUE));
		$category_description=trim($this->input->post('category_description', TRUE));	
		$id_category=trim($this->input->post('id_category', TRUE));	
		$category_color=trim($this->input->post('category_color', TRUE));

		$datains = array();            

        $arr['result'] = 'confirm';
        $arr['message'] = '<ul>';
         
		if (strlen($category_name) == 0) {
            $arr['result'] = 'error';
            $arr['message'] .= '<li>Please fill the cat name.</li>';
        }

        
	    if ($arr['result'] != 'error') 
        { 
	     	$datains['category_name'] = $category_name;
	     	$datains['category_description'] = $category_description;
	     	$datains['category_color'] = $category_color;	     	

			$this->db->where('id_category', $id_category);
			$result = $this->db->update('categories', $datains);

            $arr['result'] = 'confirm';
        	$arr['message'] = 'Category Edited.';
	    }

        echo json_encode($arr); 
	}

	/* pages menu */
	/*categories menu*/
	public function pages()
	{
		$sel['sel'] = "pages";

		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/pages');
        $this->load->view('layout/footer');
	}
	public function loadpages()
	{
		$p = $this->input->post('p');
		
		$data['categories'] = $this->admin_model->get_pages('', $p, '', 'all');
		$this->load->view('admin/ajaxcontent/loadPages', $data);
	}
	public function removepage()
	{
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;
		$i = $this->input->post('i');
		$this->db->where(array("id_page"=>$i));
		$this->db->delete("pages");
	}
	function editpage($i) {
		$sel['sel'] = "pages";

		$data['pages'] = $this->admin_model->get_specific_page($i);

		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/pageedit', $data);
        $this->load->view('layout/footer');
	}
	function addpage() {
		$sel['sel'] = "pages";

		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/pageadd');
        $this->load->view('layout/footer');
	}
	function addpage_data() 
	{
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;
		$title=trim($this->input->post('title', TRUE));
		$area=trim($this->input->post('area', TRUE));
		$content=trim($this->input->post('content', TRUE));
		$link=trim($this->input->post('link', TRUE));		

		$title = preg_replace('/[^A-Za-z0-9\-]/', '', $title);


		$datains = array();            

        $arr['result'] = 'confirm';
        $arr['message'] = '<ul>';
         
		if (strlen($title) == 0) {
            $arr['result'] = 'error';
            $arr['message'] .= '<li>Please fill the title name.</li>';
        }

        
	    if ($arr['result'] != 'error') 
        { 
	     	$datains['title'] = $title;
	     	$datains['area'] = $area;
	     	$datains['content'] = $content;
	     	$datains['link'] = $link;
	     	$datains['title_slug'] = url_title($name,'dash',TRUE);

			$result = $this->db->insert('pages', $datains);

            $arr['result'] = 'confirm';
        	$arr['message'] = 'Page Inserted.';
	    }

        echo json_encode($arr); 
	}

	function editpage_data() 
	{
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;
		$title=trim($this->input->post('title', TRUE));
		$area=trim($this->input->post('area', TRUE));
		$content=trim($this->input->post('content', TRUE));
		$link=trim($this->input->post('link', TRUE));
		$id=trim($this->input->post('page_id', TRUE));		

		$title = preg_replace('/[^A-Za-z0-9\-]/', '', $title);


		$datains = array();            

        $arr['result'] = 'confirm';
        $arr['message'] = '<ul>';
         
		if (strlen($title) == 0) {
            $arr['result'] = 'error';
            $arr['message'] .= '<li>Please fill the title name.</li>';
        }

        
	    if ($arr['result'] != 'error') 
        { 
	     	$datains['title'] = $title;
	     	$datains['area'] = $area;
	     	$datains['content'] = $content;
	     	$datains['link'] = $link;
	     	$datains['title_slug'] = url_title($title,'dash',TRUE);

			$this->db->where('id_page', $id);
			$result = $this->db->update('pages', $datains);

            $arr['result'] = 'confirm';
        	$arr['message'] = 'Page Edited.';
	    }

        echo json_encode($arr); 
	}

	/* comments menu */
	public function comments()
	{
		$sel['sel'] = "comments";

		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/comments');
        $this->load->view('layout/footer');
	}
	public function loadcomments()
	{
		$p = $this->input->post('p');
		
		$data['comments'] = $this->admin_model->get_comments('', $p, 'all');
		$this->load->view('admin/ajaxcontent/loadComments', $data);
	}
	public function removecomment()
	{
		$i = $this->input->post('i');
		$this->db->where(array("comment_id"=>$i));
		$this->db->delete("post_comments");
	}

	/* options menu */
	public function options()
	{

		$data['utila'] = $this->admin_model->get_users('','','','all');
		$sel['sel'] = "options";

		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/options', $data);
        $this->load->view('layout/footer');
	}
	
	/* options menu */
	public function Tampilan()
	{
		$data['users'] = $this->admin_model->get_stories();
		$data['utila'] = $this->admin_model->get_users('','','','all');
		$sel['sel'] = "options";

		$this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('admin/tampilan', $data);
        $this->load->view('layout/footer');
	}
	
	public function editoption()
	{
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;
		
		$v = $_POST['v'];
		$i = $this->input->post('i');
		
		$data=array('option_value'=>$v);
		$this->db->where('option_name',$i);
		$this->db->update('options',$data);		
	}

	function savelogo()
    {
    			if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;	
    			
    			$datains = array();
            	$newsins = array();

            	$arr['result'] = 'confirm';
            	$arr['message'] = '<ul>';

                //edit logo
                if (strlen($_FILES["file"]["name"]) > 1)                
                {
                    $validextensions = array("jpeg", "jpg", "png");
                    $temporary = explode(".", $_FILES["file"]["name"]);
                    $file_extension = end($temporary);

                    if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) && ($_FILES["file"]["size"] < 400000) && in_array($file_extension, $validextensions)) 
                    {
                        if ($_FILES["file"]["error"] > 0)
                        {
                            echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
                        } else {
                            if (file_exists("images/" . $_FILES["file"]["name"])) 
                            {
                                $arr['result'] = 'erro';
                                $arr['message'] .= '<li>Image already exist.</li>';
                            } else {
                                $sourcePath = $_FILES['file']['tmp_name'];
                                $nameFile   =   time() . "_" . $_FILES['file']['name'];
                                $targetPath = "images/".$nameFile;
                                move_uploaded_file($sourcePath,$targetPath);
                                
                                $datains['option_value'] = $nameFile;

								$this->db->where('option_name','applogo');
								$this->db->update('options',$datains);
                            }
                        }
                    } else {
                        $arr['result'] = 'error';
                        $arr['message'] .= '<li>Invalid File. Extension or size not valid.</li>';
                    }       
                }

                echo json_encode($arr);  

    }

    function saveretinalogo()
    {
    			if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;	

    			$datains = array();
            	$newsins = array();

            	$arr['result'] = 'confirm';
            	$arr['message'] = '<ul>';

                //edit logo
                if (strlen($_FILES["file"]["name"]) > 1)                
                {
                    $validextensions = array("jpeg", "jpg", "png");
                    $temporary = explode(".", $_FILES["file"]["name"]);
                    $file_extension = end($temporary);

                    if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) && ($_FILES["file"]["size"] < 400000) && in_array($file_extension, $validextensions)) 
                    {
                        if ($_FILES["file"]["error"] > 0)
                        {
                            echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
                        } else {
                            if (file_exists("images/" . $_FILES["file"]["name"])) 
                            {
                                $arr['result'] = 'erro';
                                $arr['message'] .= '<li>Image already exist.</li>';
                            } else {
                                $sourcePath = $_FILES['file']['tmp_name'];
                                $nameFile   =   time() . "_" . $_FILES['file']['name'];
                                $targetPath = "images/".$nameFile;
                                move_uploaded_file($sourcePath,$targetPath);
                                
                                $datains['option_value'] = $nameFile;

								$this->db->where('option_name','applogoretina');
								$this->db->update('options',$datains);
                            }
                        }
                    } else {
                        $arr['result'] = 'error';
                        $arr['message'] .= '<li>Invalid File. Extension or size not valid.</li>';
                    }       
                }

                echo json_encode($arr);  

    }

    function importwordpress()
    {
    	if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;

		//upload file
    	$datains = array();

            	$arr['result'] = 'confirm';
            	$arr['message'] = '<ul>';

                //edit logo
                if (strlen($_FILES["file"]["name"]) > 1)                
                {
                    $validextensions = array("xml");
                    $temporary = explode(".", $_FILES["file"]["name"]);
                    $file_extension = end($temporary);

                    if (($_FILES["file"]["size"] < 10000000) && in_array($file_extension, $validextensions)) 
                    {
                        if ($_FILES["file"]["error"] > 0)
                        {
                            echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
                        } else {
                            if (file_exists("files/" . $_FILES["file"]["name"])) 
                            {
                                $arr['result'] = 'erro';
                                $arr['message'] .= '<li>File already exist.</li>';
                            } else {
                                $sourcePath = $_FILES['file']['tmp_name'];
                                $nameFileXML   =   time() . "_" . $_FILES['file']['name'];
                                $targetPath = "files/".$nameFileXML;
                                move_uploaded_file($sourcePath,$targetPath);                                
                            }
                        }
                    } else {
                        $arr['result'] = 'error';
                        $arr['message'] .= '<li>Invalid File. Extension or size not valid.</li>';
                    }       
                }
                

        if ($arr['result'] == "confirm") 
        {
			$importfile = simplexml_load_file("files/".$nameFileXML);		
			$xi=0;
			foreach ($importfile->channel->item as $item) {			
			
			if (!$this->admin_model->verifyexists_title($item->title)) {

				$imageurl = $item->children('wp', true)->attachment_url;

				if ($imageurl) {
					copy($imageurl, 'images/file.png');
	            	$nameFile = time().$xi.".png";
	            	$sourcePath = "images/file.png";
	            	$targetPath = "images/".$nameFile;
	                move_uploaded_file($sourcePath,$targetPath);                
	                rename("images/file.png",$targetPath);

	                $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $targetPath;
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 900;
                    $config['height'] = 500;

                    $this->image_lib->clear();
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();

	            }
	            
				$datains['post_subject'] = $item->title;                
				$datains['post_by'] = $this->session->userdata('userid');
				$datains['post_image'] = $nameFile;
                $datains['post_date'] = $item->children('wp', true)->post_date;
                $datains['post_text'] = $item->children("content", true);
                $datains['post_slug'] = url_title($item->title,'dash',TRUE);
                $datains['post_type'] = "text";
                $datains['approved'] = 1;

                $result = $this->db->insert('posts', $datains);

                
                $xi++;

            }

            $arr['result'] = 'confirm';
            $arr['message'] = "$xi posts imported successfully.";
		
		}

		}

		echo json_encode($arr);
    }

    function savefavicon()
    {
    			if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;	

    			$datains = array();
            	$newsins = array();

            	$arr['result'] = 'confirm';
            	$arr['message'] = '<ul>';

                //edit logo
                if (strlen($_FILES["file"]["name"]) > 1)                
                {
                    $validextensions = array("jpeg", "jpg", "png", "ico");
                    $temporary = explode(".", $_FILES["file"]["name"]);
                    $file_extension = end($temporary);

                    if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/x-icon") || ($_FILES["file"]["type"] == "image/jpeg")) && ($_FILES["file"]["size"] < 400000) && in_array($file_extension, $validextensions)) 
                    {
                        if ($_FILES["file"]["error"] > 0)
                        {
                            echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
                        } else {
                            if (file_exists("images/" . $_FILES["file"]["name"])) 
                            {
                                $arr['result'] = 'erro';
                                $arr['message'] .= '<li>Image already exist.</li>';
                            } else {
                                $sourcePath = $_FILES['file']['tmp_name'];
                                $nameFile   =   time() . "_" . $_FILES['file']['name'];
                                $targetPath = "images/".$nameFile;
                                move_uploaded_file($sourcePath,$targetPath);
                                
                                $datains['option_value'] = $nameFile;

								$this->db->where('option_name','appfavicon');
								$this->db->update('options',$datains);
                            }
                        }
                    } else {
                        $arr['result'] = 'error';
                        $arr['message'] .= '<li>Invalid File. Extension or size not valid.</li>';
                    }       
                }

                echo json_encode($arr);  

    }

	function removeparsungai(){		
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;		
		$i = $this->input->post('i');
		$this->db->where(array("id"=>$i));
		$this->db->delete("par_ika");
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
