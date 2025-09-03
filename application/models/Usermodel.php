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

	public function get_count($event_id, $role){
		$this->db->select('COUNT(r.id) as total');
		$this->db->from('registrations as r');
		$this->db->join('users as u', 'u.id = r.user_id');
		$this->db->where('r.event_id', $event_id);
		$this->db->where('u.role', $role);
		$query = $this->db->get();
		return $query->row()->total;
	}

	
}
