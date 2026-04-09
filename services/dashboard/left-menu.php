<?php
    $pageLink = "/services/dashboard/";
    ?>

    <ul class="sidebar-menu">
        <li style="font-family:times"><a href="<?php echo $BaseUrl.'/services'; ?>">Back To Classified Ad Home</a></li>
        <?php  if($_SESSION['ptid'] != 2 && $_SESSION['ptid'] != 5){  ?>
          
        <li class="<?php echo ($activePage == 1)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink; ?>" >Dashboard</a></li>  
        <li class="<?php echo ($activePage == 10)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'all_ads.php'; ?>" >All Ads</a></li> 

		<li class="<?php echo ($activePage == 2)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'active.php'; ?>" >Active Ads</a></li>
    <li class="<?php echo ($activePage == 15)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'deactivated.php'; ?>">Deactivated Ads</a></li>  
		 
        <li class="<?php echo ($activePage == 3)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'past.php'; ?>" >Expired Ads</a></li> 

        <?php  } ?> 
        <?php  if($_SESSION['ptid'] == 2 || $_SESSION['ptid'] == 5){  ?>

         <li class="<?php echo ($activePage == 1)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'dashboard.php'; ?>" >Dashboard</a></li>   
         
         <li class="<?php echo ($activePage == 4)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'favourite.php'; ?>" >Favourite Ads</a></li> 

         <li class="<?php echo ($activePage == 77)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'myenquiry.php'; ?>" >Enquiries  Sent</a></li>
         <li class="<?php echo ($activePage == 78)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'sortlist.php'; ?>" >Shortlisted Ads</a></li>   

        <?php } ?> 
         <?php  if($_SESSION['ptid'] != 2 && $_SESSION['ptid'] != 5){  ?>
      <!--   <li class="<?php echo ($activePage == 5)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'myFlag.php'; ?>" >Flagged Ads</a></li> --> 
        <li class="<?php echo ($activePage == 6)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'draft.php'; ?>" >Draft Ads</a></li>
        <li class="<?php echo ($activePage == 7)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'enquiry.php'; ?>" >Enquiry Received</a></li> 

         <li class="<?php echo ($activePage == 77)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'myenquiry.php'; ?>" >Enquiry Sent</a></li>

         <li class="<?php echo ($activePage == 4)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'favourite.php'; ?>" >Favourite Ads</a></li>

          <li class="<?php echo ($activePage == 78)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'sortlist.php'; ?>" >Shortlisted Ads</a></li>  
        
        <?php } ?>  
         <li class="<?php echo ($activePage == 8)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'flagpost.php'; ?>" >Flag Post</a></li>  
    </ul> 
