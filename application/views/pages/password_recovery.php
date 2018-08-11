<div class="container" id="pagecontent">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4">
                    <div class="account-wall" style="background-color: rgb(255, 255, 255);">
                        <p>&nbsp;</p>
                        <i class="user-img icons-faces-users-03" style="opacity: 1;"></i>
                        <h3 style="margin-bottom:30px;">Lost Password</h3>
                        <form id="form-password" class="form-password" role="form">
                            <div class="append-icon m-b-20">
                                <input type="email" name="email" class="form-control form-white password" placeholder="E-mail" required="">
                                <i class="icon-lock"></i>
                            </div>

                            <div class="clearfix">
                                
                            

                            <p class="pull-left m-t-20"><button type="submit" id="submit-password" class="button button-green" style="width:auto;">Send</button>&nbsp;<a id="login" href="<?php echo base_url() ?>" class="button button-grey"><?php echo $this->lang->line('cancel_button'); ?></a></p>

                                <p class="pull-right m-t-20"></p>
                                </div>
                        </form>
						<div id="loading" class="alert alert-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> &nbsp;<?php echo $this->lang->line('loading_text'); ?></div>
                        <div id="error" class="alert alert-warning" role="alert"></div>
                        <div id="confirm" class="alert alert-success" role="alert"></div>

                    </div>
                </div>
            </div>     
</div>


<script type="text/javascript">
	jQuery(document).ready(function(){
			//save
			jQuery("#form-password").on('submit',(function(e) {
				e.preventDefault();
                jQuery("#error").empty().slideUp();
                jQuery("#confirm").empty().slideUp();
                jQuery('#loading').show();
                var curElement = jQuery(this);
                curElement.find(':submit').hide();
				
				var email = jQuery("#form-password input[name=email]").val();

				jQuery.post("<?php echo base_url() ?>user/send_recovery_email", { email: email, p: 1, <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>' },
				function(data){
                    jQuery('#loading').hide();
                    jQuery("#"+data.result).html(data.message).slideDown();
                    curElement.find(':submit').show();
                    if (data.result == "confirm") { jQuery('form#form-password').slideUp("fast"); }
				}, "json");
			}));
			                         
	});
</script>