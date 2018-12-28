<?php 
Class Raport extends CI_Controller{

    function __consrtuct(){
        parent::__construct();
        check_akses_modul();
        $this->load->model('Model_raport', 'model');
    }

    function index(){
        $walikelas = $this->db->get_where('tbl_walikelas', array('id_guru' => $this->session->userdata('id_guru')))->row_array();
        $rombel     =  "SELECT tr.nama_rombel, tr.kelas, tm.nama_mapel
                        FROM tbl_jadwal as tja, tbl_mapel as tm, tbl_rombel as tr 
                        WHERE tja.kd_mapel=tm.kd_mapel and tja.id_rombel=tr.kd_rombel and tja.id_rombel=".$walikelas['id_rombel'];
        $siswa	    =  "SELECT ts.nis, ts.nisn, ts.nama
                        FROM tbl_history_kelas as th, tbl_siswa as ts
                        WHERE th.nisn=ts.nisn and th.id_rombel=".$walikelas['id_rombel']." and th.id_tahun_akademik=".get_tahun_akademik_aktif('kd_tahun_akademik');
        
        $data = array(
            'icon'  => 'fa fa-th-large',
            'title' => 'DATA NILAI',
            'parent'=> 'JADWAL',
            'child' => 'LIST ROMBEL',
            'info'  => $this->db->query($rombel)->row_object(),
            'siswa' => $this->db->query($siswa)->result()
        );

        $this->template->load('template', 'raport/list', $data);
    } //end index

    function nilai_semester(){
        $nisn   =  $this->uri->segment(3);
        $sql    =  "SELECT ts.nama, ts.nis, ts.nisn, tr.nama_rombel
                    FROM tbl_history_kelas as th, tbl_siswa as ts, tbl_rombel as tr
                    WHERE th.nisn=ts.nisn and ts.id_rombel=tr.kd_rombel and th.nisn=".$nisn." and th.id_tahun_akademik=".get_tahun_akademik_aktif('kd_tahun_akademik');
        $siswa  = $this->db->query($sql)->row_object();

        $this->load->model('Model_raport', 'model');
        $this->load->library('CFPDF');
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        
        $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(30, 5, 'NIS', 0, 0, 'L');
            $pdf->Cell(88, 5, ': '.$siswa->nis, 0, 0, 'L');
            $pdf->Cell(30, 5, 'KELAS', 0, 0, 'L');
            $pdf->Cell(45, 5, ': '.$siswa->nama_rombel, 0, 1, 'L');
            
            $pdf->Cell(30, 5, 'NAMA', 0, 0, 'L');
            $pdf->Cell(88, 5, ': '.$siswa->nama, 0, 0, 'L');
            $pdf->Cell(30, 5, 'TAHUN AJARAN', 0, 0, 'L');
            $pdf->Cell(45, 5, ': '.get_tahun_akademik_aktif('tahun_akademik'), 0, 1, 'L');
            
            $pdf->Cell(30, 5, 'SEMESTER', 0, 0, 'L');
            $pdf->Cell(45, 5, ': '.get_tahun_akademik_aktif('semester_aktif'), 0, 1, 'L');
            
            $pdf->Cell(1, 10, '', 0, 1, 'C');

            $pdf->Cell(8, 5, 'NO', 1, 0, 'C');
            $pdf->Cell(60, 5, 'MATA PELAJARAN', 1, 0, 'C');
            $pdf->Cell(15, 5, 'KKM', 1, 0, 'C');
            $pdf->Cell(15, 5, 'ANGKA', 1, 0, 'C');
            $pdf->Cell(40, 5, 'HURUF', 1, 0, 'C');
            $pdf->Cell(30, 5, 'KETERCAPAIAN', 1, 0, 'C');
            $pdf->Cell(25, 5, 'RATA-RATA', 1, 1, 'C');
        //end font set
        $pdf->SetFont('Arial', '', 9);
            $sql2= "SELECT tj.id_jadwal, tm.nama_mapel
                    FROM tbl_jadwal as tj, tbl_mapel as tm
                    WHERE tj.kd_mapel=tm.kd_mapel and tj.id_rombel=1";
            $mapel = $this->db->query($sql2)->result();
            $no=1;
            foreach ($mapel as $row) {
                $pdf->Cell(8, 5, $no++, 1, 0, 'C');
                $pdf->Cell(60, 5, $row->nama_mapel, 1, 0, 'C');
                $pdf->Cell(15, 5, '80', 1, 0, 'C');
                $pdf->Cell(15, 5, check_nilai($siswa->nisn, $row->id_jadwal), 1, 0, 'C');
                $nilai = check_nilai($siswa->nisn, $row->id_jadwal);
                $pdf->Cell(40, 5, $this->model->terbilang($nilai), 1, 0, 'C');
                $pdf->Cell(30, 5, $this->model->ketercapaian_kompetensi($nilai), 1, 0, 'C');
                $pdf->Cell(25, 5, ceil($this->model->rata_rata($row->id_jadwal)), 1, 1, 'C');
            }
        // end font set
            
        $pdf->Output();
    } //end nilai semester
}
?>