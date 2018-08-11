        <?php if ($this->option_model->get_value('appgads') == "1") { ?>
        <!-- Ads -->
        <div class="container pubarea" style="margin-top:20px;padding-bottom:15px;">                
                <div class="row">
                    <div class="col-md-12" style="text-align:center;">
                        <a href="<?php echo $this->option_model->get_value('appadvlink'); ?>">
                                <img src="<?php echo $this->option_model->get_value('appadvimgurl'); ?>" style="display:inline-block;" class="img-responsive">
                        </a>                   
                    </div>
                </div>
        </div>
        <?php } ?>

        <?php if ($this->option_model->get_value('appgads') == "2") { ?>
        <div class="container pubarea" style="margin-top:20px;padding-bottom:15px;">                
                <div class="row">
                    <div class="col-md-12" style="text-align:center;">

                        <script type="text/javascript">
                            <!--
                            google_ad_client = "ca-pub-<?php echo $this->option_model->get_value('appgadscode'); ?>";
                            google_ad_slot = "<?php echo $this->option_model->get_value('appgadslot'); ?>";
                            google_ad_width = <?php echo $this->option_model->get_value('appgadswidth'); ?>;
                            google_ad_height = <?php echo $this->option_model->get_value('appgadsheight'); ?>;
                            //-->
                        </script>
                        <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>

                        </div>
                </div>
        </div>
        <?php } ?>

        <?php if ($this->option_model->get_value('appgads') == "3") { echo $this->option_model->get_value('appadscode'); } ?>


    <!-- Main Content -->
    <div class="maincontent container" style="padding-top:15px;">
        


    <?php if ($this->option_model->get_value('appcarousel') == "1") { ?>

        <div class="swiper-container">
        <div class="swiper-wrapper">

            <?php 
                $sliderp = $this->stories_model->get_slider($this->option_model->get_value('appslidertype')); 
                $sx = 0;
                $som = 0;
                $total = $this->option_model->get_value('appsliderlimit');
                if (count($sliderp)>0) {
                while ($sx < $total) {
            ?>
			
            <div class="posts-masonry row row-small-gutter hidden-md hidden-sm hidden-xs swiper-slide">
            
			
			<div class="col-md-6">
                
                <?php $link = base_url()."stories/article/".$sliderp[$som+$sx]['post_slug']; ?>
                <a href="<?php echo $link; ?>">
                <figure class="posts-masonry-rectangle" onclick="location.href = '<?php echo $link; ?>';" style="background-image:url('<?php echo base_url()."images/".$sliderp[$som+$sx]['post_image']; ?>');background-size:cover;min-height:265px;">                        
                            <div class="itembgcolor"></div>
                            <div class="summary caption">
                                <div class="upper posts-masonry-category">
                                    <div class="cat"><span><?php echo $sliderp[$som+$sx]['category_name']; ?></div>                                
                                </div>                                
                                    <h2 class="upper posts-masonry-heading" style="font-size: 28px;line-height:34px;">
                                    <?php echo mb_substr($sliderp[$som+$sx]['post_subject'],0,50).'...'; ?>
                                    </h2>                                
                            </div>   
                </figure>
                </a>                
				                


            </div>
			
            
            
            <div class="col-md-6">
                <div class="row row-small-gutter">
                
                    <div class="col-sm-6">
                            <?php $link = base_url()."stories/article/".$sliderp[$som+$sx+1]['post_slug']; ?>
                            <a href="<?php echo $link; ?>">
                            <figure class="posts-masonry-square-small" onclick="location.href = '<?php echo $link; ?>';" style="background-image:url('<?php echo base_url()."images/".$sliderp[$som+$sx+1]['post_image']; ?>');background-size:cover;min-height:265px;">                                
                                <figcaption>    
									<div class="itembgcolor"></div>
                                    <div class="summary caption">
                                        <div class="upper posts-masonry-category">
                                            <div rel="category" class="cat"><?php echo $sliderp[$som+$sx+1]['category_name']; ?></div>                                        
										</div>
                                        <h2 class="upper posts-masonry-heading">
                                            <?php echo mb_substr($sliderp[$som+$sx+1]['post_subject'],0,30).'...'; ?>                                        
											</h2>
                                        
                                    </div>
                                    
                                </figcaption>
                            </figure>
                            </a>    
                    </div>
                    
                    <div class="col-sm-6">
                                <?php $link = base_url()."stories/article/".$sliderp[$som+$sx+2]['post_slug']; ?>
                                <a href="<?php echo $link; ?>">
                                <figure class="posts-masonry-square-small" onclick="location.href = '<?php echo $link; ?>';" style="background-image:url('<?php echo base_url()."images/".$sliderp[$som+$sx+2]['post_image']; ?>');background-size:cover;min-height:265px;">                                
								<figcaption>  
                                    <div class="itembgcolor"></div>
                                    <div class="summary caption">
                                        <div class="upper posts-masonry-category">
                                            <div rel="category" class="cat"><?php echo $sliderp[$som+$sx+2]['category_name']; ?></div>                                        
										</div>
                                        <h2 class="upper posts-masonry-heading">
                                            <?php echo mb_substr($sliderp[$som+$sx+2]['post_subject'],0,30).'...'; ?>                                        
										</h2>
                                        
                                    </div>
                                    
                                </figcaption>
                            </figure>
                                </a>
                    </div>
                

                </div>
            </div>
		
		
		
		</div>

        <?php $sx++; $som = $som+2; } } ?>


    
        </div>
        <div class="swiper-pagination"></div>
        </div>













    
    <?php } ?> 



        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
            
            <?php if ($this->option_model->get_value('appadvarea1')) { ?>
            <div class="row" style="margin-top: 0px;margin-bottom: 20px;display:none;">
                <div class="col-md-9 col-sm-12" style="padding-right:0;">
                    <?php echo $this->option_model->get_value('appadvarea1'); ?>
                </div>
                <div class="col-md-3 col-sm-12">
                    
                </div>    

            </div>
            <?php } ?>

			<div class="row" style="margin-bottom: 20px;">
            
            <div class="col-md-12 col-sm-12">

                <div class="row">
				<div class="col-md-8 col-sm-12">
                
                

                <div class="pull-left" style="display:none;">
                <div id="filtercategory" class="dropdown" style="margin-left:20px;">
                  <button class="filterposts dropdown-toggle" type="button" data-toggle="dropdown"><span class="txt"><?php echo $this->lang->line('all_text'); ?></span>
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <?php if (count($categories)>0): ?>
                    <li><a href="javascript:void(0);" onclick="filtercat('', '<?php echo $this->lang->line('all_text'); ?>');"><?php echo $this->lang->line('all_text'); ?></a></li>
                    <?php foreach($categories as $cat): ?>
                        <li><a href="javascript:void(0);" onclick="filtercat('<?php echo $cat['id_category']; ?>', '<?php echo $cat['category_name']; ?>');"><?php echo $cat['category_name']; ?></a></li>                    
                    <?php endforeach; ?>
                    <?php endif; ?>    
                  </ul>
                </div>
                </div>

                </div>

               

				
				
                </div>

                
                <!-- Today -->
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <h2 class="areatitle newstitle" style="padding-left:15px;">Stories</h2>
                    </div>    
                    <div class="col-md-8 col-sm-12" style="text-align:right;padding-top:30px;color:#CCC;">
                        

                    <div id="gridselect" class="pull-right" style="padding-top:7px;display:none;">       
                        <a href="javascript:void(0);" class="activ" onclick="changegrid('grid');jQuery(this).addClass('activ');"><i class="fa fa-th-large"></i></a>
                        &nbsp;<a href="javascript:void(0);" onclick="changegrid('list');jQuery(this).addClass('activ');"><i class="fa fa-th-list" style="font-size: 14px;"></i></a>
                    </div>




                        <div class="pull-right search-icon" style="padding-top:7px;margin-right:20px;"> 
                <a href="javascript:void(0);" onclick="jQuery('.search-form').toggle();"><i class="fa fa-search"></i></a>
                <form class="control-style1 style2-form pull-right search-form" style="display:none;">
                    <div class="style2-input">
                        <input type="text" id="search" name="search" placeholder="<?php echo $this->lang->line('search_text'); ?>">
                    </div>
                </form>
                </div>




                        <div class="pull-right" style="display:none;">                
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
                    
                        
                    </div>
                </div>    

                

                <div class="row">

                

                <ul class="stories col-sm-12">
                    
                    

                </ul>        

                <!-- Pager -->
                <ul class="pager">
                    <li class="center">
                        <a id="more_button" href="javascript:void(0);"><i class="fa fa-angle-down" style="font-size:15px;"></i>&nbsp;<?php echo $this->lang->line('button_more'); ?></a>
                    </li>
                </ul>
				</div>
                <!-- Today end -->


                
			</div>

                           
			
            
		</div>
            
	</div>
            
			

