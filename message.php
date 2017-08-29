<?php
include "db.php";



	$fullname=$_POST["fname"];
	$email = $_POST["email"];
	$msg = $_POST["msg"];

	if(empty($fullname) || empty($email) || empty($msg)){
		
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>PLease Fill all fields..!</b>
			</div>
		";
		exit();
	} else {


	$sql = "INSERT INTO `message`(`id`, `fullname`, `email`, `messages`) VALUES (NULL,'$fullname','$email','$msg')";
	$run_query = mysqli_query($con,$sql);
	
	if($run_query){
			echo "
				<div class='alert alert-success'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Message was sent sucessfully.!</b>
				</div>
			";
			
		}
	else{
		echo mysqli_error($con);
	}

}


?>