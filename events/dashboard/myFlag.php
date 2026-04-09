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
    $activePage = 8;
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
                        <h3>Flagged Events</h3>
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

                            <div class="col-sm-12">
                                <div class="box box-danger">
                                    <div class="box-body">
                                        
                                        <div class="table-responsive bg_white">
                                            <table class="table table-striped eventTable">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Event Title</th>
                                                        <th>Price</th>
                                                        <th>Start Date</th>
                                                        <th>Start Time</th>
                                                        <th>Category</th>
                                                        <th class="text-center">Purchase Tickets</th>
                                                        <th class="text-center">Intrested</th>
                                                        <th class="text-center">Going</th>
                                                        <th>Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                  //  $p      = new _postingview;
                                                    $p      = new  _spevent;

                                                   // $pf     = new _postfield;

                                                    $res    = $p->myflagPost($_GET['categoryID'], $_SESSION['pid']);


                                                    //$res    = $p->publicpost_event($_GET["categoryID"]);
                                                 //   echo $p->ta->sql;

                                                    if($res != false){
                                                        $i = 1;
                                                        while ($row = mysqli_fetch_assoc($res)) { 
                                                            //posting fields
                                                            $result_pf = $p->read($row['idspPostings']);
                                                            //echo $pf->ta->sql."<br>";
                                                            if($result_pf){
                                                                $venu = "";
                                                                $startDate = "";
                                                                $startTime    = "";
                                                                $endTime = "";
                                                                $catName = "";
                                                                while ($row2 = mysqli_fetch_assoc($result_pf)) {
                                                                    
                                                                    if($venu == ''){
                                                                        /*if($row2['spPostFieldName'] == 'spPostingEventVenue_'){*/
                                                                            $venu = $row2['spPostingEventVenue'];

                                                                       /* }*/
                                                                    }
                                                                    if($startDate == ''){
                                                                       /* if($row2['spPostFieldName'] == 'spPostingStartDate_'){*/
                                                                            $startDate = $row2['spPostingStartDate'];

                                                                        /*}*/
                                                                    }
                                                                    if($startTime == ''){
                                                                       /* if($row2['spPostFieldName'] == 'spPostingStartTime_'){*/
                                                                            $startTime = $row2['spPostingStartDate'];

                                                                        /*}*/
                                                                    }
                                                                    if($endTime == ''){
                                                                        /*if($row2['spPostFieldName'] == 'spPostingEndTime_'){*/
                                                                            $endTime = $row2['spPostingEndTime'];

                                                                        /*}*/
                                                                    }
                                                                    if($catName == ''){
                                                                       /* if($row2['spPostFieldName'] == 'eventcategory_'){*/
                                                                            $catName = $row2['eventcategory'];

                                                                        /*}*/
                                                                    }
                                                                }

                                                                $dtstrtTime = strtotime($startTime);
                                                                $dtendTime = strtotime($endTime); ?>
                                                                <tr>
                                                                    <td><?php echo $i; ?></td>
                                                                    <td class="eventcapitalize"><a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'];?>"><?php echo $row['spPostingTitle'];?></a></td>
                                                                    <td><?php echo ($row['spPostingPrice'] > 0)? '$'.$row['spPostingPrice']:'Free';?></td>
                                                                    <td><?php echo $startDate;?></td>
                                                                    <td><?php echo date("h:i A", $dtstrtTime); ?></td>
                                                                    <td><?php echo $catName;?></td>
                                                                    <td class="text-center">0</td>
                                                                    <td class="text-center">
                                                                        <a href="javascript:void(0)" data-toggle='modal' data-target='#loaddetail' class="eventDetail" data-postid="<?php echo $row['idspPostings'];?>" data-pid="<?php echo $row['idspProfiles'];?>" data-intrest="1" >
                                                                        <?php
                                                                        $ie = new _eventIntrest;
                                                                        $result = $ie->chekGoing($row['idspPostings'], 1);
                                                                        if($result != false && $result->num_rows >0){
                                                                            echo $result->num_rows;
                                                                        }else{
                                                                            echo 0;
                                                                        }
                                                                        ?>
                                                                        </a>  
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <a href="javascript:void(0)" data-toggle='modal' data-target='#loaddetail' class="eventDetail" data-postid="<?php echo $row['idspPostings'];?>" data-pid="<?php echo $row['idspProfiles'];?>" data-intrest="2" >
                                                                        <?php
                                                                        $ie = new _eventIntrest;
                                                                        $result = $ie->chekGoing($row['idspPostings'], 2);
                                                                        if($result != false && $result->num_rows >0){
                                                                            echo $result->num_rows;
                                                                        }else{
                                                                            echo 0;
                                                                        }
                                                                        ?>
                                                                        </a>
                                                                    </td>
                                                                    <td>Waiting For Admin Review</td>
                                                                </tr> <?php
                                                                $i++;
                                                            }
                                                        }
                                                    } else{ ?>
                                            
                        <td colspan="10"><center>No Record Found</center></td><?php }?>
                                            
                                                    
                                                    
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
         include('loaddetail.php');
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
    </body>
</html>
<?php
} ?>