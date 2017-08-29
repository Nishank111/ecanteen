

<?php 
session_start();
$link = mysqli_connect("localhost", "root", "", "ecanteen");
if(isset($_POST['delete']))
{
	header('location:users.php');
}
?>
<?php include 'header.php'; ?>


<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">

		<ol class="breadcrumb">
		  <li><a href="abc.php">Home</a></li>		  
		  <li class="active">Userlist</li>
		</ol>
         
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Users</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">
                  

				 				
				
				<table class="table">

					<thead>
						<tr>
							
							<th>User id</th>							
							<th>User Name</th>
							<th>Email</th>							
							<th>Addres1</th>
							<th>Addres2</th>
							
							
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
					
								<?php
$query="SELECT * FROM user_info";
$query1=mysqli_query($link,$query);


while($row=mysqli_fetch_array($query1,MYSQLI_ASSOC))
{   
    $uid=$row['user_id'];
    $fname=$row['first_name'];
    $lname=$row['last_name'];
    $email =$row['email'];
    $mobile=$row['mobile'];
    $address1=$row['address1'];
    $address2=$row['address2'];
    ?>

    <tr>
        <td width="200px"><?php echo $uid; ?></td>
        <td width="200px"><?php echo $fname; ?></td>
            
        <td width="200px"><?php echo $email; ?> </td>
        <td width="200px"><?php echo $address1; ?></td>
        <td width="200px"><?php echo $address2; ?></td>
        <form method="post">
        <td width="200px"><input type="submit" value="delete" name="delete" id="delete"></td>
        </form>
     </tr>

    
    <?php } ?>
</table>

				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->


<?php
if(isset($_POST['delete']))
{
    $query="DELETE FROM user_info WHERE user_id='$uid'";
    $query1=mysqli_query($link,$query);
    if(!$query1)
    {
        echo mysql_error($link);
    }
    
}
?>