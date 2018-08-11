<?php

class Rssfeeds_model extends CI_Model 
{
	public function check_admin() {
        
        $c = $this->session->userdata('userid');
        $query = $this->db->query("SELECT * FROM users WHERE user_id='".$c."' AND user_level='1' LIMIT 1");

        if ($query->num_rows() > 0)
        {
           return true;
        } else {
            return false;
        }
    }	
	public function get_feeds() 
	{
		
		$query = $this->db->get('feed_source');
		return $query->result_array();
	}
    function get_feed_specific($id)
    {
        $this->db->where('id_feed', $id);
        $query = $this->db->get('feed_source');
        return $query->result_array();
    }
    public function verifyexists_title($i) 
    {        
        $query = $this->db->query("SELECT * FROM posts WHERE post_slug='".$i."'");

        if ($query->num_rows() > 0)
        {
           return true;
        } else {
            return false;
        }
    }
    public function get_categories()
    {
        $this->db->order_by("category_name");
        $query = $this->db->get('categories');
        return $query->result_array(); 
    }
 
}

?>
