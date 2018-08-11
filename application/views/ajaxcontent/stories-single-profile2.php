
                    <?php if (count($stories)>0): ?>


                   


                    <?php foreach($stories as $sto): ?>

                    <!-- post -->
                    <li class="row" style="min-height:auto;height:auto;position:relative;margin-top:10px;padding-bottom:10px;border-bottom: 1px solid #f8f8f8;">
                        
                        <?php if ($sto['post_by'] == $this->session->userdata('userid')) { ?>
                        <div class="removebtn" style="position:absolute;top:50px;right:0px;z-index:9999;">
                          <a href="#" style="cursor:hand;" class="btn-danger btn-sm rembtn" data-id="<?php echo $sto['post_id']; ?>">DELETE</a>
                          <a href="<?php echo base_url(); ?>stories/edit/<?php echo $sto['post_slug']; ?>" style="cursor:hand;" class="btn-danger btn-sm">EDIT</a>
                        </div>                        
                        <?php } ?>

                        <section class="col-md-2">
                          <div class="" style="background-image:url('<?php echo base_url()."images/".$sto['post_image']; ?>');min-height:80px;background-size:cover;"></div>
                        </section>


                        <article class="story-title col-md-10" style="padding-left:30px;">
                          <div class="domain"><?php echo $sto['post_domain']; ?></div>
                          <h2>
                            <a href="<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>" class="story-link"><?php echo $sto['post_subject']; ?></a>
                          </h2> 
                          <div class="meta" style="border-bottom:0px;">
                            <div style="float:left;">
                            <time datetime="<?php echo $sto['post_date']; ?>"><?php if ($sto['approved'] == 2) { ?>Drafted<?php } else { ?>Published<?php } ?> <?php echo $this->stories_model->calculartempo($sto['post_date'], date("Y-m-d H:i:s")); ?></time>
                            &nbsp;<i class="fa fa-comment"></i>&nbsp;
                            <a href="<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>#comments">Comments (<?php echo $this->stories_model->num_comments($sto['post_id']); ?>)</a>              
                            
                            </div>
                           
                            &nbsp;&nbsp;
                            <i class="fa fa-share-alt"></i><div class="social-likes social-likes_single" data-url="<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>" data-title="<?php echo $sto['post_subject']; ?>">
                                <div class="facebook" title="Share link on Facebook">Facebook</div>    
                                <div class="twitter" title="Share link on Twitter">Twitter</div>    
                                <div class="plusone" title="Share link on Google+">Google+</div>    
                                <div class="pinterest" title="Share link on Pinterest">Pinterest</div>    
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

$('.social-likes').socialLikes({});

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
