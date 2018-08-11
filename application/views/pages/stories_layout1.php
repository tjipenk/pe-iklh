    <?php $this->load->view('pages/slider'); ?>

    <!-- Main Content -->
    <div class="maincontent container">
        <?php $this->load->view('pages/ads_top'); ?>
        <div class="row">
                    <div class="col-md-8">                  
                        <div class="storiesloadarea">
                            <div class="row">
                                
                                <div class="heightequal storiesaq isotope-container"></div>  
                            </div>
                            <div class="row" style="margin-top:10px;">                                
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
        
        /*$currentIsotopeContainer.isotope({
            itemSelector: 'li.article',
            masonry: {columnWidth: 1}
        });
        jQuery(window).resize(function(){
            $currentIsotopeContainer.isotope('reLayout');
        });*/
        
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
                            //$currentIsotopeContainer.children('li.article').css('opacity','1');                            
                            //$currentIsotopeContainer.isotope( 'reloadItems' ).isotope({ sortBy: 'original-order' });
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
    $('input[name=search]').on('input',function(){var s = $(this).val();if(s.length >= 3){loaded_messages = 0; $(".storiesaq").html(""); $('#more_button_masonry').click();} else if (s.length == 0){ loaded_messages = 0; $(".storiesaq").html(""); $('#more_button_masonry').click(); }});
    $('input[name=search]').bind("keypress", function(e){var code = (e.keyCode ? e.keyCode : e.which);if (code == 13) {e.preventDefault();}});
    $('#more_button_masonry').click();
});
</script>