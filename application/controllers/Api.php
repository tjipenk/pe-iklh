<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Api extends CI_Controller {

	private $gapoktan_id;
	private $user_id = "";
	function __construct() {
		parent::__construct();
		$this->load->model('backend3/admin_model');
		$this->load->model('stories_model');
		$this->load->model('user_model');
		$this->load->model('dashboard_model');
		$this->this->gapoktan_id = $this->admin_model->gapoktan_id;
		$this->user_id = $this->session->userdata('userid');
	}


	function login() {
        $username 	= $this->input->post('email', TRUE);
        $password  	= $this->input->post('password', TRUE);
           
        if ((strlen($username) == 0) || (strlen($password) == 0))  {
            $response["error"] = TRUE;
            $response["error_msg"] = "Tolong isi username dan password yang benar!";
            echo json_encode($response);        
            return false;
        } else {
            $this->db->where('user_slug', $username);
            $this->db->where('user_level', 2);
            $query 	= $this->db->get_where('users');
            if ($query->num_rows() > 0) {
                $row = $query->row_array();
                $salt = $row['user_salt'];
                $check_password = hash('sha256', $password . $salt); 
                for($round = 0; $round < 65536; $round++){
                    $check_password = hash('sha256', $check_password . $salt);
                }
                
                if($check_password != $row['user_pass'])
                {
                   	$response["error"] = TRUE;
                    $response["error_msg"] = "Username / password salah . Tolong coba lagi!";
                    echo json_encode($response);        
                    return false;
                }

                $response["error"] 	= FALSE;
                $response["uid"] 	=  $row['user_id'];
                $response["user"]["name"] 	= $row['user_name'];
                $response["user"]["email"] 	= $row['user_slug'];
                $response["user"]["created_at"] 	= $row['user_date'];
                $response["user"]["updated_at"] 	= $row['user_date'];
                $nama_kecamatan =  $this->dashboard_model->nama_kecamatan($row['kecamatan']);
                $response["user"]["id_kecamatan"] 	= $row['kecamatan'];
                $response["user"]["nama_kecamatan"] = $nama_kecamatan[0]['nama'];
                $response["user"]["desa"] 	= $this->dashboard_model->desa_by_kecamatan($row['kecamatan']);
                echo json_encode($response);
                return;
                  
            } else {
			    $response["error"] = TRUE;
			    $response["error_msg"] = "Required parameters email or password is missing!";
			    echo json_encode($response);
            }
        }
              
    }



	function list_kecamatan($id) {
		$data = $this->dashboard_model->desa_by_kecamatan($id);
		echo json_encode($data);
	}
  
	function tambah_data() {
		$minggu 		= $this->input->post('minggu');
		$bulan 			= $this->input->post('bulan');
		$kecamatan 		= $this->input->post('kecamatan');
		$tahun			= $this->input->post('tahun');
		$komoditas 		= $this->input->post('komoditas');
		$produksi 		= $this->input->post('berat_panen');
		$tambah_tanam 	= $this->input->post('tambah_tanam');
		$luas_panen 	= $this->input->post('luas_panen');
		$desa 			= $this->input->post('desa');
		$array_bulan 	=  array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$komoditasx 	= $this->admin_model->komoditas_by_nama(trim($komoditas));
		$id_komoditas 	= $komoditasx[0]['id'];
		$key 			= array_search($bulan, $array_bulan);
		$id_bulan 		=	$key +1;

		$data =  array(
        	'kecamatan'	=>$kecamatan,
        	'minggu'	=>$minggu,
        	'bulan'		=>$id_bulan,
        	'tahun'		=>$tahun,
        	'luas_panen'=>$luas_panen,
        	'berat'		=>$produksi,
        	'desa'		=>$desa,
        	'komoditas'	=>$id_komoditas,
        	'tambah_tanam'	=>$tambah_tanam,
        	'tanggal_input'	=>date("Y-m-d")
        ); 

        $this->db->insert('panen', $data);
	
	 $response["error"] = FALSE;
          
            echo json_encode($response);
		//redirect("penginput/tanam");
              
	}

	function tambah_dinamika() {
		$minggu 	= $this->input->post('minggu');
		$desa 		= $this->input->post('bulan');
		$bulan 		= $this->input->post('desa');
		$tahun		= $this->input->post('tahun');
		$komoditas 	= $this->input->post('komoditas');
		$defisit 	= $this->input->post('defisit');
		$kecamatan		= $this->input->post('kecamatan');
		$jenis_bencana 	= $this->input->post('jenis_bencana');
		$array_bulan 	=  array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
	
		$komoditasx 	= $this->admin_model->komoditas_by_nama(trim($komoditas));
		$id_komoditas 	= $komoditasx[0]['id'];
		$key 		= array_search($bulan, $array_bulan);
		$id_bulan 	= $key +1;

		if(empty($desa)) {
			$desa = "";
		}

		if(empty($minggu)) {
			$minggu = "";
		}

		$data_insert 		=  array(
        	'jenis_bencana'	=> $jenis_bencana,
        	'kecamatan'		=> $kecamatan,
        	'bulan'			=> $id_bulan,
        	'tahun'			=> $tahun,
        	'defisit'		=> $defisit,
        	'minggu_ke'		=> $minggu,
        	'desa'			=> $desa
        ); 

        $this->db->insert('dinamika_budidaya', $data_insert);
	
	 $response["error"] = FALSE;
          
            echo json_encode($response);
		//redirect("penginput/tanam");
              
	}
}
