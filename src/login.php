<!DOCTYPE html>
<html>
	<header>
	
	</header>
	<body>
    	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
    		<label for="username">Username</label>
    		<input type="text" name="username" required>
    		<label for="password">Password</label>
    		<input type="password" name="password" required>
    		<input type="submit" name="login" value="Login">
    		<input type="submit" name="signup" value="Sign up">
    	</form>
	</body>
	<?php include 'authentication.php';	?>
</html>