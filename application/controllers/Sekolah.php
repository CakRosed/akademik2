<?php 
 Class Sekolah extends CI_Controller{
    function __construct(){
        parent:: __construct();
            $this->load->model('Model_global', 'model');
    } // end function __construct

 
    function index(){
        $kd_sekolah = $this->model->get_all_data('kd_sekolah', 'tbl_sekolah_info')->row();
        $data = array(
                'icon'  => 'fa fa-build',
                'title' => 'DATA MAPEL',
                'parent'=> 'SEKOLAH',
                'child' => 'INFORMASI',
                'sekolah'  => $this->model->get_data('*', 'tbl_sekolah_info', 'kd_sekolah="'.$kd_sekolah->kd_sekolah.'"')->row_object() 
            );

        if (isset($_POST['submit'])) {
            $kd_mapel   = strip_tags(trim($this->input->post('kd_mapel', TRUE)));
            $param = array(
                    'nama_sekolah'      => strip_tags(trim($this->input->post('nama_sekolah'))),
                    'email'             => strip_tags(trim($this->input->post('email'))),
                    'telpon'            => strip_tags(trim($this->input->post('telpon'))),
                    'alamat_sekolah'    => strip_tags($this->input->post('alamat_sekolah'))
                );

            $update = $this->model->update_data($kd_sekolah->kd_sekolah, 'kd_sekolah', $param, 'tbl_sekolah_info');
           if ($update) {
                echo "<scipt>alert('Sukses Merubah Informasi Sekolah');</script>";
                redirect('sekolah');
           }else{
                echo "<script>alert('Gagal Merubah Informasi Sekolah!');</script>";
           }
       }

        $this->template->load('template', 'sekolah/infosekolah', $data);
     } //end function index
}