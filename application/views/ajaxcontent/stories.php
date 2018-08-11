
                    <?php if (count($stories)>0): ?>

                    <?php foreach($stories as $sto): ?>

                    <!-- post -->
                    <li class="row" style="padding-bottom: 20px;">
                                               

                        <section class="col-sm-12 col-md-2">
                            <a href="<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>">
                              <div style="background-image:url('<?php echo base_url()."images/".$sto['post_image']; ?>');min-height:80px;background-size:cover;"></div>
                            </a>
                        </section>


                        <article class="story-title col-sm-12 col-md-10">
                          <div class="domain"><?php echo $sto['post_domain']; ?></div>
                          <h2>
                            <a href="<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>"><?php echo $sto['post_subject']; ?></a>
                          </h2> 
                          <div class="meta">
                            <div style="float:left;">
                            
                            <div class="cat" style="margin-right:10px;font-size: 10px;margin-bottom:0px;background-color:#<?php echo $sto['category_color']; ?>;"><span><?php echo $sto['category_name']; ?></div>
                            <time datetime="<?php echo $sto['post_date']; ?>"><?php echo $this->stories_model->calculartempo($sto['post_date'], date("Y-m-d H:i:s")); ?></time>
                            <span>by </span>
                            <a href="<?php echo base_url(); ?>user/viewprofile/<?php echo $sto['user_id']; ?>" class="author-link"><?php echo ucfirst($sto['user_name'])." ".ucfirst($sto['user_lastname']); ?> </a>
                            
                            <span class="separator"> • </span>                            
                            
                            <span><i class="fa fa-eye"></i>&nbsp;<?php echo $sto['numberviews']; ?></span>&nbsp;&nbsp;

                            <span class="separator"> • </span>
                            
                                                        
                            <a href="<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>#comments"><i class="fa fa-comment"></i>&nbsp;<?php echo $this->stories_model->num_comments($sto['post_id']); ?></a>

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
                            <?php if($this->session->userdata('logged_in')) { ?>
                            <span class="separator"> • </span>
                            <a href="#" class="upvotebtn <?php if ($this->stories_model->if_voted($sto['post_id'])) { ?>scorevoted<?php } else { ?>scorevote<?php } ?>" style="margin-left:5px;" data-id="<?php echo $sto['post_id']; ?>">
                            <?php } else { ?>                            
                            <a href="#" class="upvotebtn" style="margin-left:5px;" data-id="<?php echo $sto['post_id']; ?>" data-toggle="modal" data-target="#loginmodal">
                            <?php } ?>                             
                                <i class="fa fa-thumbs-up"></i>&nbsp;<span class="numvotes"><?php echo $this->stories_model->num_upvotes($sto['post_id']); ?></span>
                            </a>

                            <?php if($this->session->userdata('logged_in')) { ?>
                            <span class="separator"> • </span>
                            <a href="#" class="downvotebtn <?php if ($this->stories_model->if_voted($sto['post_id'])) { ?>scorevoted<?php } else { ?>scorevote<?php } ?>" style="margin-left:5px;" data-id="<?php echo $sto['post_id']; ?>">
                            <?php } else { ?>                            
                            <a href="#" class="downvotebtn" style="margin-left:5px;" data-id="<?php echo $sto['post_id']; ?>" data-toggle="modal" data-target="#loginmodal">
                            <?php } ?>                             
                                <i class="fa fa-thumbs-down"></i>&nbsp;<span class="numvotes"><?php echo $this->stories_model->num_downvotes($sto['post_id']); ?></span>
                            </a>                                         

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
                           a.removeClass(data.ant).addClass(data.dep);
                }, "json");

                
                return false;
});
jQuery('.downvotebtn').click(function() 
{
    var id = $(this).attr('data-id');
    var a = $(this);

                jQuery.post("<?php echo base_url() ?>stories/downvote", { id: id, <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>' },
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
                    jQuery.post("<?php echo base_url() ?>stories/favourite", { id: id, <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>' },
                    function(data){
                               a.removeClass(data.ant).addClass(data.dep).html(data.message);
                    }, "json");

                    
                    return false;
});
<?php } ?>

});
</script>