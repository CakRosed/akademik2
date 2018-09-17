<?php 
	Class Siswa extends CI_Controller{
		function __construct(){ 
			parent::__construct();
			// $this->load->library('ssp');
			$this->load->model('Model_global', 'model');
		}

		public function index(){
			$data = array(
				'icon'  => 'fa fa-users',
				'title' => 'DATA SISWA',
				'parent'=> 'SISWA',
				'child' => 'LIST',  
				'siswa' => $this->model->get_all_data('*', 'tbl_siswa')->result()
			);
			$this->template->load('template', 'siswa/list', $data);
		}


		public function add(){
			$data = array(
				'icon'  => 'fa fa-users',
				'title' => 'INPUT SISWA',
				'parent'=> 'SISWA',
				'child' => 'INPUT'  
			);

			if (isset($_POST['submit'])) {
				$nisn 	= $this->input->post('nisn', TRUE);
				$gender	= $this->input->post('gender', TRUE);
				$check 	= $this->db->get_where('tbl_siswa', array('nisn' => $nisn))->num_rows();

					#
				// konfigurasi upload foto
				$config['upload_path']          = './upload/siswa';
				$config['allowed_types']        = 'jpg|jpeg|png';
				$config['max_size']             = 1024;
				$config['file_name']			= $nisn;
				$config['overwrite']			= TRUE;
				$this->load->library('upload', $config);

				// proses upload
				$uploaded = $this->upload->do_upload('userfile');
				if ($uploaded){
					$fotodb = $nisn;
				}else{
					if ($gender == 'L') {
						$fotodb = 'avatarL.png';
					}else{
						$fotodb = 'avatarP.png';
					}
				}

				// tangkap data
				$upload = $this->upload->data();

				// lakukan fungsi simpan data ke databse

				// $$this->db->get_where('tbl_siswa');
				$param = array(
					'nisn'			=> $this->db->escape($this->input->post('nisn', TRUE)),
					'nis'		 	=> $this->db->escape($this->input->post('nis', TRUE)),
					'nama'			=> $this->db->escape(strtoupper($this->input->post('nama', TRUE))),
					'tempat_lahir' 	=> $this->db->escape(strtoupper($this->input->post('tempat_lahir', TRUE))),
					'tanggal_lahir'	=> $this->input->post('tanggal_lahir', TRUE),
					'nama_wali'		=> $this->db->escape(strtoupper($this->input->post('nama_wali', TRUE))),
					'hp_wali'		=> $this->db->escape($this->input->post('hp_wali', TRUE)),
					'gender' 		=> $this->input->post('gender', TRUE),
					'kd_agama' 		=> $this->input->post('agama', TRUE),
					'alamat' 		=> $this->db->escape($this->input->post('alamat', TRUE)),
					'password'		=> 'anonymouse135',
					'foto'			=> $fotodb.$upload['file_ext']			 
				);


				$this->input->post($param, TRUE);

				// print_r($param);
	   			// die;
	            //Parameter pertama adalah data yang ingin di simpan
	            //Parameter kedua adalah nama tabel

				$simpan = $this->model->save_data($param, 'tbl_siswa');

				if ($simpan) {
					echo "<script>alert('Berhasil Menambah Data<i class='fa fa-check'></i>')</script>";
					redirect('siswa');
				}else{
					echo "<script>alert('Gagal Menambah Data<i class='fa fa-cross'></i>')</script>";
					redirect('siswa/add');
				}
			}
			$this->template->load('template', 'siswa/add', $data);
		}
		// end add

	}

