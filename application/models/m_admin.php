<?php
class M_admin extends CI_Model  {

    public function __contsruct(){
        parent::Model();
    }
	
	//CONFIGURATION TABLE USER (PENGGUNA)
	public function menu_pengguna($active=''){
		$query = $this->db->query("SELECT menu.menu_kode AS kode, menu.menu_url AS url, menu.menu_nama AS title, menu.menu_deskripsi AS deskripsi, menu.menu_subkode AS subkode FROM menu_admin LEFT JOIN menu ON menu_admin.menu_kode=menu.menu_kode WHERE menu_admin.admin_level_kode='".$this->session->userdata('admin_level')."' AND menu.menu_level='1' AND menu.menu_status='A' ORDER BY menu.menu_urutan ASC");
		foreach ($query->result() as $row){
			if ($active == $row->kode){
				echo "<li><a href='".site_url().$row->url."' title='".$row->deskripsi."' class='".$row->url."_active'></a></li>";
			} else {
				echo "<li><a href='".site_url().$row->url."' title='".$row->deskripsi."' class='".$row->url."'></a></li>";
			} 
		}
	}
	
	public function submenu_pengguna($menu, $active=''){
		$query = $this->db->query("SELECT menu.menu_kode AS kode, menu.menu_url AS url, menu.menu_nama AS title, menu.menu_deskripsi AS deskripsi, menu.menu_subkode AS subkode FROM menu_admin LEFT JOIN menu ON menu_admin.menu_kode=menu.menu_kode WHERE menu_admin.admin_level_kode='".$this->session->userdata('admin_level')."' AND menu.menu_level='2' AND menu.menu_subkode='".$menu."' AND menu.menu_status='A' ORDER BY menu.menu_urutan ASC");
		foreach ($query->result() as $row){
			$subquery 	= $this->db->query("SELECT menu.menu_url AS url, menu.menu_nama AS title, menu.menu_deskripsi AS deskripsi FROM menu_admin LEFT JOIN menu ON menu_admin.menu_kode=menu.menu_kode WHERE menu_admin.admin_level_kode='".$this->session->userdata('admin_level')."' AND menu.menu_level='3' AND menu.menu_subkode='".$row->kode."' AND menu.menu_status='A' ORDER BY menu.menu_urutan ASC");
			if ($active == $row->kode){
				//$informasi_home = "fa-home";
				$url = ($row->url == '#')?'active':site_url().$row->url;
				echo "<li class='treeview ".$url."'>
                            <a href='".$url."'>
                                <i class='fa ".$row->deskripsi."'></i> <span>".$row->title."</span>
                                <i class='fa fa-angle-left pull-right'></i>
                            </a>";
				if ($subquery->num_rows() > 0){
				echo "<ul class='treeview-menu'>";
				foreach ($subquery->result() as $row2){
					echo "<li class='".$url."'><a href='".site_url().$row2->url."' title='".$row2->deskripsi."'><i class='fa fa-angle-double-right'></i>".$row2->title."</a></li>";
				}
				echo "</ul>";
				}
				echo "</li>";
				//echo "<div class='clear'></div>";
			} else {
				//$informasi_home = "fa fa-home";
				$url = ($row->url == '#')?'active':site_url().$row->url;
				echo "<li class='treeview '>
                            <a href='".$url."'>
                                <i class='fa ".$row->deskripsi."'></i> <span>".$row->title."</span>
                                <i class='fa fa-angle-left pull-right'></i>
                            </a>";
				if ($subquery->num_rows() > 0){
				echo "<ul class='treeview-menu'>";
				foreach ($subquery->result() as $row2){
					echo "<li><a href='".site_url().$row2->url."' title='".$row2->deskripsi."'><i class='fa fa-angle-double-right'></i>".$row2->title."</a></li>";
				}
				echo "</ul>";
				}
				echo "</li>";
				//echo "<div class='clear'></div>";
			} 
		}
	}
	
	//CONFIGURATION TABLE TAGS
    public function insert_tags($data){
        $this->db->insert("tags",$data);
    }
    
    public function update_tags($where,$data){
        $this->db->update("tags",$data,$where);
    }

    public function delete_tags($where){
        $this->db->delete("tags", $where);
    }

