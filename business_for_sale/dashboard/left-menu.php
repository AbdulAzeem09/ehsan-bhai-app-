<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/style.css">  
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">

<style>
.activepage>a {
font-size: 13px;
font-weight: bold;
color: #3e2048;
}

</style>

<div class="left_grid left_group_gray"> 
<a href="<?php echo $BaseUrl;?>/business_for_sale/index.php?page=1" style="color:#787f85;font-size:14px;font-family:times"><i class="fa fa-arrow-left"></i> Back To Business Sale Home</a> 
<p class="text-center" style="font-size:20px;"><b>My Dashboard</b></p>
<div class="left_store">
<div class="left_filter1" style="border: none;">
<?php 

$p = new _businessrating;
$result = $p->read_business_active($_SESSION['uid'],$_SESSION['pid']);
$active=$result->num_rows;


$bu1=$p->read_business($_SESSION['uid'],$_SESSION['pid']);
$all=$bu1->num_rows;


$result2 = $p->read_business_enquiry($_SESSION['pid']);
$received=$result2->num_rows;

$result3 = $p->read_business_sent_enquiry($_SESSION['pid']);
$sent=$result3->num_rows;

$result4 = $p->read_business_expired($_SESSION['uid'], $_SESSION['pid']);
$expired=$result4->num_rows;

$result5 = $p->read_fav_business_all($_SESSION['uid'], $_SESSION['pid']);
$fav=$result5->num_rows;

$result6 = $p->read_flag_business($_SESSION['pid'], $_SESSION['uid']);
$flag=$result6->num_rows;
$result7 = $p->read_business_draft($_SESSION['uid'], $_SESSION['pid']);
$draft=$result7->num_rows;
?>



<!-- <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/business_for_sale/dashboard/all_listing.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/business_for_sale/dashboard/all_listing.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> All Listing &nbsp;<span style="color:#0f8f46; font-size:14px;"><?php if($all!=0){echo '('.$all.')';}else{echo "(0)";}?></span></a></li>-->

<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/business_for_sale/dashboard/index.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/business_for_sale/dashboard/index.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> My Dashboard &nbsp;<span style="color:#0f8f46; font-size:14px;"></span></a></li>
<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/business_for_sale/dashboard/enquiry.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/business_for_sale/dashboard/enquiry.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> My Received Enquiries &nbsp;<span style="color:#0f8f46; font-size:14px;"><?php if($received!=0){echo '('.$received.')';}else{echo "(0)";}?></span></a></li>



<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/business_for_sale/dashboard/sent_enquiry.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/business_for_sale/dashboard/sent_enquiry.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> My Sent Enquiries &nbsp;<span style="color:#0f8f46; font-size:14px;"><?php if($sent!=0){echo '('.$sent.')';}else{echo "(0)";}?></span></a></li>

<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/business_for_sale/dashboard/active_listing.php"||$_GET['msg']=="uadata")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/business_for_sale/dashboard/active_listing.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Active Listing &nbsp;<span style="color:#0f8f46; font-size:14px;"><?php if($active!=0){echo '('.$active.')';}else{echo "(0)";}?></span></a></li>

<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/business_for_sale/dashboard/expired_listing.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/business_for_sale/dashboard/expired_listing.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Expired Listing &nbsp;<span style="color:#0f8f46; font-size:14px;"><?php if($expired!=0){echo '('.$expired.')';}else{echo "(0)";}?></span></a></li>

<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/business_for_sale/dashboard/favourite_business.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/business_for_sale/dashboard/favourite_business.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Favourites &nbsp;<span style="color:#0f8f46; font-size:14px;"><?php if($fav!=0){echo '('.$fav.')';}else{echo "(0)";}?></span></a></li>

<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/business_for_sale/dashboard/draft.php"||$_GET['msg']=="uddata")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/business_for_sale/dashboard/draft.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Draft&nbsp;<span style="color:#0f8f46; font-size:14px;"><?php if($draft!=0){echo '('.$draft.')';}else{echo "(0)";}?></span></a></li>


