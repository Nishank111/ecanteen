

<?php 
session_start();
if (!isset($_SESSION['userId']) && $_SESSION['userId'] =='') {
    header('location: index.php');
}
$link = mysqli_connect("localhost", "root", "", "ecanteen");

?>
<?php include 'header.php'; ?>


<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">

		<ol class="breadcrumb">
		  <li><a href="abc.php">Home</a></li>		  
		  <li class="active">Total Recipes</li>
		</ol>
         
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Food Items</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">
                   <div class="div-action pull pull-right" style="padding-bottom:20px;">
					<a href="addpro.php"> <input type="submit" name="Add Product" value="Add Recepies" class="btn btn-sucess"> </a>
					

				</div>

				 				
				
				<table class="table">

					<thead>
						<tr>
							<th style="width:10%;">Photo</th>
							<th>Food id</th>							
							<th>Food Name</th>
							<th>price</th>							
							<th>Quantity</th>
							<th>Type</th>
							<th>Category</th>
							
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
					<?php
								$query= "SELECT * FROM products";
								$result=mysqli_query($link,$query);
								while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
								      {
								           $productid=$row['product_id'];
								          $producttype =$row['product_cat'];
								          $productname=$row['product_title'];
								          $productprice=$row['product_price'];
                                          $brand=$row['product_brand'];
								          $quantity=$row['product_quantity'];
								          $productphoto=$row['product_image'];
								          $productdesc=$row['product_desc'];
                                          
								          
								               
								               ?>
                    	  <tr>
       <td width="200px" > <a href="editdel.php?productid=<?php echo $productid;  ?>"> <img src="../product_images/<?php echo $productphoto; ?>" alt="<?php echo $productphoto; ?>" height='200px' width='200px'/></a> </td>
    
    
    
    
    
    <td width="500px"><?php echo $productid; ?> </td>
    <td width="500px"><?php echo $productname; ?> </td>
     <td width="500px"><?php echo "Rs.  ".$productprice.""; ?> </td>
   
   <td width="500px"><?php echo $quantity; ?> </td>
    
    
    
    
    
    
    
    <td width="500px"><?php echo $brand; ?> </td>
    <td width="500px"><?php echo $producttype; ?> </td>
   
    <td width="500px"><a href="editproduct.php?productid=<?php echo $productid;  ?>">Edit/Delete</a></td>
    
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

