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
<?php
if (isset($_POST['addFormSubmit']) && strcmp($_POST['addFormSubmit'],"Add Set Menu")==0) {
	$currentMaxSetMenuId_sql = 'select max(setMenuId) as maxID from setmenu where restaurantid='.$_POST['rid'];
	$result = mysql_query($currentMaxSetMenuId_sql);
	$resultArray = mysql_fetch_array($result);
	$maxID = $resultArray['maxID'];
	$validAddition = true;
	if (isset($_POST['setMenuName']) && is_array($_POST['setMenuName'])) {
		$counter = 1;
		foreach($_POST['setMenuName'] as $value){
			if ($value != null && $value != ''){
				foreach ($_POST['name'.$counter] as $foodName) {
					if ($foodName != null && $foodName != '') {
						if (preg_match('/^[a-zA-Z0-9 -]*$/',$foodName) == 0) {
							$validAddition = false;
						}
					}
				}
				foreach ($_POST['price'.$counter] as $price) {
					if ($price != null && $price != '') {
						if (!is_numeric($price)) {
							$validAddition = false;
						}
					}
				}
				$counter = $counter + 1;
			}
		}
		$counter = 1;
		if ($validAddition == true) {
			foreach($_POST['setMenuName'] as $value){
				if ($value != null && $value != ''){
					$insertSetMenu_sql = 'insert into setmenu values ("'.$_POST['rid'].'","'.($maxID+$counter).'","'.$value.'")';
					mysql_query($insertSetMenu_sql);
					$itemsTotal = count($_POST['type'.$counter]);
					for ($i = 0; $i < $itemsTotal; $i++) {
						if (($_POST['name'.$counter][''.$i] != null && $_POST['name'.$counter][''.$i] != '') &&
							($_POST['price'.$counter][''.$i] != null && $_POST['price'.$counter][''.$i] != '')) {
							$foodType = (strcmp($_POST['type'.$counter][''.$i],'Food')==0 ?'F':'D');
							$insertSetMenuItem_sql = 'insert into setmenuitems values("'.$foodType.'","'.$_POST['name'.$counter][''.$i].
							'","'.$_POST['price'.$counter][''.$i].'","'.($maxID+$counter).'","'.$_POST['rid'].'")';
							mysql_query($insertSetMenuItem_sql);
						}
					}
					$counter = $counter + 1;
				}
			}
			echo '<p>Add Set Menu(s) Successfully</p>';
			echo '<a href="memberpanel.php?ad=manage_set_menu">Go Back to Member Panel</a>';
		} else {
			echo '<p>Some fields contain incorrect data. Please go back and check it.</p>';
		}
	}
} else if (isset($_POST["manageFormSubmit"])) {
	if (strcmp($_POST["manageFormSubmit"],"modify")==0) { ?>
		<form action = 'setMenuManager.php' method = 'post' onSubmit="return formChecking();" id="addNewSetMenuForm">
<?php	$modifyCount = count($_POST['selected']);
		$idArray = array();
		foreach ($_POST['selected'] as $value) {
			array_push($idArray,$value);
			$setMenuItemsInfo_sql = 'select * from setmenuitems where rid = '.$_POST['rid'].' and setMenuId = '.$value;
			$setMenuItemsInfoResult = mysql_query($setMenuItemsInfo_sql); 
			$setMenuName_sql = 'select name from setmenu where restaurantid= '.$_POST['rid'].' and setMenuId = '.$value;
			$setMenuNameResult = mysql_query($setMenuName_sql);
			$setMenuNameResultArray = mysql_fetch_array($setMenuNameResult);
			$setMenuName = $setMenuNameResultArray['name'];?>
			<label for='setMenuName<?php echo $value; ?>'>Set Menu Name:</label>
			<input type='text' name='setMenuName<?php echo $value; ?>' value='<?php echo $setMenuName; ?>' />
			<table id='addMenuForm<?php echo $value; ?>'>
				<tr>
					<th>Type</th>
					<th>Name</th>
					<th>Price</th>
				</tr>
<?php		while ($setMenuItemsInfo = mysql_fetch_array($setMenuItemsInfoResult)) { ?>
				<tr>
					<td>
						<select name = 'type<?php echo $value; ?>[]'>
							<option value='Food' <?php echo ($setMenuItemsInfo['foodType']=='F' ?'selected':''); ?>>Food</option>
							<option value='Drink' <?php echo ($setMenuItemsInfo['foodType']=='D' ?'selected':''); ?>>Drink</option>
						</select>
					</td>
					<td><input type = 'text' name = 'name<?php echo $value; ?>[]'  value = '<?php echo $setMenuItemsInfo['foodName']; ?>' /></td>
				<td><input type = 'text' name = 'price<?php echo $value; ?>[]' value = '<?php echo $setMenuItemsInfo['price']; ?>' /></td>
				</tr>
<?php		} ?>
			</table>
			<a style='color:#069; border-bottom: 1px solid #069;' href='javascript:addOneMoreItem(<?php echo $value; ?>)'>Add one more item</a>
			<input type="hidden" name="menuId[]" value="<?php echo $value; ?>" />
			<br/><br/>
<?php	} ?>
		<input type="hidden" name="rid" value="<?php echo $_POST['rid']; ?>" />
		<input type="submit" name="submitEdit" value="Submit Change"/>
		<a href="memberpanel.php?ad=manage_set_menu">Cancel</a>
		</form>
<?php	} else if (strcmp($_POST["manageFormSubmit"],"delete")==0) {
		$deletedCount = count($_POST['selected']);
		foreach($_POST['selected'] as $value) {
			$delete_sql = 'delete from setmenu where setMenuId = '.$value.' and restaurantid = '.$_POST['rid'];
			mysql_query($delete_sql);
			$delete_sql = 'delete from setmenuitems where setMenuId = '.$value.' and rid = '.$_POST['rid'];
			mysql_query($delete_sql);
		}
		echo '<p>Delete '.$deletedCount.' set menu(s) successfully.</p>';
		echo '<a href="memberpanel.php?ad=manage_set_menu">Go Back to Member Panel</a>';
	}
} else if (isset($_POST["submitEdit"])) {
	if (strcmp($_POST["submitEdit"],"Submit Change")==0) {
		$validEdit = true;
		foreach($_POST['menuId'] as $id){
			foreach ($_POST['name'.$id] as $foodName) {
				if ($foodName != null && $foodName != '') {
					if (preg_match('/^[a-zA-Z0-9 -]*$/',$foodName) == 0) {
						$validEdit = false;
					}
				}
			}
			foreach ($_POST['price'.$id] as $price) {
				if ($price != null && $price != '') {
					if (!is_numeric($price)) {
						$validEdit = false;
					}
				}
			}
		}
		
		if ($validEdit == true) {
			foreach($_POST['menuId'] as $id) {
				$updateSetMenuName_sql = 'update setmenu set name ="'.$_POST['setMenuName'.$id].'" where restaurantid = "'.$_POST['rid'].'" and setMenuId = "'.$id.'"';
				mysql_query($updateSetMenuName_sql);
				$deleteSetMenuItems_sql = 'delete from setmenuitems where setMenuId = '.$id.' and rid = '.$_POST['rid'];
				mysql_query($deleteSetMenuItems_sql);
				$itemsTotal = count($_POST['type'.$id]);
				for ($i = 0; $i < $itemsTotal; $i++) {
					if (($_POST['name'.$id][''.$i] != null && $_POST['name'.$id][''.$i] != '') &&
						($_POST['price'.$id][''.$i] != null && $_POST['price'.$id][''.$i] != '')) {
						$foodType = (strcmp($_POST['type'.$id][''.$i],'Food')==0 ?'F':'D');
						$insertSetMenuItem_sql = 'insert into setmenuitems values("'.$foodType.'","'.$_POST['name'.$id][''.$i].
						'","'.$_POST['price'.$id][''.$i].'","'.($id).'","'.$_POST['rid'].'")';
						mysql_query($insertSetMenuItem_sql);
					}
				}
			}
			echo '<p>Modify Set Menu(s) Successfully</p>';
			echo '<a href="memberpanel.php?ad=manage_set_menu">Go Back to Member Panel</a>';
		}  else {
			echo '<p>Some fields contain incorrect data. Please go back and check it.</p>';
		}
	}
}
mysql_close();
?>
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

