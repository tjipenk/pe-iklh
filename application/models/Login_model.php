<?php

class Login_model extends CI_Model {

	function inserir_logintry_failed()
    {
		$noh = date('Y-m-d G:i:s');
        $ip = $this->input->ip_address();
        $query = $this->db->query("SELECT * FROM acessos_temp WHERE ip='".$ip."' LIMIT 1");

        if ($query->num_rows() > 0)
        {

            $this->db->set('tentativas', 'tentativas+1', FALSE);
            $this->db->set('lastlogin', $noh);
            $this->db->where('ip', $ip);
            $this->db->update('acessos_temp');

        } else {

            $data_inse = array(
                'lastlogin' => $noh,
                'ip' => $ip,
                'tentativas' => '1'
            );
            $this->db->insert('acessos_temp', $data_inse);			
        }
    }
	
	function limpar_entrou()
    {        
        $ip = $this->input->ip_address();
        $this->db->delete('acessos_temp', array('ip' => $ip));
    }
	
	function ver_tempo_loginfailed()
    {
        $noh = date('Y-m-d G:i:s');
        $ip = $this->input->ip_address();
        $query = $this->db->query("SELECT *, DATE_ADD(lastlogin, INTERVAL 30 MINUTE) AS data_comp FROM `acessos_temp` WHERE ip='".$ip."' AND tentativas='3'");

        if ($query->num_rows() > 0)
        {
           foreach ($query->result() as $row)
           {
              $ace = $row->data_comp;
           }
           if ($noh < $ace) { return true; } else { return false; }
        } else {
            return false;
        }
    }
    function user_exists($id, $email) 
    {
        $query = $this->db->query("SELECT * FROM `users` WHERE user_email='".$email."' AND user_facebookid='".$id."'");

        if ($query->num_rows() > 0)
        {
           return true;
        } else {
            return false;
        }
    }
    function user_exists_twitter($id) 
    {
        $query = $this->db->query("SELECT * FROM `users` WHERE user_twitterid='".$id."'");

        if ($query->num_rows() > 0)
        {
           return true;
        } else {
            return false;
        }
    }


    
}

?>
