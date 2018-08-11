<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stories extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('stories_model');
		$this->load->model('option_model');		
		require_once APPPATH.'libraries/facebook/facebook.php';
	}

	public function index()
	{
		
		$data = array();
		$data['active'] 		= "home";
		$this->load->view('header', $data);
		$this->load->view('depan', $data);
			$this->load->view('footer');
			
	}
	
	

	public function daftar($i = "")
		{
		if($this->session->userdata('logged_in')) {
			 redirect(base_url(), 'location');		
		}else {
				$data['active'] 		= "login";
				
				$this->load->view('header', $data);
					//$this->load->view('navigation');
					$this->load->view('stories_depan');	
						
					
					$this->load->view('footer');
		}
			
	}
	
	public function layout($i)
	{
			$data['num_messages'] = $this->stories_model->num_messages();
			$data['stories'] = $this->stories_model->get_stories();			
			$data['tags'] = $this->stories_model->get_popular_tags();
			$data['videos'] = $this->stories_model->get_videos_home();
			$data['categories'] = $this->stories_model->get_categories();
			$data['authors'] = $this->stories_model->get_top_authors();

			$this->load->view('header');			
			
			$data['nav'] = 1;
			$data['layout'] = $i;				
			$this->load->view('navigation', $data);
			$this->load->view('pages/stories_layout'.$i, $data);			

			$this->load->view('footer');
	}
	public function loadStories_layouts($offset, $layout)
	{
		$search = $this->input->post('search');
		$filtera = $this->input->post('filtera');
		$filterb = $this->input->post('filterb');
		$category = $this->input->post('category');
		$tag = $this->input->post('tag');
		$show = $this->input->post('show');
		$qtd = $this->input->post('qtd');

		$data['numposts'] = $offset;
		$data['stories'] = $this->stories_model->get_stories($offset, $search, $filtera, $category, $tag, $day, $qtd, $filterb);
		$this->load->view('ajaxcontent/stories_layout'.$layout, $data);
	}

	public function article($i = "")
	{
		$data['menu'] = "cerita";
		if ($i == "") {
			$data['num_messages'] = $this->stories_model->num_messages();
			$data['stories'] = $this->stories_model->get_stories();
			$data['categories'] = $this->stories_model->get_categories();			

			$this->load->view('header');
			//$this->load->view('navigation', $data);
			$this->load->view('pages/stories2', $data);
			$this->load->view('footer');
		} else {

			$data['categories'] = $this->stories_model->get_categories();
			$data['tags'] = $this->stories_model->get_popular_tags();
			$this->load->model('poll_model');

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

			$data['stories'] = $this->stories_model->get_specific_storie($i);
			$data['storyid'] = $this->stories_model->get_id_by_slug($i);

			$this->load->view('header', $data);
			//$this->load->view('navigation', $data);
			$this->load->view('pages/stories-single2', $data);
			$this->load->view('footer');

		}
	}
	public function ext($i = "")
	{
		$data['stories'] = $this->stories_model->get_specific_storie($i);
		$data['categories'] = $this->stories_model->get_categories();
		$data['iframe'] = "y";
		$this->load->view('header', $data);
		$this->load->view('navigation', $data);
		$this->load->view('pages/iframe', $data);
	}
	public function category($i = "")
	{
		$data['num_messages'] = $this->stories_model->num_messages();
		$data['stories'] = $this->stories_model->get_stories();
		$data['categories'] = $this->stories_model->get_categories();
		$data['authors'] = $this->stories_model->get_top_authors();
		$data['tags'] = $this->stories_model->get_popular_tags();
		$data['nav'] = 1;
		$data['category'] = $i;
		$data['pagetitle'] = ucfirst($i);


		$this->load->view('header3', $data);
		$this->load->view('navigation', $data);
		$l = $this->option_model->get_value('applayout');
		$data['layout'] = $l;

		$this->load->view('pages/stories_layout'.$l, $data);
		
		$this->load->view('footer3');
	}
	
	public function dosen($i = "")
	{
		$data['num_messages'] = $this->stories_model->num_messages();
		$data['stories'] = $this->stories_model->get_stories();
		$data['categories'] = $this->stories_model->get_categories();
		$data['authors'] = $this->stories_model->get_top_authors();
		$data['tags'] = $this->stories_model->get_popular_tags();
		$data['nav'] = 1;
		$data['category'] = $i;
		$data['pagetitle'] = ucfirst($i);


		$this->load->view('header', $data);
		$this->load->view('navigation', $data);
		$l = $this->option_model->get_value('applayout');
		$data['layout'] = $l;

		$this->load->view('pages/stories_layout'.$l, $data);
		
		$this->load->view('footer');
	}
	
	public function tag($i = "")
	{
		$data['num_messages'] = $this->stories_model->num_messages();
		$data['stories'] = $this->stories_model->get_stories();
		$data['categories'] = $this->stories_model->get_categories();
		$data['authors'] = $this->stories_model->get_top_authors();
		$data['tags'] = $this->stories_model->get_popular_tags();
		$data['nav'] = 1;
		$data['tag'] = $i;

		$this->load->view('header', $data);
		$this->load->view('navigation', $data);
		$l = $this->option_model->get_value('applayout');
		$data['layout'] = $l;

		$this->load->view('pages/stories_layout'.$l, $data);
		$this->load->view('footer');
	}
	public function loadStories2($offset, $day = "")
	{
		$search = $this->input->post('search');
		$filtera = $this->input->post('filtera');
		$category = $this->input->post('category');
		$tag = $this->input->post('tag');
		$show = $this->input->post('show');
		$qtd = $this->input->post('qtd');

		$data['stories'] = $this->stories_model->get_stories($offset, $search, $filtera, $category, $tag, $day, $qtd);
		if ($show == "list") { $this->load->view('ajaxcontent/stories_list', $data); } else { $this->load->view('ajaxcontent/stories2', $data); }
	}

	public function loadStories_masonry($offset, $day = "")
	{
		$search = $this->input->post('search');
		$filtera = $this->input->post('filtera');
		$filterb = $this->input->post('filterb');
		$category = $this->input->post('category');
		$tag = $this->input->post('tag');
		$show = $this->input->post('show');
		$qtd = $this->input->post('qtd');

		$data['numposts'] = $offset;
		$data['stories'] = $this->stories_model->get_stories($offset, $search, $filtera, $category, $tag, $day, $qtd, $filterb);
		$this->load->view('ajaxcontent/stories_masonry', $data);
	}



	public function loadrecent($offset)
	{
		$search = $this->input->post('search');
		$filtera = $this->input->post('filtera');
		$category = $this->input->post('category');

		$data['stories'] = $this->stories_model->get_stories_recents($offset, $search, $filtera, $category);
		$this->load->view('ajaxcontent/stories_grid', $data);
	}
	public function loadTopAuthors()
	{
		$data['stories'] = $this->stories_model->get_top_authors();
		$this->load->view('ajaxcontent/authors_top', $data);
	}	
	public function loadStories($offset)
	{
		$search = $this->input->post('search');
		$filtera = $this->input->post('filtera');
		$category = $this->input->post('category');

		$data['stories'] = $this->stories_model->get_stories($offset, $search, $filtera, $category);
		$this->load->view('ajaxcontent/stories', $data);
	}
	public function r($i)
	{
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

		$data['stories'] = $this->stories_model->get_specific_storie($i);
		
		$data['storyid'] = $i;
		$this->load->view('header');
		$this->load->view('navigation');
		$this->load->view('pages/stories-single', $data);
		$this->load->view('footer');
	}
	public function removestory()
	{
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") { $arr['result'] = 'confirm'; $arr['message'] = 'ok';  echo json_encode($arr); return false; }
		$id = $this->input->post('id');		
		$this->db->where(array("post_id"=>$id, "post_by" => $this->session->userdata('userid')));
		$this->db->delete("posts");

		//remove comment
		$this->db->where(array("posts_id"=>$id));
		$this->db->delete("post_comments");

		//remove associ category
		$this->db->where(array("post_id"=>$id));
		$this->db->delete("categories_posts");

		$arr['result'] = 'confirm';
        $arr['message'] = 'Deleted';
        echo json_encode($arr);
	}	
	public function removecomment()
	{
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") { $arr['result'] = 'confirm'; $arr['message'] = 'ok';  echo json_encode($arr); return false; }
		$id = $this->input->post('id');
		$this->db->where(array("comment_id"=>$id));
		$this->db->delete("post_comments");

		$this->db->where(array("parent_comment_id"=>$id));
		$this->db->delete("post_comments");

		$arr['result'] = 'confirm';
        $arr['message'] = 'Deleted';
        echo json_encode($arr);
	}
	public function removereply()
	{
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") { $arr['result'] = 'confirm'; $arr['message'] = 'ok';  echo json_encode($arr); return false; }
		$id = $this->input->post('id');
		$this->db->where(array("comment_id"=>$id));
		$this->db->delete("post_comments");

		$arr['result'] = 'confirm';
        $arr['message'] = 'Deleted';
        echo json_encode($arr);
	}
	public function get_comments($i)
	{
		$filtera = $this->input->post('filtera');
		$data['stories'] = $this->stories_model->get_comments($i, $filtera);
		$data['postid'] = $i; 

		$this->load->view('ajaxcontent/comments', $data);
	}
	public function get_posts($i)
	{
		$data['stories'] = $this->stories_model->get_posts($i);
		$this->load->view('ajaxcontent/stories-single-profile', $data);
	}
	public function get_posts2($i)
	{
		$data['stories'] = $this->stories_model->get_posts($i);
		$this->load->view('ajaxcontent/stories-single-profile2', $data);
	}
	public function followers($i)
	{
		$data['stories'] = $this->stories_model->get_followers($i);
		$this->load->view('ajaxcontent/followers', $data);
	}
	public function followers2($i)
	{
		$data['stories'] = $this->stories_model->get_followers($i);
		$this->load->view('ajaxcontent/followers2', $data);
	}
	public function following($i)
	{
		$data['stories'] = $this->stories_model->get_following($i);
		$this->load->view('ajaxcontent/following', $data);
	}
	public function following2($i)
	{
		$data['stories'] = $this->stories_model->get_following($i);
		$this->load->view('ajaxcontent/following2', $data);
	}
	public function favourites($i)
	{
		$data['stories'] = $this->stories_model->get_favourites($i);
		$this->load->view('ajaxcontent/favourites', $data);
	}
	public function favourites2($i)
	{
		$data['stories'] = $this->stories_model->get_favourites($i);
		$this->load->view('ajaxcontent/favourites2', $data);
	}	
	public function insertcomment()
	{
	    if (!$this->session->userdata('logged_in') == TRUE)
		{
			redirect('stories');
		} 

		$postid=$this->input->post('postid');
	    $comment=$this->input->post('message');

	    $this->load->helper('captcha');
        //$userCaptcha = $this->input->post('userCaptcha');

		$datains = array();            

        $arr['result'] = 'confirm';
        $arr['message'] = '<ul>';

         
		if (strlen($comment) == 0) {
            $arr['result'] = 'error';
            $arr['message'] .= '<li>'.$this->lang->line('fill_comment').'</li>';
        }
/*
        if (strlen($userCaptcha) == 0) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('fill_captcha').'</li>';
        } else {
                $word = $this->session->userdata('captchaWord');
                if(strcmp(strtoupper($userCaptcha),strtoupper($word)) == 0){
                } else {
                    $arr['result'] = 'error';
                    $arr['message'] .= '<li>'.$this->lang->line('fill_captchawords').'</li>';
                }
        }
	     
	    */
	    if ($arr['result'] != 'error') 
        { 
	     
	     	$datains['posts_id'] = $postid;
            $datains['users_id'] = $this->session->userdata('userid');
            $datains['comment'] = $comment;
			$datains['date'] = date('Y-m-d G:i:s');
            $result = $this->db->insert('post_comments', $datains);

            $arr['result'] = 'confirm';
        	$arr['message'] = $this->lang->line('fill_commentinserted');

	    }

        echo json_encode($arr); 


	}
	public function insertreply()
	{

		if (!$this->session->userdata('logged_in') == TRUE)
		{
			redirect('stories');
		} 

		$i=$this->input->post('i');
	    $comment=$this->input->post('message');
	    $postid=$this->input->post('postid');


	    $datains = array();            

        $arr['result'] = 'confirm';
        $arr['message'] = '<ul>';

         
		if (strlen($comment) == 0) {
            $arr['result'] = 'error';
            $arr['message'] .= '<li>'.$this->lang->line('fill_comment').'</li>';
        }
	     
	    
	    if ($arr['result'] != 'error') 
        { 
	     
	     	$datains['posts_id'] = $postid;
	     	$datains['parent_comment_id'] = $i;
            $datains['users_id'] = $this->session->userdata('userid');
            $datains['comment'] = $comment;
			$datains['date'] = date('Y-m-d G:i:s');
            $result = $this->db->insert('post_comments', $datains);

            $arr['result'] = 'confirm';
        	$arr['message'] = $this->lang->line('fill_commentinserted');

	    }

        echo json_encode($arr); 


	}
	public function sharealink()
	{
		if ($this->option_model->get_value('apppostanon') == 0) {
			if (!$this->session->userdata('logged_in') == TRUE)
			{
				redirect('stories');
			}
		}

		$data['categories'] = $this->stories_model->get_categories();		

		$this->load->view('header');
		$this->load->view('navigation', $data);
		$this->load->view('pages/story-add-external', $data);
		$this->load->view('footer');
	}
	public function writeastory()
	{
		if ($this->option_model->get_value('apppostanon') == 0) {
			if (!$this->session->userdata('logged_in') == TRUE)
			{
				redirect('stories');
			}
		}

		$data['categories'] = $this->stories_model->get_categories();		
		$data['dosen']		= $this->stories_model->dosen2($this->session->userdata('departemen'));
		$this->load->view('header3');
		$this->load->view('navigation', $data);
		if($this->session->userdata('level')!=0) {
			$this->load->view('pages/story-add-content', $data);
		} else {
			$this->load->view('pages/story-add-content2', $data);
		}
		
		$this->load->view('footer4');
	}
	public function addpoll()
	{
		if ($this->option_model->get_value('apppostanon') == 0) {
			if (!$this->session->userdata('logged_in') == TRUE)
			{
				redirect('stories');
			}
		}
		$this->load->helper('form');
		$data['min_options'] = 2;
		$data['max_options'] = 10;

		$data['categories'] = $this->stories_model->get_categories();		

		$this->load->view('header');
		$this->load->view('navigation', $data);
		$this->load->view('pages/story-add-poll', $data);
		$this->load->view('footer');
	}
	public function edit($i = "")
	{
		if (!$this->session->userdata('logged_in') == TRUE)
		{
			redirect('stories');
		}
			
		if (!$this->stories_model->get_auth_post($i, $this->session->userdata('userid'))) {
			return false;
		}

		$data['categories'] = $this->stories_model->get_categories();
		$data['story'] = $this->stories_model->get_specific_storie($i);
		$data['tags'] = $this->stories_model->get_tags_by_slug($i);	

		$this->load->view('header3');
		$this->load->view('navigation', $data);
		$this->load->view('pages/story-add-content', $data);
		$this->load->view('footer3');		
	}	

	public function verifylink2()
	{
		$link = trim($this->input->post('link'));
		@$html = file_get_contents($link);

		if(strlen($html)){
		$doc = new DOMDocument();
		@$doc->loadHTML($html);

		$tags = $doc->getElementsByTagName('img');
		$title = $doc->getElementsByTagName("title");

		if($title->length > 0){
		  $title = $title->item(0)->nodeValue;
		}

		//verify
		if ($this->stories_model->if_url_exists($link)) {
            $arr['result'] = 'error';
            $arr['message'] .= '<li>'.$this->lang->line('duplicatepost').'</li>';
            echo json_encode($arr);
        	return false;
        }
		$slug = url_title($title,'dash',TRUE);

		if ($slug == "") {
			$arr['result'] = 'error';
            $arr['message'] .= '<li>'.$this->lang->line('nopost').'</li>';
            echo json_encode($arr);
        	return false;
		}
        
        if ($this->stories_model->if_post_exists($slug)) {
            $arr['result'] = 'error';
            $arr['message'] .= '<li>'.$this->lang->line('duplicatepost').'</li>';
            echo json_encode($arr);
        	return false;
        }	        
		
		$metas = $doc->getElementsByTagName("meta");

		for ($i = 0; $i < $metas->length; $i++)
		{
			$meta = $metas->item($i);
			
			if(strtolower($meta->getAttribute('name')) == 'description') $description = $meta->getAttribute('content');
			if(strtolower($meta->getAttribute('property')) == 'og:image') $imagepost = $meta->getAttribute('content');
			if(strtolower($meta->getAttribute('property')) == 'og:description') $description = $meta->getAttribute('content');
		}

		$data = array();

		//parse_str( parse_url( $link, PHP_URL_QUERY ) );
		$url_imagem = parse_url($link);

		if($url_imagem['host'] == 'www.youtube.com' || $url_imagem['host'] == 'youtube.com'){
	        $array = explode("&", $url_imagem['query']);
	        $data[1]['src'] = "http://img.youtube.com/vi/".substr($array[0], 2)."/0.jpg";
	        $data[]["contentype"] = "video";
	    } else if($url_imagem['host'] == 'www.vimeo.com' || $url_imagem['host'] == 'vimeo.com'){
	        $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".substr($url_imagem['path'], 1).".php"));
	        $data[1]['src'] = $hash[0]["thumbnail_large"];
	        $data[]["contentype"] = "video";
	    } else if($url_imagem['host'] == 'www.dailymotion.com' || $url_imagem['host'] == 'dailymotion.com'){
	        $id = strtok(basename($link), '_');
	        $data[1]['src'] = "http://www.dailymotion.com/thumbnail/video/$id";
	        $data[]["contentype"] = "video";
	    } else {
			foreach ($tags as $index=>$tag) {
			$src    = $tag->getAttribute('src');
			$width  = $tag->getAttribute('width');
			$height = $tag->getAttribute('height');
			if($width == "" || $height == ""){
				list($width, $height) = @getimagesize($src);
			}
			// ignore images with height or width less than 50px
			if($width >= "50" || $height >= "50"){
				$data[$index]['src']    = $src;
			}
			}
			if (isset($imagepost)) { 
				if (trim($imagepost) != "") $imagepost = $data[1]['src']; 
			}
			$data[]["contentype"] = "link";
		}

		$tags = get_meta_tags($link);

		$data[]["title"] = $title;
		$data[]["url"] = $link;
		$data[]["desc"] = $description;

		echo json_encode($data);
	
		} else {  
			$arr['result'] = 'error';
            $arr['message'] .= '<li>'.$this->lang->line('urlinvalid').'</li>';
            echo json_encode($arr);
		}

	}

	function addstory()
	{
		if ($this->option_model->get_value('apppostanon') == 0) {
			if (!$this->session->userdata('logged_in') == TRUE)
			{
				redirect('stories');
			}
		}			

		$title = $this->input->post('title');
		$link = $this->input->post('link');
		$postimage = trim($this->input->post('postimage'));            
		$category = trim($this->input->post('category'));
		$post_text = $this->input->post('post_text');
		$tags = trim($this->input->post('tags'));
		$contentype = $this->input->post('contentype');
		$edit = $this->input->post('edit');
		$draft = $this->input->post('draft');

		$datains = array();

		$slug = url_title($title,'dash',TRUE);         

		$arr['result'] = 'confirm';
		$arr['message'] = '<ul>';
		
		$badWords = array("bullshit","fuck");
		$matches = array();
		$matchFound = preg_match_all("/\b(" . implode($badWords,"|") . ")\b/i", $title, $matches);
		if ($matchFound) {
			$words = array_unique($matches[0]);
			$arr['result'] = 'error';
			$arr['message'] .= '<li>'.$this->lang->line('forbiddenwords').'</li>';
			foreach($words as $word) {
				$arr['message'] .= '<li>'.$word.'</li>';    				
			}
		}

		$matchFound = preg_match_all("/\b(" . implode($badWords,"|") . ")\b/i", $post_text, $matches);
		if ($matchFound) {
			$words = array_unique($matches[0]);
			$arr['result'] = 'error';
			$arr['message'] .= '<li>'.$this->lang->line('forbiddenwordscontent').'</li>';
			foreach($words as $word) {
				$arr['message'] .= '<li>'.$word.'</li>';    				
			}
		}

		/*if ($this->stories_model->if_url_exists($link) && ($edit == "")) {
				$arr['result'] = 'error';
				$arr['message'] .= '<li>'.$this->lang->line('duplicatepost').'</li>';
			}

			if ($this->stories_model->if_post_exists($slug) && ($edit == "")) {
				$arr['result'] = 'error';
				$arr['message'] .= '<li>'.$this->lang->line('duplicatepost').'</li>';
			}*/

		if (strlen($category) == 0) {
			$arr['result'] = 'error';
			$arr['message'] .= '<li>'.$this->lang->line('category_select').'</li>';
		}

		if (strlen($title) == 0) {
			$arr['result'] = 'error';
			$arr['message'] .= '<li>'.$this->lang->line('filltitle').'</li>';
		}

		if (strlen($postimage) == 0) {
			$arr['result'] = 'error';
			$arr['message'] .= '<li>'.$this->lang->line('fillimagelink').'</li>';
		}
		

		if ($arr['result'] != 'error') 
		{            	

			copy($postimage, 'images/file.png');
			$nameFile = time().".png";
			$sourcePath = "images/file.png";
			$targetPath = "images/".$nameFile;
			move_uploaded_file($sourcePath,$targetPath);
			//unlink("images/file.png");
			rename("images/file.png",$targetPath);

			//resize
			$this->load->library('image_lib');
			$config['image_library'] = 'gd2';
			$config['source_image'] = $targetPath;
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 900;
			$config['height'] = 500;

			$this->image_lib->clear();
			$this->image_lib->initialize($config);
			$this->image_lib->resize();

			if ($link) $parse = parse_url($link);
			$datains['post_subject'] = $title;
			if ($link) $datains['post_domain'] = $parse['host'];
			if ($link) $datains['post_url'] = $link;
			
			if ($this->session->userdata('userid'))
			{
				$datains['post_by'] = $this->session->userdata('userid');
			} else {
				$datains['post_by'] = $this->option_model->get_value('apppostanonuser');
			}				

			$datains['post_image'] = $nameFile;
			$datains['post_date'] = date('Y-m-d G:i:s');
			$datains['post_text'] = $post_text;
			
			$slugn = url_title($title,'dash',TRUE);
			if (trim($slugn) == "") { $slugn = sha1(mt_rand()); }
			$datains['post_slug'] = $slugn;

			$datains['post_type'] = $contentype;
			
			if ($this->option_model->get_value('appstoryapproval') == 1) {
				$datains['approved'] = 0;
			}

			if ($draft != "") { $datains['approved'] = 2; }

			if ($edit != "") { 
				$this->db->where('post_id', $edit); 
				$this->db->where('post_by', $datains['post_by']);                	
				$result = $this->db->update('posts', $datains); 
				$dt['post_id'] = $edit;
				$this->db->where('post_id', $edit);
				$this->db->delete('categories_posts');					
			} else { 
				$result = $this->db->insert('posts', $datains); 
				$dt['post_id'] = $this->db->insert_id();
			}


			
			$dt['id_category'] = $category;
			$nresult = $this->db->insert('categories_posts', $dt);

			//insert tags
			$tagsexplode = explode(',',$this->input->post('tags'));
			foreach($tagsexplode as $genre) {
				
				if (!$this->stories_model->if_tag_exists($genre)) {
					$temp = array(
					'tag_name' => $genre,
					'tag_slug' => url_title($genre,'dash',TRUE)
					);
					$this->db->insert('tags', $temp);
					$tagsid['tag_id'] = $this->db->insert_id();
				} else {
					$tagsid['tag_id'] = $this->stories_model->get_id_by_tag($genre);
				}

				
				$temp2 = array(
				'postid' => $dt['post_id'],
				'tagid' => $tagsid['tag_id']
				);
				$this->db->insert('posts_tags', $temp2);
			}

			
			if ($result === TRUE) {

				if ($draft == "") {
					if ($this->option_model->get_value('appstoryapproval') == 1) {
						$arr['result'] = 'confirm';
						$arr['message'] .= "Your story waits approval. Thank you!";
					} else {
						$arr['result'] = 'confirmm';
						$arr['message'] .= $this->lang->line('storysuccessfully'); 
					}
				} else {
					$arr['result'] = 'confirmm';
					$arr['message'] .= $this->lang->line('storysuccessfully');
				}
				

			} else {
				
				$arr['result'] = 'error';
				$arr['message'] .= $this->lang->line('errortryagain');

			}

		}
		echo json_encode($arr); 
	
	}
	
    function uploadimage()
    {
    	$arr['result'] = 'fileconfirm';
        $arr['message'] = '';

    	if (strlen($_FILES["file"]["name"]) > 1) 				
			{
				$validextensions = array("jpeg", "jpg", "png");
				$temporary = explode(".", $_FILES["file"]["name"]);
				$file_extension = strtolower(end($temporary));

				if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) && ($_FILES["file"]["size"] < 900000) && in_array($file_extension, $validextensions)) 
				{
					if ($_FILES["file"]["error"] > 0)
					{
						echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
					} else {
						if (file_exists("images/" . $_FILES["file"]["name"])) 
						{
							$arr['result'] = 'fileerror';
	            			$arr['message'] .= '<li>File exists.</li>';
						} else {
							$sourcePath = $_FILES['file']['tmp_name'];
							$nameFile 	=	time() . "_" . $_FILES['file']['name'];
							$targetPath = "images/".$nameFile;
							move_uploaded_file($sourcePath,$targetPath);
							
							//resize
							$this->load->library('image_lib');
							$config['image_library'] = 'gd2';
							$config['source_image']	= $targetPath;
							$config['create_thumb'] = FALSE;
							$config['maintain_ratio'] = TRUE;
							$config['width'] = 900;
							$config['height'] = 900;

							$this->image_lib->clear();
							$this->image_lib->initialize($config);
							$this->image_lib->resize();
							
							$arr['result'] = 'fileconfirm';
	            			$arr['url'] = base_url().$targetPath;							
	            			$arr['message'] = $this->lang->line('uploadedsucessfully');

						}
					}
				} else {
					$arr['result'] = 'fileerror';
	            	$arr['message'] .= '<li>'.$this->lang->line('invalidextension').'</li>';	            
				}		
			}

			echo json_encode($arr); 	
    }

	public function upvote()
	{
		if (!$this->session->userdata('logged_in') == TRUE)
		{
			redirect('stories');
		}
		
		$id = $this->input->post('id');
		$res = $this->stories_model->insert_vote($id);
		
		$this->db->where('vote_postid', $id);

		if ($res) {
			$arr['ant'] = 'scorevote';
        	$arr['dep'] = 'scorevoted';
        } else {
        	$arr['ant'] = 'scorevoted';
        	$arr['dep'] = 'scorevote';
        }
        //$this->db->where('upvote', '1');
        $arr['votes'] = $this->db->count_all_results('posts_votes');
        echo json_encode($arr); 		
	}

	public function downvote()
	{
		if (!$this->session->userdata('logged_in') == TRUE)
		{
			redirect('stories');
		}
		
		$id = $this->input->post('id');
		$res = $this->stories_model->insert_downvote($id);
		
		$this->db->where('vote_postid', $id);

		if ($res) {
			$arr['ant'] = 'scorevote';
        	$arr['dep'] = 'scorevoted';
        } else {
        	$arr['ant'] = 'scorevoted';
        	$arr['dep'] = 'scorevote';
        }
        $this->db->where('downvote', '1');
        $arr['votes'] = $this->db->count_all_results('posts_votes');
        echo json_encode($arr); 		
	}

	public function thumbsup()
	{
		if (!$this->session->userdata('logged_in') == TRUE)
		{
			redirect('stories');
		}
		
		$id = $this->input->post('id');
		$m = $this->input->post('m');

		$res = $this->stories_model->insert_vote_comment_up($id, $m);
		
		$query = $this->db->query("SELECT * FROM comments_votes WHERE com_commentid='".$id."'");
		if ($query->num_rows() > 0)
        {
        	$arr['thumbsup'] = 0;
        	$arr['thumbsdown'] = 0;
        	foreach ($query->result() as $row)
            {
               $arr['thumbsdown'] += $row->com_down;
               $arr['thumbsup'] += $row->com_up;
            }
        	        	
        } else {
        	$arr['thumbsup'] = 0;
        	$arr['thumbsdown'] = 0;
        }

		echo json_encode($arr);
	}

	public function thumbsdown()
	{
		if (!$this->session->userdata('logged_in') == TRUE)
		{
			redirect('stories');
		}
		
		$id = $this->input->post('id');
		$m = $this->input->post('m');

		$res = $this->stories_model->insert_vote_comment_down($id, $m);
		
		$query = $this->db->query("SELECT * FROM comments_votes WHERE com_commentid='".$id."'");
		if ($query->num_rows() > 0)
        {
        	$arr['thumbsdown'] = 0;
        	$arr['thumbsup'] = 0;
        	foreach ($query->result() as $row)
            {
               $arr['thumbsdown'] += $row->com_down;
               $arr['thumbsup'] += $row->com_up;
            }
        	        	
        } else {
        	$arr['thumbsdown'] = 0;
        	$arr['thumbsup'] = 0;
        }

		echo json_encode($arr);
	}


	function insert_rows()
	{
		$this->load->database();
		$i = 0;
		while($i < 50)
		{
			$i++;
			$data = array('post_domain' => 'Domain', 'post_by' => '1', 'post_subject' => 'subject ' . $i);
			$this->db->insert('posts', $data);
			echo $i. '<br />';
		}
	}


	function favourite()
    {
                $id = $this->input->post('id');
                
                if ($this->stories_model->favourite($id)) {
                    $this->db->where(array("user_id"=>$this->session->userdata('userid'), "posts_id" => $id));
                    $this->db->delete("favourites");
                    $arr['ant'] = 'btnfavouriterem';
                    $arr['dep'] = 'btnfavourite';                    
                    $arr['message'] = 'Add to favourite';  
                } else {
                    $data = array(
                       'user_id'  => $this->session->userdata('userid'),
                       'posts_id'  => $id
                    );
                    $result = $this->db->insert('favourites', $data);
                    $arr['ant'] = 'btnfavourite';
                    $arr['dep'] = 'btnfavouriterem';
                    $arr['message'] = 'Added to favourite';
                }

                echo json_encode($arr);
    }

    function favourite2()
    {
                $id = $this->input->post('id');
                
                if ($this->stories_model->favourite($id)) {
                    $this->db->where(array("user_id"=>$this->session->userdata('userid'), "posts_id" => $id));
                    $this->db->delete("favourites");
                    $arr['ant'] = 'btnfavouriterem';
                    $arr['dep'] = 'btnfavourite';                    
                    $arr['message'] = '<i class="fa fa-star-o"></i>';  
                } else {
                    $data = array(
                       'user_id'  => $this->session->userdata('userid'),
                       'posts_id'  => $id
                    );
                    $result = $this->db->insert('favourites', $data);
                    $arr['ant'] = 'btnfavourite';
                    $arr['dep'] = 'btnfavouriterem';
                    $arr['message'] = '<i class="fa fa-star"></i>';                      
                }

                echo json_encode($arr);
    }
	
	
}
