<?php
$r = new _postlike;
$ProfileId = $_SESSION['pid'];
$likecount = $r->readcount($ProfileId);

$userId = $_SESSION['uid'];
$p = new _postingview;
$events = $p->activeuserpost($userId);
if ($events != false) {
    $totalevents = mysqli_num_rows($events);
}

$shares = $p->activesharepost($userId);
if ($shares != false) {
    $totalShares = mysqli_num_rows($shares);
}

$o = new _order;
$pr = new _spprofiles;
$sales = $o->todayselling($userId);
if ($sales != false) {
    $totalSales = mysqli_num_rows($sales);
}

$e = new _postenquiry;
$enqu = $e->countunreadmessage($ProfileId);
if ($enqu != false) {
    $totalEnq = mysqli_num_rows($enqu);
}

$date = date('Y-m-d');
$date = strtotime($date);
$date = strtotime("+3 day", $date);
$date = date('Y-m-d', $date);
$expiry_item = $p->comingExpiredPosts($ProfileId, $date);
if ($expiry_item != false) {
    $totalExpiryItem = mysqli_num_rows($expiry_item);
}
//$res = $r->friends($_SESSION["uid"]); //As a receiver
?>

<div class='list-group'>
    <h4 style="color:#337ab7">Bussines Updates</h4>    
    <div style='padding:10px 0px;' class='list-group-item list-group-item-action friendchat myfriends' data-friendname='Marina'>        
        <span class='frndname'>SP Points</span>
        <span class='frdicon' data-frndicon='' style="float: right">1245</span>                              
    </div> 
    <div style='padding:10px 0px;' class='list-group-item list-group-item-action friendchat myfriends' data-friendname='Marina'>      

        <span class='frndname'>Items Expiring</span>
        <span class='frdicon' data-frndicon='' style="float: right"><?php echo (isset($totalExpiryItem) ? $totalExpiryItem : 0) ?></span>                              
    </div> 
    <div style='padding:10px 0px;' class='list-group-item list-group-item-action friendchat myfriends' data-friendname='Marina'>      

        <span class='frndname'>Enquiries Today</span>
        <span class='frdicon' data-frndicon='' style="float: right"><?php echo (isset($totalEnq) ? $totalEnq : 0); ?></span>                              
    </div> 
    <div style='padding:10px 0px;' class='list-group-item list-group-item-action friendchat myfriends' data-friendname='Marina'>      

        <span class='frndname'>Sales</span>
        <span class='frdicon' data-frndicon='' style="float: right"><?php echo (isset($totalSales) ? $totalSales : 0) ?></span>                              
    </div> 

    <h4 style="color:#337ab7">Social Updates</h4>
    <div style='padding:10px 0px;' class='list-group-item list-group-item-action friendchat myfriends' data-friendname='Marina'>      
        <span class='frndname'>Events</span>
        <span class='frdicon' data-frndicon='' style="float: right"><?php echo (isset($totalevents)) ? $totalevents : 0; ?></span>                               
    </div>
    <div style='padding:10px 0px;' class='list-group-item list-group-item-action friendchat myfriends' data-friendname='Marina'>      
        <span class='frndname'>Post likes</span>
        <span class='frdicon' data-frndicon='' style="float: right"><?php echo (isset($likecount)) ? $likecount : 0; ?></span>                               
    </div>
    <div style='padding:10px 0px;' class='list-group-item list-group-item-action friendchat myfriends' data-friendname='Marina'>      
        <span class='frndname'>Followers</span>
        <span class='frdicon' data-frndicon='' style="float: right">10</span>                               
    </div>
    <div style='padding:10px 0px;' class='list-group-item list-group-item-action friendchat myfriends' data-friendname='Marina'>      
        <span class='frndname'>Shares</span>
        <span class='frdicon' data-frndicon='' style="float: right"><?php echo (isset($totalShares)) ? $totalShares : 0; ?></span>                               
    </div>
    <div style='padding:10px 0px;' class='list-group-item list-group-item-action friendchat myfriends' data-friendname='Marina'>      
        <span class='frndname'>Following</span>
        <span class='frdicon' data-frndicon='' style="float: right">10</span>                               
    </div>
</div>