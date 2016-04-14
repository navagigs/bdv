    <br>
    <!-- Page Header
    ================================================== -->
    <div id="tf-header">
        <div class="container"> <!-- container -->
            <h1>SIGN-IN</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>home">Home</a></li>
                <li><a class="active">Sign-in</a></li>
            </ol>
        </div><!-- end container -->
    </div>

    <!--  Blog Section
    ================================================== -->
    <div id="tf-blog" class="blog">
        <div class="container"> <!-- container -->
            <div class="section-header">
                <h2>SIGN-IN<span class="highlight"><strong></strong></span></h2>
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
                    <?php if( $action == 'new_password' ) {?>
                    
  							<script>
                              function cekpass()
							{
								var pass1 = $("#admin_pass").val();
								var pass2 = $("#admin_pass").val();
								if (pass1 != pass2)
								{
									alert("Password tidak sama");
									return false;
								}
								else
								{
									$( "#new_password" ).submit();
								}
							}
					</script>
                    <form action="<?php echo site_url()."pages/new_password"; ?>" method="post" >
    					<input name="action" type="hidden" value="<?php echo $admin_email; ?>" /></p>
                        <div class="form-group"><input type="password" name="admin_pass" class="form-control" id="admin_pass" placeholder="Masukan password baru"  required="required" /></div>
                        <div class="form-group"><input type="password" name="admin_pass2" class="form-control" id="admin_pass" placeholder="Ulangi password baru"  required="required" /></div>
                        <div class="form-group">
                           <input type="submit"  class="btn btn-primary tf-btn color"  name="edit" id="edit" value="Reset Password" onclick="cekpass();"  />
                          </div>
                        </form>
                     <?php } else { ?>
                    <form action="<?php echo site_url()."pages/reset_password"; ?>" method="post" onsubmit="return validate();">
                        <div class="form-group"><input type="text" name="admin_email" class="form-control" id="admin_email" placeholder="Masukan Email"  required="required" /></div>
                        <div class="form-group">
                           <input type="submit"  class="btn btn-primary tf-btn color"  name="kirim" id="kirim" value="Reset Password" />
                          </div>
                        </form>
                     <?php } ?>
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