<?php
    $sliderp = $this->stories_model->get_slider($this->option_model->get_value('appslidertype'));                 
    $categories = $this->stories_model->get_categories();
?>
<?php if ($this->option_model->get_value('appcarousel') == "1") { ?>
<div id="swiper-slideshow" class="owl-carousel owl-theme" style="margin-bottom:20px;">
            <?php foreach($sliderp as $sli): ?>
            <?php $link = base_url()."stories/article/".$sli['post_slug']; ?>

            <div class="item" style="min-height:280px;">                
                <a href="<?php echo $link; ?>"><img src="<?php echo base_url()."images/".$sli['post_image']; ?>" style="max-height:280px;" /></a>
                
                
                <div class="captionslideshow">
                    <div class="cat" style="background-color:#<?php echo $sli['category_color']; ?>;"><span><?php echo $sli['category_name']; ?></div> <br />                                              
                    <h2 class="upper posts-masonry-heading" style="clear:both;">
                        <a href="<?php echo $link; ?>"><?php echo mb_substr($sli['post_subject'],0,50).'...'; ?></a>
                    </h2>                  
                </div>     
            </div>
            <?php endforeach; ?>            
        </div>
    </div>    
<?php } ?>


    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12">
                

			<div class="row" style="margin-top: 20px;margin-bottom: 20px;">
            <div class="col-md-9 col-sm-12">

                <div class="row">
				<div class="col-md-8 col-sm-12">
                
                <div class="pull-left">                
                 <div id="filtro" class="dropdown">
                          <button class="filterposts dropdown-toggle" type="button" data-toggle="dropdown"><span class="txt"><?php echo $this->lang->line('recent_text'); ?></span>
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li><a href="javascript:void(0);" onclick="filtr('Most Recent');"><?php echo $this->lang->line('recent_text'); ?></a></li>
                            <li><a href="javascript:void(0);" onclick="filtr('Most Popular');"><?php echo $this->lang->line('popular_text'); ?></a></li>                            
                            <li><a href="javascript:void(0);" onclick="filtr('Most Comment');"><?php echo $this->lang->line('mostcomment_text'); ?></a></li>
                            <li><a href="javascript:void(0);" onclick="filtr('Today');"><?php echo $this->lang->line('today_text'); ?></a></li>
                            <li><a href="javascript:void(0);" onclick="filtr('Yesterday');"><?php echo $this->lang->line('yesterday_text'); ?></a></li>
                            <li><a href="javascript:void(0);" onclick="filtr('Week');"><?php echo $this->lang->line('week_text'); ?></a></li>
                            <li><a href="javascript:void(0);" onclick="filtr('Month');"><?php echo $this->lang->line('month_text'); ?></a></li>
                            <li><a href="javascript:void(0);" onclick="filtr('Year');"><?php echo $this->lang->line('year_text'); ?></a></li>                            
                          </ul>
                        </div>
                </div>

                <div class="pull-left">
                <div id="filtercategory" class="dropdown" style="margin-left:20px;">
                  <button class="filterposts dropdown-toggle" type="button" data-toggle="dropdown"><span class="txt"><?php echo $this->lang->line('all_text'); ?></span>
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <?php if (count($categories)>0): ?>
                    <li><a href="javascript:void(0);" onclick="filtercat('', '<?php echo $this->lang->line('all_text'); ?>');"><?php echo $this->lang->line('all_text'); ?></a></li>
                    <?php foreach($categories as $cat): ?>
                        <li><a href="javascript:void(0);" onclick="filtercat('<?php echo $cat['category_slug']; ?>', '<?php echo $cat['category_name']; ?>');"><?php echo $cat['category_name']; ?></a></li>                    
                    <?php endforeach; ?>
                    <?php endif; ?>    
                  </ul>
                </div>
                </div>

                </div>

               

				
				<div class="col-md-4 col-sm-12">
				<p style="clear:both;" class="visible-xs"></p>
                <form class="control-style1 style1-form pull-right search-form">
					<label class="style1-open" for="q">
						<i class="fa fa-search"></i>
					</label>      
					<div class="style1-input">
						<input type="text" id="search" name="search" placeholder="<?php echo $this->lang->line('search_text'); ?>">
					</div>
				</form>
				</div>
                </div>

                <div class="row">

                <ul class="stories col-sm-12">
                    
                    

                </ul>        

                <!-- Pager -->
                <ul class="pager">
                    <li class="center">
                        <a id="more_button" href="javascript:void(0);"><?php echo $this->lang->line('button_more'); ?></a>
                    </li>
                </ul>
				</div>
                
			</div>
			
            <div class="col-md-3 col-sm-12">
				
				
				<p class="visible-xs"></p>
				


                <?php if ($this->option_model->get_value('appadsidebar') == "1") { ?>
                <a href="<?php echo $this->option_model->get_value('appadvlink'); ?>">
                <img src="<?php echo $this->option_model->get_value('appadvimgurl'); ?>" style="display:inline-block;" class="img-responsive">
                </a>    
                <?php } ?>



        <?php if ($this->option_model->get_value('appgads') == "1") { ?>
            <script type="text/javascript">
                <!--
                google_ad_client = "ca-pub-<?php echo $this->option_model->get_value('appgadscode'); ?>";
                google_ad_slot = "<?php echo $this->option_model->get_value('appgadslot'); ?>";
                google_ad_width = <?php echo $this->option_model->get_value('appgadswidth'); ?>;
                google_ad_height = <?php echo $this->option_model->get_value('appgadsheight'); ?>;
                //-->
                </script>
                <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
        <?php } ?>
				

                <h2 class="areatitle"><?php echo $this->lang->line('topauthors'); ?></h2>

                <ul class="topauthors">

                    <?php if (count($authors)>0): ?>

                    <?php foreach($authors as $aut): ?>

                    <!-- post -->
                    <li class="col-sm-6 col-md-12">

                       
                       <div class="row">
                            
                            <div class="col-md-2">
                            <?php
                                if (strlen($aut['user_avatar']) > 2) {
                                    $grav_url = base_url()."/images/avatar/".$aut['user_avatar'];
                                } else if (strlen($aut['user_facebookid']) > 2) {
                                    $grav_url = "https://graph.facebook.com/".$aut['user_facebookid']."/picture";
                                } else if (strlen($aut['user_twitterid']) > 2) {                                    
                                    $grav_url = "https://twitter.com/".$aut['user_twittername']."/profile_image?size=original";
                                } else {
                                    $email = $aut['user_email'];
                                    $default = $this->option_model->get_value('appusernophoto');
                                    $size = 30;
                                    $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
                                }                                
                            ?>
                            <img src="<?php echo $grav_url; ?>" class="img-circle" style="max-height:30px;" alt="" />

                            </div>

                            <div class="col-md-10">
                            <h2><a style="font-size: 15px;" href="<?php echo base_url(); ?>u/<?php echo $aut['user_slug']; ?>"><?php echo $aut['user_name']." ".$aut['user_lastname']; ?></a></h2>
                            <small><?php echo $aut['numberposts']; ?> Posts</small>
                            </div>

                        </div>



                    </li>
                    <!-- end post -->

                    <?php endforeach; ?>
                    <?php else: ?>  
                        <br />
                        <span style="font-size:16px;color:#888;">No users found.</span>
                        <br /><br />
                    <?php endif; ?>

                </ul> 




                <p>&nbsp;</p>


				<h2 class="areatitle"><?php echo $this->lang->line('populartags'); ?></h2>
                <br style="clear:both;">

                <div class="tagcloud">
                    <?php if (isset($tags)): ?>
                    <?php foreach($tags as $ta): ?>
                        <a href="<?php echo base_url(); ?>stories/tag/<?php echo $ta['tag_slug']; ?>"><?php echo $ta['tag_name']; ?></a>                    
                    <?php endforeach; ?>
                    <?php endif; ?>    
                    
                </div>
				
				
				
				
			</div>
		</div>
            
	</div>
            
			

