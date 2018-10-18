<?php 
 Class Guru extends CI_Controller{
 	function __construct(){
 		parent:: __construct();
 			$this->load->model('Model_global', 'model');
 			$this->load->library('form_validation');
 	}


    function index(){
    	$data = array(
				'icon'  => 'fa fa-graduation-cap',
				'title' => 'DATA GURU',
				'parent'=> 'GURU',
				'child' => 'LIST',
				'guru'  => $this->model->get_all_data('*', 'tbl_guru')->result() 
			);
    	$this->template->load('template', 'guru/list', $data);
    }

    function add(){
    	$data = array(
				'icon'  => 'fa fa-graduation-cap',
				'title' => 'INPUT GURU',
				'parent'=> 'GURU',
				'child' => 'INPUT',
			);
    	$this->template->load('template', 'guru/add', $data);
    }
 }
 ?> 