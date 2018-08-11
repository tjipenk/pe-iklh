<?php
	if (strlen($this->session->userdata('avatar')) > 2) {
        $grav_url = base_url()."/images/avatar/".$this->session->userdata('avatar');
    } else if ($this->session->userdata('User')) {
        $ses_user=$this->session->userdata('User');
        $grav_url = "https://graph.facebook.com/".$ses_user['id']."/picture";
    } else if ($this->session->userdata('twitter')) {
        $tname=$this->session->userdata('nome');
        $grav_url = "https://twitter.com/".$tname."/profile_image?size=original";
    } else {
        $email = $this->session->userdata('email');
        $default = $this->option_model->get_value('appusernophoto');
        $size = 30;
        $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
    }

    if ($this->option_model->get_value('applayout') == 1) { 
        $nav = 0;
    } else {
        $nav = 1;
    }

?>


<?php 
if (isset($storyid)) {
if (count($stories)>0):
foreach($stories as $sto):
$pagetitle = $sto['post_subject'];
$desc = $sto['post_text'];
$image = $sto['post_image'];
endforeach;
endif; } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    if (isset($desc)) { 
        $desc = str_replace('"', '', $desc);
        $desc = strip_tags(substr($desc,0,157).'...');
    }
    ?>
	  <meta name="apple-mobile-web-app-capable" content="yes"/>
   <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <title><?php if (isset($pagetitle)) { echo $pagetitle." - "; } echo $this->option_model->get_value('appname'); ?></title>
    <?php if (isset($category) != "") { ?>
    <meta name="description" content="<?php echo $this->stories_model->get_category_desc($category); ?>">
    <?php } else { ?>
    <meta name="description" content="<?php if (isset($desc)) { echo $desc; } else { echo $this->option_model->get_value('appdescription'); } ?>">
    <?php } ?> 

    <meta name="keywords" content="">
    <meta name="author" content="">
    <link rel="alternate" type="application/rss+xml" href="<?php echo base_url(); ?>feed/" />

    <meta property="og:title" content="<?php if (isset($pagetitle)) { echo $pagetitle." - "; } echo $this->option_model->get_value('appname'); ?>" />
    <meta property="og:description" content="<?php if (isset($desc)) { echo $desc; } else { echo $this->option_model->get_value('appdescription'); } ?>" />
    <meta property="og:image" content="<?php echo base_url() ?>images/<?php if (isset($image)) { echo $image; } ?>" />

    <?php if ($this->option_model->get_value('appfavicon')) { ?>    
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url(); ?>images/<?php echo $this->option_model->get_value('appfavicon'); ?>"/>
    <?php } ?>
	<!-- stylesheets -->
		 <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">    
		<!-- scripts -->
		<script src="<?php echo base_url(); ?>canvas/assets/js/jquery-3.1.0.min.js"></script>
		<script src="<?php echo base_url(); ?>canvas/assets/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css" rel="stylesheet">
		<!--<script src="http://canvasjs.com/assets/script/canvasjs.min.js"></script>-->
		<style>
		.dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover{
			background:none!important;
			color:#2B3643;
		}

    .progress{
      background: #e74c3c;
      border-radius: 0px
    }
    .progress-bar{
      background: #2B3643
    }
		.canvasjs-chart-credit {
   display: none;
}

.btn-biru{
  background: #2B3643;
  color: #fff;
}
.btn-merah{
  background: #de2d26;
  color: #fff;
  margin-left: 20px
}


.sc_columns > div{
  margin-bottom: 100px;
}

ul, li   { list-style: none;
}

.font-gede:before{
	font-size:30px;
}
.lebar{
	min-width:540px;
}
#cari-form{
	width:100%;
}
.widgetWrap .title{
	font-size:16px!important;
}

.widgetWrap {
    margin-bottom: 20px
}

.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li>a:hover,.nav-tabs>li>a, .nav-tabs>li>a:focus, .nav-tabs>li>a:hover{
    border-radius: 0px!important;
}

