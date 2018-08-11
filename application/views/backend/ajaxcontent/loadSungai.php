<?php
	$default = $this->option_model->get_value('appusernophoto');
	$size = 30;
?>
<table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2" align="right">Option</th>
                                                
                                                <th>Kode Sungai</th>
                                                <th class="hidden-sd hidden-xs">Provinsi</th>
												<th class="hidden-sd hidden-xs">Kabupaten</th>
												<th class="hidden-sd hidden-xs">Koordinat</th>
												<th class="hidden-sd hidden-xs">Lokasi</th>
                                                

                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                                        <?php if (count($sungai)>0): ?>

                                                        

                                                        <?php foreach($sungai as $pub): ?>

                                                        <?php
                                                        	


           /*                                                 
                            if (strlen($pub['user_avatar']) > 2) {
                                $grav_url = base_url()."/images/avatar/".$pub['user_avatar'];
                            } else if (strlen($pub['user_facebookid']) > 2) {
                                $grav_url = "https://graph.facebook.com/".$pub['user_facebookid']."/picture";
                            } else {
                                $email = $pub['user_email'];
                                $default = $this->option_model->get_value('appusernophoto');
                                $size = 30;
                                $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
                            }
                 */       


                                                            



                                                        ?>


                                                        <tr data-id="<?php echo $pub['id_sungai']; ?>">
                                                            <th><a style="cursor:pointer;" class="removerutilizador"><span class="label label-danger">Hapus</span></a></th>
                                                            <th><a style="cursor:pointer;" class="editstory" href="<?php echo base_url(); ?>input/editsungai/<?php echo $pub['id_sungai']; ?>"><span class="label label-warning">Edit</span></a></th>
                                                            <td><?php echo $pub['kode_sungai']; ?></td>
                                                            <td class="hidden-sd hidden-xs"><?php echo $this->input_model->get_nama_wilayah($pub['id_prov'])[0]['nama']; ?></td>
                                                            <td class="hidden-sd hidden-xs"><?php echo $this->input_model->get_nama_wilayah($pub['id_kab'])[0]['nama'];?></td>															
                                                            <td class="hidden-sd hidden-xs"><?php echo $pub['lat']."; ".$pub['lon']; ?></td>															
                                                            <td class="hidden-sd hidden-xs"><?php echo $pub[lokasi]; ?></td>															
                                                        </tr>                                                        
                                                        
                                                        <?php endforeach; ?>
                                                        

                                                    <?php else: ?>

                                                    No Sungai.

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
				
				
				$.post("<?php echo base_url(); ?>input/removesungai", {
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