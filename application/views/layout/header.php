<?php 
       $query = $this->db->query("SELECT * FROM options");

		if ($query->num_rows() > 0)
		{
		   foreach ($query->result() as $row)
		   {
			  define($row->option_name, $row->option_value);
		   }
		}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo appname." Admin - ".appdescription ?></title>
  <?php /*
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/backend/bootstrap-colorpicker.min.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/backend/pnotify.custom.min.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/backend/style.css" type="text/css" />
		<link href='https://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/ui/1.11.0/jquery-ui.min.js"></script>        
        <script src="<?php echo base_url(); ?>js/backend/main.min.js"></script>
        <script src="<?php echo base_url(); ?>js/backend/pnotify.custom.min.js"></script>
 */?>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>        
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/backend/bootstrap-colorpicker.min.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/backend/pnotify.custom.min.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/backend/style.css" type="text/css" />
    <link rel="shortcut icon" href="gfx/favicon.ico" />
        <link href='<?php echo base_url(); ?>css/googlefont/css.css' rel='stylesheet' type='text/css'>
        <link href=" <?php echo base_url(); ?>css/font-awsome/font-awesome.min.css" rel="stylesheet" type="text/css">
        <script src="<?php echo base_url(); ?>js/jquery-latest.min.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>js/backend/main.min.js"></script>
        <script src="<?php echo base_url(); ?>js/backend/pnotify.custom.min.js"></script>

		<style>
		body{
			padding-top:60px;
        }
        .removerutilizador{
            background: none;
        }
		</style>

             <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>font/flaticon.css">
            <style type="text/css">
            	body{
				font-size: 16px!important
			}

			.blob {
  width: 2rem;
  height: 2rem;
  background: #388e3c;
  border-radius: 50%;
  position: absolute;
  left: calc(50% - 1rem);
  top: calc(50% - 1rem);

  
}
.load{
	display: none
}

.blob-2 {
  -webkit-animation: animate-to-2 1.5s infinite;
          animation: animate-to-2 1.5s infinite;
}

.blob-3 {
  -webkit-animation: animate-to-3 1.5s infinite;
          animation: animate-to-3 1.5s infinite;
}

.blob-1 {
  -webkit-animation: animate-to-1 1.5s infinite;
          animation: animate-to-1 1.5s infinite;
}

.blob-4 {
  -webkit-animation: animate-to-4 1.5s infinite;
          animation: animate-to-4 1.5s infinite;
}

.blob-0 {
  -webkit-animation: animate-to-0 1.5s infinite;
          animation: animate-to-0 1.5s infinite;
}

.blob-5 {
  -webkit-animation: animate-to-5 1.5s infinite;
          animation: animate-to-5 1.5s infinite;
}

@-webkit-keyframes animate-to-2 {
  25%, 75% {
    -webkit-transform: translateX(-1.5rem) scale(0.75);
            transform: translateX(-1.5rem) scale(0.75);
  }
  95% {
    -webkit-transform: translateX(0rem) scale(1);
            transform: translateX(0rem) scale(1);
  }
}

