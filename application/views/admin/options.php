
<div class="container header">
     
      </div>

        <section id="maincontent" class="container content">
		
			<div id="optionsadmin" class="contspacing">
			
			
        <div class="col-md-12">
      <div class="col-md-4 col-md-offset-4 ">
         <div class="pull- row">
          <h1 class="page_title_text">Pengaturan</h1>
        </div>
        <p>&nbsp;</p>

        <ul class="nav nav-tabs" role="tablist" style="border:0px;">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Umum</a></li>

  
    <li class="hide" role="posts"><a href="#posts" aria-controls="posts" role="tab" data-toggle="tab">Posts</a></li>
  
    <li role="footer"><a href="#footer" aria-controls="footer" role="tab" data-toggle="tab">Footer</a></li>
    <li  class="hide" role="import"><a href="#import" aria-controls="import" role="tab" data-toggle="tab">Import</a></li>
   
  </ul>


      </div>


      <div class="col-md-8 col-md-offset-2">


<div id="optionsform" role="form">

  

  <p>&nbsp;</p>
  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
   


<div class="row">
    <div class="col-md-6">
  <div class="form-group">
    <label>Website Name:</label>
    <input type="text" class="form-control" value="<?php echo $this->option_model->get_value('appname'); ?>" data-id="appname">
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
      <label>Meta Description:</label>
    <input type="text" class="form-control" value="<?php echo $this->option_model->get_value('appdescription'); ?>" data-id="appdescription">
    </div>
</div>  
</div>

<div class="row">
    <div class="col-md-6">
  <div class="form-group">
    <label>Meta Author:</label>
    <input type="text" class="form-control" value="<?php echo $this->option_model->get_value('appauthor'); ?>" data-id="appname">
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
      <label>Meta Keywords:</label>
    <input type="text" class="form-control" value="<?php echo $this->option_model->get_value('appkeywords'); ?>" data-id="appdescription">
    </div>
</div>  
</div>

<div class="row">
    <div class="col-md-6">
  <label>Logo:</label>
    <form id="form-logo" class="form-logo" role="form" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-10">
        <input type="file" name="file" id="file" />
        <small>Max: 400 KB / File: .jpg, .jpeg, .png</small>
      </div>
      <div class="col-md-2">
        <button type="submit" id="submit-form" class="button m-t-20 button-green"><?php echo $this->lang->line('submit_profile'); ?></button>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
      </div>
    </div>    
    </form>
</div>
<div class="col-md-6">
  <label>Retina logo:</label>
    <form id="form-retinalogo" class="form-retinalogo" role="form" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-10">
        <input type="file" name="file" id="file" />
        <small>Max: 400 KB / File: .jpg, .jpeg, .png</small>
      </div>
      <div class="col-md-2">
        <button type="submit" id="submit-form" class="button m-t-20 button-green"><?php echo $this->lang->line('submit_profile'); ?></button>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
      </div>
    </div>    
    </form>
</div>  
</div>


<br />

<div class="row">
    <div class="col-md-6">
  <label>Favicon:</label>
    <form id="form-favicon" class="form-favicon" role="form" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-10">
        <input type="file" name="file" id="file" />
        <small></small>
      </div>
      <div class="col-md-2">
        <button type="submit" id="submit-form" class="button m-t-20 button-green"><?php echo $this->lang->line('submit_profile'); ?></button>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
      </div>
    </div>    
    </form>
</div>
<div class="col-md-6">
  
</div>  
</div>

<br />


  <div class="form-group">
    <label>Google Analytics Code:</label>
    <input type="text" class="form-control" value="<?php echo $this->option_model->get_value('appgoogleanalytics'); ?>" data-id="appgoogleanalytics">
  </div>


    </div>





  <div role="tabpanel" class="tab-pane" id="profile">
    
  <div class="form-group">
    <label>Choose layout option:</label>        
    <input type="radio" name="applayout" value="1" data-id="applayout" <?php if ($this->option_model->get_value('applayout') == 1) { ?>checked<?php } ?>>&nbsp;List Layout + Sidebar&nbsp;&nbsp;
    <input type="radio" name="applayout" value="2" data-id="applayout" <?php if ($this->option_model->get_value('applayout') == 2) { ?>checked<?php } ?>>&nbsp;Masonry Layout + Sidebar&nbsp;&nbsp;
    <input type="radio" name="applayout" value="3" data-id="applayout" <?php if ($this->option_model->get_value('applayout') == 3) { ?>checked<?php } ?>>&nbsp;Full Masonry Layout
  </div>

  <br />	
  <h2>Colors</h2>
  <br />

    <div class="row">
    <div class="col-md-6">
  <div class="form-group">
    <label>Background Header:</label>
    <input type="text" class="form-control ccolor" value="<?php echo $this->option_model->get_value('appcolorbgheader'); ?>" data-id="appcolorbgheader">    
  </div>
