		<div class="container header">
                <div class="pull-left">
                    <h1 class="page_title_text">Categories</h1>
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
                                <h3 class="panel-title">Add new</h3>
                            </div>
                            <!--/ panel heading/header -->
                            <!-- panel body -->
                            <div class="panel-body">
                                <form id="newcategory" class="form-horizontal form-bordered">
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" class="form-control">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Color</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="category_color" class="form-control" value="">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Meta Description</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="category_description" class="form-control">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                     
                                    <div class="panel-footer">
                                        <div class="form-group no-border">
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-9">
                                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                                <button type="submit" class="btn btn-primary">Insert</button>
                                                <a href="<?php echo site_url('admin/categories'); ?>">
												<button type="button" class="btn btn-danger">Cancel</button>
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
    $( document ).ready(function () {
      
        


        $("#newcategory").on('submit',(function(e) {
            e.preventDefault();
            $(".erro").empty().slideUp();
            
            var curElement = $(this);
            curElement.find(':submit').hide();

            $.ajax({
            url: "<?php echo site_url('admin/addcategory_data'); ?>", 
            type: "POST",
            dataType: 'json',
            data: new FormData(this),
            contentType: false,
            mimeType: "multipart/form-data",
            cache: false,             
            processData:false,
            success: function(data)
            {
                
                if (data.result == "confirm") { 
                    window.location.replace("<?php echo site_url('admin/categories'); ?>"); 
                } else {
                    $('.erro').html(data.message).slideDown();
                    curElement.find(':submit').show();
                }
                
            }
            });
        }));
 
	  
    });
  </script>

                

            </div>
            <!--/ END Template Container -->

            <!-- START To Top Scroller -->
            <a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a>
            <!--/ END To Top Scroller -->
        </section>
        <!--/ END Template Main -->