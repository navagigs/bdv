<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

    public function __construct()
    {
    	parent::__construct();
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_config', 'CONF', TRUE);
    }

	public function index($filter1='', $filter2='', $filter3='')
	{
		$data['content']		= '/default/content/search';
		$data['body']			= 'page-sub-page page-members';
		$data['web']			= $this->ADM->identitaswebsite();
		$data['title']			= '| Pencarian';
		$data['q']						= ($this->input->post('q'))?$this->input->post('q'):'';
		$data['halaman']				= (empty($filter1))?1:$filter1;
		$data['batas']					= 6;
		$data['page']					= ($data['halaman']-1) * $data['batas'];
		$like_pencarian['berita_judul']		= $data['q'];
		$like_pencarian['berita_deskripsi']	= $data['q'];
		$data['jml_data']				= $this->ADM->count_all_pencarian('',$like_pencarian);
		$data['jml_halaman'] 			= ceil($data['jml_data']/$data['batas']);
		$data['action']					= '';
		
		$data['boxberita']		= TRUE;	
		$data['boxfakultas']	= FALSE;	
		$data['boxlayanan']		= TRUE;		
		$data['boxvideo']		= TRUE;	

		$this->load->vars($data);
		$this->load->view('default/home');
	}
	
	public function pages($filter1='', $filter2='', $filter3='')
	{	
		$data['content']		= '/default/content/search';
		$data['body']			= 'page-sub-page';
		$data['web']			= $this->ADM->identitaswebsite();
		$data['title']			= '| Pencarian';
		
		$data['halaman']		= (empty($filter1))?1:$filter1;
		$data['batas']			= 6;
		error_reporting(0);
		$where['kategori_id']	= '2';
		$data['page']			= ($data['halaman']-1) * $data['batas'];
		$data['jml_data']		= $this->ADM->count_all_berita2();
		$data['jml_halaman'] 	= ceil($data['jml_data']/$data['batas']);
		$data['action']			= '';
		$data['boxberita']		= TRUE;	
		$data['boxfakultas']	= FALSE;	
		$data['boxlayanan']		= TRUE;		
		$data['boxvideo']		= TRUE;	

		$this->load->vars($data);
		$this->load->view('default/home');
	}
	
		
}

/* End of file search.php */
/* Location: ./application/controllers/search.php */