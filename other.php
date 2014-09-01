<?php
	session_start();

	$con=mysqli_connect("localhost","root","qwerty","eilabtry");
	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$myusername = $_POST['username'];
	$mypassword = $_POST['password'];
	//echo $myusername.$mypassword."aaa<br/>";
	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
	//echo $myusername.$mypassword."aaa<br/>";
	//$myusername = mysqli_escape_string($myusername);
	//$mypassword = mysqli_escape_string($mypassword);
	//echo $myusername.$mypassword."aaa<br/>";
	$result = mysqli_query($con,"SELECT * FROM Users WHERE username = '{$myusername}' AND password = '{$mypassword}'");
	$row = mysqli_fetch_array($result);
	if(!empty($row['username']) AND !empty($row['password'])){
		$_SESSION['username'] = $row['username'];
		$_SESSION['designation'] = $row['designation'];
		echo $_SESSION['username']."Login Success";
		echo $row['username'] . " " . $row['password']." ".$row['designation'];
		echo "<br>";
		if ($row['designation']=='A'){
			echo "admin";
			header("Location: adminPage.php");
		}
		else if ($row['designation']=='P'){
			echo "peon";
			header("Location: peonPage.php");
		}
		else if ($row['designation']=='O'){
			echo "officer";
			header("Location: officerPage.php");
		}
		mysqli_close($con);
    	exit;
	}
	else{
		echo "Wrong username or password";
	}

	mysqli_close($con);
?> 