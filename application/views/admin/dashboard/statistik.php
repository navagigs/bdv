<section class="content-header">
<h1>Dashboard<small>Control Panel</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Dashboard</li>
</ol>
</section>

<!-- Main content -->

<section class="content">
<div class="row">
<div class="col-xs-12">
<div class="box">
	<div class="box-body table-responsive">  
<div id="welcome">
<h3 style="display:block;">Selamat datang di Halaman Administrator <?php echo $web->identitas_website;?></h3>
<div class="clear"></div>
<div class="callout callout-info">
<h4>Hallo, <?php echo $admin->admin_nama; ?></h4>
 <p>Sistem informasi ini untuk administrator atau operator menjalankan data yang akan dibuat</p>
 </div>
 <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                    <?php echo $jml_data_join_event;?>
                                    </h3>
                                    <p>
                                       Pengikut Events
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="<?php echo site_url();?>website/agenda" class="small-box-footer">
                                    Lihat Events <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                    <?php echo $jml_data_komentar;?>
                                    </h3>
                                    <p>
                                        Komentar
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="<?php echo site_url();?>website/komentar" class="small-box-footer">
                                    Lihat Komentar <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                    <?php echo $jml_data_admin;?>
                                    </h3>
                                    <p>
                                        Member Registrasi
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="<?php echo site_url();?>pengaturan/pengguna" class="small-box-footer">
                                     Lihat Pengguna <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                    <?php echo $jml_data_management;?>
                                    </h3>
                                    <p>
                                        Management Team
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="<?php echo site_url();?>website/management" class="small-box-footer">
                                    Lihat Management <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        </div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
