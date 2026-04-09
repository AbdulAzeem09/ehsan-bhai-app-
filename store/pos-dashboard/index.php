<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/
include('../../univ/baseurl.php');
session_start();

if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="store/";
include_once ("../../authentication/islogin.php"); 

}else{
function sp_autoloader($class){
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET["categoryid"] = "1";
?>



<?php if(isset($_GET['pass']) == "wrong"){?>

<script>alert("You Have Entered Wrong Password ! Please Try Again.")</script>

<?php }
?>

<?php


if($_SESSION['ptid'] == 1 ){

//	if(($final_date >= 90) ){ 

$mb = new _spmembership;
$result = $mb->readpid($_SESSION['pid']);

if($result != false){

while($rows = mysqli_fetch_assoc($result)){
//print_r($rows);
$payment_date = $rows["createdon"];
$duration=$rows['duration'];

/*$res = $mb->readmember($rows["membership_id"]);
if($res != false)
{ 
$row = mysqli_fetch_assoc($res);
//echo $row["spMembershipName"]."<br>";
//$count=$row["spMembershipPostlimit"]; 
$duration=$row["duration"];*/

//print_r($row);
$date7 =  date('Y-m-d H:i:s');
$date8=date('Y-m-d', strtotime($date7));
$date5= date('Y-m-d', strtotime($payment_date));	
$date6= date('Y-m-d', strtotime($payment_date. ' +'. $duration.' days'));
//echo  $date5."<br>".$date6."<br>".$date8; die;
if(!(($date5 <= $date8)  && ($date6 >=  $date8))){ ?>
<script>
window.location.replace("/membership?msg=notaccess"); 
</script>

<?php   
}
//}
}
}
else {

?> 
<script>
window.location.replace("/membership?msg=notaccess");
</script>
<?php

}
//	}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Business Account & Inventory | TheSharepage </title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container-fluid">
<div class="row flex-nowrap">

<?php include('left_side_landing.php');?>  


<div class="col py-3">
<div class="row mb-4">
<div class="col-lg-12">
<div class="d-flex border-info border-top-main border-5 p-3 bg-light shadowBox">
<div >   
<a href="index.php" class="btn btn-outline-main shadowBox me-2"><span class="p-2 top-icon rounded "><i class="fas fa-home"></i> Home</span></a>
</div>
<div> 
<a href="<?php echo $BaseUrl?>/store" class="btn btn-outline-main shadowBox me-2"><span class="p-2 top-icon rounded"><i class="fas fa-store"></i> Store</span></a>
</div>
<div> 
<a href="add-product.php" class="btn btn-outline-main shadowBox me-2"><span class="p-2 top-icon rounded"><i class="fas fa-plus-square"></i>Products</span></a>
</div>
<div> 
<a href="product-list.php?key=all" class="btn btn-outline-main shadowBox me-2"><span class="p-2 top-icon rounded"><i class="fas fa-list"></i> Product</span></a>
</div>
<div> 
<a href="category.php" class="btn btn-outline-main shadowBox me-2 "><span class="top-icon rounded" style="padding: 10px 11px 7px 0px; "><i class="fas fa-code-branch "></i> Cartegories</span></a>
</div>
<div> 
<a href="brands.php" class="btn btn-outline-main shadowBox me-2"><span class="p-2 top-icon rounded"><i class="fas fa-tag"></i>  Brands</span></a>
</div>
<div> 
<a href="<?php echo $BaseUrl; ?>/store/pos-dashboard/pos.php" class="btn btn-outline-main shadowBox me-2"><span class="p-2 top-icon rounded"><i class="fas fa-cash-register"></i> POS</span></a>
</div>
<div> 
<a href="customer-list.php" class="btn btn-outline-main shadowBox me-2"><span class="p-2 top-icon rounded"><i class="fas fa-users"></i> Customers</span></a>
</div>
<div> 
<a href="supplier-list.php" class="btn btn-outline-main shadowBox me-2"><span class="p-2 top-icon rounded"><i class="fas fa-users"></i> Suppliers</span></a> 
</div>
</div>
</div>
</div>
<div class="row align-self-stretch mb-4">              
<div class="col-md-4" >
<div class="box box2  border-success border-top border-5 shadowBox">   
<?php
$p = new _pos;

$result = $p->read_peyment_amount($_SESSION['uid']);

if ($result) {
$i = 1;
$amount=0;
while ($row = mysqli_fetch_assoc($result)) {

$amount+= (int)$row['payment_amount'];
$curr =  $row['currency'];

} }//echo $amount;  //die('=====');

$current_motnh =  date('Y-m');              
$result1 = $p->read_peyment_months($_SESSION['uid'],$current_motnh);
if($result1){
while ($row1 = mysqli_fetch_assoc($result1)) {
$amount1+= (int)$row1['payment_amount'];
$curr =  $row1['currency'];
}
}  
$current_year =  date('Y-m');              
$result2 = $p->read_peyment_months($_SESSION['uid'],$current_year);
if($result2){
while ($row2 = mysqli_fetch_assoc($result2)) {
$amount2+= (int)$row2['payment_amount'];
}
}
?>
<style>
a.btn.btn-outline-main.shadowBox.me-2 {
width: 110px;
}
#spark1 text {
display: none;
}

#spark2 text {
display: none;
}

#spark3 text {
display: none;
}
</style>
<div id="1spark1"><h4><span class="">Total Sales:</span>&nbsp;<?php echo $curr; ?>&nbsp;<?php echo $amount ;?></h4></div>
</div>
</div>
<div class="col-md-4">
<div class="box box2  border-success border-top border-5 shadowBox">
<div id="1spark2"><h4><span class="">This Month:</span>&nbsp;<?php echo $curr; ?>&nbsp;<?php echo $amount1 ;?></h4></div>
</div>
</div>
<div class="col-md-4">
<div class="box box3  border-success border-top border-5 shadowBox">
<div id="1spark3"><h4><span class="">Half Year:</span>&nbsp;<?php echo $curr; ?>&nbsp;<?php echo $amount2 ;?></h4></div>
</div>
</div>
</div>

