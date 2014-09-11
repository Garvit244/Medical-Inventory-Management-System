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
					<th><span>Batch No</span></th>
					<td><span><input type="text" name="batchno"></span></td>
				</tr>
				<tr>
					<th><span>Name</span></th>
					<td><span><input type="text" name="name"></span></td>
				</tr>
			</tbody></table>
<table class="inventory">
				<thead>
					<tr>
						<th colspan="5"><span>Medicines Details</span></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><span>Price:</span></td>
						<td COLSPAN="4"><input type="text" name="price"></td>
					<tr>
						<td><span>Expiry Date:</span></td>
						<td COLSPAN="4"><input type="text" name="expirydate"></td>
					</tr>
				</tbody>
</table>
<table>
	<tbody>
		<tr>
			<td><span><input type="checkbox" name="modify"></span> &nbsp Modify Specific Medicine Category.</td>
		</tr>
	</tbody>
</table>
<table>
	<tbody>
		<tr>
			<td><span>Old Category:</span></td>
			<td COLSPAN="4"><input type="text" name="ocat"></td>
		</tr>
		<tr>
			<td><span>New category:</span></td>
			<td COLSPAN="4"><input type="text" name="ncat"></td>
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
	if(isset($_POST['batchno']) && isset($_POST['name']))
	{
		$batchno = $_POST['batchno'];
		$name = $_POST['name'];
	if(($_POST['price'])!= NULL)
	{
		$price = $_POST['price'];
		$query = "UPDATE medicines SET Price = '$price' WHERE Batchno = $batchno AND Name LIKE '%$name%'";
	}
	if (isset ($query))
	{
		$sql = mysql_query($query,$con);
	}
	if(($_POST['expirydate'])!= NULL)
	{
		$expirydate = $_POST['expirydate'];
		$query = "UPDATE medicines SET ExpiryDate = '$expirydate' WHERE Batchno = $batchno AND Name LIKE '%$name%'";
	}
	if (isset ($query))
	{
		$sql = mysql_query($query,$con);
	}
	if(isset($_POST['modify']))
	{
		//echo "45";
		$ocat = $_POST['ocat'];
		$ncat = $_POST['ncat'];
		//echo "$sid $nsloc $osloc";
		$query1 = "UPDATE medicinecategory SET Category = '$ncat' WHERE Batchno = $batchno AND Name LIKE '%$name%' AND Category LIKE '%$ocat%'";
	}
	else
	{
		$ncat = $_POST['ncat'];
		$query1 = "UPDATE medicinecategory SET Category = '$ncat' WHERE Batchno = $batchno AND Name LIKE '%$name%'";
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
		if(isset($_POST['batchno']))
		{
			$query = "SELECT Batchno,Name,Price,ExpiryDate FROM medicines WHERE Batchno =".$_POST['batchno']." AND Name LIKE '%".$_POST['name']."%'";
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
						<th COLSPAN=5><span>Modified Medicine Details</span></th></tr>
				</thead>
				<tbody>");
				$new = $row['Batchno'];
				echo("<tr>
						<td><span>Batch No:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
					
				$new = $row['Name'];
				echo("<tr>
						<td><span>Name:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				$new = $row['Price'];
				echo("<tr>
						<td><span>Price:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				$new = $row['ExpiryDate'];
				echo("<tr>
						<td><span>Expiry Date:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
		}	
	}
	if(isset($_POST['batchno']) && isset($_POST['ncat']))
	{
			$query1 = "SELECT Category From medicinecategory JOIN medicines ON medicinecategory.Batchno = medicines.Batchno AND medicinecategory.Name = medicines.Name WHERE medicinecategory.Batchno =".$_POST['batchno']." AND Category LIKE '%".$_POST['ncat']."%'";
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
				<td><span>Category:</span></td>
				<td COLSPAN=4>");
		while($row = mysql_fetch_array($sql))
		{
			$new = $row['Category'];
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