.blob {
  width: 2rem;
  height: 2rem;
  background: #2B3643;
  border-radius: 50%;
  position: absolute;
  left: calc(50% - 1rem);
  top: calc(50% - 1rem);

  
}
.load,.load2{
    display: none
}

.blob-2 {
  -webkit-animation: animate-to-2 1.5s infinite;
          animation: animate-to-2 1.5s infinite;
}

.blob-3 {
  -webkit-animation: animate-to-3 1.5s infinite;
          animation: animate-to-3 1.5s infinite;
}

.blob-1 {
  -webkit-animation: animate-to-1 1.5s infinite;
          animation: animate-to-1 1.5s infinite;
}

.blob-4 {
  -webkit-animation: animate-to-4 1.5s infinite;
          animation: animate-to-4 1.5s infinite;
}

.blob-0 {
  -webkit-animation: animate-to-0 1.5s infinite;
          animation: animate-to-0 1.5s infinite;
}

.blob-5 {
  -webkit-animation: animate-to-5 1.5s infinite;
          animation: animate-to-5 1.5s infinite;
}

@-webkit-keyframes animate-to-2 {
  25%, 75% {
    -webkit-transform: translateX(-1.5rem) scale(0.75);
            transform: translateX(-1.5rem) scale(0.75);
  }
  95% {
    -webkit-transform: translateX(0rem) scale(1);
            transform: translateX(0rem) scale(1);
  }
}

@keyframes animate-to-2 {
  25%, 75% {
    -webkit-transform: translateX(-1.5rem) scale(0.75);
            transform: translateX(-1.5rem) scale(0.75);
  }
  95% {
    -webkit-transform: translateX(0rem) scale(1);
            transform: translateX(0rem) scale(1);
  }
}
@-webkit-keyframes animate-to-3 {
  25%, 75% {
    -webkit-transform: translateX(1.5rem) scale(0.75);
            transform: translateX(1.5rem) scale(0.75);
  }
  95% {
    -webkit-transform: translateX(0rem) scale(1);
            transform: translateX(0rem) scale(1);
  }
}
@keyframes animate-to-3 {
  25%, 75% {
    -webkit-transform: translateX(1.5rem) scale(0.75);
            transform: translateX(1.5rem) scale(0.75);
  }
  95% {
    -webkit-transform: translateX(0rem) scale(1);
            transform: translateX(0rem) scale(1);
  }
}
@-webkit-keyframes animate-to-1 {
  25% {
    -webkit-transform: translateX(-1.5rem) scale(0.75);
            transform: translateX(-1.5rem) scale(0.75);
  }
  50%, 75% {
    -webkit-transform: translateX(-4.5rem) scale(0.6);
            transform: translateX(-4.5rem) scale(0.6);
  }
  95% {
    -webkit-transform: translateX(0rem) scale(1);
            transform: translateX(0rem) scale(1);
  }
}
@keyframes animate-to-1 {
  25% {
    -webkit-transform: translateX(-1.5rem) scale(0.75);
            transform: translateX(-1.5rem) scale(0.75);
  }
  50%, 75% {
    -webkit-transform: translateX(-4.5rem) scale(0.6);
            transform: translateX(-4.5rem) scale(0.6);
  }
  95% {
    -webkit-transform: translateX(0rem) scale(1);
            transform: translateX(0rem) scale(1);
  }
}
@-webkit-keyframes animate-to-4 {
  25% {
    -webkit-transform: translateX(1.5rem) scale(0.75);
            transform: translateX(1.5rem) scale(0.75);
  }
  50%, 75% {
    -webkit-transform: translateX(4.5rem) scale(0.6);
            transform: translateX(4.5rem) scale(0.6);
  }
  95% {
    -webkit-transform: translateX(0rem) scale(1);
            transform: translateX(0rem) scale(1);
  }
}
@keyframes animate-to-4 {
  25% {
    -webkit-transform: translateX(1.5rem) scale(0.75);
            transform: translateX(1.5rem) scale(0.75);
  }
  50%, 75% {
    -webkit-transform: translateX(4.5rem) scale(0.6);
            transform: translateX(4.5rem) scale(0.6);
  }
  95% {
    -webkit-transform: translateX(0rem) scale(1);
            transform: translateX(0rem) scale(1);
  }
}
@-webkit-keyframes animate-to-0 {
  25% {
    -webkit-transform: translateX(-1.5rem) scale(0.75);
            transform: translateX(-1.5rem) scale(0.75);
  }
  50% {
    -webkit-transform: translateX(-4.5rem) scale(0.6);
            transform: translateX(-4.5rem) scale(0.6);
  }
  75% {
    -webkit-transform: translateX(-7.5rem) scale(0.5);
            transform: translateX(-7.5rem) scale(0.5);
  }
  95% {
    -webkit-transform: translateX(0rem) scale(1);
            transform: translateX(0rem) scale(1);
  }
}
@keyframes animate-to-0 {
  25% {
    -webkit-transform: translateX(-1.5rem) scale(0.75);
            transform: translateX(-1.5rem) scale(0.75);
  }
  50% {
    -webkit-transform: translateX(-4.5rem) scale(0.6);
            transform: translateX(-4.5rem) scale(0.6);
  }
  75% {
    -webkit-transform: translateX(-7.5rem) scale(0.5);
            transform: translateX(-7.5rem) scale(0.5);
  }
  95% {
    -webkit-transform: translateX(0rem) scale(1);
            transform: translateX(0rem) scale(1);
  }
}
@-webkit-keyframes animate-to-5 {
  25% {
    -webkit-transform: translateX(1.5rem) scale(0.75);
            transform: translateX(1.5rem) scale(0.75);
  }
  50% {
    -webkit-transform: translateX(4.5rem) scale(0.6);
            transform: translateX(4.5rem) scale(0.6);
  }
  75% {
    -webkit-transform: translateX(7.5rem) scale(0.5);
            transform: translateX(7.5rem) scale(0.5);
  }
  95% {
    -webkit-transform: translateX(0rem) scale(1);
            transform: translateX(0rem) scale(1);
  }
}
@keyframes animate-to-5 {
  25% {
    -webkit-transform: translateX(1.5rem) scale(0.75);
            transform: translateX(1.5rem) scale(0.75);
  }
  50% {
    -webkit-transform: translateX(4.5rem) scale(0.6);
            transform: translateX(4.5rem) scale(0.6);
  }
  75% {
    -webkit-transform: translateX(7.5rem) scale(0.5);
            transform: translateX(7.5rem) scale(0.5);
  }
  95% {
    -webkit-transform: translateX(0rem) scale(1);
            transform: translateX(0rem) scale(1);
  }
}
.load{
    display: none
}


