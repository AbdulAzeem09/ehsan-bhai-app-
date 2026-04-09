<?php 
if (!defined('WEB_ROOT')) {
exit;
}
//print_r($_SESSION);

$sql =  "SELECT * FROM spmembership_transaction ";
$result  = dbQuery($dbConn, $sql);


?>


<style>
.dropbtn {
background-color: #6c757d;
color: white;
padding: 16px;
font-size: 16px;
border: none;
cursor: pointer;
}

.dropdown {
margin-left:20px;
position: relative;
display: inline-block;
}

.dropdown-content {
display: none;
position: absolute;
background-color: #f9f9f9;
min-width: 160px;
box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
z-index: 1;
}

.dropdown-content a {
color: black;
padding: 12px 16px;
text-decoration: none;
display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
display: block;
}

.dropdown:hover .dropbtn {
background-color: #3e8e41;
}
</style>	
<!-- Content Header (Page header) -->
<br>
<!--<p style="margin-left:10px;">
<a href="<?php echo WEB_ROOT_ADMIN.'my_earnings/?month=month'; ?>" class="btn btn-primary">This Month</a>
<a href="<?php echo WEB_ROOT_ADMIN.'my_earnings/?year=year'; ?>" class="btn btn-primary">This Year</a>
</p>-->
<form  action="" method="GET">
<div style="margin-left: 10px;">

Start Date:<input type="date" name="sdate" value="<?php echo $sdate; ?>" required>

End Date:<input type="date" name="edate" value="<?php echo $edate; ?>" required>

<input type="submit" value="Submit" name="submit" class="btn btn-primary">
<a href="index.php" class="btn btn-warning">Reset</a>
</form>

<a class="btn btn-success" style="margin-left: 200px;"href="<?php echo WEB_ROOT_ADMIN.'my_earnings/?day=day'; ?>">Last 7 Days</a>
<a class="btn btn-success" href="<?php echo WEB_ROOT_ADMIN.'my_earnings/?month=month'; ?>">Last 30 Days</a> 
<a class="btn btn-success" href="<?php echo WEB_ROOT_ADMIN.'my_earnings/?year=year'; ?>">One Year</a>
<a class="btn btn-success" href="<?php echo WEB_ROOT_ADMIN.'my_earnings/ ';?>">All</a>

</div>
<section class="content-header top_heading">
<div class="row">
<div class="col-md-4">
<h1>Earning By Modules </h1>
</div>
<?php 
if(isset($_GET['day']) == 'day'){ ?>
<div class="col-md-3">
<h2>Last 7 Days </h2>
</div>
<?php } elseif(isset($_GET['month']) == 'month'){ ?>
<div class="col-md-3">
<h2>This Month </h2>
</div>
<?php }  elseif(isset($_GET['year']) == 'year'){ ?>
<div class="col-md-3">
<h2>One Year</h2>
</div>
<?php }  else { ?>
<div class="col-md-4">
<h2></h2>
</div>
<?php }  ?>

<!--	<div class="col-md-4">
<div class="dropdown pull-right" style="padding-left:10px;">
<button class="dropbtn">Filter</button>
<div class="dropdown-content">
<a type="button" href="<?php echo WEB_ROOT_ADMIN.'my_earnings/?day=day'; ?>">Last 7 Days</a>
<a href="<?php echo WEB_ROOT_ADMIN.'my_earnings/?month=month'; ?>">Last 30 Days</a> 
<a href="<?php echo WEB_ROOT_ADMIN.'my_earnings/?year=year'; ?>">One Year</a>
<a href="<?php echo WEB_ROOT_ADMIN.'my_earnings/ ';?>">All</a>

</div>
</div>
</div>  -->
<div class="col-md-4">
<p">TOTAL SALES : USD  <span id="total_cad"></span> </p> 
<p> START DATE : _ _ _ TO END DATE : _ _ _ </p>
</div>
</div>
</section>


<!-- Main content -->
<section class="content">
<div class="box box-success">

<?php 
if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
if($_SESSION['count'] <= 1){
$_SESSION['count'] +=1; ?>
<div class="row" id="alertmsg" style="margin: 5px 0px 0px 5px;" >
<div style="min-height:10px;"></div>
<div class="alert alert-<?php echo $_SESSION['data'];?>">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<?php echo $_SESSION['errorMessage'];  ?>
</div> 
</div><?php
unset($_SESSION['errorMessage']);
}
} ?>

