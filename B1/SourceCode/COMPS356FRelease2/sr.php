<?php 
    session_start(); 
    require_once("mysql_connection.php");
	
	if(!isset($_GET['rid'])){
		header("location: index.php");
	}
	else{
	$rid = $_GET['rid'];
	$sql = "SELECT * FROM restaurants WHERE rid='".$rid."'";
	$sql2 = "SELECT * FROM menu WHERE restaurantid='".$rid."'";
 	$result = mysql_query($sql);
	$result2 = mysql_query("SELECT * FROM restaurants WHERE rlogo='".$_GET['rid']."'");
	$menuresult = mysql_query($sql2);
	$row = mysql_fetch_assoc($result);
	$data=mysql_fetch_array($result2); 
	$encoded=$data['rlogo']; 
	}
	
	function curPageURL() {
	$pageURL = 'http';
	if (isset($_SERVER["HTTPS"])) {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
	$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
	}
	function imglink($rid,$rname){
	$sql = "SELECT rlogo from restaurants where rid = '$rid'";
	$result = mysql_query($sql);
	$rlogo = mysql_result($result, 0);
	$path = "temporary/";
	return "<img src='".$path.$rlogo."' alt='$rname' style='width:150px; height:150px'/>";
	}	
?>
<!DOCTYPE html>
<html>
<!--This page shows the result from search box or advance search-->
<head>
<link rel="stylesheet" type="text/css" href="index.css">
<link rel="stylesheet" type="text/css" href="sr.css" />
<?php echo "<title>".$row['rname']." - ONLINE Restaurant</title> ";?>
</head>
<body onload="initialize()">
<div id="header">

<div id="logo"><a href="index.php"><img src="image\icon.png" /></a></div>


<div id="share">
<span class='st_sharethis_large' displayText='ShareThis'></span>
<span class='st_facebook_large' displayText='Facebook'></span>
<span class='st_twitter_large' displayText='Tweet'></span>
<span class='st_linkedin_large' displayText='LinkedIn'></span>
<span class='st_email_large' displayText='Email'></span>
</div>



 </div>
 <div id="container">
 <!--search bar(new version)-->
<div id="search">

		<form action="searchbox.php" method="GET" style=" color: orange; margin-bottom: -1px;">
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
echo "<a href='login.html'>Login </a>|<a href='reg.php'> New Members </a>";
}else echo "Welcome <a href='memberpanel.php'>".$_SESSION['username']."</a> | <a href='logout.php'>Logout</a>";
?>
</div>

</div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>
function addPopularity(restid) {
        id = restid;
		if (id < 10) 
		    id = '0000'+id;
		 else if ((id >= 10) && (id < 100)) 
		    id = '000'+id;
		 else if ((id >= 100) && (id < 1000))
		    id = '00'+id;
		 else if ((id >= 1000) && (id < 10000))
		    id = '0'+id;
         else
            id = id;
	    add = parseInt(document.getElementById('pop').innerHTML);
        add++;
        document.getElementById('but').innerHTML = "<input type = 'button' value = 'Like!' disabled = 'disabled'>";
		if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById('pop').innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open('GET','rank.php?q='+add+'&r='+id,true);

xmlhttp.send();

}
</script>
<div id="srrest">
<?php 
echo imglink($rid,$row['rname']);
echo "<ul style='list-style-type:none'>";
echo "<li>".$row['rname']."</li>";
echo "<li>Address : ".$row['raddr']."</li>";
echo "<li>Telephone : ".$row['rtel']."</li>";
echo "<li>Description : ".$row['rdes']."</li>";
echo "<li>Popularity: <div id = 'pop'>".$row['popular']."</div></li>";
echo "<li><div id = 'but'><input type = 'button' value = 'Like!' onclick='addPopularity($rid)'></div></li>";
echo "<li><div class='fb-like' data-send='false' data-width='450' data-show-faces='true'></div></li></ul>";
?>
</div>
<div id='map_canvas' >
</div>


<!-- menu -->

<div id="inmenu">
<form name='order' method='post' action='ordering.php'>

<div id="inmenuItem">
      <table border='0' style='text-align:center'>
      <tr>
      <th> Item </th>
	  <th> Price </th>
	  <th> Quantity </th>
	  </tr>

<?php
while($row2 = mysql_fetch_array($menuresult)) {
		echo"<tr>
		<td><p name='".$row2['foodid']."'>".$row2['food']."</p></td>
		<td><p>$".$row2['price']."</p></td>
		<td><input type='textbox' name='F".$row2['foodid']."' id='F".$row2['foodid']."' value='0' onchange='calculate(".'"F'.$row2['foodid'].'"'.", ".$row2['price'].")'></input></td>
		<input type='hidden' id='previousF".$row2['foodid']."' value='0')></input>
		</tr>";
}

