<?php
include "db.php";

session_start();

if(isset($_POST["userLogin"])){
	$email = mysqli_real_escape_string($con,$_POST["userEmail"]);
	$password = $_POST["userPassword"];
	$sql = "SELECT * FROM user_info WHERE email = '$email'";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	if($count > 0){
		$row = mysqli_fetch_array($run_query);
		if ($password==$row["password"]) {
			$_SESSION["uid"] = $row["user_id"];
			$_SESSION["name"] = $row["first_name"];
			echo "login";
		}
		else {
			echo "nopass";
		}
	} else {
		echo "nouser";
	}
	
}

?>