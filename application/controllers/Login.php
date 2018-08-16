<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->load->model('login_model');
 }

 function index()
 {
    if ($this->session->userdata('logged_in') == TRUE)
    {
        redirect('stories');
    }
    $item['atual'] = "";
    
    $this->load->view('admin/header', $item);
    $this->load->view('admin/login/login');
    $this->load->view('admin/footer');
 }

 function processlogin()
 {
        $username = $this->input->post('username', TRUE);
        $password  = $this->input->post('password', TRUE);
           
        $arr['result'] = 'error';
        $arr['message'] = '<ul>';

        if ((strlen($username) == 0) || (strlen($password) == 0))  {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('fill_login').'</li>';
                echo json_encode($arr);
                return false;
        } else {

            $this->db->where('user_slug', $username);
           
           // $this->db->where('user_level', 1);
            $query = $this->db->get_where('users');
			
			// print_r($this->db->last_query());
			// print_r($query->row_array());
			// die();
	    
            if ($query->num_rows() > 0) {
            
                $row = $query->row_array();
                $salt = $row['user_salt'];

				$check_password = hash('sha256', $password . $salt); 
				for($round = 0; $round < 65536; $round++){
					$check_password = hash('sha256', $check_password . $salt);
				}
				
				if($check_password != $row['user_pass'])
				{
                    $arr['result'] = 'error';
                    $arr['message'] .= '<li>'. $this->lang->line('email_pass_invalid') .'</li>';
                    echo json_encode($arr);
                    return false;
                }

                $data = array(
                   'userid'  => $row['user_id'],
                   'userslug'  => $row['user_slug'],
                   'nome'  => $row['user_name']." ".$row['user_lastname'],
				   'email'  => $row['user_email'],
				   'provinsi'  => $row['provinsi'],
				   'kabupaten'  => $row['kabupaten'],
                   'avatar'  => $row['user_avatar'],
				   'level'  => $row['user_level'],
                   'logged_in'  => TRUE
                );
	
                $this->session->set_userdata($data); 

                    switch($data['level']){
                        case 1:
                        redirect('/admin/');

                        case 2:
                        redirect('/input/');

                        case 3:
                        redirect('/admin_prov/');

                        case 4:
                        redirect('/lap_prov/');
                        
                        default: 
                        redirect('/');
                        
                    }
		
                
                $arr['result'] = 'confirm';
                $arr['message'] .= '';
                echo json_encode($arr);
                return false;

            } else {
                    $arr['result'] = 'error';
                    $arr['message'] .= '<li>'.$this->lang->line('email_pass_invalid').'</li>';
                    echo json_encode($arr);
                    $this->load->view('header', $data);
            //$this->load->view('navigation');
            $this->load->view('gagal_login'); 
                
            
            $this->load->view('footer');
                    return false;
            }
	    }
	    	  
	}

    function processlogin2()
 {
         $username = $this->input->post('email', TRUE);
        $password  = $this->input->post('password', TRUE);
           
        $arr['result'] = 'error';
        $arr['message'] = '<ul>';

        if ((strlen($username) == 0) || (strlen($password) == 0))  {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('fill_login').'</li>';
                echo json_encode($arr);
                return false;
        } else {

            $this->db->where('user_slug', $username);
            
            $query = $this->db->get_where('users');
        
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

                    
                
                $arr['result'] = 'confirm';
                $arr['message'] .= '';
                 $response["error"] = FALSE;
                $response["uid"] =  $row['user_id'];
                $response["user"]["name"] = $row['user_name'];
                $response["user"]["email"] = $row['user_slug'];
                $response["user"]["created_at"] = $row['user_date'];
                $response["user"]["updated_at"] = $row['user_date'];
                echo json_encode($response);
                return;
                      

            } else {
                    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters email or password is missing!";
    echo json_encode($response);
            }
        }
              
    }

	
	function see_session(){
		print_r($this->session->userdata());
	}
    

	function logout()
    {
        $this->session->sess_destroy();
        redirect('stories');
    }

	
}

?>