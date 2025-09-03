<?php

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Approvermodel');
		$this->load->model('Commonmodel');
	}

	function index()
	{
		$this->load->view('dashboard');
	}

	public function registration_list()
	{
		$cond = "band.role='" . $this->session->userdata('role') . "' and reg.user_id!='" . $this->session->userdata('userId') . "'";
		$data['approver'] = $this->Approvermodel->registration_list($cond);
		$this->load->view('approver/registration_list', $data);
	}

	public function approval()
	{
		$data = array(
			'registration_id' => $this->input->post('registration_id'),
			'approved_by' => $this->session->userdata('userId'),
			'band_id' => $this->input->post('band_id'),
			'decision' => $this->input->post('decision'),
			'remarks' => $this->input->post('remarks'),
		);
		$this->Commonmodel->insertData('approvals', $data);
		$updateStatus = array(
			'status' => $this->input->post('decision'),
		);
		$this->Commonmodel->updateData('registrations', "id='" . $this->input->post('registration_id') . "'", $updateStatus);
		$this->session->set_flashdata('success', "Approval successfully");
		redirect(base_url('registration-list'));
	}

	public function set_approval_band()
	{
		$data['set_approval_band'] = $this->Approvermodel->approvalBand_list($cond);
		$this->load->view('set_approval_band', $data);
	}
}
