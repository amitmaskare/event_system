<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Approvermodel extends CI_Model
{

	public function registration_list($cond)
	{
		 $this->db->select('reg.*,e.name,band.id as band_id,band.role as band_role');
        $this->db->from('registrations as reg');
        $this->db->join('approval_bands as band','band.event_id=reg.event_id','left');
        $this->db->join('approval_bands as band','band.event_id=reg.event_id','left');
        $this->db->join('events as e','e.id=band.event_id','left');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query->result();
	}

	
}
