<?php 
    Class Model_siswa extends CI_Model{
        public $table       = 'tbl_siswa';

        function upload_foto($nis, $gender=null){
            // konfigurasi upload foto
            $config['upload_path']          = './upload/siswa';
            $config['allowed_types']        = 'jpg|jpeg|png';
            $config['max_size']             = 1024;
            $config['file_name']			= $nis;
            $config['overwrite']			= TRUE;
            $this->load->library('upload', $config);
            //proses upload
            $uploaded = $this->upload->do_upload('userfile');
            // cek apakah ada proses upload ke folder
            if ($uploaded) {
                //tangkap data 
                $upload= $this->upload->data();
                $foto = $upload['file_name'];
            }else{
                $fotodb = $this->db->get_where('tbl_siswa', array('nis'=>$nis));
                if ($fotodb->num_rows() > 0) {
                    $foto = $fotodb->row('foto');
                }else{
                    if ($gender == 'L') {
                        $foto = 'avatarL.png';
                    }else{
                        $foto = 'avatarP.png';
                    }
                }
            }
            return $foto;
        } //end upload foto


        function add($foto){
            $param = array(
                'nisn'			=> strip_tags(trim($this->input->post('nisn', TRUE))),
                'nis'		 	=> strip_tags(trim($this->input->post('nis', TRUE))),
                'nama'			=> strip_tags(trim(strtoupper($this->input->post('nama', TRUE)))),
                'tempat_lahir' 	=> strip_tags(trim(strtoupper($this->input->post('tempat_lahir', TRUE)))),
                'tanggal_lahir'	=> strip_tags(trim($this->input->post('tanggal_lahir', TRUE))),
                'nama_wali'		=> strip_tags(trim(strtoupper($this->input->post('nama_wali', TRUE)))),
                'hp_wali'		=> strip_tags(trim($this->input->post('hp_wali', TRUE))),
                'gender' 		=> $this->input->post('gender', TRUE),
                'kd_agama' 		=> $this->input->post('agama', TRUE),
                'alamat' 		=> strip_tags(trim($this->input->post('alamat', TRUE))),
                'password'		=> 'anonymouse135',
                'id_rombel'		=> strip_tags(trim($this->input->post('rombel', TRUE))),
                'foto'			=> $foto			 
            );
            
            //check duplikasi data
            $where = array(
                'nisn' => $param['nisn'],
                'nis'  => $param['nis']
            );
            $check = $this->db->get_where($this->table, $where);
            if ($check->num_rows() < 1) {
                //inserta data siswa
                $insert = $this->db->insert($this->table, $param);
                if ($insert) {
                    //inserta data history rombognan belajar
                    $param2 = array(
                        'nisn'              => $param['nisn'],
                        'id_tahun_akademik' => get_tahun_akademik_aktif('kd_tahun_akademik'),
                        'id_rombel'         => $param['id_rombel']
                    );
                    $history = $this->db->insert('tbl_history_kelas', $param2);
                    if ($history) {
                        redirect('siswa');
                    }
                }else{
                    echo "gagal insert";die;
                }
            }else{
                echo "<script>alert('NIS atau NISN sudah terdaftar!')</script>";
            }
        } //end add

        function edit($foto){
            $param = array(
            'nisn'			=> strip_tags(trim($this->input->post('nisn', TRUE))),
            'nis'		 	=> strip_tags(trim($this->input->post('nis', TRUE))),
            'nama'			=> strip_tags(trim(strtoupper($this->input->post('nama', TRUE)))),
            'tempat_lahir' 	=> strip_tags(trim(strtoupper($this->input->post('tempat_lahir', TRUE)))),
            'tanggal_lahir'	=> strip_tags(trim($this->input->post('tanggal_lahir', TRUE))),
            'nama_wali'		=> strip_tags(trim(strtoupper($this->input->post('nama_wali', TRUE)))),
            'hp_wali'		=> strip_tags(trim($this->input->post('hp_wali', TRUE))),
            'gender' 		=> $this->input->post('gender', TRUE),
            'kd_agama' 		=> $this->input->post('agama', TRUE),
            'alamat' 		=> strip_tags(trim($this->input->post('alamat', TRUE))),
            'password'		=> 'anonymouse135',
            'id_rombel'		=> strip_tags(trim($this->input->post('rombel', TRUE))),
            'foto'			=> $foto			 
            );

            //proses update
            $this->db->where('nis', $param['nis']);
            $update = $this->db->update('tbl_siswa', $param);
            if ($update) {
                //proses cek data insert atau update
                $where = array(
                    'id_rombel'         => $param['id_rombel'],
                    'nisn'               => $param['nisn'],
                );
                $check = $this->db->get_where('tbl_history_kelas', $where);
                if ($check->num_rows() > 0) {
                    //proses update
                    $id_history = $check->row('id_history');
                    $this->db->where('id_history', $id_history);
                    $this->db->where('nisn', $param['nisn']);
                    $update_history = $this->db->update('tbl_history_kelas', array('id_rombel'=> $param['id_rombel'])); 
                    if ($update) {
                        redirect('siswa');
                    }
                }else{
                    //proses insert
                    $param2 = array(
                        'id_rombel'         => $param['id_rombel'],
                        'nisn'              => $param['nisn'],
                        'id_tahun_akademik' => get_tahun_akademik_aktif('kd_tahun_akademik')
                    );
                    $insert_history = $this->db->insert('tbl_history_kelas', $param2);
                    if($insert_history){
                        redirect('siswa');
                    }
                }
            }
        } //end edit
    } //end model
?>