.rs_text_color_1,.rs_text_style_1{
  color: #fff!important;
}

.buttonScrollUp{
  display: none!important
}
</style>


<!DOCTYPE html>
<html lang="en-US">

<!-- Mirrored from healthyfarm-html.themerex.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Feb 2017 10:40:02 GMT -->
<head> 
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="format-detection" content="telephone=no">
<link rel="icon" type="image/x-icon" href="images/favicon.ico"/>
<link rel='stylesheet' href='<?php echo base_url(); ?>js/vendor/revslider/rs-plugin/css/settings.css' type='text/css' media='all'/>
<link rel='stylesheet' href='<?php echo base_url(); ?>js/vendor/swiper/idangerous.swiper.css' type='text/css' media='all'/>
<link rel='stylesheet' href='<?php echo base_url(); ?>js/vendor/swiper/idangerous.swiper.scrollbar.css' type='text/css' media='all'/>
<link rel='stylesheet' href='<?php echo base_url(); ?>js/vendor/magnific-popup/magnific-popup.css' type='text/css' media='all'/>
<link rel='stylesheet' href='<?php echo base_url(); ?>css/fontello/css/fontello.css' type='text/css' media='all'/>
<link rel='stylesheet' href='<?php echo base_url(); ?>css/fontello/css/animation.css' type='text/css' media='all'/>
<link rel='stylesheet' href='<?php echo base_url(); ?>css/style.css' type='text/css' media='all'/>
<link rel='stylesheet' href='<?php echo base_url(); ?>css/shortcodes.css' type='text/css' media='all'/>
<link rel='stylesheet' href='<?php echo base_url(); ?>css/responsive.css' type='text/css' media='all'/>

