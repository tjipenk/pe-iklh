   <?php 
 
   if($menu!="beranda") { ?>
<style>
.item{

	 -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
	height:150px;
</style> 
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  

  <!-- Wrapper for slides -->
  <div class="carousel-inner"  style="" role="listbox">
  
    <div class="item active">
   
  <div   style="!important;height:100%;width:100%" role="listbox">
  </div>
	 <div class="carousel-caption d-none d-md-block"> <center>
	 <div  style="margin:-80px -170px;background:rgba(0,0,0,0.7);z-index:1000;position:;left:15%;right:15%;padding:20px 20px">
	 <h2 style="color:#fff">Saya Menyembutnya Ekspresi</h2>
	 <p style="color:#fff;font-size:16px;margin-top:10px">Kami percaya bahwa dengan inovasi dan kolaborasi dapat membawa kemajuan bagi Indonesia</p>
	 
	   </div>
	 </center>
	 </div>
    </div>

  
  </div>


 
</div>
  <?php } ?>


    <!-- Main Content -->
    <div class="maincontent container">
        <?php $this->load->view('pages/slider'); ?>
        <div class="row">
                    <div class="col-md-8" style="padding-top:40px;">  
					
                        <div class="storiesloadarea">
                            <div style="margin:0px;"class="row">
                                <div class="loadingposts"><img src="<?php echo base_url();?>images/ajax-loader.gif" /></div>
                                <div class="heightequal storiesaq isotope-container"></div>  
                            </div>
                            <div class="row" style="margin:0px;margin-top:10px;">                                
                                <div class="pager col-md-12">
                                    <a id="more_button_masonry" class="more_button" href="javascript:void(0);"><i class="fa fa-angle-down" style="font-size:15px;"></i>&nbsp;<?php echo $this->lang->line('button_more'); ?></a>                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="sidebar" class="col-md-4" style="padding-left: 5px;">
                        <?php $this->load->view('pages/sidebar'); ?>
                    </div>
        </div>
    </div>
</div>            
</div>
<script src="<?php echo base_url(); ?>js/imagesloaded.pkgd.min.js"></script>  
<script src="<?php echo base_url(); ?>js/jquery.isotope.min.js"></script>
<script type='text/javascript'>
jQuery(document).ready(function($){
    "use strict";
    var loaded_messages = 0;
    var qtd = 11;
    var loaded_messages_rec = 0;
    var filtera = "Most Recent";
    var filterb = "All";
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
                $('.loadingposts').show();
                var search = $(".searchform input[name=search]").val();
                if (loaded_messages == 0) $(".storiesaq").html("");
                $.post("<?php echo base_url(); ?>stories/loadStories_layouts/"+loaded_messages+"/"+<?php echo $layout; ?>, { search: search, filtera: filtera, filterb: filterb,category: category,tag: tag,qtd: qtd,<?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'},
                function(data){
					
					
                    $(".storiesaq").append(data);                    
                    setTimeout(function(){
                            $currentIsotopeContainer.children('li.article').css('opacity','1');                            
                            $currentIsotopeContainer.isotope( 'reloadItems' ).isotope({ sortBy: 'original-order' });
                            $('#more_button_masonry').html("<i class='fa fa-angle-down' style='font-size:15px;'></i>&nbsp;<?php echo $this->lang->line('button_more'); ?>");
                    },1000);
                    $('.loadingposts').hide();
                });
                loaded_messages += qtd;
        });
    });
    jQuery.filtr = function(q) { $('#filtro .txt').html(q);loaded_messages = 0;$(".storiesaq").html("");filtera = q;$('#more_button_masonry').click();}
    jQuery.filtrb = function(q) {$('#dayfilter .txt').html(q);loaded_messages = 0;$(".storiesaq").html("");filterb = q;$('#more_button_masonry').click();}
    $('.filterlinks li a').bind("click", function(e){$('.filterlinks li a.sel').removeClass('sel');$(this).addClass('sel');});   
    $('input[name=search]').on('input',function(){var s = $(this).val();if(s.length >= 3){$("#topslide").hide();loaded_messages = 0; $(".storiesaq").html(""); $('#more_button_masonry').click();} else if (s.length == 0){$("#topslide").show(); loaded_messages = 0; $(".storiesaq").html(""); $('#more_button_masonry').click(); }});
    $('input[name=search]').bind("keypress", function(e){var code = (e.keyCode ? e.keyCode : e.which);if (code == 13) {e.preventDefault();}});
    $('#more_button_masonry').click();
});
</script>