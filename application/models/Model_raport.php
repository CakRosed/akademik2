<?php
    Class Model_raport extends CI_Model{
        
        function terbilang($x){
            $abil = array(
                'Nol','Satu','Dua','Tiga',
                'Empat','Lima','Enam','Tujuh',
                'Delapan','Sembilan','Sepuluh','Sebelas'
            );
            if ($x < 12) {
                return ' '.$abil[$x];
            }elseif ($x < 20) {
                return $this->model->terbilang($x-10)." Belas";
            }elseif ($x == 100) {
                return "Seratus";
            }elseif ($x < 100) {
                return $this->model->terbilang($x/10)." Puluh ".$this->model->terbilang($x%10);
            }elseif ($x < 200) {
                return $this->model->terbilang($x-100). " Ratus ".$this->model->terbilang($x%100);
            }elseif ($x < 1000) {
                return $this->model->terbilang($x/100). " Ribu ".$this->model->terbilang($x%1000);
            }
        } //end terbilang

        function ketercapaian_kompetensi($nilai){
            if($nilai >= 90){
                return "Sangat Baik";
            }elseif ($nilai >=80 && $nilai <90) {
                return "Baik";
            }elseif ($nilai >=75 && $nilai <80) {
                return "Cukup";
            }elseif ($nilai >=50 && $nilai <75) {
                return "Kurang";
            }else {
                return "Buruk";
            }
        } //end ketercapaian

        function rata_rata($id_jadwal){
            $sql = "SELECT sum(nilai)/count(nisn) as rata_rata
                    FROM tbl_nilai
                    WHERE id_jadwal=".$id_jadwal;
            $nilai= $this->db->query($sql)->row_object();
            return $nilai->rata_rata; 
        } //end rata_rata

    } //end model
?>