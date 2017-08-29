<?php
session_start();
include "db.php";
if(isset($_POST["category"])){
	$category_query = "SELECT * FROM categories";
	$run_query = mysqli_query($con,$category_query) or die(mysqli_error($con));
	
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$cid = $row["cat_id"];
			$cat_name = $row["cat_title"];
			echo "
					<li><a href='#' class='category' cid='$cat_name'>$cat_name</a></li>
			";
		}
		
	}
}
if(isset($_POST["brand"])){
	$brand_query = "SELECT * FROM brands";
	$run_query = mysqli_query($con,$brand_query);
	
		
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$bid = $row["brand_id"];
			$brand_name = $row["brand_title"];
			echo "
					<li><a href='#' class='selectBrand' bid='$bid'>$brand_name</a></li>
			";
		}
		
	}
}

if(isset($_POST["getProduct"])){
	
	$product_query = "SELECT * FROM products where product_quantity!=0 ORDER BY RAND() LIMIT 20";
	$run_query = mysqli_query($con,$product_query);
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$pro_id    = $row['product_id'];
			$pro_cat   = $row['product_cat'];
			$pro_brand = $row['product_brand'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_image = $row['product_image'];
			echo "
				<div class='col-md-3 special-products-grid text-center'>
							
							<a  data-toggle='modal' data-target='#proImageModal' class='openModal'><img src='product_images/$pro_image' style='width:160px; height:250px;'/><input type='hidden' value='$pro_id' class='proModalID'></a></a>
							<h4><a href=''>$pro_title</a></h4>
							<a class='product-btn'><span>Rs.$pro_price</span><small>$pro_brand</small></a>
						</div>

			";
		}
	}
}

if(isset($_POST["getProductDetail"])){
	$proModalID = $_POST['proModalID'];
	$current_product_query = "SELECT product_id, product_title, product_price, product_desc, product_image, product_cat, product_brand FROM products WHERE product_id='$proModalID'";
	$run_current_query = mysqli_query($con,$current_product_query);
	if(mysqli_num_rows($run_current_query) > 0){
		$row = mysqli_fetch_array($run_current_query);
		$pro_id    = $row['product_id'];
		$pro_cat   = $row['product_cat'];
		$pro_brand = $row['product_brand'];
		$pro_title = $row['product_title'];
		$pro_price = $row['product_price'];
		$pro_desc = $row['product_desc'];
		$pro_image = $row['product_image'];
		echo "
				<div class='modal-header'>
					<button type='button' class='close' data-dismiss='modal'>&times;</button>
					<h4 class='modal-title'>$pro_title</h4>
				</div>
				<div class='modal-body'>
					<div class='row'>
						<div class='col-md-6 proimage'>
							<img src='product_images/$pro_image' style='width:160px; height:250px;'/><input type='hidden' value='$pro_id' class='proModalID'>
						</div>
						<br>
						<div class='col-md-6 prodetails'>
							<table class='table table-hover'>
								<tr>
									<td><b>Category :</b></td>
									<td>$pro_cat</td>
								</tr>
								<tr>
									<td><b>Brand :</b></td>
									<td>$pro_brand</td>
								</tr>
								<tr>
									<td><b>Price :</b></td>
									<td>Rs.$pro_price.00</td>
								</tr>
								<tr>
									<td><b>Description:</b></td>
									<td>$pro_desc</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<div class='modal-footer'>
					<div id='product_msg_popup' align='left'></div>
					<button pid='$pro_id' popup='1' id='product' class='btn btn-danger btn-md' style='min-width:160px;'>Add to Cart</button>
					<button type='button' class='btn btn-default btn-md' data-dismiss='modal'>Close</button>
				</div>
		";
		if (isset($_SESSION['uid'])) {
			$uid = $_SESSION['uid'];
			$count_query = mysqli_query($con, "SELECT COUNT(*) AS counter FROM recommendcount WHERE user_id='$uid' AND product_id='$pro_id'");
			if (mysqli_fetch_assoc($count_query)['counter'] == 0) {
				mysqli_query($con,"INSERT INTO recommendcount (user_id, product_id, count) VALUES ('$uid','$pro_id',1)");
			} else {
				mysqli_query($con,"UPDATE recommendcount SET count = count+1 WHERE user_id='$uid' AND product_id='$pro_id'");

			}
			$count_query = mysqli_query($con, "SELECT COUNT(*) AS counter FROM productcount WHERE product_id='$pro_id'");
			if (mysqli_fetch_assoc($count_query)['counter'] == 0) {
				mysqli_query($con,"INSERT INTO productcount (id, product_id, count) VALUES (null,'$pro_id',1)");
			} else {
				mysqli_query($con,"UPDATE productcount SET count = count+1 WHERE product_id='$pro_id'");

			}
		}
	}
}

