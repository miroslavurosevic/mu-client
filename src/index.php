<?php 
    if(!isset($_COOKIE['token'])){
        header("Location: login.php");
    }
?>
<html>
	<head>
		<title>Lamia Task Client</title>
		<link rel="stylesheet" type="text/css" href="/styles/style.css"/>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>

	<body>
    	<div class="query_container">
    		<form class="query" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
    			<label class="query_label">Get movie</label>
    			<label for="title">Title</label>
    			<input type="text" name="title">
    			<label for="year">Year</label>
    			<input type="text" name="year">
    			<label for="plotType">Plot</label>
    			<select name="plotType">
    				<option value selected>Short</option>
    				<option value="full">Full</option>
    			</select>
    			<input type="submit" name="getMovie" value="Get">
    		</form>
    				
    		<form class="query" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
    			<label class="query_label">Get book</label>
    			<label for="isbn">ISBN</label>
    			<input type="text" name="isbn">
    			<input type="submit" name="getBook" value="Get">
    		</form>
    		
    		<form class="logout" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
    			<input class="logout_button" type="submit" name="logout" value="Log out">
    		</form>
    	</div>
		<?php include 'getData.php' ?>
	</body>

</html>