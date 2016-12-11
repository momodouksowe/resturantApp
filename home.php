<?php 
if(!isset($_REQUEST['cmd'])){
		echo "cmd is not provided";
		exit();
	}
$cmd=$_REQUEST['cmd'];
	switch($cmd){
		case 1:
		Send();
		break;
	}
function Send(){
if(!isset($_REQUEST["to"])){
  // echo "Number is not given";   
  exit();
}
$to=$_REQUEST['to'];

if(isset($_REQUEST['from'])){
$from=$_REQUEST['from'];
}
  
if(isset($_REQUEST['text'])){
$text=$_REQUEST['text'];
}
// echo '$url';
$url = "http://52.89.116.249:13013/cgi-bin/sendsms?username=mobileapp&password=foobar&to=$to&from=$from&text=$text";
// echo $url;

$ch = curl_init($url);
// session_write_close();
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);
curl_exec($ch);
session_write_close();
// echo("1 message succesfully sent!");

curl_close($ch);
}
?>