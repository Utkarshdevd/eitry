<?php
	session_start();
	if(isset($_POST['file'])){
		$_SESSION['searchFile'] = $_POST['searchFile'];
		refreshData("file");
	}
	else if(isset($_POST['dept'])){
		$_SESSION['searchDept'] = $_POST['searchDept'];
		refreshData("dept");
	}
	else{
		refreshData("all");
	}
?>

<html>
	<style>
		#myTable{
			margin-left:20%;
		}
			table, td, th {
		    	border-collapse: collapse;
    			border: 1px solid green;
    			padding: 5px;
    		}

			th {
			    background-color: green;
			    color: white;
			}
	</style>
	<script type="text/javascript" src="jquery-1.11.1.min.js"></script> 
	<script type="text/javascript">
    	$(document).ready(function(){
    		$("#myTable").tablesorter();
    	});
    </script>
	<body>
			<form method="POST" action="">
				Search by file: <input type="text" name="searchFile"><br/>
				<input id="button" type="submit" name="file" value="Search File"><br/>
				Search by department: <input type="text" name="searchDept"><br/>
				<input id="button" type="submit" name="dept" value="Search Dept"><br/>
			</form> 
			<?php
			function refreshData($type){
					$con=mysqli_connect("localhost","root","qwerty","eilabtry");
					if (mysqli_connect_error()){
						echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br/>";
						mysqli_close($con);
					}
					if ($type=="all"){
						$sql = "SELECT * FROM Filesdata";
					}
					else if ($type=="file"){
						$sql = "SELECT * FROM Filesdata WHERE filename='{$_SESSION['searchFile']}'";
					}
					else if ($type=="dept"){
						$sql = "SELECT * FROM Filesdata WHERE currentPos='{$_SESSION[searchDept]}'" ;
					}
					// Execute query
					$result = mysqli_query($con,$sql);
					/*echo "<table class=\"tablesorter\" border='1'><tr>
					<th>Filename</th>
					<th>Status</th>
					<th>Current Pos</th>
					</tr>";
					*/
					echo "<table id=\"myTable\" class=\"tablesorter\">
						<thead>
							<tr>
								<th>Filename</th>
								<th>Status</th>
								<th>Current Pos</th>
							</tr>
						</thead>
						<tbody>";	
					while($row = mysqli_fetch_array($result)) {
					  echo "<tr>";
					  echo "<td>" . $row['filename'] . "</td>";
					  echo "<td>" . $row['filestatus'] . "</td>";
					  echo "<td>" . $row['currentPos'] . "</td>";
					  echo "</tr>";
					}
					mysqli_close($con);
				}
			?>
			</tbody>
		</table>
		<script type="text/javascript" src="jquery.tablesorter.js"></script> 
	</body>
</html>