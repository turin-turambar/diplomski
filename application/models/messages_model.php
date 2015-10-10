<?php 
	/**
	* 
	*/
	class Messages_model extends CI_Model
	{
		/*public function getUsername()
		{
			$username = $this->db->select('username')->from('users')->where('sender_id', $userID)->get()->row();
			if (!$username) {
				return FALSE;
			}else{
				return $username->username;
			}

		}*/
		public function get_messages()
		{
			$userID 	=	$this->db->select('id')->from('users')->where('username', $this->session->userdata('username'))->get()->row();
			//$query		=	$this->db->get_where('messages',array('recipient_id'	=>	$userID->id));
			$this->db->select('*', 'username');
			$this->db->from('messages', 'users');
			$this->db->join('users', 'users.id=messages.sender_id');
			$this->db->where('messages.recipient_id', $userID->id);
			$query	=	$this->db->get();
			if ($query) {
				return $query->result_array();
			} else {
				return FALSE;
			}
		}
		public function compose()
		{
			$senderID 		= $this->db->select('id')->from('users')->where('username', $this->session->userdata('username'))->get()->row();
			$recipientID 	= $this->db->select('id')->from('users')->where('username', $this->input->post('username'))->get()->row();
			$data = array(
				'recipient_id' 	=> 	$recipientID->id,
				'sender_id'		=>	$senderID->id,
				//'sent_at'		=>	date("Y-m-d H:i:s"),
				'subject'		=>	$this->input->post('subject'),
				'message_text'	=>	$this->input->post('message')
			);
			$query = $this->db->insert('messages', $data);
			if ($query) {
				return TRUE;
			} else{
				return FALSE;
			}
		}

		public function registered_user()
		{
			$this->db->where('username', $this->input->post('username'));
			$id = $this->db->get('users');
			if ($id->num_rows != 1) {
				return false;
			} else{
				return true;
			}
		}
	}
?>