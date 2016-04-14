<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

    public function __construct()
    {
    	parent::__construct();
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_config', 'CONF', TRUE);
    }

	public function index()
	{
		$data['content']				= '/default/content/home';
		$data['body']					= 'page-sub-page';
		$data['web']					= $this->ADM->identitaswebsite();
		$data['title']					= '| Pages';
		$data['action']			= '';
		
		$this->load->vars($data);
		$this->load->view('default/home');
	}
	
	public function registrasi()
	{
		$data['content']				= '/default/content/registrasi';
		$data['web']					= $this->ADM->identitaswebsite();
		$data['title']					= '| Registrasi';
		$data['boxright']				= TRUE;	
		$data['action']					= '';
		
		$this->load->vars($data);
		$this->load->view('default/home');
	}
	
	public function reset_password($admin_email='')
	{
		$data['content']				= '/default/content/reset_password';
		$data['web']					= $this->ADM->identitaswebsite();
		$data['title']					= '| Reset Password';
		$data['boxright']				= TRUE;	
		$data['action']					= '';
		
				$data['admin_email']			= ($this->input->post('admin_email'))?$this->input->post('admin_email'):'';
				$where['admin_email']		= $data['admin_email'];
				$jml_pengguna				= $this->ADM->count_all_admin($where);
				$kirim							= $this->input->post('kirim');
				if ($kirim	 && $jml_pengguna < 1 ){	
				$this->session->set_flashdata('error','Email tidak terdaftar".$admin_email.!,');
				} elseif ($kirim && $jml_pengguna > 0 ){
					echo '<script type="text/javascript">
						  	alert("Reset password telah dilakukan, silahkan cek email!,");
						  </script>';
      		  	$admin_email      = ($_POST['admin_email']);
            	$query = $this->db->query("SELECT admin_user FROM admin where admin_email='".$admin_email."'");;
            	$results = $query->num_rows();
				//echo $results->admin_email;
            if(count($results)>=1)
            {
                $encrypt= md5(90*13+$admin_email);
                $to=$admin_email;
                $subject="Forget Password";
                $from = "info@nava.web.id";
                 $body='Selamat Datang, <br/> <br/>mebership ID is '.$admin_email." <br><br>Click here to reset your password ".base_url().'pages/new_password?encrypt='.$encrypt.'&action=new_password <br/> <br/>--<br>nava.web.id<br>Solve your problems.';
                 $headers = "From: " . strip_tags($from) . "\r\n";
                 $headers = "Reply-To: ". strip_tags($from) . "\r\n";
                 $headers = "MIME-Version: 1.0\r\n";
                 $headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";
                
                mail($to,$subject,$body,$headers);
			}
            else
            {
					echo '<script type="text/javascript">
						  	alert("Reset password telah dilakukan, silahkan cek email!,");
						  </script>';
			}
			}
				
		$this->load->vars($data);
		$this->load->view('default/home');
	}
	
	
	public function new_password($filter1='', $filter2='', $filter3='', $encrypt='', $admin_pass='', $admin_email='')
	{
		$data['content']				= '/default/content/registrasi';
		$data['web']					= $this->ADM->identitaswebsite();
		$data['title']					= '| Reset Password';
		$data['content']				= '/default/content/reset_password';
		$data['action']					= 'new_password';
		$data['boxright']				= TRUE;
		$data['action']			= '';
		 if($_GET['action']=="new_password")
    {
        $encrypt = $_GET['encrypt'];
		
            	$query = $this->db->query("SELECT admin_email FROM admin where md5(90*13+admin_email)='".$encrypt."'");;
            	$results = $query->num_rows();
        if(count($results)>=1)
        {

        }
        else
        {
            $message = 'Invalid key please try again. <a href="http://demo.phpgang.com/login-signup-in-php/#forget">Forget Password?</a>';
        }
    }

			
				$data['admin_pass']			= ($this->input->post('admin_pass'))?$this->input->post('admin_pass'):'';
				$data['encrypt']     		=($this->input->post('action'))?$this->input->post('action'):'';
            	$query = $this->db->query("SELECT admin_email FROM admin where md5(90*13+admin_email)='".$encrypt."'");;
            	$results = $query->num_rows();
				if(count($results)>=1)
    {
				$data['admin_email']			= ($this->input->post('admin_email'))?$this->input->post('admin_email'):'';
            	$query = $this->db->query("update admin set admin_pass='".md5('admin_pass')."' where admin_email='".$admin_email."'");
					$this->session->set_flashdata('success','Password telah berhasil diganti!,');
    }
    else
    {
					$this->session->set_flashdata('error','Password tidak berhasil diganti!,');
    }

				
		$this->load->vars($data);
		$this->load->view('default/home');
	}
	
	public function sign_in()
	{
		$data['content']				= '/default/content/sign_in';
		$data['web']					= $this->ADM->identitaswebsite();
		$data['title']					= '| Sign-in';
		$data['boxright']				= TRUE;	
		$data['action']			= '';
		
		$this->load->vars($data);
		$this->load->view('default/home');
	}
	
	public function ceklogin()
	{
		$username 	= validasi_sql($this->input->post('username'));
		$password 	= validasi_sql($this->input->post('password'));
		$do			= validasi_sql($this->input->post('kirim'));
		
		$where_login['admin_user']	= $username;
		$where_login['admin_pass']	= do_hash($password, 'md5');
		$where_login['admin_level_kode']	= '5';
		
		if ($do && $this->cek_login($where_login) === TRUE){
			redirect("pages/profil/".$this->session->userdata('admin_user'));	
		} else {
			$this->session->set_flashdata('error','Username atau Password tidak Cocok!,');
			redirect("pages/sign_in");
		}
	}
	
	public function logout(){
		$this->remov_session();
		redirect("home");
	}
	
	function cek_login($where){
        $data = "";
		$this->db->select("*");
        $this->db->from("admin");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
			$this->set_session($data);
			//$this->update_log($data);
			return true;
		}
		return false;
	}

	function set_session(&$data){
		$session = array(
				'admin_user'	=> $data->admin_user,
				'admin_nama'	=> $data->admin_nama,
				'admin_alamat'	=> $data->admin_alamat,
				'admin_email'	=> $data->admin_email,
				'admin_telepon'	=> $data->admin_telepon,
                'admin_level'   => $data->admin_level_kode,
			//	'desakelurahan_kode'  => $data->desakelurahan_kode,
                'logged_in' 	=> TRUE
               );
		$this->session->set_userdata($session);	
	}
	
	function update_log(&$data){
		$where['admin_user'] = $data->admin_user;
		$data['admin_ip']	 = $_SERVER['REMOTE_ADDR'];
		$data['admin_online']= time();
		$this->db->update('admin',$data,$where);
	}
	
	function remov_session(){
		$session = array(
				'admin_user'  	=> '',
                'admin_level'   => '',
                'logged_in' 	=> FALSE
               );
		$this->session->unset_userdata($session);	
	}

	
	public function input_reg()
	{
		$data['admin_user']				= ($this->input->post('admin_user'))?$this->input->post('admin_user'):'';
		$data['admin_pass']				= ($this->input->post('admin_pass'))?$this->input->post('admin_pass'):'';
		$data['admin_nama']				= ($this->input->post('admin_nama'))?$this->input->post('admin_nama'):'';	
		$data['admin_alamat']			= ($this->input->post('admin_alamat'))?$this->input->post('admin_alamat'):'';
		$data['admin_email']			= ($this->input->post('admin_email'))?$this->input->post('admin_email'):'';		
		$data['admin_telepon']			= ($this->input->post('admin_telepon'))?$this->input->post('admin_telepon'):'';
		$data['admin_level_kode']		='5';
		$kirim							= $this->input->post('kirim');
		if ($kirim) {
			$insert['admin_user'] 			= $data['admin_user'];
			$insert['admin_pass']			= do_hash(($data['admin_pass']), 'md5');
			$insert['admin_nama'] 			= $data['admin_nama'];
			$insert['admin_alamat'] 		= $data['admin_alamat'];
			$insert['admin_email'] 			= $data['admin_email'];
			$insert['admin_telepon'] 		= $data['admin_telepon'];
			$insert['admin_level_kode'] 	= $data['admin_level_kode'];		
			$insert['admin_status']			= validasi_sql('A');
			$this->ADM->insert_admin($insert);
			$this->session->set_flashdata('success','Registrasi telah berhasil!,');
			redirect("pages/registrasi");
		} else {
			$this->session->set_flashdata('error','Registrasi tidak berhasil!,');
			redirect("pages/registrasi");
		}
	}
	
	public function profil($filter1='', $filter2='', $filter3='', $admin_user='')
	{
		 if ($this->session->userdata('logged_in') == TRUE) {
		
		$data['content']				= '/default/content/registrasi';
		$data['web']					= $this->ADM->identitaswebsite();
		$where_admin['admin_user']		= $this->session->userdata('admin_user');
		$admin							= $this->ADM->get_admin('*', $where_admin);
				$data['admin_user']				= ($this->input->post('admin_user'))?$this->input->post('admin_user'):$admin->admin_user;
				$data['admin_nama']				= ($this->input->post('admin_nama'))?$this->input->post('admin_nama'):$admin->admin_nama;
				$data['admin_pass']				= ($this->input->post('admin_pass'))?$this->input->post('admin_pass'):$admin->admin_pass;				
				$data['admin_alamat']			= ($this->input->post('admin_alamat'))?$this->input->post('admin_alamat'):$admin->admin_alamat;				
				$data['admin_email']			= ($this->input->post('admin_email'))?$this->input->post('admin_email'):$admin->admin_email;			
				$data['admin_telepon']			= ($this->input->post('admin_telepon'))?$this->input->post('admin_telepon'):$admin->admin_telepon;					
				$data['admin_level_kode']		= ($this->input->post('admin_level_kode'))?$this->input->post('admin_level_kode'):$admin->admin_level_kode;	
				
		$row = $this->ADM->get_admin('*', $where_admin);
		$data['title']					= '| Profil '.$this->session->userdata('admin_nama');
		$data['boxright']				= TRUE;	
		$data['action']					= 'profil';
		
		$this->load->vars($data);
		$this->load->view('default/home');
	} else {
			redirect("home");
		
	}
	}
	
	public function update_profil($filter1='', $filter2='', $filter3='')
	{
		
		 if ($this->session->userdata('logged_in') == TRUE) {
		
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
				$where_admin['admin_user']		= $filter2; 
				$admin							= $this->ADM->get_admin('*', $where_admin);
				$data['admin_user']				= ($this->input->post('admin_user'))?$this->input->post('admin_user'):$admin->admin_user;
				$data['admin_pass']				= ($this->input->post('admin_pass'))?$this->input->post('admin_pass'):$admin->admin_pass;				
				$data['admin_alamat']			= ($this->input->post('admin_alamat'))?$this->input->post('admin_alamat'):$admin->admin_alamat;				
				$data['admin_email']			= ($this->input->post('admin_email'))?$this->input->post('admin_email'):$admin->admin_email;			
				$data['admin_telepon']			= ($this->input->post('admin_telepon'))?$this->input->post('admin_telepon'):$admin->admin_telepon;				
			
				$simpan							= $this->input->post('simpan');
				if ($simpan){
					$where_edit['admin_user']	= $data['admin_user'];
					if ($data['admin_pass'] <> '') {						
					$edit['admin_pass']			= do_hash(($data['admin_pass']), 'md5'); }
					$edit['admin_alamat']		= $data['admin_alamat'];
					$edit['admin_email']		= $data['admin_email'];
					$edit['admin_telepon']		= $data['admin_telepon'];					
					$this->ADM->update_admin($where_edit, $edit);
					$this->session->set_flashdata('success','Profil telah berhasil diupdate!,');
						redirect("pages/profil/".$this->session->userdata('admin_user'));
				}
		
		$this->load->vars($data);
		$this->load->view('default/home');
	}
	else {
			redirect("home");
	}
		
	}
	
	
}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */