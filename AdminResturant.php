<?php
session_start();
if(!file_exists('users/'.$_SESSION['username'].'.xml')){
	header('Location: login.php');
	die;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin</title>
	<!-- <base href="/" target="_blank"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<!-- <meta http-equiv="refresh" content="60" /> -->

		<!-- <link rel="stylesheet" href="css/jquery.mobile.structure.css" /> -->
		<link rel="stylesheet" href="css/jquery.mobile.theme.css" />
		<link rel="stylesheet" href="css/style.css">
		<!-- <script src="js/jquery-1.12.1.js"></script> -->
		<script src="js/jquery.js"></script>
		<!-- <script src="js/index.js"></script> -->
		<script src="js/jquery.mobile.js"></script>
		<script src="js/cordova.js"></script>


		<script>
	var timeout = setTimeout("location.reload(true);",6000000);
  	function resetTimeout(){
    		clearTimeout(timeout);
    		timeout = setTimeout("location.reload(true);",30);
 	}
	function RetrievedDataComplete(xhr,status){
        	    if(status!="success"){
        	    	return alert("error while creating pool");
                }
                var obj=JSON.parse(xhr.responseText);
                   if(obj.result==0){
					window.alert(obj.message);
				}else{
					Edit(obj);
					var table="<table><th>CustomerID</th><th>name</th><th>location</th><th>Contact</th><th>food</th><th>Delivery_Time</th>";
					var EditNote = "<a href='#edit' data-transition='flip'><div style='background: #5D8AA8;color:white; text-align:center; margin-top: 5%; font-weight:bolder; padding: 10px;'><h3>Edit Records</h3></div</a>";
                	var counter=0;

                	while(counter<obj.user.length){
                    table+="<tr><td>"+obj.user[counter].Customer_ID+"</td><td>"+obj.user[counter].name+"</td><td>"+obj.user[counter].location+"</td><td><a href=tel:"+obj.user[counter].phonenumber+">" +obj.user[counter].phonenumber+"</td><td>"+obj.user[counter].food+"</td><td>"+obj.user[counter].Delivery_Time+"</td></tr>";

                      counter++;  
                } 
                table+="</table>";             
                	document.getElementById("ViewTable").innerHTML=table;
                	document.getElementById("EditNote").innerHTML=EditNote;
                	var theTable = document.getElementById('ViewPoolTable');
         		if (theTable != null) {
        		  for (var i = 1; i < theTable.rows.length; i++) { 
         		     for (var j = 0; j < 8; j++){
              	     if(theTable.rows[i].cells[j]==theTable.rows[i].cells[0]){
                	    theTable.rows[i].cells[j].onclick = function () {UpdatePool(this);};
                	  }else{
                	  }
              	 	}
            	 }
        	 }
          }
     }
    function RetrievedData(){
          		var url="ResturantServerScript.php?cmd=2";
          		var obj=$.ajax(url, {async:true,complete:RetrievedDataComplete});
          }
    function DeleteMemberComplete(xhr,status){
        	    if(status!="success"){
        	    alert("error while deleting customer");
        	    return;
                }
                alert(xhr.responseText);    
                resetTimeout();            
    }
    function DeleteMember(Customer_ID){
          		var url="ResturantServerScript.php?cmd=5&Customer_ID="+Customer_ID;
          		var obj=$.ajax(url, {async:true,complete:DeleteMemberComplete});
    }
    function UpdatePoolComplete(xhr, status){
           		if(status!="success"){
        	    return alert("error while updating pool");
                }
                alert(xhr.responseText);
                resetTimeout();
    }
    function UpdatePool(customer_ID,name,location,contact,food,delivery_Time){
    	alert(customer_ID.innerHTML,name.innerHTML,location.innerHTML,contact.innerHTML,food.innerHTML,delivery_Time.innerHTML);
           		alert(poolID,poolname,departure,destination,PoolCharges);
           		var url="createPool.php?cmd=7&poolid="+poolID+"&poolname="+poolname+"&departure="+departure+"&destination="+destination+"&pay="+PoolCharges+"&password="+hashCode(pass);
         		    var obj=$.ajax(url, {async:true,complete:UpdatePoolComplete});
         		    alert(url);
    }
    function SendMessageComplete(xhr,status){
              if(status!="success"){
              return alert("error while sending message");
                }
                alert(xhr.responseText);  
                resetTimeout();              
    }
    function SendMessage(phonenumber,sender,message){
            if((phonenumber=="") || (sender=="")){
            return window.alert("Fill the empty field(s)");
    		}
            phonenumber = phonenumber.replace(/;/g, '&to=');
              var url="home.php?cmd=1&to="+phonenumber+"&from="+sender+"&text="+message;
              var obj=$.ajax(url, {async:true,complete:SendMessageComplete});
   }
   function Edit(obj){
   			var table="<table><th>CustomerID</th><th>name</th><th>location</th><th>Contact</th><th>food</th><th>Delivery_Time</th><th>Delete</th><th>Save</th>";
   			var counter=0;

                	while(counter<obj.user.length){
                    table+="<tr><td id='id'>"+obj.user[counter].Customer_ID+"</td><td id='name' contenteditable='true'>"+obj.user[counter].name+"</td><td id='location' contenteditable='true'>"+obj.user[counter].location+"</td><td id='phone'><a href=tel:"+obj.user[counter].phonenumber+">" +obj.user[counter].phonenumber+"</td><td id='food' contenteditable='true'>"+obj.user[counter].food+"</td><td id='date' contenteditable='true'>"+obj.user[counter].Delivery_Time+"</td><td><button style='background:none';'border:none;' onClick=DeleteMember("+obj.user[counter].Customer_ID+")"+"/button>"+"Delete"+"</td><td><button style='background:none';'border:none;' onClick=DeleteMember("+obj.user[counter].Customer_ID+")"+"/button>"+"Save"+"</td></tr>";

                      counter++;  
                } 
                table+="</table>";             
                document.getElementById("EditTable").innerHTML=table;
    }
    function contacts(){
 			document.addEventListener("deviceready", init, false);
    }
    function init() {
  			navigator.contacts.find([navigator.contacts.fieldType.displayName],gotContacts,errorHandler);
	}
	function errorHandler(e) {
 			console.log("errorHandler: "+e);
	}
	function gotContacts(c) {
 			console.log("gotContacts, number of results "+c.length);
 			mobileDiv = document.querySelector("#mobile");

 			/* Retriving phoneNumbers */
 			for(var i=0, len=c.length; i<len; i++) {
 			if(c[i].phoneNumbers && c[i].phoneNumbers.length > 0) {
 			mobileDiv.innerHTML += "<p>"+c[i].displayName+"<br/>"+c[i].phoneNumbers[0].value+"</p>";
 			}
 		}
	}
     </script>

		<style>
			.ui-selectmenu.ui-popup .ui-input-search {
				margin-left: .5em;
				margin-right: .5em;
			}
			.ui-selectmenu.ui-dialog .ui-content {
				padding-top: 0;
			}
			.ui-selectmenu.ui-dialog .ui-selectmenu-list {
				margin-top: 0;
			}
			.ui-selectmenu.ui-popup .ui-selectmenu-list li.ui-first-child .ui-btn {
				border-top-width: 1px;
				-webkit-border-radius: 0;
				border-radius: 0;
			}
			.ui-selectmenu.ui-dialog .ui-header {
				border-bottom-width: 1px;
			}
			a {
				text-decoration: none;
			}
		</style>

		</head>
		<body>
			<div data-role="page" id="ViewPool" style="font-size: 18px">
			<div data-role="header" style="text-shadow: none;">
				<h1>You are login as <?php echo  $_SESSION['username']; ?></h1>
				<a href="logout.php" data-role="button" data-icon="power" data-iconpos="notext" style="background: white;border: none;">Back</a>
			</div><!-- /header -->
			<div data-role="content" style="text-shadow: none;background: linear-gradient(to bottom, rgba(146, 135, 187, 0.8) 0%, rgba(0, 0, 0, 0.6) 100%);">
			<input type="submit" name="submit" onclick="return RetrievedData()" value="Click to View Orders" data-transition="flow" style="background: green;color:black; text-align:center; font-weight:bolder; padding: 10px;">
			<div style="overflow-x:auto;"><table align="center" id="ViewTable"></table></div>
			<p id='EditNote' style="margin-left:3%; margin-top: 2%;"></p>

			<form method = "POST" action="">
          	<center><h3 style="margin-top: 5%;">Send Notifications to Customers</h3></center>
          	<input style="background-color: #E5E7E9" type="Submit" value="Contacts List" onclick="contacts()">
 			<div id="mobile"></div>
          	<p>
          	<label><b>To</b></label>
          	<input type="text" id="number" name="number" placeholder="number">
          	</p>
          	<p>
          	<label><b>Sender</b></label> 
          	<input type="text" id="sender" name="sender" placeholder="sender">
          	</p>
           <p>
           <label for="b"><b>Message</b></label>
            <textarea rows="4" cols="50" id="message" name="message" placeholder="message"></textarea><br>
               <input style="background-color: #E5E7E9" type="Submit" value="Send Message" onclick="SendMessage(number.value,sender.value,message.value)">
           </p> 
      		</form>
		</div><!-- /content -->
	</div><!-- /page -->

	<div data-role="page" id="edit">
			<div data-role="header" style="text-shadow: none;">
				<h1>Edit Records</h1>
				<a href="AdminResturant.php" data-role="button" data-icon="back" data-iconpos="notext" style="background: white;border: none;">Back</a>
			</div><!-- /header -->
			<div data-role="content" style="text-shadow: none;background: linear-gradient(to bottom, rgba(146, 135, 187, 0.8) 0%, rgba(0, 0, 0, 0.6) 100%);">
			<div style="overflow-x:auto;"><table align="center" id="EditTable"></table></div>
			</div><!-- /content -->
		</div><!-- /page -->
 </body>
</html>