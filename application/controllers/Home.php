<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('stories_model');
		$this->load->model('option_model');		
		require_once APPPATH.'libraries/facebook/facebook.php';
	}

	public function index()
	{
		
		$data = array();
		$data['active'] 		= "home";
		$this->load->view('header', $data);
		$this->load->view('depan', $data);
			$this->load->view('footer');
			
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