@keyframes animate-to-2 {
  25%, 75% {
    -webkit-transform: translateX(-1.5rem) scale(0.75);
            transform: translateX(-1.5rem) scale(0.75);
  }
  95% {
    -webkit-transform: translateX(0rem) scale(1);
            transform: translateX(0rem) scale(1);
  }
}
@-webkit-keyframes animate-to-3 {
  25%, 75% {
    -webkit-transform: translateX(1.5rem) scale(0.75);
            transform: translateX(1.5rem) scale(0.75);
  }
  95% {
    -webkit-transform: translateX(0rem) scale(1);
            transform: translateX(0rem) scale(1);
  }
}
@keyframes animate-to-3 {
  25%, 75% {
    -webkit-transform: translateX(1.5rem) scale(0.75);
            transform: translateX(1.5rem) scale(0.75);
  }
  95% {
    -webkit-transform: translateX(0rem) scale(1);
            transform: translateX(0rem) scale(1);
  }
}
@-webkit-keyframes animate-to-1 {
  25% {
    -webkit-transform: translateX(-1.5rem) scale(0.75);
            transform: translateX(-1.5rem) scale(0.75);
  }
  50%, 75% {
    -webkit-transform: translateX(-4.5rem) scale(0.6);
            transform: translateX(-4.5rem) scale(0.6);
  }
  95% {
    -webkit-transform: translateX(0rem) scale(1);
            transform: translateX(0rem) scale(1);
  }
}
@keyframes animate-to-1 {
  25% {
    -webkit-transform: translateX(-1.5rem) scale(0.75);
            transform: translateX(-1.5rem) scale(0.75);
  }
  50%, 75% {
    -webkit-transform: translateX(-4.5rem) scale(0.6);
            transform: translateX(-4.5rem) scale(0.6);
  }
  95% {
    -webkit-transform: translateX(0rem) scale(1);
            transform: translateX(0rem) scale(1);
  }
}
@-webkit-keyframes animate-to-4 {
  25% {
    -webkit-transform: translateX(1.5rem) scale(0.75);
            transform: translateX(1.5rem) scale(0.75);
  }
  50%, 75% {
    -webkit-transform: translateX(4.5rem) scale(0.6);
            transform: translateX(4.5rem) scale(0.6);
  }
  95% {
    -webkit-transform: translateX(0rem) scale(1);
            transform: translateX(0rem) scale(1);
  }
}
@keyframes animate-to-4 {
  25% {
    -webkit-transform: translateX(1.5rem) scale(0.75);
            transform: translateX(1.5rem) scale(0.75);
  }
  50%, 75% {
    -webkit-transform: translateX(4.5rem) scale(0.6);
            transform: translateX(4.5rem) scale(0.6);
  }
  95% {
    -webkit-transform: translateX(0rem) scale(1);
            transform: translateX(0rem) scale(1);
  }
}
@-webkit-keyframes animate-to-0 {
  25% {
    -webkit-transform: translateX(-1.5rem) scale(0.75);
            transform: translateX(-1.5rem) scale(0.75);
  }
  50% {
    -webkit-transform: translateX(-4.5rem) scale(0.6);
            transform: translateX(-4.5rem) scale(0.6);
  }
  75% {
    -webkit-transform: translateX(-7.5rem) scale(0.5);
            transform: translateX(-7.5rem) scale(0.5);
  }
  95% {
    -webkit-transform: translateX(0rem) scale(1);
            transform: translateX(0rem) scale(1);
  }
}
@keyframes animate-to-0 {
  25% {
    -webkit-transform: translateX(-1.5rem) scale(0.75);
            transform: translateX(-1.5rem) scale(0.75);
  }
  50% {
    -webkit-transform: translateX(-4.5rem) scale(0.6);
            transform: translateX(-4.5rem) scale(0.6);
  }
  75% {
    -webkit-transform: translateX(-7.5rem) scale(0.5);
            transform: translateX(-7.5rem) scale(0.5);
  }
  95% {
    -webkit-transform: translateX(0rem) scale(1);
            transform: translateX(0rem) scale(1);
  }
}
@-webkit-keyframes animate-to-5 {
  25% {
    -webkit-transform: translateX(1.5rem) scale(0.75);
            transform: translateX(1.5rem) scale(0.75);
  }
  50% {
    -webkit-transform: translateX(4.5rem) scale(0.6);
            transform: translateX(4.5rem) scale(0.6);
  }
  75% {
    -webkit-transform: translateX(7.5rem) scale(0.5);
            transform: translateX(7.5rem) scale(0.5);
  }
  95% {
    -webkit-transform: translateX(0rem) scale(1);
            transform: translateX(0rem) scale(1);
  }
}
@keyframes animate-to-5 {
  25% {
    -webkit-transform: translateX(1.5rem) scale(0.75);
            transform: translateX(1.5rem) scale(0.75);
  }
  50% {
    -webkit-transform: translateX(4.5rem) scale(0.6);
            transform: translateX(4.5rem) scale(0.6);
  }
  75% {
    -webkit-transform: translateX(7.5rem) scale(0.5);
            transform: translateX(7.5rem) scale(0.5);
  }
  95% {
    -webkit-transform: translateX(0rem) scale(1);
            transform: translateX(0rem) scale(1);
  }
}




			
			[class^="flaticon-"]:before, [class*=" flaticon-"]:before,
[class^="flaticon-"]:after, [class*=" flaticon-"]:after {   
  font-family: Flaticon;
        font-size: 20px;
font-style: normal;
margin-left: 20px!important;
margin-right: 0px!important
}
            		.kotak .glyph-icon:before{
				font-size: 60px!important;
				margin-right: 30px!important;
				margin-left: 0px!important
			} 
			.kotak{
				padding-right: 30px;
			}

		.kotak .glyph-icon{
			color: #388e3c
		}

		.info-box .info-box-stats span.info-box-title{
			color: #666!important
		}
		
		.btn:after{
			box-shadow: none!important;
		}
.ewTableHeader{
  background: #388e3c!important;
}
            </style>

</head>
<body>

