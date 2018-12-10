<!-- STUCK DI ALERT DUPLIKASI DATA SISWA -->


<?php 
	Class Siswa extends CI_Controller{
		function __construct(){ 
			parent::__construct();
			// $this->load->library('ssp');
			$this->load->model('Model_global', 'model');
			check_akses_modul();
		}

		function index(){
			$data = array(
				'icon'  => 'fa fa-users',
				'title' => 'DATA SISWA',
				'parent'=> 'SISWA',
				'child' => 'LIST',  
				'siswa' => $this->model->get_all_data('*', 'tbl_siswa')->result()
			);
			$this->template->load('template', 'siswa/list', $data);
		} 
		// end index

		function add(){
			$data = array(
				'icon'  => 'fa fa-users',
				'title' => 'INPUT SISWA',
				'parent'=> 'SISWA',
				'child' => 'INPUT'  
			);

			if (isset($_POST['submit'])) {
				$nisn 	= strip_tags(trim($this->input->post('nisn', TRUE)));
				$nis 	= strip_tags(trim($this->input->post('nis', TRUE)));
				$gender	= $this->input->post('gender', TRUE);
	    		$checknisn 	= $this->model->get_data('*', 'tbl_siswa', 'nisn="'.$nisn.'"');
	    		$checknis   = $this->model->get_data('*', 'tbl_siswa', 'nis="'.$nis.'"');
				
				if ($checknisn->num_rows() > 0){
					$nama = $checknisn->row_object('nama');
					echo "<script>alert('NISN telah terdaftar oleh".$nama->nama."');</script>";
				}elseif($checknis->num_rows() > 0){
					$nama = $checknis->row_object('nama');
					echo "<script>alert('NIS telah terdaftar oleh".$nama->nama."');</script>";
				}else{	
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
						'nisn'			=> strip_tags(trim($this->input->post('nisn', TRUE))),
						'nis'		 	=> strip_tags(trim($this->input->post('nis', TRUE))),
						'nama'			=> strip_tags(trim(strtoupper($this->input->post('nama', TRUE)))),
						'tempat_lahir' 	=> strip_tags(trim(strtoupper($this->input->post('tempat_lahir', TRUE)))),
						'tanggal_lahir'	=> strip_tags(trim($this->input->post('tanggal_lahir', TRUE))),
						'nama_wali'		=> strip_tags(trim(strtoupper($this->input->post('nama_wali', TRUE)))),
						'hp_wali'		=> strip_tags(trim($this->input->post('hp_wali', TRUE))),
						'gender' 		=> $this->input->post('gender', TRUE),
						'kd_agama' 		=> $this->input->post('agama', TRUE),
						'alamat' 		=> strip_tags(trim($this->input->post('alamat', TRUE))),
						'password'		=> 'anonymouse135',
						'id_rombel'		=> strip_tags(trim($this->input->post('rombel', TRUE))),
						'foto'			=> $fotodb.$upload['file_ext']			 
					);

					$id_tahun_akademik = $this->model->get_data('*', 'tbl_tahun_akademik', array('is_aktif'=>'y'))->row_object();
					$param2 = array(
						'nisn'				=> strip_tags(trim($this->input->post('nisn', TRUE))),
						'id_rombel'			=> strip_tags(trim($this->input->post('rombel', TRUE))),
						'id_tahun_akademik'	=> $id_tahun_akademik->kd_tahun_akademik
					);

					// print_r($param2);
					// die;
		            //Parameter pertama adalah data yang ingin di simpan
		            //Parameter kedua adalah nama tabel
					$simpan = $this->model->save_data($param, 'tbl_siswa');
					$backup = $this->model->save_data($param2, 'tbl_history_kelas');
					if ($simpan && $backup) {
						echo "<script>alert('Berhasil Menambah Data<i class='fa fa-check'></i>')</script>";
						redirect('siswa');
					}else{
						echo "<script>alert('Gagal Menambah Data<i class='fa fa-cross'></i>')</script>";
					}

				}
			}
			$this->template->load('template', 'siswa/add', $data);
		}
		// end add


		// start edit
		public function edit(){
			$nisn 	= $this->uri->segment(3);
			
			$data = array(
				'icon'  => 'fa fa-users',
				'title' => 'INPUT SISWA',
				'parent'=> 'SISWA',
				'child' => 'EDIT',
				'siswa' => $this->model->get_data('*', 'tbl_siswa', 'nisn='.$nisn)->row()  
			);

			if (isset($_POST['submit'])) {
				$nisn= strip_tags(trim($this->input->post('nisn', TRUE)));
				$foto = $this->model->get_data('foto', 'tbl_siswa', 'nisn='.$nisn)->row('foto');

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
					$fotodb = $foto; 
				}

				// tangkap data
				$upload = $this->upload->data();

				$param = array(
					'nama'			=> strip_tags(trim($this->input->post('nama', TRUE))),
					'tempat_lahir' 	=> strip_tags(trim(strtoupper($this->input->post('tempat_lahir', TRUE)))),
					'tanggal_lahir'	=> strip_tags(trim($this->input->post('tanggal_lahir', TRUE))),
					'nama_wali'		=> strip_tags(trim(strtoupper($this->input->post('nama_wali', TRUE)))),
					'hp_wali'		=> strip_tags(trim($this->input->post('hp_wali', TRUE))),
					'gender' 		=> $this->input->post('gender', TRUE),
					'kd_agama' 		=> $this->input->post('agama', TRUE),
					'alamat' 		=> strip_tags(trim($this->input->post('alamat', TRUE))),
					'id_rombel'		=> $this->input->post('rombel'),
					'foto'			=> $fotodb.$upload['file_ext']	
				);

				$id_tahun_akademik = $this->model->get_data('*', 'tbl_tahun_akademik', array('is_aktif'=>'y'))->row_object();
				$chek   = $this->model->get_data('id_tahun_akademik, id_rombel', 'tbl_history_kelas', 'id_tahun_akademik='.$id_tahun_akademik->kd_tahun_akademik.' and id_rombel='.$param["id_rombel"]);
				$param2 = array(
					'nisn'				=> strip_tags(trim($this->input->post('nisn', TRUE))),
					'id_rombel'			=> strip_tags(trim($this->input->post('rombel', TRUE))),
					'id_tahun_akademik'	=> $id_tahun_akademik->kd_tahun_akademik
				);
				if ($chek->num_rows()>0) {
					$backup = $this->db->update('tbl_history_kelas', $param2);	
					// echo "backup update";die;
				}else{
					$backup = $this->db->insert('tbl_history_kelas', $param2);
					// echo "backup insert";die;
				}
				//masalah terletak pda nis dan nisn yang tidak muncul  
				// print_r($param);
				// die;
				$update = $this->model->update_data($nisn, 'nisn', $param, 'tbl_siswa');
				$getBack= $this->model->get_data('kd_rombel, kd_jurusan', 'tbl_rombel', 'kd_rombel='.$param['id_rombel'])->row_object();	
				if ($update && $backup) {
					echo "<script>alert('Sukses Mengubah Data');</script>";
					redirect('siswa/siswa_aktif/'.$getBack->kd_rombel.'/'.$getBack->kd_jurusan);
				}else{
					echo "<script>alert('Gagal Mengubah Data!');</script>";
				}
			}

			$this->template->load('template', 'siswa/edit', $data);
		}
		// end edit

		function delete(){
			$nisn = $this->uri->segment(3);
			if (!empty($nisn)) {
				$delete = $this->model->delete_data($nisn, 'nisn', 'tbl_siswa');
				if ($delete) {
					echo "<script>alert('Sukses Hapus Data');</script>";
					redirect('siswa');
				}else{
					echo "<script>alert('Gagal Hapus Data!');</script>";
				redirect('siswa');
				}
			}
			// endif
		}

		// start profile
		public function profile(){
			$data = array(
				'icon'  => 'fa fa-users',
				'title' => 'INPUT SISWA',
				'parent'=> 'SISWA',
				'child' => 'PROFIL'  
			);
			$this->template->load('template', 'siswa/profile', $data);
		}
		// end profile

		function siswa_aktif(){
			$data = array(
				'icon'  => 'fa fa-users',
				'title' => 'LIST SISWA',
				'parent'=> 'SISWA',
				'child' => 'AKTIF' 
			);
			$this->template->load('template', 'siswa/siswa_aktif', $data);
		}

		function showRombel(){
			$jurusan = strip_tags(trim($this->input->get('jurusan')));
			$selected = strip_tags(trim($this->input->get('rombel')));
			// $selected = strip_tags(trim($this->uri->segment(3)));
			$rombel = $this->model->get_data('*', 'tbl_rombel', 'kd_jurusan="'.$jurusan.'"');
			echo "<select class='form-control' id='rombel' name='rombel' onchange='loadData()'>";
			foreach ($rombel->result() as $row) {
				if ($row->kd_rombel==$selected) {
					echo "<option value='$row->kd_rombel' selected>$row->nama_rombel</option>";
				}else{
					echo "<option value='$row->kd_rombel'>$row->nama_rombel</option>";
				}
			}
			echo "</select>";
		} //end showRombel

		function loadData(){
			$rombel 	= strip_tags(trim($this->input->get('rombel')));
			$siswa		= $this->model->get_data('*', 'tbl_siswa', array('id_rombel'=>$rombel));
			if ($siswa->num_rows()>0) {
				echo 
					"<table id='example1' class='table table-striped table-bordered' style='width:100%'>
						<thead>
							<tr>
								<th class='text-center'>NO</th>
								<th class='text-center'>FOTO</th>
								<th class='text-center'>NAMA SISWA</th>
								<th class='text-center'>NISN</th>
								<th class='text-center'>NIS</th>
								<th class='text-center'>JK</th>
								<th class='text-center'>MENU</th>
							</tr>
						</thead>
						<tbody>";
							$no=1;
							foreach ($siswa->result() as $row) {
								if ($row->gender=='L') {
									$gender = 'LAKI - LAKI';
								}else{
									$gender = 'PEREMPUAN';
								}
								echo 
								"<tr>
									<td class='text-center'>".$no++."</td>
									<td class='text-center'>
										<img style='width:35px;' class='img-circle' src='".base_url('upload/siswa/').$row->foto."'>
									</td>
									<td class='text-center'>$row->nama</td>
									<td class='text-center'>".$row->nisn."</td>
									<td class='text-center'>".$row->nis."</td>
									<td class='text-center'>".$gender."</td>
									<td class='text-center'>
										<a class='btn btn-info btn-xs btn-flat' href='".base_url('siswa/detail/').$row->nisn."'><i class='fa fa-eye'></i></a>
										
										<a class='btn btn-warning btn-xs btn-flat' href='".base_url('siswa/edit/').$row->nisn."'><i class='fa fa-pencil-square-o'></i></a>
										
										<a class='btn btn-danger btn-xs btn-flat' href='".base_url('siswa/delete/').$row->nisn."'><i class='fa fa-trash'></i></a>
									</td>
								</tr>";
							}
				echo	"</tbody>
					</table>";
			}else{
				echo "<div class='alert alert-danger'><h5 class='text-center'>TIDAK ADA DATA DALAM DATABASE <i class='fa fa-info-circle'></i></h5></div>";die;
			}
		} //end loadData

		function exportExcel(){
			$this->load->library('CPHP_excel');
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'NIM');
			$objPHPExcel->getActiveSheet()->setCellValue('B1', 'SISWA');
			
			$rombel = $_POST['rombel'];
			$this->db->where('id_rombel',$rombel);
			$siswa = $this->db->get('tbl_siswa');
			$no=2;
			foreach ($siswa->result() as $row){
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$no, $row->nisn);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$no, $row->nama);
				$no++;
			}
			
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
			$objWriter->save("data-siswa.xlsx");
			$this->load->helper('download');
			force_download('data-siswa.xlsx', NULL);
		} //end exportExcel
	} //end all

	