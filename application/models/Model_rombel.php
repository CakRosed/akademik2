<?php 
    Class Model_rombel extends CI_MOdel{

        function add(){
            $param = array(
				'nama_rombel' => strip_tags($this->input->post('nama_rombel')),
                'kelas'       => $this->input->post('kelas')
			);

			$simpan = $this->db->insert('tbl_rombel', $param);
			if ($simpan) {
				echo "<script>alert('Berhasil Menambah Data');</script>";
				redirect('rombel');
			}else{
				echo "<script>alert('Gagal menambah data!');</script>";
			}  
        } //end add

        function update($kd_rombel){
            $param        = array(
                            'nama_rombel' => strip_tags(trim($this->input->post('nama_rombel'))),
                            'kelas'       => strip_tags($this->input->post('kelas'))  
            );
            $query = $this->db->get_where('tbl_rombel', $param);
            if ($query->num_rows() > 0) {
                echo "<script>alert('Data Telah Terdaftar Oleh Rombongan Belajar Lain!');</script>";
            }else{
                $this->db->where('kd_rombel', $kd_rombel);
                $update = $this->db->update('tbl_rombel', $param);
                if ($update) {
                    echo "<scipt>alert('Sukses Mendaftar Mata Pelajaran');</script>";
                    redirect('rombel');
                }else{
                    echo "<script>alert('Gagal Mendaftar Mata Kuliah!');</script>";
                }
            }
        }
    } //end model
?>