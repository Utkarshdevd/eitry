<?php
	session_start();

	$con=mysqli_connect("localhost","root","qwerty","eilabtry");
	if (mysqli_connect_error()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br/>";
		mysqli_close($con);
	}

	if(isset($_POST['submits'])){
		$_SESSION['filename'] = $_POST['fileName'];
		$_SESSION['fileExists']= filesExists();
		echo "DoesfilesExists? : $fileExists <br/>";
	}

	if(isset($_POST['proceedPos'])){
		//echo "Naaice";
		global $filename,$fileExists;
		echo "okay:".$_POST['proceedPos']."-".$filename."<br/>";
		updatePos();
		//unset($_POST);
		unset($fileExists);
	}
	else{
		echo "cant update...";
	}

	function updatePos(){
		global $filename;
		$newPos = $_POST['newPos'];
		echo "in update".$newPos.$_SESSION['filename']."<br/>";
		$con=mysqli_connect("localhost","root","qwerty","eilabtry");
		$sql = "UPDATE Filesdata SET currentPos = '{$newPos}' WHERE filename = '{$_SESSION['filename']}'";
		echo $sql."<br/>";
		if (mysqli_connect_error()){
			//echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br/>";
			return False;
		}
		if(mysqli_query($con,$sql)){
			echo "update successful <br/>";
		}
		else{
			echo "SERVER ERROR pls try later".mysqli_error()."<br/>";
		}
		mysqli_close($con);
	}

	function filesExists(){
		global $filename;
		$con=mysqli_connect("localhost","root","qwerty","eilabtry");
		if (mysqli_connect_error()){
			//echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br/>";
			return False;
			mysqli_close($con);
		}
		$sql = "SELECT '{$_SESSION['filename']}' FROM Filesdata";
		echo $sql;
		if(mysqli_query($con,$sql)){
			return True;
		}
		else{
			echo "Wrong filename, enter again correctly";
			return False;
		}
		mysqli_close($con);
	}
?>
<html>
	<body>
		<fieldset style="width:30%;">
			<?php
				if ($_SESSION['fileExists'] and isset($_POST['submits'])){
			?>
			<form method="POST">
				New Designation: <input type="text" name="newPos"><br>
				<input id="button" type="submit" name="proceedPos" value="Update">
			</form>
			<?php
				}
				else{
			?>
			<form method="POST">
				File Name: <input type="text" name="fileName"><br>
				<input id="button" type="submit" name="submits" value="Search">
			</form>
			<?php
				}
			?>
		</fieldset>
	</body>
</html>