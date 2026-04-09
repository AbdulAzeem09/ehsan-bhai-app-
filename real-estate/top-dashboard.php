

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse no-padding header_po" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
        <li class="<?php echo ($activePage == 9)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/real-estate/dashboard.php';?>" class="">Dashboard</a></li>
        <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
        
        <li class="<?php echo ($activePage == 1)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/real-estate/active-property.php';?>" class=""> Active Property</a></li>
        <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
        <li class="<?php echo ($activePage == 2)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/real-estate/rent-property.php';?>" class="">Rent Entire Place</a></li>
        <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
        <li class="<?php echo ($activePage == 4)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/real-estate/rent-room.php';?>" class="">Rent Room</a></li>
        <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
        <li class="<?php echo ($activePage == 3)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/real-estate/draft-property.php';?>" class="">Draft Property</a></li>
        <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
        <li class="<?php echo ($activePage == 5)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/real-estate/my-enquiry.php';?>" class="">My Enquires</a></li>
        <li class="hidden-xs"><a href="#" class="seprator">|</a></li>

        <li class="<?php echo ($activePage == 6)?'active' : '';?> id="booking">
            <div class="dropdown" id="storeMenuQuote" style="margin-top: 8px;">
                <button class="btn dropdown-toggle" style="background-color: transparent;" type="button" data-toggle="dropdown">Booking <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo $BaseUrl.'/real-estate/booking.php';?>">My Received Booking</a></li>
                    <li><a href="<?php echo $BaseUrl.'/real-estate/my_send_booking.php'; ?>">My Send Booking</a></li>
                </ul>
            </div>
        </li>


        
        <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
        <li class="<?php echo ($activePage == 7)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/real-estate/flag.php';?>" class="">Favourite Listing</a></li>
        <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
        <li class="<?php echo ($activePage == 10)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/real-estate/myFlag.php';?>" class="">Flagged Posting</a></li>
            

    </ul>
</div><!-- /.navbar-collapse -->