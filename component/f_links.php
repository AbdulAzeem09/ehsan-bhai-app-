<?php
include '../component/custom.css.php';
?>

<meta charset="utf-8">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<?php
if (isset($_GET['page']) && $_GET['page'] == "company_info") {
?>
	<meta name="description" content="A social and business networking platform offering uncompromising user privacy and unlimited financial prosperity
">
	<meta name="author" content="The Team SharePage">

	<title>Best Real Estate Classified Advertising- Thesharepage.com
	</title>
<?php } else if (isset($_GET['page']) && $_GET['page'] == "site_map") {
?>
	<meta name="description" content="A social and business networking platform offering uncompromising user privacy and unlimited financial prosperity
">
	<meta name="author" content="The Team SharePage">

	<title>Find the Professional Jobs Classified Services- Thesharepage.com
	</title>

<?php } else if (isset($_GET['page']) && $_GET['page'] == "howtos") {
?>
	<meta name="description" content="A social and business networking platform offering uncompromising user privacy and unlimited financial prosperity
">
	<meta name="author" content="The Team SharePage">

	<title>Socialize And Earn- Powerful Directory Website & Social Business Services.
	</title>

<?php } else {
?>
	<meta name="description" content="A social and business networking platform offering uncompromising user privacy and unlimited financial prosperity
">
	<meta name="author" content="The Team SharePage">

	<title>The SharePage - Your Social and E-Commerce platform.
	</title>
<?php } ?>
<link rel="icon" href="<?php echo $BaseUrl . '/assets/images/logo/tsp_trans.png' ?>" sizes="16x16" type="image/png">

<!--Bootstrap core css-->
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">   -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/bootstrap.css">



<!-- Custom Style Sheet-->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/custom.css">
<!-- <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/responsive.css" > -->
<!-- TABLE CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/table.css">
<!-- END -->

<!--Font awesome core css-->
<link href="<?php echo $BaseUrl; ?>/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- for unminified version proxima fonts -->
<!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/proxima/fonts.css" />
<!-- for minified version add this -->
<!-- <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/proxima/fonts.min.css" /> -->
<!--This script is issue for tool-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!--Important Javascript-->

<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/jquery-ui.min.css">
<!-- EMOJI EMOTION SMILE -->
<link href="<?php echo $BaseUrl; ?>/assets/lib_emoji/css/emoji.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

<!--this is links for scroller Start-->
<link href="<?php echo $BaseUrl; ?>/assets/css/scroller/OverlayScrollbars.css" rel="stylesheet" type="text/css">
<link href="<?php echo $BaseUrl; ?>/assets/css/scroller/os-theme-round-dark.css" rel="stylesheet" type="text/css">
<!--this is links for scroller Start-->

<!-- chat box -->
<link type="text/css" rel="stylesheet" media="all" href="<?php echo $BaseUrl; ?>/assets/chat/chat.css" />

<!-- DATE AND TIME PICKER -->
<!-- <link href="<?php echo $BaseUrl; ?>/assets/css/date-time/bootstrap-datetimepicker.css" rel="stylesheet" media="screen"> -->
<link href="<?php echo $BaseUrl; ?>/assets/css/date-time/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

<!-- another custome css (By Nitin) -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/style.css">
<!-- css for font animation effect (By Nitin) -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/font_animate.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.css" />
<!--Javascript-->

<?php
$aa = rand();

?>

<!-- chart api see in future -->
<!-- <link rel="stylesheet" href="http://api.highcharts.com/highcharts"> -->
