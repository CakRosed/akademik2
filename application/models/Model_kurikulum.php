<?php 
    Class Model_kurikulum extends CI_Model{
        
        function add(){
            $kurikulum  = trim($this->input->post('nama_kurikulum'));
            $is_aktif 	= strip_tags(trim($this->input->post('is_aktif')));
    		$check      = $this->db->get_where('tbl_kurikulum', array('nama_kurikulum' => $kurikulum)); 
            if ($check->num_rows() > 0) {
                echo "<script>alert('kurikulum Telah TERDAFTAR! silahkan cek ulang');</script>";
            }else{
                $param = array(
                    'nama_kurikulum'    => $kurikulum,
                    'is_aktif'          => $is_aktif
                );
                if ($is_aktif=='y') {
					$this->db->where('is_aktif', 'y');
					$update = $this->db->update('tbl_kurikulum', array('is_aktif' => 'n'));
				} // end cek y

                $simpan = $this->db->insert('tbl_kurikulum', $param);
                if ($simpan) {
                    echo "<script>alert('Berhasil Menambah Data');</script>";
                    redirect('kurikulum');
                }else{
                    echo "<script>alert('Gagal menambah data!');</script>";
                }
            }
        } //end add
        
        function update(){
            $id_kurikulum 	= strip_tags(trim($this->input->post('id_kurikulum', TRUE)));
            $kurikulum      = trim($this->input->post('nama_kurikulum'));
            $is_aktif 	    = strip_tags(trim($this->input->post('is_aktif')));
    		$param = array(
                    'nama_kurikulum'    => $kurikulum,
                    'is_aktif'          => $is_aktif
                );

            if ($is_aktif=='y') {
                $this->db->where(array('is_aktif'=>'y'));
                $update2 = $this->db->update('tbl_kurikulum', array('is_aktif' => 'n'));
            } // end cek y

            $this->db->where('id_kurikulum', $id_kurikulum);
            $update = $this->db->update('tbl_kurikulum', $param);

    	    if ($update && $update2) {
                echo "<scipt>alert('Sukses Mendaftar Mata Pelajaran');</script>";
                redirect('kurikulum');
            }else{
                echo "<script>alert('Gagal Mendaftar Mata Kuliah!');</script>";
            }
        } //end edit

        function addDetail(){
            $param = array(
                'kd_mapel'      => strip_tags(trim($this->input->post('mapel'))),
                'kelas'         => strip_tags(trim($this->input->post('kelas'))),
                'kd_kurikulum'  => strip_tags(trim($this->uri->segment(3)))
            );

            $sql = "SELECT *
                    FROM tbl_kurikulum_detail as kd
                    WHERE kd.kelas='$kelas' and kd.kd_mapel='$kd_mapel' and kd_kurikulum=$kd_kurikulum";
            $check = $this->db->query($sql);
            if ($check->num_rows() > 0) {
                echo "<script>alert('Mata Pelajaran Telah Terdaftar Pada Kelas Yang Sama!')</script>";
            }else{
                $save =$this->db->insert('tbl_kurikulum_detail', $param);
                if ($save) {
                    echo "<scrip>alert('Sukses Insert Data')</script>";
                    redirect('kurikulum/detail/'.$this->uri->segment(3));
                }else{
                    echo "<scrip>alert('Gagal Insert Data!')</scrip>";
                }
            }
        }

    } //end model
?> 