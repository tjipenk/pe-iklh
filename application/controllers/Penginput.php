<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Penginput extends CI_Controller {

	private $gapoktan_id;
	private $user_id = "";
	function __construct()
	{
		parent::__construct();
		$this->load->model('backend3/admin_model');
		$this->load->model('stories_model');
		$this->load->model('user_model');
		$this->load->model('dashboard_model');
		$this->this->gapoktan_id = $this->admin_model->gapoktan_id;
		$this->user_id = $this->session->userdata('userid');

		//if (!$this->admin_model->check_admin()) die("Anda harus login dulu");
        
	}
    /* dashboard */
	public function index() 
	{
		redirect('/penginput/dashboard', 'location');
	}
	public function dashboard()
    {
        $sel['sel'] = "dashboard";
        $sel['header'] = "Dashboard";

	   	$data['num_aktivitas']=0;
		$data['num_unit_usaha']=0;
		
		$this->load->view('backend3/header');
        $this->load->view('backend3/navigation', $sel);
        $this->load->view('backend3/dashboard', $data);
        $this->load->view('backend3/footer');
    }

    function tanam(){
    	$this->load->view('backend3/header');
        $this->load->view('backend3/navigation', $sel);
        $this->load->view('backend3/dashboard', $data);
        $this->load->view('backend3/footer');
    }

     function panen(){
    	$this->load->view('backend3/header');
        $this->load->view('backend3/navigation', $sel);
        $this->load->view('backend3/dashboard', $data);
        $this->load->view('backend3/footer');
    }


	function tambah_tanam() {
		$sel['sel'] = "users";
		$sel['header'] = "Tambah tanam";
		$this->load->view('backend3/header');
        $this->load->view('backend3/navigation', $sel);
        $data['komoditas'] = $this->admin_model->komoditas();

        $this->load->view('backend3/tambah_tanam',$data);
        $this->load->view('backend3/footer');
	}

	function tambah_panen() {
		$sel['sel'] = "users";
		$sel['header'] = "Tambah panen";
		$this->load->view('backend3/header');
        $this->load->view('backend3/navigation', $sel);
        $data['komoditas'] = $this->admin_model->komoditas();

        $this->load->view('backend3/tambah_panen',$data);
        $this->load->view('backend3/footer');
	}

	function tambah_tanam_proses() {
		$minggu 	= $this->input->post('minggu');
		$bulan 		= $this->input->post('bulan');
		$tahun		= $this->input->post('tahun');
		$luas		= $this->input->post('luas_panen');
		$komoditas 	= $this->input->post('komoditas');
		$produksi 	= $this->input->post('produksi');
		  // user stored successfully
            
		$data 		=  array(
        	'id_kecamatan'=>1,
        	'minggu'=>$minggu,
        	'bulan'=>$bulan,
        	//'tahun'=>$tahun,
        	'tanggal_input'=>date("Y-m-d"),
        	'luas_tanam'=>$luas,
        	'komoditas'=>$komoditas,
        	'produksi'=>$produksi
        ); 

      

        $this->db->insert('tanam', $data);
		$response["error"] = FALSE;
        echo json_encode($response);
		
		//redirect("penginput/tanam");
              
	}


	function edit_komoditas() {
		$produktivitas 		= $this->input->post('produktivitas');
		$potensi_luas_tanam	= $this->input->post('potensi_luas_tanam');
		$total_panen 		= $this->input->post('total_panen');
		$komoditas 			= $this->input->post('komoditas');
		
		$updated = array("produktivitas"=>$produktivitas,"potensi_luas_tanam"=>$potensi_luas_tanam,"total_panen"=>$total_panen);
		$this->db->where(array("nama"=>$komoditas));
		$this->db->update("komoditas", $updated);
		  
		$response["error"] = FALSE;
        echo json_encode($response);

	}

	function tambah_panen_proses() {
		$minggu 	= 1;
		$bulan 		= $this->input->post('bulan');
		$kecamatan 	= $this->input->post('kecamatan');
		$tahun		= $this->input->post('tahun');
		$komoditas 	= $this->input->post('komoditas');
		$produksi 	= $this->input->post('produksi');
		$tambah_tanam 	= $this->input->post('tambah_tanam');
		$luas_panen 	= $this->input->post('luas_panen');
		$array_bulan =  array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$slug 	= $this->input->post('slug');
		$kecamatanx = $this->admin_model->kecamatan_by_user_slug($slug);
		$id_kecamatan = $kecamatanx[0]['id'];
		$komoditasx = $this->admin_model->komoditas_by_nama(trim($komoditas));
		$id_komoditas = $komoditasx[0]['id'];
		$key = array_search($bulan, $array_bulan);
		$id_bulan = $key +1;

		$data 		=  array(
        	'kecamatan'=>$id_kecamatan,
        	'minggu'=>$minggu,
        	'bulan'=>$id_bulan,
        	'tahun'=>$tahun,
        	'tanggal_input'=>date("Y-m-d"),
        	'komoditas'=>$id_komoditas,
        	'tambah_tanam'=>$tambah_tanam,
        	'luas_panen'=>$luas_panen,
        	'berat'=>$produksi
        ); 

        $this->db->insert('panen', $data);
	
	 $response["error"] = FALSE;
          
            echo json_encode($response);
		//redirect("penginput/tanam");
              
	}

	function tambah_dinamika() {
		$minggu 	= 1;
		$bulan 		= $this->input->post('bulan');
		$kecamatan 	= $this->input->post('kecamatan');
		$tahun		= $this->input->post('tahun');
		$komoditas 	= $this->input->post('komoditas');
		$defisit 	= $this->input->post('defisit');
		$slug 	= $this->input->post('slug');
$jenis_bencana 	= $this->input->post('jenis_bencana');
		$array_bulan =  array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$kecamatanx = $this->admin_model->kecamatan_by_user_slug($slug);
		$id_kecamatan = $kecamatanx[0]['id'];
		$komoditasx = $this->admin_model->komoditas_by_nama(trim($komoditas));
		$id_komoditas = $komoditasx[0]['id'];
		$key = array_search($bulan, $array_bulan);
		$id_bulan = $key +1;

		$data 		=  array(
        	'jenis_bencana'=>$jenis_bencana,
        	'kecamatan'=>$id_kecamatan,
        	'bulan'=>$id_bulan,
        	'tahun'=>$tahun,
        	'komoditas'=>$id_komoditas,
        	'defisit'=>$defisit
        ); 

        $this->db->insert('dinamika_budidaya', $data);
	
	 $response["error"] = FALSE;
          
            echo json_encode($response);
		//redirect("penginput/tanam");
              
	}

	function edit_poktan($id) {
		$sel['sel'] = "users";
		$xx 		= $this->admin_model->profil_poktan($id);
		$data 		= $xx[0];
		
		if($data['gapoktan']==$this->admin_model->gapoktan_id) {
			$sel['header'] = "Edit Poktan";
			$this->load->view('backend3/header');
	        $this->load->view('backend3/navigation', $sel);
	        $this->load->view('backend3/poktan_edit',$data);
	        $this->load->view('backend3/footer');
		} else {
			echo "Ma'af Anda tidak di izinkan";
		}
		

	}

	
	
	
	

	public function load_hibah()
	{

		 
	
		$data['stories'] = $this->admin_model->gethibah($kelompok_tani);

		$this->load->view('backend3/ajaxcontent/load_hibah', $data);
	}

	public function load_unit()
	{

		 
	
		$data['stories'] = $this->admin_model->getunit($kelompok_tani);

		$this->load->view('backend3/ajaxcontent/load_unit', $data);
	}

	public function load_keuangan()
	{

		 
	
		$data['stories'] = $this->admin_model->get_keuangan($kelompok_tani);

		$this->load->view('backend3/ajaxcontent/load_keuangan', $data);
	}

		public function load_kelompok_tani()
	{

		 
	
		$data['stories'] = $this->admin_model->get_kelompok_tani($kelompok_tani);

		$this->load->view('backend3/ajaxcontent/load_kelompok_tani', $data);
	}



	public function load_penghargaan()
	{

		   $kelompok_tani = $this->session->userdata('kelompok_tani');
	
		$data['stories'] = $this->admin_model->getpenghargaan($kelompok_tani);

		$this->load->view('backend3/ajaxcontent/load_penghargaan', $data);
	}

	public function load_galeri()
	{
		$p = $this->input->post('p');
		
		$data['stories'] = $this->admin_model->getkecamatan('', $p, '', 'all');
		
		$this->load->view('backend3/ajaxcontent/load_galeri', $data);
	}
	
	
	public function load_produk()
	{
		$p = $this->input->post('p');
		
		$data['stories'] = $this->admin_model->get_stories(null, "",  "Popular","", "","",8, "All",1);
		$this->load->view('backend3/ajaxcontent/load_produk', $data);
	}
	public function removestory($id)
	{
	
	

		$this->db->where("id",$id);
		$this->db->delete("aktivitas");
		
	

	}
	public function remove_hibah($id)
	{
		$this->db->where("id",$id);
		$this->db->where("user_id",$this->user_id);
		$this->db->delete("hibah");
		$this->update_aset();
		$this->update_aset2();
	}

	public function remove_unit($id)
	{
		$this->db->where("id",$id);
		$this->db->where("gapoktan",$this->admin_model->gapoktan_id);
		$this->db->delete("unit_usaha_gapoktan");
	}

	public function remove_keuangan($id)
	{
		$this->db->where("id",$id);
		$this->db->where("gapoktan",$this->admin_model->gapoktan_id);
		$this->db->delete("keuangan");
	}

	public function remove_poktan($id)
	{
	
	

		$this->db->where("id_user",$id);
		$this->db->delete("kelompok_tani");
		
		$this->db->where("user_id",$id);
		$this->db->delete("users");
		
	

	}
	public function remove_penghargaan($id)
	{
	
	

		$this->db->where("id",$id);
		$this->db->delete("penghargaan");
		
	

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

		$this->load->view('backend3/header');
        $this->load->view('backend3/navigation', $sel);
        $this->load->view('backend3/subscribers');
        $this->load->view('backend3/footer');
	}
	public function loadsubscribers()
	{
		$p = $this->input->post('p');
		
		$data['categories'] = $this->admin_model->get_subscribers('', $p, '', 'all');
		$this->load->view('backend3/ajaxcontent/loadSubscribers', $data);
	}

	/*categories menu*/
	public function categories()
	{
		$sel['sel'] = "categories";

		$this->load->view('backend3/header');
        $this->load->view('backend3/navigation', $sel);
        $this->load->view('backend3/categories');
        $this->load->view('backend3/footer');
	}
	public function loadcategories()
	{
		$p = $this->input->post('p');
		
	$data['categories'] =$this->stories_model->kategori("1");
		$this->load->view('backend3/ajaxcontent/loadCategories', $data);
	}
	public function removecategory()
	{
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;
		$i = $this->input->post('i');
		$this->db->where(array("id_category"=>$i));
		$this->db->delete("categories");
	}
	function addcategory() {
		$sel['sel'] = "categories";

		$this->load->view('backend3/header');
        $this->load->view('backend3/navigation', $sel);
        $this->load->view('backend3/categoriesadd');
        $this->load->view('backend3/footer');
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

		$this->load->view('backend3/header');
        $this->load->view('backend3/navigation', $sel);
        $this->load->view('backend3/categoriesedit', $data);
        $this->load->view('backend3/footer');
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

		$this->load->view('backend3/header');
        $this->load->view('backend3/navigation', $sel);
        $this->load->view('backend3/pages');
        $this->load->view('backend3/footer');
	}
	public function loadpages()
	{
		$p = $this->input->post('p');
		
		$data['categories'] = $this->admin_model->get_pages('', $p, '', 'all');
		$this->load->view('backend3/ajaxcontent/loadPages', $data);
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

		$this->load->view('backend3/header');
        $this->load->view('backend3/navigation', $sel);
        $this->load->view('backend3/pageedit', $data);
        $this->load->view('backend3/footer');
	}
	function addpage() {
		$sel['sel'] = "pages";

		$this->load->view('backend3/header');
        $this->load->view('backend3/navigation', $sel);
        $this->load->view('backend3/pageadd');
        $this->load->view('backend3/footer');
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

		$this->load->view('backend3/header');
        $this->load->view('backend3/navigation', $sel);
        $this->load->view('backend3/comments');
        $this->load->view('backend3/footer');
	}
	public function loadcomments()
	{
		$p = $this->input->post('p');
		
		$data['comments'] = $this->admin_model->get_comments('', $p, 'all');
		$this->load->view('backend3/ajaxcontent/loadComments', $data);
	}
	public function removecomment()
	{
		$i = $this->input->post('i');
		$this->db->where(array("comment_id"=>$i));
		$this->db->delete("post_comments");
	}

	/* options menu */
	public function profil()
	{
	
		$gapoktan = $this->admin_model->gapoktan();
		$data['gapoktan'] = $gapoktan[0];
		$sel['sel'] = "options";
		 $sel['header'] = "Profil";
		 if(isset($_GET['edit'])) {
		 	$data['sukses'] = true;
		 }

		 if(isset($_GET['target'])) {
		 	$data['target'] = $this->input->get('target');
		 } else {
		 	$data['target'] = "umum";
		 }

		$this->load->view('backend3/header');
        $this->load->view('backend3/navigation', $sel);
        $this->load->view('backend3/profil', $data);
        $this->load->view('backend3/footer');
	}
	
	/* options menu */
	public function Tampilan()
	{
		$data['users'] = $this->admin_model->get_stories();
		$data['utila'] = $this->admin_model->get_users('','','','all');
		$sel['sel'] = "options";

		$this->load->view('backend3/header');
        $this->load->view('backend3/navigation', $sel);
        $this->load->view('backend3/tampilan', $data);
        $this->load->view('backend3/footer');
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


    function update_aset() {
		$json = file_get_contents('Jombangkec.js');
		$jsonencode = json_decode($json);
		$desas = $jsonencode->features;
		 $min=1;
		  $max=20;
	
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
			


			 strtolower(str_replace('KECAMATAN','', $out[$x]['properties']['KECAMATAN']))."<br/>";
			 

			$x++;


		}

		$jsonoutput ="var statesData =".json_encode($out);
		file_put_contents("jombang_by_kecamatan.js",$jsonoutput);

	}


	function update_aset2() {
		$json = file_get_contents('Jombang_desa.json');
		$jsonencode = json_decode($json);
		$desas = $jsonencode->features;
		 $min=1;
		  $max=20;
		

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
		

			foreach($data as $aset) {
				
					$out[$x]['properties']['sss'.$aset['barang']] = $aset['jumlah'] + $out[$x]['properties']['sss'.$aset['barang']];
			
			}
		


			 strtolower(str_replace('KECAMATAN','', $out[$x]['properties']['KECAMATAN']))."<br/>";
			 	

			$x++;


		}


		$jsonoutput =json_encode($out);
		file_put_contents("jombang.json",$jsonoutput);
		

		$jsonoutput2 ="var statesData =".json_encode($out);
		file_put_contents("jombang.js",$jsonoutput2);

	}

	
}
