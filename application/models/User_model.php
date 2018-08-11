<?php

class User_model extends CI_Model {

  function email_exists($c) {
        $query = $this->db->query("SELECT * FROM users WHERE user_email='".$c."' LIMIT 1");

        if ($query->num_rows() > 0)
        {
           foreach ($query->result() as $row)
           {
              $email = $row->user_email;
           }
           return $email;
        } else {
            return false;
        }
  }
  function slug_exists($c) {
        $query = $this->db->query("SELECT * FROM users WHERE user_slug='".$c."' LIMIT 1");

        if ($query->num_rows() > 0)
        {
           foreach ($query->result() as $row)
           {
              $email = $row->user_slug;
           }
           return $email;
        } else {
            return false;
        }
  }
  function slug_exists_update($c, $e) {
        $query = $this->db->query("SELECT * FROM users WHERE user_slug='".$c."' AND user_email<>'".$e."' LIMIT 1");

        if ($query->num_rows() > 0)
        {
           foreach ($query->result() as $row)
           {
              $email = $row->user_slug;
           }
           return $email;
        } else {
            return false;
        }
  }  
  function avatar_exists($c) {
        $query = $this->db->query("SELECT * FROM users WHERE user_email='".$c."' and user_avatar is null");

        if ($query->num_rows() > 0)
        {
           return false;
        } else {
            return true;
        }
  }
  function insert_code($c) 
	{
        $this->load->helper('string');
        $passgerada = random_string('alnum', 12);
       
	    $data['user_passrecover']=$passgerada;

        $this->db->where('user_email', $c);
        $this->db->update('users', $data);

        return $passgerada;
  }
  function get_user_details($id) {
        $sql = "SELECT * FROM users WHERE user_email='$id' LIMIT 1";
        $query = $this->db->query($sql);
        return $query->result_array();
  }
  function get_rec($us, $ch) 
  {
        $query = $this->db->query("SELECT * FROM users WHERE user_id='".$us."' AND user_passrecover='".$ch."' LIMIT 1");

        if ($query->num_rows() > 0)
        {
            return true;
        } else {
            return false;
        }
  }
  function follow($i)
  {
      $query = $this->db->query("select users.user_id, users.user_name,users.user_lastname,u.user_id,u.user_name,u.user_lastname from users 
inner join follows f on (f.user_id=users.user_id)
inner join users u on (u.user_id=f.follow_id)
where f.follow_id = '".$i."' AND f.user_id = '".$this->session->userdata('userid')."'");

      if ($query->num_rows() > 0)
      {
        return true;
      } else {
        return false;
      }
  }
  function view_points()
  {
      $query = $this->db->query("SELECT SUM(total) AS pontos, vote_userid, users.user_name, users.user_lastname, users.user_avatar, users.user_facebookid, users.user_twitterid, users.user_email
FROM (Select upvote-downvote as total, vote_userid 
from posts_votes) as total_final
LEFT JOIN users ON vote_userid=users.user_id
WHERE total is not null
GROUP BY vote_userid
ORDER BY pontos DESC");


      return $query->result_array();
  }

  public function insert_user($actualizar) 
  {
    $result = $this->db->insert('users', $actualizar);
  $id =  $this->db->insert_id();
    if ($result == 1) {
      return $id;
    } else {
      return FALSE;
    }
  }
  public function update_user($actualizar) 
  {
    $i = $this->session->userdata('userid');
    $this->db->where('user_id', $i);
    $result = $this->db->update('users', $actualizar);
  
    if ($result == 1) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  function get_profile_edit()
  {
    $i = $this->session->userdata('userid');

    $this->db->where('user_id', $i);
    $this->db->limit('1');
    $query = $this->db->get('users');
    return $query->result_array();
  }
  function view_profile($i)
  {
    $this->db->where('user_slug', $i);
    $this->db->limit('1');
    $query = $this->db->get('users');
    return $query->result_array();
  }

  
  function subscriber_exist($email)
  {    
	$query = $this->db->query("SELECT * FROM newsletter_subscribers WHERE email='".$email."' LIMIT 1");
        if ($query->num_rows() > 0)
        {
           return true;
        } else {
            return false;
        }	
  }
  function changed_email($email) 
  {
    $userid = $this->session->userdata('userid');
		$query = $this->db->query("SELECT * FROM users WHERE user_id='".$userid."' AND user_email='".$email."' LIMIT 1");
		if ($query->num_rows() > 0)
    {
      return false;
    } else {
      return true;
    }
  }

  function num_followers($i)
  {    
    $this->db->where('users.user_slug', $i);    
    $this->db->join('users', 'follows.follow_id = users.user_id', 'left');
    $query = $this->db->count_all_results('follows');
    return $query;
  }

  function num_following($i)
  {      
    $this->db->where('users.user_slug', $i);

    $this->db->join('users', 'follows.user_id = users.user_id', 'left');
    $query = $this->db->count_all_results('follows');
    return $query;
  }

  function num_recentposts($i)
  {
    $this->db->where('users.user_slug', $i);
    $this->db->join('users', 'posts.post_by = users.user_id', 'left');
    $query = $this->db->count_all_results('posts');
    return $query;
  }
  function num_favourites($i)
  {
    $this->db->where('users.user_slug', $i);
    $this->db->join('users', 'favourites.user_id = users.user_id', 'left');
    $query = $this->db->count_all_results('favourites');
    return $query;
  }


    
}

?>
