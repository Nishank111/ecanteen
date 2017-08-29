<?php
session_start();
include "db.php";

$f_name = $_POST["f_name"];
$l_name = $_POST["l_name"];
if (!isset($_POST['editing'])) {
	$email = $_POST['email'];
	$password = MD5($_POST['password']);
	$repassword = MD5($_POST['repassword']);
} else {
	$email = $password = $repassword = "*";
}
$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
$mobile = $_POST['mobile'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$name = "/^[a-zA-Z ]+$/";
$number = "/^[0-9]+$/";

if(empty($f_name) || empty($l_name) || empty($email) || empty($password) || empty($repassword) ||
	empty($mobile) || empty($address1) || empty($address2)){
		
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>PLease Fill all fields..!</b>
			</div>
		";
		exit();
	} else {
		
	if (!isset($_POST['editing'])) {
		if(!preg_match($emailValidation,$email)){
			echo "
				<div class='alert alert-warning'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<b>This e-mail is not valid..!</b>
				</div>
			";
			exit();
		}
		if(strlen($password) < 6 ){
			echo "
				<div class='alert alert-warning'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<b>Password is weak</b>
				</div>
			";
			exit();
		}
		if(strlen($repassword) < 6 ){
			echo "
				<div class='alert alert-warning'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<b>Password is weak</b>
				</div>
			";
			exit();
		}
		if($password != $repassword){
			echo "
				<div class='alert alert-warning'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<b>Password is not same</b>
				</div>
			";
		}
	}
	if(!preg_match($number,$mobile)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Mobile number $mobile is not valid</b>
			</div>
		";
		exit();
	}
	if(!(strlen($mobile) == 10)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Mobile number must be 10 digit</b>
			</div>
		";
		exit();
	}
	if (!isset($_POST['editing'])) {
		//existing email address in our database
		$sql = "SELECT user_id FROM user_info WHERE email = '$email' LIMIT 1" ;
		$check_query = mysqli_query($con,$sql);
		$count_email = mysqli_num_rows($check_query);
		if($count_email > 0){
			echo "
				<div class='alert alert-danger'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<b>Email Address is already available. Try Another email address</b>
				</div>
			";
			exit();
		} else {
			//$password = $password;
			$sql = "INSERT INTO `user_info` 
			(`user_id`, `first_name`, `last_name`, `email`, 
			`password`, `mobile`, `address1`, `address2`) 
			VALUES (NULL, '$f_name', '$l_name', '$email', 
			'$password', '$mobile', '$address1', '$address2')";
			$run_query = mysqli_query($con,$sql);
			if($run_query){
				$_SESSION["uid"] = mysqli_insert_id($con);
				$_SESSION["name"] = $f_name;
				die("reg");
			}
		}
	} else {
		$sql = "UPDATE user_info SET first_name='$f_name', last_name='$l_name',	mobile='$mobile', address1='$address1', address2='$address2' WHERE user_id=".$_SESSION["uid"];
		$run_query = mysqli_query($con,$sql);
		if($run_query){
			$_SESSION["name"] = $f_name;
			die("updated");
		}
	}
}
	
?>






















































