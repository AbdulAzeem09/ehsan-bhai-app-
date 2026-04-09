<?php
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "business-directory/";
include_once("../authentication/check.php");
} else {
function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$header_directy = "header_directy";
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<style>
.foot {
background-color: #8c5d25 !important;

}

#profileDropDown li.active {
background-color: #8c5d25 !important;
}

#profileDropDown li.active a {
color: #fff !important;
}
</style>

<style>
.explore_data {
display: block;
/*width:50%;
margin:10px auto;
background:#fff;
line-height:50px;
border-radius:30px;*/
display: none;
}

a#seeMore {
display: block;
color: #fff;
margin: 0 auto;
line-height: 50px;
width: 30%;
border-radius: 30px;
text-decoration: none;
border: 3px #ee5f4a solid;
background: #ee5f4a;
opacity: 0.7;
margin-bottom: 50px;
text-align: center;
}

a#seeMore:hover {
opacity: 1;
}
</style>



<?php include('../component/f_links.php'); ?>
<?php include '../component/custom.css.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body class="bg_gray">
<?php
include_once("../header.php");
?>
<div class="loadbox">
<div class="loader"></div>
</div>
<section class="main_box no-padding" id="service-page" style="background-image: url('business-website-directory.webp');"">

<div class=" container">
<div class="row">
<div class="col-md-12">
<div class="text-center">
<h2 style="margin-top:10px; color:#8c5d25;">Business Directory</h2>
<!-- <p>Discover and share a constantly expanding mix of music and videos from emerging and major artists around the world.</p> -->
<div class="mainBusinessSearch">
<ul class="nav nav-pills" id="bus_ser_tab">
<li class="active"><a data-toggle="pill" href="#home">Search a Business</a></li>
<li><a data-toggle="pill" href="#menu1">Search a Profile</a></li>
</ul>
<div class="tab-content">
<div id="home" class="tab-pane fade in active">
<div class="in_ser_serch">
<form class="" action="search.php?business" method="post">
<input type="hidden" name="txtForm" value="1">
<div class="form-group no-margin">
<div class="row">
<div class="col-md-6">
<input type="text" class="form-control" name="txtSearchBox" placeholder="Type a Business name here" required>
</div>

<div class="col-md-6" style="margin-top: 23px;">
<select class="form-control form-select" id="inputGroupSelect" placeholder="Type a Business name here" name="category">
<option value="">Select by Category</option>
<?php


$m = new _subcategory;
$catid = 1;
$results = $m->read($catid);

if ($results) {

while ($rows = mysqli_fetch_assoc($results)) {


?>
<option value="<?php echo ucwords(strtolower($rows['subCategoryTitle'])); ?>"><?php echo ucwords(strtolower($rows["subCategoryTitle"])); ?></option>

<?php
}
}
?>

</select>


</div>
</div>
</div>
<button type="submit" name="btnSearch" class="btn btn-default btn-border-radius">Search</button>
</form>
</div>
</div>
<div id="menu1" class="tab-pane fade">
<div class="in_ser_serch">
<form class="" action="search.php" method="post">
<input type="hidden" name="txtForm" value="2">
<div class="form-group no-margin">
<input type="text" class="form-control" name="txtSearchBox" placeholder="Search By Profile" required>
</div>
<button type="submit" name="btnSearch" class="btn btn-default btn-border-radius">Search</button>
</form>
</div>
</div>

</div>
</div>
<?php if ($_SESSION['guet_yes'] != 'yes') { ?>

<!-- <a href="<?php if ($_SESSION['ptname'] == 'Bussiness') {
echo $BaseUrl . '/business-directory/business.php';
} else {
echo $BaseUrl . '/timeline/';
} ?>" class="btn btn_bus_dircty" style="background-color: #e39b0f;">List your business / update</a>-->
<a href="<?php echo $BaseUrl . '/business-directory/dashboard.php'; ?>" class="btn btn_bus_dircty" style="background-color: #e39b0f;">Dashboard</a> <?php } ?>
</div>
</div>
</div>
</div>
</section>

<section class="bg_white">
<div class="container">

