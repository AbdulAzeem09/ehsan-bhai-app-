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
    $_GET["categoryid"] = 1;
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>
        
        <!-- ===== INPAGE SCRIPTS====== -->
        <?php include('../../component/dashboard-link.php'); ?>
		<style>
		.heading h6{
			 
            font-size: 15px;

		}
		</style>
		
    </head>

    <body class="bg_gray">
    	<?php
        
        //this is for store header
        $header_store = "header_store";

        include_once("../../header.php");
        ?>
        <section class="main_box">
            <div class="container">
                <div class="row">
                  <!--   <div class="sidebar col-md-2 no-padding left_store_menu" id="sidebar" >
                        <?php
                            $activePage = 4;
                            //include('left-menu.php'); 
                        ?>
                    </div> -->
                    <div id="sidebar" class="col-md-2 hidden-xs no-padding">
                        <div class="left_grid store_left_cat">
                            <?php
                               include('left-sellermenu.php'); 
                            ?>
                        </div>
                    </div>
                    <div class="col-md-10">
                        
                        
                        
                        <?php 
                        
                        $storeTitle = " Dashboard / Draft";
                      //  include('../top-dashboard.php');
                       // include('../searchform.php');
                        
                        ?>
                        
                        <div class="row ">
                        <!--    <div class="col-md-12">
                             <ul class="breadcrumb" style="background-color: #fff;">
                                      <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php';?>">Seller Dashboard</a></li>
                                       <li><a href="#">Draft</a></li>
                                    
                                    </ul>
                                <div class="text-right">
                                    <ul class="dualDash"   style="float:left!important;">
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21 || $activePage == 2 || $activePage == 3 || $activePage == 4 || $activePage == 5 || $activePage == 6 || $activePage == 14 || $activePage == 16 || $activePage == 18 || $activePage == 20 || $activePage == 22 || $activePage == 8 || $activePage == 9 || $activePage == 10 || $activePage == 11 || $activePage == 12 || $activePage == 13)?'active':''?>">Seller Dashboard</a></li>
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>" class="<?php echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24)?'active':''?>">Buyer Dashboard</a></li>
                                       </ul>
                                </div>
                            </div> -->

                            
    <div class="col-md-12">
                      <ul class="breadcrumb" style="background: white !important; ">
                            <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>
                                       <li><a href="#">Transaction Details</a></li>
                                     
                          </ul>
                            </div>

