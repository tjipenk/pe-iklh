<?php
    $sliderp = $this->stories_model->get_slider($this->option_model->get_value('appslidertype'));                 
?>

                
<div id="swiper-slideshow" class="owl-carousel owl-theme" style="margin-bottom:20px;">
            <?php foreach($sliderp as $sli): ?>
            <?php $link = base_url()."stories/article/".$sli['post_slug']; ?>

            <div class="item" style="background-image:url('<?php echo base_url()."images/".$sli['post_image']; ?>');background-size:cover;min-height:280px;">                
                <div class="item-overlay"> </div>
                
                <div class="captionslideshow">
                    <div class="cat"><span><?php echo $sli['category_name']; ?></div> <br />                                              
                    <h2 class="upper posts-masonry-heading" style="clear:both;">
                        <a href="<?php echo $link; ?>"><?php echo mb_substr($sli['post_subject'],0,200).'...'; ?></a>
                    </h2>                  
                </div>     
            </div>
            <?php endforeach; ?>            
        </div>
    </div>


    <!-- Main Content -->
    <div class="maincontent" style="background:none;">



    <div>   


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


     


    <?php if ($this->option_model->get_value('appcarousel') == "1") { ?>

        <div class="container">

            <?php 
                $sliderp = $this->stories_model->get_slider($this->option_model->get_value('appslidertype')); 
                $sx = 0;
                $som = 0;
                $total = $this->option_model->get_value('appsliderlimit');
                if (count($sliderp)>0) {
                while ($sx < $total) {
            ?>
            <div id="slideshow" class="row" style="min-height:505px;margin:10px 0px;display:none;">

                <div class="itemslide col-md-6" style="position:relative;padding-right:0;">
                        <?php $link = base_url()."stories/article/".$sliderp[$som+$sx]['post_slug']; ?>                
                        <div class="overlay-dark">
                            <div class="imageslider" style="background-image:url('<?php echo base_url()."images/".$sliderp[$som+$sx]['post_image']; ?>');background-size:cover;min-height:505px;"></div>
                        </div>
                        <div class="summary caption">
                                <div class="upper posts-masonry-category">
                                    <div class="cat"><span><?php echo $sliderp[$som+$sx]['category_name']; ?></div>                                
                                </div>                                
                                    <h2 class="upper posts-masonry-heading">
                                    <a href="<?php echo $link; ?>" style="font-size: 36px;line-height:42px;">
                                    <?php echo mb_substr($sliderp[$som+$sx]['post_subject'],0,50).'...'; ?>
                                    </a>
                                    </h2>                                
                        </div>
                        <?php if ($sliderp[$som+$sx]['post_type'] == "video") { ?>
                        <span class="icon-play" style="position: absolute;width: 100%;height: 100%;top: 0px;bottom: 0;left: 0;right: 0;margin: auto;"></span>
                        <?php } ?>
                </div>
                <div class="col-md-6">

                    <div class="row" style="margin-bottom: 15px;">
                        <div class="itemslide col-md-6" style="position:relative;padding-right:0;">


                                <?php $link = base_url()."stories/article/".$sliderp[$som+$sx+1]['post_slug']; ?>                
                                <div class="overlay-dark">
                                <div class="imageslider" style="background-image:url('<?php echo base_url()."images/".$sliderp[$som+$sx+1]['post_image']; ?>');background-size:cover;min-height:245px;"></div>                                
                                </div>
                                <div class="summary caption">
                                        <div class="upper posts-masonry-category">
                                            <div class="cat"><span><?php echo $sliderp[$som+$sx+1]['category_name']; ?></div>                                
                                        </div>                                
                                            <h2 class="upper posts-masonry-heading">
                                            <a href="<?php echo $link; ?>">
                                            <?php echo mb_substr($sliderp[$som+$sx+1]['post_subject'],0,30).'...'; ?>
                                            </a>
                                            </h2>                                
                                </div>
                                <?php if ($sliderp[$som+$sx+1]['post_type'] == "video") { ?>
                                <span class="icon-play" style="position: absolute;width: 100%;height: 100%;top: -20px;bottom: 0;left: 0;right: 0;margin: auto;"></span>
                                <?php } ?>

                            
                        </div>
                        <div class="itemslide col-md-6" style="position:relative;">
                            


                                <?php $link = base_url()."stories/article/".$sliderp[$som+$sx+2]['post_slug']; ?>                
                                <div class="overlay-dark">
                                    <div class="imageslider" style="background-image:url('<?php echo base_url()."images/".$sliderp[$som+$sx+2]['post_image']; ?>');background-size:cover;min-height:245px;"></div>
                                </div>
                                <div class="summary caption">
                                        <div class="upper posts-masonry-category">
                                            <div class="cat"><span><?php echo $sliderp[$som+$sx+2]['category_name']; ?></div>                                
                                        </div>                                
                                            <h2 class="upper posts-masonry-heading">
                                            <a href="<?php echo $link; ?>">
                                            <?php echo mb_substr($sliderp[$som+$sx+2]['post_subject'],0,30).'...'; ?>
                                            </a>
                                            </h2>                                
                                </div>
                                <?php if ($sliderp[$som+$sx+2]['post_type'] == "video") { ?>
                                <span class="icon-play" style="position: absolute;width: 100%;height: 100%;top: -20px;bottom: 0;left: 0;right: 0;margin: auto;"></span>
                                <?php } ?>



                        </div>
                    </div>

                    <div class="row">
                        <div class="itemslide col-md-6" style="position:relative;padding-right:0;">



                            <?php $link = base_url()."stories/article/".$sliderp[$som+$sx+3]['post_slug']; ?>                
                                <div class="overlay-dark">
                                    <div class="imageslider" style="background-image:url('<?php echo base_url()."images/".$sliderp[$som+$sx+3]['post_image']; ?>');background-size:cover;min-height:245px;"></div>
                                </div>
                                <div class="summary caption">
                                        <div class="upper posts-masonry-category">
                                            <div class="cat"><span><?php echo $sliderp[$som+$sx+3]['category_name']; ?></div>                                
                                        </div>                                
                                            <h2 class="upper posts-masonry-heading">
                                            <a href="<?php echo $link; ?>">
                                            <?php echo mb_substr($sliderp[$som+$sx+3]['post_subject'],0,30).'...'; ?>
                                            </a>
                                            </h2>                                
                                </div>
                                <?php if ($sliderp[$som+$sx+3]['post_type'] == "video") { ?>
                                <span class="icon-play" style="position: absolute;width: 100%;height: 100%;top: -20px;bottom: 0;left: 0;right: 0;margin: auto;"></span>
                                <?php } ?>


                            
                        </div>
                        <div class="itemslide col-md-6" style="position:relative;">
                            


                            <?php $link = base_url()."stories/article/".$sliderp[$som+$sx+4]['post_slug']; ?>                
                                <div class="overlay-dark">
                                    <div class="imageslider" style="background-image:url('<?php echo base_url()."images/".$sliderp[$som+$sx+4]['post_image']; ?>');background-size:cover;min-height:245px;"></div>
                                </div>
                                <div class="summary caption">
                                        <div class="upper posts-masonry-category">
                                            <div class="cat"><span><?php echo $sliderp[$som+$sx+4]['category_name']; ?></div>                                
                                        </div>                                
                                            <h2 class="upper posts-masonry-heading">
                                            <a href="<?php echo $link; ?>">
                                            <?php echo mb_substr($sliderp[$som+$sx+4]['post_subject'],0,30).'...'; ?>
                                            </a>
                                            </h2>                                
                                </div>
                                <?php if ($sliderp[$som+$sx+4]['post_type'] == "video") { ?>
                                <span class="icon-play" style="position: absolute;width: 100%;height: 100%;top: -20px;bottom: 0;left: 0;right: 0;margin: auto;"></span>
                                <?php } ?>



                        </div>
                    </div>   

                </div>    

            </div>

            <?php $sx++; $som = $som+2; } } ?>



        <div class="swiper-container" style="margin:40px 0px;display:none;">
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
                                    <h2 class="upper posts-masonry-heading" style="font-size: 36px;line-height:42px;">
                                    <?php echo mb_substr($sliderp[$som+$sx]['post_subject'],0,50).'...'; ?>
                                    </h2>                                
                            </div>
                            <?php if ($sliderp[$som+$sx]['post_type'] == "video") { ?>
                            <span class="icon-play" style="position: absolute;width: 100%;height: 100%;top: 130px;bottom: 0;left: 45%;right: 0;margin: auto;background-color: rgba(0, 0, 0, 0.5);"></span>
                            <?php } ?>
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
                                <?php if ($sliderp[$som+$sx+1]['post_type'] == "video") { ?>
                                <span class="icon-play" style="position: relative;width: 100%;height: 100%;top: 130px;bottom: 0;left: 45%;right: 0;margin: auto;background-color: rgba(0, 0, 0, 0.5);"></span>
                                <?php } ?>
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
                                    <?php if ($sliderp[$som+$sx+2]['post_type'] == "video") { ?>
                                    <span class="icon-play" style="position: relative;width: 100%;height: 100%;top: 130px;bottom: 0;left: 45%;right: 0;margin: auto;background-color: rgba(0, 0, 0, 0.5);"></span>
                                    <?php } ?>
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
        </div>













    
    <?php } ?> 



        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
				
				
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
                
                <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <h2 class="areatitle newstitle" style="padding-left:15px;"><?php echo $this->lang->line('recent_text'); ?></h2>
                    </div>    
                    <div class="col-md-8 col-sm-8" style="text-align:right;padding-top:30px;color:#CCC;">
                        

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
				</div>

                
				<div class="container">
                <div class="row">

                <div class="heightequal stories">
                
                    
                   
                </div>  




















                    
                
				</div>

                </div>
                <!-- Today end -->



                <?php $c = 0; foreach($categories as $cat): ?>
                <?php                                                            
                    unset($stories);
                    $this->db->select('posts.*, users.*, COUNT(post_comments.posts_id) AS numbercomments, COUNT(posts_votes.vote_id) AS numbervotes, categories_posts.post_id as postid,categories.category_slug, categories.category_name, categories.id_category'); 
                    $this->db->join('post_comments', 'posts.post_id = post_comments.posts_id', 'left');
                    $this->db->join('posts_votes', 'posts_votes.vote_postid = posts.post_id', 'left');
                    $this->db->join('users', 'posts.post_by = users.user_id', 'left');
                    $this->db->join('categories_posts', 'categories_posts.post_id = posts.post_id', 'left');
                    $this->db->join('categories', 'categories.id_category = categories_posts.id_category', 'left');
                    $this->db->where('posts.approved', 1);
                    $this->db->where('categories.id_category', $cat['id_category']);
                    $this->db->order_by("post_date", "desc");
                    $this->db->group_by("posts.post_id");
                    $query = $this->db->get('posts', 8, $offset);        
                    $data['stories'] = $query->result_array();
                    //$this->output->enable_profiler(TRUE);
                ?>
                <section class="sectionarea" <?php if($c % 2 == 0) { ?>style="background:none;"<?php } ?>>
                <div class="container">                
                <div class="row" style="margin-bottom:20px;">                
                <div class="col-md-12">
                    <h2 class="areatitle newstitle" style="margin-top:0;padding-left:15px;"><?php echo $cat['category_name']; ?></h2>
                    <a href="<?php echo base_url(); ?>stories/category/<?php echo $cat['category_slug']; ?>" class="morepostscat" style="padding-right:15px;">more stories &nbsp;<i class="fa fa-angle-double-right"></i></a>
                </div>
                </div>
                <div class="row">
                <ul class="heightequal owl-carousel owl-theme">
                    
                    <?php $this->load->view('ajaxcontent/stories2', $data); $c++; ?>
                    
                </ul>
                </div>
                </div>
                </section>
                <?php endforeach; ?>
                




                
			</div>

                           
			
            
		</div>
            
	</div>
            
			

<script type='text/javascript'>
jQuery(document).ready(function($){
    
    var num_messages = <?=$num_messages?>;
    var loaded_messages = 0;
    var qtd = 8;
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
            
            var search = $(".searchform input[name=search]").val();
            if (search != "") $(".stories").html("");
            
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


                $('.swiper-posts').slick({
  dots: false,
  infinite: false,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2        
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});


			});
            loaded_messages += 4;
			
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
            loaded_messages_rec += 6;
                        
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