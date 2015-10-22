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
     $session_data = $this->session->userdata('logged_in');
     $data['firstname'] = $session_data['firstname'];
	 $data['lastname'] = $session_data['lastname'];
	 $data['email'] = $session_data['email'];
	 
	 
	 $this->load->view('checks_view', $data);
   }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 }
 
}
 
?>