<?php

// echo $_SESSIONs['userId'];
session_start();
if (!isset($_SESSION['username']) && $_SESSION['username']=='') {
    header('location: index.php');
}
?>
<?php
include "header.php";
$link = mysqli_connect("localhost", "root", "", "ecanteen");

?>
<?php
if(isset($_POST['submit']))
{ 
  $productname=$_POST['productname'];
  $brand=$_POST['brand'];
  $productprice=$_POST['price'];
  $description=$_POST['description'];
  $category=$_POST['category'];
  $quantity=$_POST['productquantity'];
 

  
  


if($productname==''||$brand==''||$productprice==''||$description==''||$category==''||$quantity=='')
{
  echo "please fill all the forms";

}
else 
{


$file_name=$_FILES['user_image']['name'];
  $file_type=$_FILES['user_image']['type'];
  $file_size=$_FILES['user_image']['size'];
  $file_tmp_name=$_FILES['user_image']['tmp_name'];
  $destination = "../product_images/".$file_name;

if($file_name)
  {
  
    move_uploaded_file($file_tmp_name, $destination);
    
 }
 //echo "$productname","$category","$productprice","$quantity","$description","$brand","$destination";
  $query="UPDATE `products` SET 
  product_id='$productid',
  product_cat='$category',
  product_brand='$brand',
   product_title='$productname',
    product_price='$productprice',
     product_desc='$description',
      product_image='$destination',
       product_quantity='$quantity'
        where product_id='$iproduct'";
 if(mysqli_query($link,$query))
{
  header('location:allproducts.php');
        exit();

}
else
{
  echo mysqli_error($link);
}
}
}

if(isset($_POST['delete']))
{
  $query="DELETE  FROM products WHERE product_id='$iproduct'";
  $query1=mysqli_query($link,$query);
  if(!$query1)
  {
    echo mysqli_error($link);
  }
  else{
    header('location:allproducts.php');
    
        exit();
  }
}

?>

 <div id="wrapper">
          <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                
                <a class="navbar-brand" href="index.html">Admin Panel</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul id="active" class="nav navbar-nav side-nav">
                 <li class="selected"><a href="dashboard.php"><i class="fa fa-bullseye"></i> Dashboard</a></li>
                    <li><a href="allproducts.php"></i> All Products</a></li>
                    <li class="selected"><a href="addproduct.php"></i> Add Products</a></li>
                    <li><a href="message.php"></i> messages</a></li>
                     <li><a href="orders.php"></i> Orders</a></li>
                    <li><a href="delivery.php"></i> Sent Deliveries </a></li>
                    <li><a href="user.php"></i> Users</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">
                    
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['username'];?>
                            <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                            
                            <li class="divider"></li>
                           <li><a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>

                        </ul>
                    </li>
                    
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Edit Products</h1>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-xs-12">
                  <?php if(isset($_GET['productid']))
{
  $iproduct=$_GET['productid'];
$query= "SELECT * FROM products WHERE product_id=$iproduct";
$result=mysqli_query($link,$query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
      {
          $productid=$row['product_id'];
          $producttype =$row['product_brand'];
          $productcat =$row['product_cat'];
          $productname=$row['product_title'];
          $productprice=$row['product_price'];
          
          $quantity=$row['product_quantity'];
          $productphoto=$row['product_image'];
          $productdesc=$row['product_desc'];  
         

}
}

?>

                    <form method="post" enctype="multipart/form-data" class="form-group">
product name<br/> <input type="text" name="productname" id="productname" autocomplete="off" class="form-control" value="<?PHP echo $productname ?>"><br/>


quantity<br/> <input type="text" name="productquantity" id="productquantity" autocomplete="off" class="form-control" value="<?PHP echo $quantity; ?>"><br/>

price<br/> <input type="text" name="price" autocomplete="off" id="productprice" class="form-control" value="<?PHP echo $productprice; ?>"><br/>
Description<br/> <input type="text" name="description" id="productdescription" autocomplete="off" class="form-control" value="<?PHP  echo $productdesc; ?>"> <br/>

product photo<br/><input type="file" class="btn btn-success"  for="my-file-selector" name="user_image" accept="image/*" value="<?php echo $productphoto; ?>"><br/><br/>
<p>
product category
<select name="category" class="btn btn-default dropdown-toggle" role="menu" id="selector">
  <option value="">Select...</option>
  <option value="Mobile">Mobile</option>
  <option value="Laptop">Laptop</option>
  
  <option value="Home Appliances">Home Appliances</option>
  <option value="Kitchen">Kitchen</option>
  
  
</select>
</p>
<p>
product Brand
<select name="brand" class="btn btn-default dropdown-toggle" role="menu" id="selector">
  <option value="">Select...</option>
  <option value="HP">HP</option>
  <option value="Samsung">Samsung</option>
  <option value="Apple">Apple</option>
  <option value="LG">LG</option>
  <option value="Sony">Sony</option>
  
  
</select>
</p>

<input type="submit" name="submit" value="save" class="btn btn-success">
<input type="submit" name="delete" value="delete" class="btn btn-danger">
</form>

