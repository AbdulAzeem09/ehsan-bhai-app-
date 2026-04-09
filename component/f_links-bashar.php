<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 'On'); */
include '../component/custom.css.php';?>
<meta charset="utf-8">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<?php 	
if($_GET['page']=="company_info"){
	?>
	<meta name="description" content="A social and business networking platform offering uncompromising user privacy and unlimited financial prosperity
	">
	<meta name="author" content="The Team SharePage">
	<title>Best Real Estate Classified Advertising- Thesharepage.com
	</title>
<?php }

else if($_GET['page']=="site_map"){
	?>
	<meta name="description" content="A social and business networking platform offering uncompromising user privacy and unlimited financial prosperity
	">
	<meta name="author" content="The Team SharePage">
	<title>Find the Professional Jobs Classified Services- Thesharepage.com
	</title>
<?php } 
else if($_GET['page']=="howtos"){
	?>
	<meta name="description" content="A social and business networking platform offering uncompromising user privacy and unlimited financial prosperity
	">
	<meta name="author" content="The Team SharePage">
	<title>Socialize And Earn- Powerful Directory Website & Social Business Services.
	</title>
<?php } 
else{
	?>
	<meta name="description" content="A social and business networking platform offering uncompromising user privacy and unlimited financial prosperity
	">
	<meta name="author" content="The Team SharePage">
	<title>Get the best site for all type Job.- Thesharepage.com
	</title>
<?php } ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
<!-- Bootstrap 5 compiled and minified CSS -->
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> -->
<link rel="icon" href="<?php echo $BaseUrl;?>/assets/images/logo/tsp_trans.png" sizes="16x16" type="image/png">

<!-- Custom Style Sheet-->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/custom.css" >
<!-- <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/responsive.css" > -->

<!--Font awesome core css-->
<!-- <link href="<?php echo $BaseUrl;?>/assets/css/font-awesome.css" rel="stylesheet" type="text/css" /> -->
<link href="<?php echo $BaseUrl;?>/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- for unminified version proxima fonts -->
<!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> -->
<!-- <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/proxima/fonts.css" /> -->
<!-- for minified version add this -->
<!-- <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/proxima/fonts.min.css" /> -->
<!-- <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/jquery-ui.min.css">  -->
<!-- EMOJI EMOTION SMILE -->
<link href="<?php echo $BaseUrl;?>/assets/lib_emoji/css/emoji.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
<!--this is links for scroller Start-->
<link href="<?php echo $BaseUrl;?>/assets/css/scroller/OverlayScrollbars.css" rel="stylesheet" type="text/css">
<link href="<?php echo $BaseUrl;?>/assets/css/scroller/os-theme-round-dark.css" rel="stylesheet" type="text/css">
<!--this is links for scroller Start-->
<!-- chat box -->
<link type="text/css" rel="stylesheet" media="all" href="<?php echo $BaseUrl;?>/assets/chat/chat.css" />
<!-- DATE AND TIME PICKER -->
<link href="<?php echo $BaseUrl;?>/assets/css/date-time/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<!-- css for font animation effect (By Nitin) -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/font_animate.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.css"/>
<!-- SWEET ALERT MSG -->
<link href="<?php echo $BaseUrl;?>/assets/css/sweetalert.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="<?php echo $BaseUrl;?>/assets/css/magnific-popup/magnific-popup.css">
<!-- END -->
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
<!-- SWEET ALERT MSG -->
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
<!-- custom css style sheet -->
<?php 
	//echo $BaseUrl.'/assets/css/custom.css.php';
$urlCustomCss = $_SERVER['DOCUMENT_ROOT'].'/sharepagego/Sharepage/component/custom.css.php';
include $urlCustomCss;
?>

<?php 
$aa=rand();
?>

<script type="text/javascript">
	
	$('.thumbnail').magnificPopup({
		type: 'image'
  // other options
	});
</script>
