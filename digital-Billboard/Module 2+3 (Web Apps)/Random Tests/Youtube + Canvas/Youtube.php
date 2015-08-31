<!--attempt to capture a snapshot from a youtube video -->
<!DOCTYPE html>
<html>
	<link type = "text/css" rel = "stylesheet" href = "stylesheet.css" />
	<body>

	<h1>billboard.com</h1>

	<form action="start.php" method="post">
	<input type="submit" name="Snapshot" id="Snap">
	</form>

	<script src="jquery.js"></script>
	<script src="mediaelement-and-player.min.js"></script>
	<link rel="stylesheet" href="mediaelementplayer.css"/>


	<video id="video">
		<source type="video/youtube"  src="https://www.youtube.com/watch?v=T86d5v_h644" />
	</video>

	<?php
		if(isset($_POST["Snap"]))
		{
			//attempt to capture a snapshot from canvas tool
			echo "<script type=\'text/javascript\'>
				var canvas = document.getElementById('video');
				var ctx = canvas.getContext('2d');
				return document.getElementById('video'); 
			</script>";
			
		}
	?>
	</body>

</html>