if (isset($_POST['recommended'])) {
	$uid = $_SESSION['uid'];
	$sql = "SELECT DISTINCT product_id, product_title, product_image, product_price,product_brand FROM products INNER JOIN categories ON products.product_cat=categories.cat_title WHERE products.product_cat IN (SELECT cat_title FROM categories INNER JOIN products ON products.product_cat=categories.cat_title INNER JOIN recommendcount ON products.product_id=recommendcount.product_id WHERE recommendcount.user_id='$uid' AND recommendcount.count>0 ORDER BY recommendcount.count DESC) ORDER BY RAND() LIMIT 4";
	if ($run_query = mysqli_query($con, $sql)) {
		if (mysqli_num_rows($run_query) > 0) {
			echo '<div class="panel panel-info" id="scroll">
					<div class="panel-heading">Recommended Products</div>
						<div class="panel-body">';
			while ($row = mysqli_fetch_assoc($run_query)) {
				$pro_id = $row['product_id'];
				$pro_title = $row['product_title'];
				$pro_image = $row['product_image'];
				$pro_price = $row['product_price'];
				$pro_brand=$row['product_brand'];
				
				echo "<div class='col-md-3 special-products-grid text-center'>
							
							<a  data-toggle='modal' data-target='#proImageModal' class='openModal'><img src='product_images/$pro_image' style='width:160px; height:250px;'/><input type='hidden' value='$pro_id' class='proModalID'></a></a>
							<h4><a href=''>$pro_title</a></h4>
							<a class='product-btn'><span>Rs.$pro_price</span><small>$pro_brand</small></a>
						</div>";
			}
			
		}
	} else {
		echo mysqli_error($con);
	}
}

