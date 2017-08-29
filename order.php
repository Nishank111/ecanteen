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
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Order</li>

		</ol>

         
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Order</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">
                   

				 				
				
				<table class="table">

					<thead>
						<tr>
						
							<th>Client Name</th>							
							<th>Order Date</th>
							<th>Order Time</th>
														
							<th>Contact</th>
							<th>Address</th>
							
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
					<?php
								$query= "SELECT DISTINCT customer_order.user_id,customer_name,customer_name,order_date,order_time,customer_phone,customer_address FROM customer_order INNER JOIN user_info on customer_order.user_id=user_info.user_id where status='0' ";
								$result=mysqli_query($link,$query);
								while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
								      {
								            
					                        $userid=$row['user_id'];
					                        $customername=$row['customer_name'];
					                        $customeraddress=$row['customer_address'];
					                        $customerphone=$row['customer_phone'];
					                        $orderdate=$row['order_date'];
					                        $ordertime=$row['order_time'];
					                        
						                    
						                                          
								          
								               
								               ?>
                    	  <tr>
                    	  	<td><?php echo  $customername;?></td>						
							<td><?php echo  $orderdate;?></td>
							<td><?php echo  $ordertime;?></td>
														
							<td><?php echo  $customerphone;?></td>
							<td><?php echo  $customeraddress;?></td>
							<td><a href="vieworders.php?userid=<?php echo $userid;  ?> & ot=<?php echo $ordertime?>">view order</a></td>
							<td></td>
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

