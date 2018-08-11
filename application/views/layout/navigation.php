<?php
    $default = $this->session->userdata('avatar');
    $size = 30;
    $email = $this->session->userdata('email');
    if (strlen($default) > 2) {
        $grav_url = base_url()."/images/avatar/".$default;
    } else {
        $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
    }    
?>

<nav class="navbar navbar-findcond" style="position:fixed;top:0;left:0;right:0;z-index:1000">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="<?php echo base_url(); ?>admin/dashboard">Akuisisi Data IKLH</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">

        <li class="dropdown ">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Pemantauan Sungai<span class="caret"></span></a>
          <ul class="dropdown-menu">
               <li><a href="<?php echo base_url(); ?>admin/daftar_sungai">Daftar Lokasi Sungai</a></li> 
               <li><a href="<?php echo base_url(); ?>admin/parameter_sungai">Parameter Air</a></li>
               <li><a href="<?php echo base_url(); ?>admin/data_sungai">Data Pemantauan</a></li>
          </ul>
        </li>

        <li class="dropdown ">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Pemantauan Udara<span class="caret"></span></a>
          <ul class="dropdown-menu">
               <li><a href="<?php echo base_url(); ?>admin/daftar_sungai">Daftar Lokasi</a></li> 
               <li><a href="<?php echo base_url(); ?>admin/data_sungai">Data Pemantauan</a></li>
          </ul>
        </li>

        <li class="dropdown ">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Petugas<span class="caret"></span></a>
          <ul class="dropdown-menu">
               <li><a href="<?php echo base_url(); ?>admin/users">Daftar Petugas</a></li> 
               <li><a href="<?php echo base_url(); ?>admin/data_sungai">Data Pemantauan</a></li>
          </ul>
        </li>




		
          <li class="hide"><a href="<?php echo base_url(); ?>admin/options">Pengaturan</a></li>    
	 </ul>

      <ul class="nav navbar-nav navbar-right ">
        <li class="dropdown hide"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
                    class="glyphicon glyphicon-envelope"></span>&nbsp;Inbox&nbsp;&nbsp;<span class="label label-info"><?php echo $num_rows; ?></span>
                </a>
                    <ul class="dropdown-menu">
                        <?php if (count($reports)>0): ?>
                        <?php foreach($reports as $rep): ?>
                        <li>
                        <a href="<?php echo base_url(); ?>admin/editstory/<?php echo $rep['posts_id']; ?>"><span class="label label-warning">Report content</span><br /><span title="<?php echo $rep['desc']; ?>"><?php echo substr($rep['desc'], 0, 50)."..."; ?></span><br />
                        <small><span style="opacity:0.7;">on post</span> <?php echo mb_substr($rep['post_subject'],0,25)."..."; ?> <span style="opacity:0.7;">by</span> <?php echo $rep['user_name']." ".$rep['user_lastname']; ?>.</small></a>
                        </li>
                        <?php endforeach; ?>
                        <li class="divider"></li>
                        <?php endif; ?>                        
                    </ul>
        </li>
        <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span> 
                        <strong><?php echo $this->session->userdata('nome'); ?></strong>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="navbar-login">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <p class="text-center">
                                            <img src="<?php echo $grav_url; ?>" class="img-circle" style="max-height:80px;float: left;" alt="" />
                                        </p>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="text-left"><strong><?php echo $this->session->userdata('nome'); ?></strong></p>
                                        <p class="text-left small"></p>
                                        <p class="text-left">
                                            <a href="<?php echo base_url(); ?>user/profile" class="btn btn-primary btn-block btn-sm" style="color:#FFF;background-color: #00B289;">Edit profile</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="navbar-login navbar-login-session">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>
                                            <a href="<?php echo base_url(); ?>login/logout" class="btn btn-danger btn-block" style="color:#FFF;background-color: #d9534f;">Logout</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
      </ul>
    </div>
  </div>
</nav>