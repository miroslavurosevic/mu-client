<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="/styles/style.css"/>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>
	<body>
    	<form class="login" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
        	<input type="text" name="username" class="login_input" placeholder="Username" required>   		   		
        	<input type="password" name="password" class="login_input" placeholder="Password" required>
    		<input type="submit" name="login" class="login_button" value="Login">
    		<input type="submit" name="signup" class="login_button"value="Sign up">
    		<div><?php include 'authentication.php';?></div>
    	</form>
	</body>
</html>