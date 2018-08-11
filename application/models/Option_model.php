<?php
class Option_model extends CI_Model {

    private $data;

    function __construct()
	{
	   parent::__construct();
	   
	   $query = $this->db->get('options');	  
	   foreach ($query->result() as $row)
       {
            $this->data[$row->option_name] = "$row->option_value";
       }
       $query->free_result();
	}

	function get_value($key){
        return $this->data[$key];
  }
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

}
?>
