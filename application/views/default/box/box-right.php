 <div class="col-md-4"> <!-- Blog Sidebar -->
                        <div class="sidebar">
                            <div class="widget post-tab"> <!-- Posts Tab Widget -->
                                <div role="tabpanel">

                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#news" aria-controls="news" role="tab" data-toggle="tab">News</a></li><!-- news Posts -->
                                        <li role="presentation"><a href="#events" aria-controls="events" role="tab" data-toggle="tab">Events</a></li><!-- events Posts -->
                                        <li role="presentation"><a href="#jobs" aria-controls="jobs" role="tab" data-toggle="tab">Jobs</a></li><!-- jobsPosts -->
                                        <li role="presentation"><a href="#downloads" aria-controls="downloads" role="tab" data-toggle="tab">Downloads</a></li><!-- download Posts -->
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content"> 
                                        <div role="tabpanel" class="tab-pane active" id="news"><!-- news Posts -->
                                            <div class="list-group">
											<?php 
										 		$where['kategori_id'] = '3';
													if ($this->ADM->count_all_berita2($where) > 0){
												foreach ($this->ADM->grid_all_berita2('*', 'berita_id', 'DESC', 8, '', $where) as $row){  ?>
                                                <a href="<?php echo site_url()?>news/read/<?php echo $row->berita_id.'/'.$this->CONF->seo($row->berita_judul)?>" class="list-group-item">
                                                    <p class="small"><?php echo dateIndoNews($row->berita_waktu); ?></p>
                                                    <h5 class="media-heading"><strong><?php echo substr($row->berita_judul,0,60); ?></strong></h5>
                                                </a>
                                              <?php } } else { ?>
                          					 <a href="#" class="list-group-item"><b>Tidak Ada Event</b></a>
										<?php 	} ?> 
                                               
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="events"><!-- events Posts -->
                                            <div class="list-group">
											<?php 
                                            $jml = $this->ADM->count_all_agenda();
                                            if ($jml > 0) {
                                            foreach ($this->ADM->grid_all_agenda('*', 'agenda_posting', 'DESC', 8, '', '', '') as $row){ ?>
                                                <a href="<?php echo site_url()?>events/read/<?php echo $row->agenda_id.'/'.$this->CONF->seo($row->agenda_tema)?>" class="list-group-item">
                                                    <p class="small"><?php echo dateIndoNews($row->agenda_posting); ?></p>
                                                    <h5 class="media-heading"><strong><?php echo substr($row->agenda_tema,0,60); ?></strong></h5>
                                                </a>
                                              <?php } } else { ?>
                          					 <a href="#" class="list-group-item"><b>Tidak Ada Event</b></a>
										<?php 	} ?>   
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="downloads"><!-- events Posts -->
                                            <div class="list-group">
											<?php 
                                            $jml = $this->ADM->count_all_downloads();
                                            if ($jml > 0) {
                                            foreach ($this->ADM->grid_all_downloads('*', 'download_id', 'DESC', 8, '', '', '') as $row){ ?>
                                                <a href="<?php echo base_url();?>assets/files/download/<?php echo $row->download_file;?>"  class="list-group-item">
                                                    <p class="small"><?php echo dateIndoNews($row->download_waktu); ?></p>
                                                    <h5 class="media-heading"><strong><?php echo substr($row->download_judul,0,60); ?></strong></h5>
                                                </a>
                                              <?php } } else { ?>
                          					 <a href="#" class="list-group-item"><b>Tidak Ada File Downloads</b></a>
										<?php 	} ?>   
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="downloads"><!-- events Posts -->
                                            <div class="list-group">
											<?php 
                                            $jml = $this->ADM->count_all_downloads();
                                            if ($jml > 0) {
                                            foreach ($this->ADM->grid_all_downloads('*', 'download_id', 'DESC', 8, '', '', '') as $row){ ?>
                                                <a href="<?php echo base_url();?>assets/files/download/<?php echo $row->download_file;?>"  class="list-group-item">
                                                    <p class="small"><?php echo dateIndoNews($row->download_waktu); ?></p>
                                                    <h5 class="media-heading"><strong><?php echo substr($row->download_judul,0,60); ?></strong></h5>
                                                </a>
                                              <?php } } else { ?>
                          					 <a href="#" class="list-group-item"><b>Tidak Ada File Downloads</b></a>
										<?php 	} ?>   
                                            </div>
                                        </div>
                                        
                                        <div role="tabpanel" class="tab-pane" id="jobs"><!-- events Posts -->
                                            <div class="list-group">
											<?php 
										 		$where['kategori_id'] = '4';
													if ($this->ADM->count_all_berita2($where) > 0){
												foreach ($this->ADM->grid_all_berita2('*', 'berita_id', 'DESC', 10, '', $where) as $row){  ?>
                                                <a href="<?php echo site_url()?>jobs/read/<?php echo $row->berita_id.'/'.$this->CONF->seo($row->berita_judul)?>" class="list-group-item">
                                                    <p class="small"><?php echo dateIndoNews($row->berita_waktu); ?></p>
                                                    <h5 class="media-heading"><strong><?php echo substr($row->berita_judul,0,60); ?></strong></h5>
                                                </a>
                                              <?php } } else { ?>
                          					 <a href="#" class="list-group-item"><b>Tidak Ada Jobs</b></a>
										<?php 	} ?> 
                                            </div>
                                        </div>
                                        
                                        
                                        <div role="tabpanel" class="tab-pane active" id="jobs"><!-- news Posts -->
                                            <div class="list-group">
                                               
                                            </div>
                                        </div>
                                </div>
                            </div>

                                </div>
                            </div>

                        </div>
                    </div><!-- end right content col 4 -->