<style>
.wrapTopMenu{
	background:#2B3643;
color:#fff}
.wrapTopMenu .topMenu>ul>li>a{
	color:#fff;
	font-style: normal!important;
	font-size:14px;
	text-transform:none!important;

}

.wrapTopMenu .topMenu>ul>li.current-menu-ancestor>a{
	color:#fff;border-bottom:2px solid #fff;
	
}
.wrapTopMenu .topMenu>ul>li>a{
	margin:0px 8px;
}
.sc_button {
	border-radius:0px!important;
	padding:8px 20px!important
}
#mainmenu li.active a{
	border-bottom:2px solid #fff;
}


#mainmenu li a:hover,{
	border-bottom:2px solid #fff;
	color:#fff!important;
	text-decoration: none!important;
}


#mainmenu .glyphicon {
	font-size:20px;
	margin:10px 10px -15px 0;
}
.wrapTopMenu .topMenu>ul>li>a{
	padding:0px 8px!important;
	margin-bottom:0px
}

#menu-cari li a{
	border-radius:0px;
	margin:0px -1px 0px;
}

#menu-cari li.active{
	margin-bottom:-4px
}
#menu-cari li.active a{
	background:#2B3643;
	
}
.inited{
	color:#fff!important;
}

.icon-mobi span{
	color:#fff!important;
	font-size:20px;
}


/* The Overlay (background) */
.overlay {
    /* Height & width depends on how you want to reveal the overlay (see JS below) */    
    height: 100%;
    width: 0;
    position: fixed; /* Stay in place */
    z-index: 10000; /* Sit on top */
    left: 0;
    top: 0;
    background-color: rgb(0,0,0); /* Black fallback color */
    background-color: rgba(255,255,255,1); /* Black w/opacity */
    overflow-x: hidden; /* Disable horizontal scroll */
    transition: 0.1s; /* 0.5 second transition effect to slide in or slide down the overlay (height or width, depending on reveal) */
}

/* Position the content inside the overlay */
.overlay-content {
    position: relative;
    top: 25%; /* 25% from the top */
    width: 100%; /* 100% width */
    text-align: center; /* Centered text/links */
    margin-top: 30px; /* 30px top margin to avoid conflict with the close button on smaller screens */
}

/* The navigation links inside the overlay */
.overlay a {
    padding: 8px;
    text-decoration: none;
    font-size: 36px;
    color: #818181;
    display: block; /* Display block instead of inline */
    transition: 0.3s; /* Transition effects on hover (color) */
}

/* When you mouse over the navigation links, change their color */
.overlay a:hover, .overlay a:focus {
    color: #f1f1f1;
}

/* Position the close button (top right corner) */
.overlay .closebtn {
    position: absolute;
    top: 20px;
    right: 45px;
    font-size: 60px;
}

/* When the height of the screen is less than 450 pixels, change the font-size of the links and position the close button again, so they don't overlap */
@media screen and (max-height: 450px) {
    .overlay a {font-size: 20px}
    .overlay .closebtn {
        font-size: 40px;
        top: 15px;
        right: 35px;
    }
}

.wrapTopMenu{
  background: #2B3643
}
.wrapTopMenu a{
	font-size:16px!important;
}
.wrapTopMenu a:hover{
	color:#333!important;
	background:none!important;
	font-style:none!important;
	border:0px!important;
}

.dropdown-menu{border-radius:0px;border:0px!important;
}

.story-link{
 text-transform: none!important;
}
#header .openTopMenu, .menuStyle2 .wrapTopMenu .topMenu>ul>li>ul li a:before, .widget_calendar table tbody td a:before, .widget_calendar table tbody td a:hover, .widget_tag_cloud a:hover, .widget_trex_post .ui-tabs-nav li.ui-state-active a, .widget_recent_reviews .post_item .post_wrapper .post_info .post_review, .widget_top10 .ui-tabs-nav li.ui-state-active a, .nav_pages ul li span, .sc_button.sc_button_skin_global.sc_button_style_bg, .sc_video_frame.sc_video_active:before, .sc_toggl.sc_toggl_style_2.sc_toggl_icon_show .sc_toggl_item .sc_toggl_title:after, .sc_toggl.sc_toggl_style_3 .sc_toggl_item .sc_toggl_title, .sc_dropcaps.sc_dropcaps_style_1 .sc_dropcap, .sc_tooltip .sc_tooltip_item, .sc_table.sc_table_style_2 table thead tr th, .sc_highlight.sc_highlight_style_1, .sc_pricing_table.sc_pricing_table_style_2 .sc_pricing_item ul li.sc_pricing_title, .sc_pricing_table.sc_pricing_table_style_3 .sc_pricing_item ul, .sc_pricing_table.sc_pricing_table_style_3 .sc_pricing_item ul li.sc_pricing_title, .sc_scroll .sc_scroll_bar .swiper-scrollbar-drag, .sc_skills_bar .sc_skills_item .sc_skills_count, .sc_skills_bar.sc_skills_vertical .sc_skills_item .sc_skills_count, .sc_icon.sc_icon_box, .sc_icon.sc_icon_box_circle, .sc_icon.sc_icon_box_square, .sc_tabs.sc_tabs_style_2 ul.sc_tabs_titles li.ui-tabs-active a, .sc_slider.sc_slider_dark .slider-pagination-nav span.swiper-active-switch, .sc_slider.sc_slider_light .slider-pagination-nav span.swiper-active-switch, .sc_testimonials.sc_testimonials_style_1 .sc_testimonials_item_quote, .sc_testimonials.sc_testimonials_style_2 .sc_testimonials_title:after, .sc_testimonials.sc_testimonials_style_2 .sc_slider_swiper.sc_slider_pagination .slider-pagination-nav span.swiper-active-switch, .sc_blogger.style_date .sc_blogger_item:before, .sc_button.sc_button_skin_global.sc_button_style_bg, .sc_video_frame.sc_video_active:before, .sc_loader_show:before, .sc_toggl.sc_toggl_style_2.sc_toggl_icon_show .sc_toggl_item .sc_toggl_title:after, .sc_toggl.sc_toggl_style_3 .sc_toggl_item .sc_toggl_title, .sc_dropcaps.sc_dropcaps_style_1 .sc_dropcap, .sc_team .sc_team_item .sc_team_item_socials ul li a:hover, .postInfo .postReview .revBlock.revStyle100 .ratingValue, .reviewBlock .reviewTab .revWrap .revBlock.revStyle100 .ratingValue, .post-password-required .post-password-form input[type="submit"]:hover, .sc_button.sc_button_skin_dark.sc_button_style_bg:hover, .sc_button.sc_button_skin_global.sc_button_style_bg, .sc_skills_counter .sc_skills_item.sc_skills_style_3 .sc_skills_count, .sc_skills_counter .sc_skills_item.sc_skills_style_4 .sc_skills_count, .sc_skills_counter .sc_skills_item.sc_skills_style_4 .sc_skills_info, .isotopeWrap .isotopeItem .isotopeRating span.rInfo, .isotopeReadMore, .sc_button.sc_button_size_mini, .sc_button.sc_button_size_medium, .sc_button.sc_button_size_big, .topTitle.subCategoryStyle1 .subCategory, .fixedTopMenuShow .wrapTopMenu, .isotopeFiltr ul li a, .topTitle, .postInfo .stickyPost .postSticky, .sc_slider_swiper .sc_slider_info .sc_slider_reviews_short span.rInfo, .openMobileMenu, .woocommerce div.product form.cart .button, .woocommerce #review_form #respond .form-submit input, #header .usermenuArea ul.usermenuList .usermenuCart .widget_area p.buttons a, .topTitle.subCategoryStyle1 .subCategory, .woocommerce .button.alt.wc-forward, .woocommerce .cart-collaterals .shipping_calculator .button, .woocommerce-page .cart-collaterals .shipping_calculator .button, .woocommerce #payment #place_order{
  background: #2B3643
}


