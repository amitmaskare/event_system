<?php

class Event extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usermodel');
	}

	function index()
	{
		$this->load->view('event');
	}
}
