
    <link href="<?php echo base_url('assets/datatables/css/jquery.dataTables.min.css')?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
 
    <div class="container" style="margin-top: 40px">
        <h1 style="font-size:20pt">Daftar User dan Administrator</h1>
        <a class="btn pull-right" style="background: #2B3643;color: #fff;margin:-20px 0 30px 0" href="<?php echo base_url();?>admin/register"> Tambah petugas</a>
        <br />
        <table class="table datatable table-striped" id="datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                   <th>Provinsi</th>
                   <th>Level</th>
                      <?php if($this->session->userdata('logged_in')) { ?>
<th>Action</th>
                     <?php } ?>
                </tr>
            </thead>
            <tbody>
                                            
                                                        <?php if (count($petugas)>0): ?>

                                                       

                                                        <?php
                                                        $no = 1;
                                                        foreach($petugas as $pub): ?>
														

                                                        <tr data-id="<?php echo $pub['user_id']; ?>">
                                                        
                                                            <td><?php echo  $no; $no++;?></td>
                                                            <td><?php echo $pub['user_name']." ".$pub['user_lastname'];;?></td>
                                                            <td><?php echo $pub['user_slug'];?></td>
                                                            <td><?php $prov = $this->admin_model->get_nama_wilayah($pub['provinsi']);
                                                                    echo $prov[0]['nama'];?></td>
                                                            <td><?php echo $pub['user_level'];?></td>
                                                        <?php    if($this->session->userdata('logged_in')) {
                                                            echo "<td> <a style='cursor:pointer;' class='removerutilizador'><span class='label label-danger'>Hapus</span></a>";
                                                            echo "<a style='cursor:pointer;' class='editstory' href='".base_url()."admin/edit_user/".$pub['user_id']."'><span class='label label-warning'>Edit</span></a></a> </td>"; 
                                                        } ?>

     																									
                                                        </tr>                                                        
                                                        
                                                        <?php endforeach; ?>
                                                        

                                                    <?php else: ?>

                                                    No Data Petugas.

                                                    <?php endif; ?>


                                        </tbody>
 
           
        </table>
    </div>
 
<script src="<?php echo base_url('assets/jquery/jquery-2.2.3.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<?php /* <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
 */ ?>
<script type='text/javascript'>
jQuery(document).ready(function($){
        
							$('#datatable').DataTable({
								
								dom: 'Bfrtip',
								buttons: [
									'csv','pdf'
								]
								
							}); // ini yang buat datatables nya ya   <<<--------

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

