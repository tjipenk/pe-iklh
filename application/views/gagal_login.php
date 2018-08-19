<style>
.form-control{
	border-radius:0px;
	height:40px
}
</style>
<div class="" id="head">
<div id="pembaur">
</div>
<div class="container text-cente" id="depan" style="height:100%;padding:60px 0 20px">
   <div class="">
<div class="col-md-8" id="depan-konten" style="padding:20px 20px">
<h1 class="depan-konten">Masuk ke Sistem Aplikasi IKLH</h1><br/>
      <h3 class="depan-konten hidden-xs hidden-sm"><cente>Masuk untuk mengakses Aplikasi secara lengkap</cente></h3>
    	 <br/>
	
</div>

		<div id="masuk" class="col-md-4" style="">
		<h3 class="hidden-xs hidden-sm">Masuk</h3>
					<p style="color: #d66"> Maaf anda memasukan username / password yang salah</p>
			<?php echo form_open("login/processlogin",array("method"=>"post"));?>
			
			<br />
			<div class="append-icon">
				<input style="border-bottom:0px"type="text" name="username" id="username" class="form-control form-white username" placeholder="Username" required="">
				
			</div>
			<div class="append-icon m-b-20">
				<input type="password" id="password" name="password" class="form-control form-white password" placeholder="Password" required="">
				
			</div>
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			<button style="margin-top:20px;border-radius:0px" type="submit" id="submit-form" class="btn btn-lg button button-green btn-block ladda-button">Log in</button>
			<br />
			
			
			<div class="clearfix" style="display:none">
				<p class="pull-left m-t-20"><a id="password" href="<?php echo base_url() ?>user/password_recovery"><?php echo $this->lang->line('forgotpassword_button'); ?></a></p>
				
			</div>
		</form>
                        
                    </div>
    </div>  </div>
</div>
    

   
    
    <!-- Main Content -->
   
</div>            
</div>
<script src="<?php echo base_url(); ?>js/imagesloaded.pkgd.min.js"></script>  
<script src="<?php echo base_url(); ?>js/jquery.isotope.min.js"></script>
