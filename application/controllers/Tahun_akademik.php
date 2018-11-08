<?php 
 Class Tahun_akademik extends CI_Controller{
 	function __construct(){
 		parent:: __construct();
 			$this->load->model('Model_global', 'model');
 	} // end function __construct


    function index(){
    	$data = array(
				'icon'  => 'fa fa-building',
				'title' => 'DATA TAHUN AKADEMIK',
				'parent'=> 'TAHUN AKADEMIK',
				'child' => 'LIST',
				'tahun_akademik'  => $this->model->get_all_data('*', 'tbl_tahun_akademik')->result() 
			);
    	$this->template->load('template', 'tahun_akademik/list', $data);
    } //end function index

    function add(){
    	$data = array(
				'icon'  => 'fa fa-calendar-o',
				'title' => 'INPUT TAHUN AKADEMIK',
				'parent'=> 'TAHUN AKADEMIK',
				'child' => 'INPUT' 
			);

    	if (isset($_POST['submit'])) {
            $tahun = trim($this->input->post('tahun_akademik'));
    		$check = $this->model->get_data('*', 'tbl_tahun_akademik', 'tahun_akademik="'.$tahun.'"');
            if ($check->num_rows() > 0) {
                echo "<script>alert('Tahun Akademik Telah Terdaftar!');</script>";
            }else{
                $param = array(
                    'kd_tahun_akademik' => '',
                    'tahun_akademik'    => strip_tags(trim($this->input->post('tahun_akademik'))),
                    'is_aktif'          => strip_tags(trim($this->input->post('is_aktif')))
                );

                $simpan = $this->model->save_data($param, 'tbl_tahun_akademik');
                if ($simpan) {
                    echo "<script>alert('Berhasil Menambah Data');</script>";
                    redirect('tahun_akademik');
                }else{
                    echo "<script>alert('Gagal menambah data!');</script>";
                }
            }
    	}
    	$this->template->load('template', 'tahun_akademik/add', $data);
    } //end function add

    function edit(){
    	$kd_tahun_akademik = $this->uri->segment(3);
    	$data  = array(
    		'icon'  => 'fa fa-calendar-o',
			'title' => 'EDIT tahun_akademik',
			'parent'=> 'TAHUN AKADEMIK',
			'child' => 'EDIT',
			'tahun_akademik' => $this->model->get_data('*', 'tbl_tahun_akademik', "kd_tahun_akademik='".$kd_tahun_akademik."'")->row_object() 
    	);

    	if (isset($_POST['submit'])) {
    		$kd_tahun_akademik 	= strip_tags(trim($this->input->post('kd_tahun_akademik', TRUE)));
    		$param = array(
                    'kd_tahun_akademik' => $kd_tahun_akademik,
                    'tahun_akademik'    => trim($this->input->post('tahun_akademik')),
                    'is_aktif'          => strip_tags(trim($this->input->post('is_aktif')))
                );

            $update = $this->model->update_data($kd_tahun_akademik, 'kd_tahun_akademik', $param, 'tbl_tahun_akademik');
    	   if ($update) {
                echo "<scipt>alert('Sukses Mendaftar Mata Pelajaran');</script>";
                redirect('tahun_akademik');
           }else{
                echo "<script>alert('Gagal Mendaftar Mata Kuliah!');</script>";
           }
        } // end if post

    	$this->template->load('template', 'tahun_akademik/edit', $data);
    } //end function edit

    function delete(){
    	$kd_tahun_akademik = $this->uri->segment(3);
    	if (!empty($kd_tahun_akademik)) {
    		$delete = $this->model->delete_data($kd_tahun_akademik, 'kd_tahun_akademik', 'tbl_tahun_akademik');
    		if ($delete) {
    			echo "<script>alert('Sukses Menghapus Data');</script>";
    			redirect('tahun_akademik');
    		}else{
    			echo "<script>alert('Gagal Menghapus Data!');</script>";
    		}
    	}
    } //end function delete
 }
 ?> 