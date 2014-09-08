<?php
	session_start();
	if(isset($_POST['submits'])){
		$con=mysqli_connect("localhost","root","qwerty","eilabtry");
		$filename = $_POST['filename'];
		if (mysqli_connect_error()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br/>";
			mysqli_close($con);
		}
		$sql = "INSERT INTO Filesdata (filename, filestatus, currentPos) VALUES ('{$filename}','P','origin')";
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
				File Name: <input type="text" name="filename"><br>
				<input id="button" type="submit" name="submits" value="Create File">
			</form> 
		</fieldset>
	</body>
</html>