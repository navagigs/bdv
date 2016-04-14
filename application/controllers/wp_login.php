<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wp_login extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_login', 'LOG', TRUE);
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_config', 'CONF', TRUE);
	}
	
	public function index()
	{
		$data['web']					= $this->ADM->identitaswebsite();
		$data['captcahImage'] 	= $this->makeCaptcha();
		$this->load->vars($data);
		$this->load->view('admin/login');
	}
	
	public function ceklogin()
	{
		$username		= validasi_sql($this->input->post('username'));
		$password		= validasi_sql($this->input->post('password'));
		$do				= validasi_sql($this->input->post('masuk'));
		
		$where_login['admin_user']	= $username;
		$where_login['admin_pass']	= do_hash($password, 'md5');
		
		date_default_timezone_set('Asia/Jakarta');
		$exp=time()-7200;
		$q="DELETE FROM captcha WHERE captcha_time < ".$exp."";
		$this->db->query($q);
		$sql="SELECT COUNT(*) as count FROM captcha WHERE word=? AND ip_address=? AND captcha_time > ?";
		$datacap=array($_POST['captcha'],$_SERVER['REMOTE_ADDR'],$exp);
		$query=$this->db->query($sql,$datacap);
		$row=$query->row();
		
		if ($row->count != 0 && $do && $this->LOG->cek_login($where_login) === TRUE){
			redirect("admin/");
		} else {
			?>
            <script>alert('Usename, Captcha dan Password tidak cocok!');top.window.location="<?php echo site_url();?>wp_login/keluar";</script>
            <?php
		}
		
	}
	
	public function keluar()
	{
		$this->LOG->remov_session();
		redirect("wp_login");
	}
	
	public function makeCaptcha()
	{
		$this->load->helper('captcha');
		$alpha 	= '1234567890';
		$acak 	= str_shuffle($alpha);
		$acak	= substr($acak,0,4);
		$nilai	= array (
						'word' =>$acak,
						'img_path' =>'./captcha/',
						'img_url' =>base_url().'captcha/',
						'font_path' =>'./system/fonts/texb.ttf',
						'img_width' => '100',
						'img_height' =>38,
						'expiration' =>7200
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
		return $captcha['image'];
	}
		
}