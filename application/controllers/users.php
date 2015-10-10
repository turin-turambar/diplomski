<?php
	/**
	*
	* @author Nemanja Djokic
	*/
	class Users extends CI_Controller{

		/*function __construct()
		{
			parent::__construct();
			if (! $this->session->userdata('is_loged_in')) {
        redirect('/users/login');
      }
      if ($role_id != 1) {
        show_404();
      }
		}*/

		public function index()
		{
			$this->members();
		}

		public function login()
		{
			//$this->load->helper('form');
			//$this->load->library('form_validation');
			$sessionData = array(
				'username'		=>	$this->input->post('username'),
				 'is_loged_in'	=>	1
			);
			$data['title'] = 'Uloguj se';
			$data['username'] = 'Ulogujte se';
			$data['path'] = '/users/login';
			$config = array(
				array(
					'field'	=>	'username',
					'label'	=>	'Korisničko ime',
					'rules'	=>	'required|trim|xss_clean'
				),
				array(
					'field'	=>	'password',
					'label'	=>	'Lozinka',
					'rules'	=>	'required|trim|min_length[8]|callback_validate_user'
				)
				);

			$this->form_validation->set_rules($config);
			$this->form_validation->set_message('required', 'Polje %s je obavezno!');
			$this->form_validation->set_message('required', 'Polje %s je obavezno!');
			$this->form_validation->set_message('min_length', 'Polje %s mora imati makar 8 karaktera!');

			if ($this->form_validation->run() === FALSE) {
				$this->load->view('templates/header', $data);
				$this->load->view('/users/login');
				$this->load->view('templates/footer');
			} else {
				$this->session->set_userdata($sessionData);
				$this->members();
			}
		}

		public function register(){
			$this->load->model('users_model');
			$this->load->helper('array');
      $username = $this->session->userdata('username');
      $user_data = $this->users_model->get_user_data($username);
      $role_id = element('role_id', $user_data);
			if ($role_id != 1) {
				show_404(); //TODO
			}else{
				$data['title'] = 'Registrujte novi nalog';
				$config = array(
					array(
						'field' =>	'username',
						'label'	=>	'Korisničko ime',
						'rules'	=>	 'required|min_length[3]|max_length[25]|is_unique[users.username]|trim|xss_clean'),
					array(
						'field' =>	'password',
						'label'	=>	'Lozinka',
						'rules'	=>	 'required|trim|min_length[8]|'),
					array(
						'field' =>	'repeatPassword',
						'label'	=>	'Ponovljena lozinka',
						'rules'	=>	 'required|trim|min_length[8]|matches[password]'),
					array(
						'field' =>	'email',
						'label'	=>	'Email adresa',
						'rules'	=>	 'required|valid_email|trim'),
					array(
						'field' =>	'first_name',
						'label'	=>	'Ime',
						'rules'	=>	 'required|trim|min_length[3]'),
					array(
						'field' =>	'last_name',
						'label'	=>	'Prezime',
						'rules'	=>	 'required|trim|min_length[3]'),
				);

				$this->form_validation->set_rules($config);
				$this->form_validation->set_message('required', 'Polje %s je obavezno');
				if ($this->form_validation->run() === FALSE) {
					$this->load->view('/templates/header', $data);
					$this->load->view('/users/register');
					$this->load->view('/templates/footer');
				} else {
					//$this->load->model('users_model');

					/*
					//send an email to the user
					$this->load->library('email', array('mailtype'	=> 'html'));
					$this->email->from('no-reply@nemanjadjokic.com', 'No-reply, nemanjadokic.com');
					$this->email->to($this->input->post('email'));
					$this->email->subject('Dobrodošli na nastavnički portal Visoke škole tehničkih strukovnih studija');
					$message = '<h3>Hvala Vam na registraciji</h3>
					<p>Ispod se nalaze podaci koje ste unali prilikom registracije. Ukoliko su podaci tačni, potrvrdite Vašu registraciju klikom
					na link ispod. Ukoliko se niste registrovali na portalu, pišite administratoru na
					<a href="\"mailto:admin@diplomskiportal.nemanjadjokic.com"\">admin@diplomskiportal.nemanjadjokic.com</a></p>
					<p>Registrovali ste se sa sledećim podacima:</p>
					<ul>
						<li>Korisničko ime: '.$this->input->post('username').'</li>
						<li>Email: '.$this->input->post('email').'</li>
						<li>Ime: '.$this->input->post('first_name').'</li>
						<li>Prezime: '.$this->input->post('last_name').'</li>
					</ul>';
					$message .= anchor(base_url().'users/register_user/'.$key);
					$this->email->message($message);*/

					//generate a random key
					$key = md5(uniqid());

					//Adding the user data to the users table
					//$this->users_model->add_user($key);
					if ($this->users_model->add_user($key)) {
						$this->load->view('/templates/header', $data);
						echo 'Succes!';
						$this->load->view('/templates/footer');
						/*if($this->email->send()){
						echo 'Email je poslat. Proverite svoj inbox.';
					}else{
						echo 'Email nije poslat. Pisite administratoru na <a href="\"mailto:admin@diplomskiportal.nemanjadjokic.com"\">
						admin@diplomskiportal.nemanjadjokic.com</a>';
					}*/
					} else {
						$this->load->view('/templates/header', $data);
						echo 'Fail.';
						$this->load->view('/templates/footer');
					}
			}
		}

/*
			$data['title'] = 'Registrujte novi nalog';
			$this->load->view('templates/header', $data);
			$this->load->view('users/register');
			$this->load->view('templates/footer');*/
		}

		public function members(){
			$data['path'] = '/users/members';
			if ($this->session->userdata('is_loged_in')) {
				$data['title'] = 'Odeljak za članove';
				$data['username'] = $this->session->userdata('username');
				$this->load->view('templates/header', $data);
				$this->load->view('templates/aside');
				$this->load->view('users/members');
				$this->load->view('templates/footer');
			} else {
				//$data['username'] = 'Login';
				redirect('/users/login', $data);
			}
		}

		public function validate_user()
		{
			$this->load->model('users_model');

			if ($this->users_model->registered_user()) {
				return true;
			} else {
				$this->form_validation->set_message('validate_user', 'Pogrešno korisničko ime ili lozinka!');
				return false;
			}

		}

		public function logout()
		{
			$this->session->sess_destroy();
			redirect('users/login');
		}

		public function view()
		{
			$data['path'] = '/users/members';
			$this->load->model('users_model');
			$username = $this->session->userdata('username');
			if ($this->session->userdata('is_loged_in')) {
				$data['title'] = 'Vaš profil';
				$data['username'] = $this->session->userdata('username');
				$columns['userdata'] = $this->users_model->view_user($username);
				$this->load->view('templates/header', $data);
				$this->load->view('templates/aside');
				$this->load->view('users/view', $columns);
				$this->load->view('templates/footer');
			} else {
				redirect('users/login', $data);
			}
		}


		public function changePassword()
		{
			$data['path'] = '/users/members';
			$data['username'] = $this->session->userdata('username');
			$data['title'] = 'Promenite lozinku';

			$config = array(
				array(
					'field' =>	'oldPassword',
					'label'	=>	'Stara lozinka',
					'rules'	=>	 'required|trim|xss_clean'),
				array(
					'field' =>	'password',
					'label'	=>	'Nova lozinka',
					'rules'	=>	 'required|trim|min_length[8]|'),
				array(
					'field' =>	'repeatPassword',
					'label'	=>	'Ponovljena lozinka',
					'rules'	=>	 'required|trim|min_length[8]|matches[password]'),
			);

			$this->form_validation->set_rules($config);
			$this->form_validation->set_message('required', 'Polje %s je obavezno');
			$this->form_validation->set_message('matches', 'Polje %s mora biti isto kao polje %s');
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('templates/header', $data);
				$this->load->view('templates/aside');
				$this->load->view('users/changePassword');
				$this->load->view('templates/footer');
			} else {
				$this->load->model('users_model');
				$password = $this->input->post('oldPassword');
				$username = $this->session->userdata('username');

				if ($this->users_model->change_password($username, $password)) {
					redirect('users/login', $data);
				} else {
					$this->changePassword();
				}
			}
		}
	}
