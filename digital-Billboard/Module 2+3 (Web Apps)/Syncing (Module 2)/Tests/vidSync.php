//Tests out timer functions of PHP in order to 
//sync video playing on webpage (webpage video) with video playing on desktop (desktop video)

<?php

	//play the video on the desktop
	exec("cd /opt/lampp/htdocs/WEB/");
	exec("xdg-open bunny.webm");
	
	//get the start time of playing the desktop video
	$time_start = microtime();
	
	//get the duration of the video
	$movie = new ffmpeg_movie("bunny.mpeg");
	$duration = $movie->getDuration();

	while(null){
		//find the time difference between desktop ($time_start) and webpage ($time_end) video
		$time_end = microtime();			
		$lapse = $time_end - $time_start;
		
		//determine at which point the webpage video needs to start by 
		//finding remainder from time elapsed divided by video duration
		$play = $lapse%$duration;
	}
	
?>
