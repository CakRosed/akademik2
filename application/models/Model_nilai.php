<?php 
Class Model_nilai extends CI_Model{
    function update_nilai(){
        $param = array(
            'nisn'      => strip_tags(trim($this->input->get('nisn'))),
            'id_jadwal' => strip_tags(trim($this->input->get('id_jadwal'))),
            'nilai'     => strip_tags(trim($this->input->get('nilai')))
        );

        $where  = array(
            'nisn'      => $param['nisn'],
            'id_jadwal' => $param['id_jadwal'],
            'nilai'     => $param['nilai']
        );
        $validasi= array('nisn' => $param['nisn'], 'id_jadwal' => $param['id_jadwal']);
        $check   = $this->db->get_where('tbl_nilai', $validasi);
        if ($check->num_rows() > 0) {
            $this->db->where('nisn', $param['nisn']);
            $this->db->where('id_jadwal', $param['id_jadwal']);
            $this->db->update('tbl_nilai', array('nilai' => $param['nilai']));
        }else{
            $this->db->insert('tbl_nilai', $where);
        }
    } //end update nilai
} //end model
?>