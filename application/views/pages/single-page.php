    <!-- Main Content -->
    <br />
    <div class="container maincontent" style="margin-top:25px;background-color:#FFF;border: 1px solid #ecf0f1;box-shadow: 0 1px 6px rgba(0,0,0,0.04);padding-bottom: 40px;">
        <div class="row">
           <div class="col-lg-12 col-md-12 col-sm-12">
            
           <div class="row" style="margin-bottom: 20px;">
            <div class="col-md-9 col-sm-12">

               
                <div style="padding:20px;">
                
                
                <?php if (count($stories)>0): ?>
                <?php foreach($stories as $sto): ?>
                
                <h2 class="areatitle" style="font-size:26px;"><?php echo $sto['title']; ?></h2>

                <div style="padding:5px 20px 20px 0px;clear:both;">
                    <p><?php echo $sto['content']; ?></p>
                </div>

                <?php if ($sto['title'] == "Contact") { ?>
                    
                        
                        <h3><?php echo $this->lang->line('title_contact'); ?></h3>
                        <br />
                        

                        <form id="formcontact" action="" method="post">    
                            <div class="row" style="margin-top:10px;">
                                <div class="col-sm-6">
                                    <div class="append-icon">
                                        <input type="text" name="name" class="form-control form-white" placeholder="<?php echo $this->lang->line('input_firstname'); ?>" required="" autofocus="">
                                        
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="append-icon">
                                        <input type="text" name="lastname" class="form-control form-white lastname" placeholder="<?php echo $this->lang->line('input_lastname'); ?>" required="">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="append-icon" style="margin-top:10px;">
                                <input type="email" name="email" id="email" class="form-control form-white email" placeholder="<?php echo $this->lang->line('input_email'); ?>" required="">
                                
                            </div>
                            <div class="append-icon" style="margin-top:10px;">
                                <input type="text" name="subject" id="subject" class="form-control form-white" placeholder="<?php echo $this->lang->line('input_subject'); ?>" required="">
                                
                            </div>

                            <div class="append-icon" style="margin-top:10px;">
                                <textarea name="message" class="form-control" rows="7"><?php echo $this->lang->line('input_textareacontact'); ?></textarea>                                
                            </div>
                            <br />
                            <div class="append-icon" style="margin-top:10px;">
                                <label for="captcha"><?php echo $captcha['image']; ?></label>
                                <br>
                                <input type="text" class="form-control" autocomplete="off" name="userCaptcha" placeholder="Enter above text" value="<?php if(!empty($userCaptcha)){ echo $userCaptcha;} ?>" />
                            </div>

                            <div class="clearfix">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                <p class="pull-left m-t-20"><button type="submit" id="submit-form" class="button m-t-20 button-green"><?php echo $this->lang->line('submitcontact_button'); ?></button></p>                                
                            </div>

                            <div id="loading" class="alert alert-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> &nbsp;<?php echo $this->lang->line('loading_text'); ?></div>
                            <div id="error" class="alert alert-warning" role="alert"></div>
                            <div id="confirm" class="alert alert-success" role="alert"></div>

                        </form>

                        
                        <script type="text/javascript">
                            jQuery(document).ready(function(){
                               

                                    jQuery("#formcontact").on('submit',(function(e) {
                                        e.preventDefault();
                                        jQuery("#error").empty().slideUp();
                                        jQuery("#confirm").empty().slideUp();
                                        jQuery('#loading').show();
                                        var curElement = jQuery(this);
                                        curElement.find(':submit').hide();

                                        jQuery.ajax({
                                        url: "<?php echo base_url(); ?>pages/contactdata",
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
                                    
                            });
                        </script>


                <?php } ?>

                <?php endforeach; ?>
                <?php else: ?>  
                        <br />
                        <span style="font-size:16px;color:#888;"><?php echo $this->lang->line('nopagefound'); ?></span>
                        <br /><br />
                <?php endif; ?>

                </div>
            
                
			</div>

            <div id="sidebar" class="col-md-3 col-sm-12 sidebar">                
                <h2 class="areatitle"><?php echo $this->lang->line('latestnews'); ?></h2>                

                <ul class="storiesrecent">
                                        

                </ul>  
            </div>                
			
            
		</div>
            
	</div>
            
			

<script type='text/javascript'>
jQuery(document).ready(function($){
   var loaded_messages_rec = 0;
    var filterb = "Recent"; 
    <?php if (isset($category) != "") { ?>var category = "<?php echo $category; ?>";<?php } else { ?>var category = "";<?php } ?> 
   loadRecent  = function() 
    {            
            var search = $(".search-form input[name=search]").val();
            $.post("<?php echo base_url(); ?>stories/loadrecent/"+loaded_messages_rec, {
                search: search,
                filterb: filterb,
                category: category,
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            function(data){
                $(".storiesrecent").append(data);
            });
            loaded_messages_rec += 10;
            
            if(loaded_messages_rec >= num_messages)
            {
                $("#more_button").hide();
            }
    }
    loadRecent();
    
});
</script>