<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdata extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('upload','session'));
	}

	function tampil_cafe($keyword, $jenis, $harga, $kapasitas, $waktu, $jarak)
	{
		$this->db->select('*');
		$this->db->from('resto');
		$this->db->join('jenis', 'jenis.ID_JENIS = resto.ID_JENIS');
		$this->db->where('resto.ID_JENIS', 1);

		if(isset($_POST['murah'])){
			$this->db->group_by('HARGA_MINIMAL', 'ASC');
			$this->db->limit(1);
		}else if(isset($_POST['pop'])){
			$this->db->group_by('PENGUNJUNG_HARIAN', 'DESC');
			$this->db->limit(1);
		}else{
			if ($keyword != "") {
				$this->db->group_start();
				$this->db->like('NAMA', $keyword, 'both');
				$this->db->or_like('ALAMAT', $keyword, 'both');
				$this->db->or_like('DESKRIPSI', $keyword, 'both');
				$this->db->group_end();
			}

			if ($jenis != "") {
				$this->db->where('resto.ID_JENIS', $jenis, 'both');
			}

			if ($harga != "") {
				if($harga == "1") {
					$this->db->where('HARGA_MINIMAL <= ', '10000');
				}else if($harga == "2"){
					$this->db->where('HARGA_MINIMAL >= ', '10000');
					$this->db->where('HARGA_MINIMAL <= ', '20000');
				}else if($harga == "3"){
					$this->db->where('HARGA_MINIMAL >= ', '20000');
					$this->db->where('HARGA_MINIMAL <= ', '50000');
				}else{
					$this->db->where('HARGA_MINIMAL >= ', '50000');
				}
			}

			if ($kapasitas != "") {
				if($kapasitas == "1") {
					$this->db->where('KAPASITAS <= ', '50');
				}else if($harga == "2"){
					$this->db->where('KAPASITAS >= ', '50');
					$this->db->where('KAPASITAS <= ', '100');
				}else if($harga == "3"){
					$this->db->where('KAPASITAS >= ', '100');
					$this->db->where('KAPASITAS <= ', '200');
				}else{
					$this->db->where('KAPASITAS >= ', '200');
				}
			}

			if ($waktu != "") {

				if($waktu == "1") {
					$this->db->where('JAM_BUKA >= ', '05:00');
					$this->db->where('JAM_BUKA <= ', '11:00');
				}else if($waktu == "2"){
					$this->db->where('JAM_BUKA >= ', '11:00');
					$this->db->where('JAM_BUKA <= ', '16:00');
				}else if($waktu == "3"){
					$this->db->where('JAM_BUKA >= ', '16:00');
					$this->db->where('JAM_BUKA <= ', '23:00');
				}else{
					$this->db->where('JAM_BUKA = ', '00:00');
				}
			}

			if ($jarak != "") {
				if($jarak == "1") {
					$this->db->where('JARAK <= ', '2');
				}else if($jarak == "2"){
					$this->db->where('JARAK >= ', '2');
					$this->db->where('JARAK <= ', '5');
				}else if($jarak == "3"){
					$this->db->where('JARAK >= ', '5');
					$this->db->where('JARAK <= ', '10');
				}else{
					$this->db->where('JARAK >= ', '10');
				}
			}
		}

		$query = $this->db->get();

		return $query;
	}

	function tampil_qsr($keyword, $jenis, $harga, $kapasitas, $waktu, $jarak)
	{
		$this->db->select('*');
		$this->db->from('resto');
		$this->db->join('jenis', 'jenis.ID_JENIS = resto.ID_JENIS');
		$this->db->where('resto.ID_JENIS', 2);

		if(isset($_POST['murah'])){
			$this->db->group_by('HARGA_MINIMAL', 'ASC');
			$this->db->limit(1);
		}else if(isset($_POST['pop'])){
			$this->db->group_by('PENGUNJUNG_HARIAN', 'DESC');
			$this->db->limit(1);
		}else{
			if ($keyword != "") {
				$this->db->group_start();
				$this->db->like('NAMA', $keyword, 'both');
				$this->db->or_like('ALAMAT', $keyword, 'both');
				$this->db->or_like('DESKRIPSI', $keyword, 'both');
				$this->db->group_end();
			}

			if ($jenis != "") {
				$this->db->where('resto.ID_JENIS', $jenis, 'both');
			}

			if ($harga != "") {
				if($harga == "1") {
					$this->db->where('HARGA_MINIMAL <= ', '10000');
				}else if($harga == "2"){
					$this->db->where('HARGA_MINIMAL >= ', '10000');
					$this->db->where('HARGA_MINIMAL <= ', '20000');
				}else if($harga == "3"){
					$this->db->where('HARGA_MINIMAL >= ', '20000');
					$this->db->where('HARGA_MINIMAL <= ', '50000');
				}else{
					$this->db->where('HARGA_MINIMAL >= ', '50000');
				}
			}

			if ($kapasitas != "") {
				if($kapasitas == "1") {
					$this->db->where('KAPASITAS <= ', '50');
				}else if($harga == "2"){
					$this->db->where('KAPASITAS >= ', '50');
					$this->db->where('KAPASITAS <= ', '100');
				}else if($harga == "3"){
					$this->db->where('KAPASITAS >= ', '100');
					$this->db->where('KAPASITAS <= ', '200');
				}else{
					$this->db->where('KAPASITAS >= ', '200');
				}
			}

			if ($waktu != "") {

				if($waktu == "1") {
					$this->db->where('JAM_BUKA >= ', '05:00');
					$this->db->where('JAM_BUKA <= ', '11:00');
				}else if($waktu == "2"){
					$this->db->where('JAM_BUKA >= ', '11:00');
					$this->db->where('JAM_BUKA <= ', '16:00');
				}else if($waktu == "3"){
					$this->db->where('JAM_BUKA >= ', '16:00');
					$this->db->where('JAM_BUKA <= ', '23:00');
				}else{
					$this->db->where('JAM_BUKA = ', '00:00');
				}
			}

			if ($jarak != "") {
				if($jarak == "1") {
					$this->db->where('JARAK <= ', '2');
				}else if($jarak == "2"){
					$this->db->where('JARAK >= ', '2');
					$this->db->where('JARAK <= ', '5');
				}else if($jarak == "3"){
					$this->db->where('JARAK >= ', '5');
					$this->db->where('JARAK <= ', '10');
				}else{
					$this->db->where('JARAK >= ', '10');
				}
			}
		}

		$query = $this->db->get();

		return $query;
	}

	function tampil_bakery($keyword, $jenis, $harga, $kapasitas, $waktu, $jarak)
	{
		$this->db->select('*');
		$this->db->from('resto');
		$this->db->join('jenis', 'jenis.ID_JENIS = resto.ID_JENIS');
		$this->db->where('resto.ID_JENIS', 3);

		if(isset($_POST['murah'])){
			$this->db->group_by('HARGA_MINIMAL', 'ASC');
			$this->db->limit(1);
		}else if(isset($_POST['pop'])){
			$this->db->group_by('PENGUNJUNG_HARIAN', 'DESC');
			$this->db->limit(1);
		}else{
			if ($keyword != "") {
				$this->db->group_start();
				$this->db->like('NAMA', $keyword, 'both');
				$this->db->or_like('ALAMAT', $keyword, 'both');
				$this->db->or_like('DESKRIPSI', $keyword, 'both');
				$this->db->group_end();
			}

			if ($jenis != "") {
				$this->db->where('resto.ID_JENIS', $jenis, 'both');
			}

			if ($harga != "") {
				if($harga == "1") {
					$this->db->where('HARGA_MINIMAL <= ', '10000');
				}else if($harga == "2"){
					$this->db->where('HARGA_MINIMAL >= ', '10000');
					$this->db->where('HARGA_MINIMAL <= ', '20000');
				}else if($harga == "3"){
					$this->db->where('HARGA_MINIMAL >= ', '20000');
					$this->db->where('HARGA_MINIMAL <= ', '50000');
				}else{
					$this->db->where('HARGA_MINIMAL >= ', '50000');
				}
			}

			if ($kapasitas != "") {
				if($kapasitas == "1") {
					$this->db->where('KAPASITAS <= ', '50');
				}else if($harga == "2"){
					$this->db->where('KAPASITAS >= ', '50');
					$this->db->where('KAPASITAS <= ', '100');
				}else if($harga == "3"){
					$this->db->where('KAPASITAS >= ', '100');
					$this->db->where('KAPASITAS <= ', '200');
				}else{
					$this->db->where('KAPASITAS >= ', '200');
				}
			}

			if ($waktu != "") {

				if($waktu == "1") {
					$this->db->where('JAM_BUKA >= ', '05:00');
					$this->db->where('JAM_BUKA <= ', '11:00');
				}else if($waktu == "2"){
					$this->db->where('JAM_BUKA >= ', '11:00');
					$this->db->where('JAM_BUKA <= ', '16:00');
				}else if($waktu == "3"){
					$this->db->where('JAM_BUKA >= ', '16:00');
					$this->db->where('JAM_BUKA <= ', '23:00');
				}else{
					$this->db->where('JAM_BUKA = ', '00:00');
				}
			}

			if ($jarak != "") {
				if($jarak == "1") {
					$this->db->where('JARAK <= ', '2');
				}else if($jarak == "2"){
					$this->db->where('JARAK >= ', '2');
					$this->db->where('JARAK <= ', '5');
				}else if($jarak == "3"){
					$this->db->where('JARAK >= ', '5');
					$this->db->where('JARAK <= ', '10');
				}else{
					$this->db->where('JARAK >= ', '10');
				}
			}
		}

		$query = $this->db->get();

		return $query;
	}

	function tampil_eskrim($keyword, $jenis, $harga, $kapasitas, $waktu, $jarak)
	{
		$this->db->select('*');
		$this->db->from('resto');
		$this->db->join('jenis', 'jenis.ID_JENIS = resto.ID_JENIS');
		$this->db->where('resto.ID_JENIS', 4);

		if(isset($_POST['murah'])){
			$this->db->group_by('HARGA_MINIMAL', 'ASC');
			$this->db->limit(1);
		}else if(isset($_POST['pop'])){
			$this->db->group_by('PENGUNJUNG_HARIAN', 'DESC');
			$this->db->limit(1);
		}else{
			if ($keyword != "") {
				$this->db->group_start();
				$this->db->like('NAMA', $keyword, 'both');
				$this->db->or_like('ALAMAT', $keyword, 'both');
				$this->db->or_like('DESKRIPSI', $keyword, 'both');
				$this->db->group_end();
			}

			if ($jenis != "") {
				$this->db->where('resto.ID_JENIS', $jenis, 'both');
			}

			if ($harga != "") {
				if($harga == "1") {
					$this->db->where('HARGA_MINIMAL <= ', '10000');
				}else if($harga == "2"){
					$this->db->where('HARGA_MINIMAL >= ', '10000');
					$this->db->where('HARGA_MINIMAL <= ', '20000');
				}else if($harga == "3"){
					$this->db->where('HARGA_MINIMAL >= ', '20000');
					$this->db->where('HARGA_MINIMAL <= ', '50000');
				}else{
					$this->db->where('HARGA_MINIMAL >= ', '50000');
				}
			}

			if ($kapasitas != "") {
				if($kapasitas == "1") {
					$this->db->where('KAPASITAS <= ', '50');
				}else if($harga == "2"){
					$this->db->where('KAPASITAS >= ', '50');
					$this->db->where('KAPASITAS <= ', '100');
				}else if($harga == "3"){
					$this->db->where('KAPASITAS >= ', '100');
					$this->db->where('KAPASITAS <= ', '200');
				}else{
					$this->db->where('KAPASITAS >= ', '200');
				}
			}

			if ($waktu != "") {

				if($waktu == "1") {
					$this->db->where('JAM_BUKA >= ', '05:00');
					$this->db->where('JAM_BUKA <= ', '11:00');
				}else if($waktu == "2"){
					$this->db->where('JAM_BUKA >= ', '11:00');
					$this->db->where('JAM_BUKA <= ', '16:00');
				}else if($waktu == "3"){
					$this->db->where('JAM_BUKA >= ', '16:00');
					$this->db->where('JAM_BUKA <= ', '23:00');
				}else{
					$this->db->where('JAM_BUKA = ', '00:00');
				}
			}

			if ($jarak != "") {
				if($jarak == "1") {
					$this->db->where('JARAK <= ', '2');
				}else if($jarak == "2"){
					$this->db->where('JARAK >= ', '2');
					$this->db->where('JARAK <= ', '5');
				}else if($jarak == "3"){
					$this->db->where('JARAK >= ', '5');
					$this->db->where('JARAK <= ', '10');
				}else{
					$this->db->where('JARAK >= ', '10');
				}
			}
		}

		$query = $this->db->get();

		return $query;
	}

	function tampil_pubs($keyword, $jenis, $harga, $kapasitas, $waktu, $jarak)
	{
		$this->db->select('*');
		$this->db->from('resto');
		$this->db->join('jenis', 'jenis.ID_JENIS = resto.ID_JENIS');
		$this->db->where('resto.ID_JENIS', 5);

		if(isset($_POST['murah'])){
			$this->db->group_by('HARGA_MINIMAL', 'ASC');
			$this->db->limit(1);
		}else if(isset($_POST['pop'])){
			$this->db->group_by('PENGUNJUNG_HARIAN', 'DESC');
			$this->db->limit(1);
		}else{
			if ($keyword != "") {
				$this->db->group_start();
				$this->db->like('NAMA', $keyword, 'both');
				$this->db->or_like('ALAMAT', $keyword, 'both');
				$this->db->or_like('DESKRIPSI', $keyword, 'both');
				$this->db->group_end();
			}

			if ($jenis != "") {
				$this->db->where('resto.ID_JENIS', $jenis, 'both');
			}

			if ($harga != "") {
				if($harga == "1") {
					$this->db->where('HARGA_MINIMAL <= ', '10000');
				}else if($harga == "2"){
					$this->db->where('HARGA_MINIMAL >= ', '10000');
					$this->db->where('HARGA_MINIMAL <= ', '20000');
				}else if($harga == "3"){
					$this->db->where('HARGA_MINIMAL >= ', '20000');
					$this->db->where('HARGA_MINIMAL <= ', '50000');
				}else{
					$this->db->where('HARGA_MINIMAL >= ', '50000');
				}
			}

			if ($kapasitas != "") {
				if($kapasitas == "1") {
					$this->db->where('KAPASITAS <= ', '50');
				}else if($harga == "2"){
					$this->db->where('KAPASITAS >= ', '50');
					$this->db->where('KAPASITAS <= ', '100');
				}else if($harga == "3"){
					$this->db->where('KAPASITAS >= ', '100');
					$this->db->where('KAPASITAS <= ', '200');
				}else{
					$this->db->where('KAPASITAS >= ', '200');
				}
			}

			if ($waktu != "") {

				if($waktu == "1") {
					$this->db->where('JAM_BUKA >= ', '05:00');
					$this->db->where('JAM_BUKA <= ', '11:00');
				}else if($waktu == "2"){
					$this->db->where('JAM_BUKA >= ', '11:00');
					$this->db->where('JAM_BUKA <= ', '16:00');
				}else if($waktu == "3"){
					$this->db->where('JAM_BUKA >= ', '16:00');
					$this->db->where('JAM_BUKA <= ', '23:00');
				}else{
					$this->db->where('JAM_BUKA = ', '00:00');
				}
			}

			if ($jarak != "") {
				if($jarak == "1") {
					$this->db->where('JARAK <= ', '2');
				}else if($jarak == "2"){
					$this->db->where('JARAK >= ', '2');
					$this->db->where('JARAK <= ', '5');
				}else if($jarak == "3"){
					$this->db->where('JARAK >= ', '5');
					$this->db->where('JARAK <= ', '10');
				}else{
					$this->db->where('JARAK >= ', '10');
				}
			}
		}

		$query = $this->db->get();

		return $query;
	}

	function tampil_cdr($keyword, $jenis, $harga, $kapasitas, $waktu, $jarak)
	{
		$this->db->select('*');
		$this->db->from('resto');
		$this->db->join('jenis', 'jenis.ID_JENIS = resto.ID_JENIS');
		$this->db->where('resto.ID_JENIS', 6);

		if(isset($_POST['murah'])){
			$this->db->group_by('HARGA_MINIMAL', 'ASC');
			$this->db->limit(1);
		}else if(isset($_POST['pop'])){
			$this->db->group_by('PENGUNJUNG_HARIAN', 'DESC');
			$this->db->limit(1);
		}else{
			if ($keyword != "") {
				$this->db->group_start();
				$this->db->like('NAMA', $keyword, 'both');
				$this->db->or_like('ALAMAT', $keyword, 'both');
				$this->db->or_like('DESKRIPSI', $keyword, 'both');
				$this->db->group_end();
			}

			if ($jenis != "") {
				$this->db->where('resto.ID_JENIS', $jenis, 'both');
			}

			if ($harga != "") {
				if($harga == "1") {
					$this->db->where('HARGA_MINIMAL <= ', '10000');
				}else if($harga == "2"){
					$this->db->where('HARGA_MINIMAL >= ', '10000');
					$this->db->where('HARGA_MINIMAL <= ', '20000');
				}else if($harga == "3"){
					$this->db->where('HARGA_MINIMAL >= ', '20000');
					$this->db->where('HARGA_MINIMAL <= ', '50000');
				}else{
					$this->db->where('HARGA_MINIMAL >= ', '50000');
				}
			}

			if ($kapasitas != "") {
				if($kapasitas == "1") {
					$this->db->where('KAPASITAS <= ', '50');
				}else if($harga == "2"){
					$this->db->where('KAPASITAS >= ', '50');
					$this->db->where('KAPASITAS <= ', '100');
				}else if($harga == "3"){
					$this->db->where('KAPASITAS >= ', '100');
					$this->db->where('KAPASITAS <= ', '200');
				}else{
					$this->db->where('KAPASITAS >= ', '200');
				}
			}

			if ($waktu != "") {

				if($waktu == "1") {
					$this->db->where('JAM_BUKA >= ', '05:00');
					$this->db->where('JAM_BUKA <= ', '11:00');
				}else if($waktu == "2"){
					$this->db->where('JAM_BUKA >= ', '11:00');
					$this->db->where('JAM_BUKA <= ', '16:00');
				}else if($waktu == "3"){
					$this->db->where('JAM_BUKA >= ', '16:00');
					$this->db->where('JAM_BUKA <= ', '23:00');
				}else{
					$this->db->where('JAM_BUKA = ', '00:00');
				}
			}

			if ($jarak != "") {
				if($jarak == "1") {
					$this->db->where('JARAK <= ', '2');
				}else if($jarak == "2"){
					$this->db->where('JARAK >= ', '2');
					$this->db->where('JARAK <= ', '5');
				}else if($jarak == "3"){
					$this->db->where('JARAK >= ', '5');
					$this->db->where('JARAK <= ', '10');
				}else{
					$this->db->where('JARAK >= ', '10');
				}
			}
		}

		$query = $this->db->get();

		return $query;
	}

	function detail_resto($id){
		$this->db->select('*');
		$this->db->from('resto');
		$this->db->join('jenis', 'jenis.ID_JENIS = resto.ID_JENIS');
		$this->db->where('ID_RESTO',$id);

		return $this->db->get();
	}
}

?>