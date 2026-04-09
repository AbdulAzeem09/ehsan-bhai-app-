<?php
/*ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);*/

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

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sales Record | TheSharepage-POS </title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container-fluid">
<div class="row flex-nowrap">

<?php include('left_side_landing.php');?>  

   <div class="col py-3">
      <div class="row mb-4">
         <div class="col-12">
      <?php if($_GET['msg'] == "success"){ 
         
         unset($_SESSION['success']);
         unset($_SESSION['code_opt']);
         ?>
   
   <div class="alert alert-success" role="alert">
You OTP has verified!
         </div>

   <?php }
      ?>
            <h3> Sales Record</h3>
         <?php if($_GET['action']=="all"){ ?>
         <form action="pos_sales_record.php" method="get">
            <div class="row">				 
               <div class="col-2 mb-3">
                  <input type="number" class="form-control" name = "phone" id="phone_" placeholder="Enter Phone Number:" aria-label="Customer ID:" aria-describedby="addon-wrapping">
               </div>
               <div class="col-2">
                  <button type="submit"  class="btn btn-main">Search</button> 
               </div>					 
            </div>
         </form>				 			
            <div class="info"></div>				  				  				  
            <table id="table_id" class="display" data-page-length='10'>
               <thead>
               <tr>
               <th>Name</th>
               <th>Phone</th>
               <th>Date</th>
               <th>Sub Total</th>
               <th>Total Discount2</th>
               <th>Grand Total</th>
               
               <th>Status</th>
               <th>Biller Name</th>                                        
               <th>View</th>
            </tr>
         </thead>
         <tbody>
      
         <?php
      $urlid = $_GET['postid'];	
      $id = $_GET['id'];				
      $p = new _pos;	
      
      $result = $p->read_pos_customer_uid1($_SESSION['uid'],$urlid);

      $result = $p->read_pos_customer_uid($_SESSION['uid']);
         if ($result) {
            $i = 1;
            while ($row = mysqli_fetch_assoc($result)) {							
               //print_r($row); die('------'); 
               $customer_id = $row['customer_id'];							
               $result_2 = $p->cust_name($customer_id);
            if($result_2){						 
               $sdata = mysqli_fetch_assoc($result_2);
               $customername= $sdata['customer_name'];
               $phone= $sdata['phone'];
            // $email=$data['spUserEmail'];
            }	                          												
         ?>
         
            <tr>
               <td> <?php echo $customername;  ?></td>
               <td><?php echo $phone; ?></td> 
               <td><?php echo $row['date']; ?></td>
               <td><?php echo $row['currency']; ?>&nbsp;<?php echo $row['sub_total']; ?></td>
               <td><?php echo $row['currency']; ?>&nbsp;<?php echo $row['discount_by_net'] ; ?> </td>
               <td><?php echo $row['currency']; ?>&nbsp;<?php echo $row['total_by_net']; ?></td>
               
               <td>
                  <?php
                  if($row['status'] == 0){
                     echo "<button class='btn btn-danger'>Pending</button>";
                  }elseif($row['status'] == 1){
                     echo "<button class='btn btn-success'>Success</button>";
                  }
                  ?>
               </td>    
               <td>
               <?php  if($row['biller_id']){
                      $r = $p->read_employe_name($row['biller_id']);
                     if ($r) {
                         $row1 = mysqli_fetch_assoc($r);
                     }
                     echo $row1['name'];
                  } 
                  ?>         
               </td>                   
               <td><a href="<?php echo $BaseUrl; ?>/store/pos-dashboard/history_sales.php?id=<?php echo $row['id'];  ?>"><i class="fas fa-eye me-1"></i></a></td> 
            
         
            </tr>
         <?php }} ?>
            
            </tr>
            
         </tbody>
      </table>
         <?php } ?>
   <?php if($_GET['phone']){  ?>  
   
   
      <form action="pos_sales_record.php?action=filter" method="post"> 
            <div class="row">
         
               <div class="col-2 mb-3">
                  <input type="number" class="form-control" value="<?php echo $_GET['phone']; ?>" name = "phone" id="phone_" placeholder="Enter Phone Number:" aria-label="Customer ID:" aria-describedby="addon-wrapping">
               </div>
               <!--<div class="col-4">
                  <select class="form-control form-select js-example-basic-multiple" id="inputGroupSelect02" name="customer">
                     <option value="1">Jhone</option>
                     <option value="2">Dave</option>
                     <option value="3">Yusha</option>
                  </select>
               </div>-->
               <div class="col-2">
                  <input type="date" class="form-control" name="start_date" placeholder="Choose Date Start"  aria-describedby="addon-wrapping">
               </div>
               <div class="col-2">
                  <input type="date" class="form-control"  name ="end_date" placeholder="Choose Date End"  aria-describedby="addon-wrapping" >
               </div>
               <div class="col-2">
                  <select class="form-select" name="employe" id="employe" aria-label="Default select example">
                  <option selected value="">Choose Biller</option>
                  <?php 
                  $p = new _pos;  
                  $useam=$p->read_employes($_SESSION['pid'], $_SESSION['uid']);
                     if($useam!=false){
                    while ($roweam = mysqli_fetch_assoc($useam)) {
                    
                   
                  ?>
                  <option value="<?php echo $roweam['id']; ?>"><?php echo $roweam['name']; ?></option>
                  <?php }
                     }
                  ?>
                  </select>
               </div>
               <div class="col-1">
                  <button type="submit" name="filter2" class="btn btn-main">Search</button> 
               </div>
            
            <div class="col-1">
                  <a href="pos_sales_record.php?action=all"  class="btn btn-secondary">Reset</a> 
               </div>
            
            </div>
         </form>
         
         
         <div class="p-3">
         <?php
      
      $phone = $_GET['phone'];
      //echo $phone;
      //die('===');
      
         $p = new _pos;
         
               //$result_2 = $p->read_data_phone($phone);
               //print_r($result_2);
               //die('=====11');
                  if($result_2){	
            

               //$data = mysqli_fetch_assoc($result_2);  
            // print_r($data);
               //die('=======');
               $customername= $data['spUserName'];
            // echo $customername;
               //die('===');
               $phone= $data['spUserPhone'];
               //echo $phone;
            // die('==');
               $email=$data['spUserEmail'];
            $address=$data['spUserAddress'];
               
               
            }	
               //print_r($data); die('---------'); 
         ?>
         
         
      <h4><?= $customername; ?></h4>
         <h6>Call: <span class="font-li"><?= $phone; ?></span></h6>
         <h6>Email: <span class="font-li"><?= $email; ?></span></h6>
            <h6>Address: <span class="font-li"><?= $address; ?></span></h6><br/>
      </div>
         
   
            <div class="info"></div>
   
      
         <table id="table_id" class="display" data-page-length='10'>
               <thead>
               <tr>
               <th>Name</th>
               <th>Phone</th>
               <th>Date</th>
               <th>Sub Total</th>
               <th>Total Discount</th>
               <th>Grand Total</th>
               
               
               <th>Biller Name</th>
               
               
               
               <th>View</th>
            </tr>
         </thead>
         <tbody>
      
         <?php
      
      $phone = $_GET['phone'];
      //echo $phone;
      //die('===');
      

               $result = $p->read_data_phone2($phone);
               //print_r($result);
               //die('====');
               
         if ($result) {
            $i = 1;
            while ($sdata = mysqli_fetch_assoc($result)) {
               
               //print_r($row); die('------'); 
            //	$id = $row['id'];
               //echo $id;
               //die('===');
               //$customername= $row['spUserName'];
               
               //echo $phone;
               //die('====');
   $result_2 = $p->read_pos_customer_by_id($phone); 
               //print_r($result_2);
               //die('===');
                  if($result_2){						 

               While($row = mysqli_fetch_assoc($result_2)){

               $customername= $row['spUserName'];
                     $phone= $row['spUserPhone'];						 
               }
            }
         ?>
            <tr>
               <td><?php echo $customername;?></td>
               <td><?php echo $phone; ?></td> 
               <td><?php echo $sdata['date']; ?></td>
               <td><?php echo $sdata['currency']; ?>&nbsp;<?php echo $sdata['sub_total']; ?></td>
               <td><?php echo $sdata['currency']; ?>&nbsp;<?php echo $sdata['discount_by_net'] ; ?> </td>
               <td><?php echo $sdata['currency']; ?>&nbsp;<?php echo $sdata['total_by_net']; ?></td>
               
               
               
            <td>
            <?php  if($row['biller_id']){
                      $r = $p->read_employe_name($row['biller_id']);
                     if ($r) {
                         $row1 = mysqli_fetch_assoc($r);
                     }
                     echo $row1['name'];
                  } 
                  ?> 
            
            </td>
               
               <td><a href="<?php echo $BaseUrl; ?>/store/pos-dashboard/history_sales.php?id=<?php echo $sdata['id'];  ?>"><i class="fas fa-eye me-1"></i></a></td> 
            
            <!--| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a></td>-->
            </tr>
         <?php }} ?>
            <!-- <tr>
               <td>02-09-2022</td>
               <td>inv-012346</td>
               <td>apples</td>
               <td>Lorem ipsum dolor sit amet, </td>
               <td>5</td>
               <td>$12</td>
               <td>$15</td>
               <td>%5</td>
               
               <!--<td><a href="#"><i class="fas fa-edit me-1"></i></a>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a></td>-->
            </tr>
            
         </tbody>
      </table>
      
      
   <?php }?>
   
   
   
   
   <?php if($_GET['action']=="filter" ){   ?>  
   
   
      <form action="pos_sales_record.php" method="get">
            <div class="row">
         
               <div class="col-2 mb-3">
                  <input type="number" class="form-control" value="<?php echo $_POST['phone']; ?>" name = "phone" id="phone_" placeholder="Enter Phone Number:" aria-label="Customer ID:" aria-describedby="addon-wrapping">
               </div>
               <!--<div class="col-4">
                  <select class="form-control form-select js-example-basic-multiple" id="inputGroupSelect02" name="customer">
                     <option value="1">Jhone</option>
                     <option value="2">Dave</option>
                     <option value="3">Yusha</option>
                  </select>
               </div>-->
               <div class="col-2">
                  <input type="date" class="form-control" value="<?php echo $_POST['start_date']; ?>" placeholder="Choose Date Start"  aria-describedby="addon-wrapping">
               </div>
               <div class="col-2">
                  <input type="date" class="form-control" value="<?php echo $_POST['end_date']; ?>" placeholder="Choose Date End"  aria-describedby="addon-wrapping">
               </div>
               <div class="col-2">
                  <select class="form-select" name="employe" id="employe" aria-label="Default select example">
                  <option  value="">Choose Biller</option>
                  <?php 
                  $p = new _pos;  
                  $useam=$p->read_employes($_SESSION['pid'], $_SESSION['uid']);
                     if($useam!=false){
                    while ($roweam = mysqli_fetch_assoc($useam)) {
                    
                   
                  ?>
                  <option value="<?php echo $roweam['id']; ?>" <?php  if($_POST['employe'] == $roweam['id']){ echo "selected"; }?>><?php echo $roweam['name']; ?></option>
                  <?php }
                     }
                  ?>
                  </select>
               </div>
               
               <div class="col-1">
                  <button type="submit"  class="btn btn-main">Search</button> 
               </div>
            <div class="col-1">
                  <a href="pos_sales_record.php?action=all"  class="btn btn-secondary">Reset</a> 
               </div>
            </div>
         </form>
         
         <div class="p-3">
         <?php
      
      $phone = $_POST['phone'];
      $p = new _pos; 
         
         
            //$start_date = $_POST['start_date'];
               //$end_date = $_POST['end_date'];
            //echo $phone;
            //echo $start_date;
            //echo $end_date;
            //die('===1');
//$result_2 = $p->read_filter($phone,$start_date,$end_date);
                  //print_r($result_2); 
            //die('===++');
            //if($result_2){						 

               //$data = mysqli_fetch_assoc($result_2);
               //print_r($data); 
            //die('===++');
                     //$customername= $data['spUserName'];
            // echo $customername;
               //die('===');
               //$phone= $data['spUserPhone'];
               //$email=$data['spUserEmail'];
               //$address=$data['spUserAddress'];						 
                                          
               
            //}	
               //print_r($data); die('---------'); 
            
            
            
            $p = new _pos;
         
               $result = $p->read_data_phone($phone);
               
         if ($result) {
            $i = 1;
            while ($row = mysqli_fetch_assoc($result)) {
               
               
            
               
               //print_r($row); die('------'); 
               $id = $row['idspUser'];
               
               $email= $row['spUserEmail'];
               $spUserAddress= $row['spUserAddress'];
               }}
               
               
         ?>
         
         
      <h4><?= $customername; ?></h4>
         <h6>Call: <span class="font-li"><?= $phone; ?></span></h6>
            <h6>Email: <span class="font-li"><?= $email; ?></span></h6>
            <h6>Address: <span class="font-li"><?= $spUserAddress; ?></span></h6><br/>
      </div>  
         
         
         
   
            <div class="info"></div>
   
      
         <table id="table_id" class="display" data-page-length='10'>
               <thead>
               <tr>
               <th>Name</th>
               <th>Phone</th>
               <th>Date</th>
               <th>Sub Total</th>
               <th>Total Discount1</th>
               <th>Grand Total</th>
              
               
               <th>Biller Name</th>
               
               
               
               <th>View</th>
            </tr>
         </thead>
         <tbody>
      
         <?php
      
      $phone = $_POST['phone'];
      $start_date = $_POST['start_date'];
      $end_date = $_POST['end_date'];
      if($_POST['employe']){
         $biller_id = "AND biller_id = '" . $_POST['employe'] . "'";
      }else{
         $biller_id= " ";
      }
         $p = new _pos;
         
               $result = $p->read_data_phone($phone);
               
         if ($result) {
            $i = 1;
            while ($row = mysqli_fetch_assoc($result)) {
               
               
            
               
               //print_r($row); die('------'); 
               $id = $row['idspUser'];
               
               $customername= $row['spUserName'];
               $phone= $row['spUserPhone'];
               }}
               //$result_2 = $p->read_pos_customer_by_date($id,$start_date,$end_date);
$result_2 = $p->read_filter($phone,$start_date,$end_date,$biller_id);							//print_r($result_2);
               //die('===');
                  if($result_2){						 

               While($sdata = mysqli_fetch_assoc($result_2)){
                  
            
            
                                 
               
         ?>
            <tr>
               <td>
            <?php echo $customername;  ?>
         
            </td>
               <td><?php echo $phone; ?></td> 
               <td><?php echo $sdata['date']; ?></td>
               <td><?php echo $sdata['currency']; ?>&nbsp;<?php echo $sdata['sub_total']; ?></td>
               <td><?php echo $sdata['currency']; ?>&nbsp;<?php echo $sdata['discount_by_net'] ; ?> </td>
               <td><?php echo $sdata['currency']; ?>&nbsp;<?php echo $sdata['total_by_net']; ?></td>
               
               
            
            <td>
            <?php  if($row['biller_id']){
                      $r = $p->read_employe_name($row['biller_id']);
                     if ($r) {
                         $row1 = mysqli_fetch_assoc($r);
                     }
                     echo $row1['name'];
                  } 
                  ?> 
            
            </td>
               
               
               <td><a href="<?php echo $BaseUrl; ?>/store/pos-dashboard/history_sales.php?id=<?php echo $sdata['id'];  ?>"><i class="fas fa-eye me-1"></i></a></td> 
            
            <!--| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a></td>-->
            </tr>
         <?php }} 
            ?>
            <!-- <tr>
               <td>02-09-2022</td>
               <td>inv-012346</td>
               <td>apples</td>
               <td>Lorem ipsum dolor sit amet, </td>
               <td>5</td>
               <td>$12</td>
               <td>$15</td>
               <td>%5</td>
               
               <!--<td><a href="#"><i class="fas fa-edit me-1"></i></a>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a></td>-->
            </tr>
            
         </tbody>
      </table>
      
      
   <?php }?>
   
   
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
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script src="js/data.js"></script>
<script src="js/custom-chart.js"></script>
<script type="text/javascript">
$(document).ready( function () {
var table = $('#table_id').dataTable( );

} );




function filter_fun(){
var phone = $('#phone_').val();
alert(phone); 

}
</script>
</body>
</html>

<?php } ?>