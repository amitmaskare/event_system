<?php

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Approvermodel');
	}

	function index()
	{
		$this->load->view('dashboard');
	}

	public function registration_list()
	{
		$cond="band.role='".$this->session->userdata('role')."'";	
		$data['approver']=$this->Approvermodel->registration_list($cond);
		$this->load->view('approver/registration_list',$data);
	}


}