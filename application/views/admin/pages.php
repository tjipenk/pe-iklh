<div class="container-fluid background">
        <section class="container-fluid content">
		
			<div class="contspacing">
			
			<a href="<?php echo site_url('admin/addpage'); ?>" style="float:right;">
                <button type="button" class="btn btn-primary" style="margin-bottom:5px;">Add new page</button>
            </a>
			<h3>Halaman</h3>
	
			

			<form id="categoriesform" action="" method="post">


				<div class="col-lg-6 pull-right"style="padding:20px 20px;  text-align: right;"><input class="form-control"  type="text" value="" name="pubpesquisar" placeholder="Search" /></div>
			
			<div id="categoriesarea" class="panel-body">
										
			</div>
										
			</form>
			

</div>

</section>
<script type='text/javascript'>
jQuery(document).ready(function($){
$("#categoriesform").on('submit',(function(e) {
        e.preventDefault();
				var p = $(this).find('input[name=pubpesquisar]').val();
				
                $.post("<?php echo base_url(); ?>admin/loadpages", {
                p:p,
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                function(data){
                    $("#categoriesarea").html(data);
				});
        return false;		
}));
$('input[name=pubpesquisar]').change(function() { $('#categoriesform').submit(); });
$('#categoriesform').submit();
});
</script>