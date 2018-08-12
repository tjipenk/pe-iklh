<style>
#socialpost a{
border-radius:0px}
.story-title{
	padding:0px;
}
body{
	background:#fff;
}
.bodyInside{
	font-size:17px;
	color:#000;
}
blockquote{
	font-size:25px;
	color:#333;
}
.videowrap{
	margin-top:100px;
}
	
	#menu-share li a{
		font-size:25px;
		color:#80b500;
	}
	body{background:#fff!important;}
	#leavecomment{
		padding:0px;
	}
	#comments{
		padding:0px 20px;
	
	}
	
	.stories .meta, .storiesrecent .meta, .meta{
		border:0px;
	}
</style>	
   <!-- Main Content -->
    <div class="container maincontent bodyInside" style="margin-top:30px;background-color:#;;padding-bottom: 40px;"> 
        <div class="row">
            <div class="col-lg-12 col-md-12">
                
              <div class="row">
			    <div class="col-md-2 hidden-xs ">
				 <ul class="nav nav-pills nav-stacked" id="menu-share" style="z-index:1000;padding:0px;;position:fixed;top:180px;margin-left:60px:;bottom:px;width:60px">
  <li role="presentation">
  <a href="https://twitter.com/intent/tweet?text=<?php echo $new; ?>&url=<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>" title="Share on Twitter" target="_blank" class="btn "><i class="fa fa-twitter"></i></a>                                  
                               </li>
    <li role="presentation"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>" title="Share on Facebook" target="_blank" class="btn "><i class="fa fa-facebook"></i></a>
                               </li>
	  <li role="presentation"> <a href="https://plus.google.com/share?url=<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>" title="Share on Google+" target="_blank" class="btn"><i class="fa fa-google-plus"></i></a>
                               </li>
	    <li role="presentation">  <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>&title=&summary=" title="Share on LinkedIn" target="_blank" class="btn"><i class="fa fa-linkedin"></i></a>
                              </li>
</ul>
				</div>
                <div class="col-md-8 col-sm-12">

                 <?php $this->load->view('ajaxcontent/single-stories2'); ?>

                <div class="pull-right hide">                
                <div id="filtercomments" class="dropdown">
                  <button class="filterposts dropdown-toggle" type="button" data-toggle="dropdown" style="margin: 25px;"><span class="txt">Popular</span>
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="javascript:void(0);" onclick="filtercom('Popular');"><?php echo $this->lang->line('popular_text'); ?></a></li>
                    <li><a href="javascript:void(0);" onclick="filtercom('Recent');"><?php echo $this->lang->line('recent_text'); ?></a></li>                    
                  </ul>
                </div>
                </div>
				<div class="row" style="margin-top:-20px">
                <div id="comments"></div>
				</div>


          	<div class="row">
    <div id="leavecomment">
      <h4>Komentari</h4>
      
     <?php if ($this->session->userdata('logged_in') == TRUE) { ?>
     
      <form id="commentsform" class="form-horizontal">
       
    <div class="form-group" style="display:none;">
        <div class="col-sm-8">
           
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $this->session->userdata('nome'); ?>" required disabled>
        </div>
    </div>
    <div class="form-group" style="display:none;">
       <div class="col-sm-8">
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $this->session->userdata('email'); ?>" required disabled>
        </div>
    </div>
	    <div class="col-sm-10">
    <div class="form-group">
    
            <textarea class="form-control" style="min-height:40px;"required rows="4" id="comment" name="comment" placeholder="Tambahkan komentar"></textarea>
        </div>
    </div>
	   <div class="col-sm-2">
	<div class="form-group">
     
            <input id="submit" name="submit" type="submit" value="Tambahkan" class="button button-green pull-right">
        </div>
    </div>
    <div class="form-group hide">
        <div class="col-sm-8">
            <label for="captcha"><?php echo $captcha['image']; ?></label>
            <br>
            <input type="text" autocomplete="off" name="userCaptcha" placeholder="Enter above text" value="<?php if(!empty($userCaptcha)){ echo $userCaptcha;} ?>" />
        </div>
    </div>
    
    <div id="loading" class="alert alert-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> &nbsp;<?php echo $this->lang->line('loading_text'); ?></div>
    <div id="error" class="alert alert-warning" role="alert"></div>
    <div id="confirm" class="alert alert-success" role="alert"></div>
   
</form>  
<?php } else { ?>
<span style="color:#888;">Please <a href="#" data-toggle="modal" data-target="#loginmodal">Login</a> to insert comment.</span>
<br /><br />
<?php } ?>

              <?php if ($this->option_model->get_value('appfbcommentsenable') == "1") { ?>
              <p>&nbsp;</p>
              <h4><?php echo $this->lang->line('facebookconversations'); ?></h4>
              <?php $link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
              <div class="fb-comments" data-href="<?php echo $link; ?>" data-numposts="5"></div>
              <?php } ?>



</div>
</div>


                
             



                </div>

      
 <div class="col-md-2 ">
				 <ul class="nav nav-pills nav-stacked" id="menu-share" style="z-index:1000;padding:0px;;position:fixed;top:180px;margin-left:60px:;bottom:px;width:60px">
 
</ul>
				</div>
                


              </div>  
                
               </div>

                


<script type='text/javascript'>
jQuery(document).ready(function($){
      
    loadComments  = function() 
    {
      var article_id = $("#article").val();
           $.post('<?php echo base_url();?>stories/get_comments/<?php echo $storyid; ?>',
                                                    {
                                                     filtera: filtera,
                                                     <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                                                    },
                                                    function(data)
     {
                                                       
       $("#comments").html(data);
     });
    }
          
  
  $("#commentsform").on('submit',(function(e) 
  {
        event.preventDefault();
        $("#error").empty().hide();
        $("#confirm").empty().hide();
        $('#loading').show();

        var curElement = $(this);
        curElement.find(':submit').hide();

        var name = $("#commentsform input[name=name]").val();
        var email = $("#commentsform input[name=email]").val();
        var message = $("#commentsform textarea[name=comment]").val();
        var userCaptcha = $("#commentsform input[name=userCaptcha]").val();
            
        $.post("<?php echo base_url(); ?>stories/insertcomment/", {
                  name: name,
          email: email,
          message: message,
          userCaptcha: userCaptcha,
          postid: <?php echo $storyid; ?>,
          <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        function(data){
          //$(".stories").append(data);
          //$("#comments").html(data);

          $('#loading').hide();
          $("#"+data.result).html(data.message).show();
          if (data.result == "confirm") { loadComments(); $("#commentsform textarea[name=comment]").val(""); }
          curElement.find(':submit').show();


        }, "json");
  }));


    var loaded_messages_rec = 0;
    var filterb = "Most Recent";
    var category = "";


 loadRecent  = function() 
    {            
            var search = $(".search-form input[name=search]").val();
            $.post("<?php echo base_url(); ?>stories/loadrecent/"+loaded_messages_rec, {
                search: search,
                filterb: filterb,
                category: category,
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            function(data){
                $(".storiesrecent").append(data);
            });
            loaded_messages_rec += 10;
            
            
    }

    loadTopAuthors  = function() 
    {            
            $.post("<?php echo base_url(); ?>stories/loadtopauthors/", {
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            function(data){
                $(".topauthors").append(data);
            });
    }

  var filtera = "Popular";

  filtercom = function(q) {
        $('#filtercomments .txt').html(q);
        loaded_comments = 0;
        $("#comments").html("");
        filtera = q;
        loadComments();
  }


  loadComments();
  loadRecent();
  loadTopAuthors();

});
</script>