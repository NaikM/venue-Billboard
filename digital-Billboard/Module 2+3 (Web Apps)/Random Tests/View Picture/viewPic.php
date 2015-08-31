<!-- Viewing a local picture on the webpage -->
<!DOCTYPE html>
<html>
	<link type = "text/css" rel = "stylesheet" href = "stylesheet.css";
	<head> 
	</head>
	<body>
		
		<h2>billboard.com</h2>
		<form action="index.php" method="post" enctype="multipart/form-data">
			<input type="string" name="path">
			<input type="submit" name="Snap" value="Snapshot">
			<input type="submit" name="View" value="View">
		</form>
		
		<?php
			//echo $time;
			if(isset($_POST["View"])){	
				$path = $_POST["path"];
				echo "<img src='$path' />";
			}
		?>
		
	</body>
</html>



