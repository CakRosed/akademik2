<?php 
	Class Users extends CI_Controller{
	function __construct(){
		parent:: __construct();
		// $this->load->model('Model_global', 'model');
		check_akses_modul();
		$this->load->model('Model_user', 'model');
	} // end function __construct


    function index(){
		$sql  = "SELECT tu.id_user, tu.nama_lengkap, tu.foto, tl.nama_level
				FROM tbl_user as tu, tbl_level_user as tl
				WHERE tu.id_level_user=tl.id_level_user"; 
    	$data = array(
				'icon'  => 'fa fa-book',
				'title' => 'DATA PENGGUNA',
				'parent'=> 'PENGGUNA SISTEM',
				'child' => 'LIST',
				'user' => $this->db->query($sql)->result()
			);
    	$this->template->load('template', 'users/list', $data);
    } //end function index

	function add(){  
		$data = array(
				'icon'  => 'fa fa-book',
				'title' => 'DATA USER',
				'parent'=> 'USER',
				'child' => 'LIST'
			);
		if (isset($_POST['submit'])) {
			$username 	= strtolower(strip_tags(trim($this->input->post('username'))));
			$foto 		= $this->model->upload_foto($username);
			$this->model->add($foto, $username);
		}
		$this->template->load('template', 'users/add', $data);
	} //end add

	function edit(){
    	$id_user	= $this->uri->segment(3);
    	$data  		= array(
    		'icon'  => 'fa fa-book',
			'title' => 'EDIT PENGGUNA', 
			'parent'=> 'PENGGUNA SISTEM',
			'child' => 'EDIT',
			'user'  => $this->db->get_where('tbl_user', array('id_user' => $id_user))->row_object() 
		);
		if (isset($_POST['submit'])) {
			$username 		= strtolower(strip_tags(trim($this->input->post('username'))));
			$foto 			= $this->model->upload_foto($username);
			$this->model->update($foto, $username);
		}
    	$this->template->load('template', 'Users/edit', $data);
    } //end function edit


    function delete(){
    	$id_user = $this->uri->segment(3);
    	if (!empty($id_user)) {
			$this->db->where('id_user', $id_user);
    		$delete = $this->db->delete('tbl_user');
    		if ($delete) {
    			echo "<script>alert('Sukses Menghapus Data');</script>";
    			redirect('Users');
    		}else{
    			echo "<script>alert('Gagal Menghapus Data!');</script>";
    		}
    	}
	} //end function delete
	
	function rule(){
		$data = array(
				'icon'  => 'fa fa-book',
				'title' => 'DATA USER',
				'parent'=> 'USER',
				'child' => 'ATURAN'
		);
		$this->template->load('template', 'users/rule', $data);
	} //end rule

	function loadData(){
		$level = strip_tags(trim($this->input->get('level')));
		echo 
		"<br><table class='table table-striped table-bordered' id='example1'>
			<thead>
				<tr>
					<th class='text-center' width='20'>NO.</th>
					<th class='text-center'>NAMA MODUL</th>
					<th class='text-center'>LINK</th>
					<th class='text-center'>HAK AKSES</th>
				</tr>
			</thead>
			<tbody>";
			if ($level == 10) {
				echo "<td class='text-center' colspan=4>ADMIN MEMPUNYAI HAK AKSES SEMUA MODUL</td>";
			}else{
				$modul = $this->db->get('tabel_menu');
				$no=1;
				foreach ($modul->result() as $row) {
					echo 
					"<tr>
						<td class='text-center'>".$no++."</td>
						<td>".strtoupper($row->nama_menu)."</td>
						<td>".strtoupper($row->link)."</td>
						<td wdith='30' class='text-center'><input type='checkbox' ";
					$this->chek_akses($level, $row->id);
					echo " onclick='addRule($row->id)'></td>
					</tr>";
				}
			}
		echo"</tbody>
		</table";
	} //end load data

	function chek_akses($level_user,$id_menu){
		$data = array('id_level_user'=>$level_user,'id_menu'=>$id_menu);
		$chek = $this->db->get_where('tbl_user_rule',$data);
		if($chek->num_rows()>0){
			echo "checked";
		} 
    } // end chek akses

	function add_rule(){
		$param 	  = array(
			'id_level_user' => strip_tags(trim($this->input->get('id_level_user'))),
			'id_menu'		=> strip_tags(trim($this->input->get('id_modul')))
		);
		$check  = $this->db->get_where('tbl_user_rule',$param);
		if ($check->num_rows() < 1) {
			$insert = $this->db->insert('tbl_user_rule', $param);
			if ($insert) {
				echo "<script>alert('MEMBERI AKSES')</script>";
			}
		}else{
			$this->db->where($param);
			$delete = $this->db->delete('tbl_user_rule');
			if ($delete) {
				echo "<script>alert('MENGHAPUS AKSES')</script>";
			}
		}
	} //end add_rule

	

}
?> 