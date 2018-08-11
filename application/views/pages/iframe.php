<?php foreach($stories as $sto): ?>
<iframe id="iframe" src="<?php echo $sto['post_url']; ?>" style=" width: 100%;height: 100%;min-height: 100%;padding: 0em;margin: 0em;border: 0em;"></iframe>
<?php endforeach; ?>
<script>
$(function(){
    var windowH = $(window).height();    
    $('body').css({'overflow':'hidden'});
    $('#iframe').css({'height':($(window).height()-$('header').height())+'px'});
    $(window).resize(function(){
        var windowH = $(window).height();
        $('#iframe').css({'height':($(window).height()-$('header').height())+'px'});
    })
});
</script>