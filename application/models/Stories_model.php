<?php
class Stories_model extends CI_Model {


public function data_kecamatan()
	{
		
		$query = $this->db->get('kecamatan');
	    return $query->result_array(); 
	}
    public function get_stories_feed($limit = NULL)
    {
    	$this->db->order_by("post_date", "desc");
    	$this->db->where('approved', 1);

    	$this->db->join('categories_posts', 'categories_posts.post_id = posts.post_id', 'left');
		$this->db->join('categories', 'categories.id_category = categories_posts.id_category', 'left');
		
    	return $this->db->get('posts', $limit);
    }
	function dosen_terlibat($post) {
		
		$query = $this->db->query("SELECT a.* FROM users a,dosen_terlibat b  WHERE  b.id_post='$post' AND a.user_id=b.id_dosen");
		
		return $query->result_array();
	}
    public function get_stories($offset = null, $search = "", $filter = "Popular", $category = "", $tag = "", $day = "", $qtd = 8, $filterb = "All") 
	{
        $this->db->query('SET SQL_BIG_SELECTS=1'); 
        
		$ui = $this->session->userdata('userid');
		if ($ui == "") $ui = 0;

		$this->db->select('posts.*, users.*, COUNT(posts_votes.vote_id) AS numbervotes, COUNT(posts_views.view_id) AS numberviews, COUNT(post_comments.posts_id) AS numbercomments, categories_posts.post_id as postid,categories.category_slug, categories.category_name, categories.category_color, categories.id_category, favourites.posts_id as favourite'); 
		

		$this->db->join('users', 'posts.post_by = users.user_id', 'left');
		$this->db->join('post_comments', 'posts.post_id = post_comments.posts_id', 'left');
		$this->db->join('posts_votes', 'posts_votes.vote_postid = posts.post_id', 'left');
		$this->db->join('posts_views', 'posts_views.view_postid = posts.post_id', 'left');
		$this->db->order_by("post_date", "desc"); 
		$this->db->join('categories_posts', 'categories_posts.post_id = posts.post_id', 'left');
		$this->db->join('categories', 'categories.id_category = categories_posts.id_category', 'left');

		$this->db->join('posts_tags', 'posts_tags.postid = posts.post_id', 'left');
		$this->db->join('tags', 'tags.id_tag = posts_tags.tagid', 'left');
		
		$this->db->join('favourites', "posts.post_id = favourites.posts_id AND favourites.user_id=$ui", 'left');		

		
		if ($category != "") {
			$this->db->where('categories.category_slug', $category);
		}
		if ($tag != "") {
			$this->db->where('tags.tag_slug', $tag);
		}
		
		

		$this->db->group_by("posts.post_id");		
		
		if ($filter == "Most Recent") {
			$this->db->order_by("post_date", "desc");
		} else if ($filter == "Most Comment") {
			$this->db->order_by("numbercomments", "desc");
		} else if ($filter == "Most Voted") {
			$this->db->order_by("numbervotes", "desc");
		} else if ($filter == "Feed") {
			$c = $this->session->userdata('userid');
			$query = $this->db->query("SELECT * FROM `follows` WHERE user_id='".$c."'");
	        if ($query->num_rows() > 0)
	        {
	           foreach ($query->result() as $row)
	           {
	              $vals[] = $row->follow_id;
	           } 
	        } 
			//$ids = array('20', '15', '22', '46', '86');
			$this->db->where_in('users.user_id', $vals);
		}

		if ($filterb == "Today") {			
			if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") { $this->db->where('DATE_ADD(posts.post_date,INTERVAL 30 DAY) >','NOW()', FALSE); } else { $this->db->where('DATE_ADD(posts.post_date,INTERVAL 24 HOUR) >','NOW()', FALSE); }
		} else if ($filterb == "Yesterday") {
			$this->db->where('DATE_ADD(posts.post_date,INTERVAL 24 HOUR) <','NOW()', FALSE);
			$this->db->where('DATE_ADD(posts.post_date,INTERVAL 48 HOUR) >','NOW()', FALSE);
		} else if ($filterb == "Week") {
			$this->db->where('DATE_ADD(posts.post_date,INTERVAL 7 DAY) >','NOW()', FALSE);
		} else if ($filterb == "Month") {
			$this->db->where('DATE_ADD(posts.post_date,INTERVAL 30 DAY) >','NOW()', FALSE);
		} else if ($filterb == "Year") {
			$this->db->where('DATE_ADD(posts.post_date,INTERVAL 1 YEAR) >','NOW()', FALSE);
		}

		$this->db->order_by("numberviews", "desc");	

		if (strlen($search)>1) {
			$this->db->like('posts.post_subject', $search);
			$this->db->or_like('posts.post_url', $search);	
			$this->db->or_like('categories.category_name', $search);	
			$this->db->or_like('users.user_name', $search);
			$this->db->or_like('users.user_lastname', $search);
			$this->db->or_like('users.user_twittername', $search);					
		}
		
		$this->db->where('posts.approved', 1);

		$query = $this->db->get('posts', $qtd, $offset);
		//$this->output->enable_profiler(TRUE);		
		return $query->result_array();

	}
	
