    
<!-- 


    <?php 
    $pageLink = 'events/dashboard/';
    ?>

    <ul class="sidebar-menu">
        <li><a href="<?php echo $BaseUrl.'/events/'; ?>">Back To Events</a></li>
      
        <li class="<?php echo ($activePage == 1)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink; ?>">Dashboard</a></li>
        <li class="<?php echo ($activePage == 2)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'active-event.php'; ?>" >Active Events</a></li>  
        <li class="<?php echo ($activePage == 3)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'past-event.php'; ?>" >Past Events</a></li>  
        <li class="<?php echo ($activePage == 4)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'draft-event.php'; ?>" >Draft Events</a></li>
        <li class="<?php echo ($activePage == 5)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'sponsor-list.php'; ?>" >Sponsors</a></li>
        <li class="<?php echo ($activePage == 6)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'bookmark.php'; ?>" >Bookmark Events</a></li>
        <li class="<?php echo ($activePage == 7)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'join-event.php'; ?>" >Join Events</a></li>
        <li class="<?php echo ($activePage == 8)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'myFlag.php'; ?>" >Flagged Events</a></li>
        <li class="<?php echo ($activePage == 9)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'trash.php'; ?>" >Trash Events</a></li>
        
    </ul>  -->

 
 <?php 
    $pageLink = 'events/dashboard/';
    ?>

    <div class="left_freelance_top">

       <!--  <p>&nbsp;</p> -->     

        <div class="left_sideevent_menu">
            <!-- <h1 class="skill-category">Dashboard Menu</h1> -->
<!-- <ul class="sidebar-menu" style="padding-top: 20px;"> -->

    <ul class="sidebar-menu ">

         <li class="treeview <?php echo ($activePage == 1 || $activePage == 2 || $activePage == 3 || $activePage == 4 || $activePage == 5 || $activePage == 6 || $activePage == 7 ||  $activePage == 8 ||  $activePage == 9)?'active activeMain' : '';?>">

        <ul class="sidebar-menu no-padding subeventmenu">

      
	  <li class="eventview <?php echo ($activePage == 1)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/events/dashboard/'; ?>" >Events Dashboard</a></li>
<li class="eventview <?php echo ($activePage == 7)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'booking.php'; ?>" >Events Attending</a></li>

	  <li class="eventview" data-toggle="collapse" data-target="#colapsible" style="cursor:pointer" aria-expanded="true"><a>Events Managing &nbsp;<i class="fa fa-caret-down"></i></a></li>
       <!-- <li class="eventviewdashboard <?php echo ($activePage == 1)?' activepage' : '';?>"><a href="<?php echo $BaseUrl.'/events'; ?>">My Events</a></li> -->
		<div id="colapsible"  class="collapse collapse in <?php echo ($activePage == 2 || $activePage == 3 || $activePage == 4 || $activePage == 5 || $activePage ==6 || $activePage ==8 || $activePage ==9 ||$activePage ==11)?'show' : '';?>" aria-expanded="true">
		<?php
		session_start();
		//echo $_SESSION['ptid'];
		//die('===========');
		if($_SESSION['ptid']!=6 || $_SESSION['ptid']!=2 || $_SESSION['ptid']!=5){
		?>
		
        <li class="eventview <?php echo ($activePage == 2)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/post-ad/events/?post'?>" style="padding: 12px 5px 12px 15px;display:block">Submit an Event</a></li>
		<?php } ?>


		
        <li class="eventview <?php echo ($activePage == 11)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'all-event.php'; ?>" style="padding: 12px 5px 12px 15px;display:block">Submitted Events</a></li> 
		<li class="eventview <?php echo ($activePage == 8)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'active-event.php'; ?>" style="padding: 12px 5px 12px 15px;display:block">Active Events</a></li> 
		
        <li class="eventview <?php echo ($activePage == 3)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'past-event.php'; ?>" style="padding: 12px 5px 12px 15px;display:block">Past Events</a></li>  
        <li class="eventview <?php echo ($activePage == 4)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'draft-event.php'; ?>" style="padding: 12px 5px 12px 15px;display:block">Draft Events</a></li>
       <!--- <li class="eventview <?php echo ($activePage == 5)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'sponsor-list.php'; ?>" >Sponsors</a></li>-->
        <li class="eventview <?php echo ($activePage == 6)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'bookmark.php'; ?>" style="padding: 12px 5px 12px 15px;display:block">Bookmarked Events</a></li>
      <!--  <li class="eventview <?php echo ($activePage == 7)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'booking.php'; ?>" >My Booking</a></li> -->
     <!--    <li class="eventview <?php echo ($activePage == 8)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'myFlag.php'; ?>" >Flagged Events</a></li>
        <li class="eventview <?php echo ($activePage == 9)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'trash.php'; ?>" >Trash Events</a></li> -->
        <!-- <li class="eventview <?php echo ($activePage == 9)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'booked.php'; ?>" style="padding: 12px 5px 12px 15px;display:block">Booked Ticket</a></li> -->
		
		<li class="eventview <?php echo ($activePage == 5)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'sponsor-list.php'; ?>" style="padding: 12px 5px 12px 15px;display:block">My Sponsors List</a></li>
		<!--<li class="eventview <?php echo ($activePage == 10)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'my-earning.php'; ?>" style="padding: 12px 5px 12px 15px;display:block">My Earning</a></li>-->
        <li class="eventview <?php echo ($activePage == 77)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'Request_Cancellation.php'; ?>" style="padding: 12px 5px 12px 15px;display:block">Request Cancellation</a></li>
		
        
    </div> 
    </ul> 
</li>
</ul>
</div>
        
        
    </div>