<div class="box-body" > 
<div class = "row ">
<div class= "col-md-3"><b>Modules</b></div>

<div class= "col-md-3"><b>Total Sales</b></div>

<div class= "col-md-3"><b>Total Earning</b></div>

<div class= "col-md-3"><b>Total Counts</b></div>

</div>

<?php 
$sql_n =  "SELECT * FROM tbl_admcommission ORDER BY comm_id DESC "; 
$result_n  = dbQuery($dbConn, $sql_n);

if ($result_n) {

$row_n = dbFetchAssoc($result_n);

$comm_amt = $row_n['comm_amt'];  
	}


?>

<?php   $sql5 =  "SELECT * FROM `spmembership_transaction` " ;
//echo $sql5;  
$result5  = dbQuery($dbConn, $sql5);

//print_r($result1);

if($result5) 
{   
$count5 = mysqli_num_rows($result5);
$amount5 = 0;
$total_earn5 = 0;

while($row5 = dbFetchAssoc($result5)){ 
// print_r($row1);
//$amount5 +=$row5['amount']; 
$int =$row5['amount']; 
if (filter_var($int, FILTER_VALIDATE_INT)) {
          $amount5 += $int;  
               } 

//$amount5 = 555525; 


$total_earn5 = $amount5* 0.01*$comm_amt;    

//echo $total_earn5 ;
}
} ?>
<br>
<div class = "row ">
<div class= "col-md-3"><b>Subscription</b></div>

<div class= "col-md-3"><b>USD</b> <?php echo  round($amount5 , 2 ) ; ?></div>

<div class= "col-md-3"><b>USD</b> <?php echo  round($amount5 , 2 ) ; ?></div>  

<div class= "col-md-3"><?php echo $count5 ; ?></div>

</div>


<?php 
/*$filter='week';

25

25 18

$sql = and colmne hjghjghjmgbhjk;

$sql1 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'store' AND status = '1'  $sql" ; */

if(isset($_GET['day']) == 'day'){

//echo "Today's date is :";
$today = date("Y-m-d");
//echo $today;

//echo "<br>";

// Add days to date and display it 
$date7= date('Y-m-d', strtotime($today. ' -7 days')); 

//echo " hello";

$sql1 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'store' AND status = '1'  AND action_date BETWEEN '$date7' AND  '$today'  " ;

} elseif(isset($_GET['month']) == 'month'){

$today = date("Y-m-d");

$date7= date('Y-m-d', strtotime($today. ' -30 days')); 

$sql1 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'store' AND status = '1'  AND action_date BETWEEN '$date7' AND  '$today'  " ;

} elseif(isset($_GET['submit']) == 'submit'){

$date7 = $_GET['sdate'];

$today = $_GET['edate']; 

$sql1 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'store' AND status = '1'  AND action_date BETWEEN '$date7' AND  '$today'  " ;

}  elseif(isset($_GET['year']) == 'year'){

$today = date("Y-m-d");

$date7= date('Y-m-d', strtotime($today. ' -365 days')); 

$sql1 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'store' AND status = '1'  AND action_date BETWEEN '$date7' AND  '$today'  " ;

} 

else{

$sql1 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'store' AND status = '1' " ;

}
//echo $sql1;    
$result1  = dbQuery($dbConn, $sql1);

//print_r($result1);

if($result1) 
{ 
$count = mysqli_num_rows($result1);
$amount1 = 0;
$total_earn = 0;

while($row1 = dbFetchAssoc($result1)){
// print_r($row1);
$amount1 +=$row1['amount'];   

$total_earn = $amount1* 0.01*$comm_amt;
}
} ?>
<br>
<div class = "row ">
<div class= "col-md-3"><b>Store</b></div>

<div class= "col-md-3"><b>USD</b> <?php echo  round($amount1 ,  2 ) ; ?></div>

<div class= "col-md-3"><b>USD</b> <?php echo round($total_earn , 2 ) ; ?></div>

<div class= "col-md-3"><?php echo $count ; ?></div>

</div>

