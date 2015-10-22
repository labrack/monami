<?php
Class Alarm extends CI_Model {
	function get_all_my_alarms_by_state($userid,$stateid,$limit=1000){
		$sql = "SELECT * FROM tblMonitoringAlarms where AlarmStateID = ? and OwnerID in (select ID from tblMonitoringOwners where OwnerMasterUserID = ?) order by ID limit ?";
		$query = $this->db->query($sql, array($stateid, $userid, $limit));
		if($query->num_rows() >= 1){
			return $query->result();
		}
		else{
			return false;
		}
	}
	function acknowledge_alarm($alarmid){
		$sql = "SELECT * FROM tblMonitoringAlarms where StateID = ? and OwnerID in (select ID from tblMonitoringOwners where OwnerMasterUserID = ?)";
		$query = $this->db->query($sql, array($stateid, $userid));
		if($query->num_rows() >= 1){
			return $query->result();
		}
		else{
			return false;
		}
	}
}
?>