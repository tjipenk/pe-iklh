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
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>        
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/backend/bootstrap-colorpicker.min.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/backend/pnotify.custom.min.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/backend/style.css" type="text/css" />
		<link rel="shortcut icon" href="gfx/favicon.ico" />
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <script src="https://code.jquery.com/jquery-latest.min.js"></script>
        <script src="https://code.jquery.com/ui/1.11.0/jquery-ui.min.js"></script>
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>js/backend/main.min.js"></script>
        <script src="<?php echo base_url(); ?>js/backend/pnotify.custom.min.js"></script>
</head>
<body>