<!doctype html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Login</title>
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/styles.css">
	
</head>
<body style="background-color:skyblue">
	<div id="container">
	&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  <font size ="2">New User</font> <font size="2" color="blue"><a href="welcome.php">Register</a></font>
		<form #action="store.php" method = "post">
		<label>Username:</label>
		<input type="name" name="username" />
		<label>Password:</label>
		<p>
		<a href="forget.php">Forgot your password?</a>
		<input type="password" name="password" />
		<div id="lower">
		<input type="checkbox">
		<label class="check" for="checkbox">Keep me logged in</label>
		<input type="submit" value="Login">
<?php
	$new = 0;
	$con = mysql_connect("localhost","root","");
	if(!$con)
	{
		die("Connection Failed");
	}
	if(!(mysql_select_db("medical_inventory", $con)))
	{
		die ("Database Not Selected");
	}
	if (isset($_POST['username']) && isset($_POST['password']))
		$query = "SELECT * FROM login ";
	if (isset ($query))
		$sql = mysql_query($query,$con);
	if (isset ($sql))
	{
		while($row = mysql_fetch_array($sql))
		{
			if(($row['username'] == $_POST['username']) && ($row['password'] == $_POST['password']))
				$new = 1;
		}
		if(!$new)
			echo "<br />&nbsp;&nbsp;&nbsp;&nbsp;<font size='1' color='red'>Wrong Username or Password</font>";
	}
	if($new)
		header ("Location:option.php");
?>	
</div>
</form>
</div>
</body>
</html>
	
	
	
	
	
		
	