<?php
    session_start();
	require_once("mysql_connection.php");
	if(!isset($_SESSION['username'])||$_SESSION['rest'] != 1){
	header ('location:index.php');
}
 $id = $_SESSION['username'];
		$error = 0;
		$count = 0;
		for($i=1;$i<=5;$i++){
			if(!empty($_POST['name'.$i])){
			$count=$count+1;}
		}

		    for ($i = 1; $i <= $count; $i++) {
			    $j = 0;
			    $incoming[$i][$j] = $_POST['type'.$i];
				$j++;
				$incoming[$i][$j] = $_POST['name'.$i];
				$j++;
				$incoming[$i][$j] = $_POST['price'.$i];
			}
			$sql = "select rid from restaurants where owner = '".$id."'";
			$result = mysql_query($sql);
			$row = mysql_fetch_row($result);
			$restid = $row[0];
			
			for ($i = 1; $i <= $count; $i++) {
			    $j = 0;
			    if ($incoming[$i][$j] == 'Food') {
				    $sql = "select count(foodid) from menu where restaurantid = '".$restid."' and foodid like 'F%'";
				    $result = mysql_query($sql);
					if ($row = mysql_fetch_row($result)) {
					    $number = $row[0] + 1;
						if ($number < 10) {
						    $number = "000$number";
						} else if ($number >= 10 && $number < 100) {
                            $number = "00$number";
                        } else if ($number >= 100 && $number < 1000){
                            $number = "0$number";
                        } else {
                            $number = $number;
                        }
                        $fid[$i] = "F$number";
					}	
                    $sql = "insert into menu (`restaurantid`, `foodid`, `food`, `price`) values ('".$restid."', '".$fid[$i]."', '".$incoming[$i][1]."', '".$incoming[$i][2]."')";	
					
					if (mysql_query($sql)) 
					    $error = 0;
					else {
					    $error = 1;
						break;
					}	
                    					
                } else if ($incoming[$i][$j] == 'Drink') {
					$sql = "select count(foodid) from menu where restaurantid = '".$restid."' and foodid like 'D%'";
					$result = mysql_query($sql);
					if ($row = mysql_fetch_row($result)) {
					
					    $number = $row[0] + 1;
						if ($number < 10) {
						    $number = "000$number";
						} else if ($number >= 10 && $number < 100) {
                            $number = "00$number";
                        } else if ($number >= 100 && $number < 1000){
                            $number = "0$number";
                        } else {
                            $number = $number;
                        }
                        $fid[$i] = "D$number";
			        }	
					$sql = "insert into menu (`restaurantid`, `foodid`, `food`, `price`) values ('".$restid."', '".$fid[$i]."', '".$incoming[$i][1]."', '".$incoming[$i][2]."')";	
			        if (mysql_query($sql)) 
					    $error = 0;
					else {
					    $error = 1;
						break;
					}
				}
			}	
			if ($error == 0) {
	            echo "<p style='color:#0000FF; padding:25px 0 25px 15px; text-align:center'>Menu Added!</p>";
				echo $count;
 	            echo "<a href='memberpanel.php'>back</a>";
            } else {
                echo "Something went wrong...Try your order later";
		        echo "<a href='memberpanel.php'>back</a>";	
            }
 
?>