	function insert_dosen($data) {
		$this->db->insert('dosen_terlibat', $data); 
	}
	public function get_trending_posts($num = 5, $category= "")
	{
		$this->db->select('posts.*, COUNT(post_comments.posts_id) AS numbercomments, COUNT(posts_votes.vote_id) AS numbervotes');
		$this->db->join('post_comments', 'posts.post_id = post_comments.posts_id', 'left');
		$this->db->join('posts_votes', 'posts_votes.vote_postid = posts.post_id', 'left');
		$this->db->join('categories_posts', 'categories_posts.post_id = posts.post_id', 'left');
		$this->db->join('categories', 'categories.id_category = categories_posts.id_category', 'left');
		$category = "penelitian";
		if ($category != "") {
			$this->db->where('categories.category_slug', $category);
		}
		
		$this->db->order_by("numbervotes", "desc");
		$this->db->order_by("post_date", "desc");
		$this->db->where('posts.approved', 1);
		$this->db->group_by("posts.post_id");
		$this->db->limit(5);
		$query = $this->db->get('posts');	
		return $query->result_array();
	}
	
	public  function dosen($dosen){
		$query = $this->db->query("SELECT user_name FROM users  WHERE  user_name like '%$dosen%'");
		
		return $query->result_array();
	}
	
