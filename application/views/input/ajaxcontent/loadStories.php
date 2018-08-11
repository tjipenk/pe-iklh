<?php
	$default = $this->option_model->get_value('appusernophoto');
	$size = 30;
?>
<table class="table">
                                        <thead>
                                            <tr>
                                               
                                       
                                                <th>Gambat pengumuman</th>
												   <th>Judul</th>	
										
                                               
											
                                                <th style="width:80px">#</th>			  <th style="width:80px">#</th>											
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                                        <?php if (count($stories)>0): ?>

                                                        

                                                        <?php foreach($stories as $pub): ?>

                                         


                                                        <tr data-id="<?php echo $pub['id']; ?>">
                                                            
                                                           
                                                           
														   <td><img src="<?php echo  base_url().'images/pengumuman/'.$pub['gambar']; ?>" class="img-rounded" style="max-height:60px;" alt="" /></td>
																<td><?php echo $pub['judul']; ?></td>
														
                                                           
															<th><a style="cursor:pointer;" class="removerutilizador"><span class="label label-danger">Remove</span></a></th>
                                                            <th><a style="cursor:pointer;" class="editstory" href="<?php echo base_url(); ?>admin/edit_pengumuman/<?php echo $pub['id']; ?>"><span class="label label-warning">Edit</span></a></th>
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
				
				
				$.post("<?php echo base_url(); ?>admin/remove_pengumuman/"+i, {
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