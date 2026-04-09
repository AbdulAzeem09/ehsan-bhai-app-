    

    <?php
    $pageLink = "/coupon/";
    ?>

    <ul class="sidebar-coupon-menu">
        <li><a href="<?php echo $BaseUrl.$pageLink; ?>" ><i class="fa fa-globe leftmenu_icon" aria-hidden="true"></i>ALL CATEGORIES <span class="couponwhite">(60)</span></a></li>
        
        <li class="<?php echo ($activePage == 1)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink; ?>" ><i class="fa fa-cutlery leftmenu_icon" aria-hidden="true"></i> FOOD & DRINK <span class="couponwhite">(40)</span></a></li> 

        <li class="<?php echo ($activePage == 2)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'active-music.php'; ?>" ><i class="fa fa-calendar leftmenu_icon" aria-hidden="true"></i> EVENTS <span class="couponwhite">(10)</span></a></li>  

        <li class="<?php echo ($activePage == 3)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'past-music.php'; ?>" ><i class="fa fa-gift leftmenu_icon" aria-hidden="true"></i>BEAUTY <span class="couponwhite">(30)</span></a></li>  

        <li class="<?php echo ($activePage == 4)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'playlist.php'; ?>" ><i class="fa fa-bolt leftmenu_icon" aria-hidden="true"></i> FITNESS <span class="couponwhite">(20)</span></a></li>  

        <li class="<?php echo ($activePage == 5)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'album.php'; ?>" ><i class="fa fa-picture-o leftmenu_icon" aria-hidden="true"></i> FURNITURE <span class="couponwhite">(40)</span></a></li> 

        <li class="<?php echo ($activePage == 6)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'private.php'; ?>" ><i class="fa fa-umbrella leftmenu_icon" aria-hidden="true"></i>FASHION <span class="couponwhite">(10)</span></a></li> 

        <li class="<?php echo ($activePage == 7)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'favourite.php'; ?>" ><i class="fa fa-cart-plus leftmenu_icon" aria-hidden="true"></i> SHOPPING <span class="couponwhite">(30)</span></a></li>  

        <li class="<?php echo ($activePage == 8)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'lyrics.php'; ?>" ><i class="fa fa-home leftmenu_icon" aria-hidden="true"></i> HOME & GARDAN <span class="couponwhite">(50)</span></a></li>  

        <li class="<?php echo ($activePage == 9)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'myFlag.php'; ?>" ><i class="fa fa-plane leftmenu_icon" aria-hidden="true"></i> TRAVEL <span class="couponwhite">(20)</span></a></li>  
      
    </ul> 
