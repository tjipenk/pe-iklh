		<div class="container header">
                <div class="pull-left">
                    <h1 class="page_title_text">Stories</h1>
                </div>
            </div>
        <!-- START Template Main -->
        <section id="main" role="main">
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
                                            <input type="text" name="post_id" value="<?php echo $dad['post_id']; ?>" class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Category</label>
                                        <div class="col-sm-9">
                                            <select name="category">
                                        <?php foreach($categories as $cat): ?>
                                        <option <?php if ($dad['id_category'] == $cat['id_category']) { ?>selected="selected"<?php } ?> value="<?php echo $cat['id_category']; ?>"><?php echo $cat['category_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                        </div>
                                    </div>

                                    


                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Title</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="post_subject" class="form-control" value="<?php echo $dad['post_subject']; ?>">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">URL</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="post_url" class="form-control" value="<?php echo $dad['post_url']; ?>">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Content</label>
                                        <div class="col-sm-9">
                                            <textarea name="post_text" style="width:100%;height:80px;"><?php echo $dad['post_text']; ?></textarea>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                     
                                    <div class="panel-footer">
                                        <div class="form-group no-border">
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-9">
                                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                                <button type="submit" class="btn btn-primary">Edit</button>
                                                <a href="<?php echo site_url('admin/stories'); ?>">
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
url: "<?php echo site_url('admin/storyeditdata'); ?>",
type: 'POST',
async : false,
data: $('#editdata').serialize(),
success: function(msg) {
if (msg = "edit") { window.location.replace("<?php echo site_url('admin/stories'); ?>"); }
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