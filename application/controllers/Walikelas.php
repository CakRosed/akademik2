<?php 
Class Walikelas extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Model_global', 'model');
        check_akses_modul();
    }

    function index(){
        $data = array(
            'icon'          => 'fa fa-search',
            'title'         => 'DETAIL WALIKELAS',
            'parent'        => 'WALIKELAS',
            'child'         => 'PENGATURAN',
            'tahun_akademik'=> $this->model->get_data('*', 'tbl_tahun_akademik', array('is_aktif'=>'y'))->row_object(),
            'data'          => $this->db->get('v_walikelas')->result()
        );
        $this->template->load('template', 'walikelas/list', $data);
    } //end index

    function update_walikelas(){
        $id_walikelas   = strip_tags(trim($this->input->get('id_walikelas')));
        $id_guru        = strip_tags(trim($this->input->get('id_guru')));
        $this->db->where(array('id_walikelas' => $id_walikelas));
        $update= $this->db->update('tbl_walikelas', $param = array('id_guru'=>$id_guru));
        if ($update) {
            echo "<script>alert('Sukses Merubah Walikelas')</script>";
            redirect('walikelas');
        }else{
            echo "<script>alert('Sukses Merubah Walikelas')</script>";
        }
    } //end update_walikelas
}
?>


