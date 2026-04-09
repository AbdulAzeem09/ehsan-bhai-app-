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
    $activePage = 3;


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
        <!--This script for posting timeline data End-->
        

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
                    <div class="col-md-12 text-center">
                        <h3>Past Event</h3>
                    </div>
                </div>
            </div>
        </section>
        <section class="m_top_15">
            <div class="container">
                <div class="row">
                    <div class="sidebar col-md-2 no-padding left_event_menu whiteevent" id="sidebar" >
                        <?php include('left-menu.php'); ?> 
                    </div>
                    <div class="col-md-10">
                        <div class="form-group" >
                            <?php include('top-button-dashboard.php'); ?>
                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <div class="box box-danger">
                                    <div class="box-body">
                                        <div class="table-responsive bg_white">
                                            <table class="table table-striped eventTable">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Event Title</th>
                                                        <th>Date / Time</th>
                                                        <th>Price</th>
                                                        <th class="text-center">Ticket Sold</th>
                                                        <th class="text-center">Earning</th>
                                                        <th>Category</th>
                                                        <th class="text-center">Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $p      = new _spevent;
                                                    //$pf     = new _postfield;
                                                    $or     = new _order;
                                                    //$res    = $p->publicpost_event($_GET["categoryID"]);
                                                    $today  = date('Y-m-d');
                                                    $res = $p->myExpireProduct($_GET['categoryID'], $_SESSION['pid']);
                                                    //$res = $p->pastEvent($_GET['categoryID'], $today, $_SESSION['pid']);
                                                    //echo $p->ta->sql;

                                                    if($res != false){
                                                        $i = 1;
                                                        while ($row = mysqli_fetch_assoc($res)) {
                                                            //posting fields
                                                           // $result_pf = $pf->read($row['idspPostings']);
                                                            //echo $pf->ta->sql."<br>";

                                                                  $pf = new _spevent_transection;
                                                            $result_pf = $pf->postread($row['idspPostings']);
                                                            if($row){
                                                                
                                                                $startDate = "";
                                                                $endDate = "";
                                                                $startTime    = "";
                                                                $endTime = "";
                                                                $catName = "";
                                                                 
                                                                 $startDate = $row['spPostingStartDate'];
                                                                 $endDate = $row['spPostingEndDate'];
                                                                 $startTime = $row['spPostingStartTime'];
                                                                 $endTime = $row['spPostingEndTime'];
                                                                 $catName = $row['eventcategory'];

                           if($result_pf){
                              while ($row2 = mysqli_fetch_assoc($result_pf)) {
                                   /* echo "<pre>";
                                    print_r($row2);*/

                                   $soldticket += $row2['quantity'];

                                   $totalearnprice +=  $row2['payment_gross'];

                         }
                     }else{

                              $soldticket = 0;

                                   $totalearnprice =  0;

                     }
                       

                                                                

                                                              /*  while ($row2 = mysqli_fetch_assoc($result_pf)) {
                                                                    
                                                                    if($startDate == ''){
                                                                        if($row2['spPostFieldName'] == 'spPostingStartDate_'){
                                                                            $startDate = $row2['spPostFieldValue'];

                                                                        }
                                                                    }
                                                                    if($endDate == ''){
                                                                        if($row2['spPostFieldName'] == 'spPostingEndDate_'){
                                                                            $endDate = $row2['spPostFieldValue'];
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
                                                                    }
                                                                }
*/

                                                                $dtstrtTime = strtotime($startTime);
                                                                $dtendTime = strtotime($endTime);
                                                                $todaydate = date('Y-m-d');
                                                                //echo "<br>";
                                                                if($endDate < $todaydate){
                                                                    $strDate = new DateTime($startDate);
                                                                    $endingDate = new DateTime($endDate);

                                                                    // TOTAL TICKET SOLD
                                                                    $result4 = $or->readMyEventTkt($_SESSION['pid'], $_GET['categoryID'], $row['idspPostings']);
                                                                    if ($result4) {
                                                                        $totSoldTkt = $result4->num_rows;
                                                                    }else{
                                                                        $totSoldTkt = 0;
                                                                    }
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $i; ?></td>
                                                                        <td class="eventcapitalize"><a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'];?>"><?php echo $row['spPostingTitle'];?></a></td>
                                                                        
                                                                        <td><?php echo $strDate->format('d-M-Y').' / '.date("h:i A", $dtstrtTime);?></td>
                                                                        <td><?php echo ($row['spPostingPrice'] > 0)? '$'.$row['spPostingPrice']:'Free';?></td>
                                                                        <td class="text-center"><?php echo $soldticket; ?></td>
                                                                        <td class="text-center"><?php echo '$'.$totalearnprice; ?></td>
                                                                        <td><?php echo $catName;?></td>
                                                                        <td class="text-center">
                                                                            <a href="<?php echo $BaseUrl.'/events/dashboard/detail.php?postid='.$row['idspPostings']; ?>" class=""><i class="fa fa-eye"></i></a>
                                                                            <a href="javascript:void(0)" data-postid="<?php echo $row['idspPostings']; ?>" class="delpost" ><i class="fa fa-trash"></i></a>
                                                                            
                                                                        </td>
                                                                    </tr> <?php
                                                                    $i++;
                                                                } 
                                                            }
                                                        }
                                            }else{ ?>
                                            
                        <td colspan="8"><center>No Record Found</center></td><?php }?>
                                                    
                                                    
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
    </body>
</html>
<?php
} ?>