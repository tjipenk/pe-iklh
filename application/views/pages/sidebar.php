<?php 

    $trendingposts = $this->stories_model->get_trending_posts(5); 

?>


                    <div class="row hide">
                        <div class="col-md-12" style="margin-top:40px;">
                            
                            <div class="article" style="background-color:#FFF;">
                             <div class="" style="border: 1px solid #ecf0f1;box-shadow: 0 1px 6px rgba(0,0,0,0.04);">   

                            <h3><i class="fa fa-user"></i><?php echo $this->lang->line('topauthors'); ?></h3>
                            
                            <div id="topauthors">
                            <?php if (isset($authors)): ?>
                            <?php foreach($authors as $au): ?>
                            <div class="row" style="padding-bottom:15px;">
                            
                            <div class="col-md-12 col-sm-12 col-lg-12">
                            
                            <?php
                                if (strlen($au['user_avatar']) > 2) {
                                    $grav_url = base_url()."/images/avatar/".$au['user_avatar'];
                                } else if (strlen($au['user_facebookid']) > 2) {
                                    $grav_url = "https://graph.facebook.com/".$au['user_facebookid']."/picture";
                                } else if (strlen($au['user_twitterid']) > 2) {                                    
                                    $grav_url = "https://twitter.com/".$au['user_twittername']."/profile_image?size=original";
                                } else {
                                    $email = $au['user_email'];
                                    $default = $this->option_model->get_value('appusernophoto');
                                    $size = 30;
                                    $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
                                }                                
                            ?>
                            <img src="<?php echo $grav_url; ?>" class="pull-left img-circle" style="max-height:30px;margin-top:10px;" alt="" />
                                <div class="pull-left" style="padding-left:10px;">
                                    <h2><a href="<?php echo base_url(); ?>user/vprofile/<?php echo $au['user_slug']; ?>"><?php echo $au['user_name']." ".$au['user_lastname']; ?></a></h2>
                                    <small><?php echo $au['numberposts']; ?> Posts</small>
                                </div>
                            </div>
                            

                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?> 
                    </div>



                        <br style="clear: both;">
                </div>
                </div>


                        </div>
                    </div>
					<br/>

                        <div class="article " style="background-color:#FFF;">
                             <div class="" style="border: 1px solid #ecf0f1;box-shadow: 0 1px 6px rgba(0,0,0,0.04);">
                                
                                <h3><i class="fa fa-level-up"></i>Diskusi terpopuler</h3>
                                
                                

                                <ul class="trendingposts" style="margin-top: 0px;">
                                        

                                  
                    
                    <?php $num=1; foreach($trendingposts as $tre): ?>
                    <li class="col-sm-12 col-md-12">
                        <div class="row">
                        
                            <div class="pull-left vote" style="background:url(<?php echo base_url()."images/".$tre['post_image']; ?>);background-size:cover;"><?php echo $num; ?></div>
                            <div class="pull-left" style="padding-left:20px;width:280px;">
                                <h2><a href="<?php echo base_url(); ?>stories/article/<?php echo $tre['post_slug']; ?>"><?php if (strlen($tre['post_subject']) > 45) { echo mb_substr($tre['post_subject'],0,45)."..."; } else { echo utf8_encode($tre['post_subject']); } ?></a></h2>
                                <time datetime="" style="font-size: 11px;color: #CCC;"><i class="fa fa-clock-o"></i>&nbsp;<?php echo $this->stories_model->calculartempo($tre['post_date'], date("Y-m-d H:i:s")); ?></time>
                            </div>

                        </div>
                    </li>
                    <?php $num++; endforeach; ?>

                    <br style="clear:both;" />
                </ul>
                    


                             </div>
                        </div>

                        <br />

                        <div class="row">
                        <div class="col-md-12">



                        <br />

                        <!--<div class="row">
                        <div class="col-md-12">
                  <div class="fb-page" data-href="<?php echo $this->option_model->get_value('appfacebookurl'); ?>" data-adapt-container-width="true" data-adapt-container-height="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?php echo $this->option_model->get_value('appfacebookurl'); ?>"><a href="<?php echo $this->option_model->get_value('appfacebookurl'); ?>">Facebook</a></blockquote></div></div>



                    
                    </div>
                    </div>

                    <br />-->

                    <div class="row hide">
                        <div class="col-md-12">

                        <div class="article" style="background-color:#FFF;">
                             <div class="" style="border: 1px solid #ecf0f1;box-shadow: 0 1px 6px rgba(0,0,0,0.04);">    

                    <h3><i class="fa fa-tags"></i><?php echo $this->lang->line('populartags'); ?></h3>

                <div class="tagcloud">
                    <?php if (isset($tags)): ?>
                    <?php foreach($tags as $ta): ?>
                        <a href="<?php echo base_url(); ?>stories/tag/<?php echo $ta['tag_slug']; ?>"><?php echo $ta['tag_name']; ?></a>                    
                    <?php endforeach; ?>
                    <?php endif; ?>    
                    
                </div>

                <br style="clear: both;">
                <br />
                </div>
                </div>


                </div>
                    </div>

                    <br />

