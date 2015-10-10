<?php
	class News_model extends CI_Model{

		/*public function __construct(){
			$this->load->database();
		}*/

		public function get_news($slug = FALSE){
			if ($slug === FALSE) {
				$query = $this->db->get('posts');
				return $query->result_array();
			}
			$query = $this->db->get_where('posts', array('slug' => $slug));
			return $query->row_array();
		}

		public function set_news(){
			$slug = url_title($this->input->post('title'), 'dash', TRUE);

			$data = array(
				'title' => $this->input->post('title'),
				'slug'	=> $slug,
				'body'	=> $this->input->post('body')
			);

			return $this->db->insert('posts', $data);
		}
	}
?>