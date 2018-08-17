<div class="container header" style="margin-bottom:2em;margin-top:2em">
	<div class="row" style="padding:10px">
		<div align="center" style="border-radius: 10px; border: 1px solid; background-color: #99cc99; padding:10px;">
			<th align="center"><h3>IKA PROVINSI <?=$data_ika[0]['provinsi']?> TERKINI : <?=$data_ika[0]['ika']?></h3></th>
		</div>
	</div>
</div>

<div class="container header">
<div class="pull-left row">
<h1 class="page_title_text">Data Pemantauan Sungai</h1>
</div>
<a href="<?php echo site_url('admin_prov/add_data_sungai'); ?>" style="float:right;">
	<br />
    <button type="button" class="btn btn-primary  hidden-sd hidden-xs" style="margin-bottom:5px;">Tambah Data Pemantauan</button>
</a>

</div>
    
<div id="maincontent" class="container">
	<div class="row content">
	
			<form id="usersform" action="" method="post">

			<div class="col-lg-6 pull-right" style="padding:20px 20px;  text-align: right;"><input class="form-control"type="hidden" value="" name="pubpesquisar" placeholder="Search" /></div>
			
			<div id="usersarea" class="panel-body">
										
			</div>
										
			</form>
	</div>			
</div>

<script type='text/javascript'>
jQuery(document).ready(function($){
$("#usersform").on('submit',(function(e) {
        e.preventDefault();
				var p = $(this).find('input[name=pubpesquisar]').val();
				
                $.post("<?php echo base_url(); ?>admin_prov/load_data_sungai", {
                p:p,
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'				
                },
                function(data){
                    $("#usersarea").html(data);
							$('#datatable').DataTable({
								
								dom: 'Bfrtip',
								buttons: [
									'csv','pdf'
								]
								
							}); // ini yang buat datatables nya ya   <<<--------
				});
        return false;		
}));
$('input[name=pubpesquisar]').change(function() { $('#usersform').submit(); });
$('#usersform').submit();
});

function reject(id){
		var result = confirm("Yakin ditolak?");
		if (result) {
			//Logic to delete the item
			// var p = $(this).find('input[name=pubpesquisar]').val();
						
			$.post("<?php echo base_url(); ?>admin_prov/removedatasungai", {
			i:id,
			<?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'				
			},
			function(data){
				alert("Data Berhasil Ditolak.");
				location.reload();
			});
		}
}
function validate(id){
		var result = confirm("Data Sudah Valid??");
		if (result) {
			//Logic to delete the item
			// var p = $(this).find('input[name=pubpesquisar]').val();
						
			$.post("<?php echo base_url(); ?>admin_prov/validatedatasungai", {
			i:id,
			<?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'				
			},
			function(data){
				alert("Data Berhasil Divalidasi.");
				location.reload();
			});
		}
}
</script>