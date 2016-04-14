<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {

    public function __construct()
    {
    	parent::__construct();
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_config', 'CONF', TRUE);
		$this->SA =& get_instance();
    }

	public function index($filter1='', $filter2='', $filter3='')
	{
		$data['content']		= '/default/content/news';
		$data['body']			= 'page-sub-page';
		$data['web']			= $this->ADM->identitaswebsite();
		$data['title']			= '| News';
		
		$data['halaman']		= (empty($filter1))?1:$filter1;
		$data['batas']			= 5;
		$data['page']			= ($data['halaman']-1) * $data['batas'];
		$data['jml_data']		= $this->ADM->count_all_berita();
		$data['jml_halaman'] 	= ceil($data['jml_data']/$data['batas']);
		$data['action']			= 'news';
		$data['boxright']		= TRUE;	

		$this->load->vars($data);
		$this->load->view('default/home');
	}
	
	
	
	public function pages($filter1='', $filter2='', $filter3='')
	{	
		$data['content']		= '/default/content/news';
	//	$data['body']			= 'page-sub-page';
		$data['title']			= '| News';
		$data['web']			= $this->ADM->identitaswebsite();
		
		$data['halaman']		= (empty($filter1))?1:$filter1;
		$data['batas']			= 5;
		$data['page']			= ($data['halaman']-1) * $data['batas'];
		$data['jml_data']		= $this->ADM->count_all_berita();
		$data['jml_halaman'] 	= ceil($data['jml_data']/$data['batas']);
		$data['action']			= '';
		$data['boxright']		= TRUE;	

		$this->load->vars($data);
		$this->load->view('default/home');
	}
	
	public function read($berita_id='', $filter2='', $berita_judul='')
	{
		$data['content']		= '/default/content/news';
	//	$data['body']			= 'page-sub-page page-blog-detail';
		$data['web']			= $this->ADM->identitaswebsite();
	
	
		$data['captcahImage']	= $this->creatCaptcha();
		$data['validate']		= array('komentar_deskripsi' => 'Deskripsi');
		$where_komentar['k.berita_id']	= $berita_id;
		//$where_komentar['k.komentar_status']	=	'Y';
		$data['halaman']		= (empty($filter2))?1:$filter2;
		$data['batas']			= 6;
		$data['page']			= ($data['halaman']-1) * $data['batas'];
		$data['jml_data']		= $this->ADM->count_all_komentar($where_komentar,'');
		$data['jml_halaman'] 	= ceil($data['jml_data']/$data['batas']);
		$data['action']			= '';
		
		$data['berita_id']				= $berita_id;
		$where_berita['b.berita_id']	= $data['berita_id'];
		$data['berita'] 				= $this->ADM->get_berita('*', $where_berita);
		$row = $this->ADM->get_berita('*', $where_berita);
		$data['title']					= 'Berita > ' .$row->berita_judul;
		$data['action']					= 'detail';
		
		$data['boxright']		= TRUE;	
		
		
		$this->ADM->update_hits_berita($berita_id);
		$this->load->vars($data);
		$this->load->view('default/home');
	}
	
	public function creatCaptcha()
	{
		$this->load->helper('captcha');
		$alpha='1234567890';
		$acak= str_shuffle($alpha);
		$acak=substr($acak,0,4);
		$nilai=array(
					'word'=>$acak,
					'img_path'=>'./captcha/',
					'img_url'=>base_url().'captcha/',
					'font_path'=>'./system/fonts/texb.ttf',
					'img_width'=>'120',
					'img_height'=>35,
					'expiration'=>7200
					);
		$captcha=create_captcha($nilai);
		$data=array(
			'captcha_id'=>'',
			'captcha_time'=>$captcha['time'],
			'ip_address'=>$_SERVER['REMOTE_ADDR'],
			'word'=>$captcha['word']
		);
		$query=$this->db->insert_string('captcha',$data);
		$this->db->query($query);
		//if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') echo $captcha['image'];
		//else 
		return $captcha['image'];
	}
	
	public function komentar()	
	{
		$data['content']		= '/default/content/news';
		$data['web']			= $this->ADM->identitaswebsite();
		
		
		date_default_timezone_set('Asia/Jakarta');//
//		$exp=time()-7200;
//		$q="DELETE FROM captcha WHERE captcha_time < ".$exp."";
//		$this->db->query($q);
//		$sql="SELECT COUNT(*) as count FROM captcha WHERE word=? AND ip_address=? AND captcha_time > ?";
//		$datacap=array($_POST['captcha'],$_SERVER['REMOTE_ADDR'],$exp);
//		$query=$this->db->query($sql,$datacap);
//		$row=$query->row();
//		if ($row->count != 0){
			$data['komentar_nama']	= $this->session->userdata('admin_nama');	
			$data['komentar_deskripsi']	= ($this->input->post('komentar_deskripsi'))?$this->input->post('komentar_deskripsi'):'';
			$data['komentar_waktu']		= date("Y-m-d H:i:s");
			$data['berita_id']			= ($this->input->post('berita_id'))?$this->input->post('berita_id'):'';
			$simpan						= $this->input->post('simpan');
			if ($simpan){
				$insert['komentar_nama']	= $this->session->userdata('admin_nama');
				$insert['komentar_deskripsi']	= $data['komentar_deskripsi'];
				$insert['komentar_waktu']		= validasi_sql($data['komentar_waktu']);
				$insert['berita_id']			= validasi_sql($data['berita_id']);
				$this->ADM->insert_komentar($insert);
				$this->session->set_flashdata('success','Terimakasih, komentar telah diposting!,');
				redirect("news/read/".$data['berita_id']);
			//}
		} else 
		{
			$this->session->set_flashdata('error','Tidak Bisa Mengirim komentar!,');
			redirect("news/read/".$this->input->post('berita_id'));
		}
	}
	
	public function tags($tag_id='', $filter2='', $filter3='')	
	{
		
		$data['content']		= '/default/content/news';
		$data['body']			= 'page-sub-page page-blog-detail';
		$data['web']			= $this->ADM->identitaswebsite();
		$data['title']			= 'Tags';
		
		$data['tags']			= (empty($tag_id))?'':$tag_id;
		$where_tags['tags']		= $data['tags'];
		$where 					= (empty($data['tags']))?'': $where_tags;
		
		$data['halaman']		= (empty($filter2))?1:$filter2;
		$data['batas']			= 5;
		$data['page']			= ($data['halaman']-1) * $data['batas'];
		$data['jml_data']		= $this->ADM->count_all_berita('',$where);
		$data['jml_halaman'] 	= ceil($data['jml_data']/$data['batas']);
		$data['action']			= '';
		
		$data['boxright']		= TRUE;	
		
		$this->load->vars($data);
		$this->load->view('default/home');
	}
}

/* End of file news.php */
/* Location: ./application/controllers/news.php */