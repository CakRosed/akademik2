<?php 
    Class Model_jenis_pembayaran extends CI_Model{
        function add(){
            $jenis_pembayaran = strip_tags(strtoupper($this->input->post('nama_jenis')));
            $check = $this->db->get_where('tbl_jenis_pembayaran', array('nama_jenis_pembayaran' => $jenis_pembayaran));
            if ($check->num_rows() >0) {
                echo "<script>alert('Data Telah Terdafatar Mohon Koreksi Kembali')</script>";
            }else{
                $insert = $this->db->insert('tbl_jenis_pembayaran', array('nama_jenis_pembayaran' => $jenis_pembayaran));
                if ($insert) {
                    echo "<script>alert('Sukses Insert Data')</script>";
                    redirect('jenis_pembayaran');
                }
            }
        } //end add

        function edit(){
            $id_jenis   = strip_tags($this->input->post('id_jenis'));
            $nama_jenis = strip_tags($this->input->post('nama_jenis'));
            $check      = $this->db->get_where('tbl_jenis_pembayaran', array('nama_jenis_pembayaran'=>$nama_jenis));
            if($check->num_rows() > 0){
                echo "<script>alert('Data Sudah Terdaftar Mohom Koreksi Kembali!')</script>";
            }else{
                $this->db->where('id_jenis_pembayaran', $id_jenis);
                $update = $this->db->update('tbl_jenis_pembayaran', array('nama_jenis_pembayaran' => $nama_jenis));
                if ($update) {
                    echo "<script>alert('Sukses Mendaftar Jenis Pembayaran!')</script>";
                    redirect('jenis_pembayaran');
                }
            }
        } //end edit
    } //end model
?>