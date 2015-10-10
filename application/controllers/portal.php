<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* Main controller for the portal project
	*/
	class Portal extends CI_Controller{

		function __construct()
		{
			parent::__construct();
			if (! $this->session->userdata('logged_in')) {
				$allowed = array(
					'index',
					'news',
					'mycalendar',
					'pages'
				);
				$data['loggedIn'] = array(
					'/users/login'		=>	'Ulogujte se',
					'/users/register'	=>	'Registrujte novi nalog'
				);
				if (! in_array($this->router->fetch_method(), $allowed)) {
					redirect(base_url().'users/login');
				}
			}
			else{
				$data['loggedIn'] = array(
					'/users/members'	=>	$this->session->userdata('username')
				);
			}
		}

		/*if ($this->session->userdata()) {
			# code...
		}*/

		public function index($page = 'home'){
			$data['path'] = '/users/members';
			$data['username'] = $this->session->userdata('username');
			if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php')){
		// Whoops, we don't have a page for that!
				show_404();
			}

			//$this->news();
			$data['title'] = ucfirst('naslovna'); // Capitalize the first letter

			$this->load->view('templates/header', $data);
			$this->load->view('pages/'.$page, $data);
			$this->load->view('templates/footer', $data);
		}

		public function news(){
			$this->load->controller('news');
		}

		public function users(){
			$this->load->controller('users');
		}

		public function mycalendar()
		{
			$this->load->contorller('mycalendar');
		}
	}
?>