#hasil-cari{
    position: absolute;
    z-index: 1000;
    background: #fff;
    width: 100%;
    
    -webkit-box-shadow: 0px 3px 5px -3px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 3px 5px -3px rgba(0,0,0,0.75);
box-shadow: 0px 3px 5px -3px rgba(0,0,0,0.75);
}
#hasil-cari li{
    padding: 8px 20px!important;
}

.readMore{
    margin-top: 10px!important;
    margin-bottom: 20px;
}
.postInfo{
    padding:0px!important;
}
.blogStreampage {
    margin-bottom: 25px
}
.well{
    border-radius: 0px
}
	</style>

	
            <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>fonts/flaticon.css">

</head>
<body class="home page">
<div id="" class=" fullWidth menuStyle1 menuSmartScrollShow bodyStyleFullWide menuStyleFixed visibleMenuDisplay logoImageStyle logoStyleBG">
<div id="wrapBox" class="wrapBox">

<header class=" hidden-lg" id="header"  style="z-index:1000;position:fixed;top:0px;right:0;left:0px;">
<div class="menuFixedWrapBlock"></div>
<div class="menuFixedWrap" >
<a href="#" class="openMobileMenu"><div class="glyph-icon flaticon-menu-1"></div></a>
<a href="#" class="openTopMenu"></a>
<div class="usermenuArea">
<ul class="usermenuList sf-js-enabled">
<li class="usermenuCurrency">
<a href="#">$</a>
<ul class="sf-js-enabled" style="display: none;">
<li>
<a href="#">
<b>$</b> Dollar
</a>
</li>
<li>
<a href="#">
<b>€</b> Euro
</a>
</li>
<li>
<a href="#">
<b>£</b> Pounds
</a>
</li>
</ul>
</li>


<li class="hide <?php if($active=="chat"){ echo "active";}?>">
<a href="#"  onclick="openNav()" class="icon-mobi"  style="color:#fff!important;font-size:20px!important">
<span class="glyphicon glyphicon-search" aria-hidden="true"></span> </a>
</li>
<?php if($this->session->userdata('logged_in')) { ?>





<?php if ($this->option_model->check_admin()) {  ?>
                            <li class="divider"></li>
                            <li><a href="<?php echo base_url(); ?>dashboard/petugas" style="color: #fff!important"><span style="color: #fff!important"class="glyph-icon flaticon-settings" aria-hidden="true"></span></a></li>
                            <?php } else { ?> 

                            <?php
                                } ?>


<?php }?>
<li class="usermenuLogin">
<?php if(!$this->session->userdata('logged_in')) { ?>
<a href="<?php echo base_url();?>user/daftar" class="user-popup-link inited">Login</a>
<?php } else {?>

<?php
}	?>

</li>
</ul>
</div>
<div class="wrapTopMenu"  style="z-index:100;">
<div class="topMenu main">
<ul id="mainmenu" class="sf-js-enabled">
<li id="statistik"class=" <?php if($active=="home"){ echo "active";}?>">
<a href="<?php echo base_url();?>">Beranda</a>
</li>





<?php if($this->session->userdata('logged_in')) { ?>



<li class="<?php if($active=="profil"){ echo "active";}?>">
<a href="<?php echo base_url();?>dashboard/profil/<?php echo $this->session->userdata('userslug'); ?>" class=""> 

<span class="glyphicon glyphicon-user" aria-hidden="true"></span>

</a>
</li>


<li class="usermenuLogin">
<?php if(!$this->session->userdata('logged_in')) { ?>
<a href="<?php echo base_url();?>user/daftar" class="user-popup-link inited">Login</a>
<?php } else {?>
<a href="<?php echo base_url();?>login/logout" class="user-popup-link inited">logout</a>
<?php
}   ?>

<?php } ?>


</ul>
</div>
</div>
</div>
<div class="logoHeader" style="display:none">
<a href="<?php echo base_url();?>">
<img src="images/logo.png" alt="">
</a>
</div>
<h1 style="display:none"class="subTitle">IKLH</h1>
</header>
<div class="hidden-lg" style="height:60px;width:100%"></div>


