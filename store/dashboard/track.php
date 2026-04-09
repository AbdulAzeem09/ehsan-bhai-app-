<?php
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
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>
        <!-- ===== INPAGE SCRIPTS====== -->       
        <?php include('../../component/dashboard-link.php'); ?>
        
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
                        $activePage = 23;
                       // include('left-menu.php'); 
                        ?> 
                    </div> -->
                     <div id="sidebar" class="col-md-2 hidden-xs no-padding">
                        <div class="left_grid store_left_cat">
                            <?php
                               include('left-buyermenu.php'); 
                            ?>
                        </div>
                    </div>
                    <div class="col-md-10">                        
                        
                        <?php 
                        $storeTitle = "Buyer Dashboard / Track Order";
                        //include('../top-dashboard.php');
                        //include('../searchform.php');                       
                        ?>
                        <div class=" ">
                            <div class="row">
                            
                          <!--   <div class="col-md-12">

                                    <ul class="breadcrumb" style="background-color: #fff;">
                                      <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>
                                       <li><a href="#">Track Order</a></li>
                                     
                                    </ul>


                                <div class="text-right" style="margin-top: -10px;">
                                        <ul class="dualDash"   style="float:left!important;">
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21)?'active':''?>">Seller Dashboard</a></li>
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>" class="<?php echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24)?'active':''?>">Buyer Dashboard</a></li>
                                       </ul>
                                </div>
                            </div> -->
                            <div class="col-md-12">
                      <ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 8px;">
                            <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>

                         <li><a href="#">Track Order</a></li>
                                     
                          </ul>
                            </div>
                            </div>
                           </div> 
                        
                        <div class="dash_bg_white ">
                            <div class="row m_top_15">


                                <div class="bg_white">
                                    <form method="post" action="" >
                                        <div  class="col-md-4">
                                            <div class="form-group">
                                                <label>TXN Number</label>
                                                <input type="text" class="form-control" name="txtTxnNumber" required="" value="<?php echo isset($_POST['txtTxnNumber'])?$_POST['txtTxnNumber']:''; ?>" >
                                            </div>
                                        </div>
                                        <div  class="col-md-4">
                                            <div class="form-group">
                                                <label>&nbsp;</label><br>
                                                <input type="submit" class="btn btn-submit" value="Track Order" name="btntrack" >
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            
                        </div>

                        <div class="row m_top_15">
                            <div class="col-md-12">
                                <table class="table tbl_store_setting" >
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 50px;">Order#</th>
                                            <th>TXN Number</th>
                                            <th>Payer Id</th>
                                            <th class="text-center">Price</th>
                                            <th>Order Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php // echo "here";   print_r($result);
										
										$userid=$_SESSION['uid'];


$c= new _orderSuccess;


