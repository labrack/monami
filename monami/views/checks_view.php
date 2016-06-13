<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
   <title>My Checks - mon ami - Your Monitoring Friend</title>
   <link rel="stylesheet" href="/css/style.css">
 </head>
 <body>

   <h1>Checks Dashboard</h1>
   <-- Go back <a href="home">Home</a>
   <h2>Current Checks</h2>
   These are all the checks we are performing on your servers.<br /><br />
   <table cellpadding="5" border="1">
	<tr><th>Check ID</th><th>Hostname/IP</th><th>Check Type</th><th>Notes</th><th>Pause Check?</th><th>Remove Check?</th></tr>
	<?=$check_table?>
   </table><br />
   <hr align="left" width="50%" />
   <h2>Configure a New Check</h2>
   Use this form to add a new check to the system. Please note that you must have already configured a the host on the <a href="/hosts">hosts dashboard</a> before using this form.<br /><br />
	<form method="POST" action="/checks/add">
	<table>
	<tr><td>Hostname or IP Address:</td><td><select name="hostid"><?=$hostlist?></select></td></tr>
	<tr><td>Type of Check:</td><td><select name="checktypeid"><?=$checktypelist?></select></td></tr>
	<tr><td><input type="submit" name="submit" value="Add Check" /></td></tr>
	</table>
	</form><br /><br />
   Go back <a href="home">Home</a>
 </body>
</html>