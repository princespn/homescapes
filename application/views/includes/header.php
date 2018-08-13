<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Site title</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">

	<!-- css -->
	  <link href="<?php echo base_url(); ?>assets/css/admin/global.css" rel="stylesheet" type="text/css">

	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">    
    <ul class="nav navbar-nav">
    	<li class="active"><a href="<?= base_url('costcalculator') ?>">Home</a></li>
    	<li><a href="<?= base_url('mainlisting') ?>">Main Listing</a></li>
    	<?php if ($this->session->userdata('username') ==='admin'){ ?>
			<li ><a href="<?= base_url('admin/signup') ?>">Add User</a></li> <?php } ?>
    	<?php if (isset($_SESSION['username']) && $_SESSION['logged_in'] === true) : ?>		
			<li><a href="<?= base_url('admin/logout') ?>">Logout</a></li>
			<?php else : ?>
			<li><a href="<?= base_url('admin/login') ?>">Login</a></li>
			<?php endif; ?>      
    </ul>
  </div>
</nav>

	<main id="site-content" role="main">
		
		<?php if (isset($_SESSION)) : ?>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<?php //var_dump($_SESSION); ?>
					</div>
				</div><!-- .row -->
			</div><!-- .container -->
<?php endif; ?>