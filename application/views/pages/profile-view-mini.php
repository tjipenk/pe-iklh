<?php if (count($user)>0): ?>
<?php foreach($user as $use): ?>
<div class="container-fluid">
            <div class="row">
                <div class="col-sm-8 col-md-8 col-md-offset-2">
                    
                        
                        
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
                        
                            
                            <div class="row" style="margin-top:10px;">
                                    <div class="col-sm-4" style="text-align:center;">
                                        <img src="<?php echo $grav_url; ?>" class="img-circle" style="max-height:100px;max-width:100px;" alt="" />
                                    </div>
                                    <div class="col-sm-4">                                    
                                        <h3><?php echo $use['user_name']; ?> <?php echo $use['user_lastname']; ?></h3>                                        
                                        <p style="margin:0 0 20px 0;color: #b0b0b0;line-height:1.1"><?php echo $use['shortbio']; ?></p>
                                        <?php if (strlen($use['user_twitter']) > 3) { ?><a href="<?php echo $use['user_twitter']; ?>" target="_blank"><i class="fa fa-twitter-square"></i></a>&nbsp;&nbsp;<?php } ?>
                                        <?php if (strlen($use['user_website']) > 3) { ?><a href="<?php echo $use['user_website']; ?>" target="_blank"><i class="fa fa-share"></i></a><?php } ?>
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

                            

                            <br style="clear:both;" /><br />
                            <div class="row" style="margin-top:10px;">
                                

    


                                


                                
                                
                                


                            </div>
                            

                      
                    </div>

                    </div>

                    


                

                
<?php endforeach; ?>
                    

<script type="text/javascript">
jQuery(document).ready(function(){
       
    
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

});   
</script>
<?php else: ?>  
<br />
<span style="font-size:16px;color:#888;"><?php echo $this->lang->line('nouserfound'); ?></span>
<br /><br />
<?php endif; ?>