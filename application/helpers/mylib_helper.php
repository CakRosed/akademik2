<?php 
	function cmb_dinamis($name, $table, $field, $pk, $selected=null, $extra=null){
		// karena tidak bisa menggunakan this 
		$ci =& get_instance();

		$cmb = "<select name='$name' class='form-control' $extra>";
		$data = $ci->db->get($table)->result();
		foreach($data as $row){
			$cmb .= "<option value='".$row->$pk."'";
			$cmb .= $selected == $row->$pk?'selected':''; //shorthend untuk if else
			$cmb .= ">".$row->$field."</option>";
		}
		$cmb .= "</select>";
		return $cmb;
	}


	function check_akses_modul(){ 
		$CI =& get_instance();
		// ambil parameter uri segment untuk controller dan method
		$controller = $CI->uri->segment(1);
		$method 	= $CI->uri->segment(2);
		
		//check url
		if (empty($method)) {
			$url = $controller;
		}else{
			$url = $controller.'/'.$method;
		}

		//ambil parameter id menu dan level user
		$menu  	= $CI->db->get_where('tabel_menu', array('link'=>$url))->row_array(); 
		$level 	= $CI->session->userdata('id_level_user');

		if (!empty($level)) {
			//check apakah level ini diberikan hak akses atau tidak
			$check = $CI->db->get_where('tbl_user_rule', array('id_level_user'=>$level, 'id_menu'=>$menu['id']));

			if ($check->num_rows() < 1 and $method!='data' 
				and $method!='generateJadwal' 
				and $method!='ressetJadwal' 
				and $method!='dataJadwal' 
				and $method!='dataWalikelas' 
				and $method!='updateGuru' 
				and $method!='updateRuangan' 
				and $method!='updateHari' 
				and $method!='updateJam' 
				and $method!='deleteJadwal' 
				and $method!='rombel' 
				and $method!='showRombel' 
				and $method!='cetak_jadwal'
				and $method!='add' 
				and $method!='edit' 
				and $method!='delete'
				and $method!='detail'
				and $method!='dataKurikulumDetail' 
				and $method!='deleteDetail'
				and $method!='addDetail'
				and $method!='adddetail'
				and $method!='loadData'
				and $method!='add_rule' 
				and $method!='chek_akses' 
				and $method!='rule'
				and $method!='update'
				and $method!='auto_complete'
				and $method!='auto_pembayaran'
				and $method!='exportExcel'
				and $method!='update_walikelas') {
			echo"<h3><i class='fa fa-warning text-red'></i> Oops! Anda tidak mempunyai hak akases ke halaman ini.</h3>
				<p>
					Silahkan cek konfirmasi kepada admin mengenai hak akases mengenai laman ini ;)
				</p>";die;
			}
		}else{
			redirect('autentifikasi');
		}
	} //endd

	function cmb_kelas($loadjs, $selected=null){
		$ci =& get_instance();
		$info_sekolah = "SELECT js.jumlah_kelas
                        FROM tbl_jenjang_sekolah as js, tbl_sekolah_info as si
						WHERE js.kd_jenjang = si.kd_jenjang_sekolah";
		$info = $ci->db->query($info_sekolah)->row();
		echo '<select class="form-control" name="kelas" id="kelas" onchange="'.$loadjs.'">';
		for ($i=1; $i <= $info->jumlah_kelas; $i++) {
			if (!empty($selected) && $i==$selected) {
				echo "<option selected value='$i'>KELAS $i</option>"; 
			}else{
				echo "<option value='$i'>KELAS $i</option>"; 
			} 
		}
		echo '</select>';
	} //end cmb_kelas

	function check_biaya($id_jenis_pembayaran){
		$ci =& get_instance();
		$where = array(
			'id_jenis_pembayaran' 	=> $id_jenis_pembayaran,
			'id_tahun_akademik'		=> get_tahun_akademik_aktif('kd_tahun_akademik')
		);
		$biaya = $ci->db->get_where('tbl_biaya_sekolah', $where);
		if ($biaya->num_rows() >0 ) {
			$row = $biaya->row();
			return $row->jumlah_biaya;
		}
	} //end check komponen

	function get_tahun_akademik_aktif($field) {
		$ci =& get_instance();
		$ci->db->where('is_aktif', 'y');
		$tahun = $ci->db->get('tbl_tahun_akademik')->row_array();
		return $tahun[$field];
	} //end get tahun akademik aktif

	function check_nilai($nisn, $id_jadwal){
		$ci 	=& get_instance();
		$where  = array(
			'nisn' 		=> $nisn,
			'id_jadwal'	=> $id_jadwal
		);
		$nilai 	= $ci->db->get_where('tbl_nilai', $where);
		if ($nilai->num_rows() >0) {
			return $nilai->row('nilai');
		}else{
			return 0;
		}
	} //end check nilai
?> 