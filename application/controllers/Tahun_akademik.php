<?php 
Class Tahun_akademik extends CI_Controller{
	function __construct(){
		parent:: __construct();
			check_akses_modul();
			$this->load->model('Model_tahun_akademik', 'model');
		} // end function __construct


    function index(){
    	$data = array(
				'icon'  => 'fa fa-building',
				'title' => 'DATA TAHUN AKADEMIK',
				'parent'=> 'TAHUN AKADEMIK',
				'child' => 'LIST',
				'tahun_akademik'  => $this->db->get('tbl_tahun_akademik')->result() 
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
			$this->model->add();
    	}
    	$this->template->load('template', 'tahun_akademik/add', $data);
    } //end function add

    function edit(){
    	$kd_tahun_akademik = $this->uri->segment(3);
    	$data  = array(
    		'icon'  => 'fa fa-calendar-o',
			'title' => 'TAHUN_AKADEMIK',
			'parent'=> 'TAHUN AKADEMIK',
			'child' => 'EDIT',
			'tahun_akademik' => $this->db->get_where('tbl_tahun_akademik', array('kd_tahun_akademik' => $kd_tahun_akademik))->row_object() 
    	);

    	if (isset($_POST['submit'])) {
			$this->model->update();
        } // end if post
    	$this->template->load('template', 'tahun_akademik/edit', $data);
    } //end function edit

    function delete(){
    	$kd_tahun_akademik = $this->uri->segment(3);
    	if (!empty($kd_tahun_akademik)) {
			$this->db->where('kd_tahun_akademik', $kd_tahun_akademik);
    		$delete = $this->db->delete('tbl_tahun_akademik');
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