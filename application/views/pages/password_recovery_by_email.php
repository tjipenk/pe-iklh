<div class="container" id="pagecontent">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4">
                    <div class="account-wall" style="background-color: rgb(255, 255, 255);">                        
                        <p>&nbsp;</p>
                        <i class="user-img icons-faces-users-03" style="opacity: 1;"></i>
                        <h3 style="margin-bottom:30px;">Por favor introduza a nova password</h3>
                        <form id="form-password" class="form-password" role="form">
                            <div class="append-icon m-b-20">
                                <input type="password" name="password" class="form-control form-white password" placeholder="Password" required="">
                                <i class="icon-lock"></i>
                            </div>
                            <button type="submit" id="submit-password" class="btn btn-lg btn-danger btn-block ladda-button" data-style="expand-left">Alterar password</button>
                            <div class="clearfix">
                                <p class="pull-left m-t-20"><a id="login" href="<?php echo base_url() ?>login">Fazer login</a></p>
                                <p class="pull-right m-t-20"><a href="<?php echo base_url() ?>">Efetuar registo</a></p>
                            </div>
                        </form>
						<div id="loading" class="alert alert-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> &nbsp;Aguarde por favor...</div>
                        <div id="erro" class="alert alert-warning" role="alert"></div>
                        <div id="confirmar" class="alert alert-success" role="alert"></div>

                    </div>
                </div>
            </div>     
</div>


<script type="text/javascript">
	jQuery(document).ready(function(){
			//save
			jQuery("#form-password").on('submit',(function(e) {
				e.preventDefault();
                jQuery("#erro").empty().slideUp();
                jQuery("#confirmar").empty().slideUp();
                jQuery('#loading').show();
                var curElement = jQuery(this);
                curElement.find(':submit').hide();
				
				var password = jQuery("#form-password input[name=password]").val();

				jQuery.post("<?php echo base_url() ?>login/guardar_nova_password", { password: password, k: '<?php echo $chave; ?>', p: 1, <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>' },
				function(data){
                    jQuery('#loading').hide();
                    jQuery("#"+data.result).html(data.message).slideDown();
                    curElement.find(':submit').show();
                    if (data.result == "confirmar") { jQuery('form#form-password').slideUp("fast"); }
				}, "json");
			}));
			                         
	});
</script>