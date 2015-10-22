<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start(); //we need to call PHP's session object to access it through CI
class Alarms extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('alarm','',TRUE);
   $this->load->model('host','',TRUE);
   $this->load->model('check','',TRUE);
 }
 
 function index()
 {
   if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['firstname'] = $session_data['firstname'];
	 $data['lastname'] = $session_data['lastname'];
	 $data['email'] = $session_data['email'];
	 
	 
	// Get New Alarms
	$newalarms = $this->alarm->get_all_my_alarms_by_state($session_data['id'], 1);
	if(!$newalarms){
		$data['newalarms'] = '<td align="center" colspan="3">No alarm conditions detected.</td>';
	}
	else{
		 $data['newalarms'] = '';
		 foreach ($newalarms as $alarm){
			 $hostname = $this->host->get_hostname($alarm->HostID);
			 $checktype = $this->check->get_checktype($alarm->CheckTypeID);
			 $detected = date('M j, Y @ g:ia', $alarm->StartDateTime);
			 $data['newalarms'] .= '<tr class="unackd_alarm">';
			 $data['newalarms'] .= "<td>$hostname</td><td>$checktype</td><td>$detected</td>";
			 $data['newalarms'] .= '</tr>';
		 }
	}

	// Get Current Alarms
	$currentalarms = $this->alarm->get_all_my_alarms_by_state($session_data['id'], 2);
	if(!$currentalarms){
		$data['currentalarms'] = '<td align="center" colspan="5">No acknowledged alarms on this account.</td>';
	}
	else{
		 $data['currentalarms'] = '';
		 foreach ($currentalarms as $alarm){
			 $hostname = $this->host->get_hostname($alarm->HostID);
			 $checktype = $this->check->get_checktype($alarm->CheckTypeID);
			 $detected = date('M j, Y @ g:ia', $alarm->StartDateTime);
			 $acked = date('M j, Y @ g:ia', $alarm->AckDateTime);
			 $data['currentalarms'] .= '<tr class="ackd_alarm">';
			 $data['currentalarms'] .= "<td>$hostname</td><td>$checktype</td><td>$detected</td><td>$acked</td><td>" . gmdate("H\h i\m s\s", $alarm->AckDateTime-$alarm->StartDateTime) . '</td>';
			 $data['currentalarms'] .= '</tr>';
		 }
	}

	// Get the last 25 cleared Alarms
	$pastalarms = $this->alarm->get_all_my_alarms_by_state($session_data['id'], 3, 25);
	if(!$pastalarms){
		$data['pastalarms'] = '<td align="center" colspan="6">No cleared alarms on this account.</td>';
	}
	else{
		 $data['pastalarms'] = '';
		 foreach ($pastalarms as $alarm){
			 $hostname = $this->host->get_hostname($alarm->HostID);
			 $checktype = $this->check->get_checktype($alarm->CheckTypeID);
			 $detected = date('M j, Y @ g:ia', $alarm->StartDateTime);
			 $acked = date('M j, Y @ g:ia', $alarm->AckDateTime);
			 $ended = date('M j, Y @ g:ia', $alarm->EndDateTime);
			 $data['pastalarms'] .= '<tr class="past_alarm">';
			 $data['pastalarms'] .= "<td>$hostname</td><td>$checktype</td><td>$detected</td><td>$acked</td><td>$ended</td><td>" . gmdate("H\h i\m s\s", $alarm->AckDateTime-$alarm->StartDateTime) . '</td>';
			 $data['pastalarms'] .= '</tr>';
		 }
	}	
	 
	 $this->load->view('alarms_view', $data);
   }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 }
 
}
 
?>