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
<h1>Delete Details</h1>
</header>
<br />
<h2>Delete Medicine Details on basis of:</h2>
<br />
<center>
<form method="POST" #action="http://www.google.com/search">
<table>
<tr>
<td><input type="radio" name="batchno" > Batch No</td>
</table>
<br />
<!-- <table>
	<tbody>
		<tr>
			<td><span><input type="checkbox" name="modify"></span> &nbsp Delete Medicine Details On Basis of Category</td>
		</tr>
	</tbody>
</table>
<br />
<table>
	<tbody>
		<tr>
			<td><span>Name:</span></td>
			<td COLSPAN="4"><input type="text" name="name"></td>
		</tr>
	</tbody>
</table>
<br />
<table>
	<tbody>
		<tr>
			<td><span><input type="checkbox" name="modifycat"></span> &nbsp Delete Specific Category Medicine Details</td>
		</tr>
	</tbody>
</table>
<br />
<table>
	<tbody>
		<tr>
			<td><span>Old Category:</span></td>
			<td COLSPAN="4"><input type="text" name="ocat"></td>
		</tr>
	</tbody>
</table> -->

<br />
<div style="border:2px dotted blue;padding:4px;width:15em;">
<table border="0" align="center" cellpadding="0">
<tr><td>
<input type="text"  name="MID" size="25" style="color:#808080;" maxlength="255" placeholder="Delete by BatchNo"/>
<input type="submit" value="Submit" />
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
	
	if(isset($_POST['MID']) )
	{
		//echo "1";
		$query = "DELETE FROM medicines WHERE Batchno=".$_POST['MID'].";";
	}
	
	
	if (isset ($query))
	{
		//echo "1";
		$sql = mysql_query($query,$con);
	}
	if (isset($sql))
	{
		echo ("<br /><br /><br /><br /><aside><h1>Details Deleted Sucessfully</h1></aside>");
	}
	else
	{
		echo ("<br /><br /><br /><br /><aside><h1>Could not delete data</h1></aside>");
	}
?>
	</tbody>
	</table>
	</article>
</body>
</html>