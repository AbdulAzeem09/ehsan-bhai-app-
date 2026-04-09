<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
// echo $_SESSION['userlevel']; die('===========');
$actual_link = $_SERVER['REQUEST_URI'];
$parts = explode('/',$actual_link);
$actual_link = $parts[2];
$activeLink = chekActiveModule($actual_link);

$activeTab = $activeLink;
// acctiv sub link


?>

<style>
.scroll {
height: 700px !important; 
overflow-x: hidden; 
overflow-y: auto; 
text-align:justify;
}
</style>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar scroll" >
<!-- Sidebar user panel -->
<div class="user-panel">
<div class="pull-left image">
<?php
if(isset($_SESSION['userImg']) && $_SESSION['userImg'] != ''){ ?>
<img src="<?php echo WEB_ROOT;?>/upload/user/<?php echo $_SESSION['userImg'];?>" class="img-circle" style="width: 45px;height: 45px;" alt="User Image" /><?php
}else{ ?>
<img src="<?php echo WEB_ROOT_TEMPLATE;?>/assets/admin/img/no_image.webp" class="img-circle" alt="User Image"  /> <?php
}
?>

</div>
<div class="pull-left info">
<p><?php echo $_SESSION['accountName'];?></p>
<a href="#"><i class="fa fa-phone text-success"></i> <?php echo $_SESSION['phoneNo'];?></a>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("li").hide();
    $("li").filter(function() {
      var mainMenu = $(this);
      var mainMenuText = mainMenu.find('> a').text().toLowerCase();
      var subMenuItems = mainMenu.find('.treeview-menu li');
      var subMenuText = subMenuItems.map(function() {
        return $(this).text().toLowerCase();
      }).get().join('|');
      if (mainMenuText.indexOf(value) > -1) {
        mainMenu.show();
        subMenuItems.show();
      } else if(subMenuText.indexOf(value) > -1){
        mainMenu.show();
        subMenuItems.filter(function() {
          return $(this).text().toLowerCase().indexOf(value) > -1;
        }).show();
      }
    });
  });
});

</script>
<input id="myInput" type="text" class="form-control input-sm" placeholder="Search.." aria-controls="example1" style="background: #504d4d; margin-left: 6px; width: 197px; color: wheat;">
<i class="fa fa-search" style="position: absolute;color:white; position: relative; left: 181px;top: -28px;" aria-hidden="true"></i>		

<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
<li class="header">MAIN NAVIGATION</li>


<li> <a href="javascript:void(0)"><i class="fa fa-cog"></i><span>Important Menu </span><i class="fa fa-angle-left pull-right"></i></a>
<ul class="treeview-menu">
<li><a href="<?php echo WEB_ROOT_ADMIN ."registerdUser/index.php?view=baccount" ?>"><i class="fa fa-cog"></i><span>Business Profile Verification</span></a>	
</li>
<li><a href="<?php echo WEB_ROOT_ADMIN ."registerdUser/index.php"?>"><i class="fa fa-cog"></i><span>User List</span></a>	
</li>
<li><a href="<?php echo WEB_ROOT_ADMIN ."membership_transaction/"?>"><i class="fa fa-cog"></i><span>Membership Transaction</span></a>	
</li>
<li><a href="<?php echo WEB_ROOT_ADMIN ."membership_assign/"?>"><i class="fa fa-cog"></i><span>Membership Assign</span></a>	
</li>
<li><a href="<?php echo WEB_ROOT_ADMIN ."membership_enquiry/"?>"><i class="fa fa-cog"></i><span>Membership Enquiry</span></a>	
</li>
<li><a href="<?php echo WEB_ROOT_ADMIN ."membership/index.php?view=add"?>"><i class="fa fa-cog"></i><span>Add Subscription Pack</span></a>	
</li>
<li><a href="<?php echo WEB_ROOT_ADMIN ."membership/"?>"><i class="fa fa-cog"></i><span>All Subscription Pack</span></a>
</li>
<li><a href="<?php echo WEB_ROOT_ADMIN ."withdraw/"?>"><i class="fa fa-cog"></i><span>Withdraw Request</span></a>
</li>
<li><a href="<?php echo WEB_ROOT_ADMIN ."spcoupons/"?>"><i class="fa fa-cog"></i><span>Coupons List</span></a>
</li>
</ul>
</li>


<?php  


if(check_permission($_SESSION['userlevel'],1,$dbConn)){ 

?>


<li> <a href="javascript:void(0)"><i class="fa fa-cog"></i><span>NewsLetter</span><i class="fa fa-angle-left pull-right"></i></a>
<ul class="treeview-menu">
<li class="treeview <?php echo ($activeTabnew == 700)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "news_letter" ?>"><i class="fa fa-cog"></i><span>Newsletter Templates</span></a>
</li>
<li class="treeview <?php echo ($activeTabnew == 700)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "news_letter/index.php?view=list_view_count" ?>"><i class="fa fa-cog"></i><span>Newsletter History</span></a>
</li>
<li class="treeview <?php echo ($activeTabnew == 700)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "news_letter/index.php?view=unsubscribe_list" ?>"><i class="fa fa-cog"></i><span>UnSubscribe List</span></a>
</li>

<li class="treeview <?php echo ($activeTabnew == 700)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "news_letter/index.php?view=aikeys" ?>"><i class="fa fa-cog"></i><span>AI Keys</span></a>
</li>

</ul>
</li>


<li class="treeview <?php echo ($activeTabnew == 83)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "content/report_tab.php " ?>"><i class="fa fa-cog"></i><span>Report </span></a>
</li>
<?php }  ?>
<?php if(check_permission($_SESSION['userlevel'],2,$dbConn)){ ?>
<li class="treeview <?php echo ($activeTab == 1)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN ?>"><i class="fa fa-tachometer"></i> <span>DashBoard</span></a>
</li>
<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],3,$dbConn)){ ?>
<!-- profile Settings -->
<li class="treeview <?php echo ($activeTab == 3)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "profileType" ?>"><i class="fa fa-cog"></i><span>Profile Type</span></a>
</li>
<?php } ?>


<!--new module -->

<?php if(check_permission($_SESSION['userlevel'],4,$dbConn)){ ?>
<li class="treeview <?php echo ($activeTab == 50)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "my_earnings" ?>"><i class="fa fa-cog"></i><span>Sharepage Earning</span></a>
</li>


<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],5,$dbConn)){ ?>
<li class="treeview <?php echo ($activeTab == 80)?'active':'';?>">
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/comm_withdraw/index.php"><i class="fa fa-cog"></i><span>Commision Request </span></a>
</li>

<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],6,$dbConn)){ ?>
<li class="treeview <?php echo ($activeTab == 80)?'active':'';?>">
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/sppoint_withdraw/index.php"><i class="fa fa-cog"></i><span>SpPoint Request </span></a>
</li>
<?php } ?>
<!--end new module -->
<li class="header">CATEGORIES</li>

<!-- <li>
<a href="<?php echo WEB_ROOT_ADMIN . "events/index.php?view=FeatureEventPrice" ?>"><i class="fa fa-cog"></i><span>Feature Event Price</span></a>
</li> -->

<li>
<a href="javascript:void(0)"><i class="fa fa-cog"></i><span>MODULES</span><i class="fa fa-angle-left pull-right"></i></a>
<ul class="treeview-menu">

<?php if(check_permission($_SESSION['userlevel'],95,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "artcategory" ?>"><i class="fa fa-cog"></i><span>Art Gallery [Category]</span><i class="fa fa-angle-left pull-right"></i></a>
<ul class="treeview-menu">


<li>
<a href="<?php echo WEB_ROOT_ADMIN . "artsubcategory" ?>"><i class="fa fa-cog"></i><span>Art Gallery [Subcategory]</span></a>
</li>
</ul>
</li>
<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],96,$dbConn)){ ?>
<li class="treeview <?php echo ($activeTab == 13)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "artsizes" ?>"><i class="fa fa-cog"></i><span>Art Gallery [Sizes]</span></a>
</li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],97,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "craftcategory" ?>"><i class="fa fa-cog"></i><span>Craft Gallery[Category]</span><i class="fa fa-angle-left pull-right"></i></a>
<ul class="treeview-menu">
<li> 
<a href="<?php echo WEB_ROOT_ADMIN . "craftsubcategory" ?>"><i class="fa fa-cog"></i><span>Craft Gallery [Subategory]</span></a>
</li>
</ul>
</li>
<?php } ?>



