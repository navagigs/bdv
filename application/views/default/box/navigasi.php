
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
        	<?php
            $i = 0;
			$menu_kode = '93';
			$admin_level_kode= '3';
			$where_pengguna['menu_kode']	= $menu_kode;
			$where_pengguna['admin_level_kode']	= $admin_level_kode;
			$lisquery = $this->db->query("SELECT * FROM menu WHERE menu_status='A' AND menu_level='2' AND menu_subkode='93' AND menu_kode NOT IN ('111','112','113','124','125','126') ORDER BY menu_urutan ASC");
			foreach ($lisquery->result() as $list){
				$i++;	
				$where_pengguna2['menu_kode']	= $list->menu_kode;
				$where_pengguna2['admin_level_kode']	= $admin_level_kode;
				if ($list->menu_site == 'A') { 
					echo "<li ><a href='".site_url().$list->menu_url."' data-toggle='dropdown'>".$list->menu_nama."</a>";
				} else {
					echo "<li><a href='".$list->menu_url."'>".$list->menu_nama."</a>";
				}
				
				echo "<ul class='dropdown-menu'>";
				$lisquery2 = $this->db->query("SELECT * FROM menu WHERE menu_status='A' AND menu_level='3' AND menu_subkode='".$list->menu_kode."' ORDER BY menu_urutan ASC");
				foreach ($lisquery2->result() as $list2){
					$i++;	
					$where_pengguna3['menu_kode']	= $list2->menu_kode;
					$where_pengguna3['admin_level_kode']	= $admin_level_kode;
					if ($list2->menu_site == 'A') { 
						echo "<li><a href='".site_url().$list2->menu_url."  class='menu-link  sub-menu-link''>".$list2->menu_nama."</a>";
					} else {
						echo "<li><a href='".$list2->menu_url."' target='_blank'>".$list2->menu_nama."</a>";
					}
					echo "<ul class='list-unstyled child-navigation'>";
					$lisquery3 = $this->db->query("SELECT * FROM menu WHERE menu_status='A' AND menu_level='4' AND menu_subkode='".$list2->menu_kode."' ORDER BY menu_urutan ASC");
					foreach ($lisquery3->result() as $list3){
						$i++;	
						$where_pengguna4['menu_kode']	= $list3->menu_kode;
						$where_pengguna4['admin_level_kode']	= $admin_level_kode;
						echo "<li><a href='".site_url().$list3->menu_url."'>".$list3->menu_nama."</a>";
					}
					echo "</ul>";
					echo "</li>";
				}
				echo "</ul>";
				echo "</li>";
			}
			?>
            
			<?php
            if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('admin_level') == '5') { ?>
            	<li><a href="<?php echo site_url();?>member">Member Area</a></li>
                <li><a href="<?php echo site_url();?>member/keluar">Keluar</a></li>
            <?php
			}
			?>
              </ul>
            </div><!-- /.navbar-collapse -->