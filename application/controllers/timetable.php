<?php
  /**
   * @author Nemanja Djokic
   */
  class Timetable extends CI_Controller
  {

    function __construct()
    {
      parent::__construct();
      if (! $this->session->userdata('is_loged_in')) {
        redirect('/users/login');
      }
    }

    public function index()
    {
      $this->view();
    }

    public function view()
    {
      $this->load->model('users_model');
      $this->load->model('timetable_model');
      $this->load->helper('array');
      $data['path'] = '/users/members';
      $data['username'] = $this->session->userdata('username');
      $username = $this->session->userdata('username');
      $user_data = $this->users_model->get_user_data($username);
      $role_id = element('role_id', $user_data);
      $user_id = element('id', $user_data);
      if ($role_id == 2 || $role_id == 3) {
        $data['timetable_items'] = $this->timetable_model->timetable($user_id);
        $this->load->view('templates/header', $data);
				$this->load->view('templates/aside');
        $this->load->view('/timetable/view', $data);
        $this->load->view('templates/footer');
      } elseif ($role_id == 1) {
        $this->load->view('templates/header', $data);
				$this->load->view('templates/aside');
        $this->load->view('/timetable/view_user', $data);
        $this->load->view('templates/footer');
        //TODO;
      } else {
        echo "Nemate dovoljan nivo privilegija da vidite ovu stranicu!";
      }
    }
  }

?>
