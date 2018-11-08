<?php 
 Class Ruangan extends CI_Controller{
 	function __construct(){
 		parent:: __construct();
 			$this->load->model('Model_global', 'model');
 	} // end function __construct


    function index(){
    	$data = array(
				'icon'  => 'fa fa-building',
				'title' => 'DATA RUANGAN',
				'parent'=> 'RUANGAN',
				'child' => 'LIST',
				'ruangan'  => $this->model->get_all_data('*', 'tbl_ruangan')->result() 
			);
    	$this->template->load('template', 'ruangan/list', $data);
    } //end function index

    function add(){
    	$data = array(
				'icon'  => 'fa fa-book',
				'title' => 'INPUT RUANGAN',
				'parent'=> 'RUANGAN',
				'child' => 'INPUT' 
			);

    	if (isset($_POST['submit'])) {
    		$kd_ruangan 	= strip_tags(trim($this->input->post('kd_ruangan', TRUE)));
    		$check 	= $this->model->get_data('*', 'tbl_ruangan', 'kd_ruangan="'.$kd_ruangan.'"');
    		if ($check->num_rows() > 0) {
    			$nama = $check->row_object('nama_ruangan');
    			echo "<script>alert('KODE ruangan telah terdaftar oleh ".$nama->nama_ruangan."');</script>";
    		}else{
    			// definisikan data
    			$param = array(
    				'kd_ruangan' 		=> strip_tags(trim($this->input->post('kd_ruangan'))),
    				'nama_ruangan' 		=> strip_tags(trim($this->input->post('nama_ruangan')))
    			);
    			// print_r($param);
    			// die;

    			$simpan = $this->model->save_data($param, 'tbl_ruangan');
    			if ($simpan) {
    				echo "<script>alert('Berhasil Menambah Data');</script>";
    				redirect('ruangan');
    			}else{
    				echo "<script>alert('Gagal menambah data!');</script>";
    			}
    		}
    	}
    	$this->template->load('template', 'ruangan/add', $data);
    } //end function add

    function edit(){
    	$kd_ruangan = $this->uri->segment(3);
    	$data  = array(
    		'icon'  => 'fa fa-book',
			'title' => 'EDIT RUANGAN',
			'parent'=> 'RUANGAN',
			'child' => 'EDIT',
			'ruangan' => $this->model->get_data('*', 'tbl_ruangan', "kd_ruangan='".$kd_ruangan."'")->row_object() 
    	);

    	if (isset($_POST['submit'])) {
    		$kd_ruangan 	= strip_tags(trim($this->input->post('kd_ruangan', TRUE)));
    		$param = array(
                    'nama_ruangan' => strip_tags(trim($this->input->post('nama_ruangan')))
                );

            $update = $this->model->update_data($kd_ruangan, 'kd_ruangan', $param, 'tbl_ruangan');
    	   if ($update) {
                echo "<scipt>alert('Sukses Mendaftar Mata Pelajaran');</script>";
                redirect('ruangan');
           }else{
                echo "<script>alert('Gagal Mendaftar Mata Kuliah!');</script>";
           }
        } // end if post

    	$this->template->load('template', 'ruangan/edit', $data);
    } //end function edit

    function delete(){
    	$kd_ruangan = $this->uri->segment(3);
    	if (!empty($kd_ruangan)) {
    		$delete = $this->model->delete_data($kd_ruangan, 'kd_ruangan', 'tbl_ruangan');
    		if ($delete) {
    			echo "<script>alert('Sukses Menghapus Data');</script>";
    			redirect('ruangan');
    		}else{
    			echo "<script>alert('Gagal Menghapus Data!');</script>";
    		}
    	}
    } //end function delete
 }
 ?> 