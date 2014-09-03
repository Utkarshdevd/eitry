<?php
	session_start();
	refreshData();
	function refreshData(){
		$con=mysqli_connect("localhost","root","qwerty","eilabtry");
		if (mysqli_connect_error()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br/>";
			mysqli_close($con);
		}
		$sql = "SELECT * FROM Filesdata";
		// Execute query
		$result = mysqli_query($con,$sql);
		echo "<table border='1'><tr>
		<th>Filename</th>
		<th>Status</th>
		<th>Current Pos</th>
		</tr>";

		while($row = mysqli_fetch_array($result)) {
		  echo "<tr>";
		  echo "<td>" . $row['filename'] . "</td>";
		  echo "<td>" . $row['filestatus'] . "</td>";
		  echo "<td>" . $row['currentPos'] . "</td>";
		  echo "</tr>";
		}

		echo "</table>";
		mysqli_close($con);
	}

	if(isset($_POST['submits'])){
		refreshData();
	}
?>