$currency= $c->readcurrency($userid);
$res1= mysqli_fetch_assoc($currency);
$curr=$res1['currency'];
                                        if (isset($_POST['btntrack'])) {
                                            $txn = $_POST['txtTxnNumber'];
                                            $p = new _orderSuccess;
                                            $or = new _order;
                                            $result = $p->chekTxnExist($txn);


                                            if ($result) {
                                                $i = 1;
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    extract($row);
                                                    $dt = new DateTime($payment_date);

                                            

                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $txn_id; ?></td>
                                                        <td><?php echo $payer_id; ?></td>
                                                        <td class="text-center"><?php echo $curr.' '. $amount; ?></td>
                                                        <td><?php echo $dt->format('d-M-Y'); ?></td>
                                                        <td>
                                                            <?php
                                                            $result2 = $or->readOrderTxn($txn_id, $spProfile_idspProfile);

                                                          //  echo $or->ta->sql;

                                                            if ($result2) {
                                                                 while ($row2 = mysqli_fetch_assoc($result2)) {

                                                                  
                                                $buyerprofilid = $row2['spByuerProfileId'];

                                              $sellerprofilid = $row2['spSellerProfileId'];

                                               $orderdate = $row2['sporderdate'];

                                              $trancsectionid = $row2['txn_id'];
                                                        
                                                              
                                             $sellproducttitle = $row2["spPostingTitle"];

                                               $sporderAmount = $row2["sporderAmount"];
                                                                
                                            
                                                   $spOrderQty = $row2['spOrderQty'];


                                                      $sp = new _spprofiles;
                                                 $spsellresult  = $sp->read($sellerprofilid);
                                                                   
                                                    //  echo $sp->ta->sql;
                                                   if($spsellresult != false)
                                                                       {
                                                              $sellrow = mysqli_fetch_assoc($spsellresult);
                                                              $sellername = $sellrow["spProfileName"];
                                                    }

                                                      

                                              $spbuyresult  = $sp->read($buyerprofilid);
                                                 if($spbuyresult != false)
                                                                       {
                                                              $buyrow = mysqli_fetch_assoc($spbuyresult);
                                                              $buyername = $buyrow["spProfileName"];
   

                                                                    
                                                                }
                                                     $pp = new _productpic;  

                                                 $sellpic = $pp->read($sellpostid);
                                                 // echo $pp->ta->sql;
                                                        if($sellpic != false){
          
                                                                  $sellrowpic = mysqli_fetch_assoc($sellpic);
                                                                  $sellProductimg   = $sellrowpic['spPostingPic'];
                        
                        

                                                                       }         




                                                                if ($row2['spOrderStatus'] == 0) {
                                                                    echo "Wait for shipping";
                                                                }else if($row2['spOrderStatus'] == 1){
                                                                    echo "Prepare Order To Ship";
                                                                }else if($row2['spOrderStatus'] == 2){
                                                                    echo "On Way";
                                                                }else if($row2['spOrderStatus'] == 3){
                                                                    echo "Delivered";
                                                                }

 $firstname = $row['first_name'];
 $lastname = $row['last_name'];


 $orderhtml ='
<html lang="en-US">
    
    <head>

    <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">

      <style>

        .showeventrating{
          margin-left: 45px;
            margin-right: 45px;
            margin-bottom: 10px;
        }

        .pdftablehead{
          font-weight: bold;
            font-size: 16px;
        }
        tr td{
            padding: 15px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }
        .tddata{
            padding-left : 14px;
             text-transform: capitalize;
        }
        .textboxcenter{
          
         border:1px solid black;
            width:50%;
            height:100px;
            margin-left: 180px;
            
        }
        .trdata .newtddata{
             padding: 7px!important;
             border:none!important;
            vertical-align: top!important;
            padding-left : 60px;
           
        }
        .bordernone{
             border:none!important;
        }
      
        
      </style> 
        
    </head>    

<body class="bg_gray">

  <section class="main_box">            
            <div class="container">
                    

                <div class="row">


                    <div class="col-md-12">
                    <div class="bg_white detailEvent m_top_10">

      

                 <div class="row">
                     <div class="showeventrating">


                           <p style="text-align:center; padding-top:20px;"> <img src="'.$BaseUrl.'/assets/images/logo/tsp_trans.png" class="img-responsive" style="height: 100px;"></p>
                           <p style="font-size: 30px; text-align:center;">The SharePage</p>
                        <div class="textboxcenter">
 <div class="col-md-6">                                 
 <table class="table">

   
    <tbody>
      <tr class="trdata">
        <td class="pdftablehead newtddata" style="padding-top:40px;">Title :</td>
        <td class="tddata newtddata" style="padding-top:40px;">'.$sellproducttitle.'</td>
        
      </tr>
    
    </tbody>
  </table>

  </div>

    </div>

                    

 <br>



<div class="row">
<div class="col-md-6" style="width:50%; float:left;">                                 
 <table class="table">
   
    <tbody>
      <tr style="border:none!important;">
        <td class="pdftablehead" style="border:none!important;" >Name : </td>
        <td class="tddata" style="font-weight:bold; border:none!important;">'.$firstname.'    '.$lastname.'</td>
        
      </tr>
      <tr>
        <td class="pdftablehead">Sold By :</td>
        <td class="tddata">'.ucwords($sellername).'</td>
        
      </tr>
      
        <tr>
        <td class="pdftablehead">Total Price :</td>
        <td class="tddata">$'.$sporderAmount.'</td>
        
      </tr>
    </tbody>
  </table>

  </div>
  <div class="col-md-6"  style="width:50%;float:right;">
      <table class="table">
   
    <tbody>
      <tr style="border:none!important;">
    <td class="pdftablehead" style="border:none!important;">Quantity : </td>
        <td class="tddata" style="padding-left:20px; border:none!important;">'.$spOrderQty.'</td>
        
      </tr>
      <tr>
        <td class="pdftablehead">Ship To :</td>
        <td class="tddata" style="padding-bottom:35px;">'.$buyername.'</td>
      
      </tr>
      
    </tbody>
  </table>

  </div>
 </div>

 

<hr>
<p style="font-size: 18px; padding-left: 12px; float:left; padding-top:-15px;"> Order Placed : '.date("Y-m-d H:i:A",strtotime($orderdate)).'</p>



<div style="float:left; padding-left: 12px;" >
<p font-size: 12px;>'.$row['remark'].' <br> Transaction ID : '.$trancsectionid.'</p>
</div>

<p style="text-align:center; padding-top:230px;">Paid Online From- www.TheSharePage.com</p>
 </div>
  </div>
                               </div>
                                </div>
                                 </div>
                                  </div>
                               
</section>
</body>
</html>';     


                                                            }

                                                        }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo $BaseUrl.'/store/dashboard/storepdf.pdf'?>"id="btnPDF" >Invoice</a>
                                                        </td>

                                                    </tr>
                                                    <?php
                                                    $i++;
                                                }
                                            }
                                        }else{?>
                                                 <tr>
                                                      <td colspan="7">
                                                          <p class="text-center">No track order available.</p>
                                                      </td>
                                                  </tr>
                                         <?php   }
                                        ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>



    	<?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
   
         include '../../assets/mpdf/mpdf.php';

$mpdf = new mPDF();

//$mpdf->WriteHTML($stylesheet,1); // Writing style to pdf

$mpdf->WriteHTML($orderhtml);

//$mpdf->WriteHTML($html);

//save the file put which location you need folder/filname
$mpdf->Output("storepdf.pdf", 'F');

//out put in browser below output function
//$mpdf->Output(); ?> 
        
    </body>
</html>
<?php
}
?>