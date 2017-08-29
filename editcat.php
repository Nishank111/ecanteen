<?php 
session_start();
if (!isset($_SESSION['userId']) && $_SESSION['userId'] =='') {
    header('location: index.php');
}
$link = mysqli_connect("localhost", "root", "", "ecanteen");

if(isset($_POST['Edit']))
{ 
   header('location:cat.php');

  }

if(isset($_POST['Delete']))
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
      <li class="active">EditDelete</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Edit/Delete Category</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">
				

				 <!-- /div-action -->
				
            <div class="row">
                <div class="col-md-10 col-xs-12">
                   <?php if(isset($_GET['catid']))
{
  $catid=$_GET['catid'];

$query= "SELECT * FROM `categories` WHERE cat_id='$catid'";
$result=mysqli_query($link,$query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
      {
          $catid=$row['cat_id'];
          $catname=$row['cat_title'];
         

}
}

?>

<form method="post" enctype="multipart/form-data" class="form-group">
Category Name<br/> <input type="text" name="catname" id="catname" autocomplete="off" class="form-control" 
value="<?PHP echo $catname; ?>"><br/>







<input type="submit" name="Edit" value="Edit" class="btn btn-success">
<input type="submit" name="Delete" value="Delete" class="btn btn-danger">
</form>


<?php

if(isset($_POST['Edit']))
{ 
  
  $catname=$_POST['catname'];
  
if($catname=='')
{
  echo "please fill all the forms";

}
else 
{



  $query="UPDATE `categories` SET 
  cat_id='$catid',
  cat_title='$catname' where cat_id='$catid'";
 if(!mysqli_query($link,$query))
{
   echo mysqli_error($link);

}

}
}

if(isset($_POST['Delete']))
{
    $query="DELETE  FROM categories WHERE cat_id='$catid'";
  $query1=mysqli_query($link,$query);
  if(!$query1)
  {
    echo mysqli_error($link);
    
  }
}

?>