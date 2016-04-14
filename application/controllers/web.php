<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Web extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_config', 'CONF', TRUE);
	}
	
	public function index()
	{
		$data['tanggal']	= date("Y-m-d");
		$data['time']		= time();
		$data['ip']			= $_SERVER['REMOTE_ADDR'];
		$data['content_left']	= 'default/web';
		$this->load->vars($data);
		$this->load->view('default/web');
	}
	 
	
	 public function web ($filter1='', $filter2='', $filter3='')
	 {
		 if($this->session->userdata('logged_in') == TRUE) {
			$where_admin['admin_user']		= $this->session->userdata('admin_user');
			$data['admin']					= $this->ADM->get_admin('',$where_admin);
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']			= FALSE;
			$data['content']				= 'admin/content/data/lihat_ijazah';
			$data['menu_terpilih']			= '1';
			$data['submenu_terpilih']		= '9';
			$data['action']					= (empty($filter1))?'view':$filter1;
			$data['validate']				= array('ijazah_prodi' => 'Program Studi',
													'ijazah_sekolah' => 'Sekolah',
													'ijazah_nama' => 'Nama',
													'ijazah_tempat' => 'Tempat Lahir',
													'ijazah_tglahir' => 'Tanggal Lahir',
													'ijazah_ortu' => 'Nama Orang tua/wali',
													'ijazah_nisn' => 'Nomor Induk Siswa Nasional',
													'ijazah_npun' => 'Nomor Peserta Ujian Nasional',
													'tahun_id'  => 'Tahun Ijazah');
			if($data['action']	== 'view') {
			   $data['berdasarkan']			= array('ijazah_prodi'=>'Program Studi', 'ijazah_nama'=>'Nama', 'ijazah_nomor'=>'Nomor Ijazah', 'tahun_ijazah'=>'Tahun Lulus');
			   $data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'ijazah_prodi';
			   $data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
			   $data['halaman']				= (empty($filter2))?1:$filter2;
			   $data['batas']				= 20;
			   $data['page']				= ($data['halaman']-1) * $data['batas'];
			   $like_ijazah[$data['cari']]	= $data['q'];
			   $data['jml_data']			= $this->ADM->count_all_ijazah('', $like_ijazah);
			   $data['jml_halaman']				= ceil ($data['jml_data']/$data['batas']);
			} elseif ($data['action']	== 'tambah') {
				$data['onload']				= 'ijazah_prodi';
				$data['ijazah_id']			= ($this->input->post('ijazah_id'))?$this->input->post('ijazah_id'):'';
				$data['ijazah_prodi']		= ($this->input->post('ijazah_prodi'))?$this->input->post('ijazah_prodi'):'';
				$data['ijazah_sekolah']		= ($this->input->post('ijazah_sekolah'))?$this->input->post('ijazah_sekolah'):'';
				$data['ijazah_nama']		= ($this->input->post('ijazah_nama'))?$this->input->post('ijazah_nama'):'';
				$data['ijazah_tempat']		= ($this->input->post('ijazah_tempat'))?$this->input->post('ijazah_tempat'):'';
				$data['ijazah_tglahir']		= ($this->input->post('ijazah_tglahir'))?$this->input->post('ijazah_tglahir'):'';
				$data['ijazah_ortu']		= ($this->input->post('ijazah_ortu'))?$this->input->post('ijazah_ortu'):'';
				$data['ijazah_nisn']		= ($this->input->post('ijazah_nisn'))?$this->input->post('ijazah_nisn'):'';
				$data['ijazah_npun']		= ($this->input->post('ijazah_npun'))?$this->input->post('ijazah_npun'):'';
				$data['ijazah_nomor']		= ($this->input->post('ijazah_nomor'))?$this->input->post('ijazah_nomor'):'';
				$data['ijazah_post']		= date("Y-m-d H:i:s");
				$data['ijazah_foto']		= ($this->input->post('ijazah_foto'))?$this->input->post('ijazah_foto'):'';
				$data['tahun_id']			= ($this->input->post('tahun_id'))?$this->input->post('tahun_id'):'';
				$simpan						= $this->input->post('simpan');
					if ($simpan) {
					$gambar = upload_image("ijazah_foto", "./assets/images/ijazah/", "230x160", seo($data['ijazah_nama']));
					$data['ijazah_foto']		 = $gambar;
					$insert['ijazah_prodi']		 = validasi_sql($data['ijazah_prodi']);
					$insert['ijazah_sekolah']	 = validasi_sql($data['ijazah_sekolah']);
					$insert['ijazah_nama']		 = validasi_sql($data['ijazah_nama']);
					$insert['ijazah_tempat']	 = validasi_sql($data['ijazah_tempat']);
					$insert['ijazah_tglahir']	 = validasi_sql($data['ijazah_tglahir']);
					$insert['ijazah_ortu']	 	 = validasi_sql($data['ijazah_ortu']);
					$insert['ijazah_nisn']		 = validasi_sql($data['ijazah_nisn']);
					$insert['ijazah_npun']		 = validasi_sql($data['ijazah_npun']);
					$insert['ijazah_nomor']		 = validasi_sql($data['ijazah_nomor']);
					if ($data['ijazah_foto']) { $insert['ijazah_foto'] = validasi_sql($data['ijazah_foto']); }
					$insert['ijazah_post']		 = validasi_sql($data['ijazah_post']);
					$insert['tahun_id']		 	 = validasi_sql($data['tahun_id']);
					$this->ADM->insert_ijazah($insert);
					$this->session->set_flashdata('success','Data telah berhasil ditambahkan!,');
					redirect("default/web");
				}
			} elseif ($data['action']	== 'edit') {
				$data['onload']				= 'ijazah_nama';
				$where_ijazah['ijazah_id']	= validasi_sql($filter2);
				$ijazah 					= $this->ADM->get_ijazah('*', $where_ijazah);
				$data['ijazah_id']			= ($this->input->post('ijazah_id'))?$this->input->post('ijazah_id'):$ijazah->ijazah_id;
				$data['ijazah_prodi']		= ($this->input->post('ijazah_prodi'))?$this->input->post('ijazah_prodi'):$ijazah->ijazah_prodi;
				$data['ijazah_sekolah']		= ($this->input->post('ijazah_sekolah'))?$this->input->post('ijazah_sekolah'):$ijazah->ijazah_sekolah;
				$data['ijazah_nama']		= ($this->input->post('ijazah_nama'))?$this->input->post('ijazah_nama'):$ijazah->ijazah_nama;
				$data['ijazah_tempat']		= ($this->input->post('ijazah_tempat'))?$this->input->post('ijazah_tempat'):$ijazah->ijazah_tempat;
				$data['ijazah_tglahir']		= ($this->input->post('ijazah_tglahir'))?$this->input->post('ijazah_tglahir'):$ijazah->ijazah_tglahir;
				$data['ijazah_ortu']		= ($this->input->post('ijazah_ortu'))?$this->input->post('ijazah_ortu'):$ijazah->ijazah_ortu;
				$data['ijazah_nisn']		= ($this->input->post('ijazah_nisn'))?$this->input->post('ijazah_nisn'):$ijazah->ijazah_nisn;
				$data['ijazah_npun']		= ($this->input->post('ijazah_npun'))?$this->input->post('ijazah_npun'):$ijazah->ijazah_npun;
				$data['ijazah_nomor']		= ($this->input->post('ijazah_nomor'))?$this->input->post('ijazah_nomor'):$ijazah->ijazah_nomor;
				$data['ijazah_post']		= ($this->input->post('ijazah_post'))?$this->input->post('ijazah_post'):$ijazah->ijazah_post;
				$data['ijazah_foto']		= ($this->input->post('ijazah_foto'))?$this->input->post('ijazah_foto'):$ijazah->ijazah_foto;
				$data['tahun_id']			= ($this->input->post('tahun_id'))?$this->input->post('tahun_id'):$ijazah->tahun_id;	
				$simpan						= $this->input->post('simpan');
				if ($simpan) {
					$gambar = upload_image("ijazah_foto", "./assets/images/ijazah/", "230x160", seo($data['ijazah_nama']));
					$data['ijazah_foto']		 = $gambar;
					$where_edit['ijazah_id']	 = validasi_sql($data['ijazah_id']);		
					$edit['ijazah_prodi']		 = validasi_sql($data['ijazah_prodi']);
					$edit['ijazah_sekolah']		 = validasi_sql($data['ijazah_sekolah']);
					$edit['ijazah_nama']		 = validasi_sql($data['ijazah_nama']);
					$edit['ijazah_tempat']		 = validasi_sql($data['ijazah_tempat']);
					$edit['ijazah_tglahir']	 	 = validasi_sql($data['ijazah_tglahir']);
					$edit['ijazah_ortu']	 	 = validasi_sql($data['ijazah_ortu']);
					$edit['ijazah_nisn']		 = validasi_sql($data['ijazah_nisn']);
					$edit['ijazah_npun']		 = validasi_sql($data['ijazah_npun']);
					$edit['ijazah_nomor']		 = validasi_sql($data['ijazah_nomor']);
					if ($data['ijazah_foto']) {
						$row = $this->ADM->get_ijazah('*', $where_edit);
						@unlink('./assets/images/ijazah/'.$row->ijazah_foto);
						@unlink('./assets/images/ijazah/kecil_'.$row->ijazah_foto);
						$edit['ijazah_foto']	= $data['ijazah_foto']; 
					}
					$edit['tahun_id']		= validasi_sql($data['tahun_id']);
					$this->ADM->update_ijazah($where_edit, $edit);
					$this->session->set_flashdata('success','Data telah berhasil diubah!,');
					redirect('data/lihat_ijazah');					
			}
		 } elseif ($data['action']	== 'hapus') {
			 $where['ijazah_id']	= validasi_sql($filter2);
			 $row = $this->ADM->get_ijazah('*', $where);
			 @unlink ('./assets/images/ijazah/'.$row->ijazah_foto);
			 @unlink ('./assets/images/ijazah/kecil_'.$row->ijazah_foto);
			 $this->ADM->delete_ijazah($where);
			 $this->session->set_flashdata('success','Data telah berhasil dihapus!,');
			 redirect("data/lihat_ijazah");
	 }
	 $this->load->vars($data);
	 $this->load->view('admin/home');
	} else {
		redirect('login');
	}
  }
  
  public function ijazah_detail($ijazah_id='')
  {
	  if($this->session->userdata('logged_in') == TRUE) {
		  $where_admin['admin_user']	= $this->session->userdata('admin_user');
		  $data['admin']				= $this->ADM->get_admin('', $where_admin);
		  $where_ijazah['ijazah_id']	= validasi_sql($ijazah_id);
		  $data['ijazah']				= $this->ADM->get_ijazah('*', $where_ijazah);
		  $data['action']				= 'detail';
		  $this->load->vars($data);
		  $this->load->view('admin/content/data/lihat_ijazah');
	  } else {
		  redirect('login');
	  }
  }
  
  public function print_ijazah($ijazah_id='')
  {
	  if($this->session->userdata('logged_in') == TRUE) {
		  $where_admin['admin_user']	= $this->session->userdata('admin_user');
		  $data['admin']				= $this->ADM->get_admin('', $where_admin);
		  $where_ijazah['ijazah_id']	= validasi_sql($ijazah_id);
		  $data['ijazah']				= $this->ADM->get_ijazah('*', $where_ijazah);
		  $data['action']				= 'detail';
		  $this->load->vars($data);
		  $this->load->view('admin/content/data/print_ijazah');
	  } else {
		  redirect('login');
	  }
  }
  
	// FUNGSI tahun
	public function tahun($filter1='', $filter2='', $filter3='')
	{
			$data['action']				= (empty($filter1))?'view':$filter1;
			$data['validate']			= array('tahun_ijazah'=>'TAHUN');
			if ($data['action'] == 'view'){
				$data['berdasarkan']	= array('tahun_ijazah'=>'TAHUN');
				$data['cari']			= ($this->input->post('cari'))?$this->input->post('cari'):'tahun_ijazah';
				$data['q']				= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']		= (empty($filter2))?1:$filter2;
				$data['batas']			= 20;
				$data['page']			= ($data['halaman']-1) * $data['batas'];
				$like_ijazah[$data['cari']]	= $data['q'];
				$data['jml_data']		= $this->ADM->count_all_tahun('', $like_ijazah);
				$data['jml_halaman'] 	= ceil($data['jml_data']/$data['batas']);
			} elseif ($data['action'] == 'tambah'){
				$data['onload']			= 'tahun_ijazah';
				$data['tahun_ijazah']	= ($this->input->post('tahun_ijazah'))?$this->input->post('tahun_ijazah'):'';
				$simpan					= $this->input->post('simpan');
				if ($simpan){
					$insert['tahun_ijazah']	= validasi_sql($data['tahun_ijazah']);					
					$this->ADM->insert_tahun($insert);
					$this->session->set_flashdata('success','Data telah berhasil ditambahkan!,');
					redirect("default/web");
				}
			} elseif ($data['action'] == 'edit'){
				$data['onload']			= 'tahun_ijazah';
				$where_tahun['tahun_id']= $filter2; 
				$tahun					= $this->ADM->get_tahun('', $where_tahun);
				$data['tahun_id']		= ($this->input->post('tahun_id'))?$this->input->post('tahun_id'):$tahun->tahun_id;
				$data['tahun_ijazah']	= ($this->input->post('tahun_ijazah'))?$this->input->post('tahun_ijazah'):$tahun->tahun_ijazah;				
				$simpan					= $this->input->post('simpan');
				if ($simpan){
					$where_edit['tahun_id']	= validasi_sql($data['tahun_id']);
					$edit['tahun_ijazah']		= validasi_sql($data['tahun_ijazah']);					
					$this->ADM->update_tahun($where_edit, $edit);
					$this->session->set_flashdata('success','Data telah berhasil diubah!,');
					redirect("default/web");
				}
			} elseif ($data['action'] == 'hapus'){
				$where_delete['tahun_id'] = validasi_sql($filter2);
				$this->ADM->delete_tahun($where_delete);
				$this->session->set_flashdata('success','Data telah berhasil dihapus!,');
				redirect("default/web");
			}
			$this->load->vars($data);
			$this->load->view('default/web');
	}
	
	public function tahun_detail($tahun_id='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$where_tahun['tahun_id']	= validasi_sql($tahun_id); 
			$data['tahun'] 			= $this->ADM->get_tahun('', $where_tahun);
			$data['action']				= 'detail';
			$this->load->vars($data);
			$this->load->view('admin/content/data/tahun');
		} else {
			redirect("default/web");
		}
	}
	
}