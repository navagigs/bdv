<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends CI_Controller {

    public function __construct()
    {
    	parent::__construct();
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_config', 'CONF', TRUE);
    }

	public function index($filter1='', $filter2='', $filter3='')
	{
		$data['body']			= 'page-sub-page';
		$data['web']			= $this->ADM->identitaswebsite();
		$data['content']		= '/default/content/events';
		$data['title']			= '| Events';
		$data['boxright']		= TRUE;			
		$data['halaman']		= (empty($filter1))?1:$filter1;
		$data['batas']			= 5;
		$data['page']			= ($data['halaman']-1) * $data['batas'];
		$data['jml_data']		= $this->ADM->count_all_agenda('','');
		$data['jml_halaman'] 	= ceil($data['jml_data']/$data['batas']);
		$data['action']			= '';

		$this->load->vars($data);
		$this->load->view('default/home');
	}
	
	
	public function read($agenda_id='', $agenda_tema='')
	{
		
		$data['body']					= 'page-sub-page page-member-detail';
		$data['web']					= $this->ADM->identitaswebsite();
		$data['content']				= '/default/content/events';
		$where_agenda['agenda_id']		= $agenda_id; 
		$data['agenda'] 				= $this->ADM->get_agenda('*', $where_agenda);
		
		$row = $this->ADM->get_agenda('*', $where_agenda);
		$data['title']					= '| Events > ' .$row->agenda_tema;
		$data['action']					= 'detail';
		
		$data['boxright']		= TRUE;	
		$this->load->vars($data);
		$this->load->view('default/home');
	}	
	
	public function join_events()	
	{
		 if ($this->session->userdata('logged_in') == TRUE) {
		$data['content']		= '/default/content/events';
		$data['web']			= $this->ADM->identitaswebsite();		
			date_default_timezone_set('Asia/Jakarta');
			$data['join_nama']			= $this->session->userdata('admin_nama');	
			$data['join_waktu']			= date("Y-m-d H:i:s");
			$data['agenda_id']			= ($this->input->post('agenda_id'))?$this->input->post('agenda_id'):'';
			$where['join_nama']		= $this->session->userdata('admin_nama');	
			$where['agenda_id']			= $data['agenda_id'];
			$jml_pengguna				= $this->ADM->count_all_join_event2($where);
			$kirim					= $this->input->post('kirim');
			if ($kirim && $jml_pengguna < 1){
				$insert['join_nama']	= $this->session->userdata('admin_nama');
				$insert['join_waktu']	= validasi_sql($data['join_waktu']);
				$insert['agenda_id']	= validasi_sql($data['agenda_id']);
				$this->ADM->insert_join_event($insert);
				$this->session->set_flashdata('success','Terimakasih, Anda telah mengikuti events ini!,');
				redirect("events/read/".$data['agenda_id']);
			} elseif ($kirim && $jml_pengguna > 0 ){
			$this->session->set_flashdata('error','Anda telah mengikuti events ini!,');
			redirect("events/read/".$this->input->post('agenda_id'));
		} else 	{
			$this->session->set_flashdata('error','Tidak bisa mengikuti events !,');
			redirect("events/read/".$this->input->post('agenda_id'));
		} 
	} else {
					echo '<script>window.alert("Untuk mengikuti events ini silahkan Login");
        window.location=("../pages/sign_in")</script>';
 }
}
	

}

/* End of file events.php */
/* Location: ./application/controllers/events.php */