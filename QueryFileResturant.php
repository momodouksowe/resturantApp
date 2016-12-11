<?php
     include_once("DBConn.php");
     
     class QueryFileResturant extends DBConn{
     	        function QueryFileResturant(){}
    	
     	        function PlaceOrder($yourname,$phonenumber,$location,$food,$date){
     		                     $strQuery="INSERT INTO resturant set phonenumber='$phonenumber', location='$location', food='$food', name='$yourname',Delivery_Time='$date'";
     		                       return $this->query($strQuery);
     	        }
     	        // function RetrievedPools(){
     		       //                $strQuery="SELECT COUNT(`Member_ID`) as state, joinpool.Pool_ID, createpool.Pool_Name,createpool.Pool_Owner_Firstname,createpool.Destination, createpool.Owner_Phone_Number, createpool.Departure, createpool.Owner_Location,createpool.Pool_Charges FROM `joinpool` INNER JOIN `createpool` ON (createpool.Pool_ID=joinpool.Pool_ID) GROUP BY joinpool.Pool_ID";
              //                       // $strQuery="SELECT
              //                       //               `Pool_ID`,
              //                       //               `Pool_Name`,
              //                       //               `Departure`,
              //                       //               `Destination`,
              //                       //               `Owner_Phone_Number`,
              //                       //               `Owner_Location`,
              //                       //               `Pool_Charges`,
              //                       //               `Pool_Owner_Firstname`,
              //                       //               (
              //                       //               SELECT COUNT(`Member_ID`)
              //                       //               FROM `joinpool`
              //                       //               INNER JOIN `createpool`
              //                       //               ON (joinpool.Pool_ID= createpool.Pool_ID) GROUP BY `joinpool.Pool_ID`
              //                       //               ) as state
              //                       //               FROM
              //                       //               `createpool`";

     		       //                 return $this->query($strQuery);
     	        // }
     	        // function JoinPool($poolid,$yourname,$phonenumber,$location,$pay){
     		       //               $strQuery="INSERT INTO joinpool set Member_Contact='$phonenumber', Member_Location='$location', Mode_Of_Pay='$pay', Member_Name='$yourname', Pool_ID='$poolid'";
     		       //                 return $this->query($strQuery);
     	        // }
     	        function ViewOrders(){
     		                     $strQuery="SELECT `Customer_ID`,`name`, `location`, `Delivery_Time`, `phonenumber`, `food` FROM `resturant` GROUP BY `name`";
     		                       return $this->query($strQuery);
     	        }
                function DeleteMember($Customer_ID){
                                $strQuery="DELETE FROM resturant where Customer_ID= '$Customer_ID'";
                                      return $this->query($strQuery);
                  }

              //     function EditPool($poolid,$password){
              //                       $strQuery="SELECT createpool.Pool_ID,`Pool_Name`, `Departure`, `Destination`,  `Pool_Charges` FROM `createpool` INNER JOIN joinpool ON (createpool.Pool_ID= '$poolid' and createpool.Password='$password')GROUP BY joinpool.Pool_ID";
              //                         return $this->query($strQuery);
              //     }
              //     function UpdatePool($poolid,$poolname,$destination,$departure,$pay,$password){
              //                       $strQuery="UPDATE `createpool` SET `Pool_Name`='$poolname',`Departure`='$departure',`Destination`='$destination',`Pool_Charges`='$pay' WHERE (`Password`='$password' AND `Pool_ID` = '$poolid')";
              //                         return $this->query($strQuery);

                                      
              //     }
      }

?>