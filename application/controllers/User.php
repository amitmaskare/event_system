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
		$this->load->view('upcoming_event/registration', $data);
	}
}
