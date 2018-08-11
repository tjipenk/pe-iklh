<style>
    .com_img
 {
 float: left; width: 80px; height: 80px; margin-right: 20px;
 }
 .com_name
 {
 font-size: 16px; color: #54595F; font-weight: bold;
 }
        ol.timeline
 {list-style:none;font-size:1.2em;}
 ol.timeline li{ display:none;position:relative;padding:.7em 0 .6em 0;}ol.timeline li:first-child{}
 li.box
 {
 margin:10px 0px 40px 0px;
 }
 .box time {
 	font-size:14px;
 }
 .commenttext {
 	/*padding-left:40px;*/
padding:5px 0px;
float:left;
font-size:14px;
 }
 
    
</style>

<br />
<h4><?php if (count($stories) > 0) echo count($stories);  ?> Komentar<?php if (count($stories) > 1) { ?> <?php } ?></h4>
<?php
	$default = $this->option_model->get_value('appusernophoto');
	$size = 30;
	$ui = $this->session->flashdata('ui');
?>
<?php if (count($stories)>0): ?>
<?php foreach($stories as $row): ?>
	<?php
        




	    
                            if (strlen($row['user_avatar']) > 2) {
                                $grav_url = base_url()."/images/avatar/".$row['user_avatar'];
                            } else if (strlen($row['user_facebookid']) > 2) {
                                $grav_url = "https://graph.facebook.com/".$row['user_facebookid']."/picture";
                            } else if (strlen($row['user_twitterid']) > 2) {                                    
                                    $grav_url = "https://twitter.com/".$row['user_twittername']."/profile_image?size=original";
                            } else {
                                $email = $row['user_email'];
                                $default = $this->option_model->get_value('appusernophoto');
                                $size = 30;
                                $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
                            }


    ?>
	<li class="box row">

		<?php if ($row['users_id'] == $this->session->userdata('userid')) { ?>
                        <div class="removebtn" style="position:absolute;top:0px;right:0px;z-index:9999;">
                          <a href="#" style="cursor:hand;" class="btn-danger btn-sm rembtn" data-id="<?php echo $row['comment_id']; ?>">Hapus</a>
                        </div>
                        <?php } ?>


	
	
	<div class="col-md-1">		
	<img src="<?php echo $grav_url; ?>" class="img-circle" style="max-height:35px;" alt="" />
	</div>	
	<div class="col-md-11">
	<span class="com_name"><?php echo $row['user_name']." ".$row['user_lastname']; ?></span> <time style="color: #BFBFBF;font-size:12px;" datetime="<?php echo $row['date']; ?>"><?php echo $this->stories_model->calculartempo($row['date'], date("Y-m-d H:i:s")); ?></time></span> <br />
	
	<span class="commenttext"> <?php echo $row['comment']; ?></span>

    <?php if ($this->session->userdata('logged_in') == TRUE) { ?>
    <br style="clear:both;" />
    <div class="replybtn"><a style="font-size:11px;" href="javascript:void(0);" onclick="jQuery('#commentform-<?php echo $row['comment_id']; ?>').toggle();">Balas</a></div>
    <div class="likecomments">&nbsp;&nbsp;
        <a style="font-size:12px;" class="thumbsup" data-id="<?php echo $row['comment_id']; ?>" href="javascript:void(0);"><span><?php if (isset($row['thumbsup'])) { echo $row['thumbsup']; } else { echo "0"; } ?></span>&nbsp;<i class="fa fa-thumbs-o-up"></i></a>&nbsp;&nbsp;
        <a style="font-size:12px;" class="thumbsdown" data-id="<?php echo $row['comment_id']; ?>" href="javascript:void(0);"><span><?php if (isset($row['thumbsdown'])) { echo $row['thumbsdown']; } else { echo "0"; } ?></span>&nbsp;<i class="fa fa-thumbs-o-down"></i></a>
    </div>
    <?php } ?>
	</div>
	</li>
	<?php 
	//$postid = $row['posts_id']; 
	$replys = $this->stories_model->get_comments_replys($row['comment_id']); ?>
	<?php if (count($replys)>0): ?>
	<?php foreach($replys as $rep): ?>


	<li class="box row" style="padding-left:50px;">
	

		<?php if ($rep['users_id'] == $this->session->userdata('userid')) { ?>
        <div class="removebtn">
            <a href="#" style="cursor:hand;" class="btn-danger btn-sm remreplybtn" data-id="<?php echo $rep['comment_id']; ?>">Hapus</a>
        </div>
   		<?php } ?>

   		<?php
   		if (strlen($rep['user_avatar']) > 2) {
                                $grav_url = base_url()."/images/avatar/".$rep['user_avatar'];
                            } else if (strlen($rep['user_facebookid']) > 2) {
                                $grav_url = "https://graph.facebook.com/".$rep['user_facebookid']."/picture";
                            } else if ($this->session->userdata('twitter')) {
                                $tname=$this->session->userdata('nome');
                                $grav_url = "https://twitter.com/".$tname."/profile_image?size=original";
                            } else {
                                $email = $rep['user_email'];
                                $default = $this->option_model->get_value('appusernophoto');
                                $size = 30;
                                $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
                            }

                            ?>


	<div class="col-md-1">
	<img src="<?php echo $grav_url; ?>" class="img-circle" style="max-height:30px;" alt="" />
	</div>
	<div class="col-md-11">	
	<span class="com_name"><?php echo $rep['user_name']." ".$rep['user_lastname']; ?></span> <time style="color: #BFBFBF;font-size:12px;" datetime="<?php echo $rep['date']; ?>"><?php echo $this->stories_model->calculartempo($rep['date'], date("Y-m-d H:i:s")); ?></time> <br />
	
	<span class="commenttext"> <?php echo $rep['comment']; ?></span>
	<?php if ($this->session->userdata('logged_in') == TRUE) { ?>
	<br style="clear:both;" />
    <div class="replybtn"><a style="font-size:11px;" href="javascript:void(0);" onclick="jQuery('#commentform-<?php echo $row['comment_id']; ?>').toggle();">Balas</a></div>
    <div class="likecomments">&nbsp;&nbsp;
        <a style="font-size:12px;" class="thumbsup" data-id="<?php echo $rep['comment_id']; ?>" href="javascript:void(0);"><span><?php if (isset($rep['thumbsup'])) { echo $rep['thumbsup']; } else { echo "0"; } ?></span>&nbsp;<i class="fa fa-thumbs-o-up"></i></a>&nbsp;&nbsp;
        <a style="font-size:12px;" class="thumbsdown" data-id="<?php echo $rep['comment_id']; ?>" href="javascript:void(0);"><span><?php if (isset($rep['thumbsdown'])) { echo $rep['thumbsdown']; } else { echo "0"; } ?></span>&nbsp;<i class="fa fa-thumbs-o-down"></i></a>
    </div>
	<?php } ?>
	</div>
	</li>

	<?php endforeach; ?>
	<?php endif; ?>


    <?php
        if (strlen($this->session->userdata('avatar')) > 2) {
            $grav_url = base_url()."/images/avatar/".$this->session->userdata('avatar');
        } else if ($this->session->userdata('User')) {
            $ses_user=$this->session->userdata('User');
            $grav_url = "https://graph.facebook.com/".$ses_user['id']."/picture";
        } else if ($this->session->userdata('twitter')) {
            $tname=$this->session->userdata('nome');
            $grav_url = "https://twitter.com/".$tname."/profile_image?size=original";
        } else {
            $email = $this->session->userdata('email');
            $default = $this->option_model->get_value('appusernophoto');
            $size = 30;
            $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
        }       
    ?>


	<div style="display:none;" id="commentform-<?php echo $row['comment_id']; ?>" class="row">
		<form id="" data-id="<?php echo $row['comment_id']; ?>" class="replyform form-horizontal">
		<div class="col-md-2" style="text-align:right;padding: 0;">
            <img src="<?php echo $grav_url; ?>" class="img-circle" style="max-height:30px;" alt="" />
		</div>
		<div class="col-md-6">
			<textarea name="message" placeholder="Balas" rows="1"  class="replybox" style="margin-top:0;"></textarea>
		</div>
		<div class="col-md-4" style="text-align:left;">
			<input type="submit" value="Kirim" style="margin-top:0;" class="button-green" /></a>
		</div>
		</form>
	</div>

