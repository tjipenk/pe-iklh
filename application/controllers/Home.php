<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('stories_model');
		$this->load->model('option_model');	
		$this->load->model('admin_model','admin_model');	

		require_once APPPATH.'libraries/facebook/facebook.php';
	}

	public function index()
	{
		if($this->session->userdata('logged_in'))  {
			switch ($this->session->userdata('level')){
				case 1:
				redirect('/admin/');

				case 2:
				redirect('/input/');

				case 3:
				redirect('/admin_prov/');

				case 4:
				redirect('/lap_prov/');
				
				default: 
				redirect('/');

			}

		}
		else {
			$data = array();
			$data['active'] 		= "home";
			$data['sungai'] = $this->admin_model->get_ika_dashboard();		 
		
			$this->load->view('header', $data);
			$this->load->view('depan', $data);
			$this->load->view('footer');
		}
	}
	
	

	public function daftar($i = "")
		{
		if($this->session->userdata('logged_in')) {
			 redirect(base_url(), 'location');		
		}else {
				$data['active'] 		= "login";
				
				$this->load->view('header', $data);
					//$this->load->view('navigation');
					$this->load->view('login');	
						
					
					$this->load->view('footer');
		}
			
	}
	
	
	
}
