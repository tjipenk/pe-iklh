
									<table class="table datatable table-striped" id="datatable">
                                        <thead>
                                            <tr>
                                                <th align="right" style="width:11%">Option</th>
                                                <th>Kode Sungai</th>
                                                <th class="hidden-sd hidden-xs">Provinsi</th>
												<th class="hidden-sd hidden-xs">Koordinat</th>
												<th class="hidden-sd hidden-xs">Lokasi</th>
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
                                                    <td><?php echo $pub['sungai']; ?></td>
                                                    <td class="hidden-sd hidden-xs"><?php echo $this->admin_model->get_nama_wilayah($pub['id_prov'])[0]['nama']; ?></td>
                                                   													
                                                    <td class="hidden-sd hidden-xs"><?php echo $pub['lintang']."; ".$pub['bujur']; ?></td>															
                                                    <td class="hidden-sd hidden-xs"><?php echo $pub['lokasi']; ?></td>															
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
				
				
				$.post("<?php echo base_url(); ?>admin/removesungai", {
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