<!-- <div class="row mt-5 mb-4">
<div class="col-md-6">
<div class="box border-warning border-top border-5 p-5 shadowBox">
<div id="bar"></div>
</div>
</div>
<div class="col-md-6">
<div class="box border-warning border-top border-5 p-5 shadowBox">
<div id="donut"></div>
</div>
</div>
</div>
<div class="row mt-4 mb-4">
<div class="col-md-6">
<div class="box border-info border-top border-5 p-5 shadowBox">
<div id="area"></div>
</div>
</div>
<div class="col-md-6">
<div class="box border-info border-top border-5 p-5 shadowBox">
<div id="line"></div>
</div>
</div>
</div> -->
<?php 
// last month
$this_1 =  date("Y-m", strtotime("0 months"));
$this_2 =  date("Y-m", strtotime("-1 months"));
$this_3 = date("Y-m", strtotime("-2 months"));
$this_4 =  date("Y-m", strtotime("-3 months"));
$this_5 =  date("Y-m", strtotime("-4 months"));
$this_6 = date("Y-m", strtotime("-5 months"));
$this_7 =  date("Y-m", strtotime("-6 months"));
$this_8 =  date("Y-m", strtotime("-7 months"));
$this_9 = date("Y-m", strtotime("-8 months"));
$this_10 =  date("Y-m", strtotime("-9 months"));
$this_11 =  date("Y-m", strtotime("-10 months"));
$this_12 = date("Y-m", strtotime("-11 months"));

//   Query
$result_1 = $p->read_peyment_monthsto($_SESSION['uid'],$this_1);
$result_2 = $p->read_peyment_monthsto($_SESSION['uid'],$this_2);
$result_3 = $p->read_peyment_monthsto($_SESSION['uid'],$this_3);
$result_4 = $p->read_peyment_monthsto($_SESSION['uid'],$this_4);
$result_5 = $p->read_peyment_monthsto($_SESSION['uid'],$this_5);
$result_6 = $p->read_peyment_monthsto($_SESSION['uid'],$this_6);
$result_7 = $p->read_peyment_monthsto($_SESSION['uid'],$this_7);
$result_8 = $p->read_peyment_monthsto($_SESSION['uid'],$this_8);
$result_9 = $p->read_peyment_monthsto($_SESSION['uid'],$this_9);
$result_10 = $p->read_peyment_monthsto($_SESSION['uid'],$this_10);
$result_11 = $p->read_peyment_monthsto($_SESSION['uid'],$this_11);
$result_12 = $p->read_peyment_monthsto($_SESSION['uid'],$this_12);



$amount_1=0;
$amount_2=0;
$amount_3=0;
$amount_4=0;
$amount_5=0;
$amount_6=0;
$amount_7=0;
$amount_8=0;
$amount_9=0;
$amount_10=0;
$amount_11=0;
$amount_12=0;



if($result_1){
while ($row_1 = mysqli_fetch_assoc($result_1)) {
$amount_1+= (int)$row_1['payment_amount'];
}
}

