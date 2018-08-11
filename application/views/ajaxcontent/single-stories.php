
                    <?php if (count($stories)>0): ?>
                     <ul class="stories">
                    <?php foreach($stories as $sto): ?>
                   
                    <!-- post -->
                    <li class="row">
                        
                         <section class="story-vote col-md-1">
                            <?php if($this->session->userdata('logged_in')) { ?>
                            <a href="#" class="upvotebtn" data-id="<?php echo $sto['post_id']; ?>">
                            <?php } else { ?>
                            <a href="#" class="upvotebtn" data-id="<?php echo $sto['post_id']; ?>" data-toggle="modal" data-target="#loginmodal">
                            <?php } ?>                            
                                <span class="score unvoted score-5553" data-red-current="0" data-next-vote="6"><i class="fa fa-angle-up" style="font-size:24px;font-weight:bold;"></i><br /><span class="numvotes"><?php echo $this->stories_model->num_votes($sto['post_id']); ?></span></span>
                            </a>           
                        </section>


                        <article class="story-title col-md-10">
                          <div class="domain"><?php echo $sto['post_domain']; ?></div>
                          <h2>
                            <a href="<?php echo $sto['post_url']; ?>" target="_blank" class="story-link"><?php echo $sto['post_subject']; ?></a>
                          </h2> 
                          <div class="meta">
                            <div style="float:left;">
                            <time datetime="<?php echo $sto['post_date']; ?>"><?php echo $this->stories_model->calculartempo($sto['post_date'], date("Y-m-d H:i:s")); ?></time>
                            <span>by </span>
                            <a href="<?php echo base_url(); ?>user/profile/<?php echo $sto['user_id']; ?>" class="author-link"><?php echo ucfirst($sto['user_name']); ?> </a>
                            <span class="separator"> • </span> 
                            </div>

                            <div class="dropdown socialdropdown hidden-xs" style="float:left;">
                              <button class="socialshare dropdown-toggle" type="button" data-toggle="dropdown"><span class="txt">Share</span>
                              <span class="caret"></span></button>
                              <ul class="dropdown-menu sharesocialarea">                                
                                <li>
                                    <?php $new = str_replace(' ', '%20', $sto['post_subject']); ?>
                                    <a href="https://twitter.com/intent/tweet?text=<?php echo $new; ?>&url=<?php echo base_url(); ?>stories/r/<?php echo $sto['post_id']; ?>" title="Share on Twitter" target="_blank" class="btn btn-sharetwitter"><i class="fa fa-twitter"></i> Twitter</a>                                  
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url(); ?>stories/r/<?php echo $sto['post_id']; ?>" title="Share on Facebook" target="_blank" class="btn btn-sharefacebook"><i class="fa fa-facebook"></i> Facebook</a>
                                    <a href="https://plus.google.com/share?url=<?php echo base_url(); ?>stories/r/<?php echo $sto['post_id']; ?>" title="Share on Google+" target="_blank" class="btn btn-sharegoogleplus"><i class="fa fa-google-plus"></i> Google+</a>
                                    <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo base_url(); ?>stories/r/<?php echo $sto['post_id']; ?>&title=&summary=" title="Share on LinkedIn" target="_blank" class="btn btn-sharelinkedin"><i class="fa fa-linkedin"></i> LinkedIn</a>
                                </li>                                                                
                              </ul>
                            </div>
                          </div>
                          <div style="margin-top:0px;"><p><?php echo $sto['post_text']; ?></p></div>
                        </article>


                       
                        <?php $postby = $sto['post_by']; ?>
                    </li>
                    <!-- end post -->

                           
                    <?php endforeach; ?>
                    </ul> 


                    <script type='text/javascript'>
jQuery(document).ready(function($){             

<?php if($this->session->userdata('logged_in')) { ?>
jQuery('.upvotebtn').click(function() 
{
    var id = $(this).attr('data-id');
    var a = $(this);

                jQuery.post("<?php echo base_url() ?>stories/upvote", { id: id, <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>' },
                function(data){
                           a.find('.numvotes').html(data);
                }, "json");

                
                return false;
});
<?php } ?>

});
</script>
                    <?php $this->session->set_flashdata('ui', $postby); ?>

                    <?php endif; ?>





                

