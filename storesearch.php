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
<h2>Search Store Details on basis of:</h2>
<br />
<center>
<form method="POST" #action="http://www.google.com/search">
<table>
<tr>
<td><input type="radio" name="storeid" > Store ID </td>
<td><input type="radio" name="storename" > Store Name </td>
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
	else if(isset($_POST['MID']) && isset($_POST['storeid']))
	{
		if ( preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['MID']))
		{
			echo "<script>alert('Enter valid Store ID!');</script>";
		}
		else
		{
		$query = "SELECT SID,Name,Streetname,No_of_Employee FROM store WHERE SID=".$_POST['MID'].";";
		$query1 = "SELECT StoreLocation FROM storelocation WHERE SID=".$_POST['MID'].";";
		$query2 = "SELECT Medname,Medbatchno,Qty FROM contains WHERE SSID= ".$_POST['MID'].";";
		}
	}
	else if(isset($_POST['MID']) && isset($_POST['storename']))
	{
		if ( preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['MID']))
		{
			echo "<script>alert('Enter valid Store Name!');</script>";
		}
		else
		{
		$query = "SELECT SID,Name,Streetname,No_of_Employee FROM store WHERE Name LIKE '%".$_POST['MID']."%'";
		$query2 = "SELECT Medname,Medbatchno,Qty FROM contains JOIN store ON contains.SSID=store.SID WHERE  store.Name LIKE '%".$_POST['MID']."%'";
		}
	}
	
	if (isset ($query))
	{
		$sql = mysql_query($query,$con);
	}
	if (isset($sql))
	{
		$flag = "1";
		while($row = mysql_fetch_array($sql))
		{
			echo("<address>
				<p>".$row['Name']."</p>
			</address>");
			echo("<table class=meta>
				<tbody><tr>
					<th><span>Store ID</span></th>
					<td><span>".$row['SID']."</span></td>
				</tr>
				<tr>
					<th><span>Name</span></th>
					<td><span>".$row['Name']."</span></td>
				</tr>
			</tbody></table>");
				echo("<table class=inventory>
				<thead><tr>
						<th COLSPAN=5><span>Store Details</span></th></tr>
				</thead>
				<tbody>");
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
				echo("<tr>
				<td><span>StoreLocations:</span></td>
				<td COLSPAN=4>");
		}	
		if(isset($query1))
		{
			$sql = mysql_query($query1,$con);
		}
	if (isset($sql))
	{
		
		while($row = mysql_fetch_array($sql))
		{
			//echo "ss";
			$new = $row['StoreLocation'];
				echo("$new,");
		}
		echo("</td></tr>");
		
	}
	if(isset($query2))
	{
		//echo "ss";
		$sql = mysql_query($query2,$con);
	}
	if (isset($sql))
	{
		
		while($row = mysql_fetch_array($sql))
		{
			if($flag)
			{
				$new = $row['Medname'];
				echo("<tr>
						<td><span>Medicine Name:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
					$flag = "0";
			}
			$new = $row['Medbatchno'];
			echo("<tr>
				<td><span>Medicine Batchno:</span></td>
				<td COLSPAN=4>$new</td>
			</tr>");
			$new = $row['Qty'];
				echo("<tr>
						<td><span>Quantity:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
		}
	}

		$sql = mysql_query($query,$con);
		$row = mysql_fetch_array($sql);
		if(empty($row))
		{
			if(isset($_POST['storeid']))
			echo"<script>alert('Enter valid Store ID!');</script>";
			else if(isset($_POST['storename']))
			echo"<script>alert('Enter valid Store Name!');</script>";
		}
	}		
	
?>
	</tbody>
	</table>
	</article>
</body>
</html>