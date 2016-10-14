<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('home_model','',TRUE);
 }
 
 function index()
 {
   if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['firstname'] = $session_data['firstname'];
	 $data['lastname'] = $session_data['lastname'];
	 $data['email'] = $session_data['email'];
	 
	 // Get Alarm Stats
	 $astats = explode(',', $this->home_model->get_alarm_stats($session_data['id']));
	 $data['alarm_stats'] = $astats[0] . ' new, ' . $astats[1] . ' current, and ' . $astats[2] . ' past ';
	 if($astats[0] >= 1 || $astats [1] >= 1){
		$data['alarm_shake'] = "shake shake-rotate shake-constant";
	 }
	 else{
		$data['alarm_shake'] = '';
	 }
	 // Get number of hosts
	 $data['host_count'] = $this->home_model->get_number_of_hosts($session_data['id']);
	 // Get number of checks
	 $data['check_count'] = $this->home_model->get_number_of_checks($session_data['id']);
	   
	 // Load the page
	 $this->load->view('home_view', $data);
   }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 }
 
 function logout()
 {
   $this->session->unset_userdata('logged_in');
   session_destroy();
   redirect('home', 'refresh');
 }
 
}
 
?>
