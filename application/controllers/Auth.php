<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Commonmodel');
	}

	public function index()
	{
		$this->load->view('login');
	}


	function actionLogin()
	{

		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() === FALSE) {

			$this->load->view('login');
		} else {
			$cond = "email='" . $_POST['email'] . "' AND password='" . md5($_POST['password']) . "'";
			$checkLogin = $this->Commonmodel->getSingle('users', $cond);

			if (empty($checkLogin)) {
				$this->session->set_flashdata('error', "Incorrect Email and Password.");
				redirect(base_url(''));
			}

				$session_data = array(
			'userId'   => $checkLogin->id,
			'name'     => $checkLogin->name,
			'email'    => $checkLogin->email,
			'role'     => $checkLogin->role,
			);

		$this->session->set_userdata($session_data);
			redirect(base_url('dashboard'));
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('success', "Logout successfully!");
		redirect('');
	}
}
