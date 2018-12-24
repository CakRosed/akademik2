<?php 
    Class Nilai extends CI_Controller{
        function __construct(){
            parent::__construct();
            check_akses_modul();
            $this->load->model('Model_nilai', 'model');
        }

        function index(){
            $sql = 
                "SELECT tj.id_rombel, tj.id_jadwal,tj.kelas,tm.nama_mapel,tj.jam,tr.nama_ruangan,tj.hari,tj.semester 
                FROM tbl_jadwal as tj, tbl_ruangan as tr, tbl_mapel as tm 
                WHERE tj.kd_mapel=tm.kd_mapel and tj.kd_ruangan=tr.kd_ruangan and tj.id_guru=".$this->session->userdata('id_guru');

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
            $id_jadwal  = strip_tags(trim($this->uri->segment(3)));
            $id_rombel  = $this->db->get_where('tbl_jadwal', array('id_jadwal'=>$id_jadwal))->row('id_rombel');
            // echo $id_jadwal.'/'.$id_rombel.'/'.get_tahun_akademik_aktif('kd_tahun_akademik');die;
            $rombel     =  "SELECT tr.nama_rombel, tjr.nama_jurusan, tr.kelas, tm.nama_mapel
                            FROM tbl_jadwal as tja, tbl_jurusan as tjr, tbl_mapel as tm, tbl_rombel as tr 
                            WHERE tja.kd_jurusan=tjr.kd_jurusan and tja.kd_mapel=tm.kd_mapel and tja.id_rombel=tr.kd_rombel and  tja.id_jadwal=".$id_jadwal." and tja.id_rombel=".$id_rombel;
            $siswa      =  "SELECT ts.nis, ts.nisn, ts.nama
                            FROM tbl_history_kelas as th, tbl_siswa as ts
                            WHERE th.nisn=ts.nisn and th.id_tahun_akademik=".get_tahun_akademik_aktif('kd_tahun_akademik')." and th.id_rombel=".$id_rombel;

            $data = array(
				'icon'  => 'fa fa-th-large',
				'title' => 'DATA NILAI',
				'parent'=> 'NILAI',
                'child' => 'INPUT',
                'info'  => $this->db->query($rombel)->row_object(),
                'siswa' => $this->db->query($siswa)->result()
            );

            $this->template->load('template' ,'nilai/form_nilai', $data);
        } //end rombel

        function update(){
            $this->model->update_nilai();
        } //end update nilai
    } //end conroller
?> 