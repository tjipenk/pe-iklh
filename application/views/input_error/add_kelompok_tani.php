   <style type="text/css">
       <style>
.desa{
display:none!important;}
</style>
<?php echo $map['js']; ?>

   </style> <div class="container header">
<div class="col-sm-6 col-sm-offset-3 " style="padding: 0px">
<h1 class="page_title_text">Tambah Kelompok Tani</h1>
</div>
</div>
            <!-- START Template Container -->
            <div id="" class="container">
                <!-- Page Header -->                
                <!-- Page Header -->

                <!-- START row -->
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3" style="padding: 0px">
                        <!-- START panel -->
                        <div class="panel panel-default" style="border: 0px!important">
                            <!-- panel heading/header -->
                           
                            <!--/ panel heading/header -->
                            <!-- panel body -->
                            <div class="panel-body">
                                <form id="editdata" class="form-horizontal form-bordered">
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nama Kelompok Tani</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="kelompok_tani" class="form-control" value="">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                   <div class="form-group">
                                        <label class="col-sm-3 control-label">Nama ketua</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="user_name" class="form-control" value="">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <label class="col-sm-3 control-label">Nama sekertaris</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="sekertaris" class="form-control" value="">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <label class="col-sm-3 control-label">Nama bendahara</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="bendahara" class="form-control" value="">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">E-mail</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="user_email" class="form-control" value="">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nomor handphone</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="nomor" class="form-control" value="">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Password</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="user_pass" class="form-control" value="">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                             

                                     <div class="form-group">
                                        <label class="col-sm-3 control-label">Kecamatan</label>
                                        <div class="col-sm-9">
                                            <select name="kecamatan" id="kecamatan" class="form-control">
<option>Semua</option>
<?php foreach($kecamatan as $camat){?>
<option class="kecamatan" target="<?php echo $camat['id'];?>" value="<?php echo $camat['id'];?>"><?php echo $camat['nama'];?></option>
<?php } ?>
</select>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Desa</label>
                                        <div class="col-sm-9">
             <select name="desa" class="form-control" >
<option>Semua</option>

<?php foreach($desa as $camat){?>
<option  class="desa  <?php echo $camat['kecamatan'];?>" value="<?php echo $camat['id'];?>"><?php echo $camat['nama'];?></option>
<?php } ?>
</select>
                                        </div>
                                    </div>


                                     <div class="form-group">
                                        <label class="col-sm-3 control-label">Komoditas</label>
                                        <div class="col-sm-9">
             <select name="komoditas" class="form-control" >
<option value="1">Padi</option>
<option value="2">Perkebunan</option>
<option value="3">Hortikultura</option>

</select>
                                        </div>
                                    </div>
                             

                
   <div class="form-group">
                                        <label class="col-sm-3 control-label">Tahun berdiri</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="tahun" class="form-control" value="">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Luas lahan</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="luas" class="form-control" value="">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <label class="col-sm-3 control-label">Jenis kepemilikan lahan</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="kepemilikan" class="form-control" value="">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                       <div class="form-group">
                                        <label class="col-sm-3 control-label">Peta</label>
                                        <div class="col-sm-9">
                                            <input type="hidden" id="latitude" name="lat" class="form-control" value="">
                                             <input type="hidden" id="longitude" name="long" class="form-control" value="">
                                           <?php echo $map['html']; ?>
                                        </div>
                                    </div>


  <div class="form-group">
                                        <label class="col-sm-3 control-label">Alamat</label>
                                        <div class="col-sm-9">
                                        
                                            <textarea class="form-control" name="alamat"></textarea>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>


  <div class="form-group">
                                        <label class="col-sm-3 control-label">Deskripsi</label>
                                        <div class="col-sm-9">
                                        
                                            <textarea class="form-control" name="deskripsi"></textarea>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                    <div class="">
                                        <div class="form-group no-border">
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-9">
                                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                                <button type="submit" class="btn btn-primary pull-right">Tambah</button>
                                                <a href="<?php echo site_url('admin/users'); ?>">
												<button type="button" class="btn btn-danger">Batal</button>
                                                <br /><br /><span class="erro" style="color:red;"></span><br />
												</a>
                                            </div>
                                        </div> 
                                    </div>
                                </form>
                            </div>
                            <!-- panel body -->
                        </div>
                        <!--/ END form panel -->
                    </div>
                </div>
                <!--/ END row -->

                <script>  


                $("#kecamatan").change(function(e){
                  
                    var kecamatan =  $(this).val();
    $(".desa").hide();
    $("."+kecamatan).show();
});




   
    $( document ).ready(function () {
      
        
        
        $('.btn-primary').click(function() {

$.ajax({
url: "<?php echo site_url('admin/add_kelompok_tani_data'); ?>",
type: 'POST',
async : false,
data: $('#editdata').serialize(),
success: function(msg) {
if (msg = "edit") { window.location.replace("<?php echo site_url('admin/users'); ?>"); }
}
});
return false;
});
    
    });
  </script> 

                

            </div>
            <!--/ END Template Container -->

            <!-- START To Top Scroller -->
            <a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a>
            <!--/ END To Top Scroller -->
        </section>
        <!--/ END Template Main -->