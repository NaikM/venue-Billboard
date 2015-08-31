<?php
	system("whoami", $retval) or die("Unable to identify");
	//shell_exec("gksudo nautilus/") or die("Unable 0");
	//shell_exec("sudo import -window root /opt/lampp/htdocs/picta5.png") or die("Unable 1");
	//echo $retval." I see ";
	//$contents = file_get_contents('/opt/lampp/htdocs/hello_world.sh') or die("Unable 1");
	//echo shell_exec($contents) or die("Unable 2");
	//exec("/usr/bin/hello_world.sh") or die("Unable 3");
	//exec("scrot -b '%Y:%m:%d:%H:%M:%S.png' -e 'mv $f ~/Desktop/'") or die("Unable");
	exec("scrot Momo.png") or die("Unable");
?>
