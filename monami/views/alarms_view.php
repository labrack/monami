<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
   <title>My Alarms - mon ami - Your Monitoring Friend</title>
   <link rel="stylesheet" href="/css/style.css">
 </head>
 <body>

   <h1>Alarm Dashboard</h1>
   <-- Go back <a href="home">Home</a>
   <h2>New Alarms</h2>
   These alarms are new, and have not been acknowledged by the host's owner.*<br /><br />
   <table cellpadding="5" border="1">
	<tr><th>Hostname/IP</th><th>Alarm Type</th><th>Date/Time<br />Detected</th></tr>
	<?=$newalarms?>
   </table><br />
   <span class="subtext">* Note: For record-keeping purposes, all new alarms must be acknowledged via the unique token URL emailed to the host's owner's email address.<br />
   If you need to change the owner of a host in alarm, please visit the <a href="/hosts">Hosts Dashboard</a>. New emails are sent every 5 minutes while an alarm is unacknowledged.</span><br /><br />
   <hr align="left" width="50%" />
   <h2>Current Alarms</h2>These alarms are ongoing. They have been acknowledged by the host's owner, but the alarm condition has not yet cleared.<br /><br />
   <table cellpadding="5" border="1">
	<tr><th>Hostname/IP</th><th>Alarm Type</th><th>Date/Time<br />First Detected</th><th>Date/Time<br />Acknowledged</th><th>Time to Ack</th></tr>
	<?=$currentalarms?>
   </table><br />
   <hr align="left" width="50%" />
   <h2>Past Alarms</h2>
   These are the latest 25 cleared alarms from hosts associated with your account.<br />
   Only the latest 25 cleared alarms are shown. All alarms are saved in our database and can be exported by opening a support ticket.<br /><br />
   <table cellpadding="5" border="1">
	<tr><th>Hostname/IP</th><th>Alarm Type</th><th>Date/Time<br />Detected</th><th>Date/Time<br />Acknowledged</th><th>Date/Time<br />Cleared</th><th>Total<br />Duration</th></tr>
	<?=$pastalarms?>
   </table>
 </body>
</html>
