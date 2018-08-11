	<div class="container header">
                <div class="pull-left">
                    <h1 class="page_title_text">Subscribers</h1>
                </div>
        </div>
    <div id="maincontent" class="container background">
		
			<div class="contspacing">
			
	
			<form id="usersform" action="" method="post">

			<div style="padding:20px 20px;  text-align: right;"><input type="text" value="" name="pubpesquisar" placeholder="Search" /></div>
			
			<div id="usersarea" class="panel-body">
										
			</div>
										
			</form>
			

</div>

</section>
<script type='text/javascript'>
jQuery(document).ready(function($){
$("#usersform").on('submit',(function(e) {
        e.preventDefault();
				var p = $(this).find('input[name=pubpesquisar]').val();
				
                $.post("<?php echo base_url(); ?>admin/loadsubscribers", {
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