<header class="hidden-xs hidden-sm"id="header" style="">
<div class=""></div>
<div class="">
<a href="#" class="openMobileMenu"></a>
<a href="#" class="openTopMenu"></a>

<div class="wrapTopMenu  navbar-fixed-top " style="box-shadow: 0px 6px 27px -12px rgba(0,0,0,0.37);">
<div class="topMenu main" style="z-index:100">
<ul id="mainmenu" class="row col-md-2">
<li class="col-md-12 <?php if($active=="home"){ echo "active";}?> " style="padding:0px">
<a style="margin:2px -10px -10px!important;border:0px"href="<?php echo base_url();?>">
<h1 class="" style="font-size:28px;color:#fff;margin:0px -10px;margin-bottom:0px;">
<img height="" class="pull-left"style="height:40px;width:40px;margin-right:10px;"src="<?php echo base_url(); ?>images/logo.png" alt=""><p style="margin-top:4px;margin-bottom:-5px" class="pull-left">IKLH</p></h1></a>
</li>

<li class="col-md-6 hidden-xs hide hidden-sm">
   
     <?php echo form_open("dashboard/".$active."/",array("method"=>"get","style"=>"margin-top:10px;z-index:1000;padding:0px;width:100%;padding-top:11px;padding-bottom:0px;margin-bottom:-15px;display"));?> 
	  
	  <div class="input-group">
	  <?php
	  
				if($query!=""){?>
					<input type="text" name="query"value="<?php echo $query;?>" id="cari-form" class="form-control" style="border:0px;width:100%;margin-top:-15px;box-shadow:none;border-radius:2px;height:35px" placeholder="Cari ...">
       
		
		<?php }  else{ ?>
		<input type="text" name="query" id="cari-form" class="form-control" style="border:0px;width:100%;margin-top:-15px;box-shadow:none;border-radius:2px;height:35px" placeholder="Cari ...">
       
		<?php }
		
		?>
           
            <div class="input-group-btn">
                <button style="margin-top:-18px;color:#2B3643;margin-left:-4px;border-left:0px;z-index:100;padding:5px 10px;border-radius:0px 2px 2px 0;font-size:16px;border:0px;"class="btn btn-default" type="submit" style="">
				<i class="glyphicon glyphicon-search" style="margin:0px;margin-bottom:1px"></i></button>
            </div>
        </div>
      </form>
 <span id="tombol"class="glyphicon glyphicon-search" style="display:none;margin:10px 0 0 -35px;color:#2B3643;display:non" aria-hidden="true"></span>

</a>

</li>

</ul>
<ul id="mainmenu" class="row col-md-8">
<li class="hide">
                        <div class="dropdown" >
                          <button class="dropdown-toggle userdrop" type="button" style="font-size:16px;padding-right:10px;background:none!important;border:0px!important" data-toggle="dropdown">
                            <span class="hidden-xs hidden-sm glyphicon glyphicon-stats" aria-hidden="true"></span>Informasi 
                          </button>
                          <ul class="dropdown-menu">
                                       <li class="link  <?php if($active=="hibah"){ echo "active";}?>">
<a href="<?php echo base_url();?>dashboard/hibah">Aset</a>
</li>


<li class="link  <?php if($active=="hibah"){ echo "active";}?>">
<a href="<?php echo base_url();?>dashboard/peta">Peta sebaran Aset</a>
</li>
<li class="link  <?php if($active=="aktivitas"){ echo "active";}?>">
<a href=" <?php echo base_url();?>dashboard/aktivitas">Aktivitas</a>
</li>
                <li id="statistik"class=" <?php if($active=="dashboard"){ echo "active";}?>">
<a href="<?php echo base_url();?>dashboard">Statistik</a>
</li>
                          </ul>
                        </div></li>


