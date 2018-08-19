<table class="table">
                                        <thead>
                                            <tr>
                                            <th style="width:80px;">#</th>   <th style="width:80px;">#</th>
                                                <th>Judul</th>
												<th>alamat link</th>                                                										
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                                        <?php if (count($categories)>0): ?>

                                                        

                                                        <?php foreach($categories as $pub): ?>

                                                        <tr data-id="<?php echo $pub['id_page']; ?>">
                                                            <th><a style="cursor:pointer;" class="removecategory"><span class="label label-danger">Remove</span></a></th>
                                                            <th><a style="cursor:pointer;" class="editstory" href="<?php echo base_url(); ?>admin/editpage/<?php echo $pub['id_page']; ?>"><span class="label label-warning">Edit</span></a></th>
                                                            <td><?php echo $pub['title']; ?></td>
                                                            <td><?php echo $pub['title_slug']; ?></td>															
                                                        </tr>                                                        
                                                        
                                                        <?php endforeach; ?>
                                                        

                                                    <?php else: ?>

                                                    No categories.

                                                    <?php endif; ?>


                                        </tbody>
                                    </table>
									
<script type='text/javascript'>
jQuery(document).ready(function($){								

	jQuery('a.removecategory').click(function() 
	{
			if (confirm('Are you sure do you want delete?')) {
				var i = $(this).parent().parent().attr('data-id');
				$(this).parent().parent().remove();
				
				
				$.post("<?php echo base_url(); ?>admin/removepage", {
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