<?php if(check_permission($_SESSION['userlevel'],99,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "evencategory" ?>"><i class="fa fa-cog"></i><span>Event Category</span></a>
</li>
<?php } ?>


<?php if(check_permission($_SESSION['userlevel'],101,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "musiccategory" ?>"><i class="fa fa-cog"></i><span>Music Category</span></a>
</li>
<?php } ?>


<?php if(check_permission($_SESSION['userlevel'],103,$dbConn)){ ?>
<li class="treeview <?php echo ($activeTab == 17)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "projecttype" ?>"><i class="fa fa-cog"></i><span>Freelance - Project Type</span></a>
</li>
<?php } ?>



<?php if(check_permission($_SESSION['userlevel'],106,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "classificat" ?>">
<i class="fa fa-cog"></i> Classified Ads Category
</a>
</li>
<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],107,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "mastercategory" ?>">
<i class="fa fa-cog"></i> Business Category
</a>
</li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],151,$dbConn)){ ?>
<li><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/freelancer/index.php?view=business_sale"><i class="fa fa-cog"></i>Business For Sale Category</a></li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],179,$dbConn)){ ?>
<li><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/freelancer/index.php?view=category"><i class="fa fa-cog"></i>Freelancer Category</a></li>
<?php } ?>

<li><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/craftsubcategory/index.php?view=Freelancer_SubCategory"><i class="fa fa-cog"></i>Freelancer SubCategory</a></li>

<li><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/freelancer/index.php?view=StoreCategory"><i class="fa fa-cog"></i>Store Category</a></li>
<!-- <li><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/craftsubcategory/index.php?view=ArtSubCategory"><i class="fa fa-cog"></i>Art&Craft SubCategory</a></li> -->

<li><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/jobboard/index.php?view=JobCategory"><i class="fa fa-cog"></i>Job-Board Category</a></li>
<li><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/trainings/index.php?view=TrainingCategory"><i class="fa fa-cog"></i>Training Category </a></li>
</ul> </li>



<li>
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>PROFILES</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">


<li><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/mastercategory/"><i class="fa fa-cog"></i>Business</a></li>

<?php if(check_permission($_SESSION['userlevel'],179,$dbConn)){ ?>
<li><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/freelancer/index.php?view=category"><i class="fa fa-cog"></i>Freelancer </a></li>
<?php } ?>

<li><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/freelancer/index.php?view=profeesional_list"><i class="fa fa-cog"></i>Professional</a></li>

<li><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/freelancer/index.php?view=personal_list"><i class="fa fa-cog"></i>Personal</a></li>


</ul> </li>




<li>
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>GROUPS</span> <i class="fa fa-angle-left pull-right"></i></a>
<ul class="treeview-menu">
<?php if(check_permission($_SESSION['userlevel'],102,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "groupcategory" ?>"><i class="fa fa-cog"></i><span>Group Category</span></a>
</li>
<?php } ?> 

</ul></li>


<li class="header">FINANCES</li>
<li class="<?php echo ($activeTab == 4)?'active':'';?> treeview">
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>Wallet</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<!--<li>
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/Walletstore/index.php?view=storelist">
<i class="fa fa-circle-o"></i><span>Store</span>
</a>
</li>-->

<?php if(check_permission($_SESSION['userlevel'],7,$dbConn)){ ?>
<li>
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/walletrealestate/index.php?view=realestatelist">
<i class="fa fa-circle-o"></i> Real Estate
</a>
</li>
<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],8,$dbConn)){ ?>
<li>
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/walletevent/index.php?view=eventlist">
<i class="fa fa-circle-o"></i> Event
</a>
</li>
<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],9,$dbConn)){ ?>

<li>
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/walletartandcraft/index.php?view=artandcraftlist">
<i class="fa fa-circle-o"></i> Art and Craft
</a>
</li>
<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],10,$dbConn)){ ?>

<li>
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/walletvideo/index.php?view=videolist">
<i class="fa fa-circle-o"></i> Video
</a>
</li>
<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],11,$dbConn)){ ?>

<li>
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/Walletstore/index.php?view=storelist">
<i class="fa fa-circle-o"></i>Store Wallet

</a>
</li>
<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],12,$dbConn)){ ?>

<li>
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/Walletgroupevent/index.php?view=groupeventlist">
<i class="fa fa-circle-o"></i>Group Event

</a>
</li>
<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],13,$dbConn)){ ?>
<li>
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/Walletbonus/index.php?view=bonuslist">
<i class="fa fa-circle-o"></i>Bonus Wallet

</a>
</li>
<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],14,$dbConn)){ ?>

<li>
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/trainingwallet/index.php?view=traininglist">
<i class="fa fa-circle-o"></i>Training Wallet

</a>
</li>
<?php } ?>


</ul>
</li>

<!--end new module -->
<?php if(check_permission($_SESSION['userlevel'],15,$dbConn)){ ?>

<li><a href="javascript:void(0)" ><i class="fa fa-cog"></i><span>Listing Of All Modules</span><i class="fa fa-angle-left pull-right"></i></a>
<ul class="treeview-menu">

<li>
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>Store</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<?php if(check_permission($_SESSION['userlevel'],135,$dbConn)){ ?>
<li><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/sppoint_redeemed/index.php?view=retail"><i class="fa fa-circle-o"></i>Retail</a></li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],136,$dbConn)){ ?>
<li><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/sppoint_redeemed/index.php?view=personal"><i class="fa fa-circle-o"></i>Personal</a></li>

<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],137,$dbConn)){ ?>
<li><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/sppoint_redeemed/index.php?view=wholesale"><i class="fa fa-circle-o"></i>Wholesale</a></li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],138,$dbConn)){ ?>
<li><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/sppoint_redeemed/index.php?view=auction"><i class="fa fa-circle-o"></i>Auction</a></li>
<?php } ?>
</ul>
</li>



<?php if(check_permission($_SESSION['userlevel'],143,$dbConn)){ ?>
<!-- <li>
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/freelancer/index.php">
<i class="fa fa-cog"></i> Freelancer
</a>
</li> -->
<?php } ?>				




<li>
<a href="<?php echo WEB_ROOT_ADMIN . "jobboard/index.php?view=ListJobBoard" ?>">
<i class="fa fa-cog"></i> Job Board
</a>
</li>

<li>
<a href="<?php echo WEB_ROOT_ADMIN . "realestate/index.php?view=ListRealState" ?>">
<i class="fa fa-cog"></i> Real Estate
</a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "events/index.php?view=ListEvents" ?>">
<i class="fa fa-cog"></i> Events
</a>
</li>

<li>
<a href="<?php echo WEB_ROOT_ADMIN . "artgallery/index.php?view=ArtAndCraft" ?>">
<i class="fa fa-cog"></i> Art And Craft
</a>
</li>
<li><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/video/index.php?view=all_videos"><i class="fa fa-cog"></i> Videos </a>
</li>

<li>
<a href="<?php echo WEB_ROOT_ADMIN . "trainings/index.php?view=ListTrainings" ?>">
<i class="fa fa-cog"></i> Trainings
</a>
</li>

<li>
<a href="<?php echo WEB_ROOT_ADMIN . "clasifiedadds/index.php?view=ListClasifiedadds" ?>">
<i class="fa fa-cog"></i> Classified Ads
</a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "BusinessforSale" ?>">
<i class="fa fa-cog"></i> Business for Sale
</a>
</li>

</ul>
</li>






<?php } ?>
<!--end new module -->

<li class="treeview <?php echo ($activeTab == 50)?'active':'';?>">
<a href="javascript:void(0)"><i class="fa fa-cog"></i><span>Support Packages </span><i class="fa fa-angle-left pull-right"></i> </a>
<ul class="treeview-menu">

<?php if(check_permission($_SESSION['userlevel'],16,$dbConn)){ ?>
<li><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/membership/index.php?view=package"><i class="fa fa-circle-o"></i><span>Package List</span></a>
</li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],17,$dbConn)){ ?>
<li class="treeview <?php echo ($activeTab == 50)?'active':'';?>">
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/membership/index.php?view=purchase"><i class="fa fa-circle-o"></i><span>Purchase Support Package </span></a>
</li> 
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],18,$dbConn)){ ?>
<li><a href="javascript:void(0)"><i class="fa fa-circle-o"></i><span>Customer Enquiry</span></a>
</li> 
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],19,$dbConn)){ ?>
<li><a href="javascript:void(0)"><i class="fa fa-circle-o"></i><span>Closed Enquiry</span></a>
</li> 
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],20,$dbConn)){ ?>
<li><a href="javascript:void(0)"><i class="fa fa-circle-o"></i><span>Open Enquiry</span></a>
</li> 
<?php } ?>

</ul>
</li>

<!--end new module -->
<!--<li class="<?php echo ($activeTab == 5)?'active':'';?> treeview">
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>Payments</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">

