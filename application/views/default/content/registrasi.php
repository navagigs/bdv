<?php if( $action == 'profil' ) {?>
 <?php if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('admin_level') == '5') { ?>
    <br>
    <!-- Page Header
    ================================================== -->
    <div id="tf-header">
        <div class="container"> <!-- container -->
            <h1>PROFIL</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>home">Home</a></li>
                <li><a class="active">Profil</a></li>
            </ol>
        </div><!-- end container -->
    </div>

    <!--  Blog Section
    ================================================== -->
    <div id="tf-blog" class="blog">
        <div class="container"> <!-- container -->
            <div class="section-header">
                <h2>PROFIL<span class="highlight"><strong></strong></span></h2>
                <div class="fancy"><span><img src="<?php echo base_url();?>templates/default/assets/img/icon-idigo.png" alt="..."></span></div>
            </div>
        </div>

        <div id="blog-post"> <!-- fullwidth gray background -->
            <div class="container"><!-- container -->

                <div class="row"> <!-- row -->
                    <div class="col-md-6 col-md-offset-1"> <!-- Left Blogrol col 8 -->   
                        <?php if ($this->session->flashdata('success') || $this->session->flashdata('error')) {?>
                        <div id="massage">
                            <?php if ($this->session->flashdata('success')) { ?>
                            <div class="success"><span><?php echo $this->session->flashdata('success');?></span></div>
                            <?php } else { ?>
                            <div class="error"><span><?php echo $this->session->flashdata('error');?></span></div>
                            <?php } ?>
                        </div>
							<?php } ?>
                <form id="formMenu" action="<?php echo site_url();?>pages/update_profil" method="post" onSubmit="return validate()">
                <input type="hidden" name="admin_user" value="<?php echo $admin_user;?>" />
                        <div class="form-group"><input name="admin_user" type="text" class="form-control input-sm" id="admin_user" value="<?php echo $admin_user; ?>" readonly="readonly"/></div>
                        <div class="form-group"><input name="admin_pass" type="password" class="form-control input-sm" id="admin_pass" placeholder="Password" value="" /></div>
                        
                        <div class="form-group"><input name="admin_nama" type="text" class="form-control input-sm" id="admin_nama" value="<?php echo $admin_nama; ?>" readonly="readonly" /></div>
                        
                        <div class="form-group"><input name="admin_alamat" type="text" class="form-control input-sm" id="admin_alamat" value="<?php echo $admin_alamat; ?>" size="50" maxlength="255"/></div>
                        
                        <div class="form-group"><input name="admin_email" type="text" class="form-control input-sm" id="admin_email" value="<?php echo $admin_email; ?>"/></div>
                        
                        <div class="form-group"><input name="admin_telepon" type="text" class="form-control input-sm" id="admin_telepon" value="<?php echo $admin_telepon; ?>"/></div>
                        <div class="form-group">
                           <input type="submit"  class="btn btn-primary tf-btn color"  name="simpan" value="Update" />
                          </div>
                        </form>
                    </div> <!-- end Left content col 8 -->

                     <?php 
                        if ($boxright == TRUE) {
                            $this->load->view('default/box/box-right');
                        } 
					?>

                </div>
                       
            </div><!-- end container -->
        </div> <!-- end fullwidth gray background -->
    </div>
   <?php } } else { ?>
   
    <br>
    <!-- Page Header
    ================================================== -->
    <div id="tf-header">
        <div class="container"> <!-- container -->
            <h1>REGISTRASI</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>home">Home</a></li>
                <li><a class="active">Registrasi</a></li>
            </ol>
        </div><!-- end container -->
    </div>

    <!--  Blog Section
    ================================================== -->
    <div id="tf-blog" class="blog">
        <div class="container"> <!-- container -->
            <div class="section-header">
                <h2>REGISTRASI<span class="highlight"><strong></strong></span></h2>
                <div class="fancy"><span><img src="<?php echo base_url();?>templates/default/assets/img/icon-idigo.png" alt="..."></span></div>
            </div>
        </div>

        <div id="blog-post"> <!-- fullwidth gray background -->
            <div class="container"><!-- container -->

                <div class="row"> <!-- row -->
                    <div class="col-md-6 col-md-offset-1"> <!-- Left Blogrol col 8 -->
                        <?php if ($this->session->flashdata('success') || $this->session->flashdata('error')) {?>
                        <div id="massage">
                            <?php if ($this->session->flashdata('success')) { ?>
                            <div class="success"><span><?php echo $this->session->flashdata('success');?></span></div>
                            <?php } else { ?>
                            <div class="error"><span><?php echo $this->session->flashdata('error');?></span></div>
                            <?php } ?>
                        </div>
                        <?php } ?>
                			<form action="<?php echo base_url()."pages/input_reg"; ?>" method="post" onSubmit="return validate()">
                        <div class="form-group"><input type="text" name="admin_user" class="form-control" id="admin_user" placeholder="Username" required="required"/></div>
                        <div class="form-group"><input type="password" name="admin_pass" class="form-control" id="admin_pass" placeholder="Password"  required="required" /></div>
                        
                        <div class="form-group"><input type="text" name="admin_nama" class="form-control" id="admin_nama" placeholder="Nama Lengkap"  required="required" /></div>
                        
                        <div class="form-group"><input type="text" name="admin_alamat" class="form-control" id="admin_alamat" placeholder="Alamat"  required="required" /></div>
                        
                        <div class="form-group"><input type="text" name="admin_email" class="form-control" id="admin_email" placeholder="Email"  required="required" /></div>
                        
                        <div class="form-group"><input type="text" name="admin_telepon" class="form-control" id="admin_telepon" placeholder="Telepon"  required="required" /></div>
                        <div class="form-group">
                           <input type="submit"  class="btn btn-primary tf-btn color"  name="kirim" id="kirim" value="Registrasi" />
                          </div>
                        <center>
                       </center>
                        </form>
                    </div> <!-- end Left content col 8 -->

                     <?php 
                        if ($boxright == TRUE) {
                            $this->load->view('default/box/box-right');
                        } 
					?>

                </div>
                       
            </div><!-- end container -->
        </div> <!-- end fullwidth gray background -->
    </div>
   <? } ?>