<?php
    include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="services/";
    include_once ("../../authentication/islogin.php");
  
}else{
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

if($_SESSION['ptid'] == 2 || $_SESSION['ptid'] == 5){ 
    $re = new _redirect;
    $location = $BaseUrl."/services/";
    $re->redirect($location);
}

    $_GET["categoryID"] = "7";
    $_GET["categoryName"] = "Services";
    $header_servic = "header_servic";
    $activePage = 7;
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>
        <!-- ===== INPAGE SCRIPTS====== -->
        <!-- High Charts script -->
        <script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
        <!-- Morris chart -->
        <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <?php include('../../component/dashboard-link.php'); ?>
         <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
         <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
         <?php include('../../component/dashboard-link.php'); ?>

                 <style type="text/css">
           
               .sweet-alert h2 {
                 
                 font-size: 21px!important;
                 margin: 10px 0px!important;

               }
       

               .sweet-alert {
            
                    width: 441px!important;
                    padding: 8px!important;

                  }


       </style>
    </head>

    <body class="bg_gray">
         <?php
        include_once("../../header.php");
        ?>
        <section class="main_box">
            <div class="container">
                <div class="row">
                    <?php //include('servicemoduledash.php'); ?> 
                    <div class="sidebar col-md-2 no-padding left_service_menu" id="sidebar" >
                        <?php include('left-menu.php'); ?> 
                    </div>
                    <div class="col-md-10">

                            <div class="col-sm-12 nopadding dashboard-section" style="">
                        <div class="col-xs-12 nopadding dashboardbreadcrum">
                            <ul class="breadcrumb" style="background-color: #FFF;padding-top: 10px;padding-bottom: 15px;">
                              <li><a href="<?php echo $BaseUrl;?>/services/dashboard">Dashboard</a></li>
                              <li>Enquiry Received </li>
                              <!-- <li><?php echo $title;?></li> -->
                               <a href="<?php echo $BaseUrl.'/post-ad/services/?post';?>" class="btn post-project postproject" style="float: right;background-color: #07a2ae;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;" >Post An AD</a>
                            </ul>
                        </div> 

                       
                    </div>


                        <!-- <div class="col-xs-12 serviceDashTop text-center">
                            <h1>Enquiry Ads</h1>
                        </div> -->
						<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive" style="overflow:hidden;">
								
								   <?php
                                            $p      = new _classified;
                                            $pf     = new _postfield;
                                            $res = $p->myServEnq($_SESSION['pid']);
                                           
                                            if($res != false){
												$nque="example";
											}
												 else{
													 $nque="example1";
												 }
												?>
                                    <div class="table-responsive">
                                    <table class="table table-striped table-bordered dashServ display" id="<?php echo $nque; ?>">
                                        <thead>
                                            <tr>
                                              <th>No</th>
                                                <th>Service Name</th>
                                                <th class="text-center">Category</th>
                                                <th class="text-center">Person</th>
                                                <!-- <th class="text-center">Chat</th> -->
                                                <th class="text-center">Enquiry Message</th>
                                                <th class="text-center">Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $p      = new _classified;
                                            $pf     = new _postfield;
                                            //$res    = $p->myposted_expire_service($_GET['categoryID'], $_SESSION['pid']);
                                            $res = $p->myServEnq($_SESSION['pid']);
                                            //$res = $p->event_favorite($_GET["categoryID"], $_SESSION['pid']);
                                            //echo $p->ta->sql;
                                            $i = 1;
                                            if($res != false){
                                                while ($row = mysqli_fetch_assoc($res)) { 

                                                    // print_r($row);
                                                    ?>
                                                    <tr>
                                                      <td class="text-center"><?php echo $i; ?></td>
                                                        <td>
                                                      
                                                            <a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$row['idspPostings'];?>"><?php echo ucfirst($row['spPostingTitle']); ?></a>
                                                        </td>
                                                        <td class="text-center"><?php echo ucfirst($row['spPostSerComty']); ?></td>
                                                        <?php
                                                       $pro = new  _spprofiles;
                                                       // $resultpro = $pro->read($row['spProfile_idspProfile']);
                                                       $resultpro = $pro->read($row['sender_id']);

                                                       $rowsp = mysqli_fetch_assoc($resultpro);
                                                       //print_r($row);
                                                       ?>
                                                        
                                                        <td class="text-center"> <a href="<?php echo $BaseUrl.'/friends/?profileid='.$rowsp['idspProfiles'];?>"><?php echo ucfirst($rowsp['spProfileName']);?></a></td>
                                                    <!--    <td class="text-center"> <a href="javascript:void(0)"  onclick="javascript:chatWith(<?php echo $row['sender_id'];?>)"  class="red"><i class='fas fa-comment-dots' style="color: #ff7208;"></i></a></td>  -->
                                                        <td class="text-center"><?php  echo $row['enquiry_msg'];

                                                        /*echo $out = strlen($row['enquiry_msg']) > 50 ? substr($row['enquiry_msg'],0,50)."..." : $row['enquiry_msg'];*/ ?></td>
                                                        <td class="text-center">
														
														<a href="javascript:void(0)" data-postid="<?php echo $row['enquiry_id'];?>" class="delenq"><i title="Delete" class="fa fa-trash"></i></a>
														
																		<a href="<?php echo $baseurl ;?>/services/dashboard/reply-enquiry.php?id=<?php echo $row['enquiry_id'];?>" class=""><i style="color: #428bca" title="Edit" class="fa fa-pencil"></i></a>
														
														</td>
                                                        
                                                        <!-- <td class="text-center"><a href="javascript:void(0)"><i class="fa fa-trash"></i></a></td> -->
                                                    </tr>
                                                    <?php

$i++;
                                                }
                                            }else{  

                                                   echo "<tr style='text-align:center;'><td colspan='6'><h4>No Enquiry Found</h4></td></tr>";


                                            } 


                                            ?>


                                        </tbody>
                                    </table>
                                        </div>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </section>
<script type="text/javascript">
    
  $(".delenq").click(function(){
   // alert();
    var postid = $(this).attr("data-postid");
  //alert(postid);
      swal({
            title: "Are you sure you want to delete ?",
            type: "warning",
            confirmButtonClass: "sweet_ok",
            confirmButtonText: "Yes",
            cancelButtonClass: "sweet_cancel",
            cancelButtonText: "No",
            showCancelButton: true,
          },
        function(isConfirm) {
            if (isConfirm) {
             if(postid > 0){
                        $.post("../delenq.php", {enqid:postid}, function (data) {
                        
                         // window.location.href = MAINURL+'/post-ad/sell/?post';

                         window.location.reload();
                        
                        });
                      }
            }
        });
 
  });

</script>
        
        <div class="space-lg"></div>

       <?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
        <!-- notification js -->
        <script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
    </body>
</html>
<?php
} ?>



  <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> -->
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
	});
	
	</script>