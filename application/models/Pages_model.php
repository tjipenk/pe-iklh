<?php
class Pages_model extends CI_Model {

	function get_specific_page($i)
	{
		$this->db->where('title_slug', $i);
		$this->db->limit('1');
		$query = $this->db->get('pages');
		return $query->result_array();
	}
	function get_all_pages()
	{
		$query = $this->db->get('pages');
		return $query->result_array();
	}	
		
}
?>
