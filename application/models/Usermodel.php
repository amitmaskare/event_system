<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usermodel extends CI_Model
{

	public function upcoming_list($role)
	{
		$now = date('Y-m-d');
		$this->db->select('events.*');
		$this->db->from('events');
		$this->db->join('quotas', 'quotas.event_id = events.id', 'inner');
		$this->db->where('quotas.role', $role);
		$this->db->where('events.end_date >=', $now);
		$this->db->order_by('events.start_date', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	
}