</div>
<div class="col-md-6">
	<div class="form-group">
	    <label>Body text:</label>
	    <input type="text" class="form-control ccolor" value="<?php echo $this->option_model->get_value('appcolorbodytext'); ?>" data-id="appcolorbodytext">
	  </div>
</div>	
</div>


<div class="row">
    <div class="col-md-6">
  <div class="form-group">
    <label>Titles:</label>
    <input type="text" class="form-control ccolor" value="<?php echo $this->option_model->get_value('appcolortitlescolor'); ?>" data-id="appcolortitlescolor">    
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
      <label>News titles:</label>
      <input type="text" class="form-control ccolor" value="<?php echo $this->option_model->get_value('appcolornewstitles'); ?>" data-id="appcolornewstitles">
    </div>
</div>  
</div>


<div class="row">
    <div class="col-md-6">
  <div class="form-group">
    <label>Footer background:</label>
    <input type="text" class="form-control ccolor" value="<?php echo $this->option_model->get_value('appcolorbgfooter'); ?>" data-id="appcolorbgfooter">    
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
      <label>Footer titles:</label>
      <input type="text" class="form-control ccolor" value="<?php echo $this->option_model->get_value('appcolorfootertitles'); ?>" data-id="appcolorfootertitles">
    </div>
</div>  
</div>

<div class="row">
    <div class="col-md-6">
  <div class="form-group">
    <label>Footer text:</label>
    <input type="text" class="form-control ccolor" value="<?php echo $this->option_model->get_value('appcolorfootertext'); ?>" data-id="appcolorfootertext">    
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
      <label>Footer links:</label>
      <input type="text" class="form-control ccolor" value="<?php echo $this->option_model->get_value('appcolorfooterlinks'); ?>" data-id="appcolorfooterlinks">
    </div>
</div>  
</div>


<div class="row">
    <div class="col-md-6">
  <div class="form-group">
    <label>Buttons Background:</label>
    <input type="text" class="form-control ccolor" value="<?php echo $this->option_model->get_value('appcolorbuttonsbg'); ?>" data-id="appcolorbuttonsbg">    
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
      <label>Buttons text:</label>
      <input type="text" class="form-control ccolor" value="<?php echo $this->option_model->get_value('appcolorbuttonstext'); ?>" data-id="appcolorbuttonstext">
    </div>
</div>  
</div>

<div class="row">
    <div class="col-md-6">
  <div class="form-group">
    <label>Buttons Background Hover:</label>
    <input type="text" class="form-control ccolor" value="<?php echo $this->option_model->get_value('appcolorbuttonsbghov'); ?>" data-id="appcolorbuttonsbghov">    
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
      <label>Buttons Text Hover:</label>
      <input type="text" class="form-control ccolor" value="<?php echo $this->option_model->get_value('appcolorbuttonstexth'); ?>" data-id="appcolorbuttonstexth">
    </div>
