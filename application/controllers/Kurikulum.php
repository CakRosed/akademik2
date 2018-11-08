<?php 
 Class Kurikulum extends CI_Controller{
 	function __construct(){
 		parent:: __construct();
 			$this->load->model('Model_global', 'model');
 	} // end function __construct


    function index(){
    	$data = array(
				'icon'  => 'fa fa-newspaper-o',
				'title' => 'DATA KURIKULUM',
				'parent'=> 'KURIKULUM',
				'child' => 'LIST',
				'kurikulum'  => $this->model->get_all_data('*', 'tbl_kurikulum')->result() 
			);
    	$this->template->load('template', 'kurikulum/list', $data);
    } //end function index

    function add(){
    	$data = array(
				'icon'  => 'fa fa-calendar-o',
				'title' => 'INPUT KURIKULUM',
				'parent'=> 'KURIKULUM',
				'child' => 'INPUT' 
			);

    	if (isset($_POST['submit'])) {
            $kurikulum  = trim($this->input->post('nama_kurikulum'));
    		$check      = $this->model->get_data('*', 'tbl_kurikulum', 'nama_kurikulum="'.$kurikulum.'"');
            if ($check->num_rows() > 0) {
                echo "<script>alert('kurikulum Telah TERDAFTAR! silahkan cek ulang');</script>";
            }else{
                $param = array(
                    'nama_kurikulum'    => strip_tags(trim($this->input->post('nama_kurikulum'))),
                    'is_aktif'          => strip_tags(trim($this->input->post('is_aktif')))
                );


                $simpan = $this->model->save_data($param, 'tbl_kurikulum');
                if ($simpan) {
                    echo "<script>alert('Berhasil Menambah Data');</script>";
                    redirect('kurikulum');
                }else{
                    echo "<script>alert('Gagal menambah data!');</script>";
                }
            }
    	}
    	$this->template->load('template', 'kurikulum/add', $data);
    } //end function add

    function edit(){ 
    	$id_kurikulum = $this->uri->segment(3);
    	$data  = array(
    		'icon'  => 'fa fa-newspaper-o',
			'title' => 'EDIT KURIKULUM',
			'parent'=> 'KURIKULUM',
			'child' => 'EDIT',
			'kurikulum' => $this->model->get_data('*', 'tbl_kurikulum', "id_kurikulum='".$id_kurikulum."'")->row_object() 
    	);

    	if (isset($_POST['submit'])) {
    		$id_kurikulum 	= strip_tags(trim($this->input->post('id_kurikulum', TRUE)));
    		$param = array(
                    'id_kurikulum'      => $id_kurikulum,
                    'nama_kurikulum'    => trim($this->input->post('nama_kurikulum')),
                    'is_aktif'          => strip_tags(trim($this->input->post('is_aktif')))
                );
            // print_r($param); die;

            $update = $this->model->update_data($id_kurikulum, 'id_kurikulum', $param, 'tbl_kurikulum');
    	   if ($update) {
                echo "<scipt>alert('Sukses Mendaftar Mata Pelajaran');</script>";
                redirect('kurikulum');
           }else{
                echo "<script>alert('Gagal Mendaftar Mata Kuliah!');</script>";
           }
        } // end if post

    	$this->template->load('template', 'kurikulum/edit', $data);
    } //end function edit

    function delete(){
    	$id_kurikulum = $this->uri->segment(3);
    	if (!empty($id_kurikulum)) {
    		$delete = $this->model->delete_data($id_kurikulum, 'id_kurikulum', 'tbl_kurikulum');
    		if ($delete) {
    			echo "<script>alert('Sukses Menghapus Data');</script>";
    			redirect('kurikulum');
    		}else{
    			echo "<script>alert('Gagal Menghapus Data!');</script>";
    		}
    	}
    } //end function delete
 }
 ?> 