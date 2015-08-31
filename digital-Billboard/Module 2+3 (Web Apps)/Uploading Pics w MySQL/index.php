<!-- Experimenting with MySQL 
Outputs the name and email back after it is entered into SQL database from the form -->

<html>
	<head></head> <!--No title-->

	<body>
		<?php
			//connect to server MySQL
			$link = mysqli_connect('localhost', 'root', '');
			if(!$link)
			{
				$error = "Error: Link could not be established.";
				include error.html.php;
				exit();
			}
			//set encoding
			if(!mysqli_set_charset($link, 'utf8'))
			{
				$error = "Error: Encoding could not be set.";
				include error.html.php;
				exit();
			}
			//set the corrcet database
			if(!mysqli_select_db($link, 'Snaps'))
			{
				$error = "Error: Database could not be selected.";
				include error.html.php;
				exit();
			}

			$nameErr = "";
			$name = "";
			$email = "";
			

			if($_SERVER["REQUEST_METHOD"]=="POST")		
			{
				if(empty($_POST["name"]))
				{
					$nameErr = 'You must submit a name';
					include 'getPic.html.php';
					exit();
				}
				$name = test_input($_POST["name"]);
				$email = test_input($_POST["email"]);
			}

			//strip and nullify any special characters from the input
			function test_input($data)
			{
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
	
			include 'getPic.html.php';

		?>

			Welcome <?php echo $name; ?><br>
			Your email address is: <?php echo $email; ?>	
			
	</body>
</html>
