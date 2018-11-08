<?php 
 Class Rombel extends CI_Controller{
 	function __construct(){
 		parent:: __construct();
 			$this->load->model('Model_global', 'model');
 	} // end function __construct


    function index(){
    	$data = array(
				'icon'  => 'fa fa-book',
				'title' => 'DATA rombel',
				'parent'=> 'ROMBONGAN BELAJAR',
				'child' => 'LIST',
				'rombel'  => $this->model->get_all_data('*', 'tbl_rombel')->result() 
			);
    	$this->template->load('template', 'rombel/list', $data);
    } //end function index

    function add(){
    	$data = array(
				'icon'  => 'fa fa-book',
				'title' => 'INPUT rombel',
				'parent'=> 'ROMBONGAN BELAJAR',
				'child' => 'INPUT'
			);

    	if (isset($_POST['submit'])) {
    		$kd_rombel 	= strip_tags(trim($this->input->post('kd_rombel', TRUE)));
    		$check 	= $this->model->get_data('*', 'tbl_rombel', 'kd_rombel="'.$kd_rombel.'"');
    		if ($check->num_rows() > 0) {
    			$nama = $check->row_object('nama_rombel');
    			echo "<script>alert('KODE rombel telah terdaftar oleh ".$nama->nama_rombel."');</script>";
    		}else{
    			// definisikan data
    			$param = array(
    				'kd_rombel' 		=> strip_tags(trim($this->input->post('kd_rombel'))),
    				'nama_rombel' 	=> strip_tags(trim($this->input->post('nama_rombel')))
    			);
    			// print_r($param);
    			// die;

    			$simpan = $this->model->save_data($param, 'tbl_rombel');
    			if ($simpan) {
    				echo "<script>alert('Berhasil Menambah Data');</script>";
    				redirect('rombel');
    			}else{
    				echo "<script>alert('Gagal menambah data!');</script>";
    			}
    		}
    	}
    	$this->template->load('template', 'rombel/add', $data);
    } //end function add

    function edit(){
    	$kd_rombel = $this->uri->segment(3);
    	$data  = array(
    		'icon'  => 'fa fa-book',
			'title' => 'EDIT rombel',
			'parent'=> 'ROMBONGAN BELAJAR',
			'child' => 'EDIT',
			'rombel' => $this->model->get_data('*', 'tbl_rombel', "kd_rombel='".$kd_rombel."'")->row_object() 
    	);

    	if (isset($_POST['submit'])) {
    		$kd_rombel 	= strip_tags(trim($this->input->post('kd_rombel', TRUE)));
    		$param = array(
                    'nama_rombel' => strip_tags(trim($this->input->post('nama_rombel')))
                );

            $update = $this->model->update_data($kd_rombel, 'kd_rombel', $param, 'tbl_rombel');
    	   if ($update) {
                echo "<scipt>alert('Sukses Mendaftar Mata Pelajaran');</script>";
                redirect('rombel');
           }else{
                echo "<script>alert('Gagal Mendaftar Mata Kuliah!');</script>";
           }
        } // end if post

    	$this->template->load('template', 'rombel/edit', $data);
    } //end function edit

    function delete(){
    	$kd_rombel = $this->uri->segment(3);
    	if (!empty($kd_rombel)) {
    		$delete = $this->model->delete_data($kd_rombel, 'kd_rombel', 'tbl_rombel');
    		if ($delete) {
    			echo "<script>alert('Sukses Menghapus Data');</script>";
    			redirect('rombel');
    		}else{
    			echo "<script>alert('Gagal Menghapus Data!');</script>";
    		}
    	}
    } //end function delete
 }
 ?> 