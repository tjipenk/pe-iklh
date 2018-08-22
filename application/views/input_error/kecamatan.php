<div class="container background">

		    <div class="container header">
				<div class="pull-left row">
					<h1 class="page_title_text ">Desa</h1>
				</div>
			</div>

        <section id="maincontent" class="container content">
		
			<div class="contspacing">

	
			<form id="storiesform" action="" method="post">

			<div class="col-lg-6 pull-right"style="padding:20px 20px;  text-align: right;"><input class="form-control"type="text" value="" name="pubpesquisar" placeholder="Search" /></div>
			
			<div id="storiesarea" class="panel-body">
										
			</div>
										
			</form>
			

</div>

</section>
<script type='text/javascript'>
jQuery(document).ready(function($){
$("#storiesform").on('submit',(function(e) {
        e.preventDefault();
				var p = $(this).find('input[name=pubpesquisar]').val();
				
                $.post("<?php echo base_url(); ?>admin/load_kecamatan", {
                p:p,
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                function(data){
                    $("#storiesarea").html(data);
				});
        return false;		
}));
$('input[name=pubpesquisar]').change(function() { $('#storiesform').submit(); });
$('#storiesform').submit();
});
</script>