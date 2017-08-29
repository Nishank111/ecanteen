<?php 
session_start();
if (!isset($_SESSION['userId']) && $_SESSION['userId'] =='') {
    header('location: index.php');
}
include "header.php" ?>
<?php
$link = mysqli_connect("localhost", "root", "", "ecanteen");
// echo $_SESSIONs['userId'];


if(isset($_POST['submit']))
      {
      	header('location:abc.php');
      }

?>

<div class="row">
	<div class="col-md-1 col-xs-12"></div>
	<div class="col-md-10">
		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Setting</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-wrench"></i> Setting</div>
			</div> <!-- /panel-heading -->

			<div class="panel-body">

				

				<form method="post" class="form-horizontal">
					<fieldset>
						<legend>Change Username and Password</legend>

						<div class="changeUsenrameMessages"></div>			

						<div class="form-group">
					    <label for="username" class="col-sm-2 control-label">Username</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="username" name="username" placeholder="Usename" value="<?php echo $_SESSION['userId']; ?>"/>
					    </div>
					  </div>

					  

						

					  <div class="form-group">
					    <label for="npassword" class="col-sm-2 control-label">New password</label>
					    <div class="col-sm-10">
					      <input type="password" class="form-control" id="npassword" name="npassword" placeholder="New Password">
					    </div>
					  </div>

					  <div class="form-group">
					    <label for="cpassword" class="col-sm-2 control-label">Confirm Password</label>
					    <div class="col-sm-10">
					      <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password">
					    </div>
					  </div>

					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					    	
					      <button type="submit" name="submit" class="btn btn-primary"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes </button>
					      
					    </div>
					  </div>


					</fieldset>
				</form>

			</div> <!-- /panel-body -->		

		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->	
</div> <!-- /row-->
<?php 
if(isset($_POST['submit']))
{ 
  $username=$_POST['username'];

  $npassword=$_POST['npassword'];
  $cpassword=$_POST['cpassword'];
 
 if (empty($username) ||  empty($password) || empty($npassword) || empty($cpassword) )
 {
 	echo "fill in all the forms";
 }
    if($npassword != $cpassword){
    	echo "Please enter both password the same";

    }

    	$sql="UPDATE `admin` SET `username`='$username',
    	`password`='$cpassword'";
    	$result=mysqli_query($link,$sql);
    	if(!$result)
    	{
    		echo mysqli_error($link);
    	}
         
    
}







  