<?php if(check_permission($_SESSION['userlevel'],21,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "storebooking/index.php?view=store" ?>"><i class="fa fa-circle-o"></i><span>Store Payment</span></a>
</li>

<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],22,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "rfqbooking/index.php?view=rfq" ?>"><i class="fa fa-circle-o"></i><span>Private RFQ Payment</span></a>
</li>

<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],23,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "rfqbooking/index.php?view=quotation" ?>"><i class="fa fa-circle-o"></i><span>Quotation Payment</span></a>
</li>

<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],24,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "withdraw/?view=withdraw" ?>"><i class="fa fa-circle-o"></i><span>Payment Request</span></a>
</li>

<?php } ?>
</ul>
</li>-->
<!--end new module -->
<?php if(check_permission($_SESSION['userlevel'],25,$dbConn)){ ?>
<li class="treeview <?php echo ($activeTabnew == 38)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "content/managecurrency.php" ?>"><i class="fa fa-cog"></i><span>Manage Cuerrency</span></a>
</li>
<?php } ?>


<!--end new module -->
<li class="header">SP POINT</li>

<?php if(check_permission($_SESSION['userlevel'],26,$dbConn)){ ?>
<li class="<?php echo ($activeTab == 5)?'active':'';?> treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "setting" ?>">
<i class="fa fa-cog"></i> <span>Setting</span></i>
</a></li>
<?php } ?>


<?php if(check_permission($_SESSION['userlevel'],27,$dbConn)){ ?>
<li class="<?php echo ($activeTab == 5)?'active':'';?> treeview">
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/sppoint_view/index.php">
<i class="fa fa-cog"></i> <span>Sp Points-View</span>
</a></li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],28,$dbConn)){ ?>
<li class="<?php echo ($activeTab == 5)?'active':'';?> treeview">
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/sppoint_redeemed/index.php">
<i class="fa fa-cog"></i> <span>Sp Points Redeemed</span>
</a></li>
<?php } ?>


<?php if(check_permission($_SESSION['userlevel'],29,$dbConn)){ ?>
<li class="<?php echo ($activeTab == 5)?'active':'';?> treeview">
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/sppoint_view/index.php?view=sppoints_unused">
<i class="fa fa-cog"></i> <span>Sp Points Unused</span>
</a></li>
<?php } ?>


<?php if(check_permission($_SESSION['userlevel'],30,$dbConn)){ ?>
<li class="<?php echo ($activeTab == 5)?'active':'';?> treeview">
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/sppoint_redeemed/index.php?view=redeem">
<i class="fa fa-cog"></i> <span>Redeem Request</span>
</a></li>
<?php } ?>


<!--end new module -->
<!-- <li class="header">SP-USERS</li>
<?php if(check_permission($_SESSION['userlevel'],31,$dbConn)){ ?>
<li class="<?php echo ($activeTab == 5)?'active':'';?> treeview">
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>Users Rights</span></i>
</a></li>

<?php } ?>


<?php if(check_permission($_SESSION['userlevel'],32,$dbConn)){ ?>
<li class="<?php echo ($activeTab == 5)?'active':'';?> treeview">
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>Assign Users</span>
</a></li>
<?php } ?>


<?php if(check_permission($_SESSION['userlevel'],33,$dbConn)){ ?>

<li class="<?php echo ($activeTab == 5)?'active':'';?> treeview">
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>Create Users</span>
</a></li>
<?php } ?>
-->

<?php if(check_permission($_SESSION['userlevel'],34,$dbConn)){ ?>

<li class="<?php echo ($activeTab == 5)?'active':'';?> treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "registerdUser/index.php" ?>">
<i class="fa fa-cog"></i> <span>Users List</span>
</a></li>

<?php } ?>



<?php if(check_permission($_SESSION['userlevel'],182,$dbConn)){ ?>
<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "registerdUser/index.php?view=referral_list" ?>">
<i class="fa fa-cog"></i> <span>Users Referral Code</span>
</a></li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],183,$dbConn)){ ?>
<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "registerdUser/index.php?view=delete_list" ?>">
<i class="fa fa-cog"></i> <span>Deleted Users</span>
</a></li>
<?php } ?>


<!--end new module -->
<li class="header">MEMBERSHIPS</li>



<!-- <?php if(check_permission($_SESSION['userlevel'],35,$dbConn)){ ?>
<li class="<?php echo ($activeTab == 5)?'active':'';?> treeview">
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>Add Membership Types</span></i>
</a></li>

<?php } ?> -->


<?php if(check_permission($_SESSION['userlevel'],36,$dbConn)){ ?>
<!-- <li class="<?php echo ($activeTab == 5)?'active':'';?> treeview">
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>Active Memberships</span>
</a></li> -->
<?php } ?>


<?php if(check_permission($_SESSION['userlevel'],37,$dbConn)){ ?>
<li class="treeview <?php echo ($activeTab == 24)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "membership_enquiry" ?>"><i class="fa fa-cog"></i><span>Membership Enquiry</span></a>
</li>
<?php } ?> 

<?php if(check_permission($_SESSION['userlevel'],38,$dbConn)){ ?>
<li class="treeview <?php echo ($activeTab == 24)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "membership_transaction" ?>"><i class="fa fa-cog"></i><span>Membership Transaction</span></a>
</li>
<?php } ?> 


<?php if(check_permission($_SESSION['userlevel'],39,$dbConn)){ ?>
<li class="treeview <?php echo ($activeTab == 24)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "membership_assign" ?>"><i class="fa fa-cog"></i><span>Membership Assign</span></a>
</li>
<?php } ?>


<?php if(check_permission($_SESSION['userlevel'],40,$dbConn)){ ?>

<!-- <li class="<?php echo ($activeTab == 5)?'active':'';?> treeview">
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>Free Membership Users</span>
</a></li> -->

<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],410,$dbConn)){ ?>
<!-- <li class="<?php echo ($activeTab == 5)?'active':'';?> treeview">
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>Expired Membership Users</span>
</a></li> -->
<?php } ?>




<!--end new module -->
<li class="header">GENERAL</li>

<?php if(check_permission($_SESSION['userlevel'],41,$dbConn)){ ?>
<li class="treeview <?php echo ($activeTab == 3)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "profileType" ?>"><i class="fa fa-cog"></i><span>Profile Type</span></a>
<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],42,$dbConn)){ ?>
<li class="treeview <?php echo ($activeTab == 90)?'active':'';?>">
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/notification_temp/index.php"><i class="fa fa-cog"></i><span>Notification Template </span></a>
</li>
<?php } ?>


<?php if(check_permission($_SESSION['userlevel'],43,$dbConn)){ ?>
<!-- <li>
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>Sharepage Modules</span>
</a>
</li> -->
<?php } ?>




<?php if(check_permission($_SESSION['userlevel'],44,$dbConn)){ ?>

<li class="treeview <?php echo ($activeTab == 28)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "contacttopic" ?>">
<i class="fa fa-cog"></i> <span>Contact Topic Issues</span>
</a>
</li>

<?php } ?>

<!--end new module -->
<?php if(check_permission($_SESSION['userlevel'],45,$dbConn)){ ?>
<li class="header">SERVER</li>


<li class="treeview <?php echo ($activeTab == 36)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "content/aws-s3.php" ?>"><i class="fa fa-cog"></i><span>Aws S-3</span></a>
</li>
<?php } ?>
<!--end new module -->

<li class="header">BUSINESS FOR SALE</li>
<?php if(check_permission($_SESSION['userlevel'],46,$dbConn)){ ?>
  <li class="treeview <?php echo ($activeTabnew == 38)?'active':'';?>">
    <a href="<?php echo WEB_ROOT_ADMIN . "content/b_sale.php " ?>"><i class="fa fa-cog"></i><span>Packages </span></a>
  </li>
  
  <li class="treeview <?php echo ($activeTabnew == 38)?'active':'';?>">
    <a href="<?php echo WEB_ROOT_ADMIN ."spcoupons/"?>"><i class="fa fa-cog"></i><span>Coupons</span></a>
  </li>


<?php } ?>



<?php if(check_permission($_SESSION['userlevel'],47,$dbConn)){ ?>
<li class="treeview <?php echo ($activeTabnew == 100)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "content/b_listings.php " ?>"><i class="fa fa-cog"></i><span>Listings </span></a>
</li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],48,$dbConn)){ ?>
<li class="treeview <?php echo ($activeTabnew == 101)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "content/b_subscriber.php " ?>"><i class="fa fa-cog"></i><span>Subscriber</span></a>
</li>
<?php } ?>
<!--end new module -->

<?php if(check_permission($_SESSION['userlevel'],49,$dbConn)){ ?>
<li class="header">Location</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "country" ?>"><i class="fa fa-cog"></i><span>Countries</span></a>
</li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],50,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "state/index.php?view=list" ?>"><i class="fa fa-cog"></i><span>State/Province</span></a>
</li>
<?php } ?>


