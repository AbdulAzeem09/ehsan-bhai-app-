<?php 
    include('../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="events/";
    include_once ("../authentication/check.php");   
    
}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    

    $_GET["categoryID"] = "9";
    $_GET["categoryName"] = "Events";
    $header_event = "events";

    // include '../assets/mpdf/mpdf.php';
?>

<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?>
        
        <!-- Magnific Popup core CSS file -->
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
        <!-- Magnific Popup core JS file -->
        <script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
        <!-- this script for slider art -->
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">

        

    </head>

    <body class="bg_gray">
        <?php include_once("../header.php");?>
        <div id="alertNotEmpProfile" class="modal fade" role="dialog" data-backdrop="static"  data-keyboard="false" >
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content no-radius">
                    
                    <div class="modal-body nobusinessProfile text-center" id="jobseakrAlert">
                        <h1><i class="fa fa-info" aria-hidden="true"></i></h1>
                        <h2>Your current profile does not have <br>access to this page. Please create or  switch<br> your current profile to either  <span>"Professional Profile"</span> to access this page.</h2>
                        <div class="space-md"></div>
                        <a href="<?php echo $BaseUrl.'/my-profile';?>" class="btn">Create or Switch Profile</a>
                        <a href="<?php echo $BaseUrl.'/events';?>" class="btn">Back to Home</a>
                    </div>
                    
                </div>
            </div>
        </div>


        <section class="main_box no-padding">
            
            <div class="Eventmap">

                <img src="../assets/images/events/event.jpg" style="background-size: cover;width: 100%;height: 400px;">
             <!--    <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d13931873.302173598!2d74.27075075!3d31.514923349999993!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1516348101457" frameborder="0" style="border:0" allowfullscreen></iframe>
                <?php
                $p      = new _postingview;
                $pf     = new _postfield;
                $res    = $p->publicpost_event($_GET["categoryID"]);
              
                if($res != false){
                    $total = $res->num_rows;
                }else{
                    $total = 0;
                }
                
                ?>

                <p><?php echo $total;?><br> <span>Global live events</span></p> -->
            </div>

            <div class="container eventExplrthefun explorecontainer" style="margin-top: 40px;padding-bottom: 0px;">
                
                <div class="row">

                    <div class="col-sm-12">
                        <div class="col-md-6 no-padding">
                        <ol class="breadcrumb"  style="padding: 8px 0px;margin-bottom: 20px!important;list-style: none;background-color: unset!important;border-radius: 4px;">
      <li><a href="<?php echo $BaseUrl ?>/events"><i class="fa fa-home"></i> Home</a></li>
    
      <li class="active">My Booking</li>
    </ol>
</div>

    <div class="col-md-6">
                        <div class="topBoxEvent text-right">
                            <?php
                            if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4){ 
                                $u = new _spuser;
                                // IS EMAIL IS VERIFIED
                                $p_result = $u->isverify($_SESSION['uid']);
                                if ($p_result == 1) {
                                    $pv = new _postingview;
                                    $reuslt_vld = $pv->chekposting(9,$_SESSION['pid']);
                                    if ($reuslt_vld == false) {
                                        ?>
                                        <a href="<?php echo $BaseUrl.'/post-ad/events/?post'?>" class="btn butn_save submitevent">Submit an event</a>
                                        <?php
                                    }
                                }else{
                                    ?>
                                    <a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="btn butn_save submitevent">Submit an event</a> <?php
                                }
                                ?>
                                <a href="<?php echo $BaseUrl.'/events/dashboard/';?>" class="btn butn_cancel eventdashboard"><i class="fa fa-dashboard"></i> Dashboard</a>
                                 <?php
                            }else{ ?>
                                <a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="btn butn_save submitevent">Submit an event</a> <?php
                            }
                            ?>
                        </div>

                  </div>

                    </div>
                </div>
              
            </div>
            
        </section>

        <section class="UpcomingSec">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="titleEvent text-center">
                            <h2>My <span>Booking</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row bg_white no-margin schedulecontainer" >
                    <div class="col-sm-12 no-padding">
                        <div class="">
 <div class="row">
                            
                            <div class="col-sm-12">
                                <div class="box box-danger">
                                    <div class="box-body">

                                        <div class="board">
                                <!-- <h2>Welcome to IGHALO!<sup>™</sup></h2>-->
                                <div class="board-inner">
                                    <div class="table-responsive bg_white">
                                            <table id="Eventtableid" class="table table-striped eventTable" style="margin-top: 20px;">