<?php
if($this->session->userdata('logged_in')) { ?>
<li class="link  menu-item-has-children <?php if($active=="register"){ echo "active";}?>">
<a href="<?php echo base_url();?>admin"> Admin IKLH</a>

</li>
<li class="link hide  menu-item-has-children <?php if($active=="register"){ echo "active";}?>">
<a href="<?php echo base_url();?>user/register"> Tambah petugas</a>

</li>

<?php

} ?>


<!--
<li class="menu-item-has-children">
<a href="<?php echo base_url();?>dashboard/statistik">Statistik</a>

</li>-->


</ul>
<ul id="mainmenu" class="row col-md-2 nav navbar-nav navbar-right">
  <?php if(!$this->session->userdata('logged_in')) { ?>
  <li class="pull-right">
<a href="<?php echo base_url();?>user/daftar">login</a>
</li>
  
  <?php }  else {?>



 <?php if($this->session->userdata('logged_in')) { ?>
                
   
        
           
                    
                     <?php }  else {?>   
                    
                      <li class="">
                        
                        <a href="<?php echo base_url();?>user/daftar" style="color:#fff!important;font-size:16px;text-transform:none!important;margin:10px 20px 0 0px;padding:7px 30px " style="padding:15px 10px;" data-balloon="Login" ">Login</a>
                       </li>
                     <?php } ?>                    


                    <li class="hidden-sm pull-right">
                        <?php if($this->session->userdata('logged_in')) { ?>
                      <a href="<?php echo base_url(); ?>login/logout">Logout</a>

                        <?php } else { ?>
                       
						 <a href="#" data-toggle="modal" data-target="#loginmodal" style="padding:15px 10px;" data-balloon="Login/Register" data-balloon-pos="down">Login / Sign Up</a>
					
                        <?php } ?>
                    </li>

 <?php } ?>

  <?php if($this->session->userdata('logged_in')) { ?>


  <?php } ?>
  
</ul>
</div>
</div>
</div>


</header >
<div id="cari-nav" style="position:fixed;top:46px;left:0;right:0;z-index:100;display:none">
	<div class="topMenu main">
	<div id="mainmenu" class="row col-md-2">
	</div>
	<div id="mainmenu" class="col-md-6" style="padding-left:30px">
	<ul class="nav nav-pills nav-stacked" id="menu-cari" style="background:#fff;border:1px solid #ccc">
  <li class="  menu-item-has-children <?php if($active=="kelompok_tani"){ echo "active";}?>">
<a href="<?php echo base_url();?>dashboard/kelompok_tani">Kelompok tani</a>

</li>

<!--
<li class="menu-item-has-children">
<a href="<?php echo base_url();?>dashboard/statistik">Statistik</a>

</li>-->

<li class="  <?php if($active=="hibah"){ echo "active";}?>">
<a href="<?php echo base_url();?>dashboard/hibah">Hibah</a>
</li>



<li class="  <?php if($active=="aktivitas"){ echo "active";}?>">
<a href=" <?php echo base_url();?>dashboard/aktivitas">Aktivitas</a>
</li>
</ul>
	</div>

</div>
</div>




<div id="myNav" class="overlay">

  <!-- Button to close the overlay navigation -->
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

  <!-- Overlay content -->
  <div class="overlay-content">
  <form class="col-md-12" style="margin-top:0px;margin-bottom:30px;z-index:1000;width:100%;">
       
      
	  
	  <div class="input-group " style="width:100%;">
           <input type="text" id="" class="form-control" style="width:100%;box-shadow:none;border-radius:2px;height:35px" placeholder="Cari ..." data-placeholder="Cari ...">
       
            <div class="input-group-btn">
                <button style="margin-top:-18px;color:#2B3643;margin-top:0px;margin-left:-60px;border-left:0px;z-index:100;padding:5px 10px;border-radius:0px 2px 2px 0;font-size:16px;border:0px;" class="btn btn-default" type="submit">
				<i class="glyphicon glyphicon-search" style="margin:0px;margin-bottom:1px"></i></button>
            </div>
        </div>
      </form>
    <a href="#">kelompok tani</a>
    <a href="#">Aktivitas</a>
    <a href="#">Hibah</a>
  </div>

</div>

<!-- Use any element to open/show the overlay navigation menu -->


