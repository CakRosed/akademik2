<?php 
 Class Mapel extends CI_Controller{
 	function __construct(){
		parent:: __construct();
		$this->load->model('Model_global', 'model');
			check_akses_modul();
		} // end function __construct


    function index(){ 
    	$data = array(
				'icon'  => 'fa fa-book',
				'title' => 'DATA MAPEL',
				'parent'=> 'MAPEL',
				'child' => 'LIST',
				'mapel'  => $this->model->get_all_data('*', 'tbl_mapel')->result() 
			);
    	$this->template->load('template', 'mapel/list', $data);
    } //end function index

    function add(){
    	$data = array(
				'icon'  => 'fa fa-book',
				'title' => 'INPUT MAPEL',
				'parent'=> 'MAPEL',
				'child' => 'INPUT'
			);

    	if (isset($_POST['submit'])) {
    		$kd_mapel 	= strip_tags(trim($this->input->post('kd_mapel', TRUE)));
    		$check 	= $this->model->get_data('*', 'tbl_mapel', 'kd_mapel="'.$kd_mapel.'"');
    		if ($check->num_rows() > 0) {
    			$nama = $check->row_object('nama_mapel');
    			echo "<script>alert('KODE MAPEL telah terdaftar oleh ".$nama->nama_mapel."');</script>";
    		}else{
    			// definisikan data
    			$param = array(
    				'kd_mapel' 		=> strip_tags(trim($this->input->post('kd_mapel'))),
    				'nama_mapel' 	=> strip_tags(trim($this->input->post('nama_mapel')))
    			);
    			// print_r($param);
    			// die;

    			$simpan = $this->model->save_data($param, 'tbl_mapel');
    			if ($simpan) {
    				echo "<script>alert('Berhasil Menambah Data');</script>";
    				redirect('mapel');
    			}else{
    				echo "<script>alert('Gagal menambah data!');</script>";
    			}
    		}
    	}
    	$this->template->load('template', 'mapel/add', $data);
    } //end function add

    function edit(){
    	$kd_mapel = $this->uri->segment(3);
    	$data  = array(
    		'icon'  => 'fa fa-book',
			'title' => 'EDIT MAPEL',
			'parent'=> 'MAPEL',
			'child' => 'EDIT',
			'mapel' => $this->model->get_data('*', 'tbl_mapel', "kd_mapel='".$kd_mapel."'")->row_object() 
    	);

    	if (isset($_POST['submit'])) {
    		$kd_mapel 	= strip_tags(trim($this->input->post('kd_mapel', TRUE)));
    		$param = array(
                    'nama_mapel' => strip_tags(trim($this->input->post('nama_mapel')))
                );

            $update = $this->model->update_data($kd_mapel, 'kd_mapel', $param, 'tbl_mapel');
    	   if ($update) {
                echo "<scipt>alert('Sukses Mendaftar Mata Pelajaran');</script>";
                redirect('mapel');
           }else{
                echo "<script>alert('Gagal Mendaftar Mata Kuliah!');</script>";
           }
        } // end if post

    	$this->template->load('template', 'mapel/edit', $data);
    } //end function edit

    function delete(){
    	$kd_mapel = $this->uri->segment(3);
    	if (!empty($kd_mapel)) {
    		$delete = $this->model->delete_data($kd_mapel, 'kd_mapel', 'tbl_mapel');
    		if ($delete) {
    			echo "<script>alert('Sukses Menghapus Data');</script>";
    			redirect('mapel');
    		}else{
    			echo "<script>alert('Gagal Menghapus Data!');</script>";
    		}
    	}
    } //end function delete
 }
 ?> 