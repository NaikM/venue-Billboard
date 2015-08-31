<!-- attempts to play webpage video and desktop video synchronously and capturing snapshot -->
<!DOCTYPE html>
<html>
	<link type = "text/css" rel = "stylesheet" href = "stylesheet.css" />
	<body>

	<h1>billboard.com</h1>

	<button id="button" onclick="getCurTime()" type="button">Snapshot</button>
	<?php 
		$video = new ffmpeg_movie("bunny.webm", false);
		$duration = $video->getDuration();
		$time_start = strtotime("06/01/2015 14:53:00");
		$time_end = time();
		$lapse = $time_end - $time_start;				//find time lapse between current time and start of desktop video
		global $play_vid;								
		$play_vid = floor($lapse%$duration); 			//finds the time at which webpage video should play
		echo $play_vid;

	?>
	
	<!-- plays the video automatically at the right point -->
	<video id="myVideo" width = "500" height = "500" autoplay loop onplay="seek()">
		<source src="bunny.webm" type="video/webm" onseeked="play()">	<!-- once start position is seeked, the video should play -->
	Not supported
	</video>
	
	<script>
	
	var vid = document.getElementById("myVideo"); 
	var time = "<?php echo $play_vid; ?>";

		function seek(){
			vid.currentTime = time;						//plays the video from the same point as the desktop video
		}

		function play(){
			vid.play;
		}
		
		//sends the current time to index.php to capture and display the desired snapshot
		function getCurTime(){ 
    			time = (vid.currentTime);
			//window.location.href = "http://localhost/WEB/index.php?time=" + time;
			
			var win = window.open("http://localhost/WEB/index.php?time=" + time, "_blank");
			win.focus();
			getFrame();
		} 

	</script>	
	
	</body>

</html>

