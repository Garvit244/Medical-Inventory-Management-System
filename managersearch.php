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
<h1>Search Details</h1>
</header>
<br />
<h2>Search Manager Details on basis of:</h2>
<br />
<center>
<form method="POST" #action="http://www.google.com/search">
<table>
<tr>
<td><input type="radio" name="manid" > Manager ID </td>
<td><input type="radio" name="manname" > Manager Name </td>
</table>
<br />
<div style="border:2px dotted blue;padding:4px;width:15em;">
<table border="0" align="center" cellpadding="0">
<tr><td>
<input type="text"  name="MID" size="25" style="color:#808080;" maxlength="255" placeholder="Search by ID or Name"/>
<input type="submit" value="Go!" />
</td></tr>
</table>
</div>
</form>
</center>
<br />
<br /><br />
<br /><br/>
<article>
<?php
$x = 0;
	$con = mysql_connect("localhost","root","");
	if(!$con)
	{
		die("Connection Failed");
	}
	if(!(mysql_select_db("medical_inventory", $con)))
	{
		die ("Database Not Selected");
	}
	if (isset($_POST['manid']) && isset($_POST['manname']))
	{
		echo "<script>alert('Select one field only!');</script>";
	}	
	else if(isset($_POST['MID']) && isset($_POST['manid']))
	{
		if ( preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['MID']))
		{
			echo "<script>alert('Enter valid Manager ID!');</script>";
		}
		else
		{
		$query = "SELECT MID,Fname,Mname,Lname,DOB,Sex,SSID,store.Name,store.Streetname,store.No_of_Employee FROM managed JOIN store ON SSID = SID WHERE MID=".$_POST['MID'].";";
		}
	}
	else if(isset($_POST['MID']) && isset($_POST['manname']))
	{
		if ( preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['MID']))
		{
			echo "<script>alert('Enter valid Manager Name!');</script>";
		}
		else
		{
		$query = "SELECT MID,Fname,Mname,Lname,DOB,Sex,SSID,store.Name,store.Streetname,store.No_of_Employee FROM managed JOIN store ON SSID = SID WHERE Fname LIKE '%".$_POST['MID']."%' OR Mname LIKE '%".$_POST['MID']."%' OR Lname LIKE '%".$_POST['MID']."%'";
		}
	}
	
	if (isset ($query))
	{
		//echo "1";
		$sql = mysql_query($query,$con);
	}
	if (isset($sql))
	{
		
		while($row = mysql_fetch_array($sql))
		{
		$x = 1;
		echo("<address>
				<p>".$row['Fname']." ".$row['Mname']." ".$row['Lname']."</p>
			</address>");
		echo("<table class=meta>
				<tbody><tr>
					<th><span>Manager ID</span></th>
					<td><span>".$row['MID']."</span></td>
				</tr>
				<tr>
					<th><span>Name</span></th>
					<td><span>".$row['Fname']." ".$row['Mname']." ".$row['Lname']."</span></td>
				</tr>
			</tbody></table>");
				echo("<table class=inventory>
				<thead><tr>
						<th COLSPAN=5><span>Manager Details</span></th></tr>
				</thead>
				<tbody>");
				$new = $row['MID'];
				echo("<tr>
						<td><span>Manager ID:</span></td>
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
				$new = $row['Name'];
				echo("<tr>
						<td><span>Store Name:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				$new = $row['Streetname'];
				echo("<tr>
						<td><span>Street Name:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				$new = $row['No_of_Employee'];
				echo("<tr>
						<td><span>No_of_Employee:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
		}
		$sql = mysql_query($query,$con);
		$row = mysql_fetch_array($sql);
		if(empty($row))
		{
			if(isset($_POST['manid']))
			echo"<script>alert('Enter valid Manager ID !');</script>";
			else if(isset($_POST['manname']))
			echo"<script>alert('Enter valid Manager Name !');</script>";
		}
	}
?>
	</tbody>
	</table>
	</article>
</body>
</html>