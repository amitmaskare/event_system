<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usermodel extends CI_Model
{

	public function upcoming_list()
	{
		$now = date('Y-m-d');
		return $this->db->where('end_date >=', $now)->order_by('start_date', 'ASC')->get('events')->result();
	}

	
}
