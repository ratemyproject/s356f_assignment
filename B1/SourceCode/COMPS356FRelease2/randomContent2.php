<?php

require_once("mysql_connection.php");

function imglink($rid,$rname){
$sql = "SELECT rlogo from restaurants where rid = '$rid'";
$result = mysql_query($sql);
$rlogo = mysql_result($result, 0);
$path = "temporary/";
return "<img src='".$path.$rlogo."' alt='$rname' style='width:150px; height:150px'/>";
}

$sql = "select * from restaurants";
$result = mysql_query($sql);
$noOfRow = mysql_num_rows($result);
$offset = (int)rand(0,$noOfRow-1);
$content = "SELECT * FROM restaurants limit 2 offset ".$offset;
$resultshown = mysql_query($content);
$count = 0;
while($rows = mysql_fetch_array($resultshown)){
	echo "<div id='rest".$count."'>";
	echo imglink($rows['rid'],$rows['rname']);
	echo "<div class='randomcontent'><ul style='list-style-type:none'>";
	echo "<li><b>".$rows['rname']."</b></li><br />";
	echo "<li> District: ".$rows['district']."</li>";
	echo "<li> Telphone: ".$rows['rtel']."</li>";
	echo "<li> Address: ".$rows['raddr']."</li>";
	echo "<li class='view_menu'><a href='sr.php?rid=".$rows['rid']."'>view menu</a></li></ul></div>";
	echo "</div>";
	$count++;
}
mysql_close($con);
?>