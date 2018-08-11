<?php
	$default = $this->option_model->get_value('appusernophoto');
	$size = 30;
?>
<table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Avatar</th>
												<th>Name</th>
                                                <th>E-mail</th>
												<th>Register date</th>                                                
                                                <th>Comment</th>												
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                                        <?php if (count($comments)>0): ?>

                                                        

                                                        <?php foreach($comments as $pub): ?>

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


                                                        <tr data-id="<?php echo $pub['comment_id']; ?>">
                                                            <th><a style="cursor:pointer;" class="removerutilizador"><span class="label label-danger">Remove</span></a></th>
                                                            <td><img src="<?php echo $grav_url; ?>" style="max-height:30px;" alt="" class="img-circle" /></td>
															<td><?php echo $pub['user_name']." ".$pub['user_lastname']; ?></td>
                                                            <td><?php echo $pub['user_email']; ?></td>
                                                            <td><?php echo $pub['date']; ?></td>															
                                                            <td><?php echo $pub['comment']; ?></td>
                                                        </tr>                                                        
                                                        
                                                        <?php endforeach; ?>
                                                        

                                                    <?php else: ?>

                                                    No comments.

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
				
				
				$.post("<?php echo base_url(); ?>admin/removestory", {
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