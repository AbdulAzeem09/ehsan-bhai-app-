<?php
session_start();
if (isset($_SESSION['deactivateStatus']) && $_SESSION['deactivateStatus'] == 1) {
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      window.onload = function() {
        Swal.fire({
          title: 'Your account is deactivated!',
          text: 'Go to settings to enable it.',
          icon: 'warning',
          showCancelButton: false,
          confirmButtonText: 'Go to Settings',
          allowOutsideClick: false, // Don't allow closing by clicking outside
          allowEscapeKey: false // Don't allow closing with Escape key
        }).then((result) => {
          if (result.isConfirmed) {
            // Navigate to dashboard/settings
            window.location.href = '/SHAREPAGE_CODES/dashboard/settings';
          }
        });
      };
    </script>
    <?php
}
?>

<?php
require_once("../../univ/baseurl.php");
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "dashboard/";
include_once("../../authentication/islogin.php");
} else {
function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

$pageactive = 3;

$re = new _redirect;

// if (!isset($_SESSION['pin']) && $_SESSION['pin'] != 1) {
//     $redirctUrl = $BaseUrl . "/dashboard/sticky/pin.php/";
//     $re->redirect($redirctUrl);
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php include('../../component/f_links.php'); ?>
<!-- ===========DSHBOARD LINKS================= -->
<?php include('../../component/dashboard-link.php'); ?>
<!-- ===========PAGE SCRIPT==================== -->



<style>
/*.stickyNotest li {
margin: 1em;
margin-bottom: 2em;
float: left;
width: 30%;
}

.stickyNotest li a {
-webkit-transform: none;

}

.stickyNotest li:nth-child(even) a {
-o-transform: rotate(4deg);
-webkit-transform: none;
-moz-transform: rotate(4deg);
position: relative;
top: 5px;
background: #cfc;
}
.stickyNotest li:nth-child(odd) a {
-o-transform: rotate(4deg);
-webkit-transform: none;
-moz-transform: rotate(4deg);
position: relative;
top: 5px;
background: #ccf;
}

.stickyNotest li:nth-child(3n) a {
-o-transform: rotate(4deg);
-webkit-transform: none;
-moz-transform: rotate(4deg);
position: relative;
top: 5px;
background: #ccf;
}

} */


.stickyNotest li a {
/*text-decoration:none;
color:#000;
background:#ffc;
display:block;
height:10em;
width:10em;
padding:1em;
box-shadow: 5px 5px 7px rgba(33,33,33,.7);
transform: rotate(-6deg);
transition: transform .15s linear;*/
-webkit-transform: none;
}

.stickyNotest li:nth-child(even) a {
-o-transform: rotate(4deg);
-webkit-transform: none;
-moz-transform: rotate(4deg);
position: relative;
top: 5px;
background: #cfc;
}

.stickyNotest li:nth-child(3n) a {
-o-transform: rotate(4deg);
-webkit-transform: none;
-moz-transform: rotate(4deg);
position: relative;
top: 5px;
background: #ccf;
}

.stickyNotest li:nth-child(5n) a {
transform: rotate(0deg);
position: relative;
top: 5px;
}

.stickyNotest li a:hover,
.stickyNotest li a:focus {
box-shadow: 10px 10px 7px rgba(0, 0, 0, .7);
transform: scale(1.25);
position: relative;
z-index: 5;
}

.stickyNotest li {
margin: 1em;
margin-bottom: 2em;
float: left;
width: 30%;
}
</style>
</head>

<body class="bg_gray" onload="pageOnload('details')">
<?php

include_once("../../header.php");
?>

<section class="">
<div class="container-fluid no-padding">
<div class="row">
<!-- left side bar -->
<div class="col-md-2 no_pad_right">
<?php
include('../../component/left-dashboard.php');
?>
</div>
<!-- main content -->
<div class="col-md-10 no_pad_left">
<div class="rightContent">

<!-- breadcrumb -->
<section class="content-header">
<h1>Sticky Notes</h1>
<ol class="breadcrumb">
<li><a href="<?php echo $BaseUrl . '/dashboard'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Sticky Notes</li>
</ol>
</section>

<div class="content">
<div class="row">
<div class="col-md-12">
<div class="">
<?php if ($_SESSION['guet_yes'] != 'yes') { ?>

<div class="text-right">
<a href="<?php echo $BaseUrl . '/dashboard/sticky/listing.php'; ?>" class="btn butn btn-border-radius"><i class="fa fa-eye"></i> View Listing</a>
<a href="<?php echo $BaseUrl . '/dashboard/sticky/add.php'; ?>" class="btn butn btn-border-radius"><i class="fa fa-plus"></i> Add New Sticky Note</a>
</div><!-- /.box-header -->
<?php } ?>
</div><!-- /.box -->



</div>
</div>
<div class="row">
<div class="col-md-12">
<ul class="stickyNotest">
<?php
$p = new _spAllStoreForm;
$type = 0;
$result = $p->readSticky($_SESSION['pid'], $type);
//var_dump($result);
if ($result) {
while ($row = mysqli_fetch_assoc($result)) {
?>
<li>
<a class="outter" href="<?php echo $BaseUrl ?>/dashboard/sticky/detail.php?id=<?php echo $row['idspSticky']; ?>">
<h2 style="white-space: nowrap; width: 180px; overflow: hidden; text-overflow: ellipsis;"><?php echo ucwords(strtolower($row['spStickyTitle'])); ?></h2>
<span style="word-wrap: break-word;"><?php if (strlen($row['spStickyDes']) > 0) {
echo substr($row['spStickyDes'], 0, 20) . '.....';
} ?></span>
</a>
</li>
<?php
}
}  ?>

</ul>
</div>
</div>
</div>
</div>
</div>
</div>





</div>
</section>

<?php include('../../component/f_footer.php'); ?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../../component/f_btm_script.php'); ?>

</body>

</html>
<?php
} ?>