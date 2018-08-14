<div class="container header">
<div class="pull-left row">
<h1 class="page_title_text">Data Pemantauan Sungai</h1>
</div>
<?php /*
<a href="<?php echo site_url('admin/add_data_sungai'); ?>" style="float:right;">
	<br />
    <button type="button" class="btn btn-primary  hidden-sd hidden-xs style="margin-bottom:5px;">Tambah Data Stasiun</button>
</a>
*/ ?>
</div>
    
<div id="maincontent" class="container">
	<div class="row content">
	
			<form id="usersform" action="" method="post">

			<div class="col-lg-6 pull-right" style="padding:20px 20px;  text-align: right;"><input class="form-control"type="hidden" value="" name="pubpesquisar" placeholder="Search" /></div>
			
			<div id="usersarea" class="panel-body">
										
			</div>
										
			</form>

			<table class="table datatable table-striped" id="datatable">
                                        <thead>
                                            <tr>
                                                <th>Provinsi</th>
                                               
												<th>IKA</th>
                                                

                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                                        <?php if (count($sungai)>0): ?>

                                                       

                                                        <?php foreach($sungai as $pub): ?>
														

                                                        <tr data-id="<?php echo $pub['id_prov']; ?>">
                                                            <td><?php echo $pub['provinsi'];?></td>
                                                            <td><?php echo $pub['ika'];?></td>																											
                                                        </tr>                                                        
                                                        
                                                        <?php endforeach; ?>
                                                        

                                                    <?php else: ?>

                                                    No Data Sungai.

                                                    <?php endif; ?>


                                        </tbody>
                                    </table>


	</div>			
</div>

<script type='text/javascript'>
jQuery(document).ready(function($){
        
							$('#datatable').DataTable({
								
								dom: 'Bfrtip',
								buttons: [
									'csv','pdf'
								]
								
							}); // ini yang buat datatables nya ya   <<<--------
});
</script>

