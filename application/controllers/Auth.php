<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usermodel');
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function register()
	{

		$this->load->view('register');
	}

	function saveRegister()
	{
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

		if ($this->form_validation->run() === FALSE) {

			$this->load->view('register');
			return;
		}
		if (empty($_FILES['profile']['name'])) {
			$data['profile_error'] = 'Profile field is required';
			$this->load->view('register', $data);
			return;
		}

		$checkEmail = $this->Usermodel->getSingle("users", "email='" . $this->input->post('email') . "'");

		if (!empty($_FILES['profile']['name'])) {
			$config['upload_path']   = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['file_name']     = rand(11111, 99999) . '-' . $_FILES['profile']['name'];
			$config['max_size']      = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('profile')) {

				$this->session->set_flashdata('error', $this->upload->display_errors());
				$this->load->view('register');
				return;
			} else {
				$uploadData = $this->upload->data();
				$profile = $uploadData['file_name'];
			}
		}

		if (empty($checkEmail)) {

			$data = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'password' => md5($this->input->post('password')),
				'profile' => $profile,
				'created_at' => date('Y-m-d H:i:s')
			);
			$this->Usermodel->insertData('users', $data);
			$this->session->set_flashdata('success', "Register successfully!");
			redirect('');
		} else {
			$data['msg'] = '<div class="alert alert-danger text-center">
  		<strong>Email Id already exits.</strong> 
			</div>';
			$this->load->view('register', $data);
		}
	}

	function actionLogin()
	{

		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() === FALSE) {

			$this->load->view('login');
		} else {
			$cond = "email='" . $_POST['email'] . "' AND password='" . md5($_POST['password']) . "'";
			$checkLogin = $this->Usermodel->getSingle('users', $cond);

			if (empty($checkLogin)) {
				$this->session->set_flashdata('error', "Incorrect Email and Password.");
				redirect(base_url(''));
			}

			$sess['event_system'] = array(
				'userId' => $checkLogin->id,
				'name' => $checkLogin->name,
				'email' => $checkLogin->email,
				'role' => $checkLogin->role,
			);
			$this->session->set_userdata($sess);
			redirect(base_url('dashboard'));
		}
	}

	function logout()
	{
		unset($_SESSION['vega6']);
		$this->session->set_flashdata('success', "Logout successfully!");
		redirect('');
	}
}
