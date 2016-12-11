<?php
if(!isset($_REQUEST['cmd'])){
	echo "cmd button is not press";
  	exit();
  }
  /*get command*/
  $cmd=$_REQUEST['cmd'];
  switch($cmd){
  	case 1:
  		Order();		
  		break;
  	case 2:
  		ViewOrders();
  		break;
  	// case 3:
  	// 	RetrievedPools();
  	// 	break;
  	// case 4:
  	// 	JoinPool();
  	// 	break;
    case 5:
      DeleteMember();
      break;
   //  case 6:
   //    EditPool();
   //    break;
   //  case 7:
   //    UpdatePool();
   //    break;


  }
	
function Order(){
  	include_once("QueryFileResturant.php");

 	  // $poolname=$_REQUEST['poolname'];
  	$yourname=$_REQUEST['yourname'];
  	$phonenumber=$_REQUEST['phonenumber'];
  	$location=$_REQUEST['location'];
  	$food=$_REQUEST['food'];
  	$date=$_REQUEST['date'];
  	// $destination=$_REQUEST['destination'];
    // $password=$_REQUEST['password'];

	$obj = new QueryFileResturant();
	if($obj->PlaceOrder($yourname,$phonenumber,$location,$food,$date)){
	echo 'Order Sent!';
	}else{
	echo 'Fail to Send Order!';
	}
}
function ViewOrders(){
  	include_once("QueryFileResturant.php");
    // $password=$_REQUEST['password'];
	  $obj = new QueryFileResturant();

	if($obj->ViewOrders()){
		$row = $obj->fetch();
	    $result=array();
   		while($row!=false){
   			$result[]=$row;
   			$row=$obj->fetch();
   		}
   		echo'{"result":1,"user":';
   		echo json_encode($result);
   		echo '}';
	}else{
   		echo'{"result":0,"message":"Order(s) cannot be retrieved"}';
   	}
	
}
// function RetrievedPools(){
//   	include_once("QueryFile.php");
// 	$obj = new QueryFile();

// 	if($obj->RetrievedPools()){
// 		$row = $obj->fetch();
// 	    $result=array();
//    		while($row!=false){
//    			$result[]=$row;
//    			$row=$obj->fetch();
//    		}
//    		echo'{"result":1,"user":';
//    		echo json_encode($result);
//    		echo '}';
// 	}
// 	else{
//    		echo'{"result":0,"message":"Pool(s) cannot be retrieved"}';
//    	}
	
// }
// function JoinPool(){
//   	include_once("QueryFile.php");
// 	$obj = new QueryFile();

// 	$poolid=$_REQUEST['poolid'];
//   	$yourname=$_REQUEST['yourname'];
//   	$phonenumber=$_REQUEST['phonenumber'];
//   	$location=$_REQUEST['location'];
//   	$pay=$_REQUEST['pay'];

//   	$obj = new QueryFile();
// 	if($obj->JoinPool($poolid,$yourname,$phonenumber,$location,$pay)){
// 	echo 'Pool joined!';
// 	}else{
// 	echo 'Fail to join pool';
// 	}
	
// }
function DeleteMember(){
    include_once("QueryFileResturant.php");
  $obj = new QueryFileResturant();
    $Customer_ID=$_REQUEST['Customer_ID'];
    $obj = new QueryFileResturant();
  if($obj->DeleteMember($Customer_ID)){
  echo 'Customer Deleted!';
  }else{
  echo 'Fail to delete Customer';
  }
  
}
// function EditPool(){
//     include_once("QueryFile.php");
//   $obj = new QueryFile();

//     $poolid=$_REQUEST['poolid'];
//     // $yourname=$_REQUEST['yourname'];
//     // $phonenumber=$_REQUEST['phonenumber'];
//     // $location=$_REQUEST['location'];
//     // $pay=$_REQUEST['pay'];
//     $password=$_REQUEST['password'];


//     $obj = new QueryFile();
//   if($obj->EditPool($poolid,$password)){
//     $row = $obj->fetch();
//       $result=array();
//       while($row!=false){
//         $result[]=$row;
//         $row=$obj->fetch();
//       }
//       echo'{"result":1,"user":';
//       echo json_encode($result);
//       echo '}';
//   }
//   else{
//       echo'{"result":0,"message":"Pool(s) cannot be retrieved"}';
//     }
  
// }
// function UpdatePool(){
//     include_once("QueryFile.php");
//   $obj = new QueryFile();

//     $poolid=$_REQUEST['poolid'];
//     $poolname=$_REQUEST['poolname'];
//     $destination=$_REQUEST['destination'];
//     $departure=$_REQUEST['departure'];
//     $pay=$_REQUEST['pay'];
//     $password=$_REQUEST['password'];


//     $obj = new QueryFile();
//   if($obj->UpdatePool($poolid,$poolname,$destination,$departure,$pay,$password)){
//   echo 'Pool Updated!';
//   }else{
//   echo 'Fail to update pool';
//   }
  
// }
?>