<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* 
	*/
	class Mycalendar extends CI_Controller
	{
		public function index()
		{
			$this->display();
		}

		public function display($year = null, $month = null)
		{

			if (!$year) {
				$year = date('Y');
			}
			if (!$month) {
				$month = date('m');
			}
			$this->load->model('mycalendar_model');

			if ($day = $this->input->post('day')) {
				$this->mycalendar_model->new_calendar_data(
					"$year-$month-$day",
					$this->input->post('data')
				);
			}
						
			$data['title'] = 'Kalendar rada';
			$vars['cal'] = $this->mycalendar_model->generate($year, $month);
			$vars['query'] = $this->mycalendar_model->get_calendar_data($year, $month);
			
			$this->load->view('templates/header', $data);
			$this->load->view('mycalendar/display', $vars);
			$this->load->view('templates/footer');
		}
	}
?>