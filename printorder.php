<?php 	

$link = mysqli_connect("localhost", "root", "", "ecanteen");

if(isset($_GET['userid']) and isset($_GET['ot']))
                        {
                          $userid=$_GET['userid'];
                          $ot=$_GET['ot'];
                        $query= "SELECT qty,customer_order.product_price,order_date,order_time,customer_name,customer_phone,products.product_title FROM customer_order inner join products on customer_order.product_id=products.product_id where user_id='$userid' and status='0' and order_time='$ot'";
                        $result=mysqli_query($link,$query);
                        $total=0;
                        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                              {
                                 $customername=$row['customer_name'];
                                 $customerphone=$row['customer_phone'];
                                 $orderdate=$row['order_date'];
                                 $ordertime=$row['order_time'];
                                 $price=$row['product_price'];
                                 $productid=$row['product_title'];
                                 $qty=$row['qty'];
                                 $total =$total + $price;
                                 

                                 
                          ?>
                            <?php header("Content-Type:application/msword"); 
                                  header("Expires:0") ;
                                  header("Cache-Control:must-revalidate,post-check=0,pre-check-0");
                                  header("content-disposition:attachment;filename=report.doc");
                                 
                                
                                   echo  '
                                  <table border="1" cellspacing="0" cellpadding="20" width="100%">
													
														
	<thead>
		<tr >
			<th colspan="5">

			<center>
				 
				Texas International College
				<center>Canteen</center>
				MitraPark Chabhil
			</center>		
			</th>
				
		</tr>		
	</thead>
</table>
								  <table border="1" cellspacing="0" cellpadding="20" width="100%">
													
														
	<thead>
		<tr >
			<th colspan="5">

			<center>
				 
				Order Date : '.$orderdate.'
				<center>Client Name : '.$customername.'</center>
				Contact : '.$customerphone.'
			</center>		
			</th>
				
		</tr>		
	</thead>
</table>
<table border="1" cellspacing="0" cellpadding="20" width="100%">
													
														
	<thead>
		<tr >
			<th colspan="5">

			
				<h4> Product name='.$productid.'</h4></br>
					<h4> Product price='.$price.'</h4></br>
					<h4>Quantity ='.$qty.'</br>
					<h4>Total:'.$total.'
					
			</th>
				
		</tr>		
	</thead>
</table>


';
//header('location:dashboard.php');

	
		

	   
		
                                                            
														
															
																
																
											
                                                                

?>




                          <?php  } }  ?>

                          <?php











