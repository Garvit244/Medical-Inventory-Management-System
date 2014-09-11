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
					<th><span>Store ID</span></th>
					<td><span><input type="text" name="sid"></span></td>
				</tr>
			</tbody></table>
<table class="inventory">
				<thead>
					<tr>
						<th colspan="5"><span>Store Details</span></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><span>Name:</span></td>
						<td COLSPAN="4"><input type="text" name="name"></td>
					</tr><tr>
						<td><span>No_of_Employee:</span></td>
						<td COLSPAN="4"><input type="text" name="noe"></td>
					</tr><tr>
						<td><span>Street Name:</span></td>
						<td COLSPAN="4"><input type="text" name="sname"></td>
					</tr>
				</tbody>
</table>
<table>
	<tbody>
		<tr>
			<td><span><input type="checkbox" name="modify"></span> &nbsp Modify Specific Store at specific Store Location.</td>
		</tr>
	</tbody>
</table>
<table>
	<tbody>
		<tr>
			<td><span>Old Store Location:</span></td>
			<td COLSPAN="4"><input type="text" name="osloc"></td>
		</tr>
		<tr>
			<td><span>New Store Location:</span></td>
			<td COLSPAN="4"><input type="text" name="nsloc"></td>
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
	if(isset($_POST['sid']))
	{
		$sid = $_POST['sid'];
	if(($_POST['name'])!= NULL)
	{
		$name = $_POST['name'];
		$query = "UPDATE store SET Name = '$name' WHERE SID = $sid";
	}
	if (isset ($query))
	{
		$sql = mysql_query($query,$con);
	}
	if(($_POST['noe'])!= NULL)
	{
		$noe = $_POST['noe'];
		$query = "UPDATE store SET No_of_Employee = '$noe' WHERE SID = $sid";
	}
	if (isset ($query))
	{
		$sql = mysql_query($query,$con);
	}
	if(($_POST['sname'])!= NULL)
	{
		$sname = $_POST['sname'];
		$query = "UPDATE store SET Streetname = '$sname' WHERE SID = $sid";
	}
	if (isset ($query))
	{
		$sql = mysql_query($query,$con);
	}
	if(isset($_POST['modify']))
	{
		//echo "45";
		$osloc = $_POST['osloc'];
		$nsloc = $_POST['nsloc'];
		echo "$sid $nsloc $osloc";
		$query1 = "UPDATE storelocation SET StoreLocation = '$nsloc' WHERE SID = $sid AND StoreLocation = $osloc";
	}
	else
	{
		$nsloc = $_POST['nsloc'];
		$query1 = "UPDATE storelocation SET StoreLocation = '$nsloc' WHERE SID = $sid";
	}
	if(isset ($query1))
	{
		//echo "455";
		$sql1 = mysql_query($query1,$con);
	}
	/*if(isset($sql1))
	{
		echo "123";
	}*/
	}
	if($new)
	{
		//$sid = $_POST['sid'];
		//$nsloc = $_POST['nsloc'];
		if(isset($_POST['sid']))
		{
			$query = "SELECT SID,Name,Streetname,No_of_Employee FROM store WHERE SID =".$_POST['sid'].";";
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
						<th COLSPAN=5><span>Modified Store Details</span></th></tr>
				</thead>
				<tbody>");
				$new = $row['SID'];
				echo("<tr>
						<td><span>Store ID:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
					
				$new = $row['Name'];
				echo("<tr>
						<td><span>Name:</span></td>
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
	}
	if(isset($_POST['sid']) && isset($_POST['nsloc']))
	{
			$query1 = "SELECT StoreLocation From storelocation JOIN store ON storelocation.SID = store.SID WHERE storelocation.SID =".$_POST['sid']." AND StoreLocation LIKE '%".$_POST['nsloc']."%'";
	}
	if(isset($query1))
		{
				//echo "ds";
			$sql = mysql_query($query1,$con);
		}
	if(isset($sql))
	{
		//echo "45";
		echo("<tr>
				<td><span>StoreLocations:</span></td>
				<td COLSPAN=4>");
		while($row = mysql_fetch_array($sql))
		{
			$new = $row['StoreLocation'];
				echo("$new,");
		}
		echo("</td></tr>");
	}
}
?>
</tbody>
</table>
</body>
</html>