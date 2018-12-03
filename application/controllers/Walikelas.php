<?php 
Class Walikelas extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Model_global', 'model');

    }

    function index(){
        $data = array(
            'icon'          => 'fa fa-search',
            'title'         => 'DETAIL WALIKELAS',
            'parent'        => 'WALIKELAS',
            'child'         => 'PENGATURAN',
            'tahun_akademik'=> $this->model->get_data('*', 'tbl_tahun_akademik', array('is_aktif'=>'y'))->row_object()
        );
        $this->template->load('template', 'walikelas/list', $data);
    }
}

?>