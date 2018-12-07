<?php 
    Class Autentifikasi extends CI_Controller{
        function __Construct(){
            parent::__Construct();
            $this->load->model('Model_global', 'model');
        }

        function index(){
            $this->load->view('auth/signin');
        }

        function check_login(){
            if (isset($_POST['submit'])) {
                $username = strtolower(strip_tags(trim($this->input->post('username'))));
                $password = strip_tags(trim($this->input->post('password')));
                $where    = array(
                    'username' => $username, 
                    'password' => md5($password)
                );            
                $checkdb  = $this->model->get_data('*', 'tbl_user', $where);
                if ($checkdb->num_rows()>0) {
                    $this->session->set_userdata($checkdb->row_array());
                    redirect('siswa');
                }else{
                    redirect('autentifikasi');
                }
            }else{
                redirect('autentifikasi');
            }
        } // end check login
    }
?>