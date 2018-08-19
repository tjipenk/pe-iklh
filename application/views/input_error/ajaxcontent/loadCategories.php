<table class="table">
                                        <thead>
                                            <tr>
                                                
												<th>Id</th>
												<th>Nama kategori</th>  
<th style="width:70px;">#</th>   <th style="width:70px;">#</th>
                                                												
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                                        <?php if (count($categories)>0): ?>

                                                        

                                                        <?php foreach($categories as $pub): ?>

                                                        <tr data-id="<?php echo $pub['id_category']; ?>">
                                                          
                                                            <td><?php echo $pub['id_category']; ?></td>
                                                            <td><?php echo $pub['category_name']; ?></td>	
  <th><a style="cursor:pointer;" class="removecategory"><span class="label label-danger">Hapus</span></a></th>
                                                            <th><a style="cursor:pointer;" class="editstory" href="<?php echo base_url(); ?>admin/editcategory/<?php echo $pub['id_category']; ?>"><span class="label label-warning">Ubah</span></a></th>															
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
				
				
				$.post("<?php echo base_url(); ?>admin/removecategory", {
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