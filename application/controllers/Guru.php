<?php 
Class Guru extends CI_Controller{
	function __construct(){
		parent:: __construct();
			// $this->load->library('form_validation');
			check_akses_modul();
			$this->load->model('Model_guru', 'model');
	} // end function __construct


    function index(){
    	$data = array(
				'icon'  => 'fa fa-graduation-cap',
				'title' => 'DATA GURU',
				'parent'=> 'GURU',
				'child' => 'LIST',
				'guru'  => $this->db->get('tbl_guru')->result() 
			);
    	$this->template->load('template', 'guru/list', $data);
    } //end function index

    function add(){
    	$data = array(
				'icon'  => 'fa fa-graduation-cap',
				'title' => 'INPUT GURU',
				'parent'=> 'GURU',
				'child' => 'INPUT'
			);

    	if (isset($_POST['submit'])) {
			$nuptk = strip_tags(trim($this->input->post('nuptk')));
			$foto = $this->model->upload_foto($nuptk);
    		$this->model->add($foto);
    	}
		$this->template->load('template', 'guru/add', $data);
	}
	
	function edit(){
		$nuptk = strip_tags(trim($this->uri->segment(3)));
    	$data  = array(
    		'icon'  => 'fa fa-graduation-cap',
			'title' => 'EDIT GURU',
			'parent'=> 'GURU',
			'child' => 'EDIT',
			'guru'  => $this->db->get_where('tbl_guru', array('nuptk' => $nuptk))->row() 
		);
		

		if(isset($_POST['submit'])){
			$nuptk 	= strip_tags(trim($this->input->post('nuptk')));
			$foto 	= $this->model->upload_foto($nuptk);
			$this->model->update($foto, $nuptk);
		} //end post
		$this->template->load('template', 'guru/edit', $data);
	} //end edit

    function delete(){
    	$nuptk = $this->uri->segment(3);
    	if (!empty($nuptk)) {
			$this->db->where('nuptk', $nuptk);
    		$delete = $this->db->delete_data('tbl_guru');
    		if ($delete) {
    			echo "<script>alert('Sukses Menghapus Data');</script>";
    			redirect('guru');
    		}else{
    			echo "<script>alert('Gagal Menghapus Data!');</script>";
    		}
    	}
    } //end function delete
}
?> 