<!-- Breadcrumb -->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>">Home</a></li>
        <li class="active">Hasil pencarian kata kunci "<i><?php echo $q; ?></i>"</li>
    </ol>
</div>
<!-- end Breadcrumb -->

<!-- Page Content -->
<div id="page-content">
    <div class="container">
        <div class="row">
            <!--MAIN Content-->
            <div class="col-md-8" style="min-height: 1060px;">
                <div id="page-main">
                    <section id="right-sidebar">
                        <header><h2><?php echo $q; ?></h2></header>
                        <div class="row">    
						<?php 
                            $i	= $page+1;
							$like_pencarian['berita_judul']	= $q;
							$like_pencarian['berita_deskripsi']	= $q;
                            if ($jml_data > 0){							
                            foreach ($this->ADM->grid_all_pencarian('*', 'berita_waktu', 'ASC', $batas, $page, '', $like_pencarian) as $row){
                            ?>  
                            <div class="col-md-6 col-sm-6">
                                <article class="blog-listing-post">
                                    <figure class="blog-thumbnail">
                                        <figure class="blog-meta"><span class="fa fa-file-text-o"></span><?php echo dateIndo4($row->berita_waktu); ?></figure>
                                        <div class="image-wrapper"><a href="<?php echo base_url();?>news/read/<?php echo $row->berita_id.'/'.$this->CONF->seo($row->berita_judul)?>"><img src="<?php echo base_url(); ?>assets/images/berita/kecil_<?php echo $row->berita_gambar; ?>" width="750" height="200"></a></div>
                                    </figure>
                                    <aside>
                                        <header>
                                            <a href="<?php echo base_url();?>news/read/<?php echo $row->berita_id.'/'.$this->CONF->seo($row->berita_judul)?>"><h3><?php echo substr($row->berita_judul,0,30); ?></h3></a>
                                        </header>
                                        <div class="description">
                                            <p><?php echo substr($row->berita_deskripsi,0,150).'...';?></p>
                                        </div>
                                        <a href="<?php echo base_url();?>news/read/<?php echo $row->berita_id.'/'.$this->CONF->seo($row->berita_judul)?>" class="read-more stick-to-bottom" >Selengkapnya</a>
                                    </aside>
                                </article><!-- /article -->
                            </div><!-- /.col-md-6 --> 
							 <?php 
	$i++; 
	} 
	} else { 
	?>                        
                           <header>Maaf pencarian yang Anda maksud tidak terdapat dalam data kami.</header>
                            <?php } ?>
   						
                        </div><!-- /.row -->

                    </section><!-- /.blog-listing -->
                   
                    <div class="center">
                        <ul class="pagination">
                        <?php if ($jml_halaman > 1){ echo pages2($halaman, $jml_halaman, 'search/pages', $id=""); }?>
                    
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
