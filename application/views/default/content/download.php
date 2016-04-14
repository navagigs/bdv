<!-- Breadcrumb -->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>">Home</a></li>
        <li class="active">Download</li>
    </ol>
</div>
<!-- end Breadcrumb -->

<!-- Page Content -->
<div id="page-content">
    <div class="container">
        <div class="row">
            <!--MAIN Content-->
            <div class="col-md-8">
                <div id="page-main">
                    <section id="members">
                        <header><h1>Download</h1></header>
                        <section id="our-speakers">           
						<?php 
                            $i	= $page+1;
                            if ($jml_data > 0){
                            foreach ($this->ADM->grid_all_downloads('*', 'download_id', 'DESC', $batas, $page, '', '') as $row){
                            ?> 
                            <div class="author-block course-speaker">
                                <figure class="author-picture"><img src="<?php echo base_url(); ?>templates/default/assets/img/icon-file.jpg" width="150" alt=""></figure>
                                <article class="paragraph-wrapper">
                                    <div class="inner">
                                        <header><?php echo $row->download_judul;?></header>
                                <div class="blog-detail-meta">
                                    <span class="date"><span class="fa fa-file-o"></span> 
                                         <?php echo dateIndo($row->download_waktu); ?></span>
                                    <!--<span class="author"><span class="fa fa-user"></span>Prof. John Doe</span>-->
                                 <!--   <span class="comments"><span class="fa fa-comment-o"></span>6 comments</span>-->
                                </div>
                                        <p><?php echo $row->download_deskripsi;?></p><br />
                                        <a href="<?php echo base_url();?>assets/files/download/<?php echo $row->download_file;?>" class="btn btn-framed btn-small btn-color-grey" target="_blank">Download</a>
                                    </div>
                                </article>
                            </div><!-- /.author -->
                        
							<?php 
                            $i++; 
                            } 												
							?>                                                        
                            <?php
                            } else { 
                            ?>
                          <article>Tidak Ada Download</article>
                            <?php } ?>
                            </section>
                            <div class="center">
                        <ul class="pagination">
                        <?php if ($jml_halaman > 1){ echo pages2($halaman, $jml_halaman, 'download/pages', $id=""); }?>
                    
                        </ul>
                    </div>
                </div><!-- /#page-main -->
            </div><!-- /.col-md-8 -->

 			<!--SIDEBAR Content-->
            <div class="col-md-4" style="min-height: 1060px;">
                <div id="page-sidebar" class="sidebar">
                     <?php 
                        if ($boxfakultas == TRUE) {
                            $this->load->view('default/box/box-fakultas');
                        } 
                        if ($boxlayanan == TRUE) {
                            $this->load->view('default/box/box-layanan');
                        } 
                        if ($boxberita == TRUE) {
                            $this->load->view('default/box/box-berita');
                        } 
                        if ($boxvideo == TRUE) {
                            $this->load->view('default/box/box-video');
                        } 
                        ?>
                </div><!-- /#sidebar -->
            </div><!-- /.col-md-4 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div>
<!-- end Page Content -->
