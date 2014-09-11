<!DOCTYPE html>
<head>

<meta http-equiv="content-type" content="text/html; charset=UTF-8"><style>article,aside,details,figcaption,figure,footer,header,hgroup,nav,section{display:block}audio[controls],canvas,video{display:inline-block}[hidden],audio{display:none}mark{background:#FF0;color:#000}</style>
<style type="text/css" media="print">
        @page 
        {
            size: auto;   /* auto is the initial value */
            margin: 0mm;  /* this affects the margin in the printer settings */
        }
</style>

<script type="text/javascript" src="http://static.tumblr.com/p2evvtm/Wycm17d1m/tumblr_search_box.js"></script>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title> Select Option </title>
<link rel="stylesheet" href="css/ret.css">
</head>
<body>
<header>
<h1>Modify Details</h1>
</header>
<form method="POST" #action="http://www.google.com/search">
<table class="meta">
				<tbody><tr>
					<th><span>ManagerID</span></th>
					<td><span><input type="text" name="id"></span></td>
				</tr>
			</tbody></table>
<table class="inventory">
				<thead>
					<tr>
						<th colspan="5"><span>Manager Details</span></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><span>First Name:</span></td>
						<td COLSPAN="4"><input type="text" name="fname"></td>
					</tr><tr>
						<td><span>Middle Name:</span></td>
						<td COLSPAN="4"><input type="text" name="mname"></td>
					</tr><tr>
						<td><span>Last Name:</span></td>
						<td COLSPAN="4"><input type="text" name="lname"></td>
					</tr><tr>
						<td><span>Sex:</span></td>
						<td COLSPAN="4"><input type="text" name="sex"></td>
					</tr><tr>
						<td><span>Date of Birth:</span></td>
						<td COLSPAN="4"><input type="text" name="dob"></td>
					</tr><tr>
						<td><span>Store ID:</span></td>
						<td COLSPAN="4"><input type="text" name="ssid"></td>
					</tr>
				</tbody>
</table>
<center><input type="submit" value="Submit"></center>
</form>

<?php
	$new = "1";
	$con = mysql_connect("localhost","root","");
	if(!$con)
	{
		die("Connection Failed");
	}
	if(!(mysql_select_db("medical_inventory", $con)))
	{
		die ("Database Not Selected");
	}
	if(isset($_POST['id']))
	{
		$id = $_POST['id'];
	if(($_POST['fname'])!= NULL)
	{
		$fname = $_POST['fname'];
		$query = "UPDATE managed SET Fname = '$fname' WHERE MID = $id";
	}
	if (isset ($query))
	{
		$sql = mysql_query($query,$con);
	}
	if(($_POST['mname'])!= NULL)
	{
		$mname = $_POST['mname'];
		$query = "UPDATE managed SET Mname = '$mname' WHERE MID = $id";
	}
	if (isset ($query))
	{
		$sql = mysql_query($query,$con);
	}
	if(($_POST['lname'])!= NULL)
	{
		$lname = $_POST['lname'];
		$query = "UPDATE managed SET Lname = '$lname' WHERE MID = $id";
	}
	if (isset ($query))
	{
		$sql = mysql_query($query,$con);
	}
	if(($_POST['sex'])!= NULL)
	{
		$sex = $_POST['sex'];
		$query = "UPDATE managed SET Sex = '$sex' WHERE MID = $id";
	}
	if (isset ($query))
	{
		$sql = mysql_query($query,$con);
	}
	if(($_POST['dob'])!= NULL)
	{
		$dob = $_POST['dob'];
		$query = "UPDATE managed SET DOB = '$dob' WHERE MID = $id";
	}	
	if (isset ($query))
	{
		$sql = mysql_query($query,$con);
	}
	if(($_POST['ssid'])!= NULL)
	{
		$ssid = $_POST['ssid'];
		$query = "UPDATE managed SET SSID = '$ssid' WHERE MID = $id";
	}	
	if (isset ($query))
	{
		$sql = mysql_query($query,$con);
	}
	}
	if($new)
	{
		if(isset($_POST['id']))
		{
			$query = "SELECT MID,Fname,Mname,Lname,DOB,Sex,SSID FROM managed WHERE MID=".$_POST['id'].";";
		}
		if (isset ($query))
		{
			$sql = mysql_query($query,$con);
		}
		if (isset($sql))
	{
		while($row = mysql_fetch_array($sql))
		{
			echo ("<br /><br /><br /><br /><aside><h1>Details Updated Sucessfully</h1></aside>");
				echo("<table class=inventory>
				<thead><tr>
						<th COLSPAN=5><span>Modified Manager Details</span></th></tr>
				</thead>
				<tbody>");
				$new = $row['MID'];
				echo("<tr>
						<td><span>Manager ID:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
					
				$new = $row['Fname'];
				echo("<tr>
						<td><span>Fname:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				$new = $row['Mname'];
				echo("<tr>
						<td><span>Mname:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				$new = $row['Lname'];
				echo("<tr>
						<td><span>Lname:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				$new = $row['DOB'];
				echo("<tr>
						<td><span>DOB:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				$new = $row['Sex'];
				if($new == "M")
					$new1 = "Male";
				else
					$new1 = "Female";
				echo("<tr>
						<td><span>Gender:</span></td>
						<td COLSPAN=4>$new1 </td>
					</tr>");
				$new = $row['SSID'];
				echo("<tr>
						<td><span>Store ID:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
		}	
		}
	}
?>
</tbody>
</table>
</body>
</html>