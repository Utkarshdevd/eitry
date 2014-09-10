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
		//echo "cant update...";
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
		<h2 class="outer" style="color: #B7C942;">Peon Logged In</h2>
		<div class="outer">
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
		</div>
		<p>{ <a href="?log=out">log out</a> }</p>
	</body>
</html>