<?php 
    Class Autentifikasi extends CI_Controller{
        function __Construct(){
            parent::__Construct();
            $this->load->model('Model_global', 'model');
            $this->load->model('Model_guru', 'gmodel');
            $this->load->model('Model_user', 'umodel');
        }

        function index(){
            $this->load->view('auth/signin');
        }

        function check_login(){
            if (isset($_POST['submit'])) {
                $param = array(
                    'level'     =>  $this->input->post('level'),
                    'username'  =>  strtolower(strip_tags(trim($this->input->post('username')))),
                    'password'  =>  strip_tags(trim($this->input->post('password')))
                );
                $sql = $this->model->get_data('nama_level', 'tbl_level_user', 'id_level_user='.$param['level'])->row_object();

                if ($param['level'] == 3) {
                    $login = $this->gmodel->check_login($param['username'], $param['password'])->row_array();
                    if (!empty($login)) {
                        $session = array(
                            'nama_lengkap'  =>$login['nama_guru'],
                            'lokasi'        =>'guru/'.$login['foto'], 
                            'id_level_user' =>$param['level'],
                            'nama_level'    => $sql->nama_level,
                            'id_guru'       => $login['nuptk']
                        );
                        $this->session->set_userdata($session);
                        redirect('siswa/siswa_aktif');
                    }else{
                        redirect('autentifikasi');
                        echo "<script>alert('Login GAGAL ! | Silahkan cek ulang email dan password')</script>";
                    }
                }else{
                    $login = $this->umodel->check_login($param['username'], $param['password'])->row_array();
                    if (!empty($login)) {
                        $session = array(
                            'nama_lengkap'=>$login['nama_lengkap'], 'lokasi'=>'user/'.$login['foto'],  
                            'id_level_user'=>$param['level'],
                            'nama_level'    => $sql->nama_level
                        );     
                        // print_r($session);die;
                        $this->session->set_userdata($session);
                        redirect('siswa/siswa_aktif');
                    }else{
                        redirect('autentifikasi');
                        echo "<script>alert('Login GAGAL ! | Silahkan cek ulang username dan password')</script>";
                    }
                    redirect('autentifikasi');
                }
            }
        } // end check login

        function check_logout(){
            $this->session->sess_destroy();
            redirect('autentifikasi');
        }
    }
?> 