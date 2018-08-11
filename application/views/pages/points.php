
<div class="container maincontent" id="pagecontent">
            <div class="row">
                <div class="col-sm-8 col-md-8 col-md-offset-2">                       
                        
                        
                    <br style="clear:both;" /><br />
                    <div class="row" style="margin-top:10px;">
                                
                            <?php if (count($user)>0): ?>
                            <?php $i=1; foreach($user as $use): ?>

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
                                <div class="col-sm-4" style="text-align:center;margin-top:30px;">
                                    <div style="box-shadow: 0px 2px 4px rgba(0,0,0,0.1);min-height:200px;background:#FFF;padding-top:30px;position:relative;">
                                        <span style="position:absolute;bottom:10px;right:10px;font-size:32px;color:#CCC;"><?php echo $i; ?></span>
                                        <img src="<?php echo $grav_url; ?>" class="img-circle" style="max-height:50px;" alt="" /><br /><br />
                                        <h2><a href="<?php echo base_url(); ?>u/<?php echo $use['vote_userid']; ?>"><?php echo $use['user_name']." ".$use['user_lastname']; ?></a></h2>
                                        <?php echo $use['pontos']*$this->option_model->get_value('appuserranklike'); ?> points
                                    </div>
                                </div>

                                <?php $i++; endforeach; ?>
                                <?php else: ?>  
                                <br />
                                <span style="font-size:16px;color:#888;"><?php echo $this->lang->line('nouserfound'); ?></span>
                                <br /><br />
                                <?php endif; ?>

                                

                                


                    </div>
                            
                </div>
                    


                
            </div>
</div>            

                

                    

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

});   
</script>
