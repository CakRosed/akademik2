<?php 
 /** Description of Global_model
 *	
 * @author AUNUR ROSIDIN 
 */ 

class Model_global extends CI_Model{
	
	public function get_all_data($select, $table){
		$this->db->select($select);
		$this->db->from($table);
		$query = $this->db->get();
		return $query;
	} //end class get_all_data

	public function get_data($select, $table, $where){
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);
		$query = $this->db->get();
		return $query;
		//$query = 'SELECT'.$select.'FROM'.$table.'WHERE'.$where;
		//return $this->db->query($query);
	}

	public function save_data($data, $table){
		$return = FALSE;
		if ($this->db->insert($table, $data)) {
			$return = TRUE;
		}
		return $return;
	}

	public function update_data($id, $field, $data, $table){
		$return = FALSE;
		$this->db->where($field, $id);
		if ($this->db->update($table, $data)) {
			$return = TRUE;
		}
		return $return;
	}

	public function delete_data($id, $field, $table){
		$return = FALSE;
		$this->db->where($field, $id);
		if ($this->db->delete($table)) {
			$return = TRUE;
		}
		return $return;
	}

} //end class model

?>