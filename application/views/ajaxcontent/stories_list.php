
                    <?php 
                    if (count($stories)>0): 
                    $com = 0;
                    ?>                    
                    <?php foreach($stories as $sto): ?>
                    
                    
                    <!-- post -->
                    <li class="col-md-12 col-sm-12" style="padding-bottom: 10px;padding-top: 5px;">

                       

                    <div class="col-md-3 col-sm-3">
                       <a href="<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>" class="story-link">
                          <div class="story-image" style="position:relative;height:120px;background-image:url('<?php echo base_url()."images/".$sto['post_image']; ?>');">
                            <a href="<?php echo base_url(); ?>stories/category/<?php echo $sto['category_slug']; ?>" style="position:absolute;bottom:10px;left:10px;color:#FFF;padding:0px 5px;" class="catf pull-left"><?php echo $sto['category_name']; ?></a>


                        <section class="story-vote <?php if ($this->stories_model->if_voted($sto['post_id'])) { ?>scorevoted<?php } else { ?>scorevote<?php } ?>" style="position:absolute;bottom:-15px;right:-5px;box-shadow: 0 0 5px rgba(0,0,0,.4);min-height: 40px;    min-width: 40px;">
                            <?php if($this->session->userdata('logged_in')) { ?>
                            <a href="#" class="upvotebtn" data-id="<?php echo $sto['post_id']; ?>">
                            <?php } else { ?>
                            <a href="#" class="upvotebtn" data-id="<?php echo $sto['post_id']; ?>" data-toggle="modal" data-target="#loginmodal">
                            <?php } ?>                            
                                <span class="score"><i class="fa fa-angle-up" style="font-size:15px;line-height: 37px;"></i>&nbsp;<span class="numvotes"><?php echo $this->stories_model->num_votes($sto['post_id']); ?></span></span>
                            </a>           
                        </section>

                          </div>
                        </a>
                    </div>


                        <article class="story-title col-sm-9 col-md-9">
                          
                          <h2 style="padding: 11px 0px;">
                            <a href="<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>" class="story-link" style="font-size:22px;line-height: 32px;font-weight:400;"><?php echo $sto['post_subject']; ?></a>
                          </h2> 

                          <p style="margin:0;margin-bottom:10px;"><?php echo strip_tags(mb_substr($sto['post_text'],0,250)).'...'; ?></p>
                          


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
                            <time datetime="<?php echo $sto['post_date']; ?>"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo $this->stories_model->calculartempo($sto['post_date'], date("Y-m-d H:i:s")); ?></time>&nbsp;&nbsp;
                            <a href="<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>#comments"><i class="fa fa-comment-o"></i>&nbsp;&nbsp;<?php echo $this->stories_model->num_comments($sto['post_id']); ?></a>&nbsp;&nbsp;
                            

                            <?php if($this->session->userdata('logged_in')) { ?>                         
                            <?php if (trim($sto['favourite']) != "") { ?>
                                  <a href="javascript:void(0);" class="btnfav btnfavouriterem" data-id="<?php echo $sto['post_id']; ?>"><i class="fa fa-star"></i></a> 
                            <?php } else { ?>
                                  <a href="javascript:void(0);" class="btnfav btnfavourite" data-id="<?php echo $sto['post_id']; ?>"><i class="fa fa-star-o"></i></a> 
                            <?php } ?>   
                            <?php } ?>

                            
                            <div class="dropdown socialdropdown hidden-xs" style="float:left;">
                              <i class="fa fa-share-alt"></i><button class="socialshare dropdown-toggle" type="button" data-toggle="dropdown"><span class="txt">Share</span>
                              </button>
                              <ul class="dropdown-menu sharesocialarea">                                
                                <li>
                                    <?php $new = str_replace(' ', '%20', $sto['post_subject']); ?>
                                    <a href="https://twitter.com/intent/tweet?text=<?php echo $new; ?>&url=<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>" title="Share on Twitter" target="_blank" class="btn btn-sharetwitter"><i class="fa fa-twitter"></i> Twitter</a>                                  
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>" title="Share on Facebook" target="_blank" class="btn btn-sharefacebook"><i class="fa fa-facebook"></i> Facebook</a>
                                    <a href="https://plus.google.com/share?url=<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>" title="Share on Google+" target="_blank" class="btn btn-sharegoogleplus"><i class="fa fa-google-plus"></i> Google+</a>
                                    <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>&title=&summary=" title="Share on LinkedIn" target="_blank" class="btn btn-sharelinkedin"><i class="fa fa-linkedin"></i> LinkedIn</a>
                                </li>                                                                
                              </ul>
                            </div>

                            </div>


                            <div class="col-md-2" style="text-align:right;">
                                <a href="<?php echo base_url(); ?>u/<?php echo $sto['user_slug']; ?>" class="popup-ajax2 author-link" data-trigger="hover" data-placement="top" data-load="<?php echo base_url(); ?>user/hover/<?php echo $sto['user_id']; ?>" data-toggle="popover" title="<?php echo $sto['user_name']." ".$sto['user_lastname']; ?>"><img src="<?php echo $grav_url; ?>" class="img-circle" style="max-height:20px;max-width:20px;" alt="" /></a>                                
                            </div>


                            </div>                                     

                          </div>



                        </article>


                    </li>
                    <!-- end post -->
                                    
                                        


                    <?php endforeach; ?>
                    <?php else: ?>  
                        <br />
                        <span style="font-size:16px;color:#888;">No stories found.</span>
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
                           a.parent().removeClass(data.ant).addClass(data.dep);
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


});
</script>