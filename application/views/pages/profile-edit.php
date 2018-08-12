<?php if (count($user)>0): ?>
<?php foreach($user as $use): ?>
<div class="container" id="pagecontent">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-md-offset-3">
                    <div class="account-wall">                        
                        
                        <h3><?php echo $this->lang->line('title_profile'); ?></h3>
                        <br />
                        <i class="user-img icons-faces-users-03"></i>
                        <form id="formregisto" action="" method="post">    
                            

                            <?php
                            if (strlen($this->session->userdata('avatar')) > 2) {
                                $grav_url = base_url()."/images/avatar/".$this->session->userdata('avatar');
                            } else if ($this->session->userdata('User')) {
                                $ses_user=$this->session->userdata('User');
                                $grav_url = "https://graph.facebook.com/".$ses_user['id']."/picture";
                            } else if ($this->session->userdata('twitter')) {
                                $tname=$this->session->userdata('nome');
                                $grav_url = "https://twitter.com/".$tname."/profile_image?size=original";
                            } else {
                                $email = $this->session->userdata('email');
                                $default = $this->option_model->get_value('appusernophoto');
                                $size = 30;
                                $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
                            }
                        ?>


                            <div class="row" style="margin-top:10px;">
                                    <div class="col-sm-4" style="text-align:center;">
                                        <img src="<?php echo $grav_url; ?>" id="previewing" class="img-circle" style="max-height:100px;max-width:100px;" alt="" />
                                    </div>
                                    <div class="col-sm-8">                                    
                                    <label>Select image from computer</label><br/>
                                    <input type="file" name="file" id="file" /><br />                                        
                                    <span style="font-size:12px;">Max file size 200KB</span>
                                </div>
                            </div>

                            <br style="clear:both;" /><br />
                            <div class="row" style="margin-top:10px;">
                                <div class="col-sm-6">
                                    <div class="append-icon">
                                        <input type="text" name="name" class="form-control form-white" placeholder="<?php echo $this->lang->line('input_firstname'); ?>" value="<?php echo $use['user_name']; ?>" required="" autofocus="">
                                        <i class="icon-user"></i>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="append-icon">
                                        <input type="text" name="lastname" class="form-control form-white lastname" placeholder="<?php echo $this->lang->line('input_lastname'); ?>" value="<?php echo $use['user_lastname']; ?>" required="">
                                        <i class="icon-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="append-icon" style="margin-top:10px;">
                                <textarea class="form-control" maxlength="160" name="shortbio" placeholder="<?php echo $this->lang->line('input_shortbio'); ?>" style="width:100%;"><?php echo $use['shortbio']; ?></textarea>
                                <i class="icon-envelope"></i>
                            </div>
                            <div class="append-icon" style="margin-top:10px;">
                                <input type="slug" name="slug" id="slug" class="form-control form-white" placeholder="<?php echo $this->lang->line('input_slug'); ?>" value="<?php echo $use['user_slug']; ?>" required="">                           
                            </div>
                            <div class="append-icon" style="margin-top:10px;">
                                <input type="email" name="email" id="email" class="form-control form-white email" placeholder="<?php echo $this->lang->line('input_email'); ?>" value="<?php echo $use['user_email']; ?>" required="" <?php if ($this->session->userdata('User')) {?>disabled<?php } ?>>
                                <i class="icon-envelope"></i>
                            </div>
                            <div class="append-icon" style="margin-top:10px;">
                                <input type="password" name="password" class="form-control form-white password" placeholder="<?php echo $this->lang->line('input_password'); ?>">
                                <i class="icon-lock"></i>
                            </div>
                            <div class="append-icon" style="margin-top:10px;">
                                <input type="password" name="password2" class="form-control form-white password2" placeholder="<?php echo $this->lang->line('input_confirmpassword'); ?>">
                                <i class="icon-lock"></i>
                            </div>
                            <div class="terms option-group" style="margin-top:30px;">
                                <label for="terms" class="m-t-10">
                                <input type="checkbox" name="newsletter">
                                &nbsp;&nbsp;<span style="font-size:16px;"><?php echo $this->lang->line('checkbox_register'); ?></span>
                                </label>  
                            </div>

                            <div class="append-icon" style="margin-top:20px;">
                                <input type="text" name="website" id="website" class="form-control form-white email" placeholder="<?php echo $this->lang->line('input_website'); ?>" value="<?php echo $use['user_website']; ?>">
                                <i class="icon-envelope"></i>
                            </div>
                            <div class="append-icon" style="margin-top:10px;">
                                <input type="text" name="twitter" id="twitter" class="form-control form-white email" placeholder="<?php echo $this->lang->line('input_twitter'); ?>" value="<?php echo $use['user_twitter']; ?>">
                                <i class="icon-envelope"></i>
                            </div>
                            <div class="append-icon" style="margin-top:10px;">
                                <input type="text" name="gplus" id="gplus" class="form-control form-white email" placeholder="<?php echo $this->lang->line('input_gplus'); ?>" value="<?php echo $use['user_gplus']; ?>">
                                <i class="icon-envelope"></i>
                            </div>
                            <div class="append-icon" style="margin-top:10px;">
                                <input type="text" name="fb" id="fb" class="form-control form-white email" placeholder="<?php echo $this->lang->line('input_fb'); ?>" value="<?php echo $use['user_fb']; ?>">
                                <i class="icon-envelope"></i>
                            </div>
                            <div class="append-icon" style="margin-top:10px;">
                                <input type="text" name="instagram" id="instagram" class="form-control form-white email" placeholder="<?php echo $this->lang->line('input_instagram'); ?>" value="<?php echo $use['user_instagram']; ?>">
                                <i class="icon-envelope"></i>
                            </div>
                            <div class="append-icon" style="margin-top:10px;">
                                <input type="text" name="pinterest" id="pinterest" class="form-control form-white email" placeholder="<?php echo $this->lang->line('input_pinterest'); ?>" value="<?php echo $use['user_pinterest']; ?>">
                                <i class="icon-envelope"></i>
                            </div>
                            
                            
                            <div class="clearfix">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                <p class="pull-left m-t-20"><button type="submit" id="submit-form" class="button m-t-20 button-green"><?php echo $this->lang->line('submit_profile'); ?></button></p>
                                <p class="pull-right m-t-20"><a href="<?php echo base_url() ?>"><?php echo $this->lang->line('cancel_profile'); ?></a></p>
                            </div>

                            <div id="message"></div>
                            <div id="loading" class="alert alert-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> &nbsp;<?php echo $this->lang->line('loading_text'); ?></div>
                            <div id="error" class="alert alert-warning" role="alert"></div>
                            <div id="confirm" class="alert alert-success" role="alert"></div>

                        </form>
                    </div>
                
