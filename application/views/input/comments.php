<div class="container header">
				<div class="pull-left row">
					<h1 class="page_title_text ">Komentar</h1>
				</div>
			</div>
<div id="maincontent" class="container">
        <section class="content">
		
	

	
			<form id="commentsform" action="" method="post">

			<div class="col-lg-6 pull-right"style="padding:20px 20px;  text-align: right;"><input class="form-control" type="text" value="" name="pubpesquisar" placeholder="Search" /></div>
			
			<div id="commentsarea" class="panel-body">
										
			</div>
										
			</form>


</section>
<script type='text/javascript'>
jQuery(document).ready(function($){
$("#commentsform").on('submit',(function(e) {
        e.preventDefault();
				var p = $(this).find('input[name=pubpesquisar]').val();
				
                $.post("<?php echo base_url(); ?>admin/loadcomments", {
                p:p,
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                function(data){
                    $("#commentsarea").html(data);
				});
        return false;		
}));
$('input[name=pubpesquisar]').change(function() { $('#commentsform').submit(); });
$('#commentsform').submit();
});
</script>