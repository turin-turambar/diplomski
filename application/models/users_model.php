<?php
    class Users_model extends CI_Model{

        public function registered_user()
        {
          $this->load->library('encrypt');

        	$this->db->where('username', $this->input->post('username'));
        	//$this->db->where('password', $this->encrypt->encode($this->input->post('password')));

            $query = $this->db->get('users');

            if($query->num_rows != 1){
                return false;
            }else{
                foreach($query->result() as $row){
                    if($this->encrypt->decode($row->password) == $this->input->post('password')){
                        return true;
                    }
                }
                return false;
            }
        }

        public function add_user($key)
        {
            $this->load->library('encrypt');

            $data = array(
                'username'          =>  $this->input->post('username'),
                'password'          =>  $this->encrypt->encode($this->input->post('password')),
                'email'             =>  $this->input->post('email'),
                'first_name'        =>  $this->input->post('first_name'),
                'last_name'         =>  $this->input->post('last_name'),
                'activation_key'    =>  $key
            );

            $query = $this->db->insert('users', $data);
            if($query){
                return true;
            }else{
                return false;
            }
        }

        public function view_user($username)
        {
            $this->db->select('id, username, first_name, last_name, email, registered');
            $this->db->where('username', $username);
            $query = $this->db->get('users');
            if ($query->num_rows != 1) {
              return false;
            } else {
              return $query->row_array();
            }
        }

        public function get_user_data($username)
        {
          $this->db->select('role_id, id');
          $this->db->where('username', $username);
          $query = $this->db->get('users');
          return $query->row_array();
        }

        public function change_password($username, $password)
        {
          $this->load->library('encrypt');

        	$this->db->where('username', $username);

          $query = $this->db->get('users');

          if($query->num_rows != 1){
              return false;
          }else{
              foreach($query->result() as $row){
                  if($this->encrypt->decode($row->password) == $password){
                    $this->db->set('password', $this->encrypt->encode($this->input->post('password')));
                    $this->db->where('username', $username);
                    $this->db->update('users');
                      return true;
                  }
              }
              return false;
          }
        }
    }
?>
