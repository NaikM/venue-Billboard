<?php
	$time = $_GET["time"];	//store the time passed in the URL form start.php
	
	//get the frame object from the movie at time = $time
	$movie = new ffmpeg_movie("bunny.webm", false);
	$fps = $movie->getFrameRate();
	$frameNumber = floor($time*$fps);
	$frame = $movie->getFrame($frameNumber);
	
	//convert the frame to an image
	$image = $frame->toGDImage();
	
	//save the images sequentially (starting at filename = 1.jpeg) in a directory 
	$array = glob("*.jpeg");
	$maxint = 1;
	
	//find the "maximum" jpeg filename in a directory
	//for example, if a directory has file 1.jpeg, 2.jpeg, 3.jpeg, then $maxint will be 3
	
	foreach($array as $filename)
	{
		$name = ltrim($filename, "pic");
		$name = rtrim($name, ".jpeg");
		$name = intval($name);
		if($name > $maxint)
			$maxint = $name;
	}
	
	//increase $maxint by 1 to get the current filename
	$name = $maxint+1;
	echo $name;
	
	//save the image as a file in the current directory
	imagejpeg($image, "pic".$name.".jpeg");
	$path = "pic".$name.".jpeg";

	echo "<img src='$path'/>";
	echo "Saved as: ".$path;
?>
