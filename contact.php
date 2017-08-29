
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>TexasCanteen</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<script src="js/jquery2.js"></script>
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
	<div class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">	
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
			
				<li><a href="index.php" class="dropdown-toggle"><span class="glyphicon glyphicon-home"></span>&nbsp; Recipes</a>
					<div class="dropdown-menu">
						<div style="width:500px;">
							<div class="panel panel-primary">
								<div class="panel-heading"></div>
								<div class="panel-body">
									<div class="row">
											<div class="col-md-6 col-xs-6">
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
													
											<div class="col-md-6 col-xs-6">
													<h4>brand</h4>
												    <ul>
												    	<div id="get_brand">
				                                                    </div>
														<!-- <li>1</li>
														<li>2</li>
														<li>3</li>
														<li>4</li> -->
													</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
					
				<li style="width:300px;left:10px;top:10px;"><input type="text" class="form-control" id="search"></li>
				<li style="top:10px;left:20px;"><button class="btn btn-primary" id="search_btn">Search</button></li>
			    <li style="top:3px;left:20px;" ><a href="contact.php">&nbsp; Contact Us</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			
				<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>&nbsp; SignIn</a>
					<ul class="dropdown-menu">
						<div style="width:300px;">
							<div class="panel panel-primary">
								<div class="panel-heading">Login</div>
								<div class="panel-heading">
									<label for="email">Email</label>
									<input type="email" class="form-control" id="email" required/>
									<label for="email">Password</label>
									<input type="password" class="form-control" id="password" required/>
									<p><br/></p>
									<input type="submit" class="btn btn-success" style="float:right;" id="login" value="Login">
								</div>
								<div class="panel-footer" id="e_msg"></div>
							</div>
						</div>
					</ul>
				</li>
				<li><a href="customer_registration.php"><span class="glyphicon glyphicon-user"></span>&nbsp; SignUp</a></li>
			</ul>
		</div>
	</div>
</div>
<p><br/></p>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8" id="send_msg">
				<!--Alert from message form-->
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				
				<div class="panel panel-info">
					<div class="panel-heading">Contact Us</div>
					<div class="panel-body">
					<form method="post">
						<div class="row">
						<div class="col-md-6 col-xs-6">
						<label for="f_name">Full Name</label>
						<input type="text" id="fname" name="fname" class="form-control">
					</div>
					<div class="col-md-6 col-xs-6">
						<label for="f_name">Email Address</label>
						<input tpe="text" id="email" name="email" class="form-control">
					</div>

					  
					  	<div class="col-md-10 col-xs-10">
						<label for="f_name">Message</label>
						<input type="text" id="msg" name="msg" class="form-control">
					<p><br/></p>
				
						<input style="float:left;" value="Send" type="button" id="send_button" name="send_button" class="btn btn-success btn-lg">
					</div>

						
					</div>
					<div class="panel-footer" align="center"> @ecanteen2017</div>
				</div>
			</div>