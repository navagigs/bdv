<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Courses extends CI_Controller {

    public function __construct()
    {
    	parent::__construct();
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_config', 'CONF', TRUE);
		$this->SA =& get_instance();
    }

	public function index($filter1='', $filter2='', $filter3='')
	{
		if($this->session->userdata('logged_in') == TRUE) {
		$data['content']		= '/default/content/courses';
		$data['web']			= $this->ADM->identitaswebsite();
		$data['title']			= '| Courses';
		
		$data['halaman']		= (empty($filter1))?1:$filter1;
		$data['batas']			= 6;
		$data['page']			= ($data['halaman']-1) * $data['batas'];
		$data['jml_data']		= $this->ADM->count_all_galeri_video();
		$data['jml_halaman'] 	= ceil($data['jml_data']/$data['batas']);
		$data['action']			= '';
		
		$data['boxright']		= TRUE;	

		$this->load->vars($data);
		$this->load->view('default/home');
		}else {
			redirect("pages/sign_in");
		}
	}
	
	public function read($video_id='', $video_judul='')
	{
		if($this->session->userdata('logged_in') == TRUE) {
		
		$data['web']					= $this->ADM->identitaswebsite();
		$data['content']				= '/default/content/courses';
		$where_video['video_id']		= $video_id; 
		$data['video'] 					= $this->ADM->get_galeri_video('*', $where_video);
		
		$row = $this->ADM->get_galeri_video('*', $where_video);
		$data['title']					= '| Courses > ' .$row->video_judul;
		$data['action']					= 'detail';
		
		$data['action']					= 'detail';
		$data['boxright']		= TRUE;		
		$this->load->vars($data);
		$this->load->view('default/home');
		}else {
			redirect("pages/sign_in");
		}
	}	
	
	public function pages($filter1='', $filter2='', $filter3='')
	{	
		if($this->session->userdata('logged_in') == TRUE) {
		$data['content']		= '/default/content/courses';
		$data['web']			= $this->ADM->identitaswebsite();
		$data['title']			= '| Courses';
		
		$data['halaman']		= (empty($filter1))?1:$filter1;
		$data['batas']			= 5;
		$data['page']			= ($data['halaman']-1) * $data['batas'];
		$data['jml_data']		= $this->ADM->count_all_galeri_video();
		$data['jml_halaman'] 	= ceil($data['jml_data']/$data['batas']);
		$data['action']			= '';
		$data['boxright']		= TRUE;	

		$this->load->vars($data);
		$this->load->view('default/home');
		}else {
			redirect("pages/sign_in");
		}
	}
	
	
}

/* End of file courses.php */
/* Location: ./application/controllers/courses.php */