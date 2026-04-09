<?php
    require_once("../../univ/baseurl.php" );
     session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="dashboard/";
    include_once ("../../authentication/islogin.php");
  
}else{
     function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
   

    $pageactive = 19;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../../component/f_links.php');?>

        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
        <!--This script for posting timeline data End-->
        <!-- ===========DSHBOARD LINKS================= -->
        <?php include('../../component/dashboard-link.php');?>
        <!-- ===========PAGE SCRIPT==================== -->
        <script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-checkbox.js" defer></script>
        
    </head>
    <body class="bg_gray" >
        <?php
       
        include_once("../../header.php");
        ?>
        
        <section class="">
            <div class="container-fluid no-padding">
                <div class="row">
                    <!-- left side bar -->
                    <div class="col-md-2 no_pad_right">
                        <?php
                        ;
                        include('../../component/left-dashboard.php');
                        ?>
                    </div>
                    <!-- main content -->
                    <div class="col-md-10 no_pad_left">
                        <div class="rightContent">
                            
                            <!-- breadcrumb -->
                            <section class="content-header">
                                <h1>Transaction History</h1>
                                <ol class="breadcrumb">
                                    <li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
                                    <li class="active">Transaction History</li>
                                </ol>
                            </section>

                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box box-success">
                                            <div class="box-header">
                                                
                                            </div><!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped ">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Id</th>
                                                                <th>Module</th>
                                                                <th>Transaction</th>
                                                                <th>Amount</th>
                                                                <th>Date</th>
                                                                
                                                              
                                                                <!-- <th class="text-center">Action</th> -->
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            

                                          $f = new _spwithdraw;

                                          $result = $f->readtransaction($_SESSION['uid']);
                                                           // echo $f->ta->sql;

                                                if ($result) {
                                                 $i = 1;
                                             while ($row = mysqli_fetch_assoc($result)) {
                                           $dt = new DateTime($row['created']);
                                  $moduleName = $row['module'];
                                 $Amount = $row['withdraw_amount'];
                                                
                                $totalamount += $row['withdraw_amount'];


                                if ($row['module'] == 'event') {

                                     $ev = new _spevent_transection; 

                                      $result1 = $ev->read($row['profile_id']);

                                      //echo $ev->ta->sql;




                                       if ($result1) {
                                          
                                 while ($row1 = mysqli_fetch_assoc($result1)) {




                                       $pt = new _spprofiles;
                                             
                           $buyer_event = $pt->read($row1['buyer_pid']);
                          if ($buyer_event) {
                                 $event_profile = mysqli_fetch_assoc($buyer_event);
                                 $ProfileNameevent = $event_profile['spProfileName'];
                                                        
                                              }
                                                        
                                   //  print_r($row1['postid']);

                                      $sp = new _spevent;       

                                      $result2 = $sp->read($row1['postid']);

                                      // echo $sp->ta->sql;

                                    
                                        }  
                                    }
       
                                }



             if ($row['module'] == 'store') {

                $p = new _orderSuccess;
                $or = new _order; 


        $result3 = $p->readmyOrder($row['profile_id']);
        //  echo $p->ta->sql;
            // print_r($result);

         if ($result3) {
                           
                             while ($row3 = mysqli_fetch_assoc($result3)){
                              extract($row3);

                               $pt = new _spprofiles;
                                             
                           $buyer_store = $pt->read($spProfile_idspProfile);

                          if ($buyer_store) {

                                 $store_profile = mysqli_fetch_assoc($buyer_store);
                                 $ProfileNamestore = $store_profile['spProfileName'];
                                                        
                               }

                               $result4 = $or->readOrderTxn($txn_id, $row['profile_id']);
                                 
                              //  echo $or->ta->sql;



                              }
                           }
                        }


                                       
           if ($row['module'] == 'private') {

                                     $qt = new _quotation_transection; 

                                      $result5 = $qt->readprivatebuyer($row['profile_id']);

                                      //echo $qt->ta->sql;

                                if ($result5) {
                                          
                                 while ($row5 = mysqli_fetch_assoc($result5)) {

                            // print_r($row5);





                          $pt = new _spprofiles;
                                             
                          $buyer_private = $pt->read($row5['buyer_pid']);
                          if ($buyer_private) 
                            {
                                 $private_profile = mysqli_fetch_assoc($buyer_private);
                                 $ProfileNameprivate = $private_profile['spProfileName'];
                                                        
                            }


                              $pst = new _productposting;
                              $sppost_res = $pst->read($row5['spPostings_idspPostings']);



                                                        
                                 
                                    
                                        }
                                    }
       
                                }
                                 


         
                                 
                                                                   
                 ?>
                                                                    <tr>
                                                                        <td class="text-center"><?php echo $i;?></td>
                                                                        
                                                            
                                                                    
                                                                        <td class="eventcapitalize">
                                                                     <a href="" ><?php echo $moduleName; ?></a>                                                                        
                                                                        </td>
                                        
                                                    <td><p style=" text-transform: capitalize;">
                                                                    <?php 
                                                    if ($row['module'] == 'event') {


                                                           
          
                                   

                                     if ($result2) {
                                                                   
                                         while (  $row2 = mysqli_fetch_assoc($result2)){
                                          // echo "<pre>";
                                         // print_r($row4);
                                        $Product_title = $row2['spPostingTitle'];
                                 echo $Product_title . ' Purchase By ' . $ProfileNameevent;
                                     }
                                 }

                                                           
                                }else if ($row['module'] == 'store') {


                                          if ($result4) {
                                                                   
                                         while ($row4 = mysqli_fetch_assoc($result4)){
                                          // echo "<pre>";
                                         // print_r($row4);
                                        $store_title = $row4['spPostingTitle'];
                                        
                              echo $store_title . ' Purchase By ' . $ProfileNamestore;

                                          
                                     }
                                 }

                              }else if ($row['module'] == 'private') {


                                          if ($sppost_res) {
                                                                   
                                         while ($sprow = mysqli_fetch_assoc($sppost_res)){
                                          // echo "<pre>";
                                          //print_r($sprow);
                                        $private_title = $sprow['spPostingTitle'];
                                         
                                        
                             echo $private_title . ' Purchase By ' . $ProfileNameprivate;




                                     }
                                 }

                              }else if ($row['module'] == 'public') {

                                     $pb = new _rfq_transection; 

                                 $result6 = $pb->readpublicbuyer($row['profile_id']);

                                //echo $pb->ta->sql;

                              if ($result6) {
                                          
                                 while ($row6 = mysqli_fetch_assoc($result6)) {

                            // print_r($row5);


                          $pt = new _spprofiles;
                                             
                          $buyer_public = $pt->read($row6['buyer_pid']);
                          if ($buyer_public) 
                            {
                                 $public_profile = mysqli_fetch_assoc($buyer_public);
                                 $ProfileNamepublic = $public_profile['spProfileName'];
                                                        
                            }


                             $public_title = $row6['rfqTitle'];
                                         
                                        
                             echo $public_title . ' Purchase By ' . $ProfileNamepublic;

                       
                                    
                                        }
                                    }
       
                                }



                                                             
                                                                

                                                        ?></p>  
                                                                        </td>

                                                                        <td><a href=""><?php echo $Amount; ?></a>  
                                                                        </td>

                                                                        <td><?php echo $dt->format('d M Y');?>
                                                                            
                                                                        </td>

                                                                        
                                                                    </tr>
                                                                    <?php
                                                                    $i++;
                                                                }
                                                                ?>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td colspan="3"><label>Total Withdraw: <?php if($totalamount > 0){ echo '$'. $totalamount; }else{ echo '$'."0" ;} ?></label></td>
                                                                </tr>
                                                              <?php
                                                            }else{?>
                                                                <tr><td colspan="4" style="text-align:center;">No Record Found</td></tr>

                                                            <?php }
                                                            ?>
                                                            

                                                        </tbody>
                                                    </table>
                                                </div>                                                
                                            </div>
                                        </div>


                                    </div>
                                </div>     

                            </div>
                            <div class="row">
                             
                                <p style="text-align: center;font-size: 20px;">Total Withdraw amount : <?php if($totalamount > 0){ echo '$'. $totalamount; }else{ echo '$'."0" ;} ?></p> </div>
                        </div>
                    </div>
                </div>
                




            </div>
        </section>

        
        <?php include('../../component/f_footer.php');?>
        <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
        <?php include('../../component/f_btm_script.php'); ?>
        <script>
            $(function() {
                $(':checkbox').checkboxpicker();
            });
        </script>
    </body>	
</html>
<?php
} ?>