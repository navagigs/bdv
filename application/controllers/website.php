<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Website extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_config', 'CONF', TRUE);
	}
	
	public function index()
	{
		if($this->session->userdata('logged_in') == TRUE) {
			$where_admin['admin_user']		= $this->session->userdata('admin_user');
			$data['admin']					= $this->ADM->get_admin('',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			$data['dashboard_info']			= TRUE;
			$data['dashboard']				= 'admin/dashboard/statistik';
			$data['boxmenu']				= 'admin/boxmenu/setting';
			$data['menu_terpilih']			= '1';
			$data['submenu_terpilih']		= '';
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	 }
	 
	 //IDENTITAS
	 public function identitas($filter1='', $filter2='', $filter3='')
	 {
		 if($this->session->userdata('logged_in') == TRUE) {
			$where_admin['admin_user']		= $this->session->userdata('admin_user');
			$data['admin']					= $this->ADM->get_admin('',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']			= FALSE;
			$data['content']				= 'admin/content/website/identitas';
			$data['menu_terpilih']			= '1';
			$data['submenu_terpilih']		= '105';
			$data['action']					= (empty($filter1))?'view':$filter1;
			$data['validate']				= array('identitas_website'=>'Nama Website',
													'identitas_deskripsi'=>'Deskripsi',
													'identitas_keyword'=>'Keyword',
													'identitas_notelp'=>'No Telepon',
													'identitas_email'=>'Email',
													'identitas_fb'=>'Facebook',
													'identitas_tw'=>'Twitter',
													'identitas_yb'=>'Youtube',													
													'identitas_favicon' => 'Favicon');
			if($data['action'] == 'view' ) {
				$data['berdasarkan']		= array('identitas_website'=>'Identitas Website');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'identitas_website';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_identitas[$data['cari']]	= $data['q'];
				$data['jml_data']			= $this->ADM->count_all_identitas('', $like_identitas);
				$data['jml_halaman']		= ceil($data['jml_data']/$data['batas']);
			} elseif ($data['action'] == 'tambah') {
				$data['onload']						= 'identitas_website';
				$data['identitas_website']			= ($this->input->post('identitas_website'))?$this->input->post('identitas_website'):'';
				$data['identitas_deskripsi']		= ($this->input->post('identitas_deskripsi'))?$this->input->post('identitas_deskripsi'):'';
				$data['identitas_keyword']			= ($this->input->post('identitas_keyword'))?$this->input->post('identitas_keyword'):'';
				$data['identitas_email']				= ($this->input->post('identitas_email'))?$this->input->post('identitas_email'):'';
				$data['identitas_fb']				= ($this->input->post('identitas_fb'))?$this->input->post('identitas_fb'):'';
				$data['identitas_tw']				= ($this->input->post('identitas_tw'))?$this->input->post('identitas_tw'):'';
				$data['identitas_gp']				= ($this->input->post('identitas_gb'))?$this->input->post('identitas_gp'):'';
				$data['identitas_yb']				= ($this->input->post('identitas_yb'))?$this->input->post('identitas_yb'):'';
				$data['identitas_favicon']			= ($this->input->post('identitas_favicon'))?$this->input->post('identitas_favicon'):'';
				$simpan								=  $this->input->post('simpan');
				if($simpan) {
					$insert['identitas_website']	= validasi_sql($data['identitas_website']);
					$insert['identitas_deskripsi']	= validasi_sql($data['identitas_deskripsi']);
					$insert['identitas_keyword']	= validasi_sql($data['identitas_keyword']);
					$insert['identitas_notelp']		= validasi_sql($data['identitas_notelp']);
					$insert['identitas_email']		= validasi_sql($data['identitas_email']);
					$insert['identitas_fb']			= validasi_sql($data['identitas_fb']);
					$insert['identitas_tw']			= validasi_sql($data['identitas_tw']);
					$insert['identitas_gp']			= validasi_sql($data['identitas_gp']);
					$insert['identitas_yb']			= validasi_sql($data['identitas_yb']);
					$insert['identitas_favicon']	= validasi_sql($data['identitas_favicon']);
					$this->ADM->insert_identitas($insert);
					$this->session->set_flashdata('success','Data identitas telah berhasil ditambahkan!,');
					redirect("website/identitas/edit/1");
				}
			} elseif ($data['action'] == 'edit') {
				$data['ckeditor']			= $this->ckeditor('identitas_deskripsi');
				$data['onload']					= 'identitas_website';
				$where_identitas['identitas_id']	= $filter2;
				$identitas						= $this->ADM->get_identitas('',$where_identitas);
				$data['identitas_id']			= ($this->input->post('identitas_id'))?$this->input->post('identitas_id'):$identitas->identitas_id;
				$data['identitas_website']		= ($this->input->post('identitas_website'))?$this->input->post('identitas_website'):$identitas->identitas_website;
				$data['identitas_deskripsi']	= ($this->input->post('identitas_deskripsi'))?$this->input->post('identitas_deskripsi'):$identitas->identitas_deskripsi;
				$data['identitas_keyword']		= ($this->input->post('identitas_keyword'))?$this->input->post('identitas_keyword'):$identitas->identitas_keyword;
				$data['identitas_alamat']		= ($this->input->post('identitas_alamat'))?$this->input->post('identitas_alamat'):$identitas->identitas_alamat;
				$data['identitas_notelp']		= ($this->input->post('identitas_notelp'))?$this->input->post('identitas_notelp'):$identitas->identitas_notelp;
				$data['identitas_email']		= ($this->input->post('identitas_email'))?$this->input->post('identitas_email'):$identitas->identitas_email;
				$data['identitas_fb']			= ($this->input->post('identitas_fb'))?$this->input->post('identitas_fb'):$identitas->identitas_fb;
				$data['identitas_tw']			= ($this->input->post('identitas_tw'))?$this->input->post('identitas_tw'):$identitas->identitas_tw;
				$data['identitas_gp']			= ($this->input->post('identitas_gp'))?$this->input->post('identitas_gp'):$identitas->identitas_gp;
				$data['identitas_yb']			= ($this->input->post('identitas_yb'))?$this->input->post('identitas_yb'):$identitas->identitas_yb;
				$data['identitas_favicon']		= ($this->input->post('identitas_favicon'))?$this->input->post('identitas_favicon'):$identitas->identitas_favicon;	
				$simpan							= $this->input->post('simpan');
				if($simpan) {
					$gambar	= upload_image("identitas_favicon", "./assets/");
					$data['identitas_favicon']	= $gambar;
					$where_edit['identitas_id']				= validasi_sql($data['identitas_id']);
					$edit['identitas_website']				= validasi_sql($data['identitas_website']);
					$edit['identitas_deskripsi']			= validasi_sql($data['identitas_deskripsi']);
					$edit['identitas_keyword']				= validasi_sql($data['identitas_keyword']);
					$edit['identitas_alamat']				= validasi_sql($data['identitas_alamat']);
					$edit['identitas_notelp']				= validasi_sql($data['identitas_notelp']);
					$edit['identitas_email']				= validasi_sql($data['identitas_email']);
					$edit['identitas_fb']					= validasi_sql($data['identitas_fb']);
					$edit['identitas_tw']					= validasi_sql($data['identitas_tw']);
					$edit['identitas_gp']					= validasi_sql($data['identitas_gp']);
					$edit['identitas_yb']					= validasi_sql($data['identitas_yb']);		
					if ($data['identitas_favicon']) { 
						$row = $this->ADM->get_identitas('*', $where_edit);
						@unlink('./assets/'.$row->identitas_favicon);
						$edit['identitas_favicon']	= validasi_sql($data['identitas_favicon']); 
					}
					$this->ADM->update_identitas($where_edit, $edit);
					$this->session->set_flashdata('success','Data identitas telah berhasil diedit!,');
					redirect("website/identitas/edit/1");
				}
			} elseif ($data['action'] == 'hapus') {
				$where_delete['identitas_id']		= validasi_sql($filter2);
				$this->ADM->delete_identitas($where_delete);
				$this->session->set_flashdata('success','Data identitas telah berhasil dihapus!,');
				redirect("website/identitas/edit/1");				
			}
		 
			$this->load->vars($data);
			$this->load->view('admin/home');
		 } else {
			 redirect("wp_login");		 	
			}
	 }
	 
	 //KATEGORI	 
	 public function kategori($filter1='', $filter2='', $filter3='')
	 {
		 if($this->session->userdata('logged_in') == TRUE) {
			$where_admin['admin_user']		= $this->session->userdata('admin_user');
			$data['admin']					= $this->ADM->get_admin('*',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']			= FALSE;
			$data['content']				= 'admin/content/website/kategori';
			$data['menu_terpilih']			= '1';
			$data['submenu_terpilih']		= '79';
			$data['action']					= (empty($filter1))?'view':$filter1;
			$data['validate']				= array('kategori_judul'=>'Judul');
			if($data['action'] == 'view') {
				//ACCESS ADMIN LEVEL
			    if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('admin_level') == '1') {	
				$data['berdasarkan']		= array('kategori_judul'=>'JUDUL');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'kategori_judul';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_kategori[$data['cari']]	= $data['q'];
				$where_kategori['admin_nama']	= $this->session->userdata('admin_nama');				
				$data['jml_data']			= $this->ADM->count_all_kategori('', $like_kategori);
				$data['jml_halaman']		= ceil($data['jml_data']/$data['batas']);
				//END ACCESS ADMIN LEVEL
				} else {
				$data['berdasarkan']		= array('kategori_judul'=>'JUDUL');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'kategori_judul';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_kategori[$data['cari']]	= $data['q'];
				$where_kategori['admin_nama']	= $this->session->userdata('admin_nama');				
				$data['jml_data']			= $this->ADM->count_all_kategori($where_kategori, $like_kategori);
				$data['jml_halaman']		= ceil($data['jml_data']/$data['batas']);
				}
			} elseif ($data['action']	== 'tambah') {
				$data['onload']				= 'kategori_judul';
				$data['kategori_judul']		= ($this->input->post('kategori_judul'))?$this->input->post('kategori_judul'):'';								 				$data['admin_nama']			= $this->session->userdata('admin_nama');				
				$simpan						= $this->input->post('simpan');
				if($simpan){
					$insert['kategori_judul']	= validasi_sql($data['kategori_judul']);
					$insert['admin_nama']	= validasi_sql($data['admin_nama']);
					$this->ADM->insert_kategori($insert);
					$this->session->set_flashdata('success','Kategori telah berhasil ditambahkan!,');
					redirect("website/kategori");
				}
			} elseif ($data['action']	== 'edit') {
				$data['onload']					= 'kategori_judul';
				$where_kategori['kategori_id']	= $filter2;
				$kategori						= $this->ADM->get_kategori('', $where_kategori);
				$data['kategori_id']			= ($this->input->post('kategori_id'))?$this->input->post('kategori_id'):$kategori->kategori_id;
				$data['kategori_judul']			= ($this->input->post('kategori_judul'))?$this->input->post('kategori_judul'):$kategori->kategori_judul;
				$simpan							= $this->input->post('simpan');
				
				if($simpan) {
					$where_edit['kategori_id']	= validasi_sql($data['kategori_id']);
					$edit['kategori_judul']		= validasi_sql($data['kategori_judul']);
					$this->ADM->update_kategori($where_edit, $edit);
					$this->session->set_flashdata('success','Kategori telah berhasil diedit!,');
					redirect("website/kategori");
				}
			} elseif ($data['action'] == 'hapus') {
				$where_delete['kategori_id'] = validasi_sql($filter2);
				$this->ADM->delete_kategori($where_delete);
				$this->session->set_flashdata('success','Kategori telah berhasil dihapus!,');
				redirect("website/kategori");
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		 } else {
			 redirect("wp_login");		 	
			}
				
		 }
		 
	public function kategori_detail($kategori_id='')
	{
		if($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user']			= $this->session->userdata('admin_user');
			$data['admin']						= $this->ADM->get_admin('',$where_admin);
			$where_kategori['kategori_id']		= validasi_sql($kategori_id);
			$data['kategori']					= $this->ADM->get_kategori('',$where_kategori);
			$data['action']						= 'detail';
			$this->load->vars($data);
			$this->load->view('admin/content/website/kategori');
		} else {
			redirect("wp_login");
		}
	}		
	 		
	//BERITA
	 public function berita($filter1='', $filter2='', $filter3='')
	 {
		 if($this->session->userdata('logged_in') == TRUE) {
			$where_admin['admin_user']		= $this->session->userdata('admin_user');
			$data['admin']					= $this->ADM->get_admin('',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']			= FALSE;
			$data['content']				= 'admin/content/website/berita';
			$data['menu_terpilih']			= '1';
			$data['submenu_terpilih']		= '79';
			$data['action']					= (empty($filter1))?'view':$filter1;
			$data['validate']				= array('berita_judul' => 'Judul',
													'kategori_id'  => 'Kategori',
													'berita_deskripsi' => 'Deskripsi',
													'berita_gambar' => 'Gambar');
			if($data['action']	== 'view') {
				//ACCESS ADMIN LEVEL
			    if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('admin_level') == '1') {					
				$data['berdasarkan']		= array('berita_judul'=>'JUDUL');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'berita_judul';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_berita[$data['cari']]	= $data['q'];		
				$data['jml_data']			= $this->ADM->count_all_berita('', $like_berita);
				$data['jml_halaman']		= ceil($data['jml_data']/$data['batas']);
				//END ACCESS ADMIN LEVEL
				} else {
				$data['berdasarkan']		= array('berita_judul'=>'JUDUL');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'berita_judul';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_berita[$data['cari']]	= $data['q'];
				$where_berita['admin_nama']	= $this->session->userdata('admin_nama');				
				$data['jml_data']			= $this->ADM->count_all_berita2($where_berita, $like_berita);
				$data['jml_halaman']		= ceil($data['jml_data']/$data['batas']);
				}
			} elseif ($data['action']	== 'tambah') {
				$data['ckeditor']			= $this->ckeditor('berita_deskripsi');
				$data['onload']				= 'berita_judul';
				$data['berita_id']			= ($this->input->post('berita_id'))?$this->input->post('berita_id'):'';
				$data['berita_judul']		= ($this->input->post('berita_judul'))?$this->input->post('berita_judul'):'';
				$data['headline']			= ($this->input->post('headline'))?$this->input->post('headline'):'';
				$data['berita_deskripsi']	= ($this->input->post('berita_deskripsi'))?$this->input->post('berita_deskripsi'):'';
				$data['berita_waktu']		= date("Y-m-d H:i:s");
				$data['berita_gambar']		= ($this->input->post('berita_gambar'))?$this->input->post('berita_gambar'):'';
				$data['tags']				= ($this->input->post('tags'))?$this->input->post('tags'):'';
				$data['kategori_id']		= ($this->input->post('kategori_id'))?$this->input->post('kategori_id'):'';								 				$data['admin_nama']			= $this->session->userdata('admin_nama');		
				$simpan						= $this->input->post('simpan');
				if ($simpan) {
					$gambar = upload_image("berita_gambar", "./assets/images/berita/", "230x160", seo($data['berita_judul']));
					$data['berita_gambar']	= $gambar;
					$tags	= "";
					if ($this->input->post('tag')) {
						$tags = implode(',', $this->input->post('tag'));
					}
					$insert['berita_judul']		 = validasi_sql($data['berita_judul']);
					$insert['headline']	 	 	 = validasi_sql($data['headline']);
					$insert['berita_deskripsi']  = $data['berita_deskripsi'];
					if ($data['berita_gambar']) { $insert['berita_gambar'] = validasi_sql($data['berita_gambar']); }
					$insert['berita_waktu']		 = validasi_sql($data['berita_waktu']);
					$insert['tags']				 = validasi_sql($tags);
					$insert['kategori_id']		 = validasi_sql($data['kategori_id']);
					$insert['admin_nama']		 = validasi_sql($data['admin_nama']);
					$this->ADM->insert_berita($insert);
					$this->session->set_flashdata('success','Berita telah berhasil ditambahkan!,');
					redirect("website/berita");
				}
			} elseif ($data['action']	== 'edit') {
				$data['ckeditor']			= $this->ckeditor('berita_deskripsi');
				$data['onload']				= 'berita_judul';
				$where_berita['berita_id']	= validasi_sql($filter2);
				$berita 					= $this->ADM->get_berita('*', $where_berita);
				$data['berita_id']			= ($this->input->post('berita_id'))?$this->input->post('berita_id'):$berita->berita_id;	
				$data['berita_judul']		= ($this->input->post('berita_judul'))?$this->input->post('berita_judul'):$berita->berita_judul;
				$data['headline']			= ($this->input->post('headline'))?$this->input->post('headline'):$berita->headline;	
				$data['berita_deskripsi']	= ($this->input->post('berita_deskripsi'))?$this->input->post('berita_deskripsi'):$berita->berita_deskripsi;
				$data['berita_waktu']		= ($this->input->post('berita_waktu'))?$this->input->post('berita_waktu'):$berita->berita_waktu;	
				$data['berita_gambar']		= ($this->input->post('berita_gambar'))?$this->input->post('berita_gambar'):$berita->berita_gambar;	
				$data['tags']				= ($this->input->post('tag'))?$this->input->post('tag'):$berita->tags;		
				$data['kategori_id']		= ($this->input->post('kategori_id'))?$this->input->post('kategori_id'):$berita->kategori_id;		
				$data['kategori_id']		= ($this->input->post('kategori_id'))?$this->input->post('kategori_id'):$berita->kategori_id;	
			//	$data['admin_nama']			= $this->session->userdata('admin_nama');		
				$simpan						= $this->input->post('simpan');
				if ($simpan) {
					$tags = "";
					if ($this->input->post('tag')) {
						$tags = implode(',', $this->input->post('tag'));
					}
					$gambar = upload_image("berita_gambar", "./assets/images/berita/", "230x160", seo($data['berita_judul']));
					$data['berita_gambar']		= $gambar;
					$where_edit['berita_id']	= validasi_sql($data['berita_id']);
					$edit['berita_judul']		= validasi_sql($data['berita_judul']);
					$edit['headline']			= validasi_sql($data['headline']);
					$edit['berita_deskripsi']	= $data['berita_deskripsi'];
					if ($data['berita_gambar']) {
						$row = $this->ADM->get_berita('*', $where_edit);
						@unlink('./assets/images/berita/'.$row->berita_gambar);
						@unlink('./assets/images/berita/kecil_'.$row->berita_gambar);
						$edit['berita_gambar']	= $data['berita_gambar']; 
					}
					$edit['tags']				= $tags;
					$edit['kategori_id']		= validasi_sql($data['kategori_id']);
					//$edit['admin_nama']		 = validasi_sql($data['admin_nama']);
					$this->ADM->update_berita($where_edit, $edit);
					$this->session->set_flashdata('success','Berita telah berhasil diedit!,');
					redirect('website/berita');					
			}
		 } elseif ($data['action']	== 'hapus') {
			 $where['berita_id']	= validasi_sql($filter2);
			 $row = $this->ADM->get_berita('*', $where);
			 @unlink ('./assets/images/berita/'.$row->berita_gambar);
			 @unlink ('./assets/images/berita/kecil_'.$row->berita_gambar);
			 $this->ADM->delete_berita($where);
			 $this->session->set_flashdata('success','Berita telah berhasil dihapus!,');
			 redirect("website/berita");
	 }
	 $this->load->vars($data);
	 $this->load->view('admin/home');
	} else {
		redirect("wp_login");
	}
  }
  
  public function berita_detail($berita_id='')
  {
	  if($this->session->userdata('logged_in') == TRUE) {
		  $where_admin['admin_user']	= $this->session->userdata('admin_user');
		  $data['admin']				= $this->ADM->get_admin('', $where_admin);
		  $where_berita['berita_id']	= validasi_sql($berita_id);
		  $data['berita']				= $this->ADM->get_berita('*', $where_berita);
		  $data['ckeditor']				= $this->ckeditor('berita_deskripsi');
		  $data['action']				= 'detail';
		  $this->load->vars($data);
		  $this->load->view('admin/content/website/berita');
	  } else {
		  redirect("wp_login");
	  }
  }
  
  
  //TAG
	public function tags($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']		= FALSE;
			$data['content'] 			= 'admin/content/website/tags';
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '79';
			$data['action']				= (empty($filter1))?'view':$filter1;
			$data['validate']			= array('tag_judul'=>'Judul');
			if ($data['action'] == 'view'){
				$data['berdasarkan']		= array('tag_judul'=>'JUDUL');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'tag_judul';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_tag[$data['cari']]	= validasi_sql($data['q']);
				$data['jml_data']			= $this->ADM->count_all_tags('', $like_tag);
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
			} elseif ($data['action'] == 'tambah'){
				$data['onload']				= 'tag_judul';
				$data['tag_judul']			= ($this->input->post('tag_judul'))?$this->input->post('tag_judul'):'';
				$simpan						= $this->input->post('simpan');
				if ($simpan){
					$insert['tag_judul']	= $data['tag_judul'];
					$insert['tag_seo']		= seo($data['tag_judul']);
					$this->ADM->insert_tags($insert);
					$this->session->set_flashdata('success','Tag baru telah berhasil ditambahkan!,');
					redirect("website/tags");
				}
			} elseif ($data['action'] == 'edit'){
				$data['onload']			= 'tag_judul';
				$where_tag['tag_id']	= $filter2; 
				$tag					= $this->ADM->get_tags('*', $where_tag);
				$data['tag_id']			= ($this->input->post('tag_id'))?$this->input->post('tag_id'):$tag->tag_id;
				$data['tag_judul']		= ($this->input->post('tag_judul'))?$this->input->post('tag_judul'):$tag->tag_judul;				
				$simpan					= $this->input->post('simpan');
				if ($simpan){
					$where_edit['tag_id']	= $data['tag_id'];
					$edit['tag_judul']		= $data['tag_judul'];
					$edit['tag_seo']		= seo($data['tag_judul']);					
					$this->ADM->update_tags($where_edit, $edit);
					$this->session->set_flashdata('success','Tag berita telah berhasil diedit!,');
					redirect("website/tags");
				}
			} elseif ($data['action'] == 'hapus'){
				$where_delete['tag_id']	= $filter2;
				$this->ADM->delete_tags($where_delete);
				$this->session->set_flashdata('success','Tag berita telah berhasil dihapus!,');
				redirect("website/tags");
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}
	
	public function tags_detail($tag_id="")
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 			= $this->ADM->get_admin('',$where_admin);
			$where_tag['tag_id']	= $tag_id; 
			$data['tag'] 			= $this->ADM->get_tags('*', $where_tag);
			$data['action']			= 'detail';
			$this->load->vars($data);
			$this->load->view('admin/content/website/tags');
		} else {
			redirect("wp_login");
		}
	}
	
	// AGENDA
	public function agenda($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']				= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']		= FALSE;
			$data['content'] 			= 'admin/content/website/agenda';
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '79';
			$data['action']				= (empty($filter1))?'view':$filter1;
			$data['validate']			= array('agenda_tema'=>'Tema agenda',
												'agenda_deskripsi'=>'Deskripsi agenda',
												'agenda_mulai'=>'Tanggal mulai',
												'agenda_selesai'=>'Tanggal Selesai',
												'agenda_tempat'=>'Tempat',
												'agenda_jam'=>'Jam',
												'agenda_gambar'=>'Gambar');
			if ($data['action'] == 'view'){
				//ACCESS ADMIN LEVEL
			    if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('admin_level') == '1') {	
				$data['berdasarkan']		= array('agenda_tema'=>'TEMA', 'agenda_tempat'=>'TEMPAT');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'agenda_tema';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_agenda[$data['cari']]	= $data['q'];
				$data['jml_data']			= $this->ADM->count_all_agenda('', $like_agenda);
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
				} else {
				$data['berdasarkan']		= array('agenda_tema'=>'TEMA', 'agenda_tempat'=>'TEMPAT');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'agenda_tema';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_agenda[$data['cari']]	= $data['q'];
				$where_agenda['admin_nama']	= $this->session->userdata('admin_nama');				
				$data['jml_data']			= $this->ADM->count_all_agenda($where_agenda, $like_agenda);
				$data['jml_halaman']		= ceil($data['jml_data']/$data['batas']);
				}
			} elseif ($data['action'] == 'tambah'){
				$data['ckeditor'] 			= $this->ckeditor('agenda_deskripsi');
				$data['onload']				= 'agenda_tema';
				$data['agenda_tema']		= ($this->input->post('agenda_tema'))?$this->input->post('agenda_tema'):'';
				$data['agenda_deskripsi']	= ($this->input->post('agenda_deskripsi'))?$this->input->post('agenda_deskripsi'):'';
				$data['agenda_mulai']		= ($this->input->post('agenda_mulai'))?$this->input->post('agenda_mulai'):'';
				$data['agenda_selesai']		= ($this->input->post('agenda_selesai'))?$this->input->post('agenda_selesai'):'';
				$data['agenda_tempat']		= ($this->input->post('agenda_tempat'))?$this->input->post('agenda_tempat'):'';
				$data['agenda_jam']			= ($this->input->post('agenda_jam'))?$this->input->post('agenda_jam'):'';
				$data['agenda_gambar']		= ($this->input->post('agenda_gambar'))?$this->input->post('agenda_gambar'):'';						 				$data['admin_nama']			= $this->session->userdata('admin_nama');	
				$data['agenda_posting']		= date("Y-m-d H:i:s");
				
				$simpan						= $this->input->post('simpan');
				if ($simpan){
					$gambar	= upload_image("agenda_gambar", "./assets/images/agenda/", "230x160");
					$data['agenda_gambar']	= $gambar;
					$insert['agenda_tema']		= $data['agenda_tema'];
					$insert['agenda_deskripsi']	= $data['agenda_deskripsi'];
					$insert['agenda_mulai']		= dateIndo3($data['agenda_mulai']);
					$insert['agenda_selesai']	= dateIndo3($data['agenda_selesai']);
					$insert['agenda_tempat']	= $data['agenda_tempat'];
					$insert['agenda_jam']		= $data['agenda_jam'];
					if ($data['agenda_gambar']) { $insert['agenda_gambar']	= $data['agenda_gambar']; }
					$insert['admin_nama']			= $this->session->userdata('admin_nama');	
					$insert['agenda_posting']	= $data['agenda_posting'];
					$this->ADM->insert_agenda($insert);
					$this->session->set_flashdata('success','Agenda telah berhasil ditambahkan!,');
					redirect("website/agenda");
				}
			} elseif ($data['action'] == 'edit'){
				$data['ckeditor'] 			= $this->ckeditor('agenda_deskripsi');
				$data['onload']				= 'agenda_tema';
				$where_agenda['agenda_id']	= $filter2; 
				$agenda						= $this->ADM->get_agenda('*', $where_agenda);
				$data['agenda_id']			= ($this->input->post('agenda_id'))?$this->input->post('agenda_id'):$agenda->agenda_id;
				$data['agenda_tema']		= ($this->input->post('agenda_tema'))?$this->input->post('agenda_tema'):$agenda->agenda_tema;
				$data['agenda_deskripsi']	= ($this->input->post('agenda_deskripsi'))?$this->input->post('agenda_deskripsi'):$agenda->agenda_deskripsi;
				$data['agenda_mulai']		= ($this->input->post('agenda_mulai'))?$this->input->post('agenda_mulai'):$agenda->agenda_mulai;
				$data['agenda_selesai']		= ($this->input->post('agenda_selesai'))?$this->input->post('agenda_selesai'):$agenda->agenda_selesai;
				$data['agenda_tempat']		= ($this->input->post('agenda_tempat'))?$this->input->post('agenda_tempat'):$agenda->agenda_tempat;
				$data['agenda_jam']			= ($this->input->post('agenda_jam'))?$this->input->post('agenda_jam'):$agenda->agenda_jam;
				$data['agenda_gambar']		= ($this->input->post('agenda_gambar'))?$this->input->post('agenda_gambar'):$agenda->agenda_gambar;
				$data['agenda_posting']		= ($this->input->post('agenda_posting'))?$this->input->post('agenda_posting'):$agenda->agenda_posting;
				$simpan						= $this->input->post('simpan');
				if ($simpan){
					$gambar	= upload_image("agenda_gambar", "./assets/images/agenda/", "230x160");
					$data['agenda_gambar']		= $gambar;
					$where_edit['agenda_id']	= $data['agenda_id'];
					$edit['agenda_tema']		= $data['agenda_tema'];
					$edit['agenda_deskripsi']	= $data['agenda_deskripsi'];
					$edit['agenda_mulai']		= dateIndo3($data['agenda_mulai']);
					$edit['agenda_selesai']		= dateIndo3($data['agenda_selesai']);
					$edit['agenda_tempat']		= $data['agenda_tempat'];
					if ($data['agenda_gambar']) { 
						$row = $this->ADM->get_agenda('*', $where_edit);
						@unlink('./assets/images/agenda/'.$row->agenda_gambar);
						@unlink('./assets/images/agenda/kecil_'.$row->agenda_gambar);
						$edit['agenda_gambar']	= $data['agenda_gambar']; 
					}
					$edit['agenda_jam']			= $data['agenda_jam'];
					$this->ADM->update_agenda($where_edit, $edit);
					$this->session->set_flashdata('success','Agenda telah berhasil diedit!,');
					redirect("website/agenda");
				}			
		} elseif ($data['action'] == 'hapus'){
				$where_delete['agenda_id'] 	= $filter2;
				$row = $this->ADM->get_agenda('*', $where_delete);
				@unlink('./assets/images/agenda/'.$row->agenda_gambar);
				@unlink('./assets/images/agenda/kecil_'.$row->agenda_gambar);
				$this->ADM->delete_agenda($where_delete);
				$this->session->set_flashdata('success','Agenda telah berhasil dihapus!,');
				redirect("website/agenda");
				
			} elseif ($data['action'] == 'report_join'){
				$where_agenda['agenda_id']	= $filter2; 
				$agenda						= $this->ADM->get_agenda('*', $where_agenda);
				$data['agenda_id']			= ($this->input->post('agenda_id'))?$this->input->post('agenda_id'):$agenda->agenda_id;
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '79';
				$where_join['j.agenda_id']	= $filter2;
				$data['halaman']		= (empty($filter1))?1:$filter1;
				$data['batas']			= 5;
				$data['page']			= ($data['halaman']-1) * $data['batas'];
				$data['jml_data']		= $this->ADM->count_all_join_event($where_join, '');
				$data['jml_halaman'] 	= ceil($data['jml_data']/$data['batas']);
				}
			
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}
	
	public function agenda_detail($agenda_id='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 			= $this->ADM->get_admin('',$where_admin);
			$where_agenda['agenda_id']	= $agenda_id; 
			$data['agenda'] 		= $this->ADM->get_agenda('*', $where_agenda);
		  	$data['ckeditor']		= $this->ckeditor('agenda_deskripsi');
			$data['action']			= 'detail';
			$this->load->vars($data);
			$this->load->view('admin/content/website/agenda');
		} else {
			redirect("wp_login");
		}
	}
	
	//SLIDE
	public function slide($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']		= FALSE;
			$data['content'] 			= 'admin/content/website/slide';
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '105';
			$data['action']				= (empty($filter1))?'view':$filter1;
			$data['validate']			= array('slide_judul'=>'Judul',
												'slide_deskripsi'=>'Deskripsi',
												'slide_gambar'=>'Gambar');
			if ($data['action'] == 'view') {
				$data['berdasarkan']	= array('slide_judul'=>'JUDUL');
				$data['cari']			= ($this->input->post('cari'))?$this->input->post('cari'):'slide_judul';
				$data['q']				= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']		= (empty($filter1))?1:$filter2;
				$data['batas']			= 10;
				$data['page']			= ($data['halaman']-1) * $data['batas'];
				$like_slide[$data['cari']]= validasi_sql($data['q']);
				$data['jml_data']		= $this->ADM->count_all_slide('',$like_slide);
				$data['jml_halaman']	= ceil($data['jml_data']/$data['batas']);				
			} elseif ($data['action'] == 'tambah') {
				$data['ckeditor']		= $this->ckeditor('slide_deskripsi');
				$data['onload']			= 'slide_judul';
				$data['slide_id']		= ($this->input->post('slide_id'))?$this->input->post('slide_id'):'';
				$data['slide_judul']	= ($this->input->post('slide_judul'))?$this->input->post('slide_judul'):'';
				$data['slide_gambar']	= ($this->input->post('slide_gambar'))?$this->input->post('slide_gambar'):'';
				$data['slide_deskripsi']= ($this->input->post('slide_deskripsi'))?$this->input->post('slide_deskripsi'):'';
				$data['slide_waktu']	= date("Y-m-d H:i:s");
				$simpan					= $this->input->post('simpan');
				if ($simpan) {
					$gambar = upload_image("slide_gambar", "./assets/images/slide/", "555x320", seo($data['slide_judul']));
					$data['slide_gambar']	= $gambar;
					$insert['slide_judul']		 = validasi_sql($data['slide_judul']);
					$insert['slide_deskripsi']   = $data['slide_deskripsi'];
					if ($data['slide_gambar']) { $insert['slide_gambar'] = validasi_sql($data['slide_gambar']); }
					$insert['slide_waktu']		 = validasi_sql($data['slide_waktu']);
					$this->ADM->insert_slide($insert);
					$this->session->set_flashdata('success','Slide telah berhasil ditambahkan!,');
					redirect("website/slide");
				}
				
			} elseif ($data['action'] == 'edit') {				
				$data['ckeditor'] 			= $this->ckeditor('slide_deskripsi'); 
				$data['onload']			 	= 'slide_judul';
				$where_slide['slide_id']	= validasi_sql($filter2);
				$slide						= $this->ADM->get_slide('*', $where_slide);
				$data['slide_id']			= ($this->input->post('slide_id'))?$this->input->post('slide_id'):$slide->slide_id;	
				$data['slide_judul']		= ($this->input->post('slide_judul'))?$this->input->post('slide_judul'):$slide->slide_judul;	
				$data['slide_gambar']		= ($this->input->post('slide_gambar'))?$this->input->post('slide_gambar'):$slide->slide_gambar;	
				$data['slide_deskripsi']	= ($this->input->post('slide_deskripsi'))?$this->input->post('slide_deskripsi'):$slide->slide_deskripsi;	
				$data['slide_waktu']		= ($this->input->post('slide_waktu'))?$this->input->post('slide_waktu'):$slide->slide_waktu;
				$simpan						= $this->input->post('simpan');
				if ($simpan) {
					$gambar = upload_image("slide_gambar", "./assets/images/slide/", "555x320", seo($data['slide_judul']));
					$data['slide_gambar']		= $gambar;
					$where_edit['slide_id']		= validasi_sql($data['slide_id']);
					$edit['slide_judul']		= validasi_sql($data['slide_judul']);
					$edit['slide_deskripsi']	= $data['slide_deskripsi'];
					if ($data['slide_gambar']) {
						$row = $this->ADM->get_slide('*', $where_edit);
						@unlink('./assets/images/slide/'.$row->slide_gambar);
						@unlink('./assets/images/slide/kecil_'.$row->slide_gambar);
						$edit['slide_gambar']	= $data['slide_gambar']; 
					}
					$this->ADM->update_slide($where_edit, $edit);
					$this->session->set_flashdata('success','Slide telah berhasil diedit!,');
					redirect('website/slide');		
				}				
				
		} elseif ($data['action']	== 'hapus') {
			 $where['slide_id']	= validasi_sql($filter2);
			 $row = $this->ADM->get_slide('*', $where);
			 @unlink ('./assets/images/slide/'.$row->slide_gambar);
			 @unlink ('./assets/images/slide/kecil_'.$row->slide_gambar);
			 $this->ADM->delete_slide($where);
			 $this->session->set_flashdata('success','Slide telah berhasil dihapus!,');
			 redirect("website/slide");
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}
  public function slide_detail($slide_id='')
  {
	  if($this->session->userdata('logged_in') == TRUE) {
		  $where_admin['admin_user']	= $this->session->userdata('admin_user');
		  $data['admin']				= $this->ADM->get_admin('', $where_admin);
		  $where_slide['slide_id']		= validasi_sql($slide_id);
		  $data['slide']				= $this->ADM->get_slide('*', $where_slide);
		  $data['ckeditor']				= $this->ckeditor('slide_deskripsi');
		  $data['action']				= 'detail';
		  $this->load->vars($data);
		  $this->load->view('admin/content/website/slide');
	  } else {
		  redirect("wp_login");
	  }
  }
  
  //HALAMAN STATIS
	public function halaman_statis($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']				= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']		= FALSE;
			$data['content'] 			= 'admin/content/website/halaman_statis';
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '105';
			$data['action']				= (empty($filter1))?'view':$filter1;
			$data['validate']			= array('statis_judul'=>'Judul',
												'statis_deskripsi'=>'Deskripsi');
			if ($data['action'] == 'view') {
				$data['berdasarkan']	= array('statis_judul'=>'JUDUL');
				$data['cari']			= ($this->input->post('cari'))?$this->input->post('cari'):'statis_judul';
				$data['q']				= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']		= (empty($filter1))?1:$filter2;
				$data['batas']			= 10;
				$data['page']			= ($data['halaman']-1) * $data['batas'];
				$like_statis[$data['cari']]= validasi_sql($data['q']);
				$data['jml_data']		= $this->ADM->count_all_statis('',$like_statis);
				$data['jml_halaman']	= ceil($data['jml_data']/$data['batas']);				
			} elseif ($data['action'] == 'tambah') {
				$data['ckeditor']		= $this->ckeditor('statis_deskripsi');
				$data['onload']			= 'statis_judul';
				$data['statis_id']		= ($this->input->post('statis_id'))?$this->input->post('statis_id'):'';
				$data['statis_judul']	= ($this->input->post('statis_judul'))?$this->input->post('statis_judul'):'';
				$data['statis_gambar']	= ($this->input->post('statis_gambar'))?$this->input->post('statis_gambar'):'';
				$data['statis_deskripsi']= ($this->input->post('statis_deskripsi'))?$this->input->post('statis_deskripsi'):'';
				$data['statis_waktu']	= date("Y-m-d H:i:s");
				$simpan					= $this->input->post('simpan');
				if ($simpan) {
					$gambar = upload_image("statis_gambar", "./assets/images/statis/", "555x320", seo($data['statis_judul']));
					$data['statis_gambar']	= $gambar;
					$insert['statis_judul']		 = validasi_sql($data['statis_judul']);
					$insert['statis_deskripsi']   = $data['statis_deskripsi'];
					if ($data['statis_gambar']) { $insert['statis_gambar'] = validasi_sql($data['statis_gambar']); }
					$insert['statis_waktu']		 = validasi_sql($data['statis_waktu']);
					$this->ADM->insert_statis($insert);
					$this->session->set_flashdata('success','Halaman Statis telah berhasil ditambahkan!,');
					redirect("website/halaman_statis");
				}
				
			} elseif ($data['action'] == 'edit') {				
				$data['ckeditor'] 			= $this->ckeditor('statis_deskripsi'); 
				$data['onload']			 	= 'statis_judul';
				$where_statis['statis_id']	= validasi_sql($filter2);
				$statis						= $this->ADM->get_statis('*', $where_statis);
				$data['statis_id']			= ($this->input->post('statis_id'))?$this->input->post('statis_id'):$statis->statis_id;	
				$data['statis_judul']		= ($this->input->post('statis_judul'))?$this->input->post('statis_judul'):$statis->statis_judul;	
				$data['statis_gambar']		= ($this->input->post('statis_gambar'))?$this->input->post('statis_gambar'):$statis->statis_gambar;	
				$data['statis_deskripsi']	= ($this->input->post('statis_deskripsi'))?$this->input->post('statis_deskripsi'):$statis->statis_deskripsi;	
				$data['statis_waktu']		= ($this->input->post('statis_waktu'))?$this->input->post('statis_waktu'):$statis->statis_waktu;
				$simpan						= $this->input->post('simpan');
				if ($simpan) {
					$gambar = upload_image("statis_gambar", "./assets/images/statis/", "555x320", seo($data['statis_judul']));
					$data['statis_gambar']		= $gambar;
					$where_edit['statis_id']		= validasi_sql($data['statis_id']);
					$edit['statis_judul']		= validasi_sql($data['statis_judul']);
					$edit['statis_deskripsi']	= $data['statis_deskripsi'];
					if ($data['statis_gambar']) {
						$row = $this->ADM->get_statis('*', $where_edit);
						@unlink('./assets/images/statis/'.$row->statis_gambar);
						@unlink('./assets/images/statis/kecil_'.$row->statis_gambar);
						$edit['statis_gambar']	= $data['statis_gambar']; 
					}
					$this->ADM->update_statis($where_edit, $edit);
					$this->session->set_flashdata('success','Halaman Statis telah berhasil diedit!,');
					redirect('website/halaman_statis');		
				}				
				
		} elseif ($data['action']	== 'hapus') {
			 $where['statis_id']	= validasi_sql($filter2);
			 $row = $this->ADM->get_statis('*', $where);
			 @unlink ('./assets/images/statis/'.$row->statis_gambar);
			 @unlink ('./assets/images/statis/kecil_'.$row->statis_gambar);
			 $this->ADM->delete_statis($where);
			 $this->session->set_flashdata('success','Halaman Statis telah berhasil dihapus!,');
			 redirect("website/halaman_statis");
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}
  public function statis_detail($statis_id='')
  {
	  if($this->session->userdata('logged_in') == TRUE) {
		  $where_admin['admin_user']	= $this->session->userdata('admin_user');
		  $data['admin']				= $this->ADM->get_admin('', $where_admin);
		  $where_statis['statis_id']		= validasi_sql($statis_id);
		  $data['statis']				= $this->ADM->get_statis('*', $where_statis);
		  $data['ckeditor']				= $this->ckeditor('statis_deskripsi');
		  $data['action']				= 'detail';
		  $this->load->vars($data);
		  $this->load->view('admin/content/website/halaman_statis');
	  } else {
		  redirect("wp_login");
	  }
  }	
  
  //ALBUM
	public function album($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']		= FALSE;
			$data['content'] 			= 'admin/content/website/album';
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '79';
			$data['action']				= (empty($filter1))?'view':$filter1;
			$data['validate']			= array('album_judul'=>'Judul Album', 'album_gambar'=>'Gambar');
			if ($data['action'] == 'view'){
				$data['berdasarkan']		= array('album_judul'=>'JUDUL ALBUM');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'album_judul';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_album[$data['cari']]	= $data['q'];
				$data['jml_data']			= $this->ADM->count_all_album('', $like_album);
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
			} elseif ($data['action'] == 'tambah'){
				$data['ckeditor'] 			= $this->ckeditor('album_deskripsi');
				$data['onload']				= 'album_judul';
				$data['album_judul']		= ($this->input->post('album_judul'))?$this->input->post('album_judul'):'';
				$data['album_deskripsi']		= ($this->input->post('album_deskripsi'))?$this->input->post('album_deskripsi'):'';
				$data['album_gambar']		= ($this->input->post('album_gambar'))?$this->input->post('album_gambar'):'';
				$simpan						= $this->input->post('simpan');
				if ($simpan){
					$gambar	= upload_image("album_gambar", "./assets/images/album/", "230x160");
					$data['album_gambar']		= $gambar;
					$insert['album_judul']		= $data['album_judul'];
					$insert['album_deskripsi']	= $data['album_deskripsi'];
					if ($data['album_gambar']) {$insert['album_gambar']	= $data['album_gambar'];}
					$this->ADM->insert_album($insert);
					$this->session->set_flashdata('success','Album baru telah berhasil ditambahkan!,');
					redirect("website/album");
				}
			} elseif ($data['action'] == 'edit'){
				$data['ckeditor'] 			= $this->ckeditor('album_deskripsi');
				$data['onload']				= 'album_judul';
				$where_album['album_id']	= $filter2; 
				$album						= $this->ADM->get_album('*', $where_album);
				$data['album_id']			= ($this->input->post('album_id'))?$this->input->post('album_id'):$album->album_id;
				$data['album_deskripsi']	= ($this->input->post('album_deskripsi'))?$this->input->post('album_deskripsi'):$album->album_deskripsi;
				$data['album_judul']		= ($this->input->post('album_judul'))?$this->input->post('album_judul'):$album->album_judul;
				$data['album_gambar']		= ($this->input->post('album_gambar'))?$this->input->post('album_gambar'):$album->album_gambar;
				$simpan						= $this->input->post('simpan');
				if ($simpan){					
					$gambar	= upload_image("album_gambar", "./assets/images/album/", "230x160");
					$data['album_gambar']			= $gambar;
					
					$where_edit['album_id']			= $data['album_id'];
					$edit['album_judul']			= $data['album_judul'];
					$edit['album_deskripsi']		= $data['album_deskripsi'];
					if ($data['album_gambar']) {
						$row = $this->ADM->get_album('*', $where_edit);			
						@unlink('./assets/images/album/'.$row->album_gambar);
						@unlink('./assets/images/album/kecil_'.$row->album_gambar);
						$edit['album_gambar']	= $data['album_gambar'];
					}					
					$this->ADM->update_album($where_edit, $edit);
					$this->session->set_flashdata('success','File album telah berhasil diedit!,');
					redirect("website/album");
				}
			} elseif ($data['action'] == 'hapus'){
				$where_delete['album_id'] 	= $filter2;	
				$row = $this->ADM->get_album('*', $where_delete);			
				@unlink('./assets/images/album/'.$row->album_gambar);
				@unlink('./assets/images/album/kecil_'.$row->album_gambar);
				$this->ADM->delete_album($where_delete);
				$this->session->set_flashdata('success','File album telah berhasil dihapus!,');
				redirect("website/album");
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}
	
	public function album_detail($album_id="")
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$where_album['album_id']	= $album_id; 
			$data['album'] 				= $this->ADM->get_album('*', $where_album);
			$data['action']				= 'detail';
			$this->load->vars($data);
			$this->load->view('admin/content/website/album');
		} else {
			redirect("wp_login");
		}
	}
	
	// GALERI
	public function galeri_foto($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']				= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']		= FALSE;
			$data['content'] 			= 'admin/content/website/galeri_foto';
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '79';
			$data['action']				= (empty($filter1))?'view':$filter1;
			$data['validate']			= array('galeri_judul'=>'Judul Galeri', 'galeri_gambar'=>'Gambar', 'album_id'=>'Album');
			if ($data['action'] == 'view'){
				$data['berdasarkan']		= array('galeri_judul'=>'JUDUL GALERI', 'album_id'=>'ALBUM');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'galeri_judul';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_galeri[$data['cari']]	= $data['q'];
				$data['jml_data']			= $this->ADM->count_all_album_galeri('', $like_galeri);
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
			} elseif ($data['action'] == 'tambah'){
				$data['ckeditor'] 			= $this->ckeditor('galeri_deskripsi');
				$data['onload']				= 'galeri_judul';
				$data['galeri_judul']		= ($this->input->post('galeri_judul'))?$this->input->post('galeri_judul'):'';
				$data['galeri_deskripsi']	= ($this->input->post('galeri_deskripsi'))?$this->input->post('galeri_deskripsi'):'';
				$data['galeri_gambar']		= ($this->input->post('galeri_gambar'))?$this->input->post('galeri_gambar'):'';
				$data['galeri_waktu']		= date("Y-m-d H:i:s");
				$data['album_id']			= ($this->input->post('album_id'))?$this->input->post('album_id'):'';
				$simpan						= $this->input->post('simpan');
				if ($simpan){
					$gambar	= upload_image("galeri_gambar", "./assets/images/galeri/", "230x160");
					$data['galeri_gambar']		= $gambar;
					$insert['galeri_judul']		= $data['galeri_judul'];
					$insert['galeri_deskripsi']	= $data['galeri_deskripsi'];
					if ($data['galeri_gambar']) {$insert['galeri_gambar']	= $data['galeri_gambar'];}
					$insert['galeri_waktu']		= $data['galeri_waktu'];
					$insert['album_id']			= $data['album_id'];
					$this->ADM->insert_album_galeri($insert);
					$this->session->set_flashdata('success','Galeri baru telah berhasil ditambahkan!,');
					redirect("website/galeri_foto");
				}
			} elseif ($data['action'] == 'edit'){
				$data['ckeditor'] 			= $this->ckeditor('galeri_deskripsi');
				$data['onload']				= 'galeri_judul';
				$where_galeri['galeri_id']	= $filter2; 
				$galeri						= $this->ADM->get_album_galeri('*', $where_galeri);
				$data['galeri_id']			= ($this->input->post('galeri_id'))?$this->input->post('galeri_id'):$galeri->galeri_id;
				$data['galeri_deskripsi']	= ($this->input->post('galeri_deskripsi'))?$this->input->post('galeri_deskripsi'):$galeri->galeri_deskripsi;
				$data['galeri_judul']		= ($this->input->post('galeri_judul'))?$this->input->post('galeri_judul'):$galeri->galeri_judul;
				$data['galeri_gambar']		= ($this->input->post('galeri_gambar'))?$this->input->post('galeri_gambar'):$galeri->galeri_gambar;
				$data['galeri_waktu']		= ($this->input->post('galeri_waktu'))?$this->input->post('galeri_waktu'):$galeri->galeri_waktu;
				$data['album_id']			= ($this->input->post('album_id'))?$this->input->post('album_id'):$galeri->album_id;
				$simpan						= $this->input->post('simpan');
				if ($simpan){					
					$gambar	= upload_image("galeri_gambar", "./assets/images/galeri/", "230x160");
					$data['galeri_gambar']			= $gambar;
					
					$where_edit['galeri_id']		= $data['galeri_id'];
					$edit['galeri_judul']			= $data['galeri_judul'];
					$edit['galeri_deskripsi']		= $data['galeri_deskripsi'];
					if ($data['galeri_gambar']) {
						$row = $this->ADM->get_album_galeri('*', $where_edit);
						@unlink('./assets/images/galeri/'.$row->galeri_gambar);
						@unlink('./assets/images/galeri/kecil_'.$row->galeri_gambar);
						$edit['galeri_gambar']	= $data['galeri_gambar'];
					}					
					$edit['album_id']				= $data['album_id'];
					$this->ADM->update_album_galeri($where_edit, $edit);
					$this->session->set_flashdata('success','File galeri telah berhasil diedit!,');
					redirect("website/galeri_foto");
				}
			} elseif ($data['action'] == 'hapus'){
				$where_delete['galeri_id'] 	= $filter2;
				$row = $this->ADM->get_album_galeri('*', $where_delete);
				@unlink('./assets/images/galeri/'.$row->galeri_gambar);
				@unlink('./assets/images/galeri/kecil_'.$row->galeri_gambar);
				$this->ADM->delete_album_galeri($where_delete);
				$this->session->set_flashdata('success','File galeri telah berhasil dihapus!,');
				redirect("website/galeri_foto");
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}
	
	public function galeri_foto_detail($galeri_id="")
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']				= $this->ADM->identitaswebsite();
			$where_galeri['galeri_id']	= $galeri_id; 
			$data['galeri'] 			= $this->ADM->get_album_galeri('*', $where_galeri);
			$data['action']				= 'detail';
			$this->load->vars($data);
			$this->load->view('admin/content/website/galeri_foto');
		} else {
			redirect("wp_login");
		}
	}
	
	
		// TESTIMONIAL
	public function testimonial($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']				= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']		= FALSE;
			$data['content'] 			= 'admin/content/website/testimonial';
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '105';
			$data['action']				= (empty($filter1))?'view':$filter1;
			$data['validate']			= array('testimonial_nama'=>'Nama Testimonial', 
												'testimonial_sumber'=>'Sumber Testimonial', 
												'testimonial_kerja'=>'Tempat Kerja Testimonial', 
												'testimonial_jabatan'=>'Jabatan Testimonial',
												'testimonial_deskripsi'=>'Deskripsi Testimonial',
												'testimonial_gambar'=>'Gambar Testimonial');
		if ($data['action'] == 'view'){
				$data['berdasarkan']		= array('testimonial_nama'=>'NAMA', 'testimonial_kerja'=>'TEMPAT KERJA');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'testimonial_nama';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_testimonial[$data['cari']]	= $data['q'];
				$data['jml_data']			= $this->ADM->count_all_testimonial('', $like_testimonial);
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
			} elseif ($data['action'] == 'tambah'){
				$data['ckeditor'] 				= $this->ckeditor('testimonial_deskripsi');
				$data['onload']					= 'testimonial_nama';
				$data['testimonial_nama']		= ($this->input->post('testimonial_nama'))?$this->input->post('testimonial_nama'):'';
				$data['testimonial_sumber']		= ($this->input->post('testimonial_sumber'))?$this->input->post('testimonial_sumber'):'';
				$data['testimonial_kerja']		= ($this->input->post('testimonial_kerja'))?$this->input->post('testimonial_kerja'):'';
				$data['testimonial_jabatan']	= ($this->input->post('testimonial_jabatan'))?$this->input->post('testimonial_jabatan'):'';
				$data['testimonial_deskripsi']	= ($this->input->post('testimonial_deskripsi'))?$this->input->post('testimonial_deskripsi'):'';
				$data['testimonial_gambar']		= ($this->input->post('testimonial_gambar'))?$this->input->post('testimonial_gambar'):'';
				$data['testimonial_waktu']		= date("Y-m-d H:i:s");
				$simpan							= $this->input->post('simpan');
				if ($simpan){
					$gambar	= upload_image("testimonial_gambar", "./assets/images/testimonial/", "230x160");
					$data['testimonial_gambar']		= $gambar;
					$insert['testimonial_nama']		= $data['testimonial_nama'];
					$insert['testimonial_sumber']		= $data['testimonial_sumber'];
					$insert['testimonial_kerja']		= $data['testimonial_kerja'];
					$insert['testimonial_jabatan']		= $data['testimonial_jabatan'];
					$insert['testimonial_deskripsi']	= $data['testimonial_deskripsi'];
					if ($data['testimonial_gambar']) {$insert['testimonial_gambar']	= $data['testimonial_gambar'];}
					$insert['testimonial_waktu']		= $data['testimonial_waktu'];
					$this->ADM->insert_testimonial($insert);
					$this->session->set_flashdata('success','Testimonial baru telah berhasil ditambahkan!,');
					redirect("website/testimonial");
				}
			} elseif ($data['action'] == 'edit'){
				$data['ckeditor'] 						= $this->ckeditor('testimonial_deskripsi');
				$data['onload']							= 'testimonial_nama';
				$where_testimonial['testimonial_id']	= $filter2; 
				$testimonial							= $this->ADM->get_testimonial('*', $where_testimonial);
				$data['testimonial_id']					= ($this->input->post('testimonial_id'))?$this->input->post('testimonial_id'):$testimonial->testimonial_id;
				$data['testimonial_nama']		= ($this->input->post('testimonial_nama'))?$this->input->post('testimonial_nama'):$testimonial->testimonial_nama;
				$data['testimonial_sumber']		= ($this->input->post('testimonial_sumber'))?$this->input->post('testimonial_sumber'):$testimonial->testimonial_sumber;
				$data['testimonial_kerja']		= ($this->input->post('testimonial_kerja'))?$this->input->post('testimonial_kerja'):$testimonial->testimonial_kerja;
				$data['testimonial_jabatan']		= ($this->input->post('testimonial_jabatan'))?$this->input->post('testimonial_jabatan'):$testimonial->testimonial_jabatan;
				$data['testimonial_deskripsi']	= ($this->input->post('testimonial_deskripsi'))?$this->input->post('testimonial_deskripsi'):$testimonial->testimonial_deskripsi;
				$data['testimonial_gambar']		= ($this->input->post('testimonial_gambar'))?$this->input->post('testimonial_gambar'):$testimonial->testimonial_gambar;
				$data['testimonial_waktu']		= ($this->input->post('testimonial_waktu'))?$this->input->post('testimonial_waktu'):$testimonial->testimonial_waktu;
				$simpan						= $this->input->post('simpan');
				if ($simpan){					
					$gambar	= upload_image("testimonial_gambar", "./assets/images/testimonial/", "230x160");
					$data['testimonial_gambar']			= $gambar;					
					$where_edit['testimonial_id']		= $data['testimonial_id'];
					$edit['testimonial_nama']			= $data['testimonial_nama'];
					$edit['testimonial_sumber']			= $data['testimonial_sumber'];
					$edit['testimonial_kerja']			= $data['testimonial_kerja'];
					$edit['testimonial_jabatan']		= $data['testimonial_jabatan'];
					$edit['testimonial_deskripsi']		= $data['testimonial_deskripsi'];
					if ($data['testimonial_gambar']) {
						$row = $this->ADM->get_testimonial('*', $where_edit);
						@unlink('./assets/images/testimonial/'.$row->testimonial_gambar);
						@unlink('./assets/images/testimonial/kecil_'.$row->testimonial_gambar);
						$edit['testimonial_gambar']	= $data['testimonial_gambar'];
					}					
					$this->ADM->update_testimonial($where_edit, $edit);
					$this->session->set_flashdata('success','Testimonial telah berhasil diubah!,');
					redirect("website/testimonial");
				}
			} elseif ($data['action'] == 'hapus'){
				$where_delete['testimonial_id'] 	= $filter2;
				$row = $this->ADM->get_testimonial('*', $where_delete);
				@unlink('./assets/images/testimonial/'.$row->testimonial_gambar);
				@unlink('./assets/images/testimonial/kecil_'.$row->testimonial_gambar);
				$this->ADM->delete_testimonial($where_delete);
				$this->session->set_flashdata('success','Testimonial telah berhasil dihapus!,');
				redirect("website/testimonial");
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}
	
	public function testimonial_detail($testimonial_id="")
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']				= $this->ADM->identitaswebsite();
			$where_testimonial['testimonial_id']	= $testimonial_id; 
			$data['testimonial'] 			= $this->ADM->get_testimonial('*', $where_testimonial);
		  	$data['ckeditor']				= $this->ckeditor('testimonial_deskripsi');
			$data['action']				= 'detail';
			$this->load->vars($data);
			$this->load->view('admin/content/website/testimonial');
		} else {
			redirect("wp_login");
		}
	}
	
	
	//DOWNLOAD FILE
	public function download_file($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']				= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']		= FALSE;
			$data['content'] 			= 'admin/content/website/download_file';
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '79';
			$data['action']				= (empty($filter1))?'view':$filter1;
			$data['validate']			= array('download_judul'=>'Judul file', 'download_file'=>'File');
			if ($data['action'] == 'view'){				
				$data['berdasarkan']		= array('download_judul'=>'JUDUL FILE');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'download_judul';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_down[$data['cari']]	= $data['q'];
				$data['jml_data']			= $this->ADM->count_all_downloads('', $like_down);
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
			} elseif ($data['action'] == 'tambah'){				
				$data['onload']				= 'download_judul';
				$data['download_judul']		= ($this->input->post('download_judul'))?$this->input->post('download_judul'):'';
				$data['download_deskripsi']		= ($this->input->post('download_deskripsi'))?$this->input->post('download_deskripsi'):'';
				$data['download_file']		= ($this->input->post('download_file'))?$this->input->post('download_file'):'';
				$data['download_waktu']		= date("Y-m-d H:i:s");
				$simpan						= $this->input->post('simpan');
				if ($simpan){
					$files	= upload_file("download_file", "./assets/files/download/");
						$data['download_file']	= $files;
						$insert['download_judul']	= $data['download_judul'];
						$insert['download_deskripsi']	= $data['download_deskripsi'];
						$insert['download_waktu']	= $data['download_waktu'];
						if ($data['download_file']) {$insert['download_file']	= $data['download_file'];}
						$this->ADM->insert_downloads($insert);
						$this->session->set_flashdata('success','download_file baru telah berhasil ditambahkan!,');
						redirect("website/download_file");
				}
			} elseif ($data['action'] == 'edit'){
				$data['onload']			= 'download_judul';
				$where_down['download_id']	= $filter2; 
				$download					= $this->ADM->get_downloads('*', $where_down);
				$data['download_id']		= ($this->input->post('download_id'))?$this->input->post('download_id'):$download->download_id;
				$data['download_judul']		= ($this->input->post('download_judul'))?$this->input->post('download_judul'):$download->download_judul;
				$data['download_deskripsi']	= ($this->input->post('download_deskripsi'))?$this->input->post('download_deskripsi'):$download->download_deskripsi;
				$data['download_file']		= ($this->input->post('download_file'))?$this->input->post('download_file'):$download->download_file;
				$simpan						= $this->input->post('simpan');
				if ($simpan){
					$files	= upload_file("download_file", "./assets/files/download/");
					$data['download_file']	= $files;
					$edit['download_judul']	= $data['download_judul'];
					$edit['download_deskripsi']	= $data['download_deskripsi'];
					$where_edit['download_id']	= $data['download_id'];
					$edit['download_judul']		= validasi_sql($data['download_judul']);
					if ($data['download_file']) {
						$row = $this->ADM->get_downloads('*', $where_edit);
						@unlink('./assets/files/download/'.$row->download_file);
						$edit['download_file']	= $data['download_file']; 
					}
					$this->ADM->update_downloads($where_edit, $edit);
					$this->session->set_flashdata('success','File telah berhasil diubah!,');
					redirect("website/download_file");
				}
			} elseif ($data['action'] == 'hapus'){
				$where_delete['download_id'] 	= $filter2;
				$row = $this->ADM->get_downloads('*', $where_delete);
				@unlink('./assets/files/download/'.$row->download_file);
				$this->ADM->delete_downloads($where_delete);
				$this->session->set_flashdata('success','File telah berhasil dihapus!,');
				redirect("website/download_file");
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}
	
	public function download_file_detail($download_id="")
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']				= $this->ADM->identitaswebsite();
			$where_down['download_id']	= $download_id; 
			$data['download'] 			= $this->ADM->get_downloads ('*', $where_down);
			$data['action']				= 'detail';
			$this->load->vars($data);
			$this->load->view('admin/content/website/download_file');
		} else {
			redirect("wp_login");
		}
	}
	
	//MITRA KERJA
	public function mitra_kerja($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']				= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']		= FALSE;
			$data['content'] 			= 'admin/content/website/mitra_kerja';
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '79';
			$data['action']				= (empty($filter1))?'view':$filter1;
			$data['validate']			= array('mitra_link'=>'Link', 'mitra_gambar'=>'Gambar');
			if ($data['action'] == 'view'){				
				$data['berdasarkan']		= array('mitra_link'=>'LINK');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'mitra_link';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_down[$data['cari']]	= $data['q'];
				$data['jml_data']			= $this->ADM->count_all_mitra_kerja('', $like_down);
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
			} elseif ($data['action'] == 'tambah'){				
				$data['onload']				= 'mitra_link';
				$data['mitra_link']		= ($this->input->post('mitra_link'))?$this->input->post('mitra_link'):'';
				$data['mitra_gambar']		= ($this->input->post('mitra_gambar'))?$this->input->post('mitra_gambar'):'';
				$data['mitra_waktu']		= date("Y-m-d H:i:s");
				$simpan						= $this->input->post('simpan');
				if ($simpan){
					$files	= upload_image("mitra_gambar", "./assets/images/mitra_kerja/");
						$data['mitra_gambar']	= $files;
						$insert['mitra_link']	= $data['mitra_link'];
						if ($data['mitra_gambar']) {$insert['mitra_gambar']	= $data['mitra_gambar'];}
						$insert['mitra_waktu']		 = validasi_sql($data['mitra_waktu']);
						$this->ADM->insert_mitra_kerja($insert);
						$this->session->set_flashdata('success','Mitra Kerja baru telah berhasil ditambahkan!,');
						redirect("website/mitra_kerja");
				}
			} elseif ($data['action'] == 'edit'){
				$data['onload']			= 'mitra_link';
				$where_mitra['mitra_id']	= $filter2; 
				$mitra					= $this->ADM->get_mitra_kerja('*', $where_mitra	);
				$data['mitra_id']		= ($this->input->post('mitra_id'))?$this->input->post('mitra_id'):$mitra->mitra_id;
				$data['mitra_link']		= ($this->input->post('mitra_link'))?$this->input->post('mitra_link'):$mitra->mitra_link;
				$data['mitra_gambar']		= ($this->input->post('mitra_gambar'))?$this->input->post('mitra_gambar'):$mitra->mitra_gambar;
				$simpan						= $this->input->post('simpan');
				if ($simpan){
					$files	= upload_image("mitra_gambar", "./assets/images/mitra_kerja/", "230x160");
					$data['mitra_gambar']	= $files;
					$edit['mitra_link']	= $data['mitra_link'];
					$where_edit['mitra_id']	= $data['mitra_id'];
					$edit['mitra_link']		= validasi_sql($data['mitra_link']);
					if ($data['mitra_gambar']) {
						$row = $this->ADM->get_mitra_kerja('*', $where_edit);
						@unlink('./assets/images/mitra_kerja/'.$row->mitra_gambar);
						$edit['mitra_gambar']	= $data['mitra_gambar']; 
					}
					$this->ADM->update_mitra_kerja($where_edit, $edit);
					$this->session->set_flashdata('success','Mitra Kerja telah berhasil diubah!,');
					redirect("website/mitra_kerja");
				}
			} elseif ($data['action'] == 'hapus'){
				$where_delete['mitra_id'] 	= $filter2;
				$row = $this->ADM->get_mitra_kerja('*', $where_delete);
				@unlink('./assets/images/mitra_kerja/'.$row->mitra_gambar);
				$this->ADM->delete_mitra_kerja($where_delete);
				$this->session->set_flashdata('success','Mitra Kerja telah berhasil dihapus!,');
				redirect("website/mitra_kerja");
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}
	
	public function mitra_kerja_detail($mitra_id="")
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']				= $this->ADM->identitaswebsite();
			$where_mitra['mitra_id']		= $mitra_id; 
			$data['mitra_kerja'] 			= $this->ADM->get_mitra_kerja('*', $where_mitra);
			$data['action']				= 'detail';
			$this->load->vars($data);
			$this->load->view('admin/content/website/mitra_kerja');
		} else {
			redirect("wp_login");
		}
	}
	
	//GALERI VIDEO
	public function galeri_video($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']		= FALSE;
			$data['content'] 			= 'admin/content/website/galeri_video';
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '79';
			$data['action']				= (empty($filter1))?'view':$filter1;
			$data['validate']			= array('video_judul'=>'Judul Video', 'video_link'=>'Link Video');
			if ($data['action'] == 'view'){
				$data['berdasarkan']		= array('video_judul'=>'JUDUL VIDEO');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'video_judul';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_galeri[$data['cari']]	= $data['q'];
				$data['jml_data']			= $this->ADM->count_all_galeri_video('', $like_galeri);
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
			} elseif ($data['action'] == 'tambah'){
				$data['ckeditor'] 			= $this->ckeditor('video_deskripsi');
				$data['onload']				= 'video_judul';
				$data['video_judul']		= ($this->input->post('video_judul'))?$this->input->post('video_judul'):'';
				$data['video_deskripsi']	= ($this->input->post('video_deskripsi'))?$this->input->post('video_deskripsi'):'';
				$data['video_link']		= ($this->input->post('video_link'))?$this->input->post('video_link'):'';
				$data['video_waktu']		= date("Y-m-d H:i:s");
				$simpan						= $this->input->post('simpan');
				if ($simpan){
					$data['video_link']		= $data['video_link'];
					$insert['video_judul']		= $data['video_judul'];
					$insert['video_deskripsi']	= $data['video_deskripsi'];
					if ($data['video_link']) {
					$insert['video_link']	= $data['video_link'];}
					$insert['video_waktu']		= $data['video_waktu'];
					$this->ADM->insert_galeri_video($insert);
					$this->session->set_flashdata('success','Video baru telah berhasil ditambahkan!,');
					redirect("website/galeri_video");
				}
			} elseif ($data['action'] == 'edit'){
				$data['ckeditor'] 			= $this->ckeditor('video_deskripsi');
				$data['onload']				= 'video_judul';
				$where_galeri['video_id']	= $filter2; 
				$galeri						= $this->ADM->get_galeri_video('*', $where_galeri);
				$data['video_id']			= ($this->input->post('video_id'))?$this->input->post('video_id'):$galeri->video_id;
				$data['video_deskripsi']	= ($this->input->post('video_deskripsi'))?$this->input->post('video_deskripsi'):$galeri->video_deskripsi;
				$data['video_judul']		= ($this->input->post('video_judul'))?$this->input->post('video_judul'):$galeri->video_judul;
				$data['video_link']		= ($this->input->post('video_link'))?$this->input->post('video_link'):$galeri->video_link;
				$data['video_waktu']		= ($this->input->post('video_waktu'))?$this->input->post('video_waktu'):$galeri->video_waktu;
				$simpan						= $this->input->post('simpan');
				if ($simpan){					
					$data['video_link']			= $data['video_link'];
					$where_edit['video_id']		= $data['video_id'];
					$edit['video_judul']			= $data['video_judul'];
					$edit['video_deskripsi']		= $data['video_deskripsi'];
					if ($data['video_link']) {
						$row = $this->ADM->get_galeri_video('*', $where_edit);
						$edit['video_link']	= $data['video_link'];
					}					
					$this->ADM->update_galeri_video($where_edit, $edit);
					$this->session->set_flashdata('success','Video telah berhasil diubah!,');
					redirect("website/galeri_video");
				}
			} elseif ($data['action'] == 'hapus'){
				$where_delete['video_id'] 	= $filter2;
				$row = $this->ADM->get_galeri_video('*', $where_delete);
				$this->ADM->delete_galeri_video($where_delete);
				$this->session->set_flashdata('success','Video telah berhasil dihapus!,');
				redirect("website/galeri_video");
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}
	
	public function galeri_video_detail($video_id="")
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$where_video['video_id']	= $video_id; 
			$data['video'] 			= $this->ADM->get_galeri_video('*', $where_video);
			$data['action']				= 'detail';
			$this->load->vars($data);
			$this->load->view('admin/content/website/galeri_video');
		} else {
			redirect("wp_login");
		}
	}
	
	
	//KOMENTAR
	public function komentar($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']		= FALSE;
			$data['content'] 			= 'admin/content/website/komentar';
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '79';
			$data['action']				= (empty($filter1))?'view':$filter1;
			$data['validate']			= array('komentar_nama' => 'Nama',
												'komentar_email' => 'Email',
												'komentar_deskripsi' => 'Deskripsi');
			if ($data['action'] == 'view'){
				$data['berdasarkan']		= array('komentar_nama'=>'NAMA','komentar_deskripsi'=>'DESKRIPSI');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'komentar_nama';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_komentar[$data['cari']]	= $data['q'];
				$data['jml_data']			= $this->ADM->count_all_komentar('', $like_komentar);
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
			} elseif ($data['action'] == 'tambah'){
				$data['ckeditor'] 			= $this->ckeditor('komentar_deskripsi');
				$data['onload']				= 'komentar_nama';
				$data['komentar_nama']	= ($this->input->post('komentar_nama'))?$this->input->post('komentar_nama'):'';
				$data['komentar_deskripsi']	= ($this->input->post('komentar_deskripsi'))?$this->input->post('komentar_deskripsi'):'';
				$data['komentar_waktu']		= date("Y-m-d H:i:s");
				$data['berita_id']			= ($this->input->post('berita_id'))?$this->input->post('berita_id'):'';
				$simpan						= $this->input->post('simpan');
				if ($simpan){
					$insert['komentar_nama']		= validasi_sql($data['komentar_nama']);
					$insert['komentar_deskripsi']	= $data['komentar_deskripsi'];
					$insert['komentar_waktu']		= validasi_sql($data['komentar_waktu']);
					$insert['berita_id']			= validasi_sql($data['berita_id']);
					$this->ADM->insert_komentar($insert);
					$this->session->set_flashdata('success','Komentar telah berhasil ditambahkan!,');
					redirect("website/komentar");
				}
			} elseif ($data['action'] == 'edit'){
				$where_komentar['komentar_id']	= validasi_sql($filter2); 
				if ($filter3 == 'N') {
					$edit['komentar_status'] = 'Y';
				} else {
 					$edit['komentar_status']= 'N';
				}
				$this->ADM->update_komentar($where_edit, $edit);
				$this->session->set_flashdata('success','Komentar telah berhasil diubah!,');
				redirect("website/komentar");
			} elseif ($data['action'] == 'hapus'){
				$where['komentar_id'] = validasi_sql($filter2);
				$row = $this->ADM->get_komentar('*', $where);
				$this->ADM->delete_komentar($where);
				$this->session->set_flashdata('success','Komentar telah berhasil dihapus!,');
				redirect("website/komentar");
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}
	
	public function komentar_detail($komentar_id='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);	
			$data['web']					= $this->ADM->identitaswebsite();		
			$where_komentar['komentar_id']	= validasi_sql($komentar_id); 
			$data['komentar'] 			= $this->ADM->get_komentar('*', $where_komentar);
			$data['ckeditor'] 			= $this->ckeditor('komentar_deskripsi');
			$data['action']				= 'detail';
			$this->load->vars($data);
			$this->load->view('admin/content/website/komentar');
		} else {
			redirect("wp_login");
		}
	}
	
	
	//MANAGEMENT
	public function management($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']				= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']		= FALSE;
			$data['content'] 			= 'admin/content/website/management';
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '105';
			$data['action']				= (empty($filter1))?'view':$filter1;
			$data['validate']			= array('management_nama'=>'Nama', 'management_jabatan'=>'Jabatan',
												'management_foto'=>'Foto');
			if ($data['action'] == 'view'){				
				$data['berdasarkan']		= array('management_nama'=>'NAMA', 'management_team'=>'TEAM');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'management_nama';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_management[$data['cari']]	= $data['q'];
				$data['jml_data']			= $this->ADM->count_all_management('', $like_management);
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
			} elseif ($data['action'] == 'tambah'){				
				$data['ckeditor'] 				= $this->ckeditor('management_deskripsi');
				$data['onload']					= 'management_nama';
				$data['management_nama']		= ($this->input->post('management_nama'))?$this->input->post('management_nama'):'';
				$data['management_jabatan']		= ($this->input->post('management_jabatan'))?$this->input->post('management_jabatan'):'';
				$data['management_team']		= ($this->input->post('management_team'))?$this->input->post('management_team'):'';
				$data['management_deskripsi']	= ($this->input->post('management_deskripsi'))?$this->input->post('management_deskripsi'):'';
				$data['management_email']		= ($this->input->post('management_email'))?$this->input->post('management_email'):'';
				$data['management_fb']			= ($this->input->post('management_fb'))?$this->input->post('management_fb'):'';
				$data['management_twitter']		= ($this->input->post('management_twitter'))?$this->input->post('management_twitter'):'';
				$data['management_gp']			= ($this->input->post('management_gp'))?$this->input->post('management_gp'):'';
				$data['management_foto']		= ($this->input->post('management_foto'))?$this->input->post('management_foto'):'';				$data['admin_nama']				= $this->session->userdata('admin_nama');	
				$data['management_post']		= date("Y-m-d H:i:s");
				$simpan							= $this->input->post('simpan');
				if ($simpan){
					$files	= upload_image("management_foto", "./assets/images/management/");
						$data['management_foto']		= $files;
						$insert['management_nama']		= $data['management_nama'];
						$insert['management_jabatan']	= $data['management_jabatan'];
						$insert['management_team']		= $data['management_team'];
						$insert['management_deskripsi']	= $data['management_deskripsi'];
						$insert['management_email']		= $data['management_nama'];
						$insert['management_fb']		= $data['management_fb'];
						$insert['management_twitter']	= $data['management_twitter'];
						$insert['management_gp']		= $data['management_gp'];
						if ($data['management_foto']) {$insert['management_foto']	= $data['management_foto'];}
							$insert['admin_nama']		= $this->session->userdata('admin_nama');	
						$insert['management_post']		 = validasi_sql($data['management_post']);
						$this->ADM->insert_management($insert);
						$this->session->set_flashdata('success','Management baru telah berhasil ditambahkan!,');
						redirect("website/management");
				}
			} elseif ($data['action'] == 'edit'){
				$data['ckeditor'] 				= $this->ckeditor('management_deskripsi'); 
				$data['onload']					= 'management_nama';
				$where_management['management_id']	= $filter2; 
				$management						= $this->ADM->get_management('*', $where_management);
				$data['management_id']			= ($this->input->post('management_id'))?$this->input->post('management_id'):$management->management_id;
				$data['management_nama']		= ($this->input->post('management_nama'))?$this->input->post('management_nama'):$management->management_nama;
				$data['management_jabatan']		= ($this->input->post('management_jabatan'))?$this->input->post('management_jabatan'):$management->management_jabatan;
				$data['management_team']		= ($this->input->post('management_team'))?$this->input->post('management_team'):$management->management_team;
				$data['management_deskripsi']	= ($this->input->post('management_deskripsi'))?$this->input->post('management_deskripsi'):$management->management_deskripsi;
				$data['management_email']		= ($this->input->post('management_email'))?$this->input->post('management_email'):$management->management_email;
				$data['management_fb']			= ($this->input->post('management_fb'))?$this->input->post('management_fb'):$management->management_fb;
				$data['management_twitter']		= ($this->input->post('management_twitter'))?$this->input->post('management_twitter'):$management->management_twitter;
				$data['management_gp']			= ($this->input->post('management_gp'))?$this->input->post('management_gp'):$management->management_gp;
				$data['management_foto']			= ($this->input->post('management_foto'))?$this->input->post('management_foto'):$management->management_foto;
				$simpan							= $this->input->post('simpan');
				if ($simpan){
					$foto	= upload_image("management_foto", "./assets/images/management/", "230x160");
					$data['management_foto']		= $foto;
					$where_edit['management_id']	= $data['management_id'];
					$edit['management_nama']		= $data['management_nama'];
					$edit['management_jabatan']		= $data['management_jabatan'];
					$edit['management_team']		= $data['management_team'];
					$edit['management_deskripsi']	= $data['management_deskripsi'];
					$edit['management_email']		= $data['management_email'];
					$edit['management_fb']			= $data['management_fb'];
					$edit['management_twitter']		= $data['management_twitter'];
					$edit['management_gp']			= $data['management_gp'];
					if ($data['management_foto']) {
						$row = $this->ADM->get_management('*', $where_edit);
						@unlink('./assets/images/management/'.$row->management_foto);
						$edit['management_foto']	= $data['management_foto']; 
					}
					$this->ADM->update_management($where_edit, $edit);
					$this->session->set_flashdata('success','Management telah berhasil diubah!,');
					redirect("website/management");
				}
			} elseif ($data['action'] == 'hapus'){
				$where_delete['management_id'] 	= $filter2;
				$row = $this->ADM->get_management('*', $where_delete);
				@unlink('./assets/images/management/'.$row->management_foto);
				$this->ADM->delete_management($where_delete);
				$this->session->set_flashdata('success','Management telah berhasil dihapus!,');
				redirect("website/management");
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}
	
	public function management_detail($management_id="")
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']				= $this->ADM->identitaswebsite();
			$where_management['management_id']	= $management_id; 
		  	$data['ckeditor']				= $this->ckeditor('management_deskripsi');
			$data['management'] 			= $this->ADM->get_management('*', $where_management);
			$data['action']				= 'detail';
			$this->load->vars($data);
			$this->load->view('admin/content/website/management');
		} else {
			redirect("wp_login");
		}
	}
	
	// FASILITAS
	public function fasilitas($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']				= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']		= FALSE;
			$data['content'] 			= 'admin/content/website/fasilitas';
			$data['menu_terpilih']			= '1';
			$data['submenu_terpilih']		= '105';
			$data['action']				= (empty($filter1))?'view':$filter1;
			$data['validate']			= array('fasilitas_nama'=>'Nama Fasilitas',
												'fasilitas_deskripsi'=>'Deskripsi',
												'fasilitas_gambar'=>'Gambar');
			if ($data['action'] == 'view'){
				$data['berdasarkan']		= array('fasilitas_nama'=>'NAMA');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'fasilitas_nama';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_fasilitas[$data['cari']]	= $data['q'];
				$data['jml_data']			= $this->ADM->count_all_fasilitas('', $like_fasilitas);
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
			} elseif ($data['action'] == 'tambah'){
				$data['ckeditor'] 			= $this->ckeditor('fasilitas_deskripsi');
				$data['onload']				= 'fasilitas_nama';
				$data['fasilitas_nama']		= ($this->input->post('fasilitas_nama'))?$this->input->post('fasilitas_nama'):'';
				$data['fasilitas_deskripsi']	= ($this->input->post('fasilitas_deskripsi'))?$this->input->post('fasilitas_deskripsi'):'';
				$data['fasilitas_gambar']		= ($this->input->post('fasilitas_gambar'))?$this->input->post('fasilitas_gambar'):'';						
				$data['fasilitas_waktu']		= date("Y-m-d H:i:s");
				
				$simpan						= $this->input->post('simpan');
				if ($simpan){
					$gambar	= upload_image("fasilitas_gambar", "./assets/images/fasilitas/", "230x160");
					$data['fasilitas_gambar']	= $gambar;
					$insert['fasilitas_nama']		= $data['fasilitas_nama'];
					$insert['fasilitas_deskripsi']		= $data['fasilitas_deskripsi'];
					if ($data['fasilitas_gambar']) { $insert['fasilitas_gambar']	= $data['fasilitas_gambar']; }
					$insert['fasilitas_waktu']	= $data['fasilitas_waktu'];
					$this->ADM->insert_fasilitas($insert);
					$this->session->set_flashdata('success','Fasilitas telah berhasil ditambahkan!,');
					redirect("website/fasilitas");
				}
			} elseif ($data['action'] == 'edit'){
				$data['ckeditor'] 			= $this->ckeditor('fasilitas_deskripsi');
				$data['onload']				= 'fasilitas_nama';
				$where_fasilitas['fasilitas_id']	= $filter2; 
				$fasilitas						= $this->ADM->get_fasilitas('*', $where_fasilitas);
				$data['fasilitas_id']			= ($this->input->post('fasilitas_id'))?$this->input->post('fasilitas_id'):$fasilitas->fasilitas_id;
				$data['fasilitas_nama']		= ($this->input->post('fasilitas_nama'))?$this->input->post('fasilitas_nama'):$fasilitas->fasilitas_nama;
				$data['fasilitas_deskripsi']	= ($this->input->post('fasilitas_deskripsi'))?$this->input->post('fasilitas_deskripsi'):$fasilitas->fasilitas_deskripsi;
				$data['fasilitas_gambar']		= ($this->input->post('fasilitas_gambar'))?$this->input->post('fasilitas_gambar'):$fasilitas->fasilitas_gambar;
				$data['fasilitas_waktu']		= ($this->input->post('fasilitas_waktu'))?$this->input->post('fasilitas_waktu'):$fasilitas->fasilitas_waktu;
				$simpan						= $this->input->post('simpan');
				if ($simpan){
					$gambar	= upload_image("fasilitas_gambar", "./assets/images/fasilitas/", "230x160");
					$data['fasilitas_gambar']		= $gambar;
					$where_edit['fasilitas_id']	= $data['fasilitas_id'];
					$edit['fasilitas_nama']		= $data['fasilitas_nama'];
					$edit['fasilitas_deskripsi']	= $data['fasilitas_deskripsi'];
					if ($data['fasilitas_gambar']) { 
						$row = $this->ADM->get_fasilitas('*', $where_edit);
						@unlink('./assets/images/fasilitas/'.$row->fasilitas_gambar);
						@unlink('./assets/images/fasilitas/kecil_'.$row->fasilitas_gambar);
						$edit['fasilitas_gambar']	= $data['fasilitas_gambar']; 
					}
					$this->ADM->update_fasilitas($where_edit, $edit);
					$this->session->set_flashdata('success','Fasilitas telah berhasil diedit!,');
					redirect("website/fasilitas");
				}			
		} elseif ($data['action'] == 'hapus'){
				$where_delete['fasilitas_id'] 	= $filter2;
				$row = $this->ADM->get_fasilitas('*', $where_delete);
				@unlink('./assets/images/fasilitas/'.$row->fasilitas_gambar);
				@unlink('./assets/images/fasilitas/kecil_'.$row->fasilitas_gambar);
				$this->ADM->delete_fasilitas($where_delete);
				$this->session->set_flashdata('success','Fasilitas telah berhasil dihapus!,');
				redirect("website/fasilitas");
				
			} 
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}
	
	
	public function fasilitas_detail($fasilitas_id='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 			= $this->ADM->get_admin('',$where_admin);
			$where_fasilitas['fasilitas_id']	= $fasilitas_id; 
			$data['fasilitas'] 		= $this->ADM->get_fasilitas('*', $where_fasilitas);
			$data['action']			= 'detail';
			$this->load->vars($data);
			$this->load->view('admin/content/website/fasilitas');
		} else {
			redirect("wp_login");
		}
	}
	
  //CKEDITOR
  private function ckeditor($text) {
		return '
		<script type="text/javascript" src="'.base_url().'editor/ckeditor.js"></script>
		<script type="text/javascript">
		var editor = CKEDITOR.replace("'.$text.'",
		{
			filebrowserBrowseUrl 	  : "'.base_url().'finder/ckfinder.html",
			filebrowserImageBrowseUrl : "'.base_url().'finder/ckfinder.html?Type=Images",
			filebrowserFlashBrowseUrl : "'.base_url().'finder/ckfinder.html?Type=Flash",
			filebrowserUploadUrl 	  : "'.base_url().'finder/core/connector/php/connector.php?command=QuickUpload&type=Files",
			filebrowserImageUploadUrl : "'.base_url().'finder/core/connector/php/connector.php?command=QuickUpload&type=Images",
			filebrowserFlashUploadUrl : "'.base_url().'finder/core/connector/php/connector.php?command=QuickUpload&type=Flash",
			filebrowserWindowWidth    : 900,
			filebrowserWindowHeight   : 700,
			toolbarStartupExpanded 	  : false,
			height					  : 400	
		}
		);
	</script>';
	}
	 
}