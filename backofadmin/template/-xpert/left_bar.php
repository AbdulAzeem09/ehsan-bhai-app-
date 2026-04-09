<?php
$actual_link = $_SERVER['REQUEST_URI'];
$parts = explode('/',$actual_link);
$actual_link = $parts[3];
$activeLink = chekActiveModule($actual_link);

$activeTab = $activeLink;
// acctiv sub link

die("====");
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
<!-- Sidebar user panel -->
<div class="user-panel">
<div class="pull-left image">
<?php
if(isset($_SESSION['userImg']) && $_SESSION['userImg'] != ''){ ?>
<img src="<?php echo WEB_ROOT;?>/upload/user/<?php echo $_SESSION['userImg'];?>" class="img-circle" style="width: 45px;height: 45px;" alt="User Image" /><?php
}else{ ?>
<img src="<?php echo WEB_ROOT_TEMPLATE;?>/dist/img/no_image.jpg" class="img-circle" alt="User Image"  /> <?php
}
?>

</div>
<div class="pull-left info">
<p><?php echo $_SESSION['accountName'];?></p>
<a href="#"><i class="fa fa-phone text-success"></i> <?php echo $_SESSION['phoneNo'];?></a>
</div>
</div>

<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">

<li class="header">MAIN NAVIGATION</li>
<li class="treeview <?php echo ($activeTab == 1)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN ?>"><i class="fa fa-tachometer"></i> <span>DashBoard</span></a>
</li>
<li class="<?php echo ($activeTab == 2)?'active':'';?> treeview">
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>Task Management</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "notes" ?>">
<i class="fa fa-circle-o"></i> All Sticky Notes
</a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "mytask" ?>">
<i class="fa fa-circle-o"></i> My Task
<span class="pull-right-container pull-right">
<small class="label bg-aqua"><?php latestUnreadTask($dbConn, $_SESSION['userId']); ?></small>
</span>
</a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "waitingTask" ?>">
<i class="fa fa-circle-o text-blue"></i> Waiting Task
</a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "crossTask" ?>">
<i class="fa fa-circle-o text-red"></i> Cross Check
</a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "cmpTask" ?>">
<i class="fa fa-circle-o text-green"></i> Completed Task
</a>
</li>
</ul>
</li>
<!-- profile Settings -->
<li class="treeview <?php echo ($activeTab == 3)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "profileType" ?>"><i class="fa fa-cog"></i><span>Profile Type</span></a>
</li>
<li class="<?php echo ($activeTab == 4)?'active':'';?> treeview">
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>Category </span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "mainCategory" ?>">
<i class="fa fa-circle-o"></i><span>Modules</span>
</a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "allcategory" ?>">
<i class="fa fa-circle-o"></i> All Category
</a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "in_sub_category" ?>">
<i class="fa fa-circle-o"></i> Inner Sub Category
</a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "classificat" ?>">
<i class="fa fa-circle-o"></i> Classified Ads Category
</a>
</li>

</ul>
</li>

<li class="header">REGISTERED USERS</li>
<li class="treeview <?php echo ($activeTab == 5)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "registerdUser" ?>"><i class="fa fa-user-md"></i>
<span>Registered Users</span>
<span class="pull-right-container pull-right">
<small class="label bg-aqua"><?php totalRegUser($dbConn); ?></small>
</span>
</a>
</li>
<li class="treeview <?php echo ($activeTab == 6)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "allprofiles" ?>"><i class="fa fa-cog"></i><span>All Profiles</span></a>
</li>


<li class="<?php echo ($activeTab == 9)?'active':'';?> treeview">
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>Module Form Setting</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu active">
<li>
<a href="#"><i class="fa fa-circle-o"></i> Store <i class="fa fa-angle-left pull-right"></i></a>
<ul class="treeview-menu">
<li><a href="<?php echo WEB_ROOT_ADMIN. "industry_type" ?>"><i class="fa fa-circle-o"></i> Industry Type</a></li>
<li><a href="<?php echo WEB_ROOT_ADMIN. "product_status" ?>"><i class="fa fa-circle-o"></i> Product Status</a></li>
<li><a href="<?php echo WEB_ROOT_ADMIN. "shipping_destination" ?>"><i class="fa fa-circle-o"></i> Shipping Destination</a></li>
</ul>
</li>
<li>
<a href="#"><i class="fa fa-circle-o"></i> Freelance <i class="fa fa-angle-left pull-right"></i></a>
<ul class="treeview-menu">
<li><a href="<?php echo WEB_ROOT_ADMIN. "free_pro_type" ?>"><i class="fa fa-circle-o"></i> Profile Type</a></li>
</ul>
</li>
<li>
<a href="#"><i class="fa fa-circle-o"></i> Job Board <i class="fa fa-angle-left pull-right"></i></a>
<ul class="treeview-menu">
<li><a href="<?php echo WEB_ROOT_ADMIN. "job_level" ?>"><i class="fa fa-circle-o"></i> Job Level</a></li>
</ul>
</li>
<li>
<a href="#"><i class="fa fa-circle-o"></i> Real Estate <i class="fa fa-angle-left pull-right"></i></a>
<ul class="treeview-menu">
<li><a href="<?php echo WEB_ROOT_ADMIN. "property_type" ?>"><i class="fa fa-circle-o"></i> Property Type</a></li>
<li><a href="<?php echo WEB_ROOT_ADMIN. "pro_status" ?>"><i class="fa fa-circle-o"></i> Property Status</a></li>
</ul>
</li>
<li>
<a href="#"><i class="fa fa-circle-o"></i> Art Gallery <i class="fa fa-angle-left pull-right"></i></a>
<ul class="treeview-menu">
<li><a href="<?php echo WEB_ROOT_ADMIN. "art_sold_by" ?>"><i class="fa fa-circle-o"></i> Art Sold By</a></li>
<li><a href="<?php echo WEB_ROOT_ADMIN. "frame_type" ?>"><i class="fa fa-circle-o"></i> Framing Type</a></li>
</ul>
</li>
<li>
<a href="#"><i class="fa fa-circle-o"></i> Music <i class="fa fa-angle-left pull-right"></i></a>
<ul class="treeview-menu">
<li><a href="<?php echo WEB_ROOT_ADMIN. "music_language" ?>"><i class="fa fa-circle-o"></i> Music Language</a></li>