<div class="row">
<div class="col-md-12">
<div class="heading-home text-center">
<h2>Explore</h2>
</div>
</div>
</div>
<div class="row m_btm_40 explore_link">
<div class="col-md-5ths explore_data">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=accounting'; ?>" value="ACCOUNTING">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>Accounting</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=advertising_and_marketing '; ?>" value="ADVERTISING AND MARKETING ">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>ADVERTISING AND MARKETING </h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=apparel '; ?>" value="APPAREL">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>APPAREL</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=automotive_services '; ?>" value="AUTOMOTIVE SERVICES">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>AUTOMOTIVE SERVICES</h3>

</div>
</a>
</div>



<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=automotive'; ?>">
<div class="home_explore box_1 text-center border_right">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/cars.png" class="img-responsive" alt="" />
<h3>Automotive</h3>

</div>
</a>
</div>
<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=business_professional'; ?>">
<div class="home_explore box_2 text-center">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/business.png" class="img-responsive" alt="" />
<h3>Business & Professional</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=beauty_services '; ?>" value="BEAUTY SERVICES">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>BEAUTY SERVICES</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=Computer_services'; ?>">
<div class="home_explore box_3 text-center">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/computer.png" class="img-responsive" alt="" />
<h3>Computer Services</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=consulting'; ?>" value="CONSULTING">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>CONSULTING</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=creative_services'; ?>" value="CREATIVE SERVICES">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>CREATIVE SERVICES</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=direct_marketing'; ?>" value="DIRECT MARKETING">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>DIRECT MARKETING</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=events_entertainment'; ?>">
<div class="home_explore box_4 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/events.png" class="img-responsive" alt="" />
<h3>Events & Entertainment</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=electronics'; ?>" value="ELECTRONICS">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>ELECTRONICS</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=energy_and_natural_resources'; ?>" value="ENERGY AND NATURAL RESOURCES">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>ENERGY AND NATURAL RESOURCES</h3>

</div>
</a>
</div>


<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=entertainment'; ?>" value="ENTERTAINMENT">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>ENTERTAINMENT</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=event_management'; ?>" value="EVENT MANAGEMENT">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>EVENT MANAGEMENT</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=family_community'; ?>">
<div class="home_explore box_5 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/family.png" class="img-responsive" alt="" />
<h3>Family & Community</h3>

</div>
</a>
</div>
<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=food_restaurants'; ?>">
<div class="home_explore box_6 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/food.png" class="img-responsive" alt="" />
<h3>Food & Restaurants</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=facilities_management '; ?>" value="FACILITIES MANAGEMENT">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>FACILITIES MANAGEMENT</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=farm_garden_services'; ?>" value="FARM & GARDEN SERVICES">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>FARM & GARDEN SERVICES</h3>

</div>
</a>
</div>


<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=financial_services'; ?>" value="FINANCIAL SERVICES">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>FINANCIAL SERVICES</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=grocery'; ?>">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>Grocery</h3>

</div>
</a>
</div>


<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=gourmet'; ?>" value="GOURMET">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>GOURMET</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=government'; ?>" value="GOVERNMENT">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>GOVERNMENT</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=health_Medical'; ?>">
<div class="home_explore box_7 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/health.png" class="img-responsive" alt="" />
<h3>Health & Medical</h3>

</div>
</a>
</div>
<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=home_construction'; ?>">
<div class="home_explore box_8 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/construction.png" class="img-responsive" alt="" />
<h3>Home & Construction</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=health_and_personal_care'; ?>" value="HEALTH AND PERSONAL CARE">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>HEALTH AND PERSONAL CARE</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=Home_construction'; ?>" value="HOME & CONSTRUCTION">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>HOME & CONSTRUCTION</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=home_and_garden'; ?>" value="HOME AND GARDEN">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>HOME AND GARDEN</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=household_services'; ?>" value="HOUSEHOLD SERVICES">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>HOUSEHOLD SERVICES</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=it_training'; ?>">
<div class="home_explore box_14 text-center border_bottom border_right">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/IT_trainings.png" class="img-responsive" alt="" />
<h3>It Training</h3>

</div>
</a>
</div>






<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=information_management'; ?>" value="INFORMATION MANAGEMENT">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>INFORMATION MANAGEMENT</h3>

</div>
</a>
</div>


<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=international_trade'; ?>" value="INTERNATIONAL TRADE">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>INTERNATIONAL TRADE</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=legal_financial'; ?>">
<div class="home_explore box_9 text-center  border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/legal.png" class="img-responsive" alt="" />
<h3>Legal & Financial</h3>

