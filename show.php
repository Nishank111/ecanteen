


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Dark Admin</title>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

    <!-- you need to include the shieldui css and js assets in order for the charts to work -->
    <link rel="stylesheet" type="text/css" />
    <link id="gridcss" rel="stylesheet" type="text/css"/>

    <script type="text/javascript"></script>
    <script type="text/javascript"></script>
</head>
<body>
   



<?php
$link = mysqli_connect("localhost", "root", "", "result");
if(isset($_POST['View Result']))
{
        $symbol=$_POST['symbolno'];
        $year=$_POST['year'];
        $semester=$_POST['semester'];
        $sql="SELECT symbol_number from student where symbol_number='$symbol'";
        $run_query = mysqli_query($link,$sql);
        $count = mysqli_num_rows($run_query);
        if(!$count > 0){
            header('location:result.php');
           // echo "No smbol Match ";

        }
        else{
        
            

        
        $sql="SELECT FirstName,symbol_number,TUReg from student where symbol_number='$symbol'";
         $query1=mysqli_query($link,$sql);
                    
                    while($row=mysqli_fetch_array($query1,MYSQLI_ASSOC))
                    {
                        
                        
                        $name=$row['FirstName'];
                        $roll=$row['symbol_number'];
                        $reg=$row['TUReg'];
                     
                    ?>
                 <div class="panel panel-info">
                   <div class="panel-heading">Result</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                        Name: <?php echo"$name"; ?>
                    </div>
                      <div class="col-md-6">
                        Registeration Number: <?php echo "$reg" ; ?>
                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    
                        Roll No: <?php echo"$roll"; ?> 
                        </br>Course:Four Years Bachelors    
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-xs-12"></div>
                          <div class="col-md-4 col-xs-12">
                              <h2> <?php echo "$year Year"; ?> :<?php echo "$semester Semester";?></h2>
                              </div>

                        <div class="col-md-4 col-xs-12"></div>
                    </div>
                        

                    
                                  
                    <?php
                }
            }
            
        }


?>


<div class="row">
    <div class="col-md-12 col-xs-12">
        <table class="table">
    <tr>
     <th>Course No</th>
    <th>Subject</th>
    <th colspan="4">Obtained Marks</th>
     
      <th>Credit hours</th>
       
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>Thoery</td>
    <td>Practical</td>
    <td>Assement</td>
    <td>total</td>
    <td></td>

  </tr>

<?php
$total=0;
$sql="SELECT result.course_id,subject.subject_name,theory_marks,pratical_marks,assessment_marks,result.sem_id,result.sem_id from result inner join subject on subject.course_id=result.course_id and subject.sem_id=result.sem_id where result.sem_id='$semester'and result.symbol_number='$symbol'";

 $query1=mysqli_query($link,$sql);
 while($row=mysqli_fetch_array($query1,MYSQLI_ASSOC)){
 $course=$row['course_id'];
 $sub=$row['subject_name'];
 $tmarks=$row['theory_marks'];
 $pmarks=$row['pratical_marks'];
 $asse=$row['assessment_marks'];
 $total=$tmarks+$pmarks+$asse;

  
 
?>




       <tr>
    <td><?php echo $course; ?></td>
    <td><?php echo $sub; ?></td>
    <td><?php echo $tmarks; ?></td>
    <td><?php echo $pmarks; ?></td>
    
    <td><?php echo $asse; ?></td>
    <td><?php echo $total;?></td>
     <td>3hrs</td>
  </tr>

  <?php } ?>

  </table> 


    </div>
</div>