<?php if(check_permission($_SESSION['userlevel'],51,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "city" ?>"><i class="fa fa-cog"></i><span>Cities</span></a>
</li>
<?php } ?>


<!-- GROUPS -->

<li class="header">Groups</li>

<?php if(check_permission($_SESSION['userlevel'],52,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN . "groups" ?>"><i class="fa fa-cog"></i> All Groups</a></li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],53,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN . "groups/index.php?view=ban" ?>"><i class="fa fa-cog"></i> Banned Groups</a></li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],54,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN . "groups/index.php?view=groups_c" ?>"><i class="fa fa-cog"></i>Groups category</a></li>
<?php } ?>
<!--end new module -->

<?php if(check_permission($_SESSION['userlevel'],55,$dbConn)){ ?>	
<li class="header">NFT</li>
<li>
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/nft/index.php">
<i class="fa fa-th-large"></i><span>Category </span>
</a>
</li>

<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],56,$dbConn)){ ?>	
<li>
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/nft/index.php?view=settings">
<i class="fa fa-cog"></i><span>Setting </span>
</a>
</li>
<?php } ?>
<!--start new module for commission -->


<li class="treeview <?php echo ($activeTab == 34)?'active':'';?>">
<a href="javascript:void(0)">
<i class="fa fa-address-card"></i> <span>Commission</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<li style="display:block">
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/commission_setup/index.php">
<i class="fa fa-th-large"></i><span>Commissions Setup</span>
</a>
</li>

<li  style="display:block">
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/commission_referral/index.php">
<i class="fa fa-th-large"></i><span>Set Referral Commissions (subscription)</span>
</a>
</li>

<li  style="display:block">
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/commission_level/index.php?view=close_f">
<i class="fa fa-cog"></i><span>Assign Users to Commissions Levels</span>
</a>
</li>
<li  style="display:block">
<a href="#">
<i class="fa fa-cog"></i><span>Commissions Report</span>
</a>
</li>
</ul>
</li>


<!--end new module for commission  -->
<!--					end new module -->
<!---->
<!--					<li class="header">COMMISSIONS</li>-->
<!---->
<!--					--><?php //if(check_permission($_SESSION['userlevel'],57,$dbConn)){ ?><!--	-->
<!--					<li><a href="--><?php //echo WEB_ROOT_ADMIN . "admcommission" ?><!--"><i class="fa fa-cog"></i> Commission Rate </a></li>-->
<!--					--><?php //} ?>
<!--					-->
<!--					--><?php //if(check_permission($_SESSION['userlevel'],58,$dbConn)){ ?>
<!--					<li class="treeview --><?php //echo ($activeTab == 34)?'active':'';?><!--">-->
<!--				<a href="javascript:void(0)">-->
<!--					<i class="fa fa-address-card"></i> <span>Commission List</span> <i class="fa fa-angle-left pull-right"></i>-->
<!--				</a>-->
<!--					<ul class="treeview-menu">-->
<!--					<li><a href="--><?php //echo WEB_ROOT_ADMIN . "commissionlist" ?><!--"><i class="fa fa-circle-o"></i><span>Today Registered Users</span></a></li>-->
<!--				</ul>-->
<!--				-->
<!--				</li>-->
<!--				--><?php //} ?>
<!--			end new module -->
<!--			-->
<!--				-->
<!--			<li class="treeview --><?php //echo ($activeTab == 34)?'active':'';?><!--">-->
<!--				<a href="javascript:void(0)">-->
<!--					<i class="fa fa-address-card"></i> <span>Friend Commission</span> <i class="fa fa-angle-left pull-right"></i>-->
<!--				</a>-->
<!--				<ul class="treeview-menu">-->
<!---->
<!---->
<!--				--><?php //if(check_permission($_SESSION['userlevel'],59,$dbConn)){ ?>
<!--				<li>-->
<!--						<a href="--><?php //$_SERVER["DOCUMENT_ROOT"]?><!--/backofadmin/friend_commission/index.php?view=add">-->
<!--						<i class="fa fa-th-large"></i><span>Super VIP Friends</span>-->
<!--						</a>-->
<!--					</li>-->
<!--					--><?php //} ?>
<!---->
<!--					--><?php //if(check_permission($_SESSION['userlevel'],60,$dbConn)){ ?>
<!--					<li>-->
<!--						<a href="--><?php //$_SERVER["DOCUMENT_ROOT"]?><!--/backofadmin/friend_commission/index.php">-->
<!--						<i class="fa fa-th-large"></i><span>VIP Friends </span>-->
<!--						</a>-->
<!--					</li>-->
<!--					--><?php //} ?>
<!---->
<!--					--><?php //if(check_permission($_SESSION['userlevel'],61,$dbConn)){ ?>
<!--					<li>-->
<!--						<a href="--><?php //$_SERVER["DOCUMENT_ROOT"]?><!--/backofadmin/super_vip_commission/index.php">-->
<!--						<i class="fa fa-cog"></i><span>Super VIP Commission </span>-->
<!--						</a>-->
<!--					</li>-->
<!--					--><?php //} ?>
<!---->
<!--					--><?php //if(check_permission($_SESSION['userlevel'],62,$dbConn)){ ?>
<!--					<li>-->
<!--						<a href="--><?php //$_SERVER["DOCUMENT_ROOT"]?><!--/backofadmin/vip_commission/index.php">-->
<!--						<i class="fa fa-cog"></i><span>VIP Commission </span>-->
<!--						</a>-->
<!--					</li>-->
<!--					--><?php //} ?>
<!---->
<!--					--><?php //if(check_permission($_SESSION['userlevel'],63,$dbConn)){ ?>
<!--					<li>-->
<!--						<a href="--><?php //$_SERVER["DOCUMENT_ROOT"]?><!--/backofadmin/general_commission/index.php">-->
<!--						<i class="fa fa-cog"></i><span>General Commission </span>-->
<!--						</a>-->
<!--					</li>-->
<!--					--><?php //} ?>
<!---->
<!--					--><?php //if(check_permission($_SESSION['userlevel'],64,$dbConn)){ ?>
<!--					<li>-->
<!--						<a href="--><?php //$_SERVER["DOCUMENT_ROOT"]?><!--/backofadmin/general_commission/index.php?view=sale">-->
<!--						<i class="fa fa-cog"></i><span>Sale Commission </span>-->
<!--						</a>-->
<!--					</li>-->
<!--					--><?php //} ?>
<!---->
<!--				</ul>-->
<!--			</li>-->
<!--			-->
<!--			end new module -->
<!--			<li class="header">CONTENT MANAGEMENT</li>-->
<!---->
<!--			--><?php //if(check_permission($_SESSION['userlevel'],65,$dbConn)){ ?>
<!--			<li><a href="javascript:void(0)"><i class="fa fa-cog"></i> <span>Contact Massages</span></a></li>-->
<!--			--><?php //} ?>

<!-- <?php if(check_permission($_SESSION['userlevel'],66,$dbConn)){ ?>
<li><a href="javascript:void(0)"><i class="fa fa-cog"></i> <span>Social Media Links</span></a></li>
<?php } ?> -->

<?php if(check_permission($_SESSION['userlevel'],67,$dbConn)){ ?>
<li class="treeview <?php echo ($activeTab == 32)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "content/posting" ?>"><i class="fa fa-file-text"></i><span>Posting Content</span></a>
</li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],68,$dbConn)){ ?>
<li class="treeview <?php echo ($activeTab == 33)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "content/profile" ?>"><i class="fa fa-cog"></i><span>Profile Content</span></a>
</li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],69,$dbConn)){ ?>
<li class="treeview <?php echo ($activeTab == 38)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "content/banner" ?>"><i class="fa fa-cog"></i><span>Upload Store Banner</span></a>
</li>
<?php } ?>


<li class="treeview <?php echo ($activeTab == 34)?'active':'';?>">
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>Job Board</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">

<?php if(check_permission($_SESSION['userlevel'],70,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "content/hire_employe" ?>"><i class="fa fa-circle-o"></i><span>Hire An Employee</span></a>
</li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],71,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "content/loking_job" ?>"><i class="fa fa-circle-o"></i><span>Looking For A Job</span></a>
</li>
<?php } ?>
</ul>
</li>


<?php if(check_permission($_SESSION['userlevel'],72,$dbConn)){ ?>
<li class="treeview <?php echo ($activeTab == 25)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "content/footleft" ?>"><i class="fa fa-cog"></i><span>Left Content</span></a>
</li>
<?php } ?>



<li class="<?php echo ($activeTab == 5)?'active':'';?> treeview">
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>Footer Content</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">


<?php if(check_permission($_SESSION['userlevel'],73,$dbConn)){ ?>
<li class="treeview <?php echo ($activeTab == 26)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "foothead" ?>"><i class="fa fa-circle-o"></i><span>Footer Heading Colum</span></a>
</li>
<?php } ?>