<?php 
if(isset($_GET['day']) == 'day'){

$today = date("Y-m-d");

$date7= date('Y-m-d', strtotime($today. ' -7 days')); 

$sql3 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'realEstate' AND status = '1'  AND action_date BETWEEN '$date7' AND  '$today'  " ;

} elseif(isset($_GET['submit']) == 'submit'){

$date7 = $_GET['sdate'];

$today = $_GET['edate']; 

$sql3 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'realEstate' AND status = '1'  AND action_date BETWEEN '$date7' AND  '$today'  " ;

} elseif(isset($_GET['month']) == 'month'){

$today = date("Y-m-d");

$date7= date('Y-m-d', strtotime($today. ' -30 days')); 

$sql3 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'realEstate' AND status = '1'  AND action_date BETWEEN '$date7' AND  '$today'  " ;

}  elseif(isset($_GET['year']) == 'year'){

$today = date("Y-m-d");

$date7= date('Y-m-d', strtotime($today. ' -365 days')); 

$sql3 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'realEstate' AND status = '1'  AND action_date BETWEEN '$date7' AND  '$today'  " ;

} 

else{
$sql3 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'realEstate' AND status = '1'  " ;
}
//echo $sql3;
$result3  = dbQuery($dbConn, $sql3);

//print_r($result1);

if($result3) 
{ 
$count3 = mysqli_num_rows($result3);
$amount3 = 0;
$total_earn3 = 0;
while($row3 = dbFetchAssoc($result3)){
// print_r($row1);
$amount3+=$row3['amount'];

$total_earn3 = $amount3* 0.01*$comm_amt;
}
} ?>
<br>
<div class = "row ">
<div class= "col-md-3"><b>Real-Estate</b></div>

<div class= "col-md-3"><b>USD</b> <?php echo  round($amount3 , 2) ; ?></div>

<div class= "col-md-3"><b>USD</b> <?php echo round($total_earn3 , 2) ; ?></div>

<div class= "col-md-3"><?php echo $count3 ; ?></div>

</div>

<?php  
if(isset($_GET['day']) == 'day'){

$today = date("Y-m-d");

$date7= date('Y-m-d', strtotime($today. ' -7 days')); 

$sql4 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'artandcraft' AND status = '1'  AND action_date BETWEEN '$date7' AND  '$today'  " ;

} elseif(isset($_GET['submit']) == 'submit'){

$date7 = $_GET['sdate'];

$today = $_GET['edate']; 

$sql4 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'artandcraft' AND status = '1'  AND action_date BETWEEN '$date7' AND  '$today'  " ;

}  elseif(isset($_GET['month']) == 'month'){

$today = date("Y-m-d");

$date7= date('Y-m-d', strtotime($today. ' -30 days')); 

$sql4 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'artandcraft' AND status = '1'  AND action_date BETWEEN '$date7' AND  '$today'  " ;

}  elseif(isset($_GET['year']) == 'year'){

$today = date("Y-m-d");

$date7= date('Y-m-d', strtotime($today. ' -365 days')); 

$sql4 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'artandcraft' AND status = '1'  AND action_date BETWEEN '$date7' AND  '$today'  " ;

} 

else{
$sql4 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'artandcraft' AND status = '1' " ;
}
//echo $sql1;
$result4  = dbQuery($dbConn, $sql4);

//print_r($result1);

if($result4) 
{ 
$count1 = mysqli_num_rows($result4);
$amount2 = 0;
$total_earn_1 = 0;
while($row4 = dbFetchAssoc($result4)){
// print_r($row1);
//$amount2+=$row4['converted_currency'];
$amount2+=$row4['amount'];

$total_earn_1 = $amount2* 0.01*$comm_amt;
}
} ?>
<br>
<div class = "row ">
<div class= "col-md-3"><b>Art & Craft</b></div>

<div class= "col-md-3"><b>USD</b> <?php echo  round($amount2 , 2) ; ?></div>

<div class= "col-md-3"><b>USD</b> <?php echo round($total_earn_1 , 2) ; ?></div>

<div class= "col-md-3"><?php echo $count1 ; ?></div>

</div>

<?php  
if(isset($_GET['day']) == 'day'){

$today = date("Y-m-d");

$date7= date('Y-m-d', strtotime($today. ' -7 days')); 

$sql4 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'Video' AND status = '1'  AND action_date BETWEEN '$date7' AND  '$today'  " ;

} elseif(isset($_GET['submit']) == 'submit'){

$date7 = $_GET['sdate'];

$today = $_GET['edate']; 

$sql4 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'Video' AND status = '1'  AND action_date BETWEEN '$date7' AND  '$today'  " ;

}  elseif(isset($_GET['month']) == 'month'){

$today = date("Y-m-d");

$date7= date('Y-m-d', strtotime($today. ' -30 days')); 

$sql4 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'Video' AND status = '1'  AND action_date BETWEEN '$date7' AND  '$today ' " ;

}  elseif(isset($_GET['year']) == 'year'){

$today = date("Y-m-d");

$date7= date('Y-m-d', strtotime($today. ' -365 days')); 

$sql4 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'Video' AND status = '1'  AND action_date BETWEEN '$date7' AND  '$today'  " ;

} 

