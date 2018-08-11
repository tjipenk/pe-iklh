
                    <?php if (count($stories)>0): ?>

                    <?php foreach($stories as $sto): ?>

                    <!-- post -->
                    <li class="col-sm-6 col-md-12">

                        <div class="row">
                        
                       

                        <section class="col-sm-6 col-md-6">
                          <a href="<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>">
                          <div class="" style="position:relative;height:70px;background:url(<?php echo base_url()."images/".$sto['post_image']; ?>);background-size:cover;">
                            
                          </div>
                            </a>
                        </section>


                        

                        

                        <article class="story-title col-sm-6 col-md-6" style="padding:0;">
                          

                        

                          <h2>
                            <a href="<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>" class="story-link"><?php echo mb_substr($sto['post_subject'],0,50).'...'; ?></a>
                          </h2> 




                          <div class="meta" style="line-height:0;">
                            <div class="row">
                            


                            


                            
                            <div class="col-md-10">
                            <time datetime="<?php echo $sto['post_date']; ?>"><i class="fa fa-clock-o"></i>&nbsp;<?php echo $this->stories_model->calculartempo($sto['post_date'], date("Y-m-d H:i:s")); ?></time>&nbsp;&nbsp;
                            
                            

                            </div>


                            


                            </div>                                     

                          </div>
                        </article>

                        </div>
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
jQuery('.btnfav2').click(function() 
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

});
</script>