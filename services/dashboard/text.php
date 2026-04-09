<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
?>


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
    $activePage = 6;
	if(isset($_GET['id']))
	{
		$p= new _state; 
	   $res = $p->new_remove($_GET['id']); 

	}
		if(($_GET['id']))
	{
		$p= new _state; 
	   $res = $p->form_update($_GET['id']); 

	}
		if(($_GET['id']))
	{
		$p= new _state; 
	   $res = $p->details_form($_GET['id']); 

	}
	
	
	
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
                    <?php include('servicemoduledash.php'); ?> 
                    <div class="sidebar col-md-2 no-padding left_service_menu" id="sidebar" >
                        <?php include('left-menu.php'); ?> 
                    </div>
                    <div class="col-md-10">
                           

                               <div class="col-sm-12 nopadding dashboard-section" style="">
                        <div class="col-xs-12 nopadding dashboardbreadcrum">
                            <ul class="breadcrumb" style="background-color: #FFF;padding-top: 10px;padding-bottom: 15px;">
                              <li><a href="<?php echo $BaseUrl;?>/services/dashboard">Dashboard</a></li>
                              <li>Draft Ads</li>
                              <!-- <li><?php echo $title;?></li> -->
                               <a href="<?php echo $BaseUrl.'/post-ad/services/?post';?>" class="btn post-project postproject" style="float: right;background-color: #07a2ae;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;" >Post An Ad</a>
                            </ul>
                        </div>

                       
                    </div>


                        <!-- <div class="col-xs-12 serviceDashTop text-center">
                            <h1>Draft Ads</h1>
                        </div> -->
                        <div class="row">
						<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

                            <div class="col-sm-12">
                                <div class="table-responsive bg_white">
                                    <table class="" id="">
                                        <thead>
                                            <tr>
                                               
                                                <th class="text-center">Creation Date</th>

                                              
                                                 <th class="text-center">Category</th>
                                                <th class="text-center">Location</th>
												 <th class="text-center">Location</th>
                                                 
												 <th class ="text-center">delete</th>
												 <th class ="text-center">Update</th>
												 
												 
												 
												 <th class ="text-center">Details</th>
												 <th class ="text-center">Profile</th>
												 <th class ="text-center">seller</th>
												 </tr>
                                               
                                               
                                         
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $p      = new _classified_fav; 
                                            $pf     = new _postfield; 
											$pq     = new _state;
                                            //$res = $p->myDraftJob($_GET['categoryID'] ,$_SESSION['pid']); 
											$res = $pq->readclassified($_SESSION['id']); 
                                            //$res    = $p->myposted_service($_GET['categoryID'], $_SESSION['pid']);
                                            //echo $p->ta->sql;
											//echo $res->num_rows;
                                             $i = 1; 
                                            if($res != false){ 
                                                while ($row = mysqli_fetch_assoc($res)) { 

                                                  ?>
												  <tr>
												  <td>  <?php  echo $row['idsprealEnquiry']?></td>
												   <td>  <?php  echo $row['sprealName']?></td>
												    <td>  <?php  echo $row['sprealEmail']?></td>
													<td>  <?php  echo $row['sprealPhone']?></td>
													
												     <td><a href="text.php?id=<?php echo $row["idsprealEnquiry"]; ?>">delete</a></td>
													 <td><a href="textup.php?idform=<?php echo $row["idsprealEnquiry"]; ?>">Update</a></td>
													   
													   <td>	
												
                      				            <?php
													  $p1=new _state;
													  $res3 = $p1->read_title($row['spPosting_idspPosting']);
													
													  $title = mysqli_fetch_assoc($res3);
													  echo $title['spPostingTitle'];
													   
													 ?>
													 </td>
													 
													  <td>	
												
                      				            <?php
													  $p4=new _state;
													  $res4 = $p4->read_form($row['spProfile_idspProfile']);
													
													  $title = mysqli_fetch_assoc($res4);
													  echo $title['spProfileName'];
													  
													 ?>
													 </td>
										<td>  <?php  echo $row['sellerid']?></td>

													
													
												  
												  <?php
                                                }
                                            }else{  

                                                   echo "<tr style='text-align:center;'><td colspan='4'><h4>No Draft Ads  Found</h4></td></tr>";


                                            }  ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </section>

        
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


  <!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
 <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
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