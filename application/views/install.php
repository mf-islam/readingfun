<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}
	
	span.msg{
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #DFF0D8;
		border: 1px solid #3C763D;
		color: #3C763D;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}
	
	span.msg.error{
		background-color: #F2DEDE;
		border-color: #A94442;
		color: #A94442;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1><?php echo $title; ?></h1>

	<div id="body">
		<?php if(!empty($errors)): foreach($errors as $error): ?>
		<span class="msg error"><?php echo $error; ?></span>
		<?php endforeach; endif; ?>
		
		<?php if(empty($installed)): ?>
		<code>Enter Application and Database Info:</code>
		<?php echo form_open('install'); ?>
		<table border="0" cellspacing="0" cellpadding="4">
			<tr>
				<td>Site Title:</td>
				<td><input type="text" name="config[site_title]" id="site_title" size="40" value="" /></td>
			</tr>
			<tr>
				<td>Site Slogan:</td>
				<td><input type="email" name="config[site_slogan]" id="site_slogan" size="40" value="" /></td>
			</tr>
			<tr>
				<td>First name:</td>
				<td><input type="text" name="config[first_name]" id="firs_tname" size="40" value="" /></td>
			</tr>
			<tr>
				<td>Last name:</td>
				<td><input type="text" name="config[last_name]" id="last_name" size="40" value="" /></td>
			</tr>
			<tr>
				<td>Admin Email:</td>
				<td><input type="text" name="config[admin_email]" id="admin_email" size="40" value="" /></td>
			</tr>
			<tr>
				<td>Admin Phone:</td>
				<td><input type="text" name="config[admin_phone]" id="admin_phone" size="40" value="" /></td>
			</tr>
			<tr>
				<td>Address:</td>
				<td><input type="text" name="config[address]" id="address" size="40" value="" /></td>
			</tr>
			<tr>
				<td>City:</td>
				<td><input type="text" name="config[city]" id="city" size="40" value="" /></td>
			</tr>
			<tr>
				<td>State:</td>
				<td><input type="text" name="config[state]" id="state" size="40" value="" /></td>
			</tr>
			<tr>
				<td>Zip:</td>
				<td><input type="text" name="config[zip]" id="zip" size="40" value="" /></td>
			</tr>
			<tr>
				<td>Country:</td>
				<td><input type="text" name="config[country]" id="country" size="40" value="" /></td>
			</tr>
			<tr>
				<td>Base URL:</td>
				<td><input type="text" name="base_url" id="base_url" size="40" value="<?php echo base_url(); ?>" /></td>
			</tr>
			<tr>
				<td>DB Host:</td>
				<td><input type="text" name="hostname" id="hostname" size="40" value="localhost" /></td>
			</tr>
			<tr>
				<td>DB User:</td>
				<td><input type="text" name="username" id="username" size="40" value="" /></td>
			</tr>
			<tr>
				<td>DB Password:</td>
				<td><input type="password" name="password" id="password" size="40" value="" /></td>
			</tr>
			<tr>
				<td>DB Name:</td>
				<td><input type="text" name="database" id="database" size="40" value="" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="submit" id="submit" value="Submit" /></td>
			</tr>
		</table>
		</form>
		<?php else: ?>
		<code>Installation Complete ! <a href="<?php echo base_url(); ?>">Click Here</a> to start App.</code>
		<?php endif; ?>
	</div>

	<p class="footer">CodeIgniter Version <?php echo CI_VERSION; ?></p>
</div>

</body>
</html>