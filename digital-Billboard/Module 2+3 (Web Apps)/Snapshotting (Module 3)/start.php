<!DOCTYPE html>
<html>
	<link type = "text/css" rel = "stylesheet" href = "stylesheet.css" />
	<body>

	<h1>billboard.com</h1>

	<button id="button" onclick="getCurTime()" type="button">Snapshot</button>
	<?php 
		$video = new ffmpeg_movie("bunny.webm", false);
		
		//synchronize the webpage video and the desktop video
		$duration = $video->getDuration();
		$time_start = strtotime("06/01/2015 14:53:00");
		$time_end = time();
		$lapse = $time_end - $time_start;
		global $play_vid;
		$play_vid = floor($lapse%$duration); //$play_vid is the time the video webpage video should seek to before playing
		echo $play_vid;

	?>
	

	<video id="myVideo" width = "500" height = "500" autoplay loop onplay="seek()">
		<source src="bunny.webm" type="video/webm" onseeked="play()">
	Not supported
	</video>
	
	<script>
	
	var vid = document.getElementById("myVideo"); 
	var time = "<?php echo $play_vid; ?>";

		function seek(){
			vid.currentTime = time;		//webpage video seeks the correct time to sync with desktop video
		}

		function play(){
			vid.play;					//webpage video plays
		}
		
		function getCurTime(){ 
    		time = (vid.currentTime);		//get the time at which the button was pressed
			
			//send the current time to index.php
			var win = window.open("http://localhost/WEB/save.php?time=" + time, "_blank");		
			win.focus();
			getFrame();
		} 

	</script>	
	
	</body>

</html>

