<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Input extends CI_Controller {
private $user_id = "";
	function __construct()
	{
		parent::__construct();
		$this->load->model('input_model');
		$this->load->model('stories_model');
		$this->load->model('dashboard_model');
		
		$this->user_id = $this->session->userdata('userid');
		if (!$this->input_model->check_user()) redirect('/', 'location');
        
	}
    /* dashboard */
	public function index() 
	{
	//	redirect('/input/dashboard', 'location');
		redirect('/input/daftar_sungai', 'location');

	}
	public function dashboard()
    {
        $sel['sel'] = "dashboard";
        $data['gapoktan'] = $this->dashboard_model->semua_gapoktan();
        $data['poktan'] = $this->dashboard_model->semua_kelompok_tani();
		$data['kecamatan'] = $this->dashboard_model->data_kecamatan();
        $data['estat1']=$this->input_model->get_num_kelompok_tani();
        $data['stat_gapoktan']=$this->input_model->get_num_gapoktan();
        $data['barang_hibah'] = $this->dashboard_model->barang_hibah();
         $data['stat_hibah']=$this->input_model->stat_hibah();
          $data['stat_aktivitas']=$this->input_model->stat_aktivitas();
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
		//print_r($gapoktan);
		$this->load->view('input/header');
        $this->load->view('input/navigation', $sel);
        $this->load->view('input/dashboard', $data);

		//$this->load->view('laporan', $data);
		
        $this->load->view('input/footer');
    }
	/* users menu */
	public function users()
	{
		$sel['sel'] = "users";

		$this->load->view('input/header');
        $this->load->view('input/navigation', $sel);
        $this->load->view('input/users');
        $this->load->view('input/footer');
	}

	
	public function daftar_sungai()
	{
		$sel['sel'] = "daftar_sungai";
	
		$this->load->view('input/header');
        $this->load->view('input/navigation', $sel);
		//$this->load->view('input/daftar_sungai',$data);
		$this->load->view('input/daftar_sungai');
        $this->load->view('input/footer');
	}

	public function load_sungai()
	{
		$p = $this->input->post('p');
		
		$data['sungai'] = $this->input_model->get_lokasi_sungai('', $p, '', 'all');		
		
		$this->load->view('input/ajaxcontent/loadSungai', $data);
	}

	function add_sungai() {
		$sel['sel'] = "sungai";
		$data['provinsi'] 		= $this->input_model->data_provinsi();
		$data['kabupaten'] 			= $this->input_model->data_kabupaten();
		$this->load->library('googlemaps');

		$config['center'] = '	-6.2068701,106.7977906';
		$config['zoom'] = '12';
		$this->googlemaps->initialize($config);

		$marker = array();
		$marker['position'] = '	-6.2068701,106.7977906';
		$marker['draggable'] = true;
		$marker['ondragend'] = '$("#latitude").val(event.latLng.lat());$("#longitude").val(event.latLng.lng());';
		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();
		$this->load->view('input/header');
        $this->load->view('input/navigation', $sel);
        $this->load->view('input/add_sungai',$data);
        $this->load->view('input/footer');
	}

	public function add_sungai_data() 
	{
		
			$nama 	=  $_POST['nama'];   //kode_sungai
			$titik 	=  $_POST['titik'];  //lokasi pengamatan
			$tanggal =  $_POST['tanggal'];
			
			$level 		=  3;
			
			$provinsi 	= $_POST['provinsi'];
			$kabupaten 		= $_POST['kabupaten'];
			$tss 	=	$_POST['tss'];
			$do 	=	$_POST['do'];
			$bod 	=	$_POST['bod'];
			$cod 	=	$_POST['cod'];
			$tf 	=	$_POST['tp'];
			$fcoli 	=	$_POST['fcoli'];
			$tcoli 	=	$_POST['tcoli'];
			
			$latitude 	= $_POST['lat'];
			$longitude 	= $_POST['long'];
			
			$deskripsi 	=  $_POST['deskripsi'];

			if(empty($latitude)){
				$latitude = '-7.546839';
			}
			if(empty($longitude)) {
				$longitude ='112.226479';
			}

			$datains2['kode_sungai'] = $nama;
            $datains2['lokasi'] = $titik;
            $datains2['id_prov'] = $provinsi;
            $datains2['id_kab'] = $kabupaten;
         	$datains2['lat'] = $latitude;
            $datains2['lon'] = $longitude;
			$datains2['usr_lv'] = $level;
			$datains2['tanggal'] = $tanggal;
			
            $datains2['tss'] = $tss;
            $datains2['do'] = $do;
            $datains2['bod'] = $bod;
           	$datains2['cod'] = $cod;
           	$datains2['tf'] = $tf;
           	$datains2['fcoli'] = $fcoli;
			$datains2['tcoli'] = $tcoli;
			$datains2['ket'] = $deskripsi;
			
			$this->db->insert('tbl_sungai', $datains2); 
			print_r($datains2);
			
			echo "add";	 
	}

	public function removesungai()
	{		
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;		
		$i = $this->input->post('i');
		$this->db->where(array("id_sungai"=>$i));
		$this->db->delete("tbl_sungai");
	}

	function editsungai($i) {
		$sel['sel'] = "sungai";

		$data['stories'] = $this->input_model->get_specific_sungai($i);

		$this->load->view('input/header');
        $this->load->view('input/navigation', $sel);
        $this->load->view('input/sungaiedit', $data);
        $this->load->view('input/footer');
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

	
	
	public function stories()
	{
		$sel['sel'] = "stories";		

		$this->load->view('input/header');
        $this->load->view('input/navigation', $sel);
        $this->load->view('input/stories');
        $this->load->view('input/footer');
	}

	public function desa()
	{
		$sel['sel'] = "stories";		

		$this->load->view('input/header');
        $this->load->view('input/navigation', $sel);
        $this->load->view('input/desa');
        $this->load->view('input/footer');
	}

	public function kecamatan()
	{
		$sel['sel'] = "stories";		

		$this->load->view('input/header');
        $this->load->view('input/navigation', $sel);
        $this->load->view('input/kecamatan');
        $this->load->view('input/footer');
	}

	
	public function load_desa()
	{
		$p = $this->input->post('p');
		
		$data['stories'] = $this->input_model->getdesa('', $p, '', 'all');

		$this->load->view('input/ajaxcontent/load_desa', $data);
	}

	public function load_kecamatan()
	{
		$p = $this->input->post('p');
		
		$data['stories'] = $this->input_model->getkecamatan('', $p, '', 'all');
		
		$this->load->view('input/ajaxcontent/load_kecamatan', $data);
	}
	
	
	/*categories menu*/
	public function tambah_pengumuman()
	{
		$sel['sel'] = "categories";

		$this->load->view('input/header');
        $this->load->view('input/navigation', $sel);
        $this->load->view('input/categories');
        $this->load->view('input/footer');
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
			redirect('/input/stories', 'location');
	}
	
	function tambah_sungai() {
		$sel['sel'] = "users";
		$sel['header'] = "Tambah Poktan";
		$this->load->view('input/header');
        $this->load->view('input/navigation', $sel);
        $this->load->view('input/add_kelompok_tani');
        $this->load->view('input/footer');
	}



public function remove_pengumuman($id)
	{
		$this->db->where("id",$id);
	
		$this->db->delete("pengumuman");
	
	}
	



	/* pages menu */
	/*categories menu*/
	public function pages()
	{
		$sel['sel'] = "pages";

		$this->load->view('input/header');
        $this->load->view('input/navigation', $sel);
        $this->load->view('input/pages');
        $this->load->view('input/footer');
	}
	public function loadpages()
	{
		$p = $this->input->post('p');
		
		$data['categories'] = $this->input_model->get_pages('', $p, '', 'all');
		$this->load->view('input/ajaxcontent/loadPages', $data);
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

		$data['pages'] = $this->input_model->get_specific_page($i);

		$this->load->view('input/header');
        $this->load->view('input/navigation', $sel);
        $this->load->view('input/pageedit', $data);
        $this->load->view('input/footer');
	}
	function addpage() {
		$sel['sel'] = "pages";

		$this->load->view('input/header');
        $this->load->view('input/navigation', $sel);
        $this->load->view('input/pageadd');
        $this->load->view('input/footer');
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

		$this->load->view('input/header');
        $this->load->view('input/navigation', $sel);
        $this->load->view('input/comments');
        $this->load->view('input/footer');
	}
	public function loadcomments()
	{
		$p = $this->input->post('p');
		
		$data['comments'] = $this->input_model->get_comments('', $p, 'all');
		$this->load->view('input/ajaxcontent/loadComments', $data);
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

		$data['utila'] = $this->input_model->get_users('','','','all');
		$sel['sel'] = "options";

		$this->load->view('input/header');
        $this->load->view('input/navigation', $sel);
        $this->load->view('input/options', $data);
        $this->load->view('input/footer');
	}
	
	/* options menu */
	public function Tampilan()
	{
		$data['users'] = $this->input_model->get_stories();
		$data['utila'] = $this->input_model->get_users('','','','all');
		$sel['sel'] = "options";

		$this->load->view('input/header');
        $this->load->view('input/navigation', $sel);
        $this->load->view('input/tampilan', $data);
        $this->load->view('input/footer');
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
			
			if (!$this->input_model->verifyexists_title($item->title)) {

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

	
}
