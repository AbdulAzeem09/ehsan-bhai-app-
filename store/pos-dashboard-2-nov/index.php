<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1); 

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
                     <div>
                        <a href="index.php" class="btn btn-outline-main shadowBox me-2"><span class="p-2 top-icon rounded "><i class="fas fa-home"></i> Home</span></a>
                     </div>
                     <div> 
                        <a href="#" class="btn btn-outline-main shadowBox me-2"><span class="p-2 top-icon rounded"><i class="fas fa-store"></i> Store</span></a>
                     </div>
                     <div style="width: 148px;"> 
                        <a href="add-product.php" class="btn btn-outline-main shadowBox me-2"><span class="p-2 top-icon rounded"><i class="fas fa-plus-square"></i> Add Products</span></a>
                     </div>
                     <div style="width: 137px;"> 
                        <a href="product-list.php" class="btn btn-outline-main shadowBox me-2"><span class="p-2 top-icon rounded"><i class="fas fa-list"></i> Product List</span></a>
                     </div>
                     <div> 
                        <a href="category.php" class="btn btn-outline-main shadowBox me-2"><span class="p-2 top-icon rounded"><i class="fas fa-code-branch"></i> Cartegories</span></a>
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
            <div class="row align-self-stretch">              
               <div class="col-md-4" >
			   <?php
                   $p = new _pos;
					
							$result = $p->read_peyment_amount($_SESSION['uid']);
							
					if ($result) {
						$i = 1;
						while ($row = mysqli_fetch_assoc($result)) {
							
							 $amount += (int)$row['payment_amount'];
							 $curr =  $row['currency'];
							
					} }//echo $amount;  //die('=====');
			   ?>
			   <style>
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
                <div id="spark1"><h4><?php echo $curr; ?>&nbsp;<?php echo $amount ;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="">Sales</span></h4></div>
               </div>
               <div class="col-md-4">
                  <div class="box box2  border-success border-top border-5 shadowBox">
                     <div id="spark2"><h4><?php echo $curr; ?>&nbsp;</h4></div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="box box3  border-success border-top border-5 shadowBox">
                     <div id="spark3"><h4><?php echo $curr; ?>&nbsp;</h4></div>
                  </div>
               </div>
            </div>

            <div class="row mt-5 mb-4">
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
            </div>

            <div class="row">
               <div class="col-lg-12 footer">                     
                  <span>Copyrights &copy; 2022 TheSharePage, All Reights Reserved</span>                    
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