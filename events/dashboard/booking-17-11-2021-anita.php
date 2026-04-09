<?php 
    include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="events/";
    include_once ("../../authentication/islogin.php");
 
}else{
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");


    $_GET["categoryID"] = "9";
    $_GET["categoryName"] = "Events";
    $header_event = "events";
    $activePage = 7;


    if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ 

    }else{
        $re = new _redirect;
        $re->redirect($BaseUrl."/events");
    }
?>

<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>
        

        <!-- ===== INPAGE SCRIPTS====== -->
        <!-- High Charts script -->
        <script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
        <?php include('../../component/dashboard-link.php'); ?>
        <!-- Morris chart -->
        <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />

          <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">

    </head>

    <body class="bg_gray">
        <?php include_once("../../header.php");?>
        <section class="topDetailEvent innerEvent">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h3>Join Event</h3>
                    </div>
                </div>
            </div>
        </section>
        <section class="m_top_15">
            <div class="container">
              <?php include('eventmodule.php'); ?>
                <div class="row">
                    <div class="sidebar col-md-2 no-padding left_event_menu whiteevent" id="sidebar" >
                        <?php include('left-menu.php'); ?> 
                    </div>
                    <div class="col-md-10">
                        <div class="form-group" >
                            <?php include('top-button-dashboard.php'); ?>
                        </div>
                        <div class="row">

                            <div class="col-sm-12">
                                <div class="box box-danger">
                                    <div class="box-body">
                                        
                                        <div class="table-responsive bg_white">
                                            <table class="table table-striped eventTable">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Event Title</th>
                                                        <th>Venue</th>
                                                        <th>Organised By</th>
                                                        <th>Quantity</th>
                                                        <th class="text-center">Tickets P.P.</th>
                                                        <th class="text-center">Total Amount </th>
                                                        <th class="text-center">Booked On </th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                         <?php
                                            //  $p      = new _postingview;
                                            //$pf     = new _postfield;

                                            //$fv = new _event_favorites;
                                            $pet = new _spevent_transection;

                                             $p  = new _spevent;

                                             $d = new _spprofiles;
                                            $res = $pet->mybooking($_SESSION['pid']); 

                                            //$res = $p->pastEvent($_GET['categoryID'], $today);
                                            //$res = $p->draftEvent($_GET['categoryID']);
                                            //echo $p->ta->sql;

                                            if($res != false){
                                                $i = 1;
                                                while ($row = mysqli_fetch_assoc($res)) { 
                                                    //posting fields
                                             $result_pf = $p->read($row['postid']);
                                               // echo $p->ta->sql."<br>";
                                              
                                            $sellerName = $d->getProfileName($row['sellid']);
                                                    if($result_pf){

                                                        $venu = "";
                                                        $startDate = "";
                                                        $startTime    = "";
                                                        $endTime = "";
                                                        $catName = "";

                                                        while ($row2 = mysqli_fetch_assoc($result_pf)) {
                                                            /*echo "<pre>";
                                                            print_r($row2);*/


                                                          $venu = $row2['spPostingEventVenue'];
                                                          $startDate = $row2['spPostingStartDate'];
                                                          $startTime = $row2['spPostingStartTime'];
                                                          $endTime = $row2['spPostingEndTime'];
                                                          $catName = $row2['eventcategory'];

                                                            
                                                           /* if($venu == ''){
                                                                if($row2['spPostFieldName'] == 'spPostingEventVenue_'){
                                                                    $venu = $row2['spPostFieldValue'];

                                                                }
                                                            }
                                                            if($startDate == ''){
                                                                if($row2['spPostFieldName'] == 'spPostingStartDate_'){
                                                                    $startDate = $row2['spPostFieldValue'];

                                                                }
                                                            }
                                                            if($startTime == ''){
                                                                if($row2['spPostFieldName'] == 'spPostingStartTime_'){
                                                                    $startTime = $row2['spPostFieldValue'];

                                                                }
                                                            }
                                                            if($endTime == ''){
                                                                if($row2['spPostFieldName'] == 'spPostingEndTime_'){
                                                                    $endTime = $row2['spPostFieldValue'];

                                                                }
                                                            }
                                                            if($catName == ''){
                                                                if($row2['spPostFieldName'] == 'eventcategory_'){
                                                                    $catName = $row2['spPostFieldValue'];

                                                                }
                                                            }*/
                                                       
                                                        $strDate = new DateTime($startDate);


                                                        $dtstrtTime = strtotime($startTime);
                                                        $dtendTime = strtotime($endTime); ?>

                                                                        <tr>
                                                                            <td><?php echo $i; ?></td>
                                                                            <td class="eventcapitalize"><a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row2['idspPostings'];?>"><?php echo $row2['spPostingTitle'];?></a></td>
                                                                          <td><?php echo $venu;?></td>
                                                                          <td><?php echo ucwords($sellerName);?></td>

                                                                           <td style="text-align: center;"><?php echo $row['quantity'];?></td>

                                                                           <td style="text-align: center;"><?php echo ($row2['spPostingPrice'] > 0)? '$'.$row2['spPostingPrice']:'Free';?></td>

                                                                           <td style="text-align: center;"><?php echo '$'.$row['payment_gross'];?></td>

                                                                           <td><?php echo date("Y-m-d H:i:A",strtotime($row['payment_date']));?></td>


                                                                           <!--  <td><?php echo $strDate->format('d-M-Y');?></td>
                                                                            <td><?php echo date("h:i A", $dtstrtTime); ?></td>
                                                                            <td><?php echo $catName;?></td> -->
                                                                            <td class="text-center">

                                                                               <!--  <a href="<?php echo $BaseUrl.'/events/dashboard/detail.php?postid='.$row2['idspPostings']; ?>" class=""><i class="fa fa-eye"></i></a> -->
                                                              <?php

                                                           $er = new _speventreview_rating;
                                                              $re_res =  $er->read($_SESSION['pid'],$row['postid']);

                                                            $row_re = mysqli_fetch_assoc($re_res);

                                                                                      
                                                                                
                                                                                if($re_res->num_rows == 0){
                                                                                     ?>
  <a href="<?php echo $BaseUrl.'/events/eventreview.php?postid='.$row2['idspPostings']; ?>" class=""><i class="fa fa-star"></i></a>
                                                                                  <?php
                                                                                }

                                                                                  ?>
                                           

                                            <a href="<?php echo $BaseUrl.'/events/eventticket.pdf' ?>" class="" id="btnPDF"><i class="fa fa-file-pdf-o "></i></a>


                                                                                <!-- <a href="<?php echo $BaseUrl.'/events/dashboard/aprove.php?org=1&postid='.$row2['idspPostings'].'&pid='.$_SESSION['pid'].'&stat=1';?>">Aprove</a> | <a href="<?php echo $BaseUrl.'/events/dashboard/aprove.php?org=1&postid='.$row2['idspPostings'].'&pid='.$_SESSION['pid'].'&stat=0';?>">Reject</a> --></td>
                                                                        </tr> <?php
                                                                       $i++;


 $Date = new DateTime($row2['spPostingDate']);
 $startTime = $row2['spPostingStartTime'];
 $dtstrtTime = strtotime($startTime);
 $firstname = $row['first_name'];
 $lastname = $row['last_name'];
  //echo date("h:i A", $dtstrtTime);
  
// $Starttime = new strtotime($eventdetail['spPostingStartTime']);

 $html ='
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
            padding-left : 40px;
           
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


                    <div class="col-sm-12">
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
        <td class="pdftablehead newtddata">Event Title :</td>
        <td class="tddata newtddata">'.$row2['spPostingTitle'].'</td>
        
      </tr>
      <tr class="trdata">
        <td class="pdftablehead newtddata">Date :</td>
        <td class="tddata newtddata">'.$Date->format('d M Y').'</td>
      
      </tr>
      <tr class="trdata">
        <td class="pdftablehead newtddata">Start Time :</td>
        <td class="tddata newtddata" style="text-transform: uppercase;">'.date("h:i A", $dtstrtTime).'</td>
        
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
        <td class="pdftablehead">Organized By :</td>
        <td class="tddata">'.ucwords($sellerName).'</td>
        
      </tr>
      
      <tr>
        <td class="pdftablehead">Venue :</td>
        <td class="tddata">'.$row2['spPostingEventVenue'].'</td>
        
      </tr>
    </tbody>
  </table>

  </div>
  <div class="col-md-6"  style="width:50%;float:right;">
      <table class="table">
   
    <tbody>
      <tr style="border:none!important;">
    <td class="pdftablehead" style="padding-left:130px; border:none!important;">Ticket Quantity : </td>
        <td class="tddata" style="padding-left:20px; border:none!important;">'.$row['quantity'].'</td>
        
      </tr>
      <tr>
        <td class="pdftablehead"></td>
        <td class="tddata" style="padding-bottom:35px;"></td>
      
      </tr>
      <tr>
        <td class="pdftablehead"></td>
        <td class="tddata"  style="padding-left:30px;"></td> 
        
      </tr>
    </tbody>
  </table>

  </div>
 </div>

 <hr>                          
                             
<div class="row">
<div class="col-md-4" style="width:30%; float:left;">                                 
 <table class="table">
   
    <tbody>
      <tr style="border:none!important;">
        <td class="pdftablehead" style="border:none!important;">Price P. P.<br><br>$'.$row2['spPostingPrice'].'</td>

       
        
      </tr>
     
    </tbody>
  </table>

  </div>
  <div class="col-md-4"  style="width:30%;">
      <table class="table">
   
    <tbody>
      <tr style="border:none!important;">
        <td class="pdftablehead" style="border:none!important; padding-left:100px;">Quantity<br><br> '.$row['quantity'].'</td>
       
        
      </tr>
      
    </tbody>
  </table>

  </div>

  <div class="col-md-4"  style="width:50%; float:right; padding-left:150px;">
      <table class="table">
   
    <tbody>
      <tr class="" style="border:none!important;">
        <td class="pdftablehead " style="border:none!important; padding-left:240px; padding-top:-80px;">Total Price<br><br>$'.$row['payment_gross'].'</td>
      
        
      </tr>
      
    </tbody>
  </table>

  </div>
 </div>


<hr>
<p style="font-size: 18px; padding-left: 12px; float:left; padding-top:-15px;"> Booked on : '.date("Y-m-d H:i:A",strtotime($row['payment_date'])).'</p>


<div style="float:left; padding-left: 12px;" >
<p font-size: 12px;>'.$row['remark'].' <br> Transaction ID : '.$row['txn_id'].'</p>
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
                                            }
                                        }
                                        else{ ?>
                                            
                        <td colspan="6"><center>No Record Found</center></td><?php }?>
                                            
                                                    
                                                    
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
        
        <div class="space"></div>

        <?php 
       
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>

    <?php   
include '../assets/mpdf/mpdf.php';

$mpdf = new mPDF();

//$mpdf->WriteHTML($stylesheet,1); // Writing style to pdf

$mpdf->WriteHTML($html);

//$mpdf->WriteHTML($html);

//save the file put which location you need folder/filname
$mpdf->Output("eventticket.pdf", 'F');

//out put in browser below output function
//$mpdf->Output(); ?>

       
    </body>
</html>
<?php
}
?>