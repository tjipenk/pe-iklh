<footer id="" style="padding:0px 100px" class=" footerWidget">
<div class="sc_columns_6 sc_columns_indent">

</div>
<div class="copyright">

&copy; 2018 Kementerian LHK dengan Teknik Sistem dan Informatika Pertanian, Departemen Teknik Mesin dan Biosistem - IPB.
</div>

</footer>
</div>
</div>
<div class="buttonScrollUp upToScroll icon-up-open-micro"></div>
<div id="user-popUp" class="user-popUp mfp-with-anim mfp-hide">
<div class="sc_tabs sc_tabs sc_tabs_style_1 sc_tabs_effects">
<ul class="sc_tabs_titles">
<li><a href="#loginForm" class="loginFormTab">Log In</a></li>

</ul>
<div class="sc_tabs_array">
<div id="loginForm" class="formItems loginFormBody sc_columns_2">
<form action="#" method="post" name="login_form" class="formValid">
<div class="">
<input type="hidden" name="redirect_to" value="#"/>
<ul class="formList">
<li class="formLogin"><input type="text" id="login" name="log" value="" placeholder="Email"></li>
<li class="formPass"><input type="password" id="password" name="pwd" value="" placeholder="Password"></li>

<li class="formButton"><a href="#" class="sendEnter enter sc_button sc_button_skin_global sc_button_style_bg sc_button_size_medium" style="border-radius:0px;padding:6px 20px;margin-top:30px">Login</a></li>
</ul>
</div>

<div class="sc_result result sc_infobox sc_infobox_closeable"></div>
</form>
</div>

</div>
</div>
</div>
<script type='text/javascript' src='<?php echo base_url();?>js/vendor/jquery-1.11.3.min.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>js/vendor/jquery-migrate.min.js'></script>

<script type='text/javascript' src='<?php echo base_url();?>js/vendor/__packed.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>js/custom/_utils.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>js/custom/_front.min.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>js/custom/shortcodes_init.min.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>js/custom/__main.js'></script>

<script>

function openNav() {
    document.getElementById("myNav").style.width = "100%";
}

/* Close when someone clicks on the "x" symbol inside the overlay */
function closeNav() {
    document.getElementById("myNav").style.width = "0%";
}


$("#kecamatan").change(function(e){
	$(".desa").hide();
	$("."+$(this).val()).show();
});


$( "#cari-form" ).focus(function() {
  $(".link").hide();
  $(this).addClass('lebar');
  
   $("#cari-nav").show();
    $("#tombol").addClass('tombol-kanan');
    $("#statistik").addClass('pull-right');
});

$( "#cari-form" ).focusout(function() {
	$(".link").show();
	$(this).removeClass('lebar');
	 $("#cari-nav").hide();
	$("#tombol").removeClass('tombol-kanan');
	$("#statistik").removeClass('pull-right');
});
</script>
</body>

</html>


