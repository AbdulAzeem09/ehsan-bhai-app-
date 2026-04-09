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

       $_GET["categoryID"] = "10";
    $_GET["categoryName"] = "GroupEvents";

    //$header_event = "events";
    $activePage = 4;

      if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ 

    }else{
        $re = new _redirect;
        $re->redirect($BaseUrl."/grouptimelines");
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
                    <div class="col-md-12 text-center">
                        <h3>Active Events</h3>
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
                                <div class="box groupbox-danger">
                                    <div class="box-body">
                                        <div class="table-responsive bg_white">
                                            <table id="" class="table table-striped groupeventTable">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Event Title</th>
                                                        <th>Price</th>
                                                        <th>Category</th>
                                                        <th class="text-center">Remaining Tickets</th>
                                                        <th class="text-center">Purchase Tickets</th>
                                                        <th class="text-center">Intrested</th>
                                                        <th class="text-center">Going</th>
                                                        <th>Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    //$p      = new _postingview;
                                                   // $pf     = new _postfield;

                                    $p = new _spgroup_event;
                  $res = $p->myActPost($_SESSION['pid'], -1, $_GET["categoryID"]);
                                                    //$res    = $p->publicpost_event($_GET["categoryID"]);
                                                    //echo $p->ta->sql;
                                                  $i = 1; 
                         if($res != false){
              while ($row = mysqli_fetch_assoc($res)) {
                                                            //posting fields
                                                           //  $totTkt = $row2['spPostFieldValue'];
                                                           //  $catName = $row2['spPostFieldValue'];

                                                                     $pf = new _spgroupevent_transection;
                                                            $result_pf = $pf->postread($row['idspPostings']);
                                                            ///echo $pf->ta->sql."<br>";

                                                            //print_r($row);

                             if($row){
                                          $totTkt = "";
                          $catName = "";


                             $totTkt = $row['ticketcapacity'];
                         $catName = $row['eventcategory'];

                         while ($row2 = mysqli_fetch_assoc($result_pf)) {
                                    

                                   $soldticket += $row2['quantity'];

                         }

                                                                
                                                              /*  while ($row2 = mysqli_fetch_assoc($result_pf)) {
                                                                    
                                                                    if($totTkt == ''){
                                                                        if($row2['spPostFieldName'] == 'ticketcapacity_'){
                                                                            $totTkt = $row2['spPostFieldValue'];

                                                                        }
                                                                    }
                                                                    
                                                                    
                                                                    if($catName == ''){
                                                                        if($row2['spPostFieldName'] == 'eventcategory_'){
                                                                            $catName = $row2['spPostFieldValue'];

                                                                        }
                                                                    }
                                                                }*/
                                                                 ?>
                                                                <tr>
                                                                    <td><?php echo $i; ?></td>
                                                                    <td class="eventcapitalize"><a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'];?>"><?php echo $row['spPostingTitle'];?></a></td>
                                                                    <td><?php echo ($row['spPostingPrice'] > 0)? '$'.$row['spPostingPrice']:'Free';?></td>
                                                                    <td><?php echo $catName;?></td>
                                                                    <td class="text-center"><?php echo ($totTkt > 0)?$totTkt:'0';?></td>
                                                                    <td class="text-center"><?php echo ($soldticket > 0)?$soldticket:'0';?></td>
                                                                    <td class="text-center">
                                                                        <a href="javascript:void(0)" data-toggle='modal' data-target='#loaddetail' class="eventDetail" data-postid="<?php echo $row['idspPostings'];?>" data-pid="<?php echo $row['idspProfiles'];?>" data-intrest="1" >
                                                                        <?php
                                                                        $ie = new _eventIntrest;
                                                                        $result = $ie->chekGoing($row['idspPostings'], 1);
                                                                       // echo $ie->ta->sql;
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
                                                                    <td>
                                                                        <a href="<?php echo $BaseUrl.'/post-ad/events/?postid='.$row['idspPostings']; ?>" class="" data-postid="<?php echo $row['idspPostings'];?>"><i class="fa fa-edit"></i></a>
                                                                        <a href="<?php echo $BaseUrl.'/events/dashboard/detail.php?postid='.$row['idspPostings']; ?>" class=""><i class="fa fa-eye"></i></a>
                                                                    </td>
 </tr> <?php
                                                                $i++;
                                                            }
                                                        }
                                                        
                                                    }else{?>
                                                        <td colspan="9"><center>No Record Found</center></td> 
                                                           <?php }?>
                                                    
                                                    
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