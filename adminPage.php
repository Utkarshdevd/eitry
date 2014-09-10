<?php
	session_start();

//checking if a log SESSION VARIABLE has been set
if( !isset($_SESSION['log']) || ($_SESSION['log'] != 'in') ){
        //if the user is not allowed, display a message and a link to go back to login page
	echo "You are not allowed. <a href='index.html'>back to login page</a>";
        
        //then abort the script
	exit();
}
   ####  CODE FOR LOG OUT #### 
if(isset($_GET['log']) && ($_GET['log']=='out')){
        //if the user logged out, delete any SESSION variables
	session_destroy();
	
        //then redirect to login page
	header('location:index.html');
}//end log out

	if(isset($_POST['submits'])){
		$con=mysqli_connect("localhost","root","qwerty","eilabtry");
		$fileid = $_POST['fileid'];
		$filename = $_POST['filename'];
		$branch = $_POST['branch'];
		$activity = $_POST['activity'];
		$date = $_POST['date'];
		$description = $_POST['description'];
		$contact = $_POST['contact'];

		if (mysqli_connect_error()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br/>";
			mysqli_close($con);
		}
		$sql = "INSERT INTO Filesdata (fileid, filename, filestatus, branch, activity, date_time, description, contact,	currentPos) VALUES ('{$fileid}', '{$filename}','P', '{$branch}', '{$activity}', CURRENT_TIMESTAMP(), '{$description}', '{$contact}', 'origin')";
		// Execute query
		if (mysqli_query($con,$sql)) {
			echo "Data inserted successfully <br/>";
		} 
		else {
			echo "Error inserting data: " . mysqli_error($con);
		}
		$a = $_POST['select'];
		echo $a;
		mysqli_close($con);
	}
?>

<html>
	<head>
		<script type= "text/javascript" src = "multiDropdown.js"></script>
	</head>
	<body>

		<style>
			.outer{
			    width:100%;
				border: none;	
			    /* Firefox */
			    display:-moz-box;
			    -moz-box-pack:center;
			    -moz-box-align:center;

			    /* Safari and Chrome */
			    display:-webkit-box;
			    -webkit-box-pack:center;
			    -webkit-box-align:center;

			    /* W3C */
			    display:box;
			    box-pack:center;
			    box-align:center;
			}
			form{
				color:#A7C942;
			}
		</style>
		<h2 class="outer" style="color: #B7C942;">Admin Logged In</h2>
			<form class="outer" method="POST">
				File ID: <input type="text" name="fileid" autofocus><br>
				File Name: <input type="text" name="filename"><br>
				<!--Stuff to handle branch and activity types-->
				<br/>Select Branch Name:
		        <select id="branch" name="branch"></select>
		        <br />Activity Type:
		        <select id="activity" name="activity"></select>
		        <br />
		        <script language="javascript">
					populateCountries("branch", "activity");
 				</script>
 				<!--Date of Creation: <input id="button" type="date" name="date" placeholder="YYYY-MM-DD"><br/>-->
 				Description: <input id="button" type="text" name="description" placeholder="Enter a description for the file"><br/>
 				Contact No.: <input id="button" type="text" name="contact" placeholder="10-digits"><br/>
				<input id="button" type="submit" name="submits" value="Create File">
			</form>
			<p>{ <a href="?log=out">log out</a> }</p>
	</body>
</html>