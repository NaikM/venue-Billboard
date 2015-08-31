<!-- failed attempt to capture frame and display snapshot using pause() PHP function -->

<!DOCTYPE html>
<html>
	<body>
	<h2>billboard.com</h2>
		<!-- sets up form w/ buttons to capture a snapshot and view existing snapshots -->
		<form action="index.php" method="post" enctype="multipart/form-data">
			<input type="string" name="path">
			<input type="submit" name="Snap" value="Snapshot">
			<input type="submit" name="View" value="View">
		</form>
	<video width = "500" height = "500" controls>
		<source src="bunny.webm" type="video/webm">
	Not supported
	</video>
	
	<script>
	var vid = document.getElementById("bunny.webm"); 
	</script>
	</body>

	<?php
		if(isset($_POST["Snap"]))
		echo "<script>vid.pause();</script>"	//attempts to display the paused state of the video as a snapshot (DOES NOT WORK)
	?>
</html>




