<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usermodel extends CI_Model
{

	public function getSingle($table, $cond)
	{
		return $this->db->get_where($table, $cond)->row();
	}
	public function getData($table, $cond)
	{
		return $this->db->get_where($table, $cond)->result();
	}

	public function insertData($table, $data)
	{
		return $this->db->insert($table, $data);
	}

	function updateData($table, $cond, $data)
	{
		return $this->db->where($cond)->update($table, $data);
	}
}