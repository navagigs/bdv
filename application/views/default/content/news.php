<?php if( $action == 'detail' ) {?>
<br />
    <!-- Page Header
    ================================================== -->
    <div id="tf-header">
        <div class="container"> <!-- container -->
            <h1>NEWS</h1>
            <ol class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li><a href="<?php echo base_url();?>news">News</a></li>
                <li><a class="active"><?php echo $berita->berita_judul; ?></a></li>
            </ol>
        </div><!-- end container -->
    </div>
 <!--  Blog Section
    ================================================== -->
    <div id="tf-blog" class="blog-post">
        <div class="container"> <!-- container -->
            <div class="section-header">
                <h2>Read<span class="highlight"><strong> News</strong></span></h2>
                <h5><em><?php echo $berita->berita_judul; ?></em></h5>
                <div class="fancy"><span><img src="<?php echo base_url();?>templates/default/assets/img/icon-idigo.png" alt="..."></span></div>
            </div>
        </div>

        <div id="blog-post"> <!-- fullwidth gray background -->
            <div class="container"><!-- container -->

                <div class="row"> <!-- row -->
                    <div class="col-md-6 col-md-offset-1"> <!-- Left Blogrol col 8 -->

                        <div class="post-wrap"> <!-- Post Wrapper -->
                            <p class="small"><?php echo dateIndoNews($berita->berita_waktu); ?></p>
                            <a href="#">
                                <h5 class="media-heading"><strong><?php echo $berita->berita_judul; ?></strong></h5>
                            </a>

                            <ul class="list-inline metas pull-left"> <!-- post metas -->
                                <li><a href="#">by <?php echo $berita->admin_nama; ?></a></li> <!-- meta author -->
                            </ul>

                            <img src="<?php echo base_url(); ?>assets/images/berita/<?php echo $berita->berita_gambar; ?>" class="img-responsive" width="800" height="500" alt="...">

                            <p><?php echo $berita->berita_deskripsi; ?></p>

                            <br>
                            <br>
                            <p><strong>Tags:</strong></p>
                            <ul class="list-inline meta-tags">
                                <li> <?php $this->ADM->tagsberita("SELECT * FROM tags ORDER BY tag_judul ASC", 'tag[]', 'tag_id', 'tag_judul', $berita->tags);?></li>
                            </ul>
                        </div><!-- end Post Wrapper -->
                        <div id="comments" class="comment">
                            <h4 class="text-uppercase">Komentar <span class="comments"></span></h4>
                         <?php 
                                $i	= $page+1;
                               // $where_komentar['k.komentar_status'] = 'Y';
                                $where_komentar['k.berita_id'] = $berita_id;
                                if ($jml_data > 0){
                                foreach ($this->ADM->grid_all_komentar('*', 'komentar_waktu', 'DESC', 10, '', $where_komentar, '') as $row){
                                ?>
                            <div class="media comment-block"> <!-- Comment Block #1 -->
                                <div class="media-left media-top">
                                    <a href="#">
                                      <img class="media-object" src="<?php echo base_url(); ?>templates/default/assets/img/icon-user.png" width="90" height="90" alt="...">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <small class="pull-right"><?php echo dateIndoNews($row->komentar_waktu); ?></small>
                                    <h5 class="media-heading"><a href="#"><?php echo $row->admin_nama; ?></a></h5> 
                                    <div class="clearfix"></div><?php echo $row->komentar_deskripsi ?>
                                    <div class="clearfix"></div>
                            </div>
                                </div><?php 
                                $i++; 
                                } 
                                } else { 
                                ?>
                                <?php } ?>
</div>

 <?php
				if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('admin_level') == '5') { ?>
             
                        <div class="comment">
                            <h4 class="text-uppercase">Tinggalkan Komentar</h4>
                            <?php if ($this->session->flashdata('success') || $this->session->flashdata('error')) {?>
                            <div id="massage">
                                <?php if ($this->session->flashdata('success')) { ?>
                                <div class="success"><span><?php echo $this->session->flashdata('success');?></span></div>
                                <?php } else { ?>
                                <div class="error"><span><?php echo $this->session->flashdata('error');?></span></div>
                                <?php } ?>
                            </div>
                            <?php }  ?>
                            <div class="clear"></div>
                            <script language="javascript">
                            function validate(){
                                <?php foreach ($validate as $key => $value) { ?>
                                var <?php echo $key;?> = document.getElementById('<?php echo $key;?>').value;
                                if (<?php echo $key;?>.length==0){
                                    alert ('<?php echo $value;?> harus diisi!');
                                    document.getElementById('<?php echo $key;?>').focus();
                                    return false;
                                }
                                <?php } ?>
                                return true;
                            }
                            </script>
                            <form id="contact-form" class="form" action="<?php echo site_url();?>news/komentar" method="post" onSubmit="return validate()">
                            <input type="hidden" name="berita_id" value="<?php echo $berita->berita_id; ?>" />
                                <div class="row">
                                </div>
                                <textarea class="form-control" name="komentar_deskripsi" required="required" rows="6" placeholder="Komentar..."></textarea>
                                <input type="submit" name="simpan" class="btn btn-primary" value="Submit Comment">
                            </form>
                        </div>
                
				<?php
				} else  { ?>
               <br />  <center> <b>Berikan Komentar silahkan <a href="<?php echo base_url(); ?>pages/sign_in" title="Login">Login</a></b></center>
				<?php  } ?>


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
            <h1>NEWS</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>home">Home</a></li>
                <li><a class="active">News</a></li>
            </ol>
        </div><!-- end container -->
    </div>

    <!--  Blog Section
    ================================================== -->
    <div id="tf-blog" class="blog">
        <div class="container"> <!-- container -->
            <div class="section-header">
                <h2>NEWS<span class="highlight"><strong></strong></span></h2>
                <div class="fancy"><span><img src="<?php echo base_url();?>templates/default/assets/img/icon-idigo.png" alt="..."></span></div>
            </div>
        </div>

        <div id="blog-post"> <!-- fullwidth gray background -->
            <div class="container"><!-- container -->

                <div class="row"> <!-- row -->
                    <div class="col-md-6 col-md-offset-1"> <!-- Left Blogrol col 8 -->

                      
 					<?php 
					$where['kategori_id'] = '3';
					$jml = $this->ADM->count_all_berita2();
					if ($jml > 0) {
					foreach ($this->ADM->grid_all_berita2('*', 'berita_id', 'DESC',  $batas, $page, $where) as $row){ ?>
                    <div class="post-wrap"> <!-- Post Wrapper -->
                            <div class="media post"> <!-- post wrap -->
                                <div class="media-left"> 
                                    <a href="<?php echo site_url()?>news/read/<?php echo $row->berita_id.'/'.$this->CONF->seo($row->berita_judul)?>"> <!-- link to your post single page -->
                                      <img class="media-object" src="<?php echo base_url()."assets/images/berita/".$row->berita_gambar; ?>" width="120" height="150" alt="..."> <!-- Your Post Image -->
                                    </a>
                                </div>
                                <div class="media-body">
                                    <p class="small"><?php echo dateIndoNews($row->berita_waktu); ?></p>
                                    <a href="<?php echo site_url()?>news/read/<?php echo $row->berita_id.'/'.$this->CONF->seo($row->berita_judul)?>">
                                        <h5 class="media-heading"><strong>
                                    <a href="<?php echo site_url()?>news/read/<?php echo $row->berita_id.'/'.$this->CONF->seo($row->berita_judul)?>"><?php echo substr($row->berita_judul,0,60); ?></strong></h5>
                                    </a>
                                    <p><?php echo substr($row->berita_deskripsi,0,150).'...';?></p>
                                </div>
                            </div><!-- end post wrap -->
                            
                            <div class="post-meta"> <!-- Meta details -->
                                <ul class="list-inline metas pull-left"> <!-- post metas -->
                                    <li><a href="#">by <?php echo  $row->admin_nama; ?></a></li> <!-- meta author -->
                                    <li><a href="<?php echo site_url()?>news/read/<?php echo $row->berita_id.'/'.$this->CONF->seo($row->berita_judul)?>">Read More</a></li> <!-- read more link -->
                                </ul>
                            </div><!-- end Meta details --> 
                        </div><!-- end Post Wrapper -->
                     <?php } } else { ?>
                            <div class="media post"> <b>Tidak Ada News</b></div>
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

<?php } ?>