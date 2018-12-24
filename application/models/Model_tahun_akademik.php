<?php 
    Class Model_tahun_akademik extends CI_Model{

        function add(){
			$tahun 		= strip_tags(trim($this->input->post('tahun_akademik')));
			$semester	= strip_tags(trim($this->input->post('semester_aktif')));
            $is_aktif 	= strip_tags(trim($this->input->post('is_aktif')));
			$check 		= $this->db->get_where('tbl_tahun_akademik', array('tahun_akademik' => $tahun));
			$rombel		= $this->db->get('tbl_rombel');
            if ($check->num_rows() > 0) {
                echo "<script>alert('Tahun Akademik Telah Terdaftar!');</script>";
            }else{
                $param = array(
                    'tahun_akademik'    => $tahun,
                    'is_aktif'          => $is_aktif,
                    'semester_aktif'    => $semester
				);
				
				if ($is_aktif=='y') {
					$this->db->where('is_aktif', 'y');
					$update = $this->db->update('tbl_tahun_akademik', array('is_aktif' => 'n'));
                } // end cek y
                
				$insert = $this->db->insert('tbl_tahun_akademik', $param);
                
                //set data walikelas pada tabel walikelas
				foreach ($rombel->result() as $rom) {
					$param2 = array(
						'id_tahun_akademik'	=> get_tahun_akademik_aktif('kd_tahun_akademik'),
						'id_guru'			=> '1',
						'id_rombel'			=> $rom->kd_rombel
					);
					$loopInsert = $this->db->insert('tbl_walikelas', $param2);
				}

				if ($insert) {
					echo "<script>alert('Sukses Insert Data');</script>";
					redirect('Tahun_akademik');
				}
            }
        } //end add

        function update(){
			$kd_tahun_akademik 	= strip_tags(trim($this->input->post('kd_tahun_akademik', TRUE)));

            $param = array(
                    'tahun_akademik'    => trim($this->input->post('tahun_akademik')),
                    'is_aktif'          => strip_tags(trim($this->input->post('is_aktif'))),
                    'semester_aktif'          => strip_tags(trim($this->input->post('semester_aktif')))
			);
			
			if ($is_aktif = 'y') {
				$this->db->where('is_aktif', 'y');
				$update = $this->db->update('tbl_tahun_akademik', array('is_aktif' => 'n'));
            }
            
            $this->db->where('kd_tahun_akademik', $kd_tahun_akademik);
            $update = $this->db->update('tbl_tahun_akademik', $param);
			if ($update) {
					echo "<scipt>alert('Sukses Mendaftar Tahun Akademik');</script>";
					redirect('tahun_akademik');
			}else{
					echo "<script>alert('Gagal Mendaftar Tahun Akademik!');</script>";
			}
        }

    } //end model
?>