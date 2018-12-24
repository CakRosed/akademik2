<?php 
Class Rombel extends CI_Controller{ 
	function __construct(){
		parent:: __construct();
			check_akses_modul();
			$this->load->model('Model_rombel', 'model');
		} // end function __construct


    function index(){
    	$data = array(
				'icon'  => 'fa fa-book', 
				'title' => 'DATA ROMBONGAN BELAJAR',
				'parent'=> 'ROMBONGAN BELAJAR',
				'child' => 'LIST',
                'rombel'  => $this->db->get('tbl_rombel')->result() 
			);
    	$this->template->load('template', 'rombel/list', $data);
    } //end function index

    function add(){
        $sql = "SELECT js.jumlah_kelas 
                FROM tbl_sekolah_info as si, tbl_jenjang_sekolah as js
                WHERE si.kd_jenjang_sekolah=js.kd_jenjang";
    	$data = array(
				'icon'  => 'fa fa-book',
				'title' => 'TAMBAH ROMBONGAN BELAJAR',
				'parent'=> 'ROMBONGAN BELAJAR',
				'child' => 'TAMBAH DATA',
                'rombel'=> $this->db->query($sql)->row()
			);


    	if (isset($_POST['submit'])) {
			$this->model->add(); 		
    	}
    	$this->template->load('template', 'rombel/add', $data);
    } //end function add

    function edit(){
    	$kd_rombel= $this->uri->segment(3);
        $sql = "SELECT tjs.jumlah_kelas 
                FROM tbl_sekolah_info as tsi, tbl_jenjang_sekolah as tjs
                WHERE tsi.kd_jenjang_sekolah=tjs.kd_jenjang";
    	$data     = array(
    		'icon'  => 'fa fa-book',
			'title' => 'EDIT ROMBONGAN BELAJAR',
			'parent'=> 'ROMBONGAN BELAJAR',
			'child' => 'EDIT',
			'rombel'=> 	$this->db->get_where('tbl_rombel', array('kd_rombel' => $kd_rombel))->row_object(), 
            'kelas' => $this->db->query($sql)->row_object()
    	);

    	if (isset($_POST['submit'])) {
        	$this->model->update($kd_rombel);
        } // end if post

    	$this->template->load('template', 'rombel/edit', $data);
    } //end function edit

    function delete(){
    	$kd_rombel = $this->uri->segment(3);
    	if (!empty($kd_rombel)) {
			$this->db->where('kd_rombel', $kd_rombel);
			$delete = $this->db->delete('tbl_rombel');
    		if ($delete) {
    			echo "<script>alert('Sukses Menghapus Data');</script>";
    			redirect('rombel');
    		}else{
    			echo "<script>alert('Gagal Menghapus Data!');</script>";
    		}
    	}
    } //end function delete
} //end controller
?> 