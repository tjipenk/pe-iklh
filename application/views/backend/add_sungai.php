<style type="text/css">
       <style>
.kabupaten{
display:none!important;}
</style>
<?php echo $map['js']; ?>

   </style> <div class="container header">
<div class="col-sm-6 col-sm-offset-3 " style="padding: 0px">
<h1 class="page_title_text">Tambah Lokasi Pengamatan</h1>
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
                                        <label class="col-sm-3 control-label">Nama Sungai</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="nama" class="form-control" value="">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Titik Sampling</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="titik" class="form-control" value="">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Sumber dana</label>
                                        <div class="col-sm-9">
                                            <select name="dana" id="dana" class="form-control">
                                            <option value="1">Dekon</option>
                                            <option value="0">Non-Dekon</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tanggal</label>
                                        <div class="col-sm-9">
                                            <input type="date" name="tanggal" class="form-control" value="">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Provinsi</label>
                                        <div class="col-sm-9">
                                            <select name="provinsi" id="provinsi" class="form-control">
<option>Semua</option>
<?php foreach($provinsi as $prov){?>
<option class="provinsi" target="<?php echo $prov['id_prov'];?>" value="<?php echo $prov['id_prov'];?>"><?php echo $prov['prov'];?></option>
<?php } ?>
</select>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Kabupaten</label>
                                        <div class="col-sm-9">
             <select name="kabupaten" class="form-control" >
<option>Semua</option>

<?php foreach($kabupaten as $camat){?>
<option  class="kabupaten <?php echo $camat['id_prov'];?>" value="<?php echo $camat['id_kab'];?>"><?php echo $camat['kab'];?></option>
<?php } ?>
</select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">TSS</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="tss" class="form-control" value="">
                                            <span class="help-block"></span>
                                        </div>
                                    
                                        <label class="col-sm-3 control-label">DO</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="do" class="form-control" value="">
                                            <span class="help-block"></span>
                                        </div>

                                        <label class="col-sm-3 control-label">BOD</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="bod" class="form-control" value="">
                                            <span class="help-block"></span>
                                        </div>
                                        <label class="col-sm-3 control-label">COD</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="cod" class="form-control" value="">
                                            <span class="help-block"></span>
                                        </div>

                                        <label class="col-sm-3 control-label">Total Fosfat</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="tp" class="form-control" value="">
                                            <span class="help-block"></span>
                                        </div>

                                        <label class="col-sm-3 control-label">Fecal Coli</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="fcoli" class="form-control" value="">
                                            <span class="help-block"></span>
                                        </div>
                                        <label class="col-sm-3 control-label">Total Coli</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="tcoli" class="form-control" value="">
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
                                                <a href="<?php echo site_url('input/daftar_sungai'); ?>">
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


                $("#provinsi").change(function(e){
                  
                    var provinsi =  $(this).val();
    $(".kabupaten").hide();
    $("."+provinsi).show();
});




   
    $( document ).ready(function () {
      
        
        
        $('.btn-primary').click(function() {

$.ajax({
url: "<?php echo site_url('input/add_sungai_data'); ?>",
type: 'POST',
async : false,
data: $('#editdata').serialize(),
success: function(msg) {
if (msg = "edit") { window.location.replace("<?php echo site_url('input/daftar_sungai'); ?>"); }
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