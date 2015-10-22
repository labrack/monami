<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
   <title>My Hosts - mon ami - Your Monitoring Friend</title>
   <link rel="stylesheet" href="/css/style.css">
 </head>
 <body>
   <h1>Your Configured Hosts</h1>
   <table border="1" cellpadding="5">
	<tr>
		<th>Host<br />ID Number</th>
		<th>Hostname</th>
		<th>Responsible<br />Party</th>
		<th>Notes</th>
		<th>Number of<br/>Checks</th>
		<th>Number of New<br/>or Current Alarms</th>
		<th>Configure Host</th>
		<th>Alarm<br />Supression</th>
	</tr>
	<?=$host_table?>
	</table>
	<h2>Add a New Host</h2>
	<form method="POST" action="/hosts/add">
	<table>
	<tr><td>Hostname or IP Address:</td><td><input type="text" name="hostname"/></td></tr>
	<tr><td>Responsible Party:</td><td><select name="owner"><?=$ownerlist?></select></td></tr>
	<tr><td><input type="submit" name="submit" value="Add Host" /></td></tr>
	</table>
	</form><br /><br />
   Go back <a href="home">Home</a>
 </body>
</html>