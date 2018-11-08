<?php 
 Class Guru extends CI_Controller{
 	function __construct(){
 		parent:: __construct();
 			$this->load->model('Model_global', 'model');
 			$this->load->library('form_validation');
 	} // end function __construct


    function index(){
    	$data = array(
				'icon'  => 'fa fa-graduation-cap',
				'title' => 'DATA GURU',
				'parent'=> 'GURU',
				'child' => 'LIST',
				'guru'  => $this->model->get_all_data('*', 'tbl_guru')->result() 
			);
    	$this->template->load('template', 'guru/list', $data);
    } //end function index

    function add(){
    	$data = array(
				'icon'  => 'fa fa-graduation-cap',
				'title' => 'INPUT GURU',
				'parent'=> 'GURU',
				'child' => 'INPUT',
			);

    	if (isset($_POST['submit'])) {
    		$nuptk 	= strip_tags(trim($this->input->post('nuptk', TRUE)));
    		$gender = $this->input->post('gender', TRUE); 
    		$check 	= $this->model->get_data('*', 'tbl_guru', 'nuptk='.$nuptk);
    		if ($check->num_rows() > 0) {
    			$nama = $check->row_object('nama_guru');
    			echo "<script>alert('NUPTK telah terdaftar oleh ".$nama->nama_guru."');</script>";
    		}else{
    			// konfigurasi upload foto
    			$config = array(
    				'upload_path' 	=> './upload/guru',
    				'allowed_types'	=> 'jpg|jpeg|png',
    				'max_size'		=> 1024,
    				'file_name'		=> $nuptk,
    				'overwrite'		=> TRUE
    			);
    			$this->load->library('upload', $config);

    			// proses upload
    			$uploaded = $this->upload->do_upload('userfile');
    			if ($uploaded) {
    				$fotodb = $nuptk;
    			}else{
    				if ($gender == 'L') {
    					$fotodb = 'avatarL.png';
    				}else{
    					$fotodb = 'avatarP.png';
    				}
    			}
    			// tangkap data
    			$upload = $this->upload->data();

    			// definisikan data
    			$param = array(
    				'nuptk' 		=> strip_tags(trim($this->input->post('nuptk'))),
    				'nama_guru' 	=> strip_tags(trim($this->input->post('nama'))),
    				'tempat_lahir'	=> strip_tags(trim(strtoupper($this->input->post('tempat_lahir')))),
    				'tanggal_lahir'	=> strip_tags(trim($this->input->post('tanggal_lahir'))),
    				'nomor'			=> strip_tags(trim($this->input->post('nomor'))),
    				'email'			=> strip_tags(trim($this->input->post('email'))),
    				'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir'),
    				'gender'		=> $this->input->post('gender'),
    				'kd_agama'		=> $this->input->post('agama'),
    				'alamat'		=> strip_tags(trim($this->input->post('alamat'))),
    				'foto'			=> $fotodb.$upload['file_ext']
    			);
    			// print_r($param);
    			// die;

    			$simpan = $this->model->save_data($param, 'tbl_guru');
    			if ($simpan) {
    				echo "<script>alert('Berhasil Menambah Data');</script>";
    				redirect('guru');
    			}else{
    				echo "<script>alert('Gagal menambah data!');</script>";
    			}
    		}
    	}
    	$this->template->load('template', 'guru/add', $data);
    } //end function add

    function edit(){
    	$nuptk = $this->uri->segment(3);
    	$data  = array(
    		'icon'  => 'fa fa-graduation-cap',
			'title' => 'EDIT GURU',
			'parent'=> 'GURU',
			'child' => 'EDIT',
			'guru' => $this->model->get_data('*', 'tbl_guru', 'nuptk='.$nuptk)->row() 
    	);

    	if (isset($_POST['submit'])) {
    		$nuptk 	= strip_tags(trim($this->input->post('nuptk', TRUE)));
    		$foto 	= $this->model->get_data('foto', 'tbl_guru', 'nuptk='.$nuptk)->row('foto');

    		// konfigurasi upload foto
    		$config = array(
    			'upload_path' 	=> './upload/guru',
				'allowed_types'	=> 'jpg|jpeg|png',
				'max_size'		=> 1024,
				'file_name'		=> $nuptk,
				'overwrite'		=> TRUE
    		);
    		$this->load->library('upload', $config);

    		// proses upload foto
    		$uploaded 	= $this->upload->do_upload('userfile');
    		if ($uploaded) {
    			$fotodb = $nuptk; 
    		}else{
    			$fotodb	= $foto;
    		}
    	}

    	$this->template->load('template', 'guru/edit', $data);
    } //end function edit

    function delete(){
    	$nuptk = $this->uri->segment(3);
    	if (!empty($nuptk)) {
    		$delete = $this->model->delete_data($nuptk, 'nuptk', 'tbl_guru');
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