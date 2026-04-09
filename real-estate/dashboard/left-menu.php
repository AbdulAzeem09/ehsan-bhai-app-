<style>
	.left_real_menu ul li a:hover {background-color: #bad280;color: #FFF;}
	
	
	.realTopBread .container .row .col-md-6 h2 { margin-top: 0px;}
	.sidebar-menu li{
	background-color: white;}
	input[type="search"] { width: 100px !important;}
	
	.left_real_menu ul li.activepage {
    background-color: #95ba3d;
    color: #FFF;}
	.a1 {
    color: black!important;
}
.aa {
    background-color: #95ba3d!important;
}
.rent{background-color: #cfbfbf;}

	
</style>
<ul class="sidebar-menu">
								<?php
$u = new _spuser;
if ($_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 3) {
    // IS EMAIL IS VERIFIED
    $p_result = $u->isverify($_SESSION['uid']);
    if ($p_result == 1) {
        $pv = new _postingview;
        $reuslt_vld = $pv->chekposting(3,$_SESSION['pid']);

        if ($reuslt_vld == false) {
            ?>
            <li><a style="margin-top: 0px;background-color:green;color:white;font-family:times" href="<?php echo $BaseUrl.'/post-ad/real-estate/?post';?>">Back To Real Estate Home</a></li>
            <?php
        }
    }
}
?>
        <!-- seller dashboard by default -->
        <li class="<?php echo ($activePage == 10)?'activepage sidebar-link': '';?>"><a  class="a1" href="<?php echo $BaseUrl.'/real-estate/dashboard'; ?>">Dashboard</a></li>
        <li><a class="a1" href="<?php echo $BaseUrl.'/post-ad/real-estate'; ?>">Post an Ad</a></li>
		    <li class="<?php echo ($activePage == 8)?'activepage' : '';?> collapsed"  data-toggle="collapse" data-target="#collapseThreec" style=" cursor: pointer; "> <a class="a1"><span>Real Estates</span> <i class="fa fa-angle-right pull-right"></i></a></li>
		    <div id="collapseThreec" class="collapse <?php if($activePage == 1 || $activePage == 4 || $activePage == 22 || $activePage == 23 || $activePage == 5 || $activePage == 12){ echo 'show'; } ?>" data-parent="#accordionExample"> <ul class="sidebar-menu no-padding innerReal"> 
		      <li class="<?php echo ($activePage == 1)?'activepage' : '';?>"><a class="a1" href="<?php echo $BaseUrl.'/real-estate/dashboard/active-property.php';?>" class="sidebar-link" >Active properties</a></li>
		      <li class="<?php echo ($activePage == 4)?'activepage' : '';?>"><a class="a1" href="<?php echo $BaseUrl.'/real-estate/dashboard/draft-property.php';?>" >Draft Property Ad</a></li>
		      <!-- <li class="rent <?php echo ($activePage == 22)?'activepage aa' : '';?>" ><a class="a1" href="<?php echo $BaseUrl.'/real-estate/dashboard/expired-property.php';?>" >Expired properties</a></li>  -->
          <li class="rent <?php echo ($activePage == 23)?'activepage aa' : '';?>"><a  class="a1" href="<?php echo $BaseUrl.'/real-estate/dashboard/sold-property.php';?>">Sold properties</a></li>
          <li class="<?php echo ($activePage == 5)?'activepage' : '';?>"><a class="a1" href="<?php echo $BaseUrl.'/real-estate/dashboard/my-enquiry.php';?>" >Sent Enquiry</a></li>	
		      <li class="<?php echo ($activePage ==12)?'activepage' : '';?>"><a class="a1" href="<?php echo $BaseUrl.'/real-estate/dashboard/received-enquiry.php';?>" >Received Enquiry</a></li></ul>
        </div>
        <!-- seller dashboard by default -->
        <li class="<?php echo ($activePage == 8)?'activepage' : '';?> collapsed"  data-toggle="collapse" data-target="#collapseThree" style=" cursor: pointer; "> <a class="a1"><span>Rentals</span> <i class="fa fa-angle-right pull-right"></i></a></li>
        <div id="collapseThree" class="collapse <?php if($activePage == 3 || $activePage == 2 || $activePage == 6 || $activePage == 7 || $activePage == 20 || $activePage == 21 || $activePage == 17 || $activePage == 11 || $activePage == 9){ echo 'show'; } ?>" data-parent="#accordionExample"> <ul class="sidebar-menu no-padding innerReal"> 
		      <li class="<?php echo ($activePage == 8)?'activepage' : '';?> collapsed"  data-toggle="collapse" data-target="#collapseThreed" style=" cursor: pointer; "> <a class="a1"><span>Rental Ads</span> <i class="fa fa-angle-right pull-right"></i></a></li>
          <div id="collapseThreed" class="collapse <?php if($activePage == 3 || $activePage == 2){ echo 'show'; } ?>" data-parent="#accordionExample"> <ul class="sidebar-menu no-padding innerReal"> 
	          <li  style="background-color: #f5f2f2;" class="rent <?php echo ($activePage == 3)?'activepage aa' : '';?>" ><a class="a1" href="<?php echo $BaseUrl.'/real-estate/dashboard/rent-room.php';?>"The file /var/www/html/SHAREPAGE_…-ad/real-estate/index.php changed on disk. >Rent Room</a></li> 
            <li  style="background-color:#f5f2f2;" class="rent <?php echo ($activePage == 2)?'activepage aa' : '';?>"><a  class="a1" href="<?php echo $BaseUrl.'/real-estate/dashboard/rent-property.php';?>">Rent Entire Place</a></li> </ul> 
          </div>
          <li class="collapsed"  data-toggle="collapse" data-target="#collapseThreea" style=" cursor: pointer; "><a class="a1"><span>Booking</span> <i class="fa fa-angle-right pull-right"></i></a></li>
		      <div id="collapseThreea" class="collapse <?php echo ($activePage == 6 || $activePage == 7 || $activePage == 20 || $activePage == 21)?'show' : '';?>" data-parent="#accordionExample"><ul class="sidebar-menu no-padding innerReal">
            <li style="background-color: #f5f2f2;" class=" <?php echo ($activePage == 6)?'activepage aa' : '';?>"><a class="a1" href="<?php echo $BaseUrl.'/real-estate/dashboard/booking.php';?>" >Received Booking For Room </a></li> 
            <li style="background-color: #f5f2f2;" class=" <?php echo ($activePage == 7)?'activepage aa' : '';?>"><a  class="a1" href="<?php echo $BaseUrl.'/real-estate/dashboard/booking2.php';?>" >Received Booking For Place </a></li>
            <li  style="background-color: #f5f2f2;" class=" <?php echo ($activePage == 20)?'activepage aa' : '';?>"><a  class="a1" href="<?php echo $BaseUrl.'/real-estate/dashboard/my_send_booking.php'; ?>" >Send Booking for Room</a></li>
            <li style="background-color: #f5f2f2;"  class=" <?php echo ($activePage == 21)?'activepage aa' : '';?>"><a  class="a1" href="<?php echo $BaseUrl.'/real-estate/dashboard/my_send_booking2.php'; ?>" >Send Booking for Place</a></li></ul>
          </div>
          <li class="<?php echo ($activePage == 17)?'activepage' : '';?>"><a class="a1" href="<?php echo $BaseUrl.'/real-estate/dashboard/hosting-details.php';?>" >Host Details</a></li>
          <li class="<?php echo ($activePage == 11)?'activepage' : '';?>"><a class="a1" href="<?php echo $BaseUrl.'/real-estate/dashboard/favourite.php';?>" >Favourite Listing</a></li>
          <li class="<?php echo ($activePage == 9)?'activepage' : '';?>"><a class="a1" href="<?php echo $BaseUrl.'/real-estate/dashboard/myFlag.php';?>" >Flagged Posting</a></li></ul>
        </div>
</ul> 

<script>
$(document).ready(function () {
	
	
	
   $(".activepage").on("click", function() {
      $("activepage").removeClass("active");
      $(this).addClass("active");
    });
.sidebar-link.active, .sidebar-link:focus {
    background: #e2e8ed;
    color:grey !important;
    text-decoration: none;
  }	
	
});
</script>
