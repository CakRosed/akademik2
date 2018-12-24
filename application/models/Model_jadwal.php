<?php
    Class Model_jadwal extends CI_Model{
        
        function generateJadwal(){ 
            $id_kurikulum   = strip_tags(trim($this->input->post('kurikulum')));
            $semester       = get_tahun_akademik_aktif('semester_aktif');
            //ambil data berdasarkan kurikulum yang  dipilih
            $kurikulum_detail = $this->db->get_where('tbl_kurikulum_detail', array('kd_kurikulum'=>$id_kurikulum));
            
            foreach($kurikulum_detail->result() as $row){
                $rombel = $this->db->get_where('tbl_rombel', array('kelas' => $row->kelas));
                foreach($rombel->result() as $rows){
                    $param = array(
                            'id_tahun_akademik'     => get_tahun_akademik_aktif('kd_tahun_akademik'), 
                            'kelas'                 => $row->kelas,
                            'kd_mapel'              => $row->kd_mapel,
                            'id_guru'               => '1',
                            'jam'                   => '',
                            'kd_ruangan'            => '1',
                            'semester'              => $semester,
                            'hari'                  => '',
                            'id_rombel'             => $rows->kd_rombel
                    );
                    $insert= $this->db->insert('tbl_jadwal', $param);
                } //end foreach rombel
            } //end foreach kurikulum detail
            if($insert){
                echo "<script>alert('Generate Jadwal Berhasil');</script>";
            }else{
                echo "<script>alert('Generate Jadwal Gagal!');</script>";
            }
            redirect('jadwal');
        } //end generateJadawl

        function getHari(){
            $days = array(
                'SENIN'  =>  'SENIN',
                'SELASA' =>  'SELASA',
                'RABU'   =>  'RABU',
                'KAMIS'  =>  'KAMIS',
                'JUMAT'  =>  'JUMAT',
                'SABTU'  =>  'SABTU',
                'MINGGU' =>  'MINGGU',
            );
            return $days;
        }
        
        function getJamPelajaran(){
            $jam  = array(
                '07.15 - 08.00' =>'07.15 - 08.00',
                '08.00 - 08.45' =>'08.00 - 08.45',
                '08.45 - 09.30' =>'08.45 - 09.30',
                '09.30 - 10.00' =>'09.30 - 10.00',
                '10.00 - 10.45' =>'10.00 - 10.45',
                '10.45 - 11.30' =>'10.45 - 11.30',
                '11.30 - 12.15' =>'11.30 - 12.15',
                '12.15 - 13.00' =>'12.15 - 13.00',
                '13.00 - 13.30' =>'13.00 - 13.30',
                '13.30 - 14.15' =>'13.30 - 14.15',
                '14.15 - 15.00' =>'14.15 - 15.00'
            );
            $jamm = array(
                '06:15' => '06:15',
                '06:00' => '06:00',
                '06:30' => '06:30',
                '06:45' => '06:45',
                '07:00' => '07:00',
                '07:15' => '07:15',
                '07:30' => '07:30',
                '07:45' => '07:45',
                '08:00' => '08:00',
                '08:15' => '08:15',
                '08:30' => '08:30',
                '08:45' => '08:45',
                '09:00' => '09:00',
                '09:15' => '09:15',
                '09:30' => '09:15',
                '09:45' => '09:45',
                '10:00' => '10:00',
                '10:15' => '10:15',
                '10:30' => '10:30',
                '10:45' => '10:45',
                '11:00' => '11:00',
                '11:15' => '11:15',
                '11:30' => '11:30',
                '11:45' => '11:45',
                '12:00' => '12:00',
                '12:15' => '12:15',
                '12:30' => '12:30',
                '12:45' => '12:45',
                '13:00' => '13:00',
                '13:15' => '13:15',
                '13:30' => '13:30',
                '13:45' => '13:45',
                '14:00' => '14:00',
                '14:15' => '14:15',
                '14:30' => '14:30',
                '14:45' => '14:45',
                '15:00' => '15:00',
                '15:15' => '15:15',
                '15:30' => '15:30',
                '15:45' => '15:45',
                '16:00' => '16:00',
                '16:15' => '16:15',
                '16:30' => '16:30',
                '16:45' => '16:45',
                '17:00' => '17:00',
                '17:15' => '17:15',
                '17:30' => '17:30',
                '17:45' => '17:45'
            );
            return $jam;
        }

    } // end class
?>