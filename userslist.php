<html>
	<head>
		<title>List of Users</title>
		<link rel="stylesheet" href="css/style.css">
		<script>
			<!--add validation js script here
		</script>
	</head>
	<body>
		<table>
			<tr>
				<td colspan="2" id="pageheader">
					Application Header
				</td>
			</tr>
			<tr>
				<td id="mainnav">
					<div class="menuitem">menu 1</div>
					<div class="menuitem">menu 2</div>
				</td>
				<td id="content">
					<div id="divPageMenu">
						<span class="menuitem" >page menu 1</span>
						<input type="text" id="txtSearch" />
						<span class="menuitem">search</span>		
					</div>
					<div id="divStatus" class="status">
						status message
					</div>
					
					<div id="divContent">
						Content space
					<form action="" method="GET">
						<input type="text" name="txtSearch">
						<input type="submit" value="search" >	
						
					</form>	
					</div>
					<table class= "tableDiv">
					
					
<?php

	//1) Create object of users class
	include_once("users.php");
	$obj=new users();
	
	
	
	//2) Call the object's getUsers method and check for error
	if(!isset($_REQUEST['txtSearch'])){
		
	if(!$obj->getUsers()){
		echo"Error getting users";
	}
	else
		
		
	
	//3) show the result
	
	
	echo "<table border 2 width=70% 	bordercolor='blue'>
	<th>USERCODE</th>
	<th>USERNAME</th>
	<th>FIRSTNAME</th>
	<th>LASTNAME</th>
	<th>GROUPNAME</th>
<th>STATUS</th>
<th>EDIT</th>
<th>DELETE</th></tr>";
	$color="1";
	while ($row=$obj->fetch()){
		
if($color==1){

echo "<tr bgcolor='#FFFF11'>";
echo"<td>{$row['USERCODE']}";
echo"<td>{$row['USERNAME']}</td>";
echo"<td>{$row['FIRSTNAME']}</td>";
echo"<td>{$row['LASTNAME']}</td>";			
echo"<td>{$row['GROUPNAME']}</td>";
?>	 <td><a href="delete.php?STATUS=<?php echo $row['STATUS'];?>&USERCODE=<?php echo $row['USERCODE'];?>"><?php echo $row['STATUS'];?></a></td>
	  <td><a href="edituser.php?USERCODE=<?php echo $row['USERCODE'];?>">Edit</a></td>
	  <td><a href="delete.php?USERCODE=<?php echo $row['USERCODE'];?>">DELETE</a></td></tr>
<?php
	$color="2";
}

else {
echo "<tr bgcolor='#12FF5D'>";
echo"<td>{$row['USERCODE']}";
echo"<td>{$row['USERNAME']}</td>";
echo"<td>{$row['FIRSTNAME']}</td>";
echo"<td>{$row['LASTNAME']}</td>";			
echo"<td>{$row['GROUPNAME']}</td>";
?>	 <td><a href="delete.php?STATUS=<?php echo $row['STATUS'];?>&USERCODE=<?php echo $row['USERCODE'];?>"><?php echo $row['STATUS'];?></a></td>
	  <td><a href="edituser.php?USERCODE=<?php echo $row['USERCODE'];?>">Edit</a></td>
	  <td><a href="delete.php?USERCODE=<?php echo $row['USERCODE'];?>">DELETE</a></td></tr>
	  
	  
	
	<?php
	$color="1";
}

	}
}
if(isset($_REQUEST['txtSearch'])){
	$colour="1";
	
if(!$obj->searchUsers($_GET['txtSearch'])) {
      echo "error searching";
	}
	
	else if(!$obj->checkUserGroups($_GET['txtSearch'])){
		
		echo"found";
			echo "<table border 2 width=70% 	bordercolor='blue'>
	
	<th>USERCODE</th>
	<th>USERNAME</th>
	<th>FIRSTNAME</th>
	<th>LASTNAME</th>
	<th>GROUPNAME</th>
<th>STATUS</th>
<th>EDIT</th>
<th>DELETE</th>";
	
	while ($row=$obj->fetch()){
		
if($colour==1){

echo "<tr bgcolor='#FFFF11'>";
echo"<td>{$row['USERCODE']}";
echo"<td>{$row['USERNAME']}</td>";
echo"<td>{$row['FIRSTNAME']}</td>";
echo"<td>{$row['LASTNAME']}</td>";			
echo"<td>{$row['GROUPNAME']}</td>";
?>	 <td><a href="delete.php?STATUS=<?php echo $row['STATUS'];?>&USERCODE=<?php echo $row['USERCODE'];?>"><?php echo $row['STATUS'];?></a></td>
	  <td><a href="edituser.php?USERCODE=<?php echo $row['USERCODE'];?>">Edit</a></td>
	  <td><a href="delete.php?USERCODE=<?php echo $row['USERCODE'];?>">DELETE</a></td></tr>
<?php
	$colour="2";
}

else {
echo "<tr bgcolor='#12FF5D'>";
echo"<td>{$row['USERCODE']}";
echo"<td>{$row['USERNAME']}</td>";
echo"<td>{$row['FIRSTNAME']}</td>";
echo"<td>{$row['LASTNAME']}</td>";			
echo"<td>{$row['GROUPNAME']}</td>";
?>	 <td><a href="delete.php?STATUS=<?php echo $row['STATUS'];?>&USERCODE=<?php echo $row['USERCODE'];?>"><?php echo $row['STATUS'];?></a></td>
	  <td><a href="edituser.php?USERCODE=<?php echo $row['USERCODE'];?>">Edit</a></td>
	  <td><a href="delete.php?USERCODE=<?php echo $row['USERCODE'];?>">DELETE</a></td></tr>
	  
	  
	
	<?php
	$colour="1";
}

	}
	}
		
		
		else
		
		{
		echo "<table border 2 width=50% 	bordercolor='blue'  >
	
	
	<th>USERCODE</th>
	<th>USERNAME</th>
	<th>FIRSTNAME</th>
	<th>LASTNAME</th>
	<th>GROUPNAME</th>
<th>STATUS</th>
<th>EDIT</th>
<th>DELETE</th>";
	$color="1";
	
	
		while ($row=$obj->fetch()){
		
if($colour==1){

echo "<tr bgcolor='#FFFF11'>";
echo"<td>{$row['USERCODE']}";
echo"<td>{$row['USERNAME']}</td>";
echo"<td>{$row['FIRSTNAME']}</td>";
echo"<td>{$row['LASTNAME']}</td>";			
echo"<td>{$row['GROUPNAME']}</td>";
?>	 <td><a href="delete.php?STATUS=<?php echo $row['STATUS'];?>&USERCODE=<?php echo $row['USERCODE'];?>"><?php echo $row['STATUS'];?></a></td>
	  <td><a href="edituser.php?USERCODE=<?php echo $row['USERCODE'];?>">Edit</a></td>
	  <td><a href="delete.php?USERCODE=<?php echo $row['USERCODE'];?>">DELETE</a></td></tr>
<?php
	$colour="2";
}

else {
echo "<tr bgcolor='#12FF5D'>";
echo"<td>{$row['USERCODE']}";
echo"<td>{$row['USERNAME']}</td>";
echo"<td>{$row['FIRSTNAME']}</td>";
echo"<td>{$row['LASTNAME']}</td>";			
echo"<td>{$row['GROUPNAME']}</td>";
?>	 <td><a href="delete.php?STATUS=<?php echo $row['STATUS'];?>&USERCODE=<?php echo $row['USERCODE'];?>"><?php echo $row['STATUS'];?></a></td>
	  <td><a href="edituser.php?USERCODE=<?php echo $row['USERCODE'];?>">Edit</a></td>
	  <td><a href="delete.php?USERCODE=<?php echo $row['USERCODE'];?>">DELETE</a></td></tr>
	  
	  
	
	<?php
	$colour="1";
}

	}
	}
	
}
?>					</table>	
					
				</td>
			</tr>
		</table>
	</body>
</html>	

	
	
	



























	