<!--                                                 <div class="showdiv" style="display:none;"><p style="font-weight: bold;">The SharePage</p>

                                                    <img src="<?php echo $BaseUrl.'/assets/images/logo/thesharepage.png'?>" alt="img" 
                                                    style="height: auto;" class="img-responsive" />
                                                    


                                                </div>
 -->                                                <thead>
                                                    <tr style="background-color: black;color: #fff;">
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
                                                    //$p      = new _postingview;
                                                   // $pf     = new _postfield;
$pet = new _spevent_transection;

$res = $pet->mybooking($_SESSION['pid']); 


                                   /* $p = new _spevent;
                                            $res = $p->myActPost($_SESSION['pid'], -1, $_GET["categoryID"]);*/
                                                  
                                                  $i = 1; 
                         if($res != false){
                                    while ($row = mysqli_fetch_assoc($res)) {
                                                          
                            /* if($row){*/

                                $p = new _spevent;
                                $res1 = $p->read($row['postid']);

                               

                                /*echo "<pre>";*/
                               /* print_r($row);
                                print_r($eventdetail);*/
                               /* print_r($row);*/
                               $totTkt = "";
                               $catName = "";
                                           $d = new _spprofiles;
                                            $sellerName = $d->getProfileName($row['sellid']);
                                
                             $totTkt = $row['ticketcapacity'];
                             $catName = $row['eventcategory'];

                                            if($res1){

                                                       
                                                while ($eventdetail = mysqli_fetch_assoc($res1)) {

                                                        
                                                                 ?>
                                                                <tr>
                                                                    <td><?php echo $i; ?></td>
                                                                    <td class="eventcapitalize"><a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$eventdetail['idspPostings'];?>"><?php echo $eventdetail['spPostingTitle'];?></a></td>
                                                                      <td><?php echo $eventdetail['spPostingEventVenue'];?></td>
                                                                      
                                                                       <td><?php echo ucwords($sellerName);?></td>
                                                                      <td style="text-align: center;"><?php echo $row['quantity'];?></td>
                                                                    <td style="text-align: center;"><?php echo ($eventdetail['spPostingPrice'] > 0)? '$'.$eventdetail['spPostingPrice']:'Free';?></td>
                                                                    <td style="text-align: center;"><?php echo '$'.$row['payment_gross'];?></td>
                                                                    
                                                                    <td><?php echo date("Y-m-d H:i:A",strtotime($row['payment_date']));?></td>
                                                                   <!--  <td class="text-center"><?php echo ($totTkt > 0)?$totTkt:'0';?></td> -->
                                                                   <!--  <td class="text-center">0</td> -->
                                                                 <!--    <td class="text-center">
                                                                        <a href="javascript:void(0)" data-toggle='modal' data-target='#loaddetail' class="eventDetail" data-postid="<?php echo $row['idspPostings'];?>" data-pid="<?php echo $eventdetail['idspProfiles'];?>" data-intrest="1" >
                                                                        <?php
                                                                        $ie = new _eventIntrest;
                                                                        $result = $ie->chekGoing($eventdetail['idspPostings'], 1);
                                                                        if($result != false && $result->num_rows >0){
                                                                            echo $result->num_rows;
                                                                        }else{
                                                                            echo 0;
                                                                        }
                                                                        ?>
                                                                        </a>  
                                                                    </td> -->
                                                                  <!--   <td class="text-center">
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
                                                                    </td> -->
                                                                    <td>
                                                                    <!--     <a href="<?php echo $BaseUrl.'/post-ad/events/?postid='.$row['idspPostings']; ?>" class="" data-postid="<?php echo $row['idspPostings'];?>"><i class="fa fa-edit"></i></a> -->
                                                                       <!--  <a href="<?php echo $BaseUrl.'/events/dashboard/detail.php?postid='.$eventdetail['idspPostings']; ?>" class=""><i class="fa fa-eye"></i></a> -->

                                                <a href="<?php echo $BaseUrl.'/events/eventreview.php?postid='.$eventdetail['idspPostings']; ?>" class=""><i class="fa fa-star"></i></a>

                                            <a href="<?php echo $BaseUrl.'/events/eventticket.pdf' ?>" class="" id="btnPDF"><i class="fa fa-file-pdf-o "></i></a>

                                                                    </td>
                                                                </tr> <?php
                                                                $i++;

 $Date = new DateTime($eventdetail['spPostingDate']);
 $startTime = $eventdetail['spPostingStartTime'];
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
        <td class="tddata newtddata">'.$eventdetail['spPostingTitle'].'</td>
        
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
        <td class="tddata">'.$eventdetail['spPostingEventVenue'].'</td>
        
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
        <td class="pdftablehead" style="border:none!important;">Price P. P.<br><br>$'.$eventdetail['spPostingPrice'].'</td>

       
        
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
<p font-size: 12px;>Full Payment Received successfully. <br> Transaction ID : '.$row['txn_id'].'</p>
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


                                }  else{?>
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
                    </div>
                </div>

            </div>
        </section>

       <?php ?>
<!-- 
        <section class="EventregisterBox">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="headingreg text-center">
                            <h2>REGISTER NOW AND JOIN WITH US!!</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <form class="">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><img src="<?php echo $BaseUrl;?>/assets/images/events/map.png"> Name</label>
                                <input type="text" name="" class="form-control" placeholder="Enter your name">
                            </div>
                        </div>  
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><img src="<?php echo $BaseUrl;?>/assets/images/events/email.png"> Email</label>
                                <input type="email" name="" class="form-control" placeholder="Enter your email">
                            </div>
                        </div>  
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><img src="<?php echo $BaseUrl;?>/assets/images/events/phone.png"> Phone</label>
                                <input type="text" name="" class="form-control" placeholder="Enter your phone">
                            </div>
                        </div>  
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><img src="<?php echo $BaseUrl;?>/assets/images/events/password.png"> Password</label>
                                <input type="password" name="" class="form-control" placeholder="Enter your password">
                            </div>
                        </div>  
                        <div class="col-md-12 text-center">
                            <input type="submit" name="" value="Register" class="btn registerbtn">
                        </div>
                    </form>
                    
                </div>
            </div>
        </section>
        <section class="eventGallery">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="titleEvent text-center">
                            <h2>Event Gallery</h2>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    
                    $start = 0;
                    $limit = 8;
                    $count = 1;
                    $p      = new _spevent;
                    $res    = $p->publicpost($start, $_GET["categoryID"]);
                    if($res != false){
                        while ($row = mysqli_fetch_assoc($res)) { ?>
                            <div class="col-md-3">
                                <div class="EvntImg">
                                    <a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'];?>" >
                                        <?php
                                        $pic = new _eventpic;
                                        $res2 = $pic->read($row['idspPostings']);
                                        if ($res2 != false) {
                                            $rp = mysqli_fetch_assoc($res2);
                                            $pic2 = $rp['spPostingPic'];
                                            echo "<img alt='Posting Pic' class='img-responsive  btn-border-radius'  src=' " . ($pic2) . "' >"; ?>
                                            <?php
                                        } ?>
                                    </a>
                                </div>
                            </div> <?php
                            $count++;
                            if($count > 8){
                                break;
                            }
                        }
                    }
                    ?>
                    
                            

                </div>
            </div>
        </section> -->

    

   <!--  <section class="main_box">            
            <div class="container">
                    

                <div class="row">


                    <div class="col-md-12">
                    <div class="bg_white detailEvent m_top_10">

      

                 <div class="row">
                     <div class="showeventrating">

                        <div style="text-align: -webkit-center;  padding-bottom: 60px; padding-top: 12px;">


                            <img src="<?php echo $BaseUrl;?>/assets/images/logo/tsp_trans.png" class="img-responsive" style="height: 70px;"><p style="font-size: 30px;">The SharePage</p></div>



                 <div style="position: absolute; top: 150px; right: 52px;"><p style="font-size: 23px; padding-left: 3px;"> Booked on</p></div>

<div class="row">
<div class="col-md-6">                                 
 <table class="table">
   
    <tbody>
      <tr>
        <td class="pdftablehead">Posted BY</td>
        <td>Doe</td>
        
      </tr>
      <tr>
        <td class="pdftablehead">Event Title</td>
        <td>Moe</td>
      
      </tr>
      <tr>
        <td class="pdftablehead">Event Venue</td>
        <td>Dooley</td>
        
      </tr>
    </tbody>
  </table>

  </div>
  <div class="col-md-6">
      <table class="table">
   
    <tbody>
      <tr>
        <td class="pdftablehead">Quantity</td>
        <td>Doe</td>
        
      </tr>
      <tr>
        <td class="pdftablehead">Tickets Price(Each Person)</td>
        <td>Moe</td>
      
      </tr>
      <tr>
        <td class="pdftablehead">Total Price</td>
        <td>Dooley</td>
        
      </tr>
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
 -->



        <?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>
<!--         <script type="text/javascript">
            
            

        $("#btnPDF").on("click", function () {

         window.location.href='<?php echo $BaseUrl;?>/events/phpflow.php';

           
            alert();
            html2canvas($('#Eventtableid')[0], {

                onrendered: function (canvas) {

                    // alert();
                    //$(".showdiv").show();
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{

                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("Table.pdf");
                }
            });
        });
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script> -->
 
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
