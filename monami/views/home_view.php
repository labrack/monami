<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
   <title>Dashboard - mon ami - Your Monitoring Friend</title>
   <link rel="stylesheet" href="/css/style.css" />
   <link rel="stylesheet" href="/css/csshake.min.css" />
 </head>
 <body>
	<div align="center">
	   <img src="/img/monamilogo-small.png" alt="monami logo" /><br />
	   <h1>Welcome to your Dashboard, <?php echo $firstname; ?>!</h1>
	   <hr width="50%" />
	   <h2>Here's your summary...</h2>
	   <table class="home-menu" >
			<tr>
				<td align="center"><div class="<?=$alarm_shake?>"><a href="/alarms"><img src="/img/icons/alarm.png" alt="alarms" /></a></div></td>
				<td align="center"><a href="/hosts"><img src="/img/icons/host.png" alt="hosts" /></a></td>
				<td align="center"><a href="/checks"><img src="/img/icons/check.png" alt="checks" /></a></td>
			</tr>
			<tr>
				<td><?=$alarm_stats?> Alarms</td>
				<td><?=$host_count?> <?php if ($host_count == 1){ echo "Host"; } else { echo "Hosts"; } ?> Configured</td>
				<td><?=$check_count?> <?php if ($check_count == 1){ echo "Check"; } else { echo "Checks"; } ?> Configured</td>
			</tr>
			<tr>
				<td align="center"><a href="/profile"><img src="/img/icons/profile.png" alt="profile" /></a></td>
				<td align="center"><!--<a href="/hosts"><img src="/img/icons/host.png" alt="hosts" /></a>--></td>
				<td align="center"><a href="/home/logout"><img src="/img/icons/logout.png" alt="logout" /></a></td>
			</tr>
			<tr>
				<td>Edit Your Profile</td>
				<td></td>
				<td>Log Out of mon ami</td>
			</tr>
		</table>
		<hr width="50%" />
	   <br /><font style="font-size: 12px;"><b>mon ami</b> is a Service of<br /><a href="http://www.sussexlabs.net">Sussex Network Laboratories</a></font>
   </div>
 </body>
</html>
