   <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
<style>
<?php if($_SERVER['REQUEST_URI'] == "/store/category_search.php" || $_SERVER['QUERY_STRING'] == "alpha=A" || $_SERVER['QUERY_STRING'] == "alpha=B" || $_SERVER['QUERY_STRING'] == "alpha=C" || $_SERVER['QUERY_STRING'] == "alpha=D" || $_SERVER['QUERY_STRING'] == "alpha=E" || $_SERVER['QUERY_STRING'] == "alpha=F" || $_SERVER['QUERY_STRING'] == "alpha=G" || $_SERVER['QUERY_STRING'] == "alpha=H" || $_SERVER['QUERY_STRING'] == "alpha=I" || $_SERVER['QUERY_STRING'] == "alpha=J" || $_SERVER['QUERY_STRING'] == "alpha=K" || $_SERVER['QUERY_STRING'] == "alpha=L" || $_SERVER['QUERY_STRING'] == "alpha=M" || $_SERVER['QUERY_STRING'] == "alpha=N" || $_SERVER['QUERY_STRING'] == "alpha=O" || $_SERVER['QUERY_STRING'] == "alpha=Q" || $_SERVER['QUERY_STRING'] == "alpha=R" || $_SERVER['QUERY_STRING'] == "alpha=S" || $_SERVER['QUERY_STRING'] == "alpha=T" || $_SERVER['QUERY_STRING'] == "alpha=U" || $_SERVER['QUERY_STRING'] == "alpha=V" || $_SERVER['QUERY_STRING'] == "alpha=W" || $_SERVER['QUERY_STRING'] == "alpha=X" || $_SERVER['QUERY_STRING'] == "alpha=Y" || $_SERVER['QUERY_STRING'] == "alpha=Z"){ ?>
.classpadding
{
   padding: 13px 2px 13px 2px!important;
}
<?php } else { ?>
.classpadding
{
   padding: 13px 13px 13px 13px!important;
}
<?php } ?> 

</style>
<style type="text/css">
<?php
    if (isset($pageTitle) && $pageTitle =='categorystore') {?>
        .classpadding {
            padding: 13px 11px 13px 11px!important;
        }
    <?php 
    }
?>
</style>

<div class="storenavigation" style="margin-bottom: 11px;background-color: #fff!important;">
        <nav class="navbar">
            <div class="">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle navbartog" data-toggle="collapse" data-target="#storenavbar_">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span> 
                    </button>
                    
                </div>

                <div class="collapse navbar-collapse " id="storenavbar_">
                    <ul class="nav navbar-nav top_margin" style="padding-left: 2px;">

                       <li style="margin-left: 10px;margin-right: 1px;">

                         <a   class="classpadding <?php if($_GET['folder'] == "home") { echo "store_active"; }  ?>" href="<?php echo $BaseUrl.'/store/storeindex.php?condition=All&folder=home&page=1';?>">Home</a></li>


                        <li style="margin-left: 1px;margin-right: 1px;">
                            <a   class="classpadding <?php if($_SERVER['REQUEST_URI'] == "/my-store/" || $_SERVER['PHP_SELF'] == "/my-store/index.php" ){ echo "store_active"; } ?>" href="<?php echo $BaseUrl.'/my-store/?condition=All&folder=retail&page=1';?>">My Store</a></li>

                        <!-- <li><a href="<?php echo $BaseUrl.'/store/';?>">Public Store</a></li> -->
                   <li style="margin-left: 1px;margin-right: 1px;">

                          <a  class="classpadding <?php if($_GET['folder'] == "retail") { echo "store_active"; }  ?>" href="<?php echo $BaseUrl.'/retail/view-all.php?condition=All&folder=retail&page=1';?>">Retail Store</a></li>

                      
                        <li style="margin-left: 1px;margin-right: 1px;"><a  class="classpadding <?php if($_GET['folder'] == "wholesale") { echo "store_active"; } ?>"  href="<?php echo $BaseUrl.'/wholesale/?condition=All&folder=wholesale&page=1';?>">Wholesale</a></li>  
                        <li style="margin-left: 1px;margin-right: 1px;">



                          <a style="padding: 13px 13px 13px 13px!important;" class="classpadding <?php if($_GET['type'] == "auction") { echo "store_active"; } ?>" href="<?php echo $BaseUrl.'/store/view-all-auction.php?type=auction';?>">Auction</a></li>

                        <li style="margin-left: 1px;margin-right: 1px;"><a  class="classpadding <?php if($_GET['folder'] == "grpstore") { echo "store_active"; } ?>" href="<?php echo $BaseUrl.'/store/group-store.php?condition=All&folder=grpstore&page=1';?>">Group Store</a></li>
						
                        <li style="margin-left: 1px;margin-right: 1px;"><a  class="classpadding <?php if($_GET['folder'] == "frdstore") { echo "store_active"; } ?>" href="<?php echo $BaseUrl.'/store/friend-store.php?condition=All&folder=frdstore&page=1';?>">Friends Store</a></li>
                         <li style="margin-left: 1px;margin-right: 1px;"><a  class="classpadding  <?php if($_GET['folder'] == "rfq") { echo "store_active"; } ?>" href="<?php echo $BaseUrl.'/public_rfq/?condition=All&folder=rfq&page=1'; ?>">RFQ</a></li>
                        <li style="margin-left: 1px;margin-right: 1px;"><a  class="classpadding <?php if($_GET['folder'] == "cat") { echo "store_active"; } ?>" href="<?php echo $BaseUrl.'/store/category_search.php?condition=All&folder=cat&page=1'; ?>">Categories</a></li>
                        <?php if($_SESSION['guet_yes'] != 'yes'){ ?>
                        <li style="margin-left: 1px;margin-right: 1px;" class="text-left"><a  class="classpadding <?php if($_SERVER['REQUEST_URI'] == "/store/dashboard/"){ echo "store_active"; } ?>" href="<?php echo $BaseUrl.'/store/dashboard/?condition=All&folder=retail&page=1';?>">My Dashboard</a></li><?php } ?> 
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    
