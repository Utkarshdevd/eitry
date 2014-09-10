<?php #admin/restricted.php 
           #####[make sure you put this code before any html output]#####

//starting the session
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

	$doc = new DOMDocument();
	$doc->loadHTMLFile("officerPage.html");
	echo $doc->saveHTML();

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
					echo "<table id=\"myTable\" class=\"tablesorter outer\">
						<thead>
							<tr>
								<th>Fileid</th>
								<th>Filename</th>
								<th>Status</th>
								<th>Current Pos</th>
								<th>Date of Creation</th>
								<th>Branch</th>
								<th>Activity</th>
							</tr>
						</thead>
						<tbody>";	
					while($row = mysqli_fetch_array($result)) {
					  echo "<tr>";
					  echo "<td>" . $row['fileid'] . "</td>";
					  echo "<td>" . $row['filename'] . "</td>";
					  echo "<td>" . $row['filestatus'] . "</td>";
					  echo "<td>" . $row['currentPos'] . "</td>";
					  echo "<td>" . $row['date_time'] . "</td>";
					  echo "<td>" . $row['branch'] . "</td>";
					  echo "<td>" . $row['activity'] . "</td>";
					  echo "</tr>";
					}
					mysqli_close($con);
					echo "	</tbody>
		</table>
	</div>";
				}
?>
<html>
<body>
<!-- add a LOGOUT link before the form -->
<p>{ <a href="?log=out">log out</a> }</p>
</body>
</html>