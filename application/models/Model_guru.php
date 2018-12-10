<?php
    Class Model_guru extends CI_Model{

        function check_login($email, $password){
            $this->db->where('email',$email);
            $this->db->where('password', md5($password));
            $user = $this->db->get('tbl_guru');
            return $user;
        }
    } 
?>