<html>
	<head></head> <!--No title-->

	<body>
		<?php

			$link = mysqli_connect('localhost', 'root', '');
			if(!$link)
			{
				$error = "Error: Link could not be established.";
				include error.html.php;
				exit();
			}

			if(!mysqli_set_charset($link, 'utf8'))
			{
				$error = "Error: Encoding could not be set.";
				include error.html.php;
				exit();
			}

			if(!mysqli_select_db($link, 'Snaps'))
			{
				$error = "Error: Database could not be selected.";
				include error.html.php;
				exit();
			}

			$target_dir = "uploads/";
			$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
			$uploadOK = 1;

			$imageFileType = pathInfo($target_file, PATHINFO_EXTENSION);

			//check if the image is an actual image or if it is a fake image
			if(isset($_POST["submit"]))
			{
				$dir = pathinfo($_FILES["fileToUpload"]["name"]);
				echo $dir;
				$check = getimagesize($_FILES["fileToUpload"]["name"]);
				if($check != false)
				{
					echo "File is an image -".$check["mime"].". ";
				}
				else
				{
					echo "File is not an image. ";
					$uploadOK = 0;
				}
			}

			//check if file already exists
			if(file_exists($target_file))
			{
				echo "Sorry, this file already exists. ";
				$uploadOK = 0;
			}

			//checking if it is the correct file type
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType 
			   != "jpeg" && $imageFileType != "gif")
			{
				echo "Sorry, your file must be an image file. ";
				$uploadOK = 0;
			}

			if($uploadOK == 0)
				echo "Sorry, your file could not be uploaded.";
			else if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],
				$target_file))
				echo "The file ".basename($_FILES["fileToUpload"]["name"]).
				" has been uploaded.";
			else
				echo "Sorry, there was an error uploading your file.";

			echo $target_file;
			echo $dir;
			
			include 'form.php';
		 ?>		
	</body>
</html>