</div>  
</div>


  <p>&nbsp;</p>

    </div>
    
    


    <div role="tabpanel" class="tab-pane" id="settings">
    
    <h2>Image</h2>

	<div class="row">
    <div class="col-md-6">
	
    <div class="form-group">
    <label>Image/Logo:</label>
    <input type="text" class="form-control" value="<?php echo $this->option_model->get_value('appadvimgurl'); ?>" data-id="appadvimgurl">
  </div>
  </div>
  
  <div class="col-md-6">
  <div class="form-group">
    <label>Title:</label>
    <input type="text" class="form-control" value="<?php echo $this->option_model->get_value('appadvtitle'); ?>" data-id="appadvtitle">
  </div>
  </div>
  
  </div>
  
  <div class="row">
    <div class="col-md-6">
  
  <div class="form-group">
    <label>Subtitle:</label>
    <input type="text" class="form-control" value="<?php echo $this->option_model->get_value('appadvsubtitle'); ?>" data-id="appadvsubtitle">
  </div>
  
  </div>
  
  <div class="col-md-6">
  <div class="form-group">
    <label>Link:</label>
    <input type="text" class="form-control" value="<?php echo $this->option_model->get_value('appadvlink'); ?>" data-id="appadvlink">
  </div>
  </div>
  
  </div>

 <h2>Google Adsense</h2>

   <div class="row">
    <div class="col-md-6">
   <div class="form-group">
    <label>Ads Code:</label>
    <input type="text" class="form-control" value="<?php echo $this->option_model->get_value('appgadscode'); ?>" data-id="appgadscode">
  </div>
  </div>
	
  <div class="col-md-6">
  <div class="form-group">
    <label>Ads Code Slot:</label>
    <input type="text" class="form-control" value="<?php echo $this->option_model->get_value('appgadslot'); ?>" data-id="appgadslot">
  </div>
  </div>
  </div>

  <div class="row">
    <div class="col-md-6">
  <div class="form-group">
    <label>Ads Width:</label>
    <input type="text" class="form-control" value="<?php echo $this->option_model->get_value('appgadswidth'); ?>" data-id="appgadswidth">
  </div>
  </div>
	
  <div class="col-md-6">
  <div class="form-group">
    <label>Ads Height:</label>
    <input type="text" class="form-control" value="<?php echo $this->option_model->get_value('appgadsheight'); ?>" data-id="appgadsheight">
  </div>
  </div>
  </div>

  <h2>Code</h2>

  <div class="row">
    <div class="col-md-12">
   <div class="form-group">
    <label>Javascript code</label>
    <textarea rows="5" class="form-control" data-id="appadscode"><?php echo $this->option_model->get_value('appadscode'); ?></textarea>
  </div>
  </div>
  </div>
  
  <h2>Homepage Display</h2>
  
  <div class="form-group">   
    <input type="radio" name="appadv" value="0" data-id="appgads" <?php if ($this->option_model->get_value('appgads') == 0) { ?>checked<?php } ?>>&nbsp;No
	<input type="radio" name="appadv" value="1" data-id="appgads" <?php if ($this->option_model->get_value('appgads') == 1) { ?>checked<?php } ?>>&nbsp;Image&nbsp;&nbsp;
	<input type="radio" name="appadv" value="2" data-id="appgads" <?php if ($this->option_model->get_value('appgads') == 2) { ?>checked<?php } ?>>&nbsp;Google Adsense&nbsp;&nbsp;
  <input type="radio" name="appadv" value="3" data-id="appgads" <?php if ($this->option_model->get_value('appgads') == 3) { ?>checked<?php } ?>>&nbsp;Code&nbsp;&nbsp;
  </div>

  <h2>Posts middle text</h2>
  
  <div class="form-group">   
    <input type="radio" name="appadmiddlepost" value="0" data-id="appadmiddlepost" <?php if ($this->option_model->get_value('appadmiddlepost') == 0) { ?>checked<?php } ?>>&nbsp;No
	<input type="radio" name="appadmiddlepost" value="1" data-id="appadmiddlepost" <?php if ($this->option_model->get_value('appadmiddlepost') == 1) { ?>checked<?php } ?>>&nbsp;Image&nbsp;&nbsp;
	<input type="radio" name="appadmiddlepost" value="2" data-id="appadmiddlepost" <?php if ($this->option_model->get_value('appadmiddlepost') == 2) { ?>checked<?php } ?>>&nbsp;Google Adsense&nbsp;&nbsp;    
  <input type="radio" name="appadmiddlepost" value="3" data-id="appadmiddlepost" <?php if ($this->option_model->get_value('appadmiddlepost') == 3) { ?>checked<?php } ?>>&nbsp;Code&nbsp;&nbsp;    
  </div>

  <h2>Sidebar Display</h2>
  
  <div class="form-group">   
    <input type="radio" name="appadsidebar" value="0" data-id="appadsidebar" <?php if ($this->option_model->get_value('appadsidebar') == 0) { ?>checked<?php } ?>>&nbsp;No
  <input type="radio" name="appadsidebar" value="1" data-id="appadsidebar" <?php if ($this->option_model->get_value('appadsidebar') == 1) { ?>checked<?php } ?>>&nbsp;Image&nbsp;&nbsp;
  <input type="radio" name="appadsidebar" value="2" data-id="appadsidebar" <?php if ($this->option_model->get_value('appadsidebar') == 2) { ?>checked<?php } ?>>&nbsp;Google Adsense&nbsp;&nbsp;
  <input type="radio" name="appadsidebar" value="3" data-id="appadsidebar" <?php if ($this->option_model->get_value('appadsidebar') == 3) { ?>checked<?php } ?>>&nbsp;Code&nbsp;&nbsp;    
  </div>


   <h2>Ads Between Homepage Posts</h2>

  <div class="row">
  <div class="col-md-12">
   <div class="form-group">
    <label>Javascript code</label>
    <textarea rows="5" class="form-control" data-id="appadscodehome"><?php echo $this->option_model->get_value('appadscodehome'); ?></textarea>
  </div>
  </div>
  </div>
      
    </div>
    
	<div role="tabpanel" class="tab-pane" id="messages">
      <div class="form-group">
        <label>Active:</label>    
        <input type="radio" name="appcarousel" value="1" data-id="appcarousel" <?php if ($this->option_model->get_value('appcarousel') == 1) { ?>checked<?php } ?>>&nbsp;Yes&nbsp;&nbsp;
        <input type="radio" name="appcarousel" value="0" data-id="appcarousel" <?php if ($this->option_model->get_value('appcarousel') == 0) { ?>checked<?php } ?>>&nbsp;No
      </div>

      <div class="form-group">
        <label>Show only</label>
        <select name="appslidertype" data-id="appslidertype">
          <option value="Popular"><?php echo $this->lang->line('popular_text'); ?></option>
          <option value="Recent" <?php if ($this->option_model->get_value('appslidertype') == "Recent") { ?>selected="selected"<?php } ?>><?php echo $this->lang->line('recent_text'); ?></option>
          <option value="MostComment"><?php echo $this->lang->line('mostcomment_text'); ?></option>
          <option value="Today"><?php echo $this->lang->line('today_text'); ?></option>
          <option value="Yesterday"><?php echo $this->lang->line('yesterday_text'); ?></option>
          <option value="Week"><?php echo $this->lang->line('week_text'); ?></option>
          <option value="Month"><?php echo $this->lang->line('month_text'); ?></option>
          <option value="Year"><?php echo $this->lang->line('year_text'); ?></option>
        </select>        
      </div>

      <div class="row">
        <div class="col-md-6">
      <div class="form-group">
        <label>Max slides (each slide contains 3 images):</label>
        <input type="text" class="form-control" value="<?php echo $this->option_model->get_value('appsliderlimit'); ?>" data-id="appsliderlimit">
      </div>
      </div>
    </div>

	
    <p>&nbsp;</p>


    </div>



