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
	
	function get_all_checktypes(){
		$sql = "SELECT * FROM tblMonitoringCheckTypes order by CheckType ASC";
		$query = $this->db->query($sql);
		if($query->num_rows() >= 1){
			return $query->result();
		}
		else{
			return false;
		}
	}
	
	function get_all_checks_for_userid($userid){
		$sql = "SELECT * FROM tblMonitoringChecks where HostID in (SELECT ID FROM tblMonitoringHosts where OwnerID in (select ID from tblMonitoringOwners where OwnerMasterUserID = ?))";
		$query = $this->db->query($sql, array($userid));
		if($query->num_rows() >= 1){
			return $query->result();
		}
		else{
			return false;
		}
	}

	function get_check_type($checktypeid){
		$sql = "SELECT CheckType from tblMonitoringCheckTypes where ID = ?";
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
	
	function get_hostid_from_checkid($checkid){
		$sql = "SELECT HostID from tblMonitoringChecks where ID = ?";
		$query = $this->db->query($sql, array($checkid));
		if($query->num_rows() == 1){
			foreach($query->result() as $row){
				return $row->HostID;
			}
		}
		else{
			return false;
		}
	}
	
	function verify_check_ownership_by_hostid($hostid, $userid){
		$sql = "SELECT * FROM tblMonitoringHosts where ID = $hostid and OwnerID in (select ID from tblMonitoringOwners where OwnerMasterUserID = $userid)";
		$query = $this->db->query($sql);
		if($query->num_rows() == 1){
			return true;
		}
		else{
			return false;
		}
	}
	
	function toggle_pausing($checkid){
		$sql = "SELECT PauseCheck FROM tblMonitoringChecks where ID = $checkid";
		$query = $this->db->query($sql);
		if($query->num_rows() == 1){
			foreach($query->result() as $row){
				$mutestate = $row->PauseCheck;
				if($mutestate == 0){
					$sql = "UPDATE tblMonitoringChecks set PauseCheck = 1 where ID = $checkid";
					$query = $this->db->query($sql);
					if($this->db->affected_rows() == 1){
						return TRUE;
					}
				}			
				else{
					$sql = "UPDATE tblMonitoringChecks set PauseCheck = 0 where ID = $checkid";
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
	
	function get_pause_state($checkid){		
		$sql = "SELECT PauseCheck FROM tblMonitoringChecks where ID = ?";
		$query = $this->db->query($sql, array($checkid));
		if($query->num_rows() == 1){
			foreach($query->result() as $row){
				return $row->PauseCheck;
			}
		}
		else{
			return false;
		}
	}
}
?>