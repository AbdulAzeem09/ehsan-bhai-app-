<meta charset="utf-8">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="The SharePage">


<title>The SharePage</title>
<link rel="icon" href="<?php echo $BaseUrl . '/assets/images/logo/tsp_trans.png' ?>" sizes="16x16" type="image/png">

<!--BOOTSTRAP CORE CSS-->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/custom.css">
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/responsive.css">


<!--FONT AWESOME CORE CSS-->
<link href="<?php echo $BaseUrl; ?>/assets/css/font-awesome.css" rel="stylesheet" type="text/css" />

<!-- for unminified version proxima fonts -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/proxima/fonts.css" />
<!-- for minified version add this -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/proxima/fonts.min.css" />

<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/jquery-ui.min.css">
<!-- EMOJI EMOTION SMILE -->
<link href="<?php echo $BaseUrl; ?>/assets/lib_emoji/css/emoji.css" rel="stylesheet">
<!--this is links for scroller Start-->
<link href="<?php echo $BaseUrl; ?>/assets/css/scroller/OverlayScrollbars.css" rel="stylesheet" type="text/css">
<link href="<?php echo $BaseUrl; ?>/assets/css/scroller/os-theme-round-dark.css" rel="stylesheet" type="text/css">
<!--this is links for scroller Start-->
<!-- chat box -->
<link type="text/css" rel="stylesheet" media="all" href="<?php echo $BaseUrl; ?>/assets/chat/chat.css" />

<!-- FAST DROPDOWN -->
<link rel="stylesheet" href="<?php echo $BaseUrl . '/assets/css/fstdropdown.css'; ?>">
<!-- END -->

<!-- custom css style sheet -->
<?php
//echo $BaseUrl.'/assets/css/custom.css.php';
$urlCustomCss = $_SERVER['DOCUMENT_ROOT'] . '/sharepagego/Sharepage/component/custom.css.php';
include $urlCustomCss;
?>

<!-- another custome css (By Nitin) -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/style.css">
<!-- css for font animation effect (By Nitin) -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/font_animate.css">
<!-- this is page script is using only dashboards -->
<!-- <link rel="stylesheet" href="https://api.highcharts.com/highcharts"> -->

<!-- DATE AND TIME PICKER -->
<link href="<?php echo $BaseUrl; ?>/assets/css/date-time/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">



<!--Javascript-->
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-3.2.1.slim.min.js"></script>
<!-- zoom effect -->
<!--This script for posting timeline data Start-->
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
<!--This script for posting timeline data End-->
<script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/register_script.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery.validate.min.js"></script>