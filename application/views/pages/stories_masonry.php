<?php
    $sliderp = $this->stories_model->get_slider($this->option_model->get_value('appslidertype'));                 
?>

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
    


    <!-- Main Content -->
    <div class="maincontent container" style="background:none;">

	<div class="row">


    <div class="col-md-12">   


        <?php if ($this->option_model->get_value('appgads') == "1") { ?>
        <!-- Ads -->
        <div class="pubarea" style="margin-top:20px;padding-bottom:15px;">                
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
        <div class="pubarea" style="margin-top:20px;padding-bottom:15px;">                
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


                <!-- Today -->
                <div class="row" style="margin-bottom:15px;">
                    
                    <div class="col-md-8 col-sm-8 col-md-offset-2" style="text-align:center;">
                        
               
                        <div id="filtro" class="dropdown" style="display: inline-block;">
                          <button class="filterposts dropdown-toggle" type="button" data-toggle="dropdown"><span class="txt"><?php echo $this->lang->line('recent_text'); ?></span>
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li><a href="javascript:void(0);" onclick="jQuery.filtr('Most Recent');"><?php echo $this->lang->line('recent_text'); ?></a></li>
                            <li><a href="javascript:void(0);" onclick="jQuery.filtr('Most Popular');"><?php echo $this->lang->line('popular_text'); ?></a></li>                            
                            <li><a href="javascript:void(0);" onclick="jQuery.filtr('Most Comment');"><?php echo $this->lang->line('mostcomment_text'); ?></a></li>                           
                          </ul>
                        </div>

                        <div id="dayfilter" class="dropdown" style="display: inline-block;">
                          <button class="filterposts dropdown-toggle" type="button" data-toggle="dropdown"><span class="txt"><?php echo $this->lang->line('today_text'); ?></span>
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li><a href="javascript:void(0);" onclick="jQuery.filtrb('Today');"><?php echo $this->lang->line('today_text'); ?></a></li>
                            <li><a href="javascript:void(0);" onclick="jQuery.filtrb('Yesterday');"><?php echo $this->lang->line('yesterday_text'); ?></a></li>
                            <li><a href="javascript:void(0);" onclick="jQuery.filtrb('Week');"><?php echo $this->lang->line('week_text'); ?></a></li>
                            <li><a href="javascript:void(0);" onclick="jQuery.filtrb('Month');"><?php echo $this->lang->line('month_text'); ?></a></li>
                            <li><a href="javascript:void(0);" onclick="jQuery.filtrb('Year');"><?php echo $this->lang->line('year_text'); ?></a></li>                            
                          </ul>
                        </div>


                    <div id="gridselect" class="pull-right" style="padding-top:7px;display:none;">       
                        <a href="javascript:void(0);" class="activ" onclick="changegrid('grid');jQuery(this).addClass('activ');"><i class="fa fa-th-large"></i></a>
                        &nbsp;<a href="javascript:void(0);" onclick="changegrid('list');jQuery(this).addClass('activ');"><i class="fa fa-th-list" style="font-size: 14px;"></i></a>
                    </div>




                        <div class="search-icon" style="display: inline-block;padding-top:7px;margin-right:20px;"> 
                <a href="javascript:void(0);" onclick="jQuery('.search-form').toggle();"><i class="fa fa-search"></i></a>
                <form class="control-style1 style2-form pull-right search-form" style="display:none;">
                    <div class="style2-input">
                        <input type="text" id="search" name="search" placeholder="<?php echo $this->lang->line('search_text'); ?>">
                    </div>
                </form>
                </div>




                        
                    
                        
                    </div>
                </div>
                <br />

                
                <div class="storiesloadarea">

                <div class="row">

                <div class="heightequal storiesaq isotope-container">
                
                    









                   
                </div>  




















                    
                
				</div>
                
                <div class="row" style="margin-top:10px;">
                <!-- Pager -->
                <div class="pager col-md-12">
                    <a id="more_button_masonry" class="more_button" href="javascript:void(0);"><i class="fa fa-angle-down" style="font-size:15px;"></i>&nbsp;<?php echo $this->lang->line('button_more'); ?></a>                    
                </div>
                </div>
                </div>
                <!-- Today end -->

                </div>
                <!-- Today end -->

                




                
			</div>
			
			
			
			
			
			
			
			</div>

                           
			
            
		</div>
            
	</div>
            
			
<script src="<?php echo base_url(); ?>js/imagesloaded.pkgd.min.js"></script>  
<script src="<?php echo base_url(); ?>js/jquery.isotope.min.js"></script>
<script type='text/javascript'>
jQuery(document).ready(function($){
    

    
    
});

jQuery(document).ready(function($){
    "use strict";

    var num_messages = <?=$num_messages?>;
    var loaded_messages = 0;
    var qtd = 11;
    var loaded_messages_rec = 0;
    var filtera = "Most Recent";
    var filterb = "Today";
    var show = "grid";

    <?php if (isset($category) != "") { ?>var category = "<?php echo $category; ?>";<?php } else { ?>var category = "";<?php } ?> 
    <?php if (isset($tag) != "") { ?>var tag = "<?php echo $tag; ?>";<?php } else { ?>var tag = "";<?php } ?> 

    jQuery('.storiesloadarea').each(function(i){
        var $currentItem=jQuery(this);
        var $currentIsotopeContainer=$currentItem.children('.row').children('.isotope-container');
        
        $currentIsotopeContainer.isotope({
            itemSelector: 'li.article',
            masonry: {columnWidth: 1}
        });
        

        jQuery(window).resize(function(){
            $currentIsotopeContainer.isotope('reLayout');
        });
        
        var $newElements = "";

        $('#more_button_masonry').unbind('click').bind('click',function(e){e.preventDefault();
            
                $(this).html("<i class='fa fa-ellipsis-h' style='font-size:18px;opacity:0.5;'></i>");

                var search = $(".search-form input[name=search]").val();
            
                $.post("<?php echo base_url(); ?>stories/loadStories_masonry/"+loaded_messages, {
                    search: search,
                    filtera: filtera,
                    filterb: filterb,
                    category: category,
                    tag: tag,
                    show: show,
                    qtd: qtd,
                    <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                function(data){
                    $(".storiesaq").append(data);                    
                    setTimeout(function(){
                            $currentIsotopeContainer.children('li.article').css('opacity','1');
                            //css('opacity','1');
                            $currentIsotopeContainer.isotope( 'reloadItems' ).isotope({ sortBy: 'original-order' });
                            $('#more_button_masonry').html("<i class='fa fa-angle-down' style='font-size:15px;'></i>&nbsp;<?php echo $this->lang->line('button_more'); ?>");
                    },1000);

                });
                loaded_messages += 11;

        });
    });


    jQuery.filtr = function(q) {
        $('#filtro .txt').html(q);
        loaded_messages = 0;
        $(".storiesaq").html("");
        filtera = q;
        $('#more_button_masonry').click();
    }

    jQuery.filtrb = function(q) {
        $('#dayfilter .txt').html(q);        
        loaded_messages = 0;
        $(".storiesaq").html("");
        filterb = q;
        $('#more_button_masonry').click();
    }     

    $('input[name=search]').on('input',function(){
        var s = $(this).val();
        if(s.length >= 3){
            loaded_messages = 0; $(".storiesaq").html(""); $('#more_button_masonry').click();
        } else if (s.length == 0){ loaded_messages = 0; $(".storiesaq").html(""); $('#more_button_masonry').click(); }
    });

    $('input[name=search]').bind("keypress", function(e){
         var code = (e.keyCode ? e.keyCode : e.which);
        if (code == 13) { //Enter keycode                        
            e.preventDefault();
        }       
    });

    $('#more_button_masonry').click();

});

</script>