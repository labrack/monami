<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
   <title>Login to mon ami</title>
   <link rel="stylesheet" href="/css/style.css">
 </head>
 <body>
	<div class="login-card">
		<img src="/img/monamilogo-small.png" alt="mon ami Logo" /><br /><br />
		<?php echo validation_errors(); ?>
		<?php echo form_open('verifylogin'); ?>
			<input type="text" size="20" id="username" name="username" placeholder="Username"/>
			<br/>
			<input type="password" size="20" id="password" name="password" placeholder="Password"/>
			<br/>
			<input type="submit" class="login login-submit" value="Login"/>
		</form>
   </div>
 </body>
</html>