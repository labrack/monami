<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start(); //we need to call PHP's session object to access it through CI
class Checks extends CI_Controller {
 
	function __construct()
	{
		parent::__construct();
		$this->load->model('host','',TRUE);
		$this->load->model('check','',TRUE);
	}
 
	function index()
	{
		if($this->session->userdata('logged_in'))
		{
			// Load some stuff
			$session_data = $this->session->userdata('logged_in');
			$data['firstname'] = $session_data['firstname'];
			$data['lastname'] = $session_data['lastname'];
			$data['email'] = $session_data['email'];
	 
			// Set up model calls for program logic below
			$checktypes = $this->check->get_all_checktypes();
			$myhosts = $this->host->get_all_hosts_for_userid($session_data['id']);
			$mychecks = $this->check->get_all_checks_for_userid($session_data['id']);
				
			// Set up the configured checks table for the view
			if(!$mychecks){
				$data['check_table'] = '<tr><td colspan="6" align="center">You have no checks configured</td></tr>';

				$this->load->view('checks_view', $data);
			}
			else{
				$data['check_table'] = '';
				foreach ($mychecks as $check){
					$pausestate = $this->check->get_pause_state($check->ID);
					$hostname = $this->host->get_hostname($check->HostID);
					$checktype = $this->check->get_check_type($check->CheckTypeID);
					$data['check_table'] .= '<tr>';
					$data['check_table'] .= "<td align=\"center\">$check->ID</td>";
					$data['check_table'] .= "<td align=\"center\">$hostname</td>";
					$data['check_table'] .= "<td align=\"center\">$checktype</td>";
					$data['check_table'] .= "<td>$check->CheckNote</td>";
					if($pausestate == 0){
						$data['check_table'] .= '<td align="center"><a style="color:blue;" href="/checks/togglepause/' . $check->ID . '">Pause Check</a></td>';
					}
					else{
						$data['check_table'] .= '<td align="center"><a style="color:blue;" href="/checks/togglepause/' . $check->ID . '">Resume Check</a></td>';
					}
					$data['check_table'] .= '<td align="center"><a style="color:blue;" href="/checks/remove/' . $check->ID . '">Remove</a></td>';
					$data['check_table'] .= '</tr>';
				}	 
			}
	 
			// Create and populate the Host dropdown content for the "Add a new check" form
			if($myhosts){
				$data['hostlist'] = '';
				foreach($myhosts as $host){
					$hostid = $host->ID;
					$hostname = $host->HostName;
					$hostnotes = $host->Notes;
					$data['hostlist'] .= "<option value=\"$hostid\">$hostname ($hostnotes)</option>\n"; 
				}
			}
			else{
				$data['hostlist'] = "<option value=\"0\">(No Hosts Available)</option>\n";
			}
	 
			// Create and populate the Check type dropdown content for the "Add a new check" form
			if($checktypes){
				$data['checktypelist'] = '';
				foreach($checktypes as $type){
					$checktypeid = $type->ID;
					$checktypename = $type->CheckType;
					$data['checktypelist'] .= "<option value=\"$checktypeid\">$checktypename</option>\n"; 
				}
			}
			else{
				$data['checktypelist'] = "<option value=\"0\">ERROR - NO TYPES AVAILABLE</option>\n";
			}
	 
			// Finally, load the page view.
			$this->load->view('checks_view', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	
	function togglepause(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$checkid = $this->uri->segment(3);
			$hostid = $this->check->get_hostid_from_checkid($checkid);
			$userid = $session_data['id'];
			if($this->check->verify_check_ownership_by_hostid($hostid, $userid)){
				if($this->check->toggle_pausing($checkid)){
					redirect('/checks');
				}
				else{
					die('Something went horribly wrong. Click "back" and then consult your dealer'); 
				}
			}
			else{
				redirect('/checks');
			}
		}
		else{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
 
}
 
?>