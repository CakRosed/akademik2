<?php 
    Class Model_user extends CI_Model{

        function check_login($username, $password){
            $this->db->where('username',$username);
            $this->db->where('password', md5($password));
            $user = $this->db->get('tbl_user');
            return $user;
        }
    }
?>