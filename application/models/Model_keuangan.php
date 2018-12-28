<?php 
    Class Model_keuangan extends CI_Model{
        function add(){
            $param = array(
                'nisn'                  =>  strip_tags(trim($this->input->post('nisn'))),
                'tanggal'               =>  strip_tags(trim($this->input->post('tanggal'))),
                'id_jenis_pembayaran'   =>  strip_tags(trim($this->input->post('jenis_pembayaran'))),
                'jumlah'                =>  strip_tags(trim($this->input->post('akan_dibayar'))),
                'keterangan'            =>  strip_tags($this->input->post('keterangan'))
            );

            $where  = array(
                'nisn'  => $param['nisn'],
                'id_jenis_pembayaran'=>$param['id_jenis_pembayaran']
            );
            $check  = $this->db->get_where('tbl_pembayaran', $where);
            if ($check->num_rows() > 0) {
                $biaya = $check->row();
                $param2 = array(
                    'tanggal'   => $param['tanggal'],
                    'jumlah'    => $biaya->jumlah + $param['jumlah'],
                    'keterangan'=> $param['keterangan']
                );
                $this->db->where('id_pembayaran', $biaya->id_pembayaran);
                $update = $this->db->update('tbl_pembayaran', $param2);
                if ($update) {
                    echo "<script>alert('Berhasil Menambahkan Pembayaran Dengan Pembayaran Sebelumnya')</script>";
                    redirect('keuangan/form');
                }
            }else{
                $insert = $this->db->insert('tbl_pembayaran', $param);
                if ($insert) {
                    redirect('keuangan/form');
                }
            }
        } //end add
        
        function update_setup_biaya(){
            $jenis_pembayaran = $this->db->get('tbl_jenis_pembayaran');
            foreach ($jenis_pembayaran->result() as $row) {
                $param = array(
                    'id_tahun_akademik'     => get_tahun_akademik_aktif('kd_tahun_akademik'),
                    'id_jenis_pembayaran'   => $row->id_jenis_pembayaran,
                    'jumlah_biaya'          => strip_tags($this->input->post($row->id_jenis_pembayaran))
                );
                $where = array(
                    'id_tahun_akademik'     => $param['id_tahun_akademik'],
                    'id_jenis_pembayaran'   => $param['id_jenis_pembayaran']
                );
                $check = $this->db->get_where('tbl_biaya_sekolah', $where);
                if ($check->num_rows() > 0) {
                    $id = $check->row();
                    $this->db->where('id_biaya', $id->id_biaya);
                    $update = $this->db->update('tbl_biaya_sekolah', array('jumlah_biaya'=> $param['jumlah_biaya']));
                }else{
                    $insert = $this->db->insert('tbl_biaya_sekolah', $param);
                    if ($insert) {
                        redirect('keuangan/setup');
                    }
                }
            }
            redirect('keuangan/setup');
        } //end update
    } //end model
?>