if($result_2){
while ($row_2 = mysqli_fetch_assoc($result_2)) {
$amount_2+= (int)$row_2['payment_amount'];
}
}

if($result_3){
while ($row_3 = mysqli_fetch_assoc($result_3)) {
$amount_3+= (int)$row_3['payment_amount'];
}
}

if($result_4){
while ($row_4 = mysqli_fetch_assoc($result_4)) {
$amount_4+= (int)$row_4['payment_amount'];
}
}
if($result_5){
while ($row_5 = mysqli_fetch_assoc($result_5)) {
$amount_5+= (int)$row_5['payment_amount'];
}
}
if($result_6){
while ($row_6 = mysqli_fetch_assoc($result_6)) {
$amount_6+= (int)$row_6['payment_amount'];
}
}
if($result_7){
while ($row_7 = mysqli_fetch_assoc($result_7)) {
$amount_7+= (int)$row_7['payment_amount'];
}
}

if($result_8){
while ($row_8 = mysqli_fetch_assoc($result_8)) {
$amount_8+= (int)$row_8['payment_amount'];
}
}
if($result_9){
while ($row_9 = mysqli_fetch_assoc($result_9)) {
$amount_9+= (int)$row_9['payment_amount'];
}
}
if($result_10){
while ($row_10 = mysqli_fetch_assoc($result_10)) {
$amount_10+= (int)$row_10['payment_amount'];
}
}
if($result_11){
while ($row_11 = mysqli_fetch_assoc($result_11)) {
$amount_11+= (int)$row_11['payment_amount'];
}
}
if($result_12){
while ($row_12 = mysqli_fetch_assoc($result_12)) {
$amount_12+= (int)$row_12['payment_amount'];
}
}




// old date
  $month_1 =  date("M-Y", strtotime("0 months"));
  $month_2 =  date("M-Y", strtotime("-1 months"));
  $month_3 =  date("M-Y", strtotime("-2 months"));
  $month_4 =  date("M-Y", strtotime("-3 months"));
  $month_5 =  date("M-Y", strtotime("-4 months"));
  $month_6 =  date("M-Y", strtotime("-5 months"));
  $month_7 =  date("M-Y", strtotime("-6 months"));
  $month_8 =  date("M-Y", strtotime("-7 months"));
  $month_9 =  date("M-Y", strtotime("-8 months"));
  $month_10 =  date("M-Y", strtotime("-9 months"));
  $month_11 =  date("M-Y", strtotime("-10 months"));
  $month_12 =  date("M-Y", strtotime("-11 months"));




//Query 22222222222
$result_111 = $p->read_peyment_monthexpe($_SESSION['pid'],$_SESSION['uid'],$this_1);
$result_22 = $p->read_peyment_monthexpe($_SESSION['pid'],$_SESSION['uid'],$this_2);
$result_33 = $p->read_peyment_monthexpe($_SESSION['pid'],$_SESSION['uid'],$this_3);
$result_44 = $p->read_peyment_monthexpe($_SESSION['pid'],$_SESSION['uid'],$this_4);
$result_55 = $p->read_peyment_monthexpe($_SESSION['pid'],$_SESSION['uid'],$this_5);
$result_66 = $p->read_peyment_monthexpe($_SESSION['pid'],$_SESSION['uid'],$this_6);
$result_77 = $p->read_peyment_monthexpe($_SESSION['pid'],$_SESSION['uid'],$this_7);
$result_88 = $p->read_peyment_monthexpe($_SESSION['pid'],$_SESSION['uid'],$this_8);
$result_99 = $p->read_peyment_monthexpe($_SESSION['pid'],$_SESSION['uid'],$this_9);
$result_101 = $p->read_peyment_monthexpe($_SESSION['pid'],$_SESSION['uid'],$this_10);
$result_1111 = $p->read_peyment_monthexpe($_SESSION['pid'],$_SESSION['uid'],$this_11);
$result_1211 = $p->read_peyment_monthexpe($_SESSION['pid'],$_SESSION['uid'],$this_12);




//fuctionsssss
$amount_111=0;
$amount_22=0;
$amount_33=0;
$amount_44=0;
$amount_55=0;
$amount_66=0;
$amount_77=0;
$amount_88=0;
$amount_99=0;
$amount_101=0;
$amount_1111=0;
$amount_1211=0;


if($result_111){
   while ($row_111 = mysqli_fetch_assoc($result_111)) {
   $amount_111+= (int)$row_111['amount'];
   }
   }

