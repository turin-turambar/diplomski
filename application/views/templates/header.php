<?php echo doctype('html5'); ?>
<html>
	<!--<head>
		<?php echo meta('Content-type', 'text/html; charset=utf-8', 'equiv'); ?>
		<title><?php echo $title; ?> - Nastavnički portal Visoke škole tehničkih strukovnih studija</title>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../../../bootstrap/css/bootstrap.css">
	</head>
	<body>-->
<!--<!DOCTYPE html>-->
 <html>
  <head>
    <?php echo meta('Content-type', 'text/html; charset=utf-8', 'equiv'); ?>
      		<title><?php echo $title; ?> - Nastavnički portal Visoke škole tehničkih strukovnih studija</title>
      		<link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css">
      		<meta charset="utf-8">
  </head>
  <body>
   <div class="container">
		<?php
			$head_img_properties = array(
				'src' 	=>	'images/logo.png',
				'alt'		=>	'Visoka škola tehničkih strukovnih studija',
				);

			echo anchor('/', img($head_img_properties));
			//echo br();
			/*echo anchor('/news', 'Obaveštenja');
			echo nbs(3);
			//echo anchor($loggedIn);
			echo anchor('/users/login', 'Ulogujte se');
			echo nbs(3);
			echo anchor('/users/register', 'Registrujte novi nalog');
			echo nbs(3);
			echo anchor('messages/inbox', 'Poruke');*/
		?>
		<ul class="nav nav-pills">
			<li role="presentation">
				<?php
					echo anchor('/news', 'Obaveštenja');
				?>
			</li>
			<li>
				<?php
					echo anchor('messages/inbox', 'Poruke');
				?>
			</li>
			<li>
				<!--<?php
					echo anchor('/users/login', 'Ulogujte se');
				?>-->
			</li>
			<!--<li>
				<?php
					echo anchor('/users/register', 'Registrujte novi nalog');
				?>-->
			</li>
			<li>
				<?php
					echo anchor($path, $username);
				?>
			</li>
		</ul>
