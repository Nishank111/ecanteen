<?php

// echo $_SESSIONs['userId'];
session_start();
if (!isset($_SESSION['userId']) && $_SESSION['userId'] =='') {
    header('location: index.php');
}
?>


<?php 
$link = mysqli_connect("localhost", "root", "", "ecanteen");

if(isset($_POST['Add']))
{ 
	 header('location:brand.php');

	}

?>
<?php include 'header.php';?>


<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li>Product</li>
		  <li class="active">Edit Product</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Edit/Delete Product</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">
				

				 <!-- /div-action -->
				
            <div class="row">
                <div class="col-md-10 col-xs-12">
                  <form method="post" enctype="multipart/form-data" class="form-group">
Brand name<br/> <input type="text" name="brandname" id="brandname" autocomplete="off" class="form-control" value=""><br/>




<input type="submit" name="Add" value="Add" class="btn btn-success">
</form>


<?php

if(isset($_POST['Add']))
{ 
  
  $brandname=$_POST['brandname'];
  
if($brandname=='')
{
  echo "please fill all the forms";

}
else 
{



  $query="INSERT INTO brands(brand_id, brand_title) VALUES
  (NULL,'$brandname')";
 if(!mysqli_query($link,$query))
{
   echo mysqli_error($link);

}

}
}

?>