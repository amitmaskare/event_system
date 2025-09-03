<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Approvermodel extends CI_Model
{

	public function registration_list($cond)
	{
		$this->db->select('reg.*,e.name as event_name,band.id as band_id,band.role as band_role,band.band_order,u.name as user_name');
		$this->db->from('registrations as reg');
		$this->db->join('approval_bands as band', 'band.event_id=reg.event_id', 'left');
		$this->db->join('events as e', 'e.id=reg.event_id', 'left');
		$this->db->join('users as u', 'u.id=reg.user_id', 'left');
		$this->db->where($cond);
		$query = $this->db->get();
		return $query->result();
	}

	public function approvalBand_list()
	{
		$this->db->select('a.*,e.name as event_name,u.name as register_name,user.name as approved_by,band.band_order');
		$this->db->from('approvals as a');
		$this->db->join('registrations as reg', 'reg.id=a.registration_id', 'left');
		$this->db->join('approval_bands as band', 'band.id=a.band_id', 'left');
		$this->db->join('events as e', 'e.id=reg.event_id', 'left');
		$this->db->join('users as u', 'u.id=reg.user_id', 'left');
		$this->db->join('users as user', 'user.id=a.approved_by', 'left');
		$query = $this->db->get();
		return $query->result();
	}
}