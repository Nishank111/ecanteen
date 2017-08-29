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
	 header('location:cat.php');

	}

?>
<?php include 'header.php';?>


<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  
		  <li>Category</li>
      <li class="active">Add Category</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Edit/Delete Category</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">
				

				 <!-- /div-action -->
				
            <div class="row">
                <div class="col-md-10 col-xs-12">
                  <form method="post" enctype="multipart/form-data" class="form-group">
Category name<br/> <input type="text" name="brandname" id="brandname" autocomplete="off" class="form-control" value=""><br/>




<input type="submit" name="Add" value="Add" class="btn btn-success">
</form>


<?php

if(isset($_POST['Add']))
{ 
  
  $catname=$_POST['brandname'];
  
if($catname=='')
{
  echo "please fill all the forms";

}
else 
{



  $query="INSERT INTO categories(cat_id, cat_title) VALUES
  (NULL,'$catname')";
 if(!mysqli_query($link,$query))
{
   echo mysqli_error($link);

}

}
}

?>