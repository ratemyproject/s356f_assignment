<?php 
    session_start();
	require_once("mysql_connection.php");
	if(!isset($_SESSION['username'])){
	header ('location:index.php');
	}

	$id = $_SESSION['username'];
    $name = $_POST['restName'];  
	$tel = $_POST['restTel']; 
	$logo = ($_POST['logo_name'] != null ?$_POST['logo_name']:'');
	$des = $_POST['restDes']; 
	$area = $_POST['area'];
	$dist = $_POST['dist'];
	$add = $_POST['restAdd'];
	$sql = "select * from restaurants where rname = '".$name."'";
	$result = mysql_query($sql);
	if ($row = mysql_fetch_row($result)) {
	    $restid = $row[0];
	} else {
	    $sql = "select MAX(rid) from restaurants";
	    $result = mysql_query($sql);
	    $row = mysql_fetch_row($result);
		$row[0]++;
	    if ($row[0] < 10) 
		    $restid = "0000$row[0]";
		 else if (($row[0] >= 10) && ($row[0] < 100)) 
		    $restid = "000$row[0]";
		 else if (($row[0] >= 100) && ($row[0] < 1000))
		    $restid = "00$row[0]";
		 else if (($row[0] >= 1000) && ($row[0] < 10000))
		    $restid = "0$row[0]";
         else
            $restid = $row[0];		
	}
	$sql = "select count(*) from restaurants where rname = '".$name."' and district='".$dist."'";
	$result = mysql_query($sql);
	$row = mysql_fetch_row($result);
	$row[0]++;
	$sql = "insert into restaurants (`rid`, `rname`, `raddr`, `area`, `district`, `rtel`, `rlogo`, `owner`, `rdes`) VALUES ('".$restid."', '".$name."', '".$add."', '".$area."', '".$dist."', '".$tel."', '".$logo."', '".$id."', '".$des."') ";
	if ($result = mysql_query($sql)) {
	    echo "Restaurant created!</br>";
		echo "<a href='memberpanel.php'>back</a>";
	} else {
        echo "Error in creating restaurant. Please Try Later</br>";
		echo "<a href='memberpanel.php'>back</a>";
    }		 
?>