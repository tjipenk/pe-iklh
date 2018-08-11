
                    <?php if (count($stories)>0): ?>
                    <?php foreach($stories as $sto): ?>

                    <li class="row" style="min-height:auto;height:auto;position:relative;margin-top:10px;border-bottom: 1px solid #f8f8f8;">
                        
                        <?php if ($sto['post_by'] == $this->session->userdata('userid')) { ?>
                        <div class="removebtn" style="display:none;position:absolute;top:50px;right:0px;z-index:9999;">
                          <a href="#" style="cursor:hand;" class="btn-danger btn-sm rembtn" data-id="<?php echo $sto['post_id']; ?>">DELETE</a>
                        </div>
                        <?php } ?>

                        <section class="col-md-2">
                          <div class="story-image" style="background-image:url('<?php echo base_url()."images/".$sto['post_image']; ?>');min-height:80px;background-size:cover;"></div>
                        </section>


                        <article class="story-title col-md-10" style="padding-left:30px;">
                          <div class="domain"><?php echo $sto['post_domain']; ?></div>
                          <h2>
                            <a href="<?php echo $sto['post_url']; ?>" target="_blank" class="story-link"><?php echo $sto['post_subject']; ?></a>
                          </h2> 
                          <div class="meta" style="border-bottom:0px;">
                            <div style="float:left;">
                            <time datetime="<?php echo $sto['post_date']; ?>"><?php echo $this->stories_model->calculartempo($sto['post_date'], date("Y-m-d H:i:s")); ?></time>
                            <span class="separator"> • </span>
                            <a href="<?php echo base_url(); ?>stories/post/<?php echo $sto['post_id']; ?>#comments">Comments (<?php echo $this->stories_model->num_comments($sto['post_id']); ?>)</a>              
                            </div>

                            <?php if($this->session->userdata('logged_in')) { ?>
                            <span class="separator"> • </span>                            
                            <?php if (trim($sto['favourite']) != "") { ?>
                                  <a href="javascript:void(0);" class="btnfav btnfavouriterem" data-id="<?php echo $sto['post_id']; ?>"><i class="fa fa-star"></i></a> 
                            <?php } else { ?>
                                  <a href="javascript:void(0);" class="btnfav btnfavourite" data-id="<?php echo $sto['post_id']; ?>"><i class="fa fa-star-o"></i></a> 
                            <?php } ?>   
                            <?php } ?> 
                           
                            


                          </div>
                        </article>

                    </li>

                    <?php endforeach; ?>
                    <?php else: ?>  
                        <br />
                        <span style="font-size:16px;color:#888;">No favourites found.</span>
                        <br /><br />
                    <?php endif; ?>
<script type='text/javascript'>
jQuery(document).ready(function($){         		

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

});
</script>