<!-- Main Content -->
    <div class="container-fluid maincontent">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                
        <div class="row" style="margin-top: 20px;margin-bottom: 20px;">
            <div class="col-md-9">
                
                

            </div>
            <div class="col-md-3 search">
                

               


            </div>    

        </div>


                
                    
                    
                 <?php $this->load->view('ajaxcontent/single-stories'); ?>



                


                <div id="comments"></div>


      <br />          
	  <div id="leavecomment">
      <h4><?php echo $this->lang->line('title_comment'); ?></h4>
      
     <?php if ($this->session->userdata('logged_in') == TRUE) { ?>
     <br />
      <form id="commentsform" class="form-horizontal">
       
    <div class="form-group">
        <div class="col-sm-8">
           
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $this->session->userdata('nome'); ?>" required disabled>
        </div>
    </div>
    <div class="form-group">
       <div class="col-sm-8">
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $this->session->userdata('email'); ?>" required disabled>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-8">
            <textarea class="form-control" required rows="4" id="comment" name="comment" placeholder="<?php echo $this->lang->line('input_comment'); ?>"></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-8">
            <label for="captcha"><?php echo $captcha['image']; ?></label>
            <br>
            <input type="text" autocomplete="off" name="userCaptcha" placeholder="Enter above text" value="<?php if(!empty($userCaptcha)){ echo $userCaptcha;} ?>" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-8">
            <input id="submit" name="submit" type="submit" value="<?php echo $this->lang->line('comment_button'); ?>" class="button button-green">
        </div>
    </div>
    <div id="loading" class="alert alert-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> &nbsp;<?php echo $this->lang->line('loading_text'); ?></div>
    <div id="error" class="alert alert-warning" role="alert"></div>
    <div id="confirm" class="alert alert-success" role="alert"></div>
   
</form>  
<?php } else { ?>
<span style="font-size:16px;color:#888;">Please <a href="#" data-toggle="modal" data-target="#loginmodal">Login</a> to insert comment.</span>
<br /><br />
<?php } ?>
</div>


<script type='text/javascript'>
jQuery(document).ready(function($){
       

    loadComments  = function() 
    {
      var article_id = $("#article").val();
           $.post('<?php echo base_url();?>stories/get_comments/<?php echo $storyid; ?>',
                                                    {
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

  loadComments();

});
</script>