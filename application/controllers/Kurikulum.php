<?php 
 Class Kurikulum extends CI_Controller{
 	function __construct(){
 		parent:: __construct();
 			$this->load->model('Model_global', 'model');
            check_akses_modul();
        } // end function __construct


    function index(){
    	$data = array(
				'icon'  => 'fa fa-newspaper-o',
				'title' => 'DATA KURIKULUM',
				'parent'=> 'KURIKULUM',
				'child' => 'LIST',
				'kurikulum'  => $this->model->get_all_data('*', 'tbl_kurikulum')->result() 
			);
    	$this->template->load('template', 'kurikulum/list', $data);
    } //end function index

    function add(){
    	$data = array( 
				'icon'  => 'fa fa-calendar-o',
				'title' => 'INPUT KURIKULUM',
				'parent'=> 'KURIKULUM',
				'child' => 'INPUT' 
			);

    	if (isset($_POST['submit'])) {
            $kurikulum  = trim($this->input->post('nama_kurikulum'));
            $is_aktif 	= strip_tags(trim($this->input->post('is_aktif')));
    		$check      = $this->model->get_data('*', 'tbl_kurikulum', 'nama_kurikulum="'.$kurikulum.'"');
            if ($check->num_rows() > 0) {
                echo "<script>alert('kurikulum Telah TERDAFTAR! silahkan cek ulang');</script>";
            }else{
                $param = array(
                    'nama_kurikulum'    => $kurikulum,
                    'is_aktif'          => $is_aktif
                );
                if ($is_aktif=='y') {
					$param2 = array(
						'is_aktif'		=> 'n' 
					);
					$this->db->where(array('is_aktif'=>'y'));
					$update = $this->db->update('tbl_kurikulum', $param2);
				} // end cek y

                $simpan = $this->model->save_data($param, 'tbl_kurikulum');
                if ($simpan && $update) {
                    echo "<script>alert('Berhasil Menambah Data');</script>";
                    redirect('kurikulum');
                }else{
                    echo "<script>alert('Gagal menambah data!');</script>";
                }
            }
    	}
    	$this->template->load('template', 'kurikulum/add', $data);
    } //end function add

    function edit(){ 
    	$id_kurikulum = $this->uri->segment(3);
    	$data  = array(
    		'icon'  => 'fa fa-newspaper-o',
			'title' => 'EDIT KURIKULUM',
			'parent'=> 'KURIKULUM',
			'child' => 'EDIT',
			'kurikulum' => $this->model->get_data('*', 'tbl_kurikulum', "id_kurikulum='".$id_kurikulum."'")->row_object() 
    	);

    	if (isset($_POST['submit'])) {
            $id_kurikulum 	= strip_tags(trim($this->input->post('id_kurikulum', TRUE)));
            $kurikulum      = trim($this->input->post('nama_kurikulum'));
            $is_aktif 	    = strip_tags(trim($this->input->post('is_aktif')));
    		$param = array(
                    'id_kurikulum'      => $id_kurikulum,
                    'nama_kurikulum'    => $kurikulum,
                    'is_aktif'          => $is_aktif
                );
            $param2 = array(
                'is_aktif'		 => 'n'
            );

            if ($is_aktif=='y') {
                $param2 = array(
                    'is_aktif'		=> 'n'
                );
                $this->db->where(array('is_aktif'=>'y'));
                $update2 = $this->db->update('tbl_kurikulum', $param2);
            } // end cek y

            $update = $this->model->update_data($id_kurikulum, 'id_kurikulum', $param, 'tbl_kurikulum');
    	   if ($update && $update2) {
                echo "<scipt>alert('Sukses Mendaftar Mata Pelajaran');</script>";
                redirect('kurikulum');
           }else{
                echo "<script>alert('Gagal Mendaftar Mata Kuliah!');</script>";
           }
        } // end if post

    	$this->template->load('template', 'kurikulum/edit', $data);
    } //end function edit

    function delete(){
    	$id_kurikulum = $this->uri->segment(3);
    	if (!empty($id_kurikulum)) {
    		$delete = $this->model->delete_data($id_kurikulum, 'id_kurikulum', 'tbl_kurikulum');
    		if ($delete) {
    			echo "<script>alert('Sukses Menghapus Data');</script>";
    			redirect('kurikulum');
    		}else{
    			echo "<script>alert('Gagal Menghapus Data!');</script>";
    		}
    	}
    } //end function delete

    function detail(){
        
        // join query database antara tbl_info_sekolah dan tbl_jenjang_sekolah untuk mengambil jumlah kelas sesuai jenjang yang terdaftar pada tbl_sekolah_info 
        $info_sekolah = "SELECT js.jumlah_kelas
                                FROM tbl_jenjang_sekolah as js, tbl_sekolah_info as si
                                WHERE js.kd_jenjang = si.kd_jenjang_sekolah";

        $data = array(
            'icon'          => 'fa fa-search',
            'title'         => 'DETAIL KURIKULUM',
            'parent'        => 'KURIKULUM',
            'child'         => 'DETAIL',
            'info'          => $this->db->query($info_sekolah)->row(),
        );

        $this->template->load('template', 'kurikulum/detail', $data);
    }//end detail

    function dataKurikulumDetail(){
        $kd_kurikulum   = $this->uri->segment(3);
        $kd_jurusan     = $this->input->get('jurusan');
        $kelas          = $this->input->get('kelas');
        if ($kelas == 'semua_kelas') {
            $selected_kelas = '';
        }else{
            $selected_kelas = "and kd.kelas='$kelas'";
        } 

         echo '<table class="table table-striped table-bordered" style="width:100%">
                <tr>
                  <th class="text-center">NO</th>
                  <th class="text-center">KODE MAPEL</th>
                  <th class="text-center">MATA PELAJARAN</th>
                  <th class="text-center">KELAS</th>
                  <th class="text-center">MENU</th>
                </tr>'; 
 
                $sql ="SELECT tj.nama_jurusan, tm.kd_mapel, tm.nama_mapel, kd.kelas, kd.kd_kurikulum_detail, kd.kd_kurikulum
                        FROM tbl_kurikulum_detail as kd, tbl_kurikulum as tk, tbl_mapel as tm, tbl_jurusan as tj
                        WHERE tk.id_kurikulum=$kd_kurikulum and kd.kd_kurikulum = tk.id_kurikulum and kd.kd_mapel = tm.kd_mapel and kd.kd_jurusan = tj.kd_jurusan $selected_kelas and kd.kd_jurusan ='$kd_jurusan'";
                $kurikulum = $this->db->query($sql)->result();
                $no = 1;
                foreach ($kurikulum as $row) {
                    echo "<tr>
                            <td  class='text-center'>".$no++."</td>
                            <td  class='text-center'>".$row->kd_mapel."</td>
                            <td  class='text-center'>".$row->nama_mapel."</td>
                            <td  class='text-center'>KELAS ".$row->kelas."</td>
                            <td  class='text-center'>
                                ".anchor('kurikulum/deletedetail/'.$row->kd_kurikulum_detail.'/'.$row->kd_kurikulum,'<i class="fa fa-trash"></i>', 'class="btn btn-xs btn-danger tooltips btn-flat"')."
                            </td>
                        </tr>";
                }
          echo '</table>';
    } //end deataKurikulumDetail


    function deletedetail(){
        $kd_kurikulum_detail = $this->uri->segment(3);
        $kd_kurikulum        = $this->uri->segment(4);
        if (!empty($kd_kurikulum_detail) && !empty($kd_kurikulum)) {
            $delete = $this->model->delete_data($kd_kurikulum_detail, 'kd_kurikulum_detail', 'tbl_kurikulum_detail');
            if ($delete) {
                echo "<script>alert('Sukses Menghapus Data');</script>";
                redirect('kurikulum/detail/'.$id_kurikulum);
            }else{
                echo "<script>alert('Gagal Menghapus Data!');</script>";
            }
        }
    } //end deletedetail

    function adddetail(){
        if (isset($_POST['submit'])) {

            $kd_mapel       = $this->input->post('mapel');
            $kd_jurusan     = $this->input->post('jurusan');
            $kelas          = $this->input->post('kelas');
            $kd_kurikulum	= $this->uri->segment(3);
            $param = array(

                'kd_mapel'      => $kd_mapel,
                'kd_jurusan'    => $kd_jurusan,
                'kelas'         => $kelas,
                'kd_kurikulum'  => $kd_kurikulum
            );

            $sql = "SELECT *
                    FROM tbl_kurikulum_detail as kd
                    WHERE kd.kelas='$kelas' and kd.kd_jurusan='$kd_jurusan' and kd.kd_mapel='$kd_mapel' and kd_kurikulum=$kd_kurikulum";
            $check = $this->db->query($sql);
            if ($check->num_rows() > 0) {
                echo "<script>alert('Mata Pelajaran Telah Terdaftar Pada Kelas Yang Sama!')</script>";
            }else{
                $save =$this->model->save_data($param,'tbl_kurikulum_detail');
                if ($save) {
                    echo "<scrip>alert('Sukses Insert Data')</script>";
                    redirect('kurikulum/detail/'.$this->uri->segment(3));
                }else{
                    echo "<scrip>alert('Gagal Insert Data!')</scrip>";
                }
            }
        }
        $info_sekolah   = "SELECT js.jumlah_kelas
                    FROM tbl_jenjang_sekolah as js, tbl_sekolah_info as si
                    WHERE js.kd_jenjang = si.kd_jenjang_sekolah";
         $data = array(
            'icon'          => 'fa fa-plus',
            'title'         => 'TAMBAH DETAIL KURIKULUM',
            'parent'        => 'KURIKULUM',
            'child'         => 'TAMBAH DETAIL',
            'info'          => $this->db->query($info_sekolah)->row()
        );
    $this->template->load('template', 'kurikulum/add_detail', $data);
    }

 }
 ?> 