else{

$sql4 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'Video' AND status = '1' " ;
}
//echo $sql1;
$result4  = dbQuery($dbConn, $sql4);

//print_r($result1);

if($result4) 
{ 
$count4 = mysqli_num_rows($result4);
$amount4 = 0;
$total_earn4 = 0;
while($row4 = dbFetchAssoc($result4)){
// print_r($row1);
$amount4+=$row4['amount'];

$total_earn4 = $amount4* 0.01*$comm_amt;
}
} ?>
<br>
<div class = "row ">
<div class= "col-md-3"><b>Videos</b></div>

<div class= "col-md-3"><b>USD</b> <?php echo  round($amount4 , 2) ; ?></div>

<div class= "col-md-3"><b>USD</b> <?php echo round($total_earn4 , 2) ; ?></div>

<div class= "col-md-3"><?php echo $count4 ; ?></div>

</div>

<?php 
if(isset($_GET['day']) == 'day'){

$today = date("Y-m-d");

$date7= date('Y-m-d', strtotime($today. ' -7 days')); 

$sql4 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'event' AND status = '1'  AND action_date BETWEEN '$date7' AND  '$today'  " ;

} elseif(isset($_GET['submit']) == 'submit'){

$date7 = $_GET['sdate'];

$today = $_GET['edate']; 

$sql4 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'event' AND status = '1'  AND action_date BETWEEN '$date7' AND  '$today'  " ;

}  elseif(isset($_GET['month']) == 'month'){

$today = date("Y-m-d");

$date7= date('Y-m-d', strtotime($today. ' -30 days')); 

$sql4 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'event' AND status = '1'  AND action_date BETWEEN '$date7' AND  '$today'  " ;

}  elseif(isset($_GET['year']) == 'year'){

$today = date("Y-m-d");

$date7= date('Y-m-d', strtotime($today. ' -365 days')); 

$sql4 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'event' AND status = '1'  AND action_date BETWEEN '$date7' AND  '$today'  " ;

} 


else{

$sql4 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'event' AND status = '1' " ;

}
//echo $sql1;
$result4  = dbQuery($dbConn, $sql4);

//print_r($result1);

if($result4) 
{ 
$count4 = mysqli_num_rows($result4);
$amount6 = 0;
$total_earn6 = 0;
while($row4 = dbFetchAssoc($result4)){
// print_r($row1);
$amount6+=$row4['amount'];

$total_earn6 = $amount6* 0.01*$comm_amt;
}
} ?>
<br>
<div class = "row ">
<div class= "col-md-3"><b>Events</b></div>

<div class= "col-md-3"><b>USD</b> <?php echo  round($amount6 , 2) ; ?></div>

<div class= "col-md-3"><b>USD</b> <?php echo round($total_earn6 , 2) ; ?></div>

<div class= "col-md-3"><?php echo $count4 ; ?></div>

</div>

<?php 
if(isset($_GET['day']) == 'day'){

$today = date("Y-m-d");

$date7= date('Y-m-d', strtotime($today. ' -7 days')); 

$sql4 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'groupevent' AND status = '1'  AND action_date BETWEEN '$date7' AND  '$today'  " ;

} elseif(isset($_GET['submit']) == 'submit'){

$date7 = $_GET['sdate'];

$today = $_GET['edate']; 

$sql4 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'groupevent' AND status = '1'  AND action_date BETWEEN '$date7' AND  '$today'  " ;

}  elseif(isset($_GET['month']) == 'month'){

$today = date("Y-m-d");

$date7= date('Y-m-d', strtotime($today. ' -30 days')); 

$sql4 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'groupevent' AND status = '1'  AND action_date BETWEEN '$date7' AND  '$today'  " ;

}  elseif(isset($_GET['year']) == 'year'){

$today = date("Y-m-d");

$date7= date('Y-m-d', strtotime($today. ' -365 days')); 

$sql4 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'groupevent' AND status = '1'  AND action_date BETWEEN '$date7' AND  '$today'  " ;

} 