<?php if(check_permission($_SESSION['userlevel'],74,$dbConn)){ ?>
<li class="treeview <?php echo ($activeTab == 27)?'active':'';?>" >
<a href="<?php echo WEB_ROOT_ADMIN . "page/footer" ?>"><i class="fa fa-circle-o"></i><span>Footer Pages</span></a>
</li>
<?php } ?>


<?php if(check_permission($_SESSION['userlevel'],75,$dbConn)){ ?>
<li><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/membership/index.php?view=sp_blog"><i class="fa fa-circle-o"></i><span>Sharepage Blogs</span></a></li>
<?php } ?>
</ul>
</li>



<!-- <li><a href="javascript:void(0)"><i class="fa fa-users"></i> <span>Contacts
</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">

<?php if(check_permission($_SESSION['userlevel'],76,$dbConn)){ ?>
<li class="treeview <?php echo ($activeTab == 28)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "contacttopic" ?>"><i class="fa fa-envelope"></i><span>Contact Topic Issue</span></a>
</li>
<?php }?> 


<?php if(check_permission($_SESSION['userlevel'],77,$dbConn)){ ?>
<li><a href="javascript:void(0)"><i class="fa fa-users"></i><span>Received Messages And Replies</span></i></a></li>
<?php }?>
</ul>
</li>-->
<?php if(check_permission($_SESSION['userlevel'],78,$dbConn)){ ?>
<li class="treeview <?php echo ($activeTab == 30)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "social" ?>"><i class="fa fa-envelope"></i><span>Social Media Links</span></a>
</li>
<?php }?>


<li class="treeview <?php echo ($activeTab == 31)?'active':'';?>">
<a href="javascript:void(0)">
<i class="fa fa-home"></i> <span>Homepage Content</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">

<?php if(check_permission($_SESSION['userlevel'],79,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "content/email_market" ?>"><i class="fa fa-circle-o"></i><span>Email Marketing</span></a>
</li>
<?php }?>


<?php if(check_permission($_SESSION['userlevel'],80,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "content/sms_market" ?>"><i class="fa fa-circle-o"></i><span>SMS Marketing</span></a>
</li>
<?php }?>

<?php if(check_permission($_SESSION['userlevel'],81,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "content/feature" ?>"><i class="fa fa-circle-o"></i><span>Feature</span></a>
</li>
<?php }?>

</ul>
</li>
<!--end new module -->

<li class="header">SHAREPAGE  EVENTS</li>
<?php if(check_permission($_SESSION['userlevel'],82,$dbConn)){ ?>
  <li>
  <a href="<?php echo WEB_ROOT_ADMIN . "booking/shareindex.php?view=share_registration_type" ?>"><i class="fa fa-cog"></i><span>Sharepage Events</span></a>
  </li>
  <li>
  <a href="<?php echo WEB_ROOT_ADMIN . "booking/shareindex.php?view=sharepageInfoSetting" ?>"><i class="fa fa-cog"></i><span>Sharepage Events Setting</span></a>
  </li>
<li class="treeview <?php echo ($activeTab == 36)?'active':'';?>">
  <a href="<?php echo WEB_ROOT_ADMIN . "register_event/index.php" ?>"><i class="fa fa-cog"></i><span>Sharepage Events Register</span></a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "booking/index.php?view=registration_type" ?>"><i class="fa fa-cog"></i><span>Sharepage Events Packages </span></a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "booking/eventCategory_index.php?view=event_categories" ?>"><i class="fa fa-cog"></i><span>Sharepage Events Categories </span></a>
</li>
<?php }?>
<!--end new module -->

<li class="header">COMMUNICATIONS</li>
<?php if(check_permission($_SESSION['userlevel'],82,$dbConn)){ ?>
<li class="treeview <?php echo ($activeTab == 36)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "emailuser" ?>"><i class="fa fa-envelope"></i><span>Email to users</span></a>
</li>
<?php }?>



<li class="treeview <?php echo ($activeTab == 34)?'active':'';?>">
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>Bookings</span> <i class="fa fa-angle-left pull-right"></i>
</a>

<ul class="treeview-menu">
<?php if(check_permission($_SESSION['userlevel'],83,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "groupbooking/index.php?view=groupevent" ?>"><i class="fa fa-circle-o"></i><span>Group Event Booked</span></a>
</li>
<?php }?>

<?php if(check_permission($_SESSION['userlevel'],84,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "booking/index.php?view=event" ?>"><i class="fa fa-circle-o"></i><span>Event Booked</span></a>
</li>
<?php }?>
<!--  <li>
<a href="<?php echo WEB_ROOT_ADMIN . "content/loking_job" ?>"><i class="fa fa-circle-o"></i><span>Looking For A Job</span></a>
</li>
-->
</ul>
</li>


<li class="treeview <?php echo ($activeTab == 36)?'active':'';?>">
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>Email Template</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">

<?php if(check_permission($_SESSION['userlevel'],85,$dbConn)){ ?>
<li>
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/email_template/index.php">
<i class="fa fa-cog"></i><span>Email Template </span>
</a>
</li>
<?php }?>

<!--<li>
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/nft/index.php?view=settings">
<i class="fa fa-cog"></i><span>Setting </span>
</a>
</li>-->
</ul>
</li>

<!--end new module -->
<?php if(check_permission($_SESSION['userlevel'],86,$dbConn)){ ?>
<li class="treeview <?php echo ($activeTabnew == 39)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "media/index.php " ?>"><i class="fa fa-cog"></i><span>Add Media</span></a>
</li>  
<?php } ?>



<li class="header">News Views</li>	
<?php if(check_permission($_SESSION['userlevel'],87,$dbConn)){ ?>
<li>
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/channelrequest/index.php?view=channellist">
<i class="fa fa-cog"></i><span>Channel Request </span>
</a>
</li>
<?php } ?>
<!-- Approved/ Rejected Courses -->
<!-- <?php if(check_permission($_SESSION['userlevel'],178,$dbConn)){ ?>
<li>
<a href="javascript:void(0)">
<i class="fa fa-cog"></i><span>Approved/Rejected Courses </span>
</a></li>

<?php } ?> -->

<?php if(check_permission($_SESSION['userlevel'],88,$dbConn)){ ?>
<li>
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/channelrequest/index.php?view=channelabout">
<i class="fa fa-cog"></i><span>About us </span>
</a>
</li>
<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],89,$dbConn)){ ?>
<li>
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/channelrequest/index.php?view=Announcement">
<i class="fa fa-cog"></i><span>Announcement</span>
</a>
</li>
<?php } ?>
<!--li>
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/channelrequest/index.php?view=worldnewsn">
<i class="fa fa-cog"></i><span>World news</span>
</a>
</li -->
<?php if(check_permission($_SESSION['userlevel'],90,$dbConn)){ ?>
<li>
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/channelrequest/index.php?view=worldnewsns">
<i class="fa fa-cog"></i><span>World news</span>
</a>
</li>
<?php } ?>

<li class="header">Courses</li>
<?php if(check_permission($_SESSION['userlevel'],91,$dbConn)){ ?>
<li><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/courses/index.php?view=pending"><i class="fa fa-cog"></i><span>Pending Approval</span></a></li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],92,$dbConn)){ ?>
<li><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/courses/index.php?view=rejected"><i class="fa fa-cog"></i><span>Rejected Courses</span></a></li>
<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],93,$dbConn)){ ?>
<li><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/courses/index.php?view=approved"><i class="fa fa-cog"></i><span>Approved Courses</span></a></li>

<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],94,$dbConn)){ ?>

<li class="treeview <?php echo ($activeTabnew == 38)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "courses/index.php " ?>"><i class="fa fa-cog"></i><span>Courses</span></a>
</li>
<?php } ?>



<!--end new module -->
<!-- <li class="header">CATEGORIES</li>  

end new module -->

