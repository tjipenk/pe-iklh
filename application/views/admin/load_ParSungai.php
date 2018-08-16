
									<table class="table datatable table-striped" id="datatable">
                                        <thead>
                                            <tr>
                                                <th align="right" style="width:11%">Option</th><th>Tanggal</th>
                                                <th>TSS</th>
												<th>DO</th>
												<th>BOD</th>
												<th>COD</th>
												<th>Total Fosfat</th>
												<th>Fecal Coli</th>
												<th>Total Coli</th>
												<th class="hidden-sd hidden-xs">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
										<?php if (count($sungai)>0): ?>
                                            <?php foreach($sungai as $pub): ?>
                                                <tr data-id="<?php echo $pub['id']; ?>">
                                                    <td>
														<a style="cursor:pointer;" class="removerutilizador"><span class="label label-danger">Hapus</span></a> | 
														<a style="cursor:pointer;" class="editstory" href="<?php echo base_url(); ?>admin/editsungai/<?php echo $pub['id']; ?>"><span class="label label-warning">Edit</span></a>
													</td>
                                                    <td><?php echo $pub['date']; ?></td>
                                                            <td><?php echo $pub['tss'];?></td>
                                                            <td><?php echo $pub['do'];?></td>																				
                                                            <td><?php echo $pub['bod'];?></td>																				
                                                            <td><?php echo $pub['cod'];?></td>																				
                                                            <td><?php echo $pub['tf'];?></td>																				
                                                            <td><?php echo $pub['fcoli'];?></td>
                                                            <td><?php echo $pub['tcoli'];?></td>																				
                                                            																				
                                                            <td class="hidden-sd hidden-xs"><?php echo $pub['ket']; ?></td>													
                                                </tr>       
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
	<script type='text/javascript'>
jQuery(document).ready(function($){								

	jQuery('a.removerutilizador').click(function() 
	{
			if (confirm('Are you sure do you want delete?')) {
				var i = $(this).parent().parent().attr('data-id');
				$(this).parent().parent().remove();
				
				
				$.post("<?php echo base_url(); ?>admin/removeparsungai", {
                i:i,
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                function(data){
				});
				return false;			
			}			
	});
                                                        
});
</script>