
    <link href="<?php echo base_url('assets/datatables/css/jquery.dataTables.min.css')?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
 
    <div class="container" style="margin-top: 40px">
        <h1 style="font-size:20pt">Petugas</h1>
        <a class="btn pull-right" style="background: #2B3643;color: #fff;margin:-20px 0 30px 0" href="<?php echo base_url();?>user/register"> Tambah petugas</a>
 
       
        <br />
        
        <table id="table" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama depan</th>
                    <th>Nama beakang</th>
                    <th>Username</th>
                   <th>Kecamatan</th>
                      <?php if($this->session->userdata('logged_in')) { ?>
<th>Action</th>
                     <?php } ?>
                </tr>
            </thead>
            <tbody>
            </tbody>
 
           
        </table>
    </div>
 
<script src="<?php echo base_url('assets/jquery/jquery-2.2.3.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
 
<script type="text/javascript">
 function editPanen(id,luas) {
   $("#user_name").val(luas);
   alert(luas);
   $("#id_tanam").val(id);
  }
var table;
 
$(document).ready(function() {
 
    //datatables
    table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('dashboard/ajax_list')?>",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });
 
});



$("#submit").click(function(){
    var luas_tanam = $("#luas_tanam").val();
    var id_tanam =   $("#id_tanam").val();

    $.ajax({
      method: "POST",
      url: '<?php echo base_url();?>dashboard/edit_berat_panen',
      data: { 'id':id_tanam,'berat_tanam':luas_tanam }
    })
  .done(function( msg ) {
    //alert( "Data Saved: " + msg );
     $('.close').click(); 
     swal("Sukses mengubah!", "Data telah berhasil di ubah!", "success")
        table.ajax.reload();
  });
 
});
</script>
 





<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit</h4>
      </div>
      <div class="modal-body">
      <form>

  <input type="hidden" name="id" id="id_tanam">
  <div class="row" style="margin-top:10px;">
                                <div class="col-sm-6">
                                    <div class="append-icon">
                                        <input type="text" name="name" id="user_name"class="form-control form-white" placeholder="Nama depan" required="" autofocus="">
                                        <i class="icon-user"></i>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="append-icon">
                                        <input type="text" name="lastname" class="form-control form-white lastname" placeholder="Nama belakang" >
                                        <i class="icon-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="append-icon" style="margin-top:10px;">
                                <input type="slug" name="slug" id="slug" class="form-control form-white email" placeholder="<?php echo $this->lang->line('input_slug'); ?>" required="">                           
                            </div>
                            

                         


                            <div class="append-icon" style="margin-top:10px;">
                                <input type="password" name="password" class="form-control form-white password" placeholder="<?php echo $this->lang->line('input_password'); ?>" required="">
                                <i class="icon-lock"></i>
                            </div>
                            <div class="append-icon" style="margin-top:10px;">
                                <input type="password" name="password2" class="form-control form-white password2" placeholder="Konfirmasi password" required="">
                                <i class="icon-lock"></i>
                            </div>
                            

                           
 
 
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="button" id="submit" class="btn btn-primary">Edit</button>
      </div>
    </div>
  </div>
</div>