if (isset($_POST['mostview'])) {

	$sql = "SELECT products.product_id, product_title, product_image, product_price,
	product_brand FROM products INNER JOIN productcount on products.product_id=productcount.product_id 
	WHERE  productcount.count>10 ORDER BY RAND() LIMIT 4";
	if ($run_query = mysqli_query($con, $sql)) {
		if (mysqli_num_rows($run_query) > 0) {
			echo '<div class="panel panel-info" id="scroll">
					<div class="panel-heading">Hot Products</div>
						<div class="panel-body">';
			while ($row = mysqli_fetch_assoc($run_query)) {
				$pro_id = $row['product_id'];
				$pro_title = $row['product_title'];
				$pro_image = $row['product_image'];
				$pro_price = $row['product_price'];
				$pro_brand=$row['product_brand'];
				echo "<div class='col-md-3 special-products-grid text-center'>
							
							<a  data-toggle='modal' data-target='#proImageModal' class='openModal'><img src='product_images/$pro_image' style='width:160px; height:250px;'/><input type='hidden' value='$pro_id' class='proModalID'></a></a>
							<h4><a href=''>$pro_title</a></h4>
							<a class='product-btn'><span>Rs.$pro_price</span><small>$pro_brand</small></a>
						</div>";
			}
			
		}
	} else {
		echo mysqli_error($con);
	}
}



	if(isset($_POST["get_seleted_Category"])){
		$id = $_POST["cat_id"];
		$sql = "SELECT * FROM products WHERE product_cat = '$id' and product_quantity!=0";
	    $run_query = mysqli_query($con,$sql);
	    
	
	while($row=mysqli_fetch_array($run_query)){
			$pro_id    = $row['product_id'];
			$pro_cat   = $row['product_cat'];
			$pro_brand = $row['product_brand'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_image = $row['product_image'];
			echo "
				<div class='col-md-3 special-products-grid text-center'>
							
							<a  data-toggle='modal' data-target='#proImageModal' class='openModal'><img src='product_images/$pro_image' style='width:160px; height:250px;'/><input type='hidden' value='$pro_id' class='proModalID'></a></a>
							<h4><a href=''>$pro_title</a></h4>
							<a class='product-btn'><span>Rs.$pro_price</span><small>$pro_brand</small></a>
						</div>	
			";
		}
	}




	if(isset($_POST["search"]))
	{
      $keyword = $_POST["keyword"];
	 $sql = "SELECT * FROM products WHERE product_title LIKE '%$keyword%' or product_cat LIKE '%$keyword%' OR product_brand LIKE '%$keyword%' and product_quantity!='0'";
     $run_query = mysqli_query($con,$sql);
	$search_results = mysqli_num_rows($run_query);
	if ($search_results == 0) {
		echo '<div class="panel panel-info" id="scroll">
					<div class="panel-heading">Searched Recipes</div>
						<div class="panel-body">
						<h2>No results found</h2>
						</div>
						</div>';
	}
	if (mysqli_num_rows($run_query) > 0) {
			echo '<div class="panel panel-info" id="scroll">
					<div class="panel-heading">Searched Recipes</div>
						<div class="panel-body">';
	while($row=mysqli_fetch_array($run_query)){
			$pro_id    = $row['product_id'];
			$pro_cat   = $row['product_cat'];
			$pro_brand = $row['product_brand'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_image = $row['product_image'];
			echo "
				<div class='col-md-3 special-products-grid text-center'>
							
							<a  data-toggle='modal' data-target='#proImageModal' class='openModal'><img src='product_images/$pro_image' style='width:160px; height:250px;'/><input type='hidden' value='$pro_id' class='proModalID'></a></a>
							<h4><a href=''>$pro_title</a></h4>
							<a class='product-btn'><span>Rs.$pro_price</span><small>$pro_brand</small></a>
						</div>

			";
		}
			
	}
}
	

									
	if(isset($_POST["addToProduct"])){
		
		if(isset($_SESSION["uid"])){
			$p_id = $_POST["proId"];
		$user_id = $_SESSION["uid"];
		$sql = "SELECT * FROM cart WHERE p_id = '$p_id' AND user_id = '$user_id' AND checkout_status=0";
		$run_query = mysqli_query($con,$sql);
		$count = mysqli_num_rows($run_query);
		if($count > 0){
			echo "
				<div class='alert alert-warning'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Product is already added into the cart Continue Shopping..!</b>
				</div>
			";
		} else {
			$sql = "SELECT * FROM products WHERE product_id = '$p_id'";
			$run_query = mysqli_query($con,$sql);
			$row = mysqli_fetch_array($run_query);
				$id = $row["product_id"];
				$pro_name = $row["product_title"];
				$pro_image = $row["product_image"];
				$pro_price = $row["product_price"];
			$sql = "INSERT INTO `cart` 
			(`id`, `p_id`, `ip_add`, `user_id`, `product_title`,
			`product_image`, `qty`, `price`, `total_amt`)
			VALUES (NULL, '$p_id', '0', '$user_id', '$pro_name', 
			'$pro_image', '1', '$pro_price', '$pro_price')";
			if(mysqli_query($con,$sql)){
				echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Recipe is Added..!</b>
					</div>
				";
			}
		}
		}else{
			echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Sorry..! Go Sign In Or Sign Up First then you can add a product to your cart</b>
					</div>
				";
		}
		
		
		
		
	}
if(isset($_POST["cart_checkout"])){
	$uid = $_SESSION["uid"];
	$sql = "SELECT * FROM cart WHERE user_id = '$uid' AND checkout_status=0";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	if($count > 0){
		$no = 1;
		$total_amt = 0;
		while($row=mysqli_fetch_array($run_query)){
			$id = $row["id"];
			$pro_id = $row["p_id"];
			$pro_name = $row["product_title"];
			$pro_image = $row["product_image"];
			$qty = $row["qty"];
			$pro_price = $row["price"];
			$total = $row["total_amt"];
			$price_array = array($total);
			$total_sum = array_sum($price_array);
			$total_amt = $total_amt + $total_sum;
			
			if(isset($_POST["get_cart_product"])){
				echo "
				<div class='row'>
					<div class='col-md-3 col-xs-3'>$no</div>
					<div class='col-md-3 col-xs-3'><img src='product_images/$pro_image' width='60px' height='50px'></div>
					<div class='col-md-3 col-xs-3'>$pro_name</div>
					<div class='col-md-3 col-xs-3'>Rs.$pro_price.00</div>
				</div>
			";
			$no = $no + 1;
			}else{
				echo "
					<div class='row'>
							<div class='col-md-2 col-sm-2'>
								<div class='btn-group'>
									<a href='#' remove_id='$pro_id' class='btn btn-danger btn-xs remove'><span class='glyphicon glyphicon-trash'></span></a>
									<a href='' update_id='$pro_id' class='btn btn-primary btn-xs update'><span class='glyphicon glyphicon-ok-sign'></span></a>
								</div>
							</div>
							<div class='col-md-2 col-sm-2'><img src='product_images/$pro_image' width='50px' height='60'></div>
							<div class='col-md-2 col-sm-2'>$pro_name</div>
							<div class='col-md-2 col-sm-2'><input type='text' class='form-control qty' pid='$pro_id' id='qty-$pro_id' value='$qty' ></div>
							<div class='col-md-2 col-sm-2'><input type='text' class='form-control price' pid='$pro_id' id='price-$pro_id' value='$pro_price' disabled></div>
							<div class='col-md-2 col-sm-2'><input type='text' class='form-control total' pid='$pro_id' id='total-$pro_id' value='$total' disabled></div>
						</div>
				";
			}
				
		}
		
		if(isset($_POST["cart_checkout"])){
			echo "<div class='row'>
				<div class='col-md-8'></div>
				<div class='col-md-4'>
					<h1>Total Rs.$total_amt</h1>
				</div>";
		}
		echo "<br>";
		echo '<button class="btn btn-danger btn-block checkoutbtn">Confirm</button>';
		
				
		
		
		
	}
}


if (isset($_POST['checkout'])) {
	$uid = $_SESSION["uid"];
	$sql_select = "SELECT cart.p_id, cart.user_id, cart.qty, cart.total_amt, first_name, last_name, email, mobile, address1, address2 FROM cart INNER JOIN user_info ON cart.user_id=user_info.user_id WHERE cart.user_id='$uid'";
	if ($run_select = mysqli_query($con, $sql_select)) {
		while ($row_select = mysqli_fetch_assoc($run_select)) {
			$p_id = $row_select['p_id'];
			$first_name = $row_select['first_name'];
			$last_name = $row_select['last_name'];
			$full_name = $first_name . " " . $last_name;
			$email = $row_select['email'];
			$mobile = $row_select['mobile'];
			$address1 = $row_select['address1'];
			$address2 = $row_select['address2'];
			$address = $address1 . " " . $address2;
			$orderdate = date("Y-m-d");
			$ordertime = date("h:i:sa");
			$qty = $row_select['qty'];

			$total_amt = $row_select['total_amt'];
			$sql = "INSERT IGNORE INTO customer_order (product_id, user_id, customer_name, customer_email, customer_phone, customer_address, order_date, order_time, qty, product_price,status) 
			VALUES ('$p_id', '$uid', '$full_name', '$email', '$mobile', '$address', '$orderdate', '$ordertime', '$qty', '$total_amt','0')";
			if (($run_query = mysqli_query($con,$sql))) echo "okay";
			
		    mysqli_query($con, "DELETE FROM cart WHERE p_id='$p_id' AND user_id='$uid' AND checkout_status=0");	
             mysqli_query($con, "UPDATE `products` SET `product_quantity`= `product_quantity`-'$qty' WHERE product_id='$p_id'");			
		}

	}
	
}

if(isset($_POST["cart_count"]) AND isset($_SESSION["uid"])){
	$uid = $_SESSION["uid"];
	$sql = "SELECT * FROM cart WHERE user_id = '$uid' AND checkout_status=0";
	$run_query = mysqli_query($con,$sql);
	echo mysqli_num_rows($run_query);
}
if(isset($_POST["removeFromCart"])){
	$pid = $_POST["removeId"];
	$uid = $_SESSION["uid"];
	$sql = "DELETE FROM cart WHERE user_id = '$uid' AND p_id = '$pid'";
	$run_query = mysqli_query($con,$sql);
	if($run_query){
		echo "
			<div class='alert alert-danger'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Recipe is Removed from Cart Continue Shopping..!</b>
			</div>
		";
	}
}

if(isset($_POST["updateProduct"])){
	$uid = $_SESSION["uid"];
	$pid = $_POST["updateId"];
	$qty = $_POST["qty"];
	$price = $_POST["price"];
	$total = $_POST["total"];
	
	$sql = "UPDATE cart SET qty = '$qty',price='$price',total_amt='$total' 
	WHERE user_id = '$uid' AND p_id='$pid'";
	$run_query = mysqli_query($con,$sql);
	if($run_query){
		echo "
			<div class='alert alert-success'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Recipe is Updated Continue Shopping..!</b>
			</div>
		";
	}
}

if (isset($_POST['editprofile'])) { ?>
	<?php
		$result = mysqli_query($con, "SELECT * FROM user_info WHERE user_id=".$_SESSION['uid']." LIMIT 1");
		$userinfo = mysqli_fetch_assoc($result);
		$f_name = $userinfo['first_name'];
		$l_name = $userinfo['last_name'];
		//$email = $userinfo['email'];
		$mobile = $userinfo['mobile'];
		$address1 = $userinfo['address1'];
		$address2 = $userinfo['address2'];
	?>
	<form method="post" id="editprofileform">
		<div class="row">
			<div class="col-md-6">
				<label for="f_name">First Name</label>
				<input type="text" id="f_name" name="f_name" class="form-control" value="<?php echo $f_name; ?>">
			</div>
			<div class="col-md-6">
				<label for="f_name">Last Name</label>
				<input type="text" id="l_name" name="l_name" class="form-control" value="<?php echo $l_name; ?>">
			</div>
		</div>
		<!-- <div class="row">
			<div class="col-md-12">
				<label for="email">Email</label>
				<input type="text" id="email" name="email" class="form-control" value="<?php echo $email; ?>">
			</div>
		</div> -->
		<div class="row">
			<div class="col-md-12">
				<label for="mobile">Mobile</label>
				<input type="text" id="mobile" name="mobile" class="form-control" value="<?php echo $mobile; ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<label for="address1">Address Line 1</label>
				<input type="text" id="address1" name="address1" class="form-control" value="<?php echo $address1; ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<label for="address2">Address Line 2</label>
				<input type="text" id="address2" name="address2" class="form-control" value="<?php echo $address2; ?>">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12">
				<input type="hidden" name="editing" value="1">
				<p id="err_profile">
					<br>
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<input style="float:right;" value="Submit" type="button" id="editprofile_submit_btn" name="editprofile_submit_btn" class="btn btn-success btn-lg">
			</div>
		</div>
	</form>
<?php }

if (isset($_POST['changepass'])) { ?>
	<?php
		$result = mysqli_query($con, "SELECT * FROM user_info WHERE user_id=".$_SESSION['uid']." LIMIT 1");
		$userinfo = mysqli_fetch_assoc($result);
		$f_name = $userinfo['first_name'];
		$l_name = $userinfo['last_name'];
		//$email = $userinfo['email'];
		$mobile = $userinfo['mobile'];
		$address1 = $userinfo['address1'];
		$address2 = $userinfo['address2'];
	?>
	<form method="post" id="changepassform">
		<div class="row">
			<div class="col-md-12">
				<label for="address2">Enter old password:</label>
				<input type="password" id="oldpassword" name="oldpassword" class="form-control">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<label for="password">Enter new password:</label>
				<input type="password" id="password" name="password" class="form-control">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<label for="repassword">Re-enter Password:</label>
				<input type="password" id="repassword" name="repassword" class="form-control">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12">
				<input type="hidden" name="changingpass" value="1">
				<p id="err_passchange">
					<br>
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<input style="float:right;" value="Submit" type="button" id="changepass_submit_btn" name="changepass_submit_btn" class="btn btn-success btn-lg">
			</div>
		</div>
	</form>
<?php }

if (isset($_POST['changingpass'])) {
	$oldpassword = $_POST['oldpassword'];
	$password = $_POST['password'];
	$repassword = $_POST['repassword'];
	if(empty($oldpassword) || empty($password) || empty($repassword)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>PLease fill all the fields..!</b>
			</div>
		";
		exit();
	}
	$result = mysqli_query($con, "SELECT password FROM user_info WHERE user_id=".$_SESSION['uid']." LIMIT 1");
	if($oldpassword != mysqli_fetch_assoc($result)['password']){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Old Password is incorrect</b>
			</div>
		";
		exit();
	}
	
	if(strlen($password) < 6 ){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Password is weak</b>
			</div>
		";
		exit();
	}
	if($password != $repassword){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Password is not same</b>
			</div>
		";
		exit();
	}
	$sql = "UPDATE user_info SET password='$password' WHERE user_id=".$_SESSION['uid']." LIMIT 1";
	$run_query = mysqli_query($con,$sql);
	if($run_query){
		die("changed");
	}



}
?>






























