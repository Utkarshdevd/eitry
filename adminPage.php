<?php
	session_start();
	if(isset($_POST['submits'])){
		$con=mysqli_connect("localhost","root","qwerty","eilabtry");
		$filename = $_POST['filename'];
		if (mysqli_connect_error()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br/>";
			mysqli_close($con);
		}
		$sql = "INSERT INTO Filesdata (filename, filestatus) VALUES ('{$filename}','P')";
		// Execute query
		if (mysqli_query($con,$sql)) {
			echo "Data inserted successfully <br/>";
		} 
		else {
			echo "Error inserting data: " . mysqli_error($con);
		}
		mysqli_close($con);
	}
?>

<html>
	<body>
		<fieldset style="width:30%;">
			<form method="POST">
				File Name: <input type="text" name="filename"><br>
				<input id="button" type="submit" name="submits" value="Log-In">
			</form> 
		</fieldset>
	</body>
</html>