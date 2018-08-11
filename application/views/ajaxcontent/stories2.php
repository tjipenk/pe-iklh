
                    <?php 
                    if (count($stories)>0): 
                    $com = 0;
                    ?>   
                    <ul class="swiper-posts col-sm-12">                 
                    <?php foreach($stories as $sto): ?>
                    
                    
                    <!-- post -->
                    <li class="col-md-3 col-sm-6" style="position:relative;">
                       <div class="blocks" style="box-shadow: 0 0 20px 0 rgba(0,0,0,0.21);">
                       <div class="row"> 
                        <div class="col-sm-12 col-md-12">
                        <a href="<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>" class="story-link">
                        <div class="story-image" style="position:relative;height:150px;overflow: hidden;">
                        <img src="<?php echo base_url()."images/".$sto['post_image']; ?>" style="max-width:100%;min-height:150px;" />
                        <span style="position:absolute;bottom:10px;left:10px;color:#FFF;padding:0px 5px;" class="catf pull-left"><?php echo $sto['category_name']; ?></span>
                        

                        </div>
                        </a>


                        <?php if ($sto['post_type'] == "video") { ?>
                        <a href="<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>" class="story-link">
                        <span class="icon-play" style="position: absolute;width: 100%;height: 100%;top: 0px;bottom: 0;left: 0px;right: 0;margin: auto;/*background-color: rgba(0, 0, 0, 0.5);*/z-index:9999;"></span>
                        </a>
                        <?php } ?>

                        
                        </div>
                        </div>


                        <div class="row">
                        <article class="story-title col-sm-12 col-md-12">
                          
                          <h2 style="padding: 5px 0px 11px 0px;">
                            <a href="<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>" class="story-link" style="font-weight:700;">
                                <?php 
                                 
                                if (strlen($sto['post_subject']) > 45) { echo mb_substr($sto['post_subject'],0,45)."..."; } else { echo utf8_encode($sto['post_subject']); }
                                ?>
                            </a>
                          </h2> 

                          <p style="margin:0;margin-bottom:10px;/*min-height:70px;*/"><?php echo strip_tags(mb_substr($sto['post_text'],0,100)).'...'; ?></p>
                          


                          <div class="meta">
                            <div class="row">
                            


                            <?php
                            if (strlen($sto['user_avatar']) > 2) {
                                $grav_url = base_url()."/images/avatar/".$sto['user_avatar'];
                            } else if (strlen($sto['user_facebookid']) > 2) {
                                $grav_url = "https://graph.facebook.com/".$sto['user_facebookid']."/picture";
                            } else if (strlen($sto['user_twitterid']) > 2) {                                    
                                $grav_url = "https://twitter.com/".$sto['user_twittername']."/profile_image?size=original";
                            } else {
                                $email = $sto['user_email'];
                                $default = $this->option_model->get_value('appusernophoto');
                                $size = 30;
                                $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
                            }
                            ?>



                            
                            <div class="col-md-10">
                            
                            <time datetime="<?php echo $sto['post_date']; ?>" style="float:left;margin-right:10px;"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo $this->stories_model->calculartempo($sto['post_date'], date("Y-m-d H:i:s")); ?></time>
                            
                            <a href="<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>#comments"><i class="fa fa-comment"></i>&nbsp;<?php echo $this->stories_model->num_comments($sto['post_id']); ?></a>

                            <?php if($this->session->userdata('logged_in')) { ?>
                            <a href="#" class="upvotebtn <?php if ($this->stories_model->if_voted($sto['post_id'])) { ?>scorevoted<?php } else { ?>scorevote<?php } ?>" style="margin-left:5px;" data-id="<?php echo $sto['post_id']; ?>">
                            <?php } else { ?>
                            <a href="#" class="upvotebtn" style="margin-left:5px;" data-id="<?php echo $sto['post_id']; ?>" data-toggle="modal" data-target="#loginmodal">
                            <?php } ?>                             
                                <i class="fa fa-thumbs-up"></i>&nbsp;<span class="numvotes"><?php echo $this->stories_model->num_votes($sto['post_id']); ?></span>
                            </a>
                            

                            

                            
                           

                            </div>


                            <div class="col-md-2" style="text-align:right;">
                                <a href="<?php echo base_url(); ?>u/<?php echo $sto['user_slug']; ?>" class="popup-ajax2 author-link" data-trigger="hover" data-placement="top" data-load="<?php echo base_url(); ?>user/hover/<?php echo $sto['user_id']; ?>" data-toggle="popover" title="<?php echo $sto['user_name']." ".$sto['user_lastname']; ?>"><img src="<?php echo $grav_url; ?>" class="img-circle" style="max-height:20px;max-width:20px;" alt="" /></a>                                
                            </div>


                            </div>                                     

                          </div>



                        </article>
                        </div>

                        <br style="clear:both;" />
                        </div>
                    </li>
                    <!-- end post -->
                                    
                                        


                    <?php endforeach; ?>
                </ul>
                    <?php else: ?>  
                        <br />
                        <div style="font-size:15px;color:#888;clear:both;text-align:center;">No stories found.</div>
                        <br /><br />
                    <?php endif; ?>
<script type='text/javascript'>
jQuery(document).ready(function($){         		

<?php if($this->session->userdata('logged_in')) { ?>
jQuery('.upvotebtn').click(function() 
{
    var id = $(this).attr('data-id');
    var a = $(this);

                jQuery.post("<?php echo base_url() ?>stories/upvote", { id: id, <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>' },
                function(data){
                           a.find('.numvotes').html(data.votes);
                           a.removeClass(data.ant).addClass(data.dep);
                }, "json");

                
                return false;
});
jQuery('.btnfav').click(function() 
    {
        var id = $(this).attr('data-id');
        var a = $(this);
                    jQuery.post("<?php echo base_url() ?>stories/favourite2", { id: id, <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>' },
                    function(data){
                               a.removeClass(data.ant).addClass(data.dep).html(data.message);
                    }, "json");

                    
                    return false;
});
<?php } ?>

//$('[data-toggle="popover"]').popover(); 

$('a.popup-ajax').popover({
    "html": true,
    "content": function(){
        var div_id =  "tmp-id-" + $.now();
        return details_in_popup($(this).attr('data-load'), div_id);
    }
});

function details_in_popup(link, div_id){
    $.ajax({
        url: link,
        success: function(response){
            $('#'+div_id).html(response);
        }
    });
    return '<div id="'+ div_id +'">Loading...</div>';
}


$('.heightequal').each(function(){  

        var highestBox = 0;
        $('.blocks', this).each(function(){

            if($(this).height() > highestBox) 
               highestBox = $(this).height(); 
        });  

        $('.blocks',this).height(highestBox);

});


});
</script>