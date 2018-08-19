<?php
	$default = $this->option_model->get_value('appusernophoto');
	$size = 30;
?>
<table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th></th>
                                                <th  class="hidden-sd hidden-xs">Avatar</th>
												<th>Nama kelompok tani</th>
                                                <th  class="hidden-sd hidden-xs">E-mail</th>
												<th class="hidden-sd hidden-xs">Tanggal bergabung</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                                        <?php if (count($users)>0): ?>

                                                        

                                                        <?php foreach($users as $pub): ?>

                                                        <?php
                                                        	


                                                            
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
                        


                                                            



                                                        ?>


                                                        <tr data-id="<?php echo $pub['user_id']; ?>">
                                                            <th><a style="cursor:pointer;" class="removerutilizador"><span class="label label-danger">Hapus</span></a></th>
                                                            <th><a style="cursor:pointer;" class="editstory" href="<?php echo base_url(); ?>admin/edituser/<?php echo $pub['user_id']; ?>"><span class="label label-warning">Edit</span></a></th>
                                                            <td  class="hidden-sd hidden-xs"><img src="<?php echo $grav_url; ?>" class="img-circle" style="max-height:30px;" alt="" /></td>
															<td><?php echo $pub['user_name']." ".$pub['user_lastname']; ?></td>
                                                            <td  class="hidden-sd hidden-xs"><?php echo $pub['user_email']; ?></td>
                                                            <td class="hidden-sd hidden-xs"><?php echo $pub['user_date']; ?></td>															
                                                        </tr>                                                        
                                                        
                                                        <?php endforeach; ?>
                                                        

                                                    <?php else: ?>

                                                    No users.

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
				
				
				$.post("<?php echo base_url(); ?>admin/removeuser", {
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