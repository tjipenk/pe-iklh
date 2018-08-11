<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">    
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.js"></script>
<div class="container" id="pagecontent">
            <div class="row">
                <div class="col-sm-8 col-md-8 col-md-offset-2">
                    <div class="account-wall" style="margin:30px 0px;">                        
                        
                        <h3 style="margin-top:0;">
                        Poll
                        </h3>
                        <br />

        <script src="<?php echo base_url('js/jQuery.WMAdaptiveInputs.js'); ?>"></script>

		<?php echo form_open('polls/create', array('id' => 'pollarea', 'class' => 'adpt_inputs_form')); ?>		
		<div>
		<div class="append-icon" style="margin-top:10px;">
                                    <div id="filtercategory" class="dropdown">
                                      <button class="filterposts dropdown-toggle" type="button" data-toggle="dropdown"><span class="txt"><?php echo $this->lang->line('selectcategory'); ?></span>
                                      <span class="caret"></span></button>
                                      <ul class="dropdown-menu">
                                        <?php if (count($categories)>0): ?>
                                        <?php foreach($categories as $cat): ?>
                                            <li><a href="javascript:void(0);" onclick="filtercat('<?php echo $cat['id_category']; ?>', '<?php echo $cat['category_name']; ?>');"><?php echo $cat['category_name']; ?></a></li>                    
                                        <?php endforeach; ?>
                                        <?php endif; ?>    
                                      </ul>
                                    </div>
                                    <i class="icon-envelope"></i>
		</div>

		<br />
                                <div class="append-icon" style="margin-top:10px;">
                                  <input type="text" name="title" id="title" class="form-control form-white" placeholder="Title" required="">
                                  <i class="icon-envelope"></i>
                                </div>

        <div class="append-icon" style="margin-top:10px;">
            <textarea name="post_text" id="post_text3" class="form-control form-white" placeholder="Post text" rows="6"></textarea>                                
        </div>

        <div class="append-icon row" style="margin-top:10px;background-color:#f8f8f8;border-radius:10px;padding:10px 30px;">                                
                                    <div class="col-md-6">
                                    <?php echo $this->lang->line('uploadimage'); ?>
                                    <input type="file" name="file" id="file" />
                                    <span style="font-size:12px;clear:both;"><?php echo $this->lang->line('maxsize'); ?> 900 Kb</span>
                                    </div>
                                    <div class="col-md-6">
                                      <br />
                                      <button type="button" id="pollsend-image" class="button m-t-20 button-green"><?php echo $this->lang->line('uploadimage'); ?></button>
                                    </div>
                                </div>
                                <div id="fileloading" style="display:none;" class="alert alert-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> &nbsp;<?php echo $this->lang->line('loading_text'); ?></div>
                                <div id="fileerror" style="display:none;" class="alert alert-warning" role="alert"></div>
                                <div id="fileconfirm" style="display:none;" class="alert alert-success" role="alert"></div>
                                <br />
                                <div class="append-icon row" style="margin-top:10px;background-color:#f8f8f8;border-radius:10px;padding:10px 30px;">                                
                                    Or insert full image URL:
                                    <input type="text" name="postimage" id="postimage" class="form-control form-white" required="" placeholder="Image full url" rows="6" />                                
                                </div>

		<div id="poll_options" class="adpt_inputs">
			<p>Options:</p>
			<ol class="adpt_inputs_list"></ol>
			<p><a href="#" class="adpt_add_option btn_add">Add option</a></p>
		</div>

		<div id="pollloading" style="display:none;" class="alert alert-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> &nbsp;<?php echo $this->lang->line('loading_text'); ?></div>
        <div id="pollerror" style="display:none;" class="alert alert-warning" role="alert"></div>
        <div id="pollconfirm" style="display:none;" class="alert alert-success" role="alert"></div>

		<div class="clearfix">	
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />		
        <input type="hidden" id="contentype" name="contentype" value="poll" />
        <input type="hidden" name="category" value="" />
		<p class="pull-left m-t-20"><button type="submit" id="submit-form" class="button m-t-20 button-green">Create</button></p>
        

		</div>
		<?php echo form_close(); ?>
	</div>


<link rel="stylesheet" href="<?php echo base_url(); ?>ckeditor/toolbarconfigurator/lib/codemirror/neo.css">

		<script type="text/javascript" charset="utf-8">
		$(function(){
			

			$('#poll_options').WMAdaptiveInputs({
				minOptions: '<?php echo $min_options; ?>',
				maxOptions: '<?php echo $max_options; ?>',
				inputNameAttr: 'options[]',
				inputClassAttr: 'btn_remove'
			});

			jQuery(".adpt_inputs_form").on('submit',(function(e) {
                e.preventDefault();

                jQuery("#pollerror").empty().slideUp();
                jQuery("#pollconfirm").empty().slideUp();
                jQuery('#pollloading').show();
                var curElement = jQuery(this);
                curElement.find(':submit').hide();

                jQuery.ajax({
                url: "<?php echo base_url(); ?>polls/create",
                type: "POST",
                dataType: 'json',
                data: new FormData(this),
                contentType: false,
                cache: false,             
                processData:false,
                success: function(data)
                {
                    jQuery('#pollloading').hide();
                    jQuery("#"+data.result).html(data.message).slideDown();
                    curElement.find(':submit').show();
                    if (data.result == "pollconfirm") window.location.replace("<?php echo base_url(); ?>");
                }
                });            
            }));

			$("#pollsend-image").click(function(){
            
		            jQuery('#fileloading').show();
		            data = new FormData($("#pollarea")[0]);

		            jQuery.ajax({
		                url: "<?php echo base_url(); ?>polls/uploadimage",
		                type: "POST",
		                dataType: 'json',
		                data: data,
		                contentType: false,
		                cache: false,             
		                processData:false,
		                success: function(data)
		                {
		                    jQuery('#fileloading').hide();
		                    jQuery("#"+data.result).html(data.message).slideDown();                    
		                    if (data.result == "fileconfirm") { $("#pollarea input[name=postimage]").val(data.url) }
		                }
		            });         
		    });

            filtercat = function(q, t) {
                jQuery('#filtercategory .txt').html(t);
                jQuery('input[name=category]').val(q);
            }
			
		});
		</script>


		</div>
		</div>
		</div>
		</div>