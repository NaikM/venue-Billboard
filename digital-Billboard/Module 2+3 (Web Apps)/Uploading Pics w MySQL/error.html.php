<!-- Outputs any error messages received from index.php -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"

	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<title>Sign of Success</title>
	</head>
	
	<body>
		<?php if(!empty($error))
			echo $error;
		else;
		?>
	</body>
</html>
