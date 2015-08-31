<?php
	$dir = "/run/shm/";
	shell_exec("service motion start");
	while(count(scandir($dir)) == 0);			//while there are no files in directory
	
	$index = 1;
	
	while(true)
	{
		$files = glob("/run/shm/*.avi");		//save the video files in /run/shm to an array
		rsort($files);							//sort the array in descending order
		echo $files[0];
		
		$filename = "/run/shm/0".$index.".avi";									//set up the name of the latest video file (highest index)
		shell_exec("curl -F file=@$files[0] http://snapclipper.app/upload");	//send the video file to the cloud server
		//shell_exec("curl -F file=@$filename http://snapclipper.app/upload")
		
		shell_exec("omxplayer --orientation 90 $files[0]");						//play the video	
		//shell_exec("omxplayer --orientation 90 $filename");
	}
	shell_exec("service motion stop");
?>
		