	public function get_stories_recents($offset = null, $search = "", $filter = "Popular", $category = "") 
	{        
		$ui = $this->session->userdata('userid');
		if ($ui == "") $ui = 0;

		$this->db->select('posts.*, users.*, COUNT(post_comments.posts_id) AS numbercomments, COUNT(posts_votes.vote_id) AS numbervotes, categories_posts.post_id as postid, categories.category_slug, categories.category_name, categories.id_category, favourites.posts_id as favourite'); 
		

		$this->db->join('users', 'posts.post_by = users.user_id', 'left');
		$this->db->join('post_comments', 'posts.post_id = post_comments.posts_id', 'left');
		$this->db->join('posts_votes', 'posts_votes.vote_postid = posts.post_id', 'left');
		//$this->db->order_by("post_date", "desc"); 
		$this->db->join('categories_posts', 'categories_posts.post_id = posts.post_id', 'left');
		$this->db->join('categories', 'categories.id_category = categories_posts.id_category', 'left');
		
		$this->db->join('favourites', "posts.post_id = favourites.posts_id AND favourites.user_id=$ui", 'left');		

		if ($category != "") {
			$this->db->where('categories.category_slug', $category);
		}

		$this->db->group_by("posts.post_id");		
		
		if ($filter == "Most Recent") {
			$this->db->order_by("post_date", "desc");
		} else if ($filter == "Most Comment") {
			$this->db->order_by("numbercomments", "desc");
		} else {
			$this->db->order_by("numbervotes", "desc");
		} 


		if (strlen($search)>1) {
			$this->db->like('posts.post_subject', $search);
			$this->db->or_like('posts.post_url', $search);	
			$this->db->or_like('categories.category_name', $search);	
			$this->db->or_like('users.user_name', $search);	
			$this->db->or_like('users.user_lastname', $search);
			$this->db->or_like('users.user_twittername', $search);					
		}
		
		$this->db->where('posts.approved', 1);
		$query = $this->db->get('posts', 6, $offset);	
		return $query->result_array();
	}
	function get_top_authors()
	{
		$this->db->select('posts.*, users.*, COUNT(posts.post_by) AS numberposts');
		$this->db->join('users', 'users.user_id = posts.post_by', 'left');
		$this->db->group_by("posts.post_by");
		$this->db->order_by("numberposts", "desc");
		$this->db->where('posts.approved', 1);
		$this->db->limit('6');
		$query = $this->db->get('posts');
		return $query->result_array();
	}
	function get_specific_storie($i)
	{
		$ui = $this->session->userdata('userid');
		if ($ui == "") $ui = 0;

		$this->db->select('posts.*, users.*, categories_posts.post_id as postid, categories.category_name, categories.category_color, categories.category_slug, categories.id_category, favourites.posts_id as favourite');
		$this->db->join('users', 'posts.post_by = users.user_id', 'left');
		/*$this->db->join('post_comments', 'posts.post_id = post_comments.posts_id', 'left');
		$this->db->join('posts_views', 'posts_views.view_postid = posts.post_id', 'left');
		$this->db->join('posts_votes', 'posts_votes.vote_postid = posts.post_id', 'left');*/
		$this->db->join('favourites', "posts.post_id = favourites.posts_id AND favourites.user_id=$ui", 'left');		

		$this->db->join('categories_posts', 'categories_posts.post_id = posts.post_id', 'left');
		$this->db->join('categories', 'categories.id_category = categories_posts.id_category', 'left');

		//$this->db->where('posts.post_id', $i);
		$this->db->where('posts.post_slug', $i);
		//if ($s != "") $this->db->where('posts.post_by', $s);
		$this->db->group_by("posts.post_id");
		$this->db->limit('1');
		$query = $this->db->get('posts');
		//$this->output->enable_profiler(TRUE);
		return $query->result_array();
	}
	function get_auth_post($i, $s)
	{		
		$this->db->where('post_slug', $i);
		$this->db->where('post_by', $s);
		$query = $this->db->get('posts');

		if ($query->num_rows() > 0)
        {
        	return true;
        } else {
        	return false;
        }

	}
	function top1_category_by_cat($cat)
	{
		$query = $this->db->query("SELECT *, count(posts_votes.vote_postid) as numvotes FROM posts LEFT JOIN categories_posts ON ( categories_posts.post_id = posts.post_id )  LEFT JOIN categories ON ( categories.id_category = categories_posts.id_category )  Left join posts_votes on (posts_votes.vote_postid=posts.post_id) WHERE categories.id_category = '".$cat."' group by posts.post_id ORDER BY numvotes DESC LIMIT 1");
		return $query->result_array();
	}
	function get_slider($filter = "")
	{
		$this->load->model('option_model');

		$this->db->select('posts.*, COUNT(posts_votes.vote_id) AS numbervotes, COUNT(posts_views.view_id) AS numberviews, categories_posts.post_id as postid,categories.category_slug, categories.category_name, categories.category_color, categories.id_category'); 

		$this->db->join('categories_posts', 'categories_posts.post_id = posts.post_id', 'left');
		$this->db->join('categories', 'categories.id_category = categories_posts.id_category', 'left');

		//$this->db->join('post_comments', 'posts.post_id = post_comments.posts_id', 'left');
		$this->db->join('posts_votes', 'posts_votes.vote_postid = posts.post_id', 'left');
		$this->db->join('posts_views', 'posts_views.view_postid = posts.post_id', 'left');

		if ($filter == "Recent") {
			$this->db->order_by("post_date", "desc");
		} else if ($filter == "MostComment") {
			$this->db->order_by("numbercomments", "desc");
		} else if ($filter == "Today") {
			$this->db->where('DATE_ADD(posts.post_date,INTERVAL 24 HOUR) >','NOW()', FALSE);
		} else if ($filter == "Yesterday") {
			$this->db->where('DATE_ADD(posts.post_date,INTERVAL 24 HOUR) <','NOW()', FALSE);
			$this->db->where('DATE_ADD(posts.post_date,INTERVAL 48 HOUR) >','NOW()', FALSE);
		} else if ($filter == "Week") {
			$this->db->where('DATE_ADD(posts.post_date,INTERVAL 7 DAY) >','NOW()', FALSE);
		} else if ($filter == "Month") {
			$this->db->where('DATE_ADD(posts.post_date,INTERVAL 30 DAY) >','NOW()', FALSE);
		} else if ($filter == "Year") {
			$this->db->where('DATE_ADD(posts.post_date,INTERVAL 1 YEAR) >','NOW()', FALSE);
		}

		if ($this->option_model->get_value('appslideruser')) {
			$this->db->where('posts.post_by', $this->option_model->get_value('appslideruser'));
		}
		$this->db->where('posts.approved', 1);

		$this->db->group_by("posts.post_id");	

		$num = $this->option_model->get_value('appsliderlimit')*5;
		$query = $this->db->get('posts', $num);		
		//$this->output->enable_profiler(TRUE);	
		return $query->result_array();
	}
	function num_messages()
	{
		$query = $this->db->count_all_results('posts');
		return $query;
	}
	function num_votes($i)
	{
		$this->db->where('vote_postid', $i);
		$query = $this->db->count_all_results('posts_votes');
		return $query;
	}
	function num_upvotes($i)
	{
		$this->db->where('vote_userid', $i);
		$this->db->where('upvote', '1');
		return $this->db->count_all_results('posts_votes');		
	}
	function num_downvotes($i)
	{
		$this->db->where('vote_userid', $i);
		$this->db->where('downvote', '1');
		return $this->db->count_all_results('posts_votes');		
	}
	function num_comments($i)
	{
		$this->db->where('posts_id', $i);
		$query = $this->db->count_all_results('post_comments');
		return $query;
	}
	function num_views($i)
	{
		$this->db->where('view_postid', $i);
		$query = $this->db->count_all_results('posts_views');
		return $query;
	}
	function get_posts($i)
	{
		$this->db->join('users', 'posts.post_by = users.user_id', 'left');
		$this->db->where('post_by', $i);
		$this->db->order_by("posts.post_date", "DESC");
		$query = $this->db->get('posts');
		//$this->output->enable_profiler(TRUE);	
		return $query->result_array();
	}
	public function get_comments($i, $filter)
	{
	    $this->db->select('*, SUM(comments_votes.com_up) AS thumbsup, SUM(comments_votes.com_down) AS thumbsdown');	    
	    $this->db->where('posts_id',$i);
	    $this->db->where('parent_comment_id is null');
	    $this->db->join('users', 'post_comments.users_id = users.user_id', 'left');
	    $this->db->join('comments_votes', 'comments_votes.com_commentid = post_comments.comment_id', 'left');

	    if ($filter == "Popular") {
			$this->db->order_by("thumbsup", "desc");
		} else if ($filter == "Recent") {
			$this->db->order_by("date", "desc");
		} else {
			$this->db->order_by("date", "desc");		
		}

		$this->db->group_by("post_comments.comment_id");

	    $query = $this->db->get('post_comments');
	    //$this->output->enable_profiler(TRUE);
	    return $query->result_array();
	}
	public function get_followers($i) 
	{
		$query = $this->db->query("select users.user_id, users.user_slug, users.user_name,users.user_lastname, users.user_email, users.user_twitterid, users.user_avatar, users.user_facebookid from users 
inner join follows f on (f.user_id=users.user_id)
inner join users u on (u.user_id=f.follow_id)
where f.follow_id = '".$i."'");
		return $query->result_array();
	}
	public function get_following($i) 
	{
		$query = $this->db->query("select users.user_id, u.user_slug, users.user_twitterid, users.user_twittername, users.user_name,users.user_lastname,u.user_id,u.user_name,u.user_lastname, u.user_email, u.user_avatar, u.user_facebookid from users 
inner join follows f on (f.user_id=users.user_id)
inner join users u on (u.user_id=f.follow_id)
where f.user_id = '".$i."'");		
		return $query->result_array();
	}
	public function get_favourites($i) 
	{		
		$ui = $this->session->userdata('userid');
		if ($ui == "") $ui = 0;

		$this->db->select('posts.*, users.*, favourites.posts_id as favourite');
		$this->db->join('users', 'favourites.user_id = users.user_id', 'left');		
		$this->db->join('posts', 'favourites.posts_id = posts.post_id', 'left');
		$this->db->where('favourites.user_id',$i);	 		
		//$this->db->join('favourites', "posts.post_id = favourites.posts_id AND favourites.user_id=$ui", 'left');

		$query = $this->db->get('favourites');
		//$this->output->enable_profiler(TRUE);

		return $query->result_array();
	}
	public function get_comments_replys($i)
	{
	    $this->db->select('*, SUM(comments_votes.com_up) AS thumbsup, SUM(comments_votes.com_down) AS thumbsdown');	     	    
	    $this->db->where('parent_comment_id',$i);	    
	    $this->db->join('users', 'post_comments.users_id = users.user_id', 'left');
	    $this->db->join('comments_votes', 'comments_votes.com_commentid = post_comments.comment_id', 'left');
	    $this->db->group_by("post_comments.comment_id");

	    $query = $this->db->get('post_comments');
	    //$this->output->enable_profiler(TRUE);
	    return $query->result_array(); 
	}
	public function get_categories()
	{
		$this->db->order_by("category_name");
		$query = $this->db->get('categories');
	    return $query->result_array(); 
	}
	public function get_popular_tags()
	{
		$this->db->select('*, COUNT(tag_slug) AS ttags');
		$this->db->limit('15');
		$this->db->where('tag_slug !=', "");
		$this->db->group_by("tag_slug");
		$this->db->order_by("ttags", "desc");
		$query = $this->db->get('tags');
	    return $query->result_array(); 
	}
	public function get_videos_home()
	{
		$this->db->limit('2');
		$this->db->where('approved', 1);
		$this->db->where('post_type', 'video');
		$this->db->order_by("post_date", "desc");
		$query = $this->db->get('posts');
	    return $query->result_array(); 
	}
	function insert_vote($id)
	{		
		$dd['vote_userid'] = $this->session->userdata('userid');
		$dd['vote_postid'] = $id;
		$dd['upvote'] = 1;
		$this->db->set('vote_datetime', 'NOW()', FALSE);

		$query = $this->db->query("SELECT * FROM posts_votes WHERE vote_userid='".$dd['vote_userid']."' AND vote_postid='".$dd['vote_postid']."' LIMIT 1");

        if ($query->num_rows() > 0)
        {
            $this->db->delete('posts_votes', array('vote_postid' => $dd['vote_postid'], 'vote_userid' => $dd['vote_userid']));
            return false;
        } else {
            $result = $this->db->insert('posts_votes', $dd);
            return true;
        }

	}
	function insert_downvote($id)
	{		
		$dd['vote_userid'] = $this->session->userdata('userid');
		$dd['vote_postid'] = $id;
		$dd['downvote'] = 1;
		$this->db->set('vote_datetime', 'NOW()', FALSE);

		$query = $this->db->query("SELECT * FROM posts_votes WHERE vote_userid='".$dd['vote_userid']."' AND vote_postid='".$dd['vote_postid']."' LIMIT 1");

        if ($query->num_rows() > 0)
        {
            $this->db->delete('posts_votes', array('vote_postid' => $dd['vote_postid'], 'vote_userid' => $dd['vote_userid']));
            return false;
        } else {
            $result = $this->db->insert('posts_votes', $dd);
            return true;
        }

	}
	function insert_view($id)
	{		
		$dd['view_userid'] = $this->session->userdata('userid');
		$dd['view_postid'] = $id;		

		$query = $this->db->query("SELECT * FROM posts_views WHERE view_userid='".$dd['view_userid']."' AND view_postid='".$dd['view_postid']."' LIMIT 1");

        if ($query->num_rows() > 0)
        {            
            return false;
        } else {
            $result = $this->db->insert('posts_views', $dd);
            return true;
        }

	}

	function insert_vote_comment_up($id)
	{		
		$dd['com_userid'] = $this->session->userdata('userid');
		$dd['com_commentid'] = $id;

		$query = $this->db->query("SELECT * FROM comments_votes WHERE com_userid='".$dd['com_userid']."' AND com_commentid='".$dd['com_commentid']."' LIMIT 1");

        if ($query->num_rows() > 0)
        {
            $this->db->delete('comments_votes', array('com_commentid' => $dd['com_commentid'], 'com_userid' => $dd['com_userid']));
            return false;
        } else {
            $dd['com_up'] = 1;
            $result = $this->db->insert('comments_votes', $dd);
            return true;
        }
	}
	function insert_vote_comment_down($id)
	{		
		$dd['com_userid'] = $this->session->userdata('userid');
		$dd['com_commentid'] = $id;

		$query = $this->db->query("SELECT * FROM comments_votes WHERE com_userid='".$dd['com_userid']."' AND com_commentid='".$dd['com_commentid']."' LIMIT 1");

        if ($query->num_rows() > 0)
        {
            $this->db->delete('comments_votes', array('com_commentid' => $dd['com_commentid'], 'com_userid' => $dd['com_userid']));
            return false;
        } else {
            $dd['com_down'] = 1;
            $result = $this->db->insert('comments_votes', $dd);
            return true;
        }
	}
	
	function calculartempo($oldTime, $newTime) 
	{
		$timeCalc = strtotime($newTime) - strtotime($oldTime);
		if ($timeCalc > (60*60*24)) {$timeCalc = round($timeCalc/60/60/24) . " hari yang lalu";}
		else if ($timeCalc > (60*60)) {$timeCalc = round($timeCalc/60/60) . " jam yang lalu";}
		else if ($timeCalc > 60) {$timeCalc = round($timeCalc/60) . " detik yang lalu";}
		else if ($timeCalc > 0) {$timeCalc .= " seconds ago";}
		return $timeCalc;
	}
	function favourite($i)
	{
	      $query = $this->db->query("select * from favourites where posts_id = '".$i."' AND user_id = '".$this->session->userdata('userid')."'");

	      if ($query->num_rows() > 0)
	      {
	        return true;
	      } else {
	        return false;
	      }
	}

	function if_voted($i)
	{
	      $query = $this->db->query("select * from posts_votes where vote_postid = '".$i."' AND vote_userid = '".$this->session->userdata('userid')."'");

	      if ($query->num_rows() > 0)
	      {
	        return true;
	      } else {
	        return false;
	      }
	}

	function get_id_by_slug($slug) {
        $query = $this->db->query("SELECT * FROM posts WHERE post_slug='".$slug."' LIMIT 1");

        if ($query->num_rows() > 0)
        {
           foreach ($query->result() as $row)
           {
              $post_id = $row->post_id;
           }
           return $post_id;
        } else {
            return false;
        }
  	}

  	function if_tag_exists($i)
	{
	      $query = $this->db->query("select * from tags where tag_name = '".$i."'");

	      if ($query->num_rows() > 0)
	      {
	        return true;
	      } else {
	        return false;
	      }
	}

	function get_id_by_tag($i) {
        $query = $this->db->query("SELECT * FROM tags WHERE tag_name='".$i."' LIMIT 1");

        if ($query->num_rows() > 0)
        {
           foreach ($query->result() as $row)
           {
              $tag_id = $row->id_tag;
           }
           return $tag_id;
        } else {
            return false;
        }
  	}
  	function get_tags_by_id($id)
  	{
		$this->db->where('posts_tags.postid', $id);
		$this->db->order_by("tags.tag_name", "ASC");
		$this->db->join('tags', 'posts_tags.tagid = tags.id_tag', 'right');
		$query = $this->db->get('posts_tags');		
		return $query->result_array();		
	}
	function get_tags_by_slug($slug)
  	{
		$this->db->join('posts_tags', 'posts_tags.postid = posts.post_id', 'left');
		$this->db->join('tags', 'tags.id_tag = posts_tags.tagid', 'left');
	
		$this->db->where('posts.post_slug', $slug);		
		$query = $this->db->get('posts');

		return $query->result_array();
	}

	function if_post_exists($i)
	{
	      $query = $this->db->query("select * from posts where post_slug = '".$i."'");

	      if ($query->num_rows() > 0)
	      {
	        return true;
	      } else {
	        return false;
	      }
	}

	function if_url_exists($i)
	{
	      $query = $this->db->query("select * from posts where post_url = '".$i."'");

	      if ($query->num_rows() > 0)
	      {
	        return true;
	      } else {
	        return false;
	      }
	}

	function get_related_posts($category)
  	{
		$this->db->where('categories.category_slug', $category);
		$this->db->join('categories_posts', 'categories_posts.post_id = posts.post_id', 'left');
		$this->db->join('categories', 'categories.id_category = categories_posts.id_category', 'left');
		$this->db->limit(3);
		$query = $this->db->get('posts');	
		return $query->result_array();		
	}

	function get_all_posts()
  	{
		
		$this->db->order_by("post_date", "desc");
		$query = $this->db->get('posts');	
		return $query->result_array();		
	}
	
	function dosen2($departemen)
  	{

		
			
	}

	
	function get_category_desc($cat) 
	{
		$query = $this->db->query("SELECT * FROM `categories` WHERE category_slug='".$cat."' LIMIT 1");
		if ($query->num_rows() > 0)
        {
           foreach ($query->result() as $row)
           {
              return $row->category_description;
           }           
        } else {
            return "";
        }
	}
	
}
?>
