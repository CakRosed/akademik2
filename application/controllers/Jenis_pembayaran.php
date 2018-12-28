<?php 
    Class Jenis_pembayaran extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('Model_jenis_pembayaran', 'model');
        } //end construct

        function index(){
            $data = array(
                'icon'          => 'fa fa-search',
                'title'         => 'JENIS PEMBAYARAN',
                'parent'        => 'JENIS PEMBAYARAN',
                'child'         => 'LIST',
                'jenis'         => $this->db->get('tbl_jenis_pembayaran')->result()
            );
            $this->template->load('template', 'jenisPembayaran/list', $data);
        } //end index

        function add(){
            $data = array(
                'icon'    => 'fa fa-search',
                'title'   => 'JENIS PEMBAYARAN',
                'parent'  => 'JENIS PEMBAYARAN',
                'child'   => 'ADD'
            );
            if (isset($_POST['submit'])) {
                $this->model->add();
            }
            $this->template->load('template', 'jenisPembayaran/add', $data);
        } //end add 

        function edit(){
            $id_jenis   = strip_tags(trim($this->uri->segment(3))); 
            $data = array(
                'icon'    => 'fa fa-search',
                'title'   => 'JENIS PEMBAYARAN',
                'parent'  => 'JENIS PEMBAYARAN',
                'child'   => 'ADD',
                'info'    => $this->db->get_where('tbl_jenis_pembayaran', array('id_jenis_pembayaran'=>$id_jenis))->row()
            );
            if (isset($_POST['submit'])) {
                $this->model->edit();
            }
            $this->template->load('template', 'jenisPembayaran/edit', $data);
        } //end edit

        function delete(){
            $id_jenis = strip_tags(trim($this->uri->segment(3)));
            if (!empty($id_jenis)) {
                $this->db->where('id_jenis_pembayaran', $id_jenis);
                $delete = $this->db->delete('tbl_jenis_pembayaran');
                if ($delete) {
                    echo "<script>alert('Sukses Menghapus Data')</script>";
                    redirect('jenis_pembayaran');
                }
            }
        } //end delete

    } //end controller
?>