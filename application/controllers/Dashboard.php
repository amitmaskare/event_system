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
		$registrationId = $this->input->post('registration_id');
		$bandId         = $this->input->post('band_id');
		$decision       = $this->input->post('decision');
		$registration = $this->Commonmodel->getSingle('registrations', array('id' => $registrationId));
		$eventId      = $registration->event_id;
		$this->db->order_by('band_order', 'ASC');
		$bands = $this->Commonmodel->getData('approval_bands', array('event_id' => $eventId));
		$currentIndex = null;
		foreach ($bands as $index => $b) {
			if ($b->id == $bandId) {
				$currentIndex = $index;
				break;
			}
		}
		if ($currentIndex !== null && $currentIndex > 0) {
			for ($i = 0; $i < $currentIndex; $i++) {
				$prevApproval = $this->Commonmodel->getSingle('approvals', array(
					'registration_id' => $registrationId,
					'band_id'         => $bands[$i]->id
				));
				if (!$prevApproval || $prevApproval->decision != 'approved') {
					$this->session->set_flashdata('error', "first need to accept {$bands[$i]->role}.");
					redirect(base_url('registration-list'));
					return;
				}
			}
		}
		$data = array(
			'registration_id' => $registrationId,
			'approved_by'     => $this->session->userdata('userId'),
			'band_id'         => $bandId,
			'decision'        => $decision,
			'remarks'         => $this->input->post('remarks'),
		);
		$this->Commonmodel->insertData('approvals', $data);
		$allApproved   = true;
		$currentStatus = 'approved';

		foreach ($bands as $b) {
			$approval = $this->Commonmodel->getSingle('approvals', array(
				'registration_id' => $registrationId,
				'band_id'         => $b->id
			));
			if ($approval) {
				if ($approval->decision == 'rejected') {
					$currentStatus = 'rejected';
					$allApproved   = false;
					break;
				} elseif ($approval->decision != 'approved') {
					$allApproved   = false;
					$currentStatus = 'pending';
					break;
				}
			} else {
				$allApproved   = false;
				$currentStatus = 'pending';
				break;
			}
		}

		if ($allApproved) {
			$updateStatus = array('status' => 'approved');
		} else {
			$updateStatus = array('status' => $currentStatus);
		}
		$this->Commonmodel->updateData('registrations', array('id' => $registrationId), $updateStatus);

		$this->session->set_flashdata('success', "Approval successfully");
		redirect(base_url('registration-list'));
	}


	public function set_approval_band()
	{
		$data['set_approval_band'] = $this->Approvermodel->approvalBand_list($cond);
		$this->load->view('set_approval_band', $data);
	}
}
