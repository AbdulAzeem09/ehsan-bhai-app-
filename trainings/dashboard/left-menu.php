    

    <?php
    $pageLink = "/trainings/dashboard/";
    ?>


    <ul class="sidebar-menu">
        <li><a href="<?php echo $BaseUrl.'/trainings'; ?>">Homepage</a></li>
        
        <li class="<?php echo ($activePage == 1)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink; ?>" >Dashboard</a></li>  
        <li class=""><a href="<?php echo $BaseUrl.'/post-ad/trainings/?post'; ?>" >Post a Course</a></li>
		<li class="<?php echo ($activePage == 2)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'active.php'; ?>" >Active Trainings</a></li>

        <li class="<?php echo ($activePage == 8)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'draft.php'; ?>" >Draft Trainings</a></li>
		
		<li class="<?php echo ($activePage == 7)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'pending.php'; ?>" >Pending Trainings</a></li>  
        <li class="<?php echo ($activePage == 3)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'favourite.php'; ?>" >Favourite Trainings</a></li>    
        <li class="<?php echo ($activePage == 4)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'myFlag.php'; ?>" >Flagged Trainings</a></li>  
		  <li class="<?php echo ($activePage == 5)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'mypurchase.php'; ?>" >My Purchase</a></li> 
		   <li class="<?php echo ($activePage == 6)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'requested_course.php'; ?>" >Requested Course</a></li>

    </ul> 
