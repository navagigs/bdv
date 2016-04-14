<?php date_default_timezone_set('Asia/Jakarta'); ?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ADMINISTRATOR - <?php echo $web->identitas_website;?></title>
        <meta name="description" content="<?php echo $web->identitas_deskripsi;?>" />
        <meta name="keywords" content="<?php echo $web->identitas_keyword;?>" />
        <meta name="author" content="<?php echo $web->identitas_author;?>" />
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/<?php echo $web->identitas_favicon;?>" sizes="16x16" />
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="<?php echo base_url();?>templates/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>templates/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>templates/admin/css/style.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>templates/admin/js/popup/jquery.fancybox-1.3.4.css"  type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url();?>templates/admin/css/date/jquery-ui-1.8.17.custom.css" />
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="<?php echo base_url();?>admin" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <img src="<?php echo base_url();?>templates/admin/img/logo_bdv.png">
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                     
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $admin->admin_nama; ?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo base_url();?>templates/admin/img/icon-user.png" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $admin->admin_nama; ?> - <?php echo $admin->admin_level_nama; ?>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo site_url();?>admin/edit_password" class="btn btn-default btn-flat">Ganti Password</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo site_url();?>wp_login/keluar" class="btn btn-default btn-flat">Keluar</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url();?>templates/admin/img/icon-user.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $admin->admin_nama; ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <?php $this->ADM->submenu_pengguna($menu_terpilih, $submenu_terpilih);?>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
			<?php $this->load->view($content);?>
               
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="<?php echo base_url();?>templates/admin/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url();?>templates/admin/js/bootstrap.min.js" type="text/javascript"></script>
       
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo base_url();?>templates/admin/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url();?>templates/admin/js/AdminLTE/app.js" type="text/javascript"></script>
           <script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/date/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/date/jquery-ui-1.8.17.custom.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/popup/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/popup/jquery.fancybox-1.3.4.pack.js"></script>
<script>
var f=jQuery.noConflict();  
  f(document).ready(function(){  
  f( '#agenda_selesai' ).datepicker({ minDate: -0, maxDate: "+1M +3D",
		changeMonth: true,
		changeYear:true,
		dateFormat: "dd-mm-yy",
		dayNamesMin:['Mg','Sn','Se','Ra','Ka','Jm','Sb'],
		monthNamesShort:['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'],
		showAnim:'fade',
		maxDate: "+1Y"
   });
 });
</script>
<script>
var m=jQuery.noConflict();  
  m(document).ready(function(){  
m('#agenda_mulai').datepicker({
		changeMonth: true,
		changeYear:true,
		dateFormat: "dd-mm-yy",
		dayNamesMin:['Mg','Sn','Se','Ra','Ka','Jm','Sb'],
		monthNamesShort:['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'],
		showAnim:'fade',
		minDate: "-1Y", 
		maxDate: "+1Y"
	});

});
</script>
<script type="text/javascript">
		var d=jQuery.noConflict();  
		  d(document).ready(function(){  
		d("a[rel=detail]").fancybox({
				'height'			: 500,
				'width'				: 900,
				'autoScale'			: false,
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'none',
				'overlayShow'		: false,
				'type'				: 'iframe',
				'prevEffect'        : 'none',
				'nextEffect'        : 'none',
				'showNavArrows'	    : false
			});
	});
</script>
</body>
</html>