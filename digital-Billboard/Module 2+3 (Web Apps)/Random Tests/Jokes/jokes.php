<?php
	if(get_magic_quotes_gpc())
	{
		function stripslashes_deep($value)
		{
			$value = is_array($value) ?
				array_map('stripslashes_deep', $value):
				stripslashes($value);
			
			return $value;
		}
		
		$_POST = array_map('stripslashes_deep', $_POST);
		$_GET = array_map('stripslashes_deep', $_GET);
		$_COOKIE = array_map('stripslashes_deep', $_COOKIE);
		$_REQUEST = array_map('stripslashes_deep', $_REQUEST);
	}
	//<p><a href="?addjoke">Add your own joke</a></p>
	//<p>Here are all the jokes in the database:</p>
	
	if(isset($_GET['addjoke']))
	{
		include 'form.html.php';
		exit();
	}
	
	$link = mysqli_connect('localhost', 'root', '');
	mysqli_set_charset($link, 'utf8');
	mysqli_select_db($link, 'ijdb');
	
	if(isset($_GET['deletejoke']))
	{
		$id = mysqli_real_escape_string($link, $_POST['id']);
		$sql = "DELETE FROM joke WHERE id='$id'";
		
		if(!mysqli_query($link, $sql))
		{
					exit();
		}
		
		header('Location: .');
		exit();
	}
	
	//store a query safe version of the contents of $_POST['joketext']
	
	//Adding a joke to the database
	if(isset($_POST['joketext']))
	{
		$joketext = mysqli_real_escape_string($link, $_POST['joketext']);
		$sql = 'INSERT INTO joke SET
			joketext="' .$joketext. '",
			jokedate=CURDATE()';
			
		if(!mysqli_query($link, $sql))
		{
			$error = 'Error adding submitted joke: '.mysqli_error($link);
			exit();
		}
		
		header('Location: .');
		exit();
	}
	
	/*
	//Deleting a joke from the database
	if(isset($_POST['id']))
	{
		$identifier = mysqli_real_escape_string($link, $_POST['id']);
		//echo $identifier;
		
		$find='SELECT FROM joke WHERE id=$identifier';
		//echo mysqli_query($link, $find);
		
		$sql = 'DELETE FROM joke WHERE
			id=$identifier';
	*/	
		
	/*	
		if(!mysqli_query($link, $sql))
		{
			$error = 'Error deleting joke: '.mysqli_error($link);
			exit();
		}
		
		header('Location: .');
		exit();
	}
	*/
	
	$result = mysqli_query($link, 'SELECT id, joketext FROM joke');
	
	if(!$result)
	{
		$error = 'Error fetching jokes: '.mysqli_error($link);
		exit();
	}
	
	//creating a 2D array
	while($row = mysqli_fetch_array($result))
	{
		$jokes[] = array('id' => $row['id'], 'text' => $row['joketext']);
	}
	
	/*
	while($row = mysqli_fetch_array($result))
	{
		$jokes[] = $row['joketext'];
	}
	*/
	
	include 'joke.html.php';
	
?>

