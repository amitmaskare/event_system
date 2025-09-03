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

			$eventId = $this->input->post('id');
			$this->Commonmodel->updateData('events', ['id' => $eventId], $data);
			$msg = "updated";

			// clear old child records
			$this->Commonmodel->deleteData('quotas', ['event_id' => $eventId]);
			$this->Commonmodel->deleteData('form_nodes', ['event_id' => $eventId]);
			$this->Commonmodel->deleteData('approval_bands', ['event_id' => $eventId]);
		} else {
			$this->Commonmodel->insertData('events', $data);
			$eventId = $this->db->insert_id();
			$msg = "added";
		}

		if ($this->input->post('quota_role')) {
			$count = count($this->input->post('quota_role'));
			for ($i = 0; $i < $count; $i++) {
				$dataQuota = array(
					'event_id'        => $eventId,
					'role'            => $this->input->post('quota_role')[$i],
					'max_participants' => $this->input->post('max_participants')[$i],
				);
				$this->Commonmodel->insertData('quotas', $dataQuota);
			}
		}
		if ($this->input->post('label')) {
			$count1 = count($this->input->post('label'));
			
			for ($i = 0; $i < $count1; $i++) {
				 $fieldType = $this->input->post('field_type')[$i];
				$dataForm = array(
					'event_id'      => $eventId,
					'label'         => $this->input->post('label')[$i],
					'field_name'    => $this->input->post('field_name')[$i],
					'field_type'    => $fieldType,
					 'field_options' => ($fieldType == 'dropdown' && !empty($this->input->post('field_options')[$i+1])) 
                                ? $this->input->post('field_options')[$i+1] 
                                : '', 
					'required'      => $this->input->post('required')[$i],
				);
				$this->Commonmodel->insertData('form_nodes', $dataForm);
			}
		}
		if ($this->input->post('band_role')) {
			$count2 = count($this->input->post('band_role'));
			$ap_band=$this->Commonmodel->getData('approval_bands', ['event_id' => $eventId]);
			if(count($ap_band)>0){
				$this->Commonmodel->deleteData2($eventId,'approval_bands',  ['event_id' => $eventId]);
			}
			for ($i = 0; $i < $count2; $i++) {
				$dataBand = array(
					'event_id'   => $eventId,
					'band_order' => $this->input->post('band_order')[$i],
					'role'       => $this->input->post('band_role')[$i],
				);
				$this->Commonmodel->insertData('approval_bands', $dataBand);
			}
		}
		$this->session->set_flashdata('success', "Event {$msg} successfully");
		redirect(base_url('event'));
	}

	public function edit($id)
	{
		$data['getData'] = $this->Commonmodel->getSingle('events', "id='" . $id . "'");
		$data['quotalist'] = $this->Commonmodel->getData('quotas', "event_id ='" . $id . "'");
		$data['formlist'] = $this->Commonmodel->getData('form_nodes', "event_id ='" . $id . "'");
		$data['bandlist'] = $this->Commonmodel->getData('approval_bands', "event_id ='" . $id . "'");

		$this->load->view('event/add', $data);
	}

	public function delete($id)
	{
		if (!empty($id)):
			$this->Commonmodel->deleteData('quotas', "event_id='" . $id . "'");
			$this->Commonmodel->deleteData('registrations', "event_id='" . $id . "'");
			$this->Commonmodel->deleteData('approval_bands', "event_id='" . $id . "'");
			$this->Commonmodel->deleteData('events', "id='" . $id . "'");
			$this->session->set_flashdata('success', "Event deleted successfully");
		else:
			$this->session->set_flashdata('error', "Id not exits");
		endif;
		redirect(base_url('event'));
	}
}