<div role="tabpanel" class="tab-pane" id="posts">

  <div class="form-group hide">
    <label>Requires approval:</label>    
    <input type="radio" name="appstoryapproval" value="1" data-id="appstoryapproval" <?php if ($this->option_model->get_value('appstoryapproval') == 1) { ?>checked<?php } ?>>&nbsp;Yes&nbsp;&nbsp;
    <input type="radio" name="appstoryapproval" value="0" data-id="appstoryapproval" <?php if ($this->option_model->get_value('appstoryapproval') == 0) { ?>checked<?php } ?>>&nbsp;No
  </div>
  
  <div class="form-group hide">
    <label>Only authors can post:</label>    
    <input type="radio" name="apppostauthor" value="1" data-id="apppostauthor" <?php if ($this->option_model->get_value('apppostauthor') == 1) { ?>checked<?php } ?>>&nbsp;Yes&nbsp;&nbsp;
    <input type="radio" name="apppostauthor" value="0" data-id="apppostauthor" <?php if ($this->option_model->get_value('apppostauthor') == 0) { ?>checked<?php } ?>>&nbsp;No
  </div>

  <p>&nbsp;</p>
  <div class="form-group hide">
    <label>Anonymous post</label>    
    <input type="radio" name="apppostanon" value="1" data-id="apppostanon" <?php if ($this->option_model->get_value('apppostanon') == 1) { ?>checked<?php } ?>>&nbsp;Yes&nbsp;&nbsp;
    <input type="radio" name="apppostanon" value="0" data-id="apppostanon" <?php if ($this->option_model->get_value('apppostanon') == 0) { ?>checked<?php } ?>>&nbsp;No
  </div>

  <div class="form-group">
        <label>Associate anonymous post to user:</label>
        <select name="apppostanonuser" data-id="apppostanonuser">
          <option value="">---</option>
          <?php if (count($utila)>0): ?>
          <?php foreach($utila as $pub): ?>
          <option <?php if ($this->option_model->get_value('apppostanonuser') == $pub['user_id']) { ?>selected<?php } ?> value="<?php echo $pub['user_id']; ?>"><?php echo $pub['user_name']." ".$pub['user_lastname']; ?></option>
          <?php endforeach; ?>
          <?php endif; ?>          
        </select>        
  </div>
  
  <p>&nbsp;</p>
  <div class="form-group">
    <label>Open External link:</label>    
    <input type="radio" name="externalarticle" value="iframe" data-id="externalarticle" <?php if ($this->option_model->get_value('externalarticle') == "iframe") { ?>checked<?php } ?>>&nbsp;Iframe&nbsp;&nbsp;
    <input type="radio" name="externalarticle" value="blank" data-id="externalarticle" <?php if ($this->option_model->get_value('externalarticle') == "blank") { ?>checked<?php } ?>>&nbsp;External Link
  </div>

  
