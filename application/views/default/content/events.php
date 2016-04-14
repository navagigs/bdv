<?php if( $action == 'detail' ) {?>
<br />
    <!-- Page Header
    ================================================== -->
    <div id="tf-header">
        <div class="container"> <!-- container -->
            <h1>EVENTS</h1>
            <ol class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li><a href="<?php echo base_url();?>events">Events</a></li>
                <li><a class="active"><?php echo $agenda->agenda_tema; ?></a></li>
            </ol>
        </div><!-- end container -->
    </div>
 <!--  Blog Section
    ================================================== -->
    <div id="tf-blog" class="blog-post">
        <div class="container"> <!-- container -->
            <div class="section-header">
                <h2>read<span class="highlight"><strong> events</strong></span></h2>
                <h5><em><?php echo $agenda->agenda_tema; ?></em></h5>
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
                        <div class="post-wrap"> <!-- Post Wrapper -->
                            <p class="small"><?php echo dateIndoNews($agenda->agenda_posting); ?></p>
                            <a href="#">
                                <h5 class="media-heading"><strong><?php echo $agenda->agenda_tema; ?></strong></h5>
                            </a>

                            <ul class="list-inline metas pull-left"> <!-- post metas -->
                                <li><a href="#">by <?php echo $agenda->admin_nama; ?></a></li> <!-- meta author -->
                            </ul>

                            <img src="<?php echo base_url(); ?>assets/images/agenda/<?php echo $agenda->agenda_gambar; ?>" class="img-responsive" width="800" height="500" alt="...">

                            <p><?php echo $agenda->agenda_deskripsi; ?></p>

                            <br>
                            <br />
 						<center>
                        <form action="<?php echo site_url();?>events/join_events" method="post" onSubmit="return validate()" > 
                            <input type="text" class="text-hidden" name="join_nama" value="<?php echo $this->session->userdata('admin_nama'); ?>" /><br />
                            <input type="hidden" name="agenda_id" value="<?php echo $agenda->agenda_id; ?>" />
                        <input type="submit" name="kirim"  value="JOIN TO EVENTS" class="myButton"  />
                        </form></center>
						
 
             
                 
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
    <!-- <?php echo $web->identitas_author;?> -->

<?php }  else { ?>
<br />
<!-- Page Header
    ================================================== -->
    <div id="tf-header">
        <div class="container"> <!-- container -->
            <h1>EVENTS</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>home">Home</a></li>
                <li><a class="active">Events</a></li>
            </ol>
        </div><!-- end container -->
    </div>

    <!--  Blog Section
    ================================================== -->
    <div id="tf-blog" class="blog">
        <div class="container"> <!-- container -->
            <div class="section-header">
                <h2>events<span class="highlight"><strong></strong></span></h2>
                <div class="fancy"><span><img src="<?php echo base_url();?>templates/default/assets/img/icon-idigo.png" alt="..."></span></div>
            </div>
        </div>

        <div id="blog-post"> <!-- fullwidth gray background -->
            <div class="container"><!-- container -->

                <div class="row"> <!-- row -->
                    <div class="col-md-6 col-md-offset-1"> <!-- Left Blogrol col 8 -->

                      
 					<?php 
					$jml = $this->ADM->count_all_agenda();
					if ($jml > 0) {
					foreach ($this->ADM->grid_all_agenda('*', 'agenda_id', 'DESC',  $batas, $page, '', '') as $row){ ?>
                    <div class="post-wrap"> <!-- Post Wrapper -->
                            <div class="media post"> <!-- post wrap -->
                                <div class="media-left"> 
                                    <a href="<?php echo site_url()?>events/read/<?php echo $row->agenda_id.'/'.$this->CONF->seo($row->agenda_tema)?>"> <!-- link to your post single page -->
                                      <img class="media-object" src="<?php echo base_url()."assets/images/agenda/".$row->agenda_gambar; ?>" width="120" height="150" alt="..."> <!-- Your Post Image -->
                                    </a>
                                </div>
                                <div class="media-body">
                                    <p class="small"><?php echo dateIndoNews($row->agenda_posting); ?></p>
                                    <a href="<?php echo site_url()?>events/read/<?php echo $row->agenda_id.'/'.$this->CONF->seo($row->agenda_tema)?>">
                                        <h5 class="media-heading"><strong>
                                    <a href="<?php echo site_url()?>events/read/<?php echo $row->agenda_id.'/'.$this->CONF->seo($row->agenda_tema)?>"><?php echo substr($row->agenda_tema,0,60); ?></strong></h5>
                                    </a>
                                    <p><?php echo substr($row->agenda_deskripsi,0,150).'...';?></p>
                                </div>
                            </div><!-- end post wrap -->
                            
                            <div class="post-meta"> <!-- Meta reads -->
                                <ul class="list-inline metas pull-left"> <!-- post metas -->
                                    <li><a href="#">by <?php echo  $row->admin_nama; ?></a></li> <!-- meta author -->
                                    <li><a href="<?php echo site_url()?>events/read/<?php echo $row->agenda_id.'/'.$this->CONF->seo($row->agenda_tema)?>">Read More</a></li> <!-- read more link -->
                                </ul>
                            </div><!-- end Meta reads --> 
                        </div><!-- end Post Wrapper -->
                     <?php } } else { ?>
                            <div class="media post"> <b>Tidak Ada Events</b></div>
					<?php 	} ?>   

   

                        <div class="text-left"> <!-- Blogrol Pagination -->
                            <nav>
                                <ul class="pagination">
                                    <li>
                        
                      				  <?php if ($jml_halaman > 1){ echo pages2($halaman, $jml_halaman, 'events/page', $id=""); }?>
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
    <!-- <?php echo $web->identitas_author;?> -->

<?php } ?>