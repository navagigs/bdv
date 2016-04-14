 <?php if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('admin_level') == '5') { ?>
<?php if( $action == 'detail' ) {?>
<br />
    <!-- Page Header
    ================================================== -->
    <div id="tf-header">
        <div class="container"> <!-- container -->
            <h1>Courses</h1>
            <ol class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li><a href="<?php echo base_url();?>courses">Courses</a></li>
                <li><a class="active"><?php echo $video->video_judul; ?></a></li>
            </ol>
        </div><!-- end container -->
    </div>
 <!--  Blog Section
    ================================================== -->
    <div id="tf-blog" class="blog-post">
        <div class="container"> <!-- container -->
            <div class="section-header">
                <h2>Read<span class="highlight"><strong> Video</strong></span></h2>
                <h5><em><?php echo $video->video_judul; ?></em></h5>
                <div class="fancy"><span><img src="<?php echo base_url();?>templates/default/assets/img/icon-idigo.png" alt="..."></span></div>
            </div>
        </div>

        <div id="blog-post"> <!-- fullwidth gray background -->
            <div class="container"><!-- container -->

                <div class="row"> <!-- row -->
                    <div class="col-md-6 col-md-offset-1"> <!-- Left Blogrol col 8 -->

                        <div class="post-wrap"> <!-- Post Wrapper -->
                            <p class="small"><?php echo dateIndoNews($video->video_waktu); ?></p>
                            <a href="#">
                                <h5 class="media-heading"><strong><?php echo $video->video_judul; ?></strong></h5>
                            </a>

                            <ul class="list-inline metas pull-left"> <!-- post metas -->
                            </ul>

                            
                               <iframe class="iframe_detail" src="<?php echo $video->video_link;?>"></iframe>

                            <p><?php echo $video->video_deskripsi; ?></p>

                            <br>
                            <br>
                          
                        </div><!-- end Post Wrapper -->
                       


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

<?php }  else { ?>
<br />
<!-- Page Header
    ================================================== -->
    <div id="tf-header">
        <div class="container"> <!-- container -->
            <h1>Courses</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>home">Home</a></li>
                <li><a class="active">courses</a></li>
            </ol>
        </div><!-- end container -->
    </div>

    <!--  Blog Section
    ================================================== -->
    <div id="tf-blog" class="blog">
        <div class="container"> <!-- container -->
            <div class="section-header">
                <h2>courses<span class="highlight"><strong></strong></span></h2>
                <div class="fancy"><span><img src="<?php echo base_url();?>templates/default/assets/img/icon-idigo.png" alt="..."></span></div>
            </div>
        </div>

        <div id="blog-post"> <!-- fullwidth gray background -->
            <div class="container"><!-- container -->

                <div class="row"> <!-- row -->
                    <div class="col-md-6 col-md-offset-1"> <!-- Left Blogrol col 8 -->

                      
 					<?php 
					
                            $i	= $page+1;
                            if ($jml_data > 0){
                            foreach ($this->ADM->grid_all_galeri_video('*', 'video_id', 'DESC', $batas, $page, '', '') as $row){ ?>
                    <div class="post-wrap"> <!-- Post Wrapper -->
                            <div class="media post"> <!-- post wrap -->
                                <div class="media-left"> 
                                    <a href="<?php echo base_url();?>video/read/<?php echo $row->video_id.'/'.$this->CONF->seo($row->video_judul)?>"> <!-- link to your post single page -->
                                        <iframe width="160" height="125" src="<?php echo $row->video_link;?>"></iframe> <!-- Your Post Image -->
                                    </a>
                                </div>
                                <div class="media-body">
                                    <p class="small"><?php echo dateIndoNews($row->video_waktu); ?></p>
                                    <a href="<?php echo base_url();?>courses/read/<?php echo $row->video_id.'/'.$this->CONF->seo($row->video_judul)?>>">
                                        <h5 class="media-heading"><strong>
                                    <a href="<?php echo base_url();?>courses/read/<?php echo $row->video_id.'/'.$this->CONF->seo($row->video_judul)?>"><?php echo $row->video_judul;?></strong></h5>
                                    </a>
                                    <p><?php echo $row->video_deskripsi;?></p>
                                </div>
                            </div><!-- end post wrap -->
                            
                            <div class="post-meta"> <!-- Meta details -->
                                <ul class="list-inline metas pull-left"> <!-- post metas -->
                                    <li><a href="<?php echo base_url();?>courses/read/<?php echo $row->video_id.'/'.$this->CONF->seo($row->video_judul)?>">Read More</a></li> <!-- read more link -->
                                </ul>
                            </div><!-- end Meta details --> 
                        </div><!-- end Post Wrapper -->
                     <?php } } else { ?>
                            <div class="media post"> <b>Tidak Ada Course</b></div>
					<?php 	} ?>   

   

                        <div class="text-left"> <!-- Blogrol Pagination -->
                            <nav>
                                <ul class="pagination">
                                    <li>
                        
                      				  <?php if ($jml_halaman > 1){ echo pages2($halaman, $jml_halaman, 'news/pages', $id=""); }?>
                                    </li>
                                </ul>
                            </nav>
                        </div>         

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

<?php } } ?>