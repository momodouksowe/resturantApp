<?php
$errors= array();
if(isset($_POST['login'])){
	$username = preg_replace ('/[^A-Za-z]/','',$_POST{'username'});
	$email = $_POST{'email'};
	$password = $_POST{'password'};
	$c_Password = $_POST{'c_password'};

	if(file_exists('users/'.$username.'.xml')){
		$errors[] = 'Username already exist';
	}
	if($email==''){
		$errors[] ='Email is blank';
	}
	if($username==''){
		$errors[] ='Username is blank';
	}
	if($password=='' || $c_Password==''){
		$errors[] = 'Passwords are blank';
	}
	if($password!=$c_Password){
		$errors[] = 'Passwords do not match';
	}
	if(count($errors)==0){
		$xml = new SimpleXMLElement ('<user></user>');
		$xml->addChild('password', $password);
		$xml->addChild('email',$email);
		$xml->asXML('users/'.$username.'.xml');
		header('Location: Login.php');
		die;
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<meta charset="utf-8">
        <title>Register</title>
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
		<?php
		if(count($errors)>0){
			foreach ($errors as $error) {
			echo "<script type='text/javascript'>alert('$error');</script>";
			}
			
		}
		?>
		<h2>REGISTER TO <span class="red"><strong>CREATE A POOL</strong></span></h2>
		<label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Choose a username...">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" placeholder="Enter your email...">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Choose a password...">
        <label for="password">Confirm Password</label>
        <input type="password" id="password" name="c_password" placeholder="Confirm password...">
        <button type="submit" name="login" >REGISTER</button>             
	</form>
	</div>
  </div>
 </div>
</body>
</html>