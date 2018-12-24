<?php 
    Class Model_user extends CI_Model{

        function check_login($username, $password){
            $this->db->where('username',$username);
            $this->db->where('password', md5($password));
            $user = $this->db->get('tbl_user');
            return $user;
        } //end check login

        function upload_foto($username){
            // konfigurasi upload foto
            $config['upload_path']          = './upload/user';
            $config['allowed_types']        = 'jpg|jpeg|png';
            $config['max_size']             = 1024;
            $config['file_name']			= $username;
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
                $fotodb = $this->db->get_where('tbl_user', array('username'=>$username));
                if ($fotodb->num_rows() > 0) {
                    $foto = $fotodb->row('foto');
                }else{
                    $foto = 'avatarLP.png';
                }
            }
            return $foto;
        } //end upload foto

        function add($foto, $username){
            $nama_lengkap 	= strtoupper(strip_tags($this->input->post('nama')));
			$password 		= strip_tags(trim($this->input->post('password')));
			$level 			= $this->input->post('level');
			$check 			= $this->db->get_where('tbl_user', array('username'=>$username));

			if ($check->num_rows() > 0 ) {
				echo "<script>alert('USERNAME SUDAH TERDAFTAR!');</script>";
			}else{
				$param = array(
					'nama_lengkap'  => $nama_lengkap,
					'username'		=> $username,
					'id_level_user' => $level,
					'password'		=> md5($password),
					'foto'			=> $foto
                );

				$insert = $this->db->insert('tbl_user', $param);
				if ($insert) {
					echo "<script>alert('SUKSES MENDAFTAR AKUN PEMAKAI SISTEM');</script>";
					redirect('users');
				}else{
					echo "<script>alert('GAGAL MENDAFTAR AKUN PEMAKAI SISTEM');</script>";
				}
			}
        } //end add

        function update($foto, $username){
            $id_user 	    = strip_tags(trim($this->input->post('id_user')));
			$param = array(
				'username'		=> $username,
				'nama_lengkap'	=> strip_tags($this->input->post('nama')),
				'id_level_user'	=> strip_tags($this->input->post('level')),
				'foto'			=> $foto	
            );
            $this->db->where('id_user', $id_user);
			$update = $this->db->update('tbl_user', $param);
            if ($update) {
                echo "<script>alert('Sukses Merubah Data Pengguna')</script>";
                redirect('users');
            }else{
                echo "<script>alert('Sukses Merubah Data Pengguna')</script>";
            }
        } //end update

    } //end model
?>