if($result_22){
   while ($row_22 = mysqli_fetch_assoc($result_22)) {
   $amount_22+= (int)$row_22['amount'];
   }
   }
if($result_33){
   while ($row_33 = mysqli_fetch_assoc($result_33)) {
   $amount_33+= (int)$row_33['amount'];
   }
   }
if($result_44){
   while ($row_44 = mysqli_fetch_assoc($result_44)) {
   $amount_44+= (int)$row_44['amount'];
   }
   }        
if($result_55){
   while ($row_55 = mysqli_fetch_assoc($result_55)) {
   $amount_55+= (int)$row_55['amount'];
   }
   }

   if($result_66){
      while ($row_66 = mysqli_fetch_assoc($result_66)) {
      $amount_66+= (int)$row_66['amount'];
      }
      }


    if($result_77){
      while ($row_77 = mysqli_fetch_assoc($result_77)) {
      $amount_77+= (int)$row_77['amount'];
      }
      }
    
    if($result_88){
      while ($row_88 = mysqli_fetch_assoc($result_88)) {
      $amount_88+= (int)$row_88['amount'];
      }
      }
    if($result_99){
      while ($row_99 = mysqli_fetch_assoc($result_99)) {
      $amount_99+= (int)$row_99['amount'];
      }
      }
      if($result_101){
        while ($row_101 = mysqli_fetch_assoc($result_101)) {
        $amount_101+= (int)$row_101['amount'];
        }
        }
    if($result_1111){
      while ($row_1111 = mysqli_fetch_assoc($result_1111)) {
      $amount_1111+= (int)$row_1111['amount'];
      }
      }        
    if($result_1211){
      while ($row_1211 = mysqli_fetch_assoc($result_1211)) {
      $amount_1211+= (int)$row_1211['amount'];
      }
      }
    

// Holiday
$result_121 = $p->read_holiday_month($_SESSION['pid'],$_SESSION['uid'],$this_1);
$result_212 = $p->read_holiday_month($_SESSION['pid'],$_SESSION['uid'],$this_2);
$result_313 = $p->read_holiday_month($_SESSION['pid'],$_SESSION['uid'],$this_3);
$result_414 = $p->read_holiday_month($_SESSION['pid'],$_SESSION['uid'],$this_4);
$result_515 = $p->read_holiday_month($_SESSION['pid'],$_SESSION['uid'],$this_5);
$result_616 = $p->read_holiday_month($_SESSION['pid'],$_SESSION['uid'],$this_6);




//fuctionsssss
$amount_121=0;
$amount_212=0;
$amount_313=0;
$amount_414=0;
$amount_515=0;
$amount_616=0;


if($result_121->num_rows > 0){
  $day1 = $result_121->num_rows;
   }else{
   $day1 = 0;
   }

if($result_212->num_rows > 0){
   $day2 = $result_212->num_rows;
   }else{
      $day2 = 0;
   }
if($result_313->num_rows > 0){
   $day3 = $result_313->num_rows;
    }else{
    $day3 = 0;
    }
if($result_414->num_rows > 0){
   $day4 = $result_414->num_rows;
    }else{
    $day4 = 0;
    }
if($result_515->num_rows > 0){
   $day5 = $result_515->num_rows;
    }else{
    $day5 = 0;
    }

   if($result_616->num_rows > 0){
      $day6 = $result_616->num_rows;
       }else{
       $day6 = 0;
       }
?>



<div class="col-md-12">
<div class="box border-info border-top border-5 mb-3 shadowBox">
<canvas id="myChart" style="width: 1045px;display: block;height: 400px;" class="pb-3"></canvas>
</div>
</div>

