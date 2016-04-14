<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
    	parent::__construct();
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_config', 'CONF', TRUE);
    }

	public function index()
	{
		$data['body']				= 'page-homepage-carousel';
		$data['title']					= '';
		$where_statis['statis_id']		= 13;
		$data['web']					= $this->ADM->identitaswebsite();
						
		$data['content']		= '/default/content/home';
		$data['navigasi']		= '/default/box/navigasi';		
		$data['boxiklan']		= '/default/boxmenu/boxiklan';
		$this->load->vars($data);
		$this->load->view('default/home');
		
	}
	
	
	public function twitter() {
	  echo '<script charset="utf-8" src="'.base_url().'templates/default/js/widget-twitter.js"></script>
			<script>
			new TWTR.Widget({
			  version: 2,
			  type: "profile",
			  rpp: 40,
			  interval: 3000,
			  width: 275,
			  height: 110,
			  theme: {
				shell: {
				  background: "#1469b3",
				  color: "#ffffff"
				},
				tweets: {
				  background: "#0d2652",
				  color: "#ffffff",
				  links: "#4aed05"
				}
			  },
			  features: {
				scrollbar: false,
				loop: true,
				live: true,
				hashtags: true,
				timestamp: true,
				avatars: true,
				behavior: "default"
			  }
			}).render().setUser("bptkit").start();
			</script>';
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */