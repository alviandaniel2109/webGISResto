<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Mdata');
		$this->load->model('Madmin');
	}

	public function index()
	{
		$data['title'] = "WEBGIS RESTORAN";

		$keyword	= $this->input->post('keyword');
		$jenis		= $this->input->post('jenis');
		$harga		= $this->input->post('harga');
		$kapasitas	= $this->input->post('kapasitas');
		$waktu		= $this->input->post('waktu');
		$jarak		= $this->input->post('jarak');

		$data['peta_cafe']=$this->Mdata->tampil_cafe($keyword, $jenis, $harga, $kapasitas, $waktu, $jarak)->result();
		$data['peta_qsr']=$this->Mdata->tampil_qsr($keyword, $jenis, $harga, $kapasitas, $waktu, $jarak)->result();
		$data['peta_bakery']=$this->Mdata->tampil_bakery($keyword, $jenis, $harga, $kapasitas, $waktu, $jarak)->result();
		$data['peta_eskrim']=$this->Mdata->tampil_eskrim($keyword, $jenis, $harga, $kapasitas, $waktu, $jarak)->result();
		$data['peta_pubs']=$this->Mdata->tampil_pubs($keyword, $jenis, $harga, $kapasitas, $waktu, $jarak)->result();
		$data['peta_cdr']=$this->Mdata->tampil_cdr($keyword, $jenis, $harga, $kapasitas, $waktu, $jarak)->result();

		$this->load->view('main-index', $data);
	}

	public function home()
	{

		$data['title']	= "WEBGIS RESTORAN";
		$data['resto'] 	= $this->Madmin->getDataResto();

		$this->load->view('home', $data);
	}

	public function detailResto($id){
		$data['title'] = "WEBGIS RESTORAN";
		$data['detail_resto'] = $this->Mdata->detail_resto($id)->result();

		$this->load->view('detail-resto', $data);
	}
}

?>