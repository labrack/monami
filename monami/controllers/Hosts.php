<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start(); //we need to call PHP's session object to access it through CI
class Hosts extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('host','',TRUE);
   $this->load->helper('form');
 }
 
 function index(){
   if($this->session->userdata('logged_in')){
     $session_data = $this->session->userdata('logged_in');
	 $hosts = $this->host->get_all_hosts_for_userid($session_data['id']);
	 $myowners = $this->host->get_all_owners_for_userid($session_data['id']);
	 //die(print_r($myowners));
	 $data['ownerlist'] = '';
	 if($myowners){
		foreach($myowners as $owner){
			$ownerid = $owner->ID;
			$ownername = $owner->OwnerName;
			$owneremail = $owner->OwnerNotificationEmail;
			$data['ownerlist'] .= "<option value=\"$ownerid\">$ownername ($owneremail)</option>\n"; 
		}
	 }
	 else{
		$data['ownerlist'] = "<option value=\"0\">(No Owners Available)</option>\n";
	 }
	 
	 if(!$hosts){
		$data['host_table'] = '<tr><td colspan="8" align="center">You have no hosts configured</td></tr>';
		
		$this->load->view('hosts_view', $data);
	 }
	 else{
		 //die(print_r($hosts));
		 $data['host_table'] = '';
		 foreach ($hosts as $host){
			 $ownername = $this->host->get_owner_name($host->OwnerID);
			 $owneremail = $this->host->get_owner_email($host->OwnerID);
			 $alarmnums = explode('|', $this->host->get_num_of_alarms_for_host($host->ID));
			 $mutestate = $this->host->get_mute_state($host->ID);
			 $data['host_table'] .= '<tr>';
			 $data['host_table'] .= "<td align=\"center\">$host->ID</td>";
			 $data['host_table'] .= "<td align=\"center\">$host->HostName</td>";
			 $data['host_table'] .= "<td align=\"center\"><a href=\"mailto:$owneremail\">$ownername</a></td>";
			 $data['host_table'] .= "<td>$host->Notes</td>";
			 $data['host_table'] .= '<td align="center"><a style="color:blue;" href="/checks">' . $this->host->get_num_of_checks_for_host($host->ID) . '</a></td>';
			 $data['host_table'] .= '<td align="center"><a style="color:blue;" href="/alarms">' . $alarmnums[0] . ' new / ' . $alarmnums[1] . ' current</a></td>';
			 $data['host_table'] .= '<td align="center"><a style="color:blue;" href="/hosts/configure/' . $host->ID . '">Edit</a></td>';
			 if($mutestate == 0){
				$data['host_table'] .= '<td align="center"><a style="color:blue;" href="/hosts/togglemute/' . $host->ID . '">Supress Alarms</a></td>';
			 }
			else{
				$data['host_table'] .= '<td align="center"><a style="color:blue;" href="/hosts/togglemute/' . $host->ID . '">Remove Supression</a></td>';
			}
			 $data['host_table'] .= '</tr>';
		 }

		 
		 $this->load->view('hosts_view', $data);
	   }
   }
   else{
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 }
 
 function togglemute(){
	if($this->session->userdata('logged_in')){
		$session_data = $this->session->userdata('logged_in');
		$hostid = $this->uri->segment(3);
		$userid = $session_data['id'];
		if($this->host->check_host_ownership($hostid, $userid)){
			if($this->host->toggle_muting($hostid)){
				redirect('/hosts/');
			}
			else{
				die('Something went horribly wrong. Click "back" and then consult your dealer'); 
			}
		}
		else{
			redirect('/hosts');
		}
    }
   else{
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 }
 
 /*
 function add(){
	 if($this->session->userdata('logged_in')){
		$session_data = $this->session->userdata('logged_in');
		$hostid = $this->uri->segment(3);
		$userid = $session_data['id'];
		if($this->host->add_new_host($hostid)){
				redirect('/hosts/');
			}
		else{
				die('Something went horribly wrong. Click "back" and then consult your dealer'); 
			}
		}
    }
   else{
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 }
 */
}
 
?>