</div>
</a>
</div>
<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=local_shopping'; ?>">
<div class="home_explore box_10 text-center border_bottom border_right">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/shopping.png" class="img-responsive" alt="" />
<h3>Local Shopping</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=Labor_moving'; ?>" value="LABOR & MOVING">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>LABOR & MOVING</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=legal_services'; ?>" value="LEGAL SERVICES">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>LEGAL SERVICES</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=lessons_tutoring'; ?>" value="LESSONS & TUTORING">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>LESSONS & TUTORING</h3>

</div>
</a>
</div>


<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=marine_services'; ?>" value="MARINE SERVICES">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>MARINE SERVICES</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=mining'; ?>" value="MINING">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>MINING</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=online_addvertising'; ?>">
<div class="home_explore box_13 text-center border_bottom border_right">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/ads.png" class="img-responsive" alt="" />
<h3>Online Advertising</h3>

</div>
</a>
</div>





<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=office_supplies_and_equipment'; ?>" value="OFFICE SUPPLIES AND EQUIPMENT">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>OFFICE SUPPLIES AND EQUIPMENT</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=pet_supplies_services'; ?>" value="PET SUPPLIES & SERVICES">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>PET SUPPLIES & SERVICES</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=public_relations'; ?>" value="PUBLIC RELATIONS">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>PUBLIC RELATIONS</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=real_estate_services'; ?>" value="REAL ESTATE SERVICES">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>REAL ESTATE SERVICES</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=recruitment_agencies'; ?>" value="RECRUITMENT AGENCIES">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>RECRUITMENT AGENCIES</h3>

</div>
</a>
</div>


<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=retail_grocery'; ?>" value="RETAIL-GROCERY">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>RETAIL-GROCERY</h3>

</div>
</a>
</div>


<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=skilled_trade_services'; ?>" value="SKILLED TRADE SERVICES">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>SKILLED TRADE SERVICES</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=sports'; ?>" value="SPORTS">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>SPORTS</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=sports_Recreation'; ?>">
<div class="home_explore box_11 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/sports.png" class="img-responsive" alt="" />
<h3>Sports & Recreation</h3>

</div>
</a>
</div>
<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=travel_transportation'; ?>">
<div class="home_explore box_12 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/flights.png" class="img-responsive" alt="" />
<h3>Travel & Transportation</h3>

</div>
</a>
</div>



<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=tax_services'; ?>" value="TAX  SERVICES">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>TAX SERVICES</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=telecommunication'; ?>" value="TELECOMMUNICATION">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>TELECOMMUNICATION</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=therapeutic_services'; ?>" value="THERAPEUTIC SERVICES">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>THERAPEUTIC SERVICES</h3>

</div>
</a>
</div>


<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=toys_and_games'; ?>" value="TOYS AND GAMES">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>TOYS AND GAMES</h3>

</div>
</a>
</div>


<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=training'; ?>" value="TRAINING">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>TRAINING</h3>

</div>
</a>
</div>


<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=transportation'; ?>" value="TRANSPORTATION">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>TRANSPORTATION</h3>

</div>
</a>
</div>

<div class="col-md-5ths explore_data explore_link">
<a href="<?php echo $BaseUrl . '/business-directory/business.php?business[]=travel _vacation_services'; ?>" value="TRAVEL & VACATION SERVICES">
<div class="home_explore box_15 text-center border_right border_bottom">
<img src="<?php echo $BaseUrl; ?>/assets/images/directory/grocery.png" class="img-responsive" alt="" />
<h3>TRAVEL & VACATION SERVICES</h3>

</div>
</a>
</div>


</div>

<a href="#" id="seeMore">Show More</a>
<!--    <div class="row">
<div class="col-md-12 text-center">
<a href="javascript:void(0)" class="btn butn_bus_serch">Show All Category</a>
</div>
</div> -->

</div>
</section>

<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>
</body>

</html>
<?php
}
?>


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script type="text/javascript">
$('#inputGroupSelect').select2({
selectOnClose: true
});
</script>
<!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script-->
<script type="text/javascript">
$(document).ready(function() {
$(".explore_data").slice(0, 15).show();
$("#seeMore").click(function(e) {
e.preventDefault();
$(".explore_data:hidden").slice(0, 15).fadeIn("slow");

if ($(".explore_data:hidden").length == 0) {
$("#seeMore").fadeOut("slow");
}
});
})
</script>