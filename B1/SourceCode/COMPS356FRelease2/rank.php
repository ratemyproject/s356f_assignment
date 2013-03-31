<?php
    session_start();
?>

<?php
    include('mysql_connection.php');
    $q = $_GET['q'];
	$r = $_GET['r'];
    $sqlpop = "update restaurants set popular = '".$q."' where rid = '".$r."'";
	$resultpop = mysql_query($sqlpop);
    
	$sql = "select popular from restaurants where rid = '".$r."'";
	$result = mysql_query($sql);
	$row = mysql_fetch_row($result);
	echo $row[0];
?>	