<div class="form-group">
    <label>Poll add option</label>    
    <input type="radio" name="appvoteadd" value="1" data-id="appvoteadd" <?php if ($this->option_model->get_value('appvoteadd') == 1) { ?>checked<?php } ?>>&nbsp;Yes&nbsp;&nbsp;
    <input type="radio" name="appvoteadd" value="0" data-id="appvoteadd" <?php if ($this->option_model->get_value('appvoteadd') == 0) { ?>checked<?php } ?>>&nbsp;No
  </div>


  <div class="form-group">
    <label>Show points each user for likes/dislikes:</label>    
    <input type="radio" name="appuserrank" value="1" data-id="appuserrank" <?php if ($this->option_model->get_value('appuserrank') == 1) { ?>checked<?php } ?>>&nbsp;Yes&nbsp;&nbsp;
    <input type="radio" name="appuserrank" value="0" data-id="appuserrank" <?php if ($this->option_model->get_value('appuserrank') == 0) { ?>checked<?php } ?>>&nbsp;No
  </div>



  <div class="form-group">
    <label>How many points for each like:</label>
    <input type="text" class="form-control" value="<?php echo $this->option_model->get_value('appuserranklike'); ?>" data-id="appuserranklike">
  </div>

</div>





<div role="tabpanel" class="tab-pane" id="footer">

  <h4>Left Column</h4><br />

  <div class="form-group">
    <label>Title:</label>
    <input type="text" class="form-control" value="<?php echo $this->option_model->get_value('apptitleleftcolumn'); ?>" data-id="apptitleleftcolumn">
  </div>

  <div class="form-group">
    <label>Content:</label><br />
    <textarea data-id="appleftcontent" style="width:100%;height:100px;"><?php echo $this->option_model->get_value('appleftcontent'); ?></textarea>    
  </div>


  <h4>Copyright Text</h4><br />

  <div class="form-group">    
    <input type="text" class="form-control" value="<?php echo $this->option_model->get_value('appfootercopy'); ?>" data-id="appfootercopy">
  </div>


</div> 

<div role="tabpanel" class="tab-pane" id="import">

  <h2>Import posts/images from Wordpress</h2><br />

  
  <div class="row">
    <div class="col-md-6">
  <label>XML File:</label>
    <form id="form-importwp" class="form-importwp" role="form" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-10">
        <input type="file" name="file" id="file" />
        <small></small>
      </div>
      <div class="col-md-2">
        <button type="submit" id="submit-form" class="button m-t-20 button-green">Import</button>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
      </div>
    </div>
    <small style="float:left;color:#888;margin:20px 0px;">This script accepts file size max. 10 MB. If you can't upload please verify your server configurations to accepted the size of your file.</small>
    </form>
