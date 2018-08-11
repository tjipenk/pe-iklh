                  


                    <?php if (count($stories)>0): ?>
                     <ul class="stories">
                    <?php foreach($stories as $sto): ?>
                   

                    <?php
                      if($this->session->userdata('logged_in')) {  $res = $this->stories_model->insert_view($sto['post_id']); }
                    ?>

                    <!-- post -->
                    <li>
                        
                      <div class="row">
					  
					 
					  

                        <section class="col-sm-12 col-md-12" style="padding:0px;">
                          
                          
                        <div class="">  
                        <div class="story-vote-inside col-md-1" style="display:none">
                            <?php if($this->session->userdata('logged_in')) { ?>
                            <a href="#" class="upvotebtn" data-id="<?php echo $sto['post_id']; ?>">
                            <?php } else { ?>
                            <a href="#" class="upvotebtn" data-id="<?php echo $sto['post_id']; ?>" data-toggle="modal" data-target="#loginmodal">
                            <?php } ?>                            
                                <span class="score unvoted <?php if ($this->stories_model->if_voted($sto['post_id'])) { ?>scorevoted<?php } else { ?>scorevote<?php } ?>"><i class="fa fa-angle-up" style="font-size:18px;font-weight:bold;"></i>&nbsp;<span class="numvotes"><?php echo $this->stories_model->num_votes($sto['post_id']); ?></span></span>
                            </a>           
                        </div>
                          <article class="story-title col-md-12" style="margin-bottom:20px;padding-left:10px;">
                          
                          <?php if (($sto['post_by'] == $this->session->userdata('userid')) && ($sto['post_type'] != "poll") || $this->option_model->check_admin()) { ?>                            
                            <a href="<?php echo base_url(); ?>stories/edit/<?php echo $sto['post_slug']; ?>" style="float:right;cursor:hand;padding:4px 8px;font-size:11px;margin-top:20px;margin-bottom:-50px" class="btn btn-danger btn-sm editbtn" data-id="<?php echo $sto['post_id']; ?>">Edit post</a>                            
                            <?php } ?>

 


                          <span style="display:none;color:#FFF;padding:0px 5px;background-color:#<?php echo $sto['category_color']; ?>;" class="catf pull-left"><?php echo $sto['category_name']; ?></span>
                          <h2 style="clear:both;padding-top:10px;font-size: 25px;line-height: 35px;color:#333;font-weight:300!important;padding-bottom: 10px;">
                            <?php echo $sto['post_subject']; ?>
                          </h2> 


                          
                        

                          </article>
                          </div>


                          <?php 
                            if ($sto['post_type'] == "video") { 
                              
                              $url_imagem = parse_url($sto['post_url']);
                              if($url_imagem['host'] == 'www.youtube.com' || $url_imagem['host'] == 'youtube.com') {
                                $array = explode("&", $url_imagem['query']);
                          ?>
                                <div class="videowrap">
                                  <iframe width="853" height="480" src="https://www.youtube.com/embed/<?php echo substr($array[0], 2); ?>" frameborder="0" allowfullscreen></iframe>
                                </div>

                              <?php
                              } else if ($url_imagem['host'] == 'www.vimeo.com' || $url_imagem['host'] == 'vimeo.com') {
                              ?>
                              <div class="videowrap"><iframe src="https://player.vimeo.com/video/<?php echo substr($url_imagem['path'], 1); ?>" width="853" height="480" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>
                              <?php
                                  
                              } else if ($url_imagem['host'] == "www.dailymotion.com" || $url_imagem['host'] == 'dailymotion.com') { 
                                  $id  = strtok(basename($sto['post_url']), '_'); 

                            ?>
                            <div class="videowrap"><iframe frameborder="0" width="853" height="480" src="//www.dailymotion.com/embed/video/<?php echo $id; ?>" allowfullscreen></iframe></div>
                          <?php } } else { ?>   
<div class="">						  
                          <div style="width:100%;background-color:#fff;margin-bottom:20px;margin-top:10px;">
<center >                   
        
						   <?php if (strpos($sto['post_image'], 'http') !== false) { ?>
                            <img src="<?php echo $sto['post_image']; ?>" style="max-width:100%;" />
                            <?php } else { ?>
                            <img src="<?php echo base_url()."images/".$sto['post_image']; ?>" style="max-width:100%;" />
                            <?php } ?>
							</center>
                          </div>
                                </div>
                            
                          <?php } ?>

                         

                        </section>
                      </div>  

                        <article class="story-title col-md-12">                          
                         
                          


						<?php $new = str_replace(' ', '%20', $sto['post_subject']); ?>
                          <div  class="row meta">
                          



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







                            <div class="col-md-12" style="padding-left:0;">
                            <a href="<?php echo base_url(); ?>u/<?php echo $sto['user_slug']; ?>"><img src="<?php echo $grav_url; ?>" class="img-circle" style="max-width:27px;height:auto;" alt="" /></a>&nbsp;&nbsp;<a href="<?php echo base_url(); ?>u/<?php echo $sto['user_slug']; ?>"><?php echo $sto['user_name']." ".$sto['user_lastname']; ?></a>&nbsp;&nbsp;
                            
						   <time datetime="<?php echo $sto['post_date']; ?>"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo $this->stories_model->calculartempo($sto['post_date'], date("Y-m-d H:i:s")); ?></time>&nbsp;&nbsp;
                            <a href="<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>#comments"><i class="fa fa-comment-o"></i>&nbsp;&nbsp;<?php echo $this->stories_model->num_comments($sto['post_id']); ?></a>&nbsp;&nbsp;
                            

      

                            </div>

                           

                          </div>
						  
					

                  
                  
                          <!-- Ads -->
                          <div class="row">
                          <div class="col-md-12" style="text-align:center;">

                              <?php if ($this->option_model->get_value('appadmiddlepost') == "1") { ?>
                              <a href="<?php echo $this->option_model->get_value('appadvlink'); ?>">
                                      <img src="<?php echo $this->option_model->get_value('appadvimgurl'); ?>" style="display:inline-block;" class="img-responsive">
                              </a>                   
                              <?php } ?>


                              <?php if ($this->option_model->get_value('appadmiddlepost') == "2") { ?>
                                  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
								<!-- sidebar -->
								<ins class="adsbygoogle"
									 style="display:block"
									 data-ad-client="ca-pub-<?php echo $this->option_model->get_value('appgadscode'); ?>"
									 data-ad-slot="<?php echo $this->option_model->get_value('appgadslot'); ?>"
									 data-ad-format="auto"></ins>
								<script>
								(adsbygoogle = window.adsbygoogle || []).push({});
								</script>
                              <?php } ?>

                              <?php if ($this->option_model->get_value('appadmiddlepost') == "3") { echo $this->option_model->get_value('appadscode'); } ?>


                          </div>
                          </div>


                            

                          <div style="margin:10px 0px;" class="contenttext"><p><?php echo $sto['post_text']; ?></p></div>








                        </article>

                        <p style="clear:both;">&nbsp;</p>
                         
                        <?php if ($sto['post_url']) { ?>
                         <ul class="pager">
                      <li class="center">
                        <?php if ($this->option_model->get_value('externalarticle') == "iframe") { ?>
                          <a id="more_button" href="<?php echo base_url(); ?>stories/ext/<?php echo $sto['post_slug']; ?>">
                        <?php } else { ?>
                          <a id="more_button" target="_blank" href="<?php echo $sto['post_url']; ?>">
                        <?php } ?>
                          <?php echo $this->lang->line('openexternal'); ?>
                          </a>
                      </li>
                    </ul>  
                    <?php } ?>
                       
                       

                    

                        <?php $postby = $sto['post_by']; $postid = $sto['post_id']; ?>

                    </li>
                    <!-- end post -->

                    
                      
                    <?php if ($sto['post_type'] == "poll") { ?>
                      <div id="poll" style="background-color: #f9fafa;padding: 30px 80px;">
                        <h4 style="color: #ce1417;"><?php echo $sto['post_subject']; ?></h4>
                        <?php
                            $idpoll = $sto['post_poll_id'];

                            $query = $this->db->query("SELECT *, polls_options.option_id as idoption, count(polls_votes.option_id) as total_votes
FROM polls
LEFT JOIN polls_options ON polls_options.poll_id=polls.poll_id 
LEFT JOIN polls_votes ON polls_votes.option_id=polls_options.option_id 
WHERE polls.poll_id = '".$idpoll."'
group by polls_options.option_id");

                            


                            $options = $query->result_array();                            
                        ?>
                        <?php 
                          if (count($options)>0): 
                          $totalvotes = 0;
                          foreach($options as $option):
                            $totalvotes += $option['total_votes'];
                          endforeach; 
                        ?>


                        <br />
                        <?php 
                        foreach($options as $option): 
                          $perc = ($option['total_votes'] / $totalvotes) * 100;
                        ?>
                        <div class="row voteline" style="min-height:40px;" onclick="vote(<?php echo $idpoll; ?>, <?php echo $option['idoption']; ?>);">
                          <div class="col-md-3" style="min-height:40px;"><?php echo $option['title']; ?></div>
                          <div class="col-md-6" style="min-height:20px;"><div style="background-color:#CCC;min-height:20px;width:100%;margin-top: 10px;"><span class="poll_bar" style="background: #ce1417;display: block;width: <?php echo (int)$perc; ?>%;min-height:20px;"></span></div></div>
                          <div class="col-md-3" style="min-height:40px;"><?php echo (int)$perc; ?>%</div>
                        </div><br />                        
                        <?php endforeach; ?>

                                      
                        <?php endif; ?>

                      </div>  
                    <?php } ?>


                    <?php $related = $this->stories_model->get_related_posts($sto['category_slug']);
                    if (count($related)>0):  ?>
                   
                    <div class="hide"style="padding: 0px 20px 0px 30px;float:left;clear:both;width:100%;">
                      <h4 style="color: #ce1417;margin:20px 0px;">Related Articles</h4>
                    
                    <?php 
                    foreach($related as $rel): ?>
                            
                    <div class="col-md-4" style="padding-left:0;">
                        
                        <a href="<?php echo base_url(); ?>stories/article/<?php echo $rel['post_slug']; ?>">
                        <div style="background:url(<?php echo base_url()."images/".$rel['post_image']; ?>);background-size:cover;min-height:140px;position:relative;">
                        <?php if ($rel['post_type'] == "video") { ?>
                        <span class="icon-play" style="position: absolute;top: 50%;left: 0px;right: 0;margin: auto;z-index:9999;"></span>
                        <?php } ?>

                        </div>
                        </a>
                    

                    <h2 style="padding: 10px 0px 0px 0px;clear:both;">
                            <a href="<?php echo base_url(); ?>stories/article/<?php echo $rel['post_slug']; ?>" class="story-link" style="font-weight:700;">
                                <?php if (strlen($rel['post_subject']) > 55) { echo mb_substr($rel['post_subject'],0,55)."..."; } else { echo mb_substr($rel['post_subject'],0,100); } ?>
                            </a>
                          </h2>

                          </div> 

                    <?php endforeach; ?>

                          </div><p>&nbsp;</p><?php endif; ?>

                           
                    <?php 
                    $colorcat = $sto['category_color'];                    
                    endforeach; 
                    ?>
                    </ul> 




<!-- Login Modal - Display if user not login -->
  <?php if($this->session->userdata('logged_in')) { ?>
  <div class="modal fade" id="reportmodal" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>          
          <h4 class="modal-title" style="">Report Content</h4>
        </div>

        <div class="modal-body">

    <form method="POST" id="formreport" role="form">
      <?php echo $this->lang->line('report_text'); ?>
      <br /><br />
      <div class="append-icon" style="display:none;">
        <input type="text" name="postid" id="postid" value="<?php echo $postid; ?>" class="form-control form-white" required="">
      </div>
      <div class="append-icon">
        <textarea name="desc" id="desc" required="" style="width:100%;" rows="5"></textarea>        
      </div>      
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
      <button type="submit" id="submit-form" class="btn btn-lg button button-green btn-block ladda-button">Submit</button>
      <br />
      <div id="loading" class="alert alert-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> &nbsp;<?php echo $this->lang->line('loading_text'); ?></div>
      <div id="error" class="alert alert-warning" role="alert"></div>
      <div id="confirm" class="alert alert-success" role="alert"></div>      
    </form>

        </div>

      </div>

    </div>
  </div>

  <!-- Begin JavaScript -->
  <script type='text/javascript'>
  jQuery(document).ready(function($){
  jQuery("#formreport").on('submit',(function(e) {
                e.preventDefault();
                var curElement = jQuery(this);
                curElement.find(':submit').hide();

                curElement.find("#error").empty().slideUp();
                curElement.find("#confirm").empty().slideUp();
                curElement.find('#loading').show();

                jQuery.ajax({
                url: "<?php echo base_url(); ?>user/reportcontent",
                type: "POST",
                dataType: 'json',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    curElement.find('#loading').hide();
                    if (data.result == "confirm") { $('#desc').val(''); $('#reportmodal').modal('hide'); }
                    curElement.find("#"+data.result).html(data.message).slideDown();
                    curElement.find(':submit').show();
                }
                });
        }));
  });
  </script>
  <?php } ?>




<script type='text/javascript'>
jQuery(document).ready(function($){     
$('.contenttext a[href^="http"]').attr('rel','nofollow');        

<?php if($this->session->userdata('logged_in')) { ?>
jQuery('.upvotebtn').click(function() 
{
    var id = $(this).attr('data-id');
    var a = $(this);

                jQuery.post("<?php echo base_url() ?>stories/upvote", { id: id, <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>' },
                function(data){
                           a.find('.numvotes').html(data.votes);
                           a.find('.score').removeClass(data.ant).addClass(data.dep);
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

});
</script>
                    <?php $this->session->set_flashdata('ui', $postby); ?>

                    <?php endif; ?>





                

