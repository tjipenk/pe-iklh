                    <br />
                    <?php if (count($stories)>0): ?>
                    <?php foreach($stories as $sto): ?>

                    <!-- post -->
                    <li class="col-md-3">

                        <div class="row">
                            
                            <div class="col-md-3">
                            
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
                            <img src="<?php echo $grav_url; ?>" class="img-circle" style="max-height:30px;" alt="" />

                            </div>

                            <div class="col-md-9">
                            <a href="<?php echo base_url(); ?>u/<?php echo $sto['user_slug']; ?>"><?php echo $sto['user_name']." ".$sto['user_lastname']; ?></a>
                            </div>

                        </div>

                    </li>
                    <!-- end post -->

                    <?php endforeach; ?>
                    <?php else: ?>  
                        <br />
                        <span style="font-size:16px;color:#888;">No followers users found.</span>
                        <br /><br />
                    <?php endif; ?>
<script type='text/javascript'>
jQuery(document).ready(function($){                 



});
</script>