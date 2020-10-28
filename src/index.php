<html>
	<head>
		<title>Lamia Task Client</title>
	</head>

	<body>
	<div>
		<h2>Get movie</h2>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
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
		
		<h2>Get book</h2>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
			<label for="isbn">ISBN</label>
			<input type="text" name="isbn">
			<input type="submit" name="getBook" value="Get">
		</form>
		
		<?php 
		if($_SERVER["REQUEST_METHOD"]=="POST"){
		    if(isset($_POST['getMovie'])){
		        echo '<h1>Movie info: '.$_POST['title'].'</h1>';
		        $query = http_build_query(array('title'=>$_POST['title'],'year'=>$_POST['year'],'plotType'=>$_POST['plotType']));
		        $ch = curl_init("mu-rest-server.herokuapp.com/getMovie?".$query);
		        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		        $response = curl_exec($ch);
		        curl_close($ch);
		        echo $response;
		    } elseif (isset($_POST['getBook'])){
		        echo '<h1>Book info: '.$_POST['title'].'</h1>';
		        $ch = curl_init("mu-rest-server.herokuapp.com/getBook?isbn=".$_POST['isbn']);
		        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		        $response = curl_exec($ch);
		        curl_close($ch);
		        echo $response;
		    }	        
		}
		?>
	</body>

</html>