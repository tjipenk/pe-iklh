<div class="container" id="pagecontent">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4">
                    <div class="account-wall" style="background-color: rgb(255, 255, 255);">
                        <hr class="colorgraph" style="margin:-20px;">
                        <p>&nbsp;</p>
                        <i class="user-img icons-faces-users-03" style="opacity: 1;"></i>
                        <h3 style="margin-bottom:30px;">Please fill new password</h3>
                        <form id="form-password" class="form-password" role="form">
                            <div class="append-icon m-b-20">
                                <input type="password" name="password" class="form-control form-white password" placeholder="Password" required="">
                                <i class="icon-lock"></i>
                            </div>
                            <button type="submit" id="submit-password" class="btn btn-lg btn-danger btn-block ladda-button" data-style="expand-left">Change password</button>                            
                        </form>
						<div id="loading" class="alert alert-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> &nbsp;Please wait...</div>
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
				
				var password = jQuery("#form-password input[name=password]").val();

				jQuery.post("<?php echo base_url() ?>user/recovery_save_newpassword", { password: password, k: '<?php echo $code; ?>', p: 1, <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>' },
				function(data){
                    jQuery('#loading').hide();
                    jQuery("#"+data.result).html(data.message).slideDown();
                    curElement.find(':submit').show();
                    if (data.result == "confirmar") { jQuery('form#form-password').slideUp("fast"); }
				}, "json");
			}));
			                         
	});
</script>