<?php 
    Class Nilai extends CI_Controller{
        function __construct(){
            parent::__construct();
            check_akses_modul();
        }

        function index(){
            $sql = 
                "SELECT tj.id_rombel, tj.id_jadwal,tjr.nama_jurusan,tj.kelas,tm.nama_mapel,tj.jam,tr.nama_ruangan,tj.hari,tj.semester FROM tbl_jadwal as tj, tbl_jurusan as tjr, tbl_ruangan as tr, tbl_mapel as tm WHERE tj.kd_jurusan=tjr.kd_jurusan and tj.kd_mapel=tm.kd_mapel and tj.kd_ruangan=tr.kd_ruangan and tj.id_guru=".$this->session->userdata('id_guru');

            $data = array(
				'icon'  => 'fa fa-th-large',
				'title' => 'DATA NILAI',
				'parent'=> 'JADWAL',
				'child' => 'LIST ROMBEL',
				'info'  => $this->db->query($sql)->result()
            );
            $this->template->load('template', 'nilai/list_rombel', $data);
        } //end index

        function rombel(){
            $id_rombel = strip_tags(trim($this->uri->segment(3)));
            $rombel  = "SELECT tr.*, tj.nama_jurusan 
                    FROM tbl_rombel as tr, tbl_jurusan as tj 
                    WHERE tj.kd_jurusan=tr.kd_jurusan and tr.kd_rombel=".$id_rombel;
            $siswa = "";

            $data = array(
				'icon'  => 'fa fa-th-large',
				'title' => 'DATA NILAI',
				'parent'=> 'NILAI',
                'child' => 'INPUT',
                'info'  => $this->db->query($rombel)->row_object(),
            );

            $this->template->load('template' ,'nilai/form_nilai', $data);
        } //end rombel
    }
?>