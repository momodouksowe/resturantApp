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
  <title>Resturant</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <!-- <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" /> -->
  <!-- <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> -->
  <!-- <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script> -->

    <link rel="stylesheet" href="css/jquery.mobile.structure.css" />
    <link rel="stylesheet" href="css/jquery.mobile.theme.css" />
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <script src="js/jquery-1.12.1.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/jquery.mobile.js"></script>
    
    <script type="text/javascript">
    var xmlhttp;
    window.onload = function(){
              xmlhttp = new XMLHttpRequest(),
              xmlhttp.onreadystatechange = ProcessResult;
    }
     function getLocation(){
          var options={enableHighAccuracy: true,timeout: 5000,MaximumAge: 0};
              navigator.geolocation.getCurrentPosition(success,failure,options)
    }
    function success(position){
          var latitude = position.coords.latitude;
          var long = position.coords.longitude;
          var googleURL = "https://maps.googleapis.com/maps/api/place/nearbysearch/xml?key=AIzaSyC9K-ZURuOZP1WZ_NjWwKvIANlT9yWFi4M&location=";
              googleURL += latitude + ","+long;
              googleURL += "&rankBy=distance&keyword=resturant";
              getResturantList(googleURL);
    }
    function getResturantList(URL){
             xmlhttp.open("GET", URL, true);
             xmlhttp.send();
    }

    function ProcessResult(){
          var out="<ul data-role='listview' data-inset='true' id='restList'>";

      if(xmlhttp.readyState == 4 && xmlhttp.status==200){
          var restaurantXML = $.parseXML(xmlhttp.responseText);
          var xml = $(restaurantXML);
              console.log(xml);
              $(xml).find("result").each(function(){
          var name = $(this).find('name').text();
          var address = $(this).find('vicinity').text();
          var image = $(this).find("image[icon]").attr("href"); 

          var rating = $(this).find('rating').text();
          var open = $(this).find('opening_hours').find('open_now').text();
          var lat = $(this).find('geometry').find('location').find('lat').text();
          var lng = $(this).find('geometry').find('location').find('lng').text();

              out += "<li data-role='list-divider'><a href='#createPool' data-transition='flip'><div style='background: #5D8AA8;color:white; text-align:center; margin-top: 5%; font-weight:bolder; padding: 10px;'><h3>";

              out += name + "</h3></div></a></li>";
              out += "<li>" + address;
              out += "<p>Location: " + lat + "</p>"
              out += "<p>Location: " + lng + "</p>"
              out += "<p>Photo: " + $('#result').append($("<img src=\"" +image+"\"/>")) + "</p>";
          if(rating==''){
              rating='Not Rated!';
            }
              out += "<p>Google Rating: " + rating + "</p>";
          if(open){
              out += "<p class='ul-li-aside'>Open Now!</p>";
            }else{
              out += "<p class='ul-li-aside'>Don't know if it is Open!</p>";
            }
              out += "</li>";
    });

    }
            out+= "</ul";
            document.getElementById('result').innerHTML="<h1>Resturants Near You</h1>";
            document.getElementById('result').innerHTML+=out;
            $("restlist").listview().listview('refresh');
    }
    function failure(message){
            alert("Error:"+ message.message);
    }
    function clearScreen(){
            document.getElementById("result").innerHTML="";
    }
    function Map(location){
            // NewWindow = window.open("map.html", "SalesDetails","resizable,scrollbars,status");
            // NewWindow.document.write("<html><body>");
           var map="<div style='height:500px;width:500px;max-width:100%;list-style:none; transition: none;overflow:hidden;'><div id='display-google-map' style='height:100%; width:100%;max-width:100%;'><iframe style='height:100%;width:100%;border:0;' frameborder='0' src='https://www.google.com/maps/embed/v1/place?q="+location+"&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU'></iframe></div><a class='embed-map-html' rel='nofollow' href='http://www.interserver-coupons.com' id='enable-map-data'>http://www.interserver-coupons.com</a><style>#display-google-map .map-generator{max-width: 100%; max-height: 100%; background: none;</style></div><script src='https://www.interserver-coupons.com/google-maps-authorization.js?id=5cf9e445-fbbf-5422-531c-95b03e0a4f9d&c=embed-map-html&u=1478760918' defer='defer' async='async'>";
          // NewWindow.document.write("</body>");
          // NewWindow.document.write("</html>");
           document.getElementById("map").innerHTML=map;
    }
    function SendMessageComplete(xhr,status){
              if(status!="success"){
              alert("error while sending message");
              return;
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
   function TakeDataComplete(xhr,status){
              if(status!="success"){
                  alert("error while placing order");
              }else{
                return alert(xhr.responseText);
              }
  }
   function TakeData(yourname,phonenumber,location,food,date){ 
             if((yourname.value=="")|| (phonenumber.value=="")|| (location.value=="")|| (food.value=="")|| (date.value=="")){
             return alert("Fill the empty field(s)");
            }
            var url="ResturantServerScript.php?cmd=1&yourname="+yourname.value+"&phonenumber="+phonenumber.value+"&location="+location.value+"&food="+food.value+"&date="+date.value;
            var obj=$.ajax(url, {async:true,complete:TakeDataComplete});   
    }
   
    </script>

      <style type="text/css">
        #container{
          margin: 5px;
        }
        #btnLocation{
          display: none;
        }
        a{
         text-decoration: none;
         color: black;
        }
      </style>
