    
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
    $pageLink = 'grouptimelines/dashboard/';
    ?>

    <div class="left_freelance_top">

       <!--  <p>&nbsp;</p> -->     

        <div class="left_sideevent_menu">
            <!-- <h1 class="skill-category">Dashboard Menu</h1> -->
<!-- <ul class="sidebar-menu" style="padding-top: 20px;"> -->

    <ul class="sidebar-menu ">

         <li class="treeview <?php echo ($activePage == 1 || $activePage == 2 || $activePage == 3 || $activePage == 4 || $activePage == 5 || $activePage == 6 || $activePage == 7 ||  $activePage == 8 ||  $activePage == 9)?'active activeMain' : '';?>">

        <ul class="sidebar-menu no-padding subeventgroupmenu">

        <li><a href="<?php echo $BaseUrl.'/events/'; ?>">Back To Events</a></li>
      
        <li class="eventviewdashboard <?php echo ($activePage == 1)?' activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink; ?>">Dashboard</a></li>

     <!--    <li class="eventview <?php echo ($activePage == 2)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'active-event.php'; ?>" >Active Events</a></li>  
        <li class="eventview <?php echo ($activePage == 3)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'past-event.php'; ?>" >Past Events</a></li>  
        <li class="eventview <?php echo ($activePage == 4)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'draft-event.php'; ?>" >Draft Events</a></li> -->

           <li class="eventview <?php echo ($activePage == 4)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'group-activeevent.php'; ?>" >Event History</a></li>

        <li class="eventview <?php echo ($activePage == 5)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'group-sponsorlist.php'; ?>" >Sponsors</a></li>

        <li class="eventview <?php echo ($activePage == 6)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'bookmark.php'; ?>" >Bookmark Events</a></li>

        <li class="eventview <?php echo ($activePage == 7)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'booking.php'; ?>" >My Booking</a></li>
     <!--    <li class="eventview <?php echo ($activePage == 8)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'myFlag.php'; ?>" >Flagged Events</a></li>
        <li class="eventview <?php echo ($activePage == 9)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'trash.php'; ?>" >Trash Events</a></li> -->
        <li class="eventview <?php echo ($activePage == 9)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'booked.php'; ?>" >Booked Ticket</a></li>

        
        
    </ul> 
</li>
</ul>
</div>
        
        
    </div>