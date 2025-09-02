<?php

class Event extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Commonmodel');
	}

	function index()
	{
		$data['eventList'] = $this->Commonmodel->getData('events');


		$this->load->view('event/list', $data);
	}

	public function add()
	{
		$this->load->view('event/add');
	}

	public function saveEvent()
	{
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('start_date', 'Start Date', 'required');
		$this->form_validation->set_rules('end_date', 'End Date', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		if ($this->form_validation->run() === FALSE) {

			$this->load->view('event/add');
			return;
		}
		$data = array(
			'name' => $this->input->post('name'),
			'start_date' => $this->input->post('start_date'),
			'end_date' => $this->input->post('end_date'),
			'description' => $this->input->post('description'),
		);
		if (!empty($this->input->post('id'))) {

			$this->Commonmodel->updateData('events', "id='" . $this->input->post('id') . "'", $data,);
			$msg = "updated";
		} else {
			$this->Commonmodel->insertData('events', $data);
			$msg = "added";
		}
		$this->session->set_flashdata('success', "Event {$msg} successfully");
		redirect(base_url('event'));
	}

	public function edit($id)
	{
		$data['getData'] = $this->Commonmodel->getSingle('events', "id='" . $id . "'");
		$this->load->view('event/add', $data);
	}

	public function delete($id)
	{
		if (!empty($id)):
			$this->Commonmodel->deleteData('events', "id='" . $id . "'");
			$this->session->set_flashdata('success', "Event deleted successfully");
		else:
			$this->session->set_flashdata('error', "Id not exits");
		endif;
		redirect(base_url('event'));
	}
}
