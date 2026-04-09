<?php
   
    include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="job-board/";
    include_once ("../../authentication/islogin.php");
 
}else{
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");


    $_GET["categoryid"] = "2";
    $_GET["categoryName"] = "Job Board";
    $activePage = 3;
    $header_jobBoard = "header_jobBoard";
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
       <?php include('../../component/f_links.php');?>
        <!--This script for sticky left and right sidebar STart-->
        

        <!-- ===== INPAGE SCRIPTS====== -->
        <!-- High Charts script -->
        <script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
        <!-- Morris chart -->
        <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <?php include('../../component/dashboard-link.php'); ?>
    </head>

    <body class="bg_gray">
        <?php
        include_once("../../header.php");
        ?>
        <section class="landing_page">
            <div class="container">
                <div class="row">
                    <?php include('../thisisjobboard.php'); ?> 
                    <div class="sidebar col-md-3 no-padding" id="sidebar" >
                        <div class="col-md-5">
                                <!-- TABLE: LATEST ORDERS -->
                               
                                <!-- =======donut chart===== -->
                               <!--  <div class="nav-tabs-custom">

                                    <ul class="nav nav-tabs pull-right">
                                        <li class="pull-left header"><i class="fa fa-pie-chart"></i> Donut Chart</li>
                                    </ul>
                                    <div class="tab-content no-padding">
                                        <div class="chart tab-pane active" id="chart-two" style="position: relative; height: 285px;">

                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        <?php include('left-menu.php'); ?> 
                    </div>
                    <div class="col-md-9">
                    <div class="col-md-12 nopadding dashboard-section whiteboardmain" style="margin-top: 7px;padding: 16px 0px 0px 0px;">
                        <div class="col-xs-12 dashboardbreadcrum">
                            <ul class="breadcrumb">
                              <li><a href="https://dev.thesharepage.com/job-board/dashboard"> Dashboard</a></li>
                              <li>My Earnings</li>
                              <!-- <li></li> -->
                               </ul>
                        </div>
                    </div>
                    <div class="col-md-12 nopadding dashboard-section whiteboardmain " style="margin-top: 7px;padding: 16px 0px 0px 0px;">
                    <div class="col-md-4 ">
                        <label class="form-label">Showing 1-24 of 205 Videos</label>
                        </div>
                        <div class="col-md-2">
                                <form class="row gx-2">
                                <label class="form-label" for="timepicker2">Sort By : Price</label>
                                  <div class="col-auto"><select class="form-select form-select-sm" aria-label="Bulk actions">
                                      <option value="Refund">Low To High</option>
                                      <option value="Delete">High To Low</option>
                                    </select></div>
                                </form>
                              </div>
                              <div class='col-md-2'>
                 
                 <div class="form-group ">
                 <label class="form-label" for="timepicker2">Date From</label>
                    <div class='input-group date' id='datetimepicker6'>
                       <input type='text' class="form-control" />
                       <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                       </span>
                    </div>
                 </div>
              </div>
              <div class='col-md-2'>
              <label class="form-label" for="timepicker2">Date To</label>
                 <div class="form-group">
                    <div class='input-group date' id='datetimepicker7'>
                       <input type='text' class="form-control" />
                       <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                       </span>
                    </div>
                 </div>
              </div>
              <div class='col-md-2' style="padding-top: 20px;">
              <button class="btn btn-success">Search</button>
                    </div>
              </div>
              
                    

                    <script type="text/javascript">
   $(function () {
       $('#datetimepicker6').datetimepicker();
       $('#datetimepicker7').datetimepicker({
   useCurrent: false //Important! See issue #1075
   });
       $("#datetimepicker6").on("dp.change", function (e) {
           $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
       });
       $("#datetimepicker7").on("dp.change", function (e) {
           $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
       });
   });
</script>

                        <?php 
                     
                        ?>
                        
                        
                        <!-- repeat able box -->
                        <div class="whiteboardmain" style="min-height: 300px;margin-top: 100px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped tbl_jobboard text-center">
                                            <thead class="">
                                                <tr>
                                                <th>ID</th>
                                                    <th>Job Title</th>
                                                    
                                                    <th>Date</th>
                                                    
                                                    <th>Price</th>
                                                    <th>Action</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $m = new  _postingview;
                                                $result = $p->myExpireProduct($_GET['categoryid'], $_SESSION['pid']);
                                                //$result = $m->myDeactiveProfilejob($_SESSION['pid']);
                                                //echo $p->ta->sql;
                                                if($result){
                                                    while ($row = mysqli_fetch_assoc($result)) { 
                                                        $postDate = new DateTime($row['spPostingDate'])
                                                        ?>
                                                        
                                                        <tr>
                                                            <td>1</td>
                                                            <td><a href="<?php echo $BaseUrl.'/job-board/dashboard/applicant.php?postid='.$row['idspPostings'];?>" ><?php echo ucfirst($row['spPostingTitle']);?></a></td>
                                                            <td><?php echo $postDate->format('d-M-Y');?></td>
                                                            <td>10000</td>
                                                            
                                                          
                                                            <td>
                                                                <a href="<?php echo $BaseUrl.'/post-ad/job-board/?postid='.$row['idspPostings'];?>" class="btn btn-success">Renew</a>
                                                                <a href="javascript:void(0)" data-postid="<?php echo $row['idspPostings']; ?>" class="btn btn-danger delpost"><i class="fa fa-trash"></i></a>

                                                                
                                                            </td>
                                                        </tr> <?php
                                                    }
                                                }


                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- repeat able box end -->
                        

                    </div>
                </div>
            </div>
        </section>
        
        <?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
    </body>
</html>
<?php
}?>