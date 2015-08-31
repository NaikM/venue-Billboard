<?php
	shell_exec("rm /run/shm/*.avi"); //gets rid of saved videos before the script starts
	
	//allows the program to run 'service motion start' from the php script.
	//keystroke control+2 is connected to "service motion start" via xbindkeys program
	shell_exec("xdotool key control+2"); 
						
	
	//open the webpage to view the video
	$ipaddr = "http://".shell_exec("hostname -I | xargs echo -n &");
	$ipaddr = $ipaddr.":8081/";
	shell_exec("xdg-open $ipaddr &");

	//wait for video files to exist in the directory
	$dir = "/run/shm/";
	while(count(scandir($dir)) == 0);
	
	//use index to keep track of which video file to send to the server
	$index = 1;
	
	//keep doing sending files as long as the motion software is running
	while(shell_exec("ps cax | grep motion &") != NULL)
	{
		sleep(50);//we want to send the video files once they are complete. Each video file is 45 seconds long and thus take 45 seconds to
			  //fully save

		echo $filename = "/run/shm/0".$index.".avi";
		
		//sending video file to the server
		shell_exec("curl -F file=@$filename http://snapclipper.app/upload &");
		
		$index++;
	}
	
	//NOTE: to stop motion from the keyboard, press Ctrl+1, or type 'service motion stop' into the terminal 

?>
		