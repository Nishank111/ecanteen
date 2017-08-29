<?php
session_start();
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>TexasCanteen</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<script src="js/jquery2.js"></script>
			<link href="css/style.css" rel='stylesheet' type='text/css' />
		<script src="js/bootstrap.min.js"></script>
		<script src="main.js"></script>
		<style>
			@media screen and (max-width:480px){
				#search{width:80%;}
				#search_btn{width:30%;float:right;margin-top:-32px;margin-right:10px;}
			}
			#gototoplink{
				text-decoration: none;
				color: inherit;
			}
			#gototop{
				opacity:0.25;
				background-color: #000;
				color: #ffffff;
				position: fixed;
				bottom: 10px;
				right: 10px;
				width: 50px;
				height: 50px;
				font-size: 20px;
				border-radius: 7px 7px 0 0;
				box-sizing: border-box;
				z-index: 1;
			}
			#gototop:hover{
				opacity: 0.8;
			}
		</style>
	</head>
<body>
	<div class="container">
			<!----top-header---->
			<div class="top-header">
				<div class="logo">
					<a href="profile.php"><img src="images/canteen.png" title="barndlogo" style="height: 80px;width: 250px;"></a>
				</div>
				<div class="top-header-info">
					<div class="top-contact-info">
						<ul class="unstyled-list list-inline">
							<li><span class="phone"> </span>01-4479017</li>
							<li><span class="mail"> </span><a href="">ecanteen@gmail.com</a></li>
							<div class="clearfix"> </div>
						</ul>
					</div>
					<a href="profile.php"><img src="images/welcome.jpg" title="welcomelogo" style="height: 100px;width: 300px;"></a>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="navbar navbar-default">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
					<span class="sr-only">navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="#" class="navbar-brand">TexasCanteen</a>
			</div>
	<div class="collapse navbar-collapse" id="collapse">
			<ul class="nav navbar-nav">
				<li><a href="index.php"><span class="glyphicon glyphicon-home"></span>&nbsp; Home</a></li>
			
				 <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-modal-window"></span>&nbsp; Recipes</a>
					<div class="dropdown-menu">
						<div style="width:200px;">
							<div class="panel panel-danger">
								<div class="panel-heading"></div>
								<div class="panel-body">
									
			                     <h4>categories</h4>
												    <ul>
												    	<div id="get_category">
				                                               </div>
														<!-- <li>1</li>
														<li>2</li>
														<li>3</li>
														<li>4</li> -->
													</ul>
												</div>
										</div>
							</div>
					
				<li style="width:300px;left:10px;top:10px;"><input type="text" class="form-control" id="search"></li>
				<li style="top:10px;left:20px;"><button class="btn btn-primary" id="search_btn">Search</button></li>
			    <li style="width:300px;left:10px;top:1px;"><a href="contact.php"></span>&nbsp; Contact Us</a></li>
			</ul>
				<ul class="nav navbar-nav navbar-right">
				<li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart">&nbsp;</span>My order<span class="badge">0</span></a>
					
				
				
				<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><?php echo "Hi, ".$_SESSION["name"]; ?></a>
					<ul class="dropdown-menu">
						<li><a href="cart.php" style="text-decoration:none; color:blue;"><span class="glyphicon glyphicon-shopping-cart">Order</a></li>
						<li class="divider"></li>
						<li><a href="" data-toggle='modal' data-target='#editProfileModal' class="editprofile" style="text-decoration:none; color:blue;">Edit Profile</a></li>
						<li class="divider"></li>
						<li><a href="" data-toggle='modal' data-target='#changePassModal' style="text-decoration:none; color:blue;">Change Password</a></li>
						<li class="divider"></li>
						<li><a href="logout.php" style="text-decoration:none; color:blue;">Logout</a></li>
					</ul>
				</li>
				
			</ul>
		</div>
	</div>
</div>	

	
	<div class="container-fluid">
		<div class="row">
					<div class="col-md-10 col-xs-12">
					</div>	
				</div>
				<div class="row">
					<div class="col-md-12 col-xs-12" id="recipes_msg">

					</div>
				</div>
				 <div class="row">
				 <div class="col-md-12 col-xs-12">
                     <div id="get_search"></div>
					  
					 <div class="recomended"></div>
                   	 <div class=""></div>

					</div>
			 </div>
				
				<div class="row">
					<!-- <div class="col-md-2 col-xs-12">
					 <div class="recommended"></div>
					</div> -->
					<div class="col-md-12 col-xs-12">
			<div class="special-products">
					<div class="s-products-head">
						<div class="s-products-head-left">
							<h3><span>Recipes</span></h3>
						</div>
						
						<div class="clearfix"> </div>
					</div>
					<!----special-products-grids---->
					<div class="special-products-grids">
						<div id="get_product"></div>
						
						<div class="clearfix"> </div>
					</div>
					<!---//special-products-grids---->
				</div>
			</div>
			
		</div>

	<a href="#top" id="gototoplink"><button id="gototop"><span class="glyphicon glyphicon-circle-arrow-up"></span></button></a>

	<div id="proImageModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<div class="modal-content">
				
			</div>

		</div>
	</div>

	<div id="editProfileModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<div class="modal-content">
				<div class="modal-header">
			    	<b class="modal-title" id="modalLabel">Edit Profile</b>
			    	<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff;">
			        <span aria-hidden="true">&times;</span>
			    	</button>
				</div>
				<div class="modal-body">
					<div style="height: 300px;"></div>
				</div>
			</div>

		</div>
	</div>

	<div id="changePassModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<div class="modal-content">
				<div class="modal-header">
			    	<b class="modal-title" id="modalLabel">Change Password</b>
			    	<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff;">
			        <span aria-hidden="true">&times;</span>
			    	</button>
				</div>
				<div class="modal-body">
					<div style="height: 300px;"></div>
				</div>
			</div>

		</div>
	</div>




	<div class="footer">
				<div class="container">
					<div class="col-md-3 footer-logo">
						<a href="profile.php"><img src="images/canteen.png" title="barndlogo" style="height: 100px;width: 300px;"></a>
					</div>
					<div class="col-md-7"></div>
					<div class="col-md-2 footer-social">
						<ul class="unstyled-list list-inline">
							<li><a class="pin" href="#"><span> </span></a></li>
							<li><a class="twitter" href="#"><span> </span></a></li>
							<li><a class="facebook" href="#"><span> </span></a></li>
							<div class="clearfix"> </div>
						</ul>
					</div>
					<div class="clearfix"> </div>
				</div>
			 </div>
			 <div class="clearfix"> </div>
		
					<div class="copy-right">
						<div class="container">
							<p>Project By Texas CSIT STUDENT</a></p>
							
							
						</div>
					</div>
</body>
</html>