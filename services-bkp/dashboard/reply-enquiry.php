<?php
    include('../../univ/baseurl.php');
    session_start();

    //print_r($_SESSION);
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="services/";
    include_once ("../../authentication/islogin.php");
  
}else{
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    
/*if($_SESSION['ptid'] != 2 && $_SESSION['ptid'] != 5){ 
    $re = new _redirect;
    $location = $BaseUrl."/services/";
    $re->redirect($location);
}*/
    $_GET["categoryID"] = "7";
    $_GET["categoryName"] = "Services";
    $header_servic = "header_servic";
    $activePage = 77;
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
				  
			  .for_seller {
					background-color: #337ab7;
                    color: white;
					margin:0px 0px
                  }
              .for_buyer {
                        background-color: brown;
                        color: white;
						margin:0px 0px
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
                      <div class="col-md-12">
                            <?php
                            if(isset($_SESSION['err']) && $_SESSION['count'] == 0){ ?>
                                <p class="alert alert-success error_show"><?php echo $_SESSION['err'];?></p><?php
                                $_SESSION['count']++;
                                unset($_SESSION['err']);
                            }
                            ?>
                        </div>
                    <?php include('servicemoduledash.php'); ?> 
                    <div class="sidebar col-md-2 no-padding left_service_menu" id="sidebar" >
                        <?php include('left-menu.php'); ?> 
                    </div>
                    <div class="col-md-10">
									                 
                    <div class="col-md-12 nopadding dashboard-section " style="">
                        <div class="col-xs-12 nopadding dashboardbreadcrum">
                            <ul class="breadcrumb" style="background-color: #FFF;padding-top: 10px;padding-bottom: 15px;">
                              <li><a href="<?php echo $BaseUrl;?>/services/dashboard">Dashboard</a></li>
                              <li>Enquiry Sent</li>
                            </ul>
                        </div>


                    </div>


                        <!-- <div class="col-xs-12 serviceDashTop text-center">
                            <h1>Enquiry Ads</h1>
                        </div> -->
						
						<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
                        <div class="row">
						

                            <div class="col-md-12">
                          
										
																    <?php     ?>

										
                                            <?php

                                            $p      = new _classified;
											$eq    = new _addServiceEnq;
                                            $pf     = new _postfield;
                                            //$res    = $p->myposted_expire_service($_GET['categoryID'], $_SESSION['pid']);
											
											
											
                                            $res = $eq ->readEnq($_GET['id']);
											$row = mysqli_fetch_assoc($res);
										$posid=$row['spPosting_idspPosting'];
										$enq_msg=$row['enquiry_msg'];
										$sndrID=$row['sender_id'];
										$poID=$row['spPosting_idspPosting'];
                                            $res1 = $p->readclassified($posid);
											$row123 = mysqli_fetch_assoc($res1);
								
											$sppostitle=$row123['spPostingTitle'];
											
											$pro = new  _spprofiles;
                                            $resultpro = $pro->read($sndrID);
                                             $rowsp = mysqli_fetch_assoc($resultpro);
											 $sndrName = $rowsp['spProfileName'];
											
											?>
											<span><b>Sender Name:</b> <?= $sndrName; ?></span>
											<br>
											<span><b>Product Name:</b> </span><a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$row['spPosting_idspPosting'];?>"><?php echo ucfirst($sppostitle); ?></a>
											<br>
											<span><b>Enquiry Message:</b> <?= $enq_msg; ?></span>
											<br>
											
											<?php  
												$enmsg = $eq->readEnqmsg($_GET['id']);
												echo "<h3> Messages </h3>";
												while($enquirymessage = mysqli_fetch_assoc($enmsg)){
												$sendID = $enquirymessage['sender_id'];
												$resultpro2 = $pro->read($sendID);
                                             $rowsp2 = mysqli_fetch_assoc($resultpro2);
											 $senderName = $rowsp2['spProfileName'];
											 
												?> <div class="row <?php if($sendID==$_SESSION['pid']){ echo 'for_seller'; }else{ echo 'for_buyer'; } ?>"> <?php
									
												echo "<div class='col-md-3' style='padding:10px 15px; font-size:16px'>";
												echo "<i class='fa fa-user'></i> " . $senderName;
												echo "</div>";
												echo "<div class='col-md-6'>";
												echo "</div>";
												echo "<div class='col-md-3' style='padding:10px 0px'>";
												echo $enquirymessage['enq_date'];
												echo "</div>";
												echo "</div>";
												echo "<div class='row' style='margin: 0px 0px 10px 0px; padding:7px 20px; border:1px solid gray' >";
												echo $enquirymessage['message'];
												echo "</div>";
												}
												
												
									
												?>
											
											<form action="" method="post">
											<textarea name="msg" id="enqmsg" rows="5" cols="50" class="form-control"></textarea>
											<br>
											<button type="submit" class="btn btn-primary" name="submitmsg">Send</button>
											</form>
										<?php 
											if(isset($_POST['submitmsg'])){
											$curDate = date("Y/m/d");
												$msgdata = array(
												'sender_id' => $_SESSION['pid'],
												'reciever_id' => $sndrID,
												'message' => $_POST['msg'],
												'post_id' => $poID,
												'enq_id' => $_GET['id'],
												'enq_date' => $curDate,
												);
												$eq->createmsg($msgdata);
												}
											
											?>
										<?php
                                            //echo $p->ta->sql;
                                        //     $i = 1;
                                            if($res != false){
                                                while ($row = mysqli_fetch_assoc($res)) { 

                                                    print_r($row);
													die();
                                                    ?>
                                                    <tr>
                                                      <td class="text-center"><?php echo $i; ?></td>
                                                        <td>
                                                            <?php
                                                            $pic = new _classifiedpic;
                                                            $res2 = $pic->read($row['idspPostings']);
                                                            if ($res2 != false) {
                                                                $rp = mysqli_fetch_assoc($res2);
                                                                $pic2 = $rp['spPostingPic'];
                                                                echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; ?>
                                                                <?php
                                                            } else{
                                                                echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>"; ?>
                                                                <?php
                                                            } ?> 
                                                            <a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$row['idspPostings'];?>"><?php echo ucfirst($sppostitle); ?></a>
                                                        </td>
                                                        <?php
                                                         $pro = new  _spprofiles;
                                                           $resultpro = $pro->read($row['spProfile_idspProfile']);

                                                           $rowsp = mysqli_fetch_assoc($resultpro);

                                                         /*$ArtistName = $rowsp['spProfileName'];
                                                           $ArtistId   = $row['spProfiles_idspProfiles'];
                                                           $ArtistAbout= $rowsp['spProfileAbout'];
                                                           $ArtistPic  = $rowsp['spProfilePic'];
                                                           $UserEmail  = $rowsp['spProfileEmail'];
                                                           $UserPhone  = $rowsp['spProfilePhone'];*/
                                                           ?>
                                                        
                                                        <td class="text-center"><a href="<?php echo $BaseUrl.'/friends/?profileid='.$row['spProfile_idspProfile'];?>"><?php echo ucfirst($rowsp['spProfileName']);?></a></td>
                                                        <td class="text-center"> <a href="javascript:void(0)"  onclick="javascript:chatWith(<?php echo $row['spProfile_idspProfile'];?>)"  class="red"><i class='fas fa-comment-dots' style="color: #ff7208;"></i></a></td>
                                                        <td class="text-center"><?php echo $row['enquiry_msg']; ?></td>
                                                        <td class="text-center"><a href="javascript:void(0)" data-postid="<?php echo $row['enquiry_id'];?>" class="delenq"><i class="fa fa-trash"></i></a></td>
                                                        
                                                        <! <td class="text-center"><a href="javascript:void(0)"><i class="fa fa-trash"></i></a></td> >
                                                    </tr>
                                                    <?php
                                                       $i++;
                                                }
                                            }else{  

                                            echo "<tr style='text-align:center;'><td colspan='5'><h4>No Enquiry Found</h4></td></tr>";


                                            } 


                                            ?>


                                        </tbody>
                                    </table>
                                </div-->
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

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
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


