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
			header('Location:resturant.php');
			die;
		}

	}
	$error=true;
}
?>
<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="cont">
  <div class="demo">
    <div class="login">
      <div class="login__check"></div>
      <div class="login__form">
        <div class="login__row">
         <form method = "post" action="">
          <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
          </svg>
          <input type="text" name="username" class="login__input name" placeholder="Username"/>
        </div>
         <div class="login__row">
          <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
          </svg>
          <input type="password" name="password" class="login__input pass" placeholder="Password"/>
        </div>
        <?php
		if($error){
			$message = "Invalid username and / or password";
			echo "<script type='text/javascript'>alert('$message');</script>";
			}
		?>
        <button type="submit" name="login" class="login__submit">Sign in</button>
        <!-- <button type="submit" name="login" class="login__submit">Sign in as Admin</button> -->
        </form>
        <p class="login__signup">Don't have an account? &nbsp;<a href="Register.php">Register</a></p><br>
        <p class="login__signup">Sign in as &nbsp;<a href="Admin.php">Admin</a></p><br>
      </div>
    </div>
</body>
</html>