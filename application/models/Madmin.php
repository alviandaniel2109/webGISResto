<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Madmin extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('upload','session'));
	}
	
	public function createResto()
	{
		$config['upload_path'] = './public/image/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_width']  = 1024*3;
		$config['max_height']  = 768*3;
		$config['overwrite'] = FALSE;
		
		$this->upload->initialize($config);

		for($i = 1; $i <= 4; $i++){
			if ( ! $this->upload->do_upload('photo'.$i))
			{
				${"photo".$i} = ""; 
				$this->session->set_flashdata('message', $this->upload->display_errors());
			} else{
				${"photo".$i} = $this->upload->file_name;
			}
		}

		$object = array(
			'ID_JENIS'		=> $this->input->post('jenis'),
			'NAMA' 			=> $this->input->post('name'),
			'ALAMAT' 		=> $this->input->post('alamat'),
			'JAM_BUKA' 		=> $this->input->post('buka'),
			'JAM_TUTUP' 	=> $this->input->post('tutup'),
			'CONTACT_PERSON'=> $this->input->post('cp'),
			'LATITUDE'		=> $this->input->post('latitude'),
			'LONGITUDE'		=> $this->input->post('longitude'),
			'KAPASITAS'		=> $this->input->post('kapasitas'),
			'HARGA_MINIMAL'	=> $this->input->post('minimal'),
			'HARGA_MAKSIMAL'=> $this->input->post('maksimal'),
			'GAMBAR_SAMPING'=> $photo1,
			'GAMBAR_DEPAN'	=> $photo2,
			'GAMBAR_ATAS'	=> $photo3,
			'GAMBAR_JALAN'	=> $photo4,
			'DESKRIPSI' 	=> $this->input->post('description')
		);

		$this->db->insert('resto', $object);

		$this->session->set_flashdata('message', "Data Resto berhasil ditambahkan");
	}

	public function getResto($param = 0)
	{
		return $this->db->get_where('resto', array('ID_RESTO' => $param) )->row();
	}

	public function categoryResto($resto = 0, $category = 0)
	{
		return $this->db->get_where('jenis', array('ID_JENIS' => $resto, 'ID_JENIS' => $category) )->row();
	}

	public function updateResto($param = 0)
	{
		$resto = $this->getResto($param);

		$config['upload_path'] = './public/image/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_width']  = 1024*3;
		$config['max_height']  = 768*3;
		$config['overwrite'] = TRUE;
		
		$this->upload->initialize($config);

		for($i = 1; $i <= 4; $i++){
			if($_FILES['photo'.$i]['name'] != ""){
				if ( ! $this->upload->do_upload('photo'.$i))
				{
					$this->session->set_flashdata('message', $this->upload->display_errors());
				} else{
					${"photo".$i} = $this->upload->file_name;
				}
			}else{
				${"photo".$i} = $this->input->post('old'.$i);
			}
		}

		$object = array(
			'ID_JENIS'		=> $this->input->post('jenis'),
			'NAMA' 			=> $this->input->post('name'),
			'ALAMAT' 		=> $this->input->post('alamat'),
			'JAM_BUKA' 		=> $this->input->post('buka'),
			'JAM_TUTUP' 	=> $this->input->post('tutup'),
			'CONTACT_PERSON'=> $this->input->post('cp'),
			'LATITUDE'		=> $this->input->post('latitude'),
			'LONGITUDE'		=> $this->input->post('longitude'),
			'KAPASITAS'		=> $this->input->post('kapasitas'),
			'HARGA_MINIMAL'	=> $this->input->post('minimal'),
			'HARGA_MAKSIMAL'=> $this->input->post('maksimal'),
			'GAMBAR_SAMPING'=> $photo1,
			'GAMBAR_DEPAN'	=> $photo2,
			'GAMBAR_ATAS'	=> $photo3,
			'GAMBAR_JALAN'	=> $photo4,
			'DESKRIPSI' 	=> $this->input->post('description')
		);

		$this->db->update('resto', $object, array('ID_RESTO' => $this->input->post('idne')));

		$this->session->set_flashdata('message', "Perubahan berhasil disimpan");
	}

	public function getDataResto(){
		$this->db->select('*');
		$this->db->from('resto');
		$this->db->join('jenis', 'jenis.ID_JENIS = resto.ID_JENIS');

		$query = $this->db->get();

		return $query->result();
	}

	public function getAllResto($limit = 10, $offset = 0, $type = 'result')
	{
		if( $this->input->get('q') != '')
			$this->db->like('NAMA', $this->input->get('q'));

		$this->db->join('jenis', 'jenis.ID_JENIS = resto.ID_JENIS');
		$this->db->order_by('ID_RESTO', 'desc');

		if($type == 'num')
		{
			return $this->db->get('resto')->num_rows();
		} else {
			return $this->db->get('resto', $limit, $offset)->result();
		}
	}

	public function deleteResto($param = 0)
	{
		$resto = $this->getResto($param);

		$this->db->delete('resto', array('ID_RESTO' => $param));

		$this->session->set_flashdata('message', "Data Resto berhasil dihapus");
	}

	public function setAccount()
	{
		$user = $this->getAccount();

		$object = array(
			'fullname' => $this->input->post('name'),
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email')
		);

		if( $this->input->post('new_pass') != '')
			$object['password'] = $this->input->post('new_pass');
		
		$this->db->update('users', $object, array('ID' => $user->ID));

		$this->session->set_flashdata('message', "Perubahan berhasil disimpan.");
	}

	public function getAccount()
	{
		return $this->db->get_where('users', array('ID' => $this->session->userdata('user')->ID) )->row();
	}
}

/* End of file Madmin.php */
/* Location: ./application/models/Madmin.php */