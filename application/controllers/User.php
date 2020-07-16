<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function gotoLogin()
	{
		$this->load->view('login');
	}

	public function auth()
	{
		$userLogin = $this->getUserLogin($this->input->post('user'));

		if( $userLogin ) 
		{
			if ($this->input->post('pass') == $userLogin->password) 
			{
				$user_session = array(
				 	'admin_login' => TRUE,
				 	'ID' => $userLogin->ID,
				 	'user' => $userLogin
				);	

				$this->session->set_userdata( $user_session );

				redirect('Admin');
			} else {
				$this->session->set_flashdata('message', 'Kombinasi Username/E-Mail dan Password tidak cocok.');
				redirect('User/gotoLogin');
			}
		} else {
			$this->session->set_flashdata('message', 'Mohon Masukkan Username/E-Mail dan Password.');
			redirect('User/gotoLogin');
		}

		// if($this->input->post('user') == "admin" AND $this->input->post('password') == "admin"){
		// 	redirect('Admin');
		// }
	}

	public function getUserLogin($user)
	{
		if (filter_var($user, FILTER_VALIDATE_EMAIL)) 
		{
			return $this->db->get_where('users', array('email' => $user))->row();
		} else {
			return $this->db->get_where('users', array('username' => $user))->row();
		}
	}

	public function signout()
	{
		$this->session->set_flashdata('message', 'Anda berhasil keluar.');
		$this->session->sess_destroy();

		redirect(base_url());
	}
}
?>