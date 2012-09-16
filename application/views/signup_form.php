<html>
<head>
	<title>Welcome to Ego</title>
    <link rel="stylesheet" href="http://egodecal.com/css/style_main.css" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Antic+Slab' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
</head> 
<body>
<div id="strip">
<div id="strip_content">
<img id="strip_head" src="http://www.egodecal.com/icons/ego.png" /><p id="strip_head">Ego</p>
</div>
<div id="strip_overlay"></div>
</div>
<div id="container">
<div id="signup_form">

<h1>Create an Account</h1>
<fieldset>
<legend>Personal Information</legend>
<?php 
	echo form_open('login/create_member');
	echo form_input('first_name', set_value('first_name', 'First Name'));
	echo form_input('last_name', set_value('last_name', 'Last Name'));
	echo form_input('email_address', set_value('email_address', 'Email address'));
	echo form_input('ccn', set_value('ccn', 'CCN'));
?>
</fieldset>
<fieldset>
<legend>Login Information</legend>
<?php
	echo form_input('username', set_value('username', 'Username'));
	echo form_password('password', set_value('password', 'Password'));
	echo form_password('password_confirm', set_value('password_confirm', 'Password'));
	
	echo form_submit('submit', 'Create Account');
?>

<?php echo validation_errors('<p class="error">'); ?>
</fieldset>

</div>
</div>
</body>
</html>