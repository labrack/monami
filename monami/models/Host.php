<?php
Class Host extends CI_Model {
	
	function get_all_hosts_for_userid($userid){
		$sql = "SELECT * FROM tblMonitoringHosts where OwnerID in (select ID from tblMonitoringOwners where OwnerMasterUserID = ?)";
		$query = $this->db->query($sql, array($userid));
		if($query->num_rows() >= 1){
			return $query->result();
		}
		else{
			return false;
		}
	}
	
	function get_owner_name($ownerid){
		$sql = "SELECT OwnerName FROM tblMonitoringOwners where ID = ?";
		$query = $this->db->query($sql, array($ownerid));
		if($query->num_rows() == 1){
			foreach($query->result() as $row){
				return $row->OwnerName;
			}
		}
		else{
			return false;
		}
	}
	
	function get_owner_email($ownerid){
		$sql = "SELECT OwnerNotificationEmail FROM tblMonitoringOwners where ID = ?";
		$query = $this->db->query($sql, array($ownerid));
		if($query->num_rows() == 1){
			foreach($query->result() as $row){
				return $row->OwnerNotificationEmail;
			}
		}
		else{
			return false;
		}
	}
	
	function get_hostname($hostid){
		$sql = "SELECT HostName FROM tblMonitoringHosts where ID = ?";
		$query = $this->db->query($sql, array($hostid));
		if($query->num_rows() == 1){
			foreach($query->result() as $row){
				return $row->HostName;
			}
		}
		else{
			return false;
		}
	}
	
	function get_num_of_checks_for_host($hostid){
		$sql = "SELECT count(id) as count FROM tblMonitoringChecks where HostID = ?";
		$query = $this->db->query($sql, array($hostid));
		if($query->num_rows() == 1){
			foreach($query->result() as $row){
				return $row->count;
			}
		}
		else{
			return false;
		}
	}
	
	function get_num_of_alarms_for_host($hostid){
		$sql = "SELECT (select count(id) FROM tblMonitoringAlarms where HostID = $hostid and AlarmStateID = 1) as newcount, (select count(id) FROM tblMonitoringAlarms where HostID = $hostid and AlarmStateID = 2) as currentcount";
		$query = $this->db->query($sql);
		if($query->num_rows() == 1){
			foreach($query->result() as $row){
				return "$row->newcount|$row->currentcount";
			}
		}
		else{
			return false;
		}
	}
	
	function get_mute_state($hostid){
		$sql = "SELECT MuteAlarms FROM tblMonitoringHosts where ID = ?";
		$query = $this->db->query($sql, array($hostid));
		if($query->num_rows() == 1){
			foreach($query->result() as $row){
				return $row->MuteAlarms;
			}
		}
		else{
			return false;
		}
	}
	function check_host_ownership($hostid, $ownerid)	{
		$sql = "SELECT * FROM tblMonitoringHosts where ID = $hostid and OwnerID in (select ID from tblMonitoringOwners where OwnerMasterUserID = $ownerid)";
		$query = $this->db->query($sql);
		if($query->num_rows() == 1){
			return true;
		}
		else{
			return false;
		}
	}
	
	function toggle_muting($hostid){
		$sql = "SELECT MuteAlarms FROM tblMonitoringHosts where ID = $hostid";
		$query = $this->db->query($sql);
		if($query->num_rows() == 1){
			foreach($query->result() as $row){
				$mutestate = $row->MuteAlarms;
				if($mutestate == 0){
					$sql = "UPDATE tblMonitoringHosts set MuteAlarms = 1 where ID = $hostid";
					$query = $this->db->query($sql);
					if($this->db->affected_rows() == 1){
						return TRUE;
					}
				}			
				else{
					$sql = "UPDATE tblMonitoringHosts set MuteAlarms = 0 where ID = $hostid";
					$query = $this->db->query($sql);
					if($this->db->affected_rows() == 1){
						return TRUE;
					}					
				}
			}
		}
		else{
			return false;
		}
	}
	function get_all_owners_for_userid($userid){
		$sql = "SELECT * FROM tblMonitoringOwners where OwnerMasterUserID = ?";
		$query = $this->db->query($sql, array($userid));
		if($query->num_rows() >= 1){
			return $query->result();
		}
		else{
			return false;
		}
	}
		
	function create_new_host($hostid, $ownerid)	{
		$sql = "SELECT * FROM tblMonitoringHosts where ID = $hostid and OwnerID in (select ID from tblMonitoringOwners where OwnerMasterUserID = $ownerid)";
		$query = $this->db->query($sql);
		if($query->num_rows() == 1){
			return true;
		}
		else{
			return false;
		}
	}
}
?>