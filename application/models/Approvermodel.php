<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Approvermodel extends CI_Model
{

	public function registration_list($cond)
	{
		 $this->db->select('reg.*,e.name,band.id as band_id,band.role as band_role,band.band_order,u.name as user_name');
        $this->db->from('approvals as a');
        $this->db->join('registrations as reg','reg.id=a.registration_id');
        $this->db->join('approval_bands as band','band.id=a.band_id');
        $this->db->join('events as e','e.id=reg.event_id');
        $this->db->join('users as u','u.id=reg.user_id');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query->result();
	}

	
}
