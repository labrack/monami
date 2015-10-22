<?php
Class User extends CI_Model
{
 function login($username, $password)
 {
   $this -> db -> select('ID, UserFirstName, UserLastName, UserUsername, UserPasswordHash, UserEmailAddress');
   $this -> db -> from('tblMonitoringUsers');
   $this -> db -> where('UserUsername', $username);
   $this -> db -> where('UserPasswordHash', MD5($password));
   $this -> db -> limit(1);
 
   $query = $this -> db -> get();
 
   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }
}
?>