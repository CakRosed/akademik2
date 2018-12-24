<?php 
Class Walikelas extends CI_Controller{
    function __construct(){
        parent::__construct();
        check_akses_modul();
        $this->load->model('Model_walikelas', 'model');
    }

    function index(){ 
        $data = array(
            'icon'          => 'fa fa-search',
            'title'         => 'DETAIL WALIKELAS',
            'parent'        => 'WALIKELAS',
            'child'         => 'PENGATURAN'
        );
        $this->template->load('template', 'walikelas/list', $data);
    } //end index

    function loadData(){
        $tahun_akademik = strip_tags(trim($this->input->get('tahun_akademik')));
        // echo $tahun_akademik.'/'.$semester;die;

        $sql  = "SELECT tw.id_walikelas, tg.nuptk, tg.nama_guru, tg.foto, tr.nama_rombel, tr.kelas, th.tahun_akademik
                FROM tbl_walikelas as tw, tbl_guru as tg, tbl_rombel as tr, tbl_tahun_akademik as th
                WHERE tw.id_guru=tg.nuptk and tw.id_rombel=tr.kd_rombel and tw.id_tahun_akademik=th.kd_tahun_akademik and tw.id_tahun_akademik=".$tahun_akademik;
        $data = $this->db->query($sql)->result();
        echo'
        <table class="table table-bordered table-stripped tbl-hover" id="example1">
            <thead>
                <th clas="text-center">NO.</th>
                <th clas="text-center">ROMBONGAN BELAJAR</th>
                <th clas="text-center">KELAS</th>
                <th clas="text-center">FOTO</th>
                <th clas="text-center">WALIKELAS</th>
                <th clas="text-center">MENU</th>
            </thead>
            <tbody>';  
                    $no=1;
                    foreach ($data as $row) {
                        echo 
                        "<tr> 
                        <td class='text-center'>".$no++."</td>
                        <td class='text-center'>".$row->nama_rombel."</td>
                        <td class='text-center'>".$row->kelas."</td>
                        <td class='text-center'><img class='img-circle' width=40 src='".base_url('upload/guru/'.$row->foto)."'></td>
                        <td>".$row->nama_guru."</td>
                        <td class='text-center'>
                            <a class='btn btn-xs btn-warning tooltips btn-flat' data placement='top' data-original-title='edit' href='".site_url('walikelas/edit/'.$row->id_walikelas)."'><i class='fa fa-pencil-square-o'></i></a>
                        <a class='btn btn-xs btn-danger tooltips btn-flat' data placement='top' data-original-title='delete' href='".site_url('walikelas/delete/'.$row->id_walikelas)."' title='Hapus Data' onclick ='return confirm(\"ANDA YAKIN INGIN MENHAPUS DATA INI?\")'><i class='fa fa-trash'></i></a>
                        </td>
                        </tr>";
                    }
            echo'                    
            </tbody> 
        </table>';
    } //end loadData

    function delete(){
        $id_walikelas = strip_tags(trim($this->uri->segment(3)));
        if (!empty($id_walikelas)) {
            $this->db->where('id_walikelas', $id_walikelas);
            $delete = $this->db->delete('tbl_walikelas');
            if ($delete) {
                echo "<script>alert('Sukses Hapus Data!');</script>";
                redirect('walikelas');
            }
        } 
    } //end delete

    function add(){
        $info_sekolah = "SELECT js.jumlah_kelas
                        FROM tbl_jenjang_sekolah as js, tbl_sekolah_info as si
                        WHERE js.kd_jenjang = si.kd_jenjang_sekolah";
        $data = array(
            'icon'          => 'fa fa-search',
            'title'         => 'DETAIL WALIKELAS',
            'parent'        => 'WALIKELAS',
            'child'         => 'PENGATURAN',
            'info'          => $this->db->query($info_sekolah)->row()
        );
        
        if (isset($_POST['submit'])) {
            $this->model->add();
        }
        $this->template->load('template', 'walikelas/add', $data);
    }// end add

    function showRombel(){
        $kelas	= strip_tags(trim($this->input->get('kelas')));
        $rombel	= $this->db->get_where('tbl_rombel', array('kelas' => $kelas));
        echo "<select id='rombel' name='rombel', class='form-control'>";
        foreach ($rombel->result() as $row) {
            echo "<option value=$row->kd_rombel>$row->nama_rombel</option>";
        }
        echo "</select>";
    }
} //end controller
