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
                            <?php }  ?>
                    <form action="<?php echo site_url()."pages/ceklogin"; ?>" method="post" onsubmit="return validate();">
                        <div class="form-group"><input type="text" name="username" class="form-control" id="username" placeholder="Username" required="required"  /></div>
                        <div class="form-group"><input type="password" name="password" class="form-control" id="password" placeholder="Password" required="required"  /></div>
                        <div class="form-group"> <input type="checkbox" name="remember_me" id="remember_me" /> Remember Me</div>
                        <div class="form-group">
                           <input type="submit"  class="btn btn-primary tf-btn color"  name="kirim" id="kirim" value="Login" />
                        	<!--br> <br>Lupa password? <a href="<?php echo base_url();?>pages/reset_password">Click here</a-->
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