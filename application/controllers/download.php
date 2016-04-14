<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download extends CI_Controller {

    public function __construct()
    {
    	parent::__construct();
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_config', 'CONF', TRUE);
		$this->SA =& get_instance();
    }

	public function index($filter1='', $filter2='', $filter3='')
	{
		$data['content']		= '/default/content/download';
		$data['body']			= 'page-sub-page page-members';
		$data['web']			= $this->ADM->identitaswebsite();
		$data['title']			= '| Download Center';
		
		$data['halaman']		= (empty($filter1))?1:$filter1;
		$data['batas']			= 6;
		$data['page']			= ($data['halaman']-1) * $data['batas'];
		$data['jml_data']		= $this->ADM->count_all_downloads();
		$data['jml_halaman'] 	= ceil($data['jml_data']/$data['batas']);
		$data['action']			= '';
		
		$data['boxberita']		= TRUE;	
		$data['boxfakultas']	= FALSE;	
		$data['boxlayanan']		= TRUE;		
		$data['boxvideo']		= TRUE;	

		$this->load->vars($data);
		$this->load->view('default/home');
	}
	
	
	public function pages($filter1='', $filter2='', $filter3='')
	{	
		$data['content']		= '/default/content/download';
		$data['body']			= 'page-sub-page page-members';
		$data['web']			= $this->ADM->identitaswebsite();
		$data['title']			= '| Download Center';
		
		$data['halaman']		= (empty($filter1))?1:$filter1;
		$data['batas']			= 6;
		$data['page']			= ($data['halaman']-1) * $data['batas'];
		$data['jml_data']		= $this->ADM->count_all_downloads();
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

/* End of file download.php */
/* Location: ./application/controllers/download.php */