<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/business_for_sale/dashboard/flag_listing.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/business_for_sale/dashboard/flag_listing.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Flag&nbsp;<span style="color:#0f8f46; font-size:14px;"><?php if($flag!=0){echo '('.$flag.')';}else{echo "(0)";}?></span></a></li>

<!--  <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/myallproduct_orderhistory.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/my_orderhistory.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/storereturn_item.php?orderid=".$cid)?'activepage' : '';?> " ><a href="<?php echo $BaseUrl.'/store/dashboard/myallproduct_orderhistory.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> My Order History</a></li>



<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/activebid.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/activebid.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Auction Bid</a></li>

<!--    <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/activebid.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/activebid.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Active Bid</a></li> -->




<!--    <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/unpaidbid.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/unpaidbid.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Unpaid Bid</a></li>

<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/paidbid.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/paidbid.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Paid Bid</a></li>

<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/track.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/track.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Track Order11</a></li>

<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my_send_enguiry.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/my_send_enguiry.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Enquiry <span style="color:#0f8f46; font-size:18px;"><?php $en = new _sppostenquiry;
$result = $en->getbuyerEnquery($_SESSION['pid']);
if ($result) {
echo '('.$result->num_rows.')';
}

else 
{
echo '(0)';
}?></span></a>
<?php

?>
</li>




<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my_rfq.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/quotation_list.php?idspRfq=".$_GET['idspRfq'])?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/my_rfq.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> RFQ 
<span style="color:#0f8f46; font-size:18px;"><?php 
$r = new _rfq;
$result = $r->readsubmittedRfqquote($_SESSION['pid']);
$rfq=0;
if($result)
{
$rfq=$result->num_rows;
}
else 
{
echo '(0)';
}?></span></a>
<?php

?>

</a></li>

<!--   <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my_rfq.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/quotation_list.php?idspRfq=".$_GET['idspRfq'])?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/my_rfq.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Public RFQ</a></li>

<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/private_rfq.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/private_rfq.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Private RFQ</a></li> 



<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my-favourite.php")?'activepage' : '';?>"><a  href="<?php echo $BaseUrl.'/store/dashboard/my-favourite.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Favourite Products</a></li>

<!--  <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my-returningitem.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/my-returningitem.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Returning Items</a></li>

<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my-problemwithorder.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/my-problemwithorder.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Problem With Order</a></li>


<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/flag-post.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/flag-post.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Flag Product <span style="color:#0f8f46; font-size:18px;"><?php  
$objflag = new _flagpost;

//print_r($_SESSION);

//echo 
$resultflaf=$objflag->readflag3($_SESSION['pid'] ,1);

// var_dump($resultflaf);
//die("-------------------");
if($resultflaf!=false){
echo '('.$resultflaf->num_rows.')';
}

else 
{
echo '(0)';
}?></span></a>


<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/rfq_flag.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/rfq_flag.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> RFQ Flag <span style="color:#0f8f46; font-size:18px;"><?php  $objflag = new _flagpost;

//print_r($_SESSION);

//echo 
$resultflaf=$objflag->readflagrfq($_SESSION['pid'] ,1);

// var_dump($resultflaf);
//die("-------------------");
if($resultflaf!=false){ 
echo '('.$resultflaf->num_rows.')';
}
else{
echo '(' . 0 .')';
}

?></span></a></li>
<?php
$objflag = new _spquotation;

//print_r($_SESSION);

//echo 
$pid=$_SESSION['pid'];
$resultflaf=$objflag->readQuote1($pid);
$countQuote=$resultflaf->num_rows;

?>





<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/quoteHistory.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard/quoteHistory.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Quote History <span style="color:#0f8f46; font-size:18px;"> (<?php 
if($countQuote==""){
echo 0;
} else{
echo $countQuote;
}

?>)</span>
</a></li>-->

</div>

<!-- <h1><a href="<?php //echo $BaseUrl.'/store/dashboard/faq.php'; ?>">FAQ</a></h1>-->
<div>


</div>


</div>
</div>
</div>