</ul>
</li>


</ul>
</li>
<li class="header">POSTINGS</li>
<!-- SHOW ALL POST THROUGH MODULE WISE -->
<li class="<?php echo ($activeTab == 8)?'active':'';?> treeview">
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
</li>

<li>
<a href="<?php echo WEB_ROOT_ADMIN . "craftgallery" ?>">
<i class="fa fa-circle-o"></i> Craft Gallery
</a>
</li>

<li>
<a href="<?php echo WEB_ROOT_ADMIN . "music" ?>">
<i class="fa fa-circle-o"></i> music
</a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "video" ?>">
<i class="fa fa-circle-o"></i> video
</a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "trainings" ?>">
<i class="fa fa-circle-o"></i> Trainings
</a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "clasifiedadds" ?>">
<i class="fa fa-circle-o"></i> Classified Adds
</a>
</li>


</ul>
</li>
<li class="treeview <?php echo ($activeTab == 9)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "topseller" ?>"><i class="fa fa-user-md"></i><span>Top Sellers</span></a>
</li>
<!--  -->


<li class="treeview <?php echo ($activeTab == 7)?'active':'';?>">
<a href="<?php echo WEB_ROOT_ADMIN . "webmodule" ?>"><i class="fa fa-user-md"></i><span>Admin Module</span></a>
</li>


<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "totalPost" ?>"><i class="fa fa-cog"></i><span>All Posts</span></a>
</li>


<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "artsizes" ?>"><i class="fa fa-cog"></i><span>Sizes (Photo Gallery)</span></a>
</li>
<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "artcategory" ?>"><i class="fa fa-cog"></i><span>Art Gallery Category</span></a>
</li>




<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "evencategory" ?>"><i class="fa fa-cog"></i><span>Event Category</span></a>
</li>
<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "musiccategory" ?>"><i class="fa fa-cog"></i><span>Entertainment Category</span></a>
</li>
<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "projecttype" ?>"><i class="fa fa-cog"></i><span>Project Type(Freelance)</span></a>
</li>


<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "sponsor" ?>"><i class="fa fa-cog"></i><span>Sponsor</span></a>
</li>
<li class="treeview">
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>Location</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "country" ?>"><i class="fa fa-circle-o"></i><span>Countries</span></a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "state" ?>"><i class="fa fa-circle-o"></i><span>State/Province</span></a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "city" ?>"><i class="fa fa-circle-o"></i><span>Cities</span></a>
</li>
</ul>
</li>
<li class="header">STATISTICS</li>
<li class="<?php echo ($activeTab == 8)?'active':'';?> treeview">
<a href="javascript:void(0)">
<i class="fa fa-bar-chart"></i> <span>All Modules Statistics</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "statistic" ?>">
<i class="fa fa-circle-o"></i> store
</a>
</li>

</ul>
</li>
<li class="header">NEWS</li>
<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "cmpnynews" ?>"><i class="fa fa-newspaper-o"></i><span>Company News</span></a>
</li>
<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "cmpnynews/index.php?view=ban" ?>"><i class="fa fa-ban"></i><span>Ban News</span></a>
</li>
<!-- GROUPS -->
<li class="header">USER GROUPS</li>
<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "groups" ?>"><i class="fa fa-users"></i><span>Groups</span></a>
</li>
<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "groups/index.php?view=ban" ?>"><i class="fa fa-ban"></i><span>Banned Groups</span></a>
</li>
<li class="header">USER MANAGEMENT</li>

<?php
if(isset($_SESSION['userlevel']) && $_SESSION['userlevel'] == 1){
?>
<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "users" ?>"><i class="fa fa-user-md"></i>
<span>USERS</span>
<span class="pull-right-container pull-right">
<small class="label bg-red"><?php totalAdminUser($dbConn); ?></small>
</span>
</a>
</li>
<?php
}
?>

