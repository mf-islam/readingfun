<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url(); ?>assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title><?php echo $page_title; ?> - Admin Panel</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- jQuery load -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.js" type="text/javascript"></script>

    <!-- Bootstrap core CSS     -->
    <!--<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    

    <!-- Animation library for notifications   -->
    <link href="<?php echo base_url(); ?>assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="<?php echo base_url(); ?>assets/css/paper-dashboard.css" rel="stylesheet"/>

    <!--  Custom core CSS    -->
    <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet"/>

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!--<link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/themify-icons.css" rel="stylesheet">

     <script src="https://cdn.jsdelivr.net/es6-promise/latest/es6-promise.min.js"></script> <!-- IE11 support -->
    <script src="<?php echo base_url(); ?>assets/js/sweetalert2.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.datatables.js"></script>

    <!-- Stop form submission with enter key -->
    <script type="text/javascript"> 
    function stopRKey(evt) { 
      var evt = (evt) ? evt : ((event) ? event : null); 
      var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
      if ((evt.keyCode == 13) && (node.type=="text"))  {return false;} 
    } 
    document.onkeypress = stopRKey; 
    </script>
</head>
<body>

<div class="wrapper"><!-- end in footer.php -->
