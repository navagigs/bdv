<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $web->identitas_website;?> <?php echo $title; ?></title>
    <meta name="description" content="<?php echo $web->identitas_deskripsi;?>" />
    <meta name="keywords" content="<?php echo $web->identitas_keyword;?>" />
    <meta name="author" content="<?php echo $web->identitas_author;?>" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/<?php echo $web->identitas_favicon;?>" sizes="16x16" />
    <link rel="stylesheet" type="text/css"  href="<?php echo base_url();?>templates/default/assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/default/assets/fonts/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url();?>templates/default/assets/css/nivo-lightbox.css" >
    <link rel="stylesheet" href="<?php echo base_url();?>templates/default/assets/css/nivo_lightbox_themes/default/default.css">
    <link href="<?php echo base_url();?>templates/default/assets/css/owl.carousel.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url();?>templates/default/assets/css/owl.theme.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css"  href="<?php echo base_url();?>templates/default/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/default/assets/css/responsive.css">
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="<?php echo base_url();?>templates/default/assets/<?php echo base_url();?>templates/default/assets/js/modernizr.custom.js"></script>

  </head>
  <body>

   <!-- Main Navigation 
    ================================================== -->
    <nav id="tf-menu" class="navbar navbar-default navbar-fixed-top">
        <div class="container" style="float:right;">
             <div class="menu-top" style="float:right">
                <?php
				if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('admin_level') == '5') { ?>
                 <a class="btn btn-primary" href="<?php echo site_url();?>pages/profil/<?php echo $this->session->userdata('admin_user'); ?>" title="Lihat Profil"><?php echo $this->session->userdata('admin_user'); ?></a> 
                  <a class="btn btn-danger" href="<?php echo site_url();?>pages/logout" title="Logout">Logout</a>
                
				<?php
				} else  { ?>
                  <a class="btn btn-primary" href="<?php echo site_url();?>pages/sign_in" title="Sign in">Sign in</a> 
                  <a class="btn btn-danger" href="<?php echo site_url();?>pages/registrasi" title="Registrasi">Registrasi</a>
				<?php  }
				?>
             </div>
          </div>
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#"></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo site_url();?>#tf-home" class="scroll">Home</a></li>
                <li><a href="<?php echo site_url();?>#tf-services" class="scroll">Services</a></li>
                <li><a href="<?php echo site_url();?>#tf-companies" class="scroll">Companies</a></li>
                <li><a href="<?php echo site_url();?>#tf-facilities" class="scroll">Facilities</a></li>
                <?php
				if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('admin_level') == '5') { ?>
					<li><a href="<?php echo site_url();?>courses">courses</a></li>
				<?php
				}
				?>
                <li><a href="<?php echo site_url();?>#tf-about" class="scroll">About Us</a></li>
				<li class=" dropdown"><a href="<?php echo site_url();?>#tf-updates" data-toggle="dropdown">Updates </a>
					<ul class="dropdown-menu">
                        <li><a href="<?php echo site_url();?>news" class="menu-link  sub-menu-link" title="News">News </a></li>
                        <li><a href="<?php echo site_url();?>events" class="menu-link  sub-menu-link" title="Events">Events </a></li>
                        <li><a href="<?php echo site_url();?>jobs" class="menu-link  sub-menu-link" title="Jobs">Jobs </a></li>
					</ul>
           		 </li>
                <li><a href="<?php echo site_url();?>#tf-contact" class="scroll">Contact</a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
            
        </div><!-- /.container-fluid -->
    </nav>
    <!-- <?php echo $web->identitas_author;?> -->
	<?php echo $this->load->view($content); ?>
    <!-- <?php echo $web->identitas_author;?> -->

    <!-- Footer 
    ================================================== -->
    <div id="tf-footer">
        <div class="container"><!-- container -->
            <p class="pull-left">© <?php echo date('Y');?> <?php echo $web->identitas_website;?>. All rights reserved</p> <!-- copyright text here-->
            <ul class="list-inline social pull-right">
                <li><a href="<?php echo $web->identitas_fb;?>" target="_blank"><i class="fa fa-facebook"></i></a></li> <!-- Change # With your FB Link -->
                <li><a href="<?php echo $web->identitas_tw;?>" target="_blank"><i class="fa fa-twitter"></i></a></li> <!-- Change # With your Twitter Link -->
                <li><a href="<?php echo $web->identitas_gp;?>" target="_blank"><i class="fa fa-google-plus"></i></a></li> <!-- Change # With your Google Plus Link -->
                <li><a href="<?php echo $web->identitas_yb;?>" target="_blank"><i class="fa fa-youtube"></i></a></li> <!-- Change # With your Youtube Link -->
            </ul>
        </div><!-- end container -->
    </div>
    


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>templates/default/assets/js/jquery.1.11.1.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="<?php echo base_url();?>templates/default/assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>templates/default/assets/js/owl.carousel.js"></script><!-- Owl Carousel Plugin -->
    <script type="text/javascript" src="<?php echo base_url();?>templates/default/assets/js/SmoothScroll.js"></script>
    <!-- Google Map --><!--
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASm3CwaK9qtcZEWYa-iQwHaGi3gcosAJc&amp;sensor=false"></script>-->
    <script type="text/javascript" src="<?php echo base_url();?>templates/default/assets/js/map.js"></script>
    <!-- Parallax Effects -->
    <script type="text/javascript" src="<?php echo base_url();?>templates/default/assets/js/skrollr.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>templates/default/assets/js/imagesloaded.js"></script>
    <!-- Portfolio Filter -->
    <script type="text/javascript" src="<?php echo base_url();?>templates/default/assets/js/jquery.isotope.js"></script>
    <!-- LightBox Nivo -->
    <script type="text/javascript" src="<?php echo base_url();?>templates/default/assets/js/nivo-lightbox.min.js"></script>
    <!-- Contact page-->
    <script type="text/javascript" src="<?php echo base_url();?>templates/default/assets/js/jqBootstrapValidation.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>templates/default/assets/js/contact.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>templates/default/assets/js/main.js"></script>
    <!-- <?php echo $web->identitas_author;?> -->

  </body>
</html>