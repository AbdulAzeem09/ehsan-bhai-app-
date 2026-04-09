			<?php
			require_once("../univ/baseurl.php" );
			session_start();
			if(!isset($_SESSION['pid'])){ 
			$_SESSION['afterlogin']="dashboard/";
			include_once ("../authentication/islogin.php");

			}else{
			function sp_autoloader($class) {
			include '../mlayer/' . $class . '.class.php';
			}

			spl_autoload_register("sp_autoloader");

			$pageactive = 56;
			?>
			<!DOCTYPE html>
			<html lang="en">
			<head>
			<?php include('../component/f_links.php');?>
			<!--This script for posting timeline data End-->
			<!-- ===========DSHBOARD LINKS================= -->
			<?php include('../component/dashboard-link.php');?>
			<!-- ===========PAGE SCRIPT==================== -->
			<script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-checkbox.js" defer></script>
			<style>
			.tagLine-max-char {

			font-size: smaller;
			font-weight: 600;

			}
			.dataTables_filter			{
			margin-bottom: 5px;
			}			
			</style>
			</head>
			<body class="bg_gray" onload="pageOnload('details')">
			<?php

			include_once("../header.php");
			?>

			<section class="">
			<div class="container-fluid no-padding">
			<div class="row">
			<!-- left side bar -->
			<div class="col-md-2 no_pad_right">
			<?php
			;
			include('../component/left-dashboard.php');
			?>
			</div>
			<!-- main content -->
			<div class="col-md-10 no_pad_left">
			<div class="rightContent">

			<style>
			.smalldot{
			width : 100px;
			overflow:hidden;
			display:inline-block;
			text-overflow: ellipsis;
			white-space: nowrap;
			}
			section.content-header {
			margin-bottom: 10px;
			margin-top: -25px;
			}
			</style>
			<div class="content">
					<?php
		if($_GET['deleted']==1){
		?>
		<div class="alert alert-danger alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Success! </strong> Event Deleted Successfully.
		</div>
		<?php
		}
		?>
			<div class="row">
			<div class="col-md-12">
			<section class="content-header">
			<h1>Upcoming events</h1>
			<ol class="breadcrumb">
			<li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Membership Transaction</li>
			</ol>
			</section>
			<div class="box box-success">
			<div class="box-header">
			</div><!-- /.box-header -->
			<div class="box-body">
			<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
			<div class="row">
			<div class="col-md-12">
			<div class="col-md-1"></div>
			<div class="col-md-10">
<?php
require __DIR__ . '/calender/vendor/autoload.php';


function getClient()
{
	
    $client = new Google_Client();
    $client->setApplicationName('Google Calendar API PHP Quickstart');
    $client->setScopes(Google_Service_Calendar::CALENDAR);
    $client->setAuthConfig('credentials.json');
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');

    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    $tokenPath = 'token.json';
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
		
    }

    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);

            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }
        }
        // Save the token to a file.
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    return $client;
}
	// Get the API client and construct the service object.
	$client = getClient();
	$service = new Google_Service_Calendar($client);

	// Print the next 10 events on the user's calendar.
	$calendarId = 'primary';
	$optParams = array(
	//'maxResults' => 10,
	'orderBy' => 'startTime',
	'singleEvents' => true,
	'timeMin' =>   date('c'),
	);
	$results = $service->events->listEvents($calendarId, $optParams);
	$events = $results->getItems();

	if (empty($events)) {
	print "No upcoming events found.\n";
	} else {
	print "<h1>Upcoming events:\n</h1>";
	foreach ($events as $event) {
	$start = $event->start->dateTime;
	if (empty($start)) {
	$start = $event->start->date;
	}
	 $event_id = $event->id;
	print "<h4>";
	printf("%s (%s)", $event->getSummary(), $start);
	print "<span><a href='delete_event.php?event_id=".$event_id."' class='btn btn-danger' style='float:right;'>delete</a></span></h4><br>";
	}
	}

