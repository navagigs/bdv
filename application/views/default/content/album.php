<?php if( $action == 'gallery') {?> 
<!-- Breadcrumb -->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>">Home</a></li>
        <li><a href="<?php echo base_url();?>album">Album</a></li>
        <li class="active">Galeri Foto</li>
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
                    <section id="blog-detail">
                        <header><h1>Galeri Foto</h1></header>
                        <div class="section-content">
						<section id="gallery">
                    <div class="section-content">
                        <ul class="gallery-list">
                            
                            <?php 
                            $i	= $page+1;
							$where_album['ag.album_id'] = $album_id;
							$where 						= (empty($album_id))?'': $where_album;
                            if ($jml_data > 0){
                            foreach ($this->ADM->grid_all_album_galeri('*', 'galeri_id', 'DESC', $batas, $page, $where, '') as $row){
                            ?>  
                            <li><a href="<?php echo base_url();?>assets/images/galeri/<?php echo $row->galeri_gambar; ?>" class="image-popup"><img src="<?php echo base_url();?>assets/images/galeri/kecil_<?php echo $row->galeri_gambar; ?>" title="<?php echo $row->galeri_judul; ?>"></a></li>
                            <?php 
                            $i++; 
                            } 												
							?>
                        </ul>
                         <?php
                            } else { 
                            ?>
                        <header><b>Tidak Ada Gallery</b>
                            <?php } ?>
                             </div><!-- /.section-content -->
               		 </section><!-- /.gallery -->
                           
                        </div><!-- /.section-content -->
                    </section><!-- /.events-images -->
                    <div class="center">
                        <ul class="pagination">
                        <?php if ($jml_halaman > 1){ echo pages2($halaman, $jml_halaman, 'album/gallery/index', $id=""); }?>
                   
                        </ul><!-- /.pagination -->
                    </div><!-- /.center -->
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
<?php } else { ?>
<!-- Breadcrumb -->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>">Home</a></li>
        <li class="active">Album</li>
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
                    <section class="events images" id="events">
                        <header><h1>Album</h1></header>
                        <div class="section-content">
						<section id="gallery">
                    <div class="section-content">
                        <ul class="gallery-list">
                            <?php 
                            $i	= $page+1;
                            if ($jml_data > 0){
                            foreach ($this->ADM->grid_all_album('*', 'album_id', 'DESC', $batas, $page, '', '') as $row){
                            ?>  
                            <li><a href="<?php echo site_url();?>album/gallery/<?php echo $row->album_id; ?>"><img src="<?php echo base_url();?>assets/images/album/kecil_<?php echo $row->album_gambar; ?>" title="<?php echo $row->album_judul; ?>" alt="" title="<?php echo substr($row->album_judul,0,25).'...'; ?>"></a></li>
                            <?php 
                            $i++; 
                            } 												
							?>
                        </ul>
                         <?php
                            } else { 
                            ?>
                        <header><b>Tidak Ada Album</b>
                            <?php } ?>
                    </div><!-- /.section-content -->
                </section><!-- /.gallery -->
                           
                        </div><!-- /.section-content -->
                    </section><!-- /.events-images -->
                    <div class="center">
                        <ul class="pagination">
                        <?php if ($jml_halaman > 1){ echo pages2($halaman, $jml_halaman, 'album/index', $id=""); }?>
                   
                        </ul><!-- /.pagination -->
                    </div><!-- /.center -->
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

<?php }  ?>