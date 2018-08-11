<?php if (count($user)>0): ?>
<?php foreach($user as $use): ?>
<div class="container maincontent" id="pagecontent">
            <div class="row">
                <div class="col-sm-8 col-md-8 col-md-offset-2">
                    <div class="account-wall">                        
                        
                        
                        <?php
                            if (strlen($use['user_avatar']) > 2) {
                                $grav_url = base_url()."/images/avatar/".$use['user_avatar'];
                            } else if (strlen($use['user_facebookid']) > 2) {
                                $grav_url = "https://graph.facebook.com/".$use['user_facebookid']."/picture";
                            } else if (strlen($use['user_twitterid']) > 2) {                                    
                                $grav_url = "https://twitter.com/".$use['user_twittername']."/profile_image?size=original";
                            } else {
                                $email = $use['user_email'];
                                $default = $this->option_model->get_value('appusernophoto');
                                $size = 30;
                                $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
                            }
                        ?>

                        <br />
                        <i class="user-img icons-faces-users-03"></i>
                        <form id="formregisto" action="" method="post">    
                            
                            <div class="row" style="margin-top:10px;">
                                    <div class="col-sm-4" style="text-align:center;">
                                        <img src="<?php echo $grav_url; ?>" class="img-circle" style="max-height:100px;max-width:100px;" alt="" />
                                    </div>
                                    <div class="col-sm-4">                                    
                                        <h3><?php echo $use['user_name']; ?> <?php echo $use['user_lastname']; ?></h3>                                        
                                        <p style="margin:0 0 20px 0;color: #b0b0b0;line-height:1.1"><?php echo $use['shortbio']; ?></p>
                                        <?php if ($this->option_model->get_value('appuserrank') == 1) { ?>
                                        <strong><a href="<?php echo base_url();?>user/points">Point:</a></strong>

										<?php echo $this->stories_model->num_upvotes($use['user_id'])*$this->option_model->get_value('appuserranklike')-$this->stories_model->num_downvotes($use['user_id'])*$this->option_model->get_value('appuserranklike'); ?>,

									<br />
                                        <?php } ?><br />
                                        <?php if (strlen($use['user_twitter']) > 3) { ?><a data-balloon="Twitter Profile" data-balloon-pos="top" href="http://twitter.com/<?php echo $use['user_twitter']; ?>" target="_blank"><i class="fa fa-twitter-square" style="font-size: 22px;"></i></a>&nbsp;&nbsp;<?php } ?>
                                        <?php if (strlen($use['user_fb']) > 3) { ?><a href="http://facebook.com/<?php echo $use['user_fb']; ?>" target="_blank" data-balloon="Facebook Profile" data-balloon-pos="top"><i class="fa fa-facebook-square" style="font-size: 22px;"></i></a>&nbsp;&nbsp;<?php } ?>
                                        <?php if (strlen($use['user_gplus']) > 3) { ?><a href="https://plus.google.com/u/0/+<?php echo $use['user_gplus']; ?>" target="_blank" data-balloon="Google + Profile" data-balloon-pos="top"><i class="fa fa-google-plus-square" style="font-size: 22px;"></i></a>&nbsp;&nbsp;<?php } ?>

                                        <?php if (strlen($use['user_instagram']) > 3) { ?><a href="http://instagram.com/<?php echo $use['user_instagram']; ?>" target="_blank" data-balloon="Instagram Profile" data-balloon-pos="top"><i class="fa fa-instagram" style="font-size: 22px;"></i></a>&nbsp;&nbsp;<?php } ?>

                                        <?php if (strlen($use['user_pinterest']) > 3) { ?><a href="http://pinterest.com/<?php echo $use['user_pinterest']; ?>" target="_blank" data-balloon="Pinterest Profile" data-balloon-pos="top"><i class="fa fa-pinterest-square" style="font-size: 22px;"></i></a>&nbsp;&nbsp;<?php } ?>

                                        <?php if (strlen($use['user_website']) > 3) { ?><a href="http://<?php echo $use['user_website']; ?>" data-balloon="Website" data-balloon-pos="top" target="_blank"><i class="fa fa-share" style="font-size: 22px;"></i></a><?php } ?>
                                    </div>
                                    <div class="col-sm-4"> 
                                        <br />
                                        <?php if (($this->session->userdata('logged_in') == TRUE) && ($this->session->userdata('userid') != $use['user_id'])) { ?>
                                            <?php if ($this->user_model->follow($use['user_id'])) { ?>
                                            <a class="btnfollow" data-id="<?php echo $use['user_id']; ?>" href="javascript:void(0);"><?php echo $this->lang->line('following'); ?></a>
                                            <?php } else { ?>
                                            <a class="btnfollow" data-id="<?php echo $use['user_id']; ?>" href="javascript:void(0);"><?php echo $this->lang->line('follow'); ?></a>
                                            <?php } ?>
                                        <?php } ?>                                        
                                    </div>
                            </div>

                            <?php
                                $id = $use['user_id'];
                            ?>

                            <br style="clear:both;" /><br />
                            <div class="row" style="margin-top:10px;">
                                

    <ul class="nav nav-tabs tabs-up" id="profiletabs">
      <li class="active"><a href="<?php echo base_url();?>stories/get_posts2/<?php echo $id; ?>" data-target="#recentstories" class="media_node active span" id="contacts_tab" data-toggle="tabajax" rel="tooltip"><?php echo $this->lang->line('recent_posts'); ?><span><?php echo $num_recentposts; ?></span></a></li>
      <li><a href="<?php echo base_url();?>stories/followers2/<?php echo $id; ?>" data-target="#followers" class="media_node span" id="friends_list_tab" data-toggle="tabajax" rel="tooltip">Penelitian / Inovasi <span><?php echo $num_followers; ?></span></a></li>
      <li><a href="<?php echo base_url();?>stories/following2/<?php echo $id; ?>" data-target="#following" class="media_node span" id="awaiting_request_tab" data-toggle="tabajax" rel="tooltip">Seminar<span><?php echo $num_following; ?></span></a></li>
      <li><a href="<?php echo base_url();?>stories/favourites2/<?php echo $id; ?>" data-target="#favourites" class="media_node span" id="favourites_tab" data-toggle="tabajax" rel="tooltip">Kolokium <span><?php echo $num_favourites; ?></span></a></li>
    
	</ul>

    <div class="tab-content">
        <ul class="tab-pane active stories" id="recentstories">
        </ul>
        <ul class="tab-pane active" id="followers">
        </ul>
        <ul class="tab-pane active" id="following">
        </ul>
        <ul class="tab-pane active stories" id="favourites">
        </ul>        
    </div>


                                


                                
                                
                                


                            </div>
                            

                        </form>
                    </div>

                    </div>

                    <div class="col-md-3 col-sm-12">
                
                  <br /><br />
                  

                </div>  


                <div class="col-md-2 col-sm-12">
        

        
      </div>

                
