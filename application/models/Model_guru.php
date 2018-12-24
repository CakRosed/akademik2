<?php
    Class Model_guru extends CI_Model{

        function check_login($email, $password){
            $this->db->where('email',$email);
            $this->db->where('password', md5($password));
            $user = $this->db->get('tbl_guru');
            return $user;
        } //end check login 

        function upload_foto($nuptk){
            // konfigurasi upload foto
            $config['upload_path']          = './upload/guru';
            $config['allowed_types']        = 'jpg|jpeg|png';
            $config['max_size']             = 1024;
            $config['file_name']			= $nuptk;
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
                $fotodb = $this->db->get_where('tbl_guru', array('nuptk'=>$nuptk));
                if ($fotodb->num_rows() > 0) {
                    $foto = $fotodb->row('foto');
                }else{
                    $foto = 'avatarLP.png';
                }
            }
            return $foto;
        } //end upload foto
        
        function add($foto){
				$password = strip_tags(trim($this->input->post('password')));
				$kpassword = strip_tags(trim($this->input->post('kpassword')));
				if($password !== $kpassword){
					echo "<script>alert('password tidak sama')</script>";
				}else{
					$passworddb= md5($password);
					// definisikan data
					$param = array(
						'nuptk' 		=> strip_tags(trim($this->input->post('nuptk'))),
						'nama_guru' 	=> strip_tags(trim($this->input->post('nama'))),
						'tempat_lahir'	=> strip_tags(trim(strtoupper($this->input->post('tempat_lahir')))),
						'tanggal_lahir'	=> strip_tags(trim($this->input->post('tanggal_lahir'))),
						'nomor'			=> strip_tags(trim($this->input->post('nomor'))),
						'email'			=> strip_tags(trim($this->input->post('email'))),
						'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir'),
						'gender'		=> $this->input->post('gender'),
						'kd_agama'		=> $this->input->post('agama'),
						'alamat'		=> strip_tags(trim($this->input->post('alamat'))),
						'password'		=> $passworddb,
						'foto'			=> $foto
					);
					// die;
					$simpan = $this->db->insert('tbl_guru', $param);
					if ($simpan) {
						echo "<script>alert('Berhasil Menambah Data');</script>";
						redirect('guru');
					}else{
						echo "<script>alert('Gagal menambah data!');</script>";
					}
				}
    		}
        

        function update($foto, $nuptk){
            //definisikan parameter
			$param = array(
						'nama_guru' 	=> strip_tags(trim($this->input->post('nama'))),
						'tempat_lahir'	=> strip_tags(trim(strtoupper($this->input->post('tempat_lahir')))),
						'tanggal_lahir'	=> strip_tags(trim($this->input->post('tanggal_lahir'))),
						'nomor'			=> strip_tags(trim($this->input->post('nomor'))),
						'email'			=> strip_tags(trim($this->input->post('email'))),
						'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir'),
						'gender'		=> $this->input->post('gender'),
						'kd_agama'		=> $this->input->post('agama'),
						'alamat'		=> strip_tags(trim($this->input->post('alamat'))),
						'foto'			=> $foto
                );
			$this->db->where('nuptk', $nuptk);
			$update = $this->db->update('tbl_guru', $param);
			if($update){
				echo "<script>alert('Sukses Ubah Data')</scritp>";
				redirect('guru');
			}else{
				echo "<script>alert('Gagal Ubah Data')</scritp>";
			}
        } //end update

    } //end model
?> 