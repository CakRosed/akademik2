<?php 
 Class Rombel extends CI_Controller{ 
 	function __construct(){
 		parent:: __construct();
 			$this->load->model('Model_global', 'model');
 	} // end function __construct


    function index(){
        $sql = "SELECT tr.kd_rombel, tr.nama_rombel, tr.kelas, tj.nama_jurusan
                FROM tbl_jurusan as tj, tbl_rombel as tr 
                WHERE tj.kd_jurusan = tr.kd_jurusan";
    	$data = array(
				'icon'  => 'fa fa-book', 
				'title' => 'DATA ROMBONGAN BELAJAR',
				'parent'=> 'ROMBONGAN BELAJAR',
				'child' => 'LIST',
                'rombel'  => $this->db->query($sql)->result() 
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
			$param = array(
				'nama_rombel' => strip_tags($this->input->post('nama_rombel')),
                'kelas'       => $this->input->post('kelas'),
                'kd_jurusan'     => $this->input->post('jurusan')
			);

			$simpan = $this->model->save_data($param, 'tbl_rombel');
			if ($simpan) {
				echo "<script>alert('Berhasil Menambah Data');</script>";
				redirect('rombel');
			}else{
				echo "<script>alert('Gagal menambah data!');</script>";
			}   		
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
			'rombel'=> $this->model->get_data('*', 'tbl_rombel', "kd_rombel='".$kd_rombel."'")->row_object(), 
            'kelas' => $this->db->query($sql)->row_object()
    	);

    	if (isset($_POST['submit'])) {
            $param        = array(
                            'kd_rombel'   => $kd_rombel,
                            'nama_rombel' => strip_tags(trim($this->input->post('nama_rombel'))),
                            'kelas'       => strip_tags($this->input->post('kelas')),
                            'kd_jurusan'  => strip_tags($this->input->post('jurusan'))  
            );

            $query = $this->model->get_data('*', 'tbl_rombel', $param);
            if ($query->num_rows() > 0) {
                echo "<script>alert('Data Telah Terdaftar Oleh Rombongan Belajar Lain!');</script>";
            }else{
                $update = $this->model->update_data($kd_rombel, 'kd_rombel', $param, 'tbl_rombel');
        	    if ($update) {
                    echo "<scipt>alert('Sukses Mendaftar Mata Pelajaran');</script>";
                    redirect('rombel');
                }else{
                    echo "<script>alert('Gagal Mendaftar Mata Kuliah!');</script>";
                }
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