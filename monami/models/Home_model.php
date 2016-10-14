<?php
class Home_model extends CI_Model {
	function get_alarm_stats($userid){
		// Yes, this query is shitty and redundant. But it works, so suck it. TIMTOWTDI.
		$sql = "Select (SELECT count(ID) FROM tblMonitoringAlarms where AlarmStateID = 1 and OwnerID in (select ID from tblMonitoringOwners where OwnerMasterUserID = $userid)) as new,
				(SELECT count(ID) FROM tblMonitoringAlarms where AlarmStateID = 2 and OwnerID in (select ID from tblMonitoringOwners where OwnerMasterUserID = $userid)) as current,
				(SELECT count(ID) FROM tblMonitoringAlarms where AlarmStateID = 3 and OwnerID in (select ID from tblMonitoringOwners where OwnerMasterUserID = $userid)) as cleared";
		$query = $this->db->query($sql);
		if($query->num_rows() >= 1){
			$retval = '';
			foreach($query->result() as $row){
				$retval .= "$row->new,";
				$retval .= "$row->current,";
				$retval .= "$row->cleared";
			}
			return $retval;
		}
		else{
			return false;
		}
	}
	function get_number_of_hosts($userid){
		$sql = "Select count(ID) as count FROM tblMonitoringHosts where OwnerID in (select ID from tblMonitoringOwners where OwnerMasterUserID = $userid)";
		$query = $this->db->query($sql);
		if($query->num_rows() >= 1){
			$retval = '';
			foreach($query->result() as $row){
				$retval .= "$row->count";
			}
			return $retval;
		}
		else{
			return false;
		}
	}
	function get_number_of_checks($userid){
		$sql = "Select count(ID) as count FROM tblMonitoringChecks where HostID in (select ID from tblMonitoringHosts where OwnerID in (select ID from tblMonitoringOwners where OwnerMasterUserID = $userid))";
		$query = $this->db->query($sql);
		if($query->num_rows() >= 1){
			$retval = '';
			foreach($query->result() as $row){
				$retval .= "$row->count";
			}
			return $retval;
		}
		else{
			return false;
		}
	}
}
?>
