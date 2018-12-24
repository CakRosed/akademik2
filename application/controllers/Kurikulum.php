<?php 
Class Kurikulum extends CI_Controller{
    function __construct(){
        parent:: __construct();
            // $this->load->model('Model_global', 'model');
            check_akses_modul();
            $this->load->model('Model_kurikulum', 'model');
        } // end function __construct


    function index(){
    	$data = array(
				'icon'  => 'fa fa-newspaper-o',
				'title' => 'DATA KURIKULUM',
				'parent'=> 'KURIKULUM',
				'child' => 'LIST',
				'kurikulum'  => $this->db->get('tbl_kurikulum')->result() 
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
            $this->model->add();
    	}
    	$this->template->load('template', 'kurikulum/add', $data);
    } //end function add

    function edit(){ 
    	$id_kurikulum = $this->uri->segment(3);
    	$data  = array(
    		'icon'      => 'fa fa-newspaper-o',
			'title'     => 'EDIT KURIKULUM',
			'parent'    => 'KURIKULUM',
			'child'     => 'EDIT',
			'kurikulum' => $this->db->get_where('tbl_kurikulum', array('id_kurikulum' => $id_kurikulum))->row_object() 
    	);

    	if (isset($_POST['submit'])) {
            $this->model->update();
        } // end if post

    	$this->template->load('template', 'kurikulum/edit', $data);
    } //end function edit

    function delete(){
    	$id_kurikulum = $this->uri->segment(3);
    	if (!empty($id_kurikulum)) {
            $this->db->where('id_kurikulum', $id_kurikulum);
    		$delete = $this->db->delete('tbl_kurikulum');
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
        $kelas          = $this->input->get('kelas');
        if ($kelas == 'semua_kelas') {
            $selected_kelas = '';
        }else{
            $selected_kelas = "and kd.kelas='$kelas'";
        } 

        echo '<table id="example1" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">NO</th>
                        <th class="text-center">KODE MAPEL</th>
                        <th class="text-center">MATA PELAJARAN</th>
                        <th class="text-center">KELAS</th>
                        <th class="text-center">MENU</th>
                    </tr> 
                </thead>
                <tbody>';

                $sql ="SELECT tm.kd_mapel, tm.nama_mapel, kd.kelas, kd.kd_kurikulum_detail, kd.kd_kurikulum
                        FROM tbl_kurikulum_detail as kd, tbl_kurikulum as tk, tbl_mapel as tm
                        WHERE tk.id_kurikulum=$kd_kurikulum and kd.kd_kurikulum = tk.id_kurikulum and kd.kd_mapel = tm.kd_mapel $selected_kelas";
                $kurikulum = $this->db->query($sql)->result();
                $no = 1;
                foreach ($kurikulum as $row) {
                    echo "
                        <tr>
                            <td  class='text-center'>".$no++."</td>
                            <td  class='text-center'>".$row->kd_mapel."</td>
                            <td  class='text-center'>".$row->nama_mapel."</td>
                            <td  class='text-center'>KELAS ".$row->kelas."</td>
                            <td  class='text-center'>
                                ".anchor('kurikulum/deletedetail/'.$row->kd_kurikulum_detail.'/'.$row->kd_kurikulum,'<i class="fa fa-trash"></i>', 'class="btn btn-xs btn-danger tooltips btn-flat"')."
                            </td>
                        </tr>";
                }
        echo '</tbody></table>';
    } //end deataKurikulumDetail


    function deletedetail(){
        $kd_kurikulum_detail = $this->uri->segment(3);
        $kd_kurikulum        = $this->uri->segment(4);
        if (!empty($kd_kurikulum_detail) && !empty($kd_kurikulum)) {
            $this->db->where('kd_kurikulum_detail', $kd_kurikulum_detail);
            $delete = $this->db->delete('tbl_kurikulum_detail');
            if ($delete) {
                echo "<script>alert('Sukses Menghapus Data');</script>";
                redirect('kurikulum/detail/'.$id_kurikulum);
            }else{
                echo "<script>alert('Gagal Menghapus Data!');</script>";
            }
        }
    } //end deletedetail

    function adddetail(){
        
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

        if (isset($_POST['submit'])) {
            $this->model->addDetail();
        }
    $this->template->load('template', 'kurikulum/add_detail', $data);
    }

}
?> 