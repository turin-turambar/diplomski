<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	*
	*/
	class Messages extends CI_Controller
	{

		function __construct()
		{
			parent::__construct();
			if (! $this->session->userdata('is_loged_in')) {
				redirect('/users/login');
			}
			$this->load->model('messages_model');
		}

		public function index()
		{
			$this->inbox();
		}

		public function inbox()
		{
			$data['messages']	=	$this->messages_model->get_messages();
			$data['username'] = $this->session->userdata('username');
			$data['path'] = '/users/members';
			$data['title'] = 'Primljene poruke';
			$this->load->view('templates/header',$data);
			$this->load->view('messages/inbox', $data);
			$this->load->view('templates/footer');
		}

		public function compose()
		{
			$data['title']	=	'Napiši novu poruku';
			$config = array(
				array(
					'field'	=>	'username',
					'label'	=>	'Korisničko ime',
					'rules'	=>	'required|trim|xss_clean|callback_user_exists'
				),
				array(
					'field'	=>	'subject',
					'label' =>	'Tema',
					'rules'	=>	'required|trim|xss_clean'
				),
				array(
					'field'	=>	'message',
					'label'	=>	'Tekst poruke',
					'rules'	=>	'required'
				)
			);
			$this->form_validation->set_rules($config);
			$this->form_validation->set_message('required', 'Polje %s je obavezno');
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('templates/header', $data);
				$this->load->view('messages/new');
				$this->load->view('templates/footer');
			}else{
				if ($this->messages_model->compose()) {
					$this->load->view('templates/header', $data);
					echo "success";
					$this->load->view('templates/footer');
				} else {
					$this->load->view('templates/header', $data);
					echo "fail";
					$this->load->view('templates/footer');
				}
			}
		}

		public function user_exists()
		{
			$this->load->model('messages_model');
			if ($this->messages_model->registered_user()) {
				return TRUE;
			} else{
				$this->form_validation->set_message('user_exists','Nepostojeći korisnik');
				return FALSE;
			}
		}
	}
?>
