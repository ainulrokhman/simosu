<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function login()
	{
		$this->load->library('form_validation');
		$this->load->model('UserModel', 'user');

		$config = [
			[
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|valid_email',
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required',
			],
		];
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('user/login');
		} else {
			$this->user->auth($this->input->post());
			redirect(base_url('dashboard'));
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('session');
		redirect(base_url('user/login'));
	}
}