<?php endforeach; ?>

</div>
                    

<script type="text/javascript">
    jQuery(document).ready(function(){
       

            jQuery("#formregisto").on('submit',(function(e) {
                e.preventDefault();
                jQuery("#error").empty().slideUp();
                jQuery("#confirm").empty().slideUp();
                jQuery('#loading').show();
                var curElement = jQuery(this);
                curElement.find(':submit').hide();

                jQuery.ajax({
                url: "<?php echo base_url(); ?>user/updatedata",
                type: "POST",
                dataType: 'json',
                data: new FormData(this),
                contentType: false,
                cache: false,             
                processData:false,
                success: function(data)
                {
                    jQuery('#loading').hide();
                    jQuery("#"+data.result).html(data.message).slideDown();
                    curElement.find(':submit').show();
                }
                });
                    



            }));


            $("#file").change(function() {
                $("#message").empty();
                var file = this.files[0];
                var imagefile = file.type;
                var match= ["image/jpeg","image/png","image/jpg"];
                if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
                {
                    $('#previewing').attr('src','noimage.png');
                    $("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
                    return false;
                } else {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
            });

            function imageIsLoaded(e) {
                $("#file").css("color","green");
                $('#image_preview').css("display", "block");
                $('#previewing').attr('src', e.target.result);
                $('#previewing').attr('width', '200px');        
            };
            
    });
</script>
<?php else: ?>  
                        <br />
                        <span style="font-size:16px;color:#888;">No user found.</span>
                        <br /><br />
                    <?php endif; ?>