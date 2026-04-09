    

    <?php 
    $pageLink = 'events/dashboard/';
    ?>

    <ul class="sidebar-menu">
        <li><a href="<?php echo $BaseUrl.'/'.$pageLink; ?>">Back To Events</a></li>
        <!-- seller dashboard by default -->
        <li class="<?php echo ($activePage == 1)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink; ?>">Dashboard</a></li>
        <li class="<?php echo ($activePage == 2)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'active-event.php'; ?>" >Active Events</a></li>  
        <li class="<?php echo ($activePage == 3)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'past-event.php'; ?>" >Past Events</a></li>  
        <li class="<?php echo ($activePage == 4)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'draft-event.php'; ?>" >Draft Events</a></li>
        <li class="<?php echo ($activePage == 5)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'sponsor-list.php'; ?>" >Sponsors</a></li>
        <li class="<?php echo ($activePage == 6)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'bookmark.php'; ?>" >Bookmark Events</a></li>
        <li class="<?php echo ($activePage == 7)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'join-event.php'; ?>" >Join Events</a></li>
        <li class="<?php echo ($activePage == 8)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'myFlag.php'; ?>" >Flagged Events</a></li>
        <li class="<?php echo ($activePage == 9)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'trash.php'; ?>" >Trash Events</a></li>
        
    </ul> 