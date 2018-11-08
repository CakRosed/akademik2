<?php 
	function cmb_dinamis($name, $table, $field, $pk, $selected=null){
		// karena tidak bisa menggunakan this 
		$ci =& get_instance();

		$cmb = "<select name='$name' id='' class='form-control'>";
		$data = $ci->db->get($table)->result();
		foreach($data as $row){
			$cmb .= "<option value='".$row->$pk."'";
			$cmb .= $selected == $row->$pk?'selected':''; //shorthend untuk if else
			$cmb .= ">".$row->$field."</option>";
		}
		$cmb .= "</select>";
		return $cmb;
	}
 ?>