<div class="row mt-4 mb-4">
<div class="col-md-6">
<div class="box border-info border-top border-5 p-5 shadowBox" style="max-height: 531px !important;">
<canvas id="myChartto" style="width: 410px;display: block;height: 410px;" ></canvas>
</div>
</div>
<div class="col-md-6">
<div class="box border-info border-top border-5 p-5 shadowBox" style="max-height: 531px !important;">
<canvas id="myChartthre" style="width: 410px;display: block;height: 410px;"></canvas>
</div>
</div>
</div>
<div class="col-md-12 mb-4">
<div class="box border-info border-top border-5 mb-3 shadowBox"style="max-height: 531px !important;">
<div class="text-center">
<b>12 Months Sales vs Expense</b>
</div>
<canvas id="myChartfore" style="width: 1045px;display: block;height: 400px;"></canvas>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<!-- first chart -->
<script>
var xValues = ["<?php echo $month_1; ?>", "<?php echo $month_2; ?>", "<?php echo $month_3; ?>", "<?php echo $month_4; ?>", "<?php echo $month_5; ?>", "<?php echo $month_6; ?>", "<?php echo $month_7; ?>", "<?php echo $month_8; ?>", "<?php echo $month_9; ?>", "<?php echo $month_10; ?>", "<?php echo $month_11; ?>", "<?php echo $month_12; ?>"];
var yValues = [<?php echo $amount_1;?>, <?php echo $amount_2;?>, <?php echo $amount_3;?>,<?php echo $amount_4;?>, <?php echo $amount_5;?>, <?php echo $amount_6;?>, <?php echo $amount_7;?>, <?php echo $amount_8;?>, <?php echo $amount_9;?>, <?php echo $amount_10;?>, <?php echo $amount_11;?>, <?php echo $amount_12;?>];
var barColors = ["red","green","blue","orange","brown","purple","brown","olive","magenta","teal","mint","charcoal"];

new Chart("myChart", {
type: "bar",
data: {
labels: xValues,
datasets: [{
backgroundColor: barColors,
data: yValues
}]
},
options: {
legend: {display: false},
title: {
display: true,
text: "12 Month Sales(All Amount are in (<?php echo $curr; ?>))"
}
}
});

// seconde chart

var xValues = ["<?php echo $month_1; ?>", "<?php echo $month_2; ?>", "<?php echo $month_3; ?>", "<?php echo $month_4; ?>", "<?php echo $month_5; ?>", "<?php echo $month_6; ?>"];

var yValues = [<?php echo $amount_111;?>, <?php echo $amount_22;?>, <?php echo $amount_33;?>, <?php echo $amount_44;?>, <?php echo $amount_55;?>, <?php echo $amount_66;?>];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145",
  "#00b33c"
];

new Chart("myChartto", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "6 Month Expenses(All Amount are in (<?php echo $curr; ?>))"
    }
  }
});

// tharde chart

var xValues = ["<?php echo $month_1; ?>", "<?php echo $month_2; ?>", "<?php echo $month_3; ?>", "<?php echo $month_4; ?>", "<?php echo $month_5; ?>", "<?php echo $month_6; ?>"];

var yValues = [<?php echo $day1;?>, <?php echo $day2;?>, <?php echo $day3;?>, <?php echo $day4;?>, <?php echo $day5;?>, <?php echo $day6;?>];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145",
  "#00b33c"
];

new Chart("myChartthre", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Holiday"
    }
  }
});




</script>
<script>
const xValuese = ["<?php echo $month_1; ?>","<?php echo $month_2; ?>","<?php echo $month_3; ?>","<?php echo $month_4; ?>","<?php echo $month_5; ?>","<?php echo $month_6; ?>","<?php echo $month_7; ?>","<?php echo $month_8; ?>","<?php echo $month_9; ?>","<?php echo $month_10; ?>","<?php echo $month_11; ?>","<?php echo $month_12; ?>"];

new Chart("myChartfore", {
  type: "line",
  data: {
    labels: xValuese,
    datasets: [{ 
      data: [<?php echo $amount_1;?>,<?php echo $amount_2;?>,<?php echo $amount_3;?>,<?php echo $amount_4;?>,<?php echo $amount_5;?>,<?php echo $amount_6;?>,<?php echo $amount_7;?>,<?php echo $amount_8;?>,<?php echo $amount_9;?>,<?php echo $amount_10;?>,<?php echo $amount_11;?>,<?php echo $amount_12;?>],
      borderColor: "red",
      fill: false
    }, { 
      data: [<?php echo $amount_111;?>,<?php echo $amount_22;?>,<?php echo $amount_33;?>,<?php echo $amount_44;?>,<?php echo $amount_55;?>,<?php echo $amount_66;?>,<?php echo $amount_77;?>,<?php echo $amount_88;?>,<?php echo $amount_99;?>,<?php echo $amount_101;?>,<?php echo $amount_1111;?>,<?php echo $amount_1211;?>],
      borderColor: "green",
      fill: false
    }]
  },
  options: {
    legend: {display: false}
  }
});
</script>

<div class="row">
<div class="col-lg-12 footer">                     
<span>Copyrights &copy; 2022 TheSharePage, All Rights Reserved</span>                    
</div>
</div>
</div>
</div>
</div>
<!------------------------------------------ Scripts Files ------------------------------------------>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="js/data.js"></script>
<script src="js/custom-chart.js"></script> 
</body>
</html>

<?php } ?>   