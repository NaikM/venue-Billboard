<?php
	$dir = "/home/pi/pics";
	while(count(scandir($dir)) <=2);		//a directory is officially empty if it has 2 or fewer files
											//this is because empty directories can have hidden files

	$index = 1;
	
	while(true)
		{
			//save the files to send in an array
			$files = array();				
	
			for($byTen = 0; $byTen < 10; $byTen++){
		 	
				//change the filename according to its index
				$filename = "/home/pi/pics/".$index.".jpeg";
				if($index < 100)
					$filename = "/home/pi/pics/0".$index.".jpeg";
				if($index < 10)
					$filename = "/home/pi/pics/00".$index.".jpeg";
	
				$index++;
			
			//pause until the video file has been made and exists in the directory
			while(file_exists($filename)!=true);
				array_push($files, $filename);
				//$files[$byTen => $filename);
			}
	
			//send an array of ten files to the cloud server
			shell_exec("curl -F file=@$files[0] http://snapclipper.app/upload &");
			shell_exec("curl -F file=@$files[1] http://snapclipper.app/upload &");
			shell_exec("curl -F file=@$files[2] http://snapclipper.app/upload &");
			shell_exec("curl -F file=@$files[3] http://snapclipper.app/upload &");
			shell_exec("curl -F file=@$files[4] http://snapclipper.app/upload &");
			shell_exec("curl -F file=@$files[5] http://snapclipper.app/upload &");
			shell_exec("curl -F file=@$files[6] http://snapclipper.app/upload &");
			shell_exec("curl -F file=@$files[7] http://snapclipper.app/upload &");
			shell_exec("curl -F file=@$files[8] http://snapclipper.app/upload &");
			shell_exec("curl -F file=@$files[9] http://snapclipper.app/upload &");
	
}
?>