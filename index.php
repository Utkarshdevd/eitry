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
		echo "Database $DB_NAME created" . "<br/>";
		$con=mysqli_connect("localhost","root","qwerty",$DB_NAME);
	}
	else{
		echo "Error creating database: " . mysqli_error($con) . "<br/>";
		mysqli_close($con);
	}

	$sql = "CREATE TABLE IF NOT EXISTS Persons 
	(
	PID INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(PID),
	username CHAR(15),
	password CHAR(15)
	)";
	// Execute query
	if (mysqli_query($con,$sql)) {
	  echo "Table persons created successfully";
	} else {
	  echo "Error creating table: " . mysqli_error($con);
	}

	mysqli_close($con);
?>