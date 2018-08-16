<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('user_model');
        $this->load->model('stories_model');
         $this->load->model('dashboard_model');
	}


public function daftar($i = "")
    {
if($this->session->userdata('logged_in')) {
     redirect(base_url(), 'location');      
}else {
        $data['active']         = "login";
        
        $this->load->view('header', $data);
            //$this->load->view('navigation');
            $this->load->view('login'); 
                
            
            $this->load->view('footer');
}
            
    }
    public function profile()
    {
        if (!$this->session->userdata('logged_in') == TRUE)
		{
			redirect('stories');
		}
        $data['user'] = $this->user_model->get_profile_edit();
        $sel['sel'] = "users";
        $this->load->view('layout/header');
        $this->load->view('layout/navigation', $sel);
        $this->load->view('pages/profile-edit', $data);
        $this->load->view('layout/footer');

    //    $this->load->view('header');
    //   $this->load->view('navigation');
    //    $this->load->view('pages/profile-edit', $data);
    //   $this->load->view('footer4');
    }
    public function viewprofile($i)
    {
        $data['user'] = $this->user_model->view_profile($i);
        $data['num_followers'] = $this->user_model->num_followers($i);
        $data['num_following'] = $this->user_model->num_following($i);
        $data['num_recentposts'] = $this->user_model->num_recentposts($i);
        $data['num_favourites'] = $this->user_model->num_favourites($i);

        $this->load->view('header3');
        $this->load->view('navigation');
        $this->load->view('pages/profile-view', $data);
        $this->load->view('footer');
    }
    public function vprofile($i)
    {
        $data['user'] = $this->user_model->view_profile($i);
        $data['num_followers'] = $this->user_model->num_followers($i);
        $data['num_following'] = $this->user_model->num_following($i);
        $data['num_recentposts'] = $this->user_model->num_recentposts($i);
        $data['num_favourites'] = $this->user_model->num_favourites($i);
        $data['categories'] = $this->stories_model->get_categories();

        $this->load->view('header3');
        $this->load->view('navigation', $data);
        $this->load->view('pages/profile-view2', $data);
        $this->load->view('footer3');
    }
    public function points()
    {
        $data['user'] = $this->user_model->view_points(); 

        $this->load->view('header');
        $this->load->view('navigation', $data);
        $this->load->view('pages/points', $data);
        $this->load->view('footer');
    }
    function hover($i)
    {
        $data['user'] = $this->user_model->view_profile($i);
        $this->load->view('pages/profile-view-mini', $data);
    }
	public function register()
	{
		$data['kecamatan']    = $this->dashboard_model->data_kecamatan();
 

        $this->load->helper('captcha');
        $random_number = substr(number_format(time() * rand(),0,'',''),0,6);
          $vals = array(
                 'word' => $random_number,
                 'img_path' => './captcha/',
                 'img_url' => base_url().'captcha/',
                 'img_width' => 140,
                 'img_height' => 32,
                 'expiration' => 7200
                );
        $data['captcha'] = create_captcha($vals);
        $this->session->set_userdata('captchaWord',$data['captcha']['word']);

        $this->load->view('header');
	
		$this->load->view('pages/register', $data);
		$this->load->view('footer');
	}
	function registerdata()
    {             


            $name = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('name', TRUE));
            $lastname = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('lastname', TRUE));

             $kecamatan = preg_replace('/[^0-9\-]/', '', $this->input->post('kecamatan', TRUE));


          
            $slug = url_title($this->input->post('slug'),'dash',TRUE);
            $password = $this->input->post('password');
            $password2 = $this->input->post('password2');
            $newsletter = $this->input->post('newsletter');
            $terms = $this->input->post('terms');

            $this->load->helper('captcha');
            $userCaptcha = $this->input->post('userCaptcha');

            $arr['result'] = 'confirm';
            $arr['message'] = '<ul>';

            $datains = array();
            $newsins = array();

            $arr['result'] = 'confirm';
            $arr['message'] = '<ul>';

          
            if (strlen($name) == 0) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('fillname').'</li>';
            }

            if (strlen($lastname) == 0) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('lastname').'</li>';
            }

            if (strlen($slug) == 0) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('slug').'</li>';
            }

        

            if (strlen($password) == 0) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('fillpassword').'</li>';
            }

            if (strlen($password2) == 0) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('fillcpassword').'</li>';
            }

            if (($password) != ($password2)) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('passwordequal').'</li>';
            }

            if ($this->user_model->slug_exists($slug)) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('slugexists').'</li>';
            }

            if ($this->user_model->email_exists($email)) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('emailexists').'</li>';
            }
            

            if ($arr['result'] != 'error') 
            {

				$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
				$passwordins = hash('sha256', $password . $salt); 
				for($round = 0; $round < 65536; $round++){ $passwordins = hash('sha256', $passwordins . $salt); }
		
                $datains['user_name'] = $name;
                $datains['user_slug'] = $slug;
                $datains['user_lastname'] = $lastname;
                //$datains['user_email'] = $email;
                $datains['user_pass'] = $passwordins;
                 $datains['user_level'] = 2;
				$datains['user_salt'] = $salt;
                $datains['kecamatan'] = $kecamatan;
                $datains['user_date'] = date('Y-m-d G:i:s');
                $result = $this->user_model->insert_user($datains);

                redirect("/dashboard/petugas");
                

            

            } else {

            echo json_encode($arr);   
            }

    }


    function edit_user()
    {             


            $name = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('name', TRUE));
            $lastname = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('lastname', TRUE));

             $kecamatan = preg_replace('/[^0-9\-]/', '', $this->input->post('kecamatan', TRUE));

 $id_user = $this->input->post('id_user');
          
            $slug = url_title($this->input->post('slug'),'dash',TRUE);
            $password = $this->input->post('password');
            $password2 = $this->input->post('password2');
            $newsletter = $this->input->post('newsletter');
            


            $datains = array();
            $newsins = array();
            $perbarui_sandi = false;
            $arr['result']  = 'confirm';
            $arr['message'] = '<ul>';

          
            if (strlen($name) == 0) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('fillname').'</li>';
            }

            if (strlen($lastname) == 0) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('lastname').'</li>';
            }

            if (strlen($slug) == 0) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('slug').'</li>';
            }




        if(strlen($password)==0){
            $perbarui_sandi = true;
             if (($password) != ($password2)) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('passwordequal').'</li>';
            }
        }

           

         

            if ($arr['result'] != 'error') 
            {


                if($perbarui_sandi){
                    $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
                    $passwordins = hash('sha256', $password . $salt); 
                    for($round = 0; $round < 65536; $round++){ $passwordins = hash('sha256', $passwordins . $salt); }
                         $datains['user_pass'] = $passwordins;
                      $datains['user_salt'] = $salt;
                }
               
                $datains['user_name'] = $name;
                $datains['user_slug'] = $slug;
                $datains['user_lastname'] = $lastname;
               
           
               
                $datains['kecamatan'] = $kecamatan;
                $this->db->where('user_id', $id_user);
                 $this->db->update('users', $datains);
              
                redirect("/dashboard/petugas");
                

            

            } else {

            echo json_encode($arr);   
            }

    }



    function updatedata()
    {
            if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;  
            if (!$this->session->userdata('logged_in') == TRUE)
			{
				redirect('stories');
			} 
            
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $password2 = $this->input->post('password2');
            $newsletter = $this->input->post('newsletter');
            $website = $this->input->post('website');
            $twitter = $this->input->post('twitter');
            $shortbio = $this->input->post('shortbio');
            $slug = url_title($this->input->post('slug'),'dash',TRUE);

            $name = $this->input->post('name', TRUE);
            $lastname = $this->input->post('lastname', TRUE);

            $arr['result'] = 'confirm';
            $arr['message'] = '<ul>';

            $datains = array();
            $newsins = array();

            $arr['result'] = 'confirm';
            $arr['message'] = '<ul>';

            if (strlen($name) == 0) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('fillname').'</li>';
            }

            if (strlen($lastname) == 0) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('lastname').'</li>';
            }

            if (strlen($slug) == 0) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('slug').'</li>';
            }

            if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('fillemail').'</li>';
            }

            if ($this->user_model->slug_exists_update($slug, $email)) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('slugexists').'</li>';
            }
            
			if (strlen($password) > 0) {
				if (strlen($password2) == 0) {
					$arr['result'] = 'error';
					$arr['message'] .= '<li>'.$this->lang->line('fillpassword').'</li>';
				}
				if (($password) != ($password2)) {
					$arr['result'] = 'error';
					$arr['message'] .= '<li>'.$this->lang->line('passwordequal').'</li>';
				}
            }

            if ($this->user_model->changed_email($email)) 
			{
				if ($this->user_model->email_exists($email)) {
					$arr['result'] = 'error';
					$arr['message'] .= '<li>'.$this->lang->line('emailexists').'</li>';
				}
			}

            if ($arr['result'] != 'error') 
            {

                //edit avatar
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
                            if (file_exists("images/avatar/" . $_FILES["file"]["name"])) 
                            {
                                $arr['result'] = 'erro';
                                $arr['message'] .= '<li>Image already exist.</li>';
                            } else {
                                $sourcePath = $_FILES['file']['tmp_name'];
                                $nameFile   =   time() . "_" . $slug;
                                $targetPath = "images/avatar/".$nameFile;
                                move_uploaded_file($sourcePath,$targetPath);
                                $datains['user_avatar'] = $nameFile;
                                
                                //resize
                                $this->load->library('image_lib');
                                $config['image_library'] = 'gd2';
                                $config['source_image'] = $targetPath;
                                $config['create_thumb'] = FALSE;
                                $config['maintain_ratio'] = FALSE;
                                $config['width'] = 300;
                                $config['height'] = 300;

                                $this->image_lib->clear();
                                $this->image_lib->initialize($config);
                                $this->image_lib->resize();
                                
                            }
                        }
                    } else {
                        $arr['result'] = 'error';
                        $arr['message'] .= '<li>'.$this->lang->line('invalidextension').'</li>';
                    }       
                }



                if (strlen($password) > 0) {
					$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
					$passwordins = hash('sha256', $password . $salt); 
					for($round = 0; $round < 65536; $round++){ $passwordins = hash('sha256', $passwordins . $salt); }
					$datains['user_pass'] = $passwordins;
					$datains['user_salt'] = $salt;
				}
        
                $datains['user_name'] = $name;
                $datains['user_slug'] = $slug;
                $datains['user_lastname'] = $lastname;
                $datains['user_email'] = $email;
                $datains['user_website'] = $website;
                $datains['user_twitter'] = $twitter;
                $datains['user_gplus'] = $this->input->post('gplus');
                $datains['user_fb'] = $this->input->post('fb');
                $datains['user_instagram'] = $this->input->post('instagram');
                $datains['user_pinterest'] = $this->input->post('pinterest');
                $datains['shortbio'] = $shortbio;
                $datains['user_date'] = date('Y-m-d G:i:s');
                $result = $this->user_model->update_user($datains);

                $idlogin = $this->session->userdata('userid');
                //$this->session->sess_destroy();

                if (strlen($_FILES["file"]["name"]) > 1)  {                    
                } else {
                   $nameFile = $this->session->userdata('avatar');
                }

                $data = array(
                   'userid'  => $idlogin,
                   'nome'  => $name." ".$lastname,
                   'email'  => $email,
                   'avatar' => $nameFile,             
                   'logged_in'  => TRUE
                );
            
                $this->session->set_userdata($data);   
				
				
                if ($newsletter == "on")
                {
                    $newsins['firstname'] = $name;
                    $newsins['lastname'] = $lastname;
                    $newsins['email'] = $email;
					
					if ($this->user_model->subscriber_exist($email)) {
						$this->db->update('newsletter_subscribers', $newsins);
					} else {
						$this->db->insert('newsletter_subscribers', $newsins);
					}
                } else {
					$this->db->where('email', $email);
					$this->db->delete('newsletter_subscribers'); 
				}

                if ($result === TRUE) {

                    $arr['result'] = 'confirm';
                    $arr['message'] .= $this->lang->line('profilesuccess');

                } else {
                    
                    $arr['result'] = 'error';
                    $arr['message'] .= $this->lang->line('errortryagain');

                }

            }

            echo json_encode($arr);   
    }
    function follow()
    {
                $id = $this->input->post('id');
                
                if ($this->user_model->follow($id)) {
                    $this->db->where(array("user_id"=>$this->session->userdata('userid'), "follow_id" => $id));
                    $this->db->delete("follows");
                    $arr['ant'] = 'btnfollowing';
                    $arr['dep'] = 'btnfollow';
                    $arr['message'] = 'Follow';  
                } else {
                    $data = array(
                       'user_id'  => $this->session->userdata('userid'),
                       'follow_id'  => $id
                    );
                    $result = $this->db->insert('follows', $data);
                    $arr['ant'] = 'btnfollow';
                    $arr['dep'] = 'btnfollowing';
                    $arr['message'] = 'Following';
                }

                echo json_encode($arr);
    }
    
    function password_recovery()
    {
        $data['categories'] = $this->stories_model->get_categories();

        $this->load->view('header');
        $this->load->view('navigation', $data);
        $this->load->view('pages/password_recovery');
        $this->load->view('footer');
    }

    //send a recovery email with link
    function send_recovery_email()
    {
        if (!$this->input->post('p')) {
            show_error('Error found', 500);
        }

        if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") { $arr['result'] = 'error'; $arr['message'] = "This function is disabled on live demo. Thank you! "; echo json_encode($arr); return false; }

        $email = $this->input->post('email', TRUE);

        if (trim($email)) {

            $email = $this->user_model->email_exists($email);

            if ($email) 
            {
                $cod3 = $this->user_model->insert_code($email);

                $contact = $this->user_model->get_user_details($email);
                $data['contact']=$contact;
                
				$config = Array(
				  'protocol' => 'smtp',
				  'smtp_host' => $this->option_model->get_value('appmailserver_url'),
				  'smtp_port' => $this->option_model->get_value('appmailserver_port'),
				  'smtp_user' => $this->option_model->get_value('appmailserver_login'),
				  'smtp_pass' => $this->option_model->get_value('appmailserver_pass'),
				  'mailtype' => 'html',
				  'charset' => 'iso-8859-1',
				  'wordwrap' => TRUE
				);

                $this->load->library('email', $config);
				$this->email->from($this->option_model->get_value('appmailserver_login'));
				$this->email->to($email);
				$this->email->subject('Recovery password');
				$message = $this->load->view('emails/login_password_recovery', $data, true);
				$this->email->message($message);
				
				if($this->email->send())
				{
					$arr['result'] = 'confirm';
					$arr['message'] = $this->lang->line('verifyemail');
				}
				else
				{
					$arr['result'] = 'error';
					$arr['message'] = $this->email->print_debugger();
				}
				
            } else {
                $arr['result'] = 'error';
                $arr['message'] = $this->lang->line('emailnotfound');
            }
        } else {
            $arr['result'] = 'error';
            $arr['message'] = $this->lang->line('fillemail');
        }
        
		echo json_encode($arr);    
	}

	function recmail($use, $cha)
    {
            $v = $this->user_model->get_rec($use, $cha);

            $da['user'] = $use;
            $da['code'] = $cha;

            if ($v) 
            {			
				$this->load->view('header');
				$this->load->view('navigation');
				$this->load->view('pages/password_recovery_final', $da);
				$this->load->view('footer');
            }
    }
	
	function recovery_save_newpassword()
    {
            if (!$this->input->post('p')) {
                    show_error('Error.', 500);
            }

            
            $npassword = $this->input->post('password');
            $key = $this->input->post('k');

            $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
			$passwordins = hash('sha256', $npassword . $salt); 
			for($round = 0; $round < 65536; $round++){ $passwordins = hash('sha256', $passwordins . $salt); }
											
                        $data = array(
                            'user_pass' => $passwordins,
							'user_salt' => $salt,
                            'user_passrecover' => ''
                        );

                        $this->db->where('user_passrecover', $key);
                        $this->db->update('users', $data);

                        $arr['result'] = 'confirm';
                        $arr['message'] = $this->lang->line('passwordsucess');
                
                echo json_encode($arr);
    }
    function reportcontent()
    {
        if (!$this->session->userdata('logged_in') == TRUE){redirect('stories');}

        $desc=$this->input->post('desc');
        $postid=$this->input->post('postid');
        $datains = array();

        $arr['result'] = 'confirm';
        $arr['message'] = '<ul>';

        if (strlen($desc) == 0) {
            $arr['result'] = 'error';
            $arr['message'] .= '<li>'.$this->lang->line('fill_textreport').'</li>';
        }

        if ($arr['result'] != 'error') 
        {          
            $datains['posts_id'] = $postid;
            $datains['user_id'] = $this->session->userdata('userid');
            $datains['desc'] = $desc;
            $datains['date'] = date('Y-m-d G:i:s');
            if ($_SERVER['SERVER_NAME'] != "labs.psilva.pt") {
            $result = $this->db->insert('reports', $datains);
            }

            $arr['result'] = 'confirm';
            $arr['message'] = $this->lang->line('fill_textsuccess');
        }
        echo json_encode($arr); 
    }
	
}
