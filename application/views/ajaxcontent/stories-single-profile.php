
                    <?php if (count($stories)>0): ?>


                   


                    <?php foreach($stories as $sto): ?>

                    <!-- post -->
                    <li class="row" style="position:relative;">
                        
                        <?php if ($sto['post_by'] == $this->session->userdata('userid')) { ?>
                        <div class="removebtn" style="position:absolute;top:50px;right:0px;z-index:9999;">
                          <a href="#" style="cursor:hand;" class="btn-danger btn-sm rembtn" data-id="<?php echo $sto['post_id']; ?>">DELETE</a>
                        </div>
                        <?php } ?>

                        <section class="col-md-2">
                          <div class="" style="background-image:url('<?php echo base_url()."images/".$sto['post_image']; ?>');min-height:80px;background-size:cover;"></div>
                        </section>


                        <article class="story-title col-md-10" style="padding-left:30px;">
                          <div class="domain"><?php echo $sto['post_domain']; ?></div>
                          <h2>
                            <a href="<?php echo $sto['post_url']; ?>" target="_blank" class="story-link"><?php echo $sto['post_subject']; ?></a>
                          </h2> 
                          <div class="meta">
                            <div style="float:left;">
                            <time datetime="<?php echo $sto['post_date']; ?>"><?php echo $this->stories_model->calculartempo($sto['post_date'], date("Y-m-d H:i:s")); ?></time>
                            <span class="separator"> • </span>
                            <a href="<?php echo base_url(); ?>stories/r/<?php echo $sto['post_id']; ?>#comments">Comments (<?php echo $this->stories_model->num_comments($sto['post_id']); ?>)</a>              
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
                           a.find('.numvotes').html(data);
                }, "json");

                
                return false;
});
jQuery('.rembtn').click(function() 
{
    var id = $(this).attr('data-id');
    var a = $(this);
                jQuery.post("<?php echo base_url() ?>stories/removestory", { id: id, <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>' },
                function(data){
                           a.parent().parent().remove();
                }, "json");

                
                return false;
});

<?php } ?>

});
</script>