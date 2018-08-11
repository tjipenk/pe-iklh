<?php if (count($stories)>0): $com = 0; ?>                 
<?php foreach($stories as $sto): ?>


<?php if (($com == 4) && ($this->option_model->get_value('appadscodehome'))) { ?>
    <li class="article col-md-12 col-sm-12" style="position:relative;min-height:0;padding: 0px 5px;">
        <div class="blocks" style="border: 1px solid #ecf0f1;box-shadow: 0 1px 6px rgba(0,0,0,0.04);"><?php echo $this->option_model->get_value('appadscodehome');  ?></div>
    </li>
<?php } ?>


<?php if ($sto['post_type'] == "poll") { ?>
<?php 
    $idpoll = $sto['post_poll_id'];
    $query = $this->db->query("SELECT *, polls_options.option_id as idoption, count(polls_votes.option_id) as total_votes FROM polls LEFT JOIN polls_options ON polls_options.poll_id=polls.poll_id LEFT JOIN polls_votes ON polls_votes.option_id=polls_options.option_id WHERE polls.poll_id = '".$idpoll."' group by polls_options.option_id");
    $options = $query->result_array();                            
?>
<?php 
    if (count($options)>0): 
    $totalvotes = 0;
    foreach($options as $option):
    $totalvotes += $option['total_votes'];
    endforeach; 
?>

                    <li class="col-md-12 col-sm-12" style="position:relative;min-height:0;padding: 0px 5px;">
                            <div class="blocks" style="border: 1px solid #ecf0f1;box-shadow: 0 1px 6px rgba(0,0,0,0.04);">
                                <div id="poll" style="padding:20px;">
                                    <time datetime="<?php echo $sto['post_date']; ?>" style="float:right;font-size:11px;color:#CCC;"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo $this->stories_model->calculartempo($sto['post_date'], date("Y-m-d H:i:s")); ?></time>
                                    <span style="color:#FFF;padding:0px 5px;background-color:#<?php echo $sto['category_color']; ?>;" class="catf pull-left"><?php echo $sto['category_name']; ?></span>
                                    <h2 style="padding: 10px 0px 0px 0px;clear:both;">
                                    <a href="<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>" class="story-link" style="font-weight:700;">
                                        <?php if (strlen($sto['post_subject']) > 55) { echo mb_substr($sto['post_subject'],0,55)."..."; } else { echo mb_substr($sto['post_subject'],0,100); } ?>
                                    </a>
                                </h2> 


                                <br />
                                <?php 
                                foreach($options as $option): 
                                  $perc = ($option['total_votes'] / $totalvotes) * 100;
                                ?>
                                <div class="row voteline" onclick="vote(<?php echo $idpoll; ?>, <?php echo $option['idoption']; ?>);">
                                  <div class="col-md-4" style="line-height: 35px;"><?php echo $option['title']; ?></div>
                                  <div class="col-md-6" style="min-height:20px;"><div style="background-color:#CCC;min-height:20px;width:100%;margin-top: 10px;"><span class="poll_bar" style="background: #ce1417;display: block;width: <?php echo (int)$perc; ?>%;min-height:20px;"></span></div></div>
                                  <div class="col-md-2" style="font-size: 12px;line-height: 34px;"><?php echo (int)$perc; ?>%</div>
                                </div>                        
                                <?php endforeach; ?>

                                </div>

                    <?php endif; ?>
                            </div>
                    </li>   
 
    
                    <?php } else { ?>

                    <?php if ($com == 0) { ?>

                    <li class="article col-md-12 col-sm-12" style="position:relative;min-height:0;padding: 0px 5px;">
                       <div class="blocks" style="border: 1px solid #ecf0f1;box-shadow: 0 1px 6px rgba(0,0,0,0.04);background:url(<?php echo base_url()."images/".$sto['post_image']; ?>);background-size:cover;min-height:350px;">
                        
                        <a class="topslidebg" style="right:7px;bottom:10px;top:10px;left:7px;" href="<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>">

                        <div class="captionfeature">
                        


                
                        <span style="color:#FFF;padding:0px 5px;background-color:#<?php echo $sto['category_color']; ?>;" class="catf pull-left"><?php echo $sto['category_name']; ?></span>
                        
                        <h2 style="clear:both;margin:35px 0px 0px 0px;">
                           
                                <?php if (strlen($sto['post_subject']) > 55) { echo mb_substr($sto['post_subject'],0,55)."..."; } else { echo mb_substr($sto['post_subject'],0,100); } ?>
                            
                          </h2>
                          

                          <?php if (strlen($sto['post_text']) > 0)  { ?>
                          <p style="color:#FFF;margin:0;margin-top:10px;margin-bottom:25px;"><?php echo strip_tags(mb_substr($sto['post_text'],0,140)).'...'; ?></p>
                          <?php } ?>


                        </div>

                        <div style="position:absolute;bottom:40px;right:30px;">
                        
                            <span><i class="fa fa-eye"></i>&nbsp;&nbsp;<?php echo $this->stories_model->num_views($sto['post_id']); ?></span>&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-comment"></i>&nbsp;&nbsp;<?php echo $this->stories_model->num_comments($sto['post_id']); ?>&nbsp;&nbsp;

                                       
                                <i class="fa fa-thumbs-up"></i>&nbsp;&nbsp;<span class="numvotes"><?php echo $this->stories_model->num_votes($sto['post_id']); ?></span>&nbsp;
                                

                        </div>


                </a>


                       </div>
                    </li>   

                    <?php } else { ?> 

                    <!-- post -->
                    <li class="article col-md-12 col-sm-12" style="position:relative;min-height:0;padding: 0px 5px;">
                       <div class="blocks" style="border: 1px solid #ecf0f1;box-shadow: 0 1px 6px rgba(0,0,0,0.04);">
                       <div class="row"> 
                        <div class="col-sm-8 col-md-8">


                        <div style="padding:20px;">
                            <time datetime="<?php echo $sto['post_date']; ?>" style="float:right;font-size:11px;color:#CCC;"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo $this->stories_model->calculartempo($sto['post_date'], date("Y-m-d H:i:s")); ?></time>
                            <span style="color:#FFF;padding:0px 5px;background-color:#<?php echo $sto['category_color']; ?>;" class="catf pull-left"><?php echo $sto['category_name']; ?></span>

                          <h2 style="padding: 10px 0px 0px 0px;clear:both;">
                            <a href="<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>" class="story-link" style="font-weight:700;">
                                <?php if (strlen($sto['post_subject']) > 100) { echo mb_substr($sto['post_subject'],0,100)."..."; } else { echo mb_substr($sto['post_subject'],0,100); } ?>
                            </a>
                          </h2>


                        <?php if ($sto['post_domain']) { ?><small style="margin-bottom: 10px;clear: both;display: inline-block;opacity:0.8;"><?php echo $sto['post_domain']; ?></small><?php } ?>

                          <?php if (strlen($sto['post_text']) > 0)  { ?>
                          <p style="margin:0;margin-bottom:25px;"><?php echo strip_tags(mb_substr($sto['post_text'],0,140)).'...'; ?></p>
                          <?php } ?>

                      
                    
                    
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



                            
                            <div class="col-md-12">
                                <a href="<?php echo base_url(); ?>u/<?php echo $sto['user_slug']; ?>" class="popup-ajax2 author-link" data-trigger="hover" data-placement="top" data-load="<?php echo base_url(); ?>user/hover/<?php echo $sto['user_id']; ?>" data-toggle="popover" title="<?php echo $sto['user_name']." ".$sto['user_lastname']; ?>"><img src="<?php echo $grav_url; ?>" class="img-circle" style="max-height:20px;max-width:20px;" alt="" />&nbsp;&nbsp;&nbsp;<?php echo $sto['user_name']." ".$sto['user_lastname']; ?></a>
                                &nbsp;&nbsp;
                            
                            <div class="pull-right">
                                <span><i class="fa fa-eye"></i>&nbsp;&nbsp;<?php echo $this->stories_model->num_views($sto['post_id']); ?></span>&nbsp;&nbsp;&nbsp;
                            <a href="<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>#comments"><i class="fa fa-comment"></i>&nbsp;&nbsp;<?php echo $this->stories_model->num_comments($sto['post_id']); ?>&nbsp;</a>&nbsp;

                            <?php if($this->session->userdata('logged_in')) { ?>
                            <a href="#" class="upvotebtn <?php if ($this->stories_model->if_voted($sto['post_id'])) { ?>scorevoted<?php } else { ?>scorevote<?php } ?>" style="margin-left:5px;" data-id="<?php echo $sto['post_id']; ?>">
                            <?php } else { ?>                            
                            <a href="#" class="upvotebtn" style="margin-left:5px;" data-id="<?php echo $sto['post_id']; ?>" data-toggle="modal" data-target="#loginmodal">
                            <?php } ?>                             
                                <i class="fa fa-thumbs-up"></i>&nbsp;&nbsp;<span class="numvotes"><?php echo $this->stories_model->num_votes($sto['post_id']); ?></span>&nbsp;
                            </a>
                            &nbsp;&nbsp;                            
                            <i class="fa fa-share-alt"></i><div class="social-likes social-likes_single" data-url="<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>" data-title="<?php echo $sto['post_subject']; ?>">
                                <div class="facebook" title="Share link on Facebook">Facebook</div>    
                                <div class="twitter" title="Share link on Twitter">Twitter</div>    
                                <div class="plusone" title="Share link on Google+">Google+</div>    
                                <div class="pinterest" title="Share link on Pinterest">Pinterest</div>    
                            </div>

                            </div>


                            

                            
                        
                            
                        </div>


                            


                            </div>                                     

                          </div>

                          </div>


                        
                        </div>

                        <div class="col-sm-4 col-md-4">
                            <div class="nopadmobile" style="padding:30px 30px 25px 0px;">
                            <a href="<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>" class="story-link">
                                <div class="story-image story-image-det2" style="position:relative;overflow: hidden;">
                                <img src="<?php echo base_url()."images/".$sto['post_image']; ?>" style="max-width:100%;" />
                                
                                <?php if ($sto['post_type'] == "video") { ?>
                                <span class="icon-play" style="position: absolute;top: 50%;left: 0px;right: 0;margin: auto;z-index:9999;"></span>
                                <?php } ?>

                                </div>
                            </a>
                            
                            </div>

                        </div>

                        </div>


                        
                        </div>
                    </li>
                    <!-- end post -->
                    <?php } ?>
                    <?php $com++; ?>
                    <?php } ?>        

                    <?php endforeach; ?>
                    <?php else: ?>  
                        <br />
                        <div style="font-size:15px;color:#888;clear:both;text-align:center;">No stories found.</div>
                        <br /><br />
                    <?php endif; ?>


<script type='text/javascript'>
jQuery(document).ready(function($){

$('.social-likes').socialLikes({});         		

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
vote = function(i, y) 
{
  jQuery.post("<?php echo base_url() ?>polls/vote", { i: i, y: y, <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>' },
  function(data){
      location.reload();
  }, "json");
  return false;
}
<?php } ?>
});
</script>