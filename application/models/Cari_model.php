<?php
class Cari_model extends CI_Model {


	public function keyword($nama)
	{
		$this->db->select('a.*');
		$this->db->from('keyword a');
		$this->db->where("a.nama='$nama'");
		$query = $this->db->get();
	    return $query->result_array(); 
	}
	
	public function hitung_dokumen()
	{
		
		$this->db->select('count(id)');
		$this->db->from('dokukmen');
	
		$query = $this->db->get();
	    return $query->result_array(); 
	}
	
	public function cari_keyword($nama)
	{	
		$this->db->select('*');
		$this->db->from('keyword a');
		$this->db->join('document_term b', "b.keyword_id=a.id");
		$this->db->where_in("a.nama",$nama);
		$query = $this->db->get();
	    return $query->result_array(); 
	}

	public function kelompok_tani($nama)
	{	
		$this->db->select('a.*,b.nama as nama_gapoktan');
		$this->db->from('kelompok_tani a');
		$this->db->join('gapoktan b', "b.id=a.gapoktan");
		$this->db->like('a.nama', $nama);
		$this->db->limit(10);
		$query = $this->db->get();

	    return $query->result_array(); 
	}

	public function gapoktan($nama)
	{	
		$this->db->select('a.*,b.nama as nama_kecamatan');
		$this->db->from('gapoktan a');
		$this->db->join('kecamatan b', "b.id=a.kecamatan");
		$this->db->like('a.nama', $nama);
			$this->db->limit(10);
		$query = $this->db->get();
	

	    return $query->result_array(); 
	}
	
	public function cari_keyword_group($nama)
	{	
		$this->db->select('b.document_id');
		$this->db->from('keyword a');
		$this->db->join('document_term b', "b.keyword_id=a.id");
		$this->db->where_in("a.nama",$nama);
		$this->db->group_by('b.document_id');
		$query = $this->db->get();
	    return $query->result_array();  
	}
	
	public function tambah_keyword($data){	
		$this->db->insert("keyword",$data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}
	
	public function tambah_term($data){	
		$this->db->insert("document_term",$data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}
	
	
	
}
?>
