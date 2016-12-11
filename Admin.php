<?php
$error=false;
if(isset($_POST['login'])){
	$username = preg_replace('/[^A-Za-z]/', '', $_POST['username']);
	$password = $_POST['password'];

	if(file_exists('users/'.$username.'.xml')){
		$xml = new SimpleXMLElement('users/'.$username.'.xml',0,true);
		if($password==$xml->password){
			session_start();
			$_SESSION['username']=$username;
			$_SESSION['password']=$password;
			header('Location:AdminResturant.php');
			die;
		}

	}
	$error=true;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<meta charset="utf-8">
        <!-- <title>Fullscreen Responsive Register Template</title> -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="header">
        <div class="register-container container">
            <div class="row">
            	<div class="register span6">
	<form method = "post" action="">
		<h2><span class="red"><strong>Admin Panel</strong></span></h2>
		<label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="username...">
        <!-- <label for="email">Email</label> -->
        <!-- <input type="text" id="email" name="email" placeholder="Enter your email..."> -->
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="password...">
        <!-- <label for="password">Confirm Password</label> -->
        <!-- <input type="password" id="password" name="c_password" placeholder="Confirm password..."> -->
        <?php
		if($error){
			$message = "Invalid username and / or password";
			echo "<script type='text/javascript'>alert('$message');</script>";
			}
		?>
        <button type="submit" name="login" >LOGIN</button>             
	</form>
	</div>
  </div>
 </div>
</body>
</html>