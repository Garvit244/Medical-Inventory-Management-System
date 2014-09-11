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
					<th><span>Company ID</span></th>
					<td><span><input type="text" name="id"></span></td>
				</tr>
			</tbody></table>
<table class="inventory">
				<thead>
					<tr>
						<th colspan="5"><span>Company Details</span></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><span> Name:</span></td>
						<td COLSPAN="4"><input type="text" name="name"></td>
					</tr><tr>
						<td><span>Location:</span></td>
						<td COLSPAN="4"><input type="text" name="location"></td>
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
	if(($_POST['name'])!= NULL)
	{
		$name = $_POST['name'];
		$query = "UPDATE company SET Name = '$name' WHERE ID = $id";
	}
	if (isset ($query))
	{
		$sql = mysql_query($query,$con);
	}
	if(($_POST['location'])!= NULL)
	{
		$location = $_POST['location'];
		$query = "UPDATE company SET  Location = '$location' WHERE ID = $id";
	}
	if (isset ($query))
	{
		$sql = mysql_query($query,$con);
	}
	/*
	if(($_POST['sex'])!= NULL)
	{
		$sex = $_POST['sex'];
		$query = "UPDATE vendors SET Sex = '$sex' WHERE ID = $id";
	}
	if (isset ($query))
	{
		$sql = mysql_query($query,$con);
	}
	if(($_POST['medname'])!= NULL)
	{
		$medname = $_POST['medname'];
		$query = "UPDATE vendors SET Medname = '$medname' WHERE ID = $id";
	}	
	if (isset ($query))
	{
		$sql = mysql_query($query,$con);
	}
	if(($_POST['medbatchno'])!= NULL)
	{
		$medbatchno = $_POST['medbatchno'];
		$query = "UPDATE vendors SET MedBatchno = '$medbatchno' WHERE ID = $id";
	}	
	if (isset ($query))
	{
		$sql = mysql_query($query,$con);
	}
	}*/
	if($new)
	{
		if(isset($_POST['id']))
		{
			$query = "SELECT ID,Name,Location FROM company WHERE ID=".$_POST['id'].";";
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
						<th COLSPAN=5><span>Modified Company Details</span></th></tr>
				</thead>
				<tbody>");
				$new = $row['ID'];
				echo("<tr>
						<td><span>Company ID:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
					
				$new = $row['Name'];
				echo("<tr>
						<td><span>Name:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				$new = $row['Location'];
				echo("<tr>
						<td><span>Location:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				/*$new = $row['Sex'];
				if($new == "M")
					$new1 = "Male";
				else
					$new1 = "Female";
				echo("<tr>
						<td><span>Gender:</span></td>
						<td COLSPAN=4>$new1 </td>
					</tr>");
				$new = $row['Medname'];
				echo("<tr>
						<td><span>Medicine Name:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
					$new = $row['MedBatchno'];
				echo("<tr>
						<td><span>Medicine Batch no:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
					$new = $row['Date'];
				echo("<tr>
						<td><span>Date:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>"); */
		}	
		}
	}
	}
?>
</tbody>
</table>
</body>
</html>