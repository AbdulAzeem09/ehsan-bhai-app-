<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
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
	   $res = $p->form_create($_GET['id']); 

	}
	//if(($_GET['id']))
	//{
		

//	}
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

<?php
/*    
       $p= new _state; 
	   $res1 = $p->form_update($_GET['idform']);
  
	   $row4 = mysqli_fetch_assoc($res1);*/

?>
                        <!-- <div class="col-xs-12 serviceDashTop text-center">
                            <h1>Draft Ads</h1>
                        </div> -->
                        <div class="row">
						<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

                            <div class="col-sm-12">
                                <div class="table-responsive bg_white">
								<!--<form action="insert1.php" method="post">-->
								 idsprealEnquiry:-<input type="text" name="idsprealEnquiry" id="spreal"><br/><br/>
								  sprealName:    -<input type="text" name="sprealName"  id="name"><br/><br/>
								   sprealEmail:   -<input type="text" name="sprealEmail"  id="email"><br/><br/>
								    sprealPhone:   -<input type="text" name="sprealPhone"  id="phone"><br/><br/>
									 sprealMessage:   -<input type="text" name="sprealMessage"  id="message"><br/><br/>
									  spPosting_idspPosting:   -<input type="text" name="spPosting_idspPosting"  id="posting"><br/><br/>
									   spProfile_idspProfile:   -<input type="text" name="spProfile_idspProfile"  id="profile" ><br/><br/>
									    sprealType:   -<input type="text" name="sprealType"  id="stype"><br/><br/>
									
										  enquiryDate	:   -<input type="date" name="enquiryDate"  id="endate"><br/><br/>
									 	Select Country  <select name="country" id="con1">
										 <option value="select1">select country</option>
										 <?php  
										 
										 $k1 = new  _state;
										 $res4= $k1->select_country();
										while( $icoutry= mysqli_fetch_assoc($res4))
										{?>
											
											<option value="<?php   echo $icoutry['country_id']; ?>"><?php   echo $icoutry['country_title']; ?></option>
											
									<?php	}
										
										 ?>
                                         
                                                </select> 
									<br/><br/>
									      <button type="button" id="button1">submit</button>
							<!--	</form>-->?
                                    
                                            

                                        </tbody> 
                                    </table>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </section>


<script>
 $(document).ready(function(){
    $("#button1").click(function(){

var spil =   $("#spreal").val();
var fname =   $("#name").val();
var femail =   $("#email").val();
var mphone =   $("#phone").val();
var emassage =   $("#message").val();
var eposting =   $("#posting").val();
var eprofile =   $("#profile").val();
var etype =   $("#stype").val();
var eselle =   $("#seller").val();
var enqui =   $("#endate").val();  
var  sell = $("#con1").val();


 $.ajax({
                    url:'insert1.php',
                    method:'POST',
                    data:{
                       idsprealEnquiry:spil,
                       sprealName:fname, 
                     sprealEmail:femail,
					 sprealPhone:mphone ,
					 sprealMessage:emassage ,
					 
					 spPosting_idspPosting:eposting ,
					 spProfile_idspProfile:eprofile,
					 sprealType:etype,
					 sellerid:eselle,
					 enquiryDate:enqui,
					 country:sell
					 
                    },
                   success:function(data){
                       alert("insert success");
                   }
                });
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