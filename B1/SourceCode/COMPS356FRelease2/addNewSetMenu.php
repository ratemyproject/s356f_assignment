<?php
session_start();
if(!isset($_SESSION['username'])){
	header ('location:index.php');
}
require_once("mysql_connection.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="menberpanelmenu.css">
<link rel="stylesheet" type="text/css" href="index.css">
<title>Add New Set Menu - ONLINE Restaurant</title>
</head>

<body>
<div id="header">

<div id="logo"><a href="index.php"><img src="image\icon.png" /></a></div>

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
<div id='memberpanel' style=" margin: 30px; ">
<h2>Member Panel</h2>
<ul id="nav">
<li><a href="memberpanel.php?ad=changepw">Change Password</a></li>
<li> <a href="#">Change information</a>
<ul><li><a href="memberpanel.php?ad=changeTel">Change Telephone No.</a></li>
<?php
if($_SESSION['rest'] == 1){
	echo "<li><a href=\"memberpanel.php?ad=createRest\">Create Restaurant(s) Record</a></li>";
	echo "<li><a href=\"memberpanel.php?ad=updateRest\">Update Restaurant(s) Details</a></li>";
}
?>
</ul>
</li>
<?php
if($_SESSION['rest'] == 1){ 
echo 
"<li><a href=\"#\">Manage Menu</a>
<ul>
<li><a href='memberpanel.php?ad=addmenu'>Add Menu</a></li>
<li><a href='memberpanel.php?ad=delmenu'>Delete Menu</a></li>
</ul>
</li>"; ?>
<li><a href='memberpanel.php?ad=manage_set_menu'>Manage Set Menu</a></li>
<?php
}
?>
<?php
if($_SESSION['rest'] == 1){ 
echo 
"<li><a href=\"#\">View Order</a>
<ul>
<li><a href='restViewOrder.php'>View Order</a></li>
</ul>
</li>";
} else {
echo 
"<li><a href=\"#\">View Order</a>
<ul>
<li><a href='vieworder.php'>View Order</a></li>
</ul>
</li>";}
?>
<li><a href="logout.php">Logout</a></li>
</ul>
<h3>Add New Set Menu</h3>
<form action = 'setMenuManager.php' method = 'post' onSubmit="return formChecking();" id="addNewSetMenuForm">
<div id="addMenuFormDiv">
	<label for='setMenuName[]'>Set Menu Name:</label>
	<input type='text' name='setMenuName[]' value='' />
	<table id='addMenuForm1'>
	  <tr>
		  <th>Type</th>
		  <th>Name</th>
		  <th>Price</th>
	  </tr>
	  <tr>
		  <td><select name = 'type1[]'><option value='Food'>Food</option>
					  <option value='Drink'>Drink</option>
			  </select></td>
		  <td><input type = 'text' name = 'name1[]'  value = '' /></td>
		  <td><input type = 'text' name = 'price1[]' value = '' /></td>
	  </tr>	
	  <tr>
		  <td><select name = 'type1[]'><option value='Food'>Food</option>
					  <option value='Drink'>Drink</option>
			  </select></td>
		  <td><input type = 'text' name = 'name1[]' value = '' /></td>
		  <td><input type = 'text' name = 'price1[]' value = '' /></td>
	  </tr>	
	  <tr>
		  <td><select name = 'type1[]'><option value='Food'>Food</option>
					  <option value='Drink'>Drink</option>
			  </select></td>
		  <td><input type = 'text' name = 'name1[]' value = '' /></td>
		  <td><input type = 'text' name = 'price1[]' value = '' /></td>
	  </tr>		
	  <tr>
		  <td><select name = 'type1[]'><option value='Food'>Food</option>
					  <option value='Drink'>Drink</option>
			  </select></td>
		  <td><input type = 'text' name = 'name1[]' value = '' /></td>
		  <td><input type = 'text' name = 'price1[]' value = '' /></td>
	  </tr>		
	  <tr>
		  <td><select name = 'type1[]'><option value='Food'>Food</option>
					  <option value='Drink'>Drink</option>
			  </select></td>
		  <td><input type = 'text' name = 'name1[]' value = '' /></td>
		  <td><input type = 'text' name = 'price1[]' value = '' /></td>
	  </tr>			
	</table>
	<a style='color:#069; border-bottom: 1px solid #069;' href='javascript:addOneMoreItem(1)'>Add one more item</a>
	<br/><br/>
</div>
<div id='addmorelink'>
	<a style="color:#069; border-bottom: 1px solid #069;" href='javascript:addOneMoreSetMenu()'>add one more set menu</a> 
</div>
<input type="hidden" name="rid" value="<?php echo $_GET['rid']; ?>"/>
<input type="submit" name="addFormSubmit" value="Add Set Menu"/>
</form>
<?php mysql_close(); ?>
</div>
<div id="footer">
<p>Copyright@CLOUD</p>
</div>
</div>
</body>

<!--social button-->
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
$('#upload').load('uploadFunc.php');

var count = 1;

function addOneMoreSetMenu(){
	count = count + 1;
	var newContent
	= "<label for='setMenuName[]'>Set Menu Name:</label>"+
	"<input type='text' name='setMenuName[]' value='' />"+
	"<table id='addMenuForm"+count+"'>"+
	"  <tr>"+
	"	  <th>Type</th>"+
	"	  <th>Name</th>"+
	"	  <th>Price</th>"+
	"  </tr>"+
	"  <tr>"+
	"	  <td><select name = 'type"+count+"[]'><option value='Food'>Food</option>"+
	"				  <option value='Drink'>Drink</option>"+
	"		  </select></td>"+
	"	  <td><input type = 'text' name = 'name"+count+"[]' value = '' /></td>"+
	"	  <td><input type = 'text' name = 'price"+count+"[]' value = '' /></td>"+
	"  </tr>"+	
	"  <tr>"+
	"	  <td><select name = 'type"+count+"[]'><option value='Food'>Food</option>"+
	"				  <option value='Drink'>Drink</option>"+
	"		  </select></td>"+
	"	  <td><input type = 'text' name = 'name"+count+"[]' value = '' /></td>"+
	"	  <td><input type = 'text' name = 'price"+count+"[]' value = '' /></td>"+
	"  </tr>"+	
	"  <tr>"+
	"	  <td><select name = 'type"+count+"[]'><option value='Food'>Food</option>"+
	"				  <option value='Drink'>Drink</option>"+
	"		  </select></td>"+
	"	  <td><input type = 'text' name = 'name"+count+"[]' value = '' /></td>"+
	"	  <td><input type = 'text' name = 'price"+count+"[]' value = '' /></td>"+
	"  </tr>"+		
	"  <tr>"+
	"	  <td><select name = 'type"+count+"[]'><option value='Food'>Food</option>"+
	"				  <option value='Drink'>Drink</option>"+
	"		  </select></td>"+
	"	  <td><input type = 'text' name = 'name"+count+"[]' value = '' /></td>"+
	"	  <td><input type = 'text' name = 'price"+count+"[]' value = '' /></td>"+
	"  </tr>"+		
	"  <tr>"+
	"	  <td><select name = 'type"+count+"[]'><option value='Food'>Food</option>"+
	"				  <option value='Drink'>Drink</option>"+
	"		  </select></td>"+
	"	  <td><input type = 'text' name = 'name"+count+"[]' value = '' /></td>"+
	"	  <td><input type = 'text' name = 'price"+count+"[]' value = '' /></td>"+
	"  </tr>"+			
	"</table>"+
	"<a style='color:#069; border-bottom: 1px solid #069;' href='javascript:addOneMoreItem("+count+")'>Add one more item</a>"+
	"<br/><br/>";
	$("#addMenuFormDiv").append(newContent);
}
function addOneMoreItem(orderOfForm) {
	var newContent = "<tr><td><select name = 'type"+orderOfForm+"[]'><option value='Food'>Food</option><option value='Drink'>Drink</option></select></td>"+
	"<td><input type = 'text' name = 'name"+orderOfForm+"[]' value = '' /></td>"+
	"<td><input type = 'text' name = 'price"+orderOfForm+"[]' value = '' /></td></tr>";
	$("table#addMenuForm"+orderOfForm).append(newContent);
}
function formChecking() {
	var valid = true;
	for (var i = 1; i<= count; i++) {
		var nameFilled = 0;
		var priceFilled = 0;
		$('#addNewSetMenuForm input[name^=name'+i+']').each(function(key,value){
			var regexp = /^[a-zA-Z0-9 -]*$/;
			if (!regexp.test(value.value)) {
				valid = false;
			}
			if (value.value != '' && value.value != null) {
				nameFilled = nameFilled + 1;
			}
		});
		$('#addNewSetMenuForm input[name^=price'+i+']').each(function(key,value){
			if (isNaN(value.value)) {
				valid = false;
			}
			if (value.value != '' && value.value != null) {
				priceFilled = priceFilled + 1;
			}
		});
		if (nameFilled != priceFilled) {
			valid = false;
		}
	}
	if (valid == false){
		alert("Some fields contain incorrect data. Please check it.");
	}
	return valid;
}
</script>
</html> 