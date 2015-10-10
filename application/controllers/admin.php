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
      $data['title'] = 'Odeljak administratore portala';
      $data['username'] = $this->session->userdata('username');
      $this->load->view('templates/header', $data);
      $this->load->view('/admin/index');
      $this->load->view('templates/footer');
    }

    public function changeUserData()
    {
      $this->load->model('users_model');
      $this->load->helper('array');
      $data['path'] = '/users/members';
      $data['title'] = 'Promeni podatke korisnika';
      $data['username'] = $this->session->userdata('username');

      $this->form_validation->set_rules('username', 'Korisničko ime', 'required|trim|xss_clean');
  		$this->form_validation->set_message('required', 'Polje %s je obavezno!');

      if ($this->form_validation->run() === FALSE) {
        $this->load->view('templates/header', $data);
        $this->load->view('/admin/changeUserData');
        $this->load->view('templates/footer');
      } else{
        $data['username'] = $this->input->post('username');
        $username = $this->input->post('username');
        $columns = $this->users_model->view_user($username);
        $userName = element('username', $columns);
        $data['user_id'] = element('id', $columns);
        if (!$userName) {
          redirect('/admin/changeUserData');
        } else{
          $this->load->view('templates/header', $data);
          $this->load->view('/admin/viewUser');
          $this->load->view('templates/footer');
        }
      //TODO generating fields for editin user data
      /*$fields = array(
        array(
          ''
        )
        '' => , );*/
    }
  }
}

?>
