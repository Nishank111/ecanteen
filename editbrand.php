<?php 
session_start();
if (!isset($_SESSION['userId']) && $_SESSION['userId'] =='') {
    header('location: index.php');
}
$link = mysqli_connect("localhost", "root", "", "ecanteen");

// echo $_SESSIONs['userId'];


if(isset($_POST['Edit']))
{ 
	 header('location:brand.php');

	}

if(isset($_POST['Delete']))
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
		  <li>Recipes</li>
		  <li class="active">Edit Recipe</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Edit/Delete Recipe</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">
				

				 <!-- /div-action -->
				
            <div class="row">
                <div class="col-md-10 col-xs-12">
                   <?php if(isset($_GET['brandid']))
{
  $brandid=$_GET['brandid'];
$query= "SELECT * FROM brands WHERE brand_id=$brandid";
$result=mysqli_query($link,$query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
      {
          $brandid=$row['brand_id'];
                           $brandname=$row['brand_title'];
         

}
}

?>

                    <form method="post" enctype="multipart/form-data" class="form-group">
Food Type<br/> <input type="text" name="brandname" id="brandname" autocomplete="off" class="form-control" value="<?PHP echo $brandname ?>"><br/>







<input type="submit" name="Edit" value="Edit" class="btn btn-success">
<input type="submit" name="Delete" value="Delete" class="btn btn-danger">
</form>


<?php

if(isset($_POST['Edit']))
{ 
  
  $brandname=$_POST['brandname'];
  
if($brandname=='')
{
  echo "please fill all the forms";

}
else 
{



  $query="UPDATE `brands` SET 
  brand_id='$brandid',
  brand_title='$brandname' where brand_id='$brandid'";
 if(!mysqli_query($link,$query))
{
   echo mysqli_error($link);

}

}
}
if(isset($_POST['Delete']))
{
    $query="DELETE  FROM brands WHERE brand_id='$brandid'";
  $query1=mysqli_query($link,$query);
  if(!$query1)
  {
    echo mysqli_error($link);
    
  }
}

?>