	public function get_tags($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("tags");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_tags($select, $sidx,$sord,$limit,$start,$where="", $like){
        $data = "";
        $this->db->select($select);
        $this->db->from("tags");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_tags($where="", $like=""){
        $this->db->select("*");
        $this->db->from("tags");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
	}
	
	//CONFIGURATION TABEL AGENDA
	public function insert_agenda($data){
        $this->db->insert("agenda",$data);
    }
    
    public function update_agenda($where,$data){
        $this->db->update("agenda",$data,$where);
    }

    public function delete_agenda($where){
        $this->db->delete("agenda", $where);
    }

	public function get_agenda($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("agenda");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_agenda($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("agenda");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_agenda($where="", $like=""){
        $this->db->select("*");
        $this->db->from("agenda");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }
	
	
	//CONFIGURATION TABEL IDENTITAS
	public function insert_identitas($data){
        $this->db->insert("identitas",$data);
    }
    
    public function update_identitas($where,$data){
        $this->db->update("identitas",$data,$where);
    }

    public function delete_identitas($where){
        $this->db->delete("identitas", $where);
    }

	public function get_identitas($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("identitas");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_identitas($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("identitas");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_identitas($where="", $like=""){
        $this->db->select("*");
        $this->db->from("identitas");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }
	
	public function identitaswebsite(){
        $data = "";
		$where['identitas_id'] = 1;
		$this->db->select("*");
        $this->db->from("identitas");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}
	
	
	//CONFIGURATION TABEL SLIDE
	public function insert_slide($data){
        $this->db->insert("slide",$data);
    }
    
    public function update_slide($where,$data){
        $this->db->update("slide",$data,$where);
    }

    public function delete_slide($where){
        $this->db->delete("slide", $where);
    }

	public function get_slide($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("slide");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_slide($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("slide");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_slide($where="", $like=""){
        $this->db->select("*");
        $this->db->from("slide");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }
	
	//CONFIGURATION TABEL STATIS
	public function insert_statis($data){
        $this->db->insert("statis",$data);
    }
    
    public function update_statis($where,$data){
        $this->db->update("statis",$data,$where);
    }

    public function delete_statis($where){
        $this->db->delete("statis", $where);
    }

	public function get_statis($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("statis");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_statis($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("statis");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_statis($where="", $like=""){
        $this->db->select("*");
        $this->db->from("statis");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }
	
	//CONFIGURATION TABLE MENU
	public function insert_menu($data){
        $this->db->insert("menu",$data);
    }
    
    public function update_menu($where,$data){
        $this->db->update("menu",$data,$where);
    }

    public function delete_menu($where){
        $this->db->delete("menu", $where);
    }

	public function get_menu($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("menu");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_menu($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("menu");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($sidx,$sord);
		$this->db->order_by('menu_urutan','ASC');
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_menu($where="", $like=""){
        $this->db->select("*");
        $this->db->from("menu");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }

	//CONFIGURATION TABLE MENU ADMIN
	public function insert_menu_admin($data){
        $this->db->insert("menu_admin",$data);
    }
    
    public function update_menu_admin($where,$data){
        $this->db->update("menu_admin",$data,$where);
    }

    public function delete_menu_admin($where){
        $this->db->delete("menu_admin", $where);
    }

	public function get_menu_admin($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("menu_admin");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_menu_admin($select, $sidx, $sord, $limit, $start, $where=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("menu_admin");
		if ($where){$this->db->where($where);}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_menu_admin($where=""){
        $this->db->select("*");
        $this->db->from("menu_admin");
		if ($where){$this->db->where($where);}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }

	//CONFIGURATION TABLE ADMIN
	public function insert_admin($data){
        $this->db->insert("admin",$data);
    }
    
    public function update_admin($where,$data){
        $this->db->update("admin",$data,$where);
    }

    public function delete_admin($where){
        $this->db->delete("admin", $where);
    }

	public function get_admin($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("admin a");
		$this->db->join('admin_level al', 'a.admin_level_kode = al.admin_level_kode', 'left');
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_admin($select, $sidx,$sord,$limit,$start,$where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("admin a");
		$this->db->join('admin_level al', 'a.admin_level_kode = al.admin_level_kode', 'left');
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
		$names = array('nava', 'admin');
        $this->db->where_not_in('admin_user', $names);
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_admin($where="", $like=""){
        $this->db->select("*");
        $this->db->from("admin");		
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }
	
	//CONFIGURATION TABLE ADMIN LEVEL
	public function insert_admin_level($data){
        $this->db->insert("admin_level",$data);
    }
    
    public function update_admin_level($where,$data){
        $this->db->update("admin_level",$data,$where);
    }

    public function delete_admin_level($where){
        $this->db->delete("admin_level", $where);
    }

	public function get_admin_level($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("admin_level");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_admin_level($select, $sidx,$sord,$limit,$start,$where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("admin_level");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_admin_level($where="", $like=""){
        $this->db->select("*");
        $this->db->from("admin_level");		
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }
	
	// CONFIGURATION COMBO BOX WITH DATABASE
	public function combo_box($table, $name, $value, $name_value, $pilihan, $js='', $label='', $width=''){
		echo "<select name='$name' id='$name' onchange='$js' class='form-control input-sm' style='width:$width'>";
		echo "<option value=''>".$label."</option>";
		$query = $this->db->query($table);
		foreach ($query->result() as $row){
			if ($pilihan == $row->$value){
				echo "<option value='".$row->$value."' selected>".$row->$name_value."</option>";
			} else {
				echo "<option value='".$row->$value."'>".$row->$name_value."</option>";
			}
		}
		echo "</select>";
	}
	
	//CONFIGURATION CHECKBOX ARRAY WITH DATABASE
	public function checkbox($table, $name, $value, $name_value, $pilihan=''){
		$query = $this->db->query($table);
		$array_tag = explode(',', $pilihan);
		$ceked = "";
		foreach ($query->result() as $row){
			$ceked = (array_search($row->tag_id, $array_tag) === false)? '' : 'checked';
			echo "<input type='checkbox' name='$name' id='".$row->$value."' value='".$row->$value."' ".$ceked."/><label for='".$row->$value."' style='display: inline-block'>".$row->$name_value."</label><br />";
		}
	}
	
	//CONFIGURATION CHECKBOX ARRAY WITH DATABASE
	public function checkbox_status($table, $name, $value, $name_value, $pilihan=''){
		$query = $this->db->query($table);
		$array_tag = explode(',', $pilihan);
		$ceked = "";
		foreach ($query->result() as $row){
			$ceked = (array_search($row->status_perkawinan_kode, $array_tag) === false)? '' : 'checked';
			echo "<input type='checkbox' name='$name' id='".$row->$value."' style='display: inline-block;' value='".$row->$value."' ".$ceked."/><label for='".$row->$value."' style='display: inline-block; margin-right: 10px;'>".$row->$name_value."</label>";
		}
	}
	
	//CONFIGURATION LIST ARRAY WITH DATABASE AND EXPLODE
	public function listarray($table, $name, $value, $name_value, $pilihan=''){
		$query = $this->db->query($table);
		$array_tag = explode(',', $pilihan);
		$ceked = "";
		foreach ($query->result() as $row){
			if (array_search($row->tag_id, $array_tag) === false) {
			} else {
			echo $row->$name_value.", ";
			}
		}
	}
	
	//CONFIGURATION LIST ARRAY WITH DATABASE AND EXPLODE
	public function tagsberita($table, $name, $value, $name_value, $pilihan=''){
		$query = $this->db->query($table);
		$array_tag = explode(',', $pilihan);
		$ceked = "";
		foreach ($query->result() as $row){
			if (array_search($row->tag_id, $array_tag) === false) {
			} else {
			echo "<a href='".site_url()."news/tags/".$row->tag_id."' class='tag'>".$row->$name_value."</a> ";
			}
		}
	}
	
	// KONFIGURASI TABEL KATEGORI
	public function insert_kategori($data){
        $this->db->insert("kategori",$data);
    }
    
    public function update_kategori($where,$data){
        $this->db->update("kategori",$data,$where);
    }

    public function delete_kategori($where){
        $this->db->delete("kategori", $where);
    }

	public function get_kategori($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("kategori");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_kategori($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("kategori");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_kategori($where="", $like=""){
        $this->db->select("*");
        $this->db->from("kategori");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }
	
	//KONFIGURASI TABEL BERITA
	public function insert_berita($data){
        $this->db->insert("berita",$data);
    }
    
    public function update_berita($where,$data){
        $this->db->update("berita",$data,$where);
    }
	
	public function update_hits_berita($where){		
        $this->db->query("UPDATE berita SET berita_hits=berita_hits+1 WHERE berita_id=$where");
    }

    public function delete_berita($where){
        $this->db->delete("berita", $where);
    }

	public function get_berita($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("berita b");
		$this->db->join('kategori k', 'b.kategori_id= k.kategori_id', 'left');
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}
	 public function grid_all_berita1($select, $sidx,$sord,$limit,$start,$where="", $like=""){
			$data = "";
			$this->db->select($select);
			$this->db->from("berita b");
			$this->db->join('kategori k', 'b.kategori_id= k.kategori_id', 'left');
			if ($where){$this->db->where($where);}
			if ($like){
				foreach($like as $key => $value){ 
				$this->db->like($key, $value); 
				}
			}
			$names = array('nava', 'admin');
			$this->db->where_not_in('admin_nama', $names);
			$this->db->order_by($sidx,$sord);
			$this->db->limit($limit,$start);
			$Q = $this->db->get();
			if ($Q->num_rows() > 0){
				$data=$Q->result();
			}
			$Q->free_result();
			return $data;
		}
		
    public function grid_all_berita($select, $sidx,$sord,$limit,$start,$where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("berita b");
		$this->db->join('kategori k', 'b.kategori_id= k.kategori_id', 'left');
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_berita($where="", $like=""){
        $this->db->select("*");
        $this->db->from("berita b");
		$this->db->join('kategori k', 'b.kategori_id= k.kategori_id', 'left');
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }
	
     public function grid_all_berita2($select, $sidx,$sord,$limit,$start,$where="", $like=""){
        $data = "1";
        $this->db->select($select);
        $this->db->from("berita");
		if ($where){$this->db->where($where);}
        $this->db->order_by($sidx,"ASC");
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_berita2($where="", $like=""){
        $this->db->select("*");
        $this->db->from("berita");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }
	
	
	// KONFIGURASI TABEL ALBUM
	public function insert_album($data){
        $this->db->insert("album",$data);
    }
    
    public function update_album($where,$data){
        $this->db->update("album",$data,$where);
    }

    public function delete_album($where){
        $this->db->delete("album", $where);
    }

	public function get_album($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("album");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_album($select, $sidx, $sord, $limit="", $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("album");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($sidx,$sord);
        if ($limit){$this->db->limit($limit,$start);}
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_album($where="", $like=""){
        $this->db->select("*");
        $this->db->from("album");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }

	// KONFIGURASI TABEL ALBUM GALERI
	public function insert_album_galeri($data){
        $this->db->insert("album_galeri",$data);
    }
    
    public function update_album_galeri($where,$data){
        $this->db->update("album_galeri",$data,$where);
    }

    public function delete_album_galeri($where){
        $this->db->delete("album_galeri", $where);
    }

	public function get_album_galeri($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("album_galeri ag");
		$this->db->join('album a', 'ag.album_id=a.album_id', 'left');
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_album_galeri($select, $sidx, $sord, $limit="", $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("album_galeri ag");
		$this->db->join('album a', 'ag.album_id=a.album_id', 'left');
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($sidx,$sord);
        if ($limit){$this->db->limit($limit,$start);}
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_album_galeri($where="", $like=""){
        $this->db->select("*");
        $this->db->from("album_galeri ag");
		$this->db->join('album a', 'ag.album_id=a.album_id', 'left');
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }
	
	public function grid_all_galeri($select, $sidx, $sord, $limit="", $start, $where="", $like="", $group=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("album_galeri ag");
		$this->db->join('album a', 'ag.album_id=a.album_id', 'left');
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($sidx,$sord);
		$this->db->group_by($group);
        if ($limit){$this->db->limit($limit,$start);}
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

	// KONFIGURASI TABEL TESTIMONIAL
	public function insert_testimonial($data){
        $this->db->insert("testimonial",$data);
    }
    
    public function update_testimonial($where,$data){
        $this->db->update("testimonial",$data,$where);
    }

    public function delete_testimonial($where){
        $this->db->delete("testimonial", $where);
    }

	public function get_testimonial($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("testimonial");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_testimonial($select, $sidx, $sord, $limit="", $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("testimonial");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($sidx,$sord);
        if ($limit){$this->db->limit($limit,$start);}
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_testimonial($where="", $like=""){
        $this->db->select("*");
        $this->db->from("testimonial");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }

	// KONFIGURASI TABEL DOWNLOADS
	public function insert_downloads($data){
        $this->db->insert("downloads",$data);
    }
    
    public function update_downloads($where,$data){
        $this->db->update("downloads",$data,$where);
    }

    public function delete_downloads($where){
        $this->db->delete("downloads", $where);
    }

	public function get_downloads($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("downloads");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_downloads($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("downloads");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_downloads($where="", $like=""){
        $this->db->select("*");
        $this->db->from("downloads");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }
	
	// KONFIGURASI TABEL MITRA KERJA
	public function insert_mitra_kerja($data){
        $this->db->insert("mitra_kerja",$data);
    }
    
    public function update_mitra_kerja($where,$data){
        $this->db->update("mitra_kerja",$data,$where);
    }

    public function delete_mitra_kerja($where){
        $this->db->delete("mitra_kerja", $where);
    }

	public function get_mitra_kerja($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("mitra_kerja");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_mitra_kerja($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("mitra_kerja");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_mitra_kerja($where="", $like=""){
        $this->db->select("*");
        $this->db->from("mitra_kerja");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }
	
		// KONFIGURASI TABEL KOMENTAR
	public function insert_komentar($data){
        $this->db->insert("komentar",$data);
    }
    
    public function update_komentar($where,$data){
        $this->db->update("komentar",$data,$where);
    }

    public function delete_komentar($where){
        $this->db->delete("komentar", $where);
    }

	public function get_komentar($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("komentar k");
		$this->db->join('berita b', 'k.berita_id=b.berita_id', 'left');
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_komentar($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("komentar k");
		$this->db->join('berita b', 'k.berita_id=b.berita_id', 'left');
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_komentar($where="", $like=""){
        $this->db->select("*");
        $this->db->from("komentar k");
		$this->db->join('berita b', 'k.berita_id=b.berita_id', 'left');
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }
	
	// KONFIGURASI TABEL GALERI VIDEO
	public function insert_galeri_video($data){
        $this->db->insert("galeri_video",$data);
    }
    
    public function update_galeri_video($where,$data){
        $this->db->update("galeri_video",$data,$where);
    }

    public function delete_galeri_video($where){
        $this->db->delete("galeri_video", $where);
    }

	public function get_galeri_video($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("galeri_video");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_galeri_video($select, $sidx, $sord, $limit="", $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("galeri_video");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($sidx,$sord);
        if ($limit){$this->db->limit($limit,$start);}
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_galeri_video($where="", $like=""){
        $this->db->select("*");
        $this->db->from("galeri_video");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }
	
	// KONFIGURASI TABEL PESAN
	public function insert_pesan($data){
        $this->db->insert("pesan",$data);
    }
    
    public function update_pesan($where,$data){
        $this->db->update("pesan",$data,$where);
    }

    public function delete_pesan($where){
        $this->db->delete("pesan", $where);
    }

	public function get_pesan($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("pesan");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_pesan($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("pesan");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_pesan($where="", $like=""){
        $this->db->select("*");
        $this->db->from("pesan");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }	
	
	
	// KONFIGURASI TABEL MANAGEMENT
	public function insert_management($data){
        $this->db->insert("management",$data);
    }
    
    public function update_management($where,$data){
        $this->db->update("management",$data,$where);
    }

    public function delete_management($where){
        $this->db->delete("management", $where);
    }

	public function get_management($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("management");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_management($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("management");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_management($where="", $like=""){
        $this->db->select("*");
        $this->db->from("management");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }
	
	//CONFIGURATION TABEL FASILITAS
	public function insert_fasilitas($data){
        $this->db->insert("fasilitas",$data);
    }
    
    public function update_fasilitas($where,$data){
        $this->db->update("fasilitas",$data,$where);
    }

    public function delete_fasilitas($where){
        $this->db->delete("fasilitas", $where);
    }

	public function get_fasilitas($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("fasilitas");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_fasilitas($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("fasilitas");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_fasilitas($where="", $like=""){
        $this->db->select("*");
        $this->db->from("fasilitas");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }
	
		// KONFIGURASI TABEL JOIN EVENT
	public function insert_join_event($data){
        $this->db->insert("join_event",$data);
    }
    
    public function update_join_event($where,$data){
        $this->db->update("join_event",$data,$where);
    }

    public function delete_join_event($where){
        $this->db->delete("join_event", $where);
    }

	public function get_join_event($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("join_event j");
		$this->db->join('agenda a', 'j.agenda_id=a.agenda_id', 'left');
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}
 	public function grid_all_join_event($select, $sidx,$sord,$limit,$start,$where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("join_event j");
		$this->db->join('agenda a', 'j.agenda_id= a.agenda_id', 'left');
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }
    
	
	public function count_all_join_event2($where="", $like=""){
        $this->db->select("*");
        $this->db->from("join_event");		
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }

    public function count_all_join_event($where="", $like=""){
        $this->db->select("*");
        $this->db->from("join_event j");
		$this->db->join('agenda a', 'j.agenda_id=a.agenda_id', 'left');
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }
	
	// FUNGSI PENCARIAN
	public function grid_all_pencarian($select, $sidx,$sord,$limit,$start,$where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("berita b");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->or_like($key, $value); 
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }
	
	public function count_all_pencarian($where="", $like=""){
        $this->db->select("*");
        $this->db->from("berita b");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->or_like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }	
	
}