</head>
     <body>
     <div data-role="page" id="landingPage" style="font-size: 18px">

      <div data-role="header" style="text-shadow: none; color: black;">
        <h1 ><?php echo  $_SESSION['username']; ?></h1>
        <a href="Logout.php" data-role="button" data-icon="power" data-iconpos="notext" style="background: white;border: none;">Logout</a>
      </div><!-- /header -->

      <div data-role="content" style="text-shadow: none; background: linear-gradient(to bottom, rgba(146, 135, 187, 0.8) 0%, rgba(0, 0, 0, 0.6) 100%);">
      <center><img src ='http://www.adweek.com/files/2016_Jun/burger-bite.gif'/></center>
      <div id= "container">
      <button id = "btnGetLocation" onclick="getLocation()"> Find A Resturant Near You</button>
      <button id = "btnClear" onclick="clearScreen()"> Clear</button>
      <div id = "result"></div>
      </div><!-- container -->
      </div><!-- /content -->
   </div><!--/page-->
   <div data-role="page" id="createPool" style="font-size: 18px">
      <div data-role="header" style="text-shadow: none;">
        <h2>Find A Resturant Near You</h2>
        <a href="resturant.php" data-role="button" data-icon="back" data-iconpos="notext" style="background: white;border: none;">Back</a>
      </div><!-- /header -->

      <div data-role="content" style="text-shadow: none;background: linear-gradient(to bottom, rgba(146, 135, 187, 0.8) 0%, rgba(0, 0, 0, 0.6) 100%);">
            <input type="submit" name="submit" onclick="Map('The Oriental Guest House and La Fete Restaurant')" value="Find Nearerst Resturant" style="background: #eb4141">
            <a href='#placeOrder' style="color: white">Place Order</a>
            <div style="overflow-x:auto;"><p id="map"></p></div>
      </div><!-- /content -->
  </div><!-- /page -->

  <div data-role="page" id="placeOrder" style="font-size: 18px">
      <div data-role="header" style="text-shadow: none;">
        <h2>Find Resturants Near You</h2>
        <a href="resturant.php" data-role="button" data-icon="back" data-iconpos="notext" style="background: white;border: none;">Back</a>
      </div><!-- /header -->
      <div data-role="content" style="text-shadow: none;background: linear-gradient(to bottom, rgba(146, 135, 187, 0.8) 0%, rgba(0, 0, 0, 0.6) 100%);">
      
      <form method = "POST" action="">
          Your Name<br>
          <input type="text" name="yourname" placeholder="Your name">
          <br>
          Phone Number<br>
          <input type="number" name="phonenumber" placeholder="Phone number">
          <br>
          Your Location<br>
          <input type="text" name="location" placeholder="Your location">
          <br>
          Food<br>
          <input type="text" name="food" placeholder="How much each is going to pay">
          <br>
          Arrival Date/Time<br>
          <input type="datetime-local" name="date" placeholder="date and time">
          <br>
          <input type="submit" name="submit" onclick="TakeData(yourname,phonenumber,location,food,date)" value="Order" style="background: #eb4141">
          <center><h3 style="margin-top: 5%;">Send Notifications to Resturant Owners</h3></center>
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


 </body>
</html>