?>



                                
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





			</div>
			</section>


			<?php include('../component/f_footer.php');?>
			<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
			<?php include('../component/f_btm_script.php'); ?>

			<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
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
			});//End of create main table


			$('#example tbody').on( 'click', 'tr', function () {

			// alert(table.row( this ).data()[0]);

			} );
			});
			</script>








			<script>
			$(function() {
			$(':checkbox').checkboxpicker();
			});
			</script>

			<script type="text/javascript">
			$(document).ready(function() {
			$("body").on("click",".add-more",function(){ 
			var html = $(".after-add-more").first().clone();

			//  $(html).find(".change").prepend("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");

			$(html).find(".change").html("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");


			$(".after-add-more").last().after(html);



			});

			$("body").on("click",".remove",function(){ 
			$(this).parents(".after-add-more").remove();
			});
			});

			</script>
			<script type="text/javascript">
			$(document).ready(function(){
			$(document).on("click",".disable-btn",function() {
			var dataId = $(this).attr("data-id");

			var work = $(this).attr("data-work");
			//alert(work);
			if(work=='deactive'){
			swal({
			title: "Do You Want Deactive this Listing?",
			/*text: "You Want to Logout!",*/
			type: "warning",
			confirmButtonClass: "sweet_ok",
			confirmButtonText: "Yes, Deactive!",
			cancelButtonClass: "sweet_cancel",
			cancelButtonText: "Cancel",
			showCancelButton: true,
			},
			function(isConfirm) {
			if (isConfirm) {
			window.location.href = '/dashboard/portfolio/delete_port.php?id=' +dataId+'&work='+work;
			} 
			});

			}	
			if(work=='delete'){
			swal({
			title: "Do You Want Delete this Listing?",
			/*text: "You Want to Logout!",*/
			type: "warning",
			confirmButtonClass: "sweet_ok",
			confirmButtonText: "Yes, Delete!",
			cancelButtonClass: "sweet_cancel",
			cancelButtonText: "Cancel",
			showCancelButton: true,
			},
			function(isConfirm) {
			if (isConfirm) {
			window.location.href = '/dashboard/portfolio/delete_port.php?id=' +dataId+'&work='+work;
			} 
			});
			}	

			// alert(dataId);
			});
			});

			// function deactiveProp(propId){ 
			//     swal({
			//           title: "Do You Want Delete this User?",
			//           /*text: "You Want to Logout!",*/
			//           type: "warning",
			//           confirmButtonClass: "sweet_ok",
			//           confirmButtonText: "Yes, Delete!",
			//           cancelButtonClass: "sweet_cancel",
			//           cancelButtonText: "Cancel",
			//           showCancelButton: true,
			//         },
			//     function(isConfirm) {
			//       if (isConfirm) {
			//        window.location.href = <?php //echo $BaseUrl.'/real-estate/dashboard/deactivate_post.php?postid='?> + propId;
			//       } 
			//     });
			// }
			</script>





			<form enctype="multipart/form-data" action="deactivate_port.php" method ="post" >		
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
			<h2 class="modal-title" id="UpdatePort">Update Portfolio</h2>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>
			<div class="modal-body">
			<div class="after-add-more">
			<div class="row">
			<div class="col-md-12">                                
			<div class="form-group">
			<label class="control-label">Title:</label>
			<input maxlength="200" type="text" class="form-control" placeholder="Enter Title" name="spPortname" id="spPortname" />
			<input type="hidden" name="portfolio_id" id="portfolio_id" value="">
			</div>
			</div>
			</div>
			<div class="row">
			<div class="col-md-12">                                
			<div class="form-group">
			<label class="control-label">Weblink:</label>
			<input maxlength="200" type="text" class="form-control" placeholder="Enter Weblink" name="spWeblink"  id="spWeblink"/>
			</div>
			</div>
			</div>
			<div class="row">
			<div class="col-md-12" id="yourAddresRemove" >
			<div class="form-group">
			<label for="spProfileAbout" class="control-label">Portfolio Item Description:</label>
			<textarea class="form-control" rows="3" name="spPortdes" id="spPortdesf" ></textarea>
			</div>	
			</div>
			</div>

			<div class="row">
			<div class="col-md-12">
			<div class="form-group">
			<label class="control-label">Upload File:</label>
			<input type="file" class="form-control" name="spPortimg" id="spPortimg"  accept=" image/* " style="display:block;" >
			</div>
			</div></div>


			<br>
			</div>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: orange; color:white;">Close</button>
			<input type="submit" class="btn btn-submit  addprofile db_btn db_primarybtn " name="submit" value="Update">
			<!--<button type="button" class="btn btn-primary">Save changes</button>-->
			</div>
			</div>
			</div>
			</div>
			</form>	



			</body> 
			</html>
			<?php
			} ?>



			<script>
			$( document ).ready(function() {
			$(".update-portfolio").on("click", function (event) {

			var id = $(this).attr('data-id');
			var title = $(this).attr('data-title');
			var des = $(this).attr('data-des');
			var weblink = $(this).attr('data-weblink');

			$("#spPortname").val(title);
			$("#spPortdesf").val(des);
			$("#portfolio_id").val(id);
			$("#spWeblink").val(weblink);



			});

			});



			</script>