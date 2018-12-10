<?php 
	Class Users extends CI_Controller{
	function __construct(){
		parent:: __construct();
		$this->load->model('Model_global', 'model');
		check_akses_modul();
	} // end function __construct


    function index(){
    	$data = array(
				'icon'  => 'fa fa-book',
				'title' => 'DATA PENGGUNA',
				'parent'=> 'PENGGUNA SISTEM',
				'child' => 'LIST',
				'user' => $this->model->get_data('tu.id_user, tu.nama_lengkap, tu.foto, tl.nama_level', 'tbl_user as tu, tbl_level_user as tl', 'tu.id_level_user=tl.id_level_user')->result()
			);
    	$this->template->load('template', 'users/list', $data);
    } //end function index

	function edit(){
    	$id_user	= $this->uri->segment(3);
    	$data  		= array(
    		'icon'  => 'fa fa-book',
			'title' => 'EDIT PENGGUNA', 
			'parent'=> 'PENGGUNA SISTEM',
			'child' => 'EDIT',
			'user' => $this->model->get_data('*', 'tbl_user', "id_user='".$id_user."'")->row_object() 
		);
		if (isset($_POST['submit'])) {
			$username 		= strtolower(strip_tags(trim($this->input->post('username'))));
			$nama_lengkap	= strtoupper(strip_tags($this->input->post('nama')));
			$id_level_user	= strtoupper(strip_tags($this->input->post('level')));
			$foto			= $this->model->get_data('foto', 'tbl_user', 'username="'.$username.'"')->row('foto');
			
			// konfigurasi upload foto
			$config['upload_path']          = './upload/user';
			$config['allowed_types']        = 'jpg|jpeg|png';
			$config['max_size']             = 1024;
			$config['file_name']			= $username;
			$config['overwrite']			= TRUE;
			$this->load->library('upload', $config);


			// proses upload
			$uploaded = $this->upload->do_upload('userfile');
			if ($uploaded){
				$fotodb = $username;
			}else{
				$fotodb = $foto;
			}

			// tangkap data
			$upload = $this->upload->data();

			$param = array(
				'username'		=> $username,
				'nama_lengkap'	=> $nama_lengkap,
				'id_level_user'	=> $id_level_user,
				'foto'			=> $fotodb.$upload['file_ext']	
			);
			$update = $this->model->update_data($username, 'username', $param, 'tbl_user');
				if ($update) {
					echo "<script>alert('Sukses Merubah Data Pengguna')</script>";
					redirect('users');
				}else{
					echo "<script>alert('Sukses Merubah Data Pengguna')</script>";
				}
			}
			
    	$this->template->load('template', 'Users/edit', $data);
    } //end function edit


    function delete(){
    	$id_user = $this->uri->segment(3);
    	if (!empty($id_user)) {
    		$delete = $this->model->delete_data($id_user, 'id_user', 'tbl_user');
    		if ($delete) {
    			echo "<script>alert('Sukses Menghapus Data');</script>";
    			redirect('Users');
    		}else{
    			echo "<script>alert('Gagal Menghapus Data!');</script>";
    		}
    	}
	} //end function delete
	
	function add(){ 
		$data = array(
				'icon'  => 'fa fa-book',
				'title' => 'DATA USER',
				'parent'=> 'USER',
				'child' => 'LIST'
			);
		if (isset($_POST['submit'])) {
			$nama_lengkap 	= strtoupper(strip_tags($this->input->post('nama')));
			$username 		= strtolower(strip_tags(trim($this->input->post('username'))));
			$password 		= strip_tags(trim($this->input->post('password')));
			$level 			= $this->input->post('level');
			$check 			= $this->model->get_data('*', 'tbl_user', array('username'=>$username));

			if ($check->num_rows() > 0 ) {
				echo "<script>alert('USERNAME SUDAH TERDAFTAR!');</script>";
			}else{

				// konfigurasi upload foto
				$config['upload_path']          = './upload/user';
				$config['allowed_types']        = 'jpg|jpeg|png';
				$config['max_size']             = 1024;
				$config['file_name']			= $username;
				$config['overwrite']			= TRUE;
				$this->load->library('upload', $config);

				// proses upload
				$uploaded = $this->upload->do_upload('userfile');
				if ($uploaded){
					$fotodb = $username;
				}else{
					$fotodb = 'avatarLP.png';
				}
				// tangkap data
				$upload = $this->upload->data();


				$param = array(
					'nama_lengkap'  => $nama_lengkap,
					'username'		=> $username,
					'id_level_user' => $level,
					'password'		=> md5($password),
					'foto'			=> $fotodb.$upload['file_ext']
				);
				$insert = $this->db->insert('tbl_user', $param);
				if ($insert) {
					echo "<script>alert('SUKSES MENDAFTAR AKUN PEMAKAI SISTEM');</script>";
					redirect('users');
				}else{
					echo "<script>alert('GAGAL MENDAFTAR AKUN PEMAKAI SISTEM');</script>";
				}
			}
		}
		$this->template->load('template', 'users/add', $data);
	} //end add

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
			if ($level == 1) {
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
		$id_level = strip_tags(trim($this->input->get('id_level_user')));
		$id_modul = strip_tags(trim($this->input->get('id_modul')));
		$param 	  = array(
			'id_level_user' => $id_level,
			'id_menu'		=> $id_modul
		);
		$check  = $this->model->get_data('*', 'tbl_user_rule',$param);
		if ($check->num_rows() < 1) {
			$insert = $this->db->insert('tbl_user_rule', $param);
			if ($insert) {
				echo "<script>alert('MEMBERI AKSES')</script>";
			}
		}else{
			$where = array(
				'id_menu'  		=> $id_modul,
				'id_level_user'	=> $id_level,
			);
			$this->db->where($where);
			$delete = $this->db->delete('tbl_user_rule');
			if ($delete) {
				echo "<script>alert('MENGHAPUS AKSES')</script>";
			}
		}
	} //end add_rule

	

}
?> 