<script type='text/javascript'>
jQuery(document).ready(function($){
    
    var num_messages = <?=$num_messages?>;
    var loaded_messages = 0;
    var qtd = 12;
    var loaded_messages_rec = 0;
    var filtera = "Most Recent";
    var filterb = "";
    var show = "grid";

    <?php if (isset($category) != "") { ?>var category = "<?php echo $category; ?>";<?php } else { ?>var category = "";<?php } ?> 
    <?php if (isset($tag) != "") { ?>var tag = "<?php echo $tag; ?>";<?php } else { ?>var tag = "";<?php } ?> 
    $("#more_button").click(function(){
        loadStories(); 
    });
	
	loadStories  = function() 
    {
            
            var search = $(".search-form input[name=search]").val();
            
			$.post("<?php echo base_url(); ?>stories/loadStories2/"+loaded_messages, {
                search: search,
				filtera: filtera,
                category: category,
                tag: tag,
                show: show,
                qtd: qtd,
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			function(data){
				$(".stories").append(data);             
			});
            loaded_messages += qtd;
			
			if(loaded_messages >= num_messages)
            {
                $("#more_button").hide();
            }
    }

    

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

    loadTopAuthors  = function() 
    {            
            $.post("<?php echo base_url(); ?>stories/loadtopauthors/", {
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            function(data){
                $(".topauthors").append(data);
            });
    }

    filtr = function(q) {
        $('#filtro .txt').html(q);
        $('.newstitle').html(q+" <span>News</span>");
        loaded_messages = 0;
        $(".stories").html("");
        filtera = q;
		loadStories();
    }

    changegrid = function(q) {
        loaded_messages = 0;
        $(".stories").html("");
        show = q;
        $('#gridselect a.activ').removeClass('activ');        
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
    loadRecent();
    loadTopAuthors();
    
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