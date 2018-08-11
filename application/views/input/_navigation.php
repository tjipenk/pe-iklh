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

<header class="container-fluid header-page">
        <div class="row">
            <div class="col-md-12 no-padding">
                <div id="logo">
                    ADMIN 
                </div>
                
                <div class="pull-right">
                    
                    <div class="dropdown">
                          <button class="dropdown-toggle userdrop" type="button" data-toggle="dropdown">
                            <img src="<?php echo $grav_url; ?>" class="img-circle" style="max-height:30px;float: left;" alt="" />&nbsp;&nbsp;&nbsp;<span class="txt"><?php echo $this->session->userdata('nome'); ?></span>
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url(); ?>login/logout"><?php echo $this->lang->line('logout_link'); ?></a></li>                            
                          </ul>
                    </div>
                    
                </div>
            </div>
        </div>
    </header>
    <nav class="container-fluid mainmenu">
        <div class="row navbar navbar-custom navbar-page">
            <div class="navbar-header">
               
            </div>
            <div class="col-md-12 no-padding navbar-collapse collapse" id="navbar">
                <ul class="nav navbar-left">
                    <li <?php if ($sel=="dashboard") { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-windows"></i> Dashboard</a></li>
                    <li <?php if ($sel=="users") { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>admin/users"><i class="fa fa-users"></i> Users</a></li>
                    <li <?php if ($sel=="stories") { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>admin/stories"><i class="fa fa-list-ul"></i> Stories</a></li>
                    <li <?php if ($sel=="categories") { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>admin/categories"><i class="fa fa-list-ul"></i> Categories</a></li>
                    <li <?php if ($sel=="pages") { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>admin/pages"><i class="fa fa-list-ul"></i> Pages</a></li>
					<li <?php if ($sel=="comments") { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>admin/comments"><i class="fa fa-list-ul"></i> Comments</a></li>
                    <li <?php if ($sel=="newsletter") { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>admin/subscribers"><i class="fa fa-list-ul"></i> Newsletter</a></li>
                    <li <?php if ($sel=="options") { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>admin/options"><i class="fa fa-wrench"></i> Options</a></li>
                </ul>
            </div>
        </div>
    </nav>