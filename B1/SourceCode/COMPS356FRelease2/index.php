<?php 
   session_start();
?> 
<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="index.css">
<title>ONLINE Restaurant</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>

<body>

<div id="header">

<div id="logo"><a href="index.php"><img src="image\icon.png" /></a></div>


<div id="login">
  <?php
if (!isset($_SESSION['username'])) {
echo "<a href='login.html'>Login </a>|<a href='reg.php'> New Members </a>";
}else echo "Welcome <a href='memberpanel.php'>".$_SESSION['username']."</a> you come back! | <a href='logout.php'>Logout</a>";
?>
|<a href=''> Mobile</a></br>
</div>

<div id="share">
<span class='st_sharethis_large' displayText='ShareThis'></span>
<span class='st_facebook_large' displayText='Facebook'></span>
<span class='st_twitter_large' displayText='Tweet'></span>
<span class='st_linkedin_large' displayText='LinkedIn'></span>
<span class='st_email_large' displayText='Email'></span>
</div>

<!--search bar(new version)-->


 </div>


  <div id="container">
<div id="search">

		<form action="searchbox.php" method="GET" style=" color: orange; ">
		<b>Search Restaurant </b>
		<select name="district">
		<option value="" selected>Select District</option>
		<option value="all">--Hong Kong--</option>
		<option value="Hong Kong Island">-Hong Kong Island-</option>
		<option value="The Peak">The Peak</option>
		<option value="Kowloon">-Kowloon-</option>
		<option value="Kwun Tong">Kwun Tong</option>
		<option value="Sham Shui Po">Sham Shui Po</option>
		<option value="New Territories">-New Territories-</option>
		<option value="Tuen Mun">Tuen Mun</option>
		</select>

<select name="keywordstype">
<option value="name" selected>Name</option>
<option value="address">Address</option>
<option value="tel">Telephone</option>
</select>

<input type="text" name="keyword"></input>
<button type="submit">submit</button>
</form>
<div id="login">
               <?php
                  if (!isset($_SESSION['username'])) {
                  echo "<a href='login.html' style='color:orange;'>Login</a> | <a href='reg.php' style='color:orange;'>New Members</a>";
                  }else echo "Welcome <a href='memberpanel.php'>".$_SESSION['username']."</a> ! | <a href='logout.php'>Logout</a>";
                  ?>
               </br>
            </div>
</div>

<div id="recommendation">
<h2>Restaurant recommendation</h2>
<div id="recommrest"></div>
</div>
<div id = 'rank'>
<h2>Top Ranking Restaurants</h2>
<?php

require_once("mysql_connection.php");

function imglink($rid,$rname){
$sql = "SELECT rlogo from restaurants where rid = '$rid'";
$result = mysql_query($sql);
$rlogo = mysql_result($result, 0);
$path = "temporary/";
return "<img src='".$path.$rlogo."' alt='$rname' style='width:150px; height:150px'/>";
}

$content = "SELECT * FROM restaurants WHERE popular >=0 ORDER BY popular desc limit 2 ";
$resultshown = mysql_query($content);
$count = 0;
while($rows = mysql_fetch_array($resultshown)){
	echo "<div id='rest".$count."'>";
	echo imglink($rows['rid'],$rows['rname']);
	echo "<div class='randomcontent'><ul style='list-style-type:none'>";
	echo "<li><b>".$rows['rname']."</b></li>";
	echo "<li> District: ".$rows['district']."</li>";
	echo "<li> Telphone: ".$rows['rtel']."</li>";
	echo "<li> Address: ".$rows['raddr']."</li>";
	echo "<li class='view_menu1'><a href='sr.php?rid=".$rows['rid']."'>view menu</a></li></ul></div>";
	echo "</div>";
	$count++;
}
mysql_close($con);
?>

</div>
</div>

<div id="footer">
<p>Copyright@CLOUD</p>
</div>


</body>

<!--social button-->
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">
$('#recommrest').load('randomContent2.php'); 
</script>
</html> 