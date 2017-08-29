<?php 
session_start();
if (!isset($_SESSION['userId']) && $_SESSION['userId'] =='') {
    header('location: index.php');
}
$link = mysqli_connect("localhost", "root", "", "ecanteen");


if(isset($_POST['accept_order']))
{
  header('location:abc.php');
}
if(isset($_POST['delete_order']))
        {
          header('location:order.php');
          }

?>

<?php include 'header.php';?>


<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-10">

		<ol class="breadcrumb">
		  <li><a href="abc.php">Home</a></li>		  
		  <li>Orders</li>
		  <li class="active">View Orders</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> View Orders</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">
             <?php if(isset($_GET['userid']) and isset($_GET['ot']))
                        {
                          $userid=$_GET['userid'];
                          $ot=$_GET['ot'];
                        $query= "SELECT distinct order_date,order_time,customer_name,customer_phone FROM customer_order where user_id='$userid' and status='0' and order_time='$ot'";
                        $result=mysqli_query($link,$query);
                        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                              {
                                 $customername=$row['customer_name'];
                                 $customerphone=$row['customer_phone'];
                                 $orderdate=$row['order_date'];
                                 $ordertime=$row['order_time'];
                                 
                                 
                          ?>


      <div class="row">
        <div class="col-md-4 col-xs-12">
        
        <h4> Order Date </h4>
          </div>
          <div class="col-md-6 col-xs-6">
           <input type="text" name="orderdate" id="orfertime" autocomplete="off" class="form-control" value="<?PHP echo $orderdate; ?>" disabled>
         </div>
       </div>
         
          <div class="row">
        <div class="col-md-4 col-xs-12">
        
        <h4> Order Time </h4>
          </div>
          <div class="col-md-6 col-xs-6">
           <input type="text" name="orderdate" id="orfertime" autocomplete="off" class="form-control" value="<?PHP echo $ordertime; ?>" disabled>
         </div>
       </div>

         <div class="row">
        <div class="col-md-4 col-xs-12">
        
        <h4> Client Name</h4>
          </div>
          <div class="col-md-6 col-xs-6">
           <input type="text" name="orderdate" id="orfertime" autocomplete="off" class="form-control" value="<?PHP echo $customername; ?>" disabled>
         </div>
       </div>

         <div class="row">
        <div class="col-md-4 col-xs-12">
        
        <h4> Client Contact </h4>
          </div>
          <div class="col-md-6 col-xs-6">
           <input type="text" name="orderdate" id="orfertime" autocomplete="off" class="form-control" value="<?PHP echo $customerphone; ?>" disabled>
         </div>
       </div>
   <?php }}?>
    

       <hr>
         <table class="table">
        <thead>
            <tr>
            
              <th>Product id</th>             
              <th>Product Name</th>
              <th>price</th>              
              <th>Quantity</th>             
             
            </tr>
          </thead>
       <?php 
       $total=0;
       $sql="SELECT qty,customer_order.product_price,customer_phone,customer_address,customer_email,customer_order.product_id,products.product_title FROM customer_order INNER JOIN products ON customer_order.product_id=products.product_id where user_id='$userid' and order_time='$ot'";

           $result=mysqli_query($link,$sql);
                    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                              {
                                 $qty=$row['qty'];
                                  $productname=$row['product_title'];
                                 $customeraddress=$row['customer_address'];
                                 $customeremail=$row['customer_email'];
                                 $price=$row['product_price'];
                                 $productid=$row['product_id'];
                                 $total =$total + $price;
                                 
                                 
                          ?>


     
           
            <tr>
              <td><?php echo $productid;?></td>             
              <td><?php echo $productname; ?></td>
              <td><?php echo $price;?></td>              
              <td><?php echo $qty; ?></td>             
             

      <?php 
    }
    ?>

  </table>


  <h3> Total :<?php echo $total; ?> </h3>
  <form method="post">
 



<input type="submit" name="accept_order" value="Accept">
 <input type="submit" name="delete_order" value="Decline">
</form>
  <form method="post" action="printorder.php">
 <a href="printorder.php?userid=<?php echo $userid;  ?> & ot=<?php echo $ordertime?>">Print</a>
</form>

 <?php
if(isset($_POST['accept_order']))
{
            $query = "UPDATE `customer_order` SET status='1'where user_id='$userid' and order_time='$ot' ";
            $query1=mysqli_query($link,$query);
        if(!$query1)
        {
            echo mysqli_error($link);
        }
        
        }

        if(isset($_POST['delete_order']))
        {
          $query = "DELETE FROM `customer_order` WHERE user_id='$userid' and order_time='$ot' ";
            $query1=mysqli_query($link,$query);
        if(!$query1)
        {
            echo mysqli_error($link);
        }
        
        }
         
        