<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
    .paginate_button {
  border-radius: 0 !important;
}
</style>
<!--<?php 
	 $p = new _productposting;
     $result = $p->readMyDraftprofile($_GET["categoryid"], $_SESSION['pid']);
	 if($result!=false){
	 $table="example";
	 
	 }else{
	 $table="";
	 
	 }
	
	
	
	?>-->
	  <div class="p-3" style="margin: 15px;"> 
				   <?php
				
				
				
					$p = new _pos;
					        if($_GET['id'] != " "){
								$id = $_GET['id'];
							$result_1 = $p->read_pos_customerid($id);
							}
							 if(isset($_GET['print']) == "invoice"){   
								 $code_id = $_GET['code_id'];
								 $result_1=$p->read_pos_customer_rand_no($code_id);    
								 
							 }
							
					if ($result_1) {
						
						$row_1 = mysqli_fetch_assoc($result_1);
						//print_r($row_1); die('-----------------');
						$customer_id = $row_1['customer_id'];
						$discount_by_net =   $row_1['discount_by_net'];							
                          $total_by_net =   $row_1['total_by_net'];							
                          $total_tax =   $row_1['total_tax'];							
                          $Gross_net =   $row_1['Gross_net'];							
                          $sub_total =   $row_1['sub_total'];	 	
                          $payment_amount =   $row_1['payment_amount'];	 	
                          //$type_payment =   $row_1['type_payment'];	

                          if($row_1['type_payment'] == 1){
							 $type_payment = 'Email Payment Link' ;
						  }	

						  if($row_1['type_payment'] == 2){
							  $type_payment = 'Open Payment Page' ;
						  }	
						  
						  if($row_1['type_payment'] == 3){
							  $type_payment = 'Payment Done' ;
						  }	
						  
						  if($row_1['type_payment'] == 4){
							  $type_payment = ' Send OTP' ; 
						  }	
                          $currency =   $row_1['currency'];	 	
						
                         $result_2 = $p->cust_name($customer_id);
                        if($result_2){						 

						 $sdata = mysqli_fetch_assoc($result_2);
						  $customername= $sdata['spUserName'];
						 $phone= $sdata['spUserPhone'];
						 $email=$sdata['spUserEmail'];
						 $address=$sdata['spUserAddress'];

						 
						}	
					}	 //print_r($data); die('---------'); 
					?>
				  
				  
				<h4><?= $customername; ?></h4>
               <h6>Phone: <span class="font-li"><?= $phone; ?></span></h6>
                <h6>Email: <span class="font-li"><?= $email ?></span></h6>
                <h6>Address: <span class="font-li"><?= $address ?></span></h6><br/>
            </div>
                            <div class="col-md-12 ">
                               <!-- <h4 style="color: #0B241E!important;">UNPUBLISHED DRAFT POSTS : </h4>-->
                                <div class="">
                                    <div class="table-responsive">
                                    
										
										<table id="table_id1" class="display" data-page-length='10'cellspacing="0" width="100%">
                   <thead style="background-color: #56966f; color: #fff;font-size: 17px;">
                    <tr>
                     <th>Barcode</th>
                     <th>Product Name</th>
                     <th>Color</th>
                     <th>Size</th>
                     <th>Qty</th>
                     <th>Unit Price</th>
                     <th>Discount</th>
                     <th>Total Price</th> 
                     
                     
                    <!-- <th>Action</th>-->
                  </tr>
               </thead>
               <tbody>
			   
			    <?php
				
				
				
					$p = new _pos;
					
					  if($_GET['id'] != " "){
					
					$id = $_GET['id'];
							$result = $p->read_pos_customer_id($id);
							
					  }
					  
					   if(isset($_GET['print']) == "invoice"){   
		$result = $p->read_pos_customer_id($customer_id); 
					   }
							
					if ($result) {
						$i = 1;
						while ($row = mysqli_fetch_assoc($result)) {
							
							//print_r($row); die('------'); 
							$barcode = $row['barcode'];
                          	$sp = new _spprofiles;  
                            $res_1 = $sp->readprice_barcode($barcode); 
                             if($res_1){
	                         $row_1 = mysqli_fetch_assoc($res_1); 
							 $id = $row_1['idspPostings'];
							 }
								
							
					?>
                  <tr>
                     <td><?php echo $row['barcode']; ?></td>
                     <td>
					 <a href="<?php echo $BaseUrl;?>/store/detail.php?postid=<?php echo $id; ?>" >
					 <?php echo $row['product_name']; ?>
					 </td>
					 </a>
                     <td><?php echo ($row['color'] != "null")? $row['color'] : "N/A"; ?></td>
                     <td><?php echo ($row['size'] != "null")? $row['size'] : "N/A" ; ?> </td>
                     <td><?php echo $row['quantity']; ?></td>
                     <td><?php  echo $currency ;?>&nbsp;<?php  echo  $row['unit_price']; ?></td>
                     <td><?php echo $row['discount']; ?>%</td>
                     <td><?php  echo $currency ;?>&nbsp;<?php echo $row['total_price']; ?></td>
                     
                     <!--<td><a href="#"><i class="fas fa-edit me-1"></i></a>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a></td>-->
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
			
			<div class="p-3 heading" style="display:flex">
				<table border="1" cellspacing="0px;" cellpadding="0px;"style="margin-top:8px;">
				<tbody>
				<tr>
				<td>
               <h6 style="margin:15px">Total Of Price: <span class="font-li"><?php  echo $currency ;?>&nbsp;<?= $sub_total; ?></span></h6> </td>
              <td> <h6 style="margin:15px">Total Discount: <span class="font-li"><?php  echo $currency ;?>&nbsp;<?= $discount_by_net; ?></span></h6></td>
             <td>   <h6 style="margin:15px" >Total By Net: <span class="font-li"><?php  echo $currency ;?>&nbsp;<?= $total_by_net; ?></span></h6></td>
               <td> <h6 style="margin:15px" >Total Tax: <span class="font-li"><?php  echo $currency ;?>&nbsp;<?= $total_tax; ?></span></h6></td>
               <td> <h6 style="margin:15px" >Total Amount: <span class="font-li"><?php  echo $currency ;?>&nbsp;<?= $Gross_net; ?></span></h6> </td>
              <td>  <h6 style="margin:15px" >Payment Amount: <span class="font-li"><?php  echo $currency ;?>&nbsp;<?= $payment_amount; ?></span></h6> </td>
              <td>  <h6 style="margin:15px" >Payment Type: <span class="font-li"><?= $type_payment; ?></span></h6></td><br/> 
				</tr>
				</tbody>
				</table>
            </div>
										
										
										
										
										
										
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>


<!-- partial 
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

  <script type="text/javascript">
    $(document).ready(function() {

  var table = $('#example').DataTable({ 
        select: false,
        "columnDefs": [{
            className: "Name", 
            "targets":[0],
            "visible": false,
            "searchable":false
        }]
		 
});
    });//End of create main table

  
  $('#example tbody').on( 'click', 'tr', function () {
   
   // alert(table.row( this ).data()[0]);

} );
  </script>

<?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
        
    </body>
</html>
<?php
} ?>
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

  <script type="text/javascript">
  
  
$(document).ready(function(){
  $(".sellerComment").click(function(){
	  
	    var mesage  = ($(this).attr("data-message"));
	      $('#sellermessage').html(mesage);
  });
});

  
  
  
  
  
  
  
    $(document).ready(function() {

  var table = $('#table_id1').DataTable({ 
        select: false,
        "columnDefs": [{
            className: "Name", 
            "targets":[0],
            "visible": false,
            "searchable":false
        }]
    });//End of create main table

  
  $('#example tbody').on( 'click', 'tr', function () {
   
   // alert(table.row( this ).data()[0]);

} );
} );

  </script>