<?php endforeach; ?>
<p>&nbsp;</p>
<?php else: ?>	
	<span style="color:#888;">Belum ada komentar.</span>
	<br /><br />
<?php endif; ?>


<script type='text/javascript'>
jQuery(document).ready(function($){

  $(".replyform").on('submit',(function(e) 
  {
        event.preventDefault();
       
        var curElement = $(this);
        curElement.find(':submit').hide();

        var message = $(this).find("textarea[name=message]").val();
        var i = $(this).attr('data-id');        

        $.post("<?php echo base_url(); ?>stories/insertreply/", {                  
          message: message,
          i: i,
          postid: <?php echo $postid; ?>,
          <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        function(data){          
          if (data.result == "confirm") loadComments();
          curElement.find(':submit').show();

        }, "json");
  }));

jQuery('.rembtn').click(function() 
{
    var id = $(this).attr('data-id');
    var a = $(this);
                jQuery.post("<?php echo base_url() ?>stories/removecomment", { id: id, <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>' },
                function(data){
                           loadComments();
                }, "json");

                
                return false;
});

jQuery('.remreplybtn').click(function() 
{
    var id = $(this).attr('data-id');
    var a = $(this);
                jQuery.post("<?php echo base_url() ?>stories/removereply", { id: id, <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>' },
                function(data){
                           loadComments();
                }, "json");

                
                return false;
});

<?php if($this->session->userdata('logged_in')) { ?>
jQuery('.thumbsup').click(function() 
{   
    var id = $(this).attr('data-id');
    var a = $(this);
    jQuery.post("<?php echo base_url() ?>stories/thumbsup", { id: id, <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>' },
    function(data){
        a.find('span').html(data.thumbsup);
        a.parent().find('.thumbsdown').find('span').html(data.thumbsdown);
    }, "json");
    return false;
});
jQuery('.thumbsdown').click(function() 
{   
    var id = $(this).attr('data-id');
    var a = $(this);
    jQuery.post("<?php echo base_url() ?>stories/thumbsdown", { id: id, <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>' },
    function(data){
        a.find('span').html(data.thumbsdown);
        a.parent().find('.thumbsup').find('span').html(data.thumbsup);
    }, "json");
    return false;
});
<?php } ?>

});
</script>