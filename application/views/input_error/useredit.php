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
                                            <input type="text" name="user_id" value="<?php echo $dad['user_id']; ?>" class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">First Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="user_name" class="form-control" value="<?php echo $dad['user_name']; ?>">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <label class="col-sm-3 control-label">Last Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="user_lastname" class="form-control" value="<?php echo $dad['user_lastname']; ?>">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">E-mail</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="user_email" class="form-control" value="<?php echo $dad['user_email']; ?>">
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
                     
                                    <div class="panel-footer">
                                        <div class="form-group no-border">
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-9">
                                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                                <button type="submit" class="btn btn-primary">Edit</button>
                                                <a href="<?php echo site_url('admin/users'); ?>">
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
url: "<?php echo site_url('admin/usereditdata'); ?>",
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