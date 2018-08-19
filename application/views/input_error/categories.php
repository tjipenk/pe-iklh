<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap-datepicker3.min.css">


<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>editor/lib/css/bootstrap.min.css"></link>
<style type="text/css">
    .container{
        max-width: 1200px;
    }
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>editor/lib/css/prettify.css"></link>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>editor/src/bootstrap-wysihtml5.css"></link>
              <script src="<?php echo base_url();?>js/bootstrap-datepicker.min.js"></script>
                <script src="<?php echo base_url();?>js/locales/bootstrap-datepicker.id.min.js" charset="UTF-8"></script><div class="container header">
				<div class="pull-left row">
					<h1 class="page_title_text">Tambah pengumuman</h1>
				</div>
		
			</div>
        <section id="maincontent" class="container content">
		
			<div class="contspacing">
						
	<?php echo form_open_multipart("admin/pengumuman_tambah", array("method"=>"POST","id"=>'editdata','class'=>'form-horizontal form-bordered'));?> 
                                   

                                     <div class="form-group">
                                        <label class="col-sm-3 control-label">Judul</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="judul" class="form-control" value="">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tanggal</label>
                                        <div class="col-sm-9">
                                            <input autocomplete="off"type="text" id="tanggal"name="tanggal" class="form-control" value="">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Pengumuman</label>
                                        <div class="col-sm-9">
                                            <textarea name="pengumuman" class="form-control textarea"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Foto</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="foto" class="form-control" value="">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>


                                  
                     
                                    <div class="navbar navbar-default"style="position: ;bottom: 0;left: 0;right: 0;height: 50px;background: #388e3c;margin:0 -20px -60px">
                                        <div class="form-group no-border" style="margin-top: -23px">
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-9">
                                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                                <button  style="border:0px!important;box-shadow: none!important"type="submit" class="btn btn-primary pull-right"><i class="glyph-icon flaticon-add" style="margin-right: 5px"></i> Tambah </button>
                                                <a href="<?php echo site_url('admin/users'); ?>" style="color: #fff;margin: 8px 10px 0 0px;font-size: 14px" class=" pull-left"><i class="glyph-icon flaticon-left-arrow"></i><p style="margin-left: 20px!important;margin-top: 5px!important;padding-top: 5px"> Batal</</p>
                                                
                                                </a>
                                            </div>
                                        </div> 
                                    </div>
                                </form>
			</div>


			



</section>
 <script>    

                $('#tanggal').datepicker({
    format: "yyyy-mm-dd",
    language: "id",
    daysOfWeekDisabled: "0",
    autoclose: true,
    toggleActive: true
});


  
  </script> 

                <script src="<?php echo base_url();?>editor/lib/js/wysihtml5-0.3.0.js"></script>

<script src="<?php echo base_url();?>editor/lib/js/prettify.js"></script>

<script src="<?php echo base_url();?>editor/src/bootstrap-wysihtml5.js"></script>


<script>
    $('.textarea').wysihtml5();
</script>
