<!-- STUCK DI ALERT DUPLIKASI DATA SISWA -->

 
<?php 
	Class Siswa extends CI_Controller{
		function __construct(){ 
			parent::__construct();
			// $this->load->library('ssp');
			$this->load->model('Model_global', 'model');
			$this->load->model('Model_siswa', 'smodel');
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
				'title' => 'DATA SISWA',
				'parent'=> 'SISWA',
				'child' => 'INPUT'  
			);

			if (isset($_POST['submit'])) {
				$nis 	= strip_tags(trim($this->input->post('nis')));
				$gender = $this->input->post('gender');
				$foto   = $this->smodel->upload_foto($nis, $gender);
				$this->smodel->add($foto);
			}
			$this->template->load('template', 'siswa/add', $data);
		} //end add

		function edit(){ 
			$nis  = $this->uri->segment(3);
			$data = array(
				'icon'  => 'fa fa-users',
				'title' => 'DATA SISWA',
				'parent'=> 'SISWA',
				'child' => 'EDIT',
				'siswa' => $this->db->get_where('tbl_siswa', array('nis' => $nis))->row_object()
			);
			if (isset($_POST['submit'])) {
				$nis 	= strip_tags(trim($this->input->post('nis')));
				$gender = $this->input->post('gender'); 
				$foto = $this->smodel->upload_foto($nis, $gender);
				$this->smodel->edit($foto);	
			}
			$this->template->load('template', 'siswa/edit', $data);
		} //end edit


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
			$info_sekolah = "SELECT js.jumlah_kelas
                        FROM tbl_jenjang_sekolah as js, tbl_sekolah_info as si
						WHERE js.kd_jenjang = si.kd_jenjang_sekolah";
						
			$data = array(
				'icon'  => 'fa fa-users',
				'title' => 'LIST SISWA',
				'parent'=> 'SISWA',
				'child' => 'AKTIF',
				'info'	=> $this->db->query($info_sekolah)->row()  
			);
			$this->template->load('template', 'siswa/siswa_aktif', $data);
		}

		function showRombel(){
			$kelas 		= strip_tags(trim($this->input->get('kelas')));
			$selected 	= strip_tags(trim($this->input->get('rombel')));
			$rombel = $this->db->get_where('tbl_rombel', array('kelas' => $kelas));
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

	