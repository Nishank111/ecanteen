<?php

// echo $_SESSIONs['userId'];
session_start();
if (!isset($_SESSION['userId']) && $_SESSION['userId'] =='') {
    header('location: index.php');
}
?>

<?php 
$link = mysqli_connect("localhost", "root", "", "ecanteen");


?>
<?php include 'header.php' ;?>


<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Food Menu</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Food</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">


				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<a href="addbrand.php"> <input type="submit" name="Add brand" value="Add food" class="btn btn-sucess"> </a>
					

				</div> <!-- /div-action -->				
				
				<table class="table">
					<thead>
						<tr>							
							<th>Food Id</th>
							<th>Food Name</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
                       <?php
								$query= "SELECT * FROM brands";
								$result=mysqli_query($link,$query);
								while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
								      {
								           $brandid=$row['brand_id'];
								           $brandname=$row['brand_title'];
								           
								               ?>
                    	  <tr>
    
								    <td width="500px"><?php echo $brandid; ?> </td>
								    <td width="500px"><?php echo $brandname; ?> </td>
								    <td width="500px"><a href="editbrand.php?brandid=<?php echo $brandid;  ?>">Edit/Delete</a></td>
								    
								</tr>


								                <?php
								            }

								?>



				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