$sql3 = "select setMenuId from setmenu where restaurantid='".$rid."'";
$setMenuIdResult = mysql_query($sql3);
while ($row2 = mysql_fetch_array($setMenuIdResult)){
	$name_sql = 'select name from setmenu where restaurantid="'.$rid.'" and setMenuId="'.$row2['setMenuId'].'"';
	$nameResult = mysql_query($name_sql);
	$nameResultArray = mysql_fetch_array($nameResult);
	$name = $nameResultArray['name'];
	$setMenuCost_sql = 'select round(sum(price),2) as total from setmenuitems where rid="'.$rid.'" and setMenuId="'.$row2['setMenuId'].'"';
	$setMenuCostResult = mysql_query($setMenuCost_sql);
	$setMenuCostResultArray = mysql_fetch_array($setMenuCostResult);
	$setMenuCost = $setMenuCostResultArray['total'];
	echo"<tr>
		<td><p name='".$name."'>".$name."</p></td>
		<td><p>$".$setMenuCost."</p></td>
		<td><input type='textbox' name='S".$row2['setMenuId']."' id='S".$row2['setMenuId']."' value='0' onchange='calculate(".'"S'.$row2['setMenuId'].'"'.", ".$setMenuCost.")'></input></td>
		<input type='hidden' id='previousS".$row2['setMenuId']."' value='0')></input>
		</tr>";
	$setMenuItemNames_sql = 'select foodName from setmenuitems where rid="'.$rid.'" and setMenuId="'.$row2['setMenuId'].'"';
	$setMenuItemNames = mysql_query($setMenuItemNames_sql);
	$setMenuItemNamesArray = mysql_fetch_array($setMenuItemNames);
	$setMenuDescription = '(includes '.$setMenuItemNamesArray['foodName'];
	while ($setMenuItemNamesArray = mysql_fetch_array($setMenuItemNames)) {
		$setMenuDescription = $setMenuDescription.', '.$setMenuItemNamesArray['foodName'];
	}
	$setMenuDescription = $setMenuDescription.')';
	echo "<tr>
			<td colspan='3'><p>".$setMenuDescription."</p></td>
			</tr>";
}

		echo"<tr>
		<td style='border-top:1px solid #B1FB17;'><label total'>Total: $</label></td>
		<td COLSPAN='2' style='border-top:1px solid #B1FB17; text-align:right;'><input type='textbox' name='total' id='total' value='0' readonly='readonly'></input></td></tr>
		</table>
		<input type='hidden' name='restid' value='".$rid."' />";
		/*no branch id
		<input type='hidden' name='branchid' value='".$branch."' />";*/
		if (isset($_SESSION['username'])) {
		    echo "<br><span> Address to be delivered: </span><input type='textbox' value='' name='address' size='40' maxlength='200' />";
		    echo "<input type='submit' value='Bill' class='button' />";
		}	
		echo "</form>";
?>
</div>
		
</div>

<!--fb comment-->
<div class="fb-comments" data-href="<?php echo curPageURL(); ?>" data-width="470" data-num-posts="10"></div>
</div>
<div id="footer">
<p>Copyright@CLOUD</p>
</div>

</body>
<!--order function, calculate tota price-->
<script>
   function calculate(id, price) { 
      
      var quantity = parseInt(document.getElementById(id).value);
	  var total = parseFloat(document.getElementById('total').value);
	  var previous = parseInt(document.getElementById('previous'+id).value);
	  
      if (isNaN(quantity) || quantity < 0) {
	      total -= price * previous;
		  document.getElementById('total').value = total;
		  document.getElementById('previous'+id).value = '0';
	      document.getElementById(id).value = '0';
		  return;
      }
	  if (quantity > previous) {
	      total += (quantity - previous) * price;
		  previous = quantity;
      }
	  else if  (quantity < previous) {
	      total -= (previous - quantity) * price;
		  previous = quantity;
	  }
	  document.getElementById('total').value = total;
	  document.getElementById('previous'+id).value = previous;
	  
   }
</script>

<!--map function-->
<script type='text/javascript' src='http://maps.google.com/maps/api/js?v=3&key=AIzaSyAQ6ZWMB23iJRcg2zUbXuOpmFItRqwSP5c&sensor=false'></script>
<script type='text/javascript'>
var geocoder;
var map;
function initialize() {
geocoder = new google.maps.Geocoder();
var myOptions = {
zoom: 16,
mapTypeId: google.maps.MapTypeId.ROADMAP
}
map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);
codeAddress();
}

function codeAddress() {
var address = 
"<?php 
$raddr = $row['raddr'];
$addr = explode(",",$raddr);
$address = ""; 
if(count($addr)>1){
	for($i = 1; $i < count($addr); $i++){
		$address = $address.$addr[$i]." ";
	}
	echo $address;
}else{
	echo $raddr;
}
?>";
if (geocoder) {
geocoder.geocode({ 'address': address }, function(results, status) {
if (status == google.maps.GeocoderStatus.OK) {
map.setCenter(results[0].geometry.location);
var marker = new google.maps.Marker({
map: map,
position: results[0].geometry.location
});
} else {
alert('Geocode was not successful for the following reason: ' + status);
}
});
}
}
</script>
</html>