<li class="header">FLAG MANAGEMENT</li>
<li class="treeview">
<a href="javascript:void(0)">
<i class="fa fa-flag"></i> <span>Flag Post</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu active">
<li><a href="<?php echo WEB_ROOT_ADMIN."flag/index.php?catId=1"?>"><i class="fa fa-circle-o"></i> Store</a></li>
<li><a href="<?php echo WEB_ROOT_ADMIN."flag/index.php?catId=5"?>"><i class="fa fa-circle-o"></i> Freelance </a></li>
<li><a href="<?php echo WEB_ROOT_ADMIN."flag/index.php?catId=2"?>"><i class="fa fa-circle-o"></i> Job Board </a></li>
<li><a href="<?php echo WEB_ROOT_ADMIN."flag/index.php?catId=3"?>"><i class="fa fa-circle-o"></i> Real Estate </a></li>
<li><a href="<?php echo WEB_ROOT_ADMIN."flag/index.php?catId=9"?>"><i class="fa fa-circle-o"></i> Event </a></li>
<li><a href="<?php echo WEB_ROOT_ADMIN."flag/index.php?catId=13"?>"><i class="fa fa-circle-o"></i> Art Gallery </a></li>
<li><a href="<?php echo WEB_ROOT_ADMIN."flag/index.php?catId=14"?>"><i class="fa fa-circle-o"></i> Music </a></li>
<li><a href="<?php echo WEB_ROOT_ADMIN."flag/index.php?catId=10"?>"><i class="fa fa-circle-o"></i> Videos </a></li>
<li><a href="<?php echo WEB_ROOT_ADMIN."flag/index.php?catId=8"?>"><i class="fa fa-circle-o"></i> Trainings </a></li>
<li><a href="<?php echo WEB_ROOT_ADMIN."flag/index.php?catId=7"?>"><i class="fa fa-circle-o"></i> Classified Ads </a></li>

</ul>
</li>
<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "flag/index.php?view=flaguser" ?>"><i class="fa fa-user"></i><span>Flag User</span></a>
</li>


<li class="header">MEMBERSHIP</li>
<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "membership" ?>"><i class="fa fa-cog"></i><span>All Membership</span></a>
</li>
<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "membership_enquiry" ?>"><i class="fa fa-cog"></i><span>Membership Enquiry</span></a>
</li>


<!-- =========SHOW ALL FOOTER======= -->
<li class="header">FOOTER CONTENT</li>
<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "content/footleft" ?>"><i class="fa fa-cog"></i><span>Left Content</span></a>
</li>
<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "foothead" ?>"><i class="fa fa-cog"></i><span>Footer Heading Colum</span></a>
</li>
<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "page/footer" ?>"><i class="fa fa-cog"></i><span>Footer Pages</span></a>
</li>
<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "contacttopic" ?>"><i class="fa fa-envelope"></i><span>Contact Topic Issue</span></a>
</li>
<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "contact" ?>"><i class="fa fa-envelope"></i><span>Contact</span></a>
</li>
<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "social" ?>"><i class="fa fa-envelope"></i><span>Social Media</span></a>
</li>

<!-- =========SHOW ALL CONTENT======= -->
<li class="header">CONTENT</li>

<li class="treeview">
<a href="javascript:void(0)">
<i class="fa fa-home"></i> <span>Home Page</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "content/email_market" ?>"><i class="fa fa-circle-o"></i><span>Email Marketing</span></a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "content/sms_market" ?>"><i class="fa fa-circle-o"></i><span>SMS Marketing</span></a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "content/feature" ?>"><i class="fa fa-circle-o"></i><span>Feature</span></a>
</li>

</ul>
</li>
<!-- POSTING VIEW -->
<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "content/posting" ?>"><i class="fa fa-file-text"></i><span>Posting Content</span></a>
</li>

<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "content/profile" ?>"><i class="fa fa-cog"></i><span>Profile Content</span></a>
</li>
<li class="treeview">
<a href="javascript:void(0)">
<i class="fa fa-cog"></i> <span>Job Board</span> <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "content/hire_employe" ?>"><i class="fa fa-circle-o"></i><span>Hire An Employee</span></a>
</li>
<li>
<a href="<?php echo WEB_ROOT_ADMIN . "content/loking_job" ?>"><i class="fa fa-circle-o"></i><span>Looking For A Job</span></a>
</li>

</ul>
</li>
<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "content/page" ?>"><i class="fa fa-file"></i><span>Add Static Pages</span></a>
</li>
<!-- SEND EMAIL TO ALL PROFILES -->
<li class="header">EMAIL</li>
<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "emailuser" ?>"><i class="fa fa-envelope"></i><span>Email to users</span></a>
</li>
<!-- ==========SETTING========== -->
<li class="header">SETTING</li>
<li class="treeview">
<a href="<?php echo WEB_ROOT_ADMIN . "setting" ?>"><i class="fa fa-cog"></i><span>All Settings</span></a>
</li>



</ul>
</section>
<!-- /.sidebar -->
</aside>
