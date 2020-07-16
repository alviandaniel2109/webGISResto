<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		if($this->session->has_userdata('admin_login')==FALSE) 
			redirect(site_url());

		$this->load->model('madmin');
	}

	public function index()
	{
		$this->data = array(
			'title' => "Beranda Administrator"
		);	

		$this->load->view('main-admin', $this->data);
	}

	public function addresto()
	{	
		$this->data['title'] = "Tambah Restoran";

		$this->form_validation->set_rules('name', 'Nama', 'trim|required');
		$this->form_validation->set_rules('jenis', 'Jenis', 'trim|required');
		$this->form_validation->set_rules('minimal', 'Minimal', 'trim|required');
		$this->form_validation->set_rules('maksimal', 'Maksimal', 'trim|required');
		$this->form_validation->set_rules('buka', 'Buka', 'trim|required');
		$this->form_validation->set_rules('tutup', 'Tutup', 'trim|required');
		$this->form_validation->set_rules('kapasitas', 'Kapasitas', 'trim|required');
		$this->form_validation->set_rules('harian', 'Pengunjung Harian', 'trim|required');
		$this->form_validation->set_rules('cp', 'Contact Person', 'trim|required');
		$this->form_validation->set_rules('latitude', 'Latitude', 'trim|required');
		$this->form_validation->set_rules('longitude', 'Longitude', 'trim|required');
		$this->form_validation->set_rules('jarak', 'Jarak', 'trim|required');
		$this->form_validation->set_rules('description', 'Deskripsi', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->madmin->createResto();

			redirect(current_url());
		}

		$this->load->view('add-resto', $this->data);
	}

	public function resto()
	{
		$config['base_url'] = site_url("admin/resto?per_page={$this->input->get('per_page')}&query={$this->input->get('q')}");

		$config['per_page'] = 10;
		$config['total_rows'] = $this->madmin->getAllResto(null, null, 'num');
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = "&larr; Pertama";
        $config['first_tag_open'] = '<li class="">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = "Terakhir &raquo";
        $config['last_tag_open'] = '<li class="">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = "Selanjutnya &rarr;";
        $config['next_tag_open'] = '<li class="">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = "&larr; Sebelumnya"; 
        $config['prev_tag_open'] = '<li class="">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="">';
        $config['num_tag_close'] = '</li>'; 
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
		
		$this->pagination->initialize($config);
		
		
		$this->data = array(
			'title' => "Data Restoran",
			'resto' => $this->madmin->getAllResto($config['per_page'], $this->input->get('page'), 'result')
		);

		$this->load->view('data-resto', $this->data);
	}

	public function updateresto($param = 0)
	{
		$this->data['title'] = "Update Resto";

		$this->form_validation->set_rules('name', 'Nama', 'trim|required');
		$this->form_validation->set_rules('jenis', 'Jenis', 'trim|required');
		$this->form_validation->set_rules('minimal', 'Minimal', 'trim|required');
		$this->form_validation->set_rules('maksimal', 'Maksimal', 'trim|required');
		$this->form_validation->set_rules('buka', 'Buka', 'trim|required');
		$this->form_validation->set_rules('tutup', 'Tutup', 'trim|required');
		$this->form_validation->set_rules('kapasitas', 'Kapasitas', 'trim|required');
		$this->form_validation->set_rules('harian', 'Pengunjung Harian', 'trim|required');
		$this->form_validation->set_rules('cp', 'Contact Person', 'trim|required');
		$this->form_validation->set_rules('latitude', 'Latitude', 'trim|required');
		$this->form_validation->set_rules('longitude', 'Longitude', 'trim|required');
		$this->form_validation->set_rules('jarak', 'Jarak', 'trim|required');
		$this->form_validation->set_rules('description', 'Deskripsi', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');

		if ($this->form_validation->run() == TRUE || isset($_POST['submit']))
		{
			$this->madmin->updateResto($param);

			redirect(current_url());
		}

		$this->data['resto'] = $this->madmin->getResto($param);

		$this->load->view('update-resto', $this->data);
	}

	public function deleteresto($param = 0)
	{
		$this->madmin->deleteResto($param);

		redirect('admin/resto');
	}

	public function account()
	{
		$this->data = array(
			'title' => "Pengaturan Akun",
			'user' => $this->madmin->getAccount()
		);	
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('name', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('email', 'E-Mail', 'trim|valid_email|required');
		$this->form_validation->set_rules('new_pass', 'Password Baru', 'trim|min_length[6]|max_length[12]');
		$this->form_validation->set_rules('old_pass', 'Password Lama', 'trim|required|callback_validate_password');
		if ($this->form_validation->run() == TRUE) 
		{
			$this->madmin->setAccount();
			
			redirect(current_url());
		}
		$this->load->view('account', $this->data);
	}
	
	public function validate_password()
	{
		$user = $this->madmin->getAccount();

		if($this->input->post('old_pass') == $user->password)
		{
			return true;
		} else {
			$this->form_validation->set_message('validate_password', 'Password lama anda tidak cocok!');
			return false;
		}
	}
}
?>