<?php


/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/


require_once("../univ/baseurl.php" );
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="dashboard/";
include_once ("../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

$pageactive = 85; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../component/f_links.php');?>
<!--This script for posting timeline data End-->
<!-- ===========DSHBOARD LINKS================= -->
<?php include('../component/dashboard-link.php');?>
<!-- ===========PAGE SCRIPT==================== -->
<script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-checkbox.js" defer></script>
<style>
        .tagLine-max-char {

font-size: smaller;
font-weight: 600;

}
                        .dataTables_filter	{
                            margin-bottom:3px;
                        }
.dataTables_empty{text-align:center!important;}

    </style>
</head>
<body class="bg_gray" onload="pageOnload('details')">
<?php

include_once("../header.php");
?>

<section class="">
    <div class="container">
    <div class="row">
      <div class="col-sm-4"></div>
      <div class="col-sm-4 sh">
    <h1>Registration form</h1>
<form action="testinsert.php" method="post">
   <label for="email">First Name</label><br/>
    <input type="text" name="fname" id="" class="form-control" placeholder="enter first name"><br/><br/>
    <label for="email">Last Name</label><br/>
    <input type="text" name="lname" id="" class="form-control" placeholder="enter last name"><br/><br/>
    <label for="email">Mobile No.</label><br/>
    <input type="number" name="contactno" id="" class="form-control" placeholder="enter mobile no."><br/><br/>
    <label for="email">Email</label><br/>
    <input type="email" name="email" id=""class="form-control" placeholder="enter emailaddress"/><br/><br/>
    <label for="gender">Select Gender</label><br/>
    <input type="radio" name="gender" id="" value="male">Male
    <input type="radio" name="gender" id="" value="female">Female <br/><br/>

    <label for="">Country</label><br/>
    <input type="text" name="country" id="" class="form-control" placeholder="enter countery name"/><br/><br/>
    <label for="">Address</label><br/>
    <input type="text" name="address" id="" class="form-control" placeholder="enter address"/><br/><br/>
    <label for="">State</label><br/>
    <input type="text" name="state" id="" class="form-control" placeholder="enter state name"/><br/><br/>

    <label for="">Hobbies</label><br/>
    <input type="text" name="hobbies" id="" class="form-control" placeholder="enter your hobbies"/><br/><br/>
   

    <label for="">Birth</label><br/>
    <input type="date" name="birth" id="" class="form-control" placeholder="enter your birth" /><br/><br/>

    <label for="">Salary</label><br/>
    <input type="number" name="salary" id="" class="form-control" placeholder="enter your birth" /><br/><br/>


    <label for="">Password</label><br/>
    <input type="password" name="password" id="" class="form-control" placeholder="enter password"/><br/><br/>
    <button type="sumbit" id="shashi" class="btn btn-success ">sumbit</button>
</form>
<div class="col-sm-4"></div>
</div>
</div>
</div>
</section><br/><br/>

<section>
    <div class="container">
    <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">name</th>
      <th scope="col">contactno</th>
      <th scope="col">gender</th>
      <th scope="col">action</th>
      
      
      
    </tr>
  </thead>
  <tbody>

  <?php
  $i=1;
  $p = new _timelineflag;
  $record = $p->regshashi();
  if($record){
  while($res = mysqli_fetch_assoc($record)){
   ?>
    <tr>
      
      <td><?php echo $i++;?></td>
         
      <td><?php echo $res["name"] ;?></td>
          
      <td><?php echo $res["mob"] ;?></td>
          
      <td><?php echo $res["gender"];?></td>

      <td ><a href="deleteshashi.php?id=<?php echo $res["eid"]; ?>" class="btn btn-danger">Delete</a>
      <a href="update.php?id=<?php echo $res["eid"]; ?>" class="btn btn-danger">Update</a></td>
    </tr>
    <?php
  }
}
  ?>
    
  </tbody>
</table>

    </div>
</section>


<?php include('../component/f_footer.php');?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../component/f_btm_script.php'); ?>

<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
                            <!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
     


</body> 
</html>
<?php
} ?>





