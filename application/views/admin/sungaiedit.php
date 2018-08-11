            <div class="container header">
<div class="pull-left">
<h1 class="page_title_text">Edit user</h1>
</div>
</div>
            <!-- START Template Container -->
            <div id="maincontent" class="container">
                <!-- Page Header -->                
                <!-- Page Header -->

                <!-- START row -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- START panel -->
                        <div class="panel panel-default">
                            <!-- panel heading/header -->
                            <div class="panel-heading">
                                <h3 class="panel-title">Edit</h3>
                            </div>
                            <!--/ panel heading/header -->
                            <!-- panel body -->
                            <?php foreach($stories as $dad):?>
                            <div class="panel-body">
                                <form id="editdata" class="form-horizontal form-bordered">
                                    
                                    
                                    <div class="form-group" style="display:none;">
                                        <label class="col-sm-3 control-label">data ID</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="id" value="<?php echo $dad['id']; ?>" class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Lokasi</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="lokasi" class="form-control" value="<?php echo $dad['lokasi']; ?>">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <label class="col-sm-3 control-label">Kode Sungai</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="sungai" class="form-control" value="<?php echo $dad['sungai']; ?>">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Kategori Stasiun</label>
                                        <div class="col-sm-9">
                                            <select name="kategori" id="kategori" class="form-control">
                                            <option value="1" <?php if ($dad['kategori'] == "1") { ?>selected="selected"<?php } ?> >Preoritas</option>
                                            <option value="0" <?php if ($dad['kategori'] == "0") { ?>selected="selected"<?php } ?>>Non-Preoritas</option>
                                            </select>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <label class="col-sm-3 control-label">Provinsi</label>
                                        <div class="col-sm-9">
                                            <select name="provinsi" id="provinsi" class="form-control">
                                            <option value="$dad['id_prov']" selected="selected"><?php echo $this->admin_model->get_nama_wilayah($dad['id_prov'])[0]['nama'];  ?></option>
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
<option value="$dad['id_kab']" selected="selected"><?php echo $this->admin_model->get_nama_wilayah($dad['id_kab'])[0]['nama'];  ?></option>

<?php foreach($kabupaten as $camat){?>
<option  class="kabupaten <?php echo $camat['id_prov'];?>" value="<?php echo $camat['id_kab'];?>"><?php echo $camat['kab'];?></option>
<?php } ?>
</select>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <label class="col-sm-3 control-label">Lintang</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="lintang" class="form-control" value="<?php echo $dad['lintang']; ?>">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Bujur</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="bujur" class="form-control" value="<?php echo $dad['bujur']; ?>">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    

<?php /*

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">TSS</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="tss" class="form-control" value="<?php echo $dad['tss']; ?>">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">DO</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="do" class="form-control" value="<?php echo $dad['do']; ?>">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">BOD</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="bod" class="form-control" value="<?php echo $dad['bod']; ?>">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">COD</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="cod" class="form-control" value="<?php echo $dad['cod']; ?>">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Total Fosfat</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="tf" class="form-control" value="<?php echo $dad['tf']; ?>">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Fecal Coliform</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="fcoli" class="form-control" value="<?php echo $dad['fcoli']; ?>">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Total Coliform</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="tcoli" class="form-control" value="<?php echo $dad['tcoli']; ?>">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Role</label>
                                        <div class="col-sm-9">
                                            <select name="level">
                                                <option value="" <?php if ($dad['user_level'] == "") { ?>selected="selected"<?php } ?>>User</option>
                                                <option value="2" <?php if ($dad['user_level'] == "2") { ?>selected="selected"<?php } ?>>Author</option>
                                                <option value="1" <?php if ($dad['user_level'] == "1") { ?>selected="selected"<?php } ?>>Administrator</option>
                                            </select>    
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    */ ?>
                                    <div class="panel-footer">
                                        <div class="form-group no-border">
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-9">
                                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                                <button type="submit" class="btn btn-primary">Edit</button>
                                                <a href="<?php echo site_url('admin/daftar_sungai'); ?>">
												<button type="button" class="btn btn-danger">Cancel</button>
                                                <br /><br /><span class="erro" style="color:red;"></span><br />
												</a>
                                            </div>
                                        </div> 
                                    </div>
                                </form>
                            </div>
                            <?php endforeach;?>
                            <!-- panel body -->
                        </div>
                        <!--/ END form panel -->
                    </div>
                </div>
                <!--/ END row -->

                <script>     
    $( document ).ready(function () {
      
        
        
        $('.btn-primary').click(function() {

$.ajax({
url: "<?php echo site_url('admin/sungaieditdata'); ?>",
type: 'POST',
async : false,
data: $('#editdata').serialize(),
success: function(msg) {
if (msg = "edit") { window.location.replace("<?php echo site_url('admin/daftar_sungai'); ?>"); }
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