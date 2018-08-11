<?php
	$default = $this->option_model->get_value('appusernophoto');
	$size = 30;
?>
<table class="table">
                                        <thead>
                                            <tr>
                                               
                                                
                                            
												<th>Kecamatan</th>
                                               
											
                                                <th style="">#</th>			  <th style="">#</th>											
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                                        <?php if (count($stories)>0): ?>

                                                        

                                                        <?php foreach($stories as $pub): ?>

                                                        <?php
                                                        	if (strlen($pub['user_avatar']) > 2) {
                                $grav_url = base_url()."/images/".$pub['post_image'];
                            } else if (strlen($pub['user_facebookid']) > 2) {
                                $grav_url = "https://graph.facebook.com/".$pub['user_facebookid']."/picture";
                            } else {
                                $email = $pub['user_email'];
                                $default = $this->option_model->get_value('appusernophoto');
                                $size = 30;
                                $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
                            }
                                                        ?>


                                                        <tr data-id="<?php echo $pub['post_id']; ?>">
                                                            
                                                            
																<td><?php echo $pub['nama']; ?></td>
															<td><?php echo $pub['kecamatan']." ".$pub['user_lastname']; ?></td>
                                                           
															<th><a style="cursor:pointer;" class="removerutilizador"><span class="label label-danger">Remove</span></a></th>
                                                            <th><a style="cursor:pointer;" class="editstory" href="<?php echo base_url(); ?>admin/editstory/<?php echo $pub['post_id']; ?>"><span class="label label-warning">Edit</span></a></th>
                                                        </tr>                                                        
                                                        
                                                        <?php endforeach; ?>
                                                        

                                                    <?php else: ?>

                                                    No stories.

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

    jQuery('a.checkgreen').click(function() 
    {
        var i = $(this).parent().parent().attr('data-id');
        var v = 0;

        var a = $(this)

        $.post("<?php echo base_url(); ?>admin/aprovstory", {
                i:i,
                v:v,
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                function(data){                                       
                    //a.addClass("checkyellow").removeClass("checkgreen");
                    location.reload();
                });
                return false;
    });

    jQuery('a.checkyellow').click(function() 
    {
        var i = $(this).parent().parent().attr('data-id');
        var v = 1;

        var a = $(this)

        $.post("<?php echo base_url(); ?>admin/aprovstory", {
                i:i,
                v:v,
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                function(data){                                       
                    //a.addClass("checkgreen").removeClass("checkyellow");
                    location.reload();
                });
                return false;
    });

                                                        
});
</script>