

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
		  <li class="active">Deleivered Record</li>
		</ol>
         
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Product</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">
                 

				 				
				
				<table class="table">

					<thead>
						<tr>
							<th>UserID</th>
							<th>Product id</th>						
							<th>Quantity</th>
							<th>Price</th>							
							
							
							
						</tr>
					</thead>
					<?php
								$query= "SELECT * FROM customer_order where status='1'";
								$result=mysqli_query($link,$query);
								while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
								      {
								          
								          $userid=$row['user_id'];
								          $productid =$row['product_id'];
								         
								          $productprice=$row['product_price'];
                                        
								          $qty=$row['qty'];
								         
                                          
								          
								               
								               ?>
                    	  <tr>
       
    
    
    
    
    
    <td width="500px"><?php echo $userid; ?> </td>
    <td width="500px"><?php echo $productid; ?> </td>
    <td width="500px"><?php echo $qty; ?> </td>
    
	<td width="500px"><?php echo "Rs.  ".$productprice.""; ?> </td>
	
   
   
    
    
    
    
    
    
   
    
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

 <form method="post" action="printorder.php">
 <a href="printorder.php?userid=<?php echo $userid;  ?> & ot=<?php echo $ordertime?>">Print</a>
</form>