</div>
<div class="col-md-6">
  
</div>  
</div>


</div> 




<p>&nbsp;</p> 


  </div>


 
 
</div>


  <div id="loading" class="alert alert-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> &nbsp;<?php echo $this->lang->line('loading_text'); ?></div>
  <div id="error" class="alert alert-warning" role="alert"></div>
  <div id="confirm" class="alert alert-success" role="alert"></div>  
		
  <button type="button" id="save-option" class="button button-green" style="width:auto;">Save</button>
  <p>&nbsp;</p>
  <p>&nbsp;</p>


		</div>
		
		
		
</div>

</section>

<script type='text/javascript'>
jQuery(document).ready(function($){								
	
	PNotify.prototype.options.styling = "bootstrap3";

  $("#save-option").click( function(){ $('#confirm').html("Options saved."); });

  $('#optionsform input[type=text], #optionsform input[type=radio], #optionsform textarea, #optionsform select').change(function () {
		var v = $(this).val();
		var i = $(this).attr('data-id');
		
		$.post("<?php echo base_url(); ?>admin/editoption", { v:v, i: i, <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
    });
      $('#confirm').html("Option saved.");
      new PNotify({
            title: 'Success',
            type: 'success',
            text: 'Option Saved'
        });
    return false;		
	});


  jQuery("#form-logo").on('submit',(function(e) {
                e.preventDefault();
                jQuery("#error").empty().slideUp();
                jQuery("#confirm").empty().slideUp();
                jQuery('#loading').show();
                var curElement = jQuery(this);
                curElement.find(':submit').hide();

                jQuery.ajax({
                url: "<?php echo base_url(); ?>admin/savelogo",
                type: "POST",
                dataType: 'json',
                data: new FormData(this),
                contentType: false,
                cache: false,             
                processData:false,
                success: function(data)
                {
                    jQuery('#loading').hide();
                    jQuery("#"+data.result).html(data.message).slideDown();
                    curElement.find(':submit').show();
                }
                });
  }));

  jQuery("#form-retinalogo").on('submit',(function(e) {
                e.preventDefault();
                jQuery("#error").empty().slideUp();
                jQuery("#confirm").empty().slideUp();
                jQuery('#loading').show();
                var curElement = jQuery(this);
                curElement.find(':submit').hide();

                jQuery.ajax({
                url: "<?php echo base_url(); ?>admin/saveretinalogo",
                type: "POST",
                dataType: 'json',
                data: new FormData(this),
                contentType: false,
                cache: false,             
                processData:false,
                success: function(data)
                {
                    jQuery('#loading').hide();
                    jQuery("#"+data.result).html(data.message).slideDown();
                    curElement.find(':submit').show();
                }
                });
  }));

  jQuery("#form-favicon").on('submit',(function(e) {
                e.preventDefault();
                jQuery("#error").empty().slideUp();
                jQuery("#confirm").empty().slideUp();
                jQuery('#loading').show();
                var curElement = jQuery(this);
                curElement.find(':submit').hide();

                jQuery.ajax({
                url: "<?php echo base_url(); ?>admin/savefavicon",
                type: "POST",
                dataType: 'json',
                data: new FormData(this),
                contentType: false,
                cache: false,             
                processData:false,
                success: function(data)
                {
                    jQuery('#loading').hide();
                    jQuery("#"+data.result).html(data.message).slideDown();
                    curElement.find(':submit').show();
                }
                });
  }));

  jQuery("#form-importwp").on('submit',(function(e) {
                e.preventDefault();
                jQuery("#error").empty().slideUp();
                jQuery("#confirm").empty().slideUp();
                jQuery('#loading').show();
                var curElement = jQuery(this);
                curElement.find(':submit').hide();

                jQuery.ajax({
                url: "<?php echo base_url(); ?>admin/importwordpress",
                type: "POST",
                dataType: 'json',
                data: new FormData(this),
                contentType: false,
                cache: false,             
                processData:false,
                success: function(data)
                {
                    jQuery('#loading').hide();
                    jQuery("#"+data.result).html(data.message).slideDown();
                    curElement.find(':submit').show();
                }
                });
  }));


  

                                                        
});
</script>

