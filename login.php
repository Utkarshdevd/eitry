<?php
	
	$DB_NAME = "eilabtry";
	
	//$con = mysqli_connect($DB_ADD, $DB_USER, $DB_PASS);
	$con=mysqli_connect("localhost","root","qwerty");
	//Check connection
	if (mysqli_connect_error()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br/>";
		mysqli_close($con);
	}

	//Create Database
	$sql = "CREATE DATABASE IF NOT EXISTS $DB_NAME";
	if (mysqli_query($con,$sql)){
		echo "Database $DB_NAME created <br/>";
		$con=mysqli_connect("localhost","root","qwerty",$DB_NAME);
	}
	else{
		echo "Error creating database: " . mysqli_error($con) . "<br/>";
		mysqli_close($con);
	}

	$sql = "CREATE TABLE IF NOT EXISTS Users 
	(
	PID INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(PID),
	username CHAR(15),
	password CHAR(15)
	)";
	// Execute query
	if (mysqli_query($con,$sql)) {
	  echo "Table Users created successfully <br/>";
	} else {
	  echo "Error creating table: " . mysqli_error($con);
	}
	$sql = "CREATE TABLE IF NOT EXISTS Filesdata
	(
	PID INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(PID),
	filename CHAR(15),
	filestatus CHAR(15),
	currentPos CHAR(15)
	)";
	// Execute query
	if (mysqli_query($con,$sql)) {
	  echo "Table Filesdata created successfully <br/>";
	} else {
	  echo "Error creating table: " . mysqli_error($con);
	}
	
	/*
	$sql = "INSERT INTO Users (username, password) VALUES ('aaa','bbbDE')";
	// Execute query
	if (mysqli_query($con,$sql)) {
	  echo "Data inserted successfully <br/>";
	} else {
	  echo "Error inserting data: " . mysqli_error($con);
	}
	*/
	/*
	$con=mysqli_connect("localhost","root","qwerty","eilabtry");
	if (mysqli_connect_error()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br/>";
		mysqli_close($con);
	}
	
	//echo "in signin <br/>";
	if (!empty($_POST['username'])){
		$myusername=$_POST['username'];
		$mypassword=$_POST['password'];
		// To protect MySQL injection (more detail about MySQL injection)
		//$myusername = stripslashes($myusername);
		//$mypassword = stripslashes($mypassword);
		//$myusername = mysqli_escape_string($myusername);
		//$mypassword = mysqli_escape_string($mypassword);
		echo "user and pass " . $_POST['username']." ".$_POST['password']." <br/>";
		echo "user and pass " . $myusername." ".$mypassword." <br/>";
		$sql = "SELECT *  FROM Users";
		echo $sql."<br/>";
		$query = mysqli_query($con,$sql);
		
		$row = mysqli_fetch_array($query);
		echo (string)$query." -- ".(string)$row['username']."<br/>";
		
		$result = mysqli_query($con,"SELECT * FROM Users");
		while($row = mysqli_fetch_array($result)) {
			echo $row['username'] . " " . $row['password'];
			echo "<br>";
		}
		if(!empty($row['username']) AND !empty($row['password']))
		{
			echo "aaa";
			$_SESSION['username'] = $row['password'];
			echo "SUCCESSFULLY LOGIN TO USER PROFILE PAGE...";
		}
		else
		{
			echo "SORRY... YOU ENTERD WRONG ID AND PASSWORD... PLEASE RETRY...";
		}
	}
	else{
		echo "Bad user or pass" . $_POST['username'].$_POST['password']." <br/>";
	}
	*/
	mysqli_close($con);
?>