<!--	<?php if(check_permission($_SESSION['userlevel'],105,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "allcategory" ?>">
<i class="fa fa-cog"></i> All Category<i class="fa fa-angle-left pull-right"></i>
</a>

<ul class="treeview-menu">
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "in_sub_category" ?>">
<i class="fa fa-circle-o"></i> Inner Sub Category
</a>
</li>
</ul>
</li>
<?php } ?>



<li>
<a href="javascript:void(0)"><i class="fa fa-cog"></i> Art Gallery <i class="fa fa-angle-left pull-right"></i></a>
<ul class="treeview-menu">


<?php if(check_permission($_SESSION['userlevel'],129,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN. "art_sold_by" ?>"><i class="fa fa-circle-o"></i> Art Sold By</a></li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],130,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN. "frame_type" ?>"><i class="fa fa-circle-o"></i> Framing Type</a></li>
<?php } ?>
</ul>
</li>

<?php if(check_permission($_SESSION['userlevel'],100,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "eventgroups" ?>"><i class="fa fa-cog"></i><span>Event Groups</span></a>
</li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],104,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "mainCategory" ?>">
<i class="fa fa-cog"></i><span>Modules</span>
</a>
</li>
<?php } ?> -->
<!-- new module -->




<li class="header">Task Management</li>
<?php if(check_permission($_SESSION['userlevel'],108,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN . "notes" ?>"><i class="fa fa-cog"></i> All Sticky Notes</a></li>
<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],109,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "mytask" ?>">
<i class="fa fa-cog"></i> My Task
<span class="pull-right-container pull-right">
<small class="label bg-aqua"><?php latestUnreadTask($dbConn, $_SESSION['userId']); ?></small>
</span>
</a>
</li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],110,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "waitingTask" ?>">
<i class="fa fa-cog text-blue"></i> Waiting Task
</a>
</li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],112,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "crossTask" ?>">
<i class="fa fa-cog text-red"></i> Cross Check
</a>
</li>

<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],113,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "cmpTask" ?>">
<i class="fa fa-cog text-green"></i> Completed Task
</a>
</li>
<?php } ?>
<!--end new module -->

<?php if(check_permission($_SESSION['userlevel'],114,$dbConn)){ ?>
<li class="header">REGISTERED USERS</li>
<li><a href="<?php echo WEB_ROOT_ADMIN . "registerdUser/index.php?view=today" ?>"><i class="fa fa-cog"></i><span>Today Registered Users</span></a></li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],115,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "registerdUser" ?>">
<i class="fa fa-cog"></i> All Users
<span class="pull-right-container pull-right"><small class="label bg-aqua"><?php totalRegUser($dbConn); ?></small></span>
</a>
</li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],116,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN . "registerdUser/index.php?view=vemail" ?>"><i class="fa fa-cog"></i><span>Valid Email Users</span></a></li>
<?php } ?>


<?php if(check_permission($_SESSION['userlevel'],117,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN . "registerdUser/index.php?view=vphone" ?>"><i class="fa fa-cog"></i><span>Valid Phone Users</span></a></li>
<?php } ?>


<?php if(check_permission($_SESSION['userlevel'],118,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN . "registerdUser/index.php?view=block" ?>"><i class="fa fa-ban"></i><span>Blocked Users</span>
<span class="pull-right-container pull-right"><small class="label bg-aqua"><?php totalBlockedUsers($dbConn); ?></small></span>
</a></li>
<?php } ?>


<?php if(check_permission($_SESSION['userlevel'],119,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN . "registerdUser/index.php?view=vaccount" ?>"><i class="fa fa-cog"></i><span>User Account Verification</span></a></li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],119,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN . "registerdUser/index.php?view=baccount" ?>"><i class="fa fa-cog"></i><span>Business Account Verification</span></a></li>
<?php } ?>


<?php if(check_permission($_SESSION['userlevel'],120,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN . "registerdUser/index.php?view=baccount" ?>"><i class="fa fa-cog"></i><span>Buisness Accounts</span></a></li>
<?php } ?>


<?php if(check_permission($_SESSION['userlevel'],121,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN . "registerdUser/index.php?view=deactivated" ?>"><i class="fa fa-cog"></i><span>Deactivated User</span></a></li>

<?php } ?>






<li class="header">FORMS</li>
<li class="<?php echo ($activeTab == 9)?'active':'';?> treeview">
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>Module Form Setting</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu active">

<li>
<a href="javascript:void(0)"><i class="fa fa-circle-o"></i> Store <i class="fa fa-angle-left pull-right"></i></a>
<ul class="treeview-menu">


<?php if(check_permission($_SESSION['userlevel'],122,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN. "industry_type" ?>"><i class="fa fa-circle-o"></i> Industry Type</a></li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],123,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN. "product_status" ?>"><i class="fa fa-circle-o"></i> Product Status</a></li>

<?php } ?>


<?php if(check_permission($_SESSION['userlevel'],124,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN. "shipping_destination" ?>"><i class="fa fa-circle-o"></i> Shipping Destination</a></li>

<?php } ?>
</ul>
</li>




<?php if(check_permission($_SESSION['userlevel'],125,$dbConn)){ ?>
<li>
<a href="javascript:void(0)"><i class="fa fa-circle-o"></i> Freelance </i></a>
<?php } ?>
</li>
<li>
<a href="javascript:void(0)"><i class="fa fa-circle-o"></i> Job Board <i class="fa fa-angle-left pull-right"></i></a>
<ul class="treeview-menu">
<?php if(check_permission($_SESSION['userlevel'],126,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN. "job_level" ?>"><i class="fa fa-circle-o"></i> Job Level</a></li>
<?php } ?>

<!-- <li><a href="<?php //echo WEB_ROOT_ADMIN. "post_guideline" ?>"><i class="fa fa-circle-o"></i> Job Post Guideline</a></li> -->
</ul>
</li>


<li>
<a href="javascript:void(0)"><i class="fa fa-circle-o"></i> Real Estate <i class="fa fa-angle-left pull-right"></i></a>
<ul class="treeview-menu">


<?php if(check_permission($_SESSION['userlevel'],127,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN. "property_type" ?>"><i class="fa fa-circle-o"></i> Property Type</a></li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],128,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN. "pro_status" ?>"><i class="fa fa-circle-o"></i> Property Status</a></li>
<?php } ?>
</ul>
</li>

<!--<li>
<a href="#"><i class="fa fa-circle-o"></i> Music <i class="fa fa-angle-left pull-right"></i></a>
<ul class="treeview-menu">
<li><a href="<?php echo WEB_ROOT_ADMIN. "music_language" ?>"><i class="fa fa-circle-o"></i> Music Language</a></li>

</ul>
</li> -->


</ul>
</li>
<!--new module -->
<li class="header">POSTS</li>
<li class="treeview <?php echo ($activeTab == 12)?'active':'';?> treeview">
<a href="javascript:void(0)"><i class="fa fa-cog"></i> <span>Timeline</span> <i class="fa fa-angle-left pull-right"></i></a>

<ul class="treeview-menu">
<?php if(check_permission($_SESSION['userlevel'],131,$dbConn)){ ?>
<li>

<a href="<?php echo WEB_ROOT_ADMIN . "totalPost" ?>"><i class="fa fa-circle-o"></i><span>All Active Posts</span></a>

</li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],132,$dbConn)){ ?>

<li>
<a href="<?php echo WEB_ROOT_ADMIN . "freelancer_hire" ?>">
<i class="fa fa-circle-o"></i> Freelancer Hired
</a>
</li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],133,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "freelancer_payment" ?>">
<i class="fa fa-circle-o"></i> Freelancer payment
</a>
</li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],134,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "freelancer_payment/index.php?view=cancel" ?>">
<i class="fa fa-circle-o"></i> Freelancer Cancel payment
</a>
</li>
<?php } ?>



</ul>



</li>
<!--end new module -->
<li class="header">ALL ADS</li>
<li>
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>Store</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<?php if(check_permission($_SESSION['userlevel'],135,$dbConn)){ ?>
<li><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/sppoint_redeemed/index.php?view=retail"><i class="fa fa-circle-o"></i>Retail</a></li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],136,$dbConn)){ ?>
<li><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/sppoint_redeemed/index.php?view=personal"><i class="fa fa-circle-o"></i>Personal</a></li>

<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],137,$dbConn)){ ?>
<li><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/sppoint_redeemed/index.php?view=wholesale"><i class="fa fa-circle-o"></i>Wholesale</a></li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],138,$dbConn)){ ?>
<li><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/sppoint_redeemed/index.php?view=auction"><i class="fa fa-circle-o"></i>Auction</a></li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],139,$dbConn)){ ?>
<li><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/sppoint_redeemed/index.php?view=rfq"><i class="fa fa-circle-o"></i> RFQ</a></li>

<?php } ?>


</ul>

</li>


<?php if(check_permission($_SESSION['userlevel'],140,$dbConn)){ ?>
<!-- <li>

<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>Jobs</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">

<li>
<a href="<?php echo WEB_ROOT_ADMIN . "jobboard" ?>">
<i class="fa fa-circle-o"></i> Job Board
</a>
</li>
</ul>
</li> -->
<?php } ?>

<!-- <?php if(check_permission($_SESSION['userlevel'],141,$dbConn)){ ?>
<li>
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>Real Estate</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<li>
<a href="javascript:void(0)">
<i class="fa fa-circle-o"></i> Real Estate
</a>
</li>
</ul>
</li>
<?php } ?> -->

<?php if(check_permission($_SESSION['userlevel'],142,$dbConn)){ ?>
<!-- <li>
<a href="javascript:void(0)">
<i class="fa fa-cog"></i>Rentals
</a>
</li> -->
<?php } ?>
<li>
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>Freelancer</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<?php if(check_permission($_SESSION['userlevel'],143,$dbConn)){ ?>
<li>
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/freelancer/index.php">
<i class="fa fa-circle-o"></i> Freelancer Projects
</a>
</li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],144,$dbConn)){ ?>
<li>
<a href="<?php echo ($activeTab == 5)?'active':'';?> treeview">
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/freelancer/index.php?view=bids">
<i class="fa fa-circle-o"></i> Freelancer Bids
</a>
</li>
<?php } ?>

</ul>
</li>
<?php if(check_permission($_SESSION['userlevel'],145,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "events" ?>">
<i class="fa fa-cog"></i> Events
</a>
</li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],146,$dbConn)){ ?>
<!-- <li>
<a href="<?php echo WEB_ROOT_ADMIN . "artgallery" ?>">
<i class="fa fa-cog"></i>Art Craft Gallery
</a>
</li> -->
<?php } ?>

