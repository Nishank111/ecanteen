<?php
$link = mysqli_connect("localhost", "root", "", "result");
?>
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

<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8 col-xs-12">
<div class="panel panel-info">
          <div class="panel-heading">Check Result</div>
          <div class="panel-body">

      <form method="post" enctype="multipart/form-data" class="form-group">
Symbolno<br/> <input type="text" name="symbolno" id="symbolno" autocomplete="off" class="form-control" value=""><br/>
<p>
</br>
</p>
Semester

<select name="semester" class="btn btn-default dropdown-toggle" role="menu" id="selector">
  <option value="">Select...</option>
  <option value="1">First</option>
  <option value="2">Second</option>
  <option value="3">Third</option>
  <option value="4">Fourth</option>
  <option value="5">Fifth</option>
  <option value="6">Sixth</option>
  <option value="7">Seventh</option>
  <option value="8">Eighth</option>
  

</select>

Batch
<select name="year" class="btn btn-default dropdown-toggle" role="menu" id="selector">
  <option value="">Select...</option>
  <option value="2070">2070</option>
  <option value="2071">2071</option>
  
  <option value="2072">2072</option>
</select>

<p>
</br>
</p>

<input type="submit" name="View Result" value="View Result">
</form>
</div>
</div>
</div>
</div>

<?php 
if(isset($_POST['View Result']))
{
        $symbol=$_POST['symbolno'];
        $year=$_POST['year'];
        $semester=$_POST['semester'];

      }
      echo $symbol;
      ?>