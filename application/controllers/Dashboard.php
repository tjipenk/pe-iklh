<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('dashboard_model');
		$this->load->model('customer_model','customers');
		$this->load->model('Luas_tanam_model','luas_tanam');
		$this->load->model('Luas_panen_model','luas_panen');
		$this->load->model('Berat_panen_model','berat_panen');
	}

	public function index()
	{
		$data 	= array();
		$data['kecamatan'] = $this->dashboard_model->data_kecamatan();
		$sel['sel'] = "dashboard";
        $data['gapoktan'] = $this->dashboard_model->semua_gapoktan();
        $data['poktan'] = $this->dashboard_model->semua_kelompok_tani();
		$data['kecamatan'] = $this->dashboard_model->data_kecamatan();
        $data['barang_hibah'] = $this->dashboard_model->barang_hibah();
		$gapoktan = $this->dashboard_model->semua_gapoktan();
		foreach ($gapoktan as $key => $value) {
			$tegalan = $tegalan + $value['tegal'];
			$sawah = $sawah + $value['sawah'];
			$pekarangan= $pekarangan + $value['pekarangan'];
		}
		$data['luas_tegal'] = $tegalan;
		$data['luas_sawah'] = $sawah;
		$data['luas_pekarangan'] = $pekarangan;
		$data['active'] 		= "statistik";
		$data['active'] 		= "statistik";
		$this->load->view('header',$data);
		$this->load->view('hibah_x', $data);
		$this->load->view('footer');
	}

	function tanam(){
		$data['active'] 	= "tanam";
		$data['komoditas'] 	= $this->dashboard_model->data_kemoditas();
		$this->load->view('header', $data);
		$this->load->view('tanam', $data);
		$this->load->view('footer');	
	}


	function luas_panen(){
		$data['active'] 	= "luas_panen";
		$data['komoditas'] 	= $this->dashboard_model->data_kemoditas();
		$this->load->view('header', $data);
		$this->load->view('luas_panen', $data);
		$this->load->view('footer');	
	}

	function edit_berat_panen(){

		$id 	= $_POST['id'];
		$berat 	= $_POST['berat_tanam'];
		$data 	= array(
        	'berat' 	=> $berat
		);

		$this->db->where('id', $id);
		$this->db->update('panen', $data);

	}
	function edit_luas_tanam(){

		$id 	= $_POST['id'];
		$luas 	= $_POST['luas_tanam'];
		$data 	= array(
        	'tambah_tanam' 	=> $luas
		);

		$this->db->where('id', $id);
		$this->db->update('panen', $data);

	}

	function delete_luas_tanam(){

		$id 	= $_POST['id'];

		$this->db->where('id', $id);
		$this->db->delete('panen');

	}

	function delete_luas_panen(){

		$id 	= $_POST['id'];

		$this->db->where('id', $id);
		$this->db->delete('panen');

	}

	function edit_luas_panen(){

		$id 	= $_POST['id'];
		$luas 	= $_POST['luas_panen'];
		$data 	= array(
        	'luas_panen' 	=> $luas
		);

		$this->db->where('id', $id);
		$this->db->update('panen', $data);

	}


	public function tanam_detail($id)
	{
		$data 			= array();
		$data['kecamatan'] 	= $this->dashboard_model->data_kecamatan();
		$sel['sel'] 	= "dashboard";
       	$data['komoditas'] 	= $this->dashboard_model->data_kemoditas();

		$bulan 		= $this->input->get("bulan");
		if($bulan	==""){
			$bulan 	=  1;
		}

		$tahun 		= $this->input->get("tahun");
		if($tahun	== ""){
			$tahun 	=  2010;
		}

		$data['bulan'] =  $bulan;
		$data['tahun'] = $tahun;

		$data['tahun_min'] =  2010;
		$data['tahun_max'] =  date('Y');
		$tanams = $this->dashboard_model->data_tanam($bulan,$tahun,$id);
	
		$luas_tanam = 0;
		$kecamatan = array();
		$x = 0;
		$list = array();
		
		foreach ($tanams as  $tanam) {
			$luas_tanam = $luas_tanam +  $tanam['tambah_tanam'];
		
			if(!in_array($tanam['kecamatan'], $list)) {
				$kecamatan[$x]['id'] 	= $tanam['id_kecamatan'];
				$list[$x] = $tanam['kecamatan'];
				$kecamatan[$x]['kecamatan'] 	=  $tanam['kecamatan'];
				$kecamatan[$x]['tambah_tanam'] = $tanam['tambah_tanam'];
				$x++;
			} else {
				$key = array_search($tanam['kecamatan'], $list);
				$kecamatan[$key]['tambah_tanam'] +=  $tanam['tambah_tanam'];
			}
		}


		$data['tanam'] = $kecamatan;
		$data['total_luas'] = $luas_tanam;

		$data['id'] = $id;
		$data['active'] 		= "tanam";
		
		$data['halaman'] = 1;
		$this->load->view('header', $data);
	
		if(count($tanams) > 0) {
				$this->load->view('tanam_x', $data);
		} else {
			$this->load->view('tanam_kosong', $data);
		}
		$this->load->view('footer');	
		$datax['tahun'] = $tahun;
		$datax['bulan'] = $bulan;
		$datax['id']	= $id;
		$this->load->view('footer_tanam_x',$datax);	

	}

		public function tanam_detail2($id)
	{
		$data 			= array();
		$data['kecamatan'] 	= $this->dashboard_model->data_kecamatan();
		$sel['sel'] 	= "dashboard";
       		$data['komoditas'] 	= $this->dashboard_model->data_kemoditas();

		$bulan 		= $this->input->get("bulan");
		if($bulan	==""){
			$bulan 	=  1;
		}

		$tahun 		= $this->input->get("tahun");
		if($tahun	== ""){
			$tahun 	=  2010;
		}

		$data['bulan'] =  $bulan;
		$data['tahun'] = $tahun;

		$data['tahun_min'] =  2010;
		$data['tahun_max'] =  date('Y');
		$tanams = $this->dashboard_model->data_tanam2($bulan,$tahun,$id);
	
		$luas_tanam = 0;
		$kecamatan = array();
		$x = 0;
		$list = array();
		
		foreach ($tanams as  $tanam) {
			$luas_tanam = $luas_tanam +  $tanam['tambah_tanam'];
		
			if(!in_array($tanam['kecamatan'], $list)) {
				$kecamatan[$x]['id'] 	= $tanam['id_kecamatan'];
				$list[$x] = $tanam['kecamatan'];
				$kecamatan[$x]['kecamatan'] 	=  $tanam['kecamatan'];
				$kecamatan[$x]['tambah_tanam'] = $tanam['tambah_tanam'];
				$x++;
			} else {
				$key = array_search($tanam['kecamatan'], $list);
				$kecamatan[$key]['tambah_tanam'] +=  $tanam['tambah_tanam'];
			}
		}


		$data['tanam'] = $kecamatan;
		$data['total_luas'] = $luas_tanam;

		$data['id'] = $id;
		$data['active'] 		= "tanam";
		
		$data['halaman'] = 1;
		$this->load->view('header', $data);
	
		if(count($tanams) > 0) {
				$this->load->view('tanam_x2', $data);
		} else {
			$this->load->view('tanam_kosong', $data);
		}
		$this->load->view('footer');	
		$datax['tahun'] = $tahun;
		$datax['bulan'] = $bulan;
		$datax['id']	= $id;
		$this->load->view('footer_tanam_x2',$datax);	

	}

	public function luas_panen_detail($id)
	{
		$data 			= array();
		$data['kecamatan'] 	= $this->dashboard_model->data_kecamatan();
		$sel['sel'] 	= "dashboard";
       	$data['komoditas'] 	= $this->dashboard_model->data_kemoditas();

		$bulan 		= $this->input->get("bulan");
		if($bulan	==""){
			$bulan 	=  1;
		}

		$tahun 		= $this->input->get("tahun");
		if($tahun	== ""){
			$tahun 	=  2010;
		}

		$data['bulan'] =  $bulan;
		$data['tahun'] = $tahun;

		$data['tahun_min'] =  2010;
		$data['tahun_max'] =  date('Y');
		$tanams = $this->dashboard_model->data_luas_panen($bulan,$tahun,$id);
	
		$luas_tanam = 0;
		$kecamatan = array();
		$x = 0;
		$list = array();
		
		foreach ($tanams as  $tanam) {
			$luas_tanam = $luas_tanam +  $tanam['luas_panen'];
		
			if(!in_array($tanam['kecamatan'], $list)) {
				$kecamatan[$x]['id'] 	= $tanam['id_kecamatan'];
				$list[$x] = $tanam['kecamatan'];
				$kecamatan[$x]['kecamatan'] 	=  $tanam['kecamatan'];
				$kecamatan[$x]['tambah_tanam'] = $tanam['luas_panen'];
				$x++;
			} else {
				$key = array_search($tanam['kecamatan'], $list);
				$kecamatan[$key]['tambah_tanam'] +=  $tanam['luas_panen'];
			}
		}


		$data['tanam'] = $kecamatan;
		$data['total_luas'] = $luas_tanam;
		$data['id'] = $id;
		$data['active'] 		= "luas_panen";
		$data['halaman'] = 1;
		$this->load->view('header', $data);
	
		if(count($tanams) > 0) {
				$this->load->view('luas_panen_x', $data);
		} else {
			$this->load->view('luas_panen_kosong', $data);
		}

		$this->load->view('footer');	
		$datax['tahun'] = $tahun;
		$datax['bulan'] = $bulan;
		$datax['id']	= $id;
		$this->load->view('footer_panen_x',$datax);	
	}


	public function dinamika($tahun)
	{
		$data 			= array();
		$data['kecamatan'] 	= $this->dashboard_model->data_kecamatan();
		$data['bulan'] =  $bulan;
		$data['tahun'] = $tahun;
		$data['tahun_min'] =  2010;
		$data['tahun_max'] =  date('Y');
		$dinamika = $this->dashboard_model->dinamika($tahun);
	
		$data['dinamika'] = $dinamika;

		$data['active'] 		= "dinamika";
		
		$this->load->view('header', $data);
		if(count($dinamika) > 0) {
			$this->load->view('dinamika', $data);
		} else {
			$this->load->view('dinamika_kosong', $data);
		}
		
		$this->load->view('footer');	
	}

	function petugas(){
		$this->load->helper('url');
		$this->load->view('header', $data);
	    $this->load->view('petugas');
	    //$this->load->view('footer');	
	}


	function edit_user($id){
		$data['kecamatan']    = $this->dashboard_model->data_kecamatan();
		$petugas = $this->dashboard_model->data_petugas($id);
		
 		$data['petugas']= $petugas[0];
		$this->load->helper('url');
		$this->load->view('header', $data);
	    $this->load->view('edit_user', $data);
	    $this->load->view('footer');	
	}

	public function ajax_list()
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
         	$row[] = "<a class='btn btn-biru' href='".base_url()."dashboard/edit_user/".$customers->user_id."'>Edit</a> ";

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

    public function luas_tanam_ajax_list()
    {
    	$bulan = $_GET['bulan'];
    	$tahun = $_GET['tahun'];
    	$id = $_GET['id'];
        $list = $this->luas_tanam->get_datatables($bulan,$tahun,$id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $customers->tambah_tanam;
            $row[] = $customers->bulan;
            $row[] = $customers->tahun;
            $row[] = $customers->tanggal_input;
            	$nama_kecamatan =  $this->dashboard_model->nama_kecamatan($customers->kecamatan);
            	$nama_desa = $this->dashboard_model->nama_desa($customers->desa);
       	    $row[] = $nama_kecamatan[0]['nama'];
            $row[] = $nama_desa[0]['nama'];
      
            $row[] = $customers->minggu;

        if($this->session->userdata('logged_in')) {
         	$row[] = "<a class='btn btn-biru' nilai='". $customers->id."'  data-toggle='modal' onclick='editTanam(". $customers->id.",". $customers->tambah_tanam.")' data-target='#myModal'>Edit</a>"."<a class='btn btn-biru btn-merah' nilai='". $customers->id."'  onclick='deleteTanam(". $customers->id.")' >Hapus</a>";

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

    public function luas_tanam_ajax_list2()
    {
    	$bulan = $_GET['bulan'];
    	$tahun = $_GET['tahun'];
    	$id = $_GET['id'];
        $list = $this->luas_tanam->get_datatables2($bulan,$tahun,$id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $customers->tambah_tanam;
            $row[] = $customers->bulan;
            $row[] = $customers->tahun;
            $row[] = $customers->tanggal_input;
            	$nama_kecamatan =  $this->dashboard_model->nama_kecamatan($customers->kecamatan);
            	$nama_desa = $this->dashboard_model->nama_desa($customers->desa);
       	    $row[] = $nama_kecamatan[0]['nama'];
            $row[] = $nama_desa[0]['nama'];
      
            $row[] = $customers->minggu;

        if($this->session->userdata('logged_in')) {
         	$row[] = "<a class='btn btn-biru' nilai='". $customers->id."'  data-toggle='modal' onclick='editTanam(". $customers->id.",". $customers->tambah_tanam.")' data-target='#myModal'>Edit</a>"."<a class='btn btn-biru btn-merah' nilai='". $customers->id."'  onclick='deleteTanam(". $customers->id.")' >Hapus</a>";

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
 
   
	
    public function luas_panen_ajax_list()
    {
    	$bulan = $_GET['bulan'];
    	$tahun = $_GET['tahun'];
    	$id = $_GET['id'];
        $list = $this->luas_panen->get_datatables($bulan,$tahun,$id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $customers->luas_panen;
            $row[] = $customers->bulan;
            $row[] = $customers->tahun;
              $row[] = $customers->tanggal_input;
            $nama_kecamatan =  $this->dashboard_model->nama_kecamatan($customers->kecamatan);
            $nama_desa = $this->dashboard_model->nama_desa($customers->desa);
       		$row[] = $nama_kecamatan[0]['nama'];
            $row[] = $nama_desa[0]['nama'];
                      $row[] = $customers->minggu;
  if($this->session->userdata('logged_in')) {
         	$row[] = "<a class='btn btn-biru' nilai='". $customers->id."'  data-toggle='modal' onclick='editPanen(". $customers->id.",". $customers->luas_panen.")' data-target='#myModal'>Edit</a>"."<a class='btn btn-biru btn-merah' nilai='". $customers->id."'  onclick='deleteTanam(". $customers->id.")' >Hapus</a>";

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

    public function berat_panen_ajax_list()
    {
    	$bulan = $_GET['bulan'];
    	$tahun = $_GET['tahun'];
    	$id = $_GET['id'];
        $list = $this->berat_panen->get_datatables($bulan,$tahun,$id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $customers->berat;
            $row[] = $customers->bulan;
            $row[] = $customers->tahun;
            $row[] = $customers->tanggal_input;
            $nama_kecamatan =  $this->dashboard_model->nama_kecamatan($customers->kecamatan);
            $nama_desa = $this->dashboard_model->nama_desa($customers->desa);
       		$row[] = $nama_kecamatan[0]['nama'];
            $row[] = $nama_desa[0]['nama'];
      
            $row[] = $customers->minggu;
  			if($this->session->userdata('logged_in')) {
         		$row[] = "<a class='btn btn-biru' nilai='". $customers->id."'  data-toggle='modal' onclick='editPanen(". $customers->id.",". $customers->berat.")' data-target='#myModal'>Edit</a>"."<a class='btn btn-biru btn-merah' nilai='". $customers->id."'  onclick='deleteTanam(". $customers->id.")' >Hapus</a>";

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
 
 
	


	
	function panen(){
		$data['active'] 	= "panen";
		$data['komoditas'] 	= $this->dashboard_model->data_kemoditas();
		$this->load->view('header', $data);
		$this->load->view('panen', $data);
		$this->load->view('footer');	
	}

	public function panen_detail($id)
	{
		$data 			= array();
		$data['kecamatan'] 	= $this->dashboard_model->data_kecamatan();
		$sel['sel'] 	= "dashboard";
       	$data['komoditas'] 	= $this->dashboard_model->data_kemoditas();

		$bulan 		= $this->input->get("bulan");
		if($bulan	==""){
			$bulan 	=  1;
		}

		$tahun 		= $this->input->get("tahun");
		if($tahun	== ""){
			$tahun 	=  2010;
		}

		$data['bulan'] =  $bulan;
		$data['tahun'] = $tahun;

		$data['tahun_min'] =  2010;
		$data['tahun_max'] =  date('Y');
		$panens = $this->dashboard_model->data_panen($bulan,$tahun,$id);
		$total_berat = 0;
		$kecamatan = array();
		$x = 0;
		$list = array();
		foreach ($panens as  $tanam) {
			$total_berat = $total_berat +  $tanam['berat'];
		
			if(!in_array($tanam['kecamatan'], $list)) {
				$kecamatan[$x]['id'] 	= $tanam['id_kecamatan'];
				$list[$x] = $tanam['kecamatan'];
				$kecamatan[$x]['kecamatan'] 	=  $tanam['kecamatan'];
				$kecamatan[$x]['berat'] = $tanam['berat'];
				$x++;
			} else {
				$key = array_search($tanam['kecamatan'], $list);
				$kecamatan[$key]['berat'] +=  $tanam['berat'];
			}
		}

	

		$data['panen'] = $panens;

		$data['tanam'] = $kecamatan;
		$data['total_berat'] = $total_berat;

		$data['id'] = $id;
		$data['active'] 		= "panen";
		
		$data['halaman'] = 1;
		$this->load->view('header', $data);
		if(count($panens) > 0) {
			$this->load->view('panen_x', $data);
		} else {
			$this->load->view('panen_kosong', $data);
		}
		
		


		$this->load->view('footer');	
		$datax['tahun'] = $tahun;
		$datax['bulan'] = $bulan;
		$datax['id']	= $id;
		$this->load->view('footer_berat_x',$datax);	
	}

	


	function peta_kecamatan($id=""){
		//$data['barang_hibah'] = $this->dashboard_model->barang_hibah();
		if($id=="") {
			$this->load->view('peta_by_kecamatan',$data);
		} else {
			$data['id'] = $id;
			$this->load->view('peta_by_kecamatan_barang',$data);
		}
			
	}

	function info_peta_kecamatan($id=""){
		$data['barang_hibah'] = $this->dashboard_model->barang_hibah();
		if($id=="") {
			$this->load->view('info_peta_by_kecamatan',$data);
		} else {
			$data['id'] = $id;
			$this->load->view('info_peta_by_kecamatan_barang',$data);
		}
			
	}

	function peta_desa($id=""){
		$data['barang_hibah'] = $this->dashboard_model->barang_hibah();
		if($id=="") {
			$this->load->view('peta_by_desa',$data);	
		} else {
			$data['id'] = $id;
			$this->load->view('peta_by_desa_barang',$data);
		}
		
	}
	
	
	public function peta()
	{
		
		$data = array();
		$data['active'] 		= "hibah";
		$this->load->view('header',$data);
		$data['kecamatan'] = $this->dashboard_model->data_kecamatan();
		$data['desa'] = $this->dashboard_model->data_desa();
		$data['aktivitas'] = $this->dashboard_model->hibah();
		
		$this->load->view('peta', $data);	
		//$this->load->view('footer');
			
	}


	public function rute()
	{
		
	
	
		$this->load->library('googlemaps');

	$config['center'] = '-7.666964, 112.300000';
	$config['zoom'] = 'auto';
		$config['language'] = 'ID';
	$config['directions'] = TRUE;
	//$config['directionsStart'] = 'Jombang, Jl. Basuki Rahmad No.1, Kaliwungu, Kec. Jombang, Kabupaten Jombang, Jawa Timur 61419, Indonesia';
	$config['directionsStart'] = 'Alun-Alun Jombang, Jalan Basuki Rahmad, Jombatan, Kabupaten Jombang, Jawa Timur, Indonesia';
	//$config['directionsStart'] = 'Kantor Dinas Pertanian Kabupaten Jombang';
	
	$config['directionsEnd'] = 'Bareng, Kabupaten Jombang, Jawa Timur, Indonesia';

	$config['directionsDivID'] = 'directionsDiv';
	$this->googlemaps->initialize($config);
	$data['map'] = $this->googlemaps->create_map();

	$this->load->view('view_file', $data);
		//$this->load->view('footer');
			
	}
	

	function update_aset() {
		$json = file_get_contents('Jombangkec.js');
		$jsonencode = json_decode($json);
		$desas = $jsonencode->features;
		 $min=1;
		  $max=20;
		//print_r($desas);
		$x = 0;

		$list =  array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17);
		foreach($desas as $desa){
			$rnd1 = rand($min,$max);
		do {
		  $rnd2 = rand($min,$max);
		} while ($rnd1 == $rnd2);

			$out[$x]['type'] = $desa->type;
			$out[$x]['properties']['AREA'] = $desa->properties->AREA;
			$out[$x]['properties']['PERIMETER'] = $desa->properties->PERIMETER;
			$out[$x]['properties']['KECAMATAN'] = trim($desa->properties->KECAMATAN);
			$out[$x]['properties']['KODE_UNSUR'] = $desa->properties->KODE_UNSUR;
			$out[$x]['properties']['TRAKTOR'] = $rnd1;
			$out[$x]['properties']['TRAKTOR_DUA'] = $rnd2;
			$out[$x]['properties']['SOURCETHM'] = $desa->properties->SOURCETHM;
			$out[$x]['geometry'] = $desa->geometry;
			foreach ($list as $key) {
				$out[$x]['properties']['sss'.$key] = 0;
			}
			echo "<pre>";
			$id = $out[$x]['properties']['ID_KECAMATAN'] = $desa->properties->ID_KECAMATAN;
			$data = $this->dashboard_model->hibah_by_kecamatan_($id);
			foreach($data as $aset) {
				
					$out[$x]['properties']['sss'.$aset['barang']] = $aset['jumlah'] + $out[$x]['properties']['sss'.$aset['barang']];
			
			}
			//print_r($out[$x]['properties']);

			 strtolower(str_replace('KECAMATAN','', $out[$x]['properties']['KECAMATAN']))."<br/>";
			 	print_r($out[$x]['properties'][$aset['barang']]);
			$x++;


		}

		print_r($out);
		$jsonoutput ="var statesData =".json_encode($out);
		file_put_contents("jombang_by_kecamatan.js",$jsonoutput);

	}


	function update_aset2() {
		$json = file_get_contents('Jombang_desa.json');
		$jsonencode = json_decode($json);
		$desas = $jsonencode->features;
		 $min=1;
		  $max=20;
		//print_r($desas);
		$x = 0;

		$list =  array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17);
		foreach($desas as $desa){
			

			$out[$x]['type'] = $desa->type;
			$out[$x]['properties']['AREA'] = $desa->properties->AREA;
			$out[$x]['properties']['PERIMETER'] = $desa->properties->PERIMETER;
				 $out[$x]['properties']['KECAMATAN'] = trim($desa->properties->KECAMATAN);
			$out[$x]['properties']['KELURAHAN'] = ucfirst(strtolower(trim(str_replace("DESA ", "", $desa->properties->KELURAHAN))));
			$out[$x]['properties']['KODE_UNSUR'] = $desa->properties->KODE_UNSUR;
			$gapoktan =  $this->dashboard_model->gapoktan_detail_by_url($out[$x]['properties']['KELURAHAN']);
			
			 $out[$x]['properties']['DESA'] = $gapoktan[0]['desa'];
			 $out[$x]['properties']['USER'] = $gapoktan[0]['id_user'];
			$out[$x]['properties']['SOURCETHM'] = $desa->properties->SOURCETHM;
			$out[$x]['geometry'] = $desa->geometry;
			foreach ($list as $key) {
				$out[$x]['properties']['sss'.$key] = 0;
			}
			echo "<pre>";
			echo $id = $out[$x]['properties']['USER'];
			$data = $this->dashboard_model->hibah_by_desa_($id);
			print_r($data);
			foreach($data as $aset) {
				
					$out[$x]['properties']['sss'.$aset['barang']] = $aset['jumlah'] + $out[$x]['properties']['sss'.$aset['barang']];
			
			}
			//print_r($out[$x]['properties']);

			 strtolower(str_replace('KECAMATAN','', $out[$x]['properties']['KECAMATAN']))."<br/>";
			 	print_r($out[$x]['properties'][$aset['barang']]);
			$x++;


		}


$jsonoutput =json_encode($out);
		file_put_contents("jombang.json",$jsonoutput);
		//print_r($out);
		$jsonoutput2 ="var statesData =".json_encode($out);
		file_put_contents("jombang.js",$jsonoutput2);

	}
	
	
	
	
	
}
