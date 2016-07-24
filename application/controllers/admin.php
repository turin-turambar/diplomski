<?php
  /**
   * @author Nemanja Djokic
   */
  class Admin extends CI_Controller
  {

    function __construct()
    {
      parent::__construct();
      $this->load->model('users_model');
      $this->load->helper('array');
      $username = $this->session->userdata('username');
      $user_data = $this->users_model->get_user_data($username);
      $role_id = element('role_id', $user_data);
      if ($role_id == 1) {
        $this->role = 'Admin panel';
        $this->role_path = '/admin';
      }else{
        $this->role = NULL;
        $this->role_path = NULL;
      }
      if (! $this->session->userdata('is_loged_in')) {
        redirect('/users/login');
      }
      if ($role_id != 1) {
        show_404();
      }
      //$this->load->model('admin_model');
    }

    public function index()
    {
      $data['path'] = '/users/members';
      $data['title'] = 'Odeljak za administratore portala';
      $data['username'] = $this->session->userdata('username');
      $data['role'] = $this->role;
      $data['role_path'] = $this->role_path;
      $this->load->view('templates/header', $data);
      $this->load->view('/admin/index');
      $this->load->view('templates/footer');
    }

    public function notExists($username)
    {
      $this->load->model('users_model');
      if ($this->users_model->view_user($username)) {
        return TRUE;
      } else {
        $this->form_validation->set_message('notExists', 'Korisnik ne postoji!');
        return FALSE;;
      }
    }
    
    public function userData()
    {
	  $this->load->model('users_model');
      $this->load->helper('array');
      $data['path']       = '/users/members';
      $data['title']      = 'Promeni podatke korisnika';
      $data['username']   = $this->session->userdata('username');
      $data['user_name']  = $this->input->post('username');

        //Adds menu option for admin
        $data['role'] = $this->role;
        $data['role_path'] = $this->role_path;
      
      $this->load->view('templates/header', $data);
      $this->load->view('/admin/changeUserData');
      $this->load->view('templates/footer');
    }

    public function changeUserData()
    {
      $this->form_validation->set_rules('username', 'Korisničko ime', 'required|trim|xss_clean|callback_notExists');
  	  $this->form_validation->set_message('required', 'Polje %s je obavezno!');

      if ($this->form_validation->run() === FALSE) {
        $this->userData();
      } else {
          $user_name = $this->input->post('username');
          $columns = $this->users_model->view_user($user_name);
          $userName = element('username', $columns);
          $data['user_id'] = element('id', $columns);
          $this->user_id = $data['user_id'];
          if (!$userName) {
            redirect('/admin/changeUserData');
          } else{
      		$this->userPassword($this->user_id);
    }
  }
}

	public function userPassword($user_id)
	{
		  $this->load->helper('array');
          $data['path'] = '/users/members';
          $data['title'] = 'Promeni podatke korisnika';
          $data['username'] = $this->session->userdata('username');
          $data['user_id'] = $user_id;

        //Adds menu option for admin
        $data['role'] = $this->role;
        $data['role_path'] = $this->role_path;
          
          $this->load->view('templates/header', $data);
          $this->load->view('/admin/changeUserPassword');
          $this->load->view('templates/footer');
	}

        public function changeUserPassword()
        {
        $user_id = $this->input->post('username');
          $config = array(
            array(
              'field' =>  'password',
              'label' =>  'Lozinka',
              'rules' =>  'required|trim|min_length[8]|'
            ),
            array(
              'field' =>  'repeatPassword',
              'label' =>  'Ponovljena lozinka',
              'rules' =>  'required|trim|min_length[8]|matches[password]'
            )
          );

          $this->form_validation->set_rules($config);
          $this->form_validation->set_message('required', 'Polje %s je obavezno!');
          $this->form_validation->set_message('min_length', 'Polje %s mora imati barem 8 karaktera!');
          $this->form_validation->set_message('matches', 'Polja moraju biti identična!');

		  
          if ($this->form_validation->run() === FALSE) {
            $this->userPassword($user_id);
          }else {
            $this->load->model('users_model');
            if ($this->users_model->admin_change_password($user_id)) {
				redirect('/admin/changed');
            }else{
              $this->userPassword($user_id);
            }

          }
        }
        
    public function changed()
    {
        
			$this->load->helper('array');
        $data['path'] = '/users/members';
        $data['title'] = 'Promena uspesna';
        $data['username'] = $this->session->userdata('username');
        $this->load->view('templates/header', $data);
        echo "Bravo";
        $this->load->view('templates/footer');
    }


      //TODO generating fields for editing user data
      /*$fields = array(
        array(
          ''
        )
        '' => , );*/
    }
  //}
//}

?>