<li>
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>Videos</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<?php if(check_permission($_SESSION['userlevel'],147,$dbConn)){ ?>
<li>
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/video/index.php?view=paid_video">
<i class="fa fa-circle-o"></i>Paid Videos
</a>
</li>
<?php	} ?>
<?php if(check_permission($_SESSION['userlevel'],148,$dbConn)){ ?>
<li>
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/video/index.php?view=free_video">
<i class="fa fa-circle-o"></i>Free Videos
</a>
</li>
<?php } ?>

<?php if(check_permission($_SESSION['userlevel'],167,$dbConn)){ ?>

<li><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/video/index.php?view=all_videos"><i class="fa fa-circle-o"></i> Videos </a></li>	

<?php } ?>
</ul>
<!-- </li>
<?php if(check_permission($_SESSION['userlevel'],149,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "trainings" ?>">
<i class="fa fa-cog"></i> Trainings
</a>
</li>
<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],150,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "clasifiedadds" ?>">
<i class="fa fa-cog"></i> Classified Ads
</a>
</li>
<?php } ?> -->

<!-- new mmm -->

<li class="header">Q&A</li>
<?php if(check_permission($_SESSION['userlevel'],152,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "faq" ?>">
<i class="fa fa-cog"></i> Module
</a>
</li>
<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],153,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "faq/faq_q_a_list.php?msg=null" ?>">
<i class="fa fa-cog"></i> Q&A
</a>
</li>
<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],154,$dbConn)){ ?>

<li class="<?php echo ($activeTab == 20)?'active':'';?> treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "cmpnynews" ?>">
<i class="fa fa-newspaper-o"></i> <span>Company News</span>
</a>
</li> <?php } ?>
<?php if(check_permission($_SESSION['userlevel'],155,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN . "cmpnynews" ?>"><i class="fa fa-cog"></i> All News</a></li> <?php } ?>

<?php if(check_permission($_SESSION['userlevel'],156,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN . "cmpnynews/index.php?view=ban" ?>"><i class="fa fa-cog"></i> Banned News</a></li> <?php } ?>

<!-- new -->

<li class="header">All Flags</li>
<?php if(check_permission($_SESSION['userlevel'],157,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN."flag/index.php?view=flagtimelinepost"?>"><i class="fa fa-cog"></i> Timeline</a></li>
<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],158,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN."flag/index.php?catId=1&module=store"?>"><i class="fa fa-cog"></i>Flag</a></li> <?php } ?>
<?php if(check_permission($_SESSION['userlevel'],159,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN."flag/rfqflag"?>"><i class="fa fa-cog"></i> RFQ Flag</a></li>
<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],160,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN."flag/index.php?catId=5"?>"><i class="fa fa-cog"></i> Freelance </a></li>	<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],161,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN."flag/index.php?catId=2"?>"><i class="fa fa-cog"></i> Job Board </a></li>	<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],162,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN."flag/index.php?catId=3"?>"><i class="fa fa-cog"></i> Real Estate </a></li>	<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],163,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN."flag/index.php?catId=9"?>"><i class="fa fa-cog"></i> Event </a></li>	<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],164,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN."flag/index.php?catId=16"?>"><i class="fa fa-cog"></i>Group Event</a></li>	<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],165,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN."flag/index.php?catId=13"?>"><i class="fa fa-cog"></i> Art Gallery </a></li>	<?php } ?>
<!-- <?php if(check_permission($_SESSION['userlevel'],166,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN."flag/index.php?catId=14"?>"><i class="fa fa-cog"></i> Music </a></li>	<?php } ?> -->
<!-- <?php if(check_permission($_SESSION['userlevel'],167,$dbConn)){ ?>
<li><a href="<?php // echo WEB_ROOT_ADMIN."flag/index.php?catId=10"?>"><i class="fa fa-cog"></i> Videos </a></li>	<?php } ?> -->
<?php if(check_permission($_SESSION['userlevel'],168,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN."flag/index.php?catId=8"?>"><i class="fa fa-cog"></i> Trainings </a></li>	<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],169,$dbConn)){ ?>
<li><a href="<?php echo WEB_ROOT_ADMIN."flag/index.php?catId=7"?>"><i class="fa fa-cog"></i> Classified Ads </a></li>	<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],170,$dbConn)){ ?>

<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "flag/index.php?view=flaguser" ?>"><i class="fa fa-user"></i><span>Flagged Profile</span></a>
</li>	<?php } ?>
<?php if(check_permission($_SESSION['userlevel'],171,$dbConn)){ ?>
<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "flag/index.php?catId=20&view=business" ?>"><i class="fa fa-user"></i><span>Business</span></a>
</li>
<?php } ?>

<li>
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>Testimonials</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">

<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "Testimonial/clients" ?>"><i class="fa fa-user"></i><span>Testimonials</span></a>
</li>
<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "Testimonial/videoTestimonials" ?>"><i class="fa fa-user"></i><span>Video Testimonials</span></a>
</li>



</ul>
</li>
<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "blogcategory" ?>"><i class="fa fa-user"></i><span>Blog Category</span></a>
</li>
<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "blogs" ?>"><i class="fa fa-user"></i><span>Blogs</span></a>
</li>
<!-- <li class="treeview <?php echo ($activeTab == 23)?'active':'';?>">
<a href="javascript:void(0)">
<i class="fa fa-users"></i> <span> MEMBERSHIP</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu active">

<?php if(check_permission($_SESSION['userlevel'],172,$dbConn)){ ?>
<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "membership/index.php?view=add" ?>"><i class="fa fa-cog"></i><span>Add Membership</span></a>
</li><?php } ?>
<?php if(check_permission($_SESSION['userlevel'],173,$dbConn)){ ?>

<li class="treeview <?php echo ($activeTab == 23)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "membership" ?>"><i class="fa fa-cog"></i><span>All Membership</span></a>
</li> <?php } ?>




</ul>
</li> -->




<!--			<li class="treeview ">-->
<!--				<a href="javascript:void(0)">-->
<!--					<i class="fa fa-users"></i> <span>Commission Level</span> <i class="fa fa-angle-left pull-right"></i>-->
<!--				</a>-->
<!--				<ul class="treeview-menu active">-->
<!--				--><?php //if(check_permission($_SESSION['userlevel'],185,$dbConn)){ ?>
<!--				<li class="treeview ">-->
<!--				<a href="--><?php //echo WEB_ROOT_ADMIN . "commission_level/index.php?view=close_f" ?><!--"><i class="fa fa-cog"></i><span>Close Friend</span></a>-->
<!--				</li>-->
<!--				--><?php //} ?>
<!--				--><?php //if(check_permission($_SESSION['userlevel'],186,$dbConn)){ ?>
<!--					<li class="treeview ">-->
<!--				<a href="--><?php //echo WEB_ROOT_ADMIN . "commission_level" ?><!--"><i class="fa fa-cog"></i><span>Set Commission</span></a>-->
<!--			</li>-->
<!--			--><?php //} ?>
<!--			-->
<!--			-->
<!--			-->
<!--				</ul>-->
<!--				</li>-->


<!-- hello -->


<!--end new module -->

<!-- <li class="treeview <?php echo ($activeTab == 6)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "allprofiles" ?>"><i class="fa fa-cog"></i><span>All Profiles</span></a>
</li> -->

<!-- <li class="<?php echo ($activeTab == 38)?'active':'';?> treeview">
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>SP POINTS</span> <i class="fa fa-angle-left pull-right"></i>
</a>  
<ul class="treeview-menu">
<li><a href="<?php echo WEB_ROOT_ADMIN . "pointtype" ?>"><i class="fa fa-circle-o text-red"></i><span>Earning Points Type</span></a></li>

<li><a href="<?php echo WEB_ROOT_ADMIN . "point" ?>"><i class="fa fa-circle-o text-green"></i><span>All Points</span></a></li>

<li><a href="<?php echo WEB_ROOT_ADMIN . "dollar" ?>"><i class="fa fa-circle-o text-blue"></i><span>Points to Dollar</span></a></li>

<li><a href="<?php echo WEB_ROOT_ADMIN . "userpointlist" ?>"><i class="fa fa-circle-o text-white"></i><span>Users Points</span></a></li>


</ul>
</li> -->





<!-- END -->

<!-- <li class="header">POSTINGS</li> -->
<!-- SHOW ALL POST THROUGH MODULE WISE -->
<!-- <li class="<?php echo ($activeTab == 8)?'active':'';?> treeview">
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>All Modules</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "postdash" ?>">
<i class="fa fa-circle-o"></i> Posting Dashboard
</a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "store" ?>">
<i class="fa fa-circle-o"></i> Store
</a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "freelance" ?>">
<i class="fa fa-circle-o"></i> Freelancer
</a>
</li>

<li>
<a href="<?php echo WEB_ROOT_ADMIN . "jobboard" ?>">
<i class="fa fa-circle-o"></i> Job Board
</a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "realestate" ?>">
<i class="fa fa-circle-o"></i> Real Estate
</a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "events" ?>">
<i class="fa fa-circle-o"></i> Events
</a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "artgallery" ?>">
<i class="fa fa-circle-o"></i> Art Gallery
</a>
</li> -->



<!--	<li>
<a href="<?php echo WEB_ROOT_ADMIN . "music" ?>">
<i class="fa fa-circle-o"></i> music
</a>
</li>-->
<!-- <li>
<a href="<?php echo WEB_ROOT_ADMIN . "video" ?>">
<i class="fa fa-circle-o"></i> Videos
</a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "trainings" ?>">
<i class="fa fa-circle-o"></i> Trainings
</a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "clasifiedadds" ?>">
<i class="fa fa-circle-o"></i> Classified Ads
</a>
</li>


</ul>
</li> -->

<!--li class="treeview <?php echo ($activeTab == 40)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "rss" ?>"><i class="fa fa-user-md"></i><span>Add RSS</span></a>
</li 

<li class="treeview <?php echo ($activeTab == 11)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "topseller" ?>"><i class="fa fa-user-md"></i><span>Top Sellers</span></a>
</li>
-->










<!--/////////////////////////////////-->



<!-- ///////////////////////////////////////////////----->

<!-- <li class="treeview <?php echo ($activeTab == 17)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "projecttype" ?>"><i class="fa fa-cog"></i><span>Project Type(Freelance)</span></a>
</li> -->


<!-- <li class="treeview <?php echo ($activeTab == 18)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "sponsor" ?>"><i class="fa fa-cog"></i><span>Sponsor</span></a>
</li>
-->
<!-- <li class="header">STATISTICS</li>
<li class="<?php echo ($activeTab == 8)?'active':'';?> treeview">
<a href="javascript:void(0)">
<i class="fa fa-bar-chart"></i> <span>All Modules Statistics</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "statistic" ?>">
<i class="fa fa-circle-o"></i> store
</a>
</li> -->
<!--	<li>
<a href="<?php echo WEB_ROOT_ADMIN . "statistic" ?>">
<i class="fa fa-circle-o"></i> RFQ Flag
</a>
</li>-->
<!-- <li>
<a href="<?php echo WEB_ROOT_ADMIN . "statistic" ?>/?view=freelancer">
<i class="fa fa-circle-o"></i> Freelance
</a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "statistic" ?>/?view=jobboard">
<i class="fa fa-circle-o"></i> Job Board
</a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "statistic" ?>/?view=realestate">
<i class="fa fa-circle-o"></i> Real Estate
</a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "statistic" ?>/?view=event">
<i class="fa fa-circle-o"></i> Event
</a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "statistic" ?>">
<i class="fa fa-circle-o"></i> Group Event
</a>
</li>-->
<!-- </ul>
</li> -->






<!-- <li class="header">USER MANAGEMENT</li>
<li class="treeview <?php echo ($activeTab == 7)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "webmodule" ?>"><i class="fa fa-user-md"></i><span>Admin Module</span></a> 
</li>-->

<?php if(check_permission($_SESSION['userlevel'],174,$dbConn)){ ?>

<li class="treeview <?php echo ($activeTab == 10)?'active':'';?> ">
<a href="<?php echo WEB_ROOT_ADMIN . "users" ?>"><i class="fa fa-user-md"></i>
<span>Staff</span>
<span class="pull-right-container pull-right">
<small class="label bg-red"><?php totalAdminUser($dbConn); ?></small>
</span>
</a>
</li>
<?php
}
?>





<!--<li class="header">MEMBERSHIP</li>
<li class="treeview <?php echo ($activeTab == 23)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "membership" ?>"><i class="fa fa-cog"></i><span>All Membership</span></a>
</li>
<li class="treeview <?php echo ($activeTab == 24)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "membership_enquiry" ?>"><i class="fa fa-cog"></i><span>Membership Enquiry</span></a>
</li>
<li class="treeview <?php echo ($activeTab == 24)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "membership_transaction" ?>"><i class="fa fa-cog"></i><span>Membership Transaction</span></a>
</li>

<li class="treeview <?php echo ($activeTab == 24)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "membership_assign" ?>"><i class="fa fa-cog"></i><span>Membership Assign</span></a>
</li>-->

<!-- =========SHOW ALL FOOTER======= -->
<!-- <li class="header">FOOTER CONTENT</li> -->




<!-- <li class="treeview <?php echo ($activeTab == 29)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "contact" ?>"><i class="fa fa-envelope"></i><span>Contact</span></a>
</li> -->


<!-- =========SHOW ALL CONTENT======= -->
<!-- <li class="header">CONTENT MANAGEMENT SYSTEM</li> -->


<!-- POSTING VIEW -->



<!-- <li class="treeview <?php echo ($activeTab == 34)?'active':'';?>">
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>FAQ</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "content/faq" ?>"><i class="fa fa-circle-o"></i><span>FAQ</span></a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "content/faq/index.php?view=contactlist" ?>"><i class="fa fa-circle-o"></i><span>FAQ Contact</span></a>
</li>

</ul>
</li> -->

<!-- <li class="treeview <?php echo ($activeTab == 35)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "content/page" ?>"><i class="fa fa-file"></i><span>Add Static Pages</span></a>
</li> -->

<!-- ==========SETTING========== -->
<!-- <li class="header">SETTING</li>
<li class="treeview <?php echo ($activeTab == 37)?'active':'';?>" >
<a href="<?php echo WEB_ROOT_ADMIN . "setting" ?>"><i class="fa fa-cog"></i><span>All Settings</span></a>
</li> -->



<!-- <li class="treeview <?php echo ($activeTab == 34)?'active':'';?>">
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>Payment Request</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu"> -->
<!--<li>
<a href="<?php echo WEB_ROOT_ADMIN . "withdraw/index.php?view=event" ?>"><i class="fa fa-circle-o"></i><span>Requests</span></a>
</li>-->

<!-- <li>
<a href="<?php echo WEB_ROOT_ADMIN . "withdraw/?view=withdraw" ?>"><i class="fa fa-circle-o"></i><span>Requests</span></a>
</li> -->
<!--  <li>
<a href="<?php echo WEB_ROOT_ADMIN . "content/loking_job" ?>"><i class="fa fa-circle-o"></i><span>Looking For A Job</span></a>
</li>
-->
<!-- </ul>
</li> -->
<!--<li class="treeview <?php echo ($activeTab == 35)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "content/expire.php" ?>"><i class="fa fa-cog"></i><span>Expire Date</span></a>
</li>-->





<!-- <li class="treeview <?php echo ($activeTabnew == 38)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "content/servicebanner.php " ?>"><i class="fa fa-cog"></i><span>Service Banner </span></a>
</li>
-->








<!-- <li class="treeview <?php echo ($activeTab == 35)?'active':'';?>">
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>SP Coin</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<li>
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/spcoin/index.php">
<i class="fa fa-cog"></i><span>Settings </span>
</a>
</li> -->
<!--<li>
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/nft/index.php?view=settings">
<i class="fa fa-cog"></i><span>Setting </span>
</a>
</li>-->
<!-- </ul>
</li>
-->
<?php if(check_permission($_SESSION['userlevel'],175,$dbConn)){ ?>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "users/index.php?view=staff" ?>">
<i class="fa fa-cog"></i><span>Staff Role</span>
</a>
</li>
<?php } ?>












</ul>
</section>
<!-- /.sidebar -->
</aside>