function addOneMoreItem(orderOfForm) {
	var newContent = "<tr><td><select name = 'type"+orderOfForm+"[]'><option value='Food'>Food</option><option value='Drink'>Drink</option></select></td>"+
	"<td><input type = 'text' name = 'name"+orderOfForm+"[]' value = '' /></td>"+
	"<td><input type = 'text' name = 'price"+orderOfForm+"[]' value = '' /></td></tr>";
	$("table#addMenuForm"+orderOfForm).append(newContent);
}
function formChecking() {
	var valid = true;
	var idArray = new Array();
	<?php $counter = 0;
		foreach($idArray as $id) { ?>
	idArray[<?php echo $counter; ?>]="<?php echo $id; ?>";
	<?php $counter = $counter + 1;
	} ?>
	for (var i = 0; i< idArray.length; i++) {
		var nameFilled = 0;
		var priceFilled = 0;
		$('#addNewSetMenuForm input[name^=name'+idArray[i]+']').each(function(key,value){
			var regexp = /^[a-zA-Z0-9 -]*$/;
			if (!regexp.test(value.value)) {
				valid = false;
			}
			if (value.value != '' && value.value != null) {
				nameFilled = nameFilled + 1;
			}
		});
		$('#addNewSetMenuForm input[name^=price'+idArray[i]+']').each(function(key,value){
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