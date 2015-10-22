<?php
class Check extends CI_Model {
	function get_checktype($checktypeid){
		$sql = "SELECT * FROM tblMonitoringCheckTypes where ID = ?";
		$query = $this->db->query($sql, array($checktypeid));
		if($query->num_rows() == 1){
			foreach($query->result() as $row){
				return $row->CheckType;
			}
		}
		else{
			return false;
		}
	}
}
?>