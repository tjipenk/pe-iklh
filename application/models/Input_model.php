<?php

class Input_model extends CI_Model 
{
	public function check_user() {
        
        $c = $this->session->userdata('userid');
        $query = $this->db->query("SELECT * FROM users WHERE user_id='".$c."' AND user_level='2' LIMIT 1");

        if ($query->num_rows() > 0)
        {
           return true;
        } else {
            return false;
        }
    }	


	public function get_users($offset = null, $search = "", $filter = "Popular", $all = "") 
	{
		$this->db->order_by("user_name", "desc");			
		
		if (strlen($search)>1) {
			$this->db->like('user_name', $search);			
		}
			$this->db->where('user_level', 2);
		if ($all == "all") { $query = $this->db->get('users'); } else { $query = $this->db->get('users', 10, $offset); }
		return $query->result_array();

	}

	public function get_lokasi_sungai($offset = null, $search = "", $filter = "Popular", $all = "") 
	{
		$this->db->order_by("kode_sungai", "desc");			
		
		if (strlen($search)>1) {
			$this->db->like('lokasi', $search);			
		}
			#$this->db->where('user_level', 0);
			
		if ($all == "all") { $query = $this->db->get('tbl_sungai'); } else { $query = $this->db->get('tbl_sungai', 10, $offset); }
		return $query->result_array();

	}

	function get_specific_user($i) {
		$this->db->where('user_id', $i);			
		$query = $this->db->get('users');
		return $query->result_array();
	}

	function get_specific_sungai($i) {
		$this->db->where('id_sungai', $i);			
		$query = $this->db->get('tbl_sungai');
		return $query->result_array();
	}

	function get_nama_wilayah($i) {
		$this->db->where('kode', $i);
		$this->db->select('nama');			
		$query = $this->db->get('wilayah');
		return $query->result_array();
	}

	public function data_kabupaten()
	{
		$query = $this->db->query("SELECT kode as id_kab, LEFT(kode,2) as id_prov, nama as kab FROM `wilayah` WHERE LENGTH(kode)>2");
	    return $query->result_array(); 
	}

	public function data_provinsi()
	{
		$query = $this->db->query("SELECT kode as id_prov, nama as prov FROM `wilayah` WHERE LENGTH(kode)<=2");
	    return $query->result_array(); 
	}

	
    function get_num_users() 
	{		
		return $this->db->count_all_results('users');
	}

	function get_num_pengumuman() 
	{		
		return $this->db->count_all_results('pengumuman');
	}

	function get_num_kelompok_tani() 
	{		
		$this->db->where('user_level', 0);
		return $this->db->count_all_results('users');
	}

	public function stat_hibah()
	{
		$this->db->select('jumlah');
		$query = $this->db->get('hibah');
		$jumlah = 0;
	    $data =  $query->result_array(); 
	    foreach ($data as $key => $value) {
	    	$jumlah= $jumlah  + $value['jumlah'];
	    }
	    return $jumlah;
	}

	function stat_aktivitas() 
	{		
		
		return $this->db->count_all_results('aktivitas');
	}
	function get_num_gapoktan() 
	{		
		$this->db->where('user_level', 2);
		return $this->db->count_all_results('users');
	}
	function get_num_stories() 
	{		
		return $this->db->count_all_results('posts');
	}
	function get_num_comments() 
	{		
		return $this->db->count_all_results('post_comments');
	}
	function get_num_subscribers() 
	{		
		
	}

	function get_recent_stories()
    {    
    	$this->db->order_by("post_date", "desc");    	
    	$query = $this->db->get('posts', 20);		
		return $query->result_array();
    }

    function get_recent_comments()
    {
    	$this->db->order_by("date", "desc");
    	$this->db->join('posts', 'post_comments.posts_id = posts.post_id', 'left');
    	$this->db->join('users', 'posts.post_by = users.user_id', 'left');
    	$query = $this->db->get('post_comments', 20);

		return $query->result_array();
    }

    function get_recent_users()
    {
    	$this->db->order_by("user_date", "desc");    	
    	$query = $this->db->get('users', 20);

		return $query->result_array();
    }

	function pengumuman() {
		$this->db->select('*');
		$this->db->from('pengumuman');
		$query = $this->db->get();
		 return $query->result_array();
	}


    
}

?>
