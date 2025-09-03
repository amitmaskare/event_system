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
		$role=$this->session->userdata('role');
		$data['upcomingEvent'] = $this->Usermodel->upcoming_list($role);
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
		$event_id = $this->input->post('event_id');
		$user_id  = $this->session->userdata('userId');
		$user = $this->Commonmodel->getSingle('users', ['id' => $user_id]);
		if (!$user) {
			$this->session->set_flashdata('error', "Invalid user.");
			return redirect('upcoming-event');
		}
		$role = $user->role;
		$quota = $this->Commonmodel->getSingle('quotas', [
			'event_id' => $event_id,
			'role'     => $role
		]);
		if (!$quota) {
			$this->session->set_flashdata('error', "No quota defined for your role in this event.");
			return redirect('upcoming-event');
		}
		$already = $this->Commonmodel->getSingle('registrations', [
			'event_id' => $event_id,
			'user_id'  => $user_id
		]);
		if ($already) {
			$this->session->set_flashdata('error', "You are already registered for this event.");
			return redirect('upcoming-event');
		}
		$count=$this->Usermodel->get_count($event_id, $role);
		if ($count >= $quota->max_participants) {
			$data = [
				'event_id'      => $event_id,
				'user_id'       => $user_id,
				'status'		=>'waitlisted'
			];
			$this->Commonmodel->insertData('registrations', $data);
			$this->session->set_flashdata('success', "Sorry, quota is waitlisted.");
		} else {
			$data = [
				'event_id'      => $event_id,
				'user_id'       => $user_id
			];
			$this->Commonmodel->insertData('registrations', $data);
			$this->session->set_flashdata('success', "Event registration successful.");
		}

		return redirect('upcoming-event');
	}
}