<?php endforeach; ?>
                    

<script type="text/javascript">
jQuery(document).ready(function(){
       
    loadPosts  = function() 
    {
        $.post('<?php echo base_url();?>stories/get_posts2/<?php echo $id; ?>',
           {
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
           },
           function(data)
     {
                                                       
       $(".stories").html(data);
     }); 

    }
    <?php if ($this->session->userdata('logged_in') == TRUE) { ?>
    jQuery('.btnfollow').click(function() 
    {
        var id = $(this).attr('data-id');
        var a = $(this);
                    jQuery.post("<?php echo base_url() ?>user/follow", { id: id, <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>' },
                    function(data){
                               a.removeClass(data.ant).addClass(data.dep).html(data.message);
                    }, "json");

                    
                    return false;
    });    
    <?php } ?>


    $('[data-toggle="tabajax"]').click(function(e) {
    var $this = $(this),
        loadurl = $this.attr('href'),
        targ = $this.attr('data-target');

    $.get(loadurl, function(data) {
        $(targ).html(data);
    });

        $this.tab('show');
        return false;
    });

    $('.nav-tabs li:first-child a').click();
    //loadPosts();

});   
</script>
<?php else: ?>  
<br />
<span style="font-size:16px;color:#888;"><?php echo $this->lang->line('nouserfound'); ?></span>
<br /><br />
<?php endif; ?>