<script type='text/javascript'>
jQuery(document).ready(function($){
    
    var num_messages = <?=$num_messages?>;
    var loaded_messages = 0;
    var filtera = "Popular";
    <?php if (isset($category) != "") { ?>var category = "<?php echo $category; ?>";<?php } else { ?>var category = "";<?php } ?> 
    $("#more_button").click(function(){
        loadStories(); 
    });
	
	/*loadStories  = function() 
    {
            
            var search = $(".search-form input[name=search]").val();
            
			$.post("<?php echo base_url(); ?>stories/loadStories/"+loaded_messages, {
                search: search,
				filtera: filtera,
                category: category,
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			function(data){
				$(".stories").append(data);
			});
            loaded_messages += 10;
			
			if(loaded_messages >= num_messages)
            {
                $("#more_button").hide();
            }
    }*/

    var currentRequest = null;
    loadStories = function(){
        var search = $(".search-form input[name=search]").val();
        currentRequest = $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>stories/loadStories/"+loaded_messages,
            data:{
                search: search,
                filtera: filtera,
                category: category,    
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'            
            },
            beforeSend: function(data){
                if(currentRequest != null) {
                    currentRequest.abort();                    
                }                
            },
            success: function(data){                
                $(".stories").append(data);
                loaded_messages += 10;
                if(loaded_messages >= num_messages){
                    $("#more_button").hide();
                }
            },
         });
    }

    filtr = function(q) {
        $('#filtro .txt').html(q);
        loaded_messages = 0;
        $(".stories").html("");
        filtera = q;
		loadStories();
    }

    filtercat = function(q, t) {
        $('#filtercategory .txt').html(t);
        //$('.menu').find('a[data-sel="'+q+'"]').addClass
        loaded_messages = 0;
        $(".stories").html("");
        category = q;
        loadStories();
    }

    loadStories();
    
    $('input[name=search]').on('input',function(){
        var s = $(this).val();
        if(s.length >= 3){
            loaded_messages = 0; $(".stories").html(""); loadStories();
        } else if (s.length == 0){ loaded_messages = 0; $(".stories").html(""); loadStories(); }
    });

    $('input[name=search]').bind("keypress", function(e){
         var code = (e.keyCode ? e.keyCode : e.which);
        if (code == 13) { //Enter keycode                        
            e.preventDefault();
        }       
    });
    
});
</script>