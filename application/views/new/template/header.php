<!--============================
=            Header            =
=============================-->
<!DOCTYPE html>
<html lang="en">
<head>
	
<?php if(isset($_SESSION['in_sub_domain']['lib_id'])){ ?>
<title><?php echo $_SESSION['in_sub_domain']['library_name'] . ' | ' . $page_title; ?></title>
<?php }else{ ?>
<title><?php echo $this->config->item('site_title') . ' | ' . $page_title; ?></title>
<?php } ?>
	
	
<!-- custom-theme -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="summer reading, amazon book reading" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //custom-theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="<?php echo base_url(); ?>/assets/new/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo base_url(); ?>/assets/new/css/custom.css" rel="stylesheet" type="text/css" media="all" />

<!-- js -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/new/js/jquery-2.1.4.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
<!-- //js -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/new/css/easy-responsive-tabs.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/new/css/jquery.gallery.css">
<link href="<?php echo base_url(); ?>assets/new/css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />

<link href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css" rel="stylesheet">

<!-- font-awesome-icons -->
<link href="<?php echo base_url(); ?>assets/new/css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome-icons -->
<link href="//fonts.googleapis.com/css?family=Handlee" rel="stylesheet">
<!--<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>-->
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:350,350|Roboto" rel="stylesheet">
<script src="<?php echo base_url(); ?>/assets/new/js/jquery.vide.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
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
<div class="container-fluid">
	<div class="row">
		<!-- header -->
		<div class="w3_navigation">
			<div class="container">
				<nav class="navbar navbar-default">
					<div class="navbar-header navbar-left">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<div class="w3_navigation_pos">
							<a href="<?php echo base_url(); ?><?php echo $_SESSION['in_sub_domain']['get_param_subdomain']; ?>">
								<?php if(!empty($_SESSION['in_sub_domain']['lib_id'])){ ?>
									<?php if(file_exists($_SESSION['in_sub_domain']['current_logo'])){ ?>
										<img src="<?php echo base_url(); ?><?php echo $_SESSION['in_sub_domain']['current_logo']; ?>" alt="logo"/>
									<?php }else{ ?>
										<img src="<?php echo base_url(); ?>/assets/new/images/logo.png" alt="logo"/>
									<?php } ?>
								<?php }else{ ?>
									<img src="<?php echo base_url(); ?>/assets/new/images/logo.png" alt="logo"/>
								<?php } ?>
							</a>
						</div>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
						<nav class="menu menu--miranda">
							<ul class="nav navbar-nav menu__list">
								<li class="menu__item <?php echo (strtolower($page_title) == 'home' ? 'menu__item--current' : ''); ?>"><a href="<?php echo base_url(); ?><?php echo $_SESSION['in_sub_domain']['get_param_subdomain']; ?>" class="menu__link">Home</a></li>
								<li class="menu__item <?php echo (strtolower($page_title) == 'events' ? 'menu__item--current' : ''); ?>"><a href="<?php echo base_url(); ?>events<?php echo $_SESSION['in_sub_domain']['get_param_subdomain']; ?>" class=" menu__link">Our Events</a></li>
								<li class="menu__item <?php echo (strtolower($page_title) == 'programs' ? 'menu__item--current' : ''); ?>"><a href="<?php echo base_url(); ?>programs<?php echo $_SESSION['in_sub_domain']['get_param_subdomain']; ?>" class=" menu__link">Programs</a></li>
								
								<?php if (!$this->ion_auth->logged_in()) { ?>
									<?php if(!empty($_SESSION['in_sub_domain']['lib_id'])){ ?>
										<li class="menu__item <?php echo (strtolower($page_title) == 'signup' ? 'menu__item--current' : ''); ?>"><a href="<?php echo base_url(); ?>readers/signup<?php echo $_SESSION['in_sub_domain']['get_param_subdomain']; ?>" class="menu__link">Signup</a></li>
										<li class="menu__item <?php echo (strtolower($page_title) == 'login' ? 'menu__item--current' : ''); ?>"><a href="<?php echo base_url(); ?>readers/login<?php echo $_SESSION['in_sub_domain']['get_param_subdomain']; ?>" class=" menu__link">Login</a></li>
									<?php }else{ ?>
										<li class="menu__item <?php echo (strtolower($page_title) == 'signup' ? 'menu__item--current' : ''); ?>"><a href="<?php echo base_url(); ?>libraries/signup" class="menu__link">Signup</a></li>
										<li class="menu__item <?php echo (strtolower($page_title) == 'login' ? 'menu__item--current' : ''); ?>"><a href="<?php echo base_url(); ?>admin/login" class=" menu__link">Login</a></li>
									<?php	}} else { ?>
									<li class="menu__item"><a href="<?php echo base_url(); ?>readers/logout<?php echo $_SESSION['in_sub_domain']['get_param_subdomain']; ?>" class=" menu__link">Logout</a></li>

								<?php } ?>
							</ul>
						</nav>
					</div>
				</nav>	
			</div>
			<hr class="colorgraph"></hr>
		</div>
	</div>
	<?php if ($this->ion_auth->logged_in()) { ?>
	<div class="welcome row">
		<div class="container">
			<div class="links">/ <a <?php echo (isset($menu_title) && (strtolower($menu_title) == "read logs") ? 'class="text-danger"' : ''); ?> href="<?php echo base_url(); ?>readers/read_logs<?php echo $_SESSION['in_sub_domain']['get_param_subdomain']; ?>">Read logs</a></div>
			<div class="links">/ <a <?php echo (isset($menu_title) && (strtolower($menu_title) == "my account") ? 'class="text-danger"' : ''); ?> href="<?php echo base_url(); ?>readers/account<?php echo $_SESSION['in_sub_domain']['get_param_subdomain']; ?>">My Account</a></div>
			<div class="wc_text">Welcome&nbsp;&nbsp;<a href=""><?php echo $this->config->item('reader_name'); ?></a>,</div>
			<!-- Reader name is set in controller/reader.php -->
			
		</div>
	</div>
	<?php } ?>
<!-- //header -->