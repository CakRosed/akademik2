<?php 
 Class Jurusan extends CI_Controller{
 	function __construct(){
 		parent:: __construct();
 			$this->load->model('Model_global', 'model');
 	} // end function __construct


    function index(){
    	$data = array(
				'icon'  => 'fa fa-th-large',
				'title' => 'DATA JURUSAN',
				'parent'=> 'JURUSAN',
				'child' => 'LIST',
				'jurusan'  => $this->model->get_all_data('*', 'tbl_jurusan')->result() 
			);
    	$this->template->load('template', 'jurusan/list', $data);
    } //end function index

    function add(){
    	$data = array(
				'icon'  => 'fa fa-th-large',
				'title' => 'INPUT JURUSAN',
				'parent'=> 'JURUSAN',
				'child' => 'INPUT' 
			);

    	if (isset($_POST['submit'])) {
    		$kd_jurusan 	= strip_tags(trim($this->input->post('kd_jurusan', TRUE)));
    		$check 	= $this->model->get_data('*', 'tbl_jurusan', 'kd_jurusan="'.$kd_jurusan.'"');
    		if ($check->num_rows() > 0) {
    			$nama = $check->row_object('nama_jurusan');
    			echo "<script>alert('KODE jurusan telah terdaftar oleh ".$nama->nama_jurusan."');</script>";
    		}else{
    			// definisikan data
    			$param = array(
    				'kd_jurusan' 		=> strip_tags(trim($this->input->post('kd_jurusan'))),
    				'nama_jurusan' 		=> strip_tags(trim($this->input->post('nama_jurusan')))
    			);
    			// print_r($param);
    			// die;

    			$simpan = $this->model->save_data($param, 'tbl_jurusan');
    			if ($simpan) {
    				echo "<script>alert('Berhasil Menambah Data');</script>";
    				redirect('jurusan');
    			}else{
    				echo "<script>alert('Gagal menambah data!');</script>";
    			}
    		}
    	}
    	$this->template->load('template', 'jurusan/add', $data);
    } //end function add

    function edit(){
    	$kd_jurusan = $this->uri->segment(3);
    	$data  = array(
    		'icon'  => 'fa fa-th-large',
			'title' => 'EDIT JURUSAN',
			'parent'=> 'JURUSAN',
			'child' => 'EDIT',
			'jurusan' => $this->model->get_data('*', 'tbl_jurusan', "kd_jurusan='".$kd_jurusan."'")->row_object() 
    	);

    	if (isset($_POST['submit'])) {
    		$kd_jurusan 	= strip_tags(trim($this->input->post('kd_jurusan', TRUE)));
    		$param = array(
                    'nama_jurusan' => strip_tags(trim($this->input->post('nama_jurusan')))
                );

            $update = $this->model->update_data($kd_jurusan, 'kd_jurusan', $param, 'tbl_jurusan');
    	   if ($update) {
                echo "<scipt>alert('Sukses Mendaftar Mata Pelajaran');</script>";
                redirect('jurusan');
           }else{
                echo "<script>alert('Gagal Mendaftar Mata Kuliah!');</script>";
           }
        } // end if post

    	$this->template->load('template', 'jurusan/edit', $data);
    } //end function edit

    function delete(){
    	$kd_jurusan = $this->uri->segment(3);
    	if (!empty($kd_jurusan)) {
    		$delete = $this->model->delete_data($kd_jurusan, 'kd_jurusan', 'tbl_jurusan');
    		if ($delete) {
    			echo "<script>alert('Sukses Menghapus Data');</script>";
    			redirect('jurusan');
    		}else{
    			echo "<script>alert('Gagal Menghapus Data!');</script>";
    		}
    	}
    } //end function delete
 }
 ?> 