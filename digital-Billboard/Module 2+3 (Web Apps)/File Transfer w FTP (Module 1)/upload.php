<!--Transferring image files via FTP protocal -->

<html>
	<head></head> 

	<body>
		<?php
			
			include 'form.php';

			$link = ftp_connect('localhost') or die("Could not connect to FTP server");
			$FTPUSER = 'daemon';
			$FTPPASS = 'xampp';
			$login = ftp_login($link, $FTPUSER, $FTPPASS) or die ("Could not login to FTP server");

			$file = "/home/bb2/Desktop/cake.jpeg";
			$local_file = "serverfile.jpeg";

			
			
			// upload file
			if(isset($_POST["submit"]))		//if the submit button is pressed
			{
			$file = $_POST["path"];			//capture the path of the uploaded file
			$fp = fopen($file,"r");			//open the file
			if (ftp_fput($link, $local_file, $fp, FTP_ASCII))
			{
				echo "Successfully uploaded $file.";
			}
			else
			{
			  	echo "Error uploading $file.";
			}			
			}
			


			//if(ftp_chmod($link, 0777, $file) != false)
			//	echo "Permission granted";
			//else
			//	echo "Permission not changed"; 

		
			ftp_close($link);
		 ?>		
	</body>
</html>
