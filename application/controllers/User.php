<?php

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Commonmodel');
		$this->load->model('Usermodel');
	}

	function index()
	{
		$data['upcomingEvent'] = $this->Usermodel->upcoming_list();
		$this->load->view('upcoming_event/event_list', $data);
	}

	public function registration($id)
	{
		$data['getEvent'] = $this->Commonmodel->getSingle('events', "id='" . $id . "'");
		$data['registration'] = $this->Commonmodel->getData('form_nodes', "event_id='" . $id . "'");
		$this->load->view('upcoming_event/registration', $data);
	}

	public function saveRegistration()
	{
		$data=array(
			'event_id'=>$this->input->post('event_id'),
			'user_id'=>$this->session->userdata('userId'),
		);
		$this->Commonmodel->insertData('registrations',$data);
		$this->session->set_flashdata('success', "Event registration successfully");

		redirect(base_url('upcoming-event'));
	}
}
