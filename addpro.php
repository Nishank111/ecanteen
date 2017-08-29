<?php

// echo $_SESSIONs['userId'];
session_start();
if (!isset($_SESSION['userId']) && $_SESSION['userId'] =='') {
    header('location: index.php');
}
?>

<?php 
$link = mysqli_connect("localhost", "root", "", "ecanteen");

if(isset($_POST['submit']))
{ 
	 header('location:products.php');

	}

?>
<?php include 'header.php';?>

<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li>Recepie</li>
		  <li class="active">Edit Recepie</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Edit/Delete Recepie</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">
				

				 <!-- /div-action -->
				
            <div class="row">
                <div class="col-md-10 col-xs-12">
                  <form method="post" enctype="multipart/form-data" class="form-group">
Food name<br/> <input type="text" name="productname" id="productname" autocomplete="off" class="form-control" value=""><br/>


quantity<br/> <input type="text" name="productquantity" id="productquantity" autocomplete="off" class="form-control" value=""><br/>

price<br/> <input type="text" name="price" autocomplete="off" id="productprice" class="form-control" value=""><br/>

Description<br/> <input type="text" name="description" id="productdescription" autocomplete="off" class="form-control" value=""> <br/>

Food photo<br/><input type="file" class="btn btn-success"  for="my-file-selector" name="user_image" accept="image/*"><br/><br/>
<p>
Food category
<select name="category" class="btn btn-default dropdown-toggle" role="menu" id="selector">
  <option value="">Select...</option>
  <option value="FastFood">FastFood</option>
  <option value="Launch">Launch</option>
  
  <option value="Beverages">Beverages</option>
  <option value="Dinner">Dinner</option>
  <option value="Snacks">Snacks</option>
   
  
  
</select>
</p>
<p>
Menu category
<select name="brand" class="btn btn-default dropdown-toggle" role="menu" id="selector">
  <option value="">Select...</option>
  <option value="Veg">Veg</option>
  <option value="Chicken">Chicken</option>
  <option value="Drinks">Drinks</option>
  <option value="Aalu">Aalu</option>
  <option value="Cellroti">Cellroti</option>
  <option value="Dunots">Donuts</option>
  <option value="Burger">Burger</option>
  <option value="Cellroti">Cellroti</option>
  <option value="KhanaSet">NormalKhanaset</option>
  <option value="KhanaSet">ChickenKhanaset</option>
  <option value="Fried">Fried</option>
  </select>
</p>

<input type="submit" name="submit" class="btn btn-success">
</form>


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
  $query="INSERT INTO products(product_id, product_cat, product_brand, product_title, product_price, product_desc, product_image, product_quantity) VALUES
  (NULL,'$category','$brand','$productname','$productprice','$description','$destination','$quantity')";
 if(!mysqli_query($link,$query))
{
   echo mysqli_error($link);

}

}
}

?>