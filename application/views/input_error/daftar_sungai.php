<div class="container header">
<div class="pull-left row">
<h1 class="page_title_text">Lokasi Pemantauan Sungai</h1>
</div>
<a href="<?php echo site_url('input/add_sungai'); ?>" style="float:right;">
	<br />
    <button type="button" class="btn btn-primary  hidden-sd hidden-xs style="margin-bottom:5px;">Tambah baru</button>
</a>
</div>
    
<div id="maincontent" class="container">
	<div class="row content">
	
			<form id="usersform" action="" method="post">

			<div class="col-lg-6 pull-right" style="padding:20px 20px;  text-align: right;"><input class="form-control"type="text" value="" name="pubpesquisar" placeholder="Search" /></div>
			
			<div id="usersarea" class="panel-body">
										
			</div>
										
			</form>
	</div>			
</div>
<div class="pull-right hidden-xl hidden-lg" style="margin-top: 20px">
				<a href="<?php echo site_url('input/add_sungai'); ?>" id="tambah"style="background: #80b500;color: #fff;padding: 15px 20px 15px 0px;margin:20px 0 0 0;border-radius:30px;position:fixed;bottom:20px;right:30px"><i class="glyph-icon flaticon-add"></i></a>
				</div>

<script type='text/javascript'>
jQuery(document).ready(function($){
$("#usersform").on('submit',(function(e) {
        e.preventDefault();
				var p = $(this).find('input[name=pubpesquisar]').val();
				
                $.post("<?php echo base_url(); ?>input/load_sungai", {
                p:p,
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'				
                },
                function(data){
                    $("#usersarea").html(data);
				});
        return false;		
}));
$('input[name=pubpesquisar]').change(function() { $('#usersform').submit(); });
$('#usersform').submit();
});
</script>