else{

$sql4 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'groupevent' AND status = '1' " ;

}
//echo $sql1;
$result4  = dbQuery($dbConn, $sql4);

//print_r($result1);

if($result4) 
{ 
$count4 = mysqli_num_rows($result4);
$amount7 = 0;
$total_earn7 = 0;
while($row4 = dbFetchAssoc($result4)){
// print_r($row1);
$amount7+=$row4['amount'];

$total_earn7 = $amount7* 0.01*$comm_amt;
}
} ?>
<br>
<div class = "row ">
<div class= "col-md-3"><b>Group Event</b></div>

<div class= "col-md-3"><b>USD</b> <?php echo  round($amount7 , 2) ; ?></div>

<div class= "col-md-3"><b>USD</b> <?php echo round($total_earn7 , 2) ; ?></div>

<div class= "col-md-3"><?php echo $count4 ; ?></div>

</div>



<?php 
if(isset($_GET['day']) == 'day'){

$today = date("Y-m-d");

$date7= date('Y-m-d', strtotime($today. ' -7 days')); 

$sql4 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'groupevent' AND status = '1'  AND action_date BETWEEN '$date7' AND  '$today'  " ;

} elseif(isset($_GET['submit']) == 'submit'){

$date7 = $_GET['sdate'];

$today = $_GET['edate']; 

$sql4 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'groupevent' AND status = '1'  AND action_date BETWEEN '$date7' AND  '$today'  " ;

}  elseif(isset($_GET['month']) == 'month'){

$today = date("Y-m-d");

$date7= date('Y-m-d', strtotime($today. ' -30 days')); 

$sql4 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'training' AND status = '1'  AND action_date BETWEEN '$date7' AND  '$today'  " ;

}  elseif(isset($_GET['year']) == 'year'){

$today = date("Y-m-d");

$date7= date('Y-m-d', strtotime($today. ' -365 days')); 

$sql4 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'training' AND status = '1'  AND action_date BETWEEN '$date7' AND  '$today'  " ;

} 


else{

$sql4 =  "SELECT * FROM `spwithdrawalreq_store`  WHERE module = 'training' AND status = '1' " ;

}
//echo $sql1;
$result4  = dbQuery($dbConn, $sql4);

//print_r($result1);

if($result4) 
{ 
$count4 = mysqli_num_rows($result4);
$amount7 = 0;
$total_earn7 = 0;
while($row4 = dbFetchAssoc($result4)){
// print_r($row1);
$amount7+=$row4['amount'];   

$total_earn7 = $amount7* 0.01*$comm_amt;   
}
} ?>
<br>
<div class = "row ">
<div class= "col-md-3"><b>Training</b></div>

<div class= "col-md-3"><b>USD</b> <?php echo  round($amount7 , 2) ; ?></div>

<div class= "col-md-3"><b>USD</b> <?php echo round($total_earn7 , 2) ; ?></div>

<div class= "col-md-3"><?php echo $count4 ; ?></div>

</div>













</div>


<!--- End Table ---------------->
</div>
<br><br>
<div class="box box-success">
<div class="box-body" > 

<div class= "row">

<?php   $sql6 =  "SELECT * FROM `spuser` " ;
//echo $sql1;
$result6  = dbQuery($dbConn, $sql6);

//print_r($result6);

if($result6) 
{ 
$count6 = mysqli_num_rows($result6);

} ?>
<div class= "col-md-3" style="border:2px solid black ; height:50px;margin-left:10px;">
<b>TOTAL REGISTERED USERS : </b><?php  echo $count6; ?>
</div>		
<?php 
$total_sales = $amount1+$amount2+$amount3+$amount4+$amount5+$amount6+$amount7;

?>
<div class= "col-md-3 " style="border:2px solid black ; height:50px;margin-left:150px;">
<b>TOTAL SALES : USD </b><?php  echo round($total_sales , 2); ?>
</div>
<?php 
$total_earning = $total_earn+$total_earn_1+$total_earn3+ $total_earn4+$total_earn5+$total_earn6+$total_earn7;


?>
<div class= "col-md-3 pull-right" style="border:2px solid black ; height:50px;margin-right:10px;">
<b>TOTAL EARNING : USD </b><?php  echo round($total_earning , 2); ?>
</div>
</div>

</div>
</div>

</section><!-- /.content -->
<script type="text/javascript">

 $('#total_cad').html('<?php echo $total_sales  ?>');
$(document).ready( function () {

var table = $('#example1').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );



} );

</script>	
