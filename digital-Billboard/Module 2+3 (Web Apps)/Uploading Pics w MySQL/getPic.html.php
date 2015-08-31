<!-- Experimenting with MySQL 
Requests the user to input their name and email -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"

	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<title>Test Form</title>
	</head>

	<body>
		<form method="post" action="<?php echo 
		htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		
		Name: <input type="text" name="name" 
		value="<?php echo $name;?>">
		<span class="error">* 
		<?php echo $nameErr; ?></span><br><br>

		Email: <input type="text" name="email"
		value="<?php echo $email;?>"> <br>

		<input type="submit" name="Submit">
		</form>

	</body>
	
</html>
