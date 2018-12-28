<?php 
    Class Model_walikelas extends CI_Model{
        function add(){
            $param = array(
                'id_rombel'         => strip_tags(trim($this->input->post('rombel'))),
                'id_guru'           => strip_tags(trim($this->input->post('guru')))
            );

            $check = $this->db->get_where('tbl_walikelas', $param);
            if ($check->num_rows() > 0) {
                echo '<script>alert("Data Telah Terdaftar Mohon Koreksi Kembali")</script>';
            }else{
                $insert = $this->db->insert('tbl_walikelas', $param);
                if ($insert) {
                    echo '<script>alert("Sukses Insert Data")</script>';
                    redirect('walikelas');
                }
            } 
        } //end add

        function update(){
            $id_walikelas = strip_tags(trim($this->input->post('id_walikelas')));
            $param = array(
                'id_rombel'         => strip_tags(trim($this->input->post('rombel'))),
                'id_guru'           => strip_tags(trim($this->input->post('guru')))
            );
            
            $check = $this->db->get_where('tbl_walikelas', $param);
            if ($check->num_rows() > 0) {
                echo '<script>alert(\"Data Telah Terdaftar Mohon Koreksi Kembali\")</script>';
                redirect('walikelas/edit/'.$id_walikelas);
            }else{
                $this->db->where('id_walikelas', $id_walikelas);
                $update = $this->db->update('tbl_walikelas', $param);
                if ($update) {
                    echo '<script>alert("Sukses Update Data")</script>';
                    redirect('walikelas');
                }
            }
        } //end edit
    } //end model
?>
